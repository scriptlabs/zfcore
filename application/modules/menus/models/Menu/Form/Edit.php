<?php
/**
 * @see Zend_Dojo_Form
 */
require_once 'Zend/Dojo/Form.php';

/**
 * Menus_Model_Menu_Form_Edit
 *
 * @category    Application
 * @package     Model_Menu
 * @subpackage  Form
 *
 * @author      Valeriu Baleyko <baleyko.v.v@gmail.com>
 * @copyright   Copyright (c) 2010 NIX Solutions (http://www.nixsolutions.com)
 */
class Menus_Model_Menu_Form_Edit extends Menus_Model_Menu_Form_Create
{

        public function init()
        {
            parent::init();

            $this->setName('menuItemEditForm')
                    ->addElement(new Zend_Form_Element_Hidden('id'));

            return $this;
        }

    public function _submit()
    {
            //$this->setLegend('Menu Item Edit Form');
            return parent::_submit()->setLabel('Save');
    }
}
