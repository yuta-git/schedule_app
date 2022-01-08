<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations; // 追加
use Faker\Factory; // 追加

class RegisterControllerTest extends TestCase
{
    // 前のテストデータが、それに引き続くテストへ影響をあたえないように、各テストが終了するごとにデータベースを破棄する
    // use DatabaseMigrations; // 追加
    // テストが終わったらテーブルの情報を削除する設定
    use RefreshDatabase;
    
    /**
     * 複数のテストで使用するような値を事前に定義
     *
     * @return void
     */
    public function setUp() :void
    {
        parent::setUp();
        // faker を初期化
        $this->faker = Factory::create('ja_JP');
    }
    
    
    /**
     * ユーザー登録画面のURLにアクセスしてユーザー登録画面が表示されるかテスト
     *
     * @return void
     */
    public function test_ユーザー登録画面のURLにアクセスしてユーザー登録画面が表示される()
    {
        // RegisterController@showRegistrationForm にアクセス
        $response = $this->get('/signup');
        // resources/views/authフォルダのregister.blade.phpが表示されるかチェック
        $response->assertViewIs('auth.register');
    }
    
    /**
     * ユーザー登録に成功した後はトップ画面が表示されるかテスト
     *
     * @return void
     */
    public function test_ユーザー登録に成功した後はトップ画面が表示される()
    {
        // fakerでパスワード作成
        $password = bcrypt($this->faker->password);
        // RegisterController@registerにダミーユーザー情報を引き連れてアクセスする
        $response = $this->post('/signup', [
            'name'     => $this->faker->name,
            'email'     => $this->faker->unique()->email,
            'password' => $password,
            'password_confirmation' => $password
        ]);
        // ユーザー登録後に /top にリダイレクトされているかのチェック
        $response->assertRedirect('/top');
    }
    
    /**
     * ログインしていない場合はログイン後のトップ画面のURLにアクセスするとログイン画面にリダイレクトされるかテスト
     *
     * @return void
     */
    public function test_ログインしていない場合はログイン後のトップ画面のURLにアクセスするとログイン画面にリダイレクトされる()
    {
        $response = $this->get('/top');
        $response->assertRedirect('/login');
    }
    
    /**
     * 名前を入力しないで登録しようとするとエラーメッセージが表示されるかテスト
     *
     * @return void
     */
    public function test_名前を入力しないで登録しようとするとエラーメッセージが表示される()
    {
        // RegisterController@registerにダミーユーザー情報を引き連れてアクセスする
        // ただし名前は未入力
        $response = $this->post('/signup', [
            'name'  => '',
            'email'    => 'test@example.com',
            'password'  => 'password123',
            'password_confirmation' => 'password123'
        ]);
        // 名前が入力されていない場合に表示されるvalidationメッセージの期待値
        $errorMessage = '名前 は必須です';
        // RegisterController@showRegistrationForm にアクセスし期待されるvalidationメッセージが得られるかされるかチェック
        $this->get('/signup')->assertSee($errorMessage);
    }
    
    /**
     * メールアドレスを入力しないで登録しようとするとエラーメッセージが表示されるかテスト
     *
     * @return void
     */
    public function test_メールアドレスを入力しないで登録しようとするとエラーメッセージが表示される()
    {
        // RegisterController@registerにダミーユーザー情報を引き連れてアクセスする
        // ただしメールアドレスは未入力
        $response = $this->post('/signup', [
            'name'  => 'testuser',
            'email'    => '',
            'password'  => 'password123',
            'password_confirmation' => 'password123'
        ]);
        // メールアドレスが入力されていない場合に表示されるvalidationメッセージの期待値
        $errorMessage = 'email は必須です';
        // RegisterController@showRegistrationForm にアクセスし期待されるvalidationメッセージが表示されるかチェック
        $this->get('/signup')->assertSee($errorMessage);
    }
    
    /**
     * パスワードを入力しないで登録しようとするとエラーメッセージが表示されるかテスト
     *
     * @return void
     */
    public function test_パスワードを入力しないで登録しようとするとエラーメッセージが表示される()
    {
        // RegisterController@registerにダミーユーザー情報を引き連れてアクセスする
        // ただしパスワードは未入力
        $response = $this->post('/signup', [
            'name'  => 'testuser',
            'email'    => 'test@example.com',
            'password'  => '',
            'password_confirmation'  => ''
        ]);
        // パスワードが入力されていない場合に表示されるvalidationメッセージの期待値
        $errorMessage = 'password は必須です';
        // RegisterController@showRegistrationForm にアクセスし期待されるvalidationメッセージが表示されるかチェック
        $this->get('/signup')->assertSee($errorMessage);
    }
 
     /**
     * パスワードを5文字未満で登録しようとするとエラーメッセージが表示されるかテスト
     *
     * @return void
     */
    public function test_パスワードを5文字未満で登録しようとするとエラーメッセージが表示される()
    {
        // RegisterController@registerにダミーユーザー情報を引き連れてアクセスする
        // ただしパスワードは5文字未満
        $response = $this->post('/signup', [
            'name'  => 'testuser',
            'email'    => 'test@example.com',
            'password'  => 'a',
            'password_confirmation'  => 'a'
        ]);
        // パスワードが5文字未満の場合に表示されるvalidationメッセージの期待値
        $errorMessage = 'password は 5 文字以上のみ有効です';
        // RegisterController@showRegistrationForm にアクセスし期待されるvalidationメッセージが表示されるかチェック
        $this->get('/signup')->assertSee($errorMessage);
    }
    
    /**
     * 2つのパスワードが違う状態で登録しようとするとエラーメッセージが表示されるかテスト
     *
     * @return void
     */
    public function test_2つのパスワードが違う状態で登録しようとするとエラーメッセージが表示される()
    {
        // RegisterController@registerにダミーユーザー情報を引き連れてアクセスする
        // ただし2つのパスワードが異なる
        $response = $this->post('/signup', [
            'name'  => 'testuser',
            'email'    => 'test@example.com',
            'password'  => 'aaaaa',
            'password_confirmation'  => 'aaaab'
        ]);
        // 2つのパスワードが異なる場合に表示されるvalidationメッセージの期待値
        $errorMessage = 'password を確認用と一致させてください';
        // RegisterController@showRegistrationForm にアクセスし期待されるvalidationメッセージが表示されるかチェック
        $this->get('/signup')->assertSee($errorMessage);
    }
}
