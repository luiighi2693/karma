/*function framecheck(section)
{
	if( self == top )
	{
		var url = "/webadmin/home.aspx";
		
		switch(section)
		{
			case "home":
				url = '/webadmin/home.aspx';
				break;
			case "contacts":
				url = '/webadmin/contacts.aspx';
				break;
			case "accounts":
				url = '/webadmin/accounts.aspx';
				break;
			case "settings":
				url = '/webadmin/settings.aspx';
				break;
			case "site":
				url = '/webadmin/site.aspx';
				break;
		}	
		this.location = url ;
	}
}*/
function smsg(msgStr) { //v1.0
  status=msgStr;
  document.prs_return = true;
}
function nosmsg(msgStr) { //v1.0
  status=msgStr;
  document.prs_return = true;
}
function openWin(pageToLoad, winName, width, height, center,scrollbar){
	  if ((parseInt(navigator.appVersion) >= 4 ) && (center)){
		        xposition = (screen.width - width) / 2;
		        yposition = (screen.height - height) / 2;
	args = "width=" + width + "," + "height=" + height + "," + "location=0," + "menubar=0," + "resizable=1," + "scrollbars=" + scrollbar + "," + "status=1," + "titlebar=0," + "toolbar=0," + "hotkeys=0," + "screenx=" + xposition + "," + "screeny=" + yposition + "," + "left=" + xposition + "," + "top=" + yposition;
	newWindow = window.open(pageToLoad,winName,args)
	window.focus
	}
}
function openWin2(pageToLoad, winName, width, height, center,scrollbar){
	  if ((parseInt(navigator.appVersion) >= 4 ) && (center)){
		        xposition = (screen.width - width) / 2;
		        yposition = (screen.height - height) / 2;
	args = "width=" + width + "," + "height=" + height + "," + "location=0," + "menubar=0," + "resizable=0," + "scrollbars=" + scrollbar + "," + "status=1," + "titlebar=0," + "toolbar=0," + "hotkeys=0," + "screenx=" + xposition + "," + "screeny=" + yposition + "," + "left=" + xposition + "," + "top=" + yposition;
	newWindow = window.open(pageToLoad,winName,args)
	window.focus
	}
}
function deleteconfirm(str,strurl)
{
	if (confirm(str)) 
	{
		this.location=strurl;
	}
}	
function displaysub(the_sub)
{
	var my_sub = document.getElementById('idd' + the_sub);
	var my_img = document.getElementById('img' + the_sub);
	
	var img_plus = 'images/plus.gif';
	var img_minus = 'images/minus.gif';
	
	if (my_sub.style.display=="none")
	{
		my_sub.style.display="inline";
		my_img.src = img_minus ;
		return
	}
	else
	{
		my_sub.style.display="none";
		my_img.src = img_plus ;
		return
	}
}
function xmlhttpPostcountry(strURL,t)
{
    var xmlHttpReq = false;
    var self = this;
    // Mozilla/Safari
    if (window.XMLHttpRequest) {
        self.xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject) {
        self.xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
    self.xmlHttpReq.open('POST', strURL, true);
    self.xmlHttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    self.xmlHttpReq.onreadystatechange = function() {
        if (self.xmlHttpReq.readyState == 4) {
            updatepagecity(self.xmlHttpReq.responseText,t);
        }
    }
    self.xmlHttpReq.send(getquerystringcity(t));
}
function getquerystringcity(t)
{
    if(t=="1")
	{
		var form     = document.forms['addprod'];
		var word = form.country.value;	
		qstr = 'id=' + escape(word);  // NOTE: no '?' before querystring	
	}
	return qstr;
}
function updatepagecity(str,s)
{
	if(s=="1")
	{
		document.getElementById("stateRow").innerHTML= str;
	}	
}
function in_ext_lib(str)
{
	var x;
	var flag = 0;
	var myext = new Array();
	myext[0] = ".gif";
	myext[1] = ".jpg";
	myext[2] = ".bmp";
	myext[3] = ".png";
	myext[4] = ".jpeg";
	
	
	for (x in myext)
	{
		if(str.substr(str.lastIndexOf(".",str)).toLowerCase() == myext[x])
		{
			flag = 1;
			break;	
		}
	}
	if(flag == 0)
	{
		alert("Photo must be in gif, png,bmp or jpeg format");
		return false;
	}
	else
	{
		return true;
	}
}
function is_videofile(str)
{
	var x;
	var flag = 0;
	var myext = new Array();
	myext[0] = ".wmv";
	myext[1] = ".wma";
	myext[2] = ".wmp";
	myext[3] = ".mpg";
	myext[4] = ".mpeg";
	
	for (x in myext)
	{
		if(str.substr(str.lastIndexOf(".",str)).toLowerCase() == myext[x])
		{
			flag = 1;
			break;	
		}
	}
	if(flag == 0)
	{
		alert("Trailer must be in window media file format");
		return false;
	}
	else
	{
		return true;
	}
}
function is_csvfile(str)
{
	var x;
	var flag = 0;
	var myext = new Array();
	myext[0] = ".csv";
	
	
	for (x in myext)
	{
		if(str.substr(str.lastIndexOf(".",str)).toLowerCase() == myext[x])
		{
			flag = 1;
			break;	
		}
	}
	if(flag == 0)
	{
		alert("File must be in .csv format.");
		return false;
	}
	else
	{
		return true;
	}
}
///////////Scrollbar for table display data
function ScrollableTable (tableEl, tableHeight, tableWidth)
{
	this.initIEengine = function () {

		this.containerEl.style.overflowY = 'auto';
		if (this.tableEl.parentElement.clientHeight - this.tableEl.offsetHeight < 0) {
			this.tableEl.style.width = this.newWidth - this.scrollWidth +'px';
		} else {
			this.containerEl.style.overflowY = 'hidden';
			this.tableEl.style.width = this.newWidth +'px';
		}

		if (this.thead) {
			var trs = this.thead.getElementsByTagName('tr');
			for (x=0; x<trs.length; x++) {
				trs[x].style.position ='relative';
				trs[x].style.setExpression("top",  "this.parentElement.parentElement.parentElement.scrollTop + 'px'");
			}
		}

		if (this.tfoot) {
			var trs = this.tfoot.getElementsByTagName('tr');
			for (x=0; x<trs.length; x++) {
				trs[x].style.position ='relative';
				trs[x].style.setExpression("bottom",  "(this.parentElement.parentElement.offsetHeight - this.parentElement.parentElement.parentElement.clientHeight - this.parentElement.parentElement.parentElement.scrollTop) + 'px'");
			}
		}

		eval("window.attachEvent('onresize', function () { document.getElementById('" + this.tableEl.id + "').style.visibility = 'hidden'; document.getElementById('" + this.tableEl.id + "').style.visibility = 'visible'; } )");
	};


	this.initFFengine = function () {
		this.containerEl.style.overflow = 'hidden';
		this.tableEl.style.width = this.newWidth + 'px';

		var headHeight = (this.thead) ? this.thead.clientHeight : 0;
		var footHeight = (this.tfoot) ? this.tfoot.clientHeight : 0;
		var bodyHeight = this.tbody.clientHeight;
		var trs = this.tbody.getElementsByTagName('tr');
		if (bodyHeight >= (this.newHeight - (headHeight + footHeight))) {
			this.tbody.style.overflow = '-moz-scrollbars-vertical';
			for (x=0; x<trs.length; x++) {
				var tds = trs[x].getElementsByTagName('td');
				tds[tds.length-1].style.paddingRight += this.scrollWidth + 'px';
			}
		} else {
			this.tbody.style.overflow = '-moz-scrollbars-none';
		}

		var cellSpacing = (this.tableEl.offsetHeight - (this.tbody.clientHeight + headHeight + footHeight)) / 4;
		this.tbody.style.height = (this.newHeight - (headHeight + cellSpacing * 2) - (footHeight + cellSpacing * 2)) + 'px';

	};

	this.tableEl = tableEl;
	this.scrollWidth = 16;

	this.originalHeight = this.tableEl.clientHeight;
	this.originalWidth = this.tableEl.clientWidth;

	this.newHeight = parseInt(tableHeight);
	this.newWidth = tableWidth ? parseInt(tableWidth) : this.originalWidth;

	this.tableEl.style.height = 'auto';
	this.tableEl.removeAttribute('height');

	this.containerEl = this.tableEl.parentNode.insertBefore(document.createElement('div'), this.tableEl);
	this.containerEl.appendChild(this.tableEl);
	this.containerEl.style.height = this.newHeight + 'px';
	this.containerEl.style.width = this.newWidth + 'px';


	var thead = this.tableEl.getElementsByTagName('thead');
	this.thead = (thead[0]) ? thead[0] : null;

	var tfoot = this.tableEl.getElementsByTagName('tfoot');
	this.tfoot = (tfoot[0]) ? tfoot[0] : null;

	var tbody = this.tableEl.getElementsByTagName('tbody');
	this.tbody = (tbody[0]) ? tbody[0] : null;

	if (!this.tbody) return;

	if (document.all && document.getElementById && !window.opera) this.initIEengine();
	if (!document.all && document.getElementById && !window.opera) this.initFFengine();
}
///////////End of Scrollbar for table display data