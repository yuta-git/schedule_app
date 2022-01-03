@extends('layouts.app')
@section('title', '新規記録作成')
@section('content')

    {!! Form::open(['route' => ['records.update', 'id'=>$record->id], 'method'=>'PUT']) !!}
    <!-- ヘッダー -->
    <header class="header">
      <div class="header__inner">
        <div class="header__cog js-main-nav">
        </div>
        <div class="header__cog js-main-nav">
          <span class="header__month">履歴•予定情報入力</span>
        </div>
        {!! Form::submit('更新', ['class' => 'before-icon-btn before-icon-btn--download']) !!}
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
      {!! Form::date('start', substr($record->start, 0, 10) ? substr($record->start, 0, 10) : old('start'), ['class' => 'form__input']) !!}
    </div>
    <div class="form__item">
      {!! Form::label('end', '終了日にち', ['class'=>'form__label']) !!}
      {!! Form::date('end', substr($record->end, 0, 10) ? substr($record->end, 0, 10) : old('end'), ['class' => 'form__input']) !!}
    </div>
    <div class="form__item">
      {!! Form::label('start_time', '開始時間', ['class'=>'form__label']) !!}
      {!! Form::time('start_time', substr($record->start, 11, 8) ? substr($record->start, 11, 8) : old('start_time'), ['class' => 'form__input']) !!}
    </div>
    <div class="form__item">
      {!! Form::label('end_time', '終了時間', ['class'=>'form__label']) !!}
      {!! Form::time('end_time', substr($record->end, 11, 8) ? substr($record->end, 11, 8) : old('end_time'), ['class' => 'form__input']) !!}
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
    
    {{-- 記録削除フォーム --}}
    <div class="row mt-4">
        <div class="offset-sm-4 col-sm-4 row">
            {!! Form::model($record, ['route' => ['records.destroy', $record->id], 'method' => 'delete', 'class' => 'col-sm-12']) !!}
            {!! Form::submit('削除', ['class' => 'btn btn-danger col-sm-12']) !!}
            {!! Form::close() !!}
        </div>
    </div>

    <div class="l-section__bottom">

    </div>
    <div class="l-section__footer-padding-bottom">

    </div>

  </form>
@endsection