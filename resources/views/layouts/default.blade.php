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
            @yield('commons.header')
            @yield('contents')
            @yield('commons.footer')
        </div>
        <!-- <div style="width: 20%;">
                @yield('commons.aside')
            </div> -->
    </div>
    @yield('modals.add-item')
    @yield('modals.apply-send')
    @yield('modals.comment-send')
    @yield('modals.update-profile')
    @yield('modals.user-register')
    @yield('modals.issue-onetime-password')
    @yield('modals.overlay')
    @yield('commons.foot')
</body>

</html>