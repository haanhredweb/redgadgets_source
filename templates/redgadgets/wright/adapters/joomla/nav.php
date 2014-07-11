<?php

class WrightAdapterJoomlaNav
{
	public function render($args)
	{
		// Set module name
		if (!isset($args['name']))
			$args['name'] = 'menu';

		// Set module name
		if (!isset($args['style']))
			$args['style'] = 'raw';

		// Set module name
		if (!isset($args['wrapClass']))
			$args['wrapClass'] = 'navbar-default';

		if (!isset($args['wrapper']))
			$args['wrapper'] = 'wrapper-' . $args['name'];

		if (!isset($args['type']))
			$args['type'] = 'menu';

		if (!isset($args['containerClass']))
			$args['containerClass'] = '';

		$nav = '<div class="' . $args['wrapper'] . '">
					<nav id="' . $args['name'] . '" class="navbar ' . $args['wrapClass'] . '"  role="navigation">
						<div class="' . $args['containerClass'] . '">
							<div class="navbar-header">
							    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-' . $args['name'] . '">
							      <span class="sr-only">Toggle navigation</span>
							      <span class="icon-bar"></span>
							      <span class="icon-bar"></span>
							      <span class="icon-bar"></span>
							    </button>
						  	</div>

		  					<div class="collapse navbar-collapse" id="nav-' . $args['name'] . '" >
		  						<jdoc:include type="modules" name="' . $args['name'] . '" style="' . $args['style'] . '" />
		  					</div>
	  					</div>
					</nav>
				</div>';

		return $nav;
	}
}
