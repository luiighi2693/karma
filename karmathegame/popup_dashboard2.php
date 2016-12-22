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
                <div style="width: 80%;margin-left: 10%; margin-right: 10%; height: 48%">
                    <div class="dashboard_whitetext" style="width: 100%; display: flex;font-size:3vh;    margin-bottom: 1%;">
                        You can start anytime and reach out to anyone, but it's a good
                        idea to fill in some of the questions in your JourneyBook.
                        <a href="journeystats.php"><img
                                src="images/help_icon_journeybook.png" align="right"
                                height="70px" border="0"></a>
                    </div>
                    <div class="dashboard_whitetext" style="width: 100%; display: flex;font-size:3vh;    margin-bottom: 1%;">
                        Once you let the Game Guru know who you are and who you'd like
                        to meet, your Potential Soulmates can be recalculated to bring
                        you closer to the people who are looking to play the Game with
                        someone like you...
                    </div>
                </div>
                <div style="width: 100%;height: 7%">
                    <div style="    margin-right: 2%;">
                        <div style="height:80%;width:10%;display:inline-block;float:right;">
                            <a href="#" onclick="hide_pop();return false;">
                                <img alt="" src="images/button_close.png" border="0" style="width: 100%;" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
