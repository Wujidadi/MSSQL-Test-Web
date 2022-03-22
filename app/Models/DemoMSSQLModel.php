<?php

namespace App\Models;

use App\MSSQLModel;

class DemoMSSQLModel extends MSSQLModel
{
    protected static $_uniqueInstance = null;

    public static function getInstance(): self
    {
        if (self::$_uniqueInstance == null) self::$_uniqueInstance = new self();
        return self::$_uniqueInstance;
    }

    protected function __construct()
    {
        parent::__construct('DEFAULT');
    }

    public function query($sql, $bind)
    {
        return $this->_db->query($sql, $bind);
    }
}
