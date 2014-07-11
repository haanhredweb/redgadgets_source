<?php
/**
 * @package     RedITEM.Frontend
 * @subpackage  mod_reditem_categories
 *
 * @copyright   Copyright (C) 2005 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;

?>
<!-- Initialize --> 
<script type="text/javascript">
	var infoBubble;
	function simpleGmap<?php echo $module->id; ?>_initialize()
	{
		var styles;
		var styledMap;
		var centerPoint;
		var myOptions;
		var map;
		var marker;

		styles = [
			{
				"featureType": "landscape.natural",
				"stylers": [{
					"visibility": "off"
				}]
			},
			{
				"featureType": "poi",
				"stylers": [{
					"visibility": "off"
				}]
			},
			{
				"featureType": "transit",
				"stylers": [{
					"visibility": "off"
				}]
			},
			{
				"featureType": "water",
				"stylers": [
					{ "color": "#BDB9C4" },
					{ "visibility": "on" }
				]
			},
			{
				"featureType": "water",
				"elementType": "labels.text",
				"stylers": [
					{ "color": "#FFFFFF" },
					{ "weight": 0.1 }
				]
			},
			{
				"featureType": "landscape",
				"elementType": "geometry.fill",
				"stylers": [{
					"visibility": "simplified"
				}]
			},
			{
				"featureType": "road.highway",
				"elementType": "geometry",
				"stylers": [
					{ "visibility": "on" },
					{ "color": "#FFFFFF" },
					{ "hue": "#FFFFFF" }
				]
			},
			{
				"featureType": "poi.park",
				"stylers": [
					{ "visibility": "on" },
					{ "hue": "#5489B9" }
				]
			}
		];

		styledMap = new google.maps.StyledMapType(styles, {name: "Styled Map"});

		centerPoint = new google.maps.LatLng(<?php echo $gmapLatlng ?>);

		myOptions = {
			zoom: <?php echo $gmapZoom ?>,
			center: centerPoint,
			panControl: false,
			zoomControl: false,
			mapTypeControl: false,
			scaleControl: false,
			streetViewControl: false,
			overviewMapControl: false,
			draggable: true,
			scrollwheel: true,
			disableDoubleClickZoom: true,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};

		map = new google.maps.Map(document.getElementById("map_canvas<?php echo $module->id; ?>"), myOptions);

		map.mapTypes.set('map_style', styledMap);
		map.setMapTypeId('map_style');

		marker = new MarkerWithLabel({
			position: centerPoint,
			draggable: false,
			raiseOnDrag: false,
			map: map,
			<?php if ($pinicon !== '') : ?>
			icon: '<?php echo $pinicon; ?>',
			<?php endif; ?>
			labelAnchor: new google.maps.Point(28, 0),
			labelStyle: {opacity: 1.0}
		});

		infoBubble = new InfoBubble({
			content: '<?php echo $inforbox; ?>',
			minWidth: 300
		});

		google.maps.event.addListener(marker, 'click', function() {
          if (!infoBubble.isOpen()) {
            infoBubble.open(map, marker);
          }
        });
	}

	jQuery(function ($){
		simpleGmap<?php echo $module->id; ?>_initialize();
	});
</script>

<div id="simple_gmap<?php echo $module->id; ?>">
	<div id="map_canvas<?php echo $module->id; ?>" style="<?php echo $gmapWidth . ';' . $gmapHeight; ?>"></div>
</div>
