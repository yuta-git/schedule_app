<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations; // 追加
use Faker\Factory; // 追加
use App\User; // 追加

class LoginControllerTest extends TestCase
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

    
    /** @test */
    public function ログイン画面のURLにアクセスして画面が表示される()
    {
        // LoginController@showLoginForm にアクセス
        $response = $this->get('/login');
        // 正常に到達できるかチェック
        $response->assertStatus(200);
    }
    
    /** @test */
    public function ログイン画面のURLにアクセスしてログイン画面が表示される()
    {
        // LoginController@showLoginForm にアクセス
        $response = $this->get('/login');
        // resources/views/auth フォルダの中にある login.blade.phpが表示されるかのチェック
        $response->assertViewIs('auth.login');
    }
    
    /** @test */
    public function 登録しておいたemailアドレスとパスワードでログインできる()
    {
        // fakerを使ってダミー情報作成
        $email = $this->faker->unique()->email;
        $password = $this->faker->password;
        
        // factoryを使ってダミーユーザー作成
        // メールアドレス、パスワード以外は勝手に自動生成してくれる
        $user = factory(User::class)->create([
            'email' => $email,
            'password'  => bcrypt($password)
        ]);
        
        // その情報でログイン処理
        $response = $this->post('/login', [
            'email'    => $email,
            'password'  => $password
        ]);
        
        // そのダミーユーザー情報で認証されるかチェック
        $this->assertAuthenticatedAs($user);
    }
    
    /** @test */
    public function ログインに成功した後はトップ画面が表示される()
    {
        // fakerを使ってダミー情報作成
        $email = $this->faker->unique()->email;
        $password = $this->faker->password;
        
        // factoryを使ってダミーユーザー作成
        // メールアドレス、パスワード以外は勝手に自動生成してくれる
        $user = factory(User::class)->create([
            'email' => $email,
            'password'  => bcrypt($password)
        ]);
        
        // その情報でログイン処理
        $response = $this->post('/login', [
            'email'    => $email,
            'password'  => $password
        ]);
        // Top画面にリダイレクトされるかチェック
        $response->assertRedirect('/top');
    }

    /** @test */
    public function 登録したのと違うメールアドレスでログインしようとしてもログインできない()
    {
        // fakerを使ってダミー情報作成
        $email = $this->faker->unique()->email;
        $password = $this->faker->password;
        
        // factoryを使ってダミーユーザー作成
        // メールアドレス、パスワード以外は勝手に自動生成してくれる
        $user = factory(User::class)->create([
            'email' => $email,
            'password'  => bcrypt($password)
        ]);
        
        // 間違った情報でログイン処理
        $response = $this->post('/login', [
            'email'    => $email . 'a',
            'password'  => $password
        ]);
        
        // ユーザーが認証されていないかテスト
        $this->assertGuest();
    }

    /** @test */
    public function 登録したのと違うパスワードでログインしようとしてもログインできない()
    {
        // fakerを使ってダミー情報作成
        $email = $this->faker->unique()->email;
        $password = $this->faker->password;
        
        // factoryを使ってダミーユーザー作成
        // メールアドレス、パスワード以外は勝手に自動生成してくれる
        $user = factory(User::class)->create([
            'email' => $email,
            'password'  => bcrypt($password)
        ]);
        
        // 間違った情報でログイン処理
        $response = $this->post('/login', [
            'email'    => $email,
            'password'  => $password . 'a'
        ]);
        
        // ユーザーが認証されていないかテスト
        $this->assertGuest();
    }
    
    /** @test */
    public function 異なるアドレスでログインしようとするとエラーメッセージが表示される()
    {
        // fakerを使ってダミー情報作成
        $email = $this->faker->unique()->email;
        $password = $this->faker->password;
        
        // factoryを使ってダミーユーザー作成
        // メールアドレス、パスワード以外は勝手に自動生成してくれる
        $user = factory(User::class)->create([
            'email' => $email,
            'password'  => bcrypt($password)
        ]);
        
        // 間違ったメールアドレスでログイン        
        $response = $this->post('/login', [
            'email'    => $email . 'a',
            'password'  => $password
        ]);
        
        // メールアドレスを間違えた際の期待されるvalidationメッセージ
        $errorMessage = '認証に失敗しました';
        // LoginController@showLoginForm にアクセスしてこのエラーメッセージが得られるかチェック
        $this->get('/login')->assertSee($errorMessage);
    }
    
    /** @test */
    public function 異なるパスワードでログインしようとするとエラーメッセージが表示される()
    {
        // fakerを使ってダミー情報作成
        $email = $this->faker->unique()->email;
        $password = $this->faker->password;
        
        // factoryを使ってダミーユーザー作成
        // メールアドレス、パスワード以外は勝手に自動生成してくれる
        $user = factory(User::class)->create([
            'email' => $email,
            'password'  => bcrypt($password)
        ]);
        
        // 異なるパスワードを送ってログイン
        $response = $this->post('/login', [
            'email'    => $email,
            'password'  => $password . 'a'
        ]);
        // パスワードを間違えた際の期待されるvalidationメッセージ
        $errorMessage = '認証に失敗しました';
        // LoginController@showLoginForm にアクセスしてこのエラーメッセージが得られるかチェック
        $this->get('/login')->assertSee($errorMessage);
    }
    
    /** @test */
    public function ログアウトすると認証状態が解除される()
    {
        // factoryを使ってダミーユーザー作成
        $user = factory(User::class)->create();
        // そのユーザーを認証状態にセット
        $this->actingAs($user);
        // そのユーザー情報で認証されるているかチェック
        $this->assertAuthenticatedAs($user);
        // ログアウトリクエストを送る
        $response = $this->get('/logout');
        // ユーザーが認証されていない
        $this->assertGuest();
    }
    
    /** @test */
    public function ログアウトをするとログイン前の画面のリダイレクトする()
    {
        // factoryを使ってダミーユーザー作成
        $user = factory(User::class)->create();
        // そのユーザーを認証状態にセット
        $this->actingAs($user);
        // ログアウトリクエストを送る
        $response = $this->get('/logout');
        // ログアウトした画面にリダイレクトするかチェック
        $response->assertRedirect('/');
    }

}
