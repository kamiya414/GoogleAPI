<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boookmarks', function (Blueprint $table) {
             $table->foreignId('user_id')->constrained('users');   //参照先のテーブル名を
        $table->foreignId('gemini_id')->constrained('geminies');    //constrainedに記載
        $table->primary(['user_id', 'gemini_id']);  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boookmarks');
    }
};
