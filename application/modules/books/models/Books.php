<?php

class Books_Model_Books
{
    protected $_id;
    protected $_title;
    protected $_author;
    protected $_publication;
    protected $_genre;
    protected $_publication_date;
    protected $_owner_id;
    protected $_path;
    protected $_image;
    protected $_errors = array();

    public function __construct(array $options = null)
    {
        if(is_array($options))
        {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value)
    {
        $method = 'set'.$name;
        if('mapper' == $method || !method_exists($this, $method))
        {
            throw new Exception('Invalid object property');
        }
        $this->$method($value);
    }

    public function  __get($name)
    {
        $method = 'get'.$name;
        if('mapper' == $name || !method_exists($this, $method))
        {
            throw new Exception('Invalid object property');
        }
        $this->$method();
    }

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach($options as $key => $value) {
            $method = 'set'.ucfirst($key);
            if(in_array($method, $methods))
            {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function setBookImage($lastBookId)
    {
        if(!empty($_FILES['userFile']['size']))
        {
            $tmpPath = $_FILES['userFile']['tmp_name'];
            $partOfPath = preg_split('/\/[a-zA-Z0-9]+$/', $tmpPath);
            $correctPath = $partOfPath[0].'/'.$_FILES['userFile']['name'];
            $BookImage = new Imagick($correctPath);
            $BookImage->thumbnailimage(200, 0, false);
            $uploadDir = DIR_PUBLIC.'images/books/';
            $uploadFile = $uploadDir.basename($_FILES['userFile']['name']);
            if($BookImage->writeimage($uploadFile))
            {
                $lastBookId['id']+= 1;
                rename($uploadFile, $uploadDir.$lastBookId['id'].'.jpg');
                $newPath = 'images/books/'.$lastBookId['id'].'.jpg';
                $this->setImage($newPath);
            } else {
                $error = 'Не удалось записать изображение!!!';
                $this->setErrors('image', $error);
            }

        } else return null;

    }

    public function setBookFile($lastBookId)
    {
        if(!empty($_FILES['userBook']['size']))
        {
            $uploadDir = DIR_PUBLIC.'books/';
            //variant with MIME-type
            /*switch($_FILES['userBook']['type']) {
                case 'application/pdf':
                    $uploadFile = $uploadDir.$lastBookId.'.pdf';
                    break;
                case 'text/plain':
                    $uploadFile = $uploadDir.$lastBookId.'.txt';
                    break;
                case 'application/epub+zip':
                    $uploadFile = $uploadDir.$lastBookId.'.epub';
                    break;
                case 'application/msword':
                    $uploadFile = $uploadDir.$lastBookId.'.doc';
                    break;
                case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
                    $uploadFile = $uploadDir.$lastBookId.'docx';
                    break;
                case 'image/vnd.djvu ':
                    $uploadFile = $uploadDir.$lastBookId.'.djvu';
                    break;
                case 'application/x-fb2':
                    $uploadFile = $uploadDir.$lastBookId.'.fb2';
                    break;
            }*/
            //variant with cutting extension from original filename
            preg_match('/\.[a-z]+$/', $_FILES['userBook']['name'], $matches);
            $currentExtension = $matches[0];
            $uploadFile = $uploadDir.$lastBookId.$currentExtension;
            if(move_uploaded_file($_FILES['userBook']['tmp_name'], $uploadFile))
            {
                $this->setPath($uploadFile);
            } else {
                $error = 'Ошибка при записи файла книги!!!';
                $this->setErrors('file', $error);
            }
        }
    }

    public function setId($id)
    {
        $this->_id = (int)$id;
        return $this;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setTitle($title)
    {
        $this->_title = (string)$title;
        return $this;
    }

    public function getTitle()
    {
        return $this->_title;
    }

    public function setAuthor($author)
    {
        $this->_author = (string)$author;
        return $this;
    }

    public function getAuthor()
    {
        return $this->_author;
    }

    public function setPublication($publication)
    {
        $this->_publication = (string)$publication;
        return $this;
    }

    public function getPublication()
    {
        return $this->_publication;
    }

    public function setGenre($genre)
    {
        $this->_genre = (string)$genre;
        return $this;
    }

    public function getGenre()
    {
        return $this->_genre;
    }

    public function setPublication_date($publication_date)
    {
        $this->_publication_date = $publication_date;
        return $this;
    }

    public function getPublication_date()
    {
        return $this->_publication_date;
    }

    public function setOwner_id($owner_id)
    {
        $this->_owner_id = $owner_id;
        return $this;
    }

    public function getOwner_id()
    {
        return $this->_owner_id;
    }

    public function setPath($path)
    {
        $this->_path = $path;
        return $this;
    }

    public function getPath()
    {
        return $this->_path;
    }

    public function setImage($image)
    {
        $this->_image = $image;
        return $this;
    }

    public function getImage()
    {
        return $this->_image;
    }

    public function setErrors($key, $error)
    {
        $this->_errors[$key] = $error;
        return $this;
    }

    public function getErrors()
    {
        return $this->_errors;
    }
}