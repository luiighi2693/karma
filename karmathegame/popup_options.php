<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <link href="css/opening_styles.css">
    <title><? echo $SITE_TITLE; ?></title>
    <script language="javascript">
        function hide_pop() {
            document.getElementById('rightsidePOPUP_MAIN').style.display = 'none';
        }
    </script>
</head>
<body>
<div id="main_menu">

    <div style="width:80% text-align:center margin-bottom: 50px;">
        <tr/>
        <table style="text-align:center;margin-left:auto;margin-right:auto;" width="95%" cellspacing="0" cellpadding="0"
               border="0" align="center">
            <tr>
                <td class="bottmborder_white">
                    <br/>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tr>

                            <td width="8%" align="left">
                                <img src="images/icon_gears.png" border="0">
                            </td>
                            <td width="52%">
                                <h1 style="text-align:left;">CONFIGURATION</h1>
                            </td>
                            <td width="15%" align="right">
                                <a href="#" onclick="hide_pop(); show_pop('popup_dashboard.php')" style="font-size:25px;" class="optiontitle">>STEP 1<a/>

                            </td>
                            <td width="15%" align="right">
                                <a href="#" style="font-size:25px;" class="optiontitle">>aDvAnCeD<a/>

                            </td>
                            <td width="10%" align="right">
                                <a href="#" onclick="hide_pop();return false;">
                                    <img src="images/popup_close.png" border="0">
                            </td>

                        </tr>
                    </table>
                    <br/>
            <tr/>
            </td>

            </tr>
            </tbody>
        </table>
    </div>


    <div id="inferior" width="100%">
        <br/>
        <br/>
        <div id="izq" style="display: inline-block; width:48%;text-align:center;">
            <div>
                <p style="color:white;text-align:center;font-size:25px;">LAYOUT PICK</p>
                <br/>
                <div>
                    <img src="images/layout0.png" border="0">
                </div>
                <br/>
                <div>
                    <img src="images/layout1.png" border="0">
                </div>
            </div>
            <br/>
            <br/>
            <br/>
            <br/>
            <div style="position=absolute;height:20%;text-align:center;">
                <p style="color:white;font-size:25px;">AI AUDIO</p>

                <form style="text-align:left; margin-left:47%;">
                    <br/>
                    <input type="checkbox" id="radio1" name="radio1" onclick="control(1);" style="background:gray;"/>
                    <label for="radio1"><span>Yes</span></label>
                    <br/>
                    <input type="checkbox" id="radio2" onclick="control(2);" name="radio2"/>
                    <label for="radio2"><span>No</span></label>
                    <br/>
                    <input type="checkbox" id="radio3" name="radio3" onclick="control(3);"/>
                    <label for="radio3"><span>When asked</span></label>
                </form>

            </div>
            <div onclick="save()" style="height:80px;width:50.1%;display:inline-block;"><img src="images/button_apply.png" border="0" >
            </div>
        </div>
        <div id="der" style="float: right;padding-right: 20%;">
            <div>
                <p style="color:white; font-size:25px;">HOUSE THEMES</p>
                <div class="themes-list">
                    <ul style="height: 62%;overflow: auto; width:190px;">
                        <li><a href="#" onclick="theme2(1);"><img src="images/theme1-small.jpg" alt="Theme2"
                                                                  title="Theme1" border="0"/></a></li>
                        <li><a href="#" onclick="theme2(2);"><img src="images/theme2-small.jpg" alt="Theme2"
                                                                  title="Theme2" border="0"/></a></li>
                        <li><a href="#" onclick="theme2(3);"><img src="images/theme3-small.jpg" alt="Theme3"
                                                                  title="Theme3" border="0"/></a></li>
                        <li><a href="#" onclick="theme2(4);"><img src="images/theme4-small.jpg" alt="Theme4"
                                                                  title="Theme4" border="0"/></a></li>
                        <li><a href="#" onclick="theme2(5);"><img src="images/theme5-small.jpg" alt="Theme5"
                                                                  title="Theme5" border="0"/></a></li>
                        <li><a href="#" onclick="theme2(7);"><img src="images/theme6-small.jpg" alt="Theme6"
                                                                  title="Theme6" border="0"/></a></li>
                        <li><a href="#" onclick="theme2(6);"><img src="images/theme7-small.jpg" alt="Theme7"
                                                                  title="Theme7" border="0"/></a></li>
                        <li><a href="#" onclick="theme2(8);"><img src="images/theme8-small.jpg" alt="Theme8"
                                                                  title="Theme8" border="0"/></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>