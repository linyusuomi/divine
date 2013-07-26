<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    User\Form\RegisterForm,
    Doctrine\ORM\EntityManager,
    User\Entity\User,
    Zend\Mail;

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
                //$user->setStatus(1);
                $this->getEntityManager()->persist($user);
                $this->getEntityManager()->flush();
                  
                $password = $user->getPassword();
                $password = md5($password);
                //send mail to register 
                $mail = new Mail\Message();
                $mail->setBody("<a href='http://calendar.local.fi/register/verify?password=$password'>active ur account</a>");
                $mail->setFrom('somebody@example.com', 'Some Sender');
                $mail->addTo('linyusos@gmail.com', 'Some Recipient');
                $mail->setSubject('TestSubject');
                $transport = new Mail\Transport\Sendmail('-freturn_to_me@example.com');
                $transport->send($mail);             
            }
        }
        
        
        return new ViewModel(array(
                    'form' => $form,
                    'messages' => $this->flashmessenger()->getMessages()
                ));
    }
    
    public function verifyAction(){
        
        
        return new ViewModel(array(
                    
                ));
        
    }

}