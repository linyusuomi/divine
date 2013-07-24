<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    User\Form\RegisterForm,
    Doctrine\ORM\EntityManager,
    User\Entity\User;

class RegisterController extends AbstractActionController {
    
    protected $em;
 
    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
    }
 
    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    public function indexAction() {
        
    }

    
    public function registerAction(){
        $form = new RegisterForm();
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $user = new User();
            //$form->setInputFilter($user->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $user->populate($form->getData());
                $user->setStatus(1);
                $this->getEntityManager()->persist($user);
                $this->getEntityManager()->flush();
            }
        }
        
        
        return new ViewModel(array(
                    'form' => $form,
                    'messages' => $this->flashmessenger()->getMessages()
                ));
    }

}