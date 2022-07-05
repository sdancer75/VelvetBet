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
<script type="text/javascript" src="../build/animation/animation-min.js"></script>
<script type="text/javascript" src="../build/container/container-min.js"></script>
<script type="text/javascript" src="../build/connection/connection-min.js"></script>
<script type="text/javascript" src="../build/json/json-min.js"></script>
<script type="text/javascript" src="../build/calendar/calendar-min.js"></script>



<script type="text/javascript" src="../js/dateformat.js"></script>




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
    background-color: #F8FCFF;
}
.yui-skin-sam .yui-dt tbody td {
    border-bottom: 0px solid #ddd;
}

.yui-skin-sam .yui-dt thead th {
    border-bottom: 0px solid #7f7f7f;
}


.yui-skin-sam .yui-dt tr.yui-dt-last td,
.yui-skin-sam .yui-dt th,
.yui-skin-sam .yui-dt td {
    border-bottom: 0px solid #7f7f7f;
    text-align: center;
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




.yui-button#pushbuttonAddRec button {

    padding-left: 3em;
    background: url(../grafix/save.png) 10% 50% no-repeat;


}

.yui-button#pushbuttonDelRec button {

    padding-left: 3em;
    background: url(../grafix/delete.gif) 10% 50% no-repeat;


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
    <TD bgcolor="#CCCC99" style="FONT-SIZE:14px" colSpan=2  height="25px" align="center">
                <strong>Νέα - Ανακοινώσεις</strong>
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
                        <li><a href="#tab2"><em>Εισαγωγή νέας εγγραφής</em></a></li>
                    </ul>
                    <div class="yui-content">

                        <div id="paginated" align="left"></div>

                        <div><p>
                                  <table>
                                  <tr>
                                    <td>

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
                                                  		oCalendar.cfg.setProperty("MONTHS_LONG",    ["Ιανουάριος", "Φεβρουάριος", "Μάριος", "Απρίλιος", "Μάϊος", "Ιούνιος", "Ιούλιος", "Αύγουστος", "Σεπτέμβριος", "Οκτώβριος", "Νοέμβριος", "Δεκέμβριος"]);
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

                                          			oButton = new YAHOO.widget.Button({
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
                                  </tr>
                                  <tr>
                                      <td class=TextInfoBlack>
                                      <br><br>
                                         Περιγραφή
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>

                                      <TEXTAREA id="Descr" name="Descr" rows="5" cols="45"></TEXTAREA>

                                      </td>
                                  </tr>
                                  <tr>
                                      <td align="right">
                                          <span id="pushbuttonAddRec" class="yui-button yui-push-button">
                                          <strong class="first-child">
                                            <button type="button" name="pushbuttonAddRec">Αποθήκευση</button>
                                          </strong>
                                          </span>



                                      </td>
                                  </tr>
                                  </table>


                        </p></div>
                    </div>
                </div>


            </TD>
        </TR>



        </Table>


      <Script type="text/javascript">

        var DataTable;

            parseSQLDate = function(ISOdate,output)
            {


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





        function delquote(str){
            return (str=str.replace(/["']{1}/gi,""));
        }



        function onAddRec(p_oEvent) {


			var oYear =  YAHOO.util.Dom.get("year").value;
			var oMonth =  YAHOO.util.Dom.get("month").value;
			var oDay =  YAHOO.util.Dom.get("day").value;
			oDate =  oYear + '-' + oMonth + '-' + oDay;
            var oDescr = YAHOO.util.Dom.get("Descr").value;

            oDescr=delquote(oDescr);
            

               if (oDescr.length != 0){
                        //disable sorting
                        DataTable.set("sortedBy", null);
                        ajaxLoadingPanel.show();
                        // Start the transaction.
                        YAHOO.util.Connect.asyncRequest('GET', '../includes/dataproxy.php?query=news&primaryKey=NewsID&type=insert&Descr='
                                +oDescr+'&Date='+oDate,
                                    {
                                        success: function (o) {

                                                  try {
                                                      var r = YAHOO.lang.JSON.parse(o.responseText);
                                                  }
                                                  catch (x) {
                                                      alert("JSON Parse failed!" + o.responseText);
                                                      return;
                                                  }

                                                  DataTable.addRow({NewsID:r.NewsID,Date:parseSQLDate(r.Date,2),Descr:r.Descr});
                                                  YAHOO.util.Dom.get("Descr").value = "";
                                                  ajaxLoadingPanel.hide();
                                                  YAHOO.example.alert('Η εγγραφή σας αποθηκεύτηκε');


                                        },
                                        failure: function (o) {
                                                alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή σας δεν αποθηκεύτηκε.');
                                        },
                                        scope:this
                                    }

                                );




               }
               else
                   YAHOO.example.alert('Παρακαλώ συμπληρώστε την περιγραφή ');


        }





        var οPushButtonAddRec = new YAHOO.widget.Button("pushbuttonAddRec");
        οPushButtonAddRec.on("click", onAddRec);





          YAHOO.util.Event.addListener(window, "load", function() {
          YAHOO.example.userslist =  function() {



           var myColumnDefs = [
                {key:"NewsID", label:"SAgentID", formatter:YAHOO.widget.DataTable.formatNumber, hidden:true, isPrimaryKey:true},
                {key:"Date", label:"Ημερομηνία", formatter:YAHOO.widget.DataTable.formatDate, editor: new YAHOO.widget.DateCellEditor(),  sortable:true, width:100},
                {key:"Descr", label:"Περιγραφή", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatText, sortable:true, width:450},
                {key:'del', label:'', className: 'delete-button', action:'delete', width:15}
            ];

            var  myDataSource = new YAHOO.util.XHRDataSource("../includes/dataproxy.php?");
            myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSON;
            myDataSource.connXhrMode = "queueRequests";


            myDataSource.responseSchema = {
                  resultsList: "DataSet.items",
                  fields: [
                  {key:"NewsID",parser:"number"},
                  {key:"Date",parser:function (oDate){

                            return parseSQLDate(oDate,1);

                  }},
                  {key:"Descr",parser:"string"},
                  "del"
                  ],
                  metaFields: {totalRecords: "DataSet.totalRecords"} // Access server-provided dynamic value

            };


            var oConfigs = {

                   //sortedBy:{key:"country",dir:"asc"},


                    dateOptions:{format:"%d/%m/%Y"},
                    //dateOptions:{format:"%Y-%m-%d"},
                    selectionMode:"single",
                    numberOptions:{decimalPlaces:0, thousandsSeparator:","},
                    MSG_EMPTY:"Δεν υπάρχουν εγγραφές",
                    draggableColumns:true,
					currencyOptions:{prefix: "€", decimalPlaces:2, decimalSeparator:".", thousandsSeparator:","},
                    initialRequest:"query=news&type=select&primaryKey=NewsID",
                    // Sorting and pagination will be routed to the server via generateRequest
	                dynamicData : false

	        };


            DataTable = new YAHOO.widget.DataTable("paginated", myColumnDefs, myDataSource, oConfigs  );

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

            DataTable.subscribe('cellClickEvent',function(oArgs) {
                var target = oArgs.target;

                column = this.getColumn(target),
                record = this.getRecord(target);

                switch (column.action) {

                 case 'delete' :

                            if (confirm('Είσαι σίγουρος για τη διαγραφή ;')) {

                                var record = this.getRecord(target);

                                 YAHOO.util.Connect.asyncRequest('GET','../includes/dataproxy.php?query=news&type=delete' + myBuildUrl(DataTable,record),
                                    {

                                        success: function (o) {
                                                this.deleteRow(target);
                                        },
                                        failure: function (o) {
                                                alert('Κάποιο σφάλμα δημιουργήθηκε');
                                        },
                                        scope:this
                                    }

                                );


                            }


                            break;
                    case 'insert':
                            //this.addRow( {} , this.getRecordIndex(target));
                            break;
                    default:this.onEventShowCellEditor(oArgs);
                            break;
                }

            })


            DataTable.subscribe("editorSaveEvent", function(oArgs){

                var oEditor = oArgs.editor;
        	    var newData = oArgs.newData;
        	    var oldData = oArgs.oldData;
    			var elCell = oEditor.cell;
		        var oRecord = oEditor.getRecord();
           		var oColumn = oEditor.getColumn();
           		var elContainer = oEditor.container;
                var value = oRecord.getData(oColumn.key);

               if (oColumn.key == "Date") {


                    value = dateFormat(value,"isoDate");

                }



                qnewval =   "&newvalue=@" + value;

                DataTable.set("sortedBy", null);

                if(oldData != newData)
                {



                 YAHOO.util.Connect.asyncRequest('GET', '../includes/dataproxy.php?query=news&type=update&column=' + oColumn.key + qnewval + myBuildUrl(this,oRecord), {
                                 success: function(o) {

                                     if (o.responseText=='200'){
                                        YAHOO.example.alert('Οι αλλαγές αποθηκεύτηκαν.');
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

            var myTabView = new YAHOO.widget.TabView("tvcontainer");
	        myTabView.getTab(1).addListener("click", function() {DataTable.onShow()})


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
