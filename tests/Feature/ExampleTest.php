<?php


test('public posts page exists', function () {
    $this->get('/posts')
         ->assertStatus(200);
});


test('admin dashboard route is registered', function () {
    $response = $this->get('/admin/dashboard');
    
   
    expect($response->status())->toBeIn([200, 302]);
});


test('admin users list route is registered', function () {
    $response = $this->get('/admin/users');
    expect($response->status())->toBeIn([200, 302]);
});


test('admin posts list route is registered', function () {
    $response = $this->get('/admin/posts');
    expect($response->status())->toBeIn([200, 302]);
});


test('admin create post route is registered', function () {
    $response = $this->get('/admin/posts/create');
    expect($response->status())->toBeIn([200, 302]);
});


test('application has a name', function () {
    $appName = config('app.name');
    expect($appName)->not->toBeEmpty();
});