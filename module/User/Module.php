<?php

namespace User;

use Zend\Mvc\ModuleRouteListener,
    Zend\Mvc\MvcEvent,
    Zend\ModuleManager\Feature\AutoloaderProviderInterface,
    Zend\Authentication\AuthenticationService,
    Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;

class Module implements AutoloaderProviderInterface {

    public function onBootstrap(MvcEvent $e) {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $sharedEvents = $e->getApplication()->getEventManager()->getSharedManager();
        $sharedEvents->attach(
                __NAMESPACE__, 'dispatch', function($e) {
                    $result = $e->getResult();
                    if ($result instanceof \Zend\View\Model\ViewModel) {
                        $result->setTerminal(true);
                    }
                }
        );
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

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'User\Model\AuthStorage' => function($sm) {
                    return new \User\Model\AuthStorage('auth');
                },
                'AuthService' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $dbTableAuthAdapter = new DbTableAuthAdapter($dbAdapter, 'user', 'username', 'password');
                    $authService = new AuthenticationService();
                    $authService->setAdapter($dbTableAuthAdapter);
                    $authService->setStorage($sm->get('User\Model\AuthStorage'));
                    return $authService;
                },
            ),
        );
    }
}
