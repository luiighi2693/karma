<?php

function GetName1($tablename,$field,$where,$id){
    $uquery="SELECT * FROM $tablename WHERE $where=$id";
    $uresult=mysql_query($uquery);
    $urow=mysql_fetch_array($uresult);
    return $urow[$field];
//    echo  $uquery;
//    return $tablename.','.$field.','.$where.','.$id;
}

function GetDropdown($value,$name,$table,$args="",$sel=""){
    $comboqry = "select $value,$name from $table ".$args ;
    $combosres = mysql_query($comboqry);

    while($comboobj = mysql_fetch_array($combosres)){
        $comboobj[0]  = stripslashes($comboobj[0]);
        $comboobj[1]  = stripslashes($comboobj[1]);

        if($comboobj[0] == $sel){
            $selected ="selected";
        }else{
            $selected = "";
        }
        echo "<option $selected value='$comboobj[0]'>".trim($comboobj[1])."</option>" ;
    }
}

function getExtension($filename){
    $path_info = pathinfo($filename);
    return $path_info['extension'];
}

function make_thumb($src,$dest,$desired_width){
    $source=$src;

    $ext=getExtension($src);
    if($ext=="jpg" || $ext=="jpeg" || $ext=="JPEG" || $ext=="JPG"){
        $im=imagecreatefromjpeg($source);
    }else if($ext=="gif" || $ext=="GIF"){
        $im=imagecreatefromgif($source);
    }else if($ext=="png" || $ext=="PNG"){
        $im=imagecreatefrompng($source);
    }else if($ext=="bmp" || $ext=="BMP"){
        $im=imagecreatefromwbmp($source);
    }else{
        $im=imagecreatefromjpeg($source);
    }
    /* read the source image */
    $width = imagesx($im);
    $height = imagesy($im);

    if($width<$desired_width){
        $width=$desired_width;
    }

    /* find the "desired height" of this thumbnail, relative to the desired width  */
    $desired_height = floor($height*($desired_width/$width));
    /* create a new, "virtual" image */
    $virtual_image = imagecreatetruecolor($desired_width,$desired_height);

    //added 7-1-2013
    $fill = imagecolorallocate($virtual_image, 255, 255, 255);
    imagefill($virtual_image, 0, 0, $fill);

    //compute resize ratio
    $hratio = $desired_height / imagesy($im);
    $wratio = $desired_width / imagesx($im);
    $ratio = min($hratio, $wratio);

    //if the source is smaller than the thumbnail size,  don't resize -- add a margin instead (that is, dont magnify images)
    if($ratio > 1.0)
        $ratio = 1.0;

    //compute sizes
    $sy = floor(imagesy($im) * $ratio);
    $sx = floor(imagesx($im) * $ratio);

    $m_y = floor(($desired_height - $sy) / 2); //0;//
    $m_x = floor(($desired_width - $sx) / 2);

    /* copy source image at a resized size */
    imagecopyresampled($virtual_image,$im,$m_x,$m_y,0,0,$sx,$desired_height,imagesx($im),imagesy($im));

    /* create the physical thumbnail image to its destination */
    imagejpeg($virtual_image,$dest,100);
}


function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}

function GetAnswerChecked($questionid,$answerid,$answeertext){
    $Data='';
    $sql1="select * from users_questions where userid='".$_SESSION['UsErIdFrOnT']."' and questionid='".$questionid."' and answerid='".$answerid."'";
    $rs1=mysql_query($sql1);
    $totquestion=mysql_affected_rows();

    if($totquestion>0){
        if($answeertext==''){
            $Data='checked';
        }else{
            $row1=mysql_fetch_array($rs1);
            $Data=stripslashes($row1['answeertext']);
        }
    }
    return $Data;
}

function GetAnswerSelected($questionid,$answerid,$answeertext){
    $Data='';
    $sql1=mysql_query("select * from users_questions where userid='".$_SESSION['UsErIdFrOnT']."' and questionid='".$questionid."' and answerid='".$answerid."'");
    $totquestion=mysql_affected_rows();

    if($totquestion>0){
        if($answeertext==''){
            $Data='selected';
        }
    }
    return $Data;
}

function GetBar($userid,$groupid){
    $totalQuestionInGroupRs=mysql_query("SELECT id FROM questions WHERE groupid='".$groupid."'");
    $totalQuestionInGroup=mysql_affected_rows();
    $sql1=mysql_query("select id from users_questions where userid='".$userid."' and groupid='".$groupid."'");
    $totquestionanswered=mysql_affected_rows();
    $total=intval(($totquestionanswered*100)/$totalQuestionInGroup);
    return $total;
}

function GetBarPercent($userid,$groupid){
    $TotalOutput=0;
    $sql1="select id,questionid,answerid from users_questions where userid='".$userid."' and groupid='".$groupid."' and answerid>0";
    $rs1=mysql_query($sql1);
    $totquestionanswered=mysql_affected_rows();

    $sql1_MAINUSER="select id from users_questions where userid='".$_SESSION['UsErIdFrOnT']."' and groupid='".$groupid."' and answerid>0  ";
    $rs1_MAINUSER=mysql_query($sql1_MAINUSER);
    $totquestionanswered_MAINUSER=mysql_affected_rows();

    if($totquestionanswered>0){
        while($row1=mysql_fetch_array($rs1)){
            $sql1_NEW="select id from users_questions where userid='".$_SESSION['UsErIdFrOnT']."' and groupid='".$groupid."' and answerid>0 and questionid='".$row1['questionid']."' and answerid='".$row1['answerid']."'";
            $rs1_NEW=mysql_query($sql1_NEW);
            $totquestionanswered_NEW=mysql_affected_rows();
            if($totquestionanswered_NEW>0){
                $TotalOutput++;
            }
        }
    }
    $total=intval(($TotalOutput*100)/$totquestionanswered_MAINUSER);
    return $total;
}

function GetAvatarImage($avatarid,$big='1'){
    $totalQuestionInGroupRs=mysql_query("SELECT * FROM avatars WHERE id='".$avatarid."'");
    $totalQuestionInGroup=mysql_affected_rows();

    if($totalQuestionInGroup>0){
        $totalQuestionInGroupRow=mysql_fetch_array($totalQuestionInGroupRs);
        $picture=$totalQuestionInGroupRow['picture'];
        if($big==''){
            $ret="imagemy_GOOD_white.php?nm=Avatars/".$picture."&mwidth=75&mheight=114";
        }else{
            $ret="Avatars/".$picture."";
        }
    }else{
        $ret="images/noimage.jpg";
    }
    return $ret;
}

function TotalQuestionsAnswered($userid=''){
    if($userid!=''){$andqry=" and userid='".$userid."'";}
    $sql1="select id from users_questions where 1=1 $andqry";
    $rs1=mysql_query($sql1);
    $totquestionanswered=mysql_affected_rows();
    return number_format($totquestionanswered);
}

function GetUserName($userid){
    $andqry=" and id='".$userid."'";
    $sql1="select username,couponcode from users where 1=1 $andqry";
    $rs1=mysql_query($sql1);
    $totquestionanswered=mysql_affected_rows();

    if($totquestionanswered>0){
        $GetUsersQryRow=mysql_fetch_array($rs1);
        if($GetUsersQryRow['username']!=''){
            return stripslashes($GetUsersQryRow['username']);
        }else{
            return stripslashes($GetUsersQryRow['couponcode']);
        }
    }
    return null;
}

function GetUserOnlineStatus($userid){
    $andqry=" and id='".$userid."'";
    $sql1="select online from users where 1=1 $andqry";
    $rs1=mysql_query($sql1);
    $totquestionanswered=mysql_affected_rows();

    if($totquestionanswered>0){
        $GetUsersQryRow=mysql_fetch_array($rs1);
        if($GetUsersQryRow['online']=='Y'){
            return "<img src='images/green_dot.png' align='absmiddle' border=0 />";
        }else{
            return "<img src='images/red_dot.png' align='absmiddle' border=0 />";
        }
    }
    return null;
}

function WebsiteWithProperUrl($website){
    if($website!=""){
        if(substr($website,0,8)=="https://"){
            $Htttpth="";
        }else if(substr($website,0,7)=="http://"){
            $Htttpth="";
        }else {
            $Htttpth="http://";
        }
        return $Htttpth.$website;
    }else{
        return "#";
    }
}

function GetTotalIntro($userid=''){
    if($userid!=''){$andqry=" and  userid_to='".$userid."'";}
    $sql1="select id from   users_emails where 1=1 and viewed='N' and TYPE='introduction' $andqry";
    $rs1=mysql_query($sql1);
    $totquestionanswered=mysql_affected_rows();
    if($totquestionanswered>0){
        return $totquestionanswered;
    }else{
        return '';
    }
}

function GetTotalGroups($userid=''){
    if($userid!=''){$andqry=" and  userid_to='".$userid."'";}
    $sql1="select id from   users_emails where 1=1 and viewed='N' and TYPE='groups' $andqry";
    $rs1=mysql_query($sql1);
    $totquestionanswered=mysql_affected_rows();
    if($totquestionanswered>0){
        return $totquestionanswered;
    }else{
        return '';
    }
}

function GetTotalChat($userid=''){
    if($userid!=''){$andqry=" and  userid_to='".$userid."'";}
    $sql1="select distinct	 userid_from from  users_chat where 1=1 $andqry and  seen='N'";
    $rs1=mysql_query($sql1);
    $totquestionanswered=mysql_affected_rows();
    if($totquestionanswered>0){
        return $totquestionanswered;
    }else{
        return '';
    }
}

function GetTotalGoOut($userid=''){
    if($userid!=''){$andqry=" and  userid_to='".$userid."'";}
    $sql1="select id from   users_emails where 1=1 and viewed='N' and TYPE='goout' $andqry";
    $rs1=mysql_query($sql1);
    $totquestionanswered=mysql_affected_rows();
    if($totquestionanswered>0){
        return $totquestionanswered;
    }else{
        return '';
    }
}

function GetMyColor($userid,$short=''){
    $andqry=" and id='".$userid."'";
    $sql1="select groupid from users where 1=1 $andqry";
    $rs1=mysql_query($sql1);
    $totquestionanswered=mysql_affected_rows();
    if($totquestionanswered>0){
        $GetUsersQryRow=mysql_fetch_array($rs1);
        $color=GetName1("groups","color","id",$GetUsersQryRow['groupid']);
    }else{
        $color='';
    }
    if($color!=''){
        if($short==''){
            $ret='style="background:'.$color.'"';
        }else{
            $ret=str_replace("#","",$color);
        }
    }else{
        if($short==''){
            $ret='style="background:#65b9d0;"';
        }else{
            $ret="65b9d0";
        }
    }
    return $ret;
}

function GetTotalHide($userid=''){
    if($userid!=''){
        $andqry=" and  userid_from='".$userid."'";
    }else{
        $andqry="";
    }
    $sql1="select id from  users_hide where 1=1 $andqry";
    $rs1=mysql_query($sql1);
    $totquestionanswered=mysql_affected_rows();
    if($totquestionanswered>0){
        return $totquestionanswered;
    }else{
        return '';
    }
}

function GetUserChatNotifier($userid_from,$userid_to){
    if($userid_from!=''){$andqry=" and  userid_from='".$userid_from."' and  userid_to='".$userid_to."' and  	seen='N'";}
    $sql1="select id from  users_chat where 1=1 $andqry";
    $rs1=mysql_query($sql1);
    $totquestionanswered=mysql_affected_rows();
    if($totquestionanswered>0){
        return "<span><img src='images/star.png' align='right'></span>";
    }else{
        return '';
    }
}

function GetGenderDropdown($name,$sel=''){
    if($sel=='Male'){$SSS1='selected';}
    if($sel=='Female'){$SSS2='selected';}
    if($sel=='Group'){$SSS3='selected';}

    $ret="<select name='".$name."' id='".$name."'  onchange=\"SaveWhatIwantAnswer('".$name."',this.value);\">";
    $ret.="<option value=''>Select</option>";
    $ret.="<option value='Male' ".$SSS1.">Male</option>";
    $ret.="<option value='Female' ".$SSS2.">Female</option>";
    $ret.="<option value='Group' ".$SSS3.">Group</option>";
    $ret.="</select>";

    return $ret;
}

function GetMessageTypeIcon($type){
    if($type=='introduction'){
        $ret="<img src='images/icon_intro.png' align='absmiddle'  width='25' height='30' />";
    }else if($type=='groups'){
        $ret="<img src='images/icon_group.png' align='absmiddle' border=0 width='25' height='30' />";
    }
    else if($type=='goout')
    {
        $ret="<img src='images/icon_outing_white.png' align='absmiddle' border=0 width='25' height='30' />";
    }
    else if($type=='safe')
    {
        $ret="<img src='images/icon_safe.png' align='absmiddle' border=0 width='25' height='30' />";
    }
    else if($type=='socialLinks')
    {
        $ret="<img src='images/icon_facebook.png' align='absmiddle' border=0 width='25' height='30' />";
    }
    else if($type=='torb')
    {
        $ret="<img src='images/icon_bomb.png' align='absmiddle' border=0 width='25' height='30' />";
    }
    else if($type=='music')
    {
        $ret="<img src='images/icon_music.png' align='absmiddle' border=0 width='25' height='30' />";
    }
    else if($type=='stars')
    {
        $ret="<img src='images/icon_star.png' align='absmiddle' border=0 width='25' height='30' />";
    }
    return $ret;
}

function CheckEitherSharedOrNot($field,$userid_from,$userid_to){
    $getusers_sociallinks_shareRs=mysql_query("SELECT * FROM users_sociallinks_share WHERE userid_from='".$userid_from."' and userid_to='".mysql_real_escape_string($_REQUEST['userid_to'])."'");
    $Totgetusers_sociallinks_share=mysql_affected_rows();
    if($Totgetusers_sociallinks_share>0){
        $getusers_sociallinks_shareRow=mysql_fetch_array($getusers_sociallinks_shareRs);
        $result=$getusers_sociallinks_shareRow[$field];
        if($result=='Y'){
            return "checked";
        }else{
            return "";
        }
    }else{
        return "";
    }
}

function CheckEitherPICVIDEOShareOrNot($id,$userid_from,$userid_to){
    $getusers_sociallinks_shareRs=mysql_query("SELECT * FROM users_pics_videos_share WHERE picid='".$id."' and userid_from='".$userid_from."' and userid_to='".mysql_real_escape_string($_REQUEST['userid_to'])."'");
    $Totgetusers_sociallinks_share=mysql_affected_rows();
    if($Totgetusers_sociallinks_share>0){
        return "checked";
    }else{
        return "";
    }
}

function GetTotalZap($userid=''){
    if($userid!=''){
        $andqry=" and   userid_to='".$userid."'";
    }else{
        $andqry="";
    }
    $sql1="select id from  users_zap where 1=1 $andqry";
    $rs1=mysql_query($sql1);
    $totquestionanswered=mysql_affected_rows();

    if($totquestionanswered>0){
        return $totquestionanswered;
    }else{
        return '';
    }
}

function GetLikeTaggedChecked($userid_from,$userid_to,$type){
    $sql1="select * from  users_likes_tagged where userid_from='".$userid_from."' and userid_to='".$userid_to."' and type='".$type."'";
    $rs1=mysql_query($sql1);
    $totquestion=mysql_affected_rows();
    if($totquestion<=0){
        return "";
    }else{
        return 'checked';
    }
}

?>