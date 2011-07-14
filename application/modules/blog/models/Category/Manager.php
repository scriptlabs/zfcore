<?php
/**
 * Blog_Model_Category_Manager
 *
 * @version $Id$
 */
class Blog_Model_Category_Manager extends Core_Categories_Manager
{
    const CATEGORY_ALIAS = 'blog';

    /**
     * @var Categories_Model_Categories
     */
    protected $_root;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setDbTable(new Categories_Model_Categories_Table());
    }

    /**
     * Get blog root category
     *
     * @return Categories_Model_Categories
     */
    public function getRoot()
    {
        if (!$this->_root) {
            $this->_root = $this->getDbTable()->getByAlias(self::CATEGORY_ALIAS);
        }
        return $this->_root;
    }

    /**
     * Get by id
     *
     * @param integer $id
     * @return Zend_Db_Table_Row_Abstract
     */
    public function getById($id)
    {
        $separator = Categories_Model_Categories::PATH_SEPARATOR;

        $select = $this->getDbTable()->select();
        $select->where('id=?', $id)
        ->where('path LIKE ?', self::CATEGORY_ALIAS . $separator . '%');
        return $this->getDbTable()->fetchRow($select);
    }

    /**
     * Get by alias
     *
     * @param string $alias
     * @return Zend_Db_Table_Row_Abstract
     */
    public function getByAlias($alias)
    {
        $separator = Categories_Model_Categories::PATH_SEPARATOR;

        $select = $this->getDbTable()->select();
        $select->where('alias=?', $alias)
               ->where('path LIKE ?', self::CATEGORY_ALIAS . $separator . '%');
        return $this->getDbTable()->fetchRow($select);
    }

    /**
     * Get categories list
     *
     * @param boolen $fetch
     * @return Zend_Db_Table_Select|Zend_Db_Table_Rowset
     */
    public function getList($fetch = false)
    {
        $separator = Categories_Model_Categories::PATH_SEPARATOR;

        $select = $this->getDbTable()->select();

        $select->where('path LIKE ?', self::CATEGORY_ALIAS . $separator . '%')
               ->order('path');

        if (!$fetch) {
            return $select;
        }
        return $this->getDbTable()->fetchAll($select);
    }
}