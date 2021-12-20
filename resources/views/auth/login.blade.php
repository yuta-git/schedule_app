@extends('layouts.app')
@section('title', 'ログイン')
@section('content')
            <header class="header-login">
                <div class="header-login__inner">
                    <div class="header-login__text">ログイン</div>
                </div>
            </header>
            <section class="login">
                <div class="login__inner">
                    <form action="/login" method="POST" class="login__form form-normal">
                        {{ csrf_field() }}
                        <div class="form-normal__inner">
                            <div class="form-normal__item">
                                <input type="email" name="email" class="form-normal__input" placeholder="メールアドレス">
                            </div>
                            <div class="form-normal__item">
                                <input type="text" name="password" class="form-normal__input" placeholder="パスワード">
                            </div>
                            <!-- ログインボタン -->
                            <div class="form-normal__item form-normal__item--submit">
                                <input type="submit" class="form-normal__input form-normal__input--submit" value="ログイン">
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