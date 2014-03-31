<?php
class Johnny_Controller_Plugin_Webinit extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch()
    {
        $controllerName = strtolower($this->_request->getControllerName());
        $actionName = strtolower($this->_request->getActionName());

        $view = Zend_Layout::getMvcInstance()->getView();

        if(file_exists(APPLICATION_CSS_FOLDER.$controllerName.'/'.$actionName.'.css'))
        {
            $view->assign('cssControllerAction', $controllerName.'/'.$actionName.'.css');
        }

        if(file_exists(APPLICATION_JS_FOLDER.$controllerName.'/'.$actionName.'.js'))
        {
            $view->assign('jsControllerAction', $controllerName.'/'.$actionName.'.js');
        }
    }
}