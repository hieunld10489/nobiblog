<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <title>@yield('title')</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
        <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
        <!-- Links -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>

        <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/jquery-confirm.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('stellar/assets/css/main.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/common.css') }}"/>
        <link rel="stylesheet" href="{{ asset('search/css/main.css') }}"/>

        @hasSection('link')
            @yield('link')
        @endif
    </head>
    <body class="is-preload">
        <!-- Nav SP -->
        @include('partials/nav', ['type' => 'sp'])

            <!-- Wrapper -->
        <div id="wrapper">

            <!-- Header -->
            <header id="header" class="alt text-light">
                {{--<span class="logo"><img src="{{ asset('stellar/images/logo.svg') }}" alt="logo" /></span>--}}
                <h1>NobiBlog</h1>
                <p class="text-hide"><small>IT、スポーツ等に関する用語集を掲載しています。</small></p>
            </header>

            <!-- Nav PC -->
            @include('partials/nav', ['type' => 'pc'])

            <!-- Main -->
            <div id="main">
                @hasSection('bread_crumb')
                    @yield('bread_crumb')
                @endif

                <div id="main-page" class="container-fluid">
                    <div class="row">
                        @include('partials/word_search')
                    </div>
                    <div class="row">
                        <div id="left-content" class="col-lg-8 col-sm-8">
                            @yield('content')
                        </div>
                        <div class="col-lg-4 col-sm-4">
                            @include('partials/right_content')
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer id="footer">
                <p class="copyright">&copy;Design by <a href="#header" class="scroll">Julio Ngo</a>.</p>
            </footer>

        </div>

        <div id="process-content" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog">
            <div class="modal-dialog modal-lg"></div>
        </div>

        <button class="to-top btn btn-dark"><i class="fa fa-lg fa-chevron-up"></i></button>
        <button class="to-bottom btn btn-dark"><i class="fa fa-lg fa-chevron-down"></i></button>

        <input type="hidden" id="_token" value="{{ csrf_token() }}">

        <!-- Scripts -->
        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/jquery-confirm.js') }}"></script>
        <script src="{{ asset('stellar/assets/js/jquery.scrollex.min.js') }}"></script>
        <script src="{{ asset('stellar/assets/js/jquery.scrolly.min.js') }}"></script>
        <script src="{{ asset('stellar/assets/js/browser.min.js') }}"></script>
        <script src="{{ asset('stellar/assets/js/breakpoints.min.js') }}"></script>
        <script src="{{ asset('stellar/assets/js/main.js') }}"></script>

        <script type="text/javascript">
            function getDomain(url) {
                return '{{ url('') }}/' + url;
            }
        </script>
        <script src="{{ asset('js/common.js') }}"></script>

        @hasSection('script')
            @yield('script')
        @endif
    </body>
</html>
