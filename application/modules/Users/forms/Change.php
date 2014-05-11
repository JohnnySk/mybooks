<?php
class Users_Form_Change extends Zend_Form
{

    public function init()
    {
        $this->setEnctype('multipart/form-data');
        $this->setMethod('POST');

        $name = $this->createElement('text', 'name', array(
            'label' => 'Новое имя: ',
        ));
        $nameLength = new Zend_Validate_StringLength(3, 32);
        $nameLength->setMessages(array(
            Zend_Validate_StringLength::TOO_SHORT => 'Строка слишком короткая',
            Zend_Validate_StringLength::TOO_LONG => 'Строка слишком длинная'
        ));

        $name->addValidator($nameLength);

        $dateOfBirth = $this->createElement('text', 'dateOfBirth', array(
            'label' => 'Дата рождения: ',
            'validators' => array(
                array('validator' => 'regex', 'options' => '/^[0-9]{2}\.[0-9]{2}\.[0-9]{4}$/')
            )
        ));

        $hidden = $this->createElement('hidden', 'MAX_FILE_SIZE', array(
            'value' => '500000'
        ));

        $avatar = $this->createElement('file', 'avatar', array(
            'label' => 'Загрузить новый аватар: '
        ));

        $submit = $this->createElement('submit', 'change', array(
            'label' => 'Изменить',
            'class' => 'btn btn-default'
        ));

        $this->addElements(array(
            $name,
            $dateOfBirth,
            $hidden,
            $avatar,
            $submit
        ));

    }
}