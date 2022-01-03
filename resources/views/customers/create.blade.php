@extends('layouts.app')
@section('title', '新規顧客作成')
@section('content')
            <form action="/customers" method="POST" class="form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <!-- ヘッダー -->
                <header class="header">
                    <div class="header__inner">
                        <div class="header__cog js-main-nav">
                            <div>新規顧客作成</div>
                        </div>
                        <div class="header__create">
                            <!--<a href="./index.html">保存</a>-->
                            <button type="submit" class="btn-create">顧客情報保存</button>
                        </div>
                    </div>
                </header>
                <!-- ヘッダー終わり -->
                <div class="c-title-lavel">
                    <div class="c-title-lavel__inner flex-box">
                        <span class="c-title-lavel__title">基本プロフィール</span>
                    </div>
                </div>
                <div class="basic-profile">
                    <div class="basic-profile__inner">
                        <div class="create-profile__img">
                            <label for="your_thumbnail" class="create-profile__label">サムネイル画像<br>タップして設定</label>
                            <input type="file" accept="image/*" name="thumbnail"  class="thumbnail-input" id="your_thumbnail" onchange="previewImage(this)">
                            <img id="preview" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" style="max-width:150px;" alt="">
                        </div>
                        <div class="basic-profile__body">
                            <div class="form__item">
                                <label for="your_name" class="form__label">名前</label>
                                <input name="name" value="" id="your_name" type="text" class="form__input" placeholder="タップして入力">
                            </div>
                            <div class="form__item">
                                <label for="your_kana" class="form__label">ふりがな</label>
                                <input name="kana_name" value="" id="your_kana" type="text" class="form__input" placeholder="タップして入力">
                            </div>
                            <div class="form__item">
                                <label for="your_gender" class="form__label">性別</label>
                                <select name="gender" class="form__gender">
                                    <option value="man">男性</option>
                                    <option value="woman">女性</option>
                                    <option value="unknown">不明</option>
                                </select>
                                <!--女性: <input type="radio" name="gender" value="woman">-->
                                <!--不明: <input type="radio" name="gender" value="unknown">-->
                            </div>
    
                        </div>
                        <!-- /.basic-profile__body -->
                    </div>
                </div>
                <!-- /.basic-profile -->
                <div class="c-title-lavel">
                    <div class="c-title-lavel__inner">
                        <label for="comment" class="c-title-lavel__title">メモ</label>
                    </div>
                </div>
                <textarea class="form__textarea" id="comment" name="memo" placeholder="ここには自由にコメントを記入してください"></textarea>
                <div class="c-title-lavel">
                    <div class="c-title-lavel__inner">
                        <p>※プロフィール項目は設定の「顧客管理設定」より編集可能です</p>
                        <label for="comment" class="c-title-lavel__title">基本プロフィール</label>
                    </div>
                </div>
                <!-- 基本プロフィール -->
                <div class="form__item">
                    <label for="your_age" class="form__label">年齢</label>
                    <input name="age" value="" id="your_age" type="text" class="form__input" placeholder="タップして入力">
                </div>
                <div class="form__item">
                    <label for="your_birthday" class="form__label">誕生日</label>
                    <input name="birthday" value="" id="your_birthday" type="date" class="form__input" placeholder="タップして入力">
                </div>
                <div class="form__item">
                    <label for="your_address" class="form__label">現在の住居地</label>
                    <input name="address" value="" id="your_address" type="text" class="form__input" placeholder="タップして入力">
                </div>
                <div class="form__item">
                    <label for="your_hometown" class="form__label">出身地</label>
                    <input name="hometown" value="" id="your_hometown" type="text" class="form__input" placeholder="タップして入力">
                </div>
                <div class="form__item">
                    <label for="your_feature" class="form__label">特徴</label>
                    <input name="feature" value="" id="your_feature" type="text" class="form__input" placeholder="タップして入力">
                </div>
                <div class="form__item">
                    <label for="your_blood_type" class="form__label">血液型</label>
                    <select name="blood_type" id="your_blood_type" class="form__blood-type">
                        <option value="A">A型</option>
                        <option value="B">B型</option>
                        <option value="O">O型</option>
                        <option value="AB">AB型</option>
                        <option value="unknown">不明</option>
                    </select>
                </div>
                <div class="form__item">
                    <label for="your_job" class="form__label">職業</label>
                    <input name="job" value="" id="your_job" type="text" class="form__input" placeholder="タップして入力">
                </div>
                <!-- 趣味・嗜好 -->
                <div class="c-title-lavel">
                    <div class="c-title-lavel__inner">
                        <label for="comment" class="c-title-lavel__title">趣味・嗜好</label>
                    </div>
                </div>
                <div class="form__item">
                    <label for="your_hobby" class="form__label">趣味</label>
                    <input name="hobby" value="" id="your_hobby" type="text" class="form__input" placeholder="タップして入力">
                </div>
                <div class="form__item">
                    <label for="your_skill" class="form__label">特技</label>
                    <input name="skill" value="" id="your_skill" type="text" class="form__input" placeholder="タップして入力">
                </div>
                <div class="form__item">
                    <label for="your_dayoff" class="form__label">休日</label>
                    <input name="dayoff" value="" id="your_dayoff" type="text" class="form__input" placeholder="タップして入力">
                </div>
                <div class="form__item">
                    <label for="your_favorite_food" class="form__label">好きな食べ物</label>
                    <input name="favorite_food" value="" id="your_favorite_food" type="text" class="form__input" placeholder="タップして入力">
                </div>
                <div class="form__item">
                    <label for="your_dislike_food" class="form__label">嫌いな食べ物</label>
                    <input name="dislike_food" value="" id="your_dislike_food" type="text" class="form__input" placeholder="タップして入力">
                </div>
                <!-- 結婚・恋人-->
                <div class="c-title-lavel">
                    <div class="c-title-lavel__inner">
                        <label for="comment" class="c-title-lavel__title">結婚・恋人</label>
                    </div>
                </div>
                <div class="form__item">
                    <label for="your_marriage" class="form__label">結婚</label>
                    <input name="marriage" value="" id="your_marriage" type="text" class="form__input" placeholder="タップして入力">
                </div>
                <div class="form__item">
                    <label for="your_children" class="form__label">子供</label>
                    <input name="children" value="" id="your_children" type="text" class="form__input" placeholder="タップして入力">
                </div>
                <div class="form__item">
                    <label for="your_lover" class="form__label">恋人</label>
                    <input name="lover" value="" id="your_lover" type="text" class="form__input" placeholder="タップして入力">
                </div>
                <!-- 連絡先　-->
                <div class="c-title-lavel">
                    <div class="c-title-lavel__inner">
                        <label for="comment" class="c-title-lavel__title">連絡先</label>
                    </div>
                </div>
                <div class="form__item">
                    <label for="your_email" class="form__label">メールアドレス</label>
                    <input name="email" value="" id="your_email" type="text" class="form__input" placeholder="タップして入力">
                </div>
                <div class="form__item">
                    <label for="your_telephone" class="form__label">電話番号</label>
                    <input name="telephone" value="" id="your_telephone" type="text" class="form__input" placeholder="タップして入力">
                </div>
                <div class="form__item">
                    <label for="your_company_name" class="form__label">会社名</label>
                    <input name="company_name" value="" id="your_company_name" type="text" class="form__input" placeholder="タップして入力">
                </div>
                <div class="l-section__bottom"></div>
                <div class="l-section__footer-padding-bottom"></div>

            </form>
@endsection