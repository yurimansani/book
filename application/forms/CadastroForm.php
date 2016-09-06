<?php

class Application_Form_CadastroForm extends Zend_Form
{

    public function init()
    {


	//---------- Validadores
	$nomeValidator = new Zend_Validate_Alpha(array('allowWhiteSpace' => true));
	//$textoValidator = new Zend_Validate_Regex('/^[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ *\-()#%&.,ºª_]+$/i');
	// ---------------- generos
	$genero = new Zend_Form_Element_Text('', [
	    'label' => 'Genero',
	    'required' => true,
	    'attribs' => array('required' => ''),
	    'validators' => array(array('StringLength', false, array(3, 50)),)
		]
	);
	// -----------------  Adicinando Validadores
	$genero->addValidator($nomeValidator, true);
	//------------------ Adicionando elementos
	$this->addElement($genero);
    }

    public function setLabelElementRequired()
    {
	foreach ($this->getElements() as $element)
	{
	    if ($element->isRequired())
	    {
		$element->setLabel($element->getLabel() . ' *');
	    }
	}
    }

}
