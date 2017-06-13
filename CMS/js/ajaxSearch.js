function showHint(s1,s2,str){
	var xmlhttp;

	if (str.length==0)
		{ 
			document.getElementById("names").innerHTML="";
			return;
		}
	if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
	else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	//checks for changes
	xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				//fills the datalist with the returned names
				document.getElementById("names").innerHTML=xmlhttp.responseText;
			}
		}
	xmlhttp.open("GET","searchHint.php?q="+str+"&s2="+s2+"&s1="+s1,true);
	xmlhttp.send();
}
function showResults(s1,s2,str){
	var xmlhttp2;

	if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp2=new XMLHttpRequest();
		}
	else
		{// code for IE6, IE5
			xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
		}
	
	xmlhttp2.onreadystatechange=function()
		{
			if (xmlhttp2.readyState==4 && xmlhttp2.status==200)
			{
				//fills the datalist with the returned names
				document.getElementById("searchResults").innerHTML=xmlhttp2.responseText;
			}
		}
	xmlhttp2.open("GET","searchResults.php?q="+str+"&s1="+s1+"&s2="+s2,true);
	xmlhttp2.send();
}
function showDataTablesResults(s1){
	var xmlhttp4;

	if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp4=new XMLHttpRequest();
		}
	else
		{// code for IE6, IE5
			xmlhttp4=new ActiveXObject("Microsoft.XMLHTTP");
		}
	
	xmlhttp4.onreadystatechange=function()
		{
			if (xmlhttp4.readyState==4 && xmlhttp4.status==200)
			{
				//fills the datalist with the returned names
				document.getElementById("dataTablesSearchResults").innerHTML=xmlhttp4.responseText;
				$('#dataTablesResults').DataTable();
			}
		}
	xmlhttp4.open("GET","dataTablesSearchResults.php?s1="+s1,true);
	xmlhttp4.send();
}
function viewResults(id,type,msg){
	var xmlhttp3;
	if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp3=new XMLHttpRequest();
		}
	else
		{// code for IE6, IE5
			xmlhttp3=new ActiveXObject("Microsoft.XMLHTTP");
		}
	
	xmlhttp3.onreadystatechange=function()
		{
			if (xmlhttp3.readyState==4 && xmlhttp3.status==200)
			{
				//fills the datalist with the returned names
				document.getElementById("viewEdit").innerHTML=xmlhttp3.responseText;
			}
		}
	xmlhttp3.open("GET","viewResult.php?id="+id+"&type="+type+"&msg="+msg,true);
	xmlhttp3.send();
}