jQuery(document).ready(function($) {
	var $destination = $("#customize-info .accordion-section-title");
 	$destination.prepend('<a style="width: 80%; margin: 10px auto; display: block; text-align: center;" href="https://www.quemalabs.com/theme/crafter-pro/?utm_source=Crafter%20Theme&utm_medium=Pro%20Button&utm_campaign=Crafter%20Pro" class="button" target="_blank">{pro}</a>'.replace( '{pro}', topbtns.pro ) );
});