<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('/build/assets/product.css')}}" type="text/css">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: "{{ route('products.search') }}",
                dataType: 'html',
            })
            .done(function(data) {
                let newTable = $(data).find('#table-1');
                $('#table-1').html(newTable);
                console.log("Ajaxリクエスト成功");
            })
            .fail(function() {
                console.log("Ajaxリクエスト失敗");
            });

            $(function(){
                $(".sortable-link").on("click",function(event){
                    event.preventDefault();
                    let sortColumn = $(this).data('column');
                    let sortDirection = $(this).data('direction');
                    sortDirection = sortDirection === "asc" ? "desc" : "asc";
                    console.log("ソートリンクがクリックされました");

                    $.ajax({
                        type:'GET',
                        url:"{{ route('products.search') }}",
                        data:{
                           'sortColumn': sortColumn,
                           'sortDirection' :sortDirection
                        },
                        dataType:'html',
                    })

                    .done(function(data){
                        let newTable = $(data).find('#table-1');
                        $('#table-1').html(newTable); 
                        console.log("Ajax3リクエスト成功");
                    })
                    .fail(function() {
                        console.log("Ajax3リクエスト失敗");
                    });                
                });
            });

        $(function(){
            $("#search-btn").on("click",function(event){
                event.preventDefault();
                let keyword =$("#keyword").val();
                let companyId =$("#companyId").val();
                let jougenPrice =$('#jougenPrice').val();
                let kagenPrice =$('#kagenPrice').val();
                let jougenStock =$('#jougenStock').val();
                let kagenStock =$('#kagenStock').val();
                $.ajax({
                    type:'GET',
                    url:"{{ route('products.search') }}",
                    data:{
                        'keyword': keyword,
                       'companyId' : companyId,
                       'jougenPrice' :jougenPrice,
                       'kagenPrice' :kagenPrice,
                       'jougenStock' :jougenStock,
                       'kagenStock' :kagenStock
                    },
                    dataType:'html',
                })

                .done(function(data){
                    let newTable = $(data).find('#table-1');
                    $('#table-1').html(newTable); 
                    console.log("Ajax2リクエスト成功");
                })
                .fail(function() {
                    console.log("Ajax2リクエスト失敗");
                });                
            });
        });
    });
});



    </script>


    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
