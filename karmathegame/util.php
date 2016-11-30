<?

include("connect.php");

include("checklogin.php");



if($_POST['method']=='addAnswer'){

    addAnswer();

}



if($_POST['method']=='addBucketlist'){

    addBucketlist();

}



if($_POST['method']=='sendMail'){

    sendMail();

}



if($_POST['method']=='saveMailId'){

    saveMailId();

}



if($_POST['method']=='verifyTypeMail'){

    verifyTypeMail();

}



if($_POST['method']=='hideUser'){

    hideUser();

}



if($_POST['method']=='deleteBuckedElement'){

    deleteBuckedElement();

}



if($_POST['method']=='verifyUserNew'){

    verifyUserNew();

}



if($_POST['method']=='updateInfoUser'){

    updateInfoUser();

}



if($_POST['method']=='shareImage'){

    shareImage();

}



if($_POST['method']=='DeleteShareMultimedia'){

    DeleteShareMultimedia();

}



if($_POST['method']=='searchUser'){

    searchUser();

}



if($_POST['method']=='saveMusicShare'){

    saveMusicShare();

}



if($_POST['method']=='deleteUserAccount'){

    deleteUserAccount();

}



function addAnswer(){

    $id_question = $_POST['id_question'];

    $id_user = $_POST['id_user'];

    $answer = $_POST['answer'];

    $query = "INSERT INTO torb_question_answers SET id_question=".$id_question.", userid_from=".$id_user.", answer='".$answer."'";

    $q = mysql_query($query);



    $query = mysql_query("SELECT * FROM torb_question_answers WHERE id_question=".$id_question." and userid_from=".$id_user);

    $queryArray = mysql_fetch_array($query);

    echo $queryArray['id'];

}



function addBucketlist(){

    $ideaId = $_POST['ideaId'];

    $userId = $_POST['userId'];



    $querySelect = mysql_query("SELECT *  FROM bucket_list WHERE userid=".$userId." and ideaid=".$ideaId);

    $numfilas = mysql_num_rows($querySelect);

    if ($numfilas == 0) {

        $query = "INSERT INTO bucket_list SET userid=".$userId.", ideaid=".$ideaId.", addeddate='".date("Y-m-d H:i:s")."'";

        $q = mysql_query($query);

        echo $q;

    }else{

        echo 'error';

    }



}



function sendMail(){

    $userIdTo = $_POST['userIdTo'];

    $userIdFrom = $_POST['userIdFrom'];

    $type = $_POST['type'];

    $typeTable = $_POST['typeTable'];

    $typeTableId = $_POST['typeTableId'];

    $accepted = $_POST['accepted'];



    $query = "INSERT INTO users_emails SET userid_from=".$userIdFrom.", userid_to=".$userIdTo.", TYPE='".$type."', TYPE_TABLE='".$typeTable."', TYPE_TABLE_ID='".$typeTableId."', accepted='".$accepted."', rejected='N', createdate='".date("Y-m-d H:i:s")."', ipaddress='".get_client_ip()."', viewed='N'";

    $q = mysql_query($query);

    echo $q;

}



function saveMailId(){

    $_SESSION['mailId'] = $_POST['mailId'];

    echo $_SESSION['mailId'];

}



function verifyTypeMail(){

    $idMail = $_POST['idMail'];

    $query = mysql_query("SELECT * FROM users_emails WHERE id=".$idMail);

    $queryArray = mysql_fetch_array($query);

    if($queryArray['TYPE'] == 'torb' && $queryArray['accepted']=='Y'){

       echo 'true';

    }else{

        echo 'false';

    }



}



function hideUser(){

    $idMail = $_POST['idMail'];

    $query = mysql_query("SELECT * FROM users_emails WHERE id=".$idMail);

    $queryArray = mysql_fetch_array($query);

    $query2 = "INSERT INTO users_hide SET userid_from=".$queryArray['userid_to'].", userid_to=".$queryArray['userid_from'].", addeddate='".date("Y-m-d H:i:s")."'";

    $q = mysql_query($query2);

}



function deleteBuckedElement(){

    $idElement = $_POST['idElement'];

    $userId = $_POST['userId'];

    $query = mysql_query("DELETE FROM bucket_list WHERE bucket_list.userid='".$userId."' and  id=".$idElement);

    echo $query;

}



function verifyUserNew(){

    $userId =  $_POST['userId'];

    $query = mysql_query("SELECT * FROM users WHERE id=".$userId);

    $queryArray = mysql_fetch_array($query);

    if($queryArray['active'] == 'N'){

        echo 'NoActive';

    }else{

        echo 'Active';

    }

}



function updateInfoUser(){

    $userId =  $_POST['userId'];

    $username =  $_POST['username'];

    $password =  $_POST['password'];

    $aboutme =  $_POST['aboutme'];



    $updateQry = mysql_query("UPDATE users set username='".$username."',password='".$password."',aboutme='".$aboutme."', active='Y' WHERE id='".$userId."'");

}



function shareImage(){

    $userIdTo = $_POST['userIdTo'];

    $userIdFrom = $_POST['userIdFrom'];

    $picId = $_POST['picId'];



    $query = "INSERT INTO users_pics_videos_share SET userid_from=".$userIdFrom.", userid_to=".$userIdTo.", picid='".$picId."', addeddate='".date("Y-m-d H:i:s")."'";

    $q = mysql_query($query);

    echo $q;

}



function DeleteShareMultimedia(){

    $id = $_POST['id'];

    $query = mysql_query("SELECT * FROM users_pics_videos WHERE id=".$id);

    $queryArray = mysql_fetch_array($query);

//    unlink("SafePicsVideos/".$queryArray['picture']);



    $query2 = mysql_query("DELETE FROM users_pics_videos WHERE id=".$id);



    return $query2;

}


function searchUser(){
    $array = array();
    $cont =0;
    $username = $_POST['username'];

    $query = mysql_query("SELECT users.*, avatars.picture FROM users left join avatars on users.avatarid=avatars.id WHERE username LIKE '%".$username."%'");
    $rows = mysql_affected_rows();
    if ($rows>0){
        while($queryArray = mysql_fetch_array($query)){
            $array[$cont] = $queryArray['id'].','.$queryArray['picture'].','.$queryArray['username'];
            $cont++;
        }
    }

    echo json_encode($array);
}



function saveMusicShare(){

    $userIdTo = $_POST['userIdTo'];

    $userIdFrom = $_POST['userIdFrom'];

    $music = $_POST['music'];



    $query = "INSERT INTO music_share SET userid_from=".$userIdFrom.", userid_to=".$userIdTo.", music='".$music."'";

    $q = mysql_query($query);

    echo mysql_insert_id();

}



function deleteUserAccount(){

    $id = $_POST['id'];



    $query = mysql_query("DELETE FROM bucket_list WHERE userid=".$id);



    $query = mysql_query("DELETE FROM group_lock WHERE userid=".$id);

    $query = mysql_query("DELETE FROM group_lock WHERE userid_from=".$id);



    $query = mysql_query("DELETE FROM music_share WHERE userid_from=".$id);

    $query = mysql_query("DELETE FROM music_share WHERE userid_to=".$id);



    $query = mysql_query("DELETE FROM promotional WHERE userid=".$id);



    $query = mysql_query("DELETE FROM torb_question_answers WHERE userid_from=".$id);



    $query = mysql_query("DELETE FROM users WHERE id=".$id);



    $query = mysql_query("DELETE FROM users_chat WHERE userid_from=".$id);

    $query = mysql_query("DELETE FROM users_chat WHERE userid_to=".$id);



    $query = mysql_query("DELETE FROM users_emails WHERE userid_from=".$id);

    $query = mysql_query("DELETE FROM users_emails WHERE userid_to=".$id);



    $query = mysql_query("DELETE FROM users_goout WHERE userid_from=".$id);

    $query = mysql_query("DELETE FROM users_goout WHERE userid_to=".$id);



    $query = mysql_query("DELETE FROM users_groups WHERE userid=".$id);



    $query = mysql_query("DELETE FROM users_groups_members WHERE userid_from=".$id);

    $query = mysql_query("DELETE FROM users_groups_members WHERE userid_to=".$id);



    $query = mysql_query("DELETE FROM users_hide WHERE userid_from=".$id);

    $query = mysql_query("DELETE FROM users_hide WHERE userid_to=".$id);



    $query = mysql_query("DELETE FROM users_intimicy_lock_request WHERE userid_from=".$id);

    $query = mysql_query("DELETE FROM users_intimicy_lock_request WHERE userid_to=".$id);



    $query = mysql_query("DELETE FROM users_introductions WHERE userid_from=".$id);

    $query = mysql_query("DELETE FROM users_introductions WHERE userid_to=".$id);



    $query = mysql_query("DELETE FROM users_lifes WHERE userid=".$id);



    $query = mysql_query("DELETE FROM users_likes_tagged WHERE userid_from=".$id);

    $query = mysql_query("DELETE FROM users_likes_tagged WHERE userid_to=".$id);



    $query = mysql_query("DELETE FROM users_pics_videos WHERE userid=".$id);



    $query = mysql_query("DELETE FROM users_pics_videos_share WHERE userid_from=".$id);

    $query = mysql_query("DELETE FROM users_pics_videos_share WHERE userid_to=".$id);



    $query = mysql_query("DELETE FROM users_sociallinks_share WHERE userid_from=".$id);

    $query = mysql_query("DELETE FROM users_sociallinks_share WHERE userid_to=".$id);



    $query = mysql_query("UPDATE users_questions set userid=0 WHERE id=".$id);



    $_SESSION['UsErIdFrOnT']='';



    echo 'good bye';

}

?>