<script type="text/javascript">
function show_pop(urls)
{
	ivar=document.getElementById('CurrentSelectedUserId').value;
	if((ivar>0 && ivar!='' && ivar!=<? echo $_SESSION['UsErIdFrOnT'];?>) || (urls=='popup_chat.php') || (urls=='popup_calendar.php') || (urls=='popup_emails.php') || (urls=='popup_options.php') || (urls=='popup_bail.php') || (urls=='popup_safe.php')|| (urls=='popup_challenge.php')|| (urls=='popup_menu.php') || (urls=='popup_bucketlist.php') || (urls=='popup_truthbomb2.php')|| (urls=='popup_dashboard.php')|| (urls=='popup_dashboard2.php') )
	{
		jQuery.noConflict();
		jQuery.ajax({
			type: "GET",
			url: urls,
			data: { id:ivar } ,
			success: function( response )
			{
				document.getElementById('rightsidePOPUP_MAIN').style.display='block';
				document.getElementById('rightsidePOPUP').innerHTML=response;
				if(urls=='popup_hide.php' || urls=='popup_stars.php' ||  urls=='popup_zap.php' || (urls=='popup_challenge.php') )
				{
					document.getElementById('pad_newlife').style.backgroundColor='#199579';
				}
				else
				{
					if((urls=='popup_menu.php'))
					{
					document.getElementById('rightsidePOPUP2').innerHTML=response;
					document.getElementById('pad_newlife').style.backgroundColor='#5D4C46';
					}else{
					document.getElementById('pad_newlife').style.backgroundColor='#5D4C46';
					}
				}
			}
		});
	}
	else
	{
		alert("Please select soulmate from left side.");
	}	
}
function hide_pop()
{
	document.getElementById('rightsidePOPUP_MAIN').style.display='none';
}

function verifyTypeMail() {
	jQuery.ajax({
		type: "POST",
		url: "util.php",
		data: {
			"method" : "verifyTypeMail",
			"idMail" :  mailSelected
		},
		success: function(data){
			if(data == "true"){
				document.getElementById("bombIcon").style.display="block";
				document.getElementById("haloIcon").style.display="block";
			}else{
				document.getElementById("bombIcon").style.display="none";
				document.getElementById("haloIcon").style.display="none";
			}
		}
	});
}

function saveAnswer(userId, questionId, userToId, type, typeTable, typeTableId, accepted) {
	//alert(userId+" "+questionId+" "+document.getElementById("txtAreaUser").value);
	if(document.getElementById("txtAreaUser").value == ""){
		alert("empty answer");
	}else{
		jQuery.ajax({
			type: "POST",
			url: "util.php",
			data: {
				"method" : "addAnswer",
				"id_question" :  questionId ,
				"id_user" : userId,
				"answer" : document.getElementById("txtAreaUser").value
			},
			success: function(data){
				sendEmail(userToId, userId, type, typeTable, typeTableId+","+data, accepted);
			}
		});
	}
}


	function sendEmail(userIdTo, userIdFrom, type, typeTable, typeTableId, accepted) {
		jQuery.ajax({
			type: "POST",
			url: "util.php",
			data: {
				"method" : "sendMail",
				"userIdTo" :  userIdTo,
				"userIdFrom" :  userIdFrom,
				"type" :  type,
				"typeTable" :  typeTable,
				"typeTableId" :  typeTableId,
				"accepted" :  accepted
			},
			success: function(data){
				console.log(data);
			}
		});
		//console.log(userIdTo+"  "+userIdFrom+"  "+type+"  "+typeTable+"  "+typeTableId+"  "+accepted);
	}
	
	function reply() {
		if(typeMailSelected == "torb"){
			//alert(mailSelected);
			jQuery.ajax({
				type: "POST",
				url: "util.php",
				data: {
					"method" : "saveMailId",
					"mailId" :  mailSelected
				},
				success: function(data){
					console.log(data);
					hide_pop();
					show_pop('popup_truthbomb2.php');
				}
			});


		}
	}

	function hideUser() {
		jQuery.ajax({
			type: "POST",
			url: "util.php",
			data: {
				"method" : "hideUser",
				"idMail" :  mailSelected
			},
			success: function(data){
				alert("user in hide list Succsefully");
				show_pop('popup_emails.php');
			}
		});
	}
	
	function promptChat() {
		var result = prompt("Do you want to chat with this user?", "yes");
		if(result != null){
			if(result=="Yes" || result=="yes" || result == "y"){
				show_pop('popup_chat.php');
			}
		}
	}

	function deleteBunckedListElements(idUser){
		var list =document.getElementById('buckedList');
		for (var i=0; i<list.childElementCount; i++){
			if(list.children[i].children[0].children[0].checked){
				jQuery.ajax({
					type: "POST",
					url: "util.php",
					data: {
						"method" : "deleteBuckedElement",
						"idElement" :  list.children[i].children[0].children[0].id,
						"userId" : idUser
					},
					success: function(data){
						console.log(data);
					}
				});
			}
		}
		show_pop('popup_bucketlist.php');
	}

function DeleteEmailList(){
	var list =document.getElementById('mailList');
	for (var i=0; i<list.childElementCount; i++){
		if(list.children[i].children[3].children[0].checked){
			DeleteEmail(list.children[i].children[3].children[0].id);
		}
	}
	setTimeout(function() {
		hide_pop();
		show_pop('popup_emails.php');
	}, 1500);
}

function deleteAccount(id) {
    if(document.getElementById('checkboxToDeleteAccount').checked){
        jQuery.ajax({
            type: "POST",
            url: "util.php",
            data: {
                "method" : "deleteUserAccount",
                "id" :  id
            },
            success: function(data){
                console.log(data);
                location.href='http://www.karmathegame.org/karmathegame/login.php';
            }
        });
    }else{
        alert('PLEASE, CHECK THE BOX BELOW THEN PRESS THE DESTROY BUTTON');
    }
}
</script>
<link rel="stylesheet" href="dhtmlgoodies_calendar.css?random=20051112" media="screen"></link>
<script type="text/javascript" src="dhtmlgoodies_calendar.js?random=<? echo rand();?>"></script>
<div class="icon_list clearfix">
  <ul>
	<li style="background:#5D4C46;height:80px; width:31.5%; margin-right:3px;"><span class="notifier_box"><? echo GetTotalIntro($_SESSION['UsErIdFrOnT']);?></span><a href="#" onclick="show_pop('popup_introduction.php');"><img src="images/icon_intro.png" style="margin: 10 auto;height:56px; width:56px;" alt="INTRODUCTION" title="INTRODUCTION" border="0"/></a></li>
	<li style="background:#5D4C46;height:80px; width:31.5%;margin-right:3px;"><span class="notifier_box"><? echo GetTotalChat($_SESSION['UsErIdFrOnT']);?></span><a href="#" onclick="show_pop('popup_chat.php');Callchateverysec();"><img src="images/icon_chat.png" style="margin: 10 auto;height:56px; width:56px;padding:3px;" alt="CHAT" title="CHAT" border="0"/></a></li>
	<li style="background:#5D4C46;height:80px; width:31.5%;margin-right:3px;"><span class="notifier_box"><? echo GetTotalGroups($_SESSION['UsErIdFrOnT']);?></span><a href="#" onclick="show_pop('popup_groups.php');"><img src="images/icon_group.png" style="margin: 10 auto;height:56px; width:56px;" alt="GROUPS" title="GROUPS" border="0"/></a></li>
	
	<li style="background:#5D4C46;height:80px; width:31.5%; margin-right:3px; margin-top:2px;"><span class="notifier_box"><? echo GetTotalGoOut($_SESSION['UsErIdFrOnT']);?></span><a href="#" onclick="show_pop('popup_letsgoout.php');"><img src="images/outingWhiteFill.png" style="margin: 10 auto;height:56px; width:56px;" alt="LET'S GO OUT!!!" title="LET'S GO OUT!!!" border="0"/></a></li>
	<li style="background:#5D4C46;height:80px; width:31.5%;margin-right:3px; margin-top:2px;"><span class="notifier_box"></span><a href="#" onclick="show_pop('popup_safe.php');"><img src="images/safeWhiteFill.png" style="margin: 10 auto;height:56px; width:56px;" alt="SAFE" title="SAFE"  border="0"/></a></li>
	<li style="background:#5D4C46;height:80px; width:31.5%; margin-top:2px;"><span class="notifier_box"></span><a href="#" onclick="show_pop('popup_calendar.php');"><img src="images/icon_calendar.png" 
	style="height:56px;width:60px; margin: 10 auto; " alt="" border="0"/></a></li>
	
	<li style="background:#220E0F;height:80px; width:31.5%;margin-right:3px;"><span class="notifier_box"></span><a href="#"></a></li>
	<li style="background:#220E0F;height:80px; width:31.5%;margin-right:3px;"><a href="#"
                                                                         onclick="show_pop('popup_emails.php');"><img
                        src="images/icon_email.png" style="height:56px; width:60px;margin: 10 10;" alt="EMAIL"
                        title="EMAIL" border="0"></a></li>
	<li style="background:#220E0F;height:80px; width:31.5%;margin-right:3px;"><span class="notifier_box"></span><a href="#"></a></li>
	
	<li style="background:#5D4C46;height:80px; width:31.5%;margin-right:3px; margin-top:2px;"><span class="notifier_box"></span><a href="#"><img src="images/icon_music.png" style="height:56px; width:60px; margin: 10 auto;" alt="" border="0"/></a></li>
	<li style="background:#5D4C46;height:80px; width:31.5%;margin-right:3px; margin-top:2px;"><span class="notifier_box"></span><a href="#" onclick="show_pop('popup_truthbomb.php');"><img src="images/icon_bomb.png" style="height:56px; width:56px; margin: 10 auto;" alt="" border="0"/></a></li>
	
	<li style="background:#5D4C46;height:80px; width:31.5%;margin-top:2px;"><span class="notifier_box"><? echo GetTotalHide($_SESSION['UsErIdFrOnT']);?></span><a href="#" onclick="show_pop('popup_hide.php');"><img src="images/icon_hide.png" style="height:56px; width:56px; margin: 10 auto;" alt="" border="0"/></a></li>
	
	<li style="background:#5D4C46;height:80px; width:31.5%;margin-right:3px; margin-top:2px;"><span class="notifier_box"></span><a href="#" onclick="show_pop('popup_stars.php');"><img src="images/icon_star.png" style="height:56px; width:56px;margin: 10 auto;" alt="" border="0"/></a></li>
	<li style="background:#5D4C46;height:80px; width:31.5%;margin-right:3px; margin-top:2px;"><span class="notifier_box"></span><a href="#" onclick="show_pop('popup_challenge.php');"><img src="images/icon_challenge.png" style="height:56px; width:56px;margin: 10 auto;" alt="" border="0"/></a></li>
	
	<li style="background:#5D4C46;height:80px; width:31.5%;margin-top:2px;"><span class="notifier_box"><? echo GetTotalZap($_SESSION['UsErIdFrOnT']);?></span><a href="#" onclick="show_pop('popup_zap.php');"><img src="images/icon_zap.png" style="height:56px; width:60px;margin: 10 auto;" alt="" border="0"/></a></li>
	
	
	<?php /*?><li><span class="notifier_box"></span><a href="#"><img src="images/icon17.jpg" alt="" border="0"/></a></li>
	<li><span class="notifier_box"></span><a href="#"><img src="images/icon18.jpg" alt="" border="0"/></a></li>
	<li><span class="notifier_box"></span><a href="#"><img src="images/icon19.jpg" alt="" border="0"/></a></li>
	<li><span class="notifier_box"></span><a href="#"><img src="images/icon20.jpg" alt="" border="0"/></a></li><?php */?>
  </ul>
</div><input type="hidden" name="CurrentSelectedUserId" id="CurrentSelectedUserId" value="<? echo $_SESSION['UsErIdFrOnT'];?>" /><input type="hidden" name="FooterSoulmates" id="FooterSoulmates" value="" />