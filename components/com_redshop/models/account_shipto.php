<?php
/**
 * @package     RedSHOP.Frontend
 * @subpackage  Model
 *
 * @copyright   Copyright (C) 2005 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;

JLoader::import('joomla.application.component.model');

/**
 * Class account_shiptoModelaccount_shipto
 *
 * @package     RedSHOP.Frontend
 * @subpackage  Model
 * @since       1.0
 */
class Account_shiptoModelaccount_shipto extends JModel
{
	public $_id = null;

	public $_data = null;

	public $_table_prefix = null;

	public function __construct()
	{
		parent::__construct();

		$this->_table_prefix = '#__redshop_';
		$infoid              = JRequest::getInt('infoid');

		$this->setId($infoid);
	}

	public function setId($id)
	{
		$this->_id   = $id;
		$this->_data = null;
	}

	public function &getData()
	{
		if (!$this->_loadData())
		{
			$this->_initData();
		}

		return $this->_data;
	}

	public function _initData()
	{
		if (empty($this->_data))
		{
			$detail                = new stdClass;
			$detail->users_info_id = 0;
			$detail->user_id       = 0;
			$detail->firstname     = null;
			$detail->lastname      = null;
			$detail->company_name  = null;
			$detail->address       = null;
			$detail->state_code    = null;
			$detail->country_code  = null;
			$detail->city          = null;
			$detail->zipcode       = null;
			$detail->phone         = 0;
			$this->_data           = $detail;

			return (boolean) $this->_data;
		}

		return true;
	}

	public function _loadData($users_info_id = 0)
	{
		if ($users_info_id)
		{
			$query = 'SELECT * FROM ' . $this->_table_prefix . 'users_info WHERE users_info_id = ' . (int) $users_info_id;
			$this->_db->setQuery($query);
			$list = $this->_db->loadObject();

			return $list;
		}

		if (empty($this->_data))
		{
			$query = 'SELECT * FROM ' . $this->_table_prefix . 'users_info WHERE users_info_id = ' . (int) $this->_id;
			$this->_db->setQuery($query);
			$this->_data = $this->_db->loadObject();

			return $this->_data;
		}

		return true;
	}

	public function delete($cid = array())
	{
		if (count($cid))
		{
			// Sanitise ids
			JArrayHelper::toInteger($cid);

			$cids  = implode(',', $cid);
			$query = 'DELETE FROM ' . $this->_table_prefix . 'users_info WHERE users_info_id IN ( ' . $cids . ' )';
			$this->_db->setQuery($query);

			if (!$this->_db->query())
			{
				$this->setError($this->_db->getErrorMsg());

				return false;
			}
		}

		return true;
	}

	public function store($post)
	{
		$userhelper = new rsUserhelper;

		$post['user_email'] = $post['email1'] = $post['email'];
		$reduser            = $userhelper->storeRedshopUserShipping($post);

		return $reduser;
	}
}
