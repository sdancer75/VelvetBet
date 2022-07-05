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

.transfer-button {
	cursor:pointer;
	background: transparent url(../grafix/money_euro.png) no-repeat center center;
	width:16px;height:16px;
}

.linkgo-button {
	cursor:pointer;
	background: transparent url(../grafix/link_go.png) no-repeat center center;
	width:16px;height:16px;
}


#example {height:30em;}
label { display:block;float:left;width:65%;clear:left; }
.clear { clear:both; }
#resp { margin:10px;padding:5px;border:1px solid #ccc;background:#fff;}
#resp li { font-family:monospace }

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
                <strong>Μεταφορά χρημάτων</strong>
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
                        <li class="selected"><a href="#tab1"><em>Λίστα Χρηστών</em></a></li>
                    </ul>
                    <div class="yui-content">


                        <table>
                        <tr>
                            <TD>

                             <br><br>

                              <b>SUPER agents</b><br>
							  <hr width="100%" style="Color:red;"></hr>
							  <br>
                              <div id="paginated" align="left"></div>
                              <br><br><br>
                              <b>agents</b><br>
							  <hr width="100%" style="Color:red;"></hr>
							  <br>
                              <div id="paginatedAgent" align="left"></div>

                             </TD>
                        </tr>
                        </table>


                        <div id="dialog1">
                        <div class="hd">Μεταφορά χρημάτων</div>
                        <div class="bd">
                        <form method="GET" action="dataproxy.php">
                           <INPUT type="hidden" name="RowID" id="RowID" value="-1">
                           <INPUT type="hidden" name="RecordID" id="RecordID" value="-1">
                           <INPUT type="hidden" name="AgentType" id="AgentType" value="-1">


                           <label for="Name">Όνομα Agent/SAgent</label> <INPUT name="UserName" id="UserName" disabled="disabled">
                           <br><br>
                           <label for="CurMoney">Τρέχων υπόλοιπο Agent/SAgent</label><INPUT name="Remainder" id="Remainder" disabled="disabled">
                           <br><br>
                           <label for="SAgentCurMoney">Τρέχων υπόλοιπο Super Agent</label><INPUT name="RemainderSAgent" id="RemainderSAgent" disabled="disabled" value="0">
                           <br><br>
     					   <hr width="100%" style="Color:red;"></hr>
                           <br><br>


                        	<label for="radiobuttons">Τύπος μεταφοράς</label>
                        	<input type="radio" name="radiobuttons" id="in" value="1" checked/> Βάλε
                        	<input type="radio" name="radiobuttons" id="out" value="2" /> Βγάλε
                            <br><br>
                            <label for="Trans">Ποσό συναλλαγής σε €</label><INPUT name="Money" id="Money" value="0" onkeypress="editKeyBoard(event,keybNumeric);">
                            <br><br>

                        </form>
                        </div>
                        </div>

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
        var SelectedSAgentRecord;
        var elDropDownSagents;
        var query;


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












      var DropDownOptions = <?php


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
                 $result_id = mysql_query("select SAgentID, Name from superagents");
                 $MYDATASOURCE = get_pair_values($result_id,"SAgentID");
                 mysql_close($DB);
                 echo $MYDATASOURCE;


             ?>;

              elDropDownSagents = new YAHOO.widget.DropdownCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.",dropdownOptions:YAHOO.lang.JSON.parse(DropDownOptions),disableBtns:false});


              var formatSagents = function(elCell, oRecord, oColumn, oData) {


					for (var i=0;i<elDropDownSagents.dropdownOptions.length;i++) {

						if ( elDropDownSagents.dropdownOptions[i].value == oData ) {
							elCell.innerHTML = elDropDownSagents.dropdownOptions[i].label;

							return;
						}

					}


		        };




          YAHOO.namespace("example.container");

          function init() {

          	// Define various event handlers for Dialog
          	var handleSubmit = function() {

         		var data = this.getData();
                 AgentMoney = data.Remainder;


                if (eval(data.Money) == 0) {
          			YAHOO.example.alert( 'Παρακαλώ συμπληρώστε το ποσό της συναλλαγής.');
          			return false;
                }


                if ( (eval(data.radiobuttons)==2) && ( eval(data.Money) > eval(AgentMoney.substr(1)) ) ) {
          			YAHOO.example.alert( 'Δεν μπορείτε να βγάλετε μεγαλύτερο ποσό από το τρέχον υπόλοιπο του Agent/SAgent.');
          			return false;
                }


                if ( (eval(data.radiobuttons)==1) && ((eval(data.Money) > eval(SelectedSAgentRecord._oData.Remainder))) && (data.AgentType == 'agent') ) {
          			YAHOO.example.alert( 'Δεν μπορείτε να βάλετε μεγαλύτερο ποσό από το διαθέσιμο υπόλοιπο του αντίστοιχου Super Agent.');
          			return false;
                }

                if ( ((eval(data.Money) < 0)) ) {
          			YAHOO.example.alert( 'Δεν μπορείτε να βάλετε αρνητικά ποσά.');
          			return false;
                }



               if  (eval(data.radiobuttons)==2)
                    value = eval(AgentMoney.substr(1)) - eval(data.Money);
                else
                    value = eval(AgentMoney.substr(1)) + eval(data.Money);


                if (data.AgentType == 'agent')
                        query = '../includes/dataproxy.php?query=agents&type=update&column=Remainder&primaryKey=AgentID&newvalue='+value+'&id='+data.RecordID;
                else
                        query = '../includes/dataproxy.php?query=superagents&type=update&column=Remainder&primaryKey=SAgentID&newvalue='+value+'&id='+data.RecordID;


                ajaxLoadingPanel.show();
                YAHOO.util.Connect.asyncRequest('GET', query, {
                                   success: function(o) {

                                             try {

                                                    var r = YAHOO.lang.JSON.parse(o.responseText);
                                                }
                                                catch (x) {

                                                    alert("JSON Parse failed!");
                                                    return;
                                                }


                                                if (data.AgentType == 'agent') {

                                                        var dRecord = AgentDataTable.getRecordSet().getRecord(eval(data.RowID));
                                                        var SetCol = AgentDataTable.getColumn('Remainder');
                                                    	AgentDataTable.updateCell ( dRecord , SetCol , value );

                                                        YAHOO.util.Dom.get("Money").value = '0';
                                                        YAHOO.util.Dom.get("in").checked = true;


                                                         if  (eval(data.radiobuttons)==2)
                                                              value = eval(SelectedSAgentRecord._oData.Remainder) + eval(data.Money);
                                                          else
                                                              value = eval(SelectedSAgentRecord._oData.Remainder) - eval(data.Money);


                                                        query = "../includes/dataproxy.php?query=superagents&type=update&column=Remainder&primaryKey=SAgentID&newvalue="+value+"&id="+SelectedSAgentID;
                                                        YAHOO.util.Connect.asyncRequest('GET', query, {
                                                        success: function(o) {

                                                            try {

                                                                    var r = YAHOO.lang.JSON.parse(o.responseText);
                                                                }
                                                                catch (x) {

                                                                    alert("JSON Parse failed!");
                                                                    return;
                                                                }

                                                                ajaxLoadingPanel.hide();
                                                                YAHOO.example.alert('Οι αλλαγές αποθηκεύτηκαν.');

                                                                dRecord = DataTable.getRecordSet().getRecord(SelectedSAgentRecord);
                                                                SetCol = DataTable.getColumn('Remainder');
                                                            	DataTable.updateCell ( dRecord , SetCol , value );

                                                                this.cancel();

                                                         },
                                                          failure: function(o) {
                                                                 alert('Παρουσιάστηκε κάποιο σφάλμα στην ενημέρωση του υπολοίπου του Super Agent.');
                                                          },
                                                          scope: this
                                                         }  );




                                                } else {
                                                        var dRecord = DataTable.getRecordSet().getRecord(eval(data.RowID));
                                                        var SetCol = DataTable.getColumn('Remainder');
                                                    	DataTable.updateCell ( dRecord , SetCol , value );
                                                        ajaxLoadingPanel.hide();
                                                        YAHOO.example.alert('Οι αλλαγές αποθηκεύτηκαν.');
                                                        YAHOO.util.Dom.get("Money").value = '0';
                                                        YAHOO.util.Dom.get("in").checked = true;
                                                        this.cancel();
                                                }






                                  },
                                  failure: function(o) {
                                         alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή σας δεν αποθηκεύτηκε.');
                                  },
                                  scope: this
                     }  );


          	};

          	var handleCancel = function() {
                YAHOO.util.Dom.get("Money").value = '0';
                YAHOO.util.Dom.get("in").checked = true;
          		this.cancel();
          	};


          	// Instantiate the Dialog
          	YAHOO.example.container.dialog1 = new YAHOO.widget.Dialog("dialog1",
          							{ width : "36em",
          							  fixedcenter : true,
          							  visible : false,
          							  constraintoviewport : true,
          							  buttons : [ { text:"Αποθήκευση", handler:handleSubmit, isDefault:true },
          								      { text:"Ακύρωση", handler:handleCancel } ]
          							});









          	// Render the Dialog
          	YAHOO.example.container.dialog1.render();

          }



          YAHOO.util.Event.onDOMReady(init);









         YAHOO.util.Event.addListener(window, "load", function() {
          YAHOO.example.paginated =  function() {


           var myColumnDefs = [
                {key:'linkgo', label:'', className: 'linkgo-button', action:'linkgo'},
                {key:"SAgentID", label:"SAgentID", formatter:YAHOO.widget.DataTable.formatNumber, hidden:true, isPrimaryKey:true},
                {key:"Name", label:"ΟΝΟΜΑ",  formatter:YAHOO.widget.DataTaformatTextring ,sortable:true},
                {key:"City", label:"ΠΟΛΗ",  formatter:YAHOO.widget.DataTablformatTextng,  sortable:true},
                {key:"Remainder", label:"ΥΠΟΛΟΙΠΟ", formatter:YAHOO.widget.DataTable.formatCurrency,  sortable:true},
                {key:"LastLogin", label:"ΤΕΛ. ΣΥΝΑΛ.", formatter:YAHOO.widget.DataTable.formatText, sortable:true},
                {key:"RegDate", label:"ΕΓΓΡΑΦΗ", formatter:YAHOO.widget.DataTable.formatDate, sortable:true},
                {key:"Active", label:"ΕΝΕΡΓΟΣ", formatter:YAHOO.widget.DataTable.formatCheckbox, sortable:true},
                {key:'Transfer', label:'', className: 'transfer-button', action:'transfer', width:15}

            ];



            myDataSource = new YAHOO.util.XHRDataSource("../includes/dataproxy.php?");
            myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSON;
            myDataSource.connXhrMode = "queueRequests";




            myDataSource.responseSchema = {
                  resultsList: "DataSet.items",
                  fields: [
                  {key:"SAgentID",parser:"number"},
                  {key:"Name",parser:"string"},
                  {key:"City",parser:"string"},
                  {key:"Remainder",parser:"number"},
                  {key:"LastLogin",parser:parseSQLDate},
                  {key:"RegDate",parser:parseSQLDate},
                  {key:"Active",parser:"number"},
                  "transfer"
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
                    initialRequest:"query=superagents&type=select&primaryKey=SAgentID",
                    // Sorting and pagination will be routed to the server via generateRequest
	                dynamicData : false,
	                height:"20em"
	        };

            DataTable = new YAHOO.widget.ScrollingDataTable("paginated", myColumnDefs, myDataSource, oConfigs  );




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

            DataTable.subscribe("initEvent",function(oArgs) {

                if (DataTable.getRecordSet().getLength() > 0) {
                          var recset = DataTable.getRecordSet().getRecord(0)._oData;

                          SelectedSAgentID = recset.SAgentID;
                          SelectedSAgentRecord = DataTable.getRecordSet().getRecord(0);

                          var oUpdateTableCallBack = {
                              success :AgentDataTable.onDataReturnReplaceRows,
                              failure :AgentDataTable.onDataReturnReplaceRows,
                              scope   :AgentDataTable
                          };

                         var sqlquery = "query=agents&type=select&primaryKey=AgentID&whereID=" + SelectedSAgentID;
                         AgentDataTable.getDataSource().sendRequest(sqlquery, oUpdateTableCallBack);
                }

             });


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

                var column = this.getColumn(target);
                var record = this.getRecord(target);
                var value = record.getData(this.getColumn('SAgentID').key);



                switch (column.action) {



                    case 'linkgo':

                             // Sends a request to the DataSource for more data
                              var oUpdateTableCallBack = {
                                  success :function (oRequest , oResponse , oPayload) {

                                  				AgentDataTable.onDataReturnReplaceRows(oRequest,oResponse,oPayload);
                                  				ajaxLoadingPanel.hide();

                              				},
                                  failure :AgentDataTable.onDataReturnReplaceRows,
                                  scope   :AgentDataTable
                              };
                             ajaxLoadingPanel.show();
                             SelectedSAgentID = value;
                             SelectedSAgentRecord = record;
                             var sqlquery = "query=agents&type=select&primaryKey=AgentID&whereID=" + SelectedSAgentID;
                             AgentDataTable.getDataSource().sendRequest(sqlquery, oUpdateTableCallBack);

                             break;

                    case 'transfer':

                            YAHOO.util.Dom.get("RowID").value = this.getRecordIndex(target);
                            YAHOO.util.Dom.get("AgentType").value = 'superagent';
                            YAHOO.util.Dom.get("RecordID").value = record.getData((this.getColumn('SAgentID').key));
                            YAHOO.util.Dom.get("UserName").value = record.getData((this.getColumn('Name').key));
                            YAHOO.util.Dom.get("Remainder").value = "€" + eval(record.getData((this.getColumn('Remainder').key))).toFixed(2);
                            YAHOO.util.Dom.get("RemainderSAgent").value = "€" + eval(record.getData((this.getColumn('Remainder').key))).toFixed(2);
                            YAHOO.example.container.dialog1.show();
                            break;
                    default:DataTable.onEventShowCellEditor(oArgs);
                            break;
                }

            });











			//*************************************************************************

           var AgentColumnDefs = [

                {key:"AgentID", label:"AGENT", formatter:YAHOO.widget.DataTable.formatNumber, hidden:true, isPrimaryKey:true},
                {key:"SAgentID", label:"S.AGENT", formatter:formatSagents, width:100, sortable:true},
				{key:"Name", label:"AGENT", formatter:YAHOO.widget.DataTable.formatString ,sortable:true},
                {key:"City", label:"ΠΟΛΗ",  formatter:YAHOO.widget.DataTable.formatString,  sortable:true},
                {key:"Remainder", label:"ΥΠΟΛΟΙΠΟ", formatter:YAHOO.widget.DataTable.formatCurrency,  sortable:true},
                {key:"LastLogin", label:"ΤΕΛ. ΣΥΝΑΛ.", formatter:YAHOO.widget.DataTable.formatText, sortable:true},
                {key:"RegDate", label:"ΕΓΓΡΑΦΗ", formatter:YAHOO.widget.DataTable.formatDate, sortable:true},
                {key:"Active", label:"ΕΝΕΡΓΟΣ", width:50, formatter:YAHOO.widget.DataTable.formatCheckbox, sortable:true},
                {key:'Transfer', label:'', className: 'transfer-button', action:'transfer', width:15}

            ];

            AgentDataSource = new YAHOO.util.XHRDataSource("../includes/dataproxy.php?");
            AgentDataSource.responseType = YAHOO.util.DataSource.TYPE_JSON;
            AgentDataSource.connXhrMode = "queueRequests";




            AgentDataSource.responseSchema = {
                  resultsList: "DataSet.items",
                  fields: [
                  {key:"AgentID",parser:"number"},
                  {key:"SAgentID",parser:"string"},
                  {key:"Name",parser:"string"},
                  {key:"City",parser:"string"},
                  {key:"Remainder",parser:"number"},
                  {key:"LastLogin",parser:parseSQLDate},
                  {key:"RegDate",parser:parseSQLDate},
                  {key:"Active",parser:"number"},
                  "transfer"

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
                    initialRequest:"query=agents&type=select&primaryKey=AgentID&whereID=-1",
                    // Sorting and pagination will be routed to the server via generateRequest
	                dynamicData : false,
	                height:"20em"

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
            AgentDataTable.subscribe("cellMouseoverEvent", highlightEditableCell);
	        AgentDataTable.subscribe("cellMouseoutEvent", AgentDataTable.onEventUnhighlightCell);
            AgentDataTable.subscribe('cellClickEvent',function(oArgs) {


                var target = oArgs.target;

                column = this.getColumn(target);
                record = this.getRecord(target);



                switch (column.action) {


                    case 'transfer':

                            YAHOO.util.Dom.get("RowID").value = this.getRecordIndex(target);
                            YAHOO.util.Dom.get("AgentType").value = 'agent';
                            YAHOO.util.Dom.get("RecordID").value = record.getData((this.getColumn('AgentID').key));
                            YAHOO.util.Dom.get("UserName").value = record.getData((this.getColumn('Name').key));
                            YAHOO.util.Dom.get("Remainder").value = "€" + eval(record.getData((this.getColumn('Remainder').key))).toFixed(2);
                            YAHOO.util.Dom.get("RemainderSAgent").value = "€" + eval(DataTable.getRecordSet().getRecord(SelectedSAgentRecord)._oData.Remainder).toFixed(2);


                            YAHOO.example.container.dialog1.show();
                            break;
                    default:AgentDataTable.onEventShowCellEditor(oArgs);
                            break;
                }

            });









            var myTabView = new YAHOO.widget.TabView("tvcontainer");
	        myTabView.getTab(0).addListener("click", function() {DataTable.onShow(); AgentDataTable.onShow();})


            return {
             oDS : myDataSource,
             oDSA: AgentDataSource,
             oDT : DataTable,
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
</div>

</BODY>
</HTML>



