<?php
class Users_UsersController extends Zend_Controller_Action
{

    public function indexAction()
    {
        $this->redirect('Users/users/profile');
    }

    public function loginAction()
    {
        $users = new Users_Model_UsersMapper();
        $users = $users->fetchAll();
        $form = new Users_Form_Login();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($_POST)) {
                $data = $form->getValues();
                for($i=0; $i<count($users); $i++) {
                    if($users[$i]->getEmail() == $data['email'] && $users[$i]->getPassword() == md5($data['password'])) {
                        $storage = new Zend_Auth_Storage_Session('User');
                        $storage->write($users[$i]);
                        $this->redirect('Users/users/profile');
                    } else {
                        $this->view->errorMessage = 'Invalid username or password. Please try again';
                    }
                }
            }
        } else {
            $this->view->form = $form;
        }
    }
    //Old Code.
    /*$auth = Zend_Auth::getInstance();
    $authAdapter = new Zend_Auth_Adapter_DbTable($users->getAdapter(), 'users');
    $authAdapter->setIdentityColumn('username')
        ->setCredentialColumn('password')
        ->setIdentity($data['username'])
        ->setCredential($data['password']);
    $result = $auth->authenticate($authAdapter);
    if ($result->isValid()) {
        $storage = new Zend_Auth_Storage_Session();
        $storage->write($authAdapter->getResultRowObject());
        $this->redirect('Users/users/profile');
    } else {
        $this->view->errorMessage = 'Invalid username or password. Please try again';
    }
}else {
    $this->view->errorMessage = 'Invalid username or password. Please try again';*/

    public function signupAction()
    {
        $users = new Users_Model_UsersMapper();
        $user = $users->fetchAll();
        $form = new Users_Form_Registration();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($_POST)) {
                $data = $form->getValues();
                if ($data['password'] != $data['confirmPassword']) {
                    $this->view->errorMessage = 'Password and confirm password dont \' match';
                    return;
                }
                for($i=0; $i<count($user); $i++) {
                    if($data['email'] == $user[$i]->getEmail()) {
                        $this->view->errorMessage = 'User with this email already registrated in this site.';
                        return;
                    } else {
                        unset($data['confirmPassword']);
                        $data['avatar'] = 'images/avatars/avatar_default.jpg';
                        $newUser = new Users_Model_Users($data);
                        $users->save($newUser);
                        $this->redirect('Users/users/login');
                    }
                }

            } else {
                $formErrors = $form->getErrors();
                foreach($formErrors as $FormElementName => $error) {
                    if($error != null) {
                        $this->view->ValidateError = $FormElementName;
                        $form = new Users_Form_Registration();
                        $this->view->form = $form;
                    }
                }

            }
        } else {
            $this->view->form = $form;
        }
    }
    //Old Code.
    /*if ($users->isUnique($data['username'])) {
        $this->view->errorMessage = 'Name already taken. Please choose another one.';
        return;
    }
    unset($data['confirmPassword']);
    $users->insert($data);
    $this->redirect('Users/users/login');*/

    public function logoutAction()
    {
        $storage = new Zend_Auth_Storage_Session('User');
        $storage->clear();
        $this->redirect('Users/users/login');
    }

    public function profileAction()
    {
        //$storage = new Zend_Auth_Storage_Session('User');
        //$data = $storage->read();
        $data = Zend_Session::namespaceGet('User');
        if (!$data) {
            $this->redirect('Users/users/login');
        }
        $this->view->user = $data['storage'];
    }

    public function changeAction()
    {

    }
}