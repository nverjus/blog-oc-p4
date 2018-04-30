<?php
session_start();

require_once '../vendor/autoload.php';

$app = new Blog\BlogApplication;

$app->run();
