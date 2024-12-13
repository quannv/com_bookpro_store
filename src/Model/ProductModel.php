<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_banners
 *
 * @copyright   (C) 2008 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joombooking\Component\Bookpro\Administrator\Model;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\Form;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Table\Table;
use Joomla\CMS\Table\TableInterface;
use Joomla\Database\ParameterType;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Banner model.
 *
 * @since  1.6
 */
class ProductModel extends AdminModel
{

    /**
     * The prefix to use with controller messages.
     *
     * @var    string
     * @since  1.6
     */
    protected $text_prefix = 'COM_BOOKOPRO_ROUTE';

    /**
     * The type alias for this content type.
     *
     * @var    string
     * @since  3.2
     */
    public $typeAlias = 'com_bookpro.product';




    /**
     * Method to get the record form.
     *
     * @param   array    $data      Data for the form. [optional]
     * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not. [optional]
     *
     * @return  Form|boolean  A Form object on success, false on failure
     *
     * @since   1.6
     */
    public function getForm($data = [], $loadData = true)
    {
        // Get the form.
        $form = $this->loadForm('com_bookpro.product', 'product', ['control' => 'jform', 'load_data' => $loadData]);

        if (empty($form)) {
            return false;
        }

        // Modify the form based on access controls.
        if (!$this->canEditState((object) $data)) {
            // Disable fields for display.
            $form->setFieldAttribute('ordering', 'disabled', 'true');
            $form->setFieldAttribute('publish_up', 'disabled', 'true');
            $form->setFieldAttribute('publish_down', 'disabled', 'true');
            $form->setFieldAttribute('state', 'disabled', 'true');

            // Disable fields while saving.
            // The controller has already verified this is a record you can edit.
            $form->setFieldAttribute('ordering', 'filter', 'unset');
            $form->setFieldAttribute('publish_up', 'filter', 'unset');
            $form->setFieldAttribute('publish_down', 'filter', 'unset');
            $form->setFieldAttribute('state', 'filter', 'unset');
        }


        return $form;
    }




    /**
     * Method to get the data that should be injected in the form.
     *
     * @return  mixed  The data for the form.
     *
     * @since   1.6
     */
    protected function loadFormData()
    {
        // Check the session for previously entered form data.
        $app  = Factory::getApplication();
        $data = $app->getUserState('com_bookpro.edit.product.data', []);

        if (empty($data)) {
            $data = $this->getItem();

            // Prime some default values.
            if ($this->getState('product.id') == 0) {
                $filters     = (array) $app->getUserState('com_bookpro.products.filter');
            }
        }

        $this->preprocessData('com_bookpro.product', $data);

        return $data;
    }




    /**
     * Prepare and sanitise the table prior to saving.
     *
     * @param   Table  $table  A Table object.
     *
     * @return  void
     *
     * @since   1.6
     */
    protected function prepareTable($table)
    {
        $date = Factory::getDate();
        $user = $this->getCurrentUser();

        if (empty($table->id)) {
            // Set the values



        } else {
        }

        // Increment the content version number.

    }

    /**
     * Allows preprocessing of the Form object.
     *
     * @param   Form    $form   The form object
     * @param   array   $data   The data to be merged into the form object
     * @param   string  $group  The plugin group to be executed
     *
     * @return  void
     *
     * @since    3.6.1
     */
    protected function preprocessForm(Form $form, $data, $group = 'content')
    {


        parent::preprocessForm($form, $data, $group);
    }

    /**
     * Method to save the form data.
     *
     * @param   array  $data  The form data.
     *
     * @return  boolean  True on success.
     *
     * @since   1.6
     */
    public function save($data)
    {
        $input = Factory::getApplication()->getInput();


        return parent::save($data);
    }

}
