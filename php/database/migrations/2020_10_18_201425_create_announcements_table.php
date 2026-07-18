<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->string('name_ar');
            $table->string('name_en')->nullable();
            $table->longText('feature_image')->nullable();
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->unsignedTinyInteger('type')->default(0);
            $table->date('enable_at')->nullable();
            $table->date('disable_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('announcements');
    }
}
