@include('backend.includes.head')
<title>@yield('title')</title>
<body class="sb-nav-fixed">
@include('backend.includes.leftmenu')
@yield('main-section')
</body>
@include('backend.includes.alerts')
@include('backend.includes.footer')
@yield('scripts')
