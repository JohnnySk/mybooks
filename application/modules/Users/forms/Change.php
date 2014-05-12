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
        ));

        $dateRegex = new Zend_Validate_Regex('/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/');
        $dateRegex->setMessages(array(
            Zend_Validate_Regex::NOT_MATCH => 'Дата должна быть в формате: гггг.мм.дд'
        ));

        $dateOfBirth->addValidator($dateRegex);

        $hidden = $this->createElement('hidden', 'MAX_FILE_SIZE', array(
            'value' => '500000'
        ));

        $avatar = $this->createElement('file', 'avatar_image', array(
            'label' => 'Загрузить новый аватар: '
        ));

        $avatarSize = new Zend_Validate_File_Size(array('min' => 1000, 'max' => 500000));
        $avatarSize->setMessages(array(
            Zend_Validate_File_Size::NOT_FOUND => 'Файл не найден!',
            Zend_Validate_File_Size::TOO_SMALL => 'Файл слишком мал!',
            Zend_Validate_File_Size::TOO_BIG   => 'Файл слишком большой!'
        ));

        $avatar->addValidator($avatarSize);

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