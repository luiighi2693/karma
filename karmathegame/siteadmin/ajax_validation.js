function AJAX_getarival(AJAX_getarival_ID,departure_point,selectedarrival)
{
	document.getElementById(AJAX_getarival_ID).innerHTML="<img src='images/loading2.gif'  border='0'/>";	
	var http7_22 = false;
	if(navigator.appName == "Microsoft Internet Explorer") { http7_22 = new ActiveXObject("Microsoft.XMLHTTP");} else { http7_22 = new XMLHttpRequest();}
	http7_22.abort();
	http7_22.open("GET", "ajax_validation.php?Type=AJAX_getarival&departure_point="+departure_point+"&selectedarrival="+selectedarrival, true);
	http7_22.onreadystatechange=function()
	{
		  if(http7_22.readyState == 4)  
		  {
			document.getElementById(AJAX_getarival_ID).innerHTML=http7_22.responseText;	
		 } 
	}
	http7_22.send(null);
}
function AJAX_getdeparture(departure_point_ID,arrival_point,selectedarrival)
{
	document.getElementById(departure_point_ID).innerHTML="<img src='images/loading2.gif'  border='0'/>";	
	var http7_22 = false;
	if(navigator.appName == "Microsoft Internet Explorer") { http7_22 = new ActiveXObject("Microsoft.XMLHTTP");} else { http7_22 = new XMLHttpRequest();}
	http7_22.abort();
	http7_22.open("GET", "ajax_validation.php?Type=AJAX_getdeparture&arrival_point="+arrival_point+"&selectedarrival="+selectedarrival, true);
	http7_22.onreadystatechange=function()
	{
		  if(http7_22.readyState == 4)  
		  {
			document.getElementById(departure_point_ID).innerHTML=http7_22.responseText;	
		 } 
	}
	http7_22.send(null);
}