@extends('layouts.app')
@section('title', '新規会員登録')
@section('content')

            <!-- ヘッダー -->
            <header class="header-login">
                <div class="header-login__inner">
                    <div class="header-login__text">新規会員登録</div>
                </div>
            </header>
            <!-- ヘッダー終わり -->
            <section class="login">
                <div class="login__inner">
                    <!--<h1 class="login__title">App Title</h1>-->
                    <form method="POST" action="/signup" class="login__form form-normal">
                        {{ csrf_field() }}
                        <div class="form-normal__inner">
                            <div class="form-normal__item">
                                <input type="text" name="name" class="form-normal__input" placeholder="名前">
                            </div>
                            <div class="form-normal__item">
                                <input type="email" name="email" class="form-normal__input" placeholder="メールアドレス">
                            </div>
                            <div class="form-normal__item">
                                <input type="password" name="password" class="form-normal__input" placeholder="パスワード">
                            </div>
                            <div class="form-normal__item">
                                <input type="password" name="password_confirmation" class="form-normal__input" placeholder="パスワード（確認用）">
                            </div>
                            <!-- 会員登録ボタン -->
                            <div class="login__btn">
                                <button type="submit" class="c-btn c-btn--lightpink">新規会員登録する</button>
                            </div>
                        </div>
                        <!-- /.form-normal__inner -->
                    </form>
                    <!-- /.login__form .form-normal -->
                </div>
                <!-- /.login__inner -->
            </section>
            <!-- /.login -->
    
@endsection