<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Doctrine\ORM\EntityManager,
    User\Form\LoginForm,
    User\Form\RegisterForm;

class IndexController extends AbstractActionController {

    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;
    protected $form;
    protected $storage;
    protected $authservice;

    public function setEntityManager(EntityManager $em) {
        $this->em = $em;
    }

    public function getEntityManager() {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    public function getAuthService() {
        if (!$this->authservice) {
            $this->authservice = $this->getServiceLocator()
                    ->get('AuthService');
        }

        return $this->authservice;
    }

    public function getSessionStorage() {
        
        if (!$this->storage) {
            $this->storage = $this->getServiceLocator()
                    ->get('User\Model\AuthStorage');
        }

        return $this->storage;
    }

    public function indexAction() {
        
    }

    public function loginAction() {

        $form = new LoginForm();

        return new ViewModel(array(
                    'form' => $form,
                    'messages' => $this->flashmessenger()->getMessages()
                ));
    }

    public function authenticateAction() {
        
        $form = new LoginForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {

                $adapter = $this->getAuthService()->getAdapter();
                $adapter->setIdentity($request->getPost('username'));
                $adapter->setCredential($request->getPost('password'));
                $result = $this->getAuthService()->authenticate();
                
                if ($result->isValid()) {
                    $remeberMe = $request->getPost('rememberMe');
                    if (isset($remeberMe)) {
                        $this->getSessionStorage()
                                ->setRememberMe(1);
                        //set storage again 
                        $this->getAuthService()->setStorage($this->getSessionStorage());
                    }
                    $this->getAuthService()->getStorage()->write($request->getPost('username'));
                    return $this->redirect()->toRoute('user', array( 
                        'action' =>  'success' 
                    ));     
                }
            }
        } 

        return $this->redirect()->toRoute('user', array( 
                        'action' =>  'login' 
                    )); 
 
    }

    public function logoutAction() {
        //$this->getSessionStorage()->read() check username
        $this->getSessionStorage()->forgetMe();
        $this->getAuthService()->clearIdentity();
        $this->flashmessenger()->addMessage("You've been logged out");
        return $this->redirect()->toRoute('user', array( 
                        'action' =>  'login' 
                    ));
    }
    
    public function registerAction(){
        $form = new RegisterForm();

        return new ViewModel(array(
                    'form' => $form,
                    'messages' => $this->flashmessenger()->getMessages()
                ));
    }
    
    public function successAction(){    
        return new ViewModel(array(
                    
                ));
    }

}