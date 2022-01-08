<?php

namespace Tests\Unit;

use Tests\TestCase;
// use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User; // 追加
use Faker\Factory; // 追加

class UserTest extends TestCase
{

    // テストが終わったらテーブルをリフレッシュする設定
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
     * 新規ユーザー登録テスト
     *
     * @return void
     */
    public function test_新規ユーザー登録()
    {
        // 挿入するデータ件数を定義
        $num = 100;
        
        // 現状のユーザー数をカウント
        $count_before = count(User::all());
        
        // fakerを使って100データを挿入
        for($i = 1; $i <= $num; $i++){
            // faker を使ってダミーユーザー情報を作成
            $attributes = [
                'name'     => $this->faker->name,
                'email'     => $this->faker->unique()->email,
                'password' => bcrypt($this->faker->password),
            ];
            // 新規ユーザーのDBへの登録
            User::create($attributes);
            // 挿入されたデータが確かにusersテーブルに存在するか確認
            $this->assertDatabaseHas('users', $attributes);
        }
        
        // 100データ挿入後の全ユーザー数をカウント
        $count_after = count(User::all());
        
        // 100データ増えているか確認
        $this->assertSame(($count_before + $num), $count_after);
    }
        /**
     * ユーザー削除テスト
     *
     * @return void
     */
    public function test_ユーザ削除(){
        // 最初のユーザーを取得
        $user = User::first();
        // ユーザーが存在していれば
        if($user !== null){
            // 現在の全ユーザー数を取得
            $count_before = count(User::all());
            // 最初のユーザーを削除
            $user->delete();
            // 削除後の全ユーザー数を取得
            $count_after = count(User::all());
            // 削除前後で全ユーザー数が1だけ減ったか検証
            $this->assertSame(($count_before - 1), $count_after);
        }else{
            // 最初のユーザーが存在しない検証
            $this->assertNull($user);
        }
    }

}

