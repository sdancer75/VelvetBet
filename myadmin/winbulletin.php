<?php
    session_start();
    include '../includes/database.php';
    include '../includes/login.php';
    include '../includes/statistics.php';


     $LoginMsg = '';
     $DB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
     mysql_select_db(DataBase, $DB) or die(mysql_error());

    if (!check_login('masterusers') )
        header( 'Location: ../index.php' );

    mysql_close($DB);


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HEAD>
<HTML xmlns="http://www.w3.org/1999/xhtml">
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





<!--begin custom header content for this example-->
<style type="text/css">

/* Remove row striping, column borders, and sort highlighting */
.yui-skin-sam tr.yui-dt-odd
{
  background-color: #FFEFC6;

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

.yui-skin-sam .yui-dt td.DirtyYes {


    background-color: #F76966;
    Color:white;

}

.yui-skin-sam .yui-dt td.DirtyNo {
     background-color: #C4FFC4;
    Color:black;

}

.yui-skin-sam .yui-dt td.YESNO {
    background-color: #E8F8FF;
    Color:black;

}

.yui-skin-sam .yui-dt td.YES {
    background-color: #F76966;
    Color:black;

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


.yui-button#pushbuttonAddLocalRec button {

    padding-left: 3em;
    background: url(../grafix/add.gif) 10% 50% no-repeat;


}

.yui-button#pushbuttonAddRec button {

    padding-left: 3em;
    background: url(../grafix/add.gif) 10% 50% no-repeat;


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

.yui-button#pushbuttonShowBulletin button {

    padding-left: 4em;
    background: url(../grafix/list.png) 10% 50% no-repeat;


}


.calweekdaycell {
  background: #FFD700
}


.delete-button {
	cursor:pointer;
	background: #FFFFCC url(../grafix/delete.png) no-repeat center center;
	width:16px;height:16px;
}

.compute-button {
	cursor:pointer;
	background: transparent url(../grafix/calculator_edit.png) no-repeat center center;
	width:16px;height:16px;
}

.yui-button#pushbuttonComputeRec button {

    padding-left: 3em;
    background: url(../grafix/calculator_edit.png) 10% 50% no-repeat;


}


/*
#paginated {
    text-align: center;
}
#paginated table {
    margin-left:auto; margin-right:auto;
}
*/



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
    <TD bgcolor="#CCCC99" style="FONT-SIZE:14px" colSpan=2  height="25px" align="center">
                <strong>Διαχείριση νικήτριας στήλης</strong>
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
                        <li class="selected"><a href="#tab1"><em>Προβολή εγγραφών</em></a></li>
                    </ul>
                    <div class="yui-content">

                          <table>
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


                                                                // Sends a request to the DataSource for more data
                                                                var oUpdateTableCallBack = {
                                                                    success :AddDataTable.onDataReturnReplaceRows,
                                                                    failure :AddDataTable.onDataReturnReplaceRows,
                                                                    scope   : AddDataTable
                                                                };

                                                               var sqlquery = "query=coupons&type=select&primaryKey=CouponID&cascade=yes&whereID=" + nYear + "-" + nMonth + "-" + nDay;
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
                                    Νικήτρια στήλη της
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

                                    <span id="pushbuttonShowBulletin" class="yui-button yui-push-button">
                                         <strong class="first-child">
                                          <button type="button" name="pushbuttonShowBulletin">Λίστα τελευταίας αποδελτίωσης</button>
                                         </strong>
                                    </span>



                                    <br><br>
                                    <div id="paginated" align="center"></div>
                                    <br><br>


                              </td>
                          </tr>
                          </table>






                    </div>
                </div>


            </TD>
        </TR>



        </Table>



        <Script type="text/javascript">

        var oDateShow;
		var AddDataTable;
        var Published;


      	function OpenWindow(name,features) {

      		  win = window.open(name,'_blank',features);
              win.window.focus();

      	}

        var myTabView = new YAHOO.widget.TabView("tvcontainer");


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







         var AjaxObject = {
        	handleSuccess:function(o){
        		// This member handles the success response
        		// and passes the response object o to AjaxObject's
        		// processResult member.




				if (o.argument == ''){

                    ajaxLoadingPanel.hide();


   				}
        	},

        	handleFailure:function(o){
        		alert('Παρουσιάστηκε κάποιο σφάλμα. Η διαδικασία δεν ολοκληρώθηκε.');
        	},



        	startRequest:function(query,status) {

               //MySQL>START TRANSACTION and COMMIT; or ROLLBACK;
               callback.argument = status;
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
        	scope: AjaxObject,
            argument : Status = ''
        };

        function onComputecoupons(p_oEvent) {


            //ajaxLoadingPanel.show();
            for(i=0;i<=AddDataTable.getRecordSet().getLength()-1;i++){

				var recset = AddDataTable.getRecordSet().getRecord(i)._oData;


                // Start the transaction.
				//AjaxObject.startRequest('query=coupons&primaryKey=CouponID&type=update',Status);


            }

        }




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

           var sqlquery = "query=coupons&type=select&primaryKey=CouponID&cascade=yes&whereID=" + oDateShow;
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

           var sqlquery = "query=coupons&type=select&primaryKey=CouponID&cascade=yes&whereID=" + oDateShow;
           AddDataTable.getDataSource().sendRequest(sqlquery, oUpdateTableCallBack);




        }

        function onShowBulletin(p_oEvent) {


            OpenWindow('indexedreport.php','toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=0,width=1220,height=600,left=0,top=0')

        }



        var oPushBbuttonNextCoupon = new YAHOO.widget.Button("pushbuttonNextCoupon");
        oPushBbuttonNextCoupon.on("click", onNextDayMatch);

        var oPushBbuttonPrevCoupon = new YAHOO.widget.Button("pushbuttonPrevCoupon");
        oPushBbuttonPrevCoupon.on("click", onPrevDayMatch);


        var oPushShowBulletin = new YAHOO.widget.Button("pushbuttonShowBulletin");
        oPushShowBulletin.on("click", onShowBulletin);





         YAHOO.util.Event.addListener(window, "load", function() {
         YAHOO.example.CouponView =  function() {
         var Dom = YAHOO.util.Dom;





           var CustomGoalFormatter = function(elCell, oRecord, oColumn, oData) {


                    if(oColumn.field == "HalfTimeScore"){
                        YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "goal");
                        var value = oRecord.getData("HalfTimeScore");
                        elCell.innerHTML = value;
                    }
                    else if(oColumn.field == "FullTimeScore"){
                        YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "goal");
                        var value = oRecord.getData("FullTimeScore");
                        elCell.innerHTML = value;
                    }


           };



            var myTimeFormatter = function(elCell, oRecord, oColumn, oData) {

                    YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "time");
                    var timerec=oRecord.getData("Time");
                    //check if time keeps the seconds. We dont need them so, make them dissappear.
                    if (timerec.length > 5) {


                         timerec=timerec.substring(0, 5);


                    }
                    elCell.innerHTML = timerec;

            };

            var DirtyFormatter = function(elCell, oRecord, oColumn, oData) {


                    var dirtyrec=oRecord.getData("Dirty");
                    var IndexedRec=oRecord.getData("Indexed");
                    //check if time keeps the seconds. We dont need them so, make them dissappear.
                    if ( dirtyrec == 0 )  {

                         YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "DirtyNo");
                         YAHOO.util.Dom.replaceClass(elCell.parentNode, "DirtyYes", "DirtyNo");
                         elCell.innerHTML = "ΟΚ";


                    } else {

                         YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "DirtyYes");
                         YAHOO.util.Dom.replaceClass(elCell.parentNode, "DirtyNo", "DirtyYes");
                         elCell.innerHTML = "ΕΠΑΝΑΥΠΟΛΟΓΙΣΤΕ";

                    }


            };

            var YESNOFormatter = function(elCell, oRecord, oColumn, oData) {


                    var Indexedrec=oRecord.getData("Indexed");
                    //check if time keeps the seconds. We dont need them so, make them dissappear.
                    if ( Indexedrec == 0 ) {

                         YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "YESNO");

                         elCell.innerHTML = "ΟΧΙ";


                    } else {

                         YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "YES");

                         elCell.innerHTML = "ΝΑΙ";

                    }


            };



            var myColumnDefs = [

                {key:"CouponID", label:"ΚΩΔ. ΚΟΥΠΟΝΙΟΥ", formatter:YAHOO.widget.DataTable.formatNumber, hidden:true, isPrimaryKey:true},
				{key:"Country", label:"ΧΩΡΑ",sortable:true},
				{key:"ShortcutName", label:"ΠΡΩΤΑΘΛ.",  sortable:true},
                {key:"Time", label:"ΩΡΑ", formatter:myTimeFormatter, sortable:true},
                {key:"Code", label:"ΚΩΔ", formatter:"string", width:20,sortable:true},
                {key:"HomeTeam", label:"ΓΗΠΕΔΟΥΧΟΣ", width:150, sortable:true},
                {key:"HostTeam", label:"ΦΙΛΟΞΕΝΟΥΜΕΝΗ", width:150, sortable:true},
                {key:"HalfTimeScore",label:"ΗΜΙΧΡ.", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomGoalFormatter},
                {key:"FullTimeScore",label:"ΤΕΛΙΚΟ", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:CustomGoalFormatter},
                {key:"Dirty",label:"ΔΙΟΡΘΩΣΗ",formatter:DirtyFormatter, sortable:true},
                {key:"Indexed",label:"ΑΠΟΔΕΛΤΙΩMENO",formatter:YESNOFormatter, sortable:true},
                {key:"Published",label:"ΔΗΜΟΣΙΕΥΜΕΝΟ",hidden:true},
                {key:"Canceled",label:"ΜΟΝΑΔΑ", width:50, formatter:YAHOO.widget.DataTable.formatCheckbox, sortable:false},
                {key:'compute', label:'', width:50, className: 'compute-button', action:'compute'}

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
                    {key:"Country", parser:"string"},
                    {key:"ShortcutName", parser:"string"},
                    {key:"Time", parser:"stirng"},
                    {key:"Code", parser:"number"},
                    {key:"HomeTeam", parser:"string"},
                    {key:"HostTeam", parser:"string"},
                    {key:"HalfTimeScore", parser:"string"},
                    {key:"FullTimeScore", parser:"string"},
                    {key:"Canceled",parser:"number" },
                    {key:"Dirty",parser:"number" },
                    {key:"Indexed",parser:"number" },
                    {key:"Published"}

                ],
                 metaFields: {totalRecords: "DataSet.totalRecords"} // Access server-provided dynamic value
            };

            var oConfigs = {

                    dateOptions:{format:"%d/%m/%Y"},
                    selectionMode:"single",
                    numberOptions:{decimalPlaces:2, thousandsSeparator:","},
                    MSG_EMPTY:"Δεν υπάρχουν εγγραφές",
                    draggableColumns:false,
                    initialRequest:"query=coupons&type=select&primaryKey=CouponID&cascade=yes&whereID=" + oDateShow
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





            AddDataTable.subscribe("cellMouseoverEvent", highlightEditableCell);
	        AddDataTable.subscribe("cellMouseoutEvent", AddDataTable.onEventUnhighlightCell);


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




			AddDataTable.subscribe('cellClickEvent',function(oArgs) {


                var target = oArgs.target;

                column = this.getColumn(target);
                record = this.getRecord(target);





                switch (column.action) {

                 case 'compute' :

                               if (Published == 0) {

                                   YAHOO.example.alert('Δεν μπορώ να προχωρήσω σε αποδελτίωση διότι το κουπόνι δεν είναι δημοσιευμένο.');
                                   return;

                               }

                               if ( (record.getData(this.getColumn('Dirty').key) == 0) && (record.getData(this.getColumn('Indexed').key) == 1) ){

                                   YAHOO.example.alert('Δεν υπάρχουν αλλαγές για αποδελτίωση.');
                                   return;

                               }


                               var CouponID = record.getData(AddDataTable.getColumn('CouponID').key);
                               var HalfTimeScore = record.getData(AddDataTable.getColumn('HalfTimeScore').key);
                               var FullTimeScore = record.getData(AddDataTable.getColumn('FullTimeScore').key);



                               if ( ( (HalfTimeScore=='-') || (FullTimeScore=='-') ) && ( record.getData(AddDataTable.getColumn('Canceled').key)==0 ) ) {

                                   YAHOO.example.alert('Παρακαλώ συμπληρώστε το πεδίο <b>Ημίχρονο</b> και <b>Τελικό Σκόρ</b>.');
                                   return;

                               }



                                ajaxLoadingPanel.show();




                                YAHOO.util.Connect.asyncRequest('GET', '../includes/dataproxy.php?query=coupons&type=sp&id='+CouponID+"&halftime="+HalfTimeScore+"&fulltime="+FullTimeScore, {
                                                  success: function(o) {


    		                                               YAHOO.util.Connect.asyncRequest('GET', '../includes/dataproxy.php?query=coupons&type=update&column=Indexed&newvalue=1' + myBuildUrl(AddDataTable,record), {
    		                                                                  success: function(o) {

                                                                                    if (o.responseText!='200') {
                                                                                                alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή του Indexed Flag δεν αποθηκεύτηκε.<br><br>' +
                  		                                                                        'Επαναλάβετε την αποδελτίωση σε λίγο (1-2 λεπτά). Αν το πρόβλημα επιμένει παρακαλώ επικοινωνήστε με την κατασκευάστρια εταιρία.');

                                                                                    }


                                                                                    var SetCol = AddDataTable.getColumn('Indexed');
    		                                                                        AddDataTable.updateCell ( record , SetCol , 1 );


                              		                                               YAHOO.util.Connect.asyncRequest('GET', '../includes/dataproxy.php?query=coupons&type=update&column=Dirty&newvalue=0' + myBuildUrl(AddDataTable,record), {
                              		                                                                  success: function(o) {


                                                                                                              if (o.responseText!='200') {
                                  		                                                                        alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή του Dirty Flag δεν αποθηκεύτηκε.<br><br>' +
                                  		                                                                        'Επαναλάβετε την αποδελτίωση σε λίγο (1-2 λεπτά). Αν το πρόβλημα επιμένει παρακαλώ επικοινωνήστε με την κατασκευάστρια εταιρία.');

                                                                                                              }




                              		                                                                        var SetCol = AddDataTable.getColumn('Dirty');
                              		                                                                        AddDataTable.updateCell ( record , SetCol , 0 );

                                                                                                              OpenWindow('indexedreport.php','toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=0,width=1220,height=600,left=0,top=0')


                              		                                                                  },
                              		                                                                  failure: function(o) {
                              		                                                                        alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή του Indexed Flag δεν αποθηκεύτηκε.<br><br>' +
                              		                                                                        'Επαναλάβετε την αποδελτίωση σε λίγο (1-2 λεπτά). Αν το πρόβλημα επιμένει παρακαλώ επικοινωνήστε με την κατασκευάστρια εταιρία.');

                              		                                                               }
                                                                                     });






    		                                                                  },
    		                                                                  failure: function(o) {
    		                                                                        alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή του Indexed Flag δεν αποθηκεύτηκε.<br><br>' +
    		                                                                        'Επαναλάβετε την αποδελτίωση σε λίγο (1-2 λεπτά). Αν το πρόβλημα επιμένει παρακαλώ επικοινωνήστε με την κατασκευάστρια εταιρία.');

    		                                                               }
                                                           });


                                                        ajaxLoadingPanel.hide();



                                                  },
                                                  failure: function(o) {
                                                        alert('Η αποδελτίωση δεν ολοκληρώθηκε διότι συνέβει κάποιο λάθος.<br><br>' +
                                                        'Επαναλάβετε την αποδελτίωση σε λίγο (1-2 λεπτά). Αν το πρόβλημα επιμένει επικοινωνήστε με την κατασκευάστρια εταιρία.');


                                               }

                               });





                            break;
                    case 'cancel':

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
					var IndexedValue = oRecord.getData(AddDataTable.getColumn('Indexed').key);





                            //convert to int
                            newValue = newValue - 0;
                            ajaxLoadingPanel.show();
                            YAHOO.util.Connect.asyncRequest('GET', '../includes/dataproxy.php?query=coupons&type=update&column=Canceled&newvalue=' + newValue +  myBuildUrl(AddDataTable,oRecord), {
                                                success: function(o) {

                                                       recordSet =AddDataTable.getRecordSet();
                                                       recordSet.updateRecordValue(oRecord,'Canceled',newValue);


													   if (IndexedValue==1) {

    		                                               YAHOO.util.Connect.asyncRequest('GET', '../includes/dataproxy.php?query=coupons&type=update&column=Dirty&newvalue=1' + myBuildUrl(AddDataTable,oRecord), {
    		                                                                  success: function(o) {
                                                                                   ajaxLoadingPanel.hide();
    		                                                                        var SetCol = AddDataTable.getColumn('Dirty');
    		                                                                        AddDataTable.updateCell ( oRecord , SetCol , 1 );

    		                                                                        var msg = '<br><br><b>Προσοχή:</b>Έγιναν αλλαγές οι οποίες απαιτούν νέα αποδελτίωση';
    		                                                                        YAHOO.example.alert('Οι αλλαγές αποθηκεύτηκαν.' + msg);



    		                                                                  },
    		                                                                  failure: function(o) {
    		                                                                        alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή του Dirty Flag δεν αποθηκεύτηκε.<br><br>' +
    		                                                                        'Επικοινωνήστε με την κατασκευάστρια εταιρία.');


    		                                                               }

    		                                               });
                                                       } else {

                                                           ajaxLoadingPanel.hide();

                                                       }



                                                },
                                                failure: function(o) {
                                                      alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή του Canceled Flag δεν αποθηκεύτηκε.<br><br>' +
                                                      'Επικοινωνήστε με την κατασκευάστρια εταιρία.');


                                             }
                             });




                 


				});


            AddDataTable.subscribe("editorSaveEvent", function(oArgs){


                var oEditor = oArgs.editor;
          	    var newData = oArgs.newData;
          	    var oldData = oArgs.oldData;
      			var elCell = oEditor.cell;
  		        var oRecord = oEditor.getRecord();
           		var oColumn = oEditor.getColumn();
                var value = oRecord.getData(oColumn.key);
                var msg;

                msg='';

                if (oColumn.formatter == YAHOO.widget.DataTable.formatNumber)
                      qnewval =   "&newvalue=" + value;
                else
                      qnewval =   "&newvalue=@" + value;



                  AddDataTable.set("sortedBy", null);

                  if ( (oColumn.key == "HalfTimeScore") || (oColumn.key == "FullTimeScore") ) {


                   // regular expression to match required time format
                      re = /^(\d{1,3})\-(\d{1,3})$/;

                      if(newData != '') {

                        if(regs = newData.match(re)) {

                          if(regs[3]) {
                            if(regs[1] < 0 || regs[1] > 300) {
                              	this.updateCell ( oRecord , oColumn , oldData );
                                return;
                            }
                          } else {
                            if(regs[1] > 300) {
                              	this.updateCell ( oRecord , oColumn , oldData );
                                return;
                            }
                          }
                          if(regs[2] > 300) {
                          	this.updateCell ( oRecord , oColumn , oldData );
                            return;
                          }
                        } else {
                          	this.updateCell ( oRecord , oColumn , oldData );
                            return;
                        }
                      }

                  }




                if(oldData != newData)
                {
                 ajaxLoadingPanel.show();
                 YAHOO.util.Connect.asyncRequest('GET', '../includes/dataproxy.php?query=coupons&type=update&column=' + oColumn.key + qnewval + myBuildUrl(this,oRecord), {
                                 success: function(o) {

                                     if (o.responseText=='200'){





                                        //if user has already updated the following fields then rise the dirty flag
                                        if ( (oRecord.getData(this.getColumn('HalfTimeScore').key) != '-') &&
                                                (oRecord.getData(this.getColumn('FullTimeScore').key) != '-' )  &&
                                                   (oRecord.getData(this.getColumn('Indexed').key) == 1 ) ) {

                                               YAHOO.util.Connect.asyncRequest('GET', '../includes/dataproxy.php?query=coupons&type=update&column=Dirty&newvalue=1' + myBuildUrl(this,oRecord), {
                                                                  success: function(o) {

                                                                        var SetCol = AddDataTable.getColumn('Dirty');
                                                                        AddDataTable.updateCell ( oRecord , SetCol , 1 );

                                                                        msg = '<br><br><b>Προσοχή:</b>Έγιναν αλλαγές οι οποίες απαιτούν νέα αποδελτίωση';
                                                                        YAHOO.example.alert('Οι αλλαγές αποθηκεύτηκαν.' + msg);



                                                                  },
                                                                  failure: function(o) {
                                                                        alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή του Dirty Flag δεν αποθηκεύτηκε.<br><br>' +
                                                                        'Επικοινωνήστε με την κατασκευάστρια εταιρία.');


                                                               }
                                               });





                                        }

                                       ajaxLoadingPanel.hide();

                                     } else {
                                        YAHOO.example.alert('Επιτυχής διαδικασία, αλλά δεν λήφθηκε σωστός κωδικός επιστροφής από τον server');

                                     }

                                },
                                failure: function(o) {
                                       alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή σας δεν αποθηκεύτηκε.');
                                },
                                scope: this
                        }  );

                }

            });





	        myTabView.getTab(0).addListener("click", function() {AddDataTable.onShow()})


             return {
                oDS: myDataSource,
                oDT: AddDataTable,
                oTV: myTabView
            };


        }();

});










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
