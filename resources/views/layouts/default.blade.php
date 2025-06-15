<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @yield('commons.head')
</head>

<body class="container">
    <div class="row">
        <div style="width: 20%;">
            @yield('commons.nav')
        </div>
        <div style="width: 80%;">
            @yield('header')
            @yield('contents')
            @yield('footer')
        </div>
        <!-- <div style="width: 20%;">
            @yield('commons.aside')
        </div> -->
    </div>
    @yield('modals.add-item')
    @yield('modals.send-apply')
    @yield('modals.send-comment')
    @yield('modals.edit-profile')
    @yield('modals.password-reissue')
    @yield('modals.register')
    @yield('modals.tmp-register')
    @yield('modals.overlay')
    @yield('commons.foot')
</body>

</html>