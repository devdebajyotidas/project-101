@include('common.header')
<body class="{{isset($bodyClass) ? $bodyClass : ''}}">
    @include('common.topbar')
    @include('common.sidebar')

    @yield('page')

    @include('common.footer')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('common.js')
</body>