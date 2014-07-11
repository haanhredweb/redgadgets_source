<?php // $Id: datetime.php 19 2010-08-03 01:24:09Z jeremy $
defined('_JEXEC') or die('Restricted access');

jimport('joomla.html.html');
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

class JFormFieldModules extends JFormFieldList
{
    public $type = 'Modules';

    protected function getOptions()
    {
        // Initialize variables.
        $options = array();

        $db = JFactory::getDbo();

        $query = $db->getQuery(true);
        $query->select('m.id, m.title, m.position');
        $query->from('#__modules AS m');
        $query->where('m.client_id = 0');
        $query->where('m.published <> -2');
        $query->order('m.title, m.ordering');

        // Set the query
        $db->setQuery($query);
        $items = $db->loadObjectList();

        foreach ($items as $item)
        {
            $val	= $item->id;
            $text	= $item->title . ' (' . $item->position . ')';
            $options[] = JHTML::_('select.option', $val, JText::_($text));
        }

        return $options;
    }
}
