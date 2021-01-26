<?php

session_start();
require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('projects', 'ProjectController');
Router::post('login', 'SecurityController');
Router::post('addProject', 'ProjectController');
Router::post('register', 'SecurityController');
Router::post('search', 'ProjectController');
Router::post('profile', 'ProjectController');
Router::get('like', 'ProjectController');
Router::get('dislike', 'ProjectController');
Router::post('settings', 'DefaultController');
Router::post('logout', 'SecurityController');
Router::post('sortLike', 'ProjectController');
Router::post('sortKcal', 'ProjectController');
Router::post('sortTime', 'ProjectController');
Router::post('removeProject', 'ProjectController');
Router::post('admin', 'SecurityController');
Router::post('removeUser', 'SecurityController');

Router::run($path);