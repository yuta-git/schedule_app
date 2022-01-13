<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations; // 追加
use App\Customer; // 追加
use App\User; // 追加
use Faker\Factory; // 追加

class CustomerControllerTest extends TestCase
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
    public function 顧客一覧画面表示()
    {  
        // 新規ダミーユーザー作成
        $user = factory(User::class)->create();
        // そのユーザーでログインしたとみなす
        $this->actingAs($user);
        // CustomersController@indexにアクセス
        $response = $this->get('/customers');
        // 成功か
        $response->assertStatus(200);
        // customers/index.blade.phpが表示されるか
        $response->assertViewIs('customers.index');
    }
    
    /** @test */
    public function ログインしていない状態で顧客一覧画面のURLにアクセスするとログイン画面にリダイレクトされる()
    {
        $response = $this->get('/customers');
        $response->assertRedirect('/login');
    }
    
    /** @test */
    public function 新規顧客登録画面表示()
    {  
        // 新規ダミーユーザー作成
        $user = factory(User::class)->create();
        // そのユーザーでログインしたとみなす
        $this->actingAs($user);
        // CustomersController@createにアクセス
        $response = $this->get('/customers/create');
        // 成功か
        $response->assertStatus(200);
        // customers/create.blade.phpが表示されるか
        $response->assertViewIs('customers.create');
    }
    
    /** @test */
    public function ログインしていない状態で顧客登録画面のURLにアクセスするとログイン画面にリダイレクトされる()
    {
        $response = $this->get('/customers/create');
        $response->assertRedirect('/login');
    }
    
    /** @test */
    public function 顧客登録に成功した後は顧客一覧画面が表示される()
    {
        // 新規ダミーユーザー作成
        $user = factory(User::class)->create();
        // そのユーザーでログインしたとみなす
        $this->actingAs($user);
        // ログインしているかチェック
        $this->assertAuthenticated();

        // 以下テスト顧客情報作成
        $genders = array('man', 'woman', 'unknown');
        $gender = $genders[mt_rand(0, 2)];
        
        $last_name = $this->faker->lastKanaName;
        
        if($gender === 'man'){
            $first_name = $this->faker->firstKanaNameMale;
        }else if($gender === 'woman'){
            $first_name = $this->faker->firstKanaNameFemale;
        }else{
            $first_name = 'ひかる';
        }
        
        $name = $last_name . $first_name;
        
        $data = [
            'name'     => $name,
            'kana_name'     => mb_convert_kana($name, "KVc"),
            'gender' => $gender,
        ];
        
        // CustomersController@storeにアクセス
        $response = $this->post('/customers', $data);
        
        // customersテーブルにデータが1件登録されているかの確認
        $this->assertDatabaseHas('customers', $data);
        
        // 顧客一覧へリダイレクトするか確認
        $response->assertRedirect('/customers');
        
        // リダイレクトでページ遷移してくるのでstatusは302
        $response->assertStatus(302);
    }
    

    
    /** @test */
    public function 顧客登録時に名前を入力しなかった場合()
    {
        // 新規ダミーユーザー作成
        $user = factory(User::class)->create();
        // そのユーザーでログインしたとみなす
        $this->actingAs($user);
        // ログインしているかチェック
        $this->assertAuthenticated();

        // 以下テスト顧客情報作成
        $genders = array('man', 'woman', 'unknown');
        $gender = $genders[mt_rand(0, 2)];
        
        $last_name = $this->faker->lastKanaName;
        
        if($gender === 'man'){
            $first_name = $this->faker->firstKanaNameMale;
        }else if($gender === 'woman'){
            $first_name = $this->faker->firstKanaNameFemale;
        }else{
            $first_name = 'ひかる';
        }
        
        $name = $last_name . $first_name;
        
        $data = [
            'name'     => '',
            'kana_name'     => mb_convert_kana($name, "KVc"),
            'gender' => $gender,
        ];
        
        // CustomersController@storeにアクセス
        $response = $this->post('/customers', $data);
        
        // 名前が入力されていない場合に表示されるvalidationメッセージの期待値
        $errorMessage = '名前 は必須です';
        // CustomersController@create にアクセスし期待されるvalidationメッセージが得られるかされるかチェック
        $this->get('/customers/create')->assertSee($errorMessage);
    }
    
    /** @test */
    public function 顧客登時にかな名を入力しなかった場合()
    {
        // 新規ダミーユーザー作成
        $user = factory(User::class)->create();
        // そのユーザーでログインしたとみなす
        $this->actingAs($user);
        // ログインしているかチェック
        $this->assertAuthenticated();

        // 以下テスト顧客情報作成
        $genders = array('man', 'woman', 'unknown');
        $gender = $genders[mt_rand(0, 2)];
        
        $last_name = $this->faker->lastKanaName;
        
        if($gender === 'man'){
            $first_name = $this->faker->firstKanaNameMale;
        }else if($gender === 'woman'){
            $first_name = $this->faker->firstKanaNameFemale;
        }else{
            $first_name = 'ひかる';
        }
        
        $name = $last_name . $first_name;
        
        $data = [
            'name'     => $name,
            'kana_name'     => '',
            'gender' => $gender,
        ];
        
        // CustomersController@storeにアクセス
        $response = $this->post('/customers', $data);
        
        // かな名が入力されていない場合に表示されるvalidationメッセージの期待値
        $errorMessage = 'ふりがな は必須です';
        // CustomersController@create にアクセスし期待されるvalidationメッセージが得られるかされるかチェック
        $this->get('/customers/create')->assertSee($errorMessage);
    }
    
    /** @test */
    public function 顧客登時にかな名の書式を正しく入力しなかった場合()
    {
        // 新規ダミーユーザー作成
        $user = factory(User::class)->create();
        // そのユーザーでログインしたとみなす
        $this->actingAs($user);
        // ログインしているかチェック
        $this->assertAuthenticated();

        // 以下テスト顧客情報作成
        $genders = array('man', 'woman', 'unknown');
        $gender = $genders[mt_rand(0, 2)];
        
        $last_name = $this->faker->lastKanaName;
        
        if($gender === 'man'){
            $first_name = $this->faker->firstKanaNameMale;
        }else if($gender === 'woman'){
            $first_name = $this->faker->firstKanaNameFemale;
        }else{
            $first_name = 'ひかる';
        }
        
        $name = $last_name . $first_name;
        
        $data = [
            'name'     => $name,
            'kana_name'     => $name,
            'gender' => $gender,
        ];
        
        // CustomersController@storeにアクセス
        $response = $this->post('/customers', $data);
        
        // かな名の書式を守らなかった場合に表示されるvalidationメッセージの期待値
        $errorMessage = 'ふりがな 無効な値です';
        // CustomersController@create にアクセスし期待されるvalidationメッセージが得られるかされるかチェック
        $this->get('/customers/create')->assertSee($errorMessage);
    }
    
    /** @test */
    public function 顧客の詳細画面表示()
    {
        // 新規ダミーユーザー作成
        $user = factory(User::class)->create();
        // そのユーザーでログインしたとみなす
        $this->actingAs($user);
        // ログインしているかチェック
        $this->assertAuthenticated();

        // 以下テスト顧客情報作成
        $genders = array('man', 'woman', 'unknown');
        $gender = $genders[mt_rand(0, 2)];
        
        $last_name = $this->faker->lastKanaName;
        
        if($gender === 'man'){
            $first_name = $this->faker->firstKanaNameMale;
        }else if($gender === 'woman'){
            $first_name = $this->faker->firstKanaNameFemale;
        }else{
            $first_name = 'ひかる';
        }
        
        $name = $last_name . $first_name;
        
        $data = [
            'name'     => $name,
            'kana_name'     => mb_convert_kana($name, "KVc"),
            'gender' => $gender,
        ];
        
        // CustomersController@storeにアクセス
        $response = $this->post('/customers', $data);
        $response->assertRedirect('/customers');
        // リダイレクトでページ遷移してくるのでstatusは302
        $response->assertStatus(302);
        
        // 登録したばかりの顧客を取得
        $customer = $user->customers()->get()->first();
        
        // CustomersController@showにアクセス
        $response = $this->get('/customers/' . $customer->id);
        // 成功か
        $response->assertStatus(200);
        // customers/show.blade.phpが表示されるか
        $response->assertViewIs('customers.show');

    }
    
    /** @test */
    public function 自分以外のユーザーが作成した顧客の詳細画面表示()
    {
        // 新規ダミーユーザー作成
        $user = factory(User::class)->create();
        // そのユーザーでログインしたとみなす
        $this->actingAs($user);
        // ログインしているかチェック
        $this->assertAuthenticated();

        // 以下テスト顧客情報作成
        $genders = array('man', 'woman', 'unknown');
        $gender = $genders[mt_rand(0, 2)];
        
        $last_name = $this->faker->lastKanaName;
        
        if($gender === 'man'){
            $first_name = $this->faker->firstKanaNameMale;
        }else if($gender === 'woman'){
            $first_name = $this->faker->firstKanaNameFemale;
        }else{
            $first_name = 'ひかる';
        }
        
        $name = $last_name . $first_name;
        
        $data = [
            'name'     => $name,
            'kana_name'     => mb_convert_kana($name, "KVc"),
            'gender' => $gender,
        ];
        
        // CustomersController@storeにアクセス
        $response = $this->post('/customers', $data);
        // 顧客一覧にリダイレクトされたかチェック
        $response->assertStatus(302)->assertRedirect('/customers');
        
        // 登録したばかりの顧客を取得
        $customer = $user->customers()->get()->first();
        
        // ログアウトリクエストを送る
        $response = $this->get('/logout');
        
        // 別の新規ダミーユーザー作成
        $other = factory(User::class)->create();
        // その別のユーザーでログインしたとみなす
        $this->actingAs($other);
        // ログインしているかチェック
        $this->assertAuthenticated();
        
        // CustomersController@showにアクセス
        $response = $this->get('/customers/' . $customer->id);
        
        // 顧客一覧にリダイレクトされたかチェック
        $response->assertStatus(302)->assertRedirect('/customers');
        
    }
    
    /** @test */
    public function ログインしていない状態で顧客詳細画面のURLにアクセスするとログイン画面にリダイレクトされる()
    {
        // 新規ダミーユーザー作成
        $user = factory(User::class)->create();
        // そのユーザーでログインしたとみなす
        $this->actingAs($user);
        // ログインしているかチェック
        $this->assertAuthenticated();

        // 以下テスト顧客情報作成
        $genders = array('man', 'woman', 'unknown');
        $gender = $genders[mt_rand(0, 2)];
        
        $last_name = $this->faker->lastKanaName;
        
        if($gender === 'man'){
            $first_name = $this->faker->firstKanaNameMale;
        }else if($gender === 'woman'){
            $first_name = $this->faker->firstKanaNameFemale;
        }else{
            $first_name = 'ひかる';
        }
        
        $name = $last_name . $first_name;
        
        $data = [
            'name'     => $name,
            'kana_name'     => mb_convert_kana($name, "KVc"),
            'gender' => $gender,
        ];
        
        // CustomersController@storeにアクセス
        $response = $this->post('/customers', $data);
        // 登録したばかりの顧客を取得
        $customer = $user->customers()->get()->first();
        // ログアウトリクエストを送る
        $response = $this->get('/logout');
        
        // 顧客詳細画面にアクセス
        $response = $this->get('/customers/' . $customer->id);
        // ログイン画面にリダイレクトされたかチェック
        $response->assertStatus(302)->assertRedirect('/login');
    }
    
}
