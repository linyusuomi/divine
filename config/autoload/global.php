<?php

return array( 
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
    
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                    'params' => array(
                        'host' => 'localhost',
                        'port' => '3306',
                        'dbname' => 'calendar_1',
                ),
            ),
        ),
    ),
    
    'db' => array(
        'driver' => 'Pdo',
        'dsn' => 'mysql:dbname=calendar_1;host=localhost',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
    ),
);
