<?php

namespace Tests\Unit;

use Tests\TestCase;
// use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations; // 追加
use App\Customer; // 追加
use App\User; // 追加
use Faker\Factory; // 追加

class CustomerTest extends TestCase
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
    public function 新規顧客登録()
    {   
        // テストユーザ作成
        $user = factory(User::class)->create();
        
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
        
        $name = $last_name . '' . $first_name;
        
        $attributes = [
            'name'     => $name,
            'kana_name'     => $name,
            'gender' => $gender,
            'age' => mt_rand(10, 100),
            'company_name' => $this->faker->company,
            'address' => $this->faker->prefecture,
            'email' => $this->faker->email,
            'company_name' => $this->faker->company,
            'telephone' => $this->faker->phoneNumber,
            'memo' => $this->faker->text,
        ];
        // テストユーザーのテスト顧客を作成
        $user->customers()->create($attributes);
        
        // DBのcsutomersテーブルに上記の情報が保存されているのか確認
        $this->assertDatabaseHas('customers', $attributes);
    }
    
    /** @test */
    public function 顧客の削除処理()
    {   
        // テストユーザ作成
        $user = factory(User::class)->create();
        
        $name = $this->faker->KanaName;
        
        // 以下顧客情報を定義。
        $attributes_before = [
            'name'     => $name,
            'kana_name'     => $name,
            'gender' => 'man',
        ];
        // テストユーザーのテスト顧客を作成
        $customer = $user->customers()->create($attributes_before);
        // DBのcsutomersテーブルに上記の情報が保存されているのか確認
        $this->assertDatabaseHas('customers', $attributes_before);
        
        $customer->delete_flag = 1;
        $customer->save();
        $attributes_after = [
            'name'     => $name,
            'kana_name'     => $name,
            'gender' => 'man',
            'delete_flag' => 1
        ];
        // DBのcsutomersテーブルに上記の情報が保存されているのか確認
        $this->assertDatabaseHas('customers', $attributes_after);
    }
    
    /** @test */
    public function 顧客の削除取り消し処理()
    {   
        // テストユーザ作成
        $user = factory(User::class)->create();
        
        $name = $this->faker->name;
        
        // 以下顧客情報を定義。
        $attributes_before = [
            'name'     => $name,
            'kana_name'     => $name,
            'gender' => 'man',
            'delete_flag' => 1
        ];
        // テストユーザーのテスト顧客を作成
        $customer = $user->customers()->create($attributes_before);
        // DBのcsutomersテーブルに上記の情報が保存されているのか確認
        $this->assertDatabaseHas('customers', $attributes_before);
        
        $customer->delete_flag = 0;
        $customer->save();
        $attributes_after = [
            'name'     => $name,
            'kana_name'     => $name,
            'gender' => 'man',
            'delete_flag' => 0
        ];
        // DBのcsutomersテーブルに上記の情報が保存されているのか確認
        $this->assertDatabaseHas('customers', $attributes_after);
    }
    
    /** @test */
    public function 顧客のお気に入り処理()
    {   
        // テストユーザ作成
        $user = factory(User::class)->create();
        
        $name = $this->faker->KanaName;
        
        // 以下顧客情報を定義。名前は空
        $attributes_before = [
            'name'     => $name,
            'kana_name'     => $name,
            'gender' => 'man',
        ];
        // テストユーザーのテスト顧客を作成
        $customer = $user->customers()->create($attributes_before);
        // DBのcsutomersテーブルに上記の情報が保存されているのか確認
        $this->assertDatabaseHas('customers', $attributes_before);
        
        $customer->favorite_flag = 1;
        $customer->save();
        $attributes_after = [
            'name'     => $name,
            'kana_name'     => $name,
            'gender' => 'man',
            'favorite_flag' => 1
        ];
        // DBのcsutomersテーブルに上記の情報が保存されているのか確認
        $this->assertDatabaseHas('customers', $attributes_after);
    }
    
    /** @test */
    public function お気に入り取り消し処理()
    {   
        // テストユーザ作成
        $user = factory(User::class)->create();
        
        $name = $this->faker->name;
        
        // 以下顧客情報を定義。名前は空
        $attributes_before = [
            'name'     => $name,
            'kana_name'     => $name,
            'gender' => 'man',
            'favorite_flag' => 1
        ];
        // テストユーザーのテスト顧客を作成
        $customer = $user->customers()->create($attributes_before);
        // DBのcsutomersテーブルに上記の情報が保存されているのか確認
        $this->assertDatabaseHas('customers', $attributes_before);
        
        $customer->favorite_flag = 0;
        $customer->save();
        $attributes_after = [
            'name'     => $name,
            'kana_name'     => $name,
            'gender' => 'man',
            'favorite_flag' => 0
        ];
        // DBのcsutomersテーブルに上記の情報が保存されているのか確認
        $this->assertDatabaseHas('customers', $attributes_after);
    }
}
