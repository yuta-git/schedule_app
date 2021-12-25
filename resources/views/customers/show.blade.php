@extends('layouts.app')
@section('title', $customer->name . 'さんの記録')
@section('content')
            <form action="/customers/{{ $customer->id }}" method="POST" class="form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                <!-- ヘッダー -->
                <header class="header">
                    <div class="header__inner">
                        <div class="header__cog js-main-nav">
                            <span>{{$customer->name}}さんの詳細画面</span>
                        </div>
                        <div class="header__create">
                            <button type="submit" class="btn-create">顧客情報更新</a>
                        </div>
                    </div>
                </header>
                <!-- ヘッダー終わり -->
                <div class="c-title-lavel">
                    <div class="c-title-lavel__inner flex-box">
                        <span class="c-title-lavel__title">基本プロフィール</span>
                        <!--{!! link_to_route('records.create', '記録新規作成' , ['customer_id' => $customer->id ],['class' => 'before-icon-btn before-icon-btn--download']) !!}-->
                    </div>
                </div>
                <div class="basic-profile">
                    <div class="basic-profile__inner">
                        <figure class="basic-profile__img">
                            @if($customer->thumbnail !== '')
                                <img src="{{ Storage::disk('s3')->url('uploads/' . $customer->thumbnail) }}" alt="{{ $customer->thumbnail }}">
                                @else
                                <img src="{{ asset('images/no_image.jpg' )}}" alt="">
                            @endif
                        </figure>
                        <div class="basic-profile__body">
                            <div class="form__item">
                                <label for="your_name" class="form__label">名前</label>
                                <input name="name" value="{{ $customer->name }}" id="your_name" type="text" class="form__input" placeholder="タップして入力">
                            </div>
                            <div class="form__item">
                                <label for="your_kana" class="form__label">ふりがな</label>
                                <input name="kana_name" value="{{ $customer->kana_name }}" id="your_kana" type="text" class="form__input" placeholder="タップして入力">
                            </div>
                            <div class="form__item">
                                <label for="your_gender" class="form__label">性別</label>
                                <select name="gender" id="your_gender">
                                    <option value="man" {{ $customer->gender === 'man' ? 'selected' : ''}}>男性</option>
                                    <option value="woman" {{ $customer->gender === 'woman' ? 'selected' : ''}}>女性</option>
                                    <option value="unknown" {{ $customer->gender === 'unknown' ? 'selected' : ''}}>不明</option>
                                </select>
                            </div>
                        </div><!-- /.basic-profile__body -->
                    </div><!-- /.basic-profile__inner -->
                </div><!-- /.basic-profile -->
                <!-- メモ -->
                @if($flag->memo_flag === 1)
                <div class="c-title-lavel">
                    <div class="c-title-lavel__inner">
                        <label for="comment" class="c-title-lavel__title">メモ</label>
                    </div>
                </div>
                <textarea class="form__textarea" id="comment" name="memo" placeholder="ここには自由にコメントを記入してください">{{ $customer->memo }}</textarea>
                @endif
                <!-- 基本プロフィール -->
                <div class="c-title-lavel">
                    <div class="c-title-lavel__inner">
                        <p>※プロフィール項目は設定の「顧客管理設定」より編集可能です</p>
                        <label for="comment" class="c-title-lavel__title">基本プロフィール</label>
                    </div>
                </div>
                <div class="form__item">
                    <label for="your_thumbnail" class="form__label">サムネイル画像</label>
                    <input type="file" name="thumbnail" value="" id="your_thumbnail" type="text" class="form__input" placeholder="タップして入力">
                </div>
                @if($flag->age_flag === 1)
                <div class="form__item">
                    <label for="your_age" class="form__label">年齢</label>
                    <input name="age" value="{{ $customer->age }}" id="your_age" type="text" class="form__input" placeholder="タップして入力">
                </div>
                @endif
                @if($flag->birthday_flag === 1)
                <div class="form__item">
                    <label for="your_birthday" class="form__label">誕生日</label>
                    <input name="birthday" value="{{ $customer->birthday }}" id="your_birthday" type="date" class="form__input" placeholder="タップして入力">
                </div>
                @endif
                @if($flag->address_flag  === 1)
                <div class="form__item">
                    <label for="your_address" class="form__label">現在の住居地</label>
                    <input name="address" value="{{ $customer->address }}" id="your_address" type="text" class="form__input" placeholder="タップして入力">
                </div>
                @endif
                @if($flag->hometown_flag === 1)
                <div class="form__item">
                    <label for="your_hometown" class="form__label">出身地</label>
                    <input name="hometown" value="{{ $customer->hometown }}" id="your_hometown" type="text" class="form__input" placeholder="タップして入力">
                </div>
                @endif
                
                @if($flag->charactor_flag === 1)
                <div class="form__item">
                    <label for="your_feature" class="form__label">特徴</label>
                    <input name="feature" value="{{ $customer->feature }}" id="your_feature" type="text" class="form__input" placeholder="タップして入力">
                </div>
                @endif
                @if($flag->blood_type_flag === 1)
                <div class="form__item">
                    <label for="your_blood_type" class="form__label">血液型</label>
                    <select name="blood_type" id="your_blood_type">
                        <option value="A" {{ $customer->blood_type === 'A' ? 'selected' : ''}}>A型</option>
                        <option value="B" {{ $customer->blood_type === 'B' ? 'selected' : ''}}>B型</option>
                        <option value="O" {{ $customer->blood_type === 'O' ? 'selected' : ''}}>O型</option>
                        <option value="AB" {{ $customer->blood_type === 'AB' ? 'selected' : ''}}>AB型</option>
                        <option value="unknown" {{ $customer->blood_type === 'unknown' ? 'selected' : ''}}>不明</option>
                    </select>
                </div>
                @endif
                @if($flag->occupancy_flag === 1)
                <div class="form__item">
                    <label for="your_job" class="form__label">職業</label>
                    <input name="job" value="{{ $customer->job }}" id="your_job" type="text" class="form__input" placeholder="タップして入力">
                </div>
                @endif
                <!-- 趣味・嗜好 -->
                <div class="c-title-lavel">
                    <div class="c-title-lavel__inner">
                        <label for="comment" class="c-title-lavel__title">趣味・嗜好</label>
                    </div>
                </div>
                @if($flag->hobby_flag === 1)
                <div class="form__item">
                    <label for="your_hobby" class="form__label">趣味</label>
                    <input name="hobby" value="{{ $customer->hobby }}" id="your_hobby" type="text" class="form__input" placeholder="タップして入力">
                </div>
                @endif
                @if($flag->skill_flag === 1)
                <div class="form__item">
                    <label for="your_skill" class="form__label">特技</label>
                    <input name="skill" value="{{ $customer->skill }}" id="your_skill" type="text" class="form__input" placeholder="タップして入力">
                </div>
                @endif
                @if($flag->dayoff_flag === 1)
                <div class="form__item">
                    <label for="your_dayoff" class="form__label">休日</label>
                    <input name="dayoff" value="{{ $customer->dayoff }}" id="your_dayoff" type="text" class="form__input" placeholder="タップして入力">
                </div>
                @endif
                @if($flag->favorite_food_flag === 1)
                <div class="form__item">
                    <label for="your_favorite_food" class="form__label">好きな食べ物</label>
                    <input name="favorite_food" value="{{ $customer->favorite_food }}" id="your_favorite_food" type="text" class="form__input" placeholder="タップして入力">
                </div>
                @endif
                @if($flag->dislike_food_flag === 1)
                <div class="form__item">
                    <label for="your_dislike_food" class="form__label">嫌いな食べ物</label>
                    <input name="dislike_food" value="{{ $customer->dislike_food }}" id="your_dislike_food" type="text" class="form__input" placeholder="タップして入力">
                </div>
                @endif
                <!-- 結婚・恋人-->
                <div class="c-title-lavel">
                    <div class="c-title-lavel__inner">
                        <label for="comment" class="c-title-lavel__title">結婚・恋人</label>
                    </div>
                </div>
                @if($flag->marriage_flag === 1)
                <div class="form__item">
                    <label for="your_marriage" class="form__label">結婚</label>
                    <input name="marriage" value="{{ $customer->marriage }}" id="your_marriage" type="text" class="form__input" placeholder="タップして入力">
                </div>
                @endif
                @if($flag->children_flag === 1)
                <div class="form__item">
                    <label for="your_children" class="form__label">子供</label>
                    <input name="children" value="{{ $customer->children }}" id="your_children" type="text" class="form__input" placeholder="タップして入力">
                </div>
                @endif
                @if($flag->lover_flag === 1)
                <div class="form__item">
                    <label for="your_lover" class="form__label">恋人</label>
                    <input name="lover" value="{{ $customer->lover }}" id="your_lover" type="text" class="form__input" placeholder="タップして入力">
                </div>
                @endif
                <!-- 連絡先　-->
                <div class="c-title-lavel">
                    <div class="c-title-lavel__inner">
                        <label for="comment" class="c-title-lavel__title">連絡先</label>
                    </div>
                </div>
                @if($flag->mail_flag === 1)
                <div class="form__item">
                    <label for="your_email" class="form__label">メールアドレス</label>
                    <input name="email" value="{{ $customer->email }}" id="your_email" type="text" class="form__input" placeholder="タップして入力">
                </div>
                @endif
                @if($flag->telphone_flag === 1)
                <div class="form__item">
                    <label for="your_telephone" class="form__label">電話番号</label>
                    <input name="telephone" value="{{ $customer->telephone }}" id="your_telephone" type="text" class="form__input" placeholder="タップして入力">
                </div>
                @endif
                @if($flag->company_name_flag === 1)
                <div class="form__item">
                    <label for="your_company_name" class="form__label">会社名</label>
                    <input name="company_name" value="{{ $customer->company_name }}" id="your_company_name" type="text" class="form__input" placeholder="タップして入力">
                </div>
                @endif
            </form>
                
                <!-- 履歴・予定情報 -->
                <div class="c-title-lavel">
                    <div class="c-title-lavel__inner display-flex-space-between">
                        <label for="comment" class="c-title-lavel__title">履歴•予定情報</label>
                        {!! link_to_route('records.create', '記録新規作成' , ['customer_id' => $customer->id ],['class' => 'before-icon-btn before-icon-btn--download']) !!}
                    </div>
                </div>
                <div class="history-plan">
                    <div class="history-plan__inner">
                        <div class="history-plan__items">
                            @foreach($records as $record)
                            <a href="/records/{{ $record->id }}/edit" class="history-plan__item">
                                <div class="history-plan__left">
                                    <p class="history-plan__title">日時：</p>
                                    <p class="history-plan__date">{{$record->start}} 
                                        <span>{{ substr($record->start_time, 0, 5) }}</span>
                                    </p>
                                </div>
                                
                                <div class="history-plan__right">
                                    <p class="history-plan__title">メモ：</p>
                                    <div class="history-plan__place">{{$record->title}} </div>
                                </div>
                                <!-- /.history-plan__right -->
                            </a><!-- /.history-plan__item -->
                            @endforeach
                        </div><!-- /.history-plan__items -->
                    </div><!-- /.history-plan__inner -->
                </div><!-- /.history-plan -->
            

            <div class="l-section__footer-padding-bottom"></div>
@endsection