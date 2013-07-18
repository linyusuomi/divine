<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Todo\Controller\Index' => 'Todo\Controller\IndexController'
        ),
    ),
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Todo\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'todo' => __DIR__ . '/../view',
        ),
    ),
);
