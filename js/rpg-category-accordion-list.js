jQuery(document).ready(function($) {
	// When visitor clicks on Accordion Heading it opens the submenu
	$(document).on('click','.rpgAccordionHeading', function(){
		var clickedID = $(this).attr("id");
		currentID = clickedID.replace("AccID", "");
		var SubMenuID = 'subMenu'  + currentID;
		var isHidden = document.getElementById(SubMenuID).style.display == "none"; 
		// if (isHidden) {
			$( "#"+SubMenuID ).slideToggle("fast");
		// }	
	}); // End of $(document).on('click','.rpgAccordionHeading', function(){ 
}); // End of jQuery(document).ready(function($) {