<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->boolean('age_flag')->default(true); 
            $table->boolean('birthday_flag')->default(true); 
            $table->boolean('address_flag')->default(true); 
            $table->boolean('hometown_flag')->default(true); 
            $table->boolean('charactor_flag')->default(true); 
            $table->boolean('blood_type_flag')->default(true); 
            $table->boolean('occupancy_flag')->default(true); 
            $table->boolean('hobby_flag')->default(true); 
            $table->boolean('skill_flag')->default(true); 
            $table->boolean('dayoff_flag')->default(true); 
            $table->boolean('favorite_food_flag')->default(true); 
            $table->boolean('dislike_food_flag')->default(true); 
            $table->boolean('marriage_flag')->default(true); 
            $table->boolean('children_flag')->default(true); 
            $table->boolean('lover_flag')->default(true); 
            $table->boolean('mail_flag')->default(true); 
            $table->boolean('telphone_flag')->default(true); 
            $table->boolean('company_name_flag')->default(true); 
            $table->boolean('memo_flag')->default(true); 
            $table->boolean('thumbnail_flag')->default(true); 

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
        Schema::dropIfExists('flags');
    }
}
