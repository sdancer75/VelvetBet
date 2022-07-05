<?php
    session_start();
    include '../includes/database.php';
    include '../includes/login.php';
    include '../includes/statistics.php';


     $LoginMsg = '';
     $DB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
     mysql_select_db(DataBase, $DB) or die(mysql_error());

    if ( (!check_login('superagents')) )  {

            mysql_close($DB);
            header( 'Location: ../index.php' );

    }


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
<script type="text/javascript" src="../js/verifyinput.js"></script>


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

.delete-button {
	cursor:pointer;
	background: #FFFFCC url(../grafix/delete.png) no-repeat center center;
	width:16px;height:16px;
}

.linkgo-button {
	cursor:pointer;
	background: transparent url(../grafix/link_go.png) no-repeat center center;
	width:16px;height:16px;
}


html, body{height:100%}
</style>

</HEAD>


<BODY  class="yui-skin-sam" oncontextmenu="return false">


<TABLE cellSpacing=0 cellPadding=0 width=100% height=100% border=0>
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
                <strong>Διαχείριση χρηστών</strong>
    </TD>
  </TR>


   <!-- hide the stuff the they are repeated -->
   <?php include 'includes/panel.php' ?>



    <TD style="VERTICAL-ALIGN: top;" width="100%" height=80%>
      <Table border=0 width="100%">
        <TR>
            <TD class="yui-skin-sam" style="FONT-SIZE: 11px;"  valign="top" width="100%" style="FONT-SIZE: 10px;">

                <div id="tvcontainer" class="yui-navset">
                    <ul class="yui-nav">
                        <li class="selected"><a href="#tab1"><em>Λίστα Χρηστών</em></a></li>
                        <li><a href="#tab2"><em>Δημιουργία χρήστη</em></a></li>
                    </ul>
                    <div class="yui-content">

                        <table>
                        <tr>
                            <TD>

							  <br>
                              <div id="paginatedAgent" align="left"></div>

                             </TD>
                        </tr>
                        </table>

                        <div><p>

                              <form  id="submit" >
                              <Table width=400px>
                              <TR>
                                  <TD colspan=4>
                                     Όνομα Agent
                                  </TD>
                              </TR>
                              <TR>
                                  <TD colspan=4 >
                                      <INPUT name="Name" id="Name" size="50" maxlength="50" onkeyup="this.value=this.value.toLowerCase()" onkeypress="editKeyBoard(event,keybAlphaNumeric);">
								  	  <br><br>
                                  </TD>
                              </TR>


                              <TR>
                                  <TD colspan=4>
                                     Κωδικός
                                  </TD>
                              </TR>
                              <TR>

                                <TD colspan=4 valign="middle" align="left">

                                    <INPUT name="zPassword" id="zPassword" size="50" maxlength="10" onkeyup="this.value=this.value.toLowerCase()" onkeypress="editKeyBoard(event,keybAlphaNumeric);">
								  	<br><br>
                                </TD>
                              </TR>

                              <TR>
                                  <TD colspan=4>
                                     Πόλη
                                  </TD>
                              </TR>
                              <TR>
                                  <TD colspan=4 valign="middle" align="left">
                                      <INPUT name="City" id="City" size="50" maxlength="50" >
								  	  <br><br>

                                </TD>
                              </TR>
<!--
                              <TR>
                                  <TD colspan=4>
                                     Τηλέφωνο
                                  </TD>
                              </TR>
                              <TR>
                                  <TD colspan=4 valign="middle" align="left">
-->
                                      <INPUT type="hidden" name="Phone" id="Phone" size="50" maxlength="15"  onkeypress="editKeyBoard(event,keybNumeric);">
<!--
								  	  <br><br>

                                </TD>
                              </TR>

-->





                              </TABLE>

                              <br><br>


                              <TABLE border=0 width=200px>

                              <TR>
                                  <TD align="right" colspan=4>

                                     <br><br>
                                     <span id="pushbuttonAddRec" class="yui-button yui-push-button">
                                      <strong class="first-child">
                                        <button type="button" name="pushbuttonAddRec">Αποθήκευση</button>
                                      </strong>
                                      </span>

                                  </TD>
                              </TR>
                              </TABLE>
                              </form>


                        </p></div>
                    </div>
                </div>


            </TD>
        </TR>



        </Table>


      <Script type="text/javascript">
                //************************************************** SUPER AGENT *********************************************************
        var DataTable;
        var AgentDataTable;
        var SelectedSAgentID = -1;
        var elDropDownSagents;


            parseSQLDate = function(ISOdate)
            {

                if (ISOdate == undefined)
                    return;

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


                return formatedDateTime;
            };


            function LogicalXOR(a,b) {
              return ( a || b ) && !( a && b );
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










        var AjaxObject = {
        	handleSuccess:function(o){

                var oSelectSAgent = YAHOO.util.Dom.get("SelectSAgent");

                try {
                    var r = YAHOO.lang.JSON.parse(o.responseText);
                }
                catch (x) {

                    ajaxLoadingPanel.hide();

                    if ( o.responseText == 'userexist' ) {
                       YAHOO.example.alert("Η εγγραφή σας <b>δεν αποθηκεύτηκε</b> διότι είτε υπάρχει το όνομα χρήστη, ή ο συνδυασμός ονόματος χρήστη και κωδικού υπάρχει ήδη. Παρακαλώ επιλέξτε κάποιο άλλο όνομα χρήστη.");
                    } else
                        YAHOO.example.alert("JSON Parse failed! :" + o.responseText);
                    return;
                }







                AgentDataTable.addRow({SAgentID:r.SAgentID, AgentID:r.AgentID, Name:r.Name,Password:r.Password,City:r.City,Phone:r.Phone,Mona:r.Mona,
                Dipla:r.Dipla, Triades:r.Triades, Systems:r.Systems, RegDate:parseSQLDate(r.RegDate),LastLogin:parseSQLDate(r.LastLogin),Active:r.Active,Remainder:0});





               YAHOO.util.Dom.get("Name").value = '';
               YAHOO.util.Dom.get("City").value = '';
               YAHOO.util.Dom.get("Phone").value = '';
               YAHOO.util.Dom.get("zPassword").value = '';



			   ajaxLoadingPanel.hide();
               YAHOO.example.alert('Η εγγραφή σας αποθηκεύτηκε');
        	},

        	handleFailure:function(o){
        		alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή σας δεν αποθηκεύτηκε.');
        	},
        	startRequest:function(query) {
				ajaxLoadingPanel.show();
                YAHOO.util.Connect.asyncRequest('GET', query, callback);


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


        function onAddRec(p_oEvent) {


               var oName = YAHOO.util.Dom.get("Name").value;
               var oCity = YAHOO.util.Dom.get("City").value;
               var oPhone = 0;
               var oPassword = YAHOO.util.Dom.get("zPassword").value;



               var oSelectSAgent = <?php echo $_SESSION['user/id']?>;

               var currentTime = new Date();
               var month = currentTime.getMonth() + 1;
               var day = currentTime.getDate();
               var year = currentTime.getFullYear();
               var SqlToday = year + '-' + month + '-' + day;








        		if ( (oName=='')  || (oPassword=='') ) {

              			YAHOO.example.alert('Παρακαλώ συμπληρώστε όλα τα υποχρεωτικά πεδία.<br><br>' +
            		   'Τα πεδία <b>Όνομα Agent & Κωδικός</b> δεν επιτρέπεται να είναι κενά και<br>'
            		   );

      	                return;

        		}

                if ( oPassword.length < 4 ) {

                        YAHOO.example.alert('Παρακαλώ πληκτρολογήστε τουλάχιστον 4 χαρακτήρες για το νέο κωδικό.');
                        return;
                }

         	           //disable sorting
   	           AgentDataTable.set("sortedBy", null);

                var queryForm = '&Name='+oName+'&City='+oCity+'&Phone='+oPhone+'&Password='+oPassword+'&Mona=0&Dipla=0&Triades=0&Systems=0&SAgentID='+oSelectSAgent+'&RegDate='+SqlToday+'&LastLogin='+SqlToday;

                // Start the transaction.
               AjaxObject.startRequest('../includes/dataproxy.php?query=agents&primaryKey=AgentID&type=insert'+queryForm);







        }



        var οPushButtonAddRec = new YAHOO.widget.Button("pushbuttonAddRec");
        οPushButtonAddRec.on("click", onAddRec);











         YAHOO.util.Event.addListener(window, "load", function() {
          YAHOO.example.paginated =  function() {



			//*************************************************************************

           var AgentColumnDefs = [

                {key:"AgentID", label:"AGENT", formatter:YAHOO.widget.DataTable.formatNumber, hidden:true, isPrimaryKey:true},
				{key:"Name", label:"AGENT", formatter:YAHOO.widget.DataTable.formatString ,sortable:true},
                {key:"Password", label:"ΚΩΔΙΚΟΣ", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:"string",sortable:true},
                {key:"City", label:"ΠΟΛΗ", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatString,  sortable:true},
	            {key:"Mona", label:"MONA %", formatter:YAHOO.widget.DataTable.formatNumber,  sortable:true},
	            {key:"Dipla", label:"ΔΙΠΛΑ %",  formatter:YAHOO.widget.DataTable.formatNumber,  sortable:true},
	            {key:"Triades", label:"3ΑΔΕΣ %", formatter:YAHOO.widget.DataTable.formatNumber,  sortable:true},
	            {key:"Systems", label:"ΣΥΣΤΗΜΑΤΑ %", formatter:YAHOO.widget.DataTable.formatNumber,  sortable:true},
                {key:"Remainder", label:"ΥΠΟΛΟΙΠΟ", formatter:YAHOO.widget.DataTable.formatCurrency,  sortable:true},
                {key:"LastLogin", label:"ΤΕΛ. ΣΥΝΑΛ.", formatter:YAHOO.widget.DataTable.formatText, sortable:true},
                {key:"RegDate", label:"ΕΓΓΡΑΦΗ", formatter:YAHOO.widget.DataTable.formatDate, sortable:true},
                {key:"Active", label:"ΕΝΕΡΓΟΣ", width:50, formatter:YAHOO.widget.DataTable.formatCheckbox, sortable:true}


            ];

            AgentDataSource = new YAHOO.util.XHRDataSource("../includes/dataproxy.php?");
            AgentDataSource.responseType = YAHOO.util.DataSource.TYPE_JSON;
            AgentDataSource.connXhrMode = "queueRequests";




            AgentDataSource.responseSchema = {
                  resultsList: "DataSet.items",
                  fields: [
                  {key:"AgentID",parser:"number"},
                  {key:"Name",parser:"string"},
                  {key:"Password",parser:"string"},
                  {key:"City",parser:"string"},
                  {key:"Phone",parser:"string"},
                  {key:"Mona",parser:"number"},
                  {key:"Dipla",parser:"number"},
                  {key:"Triades",parser:"number"},
                  {key:"Systems",parser:"number"},
                  {key:"Remainder",parser:"number"},
                  {key:"LastLogin",parser:parseSQLDate},
                  {key:"RegDate",parser:parseSQLDate},
                  {key:"Active",parser:"number"}

                  ],
                  metaFields: {totalRecords: "DataSet.totalRecords"} // Access server-provided dynamic value

            };







            var oConfigs = {

                   //sortedBy:{key:"country",dir:"asc"},

                    dateOptions:{format:"%d/%m/%Y"},
                    selectionMode:"single",
                    numberOptions:{decimalPlaces:0, thousandsSeparator:","},
                    MSG_EMPTY:"Δεν υπάρχουν εγγραφές",
                    draggableColumns:true,
					currencyOptions:{prefix: "€", decimalPlaces:2, decimalSeparator:".", thousandsSeparator:","},
                    initialRequest:"query=agents_list&type=select&primaryKey=AgentID&whereID=<?php echo $_SESSION['user/id']?>",
                    // Sorting and pagination will be routed to the server via generateRequest
	                dynamicData : false,
	                height:"55em"

	        };

            AgentDataTable = new YAHOO.widget.ScrollingDataTable("paginatedAgent", AgentColumnDefs, AgentDataSource, oConfigs );


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

            AgentDataTable.subscribe("cellMouseoverEvent", highlightEditableCell);
	        AgentDataTable.subscribe("cellMouseoutEvent", AgentDataTable.onEventUnhighlightCell);

            AgentDataTable.subscribe('cellClickEvent',function(oArgs) {


                var target = oArgs.target;

                column = this.getColumn(target);
                record = this.getRecord(target);



                switch (column.action) {

                    case 'cancel':

                            break;
                    default:AgentDataTable.onEventShowCellEditor(oArgs);
                            break;
                }

            });




          AgentDataTable.subscribe("editorSaveEvent", function(oArgs){


                var oEditor = oArgs.editor;
        	    var newData = oArgs.newData;
        	    var oldData = oArgs.oldData;
    			var elCell = oEditor.cell;
		        var oRecord = oEditor.getRecord();
           		var oColumn = oEditor.getColumn();
                var value = oRecord.getData(oColumn.key);


                AgentDataTable.set("sortedBy", null);

				//no characters allowed to the following fields
    				if ( (oColumn.key == "Phone") || (oColumn.key == "Mona") || (oColumn.key == "Dipla") ||
			                  (oColumn.key == "Triades") || (oColumn.key == "Systems") || (oColumn.key == "Remainder" ) ) {


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
						if ( ( FloatValue > 100 ) && (oColumn.key != "Phone") && (oColumn.key != "Remainder")) {
							YAHOO.example.alert( 'Προσοχή ! Η τιμή που δώσατε στη στήλη <b>' + oColumn.label + '</b> είναι πάνω από 100.');
							this.updateCell ( oRecord , oColumn , oldData );
							return;
						}

	        	}


                if(oldData != newData)
                {

                    if ( (oColumn.key == "Password") && (value.length < 4) ) {

                        YAHOO.example.alert('Παρακαλώ πληκτρολογήστε τουλάχιστον 4 χαρακτήρες για το νέο κωδικό.');
                        this.updateCell ( oRecord , oColumn , oldData );
                        return;

                    }

    				if ( (oColumn.key == "Phone") || (oColumn.key == "Mona") || (oColumn.key == "Dipla") ||
			                  (oColumn.key == "Triades") || (oColumn.key == "Systems") || (oColumn.key == "Remainder" ) )
			                          qnewval =   "&newvalue=" + value;
			                    else
			                          qnewval =   "&newvalue=@" + value;

					query = '../includes/dataproxy.php?query=agents&type=update&column='

					YAHOO.util.Connect.asyncRequest('GET', query + oColumn.key + qnewval + myBuildUrl(this,oRecord), {
                                   success: function(o) {

                                                try {

                                                    var r = YAHOO.lang.JSON.parse(o.responseText);
                                                }
                                                catch (x) {

                                                    if ((oColumn.key=='Name') && (o.responseText=='userexist')) {

                                                     YAHOO.example.alert("Η εγγραφή σας <b>δεν αποθηκεύτηκε</b> διότι το όνομα χρήστη υπάρχει ήδη. Παρακαλώ επιλέξτε κάποιο άλλο όνομα χρήστη.");
                                                     this.updateCell ( oRecord , oColumn , oldData );
                                                     return;

                                                    } else if ((oColumn.key=='Password') && (o.responseText=='userexist')) {
                                                     YAHOO.example.alert("Η εγγραφή σας <b>δεν αποθηκεύτηκε</b> διότι είτε υπάρχει το όνομα χρήστη, ή ο συνδυασμός ονόματος χρήστη και κωδικού υπάρχει ήδη. Παρακαλώ επιλέξτε κάποιο άλλο κωδικό.");
                                                     this.updateCell ( oRecord , oColumn , oldData );
                                                     return;
                                                    } else {
                                                        alert("JSON Parse failed!");
                                                        return;
                                                    }
                                                }

							                    if (oColumn.key == "SAgentID") {
							                         AgentDataTable.deleteRow( oRecord );
		                         				}

                                                YAHOO.example.alert('Οι αλλαγές αποθηκεύτηκαν.');




                                  },
                                  failure: function(o) {
                                         alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή σας δεν αποθηκεύτηκε.');
                                  },
                                  scope: this
                     }  );
               	}

		    });





            var myTabView = new YAHOO.widget.TabView("tvcontainer");
	        myTabView.getTab(0).addListener("click", function() { AgentDataTable.onShow();})


            return {

             oDSA: AgentDataSource,
             oDTA: AgentDataTable,
             oTV : myTabView
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


</BODY>
</HTML>



