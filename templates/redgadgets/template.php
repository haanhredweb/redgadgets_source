<?php
/**
 * @copyright      Copyright (C) 2013 redComponent
 * @author         redComponent
 * @package        Template
 *
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

?>
<!DOCTYPE html>
	<html>
	<head>
		<!--
            ##########################################
            ## redComponent ApS                     ##
            ## Blangstedgaardsvej 1                 ##
            ## 5220 Odense SØ                       ##
            ## Danmark                              ##
            ## support@redcomponent.com             ##
            ## http://www.redcomponent.com          ##
            ## Dato: 2013-01-14                     ##
            ##########################################
        -->

		<w:head />
	</head>
	<body <?php if ($bodyclass != "") : ?> class="<?php echo $bodyclass ?>"<?php endif; ?> >

	<div class="wrapper-main" <?php echo $bodystyle ?>>
		<?php if ($this->countModules('topbar')) : ?>
			<div id="topbar">
				<div class="container">
				<w:module type="none" name="topbar" chrome="xhtml" />
				</div>
			</div>
			<?php endif; ?>
		<!-- header -->
		<header id="header">
			<div class="container">
				<div class="row">
                <w:logo name="top" />
            </div>
				<div class="clear"></div>
			</div>
		</header>
		<div id="menusearch" class="row">
			<div class="container">
				<?php if ($this->countModules('menu')) : ?>
					<!-- menu -->
					<div id="menu" class="<?php echo $classmenu ?>">
							<w:nav name="menu" />
					</div>
				<?php endif; ?>

				<?php if ($this->countModules('search')) : ?>
					<!-- search -->
					<div id="search" class="col-md-4 col-sm-3">
						<w:module type="none" name="search" chrome="xhtml" />
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php if ($this->countModules('slider')) : ?>
			<!-- slider -->
			<div id="slider">
				<w:module type="none" name="slider" chrome="xhtml" />
			</div>
		<?php endif; ?>

		<div class="container">
			
			<!-- breadcrumbs -->
			<div id="breadcrumbs">
				<w:module type="single" name="breadcrumbs" chrome="none" />
			</div>
			<!-- grid-tab-1-->
			<?php if ($this->countModules('grid-tab-1')) : ?>
				<!-- grid-tab-1 -->
				<div id="grid-tab-1">
					<w:module type="none" name="grid-tab-1" chrome="xhtml" />
				</div>
			<?php endif; ?>
			<!-- grid-top-->
			<?php if ($this->countModules('grid-top')) : ?>
				<!-- grid-top -->
				<div id="grid-top">
					<w:module type="row" name="grid-top" chrome="wrightflexgrid" />
				</div>
			<?php endif; ?>
			<!-- grid-tab -->
			<?php if ($this->countModules('grid-tab')) : ?>
				<div id="grid-tab-2">
					<w:module type="none" name="grid-tab" chrome="xhtml" />
				</div>
			<?php endif; ?>
			<!-- grid-manu -->
			<?php if ($this->countModules('grid-manu')) : ?>
				<div id="grid-manu">
					<w:module type="none" name="grid-manu" chrome="xhtml" />
				</div>
			<?php endif; ?>
			<div id="main-content" class="row">

				<?php // Don't show in product detail page
				if ($showsidebar1) : ?>
				<!-- sidebar1 -->
				<aside id="sidebar1">
					<w:module name="sidebar1" chrome="xhtml" />
				</aside>
				<?php endif; ?>

				<!-- main -->
				<section id="main" <?php echo $classmain ?>>
					<?php if ($this->countModules('above-content')) : ?>
						<!-- above-content -->
						<div id="above-content">
							<w:module type="none" name="above-content" chrome="xhtml" />
						</div>
					<?php endif; ?>

					<!-- component -->
					<w:content />
					<?php if ($this->countModules('below-content')) : ?>
						<!-- below-content -->
						<div id="below-content">
							<w:module type="none" name="below-content" chrome="xhtml" />
						</div>
					<?php endif; ?>

					<?php if ($showcollections) : ?>
					<div id="colections" class="row">
						<div class="col-md-6 col-sm-6 col-xs-12">
							<w:module type="none" name="below-content-1" chrome="xhtml" />
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<w:module type="none" name="below-content-2" chrome="xhtml" />
							<div class="row colectionsmall">
								<div class="col-md-6 col-sm-6 col-xs-6">
									<w:module type="none" name="below-content-3" chrome="xhtml" />
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<w:module type="none" name="below-content-4" chrome="xhtml" />
								</div>
							</div>
						</div>
					</div>
					<?php endif; ?>
				</section>

				<?php if ($showsidebar2) : ?>
				<!-- sidebar2 -->
				<aside id="sidebar2">
					<w:module name="sidebar2" chrome="xhtml" />
				</aside>
				<?php endif; ?>
			</div>

			<?php if ($this->countModules('grid-bottom')) : ?>
				<!-- grid-bottom -->
				<div id="grid-bottom">
					<w:module type="row" name="grid-bottom" chrome="wrightflexgrid" />
				</div>
			<?php endif; ?>

			<?php if ($this->countModules('bottom-menu')) : ?>
				<!-- bottom-menu -->
				<w:nav containerClass="" rowClass="row" name="bottom-menu" wrapClass="navbar-inverse" />
			<?php endif; ?>
		</div>

		<!-- footer -->
		<div class="wrapper-footer">
			<footer id="footer" <?php if ($this->params->get('stickyFooter', 1)) : ?> class="sticky"<?php endif;?>>
				<div class="container">
					<?php if ($this->countModules('footer')) : ?>
						<w:module type="row" name="footer" chrome="wrightflexgrid" />
					<?php endif; ?>
				</div>
				<div class="footer-bottom">
					<div class="container">
					<?php if ($this->countModules('footer-bottom')) : ?>
						<w:module type="row" name="footer-bottom" chrome="xhtml" />
					<?php endif; ?>
				</div>
				<div class="copyright">
					<?php if ($this->countModules('copyright')) : ?>
						<w:module name="copyright" chrome="wrightflexgrid" />
					<?php endif; ?>
				</div>
			</footer>
		</div>
	</div>

    <w:footer />

	</body>
	</html>
