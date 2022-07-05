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
<link rel="stylesheet" type="text/css" href="../build/container/assets/skins/sam/container.css" />
<link type="text/css" rel="stylesheet" href="../build/calendar/assets/skins/sam/calendar.css">
<link rel="stylesheet" type="text/css" href="../build/menu/assets/skins/sam/menu.css" />

<script type="text/javascript" src="../build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="../build/container/container-min.js"></script>
<script type="text/javascript" src="../build/menu/menu-min.js"></script>
<script type="text/javascript" src="../build/dragdrop/dragdrop-min.js"></script>
<script type="text/javascript" src="../build/element/element-min.js"></script>
<script type="text/javascript" src="../build/button/button-min.js"></script>
<script type="text/javascript" src="../build/datasource/datasource-min.js"></script>
<script type="text/javascript" src="../build/datatable/datatable-min.js"></script>
<script type="text/javascript" src="../build/tabview/tabview-min.js"></script>
<script type="text/javascript" src="../build/paginator/paginator-min.js"></script>
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

.yui-skin-sam .yui-dt td.BetType {
    background-color: #FFFFD7;
    Color:black;
}


/* Class for marked rows */
.yui-skin-sam .yui-dt tr.BetTypeTotalRow,
.yui-skin-sam .yui-dt tr.BetTypeTotalRow td.yui-dt-asc,
.yui-skin-sam .yui-dt tr.BetTypeTotalRow td.yui-dt-desc,
.yui-skin-sam .yui-dt tr.BetTypeTotalRow td.yui-dt-asc,
.yui-skin-sam .yui-dt tr.BetTypeTotalRow td.yui-dt-desc {
    background-color: black;
    Color:white;
    font-weight: bold
}

.yui-skin-sam .yui-dt td.BetTypeTotal {
    background-color: black;
    Color:white;
    font-weight: bold
}

.yui-button#pushbuttonFind button {

    padding-left: 3em;
    background: url(../grafix/search.png) 10% 50% no-repeat;


}

.yui-skin-sam .yui-dt td.Lose {

    Color:#FF0000;

}

.yui-skin-sam .yui-dt td.Win {

    Color:#000000;

}

.calweekdaycell {
  background: #FFD700
}

#menubutton1 {

    width: 8em;

}

#menubutton2 {

    width: 22em;


}

#menubutton3 {

    width: 22em;


}

.info-button {
	cursor:pointer;
	background: #FFFFCC url(../grafix/info.png) no-repeat center center;
	width:16px;height:16px;
}

.yui-skin-sam .yui-dt td.BetType {
    background-color: transparent;
    Color:#006699;
}

.yui-skin-sam .yui-dt td.PaymentYes {
    background-color: #EEFFE8;
    Color:#006600;
}

.yui-skin-sam .yui-dt td.PaymentNo {
    background-color: #FFF0F0;
    Color:#FF0000;
}

.yui-skin-sam .yui-dt td.StatusOpen {
    background-color: #F0E6FF;
    Color:#000000;
}

.yui-skin-sam .yui-dt td.StatusClosed {
    background-color: #D2F0FF;
    Color:#000000;
}

.yui-skin-sam .yui-dt td.StatusWon {
    background-color: #EEFFCA;
    Color:#000000;
}

.yui-skin-sam .yui-dt td.StatusLost {
    background-color: #FFB9B9;
    Color:#000000;
}

.yui-skin-sam .yui-dt td.StatusCanceled {
    background-color: #EFEFBE;
    Color:#000000;
}



</style>

</HEAD>


<BODY class="yui-skin-sam"  oncontextmenu="return false">

<div align=top>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
  <TBODY>


  <TR>
    <TD class=logoback colSpan=2 height=10></TD>
  </TR>


    <TR>
    <TD style="VERTICAL-ALIGN: top;" width="100%" >


      <Table border=0 width="100%">
        <TR>
            <TD class="yui-skin-sam" style="FONT-SIZE: 11px;"  valign="top" width="100%" style="FONT-SIZE: 10px;">

                <div id="tvcontainer" class="yui-navset">

                    <ul class="yui-nav">
                        <li class="selected"><a href="#tab1"><em>Λίστα δελτίων που κερδίζουν ή χάνουν</em></a></li>
                    </ul>
                  <div class="yui-content">
                    <br><br>
                    <div id="paginated" align="center"></div>
                    <br><br>

    				    <hr width="100%" style="Color:red;"></hr>
                        <br>
                        <div id="paginated" align="left"></div>

                        <br><br>
                        <table  width=400px>
                        <tr>
                            <td width=200px style="background-color:#BFD5FF; Color:#333333;font-weight: bold;font-size: 12px;height: 30px;" align=center>
                                Αρ. Στοιχημάτων
                            </td>
                            <td style="background-color:#FF6600;Color:#FFFFFF;font-weight: bold;font-size: 12px;;padding-left: 10px">
                               <div id="TotalBets">0</div>
                            </td>
                        </tr>


                        <tr>
                            <td width=200px style="background-color:#BFD5FF; Color:#333333;font-weight: bold;font-size: 12px;height: 30px;" align=center>
                                Χαμένα
                            </td>
                            <td style="background-color:#FF6600;Color:#FFFFFF;font-weight: bold;font-size: 12px;;padding-left: 10px">
                               <div id="Cost">€ 0.0</div>
                            </td>
                        </tr>


                        <tr>
                            <td width=200px style="background-color:#BFD5FF; Color:#333333;font-weight: bold;font-size: 12px;height: 30px;" align=center>
                                Κερδισμένα
                            </td>
                            <td style="background-color:#FF6600;Color:#FFFFFF;font-weight: bold;font-size: 12px;padding-left: 10px">
                               <div id="FinalUserProfit">€ 0.0</div>
                            </td>
                        </tr>

                        </table>
                        <br><br>



                  </div>
                </div>


            </TD>
        </TR>



        </Table>



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

     <Script type="text/javascript">

        var DataTable;
        var ViewFilter = '*';
        var ViewAgentFilter = '*';
        var ViewSAgentFilter = '*'



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

          parseDate = function(ISOdate)
          {

              var year = ISOdate.substr(0,4);
              var month =  ISOdate.substr(5,2);
              var day =  ISOdate.substr(8);



              var jsdate = new Date (month+"/"+day+"/"+year);
              var formatedDateTime = dateFormat(jsdate,"dddd");



              return formatedDateTime;
          };

        function computeTotal() {


               var Cost = 0;
               var FinalUserProfit = 0;
               var Counter = 0;


               if (DataTable.getRecordSet().getLength() < 1)
                  return;


               for(i=0;i<DataTable.getRecordSet().getLength();i++){

       				var recset = DataTable.getRecordSet().getRecord(i)._oData;


                    if ( (recset.Canceled==0) && (recset.Status<4) ) {
                        Cost = Cost + recset.Cost;
                        FinalUserProfit = FinalUserProfit + recset.FinalUserProfit;
                        Counter = Counter + 1;
                    }





               }

              YAHOO.util.Dom.get('Cost').innerHTML = '€'+Cost.toFixed(2);
              YAHOO.util.Dom.get('FinalUserProfit').innerHTML = '€'+FinalUserProfit.toFixed(2);
              YAHOO.util.Dom.get('TotalBets').innerHTML = Counter;





        }



          YAHOO.util.Event.addListener(window, "load", function() {
          YAHOO.example.userslist =  function() {


            var BetTypeFormatter = function(elCell, oRecord, oColumn, oData) {

                    YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "BetType");
                    BetType = '';

                    switch (oData) {
                        case 0 : BetType = 'Μονό';break;                        
                        case 1 : dp = parseInt(oRecord.getData("dp"));


                                if ( (oRecord.getData("UserBetsCount") - dp  ) == 2) {
                                    if (dp > 0)
                                        BetType = 'Διπλό|ΔΠ';
                                    else
                                        BetType = 'Διπλό';

                                 } else {

                                        if (dp > 0)
                                              BetType = 'Πολλαπλό|ΔΠ';
                                        else
                                              BetType = 'Πολλαπλό';
                                 }


                                 break;						
                        case 2 : BetType = 'Σύστημα';break;

                    }
                    elCell.innerHTML = BetType;
            };

            var PaymentFormatter = function(elCell, oRecord, oColumn, oData) {


                    Payment = '';

                    switch (oData) {
                        case 1 : Payment = 'Ναι';
                                 YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "PaymentYes");
                                 break;
                        case 0 : Payment = 'Όχι';
                                 YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "PaymentNo");
                                 break;


                    }
                    elCell.innerHTML = Payment;
            };


            var StatusFormatter = function(elCell, oRecord, oColumn, oData) {


                    Status = '';

                    switch (oData) {
                        case 0 : Status = 'Ανοιχτό';
                                 YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "StatusOpen");
                                 break;
                        case 1 : Status = 'Κλειστό';
                                 YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "StatusClosed");
                                 break;
                        case 2 : Status = 'Κερδισμένο';
                                 YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "StatusWon");
                                 break;
                        case 3 : Status = 'Χαμένο';
                                 YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "StatusLost");
                                 break;
                        case 4 : Status = 'Ακυρωμένο';
                                 YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "StatusCanceled");
                                 break;
                        case 5 : Status = 'Αναβλήθηκε';
                                 YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "StatusCanceled");
                                 break;

                    }
                    elCell.innerHTML = Status;
            };




           var myColumnDefs = [
                {key:'info', label:'', className: 'info-button', action:'info', width:15},
                {key:"UserBetSynopsisID", label:"ΚΩΔ. ΔΕΛΤΙΟΥ", width:90, formatter:YAHOO.widget.DataTable.formatNumber,sortable:true,isPrimaryKey:true },
                {key:"id_u", label:"ΚΩΔ. ΔΕΛ. ΧΡΗΣΤΗ", width:110, formatter:YAHOO.widget.DataTable.formatText,sortable:true,sortOptions:{defaultDir:YAHOO.widget.DataTable.CLASS_DESC} },
                {key:"id_s", hidden:true },
                {key:"SName", label:"S.AGENT", width:90, formatter:YAHOO.widget.DataTable.formatText,sortable:true },
                {key:"Name", label:"AGENT", width:90, formatter:YAHOO.widget.DataTable.formatText,sortable:true },
                {key:"DateTime", label:"ΗΜΕΡ. & ΩΡΑ ΚΑΤΑΘΕΣΗΣ", width:150, formatter:YAHOO.widget.DataTable.formatDate ,sortable:true},
                {key:"BetType", label:"ΤΥΠΟΣ", width:80, formatter:BetTypeFormatter, sortable:true},
                {key:"Cost", label:"ΚΟΣΤΟΣ ΔΕΛΤ.",  width:90, formatter:YAHOO.widget.DataTable.formatCurrency,  sortable:true, sortOptions:{defaultDir:YAHOO.widget.DataTable.CLASS_DESC}},
                {key:"PossibleProfit", label:"ΠΙΘ. ΚΕΡΔΟΣ",  width:90, formatter:YAHOO.widget.DataTable.formatCurrency,  sortable:true, sortOptions:{defaultDir:YAHOO.widget.DataTable.CLASS_DESC}},
                {key:"FinalUserProfit", label:"ΚΕΡΔΗ ΠΑΙΚΤΗ", width:90, formatter:YAHOO.widget.DataTable.formatCurrency, sortable:true, sortOptions:{defaultDir:YAHOO.widget.DataTable.CLASS_DESC}},
                {key:"Status", label:"ΚΑΤΑΣΤΑΣΗ",width:70,  formatter:StatusFormatter, sortable:true},
                {key:"Canceled", label:"ΑΚΥΡΩΜΕΝΟ",width:70,  formatter:YAHOO.widget.DataTable.formatCheckbox, sortable:true}

            ];



            var  myDataSource = new YAHOO.util.XHRDataSource("../includes/dataproxy.php?");
            myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSON;
            myDataSource.connXhrMode = "queueRequests";



            myDataSource.responseSchema = {
                  resultsList: "DataSet.items",
                  fields: [
                  "info",
                  {key:"SName",parser:"string"},
                  {key:"Name",parser:"string"},
                  {key:"UserBetSynopsisID",parser:"number"},
                  {key:"id_u",parser:"number"}, 
                  {key:"id_s",parser:"string"},
                  {key:"DateTime",parser:function (oDate){

                            return parseSQLDate(oDate,2);

                    }},
                  {key:"BetType",parser:"number"},
                  {key:"Cost",parser:"number"},
                  {key:"PossibleProfit",parser:"number"},
                  {key:"FinalUserProfit",parser:"number"},
                  {key:"Canceled",parser:"number"},
                  {key:"Status",parser:"number"},
				  {key:"UserBetsCount",parser:"number"},
				  {key:"dp",parser:"number"}
                  ],
                  metaFields: {totalRecords: "DataSet.totalRecords"} // Access server-provided dynamic value

            };



            var oConfigs = {



                    dateOptions:{format:"%d/%m/%Y"},
                    //dateOptions:{format:"%Y-%m-%d"},
                    selectionMode:"single",
                    numberOptions:{decimalPlaces:0, thousandsSeparator:","},
                    MSG_EMPTY:"Δεν υπάρχουν εγγραφές",
                    draggableColumns:true,
					currencyOptions:{prefix: "€", decimalPlaces:2, decimalSeparator:".", thousandsSeparator:","},
                    initialRequest:"query=indexedreport&type=select",
                    // Sorting and pagination will be routed to the server via generateRequest

	                dynamicData : false

	        };




            DataTable = new YAHOO.widget.DataTable("paginated", myColumnDefs, myDataSource,oConfigs );

            DataTable.subscribe("initEvent",function() {


               computeTotal();



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




                switch (column.action) {



                    case 'info':

                            var code = escape(record.getData(this.getColumn('id_s').key));
                            OpenWindow('showuserbet.php?id=' + code ,'toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=0,width=860,height=700,left=0,top=0');

                             break;


                }

            });





            var myTabView = new YAHOO.widget.TabView("tvcontainer");
	        myTabView.getTab(0).addListener("click", function() {DataTable.onShow();})

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

</BODY>
</HTML>
