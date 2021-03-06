<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Astral') }} - {{ App\Setting::find(1)->organization }} | @yield('title')</title>

  <!-- Meta -->
  <meta name="description" content="@yield('meta_description')">

  <meta name="keywords" content="mayborn science theater, ctc planetarium, field trip,
  field trips, reservation, @yield('meta_keywords')" />

  {{-- Libraries ---}}
  <link rel="stylesheet" href="/css/vendor.css">
  <script src="/js/vendor.js"></script>

  <link rel="stylesheet" href="/semantic/semantic.min.css">
  <script src="/semantic/semantic.min.js"></script>

  <link rel="stylesheet" href="{{ mix('css/app.css') }}">

</head>
<script>
  $(document)
    .ready(function() {
      // create sidebar and attach to menu open
      $('.ui.sidebar')
      .sidebar('setting', 'transition', 'overlay')
      .sidebar('setting', 'dimPage', true)
      .sidebar('attach events', '.toc.item');

      // close message alerts
      $('.message .close').on('click', function() {
        $(this).closest('.message').transition('fade');
      });

      // Initialize Semantic UI components
      $('.ui.radio.checkbox').checkbox();
      @if (!Request::routeIs("admin.sales.index"))
      $('.ui.dropdown').dropdown({'fullTextSearch': true});
      $('.ui.dropdown.item').dropdown({on: 'hover'});
      @endif
      $('.ui.checkbox').checkbox()
    });

</script>

<style>

  textarea { font:inherit }

  .CodeMirror, .CodeMirror-scroll {
    min-height: 100px;
  }

  .fc-event .fc-bg { background: none !important}

  .fc-content { font-weight: bold !important }

  .ui.label { margin-left:0 !important }

  @media only screen and (max-width:700px) {
    .hide-on-mobile { display:none !important }
    .ui.label       { margin-left:0 !important }
  }

  @media print {
    .ui.borderless.inverted.fixed.top.menu {display: none !important}
    .ui.basic.segment {margin-top: 0 !important}
  }
</style>

<body>
  <div class="ui inverted dimmer">
    <div class="ui large text loader">Loading</div>
  </div>
  <!-- Load Facebook SDK for JavaScript -->
  <!--<div id="fb-root"></div>
  <script>
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script>-->

  <!--- Sidebar Menu -->
  @include('admin.partial._sidebar')



  <!-- Page Contents -->
  <div class="pusher">

    <!-- Top Fixed Menu -->
    @include('admin.partial._menu')

    <!-- Messages -->

    @include('admin.partial._message')

    <div class="ui basic segment" style="margin-top:3.5rem">

      @yield('content')

    </div>

  </div>

  <script type="text/javascript">
    $('.ui.positive.button').not('[onclick]').click(function() {
      if (document.querySelector('form')) {
        if ($('form').form('is valid')) {
          $('.ui.dimmer').addClass('active')
          this.form.submit()
        }
      }
      else {
        $('.ui.dimmer').addClass('active')
        this.form.submit()
      }
    })
  </script>

  @if (Request::routeIs('admin.sales.*'))
  {{-- Astral JS --}}
  <script src="{{ mix('js/app.js') }}"></script>
  @endif
  
  <style>
    #app { margin-top: -2rem !important }
  </style>


</body>
</html>
