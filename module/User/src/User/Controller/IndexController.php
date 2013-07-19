<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Doctrine\ORM\EntityManager,
    User\Entity\User,
    User\Form\LoginForm;

class IndexController extends AbstractActionController {

    /**             
    * @var Doctrine\ORM\EntityManager
    */                
    protected $em;
    
    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
    }
   
    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }
         
    public function indexAction() { 
        
    }
    
    public function loginAction() {
       $form="1212";
        
       return new ViewModel(array(
            'form' => $form,
        ));
    }

}