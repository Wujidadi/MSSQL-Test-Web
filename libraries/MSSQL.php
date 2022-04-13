<?php

namespace Libraries;

use PDO;

/**
 * MSSQL 資料庫連線類別
 */
class MSSQL
{
    private $_className;

    private $_host;
    private $_port;
    private $_database;
    private $_username;
    private $_password;
    private $_options;

    private $_pdo;

    /**
     * 單一實例
     *
     * @var self|null
     */
    protected static $_uniqueInstance = null;

    /**
     * 取得單一實例
     *
     * @return self
     */
    public static function getInstance(): self
    {
        if (self::$_uniqueInstance == null)
        {
            self::$_uniqueInstance = new self(
                DB_CONFIG['MSSQL']['HOST'],
                DB_CONFIG['MSSQL']['PORT'],
                DB_CONFIG['MSSQL']['DATABASE'],
                DB_CONFIG['MSSQL']['USERNAME'],
                DB_CONFIG['MSSQL']['PASSWORD']
            );
        }

        return self::$_uniqueInstance;
    }

    /**
     * 建構子
     */
    protected function __construct($host, $port, $database, $username, $password)
    {
        $this->_className = basename(__FILE__, '.php');

        $this->_host = $host;
        $this->_port = $port;
        $this->_database = $database;
        $this->_username = $username;
        $this->_password = $password;
        $this->_options = [];
        $this->_connect();
    }

    /**
     * 資料庫連線
     *
     * @return void
     */
    private function _connect(): void
    {
        // try
        // {
            $dsn = "sqlsrv:server={$this->_host},{$this->_port};Database={$this->_database};Encrypt=true;TrustServerCertificate=true";
            $this->_pdo = new \PDO($dsn, $this->_username, $this->_password, $this->_options);
            $this->_pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        // }
        // catch (\PDOException $ex)
        // {
        //     $exType = get_class($ex);
        //     $exCode = $ex->getCode();
        //     $exMessage = $ex->getMessage();
        //     $exString = "{$exType}({$exCode}): {$exMessage}";
        //     echo "\033[31;1m{$exString}\033[0m\n";
        // }
    }

    /**
     * 開啟事務模式（關閉自動提交模式）
     *
     * @return boolean
     */
    public function beginTransaction(): bool
    {
        return $this->_pdo->beginTransaction();
    }

    /**
     * 提交查詢，開啟事務模式（關閉自動提交模式）時有效  
     * 呼叫後將恢復自動提交模式
     *
     * @return boolean
     */
    public function commit(): bool
    {
        return $this->_pdo->commit();
    }

    /**
     * 回滾當前事務  
     * 呼叫後將恢復自動提交模式
     *
     * @return boolean
     */
    public function rollBack(): bool
    {
        return $this->_pdo->rollBack();
    }

    /**
     * 返回當前連線是否處於事務模式（即非自動提交模式）
     *
     * @return boolean
     */
    public function inTransaction(): bool
    {
        return $this->_pdo->inTransaction();
    }

    /**
     * 返回 PDO 實體
     *
     * 後門方法，本類別現有方法不敷使用時，可臨時以本方法呼叫 PDO 應急
     *
     * @return \PDO
     */
    public function getPDO(): \PDO
    {
        return $this->_pdo;
    }

    /**
     * 查詢 MSSQL 資料庫
     *
     * @param  string  $sql   SQL 語法
     * @param  array   $bind  綁定變數，可代入一維或二維陣列  
     *                        為一維陣列時，各項以預設的 `PDO::PARAM_STR` 型態綁定  
     *                        為二維陣列時，各項的第一項（`[0]`）為值，第二項（`[1]`）為綁定型態
     * @return array|integer|null
     */
    public function query(string $sql, array $bind = [])
    {
        $query = $this->_pdo->prepare($sql);

        foreach ($bind as $key => $value)
        {
            if (!is_array($value))
            {
                $query->bindParam($key, $bind[$key]);
            }
            else
            {
                $query->bindParam($key, $bind[$key][0], $bind[$key][1]);
            }
        }

        $query->execute();

        if ($query->columnCount())
        {
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        }

        return null;
    }
}
