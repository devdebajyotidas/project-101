@include('common.header')
<body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar ">
    @include('common.topbar')
    @include('common.sidebar')
    <div class="app-content content container-fluid">
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>
    @include('common.footer')
    @include('common.js')
</body>