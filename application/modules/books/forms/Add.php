<?php
class Books_Form_Add extends Zend_Form
{
    public function init()
    {
        $this->setEnctype('multipart/form-data');
        $this->setMethod('POST');

        $title = $this->createElement('text', 'title', array(
           'label' => 'Название Книги:',
            'required' => true,
        ));
        $StringLength = new Zend_Validate_StringLength(1, 50);
        $StringLength->setMessages(array(
            Zend_Validate_StringLength::TOO_SHORT => 'Строка слишком короткая',
            Zend_Validate_StringLength::TOO_LONG => 'Строка слишком длинная'
        ));

        $title->addValidator($StringLength);

        $author = $this->createElement('text', 'author', array(
           'label' => 'Автор Книги:',
            'required' => true,
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(1,56))
            )
        ));

        $publication = $this->createElement('text', 'publication', array(
            'label' => 'Публикация:',
            'required' => false,
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(1, 56))
            )
        ));

        $genre = $this->createElement('text', 'genre', array(
            'label' => 'Жанр:',
            'required' => false,
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(1,56))
            )
        ));

        $publication_date = $this->createElement('select', 'publication_date', array(
           'label' => 'Год Публикации:',
            'required' => false,
            'multiOptions' => array(
                '1' => '1700',
                '2' => '1800',
                '3' => '1900',
                '4' => '1950',
                '5' => '1951',
                '6' => '1952',
                '7' => '1953',
                '8' => '1954-1970',
                '9' => '1971-1980',
                '10' => '1981-2000',
                '11' => '2001-2009',
                '12' => '2010-2011',
                '13' => '2012-2013',
                '14' => '2014'
            )
        ));

        $hidden = $this->createElement('hidden', 'MAX_FILE_SIZE', array(
           'value' => '500000'
        ));

        $file = $this->createElement('file', 'userFile', array(
           'required' => true
        ));

        $submit = $this->createElement('submit', 'add', array(
           'label' => 'Добавить Книгу',
            'class' => 'btn btn-default'
        ));

        $this->addElements(array(
            $title,
            $author,
            $genre,
            $publication,
            $publication_date,
            $hidden,
            $file,
            $submit
        ));
    }
}