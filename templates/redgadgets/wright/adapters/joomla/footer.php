<?php

class WrightAdapterJoomlaFooter
{
	public function render($args)
	{
		$doc = Wright::getInstance();
		$js = $doc->generateJS();

		return $js;
	}
}
