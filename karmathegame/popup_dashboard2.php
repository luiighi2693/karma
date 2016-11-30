<? include("connect.php");
include("checklogin.php");
$avatarlogo = stripslashes(GetName1("avatars", "picture", "id", $CURRENTgetuserwryRow['avatarid']));
$msg = "Updated Successfully!";
?>
<div class="dashboardpopup">
    <div id="pad_wrapper_newlife">
        <div id="pad_newlife" style="border:0px solid gray;	border-radius:0px;max-width:100%;">
            <table width="100%" border="0" cellspacing="20" cellpadding="0">
                <tr>
                    <td valign="top" style="vertical-align:top;" width="200">
                        <? if ($CURRENTgetuserwryRow['avatarid'] != '') {
                            $avatarlogo = stripslashes(GetName1("avatars", "picture", "id", $CURRENTgetuserwryRow['avatarid'])); ?>
                            <img src="Avatars/<? echo $avatarlogo; ?>" width="180" height="170"/>
                        <? } ?>
                    </td>
                    <td valign="top" style="vertical-align:top;"><h1 style="text-align:left;">Welcome to<br>Karma
                            the Game of Destiny</h1>
                        <? if ($_REQUEST['step'] != '') { ?>
                            <h1 style="text-align:left;font-size:42px;padding-top:15px;">STEP 1</h1>
                            <? if ($msg != '') { ?>
                                <div style="color:#FF0000"><? echo $msg; ?></div><? } ?>
                        <? } ?>
                    </td>
                </tr>
                    <tr>
                        <td colspan="2" align="center" valign="top">
                            <table width="75%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td class="dashboard_whitetext">
                                        You can start anytime and reach out to anyone, but it's a good
                                        idea to fill in some of the questions in your JourneyBook.
                                        <a href="journeystats.php"><img
                                                src="images/help_icon_journeybook.png" align="right"
                                                height="70" border="0"></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="dashboard_whitetext">
                                        Once you let the Game Guru know who you are and who you'd like
                                        to meet, your Potential Soulmates can be recalculated to bring
                                        you closer to the people who are looking to play the Game with
                                        someone like you...
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" nowrap="nowrap" style="padding-top:8px;">
                                        <a href="dashboard.php"><img src="images/close-button.png"
                                                                     border="0"/></a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
            </table>
        </div>
    </div>
</div>

