<?php

use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return view('welcome');
});

Route::get('/ninjas', function () {
    $ninjas = [
        ["name" => "mario","skill" => 75, "id" => 1],
        ["name" => "luigi","skill" => 80, "id" => 2],
        ["name" => "peach","skill" => 90, "id" => 3]
    ];
    return view('ninjas.index', ["greeting" => "hello", "ninjas" => $ninjas]);
});

Route::get('/ninjas/{id}', function ($id) {

    return view('ninjas.show', ["id" => $id]);
});

