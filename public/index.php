<?php

use App\Controller\ItemController;

require __DIR__ . '/../vendor/autoload.php';

$paul = new ItemController();
$paul->index();