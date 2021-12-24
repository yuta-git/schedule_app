<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title> @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link rel="icon" href="{{ asset('images/favicon.ico')}} ">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/addition.css') }}">
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.css' rel='stylesheet' />
    </head>

    <body>
        <header class="mb-4">
            <nav class="navbar navbar-expand-sm navbar-dark bg-info">
                <a class="navbar-brand" href="/">Schedule App</a>
                
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="nav-bar">
                    <ul class="navbar-nav mr-auto"></ul>
                    <ul class="navbar-nav">
                        @if(Auth::check())
                        <li class="navbar-text text-success bg-white p-2 mr-5">{{ Auth::user()->name }}</li>
                        <li><a href="/customers/create" class="nav-link">顧客登録</a></li>
                        <li><a href="/customers" class="nav-link">顧客一覧</a></li>
                        <li><a href="/favorites" class="nav-link">お気に入り</a></li>
                        <li><a href="/del_customers" class="nav-link">削除顧客</a></li>
                        <li>{!! link_to_route('flags.create', '表示設定', [], ['class' => 'nav-link']) !!}</li>
                        <li><a href="/logout" class="nav-link">ログアウト</a></li>
                        @endif
                    </ul>
                </div>
            </nav>
        </header>
        
        <div class="container">
            @include('commons.flash_message')
            @include('commons.error_messages')
            @yield('content')
        </div>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.js"></script>
        <script src="{{ asset('js/script.js') }}"></script>
    </body>
</html>