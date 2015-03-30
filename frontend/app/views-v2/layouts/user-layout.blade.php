<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials/header-sidewide-meta')

    [[ HTML::style('css/themes/paperwork-v2.min.css') ]]

    [[ HTML::style('css/other/sprite.css') ]]

    <!-- Mobile only -->
    [[ HTML::style('css/other/owl.carousel.css') ]]

    [[ HTML::style('css/freqselector.min.css') ]]
    [[ HTML::style('css/typeahead.min.css') ]]
    [[ HTML::style('//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css') ]]

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body ng-app="paperworkNotes">
<div ng-controller="ConstructorController"></div>
<div class="container-fluid">
    <div class="main row">
        <div class="header">
            <div class="row">
                <div class="col-md-3 hidden-sm hidden-xs border-r">
                    <div class="sidebar-top">
                        <a class="logo" href="[[ URL::route("/") ]]"><img src="/images/navbar-logo.png"> Paperwork</a>
                        <button class="sidebar-toggle btn btn-default"><i class="icon-slide-left"></i></button>
                    </div>
                </div>
                <div class="col-md-4 col-xs-5">
                    <button class="sidebar-toggle-hidden btn btn-default hidden-sm hidden-xs"><i class="icon-slide-right"></i></button>
                    @include('partials/search-main')
                </div>
                <div class="col-md-6 col-sm-8 col-xs-7">
                    @include('partials/navigation-main')

                </div>
                <div class="col-md-1 col-sm-1 col-xs-2 text-center">
                    <button ng-controller="SidebarNotesController" class="header-add-note btn btn-default" ng-click="newNote(getNotebookSelectedId())"><i class="plus-char">+</i></button>
                </div>
            </div>
        </div>
        @yield("content")
    </div>
</div>
[[ HTML::script('js/jquery.min.js') ]]
[[ HTML::script('js/libraries.min.js') ]]
[[ HTML::script('js/angular.min.js') ]]
[[ HTML::script('js/bootstrap.min.js') ]]
[[ HTML::script('js/tagsinput.min.js') ]]
[[ HTML::script('js/paperwork-native.min.js') ]]
[[ HTML::script('js/other/snap.min.js') ]]
[[ HTML::script('js/other/jquery.matchHeight-min.js') ]]
[[ HTML::script('js/other/owl.carousel.min.js') ]]
[[ HTML::script('js/other/init.min.js') ]]
[[ HTML::script('js/other/jquery.form.js') ]]
[[ HTML::script('js/paperwork.min.js') ]]

[[ HTML::script('ckeditor/ckeditor.js') ]]
[[ HTML::script('ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js') ]]
[[ HTML::script('//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js') ]]

</body>
</html>