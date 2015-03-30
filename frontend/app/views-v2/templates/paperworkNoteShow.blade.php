<h3 class="note-header">{{note.version.title}}</h3>

<div class="note-tags">
    <ul class="list-unstyled">
        <li ng-repeat="tag in note.tags" ng-click="openTag(tag.id)" class="note-tags-item input-tag-{{ tag.visibility < 1 ? 'private' : 'public' }}"><a href="#">{{ tag.title }}</a></li>
    </ul>
</div>

<div class="note-content" ng-bind-html="note.version.content | unsafe"></div>