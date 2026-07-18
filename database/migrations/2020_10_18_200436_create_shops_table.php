<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->string('name_ar');
            $table->string('name_en')->nullable();
            $table->longText('feature_image')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->string('mobile_1')->nullable();
            $table->string('mobile_2')->nullable();
            $table->string('phone_1')->nullable();
            $table->string('phone_2')->nullable();
            $table->string('hotline')->nullable();
            $table->text('address_ar')->nullable();
            $table->text('address_en')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->text('facebook')->nullable();
            $table->text('instagram')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->foreign('category_id')->references('id')
                ->on('categories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
