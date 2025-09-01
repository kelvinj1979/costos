<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Sistema de Costos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!--begin::Fonts-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
    integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />
  <!--end::Fonts-->
  <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
    integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />
  <!--end::Third Party Plugin(OverlayScrollbars)-->
  <!--begin::Third Party Plugin(Bootstrap Icons)-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
  <!--end::Third Party Plugin(Bootstrap Icons)-->
  <!--begin::Required Plugin(AdminLTE)-->
  <link rel="stylesheet" href="{{ url('/') }}/css/plugins/adminlte.min.css" />
  <!--end::Required Plugin(AdminLTE)-->
  <link href="https://cdn.jsdelivr.net/npm/use-bootstrap-tag@2.2.2/dist/use-bootstrap-tag.min.css" rel="stylesheet">
  <!-- include summernote css/js https://summernote.org/getting-started/#for-bootstrap-5 -->
  <link href="{{ url('/') }}/css/plugins/summernote-bs5.css" rel="stylesheet">
  <!--begin::Required Plugin(Notie)-->
  <link rel="stylesheet" href="{{ url('/') }}/css/plugins/notie.css" />
  <!--end::Required Plugin(Notie)-->
  <!-- include dataTables css/js https://datatables.net/ -->
  <link rel="stylesheet" href="{{ url('/') }}/css/plugins/dataTables.min.css" />
  <!-- DataTables Bootstrap 5 CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

  <!--begin::Notie script --https://github.com/jaredreich/notie -->
  <script src="{{ url('/') }}/js/notie.js"></script>
  <!-- 
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet"> -->

  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<!--begin::Body-->

@if (Route::has('login'))
  @auth

    <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">

    @include('module.header')
    @include('module.sidebar')

    @yield('content') 
   

    @include('module.footer')

    </div>


    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
    integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)-->
    <!-- include libraries(jQuery, bootstrap) 
    <script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    -->
    <script type="text/javascript" src="//code.jquery.com/jquery-3.7.1.js"></script>

    <!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
    <!--end::Required Plugin(Bootstrap 5)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <script src="{{ url('/') }}/js/adminlte.min.js"></script>
    <!--end::Required Plugin(AdminLTE)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <!-- fuente: https://use-bootstrap-tag.js.org/install.html -->
    <script src="https://cdn.jsdelivr.net/npm/use-bootstrap-tag@2.2.2/dist/use-bootstrap-tag.min.js"></script>
    <!-- include summernote css/js https://summernote.org/getting-started/#for-bootstrap-5-->
    <script src="{{ url('/') }}/js/summernote-bs5.js"></script>
    <!--end::Third Party Plugin(Bootstrap Icons)
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>-->
    <!--begin::customizer script-->
    <script>
    window.baseUrl = "{{ url('/') }}";
    </script>
    <script src="{{ url('/') }}/js/myscript.js?v={{ time() }}"></script>
    <!--begin::Notie script --https://github.com/jaredreich/notie -->
    <script src="{{ url('/') }}/js/notie.js"></script>
    <!--end::Notie script -->
    <!-- include dataTables js https://datatables.net/ -->
    <script src="{{ url('/') }}/js/dataTables.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <!-- Incluye Chart.js desde CDN antes de tu script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!--begin::OverlayScrollbars Configure-->
    <script>
    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    const Default = {
      scrollbarTheme: 'os-theme-light',
      scrollbarAutoHide: 'leave',
      scrollbarClickScroll: true,
    };
    document.addEventListener('DOMContentLoaded', function () {
      const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
      if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
      OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
      scrollbars: {
      theme: Default.scrollbarTheme,
      autoHide: Default.scrollbarAutoHide,
      clickScroll: Default.scrollbarClickScroll,
      },
      });
      }
    });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!--begin::Bootstrap Tag Configure-->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
      document.querySelectorAll('.tag-input').forEach(el => UseBootstrapTag(el));
    });
    </script>
    <!--end::Bootstrap Tag Configure-->

    <!--end::Script-->
    </body>
@else
    @include('pages.login')
  @endauth
@endif

</html>