<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_centers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->nullableMorphs('model');
            $table->longText('file');
            $table->string('extension');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

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
        Schema::dropIfExists('file_centers');
    }
}
