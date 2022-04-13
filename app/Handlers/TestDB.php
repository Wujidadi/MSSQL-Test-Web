<?php

namespace App\Handlers;

use App\Models\DemoMSSQLModel;
use Throwable;

/**
 * Test DB handler.
 */
class TestDB
{
    /**
     * Instance of this class.
     *
     * @var self|null
     */
    protected static $_uniqueInstance = null;

    /**
     * Constructor.
     *
     * @return void
     */
    protected function __construct() {}

    /**
     * Get the instance of this class.
     *
     * @return self
     */
    public static function getInstance(): self
    {
        if (self::$_uniqueInstance == null) self::$_uniqueInstance = new self();
        return self::$_uniqueInstance;
    }

    /**
     * Create the test database.
     *
     * @return array|int|null|string  **Success:** `array|int` while `SELECT`, `null` otherwise.  
     *                                **Fail:** `string` for error message.
     */
    public function createDB()
    {
        try
        {
            $sql = <<<SQL
            CREATE DATABASE [TEST_STORAGE];
            SQL;
            $bind = [];
            return DemoMSSQLModel::getInstance()->query($sql, $bind);
        }
        catch (\Throwable $ex)
        {
            $exType = get_class($ex);
            $exCode = $ex->getCode();
            $exMessage = $ex->getMessage();
            $exFile = $ex->getFile();
            $exLine = $ex->getLine();
            $exTrace = $ex->getTraceAsString();
            $errorMessage = "{$exFile}:{$exLine} {$exType}: ({$exCode}) {$exMessage}\n{$exTrace}";
            return $errorMessage;
        }
    }

    /**
     * Drop the test database.
     *
     * @return array|int|null|string  **Success:** `array|int` while `SELECT`, `null` otherwise.  
     *                                **Fail:** `string` for error message.
     */
    public function dropDB()
    {
        try
        {
            $sql = <<<SQL
            DROP DATABASE IF EXISTS [TEST_STORAGE];
            SQL;
            $bind = [];
            return DemoMSSQLModel::getInstance()->query($sql, $bind);
        }
        catch (\Throwable $ex)
        {
            $exType = get_class($ex);
            $exCode = $ex->getCode();
            $exMessage = $ex->getMessage();
            $exFile = $ex->getFile();
            $exLine = $ex->getLine();
            $exTrace = $ex->getTraceAsString();
            $errorMessage = "{$exFile}:{$exLine} {$exType}: ({$exCode}) {$exMessage}\n{$exTrace}";
            return $errorMessage;
        }
    }
}
