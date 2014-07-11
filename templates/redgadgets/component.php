<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
?>
<!DOCTYPE html>
<html>
	<head>
		<jdoc:include type="head" />
		<script src='<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/select2.min.js' type='text/javascript'></script>
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/style.css" type="text/css" />
		<script type="text/javascript">
			try {
			   jQuery(document).ready(function($){
					$('select').select2({
						width: 'element',
						dropdownCssClass: 'main'
					});
				});
			}
			catch (e) {}
		</script>
	</head>
	<body class="contentpane">
		<jdoc:include type="message" />
		<jdoc:include type="component" />
	</body>
</html>