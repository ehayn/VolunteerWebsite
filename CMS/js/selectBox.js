function setOptions(chosen) {
	var selbox = document.searchForm.secondType;
	 
	selbox.options.length = 0;
	if (chosen == "") {
	  selbox.options[selbox.options.length] = new Option(' ',' ');
	 
	}
	if (chosen == "con") {
		selbox.options[selbox.options.length] = new Option('First Name','con1');
		selbox.options[selbox.options.length] = new Option('Last Name','con2');
		selbox.options[selbox.options.length] = new Option('City','con3');
		selbox.options[selbox.options.length] = new Option('State','con4');
		selbox.options[selbox.options.length] = new Option('Status','con5');
		selbox.options[selbox.options.length] = new Option('Organization','con6');
	}
	if (chosen == "org") {
		selbox.options[selbox.options.length] = new Option('Name','org1');
		selbox.options[selbox.options.length] = new Option('City','org2');
		selbox.options[selbox.options.length] = new Option('State','org3');
	}
}