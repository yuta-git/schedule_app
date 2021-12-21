@extends('layouts.app')
@section('title', '顧客一覧')
@section('content')
            <!-- ヘッダーはじまり -->
            <header class="header">
                <div class="header__inner">
                    <div class="header__cog js-main-nav">
                        <i class="fas fa-cog"></i>
                    </div>
                    <div class="header__title">顧客一覧({{ count($customers) }}人) </div>
                    <a href="/customers/create" class="header__create">
                        <i class="far fa-plus-square"></i>
                    </a>
                </div>
            </header>
            <!-- ヘッダーの余白 -->
            <!-- <div class="l-section__header-padding-top">
                  
            </div> -->
            <div class="search-form">
                <form id="form1" action="自分のサイトURL">
                    <input id="sbox" name="s" type="text" placeholder="名前で入力してください" />
                    <input id="sbtn" type="submit" value="検索" />
                </form>
            </div>
            @if(count($customers) !== 0)
            <!-- /.search-form -->
            <div class="sort-form">
                <ul class="sort-form__left">
                    <li class="sort-form__all">全て</li>
                    <li class="sort-form__favorite">お気に入り</li>
                </ul>
                <ul class="sort-form__right">
                    <li class="sort-form__select">
                        <i class="fas fa-arrows-alt-v"></i>
                        <span>登録順</span>
                    </li>
                    <li class="sort-form__select active-sort-form">
                        <i class="fas fa-arrows-alt-v"></i>
                        <span class="active-sort">50音順</span>
                    </li>
                </ul>
            </div>
            <!-- /.sort-form -->
            <div class="customer-index">
                <div class="customer-index__inner">
                    <div class="customer-index__items">
                        @foreach($customers as $customer)
                        <div class="customer-index__item">
                            <a href="/customers/{{ $customer->id }}" class="customer-index__left">
                                <figure class="customer-index__img">
                                    @if($customer->thumbnail !== '')
                                    <img src="{{ asset('uploads/' . $customer->thumbnail )}}" alt="">
                                    @else
                                    <img src="{{ asset('images/no_image.jpg' )}}" alt="">
                                    @endif
                                </figure>
                                <p class="customer-index__name">{{ $customer->name }}</p>
                            </a>
                            <!-- /.customer-index__right -->
                            <div class="customer-index__right">
                                <div class="customer-index__favorite">
                                    <i class="fas fa-star js-my-star"></i>
                                </div>
                            </div>
                            <!-- 削除ボタン -->
                            <form action="/customers/{{ $customer->id }}/delete" method="PUT">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="customer_id" value="{{$customer->id}}">
                                  
                                <button type="submit" class="before-icon-btn before-icon-btn--times before-icon-btn--times">削除</button>
                                
                            </form>
                            <!-- /削除ボタン -->
                            
                            <!-- /.customer-index__right -->
                        </div>
                        <!-- /.customer-index__item -->
                        @endforeach
                    </div>
                    <!-- /.customer-index__items -->
                </div>
            </div>
            <!-- /.customer-index -->
            <div class="main-nav">
                <header class="header main-nav__header">
                    <div class="header__inner">
                        <div class="header__cog js-main-nav">
                            <i class="fas fa-times"></i>
                        </div>
                        <div class="header__title">設定 </div>
                        <div class="header__create">
                            <!-- <i class="far fa-plus-square"></i> -->
                        </div>
                    </div>
                </header>
                <div class="main-nav__inner">
                    <ul class="main-nav__items">
                        <li class="main-nav__item">
                            <a href="./function.html" class="main-nav__link">
                                <span>顧客プロフィール設定</span>
                            </a>
                        </li>
                        <li class="main-nav__item">
                            <a href="./login.html" class="main-nav__link">
                                <span>ログアウト</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            @endif
            <!-- /.main-nav -->
            <!-- フッターの余白 -->
            <div class="l-section__header-padding-top"></div>

@endsection