<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <style>

            .message {
                margin: 20px 0;
                padding: 10px 20px 5px 42px;
                min-height: 22px;
            }
            .message p {
                margin: 0 0 0.45em;
            }
            .message.critical {
                border: 1px solid #f5d1d1;
                background:#fdd url(../images/msg-err.png) no-repeat 8px 8px;
                color: #800 !important;	
            }

            .message.success {
                border: 1px solid #cce6bb;
                background:#def6cf url(../images/msg-tick.png) no-repeat 8px 7px;
                color: #265708 !important;
            }

            .message.important {
                border: 1px solid #dace89;
                background:#ffb url(../images/i-important.png) no-repeat 8px 7px;
                color: #000 !important;
            }

            .message.standard {
                border: 1px solid #cddbea;
                background:#e6ebf0 url(../images/i-std.png) no-repeat 8px 7px;
                color: #2e5c99 !important;
            }
        </style>

        <!--in this first can send csrfToken-->
        <script>
            window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?>
        </script>
        <?php if (!auth()->guest()): ?>
            <script>
                //in this state can send auth end point url 
                window.Laravel.broadcastURL = '<?= url('/broadcasting/auth') ?>';
                //send auth user id to subscrip with private channal
                window.Laravel.userId = <?= auth()->user()->id ?>;
                window.Laravel.unreadnotification ='<?=route('unreadNotifications')?>';
            </script>
        <?php endif; ?>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </body>
</html>
