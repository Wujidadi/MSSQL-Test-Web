<?php

chdir(__DIR__);
require_once '../bootstrap/cli.php';

use Libraries\MSSQL;
use App\Handlers\TestDB;

$result = TestDB::getInstance()->createDB();

var_dump($result);
