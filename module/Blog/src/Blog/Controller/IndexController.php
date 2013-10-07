<?php

namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

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
        return new ViewModel(array(
            
        ));
    }

}