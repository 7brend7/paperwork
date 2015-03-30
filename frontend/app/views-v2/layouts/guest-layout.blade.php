<!DOCTYPE html>
<html lang="en">
  <head>
    @include('partials/header-sidewide-meta')

    <!-- [[ HTML::style('css/bootstrap.min.css') ]] -->
    <!-- [[ HTML::style('css/bootstrap-theme.min.css') ]] -->

    [[ HTML::style('css/themes/paperwork-v2.min.css') ]]

  </head>
  <body class="paperwork-guest">

    <div class="container container-guest">
      <div class="guest-logo">
        <img class="guest-logo-img" src="/images/paperwork-logo.png">
      </div>
      @yield("content")
    </div> <!-- /container -->

    <div class="footer [[ Config::get('paperwork.showIssueReportingLink') ? '' : 'hide' ]]">
      <div class="container container-guest">
        <div class="alert alert-warning" role="alert">
          <p>[[Lang::get('messages.found_bug')]]</p>
        </div>
      </div>
    </div>

  [[ HTML::script('js/jquery.min.js') ]]
  [[ HTML::script('js/libraries.min.js') ]]
  </body>
</html>
