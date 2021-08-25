<?php

$router = new \Bramus\Router\Router();

$router->setNamespace('controllers');


//HOME
$router->get('index.php','FrontendController@index');
$router->get('/','FrontendController@index');

//REGISTER
$router->get('/register-form', 'FrontendController@registerForm');
$router->post('/register', 'FrontendController@register');

//LOGIN
$router->get('/login-form','LoginController@viewLogin');
$router->post('/login','LoginController@login');
$router->get('/logout','LoginController@logout');

//CONTACT
$router->get('/contact', 'FrontendController@contact');
$router->post('/contact-send', 'FrontendController@contactSend');

$router->get('/category', 'FrontendController@categories');

//LIKES
$router->get('/like', 'LikeController@like');
$router->get('/unlike', 'LikeController@unlike');

//COMMENTS
$router->post('/comments-add', 'CommentController@store');
$router->post('/verify', 'CommentController@verify');
$router->get('/verify-view', 'CommentController@verifyView');
$router->get('/comments-view-edit', 'CommentController@edit');
$router->post('/comments-update', 'CommentController@update');
$router->get('/comment-delete', 'CommentController@delete');


$router->get('/post' ,'FrontendController@single');


$router->run();
