<?php

class GenerosController extends Zend_Controller_Action
{

    public function init()
    {
	/* Initialize action controller here */
    }

    public function indexAction()
    {
	
    }

    public function cadastroAction()
    {

	$form = new Application_Form_CadastroForm ();

	$this->view->form = $form;
    }

}
