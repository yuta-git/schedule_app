@extends('layouts.app')
@section('title', 'Schedule App')
@section('content')
    <div class="row mt-3 mb-3">
        <h1 class="col-sm-12 text-center">スケジュールアプリへようこそ！</h1>
    </div>
    <div class="row">
        <a href="/signup" class="offset-sm-1 col-sm-4 btn btn-primary">新規会員登録</a>
        <a href="/login" class="offset-sm-1 col-sm-4 btn btn-danger">ログイン</a>
    </div>
@endsection