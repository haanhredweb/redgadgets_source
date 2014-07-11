<?php

class WrightAdapterJoomlaHead
{
	public function render($args)
	{
		$doc = JFactory::getDocument();

		if ($doc->params->get('responsive', 1))
		{
			// Add viewport meta for tablets
			$doc->setMetaData('viewport', 'width=device-width, initial-scale=1.0');
		}

		$doc->setMetaData('X-UA-Compatible', 'IE=edge', true);

		// Add favicon links
		$faviconsurl = JURI::root() . 'templates/' . $doc->template . '/favicons/';

		$doc->addFavicon($faviconsurl . 'favicon.ico');

		$doc->addHeadLink($faviconsurl . 'apple-touch-icon-57x57.png', 'apple-touch-icon', 'rel', array('sizes' => '57x57'));
		$doc->addHeadLink($faviconsurl . 'apple-touch-icon-114x114.png', 'apple-touch-icon', 'rel', array('sizes' => '114x114'));
		$doc->addHeadLink($faviconsurl . 'apple-touch-icon-72x72.png', 'apple-touch-icon', 'rel', array('sizes' => '72x72'));
		$doc->addHeadLink($faviconsurl . 'apple-touch-icon-144x144.png', 'apple-touch-icon', 'rel', array('sizes' => '144x144'));
		$doc->addHeadLink($faviconsurl . 'apple-touch-icon-60x60.png', 'apple-touch-icon', 'rel', array('sizes' => '60x60'));
		$doc->addHeadLink($faviconsurl . 'apple-touch-icon-120x120.png', 'apple-touch-icon', 'rel', array('sizes' => '120x120'));
		$doc->addHeadLink($faviconsurl . 'apple-touch-icon-76x76.png', 'apple-touch-icon', 'rel', array('sizes' => '76x76'));
		$doc->addHeadLink($faviconsurl . 'apple-touch-icon-152x152.png', 'apple-touch-icon', 'rel', array('sizes' => '152x152'));

		$doc->addHeadLink($faviconsurl . 'favicon-16x16.png', 'icon', 'rel', array('sizes' => '16x16', 'type' => 'image/png'));
		$doc->addHeadLink($faviconsurl . 'favicon-32x32.png', 'icon', 'rel', array('sizes' => '32x32', 'type' => 'image/png'));
		$doc->addHeadLink($faviconsurl . 'favicon-96x96.png', 'icon', 'rel', array('sizes' => '96x96', 'type' => 'image/png'));
		$doc->addHeadLink($faviconsurl . 'favicon-160x160.png', 'icon', 'rel', array('sizes' => '160x160', 'type' => 'image/png'));
		$doc->addHeadLink($faviconsurl . 'favicon-196x196.png', 'icon', 'rel', array('sizes' => '196x196', 'type' => 'image/png'));

		$doc->setMetaData('msapplication-TileColor', '#b91d47');
		$doc->setMetaData('msapplication-TileImage', $faviconsurl . 'mstile-144x144.png');
		$doc->setMetaData('msapplication-square70x70logo', $faviconsurl . 'mstile-70x70.png');
		$doc->setMetaData('msapplication-square150x150logo', $faviconsurl . 'mstile-150x150.png');
		$doc->setMetaData('msapplication-square310x310logo', $faviconsurl . 'mstile-310x310.png');

		$head = '<jdoc:include type="head" />';
		$head .= "\n";

		$wr = Wright::getInstance();
		$head .= $wr->generateCSS();

		$browser = JBrowser::getInstance();

		// Add responsive for IE
		if ($browser->getBrowser() == 'msie' && (int) $browser->getMajor() <= 9)
		{
			$head .= '<script src="' . JURI::root() . 'templates/' . $doc->template . '/wright/js/respond.min.js" type="text/javascript"></script>';
		}

		return $head;
	}
}
