<?php
class Books_BooksController extends Zend_Controller_Action
{

    /*public function init()
    {
        $this ->_helper->AjaxContext()
            ->addActionContext('index','json')
            ->initContext('json');
    }*/

    public function indexAction()
    {
        $mapper = new Books_Model_BooksMapper();
        $start = 0;
        if(isset($_POST['start']) && !empty($_POST['start']))
        {
            $this->view->books = $mapper->getGroupBooks($_POST['start']);
        } else {
            $this->view->books = $mapper->getGroupBooks($start);
        }

    }

    public function addAction()
    {
        $form = new Books_Form_Add();
        if ($this->getRequest()->isPost())
        {
            if ($form->isValid($_POST))
            {
                $data = $form->getValues();
                $bookMapper = new Books_Model_BooksMapper();
                $newBook = new Books_Model_Books($data);
                $LastBookId = $bookMapper->getLastId();
                $newBook->setBookImage($LastBookId);
                $bookMapper->save($newBook);
                $this->redirect('books/books/index');
            } else {
                $FormErrors = $form->getErrors();
                foreach($FormErrors as $FormElement => $error) {
                    if(!empty($error)) {
                        $this->view->ValidateError = $FormElement;
                        break;
                    }
                }
            }
        } else {
            $this->view->form = $form;
        }
    }

    public function genreAction()
    {
        if($this->getRequest()->isXmlHttpRequest()) {
           $mapper = new Books_Model_BooksMapper();
           $books = $mapper->getByGenre($this->getRequest()->getParam('genre'));
           $this->view->books = $books;
            /*$request = $this->getRequest();
            $res = Zend_Json::decode($request, Zend_Json::TYPE_OBJECT);
            $this->view->books = $res;*/
        }
    }

    public function showAction()
    {
        if(Zend_Session::sessionExists() && Zend_Session::namespaceIsset('User'))
        {
            $booksMapper = new Books_Model_BooksMapper();
            $storage = Zend_Session::namespaceGet('User');
            $ownerData = $storage['storage'];
            $ownerId = $ownerData->id;
            $booksByOwnerId = $booksMapper->getByOwner($ownerId);
            $this->view->user = $ownerData;
            $this->view->books = $booksByOwnerId;
        }

    }

    public function testAction()
    {

    }

    public function animateAction()
    {

    }

    public function ajaxAction()
    {

    }
}