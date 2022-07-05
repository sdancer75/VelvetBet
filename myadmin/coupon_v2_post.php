<?php
    session_start();
    include_once '../includes/database.php';
    include_once '../includes/login.php';
    include_once '../includes/statistics.php';


     $LoginMsg = '';
     $DB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
     mysql_select_db(DataBase, $DB) or die(mysql_error());

    if (!check_login('masterusers') )
        header( 'Location: ../index.php' ) ;

    mysql_close($DB);


?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">

<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE>VelvetBet - Στοιχήματα Ποδοσφαίρου</TITLE>
<?php include '../includes/metatagsgr.php' ?>



<link href="../betplatform.css" rel="stylesheet" type="text/css">


<link rel="stylesheet" type="text/css" href="../build/fonts/fonts-min.css" />
<link rel="stylesheet" type="text/css" href="../build/datatable/assets/skins/sam/datatable.css" />
<link rel="stylesheet" type="text/css" href="../build/paginator/assets/skins/sam/paginator.css" />
<link rel="stylesheet" type="text/css" href="../build/button/assets/skins/sam/button.css" />
<link rel="stylesheet" type="text/css" href="../build/tabview/assets/skins/sam/tabview.css" />
<link rel="stylesheet" type="text/css" href="../build/paginator/assets/skins/sam/paginator.css" />
<link rel="stylesheet" type="text/css" href="../build/container/assets/skins/sam/container.css" />
<link type="text/css" rel="stylesheet" href="../build/calendar/assets/skins/sam/calendar.css">

<script type="text/javascript" src="../build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="../build/dragdrop/dragdrop-min.js"></script>
<script type="text/javascript" src="../build/element/element-min.js"></script>
<script type="text/javascript" src="../build/button/button-min.js"></script>
<script type="text/javascript" src="../build/datasource/datasource-min.js"></script>
<script type="text/javascript" src="../build/datatable/datatable-min.js"></script>
<script type="text/javascript" src="../build/tabview/tabview-min.js"></script>
<script type="text/javascript" src="../build/paginator/paginator-min.js"></script>
<script type="text/javascript" src="../build/animation/animation-min.js"></script>
<script type="text/javascript" src="../build/container/container-min.js"></script>
<script type="text/javascript" src="../build/connection/connection-min.js"></script>
<script type="text/javascript" src="../build/json/json-min.js"></script>
<script type="text/javascript" src="../build/calendar/calendar-min.js"></script>
<script type="text/javascript" src="../build/uploader/uploader-min.js"></script>


 <script type="text/javascript" src="../js/dateformat.js"></script>

<!--begin custom header content for this example-->
<style type="text/css">

 #selectFilesLink a, #uploadFilesLink a, #clearFilesLink a {
	color: #0000CC;
	background-color: #FFFFFF;
}

#selectFilesLink a:visited, #uploadFilesLink a:visited, #clearFilesLink a:visited {
	color: #0000CC;
	background-color: #FFFFFF;
}

#uploadFilesLink a:hover, #clearFilesLink a:hover {
	color: #FFFFFF;
	background-color: #000000;
}

/* Class for marked rows */
.yui-skin-sam .yui-dt tr.EmptyLine,
.yui-skin-sam .yui-dt tr.EmptyLine td.yui-dt-asc,
.yui-skin-sam .yui-dt tr.EmptyLine td.yui-dt-desc,
.yui-skin-sam .yui-dt tr.EmptyLine td.yui-dt-asc,
.yui-skin-sam .yui-dt tr.EmptyLine td.yui-dt-desc {
    background-color: #666699;
    Color:white;
    font-weight: bold;
    height: 5px
}

/* Remove row striping, column borders, and sort highlighting */
.yui-skin-sam tr.yui-dt-odd
{
  background-color: #FFFEF2;

}

.yui-skin-sam tr.yui-dt-even
{
  background-color: #FFFEF2;

}

.yui-skin-sam tr.yui-dt-odd td.yui-dt-asc,
.yui-skin-sam tr.yui-dt-odd td.yui-dt-desc,
.yui-skin-sam tr.yui-dt-even td.yui-dt-asc,
.yui-skin-sam tr.yui-dt-even td.yui-dt-desc {
    background-color: #AfAfAf;
}
.yui-skin-sam .yui-dt tbody td {
    border-bottom: 0px solid #00000;
}

.yui-skin-sam .yui-dt thead th {
    border-bottom: 0px solid #7f7f7f;
}



.yui-skin-sam .yui-dt tr.yui-dt-last td,
.yui-skin-sam .yui-dt th,
.yui-skin-sam .yui-dt td {
    border-bottom: 1px solid #7f7f7f;
    text-align: center;
    height: 30px;
}



/* custom styles for this example */
.yui-skin-sam .yui-dt-body { cursor:pointer; } /* when cells are selectable */
#cellrange, #singlecell { margin-top:2em; }




/*custom columns */
.yui-skin-sam .yui-dt td.ee1 {

    Color:#FF0000;
    font-weight: bold;
}
.yui-skin-sam .yui-dt td.ee2 {

    Color:#FF8040;
    font-weight: bold;
}
.yui-skin-sam .yui-dt td.ee3 {

    Color:#00CC00;
    font-weight: bold;
}

.yui-skin-sam .yui-dt td.ee4 {

    Color:#000099;
    font-weight: bold;
}

 .yui-skin-sam .yui-dt td.ee5 {

    Color:#CCCC66;
    font-weight: bold;
}

.yui-skin-sam .yui-dt td.time {
    background-color: #FFCA95;
    Color:black;

}

.yui-skin-sam .yui-dt td.goal {
    background-color: #FAFEC2;
    Color:black;
    font-weight: bold;

}

.yui-skin-sam .yui-dt td.neg_goal {
    background-color: #FAFEC2;
    Color:red;
    font-weight: bold;

}

.yui-skin-sam .yui-dt td.goal2 {
    background-color: #FFEAD5;
    Color:black;
    font-weight: bold;

}

.yui-skin-sam .yui-dt td.neg_goal2 {
    background-color: #FFEAD5;
    Color:red;
    font-weight: bold;

}

.yui-skin-sam .yui-dt td.neg_goal3 {

    Color:red;
    font-weight: bold;

}

.yui-skin-sam .yui-dt td.half {
    background-color: #FCF2FF;
    Color:black;
    font-weight: bold;

}

/* custom styles for this example */
.modform {margin-bottom: 1em;}
.index {width:5em;}

.myHighlightClassName {
    background-color: #FFCA95;
    Color:black;
}



.yui-skin-sam .yui-checkbox-button button {
    width: 4em;
}

.yui-button#pushbuttonCompareGoalBetInt button {

    padding-left: 3em;
    background: url(../grafix/refresh.png) 10% 50% no-repeat;


}


.yui-button#pushbuttonAddLocalRec button {

    padding-left: 3em;
    background: url(../grafix/add.gif) 10% 50% no-repeat;


}

.yui-button#pushbuttonSaveRec button {

    padding-left: 3em;
    background: url(../grafix/save.png) 10% 50% no-repeat;


}

.yui-button#pushbuttonDelRec button {

    padding-left: 3em;
    background: url(../grafix/delete.gif) 10% 50% no-repeat;


}

.yui-button#pushbuttonNextCoupon button {

    padding-right: 3em;
    background: url(../grafix/next.png) 90% 50% no-repeat;

}

.yui-button#pushbuttonPrevCoupon button {

    padding-left: 3em;
    background: url(../grafix/back.png) 10% 50% no-repeat;


}


.yui-button#pushbuttonReplicateDate button {

    padding-left: 3em;
    background: url(../grafix/accept.png) 10% 50% no-repeat;

}


.yui-button#ActivateCoupon button {

    padding-left: 3em;
    padding-right: 3em;
    width: 18em;
    height: 3em;
    font-size : 10px;
    background: url(../grafix/application_go.png) 10% 50% no-repeat;

}

.yui-button#pushbuttonOPAP button {

    padding-left: 3em;
    background: url(../grafix/football.png) 10% 50% no-repeat;
}


.calweekdaycell {
  background: #FFD700
}

/*
#paginated {
    text-align: center;
}
#paginated table {
    margin-left:auto; margin-right:auto;
}
*/

.delete-button {
	cursor:pointer;
	background: #FFFFCC url(../grafix/delete.png) no-repeat center center;
	width:16px;height:16px;
}

</style>

</HEAD>


<BODY class="yui-skin-sam"  oncontextmenu="return false">

<div align=top>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
  <TBODY>
  <TR>
       <TD class=logoback colSpan=2>
            <?php include '../includes/logo.php' ?>
       </TD>
  </TR>
  <TR>
    <TD class=logoback colSpan=2 height=10>
    </TD>
  </TR>
  <TR>
    <TD class=InfoTitle colSpan=2 bgcolor="#575348">

       <?php include 'includes/information.php' ?>


    </TD>
  </TR>

  <TR>
    <TD class=logoback colSpan=2 height=10></TD>
  </TR>
<!--
  <TR>
    <TD class=HeaderOptions colSpan=2 bgcolor="#475658" height="30px" align="right"><a href="#" class="HeaderOptions">Κεντρική σελίδα</a> | <a  href="#" class="HeaderOptions">Έξοδος </a></TD>
  </TR>
-->
  <TR>
    <TD bgcolor="#CCCC99" style="FONT-SIZE:14px" colSpan=2  height="25px" align="left">
            <table width=1000px border=0>
            <tr>
                <TD align=right><strong>Διαχείριση κουπονιού</strong></TD>
            </tr>
            </table>

    </TD>
  </TR>


   <!-- hide the stuff the they are repeated -->
   <?php include 'includes/panel.php' ?>



    <TD style="VERTICAL-ALIGN: top;" width="100%" >
      <Table border=0 width="100%">
        <TR>
            <TD class="yui-skin-sam" style="FONT-SIZE: 11px;"  valign="top" width="100%" style="FONT-SIZE: 10px;">

                <div id="tvcontainer" class="yui-navset">
                    <ul class="yui-nav">
                        <li class="selected"><a href="#tab1"><em>Προβολή κουπονιού</em></a></li>
                        <li><a href="#tab2"><em>Δημιουργία κουπονιού</em></a></li>
                        <li><a href="#tab2"><em>Σύγκριση αποδόσεων</em></a></li>
                    </ul>
                    <div class="yui-content">

                          <table >
                          <tr>
                              <td class=TextInfoBlack>
                                           <script type="text/javascript">
                                                var oCalendarView;
                                                var oButtonView;

                                            	(function () {

                                            		var Event = YAHOO.util.Event,
                                                    	Dom = YAHOO.util.Dom;



                                            		Event.onContentReady("todate", function () {

                                            			var oCalendarMenu;



                                            			var onButtonClick = function () {

                                           				// Create a Calendar instance and render it into the body
                                            				// element of the Overlay.

                                            			   oCalendarView = new YAHOO.widget.Calendar("buttoncalendar2", oCalendarMenu.body.id);

                                                    		// Correct formats for Greek: dd.mm.yyyy, dd.mm, mm.yyyy

                                                    		oCalendarView.cfg.setProperty("DATE_FIELD_DELIMITER", "-");

                                                    		oCalendarView.cfg.setProperty("MDY_DAY_POSITION", 1);
                                                    		oCalendarView.cfg.setProperty("MDY_MONTH_POSITION", 2);
                                                    		oCalendarView.cfg.setProperty("MDY_YEAR_POSITION", 3);

                                                    		oCalendarView.cfg.setProperty("MD_DAY_POSITION", 1);
                                                    		oCalendarView.cfg.setProperty("MD_MONTH_POSITION", 2);

                                                    		// Date labels for Greek locale

                                                    		oCalendarView.cfg.setProperty("MONTHS_SHORT",   ["Ιαν", "Φεβ", "Μαρτ", "Απρ", "Μαι", "Ιουν", "Ιου", "Αυγ", "Σεπ", "Οκτ", "Νοε", "Δεκ"]);
                                                    		oCalendarView.cfg.setProperty("MONTHS_LONG",    ["Ιανουάριος", "Φεβρουάριος", "Μάριος", "Απρίλιος", "Μάϊος", "Ιούνιος", "Ιούλιος", "Αύγουστος", "Σεπτέμβριος", "Οκτώβριος", "Νοέμβριος", "Δεκέμβριος"]);
                                                    		oCalendarView.cfg.setProperty("WEEKDAYS_1CHAR", ["Κ", "Δ", "Τ", "Τ", "Π", "Π", "Σ"]);
                                                    		oCalendarView.cfg.setProperty("WEEKDAYS_SHORT", ["Κυ", "Δε", "Τρ", "Τε", "Πε", "Πα", "Σα"]);
                                                    		oCalendarView.cfg.setProperty("WEEKDAYS_MEDIUM",["Κυρ", "Δευ", "Τρι", "Τετ", "Πεμ", "Παρ", "Σαβ"]);
                                                    		oCalendarView.cfg.setProperty("WEEKDAYS_LONG",  ["Κυριακή", "Δευτέρα", "Τρίτη", "Τετάρτη", "Πέμπτη", "Παρασκευή", "Σάββατο"]);
                                                            oCalendarView.render();
                                            				// Subscribe to the Calendar instance's "select" event to
                                            				// update the Button instance's label when the user
                                            				// selects a date.
                                            				oCalendarView.selectEvent.subscribe(function (p_sType, p_aArgs) {

                                            					var aDate,
                                            						nMonth,
                                            						nDay,
                                            						nYear;

                                            					if (p_aArgs) {

                                            						aDate = p_aArgs[0][0];

                                            						nMonth = aDate[1];
                                            						nDay = aDate[2];
                                            						nYear = aDate[0];

                                            						oButtonView.set("label", ( nDay + "-" +  nMonth+ "-" + nYear));


                                            						// Sync the Calendar instance's selected date with the date form fields

                                            						Dom.get("tomonth").selectedIndex = (nMonth - 1);
                                            						Dom.get("today").selectedIndex = (nDay - 1);
                                            						Dom.get("toyear").value = nYear;

                                            					}

                                            					oCalendarMenu.hide();


                                                                // Sends a request to the DataSource for more data
                                                                var oUpdateTableCallBack = {
                                                                    success :AddDataTable.onDataReturnReplaceRows,
                                                                    failure :AddDataTable.onDataReturnReplaceRows,
                                                                    scope   : AddDataTable
                                                                };

                                                               var sqlquery = "query=coupons&type=select&primaryKey=CouponID&whereID=" + nYear + "-" + nMonth + "-" + nDay;
                                                               AddDataTable.getDataSource().sendRequest(sqlquery, oUpdateTableCallBack);

                                            				});


                                            				// Pressing the Esc key will hide the Calendar Menu and send focus back to
                                            				// its parent Button

                                            				Event.on(oCalendarMenu.element, "keydown", function (p_oEvent) {

                                            					if (Event.getCharCode(p_oEvent) === 27) {
                                            						oCalendarMenu.hide();
                                            						this.focus();
                                            					}

                                            				}, null, this);


                                            				var focusDay = function () {

                                            					var oCalendarTBody = Dom.get("buttoncalendar2").tBodies[0],
                                            						aElements = oCalendarTBody.getElementsByTagName("a"),
                                            						oAnchor;


                                            					if (aElements.length > 0) {

                                            						Dom.batch(aElements, function (element) {

                                            							if (Dom.hasClass(element.parentNode, "today")) {
                                            								oAnchor = element;
                                            							}

                                            						});


                                            						if (!oAnchor) {
                                            							oAnchor = aElements[0];
                                            						}


                                            						// Focus the anchor element using a timer since Calendar will try
                                            						// to set focus to its next button by default

                                            						YAHOO.lang.later(0, oAnchor, function () {
                                            							try {
                                            								oAnchor.focus();
                                            							}
                                            							catch(e) {}
                                            						});

                                            					}

                                            				};


                                            				// Set focus to either the current day, or first day of the month in
                                            				// the Calendar	when it is made visible or the month changes

                                            				oCalendarMenu.subscribe("show", focusDay);
                                            				oCalendarView.renderEvent.subscribe(focusDay, oCalendarView, true);


                                            				// Give the Calendar an initial focus

                                            				focusDay.call(oCalendarView);


                                            				// Re-align the CalendarMenu to the Button to ensure that it is in the correct
                                            				// position when it is initial made visible

                                            				oCalendarMenu.align();


                                            				// Unsubscribe from the "click" event so that this code is
                                            				// only executed once

                                            				this.unsubscribe("click", onButtonClick);



                                            			};


                                            			var oDateFields = Dom.get("todate");
                                            				oMonthField = Dom.get("tomonth"),
                                            				oDayField = Dom.get("today"),
                                            				oYearField = Dom.get("toyear");


                                            			// Hide the form fields used for the date so that they can be replaced by the
                                            			// calendar button.

                                            			oMonthField.style.display = "none";
                                            			oDayField.style.display = "none";
                                            			oYearField.style.display = "none";


                                            			// Create a Overlay instance to house the Calendar instance

                                            			oCalendarMenu = new YAHOO.widget.Overlay("calendarmenu2", { visible: false });



                                            			// Create a Button instance of type "menu"

                                            			oButtonView = new YAHOO.widget.Button({
                                            											type: "menu",
                                            											id: "calendarpicker2",
                                            											label: "<?php echo date('j-n-Y'); ?>",
                                            											menu: oCalendarMenu,
                                            											container: "todate" });


                                            			oButtonView.on("appendTo", function () {

                                            				// Create an empty body element for the Overlay instance in order
                                            				// to reserve space to render the Calendar instance into.

                                            				oCalendarMenu.setBody("&#32;");

                                            				oCalendarMenu.body.id = "calendarcontainer2";


                                            			});




                                            			// Add a listener for the "click" event.  This listener will be
                                            			// used to defer the creation the Calendar instance until the
                                            			// first time the Button's Overlay instance is requested to be displayed
                                            			// by the user.

                                            			oButtonView.on("click", onButtonClick);

													    Dom.get("tomonth").selectedIndex = <?php echo date('m')-1; ?>;
                                            			Dom.get("today").selectedIndex = <?php echo date('d')-1; ?>;
                                            			Dom.get("toyear").value = <?php echo date('Y'); ?>;;


                                            		});

                                            	}());

                                    </script>

                        		   <div class="field" id="todate">


                        	        <select id="tomonth" name="tomonth">
                        	        	<option value="1">01</option>
                        	        	<option value="2">02</option>
                        	        	<option value="3">03</option>
                        	        	<option value="4">04</option>
                        	        	<option value="5">05</option>
                        	        	<option value="6">06</option>
                        	        	<option value="7">07</option>
                        	        	<option value="8">08</option>
                        	        	<option value="9">09</option>
                        	        	<option value="10">10</option>
                        	        	<option value="11">11</option>
                        	        	<option value="12">12</option>
                        	        </select>

                        	        <select id="today" name="today">
                        	        	<option value="1">01</option>
                        	        	<option value="2">02</option>
                        	        	<option value="3">03</option>
                        	        	<option value="4">04</option>
                        	        	<option value="5">05</option>
                        	        	<option value="6">06</option>
                        	        	<option value="7">07</option>
                        	        	<option value="8">08</option>
                        	        	<option value="9">09</option>
                        	        	<option value="10">10</option>
                        	        	<option value="11">11</option>
                        	        	<option value="12">12</option>
                        	        	<option value="13">13</option>
                        	        	<option value="14">14</option>
                        	        	<option value="15">15</option>
                        	        	<option value="16">16</option>
                        	        	<option value="17">17</option>
                        	        	<option value="18">18</option>
                        	        	<option value="19">19</option>
                        	        	<option value="20">20</option>
                        	        	<option value="21">21</option>
                        	        	<option value="22">22</option>
                        	        	<option value="23">23</option>
                        	        	<option value="24">24</option>
                        	        	<option value="25">25</option>
                        	        	<option value="26">26</option>
                        	        	<option value="27">27</option>
                        	        	<option value="28">28</option>
                        	        	<option value="29">29</option>
                        	        	<option value="30">30</option>
                        	        	<option value="31">31</option>
                        	        </select>
                                    <br>
                                    Κουπόνι της
                        			<input type="text" id="toyear" name="toyear" value="">
            						</div>
                                    <br><br>


                                    <span id="pushbuttonPrevCoupon" class="yui-button yui-push-button">
                                         <strong class="first-child">
                                          <button type="button" name="pushbuttonPrevCoupon">Προηγούμενη ημέρα</button>
                                         </strong>
                                    </span>

                                    <span id="pushbuttonNextCoupon" class="yui-button yui-push-button">
                                         <strong class="first-child">
                                          <button type="button" name="pushbuttonNextCoupon">Επόμενη ημέρα</button>
                                         </strong>
                                    </span>

                                    <br><br>


                                    <input type="checkbox" id="ActivateCoupon" name="ActivateCoupon" value="">

                                    <br><br>
                                    <div id="paginated" align="center"></div>

                              </td>
                          </tr>
                          </table>



                        <div><p>
                                  <table  border=0>
                                  <tr>
                                      <td class=TextInfoBlack width="170px">


                                          <script type="text/javascript">
											var oButton

                                          	(function () {

                                          		var Event = YAHOO.util.Event,
                                          			Dom = YAHOO.util.Dom;


                                          		Event.onContentReady("fromdate", function () {

                                          			var oCalendarMenu;

                                          			var onButtonClick = function () {

                                          				// Create a Calendar instance and render it into the body
                                          				// element of the Overlay.

                                          				var oCalendar = new YAHOO.widget.Calendar("buttoncalendar", oCalendarMenu.body.id);

                                                  		// Correct formats for Greek: dd.mm.yyyy, dd.mm, mm.yyyy

                                                  		oCalendar.cfg.setProperty("DATE_FIELD_DELIMITER", "-");

                                                  		oCalendar.cfg.setProperty("MDY_DAY_POSITION", 1);
                                                  		oCalendar.cfg.setProperty("MDY_MONTH_POSITION", 2);
                                                  		oCalendar.cfg.setProperty("MDY_YEAR_POSITION", 3);

                                                  		oCalendar.cfg.setProperty("MD_DAY_POSITION", 1);
                                                  		oCalendar.cfg.setProperty("MD_MONTH_POSITION", 2);

                                                  		// Date labels for Greek locale

                                                  		oCalendar.cfg.setProperty("MONTHS_SHORT",   ["Ιαν", "Φεβ", "Μαρτ", "Απρ", "Μαι", "Ιουν", "Ιου", "Αυγ", "Σεπ", "Οκτ", "Νοε", "Δεκ"]);
                                                  		oCalendar.cfg.setProperty("MONTHS_LONG",    ["Ιανουάριος", "Φεβρουάριος", "Μάρτιος", "Απρίλιος", "Μάϊος", "Ιούνιος", "Ιούλιος", "Αύγουστος", "Σεπτέμβριος", "Οκτώβριος", "Νοέμβριος", "Δεκέμβριος"]);
                                                  		oCalendar.cfg.setProperty("WEEKDAYS_1CHAR", ["Κ", "Δ", "Τ", "Τ", "Π", "Π", "Σ"]);
                                                  		oCalendar.cfg.setProperty("WEEKDAYS_SHORT", ["Κυ", "Δε", "Τρ", "Τε", "Πε", "Πα", "Σα"]);
                                                  		oCalendar.cfg.setProperty("WEEKDAYS_MEDIUM",["Κυρ", "Δευ", "Τρι", "Τετ", "Πεμ", "Παρ", "Σαβ"]);
                                                  		oCalendar.cfg.setProperty("WEEKDAYS_LONG",  ["Κυριακή", "Δευτέρα", "Τρίτη", "Τετάρτη", "Πέμπτη", "Παρασκευή", "Σάββατο"]);


                                          				oCalendar.render();


                                          				// Subscribe to the Calendar instance's "select" event to
                                          				// update the Button instance's label when the user
                                          				// selects a date.

                                          				oCalendar.selectEvent.subscribe(function (p_sType, p_aArgs) {

                                          					var aDate,
                                          						nMonth,
                                          						nDay,
                                          						nYear;

                                          					if (p_aArgs) {

                                          						aDate = p_aArgs[0][0];

                                          						nMonth = aDate[1];
                                          						nDay = aDate[2];
                                          						nYear = aDate[0];

                                          						oButton.set("label", ( nDay + "-" +  nMonth + "-" + nYear));


                                          						// Sync the Calendar instance's selected date with the date form fields

                                          						Dom.get("month").selectedIndex = (nMonth - 1);
                                          						Dom.get("day").selectedIndex = (nDay - 1);
                                          						Dom.get("year").value = nYear;


                                          						Dom.get("tomonth").selectedIndex = (nMonth - 1);
                                          						Dom.get("today").selectedIndex = (nDay - 1);
                                          						Dom.get("toyear").value = nYear;

                                                                oButtonView.set("label", ( nDay + "-" +  nMonth + "-" + nYear) );

                                          					}

                                          					oCalendarMenu.hide();

                                                                // Sends a request to the DataSource for more data
                                                                var oUpdateTableCallBack = {
                                                                    success :AddDataTable.onDataReturnReplaceRows,
                                                                    failure :AddDataTable.onDataReturnReplaceRows,
                                                                    scope   : AddDataTable
                                                                };

                                                               var sqlquery = "query=coupons&type=select&primaryKey=CouponID&whereID=" + nYear + "-" + nMonth + "-" + nDay;
                                                               AddDataTable.getDataSource().sendRequest(sqlquery, oUpdateTableCallBack);





                                          				});


                                          				// Pressing the Esc key will hide the Calendar Menu and send focus back to
                                          				// its parent Button

                                          				Event.on(oCalendarMenu.element, "keydown", function (p_oEvent) {

                                          					if (Event.getCharCode(p_oEvent) === 27) {
                                          						oCalendarMenu.hide();
                                          						this.focus();
                                          					}

                                          				}, null, this);


                                          				var focusDay = function () {

                                          					var oCalendarTBody = Dom.get("buttoncalendar").tBodies[0],
                                          						aElements = oCalendarTBody.getElementsByTagName("a"),
                                          						oAnchor;


                                          					if (aElements.length > 0) {

                                          						Dom.batch(aElements, function (element) {

                                          							if (Dom.hasClass(element.parentNode, "today")) {
                                          								oAnchor = element;
                                          							}

                                          						});


                                          						if (!oAnchor) {
                                          							oAnchor = aElements[0];
                                          						}


                                          						// Focus the anchor element using a timer since Calendar will try
                                          						// to set focus to its next button by default

                                          						YAHOO.lang.later(0, oAnchor, function () {
                                          							try {
                                          								oAnchor.focus();
                                          							}
                                          							catch(e) {}
                                          						});

                                          					}

                                          				};


                                          				// Set focus to either the current day, or first day of the month in
                                          				// the Calendar	when it is made visible or the month changes

                                          				oCalendarMenu.subscribe("show", focusDay);
                                          				oCalendar.renderEvent.subscribe(focusDay, oCalendar, true);


                                          				// Give the Calendar an initial focus

                                          				focusDay.call(oCalendar);


                                          				// Re-align the CalendarMenu to the Button to ensure that it is in the correct
                                          				// position when it is initial made visible

                                          				oCalendarMenu.align();


                                          				// Unsubscribe from the "click" event so that this code is
                                          				// only executed once

                                          				this.unsubscribe("click", onButtonClick);

                                          			};


                                          			var oDateFields = Dom.get("fromdate");
                                          				oMonthField = Dom.get("month"),
                                          				oDayField = Dom.get("day"),
                                          				oYearField = Dom.get("year");


                                          			// Hide the form fields used for the date so that they can be replaced by the
                                          			// calendar button.

                                          			oMonthField.style.display = "none";
                                          			oDayField.style.display = "none";
                                          			oYearField.style.display = "none";


                                          			// Create a Overlay instance to house the Calendar instance

                                          			oCalendarMenu = new YAHOO.widget.Overlay("calendarmenu", { visible: false });


                                          			// Create a Button instance of type "menu"

                                          			oButton = new YAHOO.widget.Button({
                                          											type: "menu",
                                          											id: "calendarpicker",
                                          											label: "Hμερομηνία",
                                          											menu: oCalendarMenu,
                                          											container: "fromdate" });


                                          			oButton.on("appendTo", function () {

                                          				// Create an empty body element for the Overlay instance in order
                                          				// to reserve space to render the Calendar instance into.

                                          				oCalendarMenu.setBody("&#32;");

                                          				oCalendarMenu.body.id = "calendarcontainer";

                                          			});


                                          			// Add a listener for the "click" event.  This listener will be
                                          			// used to defer the creation the Calendar instance until the
                                          			// first time the Button's Overlay instance is requested to be displayed
                                          			// by the user.

                                          			oButton.on("click", onButtonClick);

                                          		});

                                          	}());

                                          </script>

                                               <div class="field" id="fromdate">


                                    	        <select id="month" name="month">
                                    	        	<option value="1">01</option>
                                    	        	<option value="2">02</option>
                                    	        	<option value="3">03</option>
                                    	        	<option value="4">04</option>
                                    	        	<option value="5">05</option>
                                    	        	<option value="6">06</option>
                                    	        	<option value="7">07</option>
                                    	        	<option value="8">08</option>
                                    	        	<option value="9">09</option>
                                    	        	<option value="10">10</option>
                                    	        	<option value="11">11</option>
                                    	        	<option value="12">12</option>
                                    	        </select>

                                    	        <select id="day" name="day">
                                    	        	<option value="1">01</option>
                                    	        	<option value="2">02</option>
                                    	        	<option value="3">03</option>
                                    	        	<option value="4">04</option>
                                    	        	<option value="5">05</option>
                                    	        	<option value="6">06</option>
                                    	        	<option value="7">07</option>
                                    	        	<option value="8">08</option>
                                    	        	<option value="9">09</option>
                                    	        	<option value="10">10</option>
                                    	        	<option value="11">11</option>
                                    	        	<option value="12">12</option>
                                    	        	<option value="13">13</option>
                                    	        	<option value="14">14</option>
                                    	        	<option value="15">15</option>
                                    	        	<option value="16">16</option>
                                    	        	<option value="17">17</option>
                                    	        	<option value="18">18</option>
                                    	        	<option value="19">19</option>
                                    	        	<option value="20">20</option>
                                    	        	<option value="21">21</option>
                                    	        	<option value="22">22</option>
                                    	        	<option value="23">23</option>
                                    	        	<option value="24">24</option>
                                    	        	<option value="25">25</option>
                                    	        	<option value="26">26</option>
                                    	        	<option value="27">27</option>
                                    	        	<option value="28">28</option>
                                    	        	<option value="29">29</option>
                                    	        	<option value="30">30</option>
                                    	        	<option value="31">31</option>
                                    	        </select>

                                                Κουπόνι της

                                    			<input type="text" id="year" name="year" value="">
                                            </div>
                                      </td>
                                      <td width="150px" align=left>
                                                <span id="pushbuttonReplicateDate" class="yui-button yui-push-button">
                                                <strong class="first-child">
                                                  <button type="button" name="pushbuttonReplicateDate">Εφαρμογή σε όλα</button>
                                                </strong>
                                                </span>
                                      </td>
                                      <td width="130px"></td>
                                      <td width="130px"></td>
                                      <td ></td>
                                      </tr>
                                      <tr><td colspan=5 height="20px"></td></tr>
                                      <tr>
                                      <td align="center">

                                                    <span id="pushbuttonAddLocalRec" class="yui-button yui-push-button">
                                                    <strong class="first-child">
                                                      <button type="button" name="pushbuttonAddLocalRec">Προσθήκη γραμμής</button>
                                                    </strong>
                                                    </span>

                                      </td>
                                      <td align="left">

                                                    <span id="pushbuttonOPAP" class="yui-button yui-push-button">
                                                    <strong class="first-child">
                                                      <button type="button" name="pushbuttonOPAP">Κουπόνι ΟΠΑΠ</button>
                                                    </strong>
                                                    </span>


                                      </td>
                                      <td align="center" >
                                          <span id="pushbuttonSaveRec" class="yui-button yui-push-button">
                                          <strong class="first-child">
                                            <button type="button" name="pushbuttonSaveRec">Αποθήκευση</button>
                                          </strong>
                                          </span>
                                      </td>
                                      <td align="center" >
                                          <span id="pushbuttonDelRec" class="yui-button yui-push-button">
                                          <strong class="first-child">
                                            <button type="button" name="pushbuttonDelRec">Διαγραφή όλων</button>
                                          </strong>
                                          </span>
                                      </td>
                                      <td></td>
                                  </tr>
                                  <tr><td colspan=5 height="20px"></td></tr>
                                  <tr>
                                  <td colspan=5>

                                      <div id="formatting" align="center"></div>

                                  </td>
                                  </tr>

                                  </table>


                        </p></div>

                        <div>
                        <br><br>

                         Η σύγκριση γίνεται με παιχνίδια της velvetbet.com που έχουν μέν τον <b>ίδιο κωδικό ΚΩΔ</b> με αυτόν της <b>Goal</b>, αλλά ταυτόχρονα ισχύουν και οι παρακάτω προϋποθέσεις για τα αντίστοιχα παιχνίδια της velvetbet.com<br><br>

                        <ol><li><b>είναι δημοσιευμένα</b></li><li><b>είναι ανοιχτά</b></li><li><b>δεν έχουν αποδελτιωθεί</b> και τέλος αυτά τα παιχνίδια</li><li><b>προβάλλονται</b></li></ol>


                    <div >
                      <br><br>
                      <b>Εξαίρεση από κανόνα (1): Εμφάνιση μη δημοσιευμένων</b> <br>
   				      <hr width="100%" style="Color:red;"></hr>


                      <Table width=100% align=left border=0>
                      <tr>
                        <td colspan=2 height=50px valign=top>
                        <form name="frm">
                         <input TYPE=checkbox NAME="notpublishedcompare" id="notpublishedcompare" > Ενεργοποίηση μη δημοσιευμένων
                         </form>

                        </td>
                      </tr>
                      <tr>
                        <td align=left width=200px>
                                            <script type="text/javascript">
											var oButtonCompareFrom;

                                          	(function () {

                                          		var Event = YAHOO.util.Event,
                                          			Dom = YAHOO.util.Dom;


                                          		Event.onContentReady("fromdatecompare", function () {

                                          			var oCalendarMenu;

                                          			var onButtonClick = function () {

                                          				// Create a Calendar instance and render it into the body
                                          				// element of the Overlay.

                                          				var oCalendar = new YAHOO.widget.Calendar("buttoncalendar", oCalendarMenu.body.id);

                                                  		// Correct formats for Greek: dd.mm.yyyy, dd.mm, mm.yyyy

                                                  		oCalendar.cfg.setProperty("DATE_FIELD_DELIMITER", "-");

                                                  		oCalendar.cfg.setProperty("MDY_DAY_POSITION", 1);
                                                  		oCalendar.cfg.setProperty("MDY_MONTH_POSITION", 2);
                                                  		oCalendar.cfg.setProperty("MDY_YEAR_POSITION", 3);

                                                  		oCalendar.cfg.setProperty("MD_DAY_POSITION", 1);
                                                  		oCalendar.cfg.setProperty("MD_MONTH_POSITION", 2);

                                                  		// Date labels for Greek locale

                                                  		oCalendar.cfg.setProperty("MONTHS_SHORT",   ["Ιαν", "Φεβ", "Μαρτ", "Απρ", "Μαι", "Ιουν", "Ιου", "Αυγ", "Σεπ", "Οκτ", "Νοε", "Δεκ"]);
                                                  		oCalendar.cfg.setProperty("MONTHS_LONG",    ["Ιανουάριος", "Φεβρουάριος", "Μάρτιος", "Απρίλιος", "Μάϊος", "Ιούνιος", "Ιούλιος", "Αύγουστος", "Σεπτέμβριος", "Οκτώβριος", "Νοέμβριος", "Δεκέμβριος"]);
                                                  		oCalendar.cfg.setProperty("WEEKDAYS_1CHAR", ["Κ", "Δ", "Τ", "Τ", "Π", "Π", "Σ"]);
                                                  		oCalendar.cfg.setProperty("WEEKDAYS_SHORT", ["Κυ", "Δε", "Τρ", "Τε", "Πε", "Πα", "Σα"]);
                                                  		oCalendar.cfg.setProperty("WEEKDAYS_MEDIUM",["Κυρ", "Δευ", "Τρι", "Τετ", "Πεμ", "Παρ", "Σαβ"]);
                                                  		oCalendar.cfg.setProperty("WEEKDAYS_LONG",  ["Κυριακή", "Δευτέρα", "Τρίτη", "Τετάρτη", "Πέμπτη", "Παρασκευή", "Σάββατο"]);


                                          				oCalendar.render();


                                          				// Subscribe to the Calendar instance's "select" event to
                                          				// update the Button instance's label when the user
                                          				// selects a date.

                                          				oCalendar.selectEvent.subscribe(function (p_sType, p_aArgs) {

                                          					var aDate,
                                          						nMonth,
                                          						nDay,
                                          						nYear;

                                          					if (p_aArgs) {

                                          						aDate = p_aArgs[0][0];

                                          						nMonth = aDate[1];
                                          						nDay = aDate[2];
                                          						nYear = aDate[0];

	                                                            Dom.get("monthcomparefrom").selectedIndex = (nMonth - 1);
                                          						Dom.get("daycomparefrom").selectedIndex = (nDay - 1);
                                          						Dom.get("yearcomparefrom").value = nYear;

                                          						oButtonCompareFrom.set("label", ( nDay + "-" +  nMonth + "-" + nYear));


                                          					}

                                          					oCalendarMenu.hide();






                                          				});


                                          				// Pressing the Esc key will hide the Calendar Menu and send focus back to
                                          				// its parent Button

                                          				Event.on(oCalendarMenu.element, "keydown", function (p_oEvent) {

                                          					if (Event.getCharCode(p_oEvent) === 27) {
                                          						oCalendarMenu.hide();
                                          						this.focus();
                                          					}

                                          				}, null, this);


                                          				var focusDay = function () {

                                          					var oCalendarTBody = Dom.get("buttoncalendar").tBodies[0],
                                          						aElements = oCalendarTBody.getElementsByTagName("a"),
                                          						oAnchor;


                                          					if (aElements.length > 0) {

                                          						Dom.batch(aElements, function (element) {

                                          							if (Dom.hasClass(element.parentNode, "today")) {
                                          								oAnchor = element;
                                          							}

                                          						});


                                          						if (!oAnchor) {
                                          							oAnchor = aElements[0];
                                          						}


                                          						// Focus the anchor element using a timer since Calendar will try
                                          						// to set focus to its next button by default

                                          						YAHOO.lang.later(0, oAnchor, function () {
                                          							try {
                                          								oAnchor.focus();
                                          							}
                                          							catch(e) {}
                                          						});

                                          					}

                                          				};


                                          				// Set focus to either the current day, or first day of the month in
                                          				// the Calendar	when it is made visible or the month changes

                                          				oCalendarMenu.subscribe("show", focusDay);
                                          				oCalendar.renderEvent.subscribe(focusDay, oCalendar, true);


                                          				// Give the Calendar an initial focus

                                          				focusDay.call(oCalendar);


                                          				// Re-align the CalendarMenu to the Button to ensure that it is in the correct
                                          				// position when it is initial made visible

                                          				oCalendarMenu.align();


                                          				// Unsubscribe from the "click" event so that this code is
                                          				// only executed once

                                          				this.unsubscribe("click", onButtonClick);

                                          			};


                                          			var oDateFields = Dom.get("fromdatecompare");
                                          				oMonthField = Dom.get("monthcomparefrom"),
                                          				oDayField = Dom.get("daycomparefrom"),
                                          				oYearField = Dom.get("yearcomparefrom");


                                          			// Hide the form fields used for the date so that they can be replaced by the
                                          			// calendar button.

                                          			oMonthField.style.display = "none";
                                          			oDayField.style.display = "none";
                                          			oYearField.style.display = "none";


                                          			// Create a Overlay instance to house the Calendar instance

                                          			oCalendarMenu = new YAHOO.widget.Overlay("calendarmenu", { visible: false });


                                          			// Create a Button instance of type "menu"

                                          			oButtonCompareFrom = new YAHOO.widget.Button({
                                          											type: "menu",
                                          											id: "calendarpicker",
                                          											label: "Hμερομηνία",
                                          											menu: oCalendarMenu,
                                          											container: "fromdatecompare" });


                                          			oButtonCompareFrom.on("appendTo", function () {

                                          				// Create an empty body element for the Overlay instance in order
                                          				// to reserve space to render the Calendar instance into.

                                          				oCalendarMenu.setBody("&#32;");

                                          				oCalendarMenu.body.id = "calendarcontainer";

                                          			});


                                          			// Add a listener for the "click" event.  This listener will be
                                          			// used to defer the creation the Calendar instance until the
                                          			// first time the Button's Overlay instance is requested to be displayed
                                          			// by the user.

                                          			oButtonCompareFrom.on("click", onButtonClick);

                                          		});

                                          	}());

                                          </script>

                                          <div class="field" id="fromdatecompare">


                                    	        <select id="monthcomparefrom" name="monthcomparefrom">
                                    	        	<option value="1">01</option>
                                    	        	<option value="2">02</option>
                                    	        	<option value="3">03</option>
                                    	        	<option value="4">04</option>
                                    	        	<option value="5">05</option>
                                    	        	<option value="6">06</option>
                                    	        	<option value="7">07</option>
                                    	        	<option value="8">08</option>
                                    	        	<option value="9">09</option>
                                    	        	<option value="10">10</option>
                                    	        	<option value="11">11</option>
                                    	        	<option value="12">12</option>
                                    	        </select>

                                    	        <select id="daycomparefrom" name="daycomparefrom">
                                    	        	<option value="1">01</option>
                                    	        	<option value="2">02</option>
                                    	        	<option value="3">03</option>
                                    	        	<option value="4">04</option>
                                    	        	<option value="5">05</option>
                                    	        	<option value="6">06</option>
                                    	        	<option value="7">07</option>
                                    	        	<option value="8">08</option>
                                    	        	<option value="9">09</option>
                                    	        	<option value="10">10</option>
                                    	        	<option value="11">11</option>
                                    	        	<option value="12">12</option>
                                    	        	<option value="13">13</option>
                                    	        	<option value="14">14</option>
                                    	        	<option value="15">15</option>
                                    	        	<option value="16">16</option>
                                    	        	<option value="17">17</option>
                                    	        	<option value="18">18</option>
                                    	        	<option value="19">19</option>
                                    	        	<option value="20">20</option>
                                    	        	<option value="21">21</option>
                                    	        	<option value="22">22</option>
                                    	        	<option value="23">23</option>
                                    	        	<option value="24">24</option>
                                    	        	<option value="25">25</option>
                                    	        	<option value="26">26</option>
                                    	        	<option value="27">27</option>
                                    	        	<option value="28">28</option>
                                    	        	<option value="29">29</option>
                                    	        	<option value="30">30</option>
                                    	        	<option value="31">31</option>
                                    	        </select>

                                                Για διάστημα από

                                    			<input type="text" id="yearcomparefrom" name="yearcomparefrom" value="">
                                            </div>


                      </td>
                      <td align=left>
                       <script type="text/javascript">
                                    var oCalendarCompareTo;
                                    var oButtonCompareTo;

                                	(function () {

                                		var Event = YAHOO.util.Event,
                                        	Dom = YAHOO.util.Dom;



                                		Event.onContentReady("todatecompare", function () {

                                			var oCalendarMenu;



                                			var onButtonClick = function () {

                               				// Create a Calendar instance and render it into the body
                                				// element of the Overlay.

                                			   oCalendarCompareTo = new YAHOO.widget.Calendar("buttoncalendar2", oCalendarMenu.body.id);

                                        		// Correct formats for Greek: dd.mm.yyyy, dd.mm, mm.yyyy

                                        		oCalendarCompareTo.cfg.setProperty("DATE_FIELD_DELIMITER", "-");

                                        		oCalendarCompareTo.cfg.setProperty("MDY_DAY_POSITION", 1);
                                        		oCalendarCompareTo.cfg.setProperty("MDY_MONTH_POSITION", 2);
                                        		oCalendarCompareTo.cfg.setProperty("MDY_YEAR_POSITION", 3);

                                        		oCalendarCompareTo.cfg.setProperty("MD_DAY_POSITION", 1);
                                        		oCalendarCompareTo.cfg.setProperty("MD_MONTH_POSITION", 2);

                                        		// Date labels for Greek locale

                                        		oCalendarCompareTo.cfg.setProperty("MONTHS_SHORT",   ["Ιαν", "Φεβ", "Μαρτ", "Απρ", "Μαι", "Ιουν", "Ιου", "Αυγ", "Σεπ", "Οκτ", "Νοε", "Δεκ"]);
                                        		oCalendarCompareTo.cfg.setProperty("MONTHS_LONG",    ["Ιανουάριος", "Φεβρουάριος", "Μάρτιος", "Απρίλιος", "Μάϊος", "Ιούνιος", "Ιούλιος", "Αύγουστος", "Σεπτέμβριος", "Οκτώβριος", "Νοέμβριος", "Δεκέμβριος"]);
                                        		oCalendarCompareTo.cfg.setProperty("WEEKDAYS_1CHAR", ["Κ", "Δ", "Τ", "Τ", "Π", "Π", "Σ"]);
                                        		oCalendarCompareTo.cfg.setProperty("WEEKDAYS_SHORT", ["Κυ", "Δε", "Τρ", "Τε", "Πε", "Πα", "Σα"]);
                                        		oCalendarCompareTo.cfg.setProperty("WEEKDAYS_MEDIUM",["Κυρ", "Δευ", "Τρι", "Τετ", "Πεμ", "Παρ", "Σαβ"]);
                                        		oCalendarCompareTo.cfg.setProperty("WEEKDAYS_LONG",  ["Κυριακή", "Δευτέρα", "Τρίτη", "Τετάρτη", "Πέμπτη", "Παρασκευή", "Σάββατο"]);
                                                oCalendarCompareTo.render();
                                				// Subscribe to the Calendar instance's "select" event to
                                				// update the Button instance's label when the user
                                				// selects a date.
                                				oCalendarCompareTo.selectEvent.subscribe(function (p_sType, p_aArgs) {

                                					var aDate,
                                						nMonth,
                                						nDay,
                                						nYear;

                                					if (p_aArgs) {

                                						aDate = p_aArgs[0][0];

                                						nMonth = aDate[1];
                                						nDay = aDate[2];
                                						nYear = aDate[0];

                                						oButtonCompareTo.set("label", ( nDay + "-" +  nMonth+ "-" + nYear));


                                						// Sync the Calendar instance's selected date with the date form fields

                                						Dom.get("monthcompareto").selectedIndex = (nMonth - 1);
                                						Dom.get("daycompareto").selectedIndex = (nDay - 1);
                                						Dom.get("yearcompareto").value = nYear;

                                					}

                                					oCalendarMenu.hide();


                                				});


                                				// Pressing the Esc key will hide the Calendar Menu and send focus back to
                                				// its parent Button

                                				Event.on(oCalendarMenu.element, "keydown", function (p_oEvent) {

                                					if (Event.getCharCode(p_oEvent) === 27) {
                                						oCalendarMenu.hide();
                                						this.focus();
                                					}

                                				}, null, this);


                                				var focusDay = function () {

                                					var oCalendarTBody = Dom.get("buttoncalendar2").tBodies[0],
                                						aElements = oCalendarTBody.getElementsByTagName("a"),
                                						oAnchor;


                                					if (aElements.length > 0) {

                                						Dom.batch(aElements, function (element) {

                                							if (Dom.hasClass(element.parentNode, "today")) {
                                								oAnchor = element;
                                							}

                                						});


                                						if (!oAnchor) {
                                							oAnchor = aElements[0];
                                						}


                                						// Focus the anchor element using a timer since Calendar will try
                                						// to set focus to its next button by default

                                						YAHOO.lang.later(0, oAnchor, function () {
                                							try {
                                								oAnchor.focus();
                                							}
                                							catch(e) {}
                                						});

                                					}

                                				};


                                				// Set focus to either the current day, or first day of the month in
                                				// the Calendar	when it is made visible or the month changes

                                				oCalendarMenu.subscribe("show", focusDay);
                                				oCalendarCompareTo.renderEvent.subscribe(focusDay, oCalendarCompareTo, true);


                                				// Give the Calendar an initial focus

                                				focusDay.call(oCalendarCompareTo);


                                				// Re-align the CalendarMenu to the Button to ensure that it is in the correct
                                				// position when it is initial made visible

                                				oCalendarMenu.align();


                                				// Unsubscribe from the "click" event so that this code is
                                				// only executed once

                                				this.unsubscribe("click", onButtonClick);



                                			};


                                			var oDateFields = Dom.get("todatecompare");
                                				oMonthField = Dom.get("monthcompareto"),
                                				oDayField = Dom.get("daycompareto"),
                                				oYearField = Dom.get("yearcompareto");


                                			// Hide the form fields used for the date so that they can be replaced by the
                                			// calendar button.

                                			oMonthField.style.display = "none";
                                			oDayField.style.display = "none";
                                			oYearField.style.display = "none";


                                			// Create a Overlay instance to house the Calendar instance

                                			oCalendarMenu = new YAHOO.widget.Overlay("calendarmenu2", { visible: false });



                                			// Create a Button instance of type "menu"

                                			oButtonCompareTo = new YAHOO.widget.Button({
                                											type: "menu",
                                											id: "calendarpicker2",
                                											label: "Hμερομηνία",
                                											menu: oCalendarMenu,
                                											container: "todatecompare" });


                                		    	oButtonCompareTo.on("appendTo", function () {

                                				// Create an empty body element for the Overlay instance in order
                                				// to reserve space to render the Calendar instance into.

                                				oCalendarMenu.setBody("&#32;");

                                				oCalendarMenu.body.id = "calendarcontainer2";


                                			});




                                			// Add a listener for the "click" event.  This listener will be
                                			// used to defer the creation the Calendar instance until the
                                			// first time the Button's Overlay instance is requested to be displayed
                                			// by the user.

                                			oButtonCompareTo.on("click", onButtonClick);

	                                        Dom.get("tomonth").selectedIndex = <?php echo date('m')-1; ?>;
                                			Dom.get("today").selectedIndex = <?php echo date('d')-1; ?>;
                                			Dom.get("toyear").value = <?php echo date('Y'); ?>;;


                                		});

                                	}());

                        </script>
                                                <div class="field" id="todatecompare">

                                    	        <select id="monthcompareto" name="monthcompareto">
                                    	        	<option value="1">01</option>
                                    	        	<option value="2">02</option>
                                    	        	<option value="3">03</option>
                                    	        	<option value="4">04</option>
                                    	        	<option value="5">05</option>
                                    	        	<option value="6">06</option>
                                    	        	<option value="7">07</option>
                                    	        	<option value="8">08</option>
                                    	        	<option value="9">09</option>
                                    	        	<option value="10">10</option>
                                    	        	<option value="11">11</option>
                                    	        	<option value="12">12</option>
                                    	        </select>

                                    	        <select id="daycompareto" name="daycompareto">
                                    	        	<option value="1">01</option>
                                    	        	<option value="2">02</option>
                                    	        	<option value="3">03</option>
                                    	        	<option value="4">04</option>
                                    	        	<option value="5">05</option>
                                    	        	<option value="6">06</option>
                                    	        	<option value="7">07</option>
                                    	        	<option value="8">08</option>
                                    	        	<option value="9">09</option>
                                    	        	<option value="10">10</option>
                                    	        	<option value="11">11</option>
                                    	        	<option value="12">12</option>
                                    	        	<option value="13">13</option>
                                    	        	<option value="14">14</option>
                                    	        	<option value="15">15</option>
                                    	        	<option value="16">16</option>
                                    	        	<option value="17">17</option>
                                    	        	<option value="18">18</option>
                                    	        	<option value="19">19</option>
                                    	        	<option value="20">20</option>
                                    	        	<option value="21">21</option>
                                    	        	<option value="22">22</option>
                                    	        	<option value="23">23</option>
                                    	        	<option value="24">24</option>
                                    	        	<option value="25">25</option>
                                    	        	<option value="26">26</option>
                                    	        	<option value="27">27</option>
                                    	        	<option value="28">28</option>
                                    	        	<option value="29">29</option>
                                    	        	<option value="30">30</option>
                                    	        	<option value="31">31</option>
                                    	        </select>

                                                έως την

                                    			<input type="text" id="yearcompareto" name="yearcompareto" value="">
                                            </div>


                      </td>
                      </tr>
                      <tr>
                        <td colspan=2>
                         <br><br>
                         <b>Διάβασμα από αρχείο και όχι on-line</b> <br>
                            <hr width="100%" style="Color:red;"></hr>

                          <form name="frm1">
                           <input TYPE=checkbox NAME="readfile" id="readfile" > Διάβασμα από αρχείο
                           </form>
                           <br><br>
                                <div id="uiElements" style="display:inline;">
                                		<div id="postVars">
                                		Set custom values for a couple POST vars:<br/>
                                		var1: <input type="text" id="var1Value" value="var1 default value" /><br/>
                                		var2: <input type="text" id="var2Value" value="var2 default value" /><br/><br/>
                                		</div>
                                		<div id="uploaderContainer">
                                			<div id="uploaderOverlay" style="position:absolute; z-index:2"></div>
                                			<div id="selectFilesLink" style="z-index:1"><a id="selectLink" href="#">Select File</a></div>
                                		</div>
                                		<div id="uploadFilesLink"><a id="uploadLink" onClick="upload(); return false;" href="#">Upload File</a></div><br/>
                                		<div id="selectedFileDisplay">
                                		Progress: <input type="text" cols="50" id="progressReport" value="" readonly /><br/><br/>
                                		</div>
                                		<div id="returnedDataDisplay">
                                		Data returned by the server:<br/>
                                		<textarea id="serverData" rows="5" cols="50"></textarea>
                                		</div>
                                </div>

                        </td>
                      </tr>
                      <tr>
                      <td colspan=2>
                      <hr width="100%" style="Color:red;"></hr>


                        <br><br>
                            <span id="pushbuttonCompareGoalBetInt" class="yui-button yui-push-button">
                            <strong class="first-child">
                              <button type="button" name="pushbuttonCompareGoalBetInt"> Σύγκριση με Goal </button>
                            </strong>
                            </span>
                            <br><br>

                      </td>
                      </tr>
                      </table>
                      <table>
                      <tr>
                      <td>
                         <div id="compareGoalBetIntTable" align="left"></div>
                      </td>
                      </tr>
                      </table>

                        </div>
                    </div>
                </div>


            </TD>
        </TR>



        </Table>



        <Script type="text/javascript">

        var oDate,oDateShow;
		var AddDataTable;
        var DataEdit
        var compareGoalBetIntTable;
        var elDropDownchapionships, elDropDownchapionships2;
        var elDropDowncountries, elDropDowncountries2;
        var elDropDownteams, elDropDownteams2;
        var Published;
        var myTabView = new YAHOO.widget.TabView("tvcontainer");



         //-------------- upload

 YAHOO.util.Event.onDOMReady(function () {
var uiLayer = YAHOO.util.Dom.getRegion('selectLink');
var overlay = YAHOO.util.Dom.get('uploaderOverlay');
YAHOO.util.Dom.setStyle(overlay, 'width', uiLayer.right-uiLayer.left + "px");
YAHOO.util.Dom.setStyle(overlay, 'height', uiLayer.bottom-uiLayer.top + "px");
});

	// Custom URL for the uploader swf file (same folder).
	YAHOO.widget.Uploader.SWFURL = "../grafix/uploader.swf";

    // Instantiate the uploader and write it to its placeholder div.
	var uploader = new YAHOO.widget.Uploader( "uploaderOverlay" );

	// Add event listeners to various events on the uploader.
	// Methods on the uploader should only be called once the
	// contentReady event has fired.

	uploader.addListener('contentReady', handleContentReady);
	uploader.addListener('fileSelect', onFileSelect)
	uploader.addListener('uploadStart', onUploadStart);
	uploader.addListener('uploadProgress', onUploadProgress);
	uploader.addListener('uploadCancel', onUploadCancel);
	uploader.addListener('uploadComplete', onUploadComplete);
	uploader.addListener('uploadCompleteData', onUploadResponse);
	uploader.addListener('uploadError', onUploadError);
    uploader.addListener('rollOver', handleRollOver);
    uploader.addListener('rollOut', handleRollOut);
    uploader.addListener('click', handleClick);

    // Variable for holding the selected file id.
	var fileID;

	// When the mouse rolls over the uploader, this function
	// is called in response to the rollOver event.
	// It changes the appearance of the UI element below the Flash overlay.
	function handleRollOver () {
		YAHOO.util.Dom.setStyle(YAHOO.util.Dom.get('selectLink'), 'color', "#FFFFFF");
		YAHOO.util.Dom.setStyle(YAHOO.util.Dom.get('selectLink'), 'background-color', "#000000");
	}

	// On rollOut event, this function is called, which changes the appearance of the
	// UI element below the Flash layer back to its original state.
	function handleRollOut () {
		YAHOO.util.Dom.setStyle(YAHOO.util.Dom.get('selectLink'), 'color', "#0000CC");
		YAHOO.util.Dom.setStyle(YAHOO.util.Dom.get('selectLink'), 'background-color', "#FFFFFF");
	}

	// When the Flash layer is clicked, the "Browse" dialog is invoked.
	// The click event handler allows you to do something else if you need to.
	function handleClick () {
	}

	// When contentReady event is fired, you can call methods on the uploader.
	function handleContentReady () {
	    // Allows the uploader to send log messages to trace, as well as to YAHOO.log
		uploader.setAllowLogging(true);

		// Disallows multiple file selection in "Browse" dialog.
		uploader.setAllowMultipleFiles(false);

		// New set of file filters.
		var ff = new Array({description:"Anything", extensions:"*.*"} );

		// Apply new set of file filters to the uploader.
		uploader.setFileFilters(ff);
	}

	// Actually uploads the files. Since we are only allowing one file
	// to be selected, we use the upload function, in conjunction with the id
	// of the selected file (returned by the fileSelect event). We are also including
	// the text of the variables specified by the user in the input UI.

	function upload() {
	if (fileID != null) {
	  //"http://localhost/lackybet/myadmin/includes/upload_simple.php",
		uploader.upload(fileID, "http://www.velvetbet.com/myadmin/includes/upload_simple.php",
		                "POST",
		                {var1:document.getElementById("var1Value").value,
						 var2:document.getElementById("var2Value").value});
	}
	}

	// Fired when the user selects files in the "Browse" dialog
	// and clicks "Ok". Here, we set the value of the progress
	// report textfield to reflect the fact that a file has been
	// selected.

	function onFileSelect(event) {
		for (var file in event.fileList) {
		    if(YAHOO.lang.hasOwnProperty(event.fileList, file)) {
				fileID = event.fileList[file].id;
			}
		}

		this.progressReport = document.getElementById("progressReport");
		this.progressReport.value = "Selected " + event.fileList[fileID].name;
	}


    // When the upload starts, we inform the user about it via
	// the progress report textfield.
	function onUploadStart(event) {
		this.progressReport.value = "Starting upload...";
	}

	// As upload progresses, we report back to the user via the
	// progress report textfield.
	function onUploadProgress(event) {
		prog = Math.round(100*(event["bytesLoaded"]/event["bytesTotal"]));
		this.progressReport.value = prog + "% uploaded...";
	}

	// Report back to the user that the upload has completed.
	function onUploadComplete(event) {
		this.progressReport.value = "Upload complete.";
	}

	// Report back to the user if there has been an error.
	function onUploadError(event) {
		this.progressReport.value = "Upload error.";
	}

	// Do something if an upload is canceled.
	function onUploadCancel(event) {

	}

	// When the data is received back from the server, display it to the user
	// in the server data text area.
	function onUploadResponse(event) {
		this.serverData = document.getElementById("serverData");
		this.serverData.value = event.data;
	}

         //---------------------


          parseSQLDate = function(ISOdate,output)
          {

              if (ISOdate=='-')
                  return "";

              var time = '';
              var pos = ISOdate.indexOf('-');
              var year = ISOdate.substr(0,pos);

              var pos2 = ISOdate.indexOf('-',pos+1);
              var month =  ISOdate.substr(pos+1,(pos2-pos-1));

              pos = ISOdate.indexOf(' ');
              if (pos != -1) {
                  var day =  ISOdate.substr(pos2+1,(pos-pos2-1));
                  time = ISOdate.substr(pos+1);

              }
              else
                  var day =  ISOdate.substr(pos2+1);




              if (pos != -1) {
                  var jsdate = new Date (month+"/"+day+"/"+year+' '+ time);
                  var formatedDateTime = dateFormat(jsdate,"dd/mm/yyyy HH:MM");

              }
              else {
                  var jsdate = new Date (month+"/"+day+"/"+year);
                  var formatedDateTime = dateFormat(jsdate,"dd/mm/yyyy");
              }

              if (output==1)
                  return jsdate;
              else
                  return  formatedDateTime;

          };


            //************ virtual functions for dynamic drop down updating *************************

		    YAHOO.widget.DropdownCellEditor.prototype.renderForm = function() {

                var elDropdown = this.getContainerEl().appendChild( document.createElement( "select") );
                elDropdown.style. zoom = 1;
                this.dropdown = elDropdown;

                this.setOptions( );

                if(this.disableBtns ) {
                    this.handleDisabledBtns();
                }
            };




            YAHOO.widget.DropdownCellEditor.prototype.setOptions = function () {

                var elDropdown = this.dropdown;

                elDropdown.innerHTML = "";
                if(YAHOO.lang.isArray( this.dropdownOptions)) {

                    var dropdownOption, elOption;
                    for(var i=0, j=this.dropdownOptions.length; i<j; i++) {
                        dropdownOption = this.dropdownOptions[i];
                        elOption = document.createElement("option" );
                        elOption.value = (YAHOO.lang.isValue( dropdownOption.value)) ? dropdownOption.value : dropdownOption;
                        elOption.innerHTML = (YAHOO.lang.isValue( dropdownOption. label)) ? dropdownOption.label : dropdownOption;
                        elOption = elDropdown.appendChild(elOption) ;
                    }
                }
            };

            //***********************************************************************************************

           var ajaxLoadingPanel = new YAHOO.widget.Panel('ajaxLoadPanel', {
                width:"240px",
                fixedcenter:true,
                close:false,
                draggable:false,
                modal:true,
                visible:false
                //effect:{effect:YAHOO.widget.ContainerEffect.FADE,duration:0.25}
            }
            );

            ajaxLoadingPanel.setHeader('Παρακαλώ περιμένετε...');
            ajaxLoadingPanel.setBody('<img src="../grafix/ajax-loader.gif" />');
            ajaxLoadingPanel.render(document.body);
            ajaxLoadingPanel.bringToTop();


            //Create a SimpleDialog used to mimic an OS dialog
            var panel = new YAHOO.widget.SimpleDialog('alert', {
                fixedcenter: true,
                visible: false,
                modal: true,
                width: '500px',
                constraintoviewport: true,
                icon: YAHOO.widget.SimpleDialog.ICON_WARN,
                buttons: [
                    { text: 'OK', handler: function() {
                        panel.hide();
                    }, isDefault: true }
                ]
            });
            //Set the header
            panel.setHeader('Alert');
            //Give the body something to render with
            panel.setBody('Notta');
            //Render the Dialog to the body
            panel.render(document.body);

            //Create a namepaced alert method
            YAHOO.example.alert = function(str) {

                //Set the body to the string passed
                panel.setBody(str);
                //Set an icon
                panel.cfg.setProperty('icon', YAHOO.widget.SimpleDialog.ICON_WARN);
                //Bring the dialog to the top
                panel.bringToTop();
                //Show it
                panel.show();
            };


        function onPrevDayMatch(p_oEvent) {



			var oYearShow =  YAHOO.util.Dom.get("toyear").value;
			var oMonthShow =  YAHOO.util.Dom.get("tomonth").value;
			var oDayShow =  YAHOO.util.Dom.get("today").value;


            var newDate = new Date(oYearShow,oMonthShow-1,oDayShow);
            newDate.setDate(newDate.getDate()-1);




            YAHOO.util.Dom.get("toyear").value =  newDate.getFullYear();
			YAHOO.util.Dom.get("tomonth").value = eval(newDate.getMonth()+1);
			YAHOO.util.Dom.get("today").value = newDate.getDate();



            var strLabel = newDate.getDate() + '-' + eval(newDate.getMonth()+1) + '-' + newDate.getFullYear ();
			oDateShow = newDate.getFullYear () + '-' + eval(newDate.getMonth()+1) + '-' + newDate.getDate(); ;

            oButtonView.set("label", ( strLabel ) );
            // Sends a request to the DataSource for more data
            var oUpdateTableCallBack = {
                success :AddDataTable.onDataReturnReplaceRows,
                failure :AddDataTable.onDataReturnReplaceRows,
                scope   : AddDataTable
            };

           var sqlquery = "query=coupons&type=select&primaryKey=CouponID&whereID=" + oDateShow;
           AddDataTable.getDataSource().sendRequest(sqlquery, oUpdateTableCallBack);


        }

        function onNextDayMatch(p_oEvent) {



			var oYearShow =  YAHOO.util.Dom.get("toyear").value;
			var oMonthShow =  YAHOO.util.Dom.get("tomonth").value;
			var oDayShow =  YAHOO.util.Dom.get("today").value;


            var newDate = new Date(oYearShow,oMonthShow-1,oDayShow);
            newDate.setDate(newDate.getDate()+1);




            YAHOO.util.Dom.get("toyear").value =  newDate.getFullYear();
			YAHOO.util.Dom.get("tomonth").value = eval(newDate.getMonth()+1);
			YAHOO.util.Dom.get("today").value = newDate.getDate();



            var strLabel = newDate.getDate() + '-' + eval(newDate.getMonth()+1) + '-' + newDate.getFullYear ();
			oDateShow = newDate.getFullYear () + '-' + eval(newDate.getMonth()+1) + '-' + newDate.getDate(); ;

            oButtonView.set("label", ( strLabel ) );


            // Sends a request to the DataSource for more data
            var oUpdateTableCallBack = {
                success :AddDataTable.onDataReturnReplaceRows,
                failure :AddDataTable.onDataReturnReplaceRows,
                scope   :AddDataTable
            };

           var sqlquery = "query=coupons&type=select&primaryKey=CouponID&whereID=" + oDateShow;
           AddDataTable.getDataSource().sendRequest(sqlquery, oUpdateTableCallBack);

        }

         var AjaxObject = {
        	handleSuccess:function(o){
        		// This member handles the success response
        		// and passes the response object o to AjaxObject's
        		// processResult member.
        		this.processResult(o);
                try {
                    var r = YAHOO.lang.JSON.parse(o.responseText);
                }
                catch (x) {
                    alert("JSON Parse failed!");
                    return;
                }


				if (r.Date == oDateShow) {

                    AddDataTable.addRow({CouponID:r.CouponID, CountryID:r.CountryID, ChapionshipID:r.ChapionshipID, Time:r.Time,
                    Code:r.Code, EE:r.EE, Goal_1:r.Goal_1, HomeTeamID:r.HomeTeamID, Goal_x:r.Goal_x, HostTeamID:r.HostTeamID,
                    Goal_2:r.Goal_2, de_1ORX:r.de_1ORX, de_XOR2:r.de_XOR2, de_1OR2:r.de_1OR2, Under:r.Under, Over:r.Over,
                    GG:r.GG, NG:r.NG, HMI_1:r.HMI_1, HMI_X:r.HMI_X ,HMI_2:r.HMI_2 ,HT_11:r.HT_11 ,HT_1X:r.HT_1X ,HT_12:r.HT_12 ,
                    HT_X1:r.HT_X1 ,HT_XX:r.HT_XX ,HT_X2:r.HT_X2 ,HT_21:r.HT_21 ,HT_2X:r.HT_2X ,HT_22:r.HT_22 ,SS_10:r.SS_10 ,
                    SS_20:r.SS_20 ,SS_21:r.SS_21 ,SS_30:r.SS_30 ,SS_31:r.SS_31 ,SS_32:r.SS_32 ,SS_40:r.SS_40 ,
                    SS_41:r.SS_41 ,SS_42:r.SS_42 ,SS_43:r.SS_43 ,SS_00:r.SS_00 ,SS_11:r.SS_11 ,SS_22:r.SS_22 ,SS_33:r.SS_33 ,
                    SS_01:r.SS_01 ,SS_02:r.SS_02 ,SS_12:r.SS_12 ,SS_03:r.SS_03 ,SS_13:r.SS_13 ,SS_23:r.SS_23 ,SS_04:r.SS_04 ,
                    SS_14:r.SS_14 ,SS_24:r.SS_24 ,
                    SS_34:r.SS_34 ,TG_01:r.TG_01 ,TG_23:r.TG_23 ,TG_46:r.TG_46 ,TG_7:r.TG_7,
                    Published:r.Published, Canceled:r.Canceled, Showed:1});


				}

				if (r.SpecialCouponADDStatus == 'LAST'){
                    ajaxLoadingPanel.hide();
                    YAHOO.example.alert('Το κουπόνι αποθηκεύτηκε επιτυχώς.');
                    DataEdit.deleteRows ( 0 , DataEdit.getRecordSet().getLength() );
        			YAHOO.util.Dom.get("year").value = '';
        			YAHOO.util.Dom.get("month").value = '';
        			YAHOO.util.Dom.get("day").value = '';
                    oButton.set("label","Hμερομηνία");

   				}
        	},

        	handleFailure:function(o){
        		alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή σας δεν αποθηκεύτηκε.');
        	},

        	processResult:function(o){
        		// This member is called by handleSuccess
        	},

        	startRequest:function(query,Status) {
               callback.argument = Status;

			   YAHOO.util.Connect.asyncRequest('GET', '../includes/dataproxy.php?' + query, callback);



        	}

        };

        /*
         * Define the callback object for success and failure
         * handlers as well as object scope.
         */
        var callback =
        {
        	success:AjaxObject.handleSuccess,
        	failure:AjaxObject.handleFailure,
        	scope: AjaxObject

        };

        function onSaveRec(p_oEvent) {


			var Status;
            var oDateRecSet,recset;
            var CurrentDate = dateFormat(Date(),"yyyy-mm-dd");
            var PossibleError = -1;


			var oYear =  YAHOO.util.Dom.get("year").value;
			var oMonth =  YAHOO.util.Dom.get("month").value;
			var oDay =  YAHOO.util.Dom.get("day").value;
			oDate =  oYear + '-' + oMonth + '-' + oDay;

			var oYearShow =  YAHOO.util.Dom.get("toyear").value;
			var oMonthShow =  YAHOO.util.Dom.get("tomonth").value;
			var oDayShow =  YAHOO.util.Dom.get("today").value;


            oDateShow = dateFormat(new Date(oYearShow,oMonthShow-1,oDayShow),"yyyy-mm-dd");


            for(i=0;i<=DataEdit.getRecordSet().getLength()-1;i++){

  				recset = DataEdit.getRecordSet().getRecord(i)._oData;

                oDateRecSet = dateFormat(recset.Date,"yyyy-mm-dd");


                if ( (oDateRecSet == CurrentDate) || (oDateRecSet < CurrentDate) ) {

                    PossibleError = i+1;
                    break;

                }




            }



            if (PossibleError != -1) {
                if (!confirm('Τουλάχιστον μια εγγραφή έχει ημερομηνία ίδια η μικρότερη με τη σημερινή δηλαδή με την '+dateFormat(Date(),"dd/mm/yyyy")+'.\n\n'+
                             'Kάτι τέτοιο δεν είναι η συνήθης διαδικασία, αφού το κουπόνι ετοιμάζεται για αγώνες που θα διεξαχθούν στις επόμενες ημέρες.\n\n'+
                             'Εφόσον δεν πρόκειται για λάθος, είστε σίγουρος ότι θέλετε να προχωρήσετε στην αποθήκευση ;')) {

                        YAHOO.example.alert('Το κουπόνι ΔΕΝ αποθηκεύτηκε, επειδή ακυρώσατε τη διαδικασία.\n\n');
      		        	return;

                }
            }




  		    if (DataEdit.getRecordSet().getLength() == 0) {

  		    	YAHOO.example.alert('Παρακαλώ εισάγετε τουλάχιστον μια γραμμή στον πίνακα');
  		    	return;

  		    }



  			//do first a check for errors
              for(i=0;i<=DataEdit.getRecordSet().getLength()-1;i++){

  				var recset = DataEdit.getRecordSet().getRecord(i)._oData;
  				//alert(YAHOO.lang.dump(recset));

  				if ( (recset.Date=='0000-00-00') || (recset.CountryID==0) || (recset.ChapionshipID==0) || (recset.Time == '00:00') || (recset.Code == 0) ||
  				   (recset.EE == 0) || (recset.Goal_1 == 0) || (recset.Goal_x == 0) || (recset.Goal_2 == 0) || (recset.HomeTeamID == 0) ||
  				   (recset.HostTeamID == 0)  ) {


  						var line = i+1;
  						YAHOO.example.alert('Δεν συμπληρώθηκε κάποιο υποχρεωτικό πεδίο στη γραμμή ' + line + '.<br><br>Τα στοιχεία δεν αποθηκεύτηκαν.');
  						return;

  				}


              }


             ajaxLoadingPanel.show();
  			//if you come here then save to the database
              for(i=0;i<=DataEdit.getRecordSet().getLength()-1;i++){

  				var recset = DataEdit.getRecordSet().getRecord(i)._oData;

                  var recDate = dateFormat(recset.Date,"yyyy-mm-dd");
                  recset.Date = recDate;
  			      var json = YAHOO.lang.JSON.stringify(recset);
  				  var newjson = json.substr(1, json.length-1 );

  			      if  (i == (DataEdit.getRecordSet().getLength()-1)) {
  						newjson = '"SpecialCouponADDStatus":"LAST",' + newjson;


  				  }
    			    else {
  						newjson = '"SpecialCouponADDStatus":"NEXTREC",' + newjson;
  				  }

                   /*

                  if (Published==1) {
                      newjson = '{"Published":"1", "Canceled":"0",' + newjson;

                  }
                  else
                  */
      				newjson = '{"Canceled":"0",' + newjson;


                  Status = 0;



                  // Start the transaction.
  			   AjaxObject.startRequest('query=coupons&primaryKey=CouponID&type=insert&jsondata=' + newjson,Status);
               //alert('query=coupons&primaryKey=CouponID&type=insert&jsondata=' + newjson,Status);


              }



        }



        function onAddLocalRec(p_oEvent) {

            DataEdit.addRow({"AA":DataEdit.getRecordSet().getLength()+1, "Date":new Date(), "CountryID": "", "ChapionshipID": "",  "Time":"00:00", "Code":0, "EE":0, "Goal_1":0, "HomeTeamID":"", "Goal_x":0, "HostTeamID": "", "Goal_2":0, "de_1ORX":0, "de_XOR2":0, "de_1OR2":0, "Under":0, "Over":0, "GG":0, "NG":0,
            "HMI_1":0, "HMI_X":0, "HMI_2":0, "HT_11":0, "HT_1X":0, "HT_12":0, "HT_X1":0, "HT_XX":0, "HT_X2":0, "HT_21":0, "HT_2X":0, "HT_22":0, "SS_10":0, "SS_20":0, "SS_21":0, "SS_30":0, "SS_31":0, "SS_32":0,
            "SS_40":0, "SS_41":0, "SS_42":0, "SS_43":0, "SS_00":0, "SS_11":0, "SS_22":0, "SS_33":0, "SS_01":0, "SS_02":0, "SS_12":0, "SS_03":0, "SS_13":0, "SS_23":0, "SS_04":0, "SS_14":0, "SS_24":0, "SS_34":0,
            "TG_01":0, "TG_23":0, "TG_46":0, "TG_7":0
            });

        }

        function onActivateCoupon(p_oEvent) {

            var msg,query;
            var oPublishedValue;


            var oYearShow =  YAHOO.util.Dom.get("toyear").value;
			var oMonthShow =  YAHOO.util.Dom.get("tomonth").value;
			var oDayShow =  YAHOO.util.Dom.get("today").value;


            if ( (AddDataTable.getRecordSet().getLength()) <= 0 )
            {
                οPushButtonActivateCoupon.set("checked", false);
                return;
            }


			oDateShow =  oYearShow + '-' + oMonthShow + '-' + oDayShow;

            if (οPushButtonActivateCoupon.get("checked")) {
                 οPushButtonActivateCoupon.set("label", "Δημοσιευμένο");
                 msg = 'Το κουπόνι της ' + oDayShow + '-' + oMonthShow +  '-' + oYearShow + ' <b>εμφανίζεται</b> από τώρα στους χρήστες του συστήματος';
                 query = "../includes/dataproxy.php?query=coupons&type=update&column=Published&newvalue=1&primaryKey=Date&id=@" + oDateShow;
                 oPublishedValue = 1;
            }
            else {
                 οPushButtonActivateCoupon.set("label", "Μη Δημοσιευμένο");
                 msg = 'Το κουπόνι της ημέρας ' + oDayShow + '-' + oMonthShow +  '-' + oYearShow + ' <b>δεν εμφανίζεται</b> τώρα στους χρήστες του συστήματος';
                 query = "../includes/dataproxy.php?query=coupons&type=update&column=Published&newvalue=0&primaryKey=Date&id=@" + oDateShow;
                 oPublishedValue = 0;
            }




            YAHOO.util.Connect.asyncRequest('GET', query, {
                           success: function(o) {
                              records = AddDataTable.getRecordSet().getRecords();
                              for(i=0; i < records.length; i++){
                                AddDataTable.getRecordSet().updateKey(records[i], "Published", oPublishedValue);
                              }
                              AddDataTable.refreshView();
                              YAHOO.example.alert(msg);


                          },
                          failure: function(o) {
                                 alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή σας δεν αποθηκεύτηκε.');
                          },
                          scope: this
             });



        }

        function onCompareGoalBetInt(p_oEvent) {

            var exception_published_checkbox = document.frm.notpublishedcompare.checked;
            if (exception_published_checkbox) {

                var oCmpFromYear =  YAHOO.util.Dom.get("yearcomparefrom").value;
    			var oCmpFromMonth =  YAHOO.util.Dom.get("monthcomparefrom").value;
    			var oCmpFromDay =  YAHOO.util.Dom.get("daycomparefrom").value;

                var oCmpFromDate =  oCmpFromYear + '-' + oCmpFromMonth + '-' + oCmpFromDay;

                var oCmpToYear =  YAHOO.util.Dom.get("yearcompareto").value;
    			var oCmpToMonth =  YAHOO.util.Dom.get("monthcompareto").value;
    			var oCmpToDay =  YAHOO.util.Dom.get("daycompareto").value;

                var oCmpToDate =  oCmpToYear + '-' + oCmpToMonth + '-' + oCmpToDay;



    		    if (oCmpFromYear=='') {

    		    	YAHOO.example.alert('Παρακαλώ επιλέξτε ημερομηνία <strong>από</strong>');
    		    	return;

    		    }

    		    if (oCmpToYear=='') {

    		    	YAHOO.example.alert('Παρακαλώ επιλέξτε ημερομηνία <strong>έως</strong>');
    		    	return;

    		    }

                Params = "&SQL=Date >=@" + oCmpFromDate + "@ AND Date <= @"+ oCmpToDate +"@";

            } else
                Params = "";


            var read_file_checkbox = document.frm1.readfile.checked;
            if (read_file_checkbox) {
                Params = Params + "&File=1";
            }


            ajaxLoadingPanel.show();
            // Sends a request to the DataSource for more data
            var oUpdateTableCallBack = {
                success :function (oRequest , oResponse , oPayload) {

                				compareGoalBetIntTable.onDataReturnReplaceRows(oRequest,oResponse,oPayload);
                				ajaxLoadingPanel.hide();

            				},
                failure :function (oRequest , oResponse , oPayload) {

                				compareGoalBetIntTable.onDataReturnReplaceRows(oRequest,oResponse,oPayload);
                				ajaxLoadingPanel.hide();

            				},


                scope   :compareGoalBetIntTable
            };


           var sqlquery = "query=coupons&type=select&primaryKey=CouponID&whereID=CompareGoalBet"+Params;
           compareGoalBetIntTable.getDataSource().sendRequest(sqlquery, oUpdateTableCallBack);




        }

        function onReplicateDate(p_oEvent) {

            var oRecord,SetCol;

			var oYear =  YAHOO.util.Dom.get("year").value;
			var oMonth =  YAHOO.util.Dom.get("month").value;
			var oDay =  YAHOO.util.Dom.get("day").value;



		    if (oYear=='') {

		    	YAHOO.example.alert('Παρακαλώ επιλέξτε ημερομηνία');
		    	return;

		    }

			var oDateReplicate =  new Date(oYear + '/' + oMonth + '/' + oDay);

              for(i=0;i<=DataEdit.getRecordSet().getLength()-1;i++){

  				oRecord = DataEdit.getRecordSet().getRecord(i);
                SetCol = DataEdit.getColumn('Date');
                DataEdit.updateCell ( oRecord , SetCol , oDateReplicate);


              }


        }

        function onGetOPAP (p_oEvent) {

              if (DataEdit.getRecordSet().getLength() > 0) {
                    if (!confirm("Υπάρχουν στοιχεία στη λίστα τα οποία θα διαγραφούν. Είστε σίγουρος ;")) {

                      return;

                    }
              }

              ajaxLoadingPanel.show();
              // Sends a request to the DataSource for more data
              var oUpdateTableCallBack = {
                  success :function (oRequest , oResponse , oPayload) {
                               if  (oResponse.meta.couponID != -1) {

                                      if ( confirm ('Το κουπόνι του ΟΠΑΠ με αρ. #'+oResponse.meta.couponID+' αφορά την περίοδο '+oResponse.meta.couponperiod+' και περιλαμβάνει '+oResponse.meta.totalRecords+' αγώνες.'+
                                       '\n\nΘέλετε να το εμφανίσω στη λίστα ;') )
                                       {

                              			  DataEdit.onDataReturnReplaceRows(oRequest,oResponse,oPayload);

                                            if (oResponse.meta.notfoundcount>0)
                                                YAHOO.example.alert('Δεν ανακτήθηκαν οι παρακάτω ['+oResponse.meta.notfoundcount +'] κωδικοί αγώνων ίσως γιατί δεν υπάρχουν ή γιατί τα ονόματα δεν είναι τα ίδια. Με κόκκινο επισημαίνονται οι λέξεις που δεν ταιριάζουν ή δεν βρέθηκαν : <br><br>'
                                                                     +oResponse.meta.notfound+'<br><font size="1">Επιλέξτε το κείμενο και κάντε Ctrl+C/Ctrl+V για αντιγραφή/επικόλληση</font>');

                                      }
                               } else {

                                 YAHOO.example.alert('Ο ΟΠΑΠ δεν έχει δημοσιεύσει το κουπόνι της επόμενης περιόδου.');

                               }

                                ajaxLoadingPanel.hide();

              				},
                  failure :function (oRequest , oResponse , oPayload) {

                  				DataEdit.onDataReturnReplaceRows(oRequest,oResponse,oPayload);
                  				ajaxLoadingPanel.hide();


              				},


                  scope   :DataEdit
              };

             var sqlquery = "query=coupons&type=select&primaryKey=CouponID&whereID=OpapXML";
             DataEdit.getDataSource().sendRequest(sqlquery, oUpdateTableCallBack);


        }

        function onDelAll (p_oEvent) {

            if (confirm("Θέλετε να διαγράψετε όλα τα στοιχεία ;")) {

                 DataEdit.deleteRows ( 0 , DataEdit.getRecordSet().getLength() );

            }

        }




        var οPushButtonSaveRec = new YAHOO.widget.Button("pushbuttonSaveRec");
        οPushButtonSaveRec.on("click", onSaveRec);

        var oPushBbuttonNextCoupon = new YAHOO.widget.Button("pushbuttonNextCoupon");
        oPushBbuttonNextCoupon.on("click", onNextDayMatch);

        var oPushBbuttonPrevCoupon = new YAHOO.widget.Button("pushbuttonPrevCoupon");
        oPushBbuttonPrevCoupon.on("click", onPrevDayMatch);

        var οPushButtonAddLocalRec = new YAHOO.widget.Button("pushbuttonAddLocalRec");
        οPushButtonAddLocalRec.on("click", onAddLocalRec);

        var οPushButtonReplicateDate = new YAHOO.widget.Button("pushbuttonReplicateDate");
        οPushButtonReplicateDate.on("click", onReplicateDate);

        var οPushButtonOPAP = new YAHOO.widget.Button("pushbuttonOPAP");
        οPushButtonOPAP.on("click", onGetOPAP);

        var οPushButtonDelAll = new YAHOO.widget.Button("pushbuttonDelRec");
        οPushButtonDelAll.on("click", onDelAll);



        var οPushButtonCompareGoalBetInt = new YAHOO.widget.Button("pushbuttonCompareGoalBetInt");
        οPushButtonCompareGoalBetInt.on("click", onCompareGoalBetInt);







        var οPushButtonActivateCoupon = new YAHOO.widget.Button(
                        "ActivateCoupon",  // Source element id
                        {
                            label:"Μη Δημοσιευμένο",
                            checked: false // Attribute override

                        }
                    );
        οPushButtonActivateCoupon.on("click", onActivateCoupon);


       YAHOO.example.Inserted = {


            multitypes: [


                      ]

        }


      var countriesString = <?php
          
          
                 function get_pair_values($result_id, $primaryKey)
                  {

                          //************************ Get Values for Drop Down Menus ************************************

                           $first = 0;


                           $column_count = mysql_num_fields($result_id) or die("display_db_query:" . mysql_error());


                            while ($row = mysql_fetch_row($result_id)) {

                                for ($column_num = 0; $column_num < $column_count; $column_num++) {

                                    $field_name = mysql_field_name($result_id, $column_num);



                                    if($first==0){
                                          $field_value .= ($column_num == 0)?"{" :" ";
                                          $first = 1;
                                    }
                                    else {
                                          $field_value .= ($column_num == 0)?",{" :" ";
                                    }


                                    $colum_value = ($row[$column_num]==nil || $row[$column_num]=="") ? "\"" : "\"".$row[$column_num]."\"";

                                   if ($field_name == $primaryKey)
                                        $field_value .= "\"value\":".html_entity_decode($colum_value);
                                    else
                                        $field_value .= "\"label\":".html_entity_decode($colum_value);

                                    $field_value .= (($column_num + 1 ) == $column_count)?" } ":",";

                                }

                             }

                             //create envelop
                             $field_value = "'[".$field_value."]'";
                             return $field_value;



                  }

                 $DB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
                 mysql_select_db(DataBase, $DB) or die(mysql_error());
                 mysql_query("SET NAMES 'utf8'");
                 $result_id = mysql_query("select CountryID, Country from countries order by Country asc");
                 $MYDATASOURCE = get_pair_values($result_id,"CountryID");
                 mysql_close($DB);
                 echo $MYDATASOURCE;
                 

             ?>;



              elDropDowncountries = new YAHOO.widget.DropdownCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.",dropdownOptions:YAHOO.lang.JSON.parse(countriesString),disableBtns:false});
              elDropDowncountries2 = new YAHOO.widget.DropdownCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.",dropdownOptions:YAHOO.lang.JSON.parse(countriesString),disableBtns:false});

              var formatcountries = function(elCell, oRecord, oColumn, oData) {
                    if (isNaN(oData)) {

                      elCell.innerHTML = oData;

                    } else {
      					for (var i=0;i<elDropDowncountries.dropdownOptions.length;i++) {
      						if ( elDropDowncountries.dropdownOptions[i].value == oData ) {
      							elCell.innerHTML = elDropDowncountries.dropdownOptions[i].label;

      							return;
      						}

      					}
                    }
					


		        };
              var formatcountries2 = function(elCell, oRecord, oColumn, oData) {

					for (var i=0;i<elDropDowncountries2.dropdownOptions.length;i++) {
						if ( elDropDowncountries2.dropdownOptions[i].value == oData ) {
							elCell.innerHTML = elDropDowncountries2.dropdownOptions[i].label;

							return;
						}

					}
		        };
		        
   			var chapionshipsString = <?php

                 $DB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
                 mysql_select_db(DataBase, $DB) or die(mysql_error());
                 mysql_query("SET NAMES 'utf8'");
                 $result_id = mysql_query("select ChapionshipID, Chapionship from chapionships order by Chapionship asc");
                 $MYDATASOURCE = get_pair_values($result_id,"ChapionshipID");
                 mysql_close($DB);
                 echo $MYDATASOURCE;

             ?>;

              elDropDownchapionships = new YAHOO.widget.DropdownCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.",dropdownOptions:YAHOO.lang.JSON.parse(chapionshipsString),disableBtns:false});
              elDropDownchapionships2 = new YAHOO.widget.DropdownCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.",dropdownOptions:YAHOO.lang.JSON.parse(chapionshipsString),disableBtns:false});


              var formatchapionships = function(elCell, oRecord, oColumn, oData) {

                    if (isNaN(oData)) {
                      elCell.innerHTML = oData;

                    } else {
    					for (var i=0;i<elDropDownchapionships.dropdownOptions.length;i++) {
    						if ( elDropDownchapionships.dropdownOptions[i].value == oData ) {
    							elCell.innerHTML = elDropDownchapionships.dropdownOptions[i].label;

    							return;
    						}

    					}
                    }
                    


		        };

              var formatchapionships2 = function(elCell, oRecord, oColumn, oData) {

					for (var i=0;i<elDropDownchapionships2.dropdownOptions.length;i++) {
						if ( elDropDownchapionships2.dropdownOptions[i].value == oData ) {
							elCell.innerHTML = elDropDownchapionships2.dropdownOptions[i].label;

							return;
						}

					}



		        };

   			var teamsString = <?php
				
                 $DB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
                 mysql_select_db(DataBase, $DB) or die(mysql_error());
                 mysql_query("SET NAMES 'utf8'");
                 $result_id = mysql_query("select TeamID, Team from teams order by Team asc");
                 $MYDATASOURCE = get_pair_values($result_id,"TeamID");
                 mysql_close($DB);
                 echo $MYDATASOURCE;

             ?>;

              elDropDownteams = new YAHOO.widget.DropdownCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.",dropdownOptions:YAHOO.lang.JSON.parse(teamsString),disableBtns:false});
              elDropDownteams2 = new YAHOO.widget.DropdownCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.",dropdownOptions:YAHOO.lang.JSON.parse(teamsString),disableBtns:false});


              var formatteams = function(elCell, oRecord, oColumn, oData) {
                    if (isNaN(oData)) {
                      elCell.innerHTML = oData;

                    } else {
    					for (var i=0;i<elDropDownteams.dropdownOptions.length;i++) {
    						if ( elDropDownteams.dropdownOptions[i].value == oData ) {
    							elCell.innerHTML = elDropDownteams.dropdownOptions[i].label;

    							return;
    						}

    					}
                    }



		        };

              var formatteams2 = function(elCell, oRecord, oColumn, oData) {

					for (var i=0;i<elDropDownteams2.dropdownOptions.length;i++) {
						if ( elDropDownteams2.dropdownOptions[i].value == oData ) {
							elCell.innerHTML = elDropDownteams2.dropdownOptions[i].label;

							return;
						}

					}



		        };



         // Define a custom formatter for the Column labeled "flag"
            // draws an up icon and adds class "up" to the cell liner to affect
            // a green background color if value of field3 is greater than 100.
            // Otherwise renders a down icon and assigns class "down", setting
            // the background color to red.
            var myEEFormatter = function(elCell, oRecord, oColumn, oData) {
                if(oRecord.getData("EE") == 1) {
                    YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "ee1");
                    elCell.innerHTML = oRecord.getData("EE");
                }
                else if(oRecord.getData("EE") == 2){
                    YAHOO.util.Dom.replaceClass(elCell.parentNode, "","ee2");
                    elCell.innerHTML = oRecord.getData("EE");
                }
                else if(oRecord.getData("EE") == 3){
                    YAHOO.util.Dom.replaceClass(elCell.parentNode, "","ee3");
                    elCell.innerHTML = oRecord.getData("EE");
                }
                else if(oRecord.getData("EE") == 4){
                    YAHOO.util.Dom.replaceClass(elCell.parentNode, "","ee4");
                    elCell.innerHTML = oRecord.getData("EE");
                }
                else if(oRecord.getData("EE") == 5){
                    YAHOO.util.Dom.replaceClass(elCell.parentNode, "","ee5");
                    elCell.innerHTML = oRecord.getData("EE");
                }
            };

            var myTimeFormatter = function(elCell, oRecord, oColumn, oData) {

                    if  (oRecord.getData("id_s")=='EMPTY')
                        return;

                    YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "time");
                    var timerec=oRecord.getData("Time");
                    //check if time keeps the seconds. We dont need them so, make them dissappear.
                    if (timerec.length > 5) {


                         timerec=timerec.substring(0, 5);


                    }
                    elCell.innerHTML = timerec;

            };

           var AAformatNumber = function(elCell, oRecord, oColumn, oData) {

               var formatted_value = YAHOO.util.Number.format(oData, {decimalPlaces:0} );
               elCell.innerHTML = formatted_value;

           }


           var CustomformatNumber = function(elCell, oRecord, oColumn, oData) {

                    // dont print any value if the id_s has the value EMPTY
                    if  (oRecord.getData("id_s")=='EMPTY')
                        return;

                    if ( (oColumn.field == "Goal_1") || (oColumn.field == "Goal_x") || (oColumn.field == "Goal_2")  ) {

                        if (oData < 0) {
                           YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "neg_goal");
                           oData = Math.abs(oData);
                           if (oData==0.01)
                                oData=0.00;
                        }else
                            YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "goal");

                        var value = oData;

                        var formatted_value = YAHOO.util.Number.format(value, {decimalPlaces:2} );
                        elCell.innerHTML = formatted_value;

                    } else if ( (oColumn.field == "Under") || (oColumn.field == "Over") || (oColumn.field == "GG") ||
                                (oColumn.field == "NG") || (oColumn.field == "HMI_1") || (oColumn.field == "HMI_X") ||
                                (oColumn.field == "HMI_2") || (oColumn.field == "TG_01") || (oColumn.field == "TG_23") ||
                                (oColumn.field == "TG_46") ||  (oColumn.field == "TG_7")  ){

                        if (oData < 0) {
                           YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "neg_goal2");
                           oData = Math.abs(oData);
                           if (oData==0.01)
                                oData=0.00;
                        }else
                            YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "goal2");


                        var value = oData

                        var formatted_value = YAHOO.util.Number.format(value, {decimalPlaces:2} );
                        elCell.innerHTML = formatted_value;

                    } else if  ( (oColumn.field == "de_1ORX") || (oColumn.field == "de_XOR2") || (oColumn.field == "de_1OR2")  ) {

                        if (oData < 0) {
                           YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "neg_goal3");
                           oData = Math.abs(oData);
                           if (oData==0.01)
                                oData=0.00;
                        }


                        var value = oData

                        var formatted_value = YAHOO.util.Number.format(value, {decimalPlaces:2} );
                        elCell.innerHTML = formatted_value;

                    }


           };


         YAHOO.util.Event.addListener(window, "load", function() {
         YAHOO.example.CouponView =  function() {
         var Dom = YAHOO.util.Dom;




            // Add the custom formatter to the shortcuts
            YAHOO.widget.DataTable.Formatter.myCustomEE = myEEFormatter;
            YAHOO.widget.DataTable.Formatter.myCustomTime = myTimeFormatter;




            var myColumnDefs = [
                {key:"CouponID", label:"ΚΩΔ. ΚΟΥΠΟΝΙΟΥ", formatter:YAHOO.widget.DataTable.formatNumber, hidden:true, isPrimaryKey:true},
                {key:"Published", label:"ΔΗΜ/ΝΟ",width:60,  formatter:YAHOO.widget.DataTable.formatCheckbox, sortable:false},
				{key:"CountryID", label:"ΧΩΡΑ", width:70, formatter:formatcountries, editor:elDropDowncountries, sortable:true},
				{key:"ChapionshipID", label:"ΠΡΩΤΑΘΛHMA", width:130, formatter:formatchapionships, editor : elDropDownchapionships,  sortable:true},
                {key:"Time", label:"ΩΡΑ", width:30,  editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:myTimeFormatter,sortable:true},
                {key:"Code", label:"ΚΩΔ", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:"string", width:20,sortable:true},
                {key:"EE", label:"ΕΕ", editor: new YAHOO.widget.DropdownCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", dropdownOptions:["1","2","3","4","5"],disableBtns:false}), formatter:myEEFormatter,sortable:true},
                {key:"Goal_1", label:"1", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber,sortable:true },
                {key:"HomeTeamID", label:"ΓΗΠΕΔΟΥΧΟΣ", width:150, formatter:formatteams, editor : elDropDownteams,sortable:true},
                {key:"Goal_x", label:"X", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber,sortable:true},
                {key:"HostTeamID", label:"ΦΙΛΟΞΕΝΟΥΜΕΝΗ", width:150, formatter:formatteams, editor : elDropDownteams,sortable:true},
                {key:"Goal_2", label:"2", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber ,sortable:true},
                {label:"ΕΙΔΙΚΑ ΣΤΟΙΧΗΜΑΤΑ",
	                    children: [
                            {key:"Under", label:"Under", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber,sortable:true,width:30},
                            {key:"Over", label:"Over", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber,sortable:true,width:30},
                            {key:"GG", label:"GG", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber,sortable:true,width:25},
                            {key:"NG", label:"NG", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber,sortable:true,width:25}
                        ]
                },
                {label:"ΔΙΠΛΗ ΕΥΚΑΙΡΙΑ",
	                    children: [
                            {key:"de_1ORX", label:"1ήΧ", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber,sortable:true},
                            {key:"de_XOR2", label:"Xή2", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber,sortable:true},
                            {key:"de_1OR2", label:"1ή2", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber,sortable:true}
                        ]
                },
                {label:"1ο ΗΜΙΧΡΟΝΟ",
	                    children: [
                            {key:"HMI_1", label:"HMI 1-1", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber},
                            {key:"HMI_X", label:"HMI 1-X", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber},
                            {key:"HMI_2", label:"HMI 1-2", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber}
                        ]
                },
                {label:"ΗΜΙΧΡΟΝΟ-ΤΕΛΙΚΟ",
	                    children: [
                            {key:"HT_11", label:"HT 1-1", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"HT_1X", label:"HT 1-X", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"HT_12", label:"HT 1-2", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"HT_X1", label:"HT X-1", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"HT_XX", label:"HT X-X", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"HT_X2", label:"HT X-2", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"HT_21", label:"HT 2-1", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"HT_2X", label:"HT 2-X", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"HT_22", label:"HT 2-2", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber}
                        ]
                },
                /*
                {label:"Σωστό Σκορ",
	                    children: [
                            {key:"SS_10", label:"ΣΣ 1-0", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_20", label:"ΣΣ 2-0", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_21", label:"ΣΣ 2-1", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_30", label:"ΣΣ 3-0", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_31", label:"ΣΣ 3-1", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_32", label:"ΣΣ 3-2", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_40", label:"ΣΣ 4-0", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_41", label:"ΣΣ 4-1", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_42", label:"ΣΣ 4-2", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_43", label:"ΣΣ 4-3", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_00", label:"ΣΣ 0-0", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_11", label:"ΣΣ 1-1", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_22", label:"ΣΣ 2-2", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_33", label:"ΣΣ 3-3", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_01", label:"ΣΣ 0-1", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_02", label:"ΣΣ 0-2", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_12", label:"ΣΣ 1-2", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_03", label:"ΣΣ 0-3", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_13", label:"ΣΣ 1-3", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_23", label:"ΣΣ 2-3", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_04", label:"ΣΣ 0-4", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_14", label:"ΣΣ 1-4", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_24", label:"ΣΣ 2-4", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_34", label:"ΣΣ 3-4", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber}
                        ]
                },
                */
                {label:"ΣΥΝΟΛΟ ΤΕΡΜΑΤΩΝ ",
	                    children: [
                            {key:"TG_01", label:"TG 0-1", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber},
                            {key:"TG_23", label:"TG 2-3", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber},
                            {key:"TG_46", label:"TG 4-6", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber},
                            {key:"TG_7", label:"TG 7+", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber}
                        ]
                },

                {key:"Canceled",label:"ΜΟΝΑΔΑ",hidden:true},
                {key:"Showed", label:"ΠΡΟΒΟΛΗ",width:60,  formatter:YAHOO.widget.DataTable.formatCheckbox, sortable:false},
                {key:'del', label:'', className: 'delete-button', action:'delete', width:15}
            ];


            var myDataSource = new YAHOO.util.DataSource("../includes/dataproxy.php?");
            myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSON;
            myDataSource.connXhrMode = "queueRequests";


			var oYearShow =  YAHOO.util.Dom.get("toyear").value;
			var oMonthShow =  YAHOO.util.Dom.get("tomonth").value;
			var oDayShow =  YAHOO.util.Dom.get("today").value;
			oDateShow =  oYearShow + '-' + oMonthShow + '-' + oDayShow;


            myDataSource.responseSchema = {
                resultsList: "DataSet.items",
                // Use the parse methods to populate the RecordSet with the right data types
               fields: [
                    {key:"CouponID", parser:"number"},
					{key:"CountryID", parser:"number"},
					{key:"ChapionshipID", parser:"number"},
                    {key:"Time", parser:"string"},
                    {key:"Code", parser:"number"},
                    {key:"EE", parser:"number"},
                    {key:"Goal_1", parser:"number"},
                    {key:"HomeTeamID", parser:"string"},
                    {key:"Goal_x", parser:"number"},
                    {key:"HostTeamID", parser:"string"},
                    {key:"Goal_2", parser:"number"},
                    {key:"de_1ORX",parser:"number"},
                    {key:"de_XOR2",parser:"number"},
                    {key:"de_1OR2",parser:"number"},
                    {key:"Under",parser:"number"},
                    {key:"Over",parser:"number"},
                    {key:"GG",parser:"number"},
                    {key:"NG",parser:"number"},
                    {key:"HMI_1", parser:"number"},
                    {key:"HMI_X", parser:"number"},
                    {key:"HMI_2", parser:"number"},
                    {key:"HT_11", parser:"number"},
                    {key:"HT_1X", parser:"number"},
                    {key:"HT_12", parser:"number"},
                    {key:"HT_X1", parser:"number"},
                    {key:"HT_XX", parser:"number"},
                    {key:"HT_X2", parser:"number"},
                    {key:"HT_21", parser:"number"},
                    {key:"HT_2X", parser:"number"},
                    {key:"HT_22", parser:"number"},
                    {key:"SS_10", parser:"number"},
                    {key:"SS_20", parser:"number"},
                    {key:"SS_21", parser:"number"},
                    {key:"SS_30", parser:"number"},
                    {key:"SS_31", parser:"number"},
                    {key:"SS_32", parser:"number"},
                    {key:"SS_40", parser:"number"},
                    {key:"SS_41", parser:"number"},
                    {key:"SS_42", parser:"number"},
                    {key:"SS_43", parser:"number"},
                    {key:"SS_00", parser:"number"},
                    {key:"SS_11", parser:"number"},
                    {key:"SS_22", parser:"number"},
                    {key:"SS_33", parser:"number"},
                    {key:"SS_01", parser:"number"},
                    {key:"SS_02", parser:"number"},
                    {key:"SS_12", parser:"number"},
                    {key:"SS_03", parser:"number"},
                    {key:"SS_13", parser:"number"},
                    {key:"SS_23", parser:"number"},
                    {key:"SS_04", parser:"number"},
                    {key:"SS_14", parser:"number"},
                    {key:"SS_24", parser:"number"},
                    {key:"SS_34", parser:"number"},
                    {key:"TG_01", parser:"number"},
                    {key:"TG_23", parser:"number"},
                    {key:"TG_46", parser:"number"},
                    {key:"TG_7", parser:"number"},
                    {key:"Published",parser:"number"},
                    {key:"Canceled",parser:"number"},
                    {key:"Showed", parser:"number"},
                    {key:"del"}
                ],
                metaFields: {totalRecords: "DataSet.totalRecords"} // Access server-provided dynamic value

            };





            var oConfigs = {

                    dateOptions:{format:"%d/%m/%Y"},
                    selectionMode:"single",
                    numberOptions:{decimalPlaces:2, thousandsSeparator:","},
                    MSG_EMPTY:"Δεν υπάρχουν εγγραφές",
                    draggableColumns:false,
                    initialRequest:"query=coupons&type=select&primaryKey=CouponID&whereID=" + oDateShow
	        };

            AddDataTable = new YAHOO.widget.DataTable("paginated", myColumnDefs, myDataSource,oConfigs  );
            var i=1,bReverseSorted = false;

            // Track when Column is reverse-sorted, since new data will come in out of order
            var trackReverseSorts = function(oArg) {
                bReverseSorted = (oArg.dir === YAHOO.widget.DataTable.CLASS_DESC);
            };






            // Set up editing flow
	        var highlightEditableCell = function(oArgs) {
	            var elCell = oArgs.target;
	            if(YAHOO.util.Dom.hasClass(elCell, "yui-dt-editable")) {
	                this.highlightCell(elCell);
	            }
	        };


           /*
            AddDataTable.subscribe("dataReturnEvent", function(oArgs, oEl) {
                    var nRecords = oArgs.response.results.length;
                    var results = oArgs.response.results;



            });

            */
            myDataSource.subscribe("responseParseEvent",function(oArgs) {


                    if (oArgs.response.results.length == 0) {
                        οPushButtonActivateCoupon.set("label", "Μη Δημοσιευμένο");
                        οPushButtonActivateCoupon.set("checked", false);
                        Published=0;

                        return;
                    }

                    Published = oArgs.response.results[0].Published;


                    if ( (Published == 1)   )  {

                        οPushButtonActivateCoupon.set("label", "Δημοσιευμένο");
                        οPushButtonActivateCoupon.set("checked", true);
                    }
                    else {

                        οPushButtonActivateCoupon.set("label", "Μη Δημοσιευμένο");
                        οPushButtonActivateCoupon.set("checked", false);

                    }


            });

            AddDataTable.subscribe("cellMouseoverEvent", highlightEditableCell);
	        AddDataTable.subscribe("cellMouseoutEvent", AddDataTable.onEventUnhighlightCell);
            AddDataTable.subscribe("cellClickEvent", AddDataTable.onEventShowCellEditor);

            var myBuildUrl = function(datatable,record) {
                var url = '';
                var cols = datatable.getColumnSet().keys;
                for (var i = 0; i < cols.length; i++) {
                    if (cols[i].isPrimaryKey) {
                        url += '&id=' + escape(record.getData(cols[i].key));
                        url += '&primaryKey=' + cols[i].key;
                    }
                }

                return url;
            };

           AddDataTable.doBeforeShowCellEditor = function(oCellEditor) {


                var oEditor1 = elDropDowncountries;
                var oEditor2 = elDropDownchapionships;
                var oEditor3 = elDropDownteams;
                var oEditor = oCellEditor;
		        var oRecord = oEditor.getRecord();
           		var oColumn1 = this.getColumn('CountryID');
				var oColumn2 = this.getColumn('ChapionshipID');
                var valueCountry = oRecord.getData(oColumn1.key);
				var valueChapionship = oRecord.getData(oColumn2.key);
				var processID;






                //take the value of the CountryID and fill the drop down menu with appropriate chapionship values that
                //corresponds to that country
                if (oEditor == oEditor2) {

							if (valueCountry == '') {
								 YAHOO.example.alert('Συμπληρώστε πρώτα τη στήλη <b>"Χώρα"</b> μετά τη στήλη <b>"Πρωτάθλημα"</b> και τέλος τις στήλες <b>"Γηπεδούχος"</b> και <b>"Φιλοξενούμενη"</b>.');

								 return false;

							}
                             ajaxLoadingPanel.show();
                            processID = YAHOO.util.Connect.asyncRequest('GET', '../includes/dataproxy.php?query=chapionships&primaryKey=ChapionshipID&type=select&output=dropdown&whereID=' + valueCountry, {
                                         success: function(o) {

                                                try {

                                                    var r = YAHOO.lang.JSON.parse(o.responseText);
                                                }
                                                catch (x) {

                                                    alert("JSON Parse failed!");
                                                    return;
                                                }
                                                 //debug
                                                //alert(YAHOO.lang.dump(r));

                                                oEditor.dropdownOptions = r.DataSet.items;
                                                oEditor.setOptions();
                                                ajaxLoadingPanel.hide();


                                        },
                                        failure: function(o) {
                                               alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή σας δεν αποθηκεύτηκε.');
                                        },
                                        scope: this
                                }  );




                }

 				if (oEditor == oEditor3) {

							if (valueChapionship == '') {
								 YAHOO.example.alert('Συμπληρώστε πρώτα τη στήλη <b>"Χώρα"</b> μετά τη στήλη <b>"Πρωτάθλημα"</b> και τέλος τις στήλες <b>"Γηπεδούχος"</b> και <b>"Φιλοξενούμενη"</b>.');

								 return false;

							}
							ajaxLoadingPanel.show();
                            processID = YAHOO.util.Connect.asyncRequest('GET', '../includes/dataproxy.php?query=teams&primaryKey=TeamID&type=select&output=dropdown&whereID=' + valueChapionship, {
                                         success: function(o) {

                                                try {

                                                    var r = YAHOO.lang.JSON.parse(o.responseText);
                                                }
                                                catch (x) {

                                                    alert("JSON Parse failed!");
                                                    return;
                                                }
                                                 //debug
                                                //alert(YAHOO.lang.dump(r));

                                                oEditor.dropdownOptions = r.DataSet.items;
                                                oEditor.setOptions();
                                                 ajaxLoadingPanel.hide();

                                        },
                                        failure: function(o) {
                                               alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή σας δεν αποθηκεύτηκε.');
                                        },
                                        scope: this
                                }  );


				}

                //dont let show countries that dont have chapionships.
                if (oEditor == oEditor1) {



                            ajaxLoadingPanel.show();
                            processID = YAHOO.util.Connect.asyncRequest('GET', '../includes/dataproxy.php?query=countries&primaryKey=CountryID&type=select&output=dropdown', {
                                         success: function(o) {

                                                try {

                                                    var r = YAHOO.lang.JSON.parse(o.responseText);
                                                }
                                                catch (x) {
                                                    alert("JSON Parse failed!");
                                                    return;
                                                }
                                                 //debug
                                                //alert("Inside=" + YAHOO.lang.dump(r));
                                                oEditor.dropdownOptions = r.DataSet.items;
                                                oEditor.setOptions();
                                               ajaxLoadingPanel.hide();

                                        },
                                        failure: function(o) {
                                               alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή σας δεν αποθηκεύτηκε.');
                                        },
                                        scope: this
                                }  );

                }


                return true;
            };


            AddDataTable.doBeforeSortColumn = function(oColumn , sSortDir) {


                elDropDownteams.dropdownOptions = YAHOO.lang.JSON.parse(teamsString);
                elDropDownteams.setOptions();
                elDropDownteams2.dropdownOptions = YAHOO.lang.JSON.parse(teamsString);
                elDropDownteams2.setOptions();


                elDropDownchapionships.dropdownOptions = YAHOO.lang.JSON.parse(chapionshipsString);
                elDropDownchapionships.setOptions();
                elDropDownchapionships2.dropdownOptions = YAHOO.lang.JSON.parse(chapionshipsString);
                elDropDownchapionships2.setOptions();


                elDropDowncountries.dropdownOptions = YAHOO.lang.JSON.parse(countriesString);
                elDropDowncountries.setOptions();
                elDropDowncountries2.dropdownOptions = YAHOO.lang.JSON.parse(countriesString);
                elDropDowncountries2.setOptions();

                return true;

            };


			AddDataTable.subscribe('cellClickEvent',function(oArgs) {


                var target = oArgs.target;

                column = this.getColumn(target);
                record = this.getRecord(target);



                switch (column.action) {

                 case 'delete' :

                            if (confirm('Είσαι σίγουρος για τη διαγραφή ;')) {

                                var record = this.getRecord(target);

                                 YAHOO.util.Connect.asyncRequest('GET','../includes/dataproxy.php?query=coupons&type=delete' + myBuildUrl(this,record),
                                    {

                                        success: function (o) {
                                                this.deleteRow(target);
                                        },
                                        failure: function (o) {
                                                alert('Κάποιο σφάλμα δημιουργήθηκε');
                                        },
                                        scope:AddDataTable
                                    }

                                );


                            }

                            break;
                    case 'insert':

                            break;
                    default:AddDataTable.onEventShowCellEditor(oArgs);
                            break;
                }

            })

           AddDataTable.subscribe('checkboxClickEvent', function(oArgs){

				    var elCheckbox = oArgs.target;
					var newValue = elCheckbox.checked;
				    var oRecord = this.getRecord(elCheckbox);
					var column = this.getColumn(elCheckbox);
					var oldValue = oRecord.getData(column.key);



                      //convert to int
                      newValue = newValue - 0;

                      switch (column.key) {

                        case 'Showed' :



                              YAHOO.util.Connect.asyncRequest('GET', '../includes/dataproxy.php?query=coupons&type=update&column=Showed&newvalue=' + newValue +  myBuildUrl(AddDataTable,oRecord), {

                                                  success: function(o) {


                                                  },
                                                  failure: function(o) {
                                                        alert('Παρουσιάστηκε κάποιο σφάλμα.' +
                                                        'Επικοινωνήστε με την κατασκευάστρια εταιρία.');


                                               }
                               });

                            break;
                    case 'Published':
                              YAHOO.util.Connect.asyncRequest('GET', '../includes/dataproxy.php?query=coupons&type=update&column=Published&newvalue=' + newValue +  myBuildUrl(AddDataTable,oRecord), {

                                                  success: function(o) {


                                                  },
                                                  failure: function(o) {
                                                        alert('Παρουσιάστηκε κάποιο σφάλμα.' +
                                                        'Επικοινωνήστε με την κατασκευάστρια εταιρία.');


                                               }
                               });

                            break;



                  }

				});




           AddDataTable.subscribe("editorSaveEvent", function(oArgs){

				var MAX_VALUE_ALERT = 15;
                var oEditor = oArgs.editor;
                var newData;
                var oldData = oArgs.oldData;
    			var elCell = oEditor.cell;
		        var oRecord = oEditor.getRecord();
           		var oColumn = oEditor.getColumn();
                var value = oRecord.getData(oColumn.key);
                var oTeamCol,query;
                var msg;


                if  (oColumn.key == "Time") {
                     newData = oArgs.newData;
                } else {
                     newData = trimNumber(oArgs.newData);
                }

                msg="";
                this.updateCell ( oRecord , oColumn , newData );
                AddDataTable.set("sortedBy", null);

                if (oColumn.key == "Time") {


                 // regular expression to match required time format
                    re = /^(\d{1,2}):(\d{2})([ap]m)?$/;

                    if(newData != '') {
                      if(regs = newData.match(re)) {
                        if(regs[3]) {
                          if(regs[1] < 1 || regs[1] > 12) {
                            	this.updateCell ( oRecord , oColumn , oldData );
                                return;
                          }
                        } else {
                          if(regs[1] > 23) {
                            	this.updateCell ( oRecord , oColumn , oldData );
                                return;
                          }
                        }
                        if(regs[2] > 59) {
                        	this.updateCell ( oRecord , oColumn , oldData );
                            return;
                        }
                      } else {
                        	this.updateCell ( oRecord , oColumn , oldData );
                            return;
                      }
                    }

                }








				//no characters allowed to the following fields
		        if (  (oColumn.key == "de_1ORX")  || (oColumn.key == "de_XOR2")  || (oColumn.key == "de_1OR2") ||
					  (oColumn.key == "Under")  || (oColumn.key == "Over")  || (oColumn.key == "GG") ||
					  (oColumn.key == "NG")  || (oColumn.key == "Code")  ) {


						if ( isNaN(newData) ) {
							this.updateCell ( oRecord , oColumn , oldData );
                            return;
                        }

     					if (newData==''){
                        	this.updateCell ( oRecord , oColumn , oldData );
                            return;
                        }


						//Max_Value_Alert does not affect Code field
						var FloatValue = parseFloat(newData);
						if ( ( FloatValue > MAX_VALUE_ALERT ) && (oColumn.key != "Code") )
							msg = 'Προσοχή ! Η τιμή που δώσατε στη στήλη <b>' + oColumn.label + '</b> είναι πολύ μεγάλη.<br><br>';





	        	}



				//the first time the Olddata=0, so check these fields outside the  if(oldData != newData)
				if (  (oColumn.key == "Goal_1")  || (oColumn.key == "Goal_2")  || (oColumn.key == "Goal_x")) {

     					if (newData==''){
                        	this.updateCell ( oRecord , oColumn , oldData);
                            return;
                        }

				}



                if(oldData != newData)
                {



					//check if HostTeamID == HomeTeamID
					if (  (oColumn.key == "HostTeamID")  || (oColumn.key == "HomeTeamID") ) {

						if (oColumn.key == "HostTeamID")
							oTeamCol = this.getColumn('HomeTeamID');
						else
							oTeamCol = this.getColumn('HostTeamID');


						if ( (oRecord.getData(oTeamCol.key)) == newData ){
							msg = 'Προσοχή ! Οι στήλες <b>Γηπεδούχος</b> και <b>Φιλοξενούμενη</b> έχουν τις ίδιες ομάδες.<br><br>';

						}


					}




					//set all other values
					if (  (oColumn.key == "Goal_1")  || (oColumn.key == "Goal_2")  || (oColumn.key == "Goal_x")) {


						if ( isNaN(newData) ) {

								this.updateCell ( oRecord , oColumn , oldData );
                                return;

						}

						if ( isNaN(newData) ) {

								this.updateCell ( oRecord , oColumn , oldData );
                                return;

						}


						var FloatValue = parseFloat(newData);
						if ( FloatValue > MAX_VALUE_ALERT )
							msg = 'Προσοχή ! Η τιμή που δώσατε στη στήλη <b>' + oColumn.label + '</b> είναι πολύ μεγάλη.<br><br>';



						if ( (oColumn.key == "Goal_1") && ( ( (oRecord.getData(this.getColumn('Goal_2').key)) == 0) || ( (oRecord.getData(this.getColumn('Goal_x').key)) == 0) ) )
							return;

						if ( (oColumn.key == "Goal_2") && ( ( (oRecord.getData(this.getColumn('Goal_1').key)) == 0) || ( (oRecord.getData(this.getColumn('Goal_x').key)) == 0) ) )
							return;

						if ( (oColumn.key == "Goal_x") && ( ( (oRecord.getData(this.getColumn('Goal_2').key)) == 0) || ( (oRecord.getData(this.getColumn('Goal_1').key)) == 0) ) )
							return;


                        var compute;
                        var SetCol = this.getColumn('de_1ORX');
                        compute = ( eval(oRecord.getData(this.getColumn('Goal_1').key))*eval(oRecord.getData(this.getColumn('Goal_x').key)) ) / ( eval(oRecord.getData(this.getColumn('Goal_1').key))+eval(oRecord.getData(this.getColumn('Goal_x').key)) );

                        if (compute <= 1)
                            compute = 1.05;
                        var de_1=compute;
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2));

                        SetCol = this.getColumn('de_XOR2');
                        compute = ( eval(oRecord.getData(this.getColumn('Goal_x').key))*eval(oRecord.getData(this.getColumn('Goal_2').key)) ) / ( eval(oRecord.getData(this.getColumn('Goal_x').key))+eval(oRecord.getData(this.getColumn('Goal_2').key)) );

                        if (compute <= 1)
                            compute = 1.05;
                        var de_2=compute;
                        this.updateCell ( oRecord , SetCol ,compute.toFixed(2) );

                        SetCol = this.getColumn('de_1OR2');
                        compute = ( eval(oRecord.getData(this.getColumn('Goal_1').key))*eval(oRecord.getData(this.getColumn('Goal_2').key)) ) / ( eval(oRecord.getData(this.getColumn('Goal_1').key))+eval(oRecord.getData(this.getColumn('Goal_2').key)) );
                        var de_3=compute;
                        if (compute <= 1)
                            compute = 1.05;
                        var de_3=compute;
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );



                        var G1_odd=eval(oRecord.getData(this.getColumn('Goal_1').key));
                        compute=-0.0049*(G1_odd*G1_odd*G1_odd*G1_odd)+0.1075*(G1_odd*G1_odd*G1_odd)-0.8415*(G1_odd*G1_odd)+3.3316*G1_odd-1.5819;
                        if (compute < 0)
                            compute = 0;
                        var HMI_1=compute;
                        SetCol = this.getColumn('HMI_1');
                        //this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        var Gx_odd=eval(oRecord.getData(this.getColumn('Goal_x').key));
                        compute = -0.013*(Gx_odd*Gx_odd)+0.5081*Gx_odd+0.3954;
                        if (compute < 0)
                            compute = 0;
                        var HMI_X=compute;
                        SetCol = this.getColumn('HMI_X');
                        //this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        var G2_odd=eval(oRecord.getData(this.getColumn('Goal_2').key));
                        compute = 0.0035*(G2_odd*G2_odd*G2_odd)-0.0834*(G2_odd*G2_odd)+1.3085*G2_odd+0.09;
                        if (compute < 0)
                            compute = 0;
                        var HMI_2=compute;
                        SetCol = this.getColumn('HMI_2');
                        //this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        ajaxLoadingPanel.show();
                        //query = '../includes/dataproxy.php?query=coupons&type=update&column=edit_de&de_1ORX='+de_1+'&de_XOR2='+de_2+'&de_1OR2='+de_3+'&HMI_1='+HMI_1+'&HMI_X='+HMI_X+'&HMI_2='+HMI_2;
                        query = '../includes/dataproxy.php?query=coupons&type=update&column=edit_de&de_1ORX='+de_1+'&de_XOR2='+de_2+'&de_1OR2='+de_3;
                        YAHOO.util.Connect.asyncRequest('GET', query + myBuildUrl(this,oRecord), {
                                   success: function(o) {

                                                ajaxLoadingPanel.hide();

                                   },
                                  failure: function(o) {
                                         alert('Παρουσιάστηκε κάποιο σφάλμα. Οι αλλαγές δεν αποθηκεύτηκαν.');
                                         ajaxLoadingPanel.hide();
                                  },
                                  scope: this
                     }  );

                    }



                    if ( (oColumn.key == "CountryID") || (oColumn.key == "ChapionshipID") || (oColumn.key == "CouponID") ||
                         (oColumn.key == "Code") || (oColumn.key == "EE") || (oColumn.key == "Goal_1") ||
                          (oColumn.key == "HomeTeamID") || (oColumn.key == "Goal_x") || (oColumn.key == "HostTeamID") ||
                          (oColumn.key == "Goal_2") || (oColumn.key == "de_1ORX") || (oColumn.key == "de_XOR2") ||
                          (oColumn.key == "de_1OR2") || (oColumn.key == "Under") || (oColumn.key == "Over") ||
                          (oColumn.key == "GG") || (oColumn.key == "NG") )
                          qnewval =   "&newvalue=" + value;
                    else
                          qnewval =   "&newvalue=@" + value;



                    if ( (oColumn.key == "CountryID") || (oColumn.key == "ChapionshipID") )
                          query = '../includes/dataproxy.php?query=coupons&type=update&cascade=yes&column=';
                    else
                          query = '../includes/dataproxy.php?query=coupons&type=update&column='


                    YAHOO.util.Connect.asyncRequest('GET', query + oColumn.key + qnewval + myBuildUrl(this,oRecord), {
                                   success: function(o) {

                                                try {

                                                    var r = YAHOO.lang.JSON.parse(o.responseText);
                                                }
                                                catch (x) {

                                                    alert("JSON Parse failed!");
                                                    return;
                                                }
                                                 //debug
                                                //alert(YAHOO.lang.dump(r));

                                                if (oColumn.key == "CountryID") {


                                                                          elDropDownchapionships.dropdownOptions = r.DataSet.chapionships;
                                                                          elDropDownchapionships.setOptions();

                                                                          var SetCol = this.getColumn('ChapionshipID');
                                                                          this.updateCell ( oRecord , SetCol , r.DataSet.chapionships[0].value );



                                                                          elDropDownteams.dropdownOptions = r.DataSet.teams;
                                                                          elDropDownteams.setOptions();

                                                                          var SetCol = this.getColumn('HomeTeamID');
                                                                          this.updateCell ( oRecord , SetCol , r.DataSet.teams[0].value );

                                                                          var SetCol = this.getColumn('HostTeamID');
                                                                          this.updateCell ( oRecord , SetCol , r.DataSet.teams[0].value );


                                                                          YAHOO.example.alert( msg + 'Οι αλλαγές αποθηκεύτηκαν.<br><br>Προσοχή, άλλαξαν αυτόματα οι στήλες <b>Πρωταθλήματος</b>,<b>Γηπεδούχος</b> και <b>Φιλοξενούμενη</b> για να υπάρχει συνέπεια στις εγγραφές.</b>.'+
                                                                          '<br><br>Επιπλέον οι ομάδες είναι οι ίδιες και θα πρέπει να αλλαχτούν.');

                                                                          return;



                                                }

                                               if (oColumn.key == "ChapionshipID") {




                                                                          elDropDownteams.dropdownOptions = r.DataSet.teams;
                                                                          elDropDownteams.setOptions();

                                                                          var SetCol = this.getColumn('HomeTeamID');
                                                                          this.updateCell ( oRecord , SetCol , r.DataSet.teams[0].value );

                                                                          var SetCol = this.getColumn('HostTeamID');
                                                                          this.updateCell ( oRecord , SetCol , r.DataSet.teams[0].value );


                                                                          YAHOO.example.alert( msg + 'Οι αλλαγές αποθηκεύτηκαν.<br><br>Προσοχή, άλλαξαν αυτόματα οι στήλες <b>Γηπεδούχος</b> και <b>Φιλοξενούμενη</b> για να υπάρχει συνέπεια στις εγγραφές.</b>.'+
                                                                          '<br><br>Επιπλέον οι ομάδες είναι οι ίδιες και θα πρέπει να αλλαχτούν.');

                                                                          return;

                                                }



                                                if (msg != '')
                                                    YAHOO.example.alert( msg );




                                  },
                                  failure: function(o) {
                                         alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή σας δεν αποθηκεύτηκε.');
                                  },
                                  scope: this
                     }  );






                }





             });





	        myTabView.getTab(1).addListener("click", function() {AddDataTable.onShow()})


             return {
                oDS: myDataSource,
                oDT: AddDataTable,
                oTV: myTabView
            };


        }();

});



/******************************************************************************/
/***************** Create new coupon *****************************************/



         YAHOO.util.Event.addListener(window, "load", function() {
         YAHOO.example.EditCoupon =  function() {
         var Dom = YAHOO.util.Dom;










            // Add the custom formatter to the shortcuts
            YAHOO.widget.DataTable.Formatter.myCustomEE = myEEFormatter;
            YAHOO.widget.DataTable.Formatter.myCustomTime = myTimeFormatter;



            var oCalConfigs = {



                    MONTHS_LONG: ["Ιανουάριος", "Φεβρουάριος", "Μάριος", "Απρίλιος", "Μάϊος", "Ιούνιος", "Ιούλιος", "Αύγουστος", "Σεπτέμβριος", "Οκτώβριος", "Νοέμβριος", "Δεκέμβριος"],
                  	DATE_FIELD_DELIMITER: "/",
                    WEEKDAYS_MEDIUM: ["Κυρ", "Δευ", "Τρι", "Τετ", "Πεμ", "Παρ", "Σαβ"],
                    WEEKDAYS_SHORT: ["Κυ", "Δε", "Τρ", "Τε", "Πε", "Πα", "Σα"],
                    MONTHS_SHORT: ["Ιαν", "Φεβ", "Μαρτ", "Απρ", "Μαι", "Ιουν", "Ιου", "Αυγ", "Σεπ", "Οκτ", "Νοε", "Δεκ"],
                    WEEKDAYS_LONG: ["Κυριακή", "Δευτέρα", "Τρίτη", "Τετάρτη", "Πέμπτη", "Παρασκευή", "Σάββατο"],
                    WEEKDAYS_1CHAR: ["Κ", "Δ", "Τ", "Τ", "Π", "Π", "Σ"]



	        };


             /*
            TableCalendar = function() {

                var oCalendarTbl = new YAHOO.widget.DateCellEditor({calendarOptions:oCalConfigs, LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:true});

                return oCalendarTbl;
            }

            YAHOO.util.DataSource.parseDate = function(oData){

                if(!(oData instanceof Date)){
                    var date = new Date(oData);
                    if(date == 'Invalid Date'){date = new Date('1/11/1900');}
                    return date;
                } else {return oData;}
            }

            myFormatDate = function(elCell, oRecord, oColumn, oData) {

                    var d = new Date('1/11/1900');

                    if (oData > d) {

                        YAHOO.widget.DataTable.formatDate(elCell, oRecord, oColumn, oData);
                    } else {
                        elCell.innerHTML = '';
                    }
            };
            */
            var myColumnDefs = [
                {key:"AA", label:"A/A", formatter:AAformatNumber},
                {key:"Date", label:"ΗΜΕΡ.", formatter:YAHOO.widget.DataTable.formatDate, editor:new YAHOO.widget.DateCellEditor({calendarOptions:oCalConfigs,LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), width:60},
                {key:"CountryID", label:"ΧΩΡΑ", formatter:formatcountries2, editor:elDropDowncountries2, width:70},
				{key:"ChapionshipID", label:"ΠΡΩΤΑΘΛHMA",  formatter:formatchapionships2, editor : elDropDownchapionships2,  width:130},
                {key:"Time", label:"ΩΡΑ", width:30, editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:myTimeFormatter},
                {key:"Code", label:"ΚΩΔ", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:"string", width:20},
                {key:"EE", label:"ΕΕ", editor: new YAHOO.widget.DropdownCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", dropdownOptions:["1","2","3","4","5"],disableBtns:false})},
                {key:"Goal_1", label:"1", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber },
                {key:"HomeTeamID", label:"ΓΗΠΕΔΟΥΧΟΣ", formatter:formatteams2, editor : elDropDownteams2},
                {key:"Goal_x", label:"X", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber},
                {key:"HostTeamID", label:"ΦΙΛΟΞΕΝΟΥΜΕΝΗ", formatter:formatteams2, editor : elDropDownteams2},
                {key:"Goal_2", label:"2", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber },
                {label:"ΕΙΔΙΚΑ ΣΤΟΙΧΗΜΑΤΑ",
	                    children: [
                            {key:"Under", label:"Under", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber, width:30},
                            {key:"Over", label:"Over", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber, width:30},
                            {key:"GG", label:"GG", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber, width:25},
                            {key:"NG", label:"NG", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber, width:25}
                        ]
                },
                {label:"ΔΙΠΛΗ ΕΥΚΑΙΡΙΑ",
	                    children: [
                            {key:"de_1ORX", label:"1ήΧ", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"de_XOR2", label:"Xή2", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"de_1OR2", label:"1ή2", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber}
                        ]
                },
                {label:"1ο ΗΜΙΧΡΟΝΟ",
	                    children: [
                            {key:"HMI_1", label:"HMI 1-1", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber},
                            {key:"HMI_X", label:"HMI 1-X", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber},
                            {key:"HMI_2", label:"HMI 1-2", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber}
                        ]
                },
                {label:"ΗΜΙΧΡΟΝΟ-ΤΕΛΙΚΟ",
	                    children: [
                            {key:"HT_11", label:"HT 1-1", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"HT_1X", label:"HT 1-X", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"HT_12", label:"HT 1-2", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"HT_X1", label:"HT X-1", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"HT_XX", label:"HT X-X", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"HT_X2", label:"HT X-2", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"HT_21", label:"HT 2-1", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"HT_2X", label:"HT 2-X", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"HT_22", label:"HT 2-2", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber}
                        ]
                },
                /*
                {label:"Σωστό Σκορ",
	                    children: [
                            {key:"SS_10", label:"ΣΣ 1-0", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_20", label:"ΣΣ 2-0", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_21", label:"ΣΣ 2-1", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_30", label:"ΣΣ 3-0", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_31", label:"ΣΣ 3-1", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_32", label:"ΣΣ 3-2", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_40", label:"ΣΣ 4-0", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_41", label:"ΣΣ 4-1", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_42", label:"ΣΣ 4-2", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_43", label:"ΣΣ 4-3", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_00", label:"ΣΣ 0-0", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_11", label:"ΣΣ 1-1", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_22", label:"ΣΣ 2-2", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_33", label:"ΣΣ 3-3", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_01", label:"ΣΣ 0-1", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_02", label:"ΣΣ 0-2", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_12", label:"ΣΣ 1-2", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_03", label:"ΣΣ 0-3", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_13", label:"ΣΣ 1-3", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_23", label:"ΣΣ 2-3", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_04", label:"ΣΣ 0-4", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_14", label:"ΣΣ 1-4", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_24", label:"ΣΣ 2-4", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"SS_34", label:"ΣΣ 3-4", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber}
                        ]
                },
                */
                {label:"ΣΥΝΟΛΟ ΤΕΡΜΑΤΩΝ",
	                    children: [
                            {key:"TG_01", label:"TG 0-1", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber},
                            {key:"TG_23", label:"TG 2-3", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber},
                            {key:"TG_46", label:"TG 4-6", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber},
                            {key:"TG_7", label:"TG 7+", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber}
                        ]
                },
                {key:'del', label:'', className: 'delete-button', action:'delete', width:15}
            ];

            //var myDataSource = new YAHOO.util.DataSource(YAHOO.example.Inserted.multitypes);
            //myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSARRAY;

            //var myDataSource = new YAHOO.util.DataSource(YAHOO.example.Data.multitypes);
            //myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSON;

            var myDataSource = new YAHOO.util.DataSource("../includes/dataproxy.php?");
            myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSON;
            myDataSource.connXhrMode = "queueRequests";


            myDataSource.responseSchema = {
                resultsList: "DataSet.items",
                // Use the parse methods to populate the RecordSet with the right data types
                fields: [
                    {key:"AA", parser:"number"},
                    {key:"Date", parser:YAHOO.util.DataSource.parseDate},
                    {key:"CountryID", parser:"number"},
					{key:"ChapionshipID", parser:"number"},
                    {key:"Time", parser:"string"},
                    {key:"Code", parser:"string"},
                    {key:"EE", parser:"number"},
                    {key:"Goal_1", parser:"number"},
                    {key:"HomeTeamID", parser:"string"},
                    {key:"Goal_x", parser:"number"},
                    {key:"HostTeamID", parser:"string"},
                    {key:"Goal_2", parser:"string"},
                    {key:"de_1ORX",parser:"number"},
                    {key:"de_XOR2",parser:"number"},
                    {key:"de_1OR2",parser:"number"},
                    {key:"Under",parser:"number"},
                    {key:"Over",parser:"number"},
                    {key:"GG",parser:"number"},
                    {key:"NG",parser:"number"},
                    {key:"HMI_1", parser:"number"},
                    {key:"HMI_X", parser:"number"},
                    {key:"HMI_2", parser:"number"},
                    {key:"HT_11", parser:"number"},
                    {key:"HT_1X", parser:"number"},
                    {key:"HT_12", parser:"number"},
                    {key:"HT_X1", parser:"number"},
                    {key:"HT_XX", parser:"number"},
                    {key:"HT_X2", parser:"number"},
                    {key:"HT_21", parser:"number"},
                    {key:"HT_2X", parser:"number"},
                    {key:"HT_22", parser:"number"},
                    {key:"SS_10", parser:"number"},
                    {key:"SS_20", parser:"number"},
                    {key:"SS_21", parser:"number"},
                    {key:"SS_30", parser:"number"},
                    {key:"SS_31", parser:"number"},
                    {key:"SS_32", parser:"number"},
                    {key:"SS_40", parser:"number"},
                    {key:"SS_41", parser:"number"},
                    {key:"SS_42", parser:"number"},
                    {key:"SS_43", parser:"number"},
                    {key:"SS_00", parser:"number"},
                    {key:"SS_11", parser:"number"},
                    {key:"SS_22", parser:"number"},
                    {key:"SS_33", parser:"number"},
                    {key:"SS_01", parser:"number"},
                    {key:"SS_02", parser:"number"},
                    {key:"SS_12", parser:"number"},
                    {key:"SS_03", parser:"number"},
                    {key:"SS_13", parser:"number"},
                    {key:"SS_23", parser:"number"},
                    {key:"SS_04", parser:"number"},
                    {key:"SS_14", parser:"number"},
                    {key:"SS_24", parser:"number"},
                    {key:"SS_34", parser:"number"},
                    {key:"TG_01", parser:"number"},
                    {key:"TG_23", parser:"number"},
                    {key:"TG_46", parser:"number"},
                    {key:"TG_7", parser:"number"},
                    {key:"del"}
                ],
                metaFields: {totalRecords: "DataSet.totalRecords", notfound:"DataSet.notfound", notfoundcount:"DataSet.notfoundcount", couponID:"DataSet.couponID", couponperiod:"DataSet.couponperiod"} // Access server-provided dynamic value
            };

            var oConfigs = {

                    dateOptions:{format:"%d/%m/%Y", locale:"el"},
                    selectionMode:"single",
                    numberOptions:{decimalPlaces:2, thousandsSeparator:","},
                    MSG_EMPTY:"Δεν υπάρχουν εγγραφές",
                    initialRequest:"query=empty&type=select&whereID=OpapXML",
                    draggableColumns:false
	        };

            DataEdit = new YAHOO.widget.DataTable("formatting", myColumnDefs, myDataSource, oConfigs  );

            var i=1,bReverseSorted = false;

            // Track when Column is reverse-sorted, since new data will come in out of order
            var trackReverseSorts = function(oArg) {
                bReverseSorted = (oArg.dir === YAHOO.widget.DataTable.CLASS_DESC);
            };



            // Set up editing flow
	        var highlightEditableCell = function(oArgs) {
	            var elCell = oArgs.target;
	            if(YAHOO.util.Dom.hasClass(elCell, "yui-dt-editable")) {
	                this.highlightCell(elCell);
	            }
	        };


            DataEdit.subscribe("cellMouseoverEvent", highlightEditableCell);
	        DataEdit.subscribe("cellMouseoutEvent", DataEdit.onEventUnhighlightCell);


            var myBuildUrl = function(datatable,record) {
                var url = '';
                var cols = datatable.getColumnSet().keys;
                for (var i = 0; i < cols.length; i++) {
                    if (cols[i].isPrimaryKey) {
                        url += '&id=' + escape(record.getData(cols[i].key));
                        url += '&primaryKey=' + cols[i].key;
                    }
                }

                return url;
            };

           DataEdit.doBeforeShowCellEditor = function(oCellEditor) {


                var oEditor1 = elDropDowncountries2;
                var oEditor2 = elDropDownchapionships2;
                var oEditor3 = elDropDownteams2;
                var oEditor = oCellEditor;
		        var oRecord = oEditor.getRecord();
           		var oColumn1 = this.getColumn('CountryID');
				var oColumn2 = this.getColumn('ChapionshipID');
                var valueCountry = oRecord.getData(oColumn1.key);
				var valueChapionship = oRecord.getData(oColumn2.key);
				var processID;






                //take the value of the CountryID and fill the drop down menu with appropriate chapionship values that
                //corresponds to that country
                if (oEditor == oEditor2) {

							if (valueCountry == '') {
								 YAHOO.example.alert('Συμπληρώστε πρώτα τη στήλη <b>"Χώρα"</b> μετά τη στήλη <b>"Πρωτάθλημα"</b> και τέλος τις στήλες <b>"Γηπεδούχος"</b> και <b>"Φιλοξενούμενη"</b>.');

								 return false;

							}
                             ajaxLoadingPanel.show();
                            processID = YAHOO.util.Connect.asyncRequest('GET', '../includes/dataproxy.php?query=chapionships&primaryKey=ChapionshipID&type=select&output=dropdown&whereID=' + valueCountry, {
                                         success: function(o) {

                                                try {

                                                    var r = YAHOO.lang.JSON.parse(o.responseText);
                                                }
                                                catch (x) {

                                                    alert("JSON Parse failed!");
                                                    return;
                                                }
                                                 //debug
                                                //alert(YAHOO.lang.dump(r));

                                                oEditor.dropdownOptions = r.DataSet.items;
                                                oEditor.setOptions();




                                                ajaxLoadingPanel.hide();


                                        },
                                        failure: function(o) {
                                               alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή σας δεν αποθηκεύτηκε.');
                                        },
                                        scope: this
                                }  );




                }

 				if (oEditor == oEditor3) {

							if (valueChapionship == '') {
								 YAHOO.example.alert('Συμπληρώστε πρώτα τη στήλη <b>"Χώρα"</b> μετά τη στήλη <b>"Πρωτάθλημα"</b> και τέλος τις στήλες <b>"Γηπεδούχος"</b> και <b>"Φιλοξενούμενη"</b>.');

								 return false;

							}
							ajaxLoadingPanel.show();
                            processID = YAHOO.util.Connect.asyncRequest('GET', '../includes/dataproxy.php?query=teams&primaryKey=TeamID&type=select&output=dropdown&whereID=' + valueChapionship, {
                                         success: function(o) {

                                                try {

                                                    var r = YAHOO.lang.JSON.parse(o.responseText);
                                                }
                                                catch (x) {

                                                    alert("JSON Parse failed!");
                                                    return;
                                                }
                                                 //debug
                                                //alert(YAHOO.lang.dump(r));

                                                oEditor.dropdownOptions = r.DataSet.items;
                                                oEditor.setOptions();
                                                ajaxLoadingPanel.hide();

                                        },
                                        failure: function(o) {
                                               alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή σας δεν αποθηκεύτηκε.');
                                        },
                                        scope: this
                                }  );


				}

                //dont let show countries that dont have chapionships.
                if (oEditor == oEditor1) {


                            ajaxLoadingPanel.show();

                            processID = YAHOO.util.Connect.asyncRequest('GET', '../includes/dataproxy.php?query=countries&primaryKey=CountryID&type=select&output=dropdown', {
                                         success: function(o) {

                                                try {

                                                    var r = YAHOO.lang.JSON.parse(o.responseText);
                                                }
                                                catch (x) {
                                                    alert("JSON Parse failed!");
                                                    return;
                                                }
                                                 //debug
                                                //alert("Inside=" + YAHOO.lang.dump(r));
                                                oEditor.dropdownOptions = r.DataSet.items;
                                                oEditor.setOptions();
                                                ajaxLoadingPanel.hide();

                                        },
                                        failure: function(o) {
                                               alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή σας δεν αποθηκεύτηκε.');
                                        },
                                        scope: this
                                }  );

                }


                return true;
            };






			DataEdit.subscribe('cellClickEvent',function(oArgs) {


                var target = oArgs.target;

                column = this.getColumn(target);
                record = this.getRecord(target);



                switch (column.action) {

                 case 'delete' :

                            if (confirm('Είσαι σίγουρος για τη διαγραφή ;')) {
                            		this.deleteRow(target);
                                    for(i=0;i<=DataEdit.getRecordSet().getLength()-1;i++){

                        		        oRecord = DataEdit.getRecordSet().getRecord(i);
                                        DataEdit.updateCell ( oRecord , "AA" , i+1 );


                                    }

                            }
                            break;
                    case 'insert':

                            break;
                    default:DataEdit.onEventShowCellEditor(oArgs);
                            break;
                }

            })


            var TG = function(tg_sel, under_odd) {


               var UnderArray=[1.25,1.3,1.35,1.4,1.45,1.5,1.55,1.6,1.65,1.7,1.75,1.8,1.85,1.9,1.95,2,2.05,2.1,2.15,2.2,2.25,2.3,2.35,2.4,2.45,2.5,2.55,2.6];
               var TG01=[1.8,1.8,2.0,2.35,2.4,2.5,2.6,2.7,2.9,3.1,3.2,3.4,3.6,3.6,3.6,4.25,4.5,4.75,4.6,4.5,5.0,5.5,5.5,5.5,5.5,5.5,5.5,5.5];
               var TG23=[1.7,1.7,1.7,1.7,1.7,1.7,1.75,1.75,1.8,1.8,1.8,1.8,1.8,1.8,1.9,2.0,2.0,2.0,2.0,2.0,2.0,2.2,2.2,2.2,2.2,2.2,2.2,2.2];
               var TG46=[5.0,5.0,5.0,4.5,4.25,4.0,3.75,3.5,3.25,3.0,3.0,2.9,2.9,2.9,2.6,2.4,2.3,2.3,2.3,2.4,2.2,2.1,2.1,2.1,2.1,2.1,2.1,2.1];
               var TG7=[30.0,30.0,30.0,25.0,25.0,25.0,20.0,20.0,17.0,17.0,15.0,12.5,11.0,11.0,10.0,9.0,8.0,7.5,7.5,8.0,6.5,6.0,6.0,6.0,6.0,6.0,6.0,6.0];

                if (tg_sel=='TG_01')  {
                    for (i=0;i<UnderArray.length;i++) {

                        if (under_odd <= UnderArray[i]) {
                            return TG01[i];
                        }
                    }

                    return  TG01[TG01.length-1];

                } else if (tg_sel=='TG_23') {


                    for (i=0;i<UnderArray.length;i++) {

                        if (under_odd <= UnderArray[i]) {
                            return TG23[i];
                        }
                    }


                   return  TG23[TG23.length-1];

                } else if (tg_sel=='TG_46') {


                    for (i=0;i<UnderArray.length;i++) {

                        if (under_odd <= UnderArray[i]) {
                            return TG46[i];
                        }
                    }


                   return  TG46[TG46.length-1];

                } else if (tg_sel=='TG_7') {


                    for (i=0;i<UnderArray.length;i++) {

                        if (under_odd <= UnderArray[i]) {
                            return TG7[i];
                        }
                    }

                   return  TG7[TG7.length-1];

                }



                return 1.05;
            }

            var HT = function(Score,odds) {

               var Gain = 0.0;
               var OddsNX=[1.02,1.05,1.10,1.15,1.20,1.25,1.30,1.35,1.40,1.45,1.50,1.55,1.60,1.65,1.70,1.75,1.80,1.90,2.00,2.10,2.20,2.30,2.40,2.50,2.60,2.70,2.80,2.90,3.0,3.10,3.20,3.30,3.40,3.50,3.60,3.75,4.00,4.50,5.0,5.50,6.0,7.0,8.0,9.0,10.0,12.0,15.0,20.0,25.0];
               var Score11OR22=[1.10,1.20,1.35,1.50,1.60,1.65,1.75,1.85,1.95,2.10,2.20,2.30,2.40,2.50,2.60,2.65,2.90,3.10,3.25,3.40,3.60,3.75,4.0,4.20,4.30,4.50,4.60,5.0,5.0,5.50,5.50,6.0,6.0,6.25,6.50,7.0,7.50,7.50,8.0,9.0,10.0,12.0,14.0,17.0,19.0,21.0,30.0,35.0,45.0];
               var ScoreX1ORX2=[6.5,5.75,5.0,4.4,4.4,4.4,4.3,4.3,4.3,4.3,4.3,4.3,4.3,4.4,4.4,4.6,4.6,4.6,5.0,5.0,5.25,5.5,5.5,6.0,6.0,6.5,6.5,6.75,7.0,7.0,7.0,7.0,7.5,7.5,7.5,8.0,8.0,9.0,10.0,11.0,12.0,14.0,16.0,18.0,19.0,21.0,30.0,35.0,45.0];
               var Score21OR12=[50.0,40.0,30.0,25.0,25.0,25.0,25.0,25.0,25.0,25.0,25.0,25.0,25.0,25.0,25.0,25.0,25.0,25.0,25.0,25.0,25.0,25.0,25.0,25.0,25.0,25.0,25.0,25.0,25.0,25.0,25.0,25.0,25.0,25.0,25.0,25.0,30.0,30.0,30.0,30.0,30.0,40.0,40.0,60.0,60.0,75.0,100.0,100.0,100.0];

               var OddsX=[2.40,2.50,2.60,2.70,2.80,2.90,3.0,3.10,3.20,3.30,3.40,3.50,3.60,3.75,4.0,4.50,5.0,5.50,6.0,7.0,8.0];
               var Score1XOR2X=[11.0,11.0,11.0,12.0,12.0,12.0,13.0,13.0,14.0,15.0,16.0,16.0,16.0,18.0,20.0,22.0,25.0,25.0,28.0,40.0,40.0];
               var Score2XOR1X=[11.0,11.0,11.0,12.0,12.0,12.0,12.0,12.0,12.0,12.0,12.0,12.0,13.0,14.0,14.0,14.0,16.0,17.0,20.0,22.0,22.0];
               var ScoreXX=[3.5,3.6,4.0,4.0,4.3,4.4,4.5,4.6,5.0,5.25,5.5,5.75,6.25,6.50,7.0,7.5,8.0,9.0,10.0,12.0,14.0];



               if ( (Score=='1-1') || (Score=='2-2') ) {


                        for (i=0;i<OddsNX.length;i++) {

                            if (odds <= OddsNX[i]) {
                                return Score11OR22[i]-(Score11OR22[i] * 0.10)+Gain;
                            }
                        }

                        return Score11OR22[(Score11OR22.length)-1]+Gain;


               } else if ( (Score=='X-1') || (Score=='X-2') ) {

                        for (i=0;i<OddsNX.length;i++) {

                            if (odds <= OddsNX[i]) {
                                return ScoreX1ORX2[i]+Gain;
                            }
                        }

                        return ScoreX1ORX2[(ScoreX1ORX2.length)-1]+Gain;


               } else if ( (Score=='2-1') || (Score=='1-2') ) {

                        for (i=0;i<OddsNX.length;i++) {

                            if (odds <= OddsNX[i]) {
                                return Score21OR12[i]+Gain;
                            }
                        }

                        return Score21OR12[(Score21OR12.length)-1]+Gain;

               } else if ( (Score=='1-X<=') || (Score=='2-X>') ) {

                        for (i=0;i<OddsX.length;i++) {

                            if (odds <= OddsX[i]) {
                                return Score1XOR2X[i]+Gain;
                            }
                        }

                        return Score1XOR2X[(Score1XOR2X.length)-1]+Gain;

               } else if ( (Score=='2-X<=') || (Score=='1-X>') ) {

                        for (i=0;i<OddsX.length;i++) {

                            if (odds <= OddsX[i]) {
                                return Score2XOR1X[i]+Gain;
                            }
                        }

                        return Score2XOR1X[(Score2XOR1X.length)-1]+Gain;

               } else if  (Score=='X-X' ) {

                        for (i=0;i<OddsX.length;i++) {

                            if (odds <= OddsX[i]) {
                                return ScoreXX[i]+Gain;
                            }
                        }

                        return ScoreXX[(ScoreXX.length)-1]+Gain;
               }

                return 1.05;
            };

            var SS = function(Score,odds) {
                var Gain = 0.1;
                Odds=[1.02,1.05,1.10,1.15,1.20,1.25,1.30,1.35,1.40,1.45,1.50,1.55,1.60,1.65,1.70,1.75,1.80,1.90,2.0,2.1,2.2,2.3,2.4,2.5,2.6,2.7,2.8,2.9,3.0,3.1,3.2,3.3,3.4,3.5,3.6,3.7,3.8,3.9,4.0,4.5,5.0,5.5,6.0,7.0,8.0,9.0,10.0,12.0,15.0,20.0,25.0];
                OddsX=[2.4,2.5,2.6,2.7,2.8,2.9,3.0,3.1,3.2,3.3,3.4,3.5,3.6,3.75,4.0,4.5,5.0,5.5,6.0,7.0,8.0];
                Score10OR01=[7.5,7.5,7.5,7.5,7.5,7.0,7.0,7.0,6.5,6.5,6.5,6.5,6.0,6.0,6.0,6.0,6.5,6.5,6.5,6.5,7.0,7.0,7.0,7.5,7.5,8.0,8.0,8.5,8.5,8.5,9.0,9.0,9.0,9.5,9.5,10.0,10.0,11.0,11.0,12.0,12.0,13.0,15.0,17.0,17.0,19.0,23.0,35.0,35.0];
                Score20OR02=[6.0,6.0,6.0,6.0,6.0,6.0,6.0,6.0,6.5,6.5,6.5,6.5,6.5,7.0,7.0,7.0,7.5,8.0,8.0,8.5,9.0,9.5,10.0,10.0,11.0,12.0,12.0,13.0,13.0,13.0,14.0,14.0,15.0,15.0,15.0,17.0,19.0,19.0,23.0,23.0,25.0,30.0,35.0,40.0,50.0,60.0,80.0,100.0,100.0];
                Score21OR12=[10.0,10.0,10.0,10.0,10.0,9.5,9.0,8.5,8.0,8.0,8.0,7.5,7.5,7.5,7.5,8.0,8.0,8.0,8.5,8.5,8.5,9.0,9.0,9.0,9.5,9.5,10.0,10.0,11.0,11.0,11.0,12.0,12.0,13.0,13.0,15.0,15.0,17.0,17.0,19.0,19.0,21.0,25.0,30.0,35.0,35.0,50.0,60.0,60.0];
                Score30OR03=[7.0,7.5,7.5,8.0,8.5,9.0,9.0,9.5,10.0,11.0,13.0,13.0,14.0,14.0,15.0,15.0,17.0,19.0,19.0,21.0,23.0,23.0,25.0,25.0,25.0,30.0,30.0,35.0,35.0,35.0,35.0,40.0,40.0,50.0,50.0,50.0,50.0,50.0,60.0,80.0,80.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0];
                Score31OR13=[15.0,15.0,13.0,11.0,11.0,11.0,10.0,10.0,11.0,11.0,13.0,13.0,13.0,13.0,15.0,15.0,17.0,19.0,19.0,19.0,21.0,21.0,23.0,23.0,25.0,25.0,25.0,30.0,30.0,30.0,30.0,30.0,35.0,35.0,40.0,40.0,40.0,50.0,50.0,50.0,60.0,60.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0];
                Score32OR23=[60.0,60.0,50.0,40.0,40.0,40.0,35.0,35.0,30.0,30.0,30.0,30.0,30.0,25.0,25.0,25.0,25.0,25.0,30.0,30.0,30.0,30.0,30.0,30.0,30.0,30.0,30.0,30.0,30.0,30.0,30.0,35.0,35.0,35.0,35.0,35.0,35.0,35.0,40.0,40.0,40.0,50.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0];
                Score40OR04=[7.5,8.0,8.5,10.0,12.0,15.0,15.0,17.0,19.0,21.0,25.0,30.0,30.0,35.0,35.0,35.0,35.0,40.0,40.0,40.0,50.0,50.0,60.0,60.0,60.0,80.0,80.0,80.0,80.0,80.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0];
                Score41OR14=[12.0,12.0,12.0,11.0,12.0,15.0,15.0,17.0,19.0,21.0,23.0,25.0,25.0,30.0,30.0,30.0,35.0,35.0,40.0,40.0,50.0,50.0,50.0,60.0,60.0,60.0,60.0,60.0,60.0,60.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0];
                Score42OR24=[60.0,60.0,60.0,50.0,50.0,50.0,40.0,40.0,40.0,50.0,50.0,50.0,50.0,50.0,50.0,50.0,50.0,50.0,50.0,60.0,60.0,80.0,80.0,80.0,80.0,80.0,80.0,80.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0];
                Score43OR34=[150.0,150.0,150.0,150.0,150.0,150.0,150.0,150.0,150.0,150.0,150.0,150.0,150.0,150.0,150.0,150.0,150.0,150.0,150.0,150.0,150.0,150.0,150.0,150.0,150.0,150.0,150.0,200.0,200.0,200.0,200.0,200.0,200.0,200.0,200.0,200.0,200.0,200.0,200.0,300.0,300.0,300.0,300.0,300.0,300.0,300.0,300.0,300.0,300.0];
                Score50OR05=[5.5,5.5,6.5,7.0,9.0,12.0,13.0,15.0,18.0,20.0,22.0,24.0,30.0,35.0,32.0,35.0,40.0,45.0,50.0,55.0,60.0,60.0,65.0,80.0,80.0,80.0,80.0,100.0,100.0,200.0,200.0,200.0,200.0,200.0,200.0,300.0,300.0,200.0,200.0,300.0,300.0,300.0,300.0,300.0,300.0,300.0,300.0,300.0,300.0];
                Score51OR15=[7.0,8.0,9.0,10.0,11.0,13.0,14.0,16.0,18.0,20.0,22.0,24.0,28.0,30.0,30.0,30.0,35.0,40.0,45.0,48.0,50.0,50.0,60.0,60.0,60.0,60.0,60.0,80.0,80.0,120.0,120.0,150.0,150.0,150.0,200.0,300.0,300.0,200.0,200.0,300.0,300.0,300.0,300.0,300.0,300.0,300.0,300.0,300.0,300.0];
                Score52OR25=[80.0,80.0,80.0,80.0,80.0,70.0,70.0,70.0,60.0,60.0,60.0,60.0,60.0,60.0,60.0,60.0,60.0,60.0,60.0,60.0,70.0,70.0,70.0,80.0,80.0,80.0,80.0,150.0,150.0,200.0,200.0,200.0,200.0,200.0,200.0,300.0,300.0,150.0,150.0,200.0,200.0,200.0,200.0,300.0,300.0,300.0,300.0,300.0,300.0];
                Score53OR35=[200.0,200.0,200.0,200.0,200.0,200.0,200.0,200.0,200.0,200.0,200.0,200.0,200.0,200.0,200.0,200.0,200.0,200.0,200.0,200.0,200.0,200.0,200.0,200.0,200.0,200.0,200.0,200.0,200.0,300.0,300.0,300.0,300.0,300.0,300.0,400.0,400.0,300.0,300.0,400.0,400.0,400.0,400.0,400.0,400.0,400.0,400.0,400.0,400.0];
                Score54OR45=[300.0,300.0,300.0,300.0,300.0,300.0,300.0,300.0,300.0,300.0,300.0,300.0,300.0,300.0,300.0,300.0,300.0,300.0,300.0,300.0,300.0,300.0,400.0,400.0,400.0,400.0,400.0,400.0,400.0,500.0,500.0,500.0,500.0,500.0,500.0,500.0,500.0,500.0,500.0,500.0,500.0,500.0,500.0,500.0,500.0,500.0,500.0,500.0,500.0];
                Score00=[6.5,6.5,6.5,7.0,7.0,8.0,8.5,9.0,9.5,10.0,10.0,10.0,11.0,11.0,12.0,12.0,12.0,12.0,13.0,15.0,17.0];
                Score11=[5.5,5.5,6.0,6.0,6.5,6.5,6.5,6.5,6.5,7.0,7.5,7.5,7.5,7.5,8.5,10.0,11.0,13.0,13.0,15.0,15.0];
                Score22=[15.0,15.0,15.0,15.0,15.0,15.0,15.0,15.0,18.0,18.0,18.0,20.0,20.0,22.0,25.0,25.0,30.0,35.0,35.0,50.0,50.0];
                Score33=[60.0,60.0,60.0,60.0,60.0,60.0,60.0,60.0,80.0,80.0,80.0,80.0,80.0,80.0,100.0,100.0,100.0,100.0,100.0,100.0,100.0];


                //cancel all of them
                return 0;


                if ( (Score=='1-0') || (Score=='0-1') ) {

                        for (i=0;i<Odds.length;i++) {

                            if (odds <= Odds[i]) {
                                return Score10OR01[i]+Gain;
                            }
                        }

                        return Score10OR01[(Score10OR01.length)-1]+Gain;

                } else   if ( (Score=='2-0') || (Score=='0-2') ) {

                        for (i=0;i<Odds.length;i++) {

                            if (odds <= Odds[i]) {
                                return Score20OR02[i]+Gain;
                            }
                        }

                        return Score20OR02[(Score20OR02.length)-1]+Gain;

                } else   if ( (Score=='2-1') || (Score=='1-2') ) {

                        for (i=0;i<Odds.length;i++) {

                            if (odds <= Odds[i]) {
                                return Score21OR12[i]+Gain;
                            }
                        }

                        return Score21OR12[(Score21OR12.length)-1]+Gain;

                } else   if ( (Score=='3-0') || (Score=='0-3') ) {

                        for (i=0;i<Odds.length;i++) {

                            if (odds <= Odds[i]) {
                                return Score30OR03[i]+Gain;
                            }
                        }

                        return Score30OR03[(Score30OR03.length)-1]+Gain;

                } else   if ( (Score=='3-1') || (Score=='1-3') ) {

                        for (i=0;i<Odds.length;i++) {

                            if (odds <= Odds[i]) {
                                return Score31OR13[i]+Gain;
                            }
                        }

                        return Score31OR13[(Score31OR13.length)-1]+Gain;

                } else   if ( (Score=='3-2') || (Score=='2-3') ) {

                        for (i=0;i<Odds.length;i++) {

                            if (odds <= Odds[i]) {
                                return Score32OR23[i]+Gain;
                            }
                        }

                        return Score32OR23[(Score32OR23.length)-1]+Gain;

                } else   if ( (Score=='4-0') || (Score=='0-4') ) {

                        for (i=0;i<Odds.length;i++) {

                            if (odds <= Odds[i]) {
                                return Score40OR04[i]+Gain;
                            }
                        }

                        return Score40OR04[(Score40OR04.length)-1]+Gain;

                } else   if ( (Score=='4-1') || (Score=='1-4') ) {

                        for (i=0;i<Odds.length;i++) {

                            if (odds <= Odds[i]) {
                                return Score41OR14[i]+Gain;
                            }
                        }

                        return Score41OR14[(Score41OR14.length)-1]+Gain;

                } else   if ( (Score=='4-2') || (Score=='2-4') ) {

                        for (i=0;i<Odds.length;i++) {

                            if (odds <= Odds[i]) {
                                return Score42OR24[i]+Gain;
                            }
                        }

                        return Score42OR24[(Score42OR24.length)-1]+Gain;

                } else   if ( (Score=='4-3') || (Score=='3-4') ) {

                        for (i=0;i<Odds.length;i++) {

                            if (odds <= Odds[i]) {
                                return Score43OR34[i]+Gain;
                            }
                        }

                        return Score43OR34[(Score43OR34.length)-1]+Gain;

                } else   if  (Score=='0-0') {

                        for (i=0;i<OddsX.length;i++) {

                            if (odds <= OddsX[i]) {
                                return Score00[i]+Gain;
                            }
                        }

                        return Score00[(Score00.length)-1]+Gain;

                } else   if  (Score=='1-1') {

                        for (i=0;i<OddsX.length;i++) {

                            if (odds <= OddsX[i]) {
                                return Score11[i]+Gain;
                            }
                        }

                        return Score11[(Score11.length)-1]+Gain;

                }else   if  (Score=='2-2') {

                        for (i=0;i<OddsX.length;i++) {

                            if (odds <= OddsX[i]) {
                                return Score22[i]+Gain;
                            }
                        }

                        return Score22[(Score22.length)-1]+Gain;

                }else   if  (Score=='3-3') {

                        for (i=0;i<OddsX.length;i++) {

                            if (odds <= OddsX[i]) {
                                return Score33[i]+Gain;
                            }
                        }

                        return Score33[(Score33.length)-1]+Gain;

                }







                return 1.05;
            }

      /* Start of change by Satyam to allow for keyboard navigation */

      	   DataEdit.subscribe("editorKeydownEvent",function(oArgs) {
 			var self = this,
				ed = this._oCellEditor,  // Should be: oArgs.editor, see: http://yuilibrary.com/projects/yui2/ticket/2513909
				ev = oArgs.event,
				KEY = YAHOO.util.KeyListener.KEY,
				Textbox = YAHOO.widget.TextboxCellEditor,
				Textarea = YAHOO.widget.TextareaCellEditor,
				cell = ed.getTdEl(),
				col = ed.getColumn(),
				row,rec,

				editNext = function(cell) {
					cell = self.getNextTdEl(cell);
					while (cell && !self.getColumn(cell).editor) {
						cell = self.getNextTdEl(cell);
					}
					if (cell) {
						self.showCellEditor(cell);
					}
				},
				editPrevious = function(cell) {
					cell = self.getPreviousTdEl(cell);
					while (cell && !self.getColumn(cell).editor) {
						cell = self.getPreviousTdEl(cell);
					}
					if (cell) {
						self.showCellEditor(cell);
					}
				};

			switch (ev.keyCode) {
				case KEY.UP:
					if (ed instanceof Textarea) { return; }
					YAHOO.util.Event.stopEvent(ev);
					ed.save();
					row = this.getPreviousTrEl(cell);
					if (row) {
						rec = this.getRecord(row);
						this.showCellEditor({record:rec,column:col});
					}
					break;
				case KEY.DOWN:
					if (ed instanceof Textarea) { return; }
					YAHOO.util.Event.stopEvent(ev);
					ed.save();
					row = this.getNextTrEl(cell);
					if (row) {
						rec = this.getRecord(row);
						this.showCellEditor({record:rec,column:col});
					}
					break;
				case KEY.LEFT:
					if (ed instanceof Textbox || ed instanceof Textarea) { return; }
					YAHOO.util.Event.stopEvent(ev);
					ed.save();
					editPrevious(cell);
					break;
				case KEY.RIGHT:
					if (ed instanceof Textbox || ed instanceof Textarea) { return; }
					YAHOO.util.Event.stopEvent(ev);
					ed.save();
					editNext(cell);
					break;
				case KEY.TAB:
					YAHOO.util.Event.stopEvent(ev);
					ed.save();
					if (ev.shiftKey) {
						editPrevious(cell);
					} else {
						editNext(cell);
					}
					break;
			}
		});

		// End of key handling

		// The following code tries to keep the cell editor visible at all times.

		DataEdit.on('editorShowEvent', function (oArgs) {
			var Dom = YAHOO.util.Dom;
			var el = oArgs.editor.getContainerEl();
			var reg = Dom.getRegion(el);
			var topScreen = Dom.getDocumentScrollTop(),
				bottomScreen = topScreen + Dom.getViewportHeight();
			if (reg.top < topScreen) {
				el.scrollIntoView();
			}
			if (reg.bottom > bottomScreen) {
				el.scrollIntoView(false);
			}
		});

		// End of patch.

           DataEdit.subscribe("editorSaveEvent", function(oArgs){

				var MAX_VALUE_ALERT = 15;
                var oEditor = oArgs.editor;
                var newData;
        	    var oldData = oArgs.oldData;
    			var elCell = oEditor.cell;
		        var oRecord = oEditor.getRecord();
           		var oColumn = oEditor.getColumn();
                var value = oRecord.getData(oColumn.key);
                var oTeamCol, compute;


                if  (oColumn.key == "Time") {
                     newData = oArgs.newData;
                } else {
                     newData = trimNumber(oArgs.newData);
                }

                this.updateCell ( oRecord , oColumn , newData );
                DataEdit.set("sortedBy", null);

                if (oColumn.key == "Time") {


                 // regular expression to match required time format
                    re = /^(\d{1,2}):(\d{2})([ap]m)?$/;

                    if(newData != '') {
                      if(regs = newData.match(re)) {
                        if(regs[3]) {
                          if(regs[1] < 1 || regs[1] > 12) {
                            	this.updateCell ( oRecord , oColumn , oldData );
                                return;
                          }
                        } else {
                          if(regs[1] > 23) {
                            	this.updateCell ( oRecord , oColumn , oldData );
                                return;
                          }
                        }
                        if(regs[2] > 59) {
                        	this.updateCell ( oRecord , oColumn , oldData );
                            return;
                        }
                      } else {
                        	this.updateCell ( oRecord , oColumn , oldData );
                            return;
                      }
                    }

                }






		

				//no characters allowed to the following fields
		        if (  (oColumn.key == "de_1ORX")  || (oColumn.key == "de_XOR2")  || (oColumn.key == "de_1OR2") ||
					  (oColumn.key == "Under")  || (oColumn.key == "Over")  || (oColumn.key == "GG") ||
					  (oColumn.key == "NG")  || (oColumn.key == "Code")   ||
                      (oColumn.key =="HMI_1") ||  (oColumn.key =="HMI_X") ||   (oColumn.key =="HMI_2") ||  (oColumn.key =="HT_11") ||  (oColumn.key =="HT_1X") ||  (oColumn.key =="HT_12") ||  (oColumn.key =="HT_X1") ||
                      (oColumn.key =="HT_XX") ||  (oColumn.key =="HT_X2") ||  (oColumn.key =="HT_21") ||  (oColumn.key =="HT_2X") ||  (oColumn.key =="HT_22") ||  (oColumn.key =="SS_10") ||  (oColumn.key =="SS_20") ||
                      (oColumn.key =="SS_21") ||  (oColumn.key =="SS_30") ||  (oColumn.key =="SS_31") ||  (oColumn.key =="SS_32") ||  (oColumn.key =="SS_40") ||  (oColumn.key =="SS_41") ||  (oColumn.key =="SS_42") ||
                      (oColumn.key =="SS_43") ||  (oColumn.key =="SS_00") ||  (oColumn.key =="SS_11") ||  (oColumn.key =="SS_22") ||  (oColumn.key =="SS_33") ||  (oColumn.key =="SS_01") ||  (oColumn.key =="SS_02") ||
                      (oColumn.key =="SS_12") ||  (oColumn.key =="SS_03") ||  (oColumn.key =="SS_13") ||  (oColumn.key =="SS_23") ||  (oColumn.key =="SS_04") ||  (oColumn.key =="SS_14") ||  (oColumn.key =="SS_24") ||
                      (oColumn.key =="SS_34") ||  (oColumn.key =="TG_01") ||  (oColumn.key =="TG_23") ||  (oColumn.key =="TG_46") ||  (oColumn.key =="TG_7")
                       ) {


						if ( isNaN(newData) ){
							this.updateCell ( oRecord , oColumn , oldData );
                            return;
                        }

     					if (newData=='') {
                        	this.updateCell ( oRecord , oColumn , oldData );
                            return;
                        }


						//Max_Value_Alert does not affect Code field
						var FloatValue = parseFloat(newData);
						if ( ( FloatValue > MAX_VALUE_ALERT ) && (oColumn.key != "Code") )
							YAHOO.example.alert('Προσοχή ! Η τιμή που δώσατε στη στήλη <b>' + oColumn.label + '</b> είναι πολύ μεγάλη.' );





	        	}



				//the first time the Olddata=0, so check these fields outside the  if(oldData != newData)
				if (  (oColumn.key == "Goal_1")  || (oColumn.key == "Goal_2")  || (oColumn.key == "Goal_x")) {

     					if (newData=='') {
                        	this.updateCell ( oRecord , oColumn , oldData );
                            return;
                        }

				}



                if(oldData != newData)
                {



					//check if HostTeamID == HomeTeamID
					if (  (oColumn.key == "HostTeamID")  || (oColumn.key == "HomeTeamID") ) {

						if (oColumn.key == "HostTeamID")
							oTeamCol = this.getColumn('HomeTeamID');
						else
							oTeamCol = this.getColumn('HostTeamID');

													
						if ( (oRecord.getData(oTeamCol.key)) == newData ){
							YAHOO.example.alert('Προσοχή ! Οι στήλες <b>Γηπεδούχος</b> και <b>Φιλοξενούμενη</b> έχουν τις ίδιες ομάδες.');

						}


					}


                   if  (oColumn.key == "Under")   {





                        compute =TG('TG_01',eval(oRecord.getData(this.getColumn('Under').key)));
                        SetCol = this.getColumn('TG_01');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        compute =TG('TG_23',eval(oRecord.getData(this.getColumn('Under').key)));
                        compute = 1.85;
                        SetCol = this.getColumn('TG_23');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        compute =TG('TG_46',eval(oRecord.getData(this.getColumn('Under').key)));
                        SetCol = this.getColumn('TG_46');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );


                        compute =TG('TG_7',eval(oRecord.getData(this.getColumn('Under').key)));
                        SetCol = this.getColumn('TG_7');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );
                   }


					//set all other values
					if (  (oColumn.key == "Goal_1")  || (oColumn.key == "Goal_2")  || (oColumn.key == "Goal_x")) {


						if ( isNaN(newData) ) {

								this.updateCell ( oRecord , oColumn , oldData );
                                return;

						}

						var FloatValue = parseFloat(newData);
						if ( FloatValue > MAX_VALUE_ALERT )
							YAHOO.example.alert('Προσοχή ! Η τιμή που δώσατε στη στήλη <b>' + oColumn.label + '</b> είναι πολύ μεγάλη.' );



						if ( (oColumn.key == "Goal_1") && ( ( (oRecord.getData(this.getColumn('Goal_2').key)) == 0) || ( (oRecord.getData(this.getColumn('Goal_x').key)) == 0) ) )
							return;

						if ( (oColumn.key == "Goal_2") && ( ( (oRecord.getData(this.getColumn('Goal_1').key)) == 0) || ( (oRecord.getData(this.getColumn('Goal_x').key)) == 0) ) )
							return;

						if ( (oColumn.key == "Goal_x") && ( ( (oRecord.getData(this.getColumn('Goal_2').key)) == 0) || ( (oRecord.getData(this.getColumn('Goal_1').key)) == 0) ) )
							return;
						




                        var SetCol = this.getColumn('de_1ORX');
                        compute = ( eval(oRecord.getData(this.getColumn('Goal_1').key))*eval(oRecord.getData(this.getColumn('Goal_x').key)) ) / ( eval(oRecord.getData(this.getColumn('Goal_1').key))+eval(oRecord.getData(this.getColumn('Goal_x').key)) );
                        if (compute <= 1)
                            compute = 1.05;
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2));

                        SetCol = this.getColumn('de_XOR2');
                        compute = ( eval(oRecord.getData(this.getColumn('Goal_x').key))*eval(oRecord.getData(this.getColumn('Goal_2').key)) ) / ( eval(oRecord.getData(this.getColumn('Goal_x').key))+eval(oRecord.getData(this.getColumn('Goal_2').key)) );
                        if (compute <= 1)
                            compute = 1.05;
                        this.updateCell ( oRecord , SetCol ,compute.toFixed(2) );

                        SetCol = this.getColumn('de_1OR2');
                        compute = ( eval(oRecord.getData(this.getColumn('Goal_1').key))*eval(oRecord.getData(this.getColumn('Goal_2').key)) ) / ( eval(oRecord.getData(this.getColumn('Goal_1').key))+eval(oRecord.getData(this.getColumn('Goal_2').key)) );
                        if (compute <= 1)
                            compute = 1.05;
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );


                        /*
                        SetCol = this.getColumn('Over');
                        this.updateCell ( oRecord , SetCol , 0 );

                        SetCol = this.getColumn('GG');
                        this.updateCell ( oRecord , SetCol , 0 );

                        SetCol = this.getColumn('NG');
                        this.updateCell ( oRecord , SetCol , 0 );
                        */

                        var G1_odd=eval(oRecord.getData(this.getColumn('Goal_1').key));
                        compute=-0.0049*(G1_odd*G1_odd*G1_odd*G1_odd)+0.1075*(G1_odd*G1_odd*G1_odd)-0.8415*(G1_odd*G1_odd)+3.3316*G1_odd-1.5819;
                        if (compute < 0 )
                            compute = 0;
                        SetCol = this.getColumn('HMI_1');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        var Gx_odd=eval(oRecord.getData(this.getColumn('Goal_x').key));
                        compute = -0.013*(Gx_odd*Gx_odd)+0.5081*Gx_odd+0.3954;
                        if (compute < 0 )
                            compute = 0;
                        SetCol = this.getColumn('HMI_X');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        var G2_odd=eval(oRecord.getData(this.getColumn('Goal_2').key));
                        compute = 0.0035*(G2_odd*G2_odd*G2_odd)-0.0834*(G2_odd*G2_odd)+1.3085*G2_odd+0.09;
                        if (compute < 0 )
                            compute = 0;
                        SetCol = this.getColumn('HMI_2');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        //*********************************************
                        compute = HT('1-1',eval(oRecord.getData(this.getColumn('Goal_1').key)));
                        SetCol = this.getColumn('HT_11');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );


                        if (   eval(oRecord.getData(this.getColumn('Goal_1').key)) <= eval(oRecord.getData(this.getColumn('Goal_2').key)) )
                            compute = HT('1-X<=',eval(oRecord.getData(this.getColumn('Goal_x').key)));
                        else
                            compute = HT('1-X>',eval(oRecord.getData(this.getColumn('Goal_x').key)));
                        SetCol = this.getColumn('HT_1X');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        compute = HT('1-2',eval(oRecord.getData(this.getColumn('Goal_2').key)));
                        SetCol = this.getColumn('HT_12');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        compute = HT('X-1',eval(oRecord.getData(this.getColumn('Goal_1').key)));
                        SetCol = this.getColumn('HT_X1');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        compute = HT('X-X',eval(oRecord.getData(this.getColumn('Goal_x').key)));
                        SetCol = this.getColumn('HT_XX');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        compute = HT('X-2',eval(oRecord.getData(this.getColumn('Goal_2').key)));
                        SetCol = this.getColumn('HT_X2');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        compute = HT('2-1',eval(oRecord.getData(this.getColumn('Goal_1').key)));
                        SetCol = this.getColumn('HT_21');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        if (   eval(oRecord.getData(this.getColumn('Goal_1').key)) <= eval(oRecord.getData(this.getColumn('Goal_2').key)) )
                            compute = HT('2-X<=',eval(oRecord.getData(this.getColumn('Goal_x').key)));
                        else
                            compute = HT('2-X>',eval(oRecord.getData(this.getColumn('Goal_x').key)));
                        SetCol = this.getColumn('HT_2X');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        compute = HT('2-2',eval(oRecord.getData(this.getColumn('Goal_2').key)));
                        SetCol = this.getColumn('HT_22');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        //*********************************************************
                        compute = SS('1-0',eval(oRecord.getData(this.getColumn('Goal_1').key)));
                        SetCol = this.getColumn('SS_10');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        compute = SS('2-0',eval(oRecord.getData(this.getColumn('Goal_1').key)));
                        SetCol = this.getColumn('SS_20');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        compute = SS('2-1',eval(oRecord.getData(this.getColumn('Goal_1').key)));
                        SetCol = this.getColumn('SS_21');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        compute = SS('3-0',eval(oRecord.getData(this.getColumn('Goal_1').key)));
                        SetCol = this.getColumn('SS_30');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        compute = SS('3-1',eval(oRecord.getData(this.getColumn('Goal_1').key)));
                        SetCol = this.getColumn('SS_31');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        compute = SS('3-2',eval(oRecord.getData(this.getColumn('Goal_1').key)));
                        SetCol = this.getColumn('SS_32');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        compute = SS('4-0',eval(oRecord.getData(this.getColumn('Goal_1').key)));
                        SetCol = this.getColumn('SS_40');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        compute = SS('4-1',eval(oRecord.getData(this.getColumn('Goal_1').key)));
                        SetCol = this.getColumn('SS_41');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        compute = SS('4-2',eval(oRecord.getData(this.getColumn('Goal_1').key)));
                        SetCol = this.getColumn('SS_42');
                        this.updateCell ( oRecord , SetCol ,compute.toFixed(2) );

                        compute = SS('4-3',eval(oRecord.getData(this.getColumn('Goal_1').key)));
                        SetCol = this.getColumn('SS_43');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        compute = SS('0-0',eval(oRecord.getData(this.getColumn('Goal_x').key)));
                        SetCol = this.getColumn('SS_00');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        compute = SS('1-1',eval(oRecord.getData(this.getColumn('Goal_x').key)));
                        SetCol = this.getColumn('SS_11');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        compute = SS('2-2',eval(oRecord.getData(this.getColumn('Goal_x').key)));
                        SetCol = this.getColumn('SS_22');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        compute = SS('3-3',eval(oRecord.getData(this.getColumn('Goal_x').key)));
                        SetCol = this.getColumn('SS_33');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        compute = SS('0-1',eval(oRecord.getData(this.getColumn('Goal_2').key)));
                        SetCol = this.getColumn('SS_01');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        compute = SS('0-2',eval(oRecord.getData(this.getColumn('Goal_2').key)));
                        SetCol = this.getColumn('SS_02');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        compute = SS('1-2',eval(oRecord.getData(this.getColumn('Goal_2').key)));
                        SetCol = this.getColumn('SS_12');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        compute = SS('0-3',eval(oRecord.getData(this.getColumn('Goal_2').key)));
                        SetCol = this.getColumn('SS_03');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        compute = SS('1-3',eval(oRecord.getData(this.getColumn('Goal_2').key)));
                        SetCol = this.getColumn('SS_13');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        compute = SS('2-3',eval(oRecord.getData(this.getColumn('Goal_2').key)));
                        SetCol = this.getColumn('SS_23');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        compute = SS('0-4',eval(oRecord.getData(this.getColumn('Goal_2').key)));
                        SetCol = this.getColumn('SS_04');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        compute = SS('1-4',eval(oRecord.getData(this.getColumn('Goal_2').key)));
                        SetCol = this.getColumn('SS_14');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        compute = SS('2-4',eval(oRecord.getData(this.getColumn('Goal_2').key)));
                        SetCol = this.getColumn('SS_24');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        compute = SS('3-4',eval(oRecord.getData(this.getColumn('Goal_2').key)));
                        SetCol = this.getColumn('SS_34');
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );




					}




                    if (oColumn.key == "CountryID") {

                          //[{value => 1, label => Α-Εθν}]
                          elDropDownchapionships2.dropdownOptions = [{label:"", value:0}];
                          elDropDownchapionships2.setOptions();



                          var SetCol = this.getColumn('ChapionshipID');
                          this.updateCell ( oRecord , SetCol , 0 );


                          elDropDownteams2.dropdownOptions = [{label:"", value:0}];
                          elDropDownteams2.setOptions();

                          SetCol = this.getColumn('HomeTeamID');
                          this.updateCell ( oRecord , SetCol , 0 );

                          SetCol = this.getColumn('HostTeamID');
                          this.updateCell ( oRecord , SetCol , 0 );




                    }

                    if (oColumn.key == "ChapionshipID") {



                          elDropDownteams2.dropdownOptions = [{label:"", value:0}];
                          elDropDownteams2.setOptions();

                          var SetCol = this.getColumn('HomeTeamID');
                          this.updateCell ( oRecord , SetCol , 0 );

                          SetCol = this.getColumn('HostTeamID');
                          this.updateCell ( oRecord , SetCol , 0 );




                    }


                }



             });

	        myTabView.getTab(1).addListener("click", function() {DataEdit.onShow()});


             return {
                oDS: myDataSource,
                oDT: DataEdit,
                oTV: myTabView
            };


        }();
});


/*******************************************************************************************/
/**************************************** Compare Table ***********************************/
/******************************************************************************************/



         YAHOO.util.Event.addListener(window, "load", function() {
         YAHOO.example.EditCoupon =  function() {
         var Dom = YAHOO.util.Dom;




            var lineformatter = function(elTr, oRecord) {



                if (oRecord.getData('id_s') == 'EMPTY') {

                    YAHOO.util.Dom.addClass(elTr, "EmptyLine");

                }

                return true;
            };




            var myColumnDefsCompare = [
                {key:"AA", label:"A/A", formatter:YAHOO.widget.DataTable.formatText},
                {key:"id_s", label:"id string", formatter:lineformatter, hidden:true},
                {key:"CouponID", label:"ΚΩΔ. ΚΟΥΠΟΝΙΟΥ", formatter:YAHOO.widget.DataTable.formatNumber, hidden:true, isPrimaryKey:true},
                {key:"CountryID", formatter:formatcountries, label:"Χώρα", width:70},
				{key:"ChapionshipID", label:"Δ.", width:30},
                {key:"IsoDate", label:"ΗΜΕΡOMHNIA", width:80},
                {key:"Time", label:"ΩΡΑ", width:30, formatter:myTimeFormatter},
                {key:"Code", label:"ΚΩΔ", formatter:"string", width:20},
                {key:"EE", label:"ΕΕ"},
                {key:"Goal_1", label:"1", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber },
                {key:"HomeTeamID", formatter:formatteams, label:"ΓΗΠΕΔΟΥΧΟΣ"},
                {key:"Goal_x", label:"X", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber},
                {key:"HostTeamID", formatter:formatteams, label:"ΦΙΛΟΞΕΝΟΥΜΕΝΗ"},
                {key:"Goal_2", label:"2", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber },
                {label:"ΕΙΔΙΚΑ ΣΤΟΙΧΗΜΑΤΑ",
	                    children: [
                            {key:"Under", label:"Under", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber, width:30},
                            {key:"Over", label:"Over", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber, width:30},
                            {key:"GG", label:"GG", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber, width:25},
                            {key:"NG", label:"NG", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber, width:25}
                        ]
                },
                   /*
                {label:"ΔΙΠΛΗ ΕΥΚΑΙΡΙΑ",
	                    children: [
                            {key:"de_1ORX", label:"1ήΧ", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber},
                            {key:"de_XOR2", label:"Xή2", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber},
                            {key:"de_1OR2", label:"1ή2", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber}
                        ]
                }

                {label:"1ο ΗΜΙΧΡΟΝΟ",
	                    children: [
                            {key:"HMI_1", label:"HMI 1-1", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber},
                            {key:"HMI_X", label:"HMI 1-X", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber},
                            {key:"HMI_2", label:"HMI 1-2", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber}
                        ]
                },
                {label:"ΗΜΙΧΡΟΝΟ-ΤΕΛΙΚΟ",
	                    children: [
                            {key:"HT_11", label:"HT 1-1", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"HT_1X", label:"HT 1-X", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"HT_12", label:"HT 1-2", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"HT_X1", label:"HT X-1", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"HT_XX", label:"HT X-X", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"HT_X2", label:"HT X-2", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"HT_21", label:"HT 2-1", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"HT_2X", label:"HT 2-X", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber},
                            {key:"HT_22", label:"HT 2-2", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber}
                        ]
                },
                {label:"ΣΥΝΟΛΟ ΤΕΡΜΑΤΩΝ",
	                    children: [
                            {key:"TG_01", label:"TG 0-1", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber},
                            {key:"TG_23", label:"TG 2-3", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber},
                            {key:"TG_46", label:"TG 4-6", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber},
                            {key:"TG_7", label:"TG 7+", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomformatNumber}
                        ]
                }
                */
            ];


            var myDataSourceCompare = new YAHOO.util.DataSource("../includes/dataproxy.php?");
            myDataSourceCompare.responseType = YAHOO.util.DataSource.TYPE_JSON;
            myDataSourceCompare.connXhrMode = "queueRequests";




            myDataSourceCompare.responseSchema = {
                resultsList: "DataSet.items",
                // Use the parse methods to populate the RecordSet with the right data types
               fields: [
                    {key:"AA", parser:"string"},
                    {key:"id_s", parser:"string"},
                    {key:"CouponID", parser:"number"},
					{key:"CountryID", parser:"string"},
					{key:"ChapionshipID", parser:"string"},

                    {key:"Time", parser:"string"},

                    {key:"IsoDate",parser:function (oDate){

                            return parseSQLDate(oDate,2);

                    }},
                    {key:"Code", parser:"number"},
                    {key:"EE", parser:"number"},
                    {key:"Goal_1", parser:"number"},
                    {key:"HomeTeamID", parser:"string"},
                    {key:"Goal_x", parser:"number"},
                    {key:"HostTeamID", parser:"string"},
                    {key:"Goal_2", parser:"number"},
                    //{key:"de_1ORX",parser:"number"},
                    //{key:"de_XOR2",parser:"number"},
                    //{key:"de_1OR2",parser:"number"},
                    {key:"Under",parser:"number"},
                    {key:"Over",parser:"number"},
                    {key:"GG",parser:"number"},
                    {key:"NG",parser:"number"}
                    /*
                    {key:"HMI_1", parser:"number"},
                    {key:"HMI_X", parser:"number"},
                    {key:"HMI_2", parser:"number"},
                    {key:"HT_11", parser:"number"},
                    {key:"HT_1X", parser:"number"},
                    {key:"HT_12", parser:"number"},
                    {key:"HT_X1", parser:"number"},
                    {key:"HT_XX", parser:"number"},
                    {key:"HT_X2", parser:"number"},
                    {key:"HT_21", parser:"number"},
                    {key:"HT_2X", parser:"number"},
                    {key:"HT_22", parser:"number"},
                    {key:"SS_10", parser:"number"},
                    {key:"SS_20", parser:"number"},
                    {key:"SS_21", parser:"number"},
                    {key:"SS_30", parser:"number"},
                    {key:"SS_31", parser:"number"},
                    {key:"SS_32", parser:"number"},
                    {key:"SS_40", parser:"number"},
                    {key:"SS_41", parser:"number"},
                    {key:"SS_42", parser:"number"},
                    {key:"SS_43", parser:"number"},
                    {key:"SS_00", parser:"number"},
                    {key:"SS_11", parser:"number"},
                    {key:"SS_22", parser:"number"},
                    {key:"SS_33", parser:"number"},
                    {key:"SS_01", parser:"number"},
                    {key:"SS_02", parser:"number"},
                    {key:"SS_12", parser:"number"},
                    {key:"SS_03", parser:"number"},
                    {key:"SS_13", parser:"number"},
                    {key:"SS_23", parser:"number"},
                    {key:"SS_04", parser:"number"},
                    {key:"SS_14", parser:"number"},
                    {key:"SS_24", parser:"number"},
                    {key:"SS_34", parser:"number"},
                    {key:"TG_01", parser:"number"},
                    {key:"TG_23", parser:"number"},
                    {key:"TG_46", parser:"number"},
                    {key:"TG_7", parser:"number"},

                    {key:"Published",parser:"number"},
                    {key:"Canceled",parser:"number"},
                    {key:"Showed", parser:"number"}
                    */

                ],
                metaFields: {totalRecords: "DataSet.totalRecords"} // Access server-provided dynamic value

            };

            var oConfigsCompare = {

                    dateOptions:{format:"%d/%m/%Y"},
                    selectionMode:"single",
                    numberOptions:{decimalPlaces:2, thousandsSeparator:","},
                    MSG_EMPTY:"Δεν υπάρχουν εγγραφές",
                    draggableColumns:false,
                    //initialRequest:"query=coupons&type=select&primaryKey=CouponID&whereID=CompareGoalBet",
                    initialRequest:"query=empty&type=select&whereID=CompareGoalBet",
                    formatRow: lineformatter
	        };

            compareGoalBetIntTable = new YAHOO.widget.DataTable("compareGoalBetIntTable", myColumnDefsCompare, myDataSourceCompare, oConfigsCompare  );

            var i=1,bReverseSorted = false;

            // Track when Column is reverse-sorted, since new data will come in out of order
            var trackReverseSorts = function(oArg) {
                bReverseSorted = (oArg.dir === YAHOO.widget.DataTable.CLASS_DESC);
            };



            // Set up editing flow
	        var highlightEditableCell = function(oArgs) {
	            var elCell = oArgs.target;
	            if(YAHOO.util.Dom.hasClass(elCell, "yui-dt-editable")) {
	                this.highlightCell(elCell);
	            }
	        };


            compareGoalBetIntTable.subscribe("cellMouseoverEvent", highlightEditableCell);
	        compareGoalBetIntTable.subscribe("cellMouseoutEvent", DataEdit.onEventUnhighlightCell);


            var myBuildUrl = function(datatable,record) {
                var url = '';
                var cols = datatable.getColumnSet().keys;
                for (var i = 0; i < cols.length; i++) {
                    if (cols[i].isPrimaryKey) {
                        url += '&id=' + escape(record.getData(cols[i].key));
                        url += '&primaryKey=' + cols[i].key;
                    }
                }

                return url;
            };







			compareGoalBetIntTable.subscribe('cellClickEvent',function(oArgs) {


                var target = oArgs.target;

                column = this.getColumn(target);
                record = this.getRecord(target);


                // do not edit empty records or records recieved from goalbetint
                get_id_s = record.getData(this.getColumn('id_s').key);
                if ( (get_id_s=='EMPTY') || (get_id_s=='GOALBETINT') )
                    return;


                compareGoalBetIntTable.onEventShowCellEditor(oArgs);
            })




      /* Start of change by Satyam to allow for keyboard navigation */

      	   compareGoalBetIntTable.subscribe("editorKeydownEvent",function(oArgs) {
 			var self = this,
				ed = this._oCellEditor,  // Should be: oArgs.editor, see: http://yuilibrary.com/projects/yui2/ticket/2513909
				ev = oArgs.event,
				KEY = YAHOO.util.KeyListener.KEY,
				Textbox = YAHOO.widget.TextboxCellEditor,
				Textarea = YAHOO.widget.TextareaCellEditor,
				cell = ed.getTdEl(),
				col = ed.getColumn(),
				row,rec,

				editNext = function(cell) {
					cell = self.getNextTdEl(cell);
					while (cell && !self.getColumn(cell).editor) {
						cell = self.getNextTdEl(cell);
					}
					if (cell) {
						self.showCellEditor(cell);
					}
				},
				editPrevious = function(cell) {
					cell = self.getPreviousTdEl(cell);
					while (cell && !self.getColumn(cell).editor) {
						cell = self.getPreviousTdEl(cell);
					}
					if (cell) {
						self.showCellEditor(cell);
					}
				};

			switch (ev.keyCode) {
				case KEY.UP:
					if (ed instanceof Textarea) { return; }
					YAHOO.util.Event.stopEvent(ev);
					ed.save();
					row = this.getPreviousTrEl(cell);
					if (row) {
						rec = this.getRecord(row);
						this.showCellEditor({record:rec,column:col});
					}
					break;
				case KEY.DOWN:
					if (ed instanceof Textarea) { return; }
					YAHOO.util.Event.stopEvent(ev);
					ed.save();
					row = this.getNextTrEl(cell);
					if (row) {
						rec = this.getRecord(row);
						this.showCellEditor({record:rec,column:col});
					}
					break;
				case KEY.LEFT:
					if (ed instanceof Textbox || ed instanceof Textarea) { return; }
					YAHOO.util.Event.stopEvent(ev);
					ed.save();
					editPrevious(cell);
					break;
				case KEY.RIGHT:
					if (ed instanceof Textbox || ed instanceof Textarea) { return; }
					YAHOO.util.Event.stopEvent(ev);
					ed.save();
					editNext(cell);
					break;
				case KEY.TAB:
					YAHOO.util.Event.stopEvent(ev);
					ed.save();
					if (ev.shiftKey) {
						editPrevious(cell);
					} else {
						editNext(cell);
					}
					break;
			}
		});

		// End of key handling

		// The following code tries to keep the cell editor visible at all times.

		compareGoalBetIntTable.on('editorShowEvent', function (oArgs) {
			var Dom = YAHOO.util.Dom;
			var el = oArgs.editor.getContainerEl();
			var reg = Dom.getRegion(el);
			var topScreen = Dom.getDocumentScrollTop(),
				bottomScreen = topScreen + Dom.getViewportHeight();
			if (reg.top < topScreen) {
				el.scrollIntoView();
			}
			if (reg.bottom > bottomScreen) {
				el.scrollIntoView(false);
			}
		});

		// End of patch.

       compareGoalBetIntTable.subscribe("editorSaveEvent", function(oArgs){

				var MAX_VALUE_ALERT = 15;
                var oEditor = oArgs.editor;
                var newData;
                var oldData = oArgs.oldData;
    			var elCell = oEditor.cell;
		        var oRecord = oEditor.getRecord();
           		var oColumn = oEditor.getColumn();
                var value = oRecord.getData(oColumn.key);
                var oTeamCol,query;
                var msg;



                newData = trimNumber(oArgs.newData);
                msg="";
                this.updateCell ( oRecord , oColumn , newData );
                compareGoalBetIntTable.set("sortedBy", null);



				//no characters allowed to the following fields
		        if (  (oColumn.key == "de_1ORX")  || (oColumn.key == "de_XOR2")  || (oColumn.key == "de_1OR2") ||
					  (oColumn.key == "Under")  || (oColumn.key == "Over")  || (oColumn.key == "GG") ||
					  (oColumn.key == "NG")  || (oColumn.key == "Code")  ) {


						if ( isNaN(newData) ) {
							this.updateCell ( oRecord , oColumn , oldData );
                            return;
                        }

     					if (newData==''){
                        	this.updateCell ( oRecord , oColumn , oldData );
                            return;
                        }


						//Max_Value_Alert does not affect Code field
						var FloatValue = parseFloat(newData);
						if ( ( FloatValue > MAX_VALUE_ALERT ) && (oColumn.key != "Code") )
							msg = 'Προσοχή ! Η τιμή που δώσατε στη στήλη <b>' + oColumn.label + '</b> είναι πολύ μεγάλη.<br><br>';





	        	}



				//the first time the Olddata=0, so check these fields outside the  if(oldData != newData)
				if (  (oColumn.key == "Goal_1")  || (oColumn.key == "Goal_2")  || (oColumn.key == "Goal_x")) {

     					if (newData==''){
                        	this.updateCell ( oRecord , oColumn , oldData);
                            return;
                        }

				}



                if(oldData != newData)
                {


					//set all other values
					if (  (oColumn.key == "Goal_1")  || (oColumn.key == "Goal_2")  || (oColumn.key == "Goal_x")) {


						if ( isNaN(newData) ) {

								this.updateCell ( oRecord , oColumn , oldData );
                                return;

						}

						if ( isNaN(newData) ) {

								this.updateCell ( oRecord , oColumn , oldData );
                                return;

						}

                        ;
						var FloatValue = parseFloat(newData);
						if ( FloatValue > MAX_VALUE_ALERT )
							msg = 'Προσοχή ! Η τιμή που δώσατε στη στήλη <b>' + oColumn.label + '</b> είναι πολύ μεγάλη.<br><br>';



						if ( (oColumn.key == "Goal_1") && ( ( (oRecord.getData(this.getColumn('Goal_2').key)) == 0) || ( (oRecord.getData(this.getColumn('Goal_x').key)) == 0) ) )
							return;

						if ( (oColumn.key == "Goal_2") && ( ( (oRecord.getData(this.getColumn('Goal_1').key)) == 0) || ( (oRecord.getData(this.getColumn('Goal_x').key)) == 0) ) )
							return;

						if ( (oColumn.key == "Goal_x") && ( ( (oRecord.getData(this.getColumn('Goal_2').key)) == 0) || ( (oRecord.getData(this.getColumn('Goal_1').key)) == 0) ) )
							return;


                        var compute;
                        var SetCol = this.getColumn('de_1ORX');
                        compute = ( eval(oRecord.getData(this.getColumn('Goal_1').key))*eval(oRecord.getData(this.getColumn('Goal_x').key)) ) / ( eval(oRecord.getData(this.getColumn('Goal_1').key))+eval(oRecord.getData(this.getColumn('Goal_x').key)) );

                        if (compute <= 1)
                            compute = 1.05;
                        var de_1=compute;
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2));

                        SetCol = this.getColumn('de_XOR2');
                        compute = ( eval(oRecord.getData(this.getColumn('Goal_x').key))*eval(oRecord.getData(this.getColumn('Goal_2').key)) ) / ( eval(oRecord.getData(this.getColumn('Goal_x').key))+eval(oRecord.getData(this.getColumn('Goal_2').key)) );

                        if (compute <= 1)
                            compute = 1.05;
                        var de_2=compute;
                        this.updateCell ( oRecord , SetCol ,compute.toFixed(2) );

                        SetCol = this.getColumn('de_1OR2');
                        compute = ( eval(oRecord.getData(this.getColumn('Goal_1').key))*eval(oRecord.getData(this.getColumn('Goal_2').key)) ) / ( eval(oRecord.getData(this.getColumn('Goal_1').key))+eval(oRecord.getData(this.getColumn('Goal_2').key)) );
                        var de_3=compute;
                        if (compute <= 1)
                            compute = 1.05;
                        var de_3=compute;
                        this.updateCell ( oRecord , SetCol , compute.toFixed(2) );



                        var G1_odd=eval(oRecord.getData(this.getColumn('Goal_1').key));
                        compute=-0.0049*(G1_odd*G1_odd*G1_odd*G1_odd)+0.1075*(G1_odd*G1_odd*G1_odd)-0.8415*(G1_odd*G1_odd)+3.3316*G1_odd-1.5819;
                        if (compute < 0)
                            compute = 0;
                        var HMI_1=compute;
                        SetCol = this.getColumn('HMI_1');
                        //this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        var Gx_odd=eval(oRecord.getData(this.getColumn('Goal_x').key));
                        compute = -0.013*(Gx_odd*Gx_odd)+0.5081*Gx_odd+0.3954;
                        if (compute < 0)
                            compute = 0;
                        var HMI_X=compute;
                        SetCol = this.getColumn('HMI_X');
                        //this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        var G2_odd=eval(oRecord.getData(this.getColumn('Goal_2').key));
                        compute = 0.0035*(G2_odd*G2_odd*G2_odd)-0.0834*(G2_odd*G2_odd)+1.3085*G2_odd+0.09;
                        if (compute < 0)
                            compute = 0;
                        var HMI_2=compute;
                        SetCol = this.getColumn('HMI_2');
                        //this.updateCell ( oRecord , SetCol , compute.toFixed(2) );

                        //ajaxLoadingPanel.show();
                        //query = '../includes/dataproxy.php?query=coupons&type=update&column=edit_de&de_1ORX='+de_1+'&de_XOR2='+de_2+'&de_1OR2='+de_3+'&HMI_1='+HMI_1+'&HMI_X='+HMI_X+'&HMI_2='+HMI_2;
                        query = '../includes/dataproxy.php?query=coupons&type=update&column=edit_de&de_1ORX='+de_1+'&de_XOR2='+de_2+'&de_1OR2='+de_3;
                        YAHOO.util.Connect.asyncRequest('GET', query + myBuildUrl(this,oRecord), {
                                   success: function(o) {

                                                //ajaxLoadingPanel.hide();

                                   },
                                  failure: function(o) {
                                         alert('Παρουσιάστηκε κάποιο σφάλμα. Οι αλλαγές δεν αποθηκεύτηκαν.');
                                         //ajaxLoadingPanel.hide();
                                  },
                                  scope: this
                     }  );

                    }



                    if ( (oColumn.key == "CountryID") || (oColumn.key == "ChapionshipID") || (oColumn.key == "CouponID") ||
                         (oColumn.key == "Code") || (oColumn.key == "EE") || (oColumn.key == "Goal_1") ||
                          (oColumn.key == "HomeTeamID") || (oColumn.key == "Goal_x") || (oColumn.key == "HostTeamID") ||
                          (oColumn.key == "Goal_2") || (oColumn.key == "de_1ORX") || (oColumn.key == "de_XOR2") ||
                          (oColumn.key == "de_1OR2") || (oColumn.key == "Under") || (oColumn.key == "Over") ||
                          (oColumn.key == "GG") || (oColumn.key == "NG") )
                          qnewval =   "&newvalue=" + value;
                    else
                          qnewval =   "&newvalue=@" + value;




                   query = '../includes/dataproxy.php?query=coupons&type=update&column='


                    YAHOO.util.Connect.asyncRequest('GET', query + oColumn.key + qnewval + myBuildUrl(this,oRecord), {
                                   success: function(o) {

                                                try {

                                                    var r = YAHOO.lang.JSON.parse(o.responseText);
                                                }
                                                catch (x) {

                                                    alert("JSON Parse failed!");
                                                    return;
                                                }
                                                 //debug
                                                //alert(YAHOO.lang.dump(r));


                                                if (msg != '')
                                                    YAHOO.example.alert( msg );




                                  },
                                  failure: function(o) {
                                         alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή σας δεν αποθηκεύτηκε.');
                                  },
                                  scope: this
                     }  );






                }





             });

	        myTabView.getTab(1).addListener("click", function() {compareGoalBetIntTable.onShow()})


             return {
                oDS: myDataSourceCompare,
                oDT: compareGoalBetIntTable,
                oTV: myTabView
            };


        }();

})


/*****************************************************************************************/







    </script>







    <!--END SOURCE CODE FOR EXAMPLE =============================== -->

    <script type="text/javascript">
        //*****************************************************
        //Patch for sorting
        //http://yuilibrary.com/projects/yui2/ticket/2527707
        //*****************************************************
        YAHOO.widget.DataTable.prototype.getTdEl = function(cell) {

        var Dom = YAHOO.util.Dom,

        lang = YAHOO.lang,
        elCell,
        el = Dom.get(cell);

        // Validate HTML element
        if(el && (el.ownerDocument == document)) {

        // Validate TD element
        if(el.nodeName.toLowerCase() != "td") {

        // Traverse up the DOM to find the corresponding TR element
        elCell = Dom.getAncestorByTagName(el, "td");

        }
        else {

        elCell = el;

        }

        // Make sure the TD is in this TBODY
        if(elCell && (elCell.parentNode.parentNode == this._elTbody)) {

        // Now we can return the TD element
        return elCell;

        }

        }
        else if(cell) {

        var oRecord, nColKeyIndex;

        if(lang.isString(cell.columnKey) && lang.isString(cell.recordId)) {

        oRecord = this.getRecord(cell.recordId);
        var oColumn = this.getColumn(cell.columnKey);
        if(oColumn) {

        nColKeyIndex = oColumn.getKeyIndex();

        }

        }
        if(cell.record && cell.column && cell.column.getKeyIndex) {

        oRecord = cell.record;
        nColKeyIndex = cell.column.getKeyIndex();

        }
        var elRow = this.getTrEl(oRecord);
        if((nColKeyIndex !== null) && elRow && elRow.cells && elRow.cells.length > 0) {

        return elRow.cells[nColKeyIndex] || null;

        }

        }

        return null;

        };
    </script>


   <script type="text/javascript">

function trimNumber(s) {
  while (s.substr(0,1) == '0' && s.length>1) { s = s.substr(1,9999); }
  return s;
}

/*
   var optionsChapionshipID;
   var optionsCountryID;
   
   optionsChapionshipID='';
   optionsCountryID='';

    <?
 
        $chapionships = '';
        $countries = '';
  
        $myDB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
	    mysql_select_db(DataBase, $myDB) or die(mysql_error());
		$query_result = mysql_query("select * from countries order by Country Asc");
	    while ($row = mysql_fetch_assoc($query_result)) {

         $query_result2 = mysql_query("select * from chapionships where CountryID=".$row['CountryID']." order by Chapionship Asc");
         if (mysql_num_rows ($query_result2) > 0) {
             $countries = $countries.'{"label":"'.$row['Country'].'","value":"'.$row['CountryID'].'"},';


           while ($row2 = mysql_fetch_assoc($query_result2)) {
                  $chapionships = $chapionships.'{"label":"'.$row2['Chapionship'].'","value":"'.$row2['ChapionshipID'].'"},';
                

            }
         }
		}
		mysql_close($myDB);
		$temp_Counties = substr($countries, 0, -1);
		$temp_chapionships = substr($chapionships, 0, -1);
		$countries = '['.$temp_Counties.']';
		$chapionships = '['.$temp_chapionships.']';

	  ?>

        optionsChapionshipID = <? echo $chapionships; ?>;
		optionsCountryID =  <? echo $countries; ?>;
    */
</script>



    </TD>
  </TR>
  <TR>
    <TD class=footerback colSpan=2>
         <?php include '../includes/footer.php' ?>
    </TD>
  </TR>
</TBODY>
</TABLE>
</div>

</BODY>
</HTML>
