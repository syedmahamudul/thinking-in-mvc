<?php

use Src\User;

require __DIR__ . '/vendor/autoload.php';


$user = new User();

echo $user->sayHello();