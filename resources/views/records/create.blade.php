@extends('layouts.app')
@section('title', '新規記録作成')
@section('content')

    {!! Form::open(['route' => ['records.store']]) !!}
    <input type="hidden" name="customer_id" value="{{ $customer_id }}">
    <!-- ヘッダー -->
    <header class="header">
      <div class="header__inner">
        <div class="header__cog js-main-nav">
          <a href="./calender.html"><i class="fas fa-times"></i></a>
        </div>
        <div class="header__cog js-main-nav">
          <span class="header__month">履歴•予定情報入力</span>
        </div>
        {!! Form::submit('新規記録作成', ['class' => 'before-icon-btn before-icon-btn--download']) !!}
      </div>
    </header>
    <!-- ヘッダー終わり -->

    <!-- 履歴・予定情報 -->
    <div class="c-title-lavel">
      <div class="c-title-lavel__inner">
        <label for="comment" class="c-title-lavel__title"></label>
      </div>
    </div>  
    
    <div class="form__item">
      <label class="form__label">名前</label>
      <!-- <input name="your_name" value="" id="your_name" type="text" class="form__input" placeholder="タップして入力"> -->
      <div class="form__select">
        <p class="form__option">{{$customer->name}}</p>
      </div>
    </div>
    
    <div class="form__item">
      {!! Form::label('start', '開始日にち', ['class'=>'form__label']) !!}
      {!! Form::date('start', $record->start ? $record->start : old('start'), ['class' => 'form__input']) !!}
    </div>
    <div class="form__item">
      {!! Form::label('end', '開始日にち', ['class'=>'form__label']) !!}
      {!! Form::date('end', $record->end ? $record->end : old('end'), ['class' => 'form__input']) !!}
    </div>
    <div class="form__item">
      {!! Form::label('start_time', '開始時間', ['class'=>'form__label']) !!}
      {!! Form::time('start_time', $record->start_time ? $record->start_time : old('start_time'), ['class' => 'form__input']) !!}
    </div>
    <div class="form__item">
      {!! Form::label('end_time', '終了時間', ['class'=>'form__label']) !!}
      {!! Form::time('end_time', $record->end_time ? $record->end_time : old('end_time'), ['class' => 'form__input']) !!}
    </div>
    
    <div class="form__item">
      {!! Form::label('color', '色', ['class'=>'form__label']) !!}
      {!! Form::color('color', $record->color ? $record->color : old('color'), []) !!}
    </div>

    <div class="c-title-lavel">
      <div class="c-title-lavel__inner">
      {!! Form::label('title', 'メモ', ['class' => 'c-title-lavel__title']) !!}
      </div>
    </div>
    {!! Form::text('title', $record->title ? $record->title : old('title'), ['class' => 'form__textarea','placeholder' => 'メモを入力してください']) !!}
    {!! Form::close() !!}

    <div class="l-section__bottom">

    </div>
    <div class="l-section__footer-padding-bottom">

    </div>

  </form>
@endsection