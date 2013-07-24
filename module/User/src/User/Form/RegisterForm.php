<?php

namespace User\Form;

use Zend\Form\Form;

class RegisterForm extends Form {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('register');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));
        $this->add(array(
            'name' => 'username',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'username',
            ),
        ));
        $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'password',
            ),
        ));
        $this->add(array(            
            'name' => 'email',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'email',
            ),
        ));
        $this->add(array(
            'name' => 'status',
            'attributes' => array(
                'type' => 'Checkbox',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'submit',
                'id' => 'submitbutton',
            ),
        ));
    }

}