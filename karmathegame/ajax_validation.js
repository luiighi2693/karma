function LoadCountry_States(LoadCountry_States_ID,CountryName,statefieldname,totalwidth)
{
	//alert(name);
	//alert(password);
  var http4 = false;
	if(navigator.appName == "Microsoft Internet Explorer") {
	  http4 = new ActiveXObject("Microsoft.XMLHTTP");
	} else {
	  http4 = new XMLHttpRequest();
	}
  http4.abort();
  http4.open("GET", "ajax_validation.php?Type=LoadCountry_States&CountryName="+CountryName+"&statefieldname="+statefieldname+"&totalwidth="+totalwidth, true);
  document.getElementById(LoadCountry_States_ID).innerHTML= "Loading....";
  http4.onreadystatechange=function()
  {
	  if(http4.readyState == 4)
	  {
		  if(http4.responseText!="")
		  {
			  document.getElementById(LoadCountry_States_ID).innerHTML= http4.responseText;
			  return  false;
		  }
	  } 
  }
  http4.send(null);
}
function SaveQuestionsAnswer(questionid,answerid,answeertext)
{
    var http4 = false;
	if(navigator.appName == "Microsoft Internet Explorer") {
	  http4 = new ActiveXObject("Microsoft.XMLHTTP");
	} else {
	  http4 = new XMLHttpRequest();
	}
  http4.abort();
  http4.open("GET", "ajax_validation.php?Type=SaveQuestionsAnswer&questionid="+questionid+"&answerid="+answerid+"&answeertext="+answeertext, true);
  http4.onreadystatechange=function()
  {
	  if(http4.readyState == 4)
	  {
		  if(http4.responseText!="")
		  {
			  return  false;
		  }
	  } 
  }
  http4.send(null);
}
function SaveProfileAnswer(questionid,answeertext)
{
    var http4 = false;
	if(navigator.appName == "Microsoft Internet Explorer") {
	  http4 = new ActiveXObject("Microsoft.XMLHTTP");
	} else {
	  http4 = new XMLHttpRequest();
	}
  http4.abort();
  http4.open("GET", "ajax_validation.php?Type=SaveProfileAnswer&questionid="+questionid+"&answeertext="+answeertext, true);
  http4.onreadystatechange=function()
  {
	  if(http4.readyState == 4)
	  {
		  if(http4.responseText!="")
		  {
			  return  false;
		  }
	  } 
  }
  http4.send(null);
}
function DisplayGraph(userid)
{
    var http4 = false;
	if(navigator.appName == "Microsoft Internet Explorer") {
	  http4 = new ActiveXObject("Microsoft.XMLHTTP");
	} else {
	  http4 = new XMLHttpRequest();
	}
  http4.abort();
  http4.open("GET", "ajax_validation.php?Type=DisplayGraph&userid="+userid, true);
  http4.onreadystatechange=function()
  {
	  if(http4.readyState == 4)
	  {
		  if(http4.responseText!="")
		  {
			  var aa,bb;
			  aa=http4.responseText;
			  bb=aa.split("#");
			  document.getElementById('Graphs_YOU').style.visibility='visible';
			  document.getElementById('Graphs_YOU_1').style.width=bb[0]+"%";
			  document.getElementById('Graphs_YOU_2').style.width=bb[1]+"%";
			  document.getElementById('Graphs_YOU_3').style.width=bb[2]+"%";
			  document.getElementById('Graphs_YOU_4').style.backgroundColor=bb[3];
			  return  false;
		  }
	  } 
  }
  http4.send(null);
}

function DisplayGraphPercent(userid)
{
    var http4percent = false;
	if(navigator.appName == "Microsoft Internet Explorer") {
	  http4percent = new ActiveXObject("Microsoft.XMLHTTP");
	} else {
	  http4percent = new XMLHttpRequest();
	}
  http4percent.abort();
  http4percent.open("GET", "ajax_validation.php?Type=DisplayGraphPercent&userid="+userid, true);
  http4percent.onreadystatechange=function()
  {
	  if(http4percent.readyState == 4)
	  {
		  if(http4percent.responseText!="")
		  {
			  var aa,bb;
			  aa=http4percent.responseText;
			  //alert(http4percent.responseText);
			  bb=aa.split("#");
			  document.getElementById('Graphs_BOTH').style.visibility='visible';
			  document.getElementById('Graphs_BOTH_1').style.width=bb[0]+"%";
			  document.getElementById('Graphs_BOTH_2').style.width=bb[1]+"%";
			  document.getElementById('Graphs_BOTH_3').style.width=bb[2]+"%";
			  return  false;
		  }
	  } 
  }
  http4percent.send(null);
}
function UpdateMiddleSection(userid,slide)
{
    var http4NEW = false;
	if(navigator.appName == "Microsoft Internet Explorer") {
	  http4NEW = new ActiveXObject("Microsoft.XMLHTTP");
	} else {
	  http4NEW = new XMLHttpRequest();
	}
  http4NEW.abort();
  http4NEW.open("GET", "ajax_userdetail.php?userid="+userid+"&slide="+slide, true);
  http4NEW.onreadystatechange=function()
  {
	  if(http4NEW.readyState == 4)
	  {
		  if(http4NEW.responseText!="")
		  {
			  document.getElementById('detail_box').style.display='none';
			  document.getElementById('detail_box_updating').style.display='inline';
			  document.getElementById('detail_box_updating').innerHTML=http4NEW.responseText;
			  return  false;
		  }
	  } 
  }
  http4NEW.send(null);
}

function Updatebox(userid,slide)
{
    var http4NEW = false;
	if(navigator.appName == "Microsoft Internet Explorer") {
	  http4NEW = new ActiveXObject("Microsoft.XMLHTTP");
	} else {
	  http4NEW = new XMLHttpRequest();
	}
  http4NEW.abort();
  http4NEW.open("GET", "ajax_userdetail.php?userid="+userid+"&slide="+slide, true);
  http4NEW.onreadystatechange=function()
  {
	  if(http4NEW.readyState == 4)
	  {
		  if(http4NEW.responseText!="")
		  {
			  document.getElementById('detail_box').style.display='none';
			  document.getElementById('detail_box_updating').style.display='inline';
			  document.getElementById('detail_box_updating').style.overflow='hidden';
			  document.getElementById('detail_box_updating').innerHTML=http4NEW.responseText;
			  return  false;
		  }
	  } 
  }
  http4NEW.send(null);
}
function SAVE_POPUP_INTRODUCTION(userid_from,userid_to,introid)
{
  var http4_1 = false;
  if(navigator.appName == "Microsoft Internet Explorer") { http4_1 = new ActiveXObject("Microsoft.XMLHTTP");} else {  http4_1 = new XMLHttpRequest();	}
  http4_1.abort();
  http4_1.open("GET", "ajax_validation.php?Type=SAVE_POPUP_INTRODUCTION&userid_from="+userid_from+"&userid_to="+userid_to+"&introid="+introid, true);
  http4_1.onreadystatechange=function()
  {
	  if(http4_1.readyState == 4)
	  {
		  if(http4_1.responseText!="")
		  {
			  document.frmpopup.reset();
			  document.getElementById('MessageId').innerHTML='Sent Successfully!';
			  return  false;
		  }
	  } 
  }
  http4_1.send(null);
}
function SAVE_POPUP_GOOUT(userid_from,userid_to,outtype,relationtype,whomidea,payby,outdate, outdatetime, bucket_id)
{
  var http4_1 = false;
  if(navigator.appName == "Microsoft Internet Explorer") { http4_1 = new ActiveXObject("Microsoft.XMLHTTP");} else {  http4_1 = new XMLHttpRequest();	}
  http4_1.abort();
  http4_1.open("GET", "ajax_validation.php?Type=SAVE_POPUP_GOOUT&userid_from="+userid_from+"&userid_to="+userid_to+"&outtype="+outtype+"&relationtype="+relationtype+"&whomidea="+whomidea+"&payby="+payby+"&outdate="+outdate+"&outdatetime="+outdatetime+"&bucket_id="+bucket_id, true);
  http4_1.onreadystatechange=function()
  {
	  if(http4_1.readyState == 4)
	  {
		  if(http4_1.responseText!="")
		  {
			  document.frmpopup.reset();
			  document.getElementById('MessageId').innerHTML='Sent Successfully!';
			  return  false;
		  }
	  } 
  }
  http4_1.send(null);
}
function SAVE_POPUP_CHAT(userid_from,userid_to,message)
{
  var http4_1 = false;
  if(navigator.appName == "Microsoft Internet Explorer") { http4_1 = new ActiveXObject("Microsoft.XMLHTTP");} else {  http4_1 = new XMLHttpRequest();	}
  http4_1.abort();
  document.getElementById('chatloaderID').innerHTML= "<img src='images/loading.gif' />";
  http4_1.open("GET", "ajax_validation.php?Type=SAVE_POPUP_CHAT&userid_from="+userid_from+"&userid_to="+userid_to+"&message="+message, true);
  http4_1.onreadystatechange=function()
  {
	  if(http4_1.readyState == 4)
	  {
		  if(http4_1.responseText!="")
		  {
			  document.frmpopup.reset();
			  var current=document.getElementById('AllChatsID').innerHTML;
			  document.getElementById('AllChatsID').innerHTML=current+http4_1.responseText;
			  document.getElementById('MessageId').innerHTML='Sent Successfully!';
			  document.getElementById('chatloaderID').innerHTML= "";
			  return  false;
		  }
	  } 
  }
  http4_1.send(null);
}
function GETCHAT(userid_from,userid_to,showloder)
{
  var http4_1 = false;
  if(navigator.appName == "Microsoft Internet Explorer") { http4_1 = new ActiveXObject("Microsoft.XMLHTTP");} else {  http4_1 = new XMLHttpRequest();	}
  http4_1.abort();
  if(showloder=='YES')
  {
  	document.getElementById('chatloaderID').innerHTML= "<img src='images/loading.gif' />";
  }
  http4_1.open("GET", "ajax_validation.php?Type=GETCHAT&userid_from="+userid_from+"&userid_to="+userid_to, true);
  http4_1.onreadystatechange=function()
  {
	  if(http4_1.readyState == 4)
	  {
		   LoadRightSideChatterBox(userid_to);
		   document.getElementById('AllChatsID').innerHTML=http4_1.responseText;
		   document.getElementById('chatloaderID').innerHTML= "";
		   setTimeout("Callchateverysec()",2000);
		   return  false;
	  } 
  }
  http4_1.send(null);
}
function Callchateverysec()
{
	if(document.getElementById('chatloaderID'))
	{
		GETCHAT(document.getElementById('userid_from').value,document.getElementById('userid_to').value,'NO');	
	}
	else
	{
		setTimeout("Callchateverysec()",9990000);
	}
}	
function LoadRightSideChatterBox(userid_to)
{
  var http4_1 = false;
  if(navigator.appName == "Microsoft Internet Explorer") { http4_1 = new ActiveXObject("Microsoft.XMLHTTP");} else {  http4_1 = new XMLHttpRequest();	}
  http4_1.abort();
    var element =  document.getElementById('chatloaderID');
	if (typeof(element) != 'undefined' && element != null)
	{
	   document.getElementById('chatloaderID').innerHTML= "<img src='images/loading.gif' />";
	}
 
  http4_1.open("GET", "ajax_validation.php?Type=LoadRightSideChatterBox&userid_to="+userid_to, true);
  http4_1.onreadystatechange=function()
  {
	  if(http4_1.readyState == 4)
	  {
		  if(http4_1.responseText!="")
		  {
			  //alert(http4_1.responseText);
			  document.getElementById('RIGHTSIDECHATTER_ID').innerHTML=http4_1.responseText;
			  return  false;
		  }
	  } 
  }
  http4_1.send(null);
}

function SAVE_POPUP_HIDE(userid_from,userid_to,neverwann,hideme1,hideme2)
{
  var http4_1 = false;
  if(navigator.appName == "Microsoft Internet Explorer") { http4_1 = new ActiveXObject("Microsoft.XMLHTTP");} else {  http4_1 = new XMLHttpRequest();	}
  http4_1.abort();
  http4_1.open("GET", "ajax_validation.php?Type=SAVE_POPUP_HIDE&userid_from="+userid_from+"&userid_to="+userid_to+"&neverwann="+neverwann+"&hideme1="+hideme1+"&hideme2="+hideme2, true);
  http4_1.onreadystatechange=function()
  {
	  if(http4_1.readyState == 4)
	  {
		  if(http4_1.responseText!="")
		  {
			  alert("Updated Successfully!");
			  location.reload();
			  return  false;
		  }
	  } 
  }
  http4_1.send(null);
}
function SaveWhatIwantAnswer(fieldname,answer)
{
    var http4 = false;
	if(navigator.appName == "Microsoft Internet Explorer") {
	  http4 = new ActiveXObject("Microsoft.XMLHTTP");
	} else {
	  http4 = new XMLHttpRequest();
	}
  http4.abort();
  http4.open("GET", "ajax_validation.php?Type=SaveWhatIwantAnswer&fieldname="+fieldname+"&answer="+answer, true);
  http4.onreadystatechange=function()
  {
	  if(http4.readyState == 4)
	  {
		  if(http4.responseText!="")
		  {
			  return  false;
		  }
	  } 
  }
  http4.send(null);
}
function SAVE_POPUP_GROUP(userid_from,userid_to,groupid_new,groupid)
{
  var http4_1 = false;
  if(navigator.appName == "Microsoft Internet Explorer") { http4_1 = new ActiveXObject("Microsoft.XMLHTTP");} else {  http4_1 = new XMLHttpRequest();	}
  http4_1.abort();
  http4_1.open("GET", "ajax_validation.php?Type=SAVE_POPUP_GROUP&userid_from="+userid_from+"&userid_to="+userid_to+"&groupid_new="+groupid_new+"&groupid="+groupid, true);
  http4_1.onreadystatechange=function()
  {
	  if(http4_1.readyState == 4)
	  {
		  if(http4_1.responseText!="")
		  {
			  document.getElementById('MessageId').innerHTML=http4_1.responseText;
			  return  false;
		  }
	  } 
  }
  http4_1.send(null);
}
function LoadEmail(emailid)
{
  var http4_1 = false;
  if(navigator.appName == "Microsoft Internet Explorer") { http4_1 = new ActiveXObject("Microsoft.XMLHTTP");} else {  http4_1 = new XMLHttpRequest();	}
  http4_1.abort();
  http4_1.open("GET", "ajax_validation.php?Type=LoadEmail&emailid="+emailid, true);
  http4_1.onreadystatechange=function()
  {
	  if(http4_1.readyState == 4)
	  {
		  if(http4_1.responseText!="")
		  {
			  document.getElementById('EMailBody').innerHTML=http4_1.responseText;
			  return  false;
		  }
	  } 
  }
  http4_1.send(null);
}

var mailSelected = null;
var typeMailSelected = null;

function DeleteEmail(emailid)
{
	if (emailid == null){
		alert("please, select a email to delete..");
	}else{
		var http4_1 = false;
		if(navigator.appName == "Microsoft Internet Explorer") { http4_1 = new ActiveXObject("Microsoft.XMLHTTP");} else {  http4_1 = new XMLHttpRequest();	}
		http4_1.abort();
		http4_1.open("GET", "ajax_validation.php?Type=DeleteEmail&emailid="+emailid, true);
		http4_1.onreadystatechange=function()
		{
			if(http4_1.readyState == 4)
			{
				if(http4_1.responseText!="")
				{
					// show_pop('popup_emails.php');
					return  false;
				}
			}
		};
		http4_1.send(null);
	}
}

function SAVE_POPUP_ZAP(userid_from,userid_to,neverwann,reason)
{
  var http4_1 = false;
  if(navigator.appName == "Microsoft Internet Explorer") { http4_1 = new ActiveXObject("Microsoft.XMLHTTP");} else {  http4_1 = new XMLHttpRequest();	}
  http4_1.abort();
  http4_1.open("GET", "ajax_validation.php?Type=SAVE_POPUP_ZAP&userid_from="+userid_from+"&userid_to="+userid_to+"&neverwann="+neverwann+"&reason="+reason, true);
  http4_1.onreadystatechange=function()
  {
	  if(http4_1.readyState == 4)
	  {
		  if(http4_1.responseText!="")
		  {
			  alert("Zapped Successfully!");
			  location.reload();
			  return  false;
		  }
	  } 
  }
  http4_1.send(null);
}
function RequestIntimicyLock(userid_from,userid_to)
{
  var http4_1 = false;
  if(navigator.appName == "Microsoft Internet Explorer") { http4_1 = new ActiveXObject("Microsoft.XMLHTTP");} else {  http4_1 = new XMLHttpRequest();	}
  http4_1.abort();
  http4_1.open("GET", "ajax_validation.php?Type=RequestIntimicyLock&userid_from="+userid_from+"&userid_to="+userid_to, true);
  http4_1.onreadystatechange=function()
  {
	  if(http4_1.readyState == 4)
	  {
		  if(http4_1.responseText!="")
		  {
			  document.getElementById('MessageId').innerHTML='<br>Requested Successfully!&nbsp;&nbsp;';
			  return  false;
		  }
	  } 
  }
  http4_1.send(null);
}
function SaveLikedTagged(userid_from,userid_to,type,val)
{
  var http4_1 = false;
  if(navigator.appName == "Microsoft Internet Explorer") { http4_1 = new ActiveXObject("Microsoft.XMLHTTP");} else {  http4_1 = new XMLHttpRequest();	}
  http4_1.abort();
  http4_1.open("GET", "ajax_validation.php?Type=SaveLikedTagged&userid_from="+userid_from+"&userid_to="+userid_to+"&type="+type+"&val="+val, true);
  http4_1.onreadystatechange=function()
  {
	  if(http4_1.readyState == 4)
	  {
		  if(http4_1.responseText!="")
		  {
			  document.getElementById('MessageIdNew').innerHTML='Saved!';
			  return  false;
		  }
	  } 
  }
  http4_1.send(null);
}
function LoadFooterSoulmates(type)
{
	if(type!='Ideas')
	{
		if(type=='Infinity')
		{
			document.getElementById('Infinity').src="images/footer_icon1_blur.png";
		}
		if(type=='ThumbsUp')
		{
			document.getElementById('ThumbsUp').src="images/footer_icon2_blur.png";
		}
		if(type=='Heart')
		{
			document.getElementById('Heart').src="images/footer_icon3_blur.png";
		}
		document.getElementById('Ideas').src="images/icon_idea.png";
		var str=document.getElementById("FooterSoulmates").value;
		
		if(str.indexOf(type)>=0)
		{
			str=str.replace(type,'');
			document.getElementById("FooterSoulmates").value=str;	
			if(type=='Infinity')
			{
				document.getElementById('Infinity').src="images/icon_infinity.png";
				document.getElementById('Infinity_TOP').style.display='none';
			}
			if(type=='ThumbsUp')
			{
				document.getElementById('ThumbsUp').src="images/icon_like.png";
				document.getElementById('ThumbsUp_TOP').style.display='none';
			}
			if(type=='Heart')
			{
				document.getElementById('Heart').src="images/icon_heart.png";
				document.getElementById('Heart_TOP').style.display='none';
			}
		}
		else
		{
			document.getElementById("FooterSoulmates").value+=type;	
			if(type=='Infinity')
			{
				document.getElementById('Infinity_TOP').style.display='inline';
			}
			if(type=='ThumbsUp')
			{
				document.getElementById('ThumbsUp_TOP').style.display='inline';
			}
			if(type=='Heart')
			{
				document.getElementById('Heart_TOP').style.display='inline';
			}
		}
		document.getElementById('Ideas_TOP').style.display='none';
		var str2=document.getElementById("FooterSoulmates").value;
		str2=str2.replace('Ideas','');
		document.getElementById("FooterSoulmates").value=str2;	
	}
	else
	{
		var str=document.getElementById("FooterSoulmates").value;
		if(str.indexOf(type)>=0)
		{
			str=str.replace(type,'');
			document.getElementById("FooterSoulmates").value=str;	
			document.getElementById('Ideas').src="images/icon_idea.png";
			document.getElementById('Ideas_TOP').style.display='none';
		}
		else
		{
			document.getElementById("FooterSoulmates").value=type;	
			document.getElementById('Ideas_TOP').style.display='inline';
			document.getElementById('Ideas').src="images/footer_icon4_blur.png";
		}	
		document.getElementById('Infinity').src="images/icon_infinity.png";
		document.getElementById('ThumbsUp').src="images/icon_like.png";
		document.getElementById('Heart').src="images/icon_heart.png";
		document.getElementById('Infinity_TOP').style.display='none';
		document.getElementById('ThumbsUp_TOP').style.display='none';
		document.getElementById('Heart_TOP').style.display='none';
	}
	
  var http4_1 = false;
  document.getElementById('SoulmateboxID').innerHTML= "<img src='images/loading.gif' />";
  if(navigator.appName == "Microsoft Internet Explorer") { http4_1 = new ActiveXObject("Microsoft.XMLHTTP");} else {  http4_1 = new XMLHttpRequest();	}
  http4_1.abort();
  http4_1.open("GET", "ajax_footersoulmates.php?type="+type+"&allselected="+document.getElementById("FooterSoulmates").value, true);
  http4_1.onreadystatechange=function()
  {
	  if(http4_1.readyState == 4)
	  {
		  if(http4_1.responseText!="")
		  {
			  document.getElementById('SoulmateboxID').innerHTML=http4_1.responseText;
			  return  false;
		  }
	  } 
  }
  http4_1.send(null);
}
function ClickIdeas(id)
{
    var http4NEW = false;
	if(navigator.appName == "Microsoft Internet Explorer") {
	  http4NEW = new ActiveXObject("Microsoft.XMLHTTP");
	} else {
	  http4NEW = new XMLHttpRequest();
	}
  http4NEW.abort();
  http4NEW.open("GET", "ajax_ideadetaill.php?id="+id, true);
  http4NEW.onreadystatechange=function()
  {
	  if(http4NEW.readyState == 4)
	  {
		  if(http4NEW.responseText!="")
		  {
			  document.getElementById('detail_box').style.display='none';
			  document.getElementById('detail_box_updating').style.display='inline';
			  document.getElementById('detail_box_updating').innerHTML=http4NEW.responseText;
			  return  false;
		  }
	  } 
  }
  http4NEW.send(null);
}

function setIdeaSelected(id) {
	ideaSelected = id;
}