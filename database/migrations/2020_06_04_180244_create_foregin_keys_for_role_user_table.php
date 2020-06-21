<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeginKeysForRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    //     Schema::create('foregin_keys_for_role_user', function (Blueprint $table) {
    //         $table->id();
    //         $table->timestamps();
    //     });
    
        Schema::table('role_user', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       // Schema::dropIfExists('foregin_keys_for_role_user');
       Schema::table('role_user', function (Blueprint $tabe) {
            $table->dropForegin('role_user_user_id_foregin');
            $table->dropForegin('role_user_role_id_foregin');
       });
    }
}
