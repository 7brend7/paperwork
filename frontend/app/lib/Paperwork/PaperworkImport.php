<?php
/**
 * Created by PhpStorm.
 * User: Borys Anikiyenko
 * Date: 02.02.2015
 */

namespace Paperwork;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class PaperworkImport
{
    protected $xml;

    protected $notebook;

    protected function checkXmlSource()
    {
        if(isset($this->xml['@attributes'], $this->xml['@attributes']['application']) && preg_match('/evernote/i', $this->xml['@attributes']['application'])) {
            return 'Paperwork\PaperwokImportEvernote';
        }

        return false;
    }

    public function import(UploadedFile $file)
    {
        $this->xml = simplexml_load_file($file->getRealPath(), 'SimpleXMLElement', LIBXML_PARSEHUGE | LIBXML_NOCDATA);
        $this->xml = json_decode(json_encode($this->xml), true);

        if($method = $this->checkXmlSource()) {
            // TODO: need to think how better put xml property to child class without copying.
            $obj = new $method($this->xml);
            $obj->process();

            return $obj->getNotebookId();
        }

        return false;
    }

    public function getNotebookId()
    {
        return $this->notebook->id;
    }

    protected function createNotebook($title)
    {
        $this->notebook = \Notebook::firstOrCreate([
            'title' => $title
        ]);

        if (! $this->notebook->users->contains(\Auth::user()->id)) {
            $this->notebook->users()->attach(\Auth::user()->id, array('umask' => \PaperworkHelpers::UMASK_OWNER));
        }
    }

    protected function createNote($title, $content, $created_at, $updated_at)
    {
        $noteCreate = new \Note;

        $noteCreate->created_at = $created_at;
        $noteCreate->updated_at = $updated_at;

        $versionCreate = new \Version([
            'title'           => $title,
            'content'         => $content,
            'content_preview' => mb_substr(strip_tags($content), 0, 255),
            'created_at'      => $created_at,
            'updated_at'      => $updated_at
        ]);
        $versionCreate->save();

        $noteCreate->version()->associate($versionCreate);
        $noteCreate->notebook_id = $this->notebook->id;

        $noteCreate->save();
        $noteCreate->users()->attach(\Auth::user()->id, array('umask' => \PaperworkHelpers::UMASK_OWNER));

        return $noteCreate;
    }

    protected function createTag($title)
    {
        $tagCreate = \Tag::firstOrCreate([
            'title' => $title
        ]);

        if (! $tagCreate->users->contains(\Auth::user()->id)) {
            $tagCreate->users()->attach(\Auth::user()->id);
        }

        return $tagCreate;
    }

    protected function createAttachment($data, $fileName, $mime = '')
    {
        if(empty($mime)) {
            $f = finfo_open();
            $mime = finfo_buffer($f, $data, FILEINFO_MIME_TYPE);
        }

        $newAttachment = new \Attachment(array(
            'filename'      => $fileName,
            'fileextension' => pathinfo($fileName, PATHINFO_EXTENSION),
            'mimetype'      => $mime,
            'filesize'      => strlen($data)
        ));
        $newAttachment->save();

        $destinationFolder = \Config::get('paperwork.attachmentsDirectory') . '/' . $newAttachment->id;
        if(!\File::makeDirectory($destinationFolder, 0700)) {
            $newAttachment->delete();
            throw new \Exception('Error creating directory');
        }
        file_put_contents($destinationFolder . '/' . $fileName, $data);

        return $newAttachment;
    }
}