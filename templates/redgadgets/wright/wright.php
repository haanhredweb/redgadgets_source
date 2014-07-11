<?php
/**
 * @package    RedCOMPONENT.Template.Framework.
 *
 * @copyright  redCOMPONENT 2013 All Rights Reserved.
 *
 */

defined('_JEXEC') or die('You are not allowed to directly access this file');

if (version_compare(JVERSION, '3.0', 'lt'))
{
	// Check for PHP 5.2.4 if Joomla < 3.0
	if (version_compare(PHP_VERSION, '5.2.4', 'lt'))
	{
		print 'You are using an out of date version of PHP, version ' . PHP_VERSION . ' and Joomla 2.5 requires PHP 5.2.4 or greater. Please contact your host to use PHP 5.2.4 or greater (Joomla 5.3+ recommended).
			<br />Please check Joomla requirements in <a href="http://www.joomla.org/technical-requirements.html">http://www.joomla.org/technical-requirements.html</a>';
		die();
	}
}
else
{
	// Check for PHP 5.3.1 if Joomla >= 3.0
	if (version_compare(PHP_VERSION, '5.3.1', 'lt'))
	{
		print 'You are using an out of date version of PHP, version ' . PHP_VERSION . ' and Joomla 3.x requires PHP 5.3.1 or greater. Please contact your host to use PHP 5.3.1 or greater.
			<br />Please check Joomla requirements in <a href="http://www.joomla.org/technical-requirements.html">http://www.joomla.org/technical-requirements.html</a>';
		die();
	}
}

// Includes WrightTemplateBase class for customizations to the template
require_once dirname(__FILE__) . '/template/wrighttemplatebase.php';

// Mobile Detect
require_once dirname(__FILE__) . '/includes/mobile_detect.php';

// Build LESS via PHP
require_once dirname(__FILE__) . '/build/build.php';

class Wright
{
	public $template;

	public $document;

	public $adapter;

	public $params;

	public $baseurl;

	public $author;

	public $browser;

	public $revision = "1.2";

	public $language;

	private $loadBootstrap = false;

	private $_jsScripts = array();

	private $_jsDeclarations = array();

	private $_cssStyles = array();

	// Urls
	private $_urlTemplate = null;

	private $_urlWright = null;

	private $_urlJS = null;


	function Wright()
	{
		// Initialize properties
		$document = JFactory::getDocument();
		$app = JFactory::getApplication();
		$this->document = $document;
		$this->params = $document->params;
		$this->baseurl = $document->baseurl;
		$this->language = $document->language;
		$this->browser = new WMobile_Detect;

		// Urls
		$this->_urlTemplate = JURI::root(true) . '/templates/' . $this->document->template;
		$this->_urlWright = $this->_urlTemplate . '/wright';
		$this->_urlFontAwesome = $this->_urlWright . '/fontawesome';
		$this->_urlJS = $this->_urlWright . '/js';

		// Versions under 3.0 must load bootstrap
		if (version_compare(JVERSION, '3.0', 'lt'))
		{
			$this->loadBootstrap = true;
		}

		$this->author = simplexml_load_file(JPATH_BASE . '/templates/' . $this->document->template . '/templateDetails.xml')->author;

		if (is_file(JPATH_THEMES . '/' . $document->template . '/functions.php'))
		{
			include_once JPATH_THEMES . '/' . $document->template . '/functions.php';
		}

		// Get our template for further parsing, if custom file is found
		// it will use it instead of the default file
		$path = JPATH_THEMES . '/' . $document->template . '/' . 'template.php';
		$menu = $app->getMenu();

		// If homepage, load up home.php if found, or load custom.php if found
		$lang = JFactory::getLanguage();

		if ($menu->getActive() == $menu->getDefault($lang->getTag()) && is_file(JPATH_THEMES . '/' . $document->template . '/home.php'))
		{
			$path = JPATH_THEMES . '/' . $document->template . '/home.php';
		}
		elseif (is_file(JPATH_THEMES . '/' . $document->template . '/custom.php'))
		{
			$path = JPATH_THEMES . '/' . $document->template . '/custom.php';
		}

		$build = new BuildBootstrap;
		$build->start();

		// Include our file and capture buffer
		ob_start();
		include $path;
		$this->template = ob_get_contents();
		ob_end_clean();
	}

	static function getInstance()
	{
		static $instance = null;

		if ($instance === null)
		{
			$instance = new Wright;
		}

		return $instance;
	}

	public function display()
	{
		// Setup the header
		$this->header();

		// Parse by platform
		$this->platform();

		// Parse by doctype
		$this->doctype();

		print trim($this->template);

		return true;
	}

	public function header()
	{
		JHtml::_('behavior.framework', true);

		// Load jQuery ?
		if ($this->loadBootstrap && $loadJquery = $this->document->params->get('jquery', 0))
		{
			switch ($loadJquery)
			{
				// Load jQuery locally
				case 1:
					$jquery = $this->_urlJS . '/jquery.min.js';
					break;

				// Load jQuery from Google
				default:
					$jquery = 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js';
					break;
			}

			$this->document->addScript($jquery);
			$this->document->addScript($this->_urlJS . '/jquery-migrate.min.js');

			// Ensure that jQuery loads in noConflict mode to avoid mootools conflicts
			$this->document->addScriptDeclaration('jQuery.noConflict();');
		}

		// Load bootstrap JS
		$this->addJSScript($this->_urlJS . '/bootstrap.min.js', true);

		$this->addJSScript($this->_urlJS . '/utils.js');

		if ($this->document->params->get('stickyFooter', 1))
		{
			$this->addJSScript($this->_urlJS . '/stickyfooter.js');
		}

		// Build css
		$this->_cssStyles = $this->loadCSSList();
	}

	private function addCSSToHead($styles)
	{
		foreach ($styles as $folder => $files)
		{
			if (count($files))
			{
				foreach ($files as $style)
				{
					if ($folder == 'fontawesome')
					{
						$sheet = $this->_urlFontAwesome . '/css/' . $style;
					}
					else
					{
						$sheet = JURI::root() . 'templates/' . $this->document->template . '/css/' . $style;
					}

					$this->document->addStyleSheet($sheet);
				}
			}
		}
	}

	public function generateCSS()
	{
		$css = "\n";
		$styles = $this->_cssStyles;

		foreach ($styles as $folder => $files)
		{
			if (count($files))
			{
				foreach ($files as $style)
				{
					if ($folder == 'fontawesome')
					{
						$sheet = $this->_urlFontAwesome . '/css/' . $style;
					}
					else
					{
						$sheet = JURI::root() . 'templates/' . $this->document->template . '/css/' . $style;
					}

					$css .= '<link rel="stylesheet" href="' . $sheet . '" type="text/css" />' . "\n";
				}
			}
		}

		return $css;
	}

	private function loadCSSList()
	{
		jimport('joomla.filesystem.file');
		jimport('joomla.filesystem.folder');
		jimport('joomla.environment.browser');

		$browser = JBrowser::getInstance();

		$version = explode('.', JVERSION);
		$version = $version[0];

		if (is_file(JPATH_THEMES . '/' . $this->document->template . '/css/style.css'))
		{
			$styles['template'][] = 'style.css';
		}

		if ($this->document->params->get('responsive', 1) && is_file(JPATH_THEMES . '/' . $this->document->template . '/css/style-responsive.css'))
		{
			$styles['template'][] = 'style-responsive.css';
		}

		// Add some stuff for lovely IE if needed
		if ($browser->getBrowser() == 'msie')
		{
			// Switch to allow specific versions of IE to have additional sheets
			$major = $browser->getMajor();

			if (is_file(JPATH_THEMES . '/' . $this->document->template . '/css/ie.css'))
			{
				$styles['ie'][] = 'ie.css';
			}

			switch ($major)
			{
				case '7':
					$styles['fontawesome'][] = 'font-awesome-ie7.min.css';

				// Does not break for leaving defaults
				default:
					if (is_file(JPATH_THEMES . '/' . $this->document->template . '/css/ie' . $major . '.css'))
					{
						$styles['ie'][] = 'ie' . $major . '.css';
					}
			}

			if ((int) $major <= 9)
			{
				$this->document->addScript($this->_urlJS . '/html5shiv.js');
			}
		}

		if ($this->document->direction == 'rtl' && is_file(JPATH_THEMES . '/' . $this->document->template . '/css/rtl.css'))
		{
			$styles['template'][] = 'rtl.css';
		}

		if (is_file(JPATH_THEMES . '/' . $this->document->template . '/css/editor.css'))
		{
			$styles['template'][] = 'editor.css';
		}

		// Include FontAwesome
		$styles['fontawesome'] = Array('font-awesome.min.css');

		return $styles;
	}

	private function doctype()
	{
		require dirname(__FILE__) . '/doctypes/' . $this->document->params->get('doctype', 'html5') . '.php';
		$adapter_name = 'HtmlAdapter' . $this->document->params->get('doctype', 'html5');
		$adapter = new $adapter_name($this->document->params);

		foreach ($adapter->getTags() as $name => $regex)
		{
			$action = 'get' . ucfirst($name);
			$this->template = preg_replace_callback($regex, array($adapter, $action), $this->template);
		}

		// Reorder columns based on the order
		$this->reorderContent();

		$this->template = str_replace('__cols__', $adapter->cols, $this->template);
	}

	/**
	 * Searches for platform specific tags, and has a callback function to
	 * handle the processing of each match
	 *
	 * @access private
	 */
	private function platform()
	{
		// Get Joomla's version to get proper platform
		jimport('joomla.version');
		$version = new JVersion;
		$file = ucfirst(str_replace('.', '', $version->RELEASE));

		// Load up the proper adapter
		require_once dirname(__FILE__) . '/adapters/joomla.php';
		$this->adapter = new WrightAdapterJoomla($file);
		$this->template = preg_replace_callback("/<w:(.*)\/>/i", array(get_class($this), 'platformTags'), $this->template);

		return true;
	}

	private function platformTags($matches)
	{
		// Grab first match since there should only be one
		$match = $matches[1];

		// @TODO Craft a regex to better handle syntax possibilities
		if (strpos($match, '='))
		{
			$tag = substr($match, 0, strpos($match, ' '));
			$list = explode('" ', substr($match, trim(strpos($match, ' ') + 1)));

			$attributes = array();

			foreach ($list as $item)
			{
				if (strlen($item) > strrchr($item, '"'))
				{
					$name = substr($item, 0, strpos($item, '='));
					$value = substr($item, strpos($item, '"') + 1);
					$attributes[$name] = $value;
				}
			}

			$config = array(trim($tag) => $attributes);
		}
		else
		{
			$config = array(trim($match) => array());
		}

		return $this->adapter->get($config);
	}

	// Borrowed from JDocumentHtml for compatibility
	function countModules($condition)
	{
		jimport('joomla.application.module.helper');

		$result = '';
		$words = explode(' ', $condition);

		for ($i = 0; $i < count($words); $i += 2)
		{
			// Odd parts (modules)
			$name = strtolower($words[$i]);
			$words[$i] = ((isset($this->_buffer['modules'][$name])) && ($this->_buffer['modules'][$name] === false)) ? 0
				: count(JModuleHelper::getModules($name));
		}

		$str = 'return ' . implode(' ', $words) . ';';

		return eval($str);
	}

	/**
	 * Reorder main content / sidebars in the order selected by the user
	 */
	private function reorderContent()
	{
		/**
		 * regular patterns to identify every column
		 * Added id to avoid the annoying bug that avoids the user to use HTML5 tags
		 */
		$patterns = array('sidebar1' => '/<aside(.*)id="sidebar1">(.*)<\/aside>/isU', 'sidebar2' => '/<aside(.*)id="sidebar2">(.*)<\/aside>/isU',
			'main' => '/<section(.*)id="main"(.*)>(.*)<\/section>/isU');

		// Only this columns
		$allowedColNames = array_keys($patterns);
		$reorderedCols = array();
		$reorderedContent = '';

		// Get column configuration
		$columnCfg = $this->document->params->get('columns', 'sidebar1:3;main:6;sidebar2:3');
		$colStrings = explode(';', $columnCfg);

		if ($colStrings)
		{
			foreach ($colStrings as $colString)
			{
				list($colName, $colWidth) = explode(':', $colString);

				if (in_array($colName, $allowedColNames))
				{
					$reorderedCols[] = $colName;
				}
			}
		}

		// Get column contents with regular expressions
		$patternFound = false;

		foreach ($patterns as $column => $pattern)
		{
			// Save the content into a variable
			$$column = null;

			if (preg_match($pattern, $this->template, $matches))
			{
				$$column = $matches[0];

				$replacement = '';

				// Replace first column found with string '##wricolumns##' to reorder content later
				if (!$patternFound)
				{
					$replacement = '##wricolumns##';
					$patternFound = true;
				}

				$this->template = preg_replace($pattern, $replacement, $this->template);
			}
		}

		// If columns reordered and column content found replace contents
		if ($reorderedCols && $patternFound)
		{
			foreach ($reorderedCols as $colName)
			{
				if (!is_null($$colName))
				{
					$reorderedContent .= $$colName;
				}
			}
		}

		$this->template = preg_replace('/##wricolumns##/isU', $reorderedContent, $this->template);

		return $reorderedContent;
	}

	public function addJSScript($url, $first = false)
	{
		if ($first)
		{
			array_unshift($this->_jsScripts, $url);
		}
		else
		{
			$this->_jsScripts[] = $url;
		}

	}

	private function addJSScriptDeclaration($script)
	{
		$this->_jsDeclarations[] = $script;
	}

	public function generateJS()
	{
		$javascriptBottom = ($this->document->params->get('javascriptBottom', 1) == 1 ? true : false);

		$script = "\n";

		if ($this->_jsDeclarations)
		{
			$dec = "";



			foreach ($this->_jsDeclarations as $js)
			{
				if ($javascriptBottom)
				{
					$dec .= "$js\n";
				}
				else
				{
					$this->document->addScript($js);
				}
			}

			if (!empty($dec))
			{
				$script .= "<script type='text/javascript'>\n" . $dec . "</script>\n";
			}
		}

		if ($this->_jsScripts)
		{
			foreach ($this->_jsScripts as $js)
			{
				if ($javascriptBottom)
				{
					$script .= "<script src='$js' type='text/javascript'></script>\n";
				}
				else
				{
					$this->document->addScript($js);
				}
			}
		}

		return $script;
	}
}
