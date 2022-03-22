<?php

use App\Controllers\MssqlController;

$Route->map('GET', '/', function() {
    MssqlController::getInstance()->index();
});
