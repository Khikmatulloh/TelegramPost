<?php
declare(strict_types=1);
namespace App;
require_once "vendor/autoload.php";
use App\Router;
$router = new Router(); 
$router->get('/', require 'view/view.php');

