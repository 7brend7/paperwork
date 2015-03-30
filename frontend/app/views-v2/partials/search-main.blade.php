<form ng-controller="SidebarNotesController" class="search" id="searchForm" role="form" ng-submit="submitSearch()">
    <i class="icon-search"></i>
    <input type="text" placeholder="[[Lang::get('keywords.search_dotdotdot')]]" ng-model="search">
</form>