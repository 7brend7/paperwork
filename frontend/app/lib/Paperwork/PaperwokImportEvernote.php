<?php
/**
 * Created by PhpStorm.
 * User: Borys Anikiyenko
 * Date: 03.02.2015
 */

namespace Paperwork;

class PaperwokImportEvernote extends PaperworkImport
{
    public function __construct($xml)
    {
        $this->xml = $xml;
    }

    public function process()
    {
        if(isset($this->xml['note'])) {
            $this->createNotebook('Evernote');

            libxml_use_internal_errors(true);
            foreach($this->xml['note'] as $note) {
                $this->createEvernoteNote($note, $this->getNoteContent($note));
            }
            libxml_use_internal_errors(false);
        }
    }

    protected function getNoteContent($note)
    {
        // Get content from xml. Use DOMDocument
        $doc = new \DOMDocument;
        $doc->loadHTML($note['content']);

        // Remove xml, doctype and body tags
        $body = new \DOMDocument();
        $cloned = $doc->getElementsByTagName('body')->item(0)->cloneNode(true);
        $body->appendChild($body->importNode($cloned, true));
        $res = str_replace( array('<body>', '</body>', '<en-note', '</en-note>'), array('', '', '<div', '</div>'), $body->saveHTML());
        return mb_convert_encoding($res, 'UTF-8', 'HTML-ENTITIES');
    }

    protected function createEvernoteNote($note, $content)
    {
        $noteCreate = $this->createNote($note['title'], $content, strtotime($note['created']), (isset($note['updated'])) ? strtotime($note['updated']) : strtotime($note['created']));

        if(isset($note['tag'])) {
            $tagsIds = [];

            // Can be single element if 1 tag
            if(!is_array($note['tag'])) {
                $note['tag'] = [$note['tag']];
            }
            foreach($note['tag'] as $tag) {
                $tagCreate = $this->createTag($tag);
                $tagsIds[] = $tagCreate->id;
            }

            $noteCreate->tags()->sync($tagsIds);
        }

        if(isset($note['resource'])) {
            if(isset($note['resource']['data'])) {
                $note['resource'] = [$note['resource']];
            }
            foreach($note['resource'] as $attachment) {
                // No name? Use rand
                $fileName = (isset($attachment['resource-attributes'], $attachment['resource-attributes']['file-name'])) ? $attachment['resource-attributes']['file-name'] : uniqid(rand(), true);

                $fileContent = base64_decode($attachment['data']);
                $fileHash = md5($fileContent);

                $newAttachment = $this->createAttachment($fileContent, $fileName, $attachment['mime']);

                $noteVersion = $noteCreate->version()->first();

                // TODO: review regexp - need to fetch style attribute in another way.
                // replace en-media tag by img
                if(str_contains($attachment['mime'], 'image')) {
                    $noteVersion->content = preg_replace('/<en-media[^>]*hash="' . $fileHash . '"([^>]*)><\/en-media>/', '<img $1 src="/api/v1/notebooks/' . $this->notebook->id . '/notes/' . $noteCreate->id . '/versions/' . $noteVersion->id . '/attachments/' . $newAttachment->id . '/raw" />', $noteVersion->content);
                }
                else {
                    $noteVersion->content = preg_replace('/<en-media[^>]*hash="' . $fileHash . '"([^>]*)><\/en-media>/', '<a $1 href="/api/v1/notebooks/' . $this->notebook->id . '/notes/' . $noteCreate->id . '/versions/' . $noteVersion->id . '/attachments/' . $newAttachment->id . '/raw">'.$fileName.'</a>', $noteVersion->content);
                }
                $noteVersion->attachments()->attach($newAttachment);
                $noteVersion->save();

                // Doesn't work.
                // \Queue::push('DocumentParserWorker', array('user_id' => \Auth::user()->id, 'document_id' => $newAttachment->id));
            }
        }
    }
}