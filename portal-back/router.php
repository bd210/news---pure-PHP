<?php


$router = new \Bramus\Router\Router();
$router->setNamespace('controllers');

//HOME - INDEX PAGE
$router->get('/', 'BackendController@index');
$router->get('index.php', 'BackendController@index');

//LOGIN
$router->post('/login', 'LoginController@login');
$router->get('/logout', 'LoginController@logout');

//SEARCH
$router->post('/search', 'BackendController@search');

//USERS
$router->get('/all-users', 'UserController@index');
$router->get('/create-users-view','UserController@create');
$router->post('/create-user', 'UserController@store');
$router->get('/delete-user', 'UserController@delete');
$router->get('/view-user-profile', 'UserController@edit');
$router->post('/update-user', 'UserController@update');

//POSTS - NEWS
$router->get('/all-posts', 'PostController@index');
$router->get('/create-posts-view','PostController@create');
$router->post('/create-post', 'PostController@store');
$router->get('/delete-post', 'PostController@delete');
$router->get('/view-post', 'PostController@edit');
$router->post('/update-post', 'PostController@update');
$router->get('/pending-post', 'PostController@pending');
$router->get('/approve-post', 'PostController@approve');
$router->get('/delete-post-file', 'PostController@deletePostFile');

//CATEGORIES
$router->get('/all-categories', 'CategoryController@index');
$router->get('/create-categories-view', 'CategoryController@create');
$router->post('/create-category', 'CategoryController@store');
$router->get('/delete-category', 'CategoryController@delete');
$router->get('/view-category', 'CategoryController@edit');
$router->post('/update-category', 'CategoryController@update');

//FORBIDDEN WORDS
$router->get('/all-forbidden-words' , 'BadWordController@index');
$router->get('/create-forbidden-words-view', 'BadWordController@create');
$router->post('/create-forbidden-word', 'BadWordController@store');
$router->get('/delete-forbidden-word', 'BadWordController@delete');
$router->get('/view-forbidden-word', 'BadWordController@edit');
$router->post('/update-forbidden-word', 'BadWordController@update');

//ROLES
$router->get('/all-roles', 'RoleController@index');
$router->get('/create-roles-view', 'RoleController@create');
$router->post('/create-role', 'RoleController@store');
$router->get('/delete-role', 'RoleController@delete');
$router->get('/view-role', 'RoleController@edit');
$router->post('/update-role', 'RoleController@update');

//PERMISSIONS
$router->get('/all-permissions', 'PermissionController@index');
$router->get('/create-permissions-view', 'PermissionController@create');
$router->post('/create-permission', 'PermissionController@store');
$router->get('/delete-permission', 'PermissionController@delete');
$router->get('/view-permission', 'PermissionController@edit');
$router->post('/update-permission', 'PermissionController@update');

//PERMISSION ROLES
$router->get('/all-permission-roles', 'BackendController@PermissionRole');
$router->post('/update-permission-role', 'BackendController@updatePermissionRole');

//TAGS
$router->get('/all-tags', 'TagController@index');
$router->get('/create-tags-view', 'TagController@create');
$router->post('/create-tag', 'TagController@store');
$router->get('/delete-tag', 'TagController@delete');
$router->get('/view-tag', 'TagController@edit');
$router->post('/update-tag', 'TagController@update');


//COMMENTS
$router->get('/all-comments', 'CommentController@index');
$router->get('/delete-comment', 'CommentController@delete');



$router->run();







