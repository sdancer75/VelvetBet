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
    background: url(../grafix/add.gif) 10% 50% no-repeat;


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

.yui-skin-sam .yui-dt td.time {
    background-color: #FFCA95;
    Color:black;

}

.yui-skin-sam .yui-dt td.limits {
    background-color: #DDE8FF;
    Color:black;

}

.yui-skin-sam .yui-dt td.master {
    background-color: #990000;
    Color:white;

}

.yui-skin-sam .yui-dt td.maxmin {
    background-color: #FFFFD9;
    Color:black;

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
                <strong>Όρια και Έλεγχοι</strong>
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
                        <li class="selected"><a href="#tab1"><em>Όρια & Έλεγχοι</em></a></li>
                        <li><a href="#tab2"><em>Κωδικοί Master</em></a></li>
                    </ul>
                       <div class="yui-content">
                            <DIV>


                            <br>
                            <img src="../grafix/info.png" width="16" height="16" align="absmiddle" border="0" hspace="2">
                            <b>Οδηγίες</b><br>
					        <hr width="100%" style="Color:red;"></hr>
    					    <br>
                            Μηδενικές τιμές στα πεδία <b>ΟΡΙΑ ΣΤΟΙΧΗΜΑΤΟΣ, ΜΑΧ ΠΙΘΑΝΟΥ ΚΕΡΔΟΥΣ, MIN ΠΟΣΟ ΣΤΟΙΧΗΜΑΤΙΣΜΟΥ</b> σημαίνει
                            ότι δεν υπάρχει όριο.
                            <br><br>
                            Το ελάχιστο ποσό στοιχηματισμού για <b>μονά & πολλαπλά είναι 5 €</b> εξ' ορισμού
                            <br><br>
                            Το ίδιο ισχύει όταν το <b>ΝΥΧΤΕΡΙΝΟ ΟΡΙΟ</b> έχει τιμές 00:00:00 και στα δυο πεδία <b>ΑΠΟ - ΈΩΣ</b>.
                            <br><br>
					        <hr width="100%" style="Color:red;"></hr>
                            <br>
                            <div id="paginated" align="left"></div>
                            <br><br><br>
                            </DIV>

                            <DIV>

                            <br>
                            <img src="../grafix/info.png" width="16" height="16" align="absmiddle" border="0" hspace="2">
                            <b>Εισαγωγή νέου Master</b><br>
					        <hr width="100%" style="Color:red;"></hr>
    					    Παρακαλώ εισάγετε το όνομα και τον κωδικό ενός νέου master.

                                  <form  id="submit" >
                                  <table>
                                  <tr>
                                      <td >
                                         <br><br>
                                         Όνομα
                                      </td>
                                      <td >
                                         <br><br>
                                         Κωδικός
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                         <INPUT  name="Name" id="Name" size="20" maxlength="20" onkeyup="this.value=this.value.toLowerCase()" onkeypress="editKeyBoard(event,keybAlphaNumeric);">
                                      </td>
                                      <td>
                                         <INPUT  name="Password" id="Password" size="20" maxlength="20" onkeyup="this.value=this.value.toLowerCase()" onkeypress="editKeyBoard(event,keybAlphaNumeric);">
                                      </td>
                                  </tr>
                                  <tr>
                                      <td align="left" colspan=2>
                                           <br><br>
                                            <span id="pushbuttonAddRec" class="yui-button yui-push-button">
                                            <strong class="first-child">
                                              <button type="button" name="pushbuttonAddRec">Προσθήκη</button>
                                            </strong>
                                            </span>
                                      </td>
                                  </tr>
                                  </table>
                                  </form>


   					        <hr width="100%" style="Color:red;"></hr>
                            <br><br><br><br>
                            <div id="masterusers" align="left"></div>
                            <br><br>
                            </DIV>
                      </div>



                    </div>
            </TD>
        </TR>
        </Table>


      <Script type="text/javascript">

        var DataTable, DataTableMasterUsers;



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
        		// This member handles the success response
        		// and passes the response object o to AjaxObject's
        		// processResult member.

                try {
                    var r = YAHOO.lang.JSON.parse(o.responseText);
                }
                catch (x) {
                    alert("JSON Parse failed!" + o.responseText);
                    return;
                }

                DataTableMasterUsers.addRow({MasterID:r.MasterID,Name:r.Name,Password:r.Password});
                YAHOO.util.Dom.get("Name").value = "";
                YAHOO.util.Dom.get("Password").value = "";
                YAHOO.example.alert('Η εγγραφή σας αποθηκεύτηκε επιτυχώς.');
        	},

        	handleFailure:function(o){
        		alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή σας δεν αποθηκεύτηκε.');
        	},

        	processArgument:function(o){
        	   DataTableMasterUsers.getState()
        	},

        	startRequest:function() {
        	   YAHOO.util.Connect.asyncRequest('GET', '../includes/dataproxy.php?query=masterusers&primaryKey=MasterID&type=insert', callback);


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
            argument:AjaxObject.processArgument,
        	scope: AjaxObject
        };

        function onAddRec(p_oEvent) {


               var oName = YAHOO.util.Dom.get("Name").value;
               var oPassword = YAHOO.util.Dom.get("Password").value;


               if ( (oName.length != 0) && (oPassword.length != 0)) {

                        //disable sorting
                        DataTableMasterUsers.set("sortedBy", null);

                        //get data from the form.
                        var formObject = document.getElementById('submit');
                       	YAHOO.util.Connect.setForm(formObject);

                        // Start the transaction.
                        AjaxObject.startRequest();

               }
               else
                   YAHOO.example.alert('Παρακαλώ συμπληρώστε τα πεδία <b>Όνομα και Κωδικός</b>');


        }



        var οPushButtonAddRec = new YAHOO.widget.Button("pushbuttonAddRec");
        οPushButtonAddRec.on("click", onAddRec);


          YAHOO.util.Event.addListener(window, "load", function() {
          YAHOO.example.userslist =  function() {

            var myTimeFormatter = function(elCell, oRecord, oColumn, oData) {

                    YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "time");
                    var timerec=oRecord.getData(oColumn.field);

                    //check if time keeps the seconds. We dont need them so, make them dissappear.
                    if (timerec.length > 5) {


                         timerec=timerec.substring(0, 5);


                    }
                    elCell.innerHTML = timerec;

            };

            var myLimitsFormatter = function(elCell, oRecord, oColumn, oData) {

                    YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "limits");
                    var rec=oRecord.getData(oColumn.field);
                    elCell.innerHTML = '€'+rec;

            };

            var myMaxMinFormatter = function(elCell, oRecord, oColumn, oData) {

                    YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "maxmin");
                    var rec=oRecord.getData(oColumn.field);
                    elCell.innerHTML = '€'+rec;

            };

            var mymasterFormatter = function(elCell, oRecord, oColumn, oData) {

                    YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "master");
                    var rec=oRecord.getData(oColumn.field);
                    elCell.innerHTML = rec;

            };

            var myCustomValidator = function(newData, oldData, oCellEditor){
                var regex=/^[0-9a-zA-Z]+$/;

                if(regex.test(newData)){
                    return newData;
                }else{
                    alert('Μόνο αλφαριθμητικά δεδομένα στην λατινική (αγγλικά) επιτρέπονται.');
                    return undefined;
                }
            };
/*
            var myNumberValidator = function(newData, oldData, oCellEditor){
                var regex=/^[0-9]+$/;

                if(regex.test(newData)){
                    return newData;
                }else{
                    alert('Μόνο αριθμητικά δεδομένα επιτρέπονται.');
                    return undefined;
                }
            };
*/
            var myNumberValidator = function(newData, oldData, oCellEditor){
                try {
                    var inpVal = parseFloat(newData);
                    if (isNaN(inpVal)) {
                        var msg = "Μόνο αριθμητικά δεδομένα επιτρέπονται.";
                        var err = new Error(msg);
                        if (!err.message) {
                            err.message = msg;
                        }
                        throw err;
                    } else {

                        return newData;
                    }

                } catch (e) {
                    alert(e.message);
                    return undefined;
                }
            }

           var myColumnDefs = [

               {key:"MasterID", label:"MasterID", formatter:YAHOO.widget.DataTable.formatNumber, hidden:true, isPrimaryKey:true},
                {label:"ΝΥΧΤΕΡΙΝΟ ΟΡΙΟ",
	                    children: [
                            {key:"NightLimitFrom", label:"ΑΠΟ", editor:new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:myTimeFormatter, sortable:true},
                            {key:"NightLimitTo", label:"ΕΩΣ", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:myTimeFormatter, sortable:true}
                        ]
                },
                {label:"ΟΡΙΑ ΝΥΧΤΕΡΙΝΟΥ ΣΤΟΙΧΗΜΑΤΟΣ",
	                    children: [
                            {key:"LimitMona", label:"ΜΟΝΑ", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", validator:myNumberValidator, disableBtns:false}), formatter:myLimitsFormatter, sortable:true},
                            {key:"LimitPollapla", label:"ΠΟΛΛΑΠΛΑ", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", validator:myNumberValidator, disableBtns:false}), formatter:myLimitsFormatter, sortable:true},
                            {key:"LimitSystems", label:"ΣΥΣΤΗΜΑΤΑ", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", validator:myNumberValidator, disableBtns:false}), formatter:myLimitsFormatter, sortable:true}
                        ]
                },
                {key:"MaxProfit", label:"ΜΑΧ ΠΙΘΑΝΟΥ ΚΕΡΔΟΥΣ",  editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", validator:myNumberValidator, disableBtns:false}), formatter:myMaxMinFormatter,  sortable:true},
                {key:"MinBet", label:"MIN ΣΤΟΙΧ. ΣΥΣΤΗΜΑΤΩΝ",  editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", validator:myNumberValidator, disableBtns:false}), formatter:myMaxMinFormatter,  sortable:true},
                {key:"MaxBet", label:"MAX ΣΤΟΙΧΗΜΑΤΙΣΜΟΥ",  editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", validator:myNumberValidator, disableBtns:false}), formatter:myMaxMinFormatter,  sortable:true}
            ];



            var  myDataSource = new YAHOO.util.XHRDataSource("../includes/dataproxy.php?");
            myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSON;
            myDataSource.connXhrMode = "queueRequests";


            myDataSource.responseSchema = {
                  resultsList: "DataSet.items",
                  fields: [
                  {key:"MasterID",parser:"number"},
                  {key:"NightLimitFrom",parser:"string"},
                  {key:"NightLimitTo",parser:"string"},
                  {key:"LimitMona",parser:"number"},
                  {key:"LimitPollapla",parser:"number"},
                  {key:"LimitSystems",parser:"number"},
                  {key:"MaxProfit",parser:"number"},
                  {key:"MinBet",parser:"number"},
                  {key:"MaxBet",parser:"number"}
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
                    initialRequest:"query=master&type=select&primaryKey=masterID",
                    // Sorting and pagination will be routed to the server via generateRequest
	                dynamicData : false

	        };




            DataTable = new YAHOO.widget.DataTable("paginated", myColumnDefs, myDataSource,oConfigs );

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

            DataTable.subscribe("cellMouseoverEvent", highlightEditableCell);
	        DataTable.subscribe("cellMouseoutEvent", DataTable.onEventUnhighlightCell);
            DataTable.subscribe('cellClickEvent', DataTable.onEventShowCellEditor);

            DataTable.subscribe("editorSaveEvent", function(oArgs){


                var oEditor = oArgs.editor;
        	    var newData = oArgs.newData;
        	    var oldData = oArgs.oldData;
    			var elCell = oEditor.cell;
		        var oRecord = oEditor.getRecord();
           		var oColumn = oEditor.getColumn();
                var value = oRecord.getData(oColumn.key);
                var msg = '';


                DataTable.set("sortedBy", null);

               if ( (oColumn.key == "NightLimitFrom") || (oColumn.key == "NightLimitTo") ) {


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
		        if (  (oColumn.key == "LimitMona")  || (oColumn.key == "LimitPollapla")  || (oColumn.key == "LimitSystems") ||
					  (oColumn.key == "MaxProfit")  || (oColumn.key == "MinBet") || (oColumn.key == "MaxBet") ) {


						if ( isNaN(newData) ) {
							this.updateCell ( oRecord , oColumn , oldData );
                            return;
                        }

     					if (newData==''){
                        	this.updateCell ( oRecord , oColumn , oldData );
                            return;
                        }


						//Max_Value_Alert does not affect Code field
						var IntValue = parseInt(newData);

                        if ( (oColumn.key == "MaxProfit") && ( IntValue > 10000 ) ) {

                                msg= 'Προσοχή ! Η τιμή που δώσατε στη στήλη <b>' + oColumn.label + '</b> είναι πάνω από €10.000.';

                        } else if ( (oColumn.key != "MaxProfit") && ( IntValue > 1000 ) ) {
							msg= 'Προσοχή ! Η τιμή που δώσατε στη στήλη <b>' + oColumn.label + '</b> είναι πάνω από €1000.';

						}

	        	}


                if(oldData != newData)
                {




                   if ( (oColumn.key == "LimitMona") || (oColumn.key == "LimitPollapla") || (oColumn.key == "LimitSystems") ||
			                         (oColumn.key == "MaxProfit" ) || (oColumn.key == "MinBet"))
			                          qnewval =   "&newvalue=" + value;
			                    else
			                          qnewval =   "&newvalue=@" + value;

					query = '../includes/dataproxy.php?query=master&type=update&column='+ oColumn.key + qnewval + myBuildUrl(this,oRecord);

					YAHOO.util.Connect.asyncRequest('GET', query , {
                                   success: function(o) {

                                                try {

                                                    var r = YAHOO.lang.JSON.parse(o.responseText);
                                                }
                                                catch (x) {

                                                    alert("JSON Parse failed!");
                                                    return;
                                                }


                                                YAHOO.example.alert('Οι αλλαγές αποθηκεύτηκαν.<br><br>'+msg);




                                  },
                                  failure: function(o) {
                                         alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή σας δεν αποθηκεύτηκε.');
                                  },
                                  scope: this
                     }  );
               	}

		    });


           //**************************************************************

           var myColumnDefsMasterUsers = [

                {key:"MasterID", label:"MasterID", formatter:YAHOO.widget.DataTable.formatNumber, hidden:true, isPrimaryKey:true},
                {label:"ΚΩΔΙΚΟΙ master",
	                    children: [
                          {key:"Name", label:"ΟΝΟΜΑ", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", validator:myCustomValidator, disableBtns:false}), sortable:true},
                          {key:"Password", label:"ΚΩΔΙΚΟΣ", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", validator:myCustomValidator, disableBtns:false}), sortable:true}
                        ]
                },
                {key:"Active", label:"ΕΝΕΡΓΟΣ", formatter:YAHOO.widget.DataTable.formatCheckbox, sortable:true},
                {key:'del', label:'', className: 'delete-button', action:'delete', width:15}
			];





            var  myDataSourceMasterUsers = new YAHOO.util.XHRDataSource("../includes/dataproxy.php?");
            myDataSourceMasterUsers.responseType = YAHOO.util.DataSource.TYPE_JSON;
            myDataSourceMasterUsers.connXhrMode = "queueRequests";


            myDataSourceMasterUsers.responseSchema = {
                  resultsList: "DataSet.items",
                  fields: [
                  {key:"MasterID",parser:"number"},
                  {key:"Name",parser:"string"},
                  {key:"Password",parser:"string"},
                  {key:"Active",parser:"number"},
                  "del"
                  ],
                  metaFields: {totalRecords: "DataSet.totalRecords"} // Access server-provided dynamic value

            };


            var oConfigsMasterUsers = {


                    dateOptions:{format:"%d/%m/%Y"},
                    selectionMode:"single",
                    numberOptions:{decimalPlaces:0, thousandsSeparator:","},
                    MSG_EMPTY:"Δεν υπάρχουν εγγραφές",
                    draggableColumns:true,
					currencyOptions:{prefix: "€", decimalPlaces:2, decimalSeparator:".", thousandsSeparator:","},
                    initialRequest:"query=masterusers&type=select&primaryKey=masterID",
                    // Sorting and pagination will be routed to the server via generateRequest
	                dynamicData : false

	        };




            DataTableMasterUsers = new YAHOO.widget.DataTable("masterusers", myColumnDefsMasterUsers, myDataSourceMasterUsers,oConfigsMasterUsers );

            var i=1,bReverseSorted = false;

            // Track when Column is reverse-sorted, since new data will come in out of order
            var trackReverseSorts = function(oArg) {
                bReverseSorted = (oArg.dir === YAHOO.widget.DataTableMasterUsers.CLASS_DESC);
            };



            // Set up editing flow
	        var highlightEditableCell = function(oArgs) {
	            var elCell = oArgs.target;
	            if(YAHOO.util.Dom.hasClass(elCell, "yui-dt-editable")) {
	                this.highlightCell(elCell);
	            }
	        };

            var myBuildUrl = function(DataTableMasterUsers,record) {
                var url = '';
                var cols = DataTableMasterUsers.getColumnSet().keys;
                for (var i = 0; i < cols.length; i++) {
                    if (cols[i].isPrimaryKey) {
                        url += '&id=' + escape(record.getData(cols[i].key));
                        url += '&primaryKey=' + cols[i].key;
                    }
                }

                return url;
            };

            DataTableMasterUsers.subscribe("cellMouseoverEvent", highlightEditableCell);
	        DataTableMasterUsers.subscribe("cellMouseoutEvent", DataTableMasterUsers.onEventUnhighlightCell);
            DataTableMasterUsers.subscribe('cellClickEvent', DataTableMasterUsers.onEventShowCellEditor);

            DataTableMasterUsers.subscribe("editorSaveEvent", function(oArgs){


                var oEditor = oArgs.editor;
        	    var newData = oArgs.newData;
        	    var oldData = oArgs.oldData;
    			var elCell = oEditor.cell;
		        var oRecord = oEditor.getRecord();
           		var oColumn = oEditor.getColumn();
                var value = oRecord.getData(oColumn.key);
                var msg = '';


                DataTableMasterUsers.set("sortedBy", null);





                if(oldData != newData)
                {





					query = '../includes/dataproxy.php?query=masterusers&type=update&column='+ oColumn.key + "&newvalue=@" + newData + myBuildUrl(this,oRecord);

					YAHOO.util.Connect.asyncRequest('GET', query , {
                                   success: function(o) {

                                                try {

                                                    var r = YAHOO.lang.JSON.parse(o.responseText);
                                                }
                                                catch (x) {

                                                    alert("JSON Parse failed!");
                                                    return;
                                                }


                                                YAHOO.example.alert('Οι αλλαγές αποθηκεύτηκαν.<br><br>'+msg);




                                  },
                                  failure: function(o) {
                                         alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή σας δεν αποθηκεύτηκε.');
                                  },
                                  scope: this
                     }  );
              }

		    });

            DataTableMasterUsers.subscribe('cellClickEvent',function(oArgs) {
                var target = oArgs.target;

                column = this.getColumn(target),
                record = this.getRecord(target);

                switch (column.action) {

                 case 'delete' :

                            if (confirm('Είσαι σίγουρος για τη διαγραφή ;')) {

                                var record = this.getRecord(target);

                                 YAHOO.util.Connect.asyncRequest('GET','../includes/dataproxy.php?query=masterusers&type=delete' + myBuildUrl(this,record),
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


           DataTableMasterUsers.subscribe('checkboxClickEvent', function(oArgs){

				    var elCheckbox = oArgs.target;
					var newValue = elCheckbox.checked;
				    var oRecord = this.getRecord(elCheckbox);
					var column = this.getColumn(elCheckbox);
					var oldValue = oRecord.getData(column.key);





                    //convert to int
                    newValue = newValue - 0;

                    YAHOO.util.Connect.asyncRequest('GET', '../includes/dataproxy.php?query=masterusers&type=update&column=Active&newvalue=' + newValue +  myBuildUrl(DataTable,oRecord), {
                                        success: function(o) {


                                        },
                                        failure: function(o) {
                                              alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή του Active Flag δεν αποθηκεύτηκε.<br><br>' +
                                              'Επικοινωνήστε με την κατασκευάστρια εταιρία.');


                                     }
                     });







				});


            var myTabView = new YAHOO.widget.TabView("tvcontainer");
	        myTabView.getTab(0).addListener("click", function() {DataTable.onShow();})
	        myTabView.getTab(1).addListener("click", function() {DataTableMasterUsers.onShow();})

            return {
             oDS : myDataSource,
             oDS2: myDataSourceMasterUsers,
             oDT : DataTable,
             oDT2: DataTableMasterUsers,
             oTV: myTabView,


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
