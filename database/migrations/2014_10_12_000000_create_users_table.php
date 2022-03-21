<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('active')->default(1);
            $table->unsignedInteger('registration_step')->nullable();
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });

        \App\Models\User::insert([
            [
                'email' => 'admin@splashcreative.com',
                'password' => Hash::make('P3Gc*+fgtW+j@C5CJG%7!a@d'),
                'first_name' => 'Ionut',
                'last_name' => 'Rusen',
                'email_verified_at' => now(),
                //'gender' => 'male',
                'active' => 1,
                'remember_token' => Str::random(10)
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
