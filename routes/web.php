<?php

use App\Entitys\EPostEntity;
use App\Entitys\EUserEntity;
use App\Models\Post;
use App\Models\User;
use Faker\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $faker =  Factory::create();
    $userEntity = new EUserEntity(
        $faker->name,
        $faker->email,
        Hash::make('12345678')
    );

    $postEntity = new EPostEntity(
        $faker->title,
        $userEntity->getId()
    );

    User::query()->create($userEntity->toDbArray());
    Post::query()->create($postEntity->toDbArray());

    return $postEntity->toDbArray();
});
