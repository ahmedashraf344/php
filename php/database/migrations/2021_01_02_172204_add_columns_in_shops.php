<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Shop;

class AddColumnsInShops extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shops', function (Blueprint $table) {
            $table->unsignedBigInteger('views')->default(0);
            $table->string('working_days_ar')->nullable();
            $table->string('working_days_en')->nullable();
            $table->time('start_at')->nullable();
            $table->time('end_at')->nullable();
            $table->bigInteger('category_id')->unsigned()->nullable()->change();
            $table->unsignedTinyInteger('status')->default(Shop::STATUS_PUBLISHED);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shops', function (Blueprint $table) {
            $table->dropColumn(['views','working_days_ar', 'working_days_en', 'start_at', 'end_at','status']);
        });
    }
}
