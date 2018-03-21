jQuery(document).ready(function($) {
	// When visitor clicks on Accordion Heading it opens the submenu
	$(document).on('click','.rpgAccordionHeading', function(e){

		// Get the id of the clicked element, take out the number, and apply the number to the submenu
		var clickedID = $(this).attr("id");
		currentID = clickedID.replace("AccID", "");
		var SubMenuID = 'subMenu'  + currentID;

		// If the Accordion Heading is clicked on  without clicking the anchor tag, then activate the slide toggle
		if(!$(e.target).is("a")) { 
			$( "#"+SubMenuID ).slideToggle("fast");
		}

	}); // End of $(document).on('click','.rpgAccordionHeading', function(){ 
}); // End of jQuery(document).ready(function($) {