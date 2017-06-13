$(".tab-pane").each(function(){ 
$(this).removeClass("active");
});
$(".tabButtons").each(function(){ 
	$(this).removeClass("active");
});
$("#<?php print $oldSelected1; ?>").addClass("active");
$("#<?php print $oldSelected2; ?>").addClass("active");
document.getElementById("uploadBtnContact").onchange = function () {
	document.getElementById("uploadContactFile").value = this.value;
};
document.getElementById("uploadBtnOrganization").onchange = function () {
	document.getElementById("uploadOrganizationFile").value = this.value;
};
