<?php
namespace User;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Authentication\Storage;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;

class Module implements AutoloaderProviderInterface
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
	return include __DIR__ . '/config/module.config.php';
    }
    
    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
 
}
