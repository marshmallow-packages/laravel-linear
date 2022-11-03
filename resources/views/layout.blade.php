<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full font-sans antialiased">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite('resources/css/app.css', 'marshmallow/linear')

    <!-- Livewire -->
    @livewireStyles

    <!-- Scripts -->
    @vite('resources/js/app.js', 'marshmallow/linear')

    <!-- Livewire -->
    @livewireScripts


</head>

<body class="h-full text-[#F4F5F8] ] bg-[#050b1c]">
    <div class="h-full">
        <div class="mx-auto px-view py-view">
            <div
                class="flex items-center justify-center min-h-screen px-4 pt-4 pb-10 text-left sm:mx-auto sm:p-4 sm:w-auto sm:max-w-lg ">
                <div class="flex flex-col justify-center space-y-4">
                    <div class="block mx-auto">
                        <svg width="166" height="56" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.24 31.206 25.793 46.76c-7.943-1.343-14.212-7.612-15.555-15.555ZM10 26.983 30.017 47a19 19 0 0 0 3.474-.51L10.51 23.51a19 19 0 0 0-.51 3.473Zm1.506-6.462 24.973 24.973c.91-.39 1.782-.85 2.612-1.371L12.877 17.909c-.522.83-.98 1.703-1.371 2.612Zm3.063-4.904A18.97 18.97 0 0 1 28.986 9C39.487 9 48 17.513 48 28.014a18.97 18.97 0 0 1-6.617 14.417L14.569 15.617Z"
                                fill="#6E79D6" />
                            <path
                                d="M64 39.672h14.432v-3.903h-9.665v-18.49H64v22.393Zm17.5 0h4.69V22.877H81.5v16.795Zm2.356-18.96c1.398 0 2.543-1.06 2.543-2.361 0-1.29-1.145-2.351-2.543-2.351-1.387 0-2.531 1.06-2.531 2.35 0 1.302 1.144 2.362 2.531 2.362Zm10.78 9.251c.011-2.165 1.31-3.434 3.204-3.434 1.882 0 3.016 1.225 3.005 3.28v9.863h4.69V28.979c0-3.915-2.312-6.32-5.835-6.32-2.51 0-4.326 1.224-5.086 3.181h-.198v-2.963h-4.47v16.795h4.69v-9.71ZM116.937 40c4.183 0 7.001-2.023 7.662-5.139l-4.338-.284c-.473 1.279-1.684 1.946-3.247 1.946-2.345 0-3.831-1.542-3.831-4.046v-.01h11.515v-1.28c0-5.707-3.479-8.528-7.948-8.528-4.976 0-8.202 3.51-8.202 8.692 0 5.325 3.182 8.649 8.389 8.649Zm-3.754-10.42c.099-1.913 1.563-3.444 3.644-3.444 2.036 0 3.445 1.443 3.456 3.444h-7.1Zm19.397 10.41c2.499 0 4.117-1.083 4.942-2.647h.132v2.329h4.448V28.344c0-4.001-3.413-5.685-7.178-5.685-4.051 0-6.715 1.924-7.364 4.986l4.337.35c.319-1.116 1.321-1.936 3.005-1.936 1.597 0 2.51.798 2.51 2.176v.066c0 1.082-1.156 1.224-4.095 1.509-3.346.306-6.352 1.421-6.352 5.171 0 3.324 2.389 5.008 5.615 5.008Zm1.343-3.215c-1.442 0-2.477-.667-2.477-1.947 0-1.312 1.09-1.957 2.741-2.187 1.024-.142 2.697-.382 3.258-.754v1.782c0 1.76-1.464 3.106-3.522 3.106Zm11.817 2.897h4.69V30.17c0-2.066 1.519-3.488 3.588-3.488.65 0 1.542.11 1.982.252V22.8a7.084 7.084 0 0 0-1.475-.164c-1.894 0-3.446 1.093-4.062 3.17h-.176v-2.93h-4.547v16.795Z"
                                fill="#fff" />
                        </svg>
                    </div>
                    <div
                        class="w-full p-12 space-y-2 transition ease-linear border shadow-2xl shadow-indigo-500/20 border-gray-100/10 bg-radial from-white/20 to-white/5 backdrop-blur-md rounded-2xl ">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
