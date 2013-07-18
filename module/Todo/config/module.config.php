<?php
namespace Todo;
return array(
    
    //Controllers in this module
    'controllers' => array(
        'invokables' => array(
            'Todo\Controller\Index' => 'Todo\Controller\IndexController'
        ),
    ),
    
    //Routes for this module
    'router' => array(
        
        'routes' => array(
            //in the future ,set a default module put this home route,it is not good in todo module
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Todo\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
            'todo' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/todo[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Todo\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    
    // View setup for this module
    'view_manager' => array(
        'template_path_stack' => array(
            'todo' => __DIR__ . '/../view',
        ),
    ),
    
    // Doctrine config
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    )
);
