<?php

namespace app\Controllers;

use App\Models\DemoMSSQLModel;

class MssqlController
{
    protected static $_uniqueInstance = null;

    public static function getInstance(): self
    {
        if (self::$_uniqueInstance == null) self::$_uniqueInstance = new self();
        return self::$_uniqueInstance;
    }

    protected function __construct() {}

    public function index()
    {
        header('content-type: text/plain');
        $dbConn = DemoMSSQLModel::getInstance();
        $sql = <<<SQL
        SELECT TOP (5) [optname]
            ,[value]
            ,[major_version]
            ,[minor_version]
            ,[revision]
            ,[install_failures]
        FROM [master].[dbo].[MSreplication_options]
        SQL;
        $bind = [];
        $result = $dbConn->query($sql, $bind);
        var_dump($result);
    }
}
