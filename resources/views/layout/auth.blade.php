<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Astral') }} - {{ App\Setting::find(1)->organization }}</title>

  <!-- Meta -->
  <meta name="description" content="@yield('meta_description')">

  <meta name="keywords" content="mayborn science theater, ctc planetarium, field trip,
  field trips, reservation, @yield('meta_keywords')" />

  @yield('meta')

  <!-- Google Analytics -->
  <!--<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-92903603-1', 'auto');
    ga('send', 'pageview');

  </script>-->

  <!-- Libraries -->
  <link rel="stylesheet" href="/css/vendor.css">
  <script src="/js/vendor.js"></script>

  <link rel="stylesheet" href="/semantic/semantic.min.css">
  <script src="/semantic/semantic.min.js"></script>

</head>
<script>
  $(document)
    .ready(function() {
      // close message alerts
      $('.message .close').on('click', function() {
        $(this).closest('.message').transition('fade');
      });
    });
</script>

<style>
    #left {
        padding-top: 2.5rem;
        background: linear-gradient(rgba(0,0,0,1), rgba(255,255,255,0.5)), url('{{ (App\Setting::find(1)->cover == '/cover.jpg') ? App\Setting::find(1)->cover : Storage::url(App\Setting::find(1)->cover) }}');
        background-size: cover;
        min-height: 100vh
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
  <!--- @ include('partial._sidebar') --->



  <!-- Page Contents -->
  <div class="pusher">

    <!-- Top Fixed Menu -->
    <!-- @ include('partial._menu') -->

    <!-- Messages -->


    <div class="ui basic segment">

      @yield('content')

    </div>

  </div>

  <script type="text/javascript">
    $('[type="submit"]').click(function() {
      $('.ui.dimmer').addClass('active')
      this.form.submit()
    })
  </script>

</body>
</html>
