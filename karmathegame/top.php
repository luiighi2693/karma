<? if($TOPCONDENSE=="YES"){?>
<style type="text/css">
#main_title {font-size:30px;}
#main_title a{color:#663300; font-size:30px;text-decoration:none;}
#subtitle {color:#663300; margin-left:44%; font-size:10px;font-family:"Century Gothic", "Calibri", "Trebuchet MS", ariel, Helvetica, sans-serif;}
</style>
<span id="date_time"><? echo date("l, F d");?></span>
<? }?>
<div id="top">
  <div id="topbar">
    <div id="time-date">
      <div id="clock">
        <div id="txt"></div>
      </div>
      <div id="day">
        <div id="id"></div>
      </div>
    </div>
    <div id="main_title"><a href="index.php">Karma</a></div>
    <div id="subtitle">the Game of Destiny</div>
  </div>
  <? if($TOPCONDENSE=="YES"){?>	
  <div style="position:absolute;float:right;text-align:right;width:99%;padding-bottom:15px;top:30px;color:#5d4c46;font-size:24px;font-weight:normal;"><h2><? echo TotalQuestionsAnswered();?></h2></div>
  <? }?>
</div>