<?php

defined('_JEXEC') or die('You are not allowed to directly access this file');

require_once dirname(__FILE__) . '/lessc.inc.php';

class BuildBootstrap extends lessc
{
	static function getInstance()
	{
		static $instance = null;

		if ($instance === null)
		{
			$instance = new Wright;
		}

		return $instance;
	}

	function start()
	{
		jimport('joomla.filesystem.file');
		jimport('joomla.filesystem.folder');

		$document = JFactory::getDocument();

		$less_path = JPATH_THEMES . '/' . $document->template . '/less';

		// Check rebuild less
		$rebuild = false;

		if (is_file(JPATH_THEMES . '/' . $document->template . '/css/style.css'))
		{
			$cachetime = filemtime(JPATH_THEMES . '/' . $document->template . '/css/style.css');

			$files = JFolder::files($less_path, '.less', true, true);

			if (count($files) > 0)
			{
				foreach ($files as $file)
				{
					if (filemtime($file) > $cachetime)
					{
						$rebuild = true;
						break;
					}
				}
			}
		}
		else
		{
			$rebuild = true;
		}

		// Build LESS
		if ($rebuild)
		{
			// Get column configuration
			$left_columns = 1;

			if ($document->countModules('sidebar1') == 0)
			{
				$left_columns = 0;
			}

			$right_columns = 1;

			if ($document->countModules('sidebar2') == 0)
			{
				$right_columns = 0;
			}

			$this->setFormatter("compressed");

			if (is_file(JPATH_THEMES . '/' . $document->template . '/css/style.css'))
			{
				unlink(JPATH_THEMES . '/' . $document->template . '/css/style.css');
			}

			$df =  dirname(__FILE__) . '/less/build.less';

			$ds = '@import "../../../less/variables.less"; ';
			$ds .= '@import "../less/bootstrap.less"; ';
			$ds .= '@import "../less/typography.less"; ';
			$ds .= '@import "../../../less/template.less"; ';

			file_put_contents($df, $ds);

			$this->compileFile($df, JPATH_THEMES . '/' . $document->template . '/css/style.css');

			unlink($df);
		}
	}
}
