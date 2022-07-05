<?php
    session_start();
    include '../includes/database.php';
    include '../includes/login.php';
    include '../includes/statistics.php';


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
<script type="text/javascript" src="../build/container/container-min.js"></script>
<script type="text/javascript" src="../build/connection/connection-min.js"></script>
<script type="text/javascript" src="../build/json/json-min.js"></script>
<script type="text/javascript" src="../build/calendar/calendar-min.js"></script>



<!--begin custom header content for this example-->
<style type="text/css">

/* Remove row striping, column borders, and sort highlighting */
.yui-skin-sam tr.yui-dt-odd
{
  background-color: #FFEFC6;

}

.yui-skin-sam tr.yui-dt-odd td.yui-dt-asc,
.yui-skin-sam tr.yui-dt-odd td.yui-dt-desc,
.yui-skin-sam tr.yui-dt-even td.yui-dt-asc,
.yui-skin-sam tr.yui-dt-even td.yui-dt-desc {
    background-color: #AfAfAf;

}
.yui-skin-sam .yui-dt tbody td {
    border-bottom: 1px solid #7f7f7f;
    /* border-left: 1px solid #7f7f7f; */
}

.yui-skin-sam .yui-dt thead th {
    border-bottom: 0px solid #7f7f7f;
}



.yui-skin-sam .yui-dt tr.yui-dt-last td,
.yui-skin-sam .yui-dt th,
.yui-skin-sam .yui-dt td {
    border-bottom: 0px solid #7f7f7f;
    text-align: center;
    height: 30px;
}



/* custom styles for this example */
.yui-skin-sam .yui-dt-body { cursor:pointer; } /* when cells are selectable */
#cellrange, #singlecell { margin-top:2em; }


.yui-skin-sam .yui-dt td.MaxFormatter {
    background-color: #EFFFB7;
    Color:black;

}

/*custom columns */
.yui-skin-sam .yui-dt td.ee1 {
    background-color: #FF0000;
    Color:white;
}
.yui-skin-sam .yui-dt td.ee2 {
    background-color: #FF8040;
    Color:white;
}
.yui-skin-sam .yui-dt td.ee3 {
    background-color: #00CC00;
    Color:white;
}

.yui-skin-sam .yui-dt td.ee4 {
    background-color: #000099;
    Color:white;
}

 .yui-skin-sam .yui-dt td.ee5 {
    background-color: #CCCC66;
    Color:white;
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






.yui-button#pushbuttonFindRec button {

    padding-left: 3em;
    background: url(../grafix/add.gif) 10% 50% no-repeat;


}
/*
#paginated {
    text-align: center;
}
#paginated table {
    margin-left:auto; margin-right:auto;
}
*/


.calweekdaycell {
  background: #FFD700
}


/*custom columns */
.yui-skin-sam .yui-dt td.win {
    background-color: #339900;
    Color:white;
}
.yui-skin-sam .yui-dt td.lost {

    background-color: #FF0000;
    Color:white;
}

.yui-button#pushbuttonFind button {

    padding-left: 3em;
    background: url(../grafix/search.png) 10% 50% no-repeat;


}

</style>

</HEAD>


<BODY class="yui-skin-sam" oncontextmenu="return false">

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
    <TD bgcolor="#CCCC99" style="FONT-SIZE:14px" colSpan=2  height="25px" align="center">
                <strong>Κάλυψη</strong>
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
                        <li class="selected"><a href="#tab1"><em>Κάλυψη</em></a></li>

                    </ul>
                    <div class="yui-content">
                      <br><br>
                      <b>Χρονικό διάστημα</b><br>
   				      <hr width="100%" style="Color:red;"></hr>
                      <Table width=240px>
                      <tr>
                        <td align=center>
                                          <script type="text/javascript">


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

                                          			var oButton = new YAHOO.widget.Button({
                                          											type: "menu",
                                          											id: "calendarpicker",
                                          											label: "<?php echo date('j-n-Y'); ?>",
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

											        Dom.get("month").selectedIndex = <?php echo date('m')-1; ?>;
                                          			Dom.get("day").selectedIndex = <?php echo date('d')-1; ?>;
                                          			Dom.get("year").value = <?php echo date('Y'); ?>;;

                                          		});

                                          	}());

                                          </script>

                                               Ημερομηνία από
                                               <br><br>
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



                                    			<input type="text" id="year" name="year" value="">

                                            </div>
                      </td>
                      <td align=center>
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
                                        		oCalendarView.cfg.setProperty("MONTHS_LONG",    ["Ιανουάριος", "Φεβρουάριος", "Μάρτιος", "Απρίλιος", "Μάϊος", "Ιούνιος", "Ιούλιος", "Αύγουστος", "Σεπτέμβριος", "Οκτώβριος", "Νοέμβριος", "Δεκέμβριος"]);
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
                        Ημερομηνία έως
                        <br><br>
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

                        <input type="text" id="toyear" name="toyear" value="">
                      </div>
                      </td>
                      </tr>
                      </table>
                      <br><br>
                      <table>
                       <tr>
                       <td width=10px>
                       </td>
                       <td>
                       <span id="pushbuttonFind" class="yui-button yui-push-button">
                        <strong class="first-child">
                          <button type="button" name="pushbuttonFind">Αναζήτηση</button>
                        </strong>
                        </span>
                        </td>
                        </tr>
                       </table>
    				   <hr width="100%" style="Color:red;"></hr>
                       <br><br>




                        <table  width=400px>
                        <tr>
                            <td width=200px style="background-color:#BFD5FF; Color:#333333;font-weight: bold;font-size: 12px;height: 30px;" align=center>
                                Σύνολο κόστους δελτίων
                            </td>
                            <td style="background-color:#FF6600;Color:#FFFFFF;font-weight: bold;font-size: 12px;;padding-left: 10px">
                               <div id="Cost">€ 0.0</div>
                            </td>
                        </tr>


                        <tr>
                            <td width=200px style="background-color:#BFD5FF; Color:#333333;font-weight: bold;font-size: 12px;height: 30px;" align=center>
                                Αρ. Δελτίων
                            </td>
                            <td style="background-color:#FF6600;Color:#FFFFFF;font-weight: bold;font-size: 12px;padding-left: 10px">
                               <div id="BetNum">0</div>
                            </td>
                        </tr>

                        </table>
                        <br><br>



                       <div align="left" id="paginated" ></div>

                         <br><br>


                        <div><p>





                        </p></div>
                    </div>
                </div>


            </TD>
        </TR>



        </Table>

        <div id="dialog1">
        <div class="hd">Λίστα στοιχημάτων</div>
        <div class="bd">
        <form method="GET" id="BetListForm" name="BetListForm">

                   <label for="Λιστ">Λίστα στοιχημάτων</label>
                   <br><br>
                   <div align=center>
                   <select id="BetList" name="BetList" size="18" style="width:15em">
                   </select>
                   <br><br>

                   <input type="button" name="Προβολή" value="Προβολή" onclick="var dropdownIndex = document.getElementById('BetList').selectedIndex;OpenWindow('showuserbet.php?idu='+document.getElementById('BetList')[dropdownIndex].value,'toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=0,width=860,height=700,left=0,top=0');">
                   </div>

            <br><br>

        </form>
        </div>
        </div>


      <Script type="text/javascript">

        var DataTable;
        var elDropDownAllOthers;

        function computeTotal() {


               var Cost = 0;
               var Counter = 0;


               if (DataTable.getRecordSet().getLength() < 1)
                  return;


               for(i=0;i<DataTable.getRecordSet().getLength();i++){


       			     	var recset = DataTable.getRecordSet().getRecord(i)._oData;


                        if (recset.Code == -1) {
                            Cost = Cost + recset.Bets;
                            Counter = Counter + recset.TotalBets;
                            DataTable.deleteRow(i);

                        }






               }

              YAHOO.util.Dom.get('Cost').innerHTML = '€'+Cost.toFixed(2);
              YAHOO.util.Dom.get('BetNum').innerHTML = Counter;




        }

            YAHOO.namespace("example.container");

          	// Instantiate the Dialog
          	YAHOO.example.container.dialog1 = new YAHOO.widget.Dialog("dialog1",
          							{ width : "16em",
          							  fixedcenter : true,
          							  visible : false,
          							  constraintoviewport : true,

          							});




          	// Render the Dialog
          	YAHOO.example.container.dialog1.render();

            function trim (str)
            {
                var i = str.length - 1;
                while ( i >= 0 && /\s/.test(str.charAt(i)) ) --i;


                return str.substring(0, i + 1);
            }

            function prepareBetList(recordID) {

              var listbox=document.BetListForm.BetList;
              var recID=0;

              for (var i=0;i<DataTable.getRecordSet().getLength();i++) {

                if (recordID == DataTable.getRecordSet().getRecord(i)._nCount) {

                    recID = i;

                }

              }

              var ListArray = DataTable.getRecordSet().getRecord(recID)._oData.BetList.split(',');



              // first, remove all what is in the listbox
               while (listbox.options.length!=0)
                  listbox.remove(0);

               // now, fill it !
               for (var m=0; m<ListArray.length; m++)
                  // if you conditionnaly fill the list, put the condition here (for exemple : if (my_array[m][1]>"whatever"))
               {
                   var oOption = document.createElement("OPTION");
                   oOption.text='Δελτίο - ' + trim(ListArray[m]);
                   oOption.value=trim(ListArray[m]);
                   listbox.options.add(oOption)
               }

               document.getElementById('BetList').selectedIndex = 0;


              YAHOO.example.container.dialog1.show();

            }


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
                width: '600px',
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




         function onFind(p_oEvent) {


                ajaxLoadingPanel.show();

                // Sends a request to the DataSource for more data
                var oUpdateTableCallBack = {
                    success :function (oRequest , oResponse , oPayload) {

                    				DataTable.onDataReturnReplaceRows(oRequest,oResponse,oPayload);
                    				ajaxLoadingPanel.hide();
                                    computeTotal();

                				},
                    failure :DataTable.onDataReturnReplaceRows,
                    scope   :DataTable,
                    argument: DataTable.getState()
                };

           	 var StartDate = YAHOO.util.Dom.get("year").value + '-' + YAHOO.util.Dom.get("month").value + '-' + YAHOO.util.Dom.get("day").value;
 			 var EndDate =  YAHOO.util.Dom.get("toyear").value + '-' + YAHOO.util.Dom.get("tomonth").value + '-' + YAHOO.util.Dom.get("today").value;
             var sqlquery ="query=covering&type=select&whereID=SQL|Date(DateTime) >=@" + StartDate + "@ AND Date(DateTime) <= @"+ EndDate +"@";
             DataTable.getDataSource().sendRequest(sqlquery, oUpdateTableCallBack);


         };

        var oPushButtonFind = new YAHOO.widget.Button("pushbuttonFind");
        oPushButtonFind.on("click", onFind);

        elDropDownAllOthers = new YAHOO.widget.DropdownCellEditor({dropdownOptions:[{"label":"- Προβολή -","value":"0"}], disableBtns:true});

          YAHOO.util.Event.addListener(window, "load", function() {
          YAHOO.example.paginated =  function() {

              var formatDesc = function(elCell, oRecord, oColumn, oData) {

					for (var i=0;i<elDropDownAllOthers.dropdownOptions.length;i++) {
						if ( elDropDownAllOthers.dropdownOptions[i].value == oData ) {
							elCell.innerHTML = elDropDownAllOthers.dropdownOptions[i].label;

							return;
						}

					}

              };
       /*
        YAHOO.widget.DataTable.formatCurrency = function(el, oRecord, oColumn, oData) {
                if(YAHOO.lang.isNumber(oData)) {
                    var nAmount = oData;
                    var markup;

                    // Round to the penny
                    nAmount = Math.round(nAmount*100)/100;

                    // Default currency is USD
                    markup = nAmount+"";    /////// changed to remove $

                    // Normalize digits
                    var dotIndex = markup.indexOf(".");
                    if(dotIndex < 0) {
                        markup += ".00";
                    }
                    else {
                        while(dotIndex > markup.length-3) {
                            markup += "0";
                        }
                    }
                    el.innerHTML = markup;
                }
                else {
                    el.innerHTML = YAHOO.lang.isValue(oData) ? oData : "";
                }
            };

            */
            var MaxFormatter = function(elCell, oRecord, oColumn, oData) {



                        YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "MaxFormatter");
                        //call the original formatter
                        YAHOO.widget.DataTable.formatCurrency.call(DataTable,elCell, oRecord, oColumn, oData);
                    



            };

            var FormatLink = function(elCell, oRecord, oColumn, oData) {



                    elCell.innerHTML = '<a onclick="prepareBetList('+oRecord._nCount+')" href="#">'+oData+'</a>';




            };

           var myColumnDefs = [

                {key:"Code", label:"ΚΩΔ.", formatter:YAHOO.widget.DataTable.formatNumber, sortable:true, sortOptions:{defaultDir:YAHOO.widget.DataTable.CLASS_DESC}},
                {key:"Event", label:"ΑΓΩΝΑΣ", sortable:true},
                {key:"TotalBets", label:"ΔΕΛΤΙΑ", formatter:FormatLink, sortable:true, width:40, sortOptions:{defaultDir:YAHOO.widget.DataTable.CLASS_DESC}},
                {key:"Bets", label:"ΜΕΓΙΣΤΟ", formatter:MaxFormatter, sortable:true, sortOptions:{defaultDir:YAHOO.widget.DataTable.CLASS_DESC}},
                {key:"Goal_1", label:"1", formatter:YAHOO.widget.DataTable.formatCurrency, sortable:true, sortOptions:{defaultDir:YAHOO.widget.DataTable.CLASS_DESC}},
                {key:"Goal_x", label:"X", formatter:YAHOO.widget.DataTable.formatCurrency, sortable:true, sortOptions:{defaultDir:YAHOO.widget.DataTable.CLASS_DESC}},
                {key:"Goal_2", label:"2", formatter:YAHOO.widget.DataTable.formatCurrency, sortable:true, sortOptions:{defaultDir:YAHOO.widget.DataTable.CLASS_DESC}},
                {key:"Under", label:"U<2.5", formatter:YAHOO.widget.DataTable.formatCurrency, sortable:true, sortOptions:{defaultDir:YAHOO.widget.DataTable.CLASS_DESC}},
                {key:"Over", label:"O>2.5", formatter:YAHOO.widget.DataTable.formatCurrency, sortable:true, sortOptions:{defaultDir:YAHOO.widget.DataTable.CLASS_DESC}},
                {key:"GG", label:"GG", formatter:YAHOO.widget.DataTable.formatCurrency, sortable:true, sortOptions:{defaultDir:YAHOO.widget.DataTable.CLASS_DESC}},
                {key:"NG", label:"NG", formatter:YAHOO.widget.DataTable.formatCurrency, sortable:true, sortOptions:{defaultDir:YAHOO.widget.DataTable.CLASS_DESC}},
                {key:"AllOthers_Local", label:"Όλα Φθίνουσα",  formatter:formatDesc, editor : elDropDownAllOthers}


            ];


            var  myDataSource = new YAHOO.util.XHRDataSource("../includes/dataproxy.php?");
            myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSON;
            myDataSource.connXhrMode = "queueRequests";



            myDataSource.responseSchema = {
                resultsList: "DataSet.items",
                fields: [
                    {key:"Code",parser:"number"},
                    {key:"TotalBets",parser:"number"},
                    {key:"BetList",parser:"string"},
                    {key:"Event",parser:"string"},
                    {key:"Bets",parser:"number"},
                    {key:"Goal_1",parser:"number"},
                    {key:"Goal_x",parser:"number"},
                    {key:"Goal_2",parser:"number"},
                    {key:"Under",parser:"number"},
                    {key:"Over",parser:"number"},
                    {key:"GG",parser:"number"},
                    {key:"NG",parser:"number"},
                    {key:"AllOthers",parser:"string"},
                    {key:"AllOthers_Local",parser:"string"}
                 ],
                metaFields: {totalRecords: "DataSet.totalRecords"} // Access server-provided dynamic value

            };

           	StartDate = "<?php echo date('Y'); ?>-<?php echo date('m'); ?>-<?php echo date('d'); ?>";
			EndDate =   "<?php echo date('Y'); ?>-<?php echo date('m'); ?>-<?php echo date('d'); ?>";


            var oConfigs = {

                   //sortedBy:{key:"ID",dir:"asc"},

                    dateOptions:{format:"%d/%m/%Y"},
                    selectionMode:"single",
                    numberOptions:{decimalPlaces:0},
                    MSG_EMPTY:"Δεν υπάρχουν εγγραφές",
                    draggableColumns:true,
                    currencyOptions:{prefix: "€", decimalPlaces:2, decimalSeparator:".", thousandsSeparator:","},
                    initialRequest:"query=covering&type=select&whereID=SQL|Date(DateTime) >=@" + StartDate + "@ AND Date(DateTime) <= @"+ EndDate +"@",
	        };



            DataTable = new YAHOO.widget.DataTable("paginated", myColumnDefs, myDataSource, oConfigs  );

            DataTable.subscribe("initEvent",function() {


               computeTotal();



             });

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


            DataTable.subscribe("cellMouseoverEvent", highlightEditableCell);
	        DataTable.subscribe("cellMouseoutEvent", DataTable.onEventUnhighlightCell);
            DataTable.subscribe("cellClickEvent", DataTable.onEventShowCellEditor);

            DataTable.doBeforeShowCellEditor = function(oCellEditor) {


                var oEditor = oCellEditor;
  		        var oRecord = oEditor.getRecord();
                var valueAllOthers =  DataTable.getRecordSet().getRecord(oRecord)._oData.AllOthers;


                if (oEditor == elDropDownAllOthers) {


                    var r = YAHOO.lang.JSON.parse( valueAllOthers );
                    oEditor.dropdownOptions = r;
                    oEditor.setOptions();
                }


                return true;
             }




            var myTabView = new YAHOO.widget.TabView("tvcontainer");
	        myTabView.getTab(0).addListener("click", function() {DataTable.onShow()})


            return {
             oDS: myDataSource,
             oDT: DataTable,
             oTV: myTabView
             };


        }();
});


    </script>

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

	function OpenWindow(name,features) {

		  win = window.open(name,'mywindow',features);
          win.window.focus();

		}
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
