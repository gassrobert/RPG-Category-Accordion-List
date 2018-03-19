jQuery(document).ready(function($) {
	$(document).on('click','.rpgAccordionHeading', function(){
		var clickedID = $(this).attr("id");
		currentID = clickedID.replace("AccID", "");
		var SubMenuID = 'subMenu'  + currentID;
		$( "#"+SubMenuID ).slideToggle("fast");
		// $( "#myDiv" ).slideToggle("slow");
		// $(this).next(".rpgAccordion").slideToggle("slow");
		//$(this).next(".rpgAccordion").slideToggle("slow");
		// alert($(this).next(".rpgAccordionSubmenu").attr('class'));
		// $(this).next(".rpgAccordionSubmenu").slideToggle("slow"); 
		// $(this).next(".rpgAccordionSubmenu").show("slow");
		//$(this).next(".rpgAccordionSubmenu").attr("style", "display:none");
		// $(this).next(".rpgAccordionSubmenu").removeClass();
		// $("#" + $(this).attr("id"));
	}); // End of $(document).on('click','.rpgAccordionHeading', function(){ 
	//$(".rpgAccordionHeading").click(function () { $(this).parent().next(".rpgAccordionSubmenu").show("fast"); });
}); // End of jQuery(document).ready(function($) {