@extends('layouts.app')
@section('title', 'Contact You')
@section('content')
    <div class="row">
        <p>{{ Auth::user()->name }}さん、ようこそ！</p>
        <a href="/logout" class="offset-sm-1 col-sm-4 btn btn-danger">ログアウト</a> 
    </div>
@endsection