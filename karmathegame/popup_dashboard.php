<? include("connect.php");
include("checklogin.php");
$avatarlogo = stripslashes(GetName1("avatars", "picture", "id", $CURRENTgetuserwryRow['avatarid']));
$msg = "Updated Successfully!";
?>

<div class="dashboardpopup" style="width: 100%;height: 100%;">
    <div id="pad_wrapper_newlife">
        <div id="pad_newlife" style="border:0 solid gray;	border-radius:0;max-width:100%;">
            <div style="width: 100%;">
                <div style="width: 100%; display: flex;    margin: 1%;     height: 38%;">
                    <div style="vertical-align:top; width: 20%;    margin-right: 3%" >
                        <? if ($CURRENTgetuserwryRow['avatarid'] != '') {
                            $avatarlogo = stripslashes(GetName1("avatars", "picture", "id", $CURRENTgetuserwryRow['avatarid'])); ?>
                            <img src="Avatars/<? echo $avatarlogo; ?>" style="width: 100%;"/>
                        <? } ?>
                    </div>
                    <div style="vertical-align:top; width: 80%; font-size: 5vh;">
                        <div style="text-align:left;">Welcome to<br>Karma the Game of Destiny</div>
                        <? if ($_REQUEST['step'] != '') { ?>
                            <h1 style="text-align:left;font-size:42px;padding-top:15px;">STEP 1</h1>
                            <? if ($msg != '') { ?>
                                <div style="color:#FF0000"><? echo $msg; ?></div><? } ?>
                        <? } ?>
                    </div>
                </div>
                <div id="frmchangeusername">
                    <div style="width: 100%;margin-left: 10%; margin-right: 10%; height: 48%">
                        <div class="dashboard_whitetext" style="width: 100%; display: flex;font-size:3vh;    margin-bottom: 1%;">
                            <div  style="width: 40%;">What do you call yourself?</div>
                            <div style="width: 60%;">
                                <input type="text" name="username" id="username" class="inputbox" placeholder="<? echo GetUserName($_SESSION['UsErIdFrOnT']); ?>" style="width:60%"/>
                            </div>
                        </div>
                        <div class="dashboard_whitetext" style="width: 100%; display: flex;font-size:3vh;    margin-bottom: 1%;">
                            <div style="width: 40%;">What will be your secret code?</div>
                            <div style="width: 60%;">
                                <input type="text" name="password" id="passwordUser" class="inputbox" placeholder="change your password" style="width:60%"/>
                            </div>
                        </div>
                        <div class="dashboard_whitetext" style="width: 100%; display: flex;font-size:3vh;    margin-bottom: 1%;">
                            <div style="width: 40%">Tagline:</div>
                            <div style="width: 60%;">
                                <textarea name="aboutme" id="aboutmeUser" class="inputbox" placeholder="Funny man seeks wonderful woman for love and passion" style="width:60%"></textarea>
                            </div>
                        </div>
                    </div>
                    <div style="width: 100%;height: 7%">
                        <input type="hidden" name="Hidsubmit" id="Hidsubmit" value="0"/>
                        <div style="    margin-right: 2%;">
                            <div style="height:80%;width:10%;display:inline-block;float:right;">
                                <a href="#" onclick="hide_pop();return false;">
                                    <img alt="" src="images/button_close.png" border="0" style="width: 100%;" />
                                </a>
                            </div>
                            <div style="height:80%;width:10%;display:inline-block;float:right;">
                                <input style="width: 100%;"  type="image" name="saveuserpass" id="saveuserpass" src="images/button_send.png" onClick="frmupdatesave();" />
                            </div>
                            <span id="MessageId" style="color:#FF0000;"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

