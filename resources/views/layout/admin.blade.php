<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Astral') }} - Mayborn Science Theater | @yield('title')</title>

  <!-- Meta -->
  <meta name="description" content="@yield('meta_description')">

  <meta name="keywords" content="mayborn science theater, ctc planetarium, field trip,
  field trips, reservation, @yield('meta_keywords')" />

  <!-- MomentJS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

  <script
    src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>

  <link rel="stylesheet" href="{{ asset('semantic/semantic.min.css') }}">

  <script src="{{ asset('semantic/semantic.min.js') }}"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.3.0/fullcalendar.min.css" rel="stylesheet" />

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.3.0/fullcalendar.min.js"></script>

  <link rel="stylesheet" href="https://unpkg.com/flatpickr/dist/flatpickr.min.css">
  <script src="https://unpkg.com/flatpickr"></script>

  <script src="{{ asset('js/vendor.js') }}"></script>

  <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">

  <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
  <script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>

</head>
<script>
  $(document)
    .ready(function() {
      // create sidebar and attach to menu open
      $('.ui.sidebar')
      .sidebar('setting', 'transition', 'overlay')
      .sidebar('setting', 'dimPage', false)
      .sidebar('attach events', '.toc.item');

      // close message alerts
      $('.message .close').on('click', function() {
        $(this).closest('.message').transition('fade');
      });

      // Initialize Semantic UI components
      $('.ui.radio.checkbox').checkbox();
      $('.ui.dropdown').dropdown();

      /*jQuery('.datetimepicker').datetimepicker({
        format:'dddd, MMMM DD, YYYY H:mm',
        formatTime:'H:mm',
        formatDate:'dddd, MMMM DD, YYYY',
        minTime: '08:00',
        maxTime: '24:00'
      });*/
    });

</script>

<style> textarea { font:inherit } </style>

<body>
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


    <div class="ui basic segment" style="margin-top:3rem">

      @include('admin.partial._message')

      @yield('content')

    </div>

  </div>

</body>
</html>
