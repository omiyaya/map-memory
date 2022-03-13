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
        Schema::create('t_photo', function (Blueprint $table) {
            $table->increments('photo_id');
            $table->string('photo_name')->nullable();
            $table->string('photo_hash_name')->nullable();
            $table->string('photo_extension')->nullable();
            $table->date('photo_date')->nullable();
            $table->boolean('share_on')->default(false);
            $table->integer('user_id');
            $table->integer('area_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_photo');
    }
};
