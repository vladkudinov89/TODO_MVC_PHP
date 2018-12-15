<?php

require ROOT . 'app/config/database.php';

use Illuminate\Database\Capsule\Manager as Capsule;


Capsule::schema()->create('task_list', function ($table) {

    $table->increments('id');

    $table->string('task_name');

    $table->string('email')->unique();

    $table->string('password');

    $table->string('userimage')->nullable();

    $table->string('api_key')->nullable()->unique();

    $table->rememberToken();

    $table->timestamps();

});