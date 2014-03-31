<?php

class Users_Model_Users
{
    protected $_id;
    protected $_name;
    protected $_password;
    protected $_email;
    protected $_date_of_birth;
    protected $_date_of_activate;
    protected $_avatar;
    protected $_active;
    protected $_role;

    public function __construct(array $options = null)
    {
        if(is_array($options))
        {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid User property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid User property');
        }
        return $this->$method();
    }

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setName($name)
    {
        $this->_name = (string) $name;
        return $this;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function setPassword($password)
    {
        $this->_password = (string) $password;
        return $this;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function setEmail($email)
    {
        $this->_email = (string) $email;
        return $this;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function setDateOfBirth($DateOfBirth)
    {
        $this->_date_of_birth = $DateOfBirth;
        return $this;
    }

    public function getDateOfBirth()
    {
        return $this->_date_of_birth;
    }

    public function setDateOfActivate($DateOfActivate)
    {
        $this->_date_of_activate = $DateOfActivate;
        return $this;
    }

    public function getDateOfActivate()
    {
        return $this->_date_of_activate;
    }

    public function setAvatar($avatar)
    {
        $this->_avatar = $avatar;
        return $this;
    }

    public function getAvatar()
    {
        return $this->_avatar;
    }

    public function setActive($active)
    {
        $this->_active = $active;
        return $this;
    }

    public function getActive()
    {
        return $this->_active;
    }

    public function setRole($role)
    {
        $this->_role = $role;
        return $this;
    }

    public function getRole()
    {
        return $this->_role;
    }

}

