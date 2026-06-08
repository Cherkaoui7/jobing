<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfileFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
{
    Schema::table('users', function (Blueprint $table) {

        $table->string('phone')->nullable();
        $table->string('city')->nullable();
        $table->text('bio')->nullable();
        $table->text('skills')->nullable();

        $table->string('cv')->nullable();
        $table->string('image')->nullable();

        $table->string('linkedin')->nullable();
        $table->string('github')->nullable();

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

        $table->dropColumn([
            'phone',
            'city',
            'bio',
            'skills',
            'cv',
            'image',
            'linkedin',
            'github'
        ]);

    });
}
}
