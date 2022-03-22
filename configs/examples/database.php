<?php

/**
 * Database configurations.
 *
 * @var array
 */
define('DB_CONFIG', [

    /**
     * Default database configurations.
     *
     * @var array
     */
    'DEFAULT' => [

        /**
         * Database type.
         *
         * @var string
         */
        'TYPE' => 'mysql',

        /**
         * Database host.
         *
         * @var string
         */
        'HOST' => '127.0.0.1',

        /**
         * Database port.
         *
         * @var integer|string
         */
        'PORT' => '3306',

        /**
         * Database name.
         *
         * @var string
         */
        'DATABASE' => 'default_db',

        /**
         * Database username.
         *
         * @var string
         */
        'USERNAME' => 'root',

        /**
         * Database password.
         *
         * @var string
         */
        'PASSWORD' => ''

    ],

    /**
     * Configurations of second database as example.
     *
     * @var array
     */
    'SECOND' => [

        'TYPE' => 'pgsql',

        'HOST' => '192.168.0.150',

        'PORT' => 5432,

        'DATABASE' => 'default_db',

        'USERNAME' => 'root',

        'PASSWORD' => ''

    ],

    /**
     * Configurations of MSSQL Test, March 22, 2022 in PChome.
     *
     * @var array
     */
    'MSSQL' => [

        'TYPE' => 'sqlsrv',

        'HOST' => '10.99.251.2',

        'PORT' => 1433,

        'DATABASE' => 'master',

        'USERNAME' => 'SA',

        'PASSWORD' => '1qaz2wsx'

    ]

]);
