<?php
class Users_Bootstrap extends Zend_Application_Module_Bootstrap
{
    protected function _initSession()
    {
        Zend_Session::start();
    }
}