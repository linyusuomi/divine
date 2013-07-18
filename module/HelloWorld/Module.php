<?php

namespace HelloWorld;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

  	    $sharedEvents        = $e->getApplication()->getEventManager()->getSharedManager();
  	    $sharedEvents->attach(
			__NAMESPACE__, 'dispatch', function($e) {
				$result = $e->getResult();
				if ($result instanceof \Zend\View\Model\ViewModel) {
					$result->setTerminal(true);
				}
			}
		);
    }

    public function getConfig()
    {
		return array(
			'router' => array(
				'routes' => array(
					'home' => array(
						'type' => 'Zend\Mvc\Router\Http\Literal',
						'options' => array(
							'route'    => '/',
							'defaults' => array(
								'controller' => 'HelloWorld\Controller\Index',
								'action'     => 'index',
							),
						),
					),
				),
			),
			'controllers' => array(
				'invokables' => array(
					'HelloWorld\Controller\Index' => 'HelloWorld\Controller\IndexController'
				),
			),
			'view_manager' => array(
				'template_path_stack' => array(
					__DIR__ . '/view',
				),
			),
		);
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/',
                ),
            ),
        );
    }
}
