<table width="96%" border="0" cellspacing="0" cellpadding="0" >
  <tr>
    <td width="5%"><img src="images/login/bullet1.jpg" alt="bullet" width="10" height="29" /></td>
    <td width="95%" background="images/login/leftbg.jpg">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <? if ($mlevel==0){?>
			<tr>
			  <td height="20" class="mail_font">Users Management</td>
			</tr>
			<tr>
			  <td height="20" class="menuon" onClick="javascript:document.location.href='manage_user.php';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Manage Users</td>
			</tr>
			<tr>
			  <td height="29" class="mail_font">Sub Group Management</td>
			</tr>
			<tr>
			  <td height="29" class="menuon" onClick="javascript:document.location.href='manage_groups_sub.php';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Manage Sub Group</td>
			</tr>
			<tr>
			  <td height="29" class="mail_font">Avatars Management</td>
			</tr>
			<tr>
			  <td height="29" class="menuon" onClick="javascript:document.location.href='manage_avatars.php';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Manage Avatars</td>
			</tr>
			<tr>
			  <td height="29" class="mail_font">Question Management</td>
			</tr>
			<tr>
			  <td height="29" class="menuon" onClick="javascript:document.location.href='manage_question.php';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Manage Questions</td>
			</tr>
			<tr>
			  <td height="29" class="mail_font">Static Page Management</td>
			</tr>
			<tr>
			  <td height="29" class="menuon" onClick="javascript:document.location.href='editcontents.php?id=1';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">About Us</td>
			</tr>
			<tr>
			  <td height="29" class="mail_font">Change Admin Password </td>
			</tr>
			<tr>
			  <td height="29" class="menuon" onclick="javascript:document.location.href='changepass.php';" onmouseover="className='menuover';" onmouseout="className='menuon';">Change Admin password</td>
			</tr>
			<tr>
			  <td height="29" class="mail_font">Banner Management</td>
			</tr>
			<tr>
			  <td height="29" class="menuon" onClick="javascript:document.location.href='manage_banners.php';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Manage Banner</td>
			</tr>
        <? }else if($mlevel==1){?>
			<tr>
			  <td height="29" class="mail_font">Static Page Management</td>
			</tr>
			<tr>
			  <td height="29" class="menuon" onClick="javascript:document.location.href='editcontents.php?id=1';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">About Us</td>
			</tr>
			<tr>
			  <td height="29" class="menuon" onClick="javascript:document.location.href='editcontents.php?id=2';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Contact Us</td>
			</tr>
			<tr>
			  <td height="29" class="menuon" onClick="javascript:document.location.href='editcontents.php?id=3';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">FAQ</td>
			</tr>
			<tr>
			  <td height="29" class="menuon" onClick="javascript:document.location.href='editcontents.php?id=4';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Privacy</td>
			</tr>
			<tr>
			  <td height="29" class="menuon" onClick="javascript:document.location.href='editcontents.php?id=5';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Terms of Use</td>
			</tr>
			<tr>
			  <td height="29" class="menuon" onClick="javascript:document.location.href='editcontents.php?id=6';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Help</td>
			</tr>
			
		<? }else if($mlevel==2){?>
			<tr>
			  <td height="29" class="mail_font">Users Management</td>
			</tr>
			<tr>
			  <td height="29" class="menuon" onClick="javascript:document.location.href='manage_user.php';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Manage Users</td>
			</tr>
			 <tr>
			  <td height="20" class="menuon" onClick="javascript:document.location.href='add_user.php';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Add User</td>
			</tr>
		<? }else if($mlevel==3){?>
			<tr>
			  <td height="29" class="mail_font">Sub Group Management</td>
			</tr>
			<tr>
			  <td height="29" class="menuon" onClick="javascript:document.location.href='manage_groups_sub.php';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Manage Sub Group</td>
			</tr>
			 <tr>
			  <td height="20" class="menuon" onClick="javascript:document.location.href='add_groups_sub.php';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Add Sub Group</td>
			</tr>
			<tr>
			  <td height="29" class="mail_font">Avatars Management</td>
			</tr>
			<tr>
			  <td height="29" class="menuon" onClick="javascript:document.location.href='manage_avatars.php';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Manage Avatars</td>
			</tr>
			<tr>
			  <td height="29" class="mail_font">Options Group Management</td>
			</tr>
			<tr>
			  <td height="29" class="menuon" onClick="javascript:document.location.href='manage_option_group.php';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Manage Options Group</td>
			</tr>
			 <tr>
			  <td height="20" class="menuon" onClick="javascript:document.location.href='add_option_group.php';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Add Options Group</td>
			</tr>
			<tr>
			  <td height="29" class="mail_font">Options Group Values Management</td>
			</tr>
			<tr>
			  <td height="29" class="menuon" onClick="javascript:document.location.href='manage_option_group_values.php';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Manage Options Group Values</td>
			</tr>
			 <tr>
			  <td height="20" class="menuon" onClick="javascript:document.location.href='add_option_group_values.php';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Add Options Group Values</td>
			</tr>
			<tr>
			  <td height="29" class="mail_font">Manage Looking For</td>
			</tr>
			<tr>
			  <td height="29" class="menuon" onClick="javascript:document.location.href='manage_lookingfor.php';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Manage Looking For</td>
			</tr>
			 <tr>
			  <td height="20" class="menuon" onClick="javascript:document.location.href='add_lookingfor.php';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Add Looking For</td>
			</tr>
			<tr>
			  <td height="29" class="mail_font">Manage Emoticons</td>
			</tr>
			<tr>
			  <td height="29" class="menuon" onClick="javascript:document.location.href='manage_emoticons.php';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Manage Emoticons</td>
			</tr>
			 <tr>
			  <td height="20" class="menuon" onClick="javascript:document.location.href='add_emoticons.php';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Add Emoticons</td>
			</tr>
		<? }else if($mlevel==4){?>
			<tr>
			  <td height="29" class="mail_font">Question Management</td>
			</tr>
			<tr>
			  <td height="29" class="menuon" onClick="javascript:document.location.href='manage_question.php';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Manage Questions</td>
			</tr>
			 <tr>
			  <td height="20" class="menuon" onClick="javascript:document.location.href='add_question.php';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Add Question</td>
			</tr>
		<? }else if($mlevel==5){?>
			<tr>
			  <td height="29" class="mail_font">QR Codes Management</td>
			</tr>
			<tr>
			  <td height="29" class="menuon" onClick="javascript:document.location.href='manage_qrcodes.php';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Manage QR Codes</td>
			</tr>
			 <tr>
			  <td height="20" class="menuon" onClick="javascript:document.location.href='add_qrcode.php';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Add QR Code</td>
			</tr>
		<? }else if($mlevel==55){?>
			<tr>
			  <td height="29" class="mail_font">Street Marketers Management</td>
			</tr>
			<tr>
			  <td height="29" class="menuon" onClick="javascript:document.location.href='manage_marketers.php';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Manage Street Marketers</td>
			</tr>
			 <tr>
			  <td height="20" class="menuon" onClick="javascript:document.location.href='add_marketers.php';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Add Street Marketer</td>
			</tr>	
		<? }else if($mlevel==6){?>
			<tr>
			  <td height="29" class="mail_font">Coupons Management</td>
			</tr>
			<tr>
			  <td height="29" class="menuon" onClick="javascript:document.location.href='manage_coupons.php';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Manage Coupons</td>
			</tr>
			 <tr>
			  <td height="20" class="menuon" onClick="javascript:document.location.href='add_coupons.php';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Add Coupon</td>
			</tr>
		<? } else if($mlevel==7){?>
			<tr>
			  <td height="29" class="mail_font">Change Admin Password </td>
			</tr>
			<tr>
			  <td height="29" class="menuon" onclick="javascript:document.location.href='changepass.php';" onmouseover="className='menuover';" onmouseout="className='menuon';">Change Admin password</td>
			</tr>
			<tr>
			  <td height="29" class="mail_font">Admin E-Mail Address</td>
			</tr>
			<tr>
			  <td height="29" class="menuon" onClick="javascript:document.location.href='manage_mail.php';" onmouseover="className='menuover';" onmouseout="className='menuon';">Update Admin E-Mail Address</td>
			</tr>
			<tr>
			  <td height="29" class="mail_font">Google Analytics</td>
			</tr>
			<tr>
			  <td height="29" class="menuon" onClick="javascript:document.location.href='google_analytic.php';" onmouseover="className='menuover';" onmouseout="className='menuon';">Google Analytics</td>
			</tr>
			<tr>
			  <td height="29" class="mail_font">Social Links</td>
			</tr>
			<tr>
			  <td height="29" class="menuon" onClick="javascript:document.location.href='update_links.php';" onmouseover="className='menuover';" onmouseout="className='menuon';">Update Social Links</td>
			</tr>
			<tr>
			  <td height="29" class="mail_font">Banner Management</td>
			</tr>
			<tr>
			  <td height="29" class="menuon" onClick="javascript:document.location.href='manage_banners.php';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Manage Banner</td>
			</tr>
			<tr>
			  <td height="29" class="menuon" onClick="javascript:document.location.href='add_banner.php';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Add Banner</td>
			</tr>
			
		<? }else if($mlevel==8){?>
			<tr>
			  <td height="29" class="mail_font">Ideas Management</td>
			</tr>
			<tr>
			  <td height="29" class="menuon" onClick="javascript:document.location.href='manage_ideas.php';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Manage Ideas</td>
			</tr>
			 <tr>
			  <td height="20" class="menuon" onClick="javascript:document.location.href='add_ideas.php';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Add Ideas</td>
			</tr>
                <? }else if($mlevel==9){?>
			<tr>
			  <td height="29" class="mail_font">Truth Management</td>
			</tr>
			<tr>
			  <td height="29" class="menuon" onClick="javascript:document.location.href='manage_truth.php';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Manage truth</td>
			</tr>
			 <tr>
			  <td height="20" class="menuon" onClick="javascript:document.location.href='add_truth.php';" onMouseOver="className='menuover';" onMouseOut="className='menuon';">Add truth</td>
			</tr>
		<? } ?>
	  </table></td>
  </tr>
</table>