<?php
class Users_Form_Registration extends Zend_Form {

    public function init() {

        $email = $this->createElement('text', 'email', array(
            'label' => 'E-mail(Login):',
            'required' => TRUE,
            'validators' => array(
                array('validator' => 'EmailAddress')
            )
        ));

        $name = $this->createElement('text', 'name', array(
            'label' => 'Name',
            'required' => TRUE
        ));

        $password = $this->createElement('password', 'password', array(
            'label' => 'Password: *',
            'required' => TRUE,
            'validators' => array(
                array('validator' => 'regex', 'options' => '/((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16})/')
            )
        ));

        $confirmPassword = $this->createElement('password', 'confirmPassword', array(
            'label' => 'Confirm Password: *',
            'required' => TRUE
        ));

        $register = $this->createElement('submit', 'Register', array(
            'label' => 'Sign Up'
        ));

        $this->addElements(array(
            $email,
            $name,
            $password,
            $confirmPassword,
            $register
        ));
    }
}