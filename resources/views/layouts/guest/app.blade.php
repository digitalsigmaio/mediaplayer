<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mediaplayer') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/manifest.js') }}" defer></script>
    <script src="{{ mix('js/vendor.js') }}" defer></script>
    <script src="{{ mix('js/app.js') }}" defer></script>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
<div id="app">
    <v-app
            id="inspire"
            dark
    >
        <v-content>

            <v-container
                    justify-center
                    fill-height
            >
                <v-layout
                        align-center
                        justify-center
                        fill-height
                >
                    @yield('content')

                </v-layout>
            </v-container>

            </section>
        </v-content>

    </v-app>
</div>
</body>
</html>
