<?php
namespace Blog;
return array(
    
    //Controllers in this module
    'controllers' => array(
        'invokables' => array(
            'Blog\Controller\Index' => 'Blog\Controller\IndexController'
        ),
    ),
    
    //Routes for this module
    'router' => array(       
        'routes' => array(
            'blog' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/blog[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Blog\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    
    // View setup for this module
    'view_manager' => array(
        'template_path_stack' => array(
            'blog' => __DIR__ . '/../view',
        ),
    ),
    
   
    
    //when run ./vendor/bin/doctrine-module orm:validate-schema got 'Given route does not implement Console route interface' error
    'console' => array(
        'router' => array(),
    ),
);
