@extends("layouts/user-layout")
@section("content")

@include('modal/messagebox')
@include('modal/manageTags')
@include('modal/manageNotebooks')

<div class="content">
    <div class="row">
        <div class="row hidden-md hidden-lg">
            <div class="col-xs-14 mobile-show-navigation">
                <button class="sidebar-toggle btn btn-default"><i class="icon-slide-right"></i></button>
                <button class="sidebar-toggle-hidden btn btn-default"><i class="icon-slide-left"></i></button>
            </div>
        </div>
        <div class="col-md-3 border-r set-height" ng-controller="SidebarNotebooksController">
            <div class="sidebar">
                @include('partials/sidebar')

                <div class="footer footer-issue [[ Config::get('paperwork.showIssueReportingLink') ? '' : 'hide' ]]">
                    <div class="">
                        <div class="alert alert-warning" role="alert">
                            <p>[[Lang::get('messages.found_bug')]]</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="notesListViewParent" class="col-md-3 border-r set-height" ng-controller="SidebarNotesController">

            <div class="sort-by-row row">
                <div class="col-xs-8">
                    <label class="current-notebook">All Notes</label>
                </div>
                <div class="col-xs-6">
                    <div class="dropdown sort-by">
                        <button class="btn btn-default dropdown-toggle" type="button" id="sortByDropDown" data-toggle="dropdown" aria-expanded="true">
                            Sort By
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="sortByDropDown">
                            <li ng-click="sortNotes('title', false);"><a href="#">Title</a></li>
                            <li ng-click="sortNotes('created_at', true);"><a href="#">Created</a></li>
                            <li ng-click="sortNotes('updated_at', true);"><a href="#">Modified</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            @include('partials/notes-list')


        </div>
        <div id="paperworkViewParent" class="col-md-8 set-height" ng-controller="ViewController">
            @include('partials/single-note-header')
            @include('partials/history-control')
            <div class="single-note-content" ng-view></div>
        </div>
    </div>
</div>
@stop