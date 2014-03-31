<?php

class Users_Model_UsersMapper
{
    protected $_dbTable;

    public function setDbTable($dbTable)
    {
        if(is_string($dbTable))
        {
            $dbTable = new $dbTable();
        }

        if(!$dbTable instanceof Zend_Db_Table_Abstract)
        {
            throw new Exception('Invalid table data gateway provided');
        }

        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if(null === $this->_dbTable)
        {
            $this->setDbTable('Users_Model_DbTable_Users');
        }
        return $this->_dbTable;
    }

    public function save(Users_Model_Users $user)
    {
        $data = array();
        if($user->getName())
        {
            $data['name'] = $user->getName();
        }
        if($user->getPassword())
        {
            $data['password'] = md5($user->getPassword());
        }
        if($user->getEmail())
        {
            $data['email'] = $user->getEmail();
        }
        if($user->getDateOfBirth())
        {
            $data['date_of_birth'] = $user->getDateOfBirth();
        }
        if($user->getAvatar())
        {
            $data['avatar'] = $user->getAvatar();
        }
        if($user->getActive())
        {
            $data['active'] = $user->getActive();
        }
        if($user->getRole())
        {
            $data['role'] = $user->getRole();
        }
        $data['date_of_activate'] = date('Y-m-d H:i:s');

        if(null === ($id = $user->getId()))
        {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id, Users_Model_Users $user)
    {
        $result = $this->getDbTable()->find($id);
        if(0 ==count($result))
        {
            return;
        }
        $row = $result->current();
        $user->setId($row->id)
            ->setName($row->name)
            ->setPassword($row->password)
            ->setEmail($row->email)
            ->setDateOfBirth($row->date_of_birth)
            ->setDateOfActivate($row->date_of_activate)
            ->setAvatar($row->avatar)
            ->setActive($row->active)
            ->setRole($row->role);
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries = array();
        foreach($resultSet as $row) {
            $entry = new Users_Model_Users();
            $entry->setId($row->id)
                ->setName($row->name)
                ->setPassword($row->password)
                ->setEmail($row->email)
                ->setDateOfBirth($row->date_of_birth)
                ->setDateOfActivate($row->date_of_activate)
                ->setAvatar($row->avatar)
                ->setActive($row->active)
                ->setRole($row->role);
            $entries[] = $entry;
        }
        return $entries;
    }

}

