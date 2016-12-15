function openWin2(pageToLoad, winName, width, height, center,scrollbar){
	  if ((parseInt(navigator.appVersion) >= 4 ) && (center)){
		        xposition = (screen.width - width) / 2;
		        yposition = (screen.height - height) / 2;
	args = "width=" + width + "," + "height=" + height + "," + "location=0," + "menubar=0," + "resizable=0," + "scrollbars=" + scrollbar + "," + "status=1," + "titlebar=0," + "toolbar=0," + "hotkeys=0," + "screenx=" + xposition + "," + "screeny=" + yposition + "," + "left=" + xposition + "," + "top=" + yposition;
	newWindow = window.open(pageToLoad,winName,args)
	window.focus
	}
}
function openWinFullwidth(pageToLoad, winName, width, height, center,scrollbar){
	  if ((parseInt(navigator.appVersion) >= 4 ) && (center)){
		        xposition = 0;
		        yposition =0;
	args = "width=" + screen.width + "," + "height=" + screen.height + "," + "location=0," + "menubar=0," + "resizable=0," + "scrollbars=" + scrollbar + "," + "status=1," + "titlebar=0," + "toolbar=0," + "hotkeys=0," + "screenx=" + xposition + "," + "screeny=" + yposition + "," + "left=" + xposition + "," + "top=" + yposition;
	newWindow = window.open(pageToLoad,winName,args)
	window.focus
	}
}
function openPreferencesPopup(userid_from,userid_to)
{
	openWinFullwidth('preferences.php?userid_from='+userid_from+'&userid='+userid_to+'','usedadasr_'+userid_from+'_'+userid_to+'',1024,480,'yes','yes')
}
function loadchateverysec()
{
	setTimeout("Callchateverysec()",500);
}
function Callchateverysec()
{
	GETCHAT(document.getElementById('userid_from').value,document.getElementById('userid_to').value);
}	
function SelectEmotion(emoticon)
{
	document.getElementById('BigEmotionID').innerHTML='<img src="Emoticons/'+emoticon+'" />';
}
function POPUPfrmcheck(formid)
{
	if(formid=='introduction')
	{
		if (document.frmpopup.Hidintroduction.value=='')
		{
			alert("Please Select One Option.");
			return false;
		}
		console.log('entro');
		SAVE_POPUP_INTRODUCTION(document.frmpopup.userid_from.value,document.frmpopup.userid_to.value,document.frmpopup.Hidintroduction.value);
	}
	else if(formid=='goout')
	{
		SAVE_POPUP_GOOUT(document.frmpopup.userid_from.value,document.frmpopup.userid_to.value,document.frmpopup.Hidouttype.value,document.frmpopup.Hidrelationtype.value,document.frmpopup.Hidwhomidea.value,document.frmpopup.Hidpayby.value,document.frmpopup.outdate.value, document.getElementById('goOutTime').value, document.getElementById('id_bucket').value);
	}
	else if(formid=='chat')
	{
		if (document.frmpopup.message.value.split(" ").join("")=='')
		{
			alert("Please enter your message.");
			document.frmpopup.message.focus();
			return false;
		}
		message=document.getElementById('message').value.replace(/\n/g,'<br />');
		message=message.replaceAll('#',"RRRRRR_RRRRRR");
		message=message.replaceAll('&',"PPPPPP_PPPPPP");
		SAVE_POPUP_CHAT(document.frmpopup.userid_from.value,document.frmpopup.userid_to.value,message);
	}
	else if(formid=='hidepop')
	{
		SAVE_POPUP_HIDE(document.frmpopup.userid_from.value,document.frmpopup.userid_to.value,document.frmpopup.neverwann.checked,document.getElementById('hideme1').checked,document.getElementById('hideme2').checked);
	}
	else if(formid=='groups')
	{
		if (document.frmpopup.groupid_new.value.split(" ").join("")=='' && document.frmpopup.groupid.value.split(" ").join("")=='')
		{
			alert("Please create new group or select your group.");
			document.frmpopup.groupid_new.focus();
			return false;
		}
		SAVE_POPUP_GROUP(document.frmpopup.userid_from.value,document.frmpopup.userid_to.value,document.frmpopup.groupid_new.value,document.frmpopup.groupid.value);
	}
	else if(formid=='zap')
	{
		 if(document.getElementById('neverwann').checked==false)
		 {
			alert("Please check if wann to ZAP this player off your list and the game.");
			return false;
		 }
		  
		 selectedValue='';
		 for(var i = 0; i < document.getElementById('hideme').childElementCount; i++)
		 {
		  if(document.getElementById("hideme"+(i+1)).checked)
		  {
			var selectedValue =document.getElementById("hideme"+(i+1)).value;
		  }
	 	}
		SAVE_POPUP_ZAP(document.getElementById("userid_from").value,document.getElementById("userid_to").value,document.getElementById('neverwann').checked,selectedValue);
	}
	return false;
}
function ClickAvatar(id,slide)
{
	if(slide==''){slide=1;}
	document.getElementById('CurrentSelectedUserId').value=id;
	DisplayGraph(id);
	UpdateMiddleSection(id,slide);
	DisplayGraphPercent(id);
}	



String.prototype.replaceAll = function(strTarget,strSubString)
{
       var strText = this;
       var intIndexOfMatch = strText.indexOf( strTarget );
       while (intIndexOfMatch != -1)
       {
               strText = strText.replace( strTarget, strSubString )
               intIndexOfMatch = strText.indexOf( strTarget );
       }
       return( strText );
};

function ClickAvatar2(id,slide)
{
	if(slide==''){slide=1;}
	document.getElementById('CurrentSelectedUserId').value=id;
	// DisplayGraph(id);
	Updatebox(id,slide);
	// DisplayGraphPercent(id);

	displayGraph(id);
}

function displayGraph(id) {
	document.getElementById('CurrentSelectedUserId').value=id;
	DisplayGraph(id);
	DisplayGraphPercent(id);
}