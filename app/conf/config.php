<?php
ini_set("session.cookie_lifetime", 86400); //1 day
session_start();

define('ROOT', $_SERVER['DOCUMENT_ROOT'] .  '/app');
define('CONTROLLER_PATH', ROOT . '/controllers/');
define('MODEL_PATH', ROOT . '/models/');
define('VIEW_PATH', ROOT . '/views/');
define('HOST', 'http://' . $_SERVER['HTTP_HOST'] . '/');

require_once("db_connect.php");
require_once("route.php");
require_once(MODEL_PATH. 'Model.php');
require_once(VIEW_PATH. 'View.php');
require_once(CONTROLLER_PATH. 'Controller.php');

require_once(ROOT . '/conf' . '/functions.php');

Routing::buildRoute();

