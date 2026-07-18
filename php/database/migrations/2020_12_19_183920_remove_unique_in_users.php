<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUniqueInUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['email']);
            $table->text('device_id')->nullable()->after('avatar');
            $table->text('device_token')->nullable()->after('avatar');
            $table->string('code')->nullable()->after('mobile');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
//            $table->unique(['email']);
            $table->dropColumn(['device_id','device_token','code']);
        });
    }
}
