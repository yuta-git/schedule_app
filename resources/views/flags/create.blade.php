@extends('layouts.app')
@section('title', '顧客情報表示設定')
@section('content')
    <!--<div class="text-center">-->
    <!--    <h1>顧客情報表示設定</h1>-->
    <!--</div>-->
{!! Form::open(['route' => ['flags.store']]) !!}
<input type="hidden" name="id" value="{{ $flag->id }}">
<header class="header">
  <div class="header__inner">
    <div class="header__cog js-main-nav">
      <!--＜ 設定　-->
    </div>
    <div class="header__title">
      顧客プロフィールの表示項目設定
    </div>
    <div class="header__create">
      {!! Form::submit('登録', ['class' => 'btn-create']) !!}
    </div>
  </div>
</header>
<ul class="p-function">
  
  <!--<li class="p-function__item flex-box">-->
  <!--  <div class="p-function__title">-->
  <!--    年齢-->
  <!--  </div>-->
  <!--  <span class="p-function__check js-p-function__check">-->
  <!--    <i class="fas fa-check"></i>-->
  <!--  </span>-->
  <!--</li>-->
  
  <li class="p-function__item flex-box">
    <div class="p-function__title">
      年齢
    </div>
    <span class="p-function__check js-p-function__check">
      {!! Form::label('show', '表示') !!}
      {!! Form::radio('age_flag', 1, $flag->age_flag === 1 ? true : false, ['id'=>'show']) !!}
      {!! Form::label('hidden', '非表示') !!}
      {!! Form::radio('age_flag', 0, $flag->age_flag === 0 ? true : false, ['id'=>'hidden']) !!}
    </span>
  </li>
  
  <li class="p-function__item flex-box">
    <div class="p-function__title">
      誕生日
    </div>
    <span class="p-function__check js-p-function__check">
      {!! Form::label('show', '表示') !!}
      {!! Form::radio('birthday_flag', 1, $flag->birthday_flag === 1 ? true : false, ['id'=>'show']) !!}
      {!! Form::label('hidden', '非表示') !!}
      {!! Form::radio('birthday_flag', 0, $flag->birthday_flag === 0 ? true : false, ['id'=>'hidden']) !!}
    </span>
  </li>
  
  <li class="p-function__item flex-box">
    <div class="p-function__title">
      住所
    </div>
    <span class="p-function__check js-p-function__check">
      {!! Form::label('show', '表示') !!}
      {!! Form::radio('address_flag', 1, $flag->address_flag === 1 ? true : false, ['id'=>'show']) !!}
      {!! Form::label('hidden', '非表示') !!}
      {!! Form::radio('address_flag', 0, $flag->address_flag === 0 ? true : false, ['id'=>'hidden']) !!}
    </span>
  </li>
  
  <li class="p-function__item flex-box">
    <div class="p-function__title">
      出身地
    </div>
    <span class="p-function__check js-p-function__check">
      {!! Form::label('show', '表示') !!}
      {!! Form::radio('hometown_flag', 1, $flag->hometown_flag === 1 ? true : false, ['id'=>'show']) !!}
      {!! Form::label('hidden', '非表示') !!}
      {!! Form::radio('hometown_flag', 0, $flag->hometown_flag === 0 ? true : false, ['id'=>'hidden']) !!}
    </span>
  </li>
  
  <li class="p-function__item flex-box">
    <div class="p-function__title">
      特徴
    </div>
    <span class="p-function__check js-p-function__check">
      {!! Form::label('show', '表示') !!}
      {!! Form::radio('charactor_flag', 1, $flag->charactor_flag  === 1 ? true : false, ['id'=>'show']) !!}
      {!! Form::label('hidden', '非表示') !!}
      {!! Form::radio('charactor_flag', 0, $flag->charactor_flag  === 0 ? true : false, ['id'=>'hidden']) !!}
    </span>
  </li>
  
  <li class="p-function__item flex-box">
    <div class="p-function__title">
      血液型
    </div>
    <span class="p-function__check js-p-function__check">
      {!! Form::label('show', '表示') !!}
      {!! Form::radio('blood_type_flag', 1, $flag->blood_type_flag === 1 ? true : false, ['id'=>'show']) !!}
      {!! Form::label('hidden', '非表示') !!}
      {!! Form::radio('blood_type_flag', 0, $flag->blood_type_flag === 0 ? true : false, ['id'=>'hidden']) !!}
    </span>
  </li>
  
  <li class="p-function__item flex-box">
    <div class="p-function__title">
      職業
    </div>
    <span class="p-function__check js-p-function__check">
      {!! Form::label('show', '表示') !!}
      {!! Form::radio('occupancy_flag', 1, $flag->occupancy_flag === 1 ? true : false, ['id'=>'show']) !!}
      {!! Form::label('hidden', '非表示') !!}
      {!! Form::radio('occupancy_flag', 0, $flag->occupancy_flag === 0 ? true : false, ['id'=>'hidden']) !!}
    </span>
  </li>
  
  <li class="p-function__item flex-box">
    <div class="p-function__title">
      趣味
    </div>
    <span class="p-function__check js-p-function__check">
      {!! Form::label('show', '表示') !!}
      {!! Form::radio('hobby_flag', 1, $flag->hobby_flag === 1 ? true : false, ['id'=>'show']) !!}
      {!! Form::label('hidden', '非表示') !!}
      {!! Form::radio('hobby_flag', 0, $flag->hobby_flag === 0 ? true : false, ['id'=>'hidden']) !!}
    </span>
  </li>
  
  <li class="p-function__item flex-box">
    <div class="p-function__title">
      特技
    </div>
    <span class="p-function__check js-p-function__check">
      {!! Form::label('show', '表示') !!}
      {!! Form::radio('skill_flag', 1, $flag->skill_flag === 1 ? true : false, ['id'=>'show']) !!}
      {!! Form::label('hidden', '非表示') !!}
      {!! Form::radio('skill_flag', 0, $flag->skill_flag === 0 ? true : false, ['id'=>'hidden']) !!}
    </span>
  </li>
  
  <li class="p-function__item flex-box">
    <div class="p-function__title">
      休日
    </div>
    <span class="p-function__check js-p-function__check">
      {!! Form::label('show', '表示') !!}
      {!! Form::radio('dayoff_flag', 1, $flag->dayoff_flag === 1 ? true : false, ['id'=>'show']) !!}
      {!! Form::label('hidden', '非表示') !!}
      {!! Form::radio('dayoff_flag', 0, $flag->dayoff_flag === 0 ? true : false, ['id'=>'hidden']) !!}
    </span>
  </li>
  
  <li class="p-function__item flex-box">
    <div class="p-function__title">
      好きな食べ物
    </div>
    <span class="p-function__check js-p-function__check">
      {!! Form::label('show', '表示') !!}
      {!! Form::radio('favorite_food_flag', 1, $flag->favorite_food_flag === 1 ? true : false, ['id'=>'show']) !!}
      {!! Form::label('hidden', '非表示') !!}
      {!! Form::radio('favorite_food_flag', 0, $flag->favorite_food_flag === 0 ? true : false, ['id'=>'hidden']) !!}
    </span>
  </li>
  
  <li class="p-function__item flex-box">
    <div class="p-function__title">
      嫌いな食べ物
    </div>
    <span class="p-function__check js-p-function__check">
      {!! Form::label('show', '表示') !!}
      {!! Form::radio('dislike_food_flag', 1, $flag->dislike_food_flag === 1 ? true : false, ['id'=>'show']) !!}
      {!! Form::label('hidden', '非表示') !!}
      {!! Form::radio('dislike_food_flag', 0, $flag->dislike_food_flag === 0 ? true : false, ['id'=>'hidden']) !!}
    </span>
  </li>
  
  <li class="p-function__item flex-box">
    <div class="p-function__title">
      結婚
    </div>
    <span class="p-function__check js-p-function__check">
      {!! Form::label('show', '表示') !!}
      {!! Form::radio('marriage_flag', 1, $flag->marriage_flag === 1 ? true : false, ['id'=>'show']) !!}
      {!! Form::label('hidden', '非表示') !!}
      {!! Form::radio('marriage_flag', 0, $flag->marriage_flag === 0 ? true : false, ['id'=>'hidden']) !!}
    </span>
  </li>
  
  <li class="p-function__item flex-box">
    <div class="p-function__title">
      子供
    </div>
    <span class="p-function__check js-p-function__check">
      {!! Form::label('show', '表示') !!}
      {!! Form::radio('children_flag', 1, $flag->children_flag === 1 ? true : false, ['id'=>'show']) !!}
      {!! Form::label('hidden', '非表示') !!}
      {!! Form::radio('children_flag', 0, $flag->children_flag === 0 ? true : false, ['id'=>'hidden']) !!}
    </span>
  </li>
  
  <li class="p-function__item flex-box">
    <div class="p-function__title">
      恋人
    </div>
    <span class="p-function__check js-p-function__check">
      {!! Form::label('show', '表示') !!}
      {!! Form::radio('lover_flag', 1, $flag->lover_flag === 1 ? true : false, ['id'=>'show']) !!}
      {!! Form::label('hidden', '非表示') !!}
      {!! Form::radio('lover_flag', 0, $flag->lover_flag === 0 ? true : false, ['id'=>'hidden']) !!}
    </span>
  </li>
  
  <li class="p-function__item flex-box">
    <div class="p-function__title">
      メールアドレス
    </div>
    <span class="p-function__check js-p-function__check">
      {!! Form::label('show', '表示') !!}
      {!! Form::radio('mail_flag', 1, $flag->mail_flag === 1 ? true : false, ['id'=>'show']) !!}
      {!! Form::label('hidden', '非表示') !!}
      {!! Form::radio('mail_flag', 0, $flag->mail_flag === 0 ? true : false, ['id'=>'hidden']) !!}
    </span>
  </li>
  
  <li class="p-function__item flex-box">
    <div class="p-function__title">
      電話番号
    </div>
    <span class="p-function__check js-p-function__check">
      {!! Form::label('show', '表示') !!}
      {!! Form::radio('telphone_flag', 1, $flag->telphone_flag === 1 ? true : false, ['id'=>'show']) !!}
      {!! Form::label('hidden', '非表示') !!}
      {!! Form::radio('telphone_flag', 0, $flag->telphone_flag === 0 ? true : false, ['id'=>'hidden']) !!}
    </span>
  </li>
  
  <li class="p-function__item flex-box">
    <div class="p-function__title">
      会社名
    </div>
    <span class="p-function__check js-p-function__check">
      {!! Form::label('show', '表示') !!}
      {!! Form::radio('company_name_flag', 1, $flag->company_name_flag === 1 ? true : false, ['id'=>'show']) !!}
      {!! Form::label('hidden', '非表示') !!}
      {!! Form::radio('company_name_flag', 0, $flag->company_name_flag === 0 ? true : false, ['id'=>'hidden']) !!}
    </span>
  </li>
  
  <li class="p-function__item flex-box">
    <div class="p-function__title">
      メモ
    </div>
    <span class="p-function__check js-p-function__check">
      {!! Form::label('show', '表示') !!}
      {!! Form::radio('memo_flag', 1, $flag->memo_flag === 1 ? true : false, ['id'=>'show']) !!}
      {!! Form::label('hidden', '非表示') !!}
      {!! Form::radio('memo_flag', 0, $flag->memo_flag === 0 ? true : false, ['id'=>'hidden']) !!}
    </span>
  </li>

</ul>

{!! Form::close() !!}
@endsection