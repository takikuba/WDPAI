<?php

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

Router::run($path);