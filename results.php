<?php
 session_start();
 include 'includes/statistics.php';
 $_SESSION["user/id"]="guest";

 ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">

<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE>VelvetBet - Στοιχήματα Ποδοσφαίρου</TITLE>
 <?php include 'includes/metatagsgr.php' ?>


<link href="betplatform.css" rel="stylesheet" type="text/css">


<link rel="stylesheet" type="text/css" href="build/fonts/fonts-min.css" />
<link rel="stylesheet" type="text/css" href="build/datatable/assets/skins/sam/datatable.css" />
<link rel="stylesheet" type="text/css" href="build/button/assets/skins/sam/button.css" />
<link rel="stylesheet" type="text/css" href="build/container/assets/skins/sam/container.css" />


<script type="text/javascript" src="build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="build/element/element-min.js"></script>
<script type="text/javascript" src="build/button/button-min.js"></script>
<script type="text/javascript" src="build/datasource/datasource-min.js"></script>
<script type="text/javascript" src="build/datatable/datatable-min.js"></script>
<script type="text/javascript" src="build/container/container-min.js"></script>
<script type="text/javascript" src="build/connection/connection-min.js"></script>
<script type="text/javascript" src="build/json/json-min.js"></script>


<script type="text/javascript" src="js/dateformat.js"></script>

<!--begin custom header content for this example-->
<style type="text/css">



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

.yui-skin-sam .yui-dt td.mon {
    background-color: #87CEEB;
    Color:black;

}

.yui-skin-sam .yui-dt td.tue {
    background-color: #F08080;
    Color:black;

}


.yui-skin-sam .yui-dt td.wed {
    background-color: #3E3EFF;
    Color:white;

}

.yui-skin-sam .yui-dt td.thu {
    background-color: #E6E6FA;
    Color:black;

}

.yui-skin-sam .yui-dt td.fri {
    background-color: #FFFACD;
    Color:black;

}

.yui-skin-sam .yui-dt td.sat {
    background-color: #F5DEB3;
    Color:black;

}

.yui-skin-sam .yui-dt td.sun {
    background-color: #90EE90;
    Color:black;

}

.yui-skin-sam .yui-dt td.results {
    background-color: #FFFFD2;
    Color:black;
    font-weight: bold;

}


</style>

</HEAD>


<BODY class="yui-skin-sam"  oncontextmenu="return false">

<div align=top>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
  <TBODY>
  <TD style="VERTICAL-ALIGN: top;" width="100%" >

      <Table border=0 width="750">
      <TR>
        <TD class=logoback colSpan=2>
                    <IMG src="grafix/Logo.png"  align=absBottom>
        </TD>
      </TR>

        <TR>
            <TD width="100%" align="left">



                <table>
                <tr>
                    <td bgcolor="#FFD700" class=TextInfo style="TEXT-ALIGN :center;COLOR:BLACK" height=15 width="750px">

                            <?php
                                $Days = array(1=>'Δευτέρα',2=>'Τρίτη',3=>'Τετάρτη',4=>'Πέμπτη',5=>'Παρασκευή',6=>'Σάββατο',7=>'Κυριακή');
                                $DayOfWeek = date('N');

                                if ($DayOfWeek !=1) {
                                        $StartPeriod = $DayOfWeek - 2;
                                        $EndPeriod = 7 - $DayOfWeek + 1;
                                        $MiddlePeriod = 5 - $DayOfWeek;
                                } else {

                                    $StartPeriod = 6;
                                    $EndPeriod = 0;
                                    $MiddlePeriod = 4;
                                }

                                $ValidStartPeriodBigZone  = mktime(0, 0, 0, date("m")  , date("d")-$StartPeriod, date("Y"));
                                $ValidEndPeriodBigZone = mktime(0, 0, 0, date("m")  , date("d")+$EndPeriod, date("Y"));
                                $MiddleDateBetweenPeriods =  mktime(0, 0, 0, date("m")  , date("d")+$MiddlePeriod, date("Y"));

                                if ( ( $DayOfWeek >=2 ) && ( $DayOfWeek <=4 ) ) {
                                        $StartPeriod = $DayOfWeek - 2;
                                        $EndPeriod = 4 - $DayOfWeek;
                                } else {

                                      if ($DayOfWeek !=1) {
                                              $StartPeriod = $DayOfWeek - 5;
                                              $EndPeriod = 7 - $DayOfWeek + 1;
                                      } else {

                                          $StartPeriod = 3;
                                          $EndPeriod = 0;
                                      }

                                }

                                $ValidStartPeriodSmallZone  = mktime(0, 0, 0, date("m")  , date("d")-$StartPeriod, date("Y"));
                                $ValidEndPeriodSmallZone = mktime(0, 0, 0, date("m")  , date("d")+$EndPeriod, date("Y"));

                            ?>
                            <div id="PreriodStr"></div>


                            <script type="text/javascript">
                            var FullPeriodStr = '<?php echo "<strong>Κουπόνι - Από ".$Days[date("N",$ValidStartPeriodBigZone)]." ".date("d/m",$ValidStartPeriodBigZone)." Έως #<strong>"?>';
                            var HalfPeriodStr = '<?php echo "<strong>Κουπόνι - Από ".$Days[date("N",$ValidStartPeriodSmallZone)]." ".date("d/m",$ValidStartPeriodSmallZone)." Έως ".$Days[date("N",$ValidEndPeriodSmallZone)]." ".date("d/m",$ValidEndPeriodSmallZone)."<strong>"?>';
                            var MiddlePeriodDate = '<?php echo date("Y-m-d",$MiddleDateBetweenPeriods)?>';
                            var ValidStartPeriodBigZone = '<?php echo date("Y-m-d",$ValidStartPeriodBigZone)?>';
                            var ValidEndPeriodBigZone = '<?php echo date("Y-m-d",$ValidEndPeriodBigZone)?>';
                            var ValidStartPeriodSmallZone = '<?php echo date("Y-m-d",$ValidStartPeriodSmallZone)?>';
                            var ValidEndPeriodSmallZone = '<?php echo date("Y-m-d",$ValidEndPeriodSmallZone)?>';
                            </script>
                    </td>

                </tr>

                </table>

            </TD>
        </TR>
        <TR>
            <TD class="yui-skin-sam" style="FONT-SIZE: 10px;"  valign="top" width="100%" align="left">
                   <div id="coupon" align="left"></div>
            </TD>
        </TR>
        <TR>

            <TD class="yui-skin-sam" style="FONT-SIZE: 10px;"  valign="top" width="100%" align="center">
                 <br><br>
                 <INPUT class=ButtonOrange id="printbutton" type="button" value="     Εκτύπωση     " onmouseover="this.style.cursor='pointer'" onclick="javascript:window.print();">
                 <br><br>
                 <br><br>
            </TD>
        </TR>


        </Table>

        <script type="text/javascript">

        var oDateShow;
		var myDataTable;
        var elDropDownSpecials;

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




         YAHOO.util.Event.addListener(window, "load", function() {
         YAHOO.example.CustomFormatting =  function() {
         var Dom = YAHOO.util.Dom;


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

                    YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "time");
                    var timerec=oRecord.getData("Time");
                    //check if time keeps the seconds. We dont need them so, make them dissappear.
                    if (timerec.length > 5) {


                         timerec=timerec.substring(0, 5);


                    }
                    elCell.innerHTML = timerec;

            };


           var CustomformatNumber = function(elCell, oRecord, oColumn, oData) {


                    if(oColumn.field == "Goal_1"){
                        YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "goal");
                        var value = oRecord.getData("Goal_1");
                        var formatted_value = YAHOO.util.Number.format(value, {decimalPlaces:2} );
                        elCell.innerHTML = formatted_value;
                    }
                    else if(oColumn.field == "Goal_x"){
                        YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "goal");
                        var value = oRecord.getData("Goal_x");
                        var formatted_value = YAHOO.util.Number.format(value, {decimalPlaces:2} );
                        elCell.innerHTML = formatted_value;
                    }
                    else if(oColumn.field == "Goal_2"){
                        YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "goal");
                        var value = oRecord.getData("Goal_2");
                        var formatted_value = YAHOO.util.Number.format(value, {decimalPlaces:2} );
                        elCell.innerHTML = formatted_value;
                    }
                    else if(oColumn.field == "Under"){
                        YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "goal");
                        var value = oRecord.getData("Under");
                        var formatted_value = YAHOO.util.Number.format(value, {decimalPlaces:2} );
                        elCell.innerHTML = formatted_value;
                    }
                    else if(oColumn.field == "Over"){
                        YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "goal");
                        var value = oRecord.getData("Over");
                        var formatted_value = YAHOO.util.Number.format(value, {decimalPlaces:2} );
                        elCell.innerHTML = formatted_value;
                    }
                    else if(oColumn.field == "GG"){
                        YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "goal");
                        var value = oRecord.getData("GG");
                        var formatted_value = YAHOO.util.Number.format(value, {decimalPlaces:2} );
                        elCell.innerHTML = formatted_value;
                    }
                    else if(oColumn.field == "NG"){
                        YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "goal");
                        var value = oRecord.getData("NG");
                        var formatted_value = YAHOO.util.Number.format(value, {decimalPlaces:2} );
                        elCell.innerHTML = formatted_value;
                    }

           };

            var DayFormatter = function(elCell, oRecord, oColumn, oData) {
                if(oRecord.getData("Date") == 'ΔΕΥΤΕΡΑ') {
                    YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "mon");
                    elCell.innerHTML = oRecord.getData("Date");
                }
                else if(oRecord.getData("Date") == 'ΤΡΙΤΗ'){
                    YAHOO.util.Dom.replaceClass(elCell.parentNode, "","tue");
                    elCell.innerHTML = oRecord.getData("Date");
                }
                else if(oRecord.getData("Date") == 'ΤΕΤΑΡΤΗ'){
                    YAHOO.util.Dom.replaceClass(elCell.parentNode, "","wed");
                    elCell.innerHTML = oRecord.getData("Date");
                }
                else if(oRecord.getData("Date") == 'ΠΕΜΠΤΗ'){
                    YAHOO.util.Dom.replaceClass(elCell.parentNode, "","thu");
                    elCell.innerHTML = oRecord.getData("Date");
                }
                else if(oRecord.getData("Date") == 'ΠΑΡΑΣΚΕΥΗ'){
                    YAHOO.util.Dom.replaceClass(elCell.parentNode, "","fri");
                    elCell.innerHTML = oRecord.getData("Date");
                }
                else if(oRecord.getData("Date") == 'ΣΑΒΒΑΤΟ'){
                    YAHOO.util.Dom.replaceClass(elCell.parentNode, "","sat");
                    elCell.innerHTML = oRecord.getData("Date");
                }
                else if(oRecord.getData("Date") == 'ΚΥΡΙΑΚΗ'){
                    YAHOO.util.Dom.replaceClass(elCell.parentNode, "","sun");
                    elCell.innerHTML = oRecord.getData("Date");
                }
            };

            var ResultFormatter = function(elCell, oRecord, oColumn, oData) {

                    YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "results");
                    elCell.innerHTML = oData;

            };




            var FillSpecials = ['Goal_1','Goal_x','Goal_2','Under','Over','GG','NG','de_1ORX','de_XOR2','de_1OR2','HMI_1','HMI_X','HMI_2','HT_11','HT_1X','HT_12','HT_X1','HT_XX','HT_X2','HT_21','HT_2X','HT_22','SS_10','SS_20','SS_21','SS_30',
                      'SS_31','SS_32','SS_40','SS_41','SS_42','SS_43','SS_00','SS_11','SS_22','SS_33','SS_01','SS_02','SS_12','SS_03','SS_13','SS_23','SS_04','SS_14','SS_24','SS_34',
                      'TG_01','TG_23','TG_46','TG_7'];

            var FillSpecialsLabel = ['1','X','2','Under','Over','GG','NG','ΔΕ 1ήΧ','ΔΕ Χή2','ΔΕ 1ή2','HMI 1','HMI X','HMI 2','HT 1-1','HT 1-X','HT 1-2','HT X-1','HT X-X','HT X-2','HT 2-1','HT 2-X','HT 2-2','ΣΣ 1-0','ΣΣ 2-0','ΣΣ 2-1','ΣΣ 3-0',
                           'ΣΣ 3-1','ΣΣ 3-2','ΣΣ 4-0','ΣΣ 4-1','ΣΣ 4-2','ΣΣ 4-3','ΣΣ 0-0','ΣΣ 1-1','ΣΣ 2-2','ΣΣ 3-3','ΣΣ 0-1','ΣΣ 0-2','ΣΣ 1-2','ΣΣ 0-3','ΣΣ 1-3','ΣΣ 2-3','ΣΣ 0-4','ΣΣ 1-4','ΣΣ 2-4','ΣΣ 3-4',
                           'TG 0-1','TG 2-3','TG 4-6','TG 7+'];


              elDropDownSpecials = new YAHOO.widget.DropdownCellEditor({dropdownOptions:[{label:"-Επιλέξτε-",value:0}],disableBtns:true});
              var formatSpecials = function(elCell, oRecord, oColumn, oData) {

					for (var i=0;i<elDropDownSpecials.dropdownOptions.length;i++) {
						if ( elDropDownSpecials.dropdownOptions[i].value == oData ) {
							elCell.innerHTML = elDropDownSpecials.dropdownOptions[i].label;

							return;
						}

					}


                   counter=0;

                    for (var i=0;i < FillSpecials.length;i++) {
                          var value = eval(this.getRecord(oRecord)._oData[ FillSpecials[i] ]);

                          if ( value !=0 ) {

                              counter++;
                          }

                     }


                   elCell.innerHTML = "-Επιλέξτε- ("+counter.toString()+")";

		        };


            // Add the custom formatter to the shortcuts
            YAHOO.widget.DataTable.Formatter.myCustomEE = myEEFormatter;
            YAHOO.widget.DataTable.Formatter.myCustomTime = myTimeFormatter;



            var myColumnDefs = [





				{key:"Date", label:"ΗΜΕΡΑ",  formatter:DayFormatter, width:65,sortable:false},
				{key:"ShortcutName", label:"Δ.",  width:40,sortable:false},
                {key:"Time", label:"ΩΡΑ", formatter:myTimeFormatter,sortable:false},
                {key:"Code", label:"ΚΩΔ", formatter:"string", width:20,sortable:false},
                {key:"HomeTeam", label:"ΓΗΠΕΔΟΥΧΟΣ", sortable:false, width:150},
                {key:"HostTeam", label:"ΦΙΛΟΞΕΝΟΥΜΕΝΗ", sortable:false, width:150},
                {key:"HalfTimeScore", label:"ΗΜΙΧΡΟΝΟ",formatter:ResultFormatter, width:60},
                {key:"FullTimeScore", label:"ΤΕΛΙΚΟ", formatter:ResultFormatter, width:60}





        ];




            var myDataSource = new YAHOO.util.DataSource("includes/dataproxy.php?");
            myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSON;
            myDataSource.connXhrMode = "queueRequests";


            myDataSource.responseSchema = {
                resultsList: "DataSet.items",
                // Use the parse methods to populate the RecordSet with the right data types
               fields: [
                    {key:"CouponID", parser:"number"},
                    {key:"IsoDate",parser:function (oDate){

                            return parseSQLDate(oDate,1);

                    }},
					{key:"Date", parser:parseDate},
					{key:"Country", parser:"string"},
					{key:"ShortcutName", parser:"string"},
                    {key:"Time", parser:"string"},
                    {key:"Code", parser:"number"},
                    {key:"EE", parser:"number"},
                    {key:"Goal_1", parser:"number"},
                    {key:"HomeTeam", parser:"string"},
                    {key:"Goal_x", parser:"number"},
                    {key:"HostTeam", parser:"string"},
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
                    {key:"HalfTimeScore",parser:"string"},
                    {key:"FullTimeScore",parser:"string"}


                ],
                metaFields: {totalRecords: "DataSet.totalRecords"} // Access server-provided dynamic value

            };


            var jsDate = new Date();
            var day = jsDate.getDay();

            if ( (day >= 2) && (day <= 4) ) {
                	StartDate =  ValidStartPeriodBigZone;
                    EndDate = ValidEndPeriodBigZone;
            } else {
                	StartDate =  ValidStartPeriodSmallZone;
                    EndDate = ValidEndPeriodSmallZone;

            }


            var oConfigs = {

                    dateOptions:{format:"%d/%m/%Y"},
                    selectionMode:"single",
                    numberOptions:{decimalPlaces:2, thousandsSeparator:","},
                    MSG_EMPTY:"Δεν υπάρχουν εγγραφές",
                    draggableColumns:false,
                    initialRequest:"query=coupons&type=select&primaryKey=CouponID&cascade=yes&whereID=RSQL"
	        };

            myDataTable = new YAHOO.widget.DataTable("coupon", myColumnDefs, myDataSource,oConfigs  );
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

            myDataTable.subscribe("cellMouseoverEvent", highlightEditableCell);
	        myDataTable.subscribe("cellMouseoutEvent", myDataTable.onEventUnhighlightCell);
            myDataTable.subscribe("cellClickEvent", myDataTable.onEventShowCellEditor);

            myDataTable.subscribe("initEvent",function() {

                var recset = myDataTable.getRecordSet().getRecord(myDataTable.getRecordSet().getLength()-1)._oData;
                var jsDate = new Date(recset.IsoDate);


                var weekday=new Array(7);
                weekday[0]="Κυριακή";
                weekday[1]="Δευτέρα";
                weekday[2]="Τρίτη";
                weekday[3]="Τετάρτη";
                weekday[4]="Πέμπτη";
                weekday[5]="Παρασκευή";
                weekday[6]="Σάββατο";

                var strEndDate=weekday[jsDate.getDay()]

                var Day = jsDate.getDate();
                var Month = jsDate.getMonth();
                Month++;                 

                strEndDate += " "+Day+"/"+Month;



                FullPeriodStr = FullPeriodStr.replace("#", strEndDate);
                YAHOO.util.Dom.get('PreriodStr').innerHTML = FullPeriodStr;






             });

           myDataTable.doBeforeShowCellEditor = function(oCellEditor) {


                var oEditor = oCellEditor;
		        var oRecord = oEditor.getRecord();
                var options = "";
                var counter =0;


   				var recset = myDataTable.getRecordSet().getRecord(oRecord)._oData;




                 for (var i=0;i< FillSpecials.length;i++) {
                        var value = parseFloat(myDataTable.getRecordSet().getRecord(oRecord)._oData[ FillSpecials[i] ]);
                        var valFixed=value.toFixed(2);

                        if ( value !=0 ) {

                            options = options + '{\"label\":"'+FillSpecialsLabel[i]+' ('+ valFixed.toString() +')\",\"value\":"'+valFixed.toString()+'\"},';
                            counter++;
                        }

                    }


                options = '[{"label":"-Επιλέξτε- ('+counter.toString()+')","value":"-1"},'+options.substr(0, options.length-1)+']';


                oEditor.dropdownOptions = YAHOO.lang.JSON.parse(options);
                oEditor.setOptions();

                return true;
            };

           myDataTable.subscribe("editorSaveEvent", function(oArgs){


                var oEditor = oArgs.editor;
        	    var newData = oArgs.newData;
        	    var oldData = oArgs.oldData;
    			var elCell = oEditor.cell;
		        var oRecord = oEditor.getRecord();
           		var oColumn = oEditor.getColumn();
                var value = oRecord.getData(oColumn.key);

                if ( (oldData != newData) && (oldData != null) )
                {





                }

                var SetCol = this.getColumn('Special');
                this.updateCell ( oRecord , SetCol , -1 );
             });


             return {
                oDS: myDataSource,
                oDT: myDataTable
            };
        }();
});


    </script>



    </TD>

</TBODY>
</TABLE>
</div>

</BODY>
</HTML>
