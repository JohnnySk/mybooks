<?php

class Books_Model_BooksMapper
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
        if($this->_dbTable == null)
        {
            $this->setDbTable('Books_Model_DbTable_Books');
        }
        return $this->_dbTable;
    }

    public function save(Books_Model_Books $book)
    {
        $data = array();
        if($book->getTitle())
        {
            $data['title'] = $book->getTitle();
        }
        if($book->getAuthor())
        {
            $data['author'] = $book->getAuthor();
        }
        if($book->getPublication())
        {
            $data['publication'] = $book->getPublication();
        }
        if($book->getGenre())
        {
            $data['genre'] = $book->getGenre();
        }
        if($book->getPublication_date())
        {
            $data['publication_date'] = $book->getPublication_date();
        }
        if($book->getOwner_id())
        {
            $data['owner_id'] = $book->getOwner_id();
        }
        if($book->getPath())
        {
            $data['path'] = $book->getPath();
        }
        if($book->getImage())
        {
            $data['image'] = $book->getImage();
        }
        if(null === ($id = $book->getId()))
        {
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id, Books_Model_Books $book)
    {
        $result = $this->getDbTable()->find($id);
        if(0 == count($result))
        {
            return;
        }
        $row = $result->current();
        $book->setId($row->id)
            ->setTitle($row->title)
            ->setAuthor($row->author)
            ->setPublication($row->publication)
            ->setGenre($row->genre)
            ->setPublication_date($row->publication_date)
            ->setOwner_id($row->owner_id)
            ->setPath($row->path)
            ->setImage($row->image);
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries = array();
        foreach($resultSet as $row) {
            $entry = new Books_Model_Books();
            $entry->setId($row->id)
                ->setTitle($row->title)
                ->setAuthor($row->author)
                ->setPublication($row->publication)
                ->setGenre($row->genre)
                ->setPublication_date($row->publication_date)
                ->setOwner_id($row->owner_id)
                ->setPath($row->path)
                ->setImage($row->image);
            $entries[] = $entry;
        }
        return $entries;
    }

    public function getLastId()
    {
        $tableSelect = $this->getDbTable()->select()->from('books', 'id')->order('id DESC')->limit(1);
        $result = $tableSelect->query()->fetch();
        return $result;
    }

    public function getGroupBooks($colRows)
    {
        $tableSelect = $this->getDbTable()->select()->from('books', '*')->order('id DESC')->limit(3, $colRows);
        $resultSet = $tableSelect->query()->fetchAll();
        $entries = array();
        foreach($resultSet as $row) {
            $entry = new Books_Model_Books();
            $entry->setId($row['id'])
                ->setTitle($row['title'])
                ->setAuthor($row['author'])
                ->setPublication($row['publication'])
                ->setGenre($row['genre'])
                ->setPublication_date($row['publication_date'])
                ->setOwner_id($row['owner_id'])
                ->setPath($row['path'])
                ->setImage($row['image']);
            $entries[] = $entry;
        }
        return $entries;
    }

    public function getByGenre($genre)
    {
        $tableSelect = $this->getDbTable()->select()->from('books', '*')->where('genre = ?', $genre)->order('id');
        $resultSet = $tableSelect->query()->fetchAll();
        $books = array();
        foreach($resultSet as $row) {
            $book = new Books_Model_Books();
            $book->setId($row['id'])
                ->setTitle($row['title'])
                ->setAuthor($row['author'])
                ->setPublication($row['publication'])
                ->setGenre($row['genre'])
                ->setPublication_date($row['publication_date'])
                ->setOwner_id($row['owner_id'])
                ->setPath($row['path'])
                ->setImage($row['image']);
            $books[] = $book;
        }
        return $books;
    }

    public function getByOwner($ownerId)
    {
        $tableSelect = $this->getDbTable()->select()->from('books', '*')->where('owner_id = ?', $ownerId)->order('id');
        $resultSet = $tableSelect->query()->fetchAll();
        $books = array();
        foreach($resultSet as $row) {
            $book = new Books_Model_Books();
            $book->setId($row['id'])
                ->setTitle($row['title'])
                ->setAuthor($row['author'])
                ->setPublication($row['publication'])
                ->setGenre($row['genre'])
                ->setPublication_date($row['publication_date'])
                ->setOwner_id($row['owner_id'])
                ->setPath($row['path'])
                ->setImage($row['image']);
            $books[] = $book;
        }
        return $books;
    }
}