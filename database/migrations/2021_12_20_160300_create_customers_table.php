<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id'); // ID
            $table->unsignedBigInteger('user_id'); // user_id
            $table->string('name'); // 名前
            $table->string('kana_name'); // ふりがな
            $table->string('thumbnail')->nullable()->default(''); // 画像名
            $table->string('gender'); // 性別
            $table->integer('age')->nullable()->default(0); // 年齢
            $table->string('birthday')->nullable()->default(''); // 誕生日
            $table->string('address')->nullable()->default(''); // 住所
            $table->string('hometown')->nullable()->default(''); // 出身地
            $table->string('feature')->nullable()->default(''); // 特徴
            $table->string('blood_type')->nullable()->default(''); // 血液型
            $table->string('job')->nullable()->default(''); // 職業
            $table->string('hobby')->nullable()->default(''); // 趣味
            $table->string('skill')->nullable()->default(''); // 特技
            $table->string('dayoff')->nullable()->default(''); // 休日
            $table->string('favorite_food')->nullable()->default(''); // 好きな食べ物
            $table->string('dislike_food')->nullable()->default(''); // 嫌いな食べ物
            $table->string('marriage')->nullable()->default(''); // 結婚
            $table->string('children')->nullable()->default(''); // 子供
            $table->string('lover')->nullable()->default(''); // 恋人
            $table->string('email')->nullable()->default(''); // メールアドレス
            $table->string('telephone')->nullable()->default(''); // 電話番号
            $table->string('company_name')->nullable()->default(''); // 会社名
            $table->string('memo')->nullable()->default(''); // メモ
            $table->boolean('favorite_flag')->default(false); // お気に入りフラグ
            $table->boolean('delete_flag')->default(false); // 削除フラグ
            $table->timestamps(); // 登録日時、更新日時

            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
