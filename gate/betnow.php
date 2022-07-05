<?php
    session_start();
    include '../includes/database.php';
    include '../includes/login.php';
    include '../includes/statistics.php';

    date_default_timezone_set("Europe/Athens");




     $LoginMsg = '';
     $DB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
     mysql_select_db(DataBase, $DB) or die(mysql_error());

    if ( (!check_login('agents')) && (!check_login('superagents')) )  {

            mysql_close($DB);
            header( 'Location: ../index.php' );
    }




    $NightRestrictions = 0;
    $TimeOutFrom = 0;
    $TimeOutTo = 0;

    $result_id = mysql_query("select * from master limit 1");
    $row = mysql_fetch_assoc($result_id);
    if ($row) {

        $NightFrom = $row['NightLimitFrom'];
        $NightTo = $row['NightLimitTo'];
        $Time =time();



        if ( ( strtotime("1970-01-01 UTC ".$row['NightLimitFrom']) - strtotime("1970-01-01 UTC ".GR_Time("H:i:s",time())) ) > 0 )
            $TimeOutFrom = 0;
        else
            $TimeOutFrom = 1;


        if ( ( strtotime("1970-01-01 UTC ".GR_Time("H:i:s",time())) - strtotime("1970-01-01 UTC ".$row['NightLimitTo']) ) > 0 )
            $TimeOutTo = 0;
        else
            $TimeOutTo = 1;


        if ( ( $TimeOutFrom == 1) || ( $TimeOutTo == 1) )
            $NightRestrictions = 1;


        $LimitMona = $row['LimitMona'];
        $LimitPollapla = $row['LimitPollapla'];
        $LimitSystems = $row['LimitSystems'];


        $MaxProfit = $row['MaxProfit'];
        $MinBet = $row['MinBet'];
        $MaxBet  = $row['MaxBet'];

        if ($MaxProfit==0)
            $MaxProfit=10000;

        if ($MinBet==0)
            $MinBet=1;

        if ($MaxBet==0)
            $MaxBet=500;


    } else {

        header( 'Location: ../index.php' );
    }

    mysql_close($DB);

    if (!session_is_registered("nextValidSubmission")) {
            session_register("nextValidSubmission");
    }

    $_SESSION['nextValidSubmission'] = rand(1000000,9999999);
?>





<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<HTML>
<HEAD>
<TITLE>VelvetBet - Στοιχήματα Ποδοσφαίρου</TITLE>
 <?php include '../includes/metatagsgr.php' ?>

<link href="../betplatform.css" rel="stylesheet" type="text/css">


<link rel="stylesheet" type="text/css" href="../build/fonts/fonts-min.css" />
<link rel="stylesheet" type="text/css" href="../build/datatable/assets/skins/sam/datatable.css" />
<link rel="stylesheet" type="text/css" href="../build/paginator/assets/skins/sam/paginator.css" />
<link rel="stylesheet" type="text/css" href="../build/button/assets/skins/sam/button.css" />
<link rel="stylesheet" type="text/css" href="../build/container/assets/skins/sam/container.css" />


<script type="text/javascript" src="../build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="../build/element/element-min.js"></script>
<script type="text/javascript" src="../build/button/button-min.js"></script>
<script type="text/javascript" src="../build/datasource/datasource-min.js"></script>
<script type="text/javascript" src="../build/datatable/datatable-min.js"></script>
<script type="text/javascript" src="../build/animation/animation-min.js"></script>
<script type="text/javascript" src="../build/container/container-min.js"></script>
<script type="text/javascript" src="../build/connection/connection-min.js"></script>
<script type="text/javascript" src="../build/json/json-min.js"></script>



<script type="text/javascript" src="../js/dateformat.js"></script>

<!--begin custom header content for this example-->
<style type="text/css">


/* Remove row striping, column borders, and sort highlighting */
.yui-skin-sam tr.yui-dt-odd
{
  background-color: #FFEFC6;
  Color : black;

}

.yui-skin-sam tr.yui-dt-even
{
  background-color: #FFFEF2;
  Color : black;

}

.yui-skin-sam tr.yui-dt-odd td.yui-dt-asc,
.yui-skin-sam tr.yui-dt-odd td.yui-dt-desc,
.yui-skin-sam tr.yui-dt-even td.yui-dt-asc,
.yui-skin-sam tr.yui-dt-even td.yui-dt-desc {
    background-color: #AfAfAf;
    Color : black;
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


.delete-button {
	cursor:pointer;
	background: #FFFFCC url(../grafix/delete.png) no-repeat center center;
	width:16px;height:16px;
}

.yui-checkbox-button-disabled button{
    /* Styles for all focused Buttons here. */


    background: #161614;

}

.yui-skin-sam .yui-dt td.BetMoney {
    background-color: #FCED98;
    Color:#990066;
    font-weight: bold
}

.yui-skin-sam .yui-dt td.DescriptionFormatter {


  Color:#CC0000;
  font-weight: bold
}

.yui-tt {
  visibility:hidden;
  position:absolute;
  background-color: black;
  font-family:arial,helvetica,verdana,sans-serif;
  padding:4px 4px 4px 4px;
  border:2px solid #FCC90D; /*border width, style and color of the tooltip*/
  font:100% sans-serif;
  width:370px;
  text-align: justify;
  font-size: 11px
}

/* html, body{height:100%} */

html,body {
margin:0;
padding:0;
height:100%;
}
</style>




</HEAD>


<BODY  class="yui-skin-sam" oncontextmenu="return false" style="margin: 0px">


<TABLE height="100%" cellSpacing=0 cellPadding=0 width=100%  border=0>
  <TBODY>
  <TR>
    <TD class=logoback colSpan=2 valign="top">
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
  <TR>
    <TD bgcolor="#CCCC99" style="FONT-SIZE:14px" colSpan=2  height="25px" align="center">
                <strong>Στοιχηματίστε</strong>
    </TD>
  </TR>

   <!-- hide the stuff the they are repeated -->
   <?php include 'includes/panel.php' ?>

   <TD style="VERTICAL-ALIGN: top;" width="100%" height=80%>

        <Table height=100% border=0 cellpadding="0" cellspacing="0" >
        <TR>
           <TD valign="top" height="100%" width="765px">

                    <iframe name="coupon" id="coupon" src="coupon.php" width="100%" Height="100%" frameborder="0" margin="0" padding="0" scrolling="yes" ></iframe>

           </TD>
           <TD valign="top" class="yui-skin-sam" style="FONT-SIZE: 10px;" width="350px">

                <Table border=0 cellpadding="0" cellspacing="0" width=100%>
                <TR>
                    <TD height=0>
                    </TD>
                </TR>
                <TR>
                    <TD bgcolor="#FF6633" class=TextInfo style="TEXT-ALIGN :center" height=18>
                        <table width=100% cellpadding="0" cellspacing="0">
                        <tr>
                            <td width=20>
                                <img id="help1" src="../grafix/help.gif" width="20" height="18" onmouseover="this.style.cursor='pointer'">
                            </td>
                            <td>
                                Λεπτομέρειες στοιχήματος
                            </td>
                        </tr>
                        </table>
                    </TD>
                </TR>
                </table>

                <div id="container"></div>
                <br>

                <Table border=0 cellpadding="0" cellspacing="0">
                <TR>
                    <TD bgcolor="#FF6633" class=TextInfo style="TEXT-ALIGN :center" height=18 width="350px">
                        <table width=100% cellpadding="0" cellspacing="0">
                        <tr>
                            <td width=20>
                                <img id="help2" src="../grafix/help.gif" width="20" height="18" onmouseover="this.style.cursor='pointer'">
                            </td>
                            <td>
                                Τύπος Στοιχήματος
                            </td>
                        </tr>
                        </table>



                    </TD>
                </TR>
                <TR>
                      <TD  bgcolor="#233A3A" class=TextInfo width=100%>


                              <INPUT type="checkbox" name="BetTypeGroup" id="System" onclick="EnableSystem()"> Σύστημα

                              <div id="SystemModule">
                              <table width=80% align="right" cellpadding="0" cellspacing="0">
                              <TR>
                                <TD
                                <TD align="left" class=TextInfo>
                                  <INPUT type="checkbox" id="x1" name="x1" value="-">
                                  <INPUT type="checkbox" id="x2" name="x2" value="2">
                                  <INPUT type="checkbox" id="x3" name="x3" value="3">
                                  <INPUT type="checkbox" id="x4" name="x4" value="4">
                                  <INPUT type="checkbox" id="x5" name="x5" value="5">
                                  <INPUT type="checkbox" id="x6" name="x6" value="6">
                                  <INPUT type="checkbox" id="x7" name="x7" value="7">
                                  <INPUT type="checkbox" id="x8" name="x8" value="8">
                                  <INPUT type="checkbox" id="x9" name="x9" value="9">
                                  <INPUT type="checkbox" id="x10" name="x10" value="10">
                                  <INPUT type="checkbox" id="x11" name="x11" value="11">
                                  <INPUT type="checkbox" id="x12" name="x12" value="12">
                                  <INPUT type="checkbox" id="x13" name="x13" value="13">
                                  <INPUT type="checkbox" id="x14" name="x14" value="14">
                                  <INPUT type="checkbox" id="x15" name="x15" value="15">
                                </TD>
                              </TR>
                              </table>
                              </div>


                      </TD>
                </TR>
                </Table>
                <br>
                <Table border=0 width=100%>
                <TR>
                    <TD bgcolor="#FF6633"  class=TextInfo style="TEXT-ALIGN : center" height=18>

                        <table width=100% cellpadding="0" cellspacing="0">
                        <tr>
                            <td width=20>
                                <img id="help3" src="../grafix/help.gif" width="20" height="18" onmouseover="this.style.cursor='pointer'">
                            </td>
                            <td>
                                Πληροφορίες στοιχήματος
                            </td>
                        </tr>
                        </table>

                    </TD>
                </TR>
                <TR>
                    <TD bgcolor="#444033">

                        <table width=100% align="right" cellpadding="0" cellspacing="0">
                        <TR>
                          <TD>
                                  <div id="BetMoney"></div>
                          </TD>
                        </TR>
                        <TR height=5px>
                          <TD class=TextInfo style="TEXT-ALIGN : right" width=40%>
                          </TD>
                        </TR>
                        <TR>
                          <TD align="right">
                                <Table class=TextInfo style="TEXT-ALIGN : right" width=180px>
                                <tr>
                                    <td align="left" width=100px>
                                         Απόδοση
                                    </td>
                                    <td align="right">
                                        <div id="Odds">0</div>
                                    </td>

                                </tr>
                                </Table>

                          </TD>
                        </TR>

                        <TR>
                          <TD align="right">
                                <Table class=TextInfo style="TEXT-ALIGN : right" width=180px>
                                <tr>
                                    <td align="left" width=100px>
                                         Πιναθό κέρδος
                                    </td>
                                    <td align="right">
                                        <div id="PossibleProfit">€ 0</div>
                                    </td>

                                </tr>
                                </Table>
                          </TD>
                        </TR>

                        <TR>
                          <TD align="right">
                                <Table class=TextInfo style="TEXT-ALIGN : right" width=180px>
                                <tr>
                                    <td align="left" width=100px>
                                         Κόστος δελτίου
                                    </td>
                                    <td align="right">
                                        <div id="Cost">€ 0</div>
                                    </td>

                                </tr>
                                </Table>
                          </TD>
                        </TR>



                        </table>
                    </TD>
                </TR>
                <TR height=50  valign="middle">
                    <TD align="center" >
                        <INPUT Class=ButtonOrange onmouseover="this.style.cursor='pointer'" type="button" name="Save" value="Στοιχηματίστε" onclick="Save();">
                        <INPUT Class=ButtonOrange onmouseover="this.style.cursor='pointer'" type="button" name="Reset" value="Ακύρωση" onclick="Reset();">
                    </TD>
                </TR>
                </Table>
            </TD>
        </TR>

        </Table>
         <form id="submit" name="submit" method="POST" action="submitbetform.php">

             <input type="hidden" name="submitted" id="submitted" value="yes">
             <input type="hidden" name="f_odds" id="f_odds" >
             <input type="hidden" name="f_possibleprofit" id="f_possibleprofit" >
             <input type="hidden" name="f_cost" id="f_cost">
             <input type="hidden" name="f_bettype" id="f_bettype">
             <input type="hidden" name="f_remainder" id="f_remainder">
             <input type="hidden" value="<?php echo $_SESSION['nextValidSubmission'];?>" name="submissionId">

             <input type="hidden" name="point1" id="point1">
             <input type="hidden" name="point2" id="point2">
             <input type="hidden" name="point3" id="point3">
             <input type="hidden" name="point4" id="point4">
             <input type="hidden" name="point5" id="point5">
             <input type="hidden" name="point6" id="point6">
             <input type="hidden" name="point7" id="point7">
             <input type="hidden" name="point8" id="point8">
             <input type="hidden" name="point9" id="point9">
             <input type="hidden" name="point10" id="point10">
             <input type="hidden" name="point11" id="point11">
             <input type="hidden" name="point12" id="point12">
             <input type="hidden" name="point13" id="point13">
             <input type="hidden" name="point14" id="point14">
             <input type="hidden" name="point15" id="point15">

             <input type="hidden" name="bet1" id="bet1">
             <input type="hidden" name="bet2" id="bet2">
             <input type="hidden" name="bet3" id="bet3">
             <input type="hidden" name="bet4" id="bet4">
             <input type="hidden" name="bet5" id="bet5">
             <input type="hidden" name="bet6" id="bet6">
             <input type="hidden" name="bet7" id="bet7">
             <input type="hidden" name="bet8" id="bet8">
             <input type="hidden" name="bet9" id="bet9">
             <input type="hidden" name="bet10" id="bet10">
             <input type="hidden" name="bet11" id="bet11">
             <input type="hidden" name="bet12" id="bet12">
             <input type="hidden" name="bet13" id="bet13">
             <input type="hidden" name="bet14" id="bet14">
             <input type="hidden" name="bet15" id="bet15">

         </form>





    </TD>
  </TR>
  <TR>
    <TD class=footerback colSpan=2>
         <?php include '../includes/footer.php' ?>
    </TD>
  </TR>
</TBODY>
</TABLE>



    <Script type="text/javascript">



        //************************************************************************************************
            var MAXPROFIT = eval(<?php echo $MaxProfit ?>);
            var MINBET = eval(<?php echo $MinBet ?>);
            var MAXBET = eval(<?php echo $MaxBet ?>);


            var LIMIT_MONA = eval(<?php echo $LimitMona ?>);
            var LIMIT_POLLAPLA =  eval(<?php echo $LimitPollapla ?>);
            var LIMIT_SYSTEMS = eval(<?php echo $LimitSystems ?>);

            var NIGHT_RESTRICTIONS = eval(<?php echo $NightRestrictions ?>);

            var NIGHT_FROM = "<?php echo $NightFrom ?>";
            var NIGHT_TO = "<?php echo $NightTo ?>";









            var global_N=4;
            var global_x = new Array('1','2','3','4','5','6','7','8','9','A','B','C','D','E','F');
            var global_r = new Array ();
            var global_odds = 0;
            var global_SystemsChecked = new Array();
            var global_L=0;
            var global_Counter = 0;
            var global_SystemsChecked_flag = false;

            for (var i=0;i<16;i++)
                 global_SystemsChecked [ i ] = false;



            function step(k, l)
            {


                if (l==global_L)
                {

                    var calc = 1;
                    for (var i=1;i<=global_L;i++)
                        calc = calc * global_r[i-1];

                    global_odds = global_odds + calc;
                    global_Counter++;
                    return;
                }

                for (var i=k; i<global_N; i++)
                {
                    global_r[l] = global_x[i];
                    step(i+1, l+1);
                }
            }

            function FindSystems(systemtype,maxelements) {

               global_Counter=0;
               global_N=maxelements;
               global_L=systemtype;
               step(0,0);

               return global_Counter;

            }




        //************************************************************************************************

          YAHOO.SystemModule = new YAHOO.widget.Module("SystemModule", { visible: false });
          YAHOO.SystemModule.render();

            //***********************************************************************************************


          var help1Descr='<b>Λεπτομέρειες στοιχήματος</b><br><br>Λίστα εμφάνισης των επιλεγμένων γεγονότων. ' +
                         'Για να διαγράψετε ένα γεγονός κάντε κλικ στο αντίστοιχο κουμπί όπως φαίνεται στην εικόνα παρακάτω. ' +
                         '<br><br><div align=center><img src="../grafix/help1a.png"></div><br> ';
          var myTooltip1 = new YAHOO.widget.Tooltip("myTooltip1", { context:"help1",text:help1Descr,autodismissdelay:15000,hidedelay:0 } );

          var help2Descr='<b>Τύπος στοιχήματος</b><br><br>Ο τύπος στοιχήματος προσαρμόζεται αυτόματα με τα επιλεγμένα γεγονότα. ' +
                         'Αυτό δεν ισχύει όταν επιλέξετε σαν τύπο στοιχήματος το σύστημα. ' +
                         '<br><br><div align=center><img src="../grafix/help2a.png"></div><br> '+
                         'Σε αυτήν την περίπτωση μπορείτε να επιλέξετε τον τύπο του στοιχήματος '+
                         'κάνοντας κλικ στη λίστα των κουμπιών για 1αδες, 2αδες, 3αδες κοκ ';
          var myTooltip2 = new YAHOO.widget.Tooltip("myTooltip2", { context:"help2",text:help2Descr,autodismissdelay:15000,hidedelay:0 } );

          var help3Descr='<b>Πληροφορίες στοιχήματος</b><br><br>Κάθε φορά που επιλέγετε ένα γεγονός εμφανίζεται. ' +
                         'σε αυτήν τη λίστα ο <b>τύπος του στοιχήματος, ο αριθμός των στηλών και το ποσό που θέλετε ' +
                         'να στοιχηματίσετε</b>. Για να εισαγάγετε το ποσό κάντε κλικ επάνω στην αντίστοιχη σειρά,' +
                         'πληκτρολογήστε το ποσό που θέλετε και πατήστε το πλήκτρο <b>Enter</b> ή <b>κάντε κλίκ</b> σε κάποιο ' +
                         'άλλο σημείο της οθόνης. Αυτόματα τα πεδία τα πεδία Πιθανό κέρδος και κόστος δελτίου ' +
                         'ενημερώνονται με τις αντίστοιχες καταχωρήσεις. ' +
                         '<br><br><div align=center><img src="../grafix/help3a.png"></div><br>';

          var myTooltip3 = new YAHOO.widget.Tooltip("myTooltip3", { context:"help3",width:350, text:help3Descr, autodismissdelay:15000,hidedelay:0 } );


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
                panel.setBody('<div align=left>'+str+'</div>');
                //Set an icon
                panel.cfg.setProperty('icon', YAHOO.widget.SimpleDialog.ICON_WARN);
                //Bring the dialog to the top
                panel.bringToTop();
                //Show it
                panel.show();
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

          function onButtonClick(e) {

              var id_str = this.get("id");
              id_str = id_str.substr(1);
              var pos = eval(id_str);


              if (this.get("checked") == true) {
                        var selectedEvents = BetTable.getRecordSet().getLength();

                        var min = 1;
                        for (var i=0;i<selectedEvents;i++) {

                                  if (eval(BetTable.getRecordSet().getRecord(i)._oData.EE) > min)
                                      min = eval(BetTable.getRecordSet().getRecord(i)._oData.EE);
                         }

                         if ( pos < min ) {

                            YAHOO.example.alert('Δεν μπορείτε να στοιχηματίσετε '+id_str+'αδες όταν το ελάχιστο EE είναι ' + min + '.<br><br>' +
                             'To ελάχιστο σύστημα που μπορείτε να στοιχηματίσετε είναι '+min+'αδες.');
                            switch (pos) {
                                case 1: oCheckButton1.set("checked", false); break;
                                case 2: oCheckButton2.set("checked", false); break;
                                case 3: oCheckButton3.set("checked", false); break;
                                case 4: oCheckButton4.set("checked", false); break;
                                case 5: oCheckButton5.set("checked", false); break;
                                case 6: oCheckButton6.set("checked", false); break;
                                case 7: oCheckButton7.set("checked", false); break;
                                case 8: oCheckButton8.set("checked", false); break;
                                case 9: oCheckButton9.set("checked", false); break;
                                case 10: oCheckButton10.set("checked", false); break;
                                case 11: oCheckButton11.set("checked", false); break;
                                case 12: oCheckButton12.set("checked", false); break;
                                case 13: oCheckButton13.set("checked", false); break;
                                case 14: oCheckButton14.set("checked", false); break;
                                case 15: oCheckButton15.set("checked", false); break;

                            }
                            return;

                         }



                        if (pos  >  selectedEvents) {

                                  YAHOO.example.alert('Δεν μπορείτε να στοιχηματίσετε '+id_str+ 'αδες με '+selectedEvents+' επιλεγμένα σημεία (γεγονότα).');
                                  switch (pos) {
                                      case 1: oCheckButton1.set("checked", false); break;
                                      case 2: oCheckButton2.set("checked", false); break;
                                      case 3: oCheckButton3.set("checked", false); break;
                                      case 4: oCheckButton4.set("checked", false); break;
                                      case 5: oCheckButton5.set("checked", false); break;
                                      case 6: oCheckButton6.set("checked", false); break;
                                      case 7: oCheckButton7.set("checked", false); break;
                                      case 8: oCheckButton8.set("checked", false); break;
                                      case 9: oCheckButton9.set("checked", false); break;
                                      case 10: oCheckButton10.set("checked", false); break;
                                      case 11: oCheckButton11.set("checked", false); break;
                                      case 12: oCheckButton12.set("checked", false); break;
                                      case 13: oCheckButton13.set("checked", false); break;
                                      case 14: oCheckButton14.set("checked", false); break;
                                      case 15: oCheckButton15.set("checked", false); break;

                                  }

                          return;
                        }

                          //Find Events
                          var events = 0;
                          for (var i=0;i<BetTable.getRecordSet().getLength();i++){

                                  global_x[i] = eval(BetTable.getRecordSet().getRecord(i)._oData.BetFactor);
                                  events++;
                          }

                        global_odds = 0;
                        result=FindSystems(pos,events);

                        Descr = '('+global_odds.toFixed(2)+')';
                        BetMoneyTable.addRow({System:pos, Odds:global_odds.toFixed(2), MulFactor:pos+'αδες '+Descr, ColNum:result ,BetMoney: 0 });
                        UpdateCheckedTable (pos);
                        ComputeValues();

              } else {

                        for (var i=0;i<BetMoneyTable.getRecordSet().getLength();i++) {

                              var recset = BetMoneyTable.getRecordSet().getRecord(i)._oData;

                              if (recset.System == pos) {
                                  UpdateCheckedTable (recset.System);
                                  BetMoneyTable.deleteRow(i);
                                  ComputeValues();
                                  break;
                              }
                        }


              }



          }



           var oCheckButton1 = new YAHOO.widget.Button("x1", { label:"-" });
           oCheckButton1.on("click", onButtonClick);
           //oCheckButton1.addListener("checkedChange", onButtonClick);

           var oCheckButton2 = new YAHOO.widget.Button("x2", { label:"2" });
           oCheckButton2.on("click", onButtonClick);

           var oCheckButton3 = new YAHOO.widget.Button("x3", { label:"3" });
           oCheckButton3.on("click", onButtonClick);

           var oCheckButton4 = new YAHOO.widget.Button("x4", { label:"4" });
           oCheckButton4.on("click", onButtonClick);

           var oCheckButton5 = new YAHOO.widget.Button("x5", { label:"5" });
           oCheckButton5.on("click", onButtonClick);

           var oCheckButton6 = new YAHOO.widget.Button("x6", { label:"6" });
           oCheckButton6.on("click", onButtonClick);

           var oCheckButton7 = new YAHOO.widget.Button("x7", { label:"7" });
           oCheckButton7.on("click", onButtonClick);

           var oCheckButton8 = new YAHOO.widget.Button("x8", { label:"8" });
           oCheckButton8.on("click", onButtonClick);

           var oCheckButton9 = new YAHOO.widget.Button("x9", { label:"9" });
           oCheckButton9.on("click", onButtonClick);

           var oCheckButton10 = new YAHOO.widget.Button("x10", { label:"10" });
           oCheckButton10.on("click", onButtonClick);

           var oCheckButton11 = new YAHOO.widget.Button("x11", { label:"11" });
           oCheckButton11.on("click", onButtonClick);

           var oCheckButton12 = new YAHOO.widget.Button("x12", { label:"12" });
           oCheckButton12.on("click", onButtonClick);

           var oCheckButton13 = new YAHOO.widget.Button("x13", { label:"13" });
           oCheckButton13.on("click", onButtonClick);

           var oCheckButton14 = new YAHOO.widget.Button("x14", { label:"14" });
           oCheckButton14.on("click", onButtonClick);

           var oCheckButton15 = new YAHOO.widget.Button("x15", { label:"15" });
           oCheckButton15.on("click", onButtonClick);

          UpdateCheckedTable = function(position) {

              global_SystemsChecked[ position ] = !global_SystemsChecked[ position ];

              global_SystemsChecked_flag = false;
              for (var i=1;i<16;i++) {
                if (global_SystemsChecked[i] == true) {
                   global_SystemsChecked_flag = true;
                   break;
                }

              }


          }

          ComputeValues = function() {

                  var Odds,Cost,PossibleProfit;

                  Odds = 0;
                  Cost = 0;
                  PossibleProfit = 0;


                  if ( (BetTable.getRecordSet().getLength() == 0) && (YAHOO.util.Dom.get("System").checked == false) ) {
                      YAHOO.util.Dom.get('PossibleProfit').innerHTML = '€ 0';
                      YAHOO.util.Dom.get('Cost').innerHTML = '€ 0';
                      YAHOO.util.Dom.get('Odds').innerHTML = '0';
                      BetMoneyTable.deleteRow(0,BetMoneyTable.getRecordSet().getLength());

                      return;
                  }


                  if ( (BetTable.getRecordSet().getLength() == 1) && ( YAHOO.util.Dom.get("System").checked == false) ) {



                        var recset = BetMoneyTable.getRecordSet().getRecord(0)._oData;

                        Odds = eval(BetTable.getRecordSet().getRecord(0)._oData.BetFactor);
                        Cost = recset.BetMoney;
                        PossibleProfit = (eval(Cost * Odds)).toFixed(2);

                        BetMoneyTable.updateRow(0,{System:0, Odds:Odds, MulFactor:"Μονό", ColNum:recset.ColNum, BetMoney:recset.BetMoney});





                  } else if ( (BetTable.getRecordSet().getLength() > 1) && ( YAHOO.util.Dom.get("System").checked == false) ) {
                          Odds = 1;
                          Cost = 0;


                          var recset = BetMoneyTable.getRecordSet().getRecord(0)._oData;

                          BetMoneyTable.updateRow(0,{System:recset.System, Odds:recset.Odds, MulFactor:"Πολλαπλό",ColNum:recset.ColNum ,BetMoney: recset.BetMoney });

                          dp = checkForDP();

                          if (dp==0) {
                            for (var i=0;i< BetTable.getRecordSet().getLength();i++)
                                    Odds = Odds * eval(BetTable.getRecordSet().getRecord(i)._oData.BetFactor);
                          } else {

                             for (var i=0;i<BetTable.getRecordSet().getLength();i++) {

                                  checkCodeID = eval(BetTable.getRecordSet().getRecord(i)._oData.CouponID);
                                  OddsTemp = eval(BetTable.getRecordSet().getRecord(i)._oData.BetFactor);

                                  for (var j=0;j<BetTable.getRecordSet().getLength();j++) {

                                      if  ( (i!=j) && (eval(BetTable.getRecordSet().getRecord(j)._oData.CouponID)==checkCodeID) && (eval(BetTable.getRecordSet().getRecord(j)._oData.BetFactor) > 0 ) ) {


                                           if (eval(BetTable.getRecordSet().getRecord(j)._oData.BetFactor) > OddsTemp ){
                                               OddsTemp = eval(BetTable.getRecordSet().getRecord(j)._oData.BetFactor);
                                           }


                                          //make them negative, so disallow any pass again.
                                           BetTable.getRecordSet().getRecord(i)._oData.BetFactor = -eval(BetTable.getRecordSet().getRecord(i)._oData.BetFactor);
                                           BetTable.getRecordSet().getRecord(j)._oData.BetFactor = -eval(BetTable.getRecordSet().getRecord(j)._oData.BetFactor);

                                      }

                                  }

                                  if (OddsTemp > 0) {
                                    Odds = Odds * OddsTemp;
                                  }
                             }
                            //make them all positive again
                            for (var i=0;i< BetTable.getRecordSet().getLength();i++)
                                    BetTable.getRecordSet().getRecord(i)._oData.BetFactor = Math.abs(eval(BetTable.getRecordSet().getRecord(i)._oData.BetFactor));

                            }



                          for (var i=0;i< BetMoneyTable.getRecordSet().getLength();i++)
                                  Cost = Cost + eval(BetMoneyTable.getRecordSet().getRecord(i)._oData.BetMoney);

                          if (dp > 0) {

                            subCost = 1 / Math.pow(2,dp)
                            fCost = Cost * subCost;
                            PossibleProfit = (eval(fCost * Odds)).toFixed(2);

                          } else {

                            PossibleProfit = (eval(Cost * Odds)).toFixed(2);
                          }






                  } else if ( ( YAHOO.util.Dom.get("System").checked == true) && (YAHOO.util.Dom.get("System").checked == true ) ) {

                            Odds=0;
                            Cost=0;
                            PossibleProfit = 0;

                            //Find how many Events (points)
                            var events = 0;
                            for (var i=0;i<BetTable.getRecordSet().getLength();i++){

                                    global_x[i] = eval(BetTable.getRecordSet().getRecord(i)._oData.BetFactor);
                                    events++;
                            }

                            //Search if already exists
                            for (var i=0;i<BetMoneyTable.getRecordSet().getLength();i++) {

                                  var recset = BetMoneyTable.getRecordSet().getRecord(i)._oData;

                                  if (recset.System > events) {
                                        switch (recset.System) {
                                            case 1: oCheckButton1.set("checked", false); break;
                                            case 2: oCheckButton2.set("checked", false); break;
                                            case 3: oCheckButton3.set("checked", false); break;
                                            case 4: oCheckButton4.set("checked", false); break;
                                            case 5: oCheckButton5.set("checked", false); break;
                                            case 6: oCheckButton6.set("checked", false); break;
                                            case 7: oCheckButton7.set("checked", false); break;
                                            case 8: oCheckButton8.set("checked", false); break;
                                            case 9: oCheckButton9.set("checked", false); break;
                                            case 10: oCheckButton10.set("checked", false); break;
                                            case 11: oCheckButton11.set("checked", false); break;
                                            case 12: oCheckButton12.set("checked", false); break;
                                            case 13: oCheckButton13.set("checked", false); break;
                                            case 14: oCheckButton14.set("checked", false); break;
                                            case 15: oCheckButton15.set("checked", false); break;

                                        }

                                       UpdateCheckedTable (recset.System);
                                       BetMoneyTable.deleteRow(i);
                                       continue;

                                  }

                                  global_odds = 0;
                                  result=FindSystems(recset.System,events);

                                  Descr =  '('+global_odds.toFixed(2)+')';
                                  Data = recset.System;
                                  BetMoneyTable.updateRow(i,{System:recset.System, Odds:global_odds.toFixed(2), MulFactor:Data+'αδες '+Descr,ColNum:eval(result),BetMoney:recset.BetMoney });
                                  recset = BetMoneyTable.getRecordSet().getRecord(i)._oData;

                                  Odds = Odds +  eval(global_odds.toFixed(2));
                                  Cost = Cost +  (eval(recset.BetMoney) * eval(recset.ColNum));
                                
                                  PossibleProfit =  PossibleProfit + eval(recset.BetMoney) *  eval(global_odds.toFixed(2));



                            }






                  }




                 YAHOO.util.Dom.get('Odds').innerHTML = eval(Odds).toFixed(2);
                 YAHOO.util.Dom.get('PossibleProfit').innerHTML = '€' + eval(PossibleProfit).toFixed(2);
                 YAHOO.util.Dom.get('Cost').innerHTML = '€' + eval(Cost).toFixed(2);

          }

          /*******************************************************************
           function checkForDP
           returns the number of DP's

          **********************************************************************/
          checkForDP = function(){

               MaxDP=0;

               for (var i=0;i<BetTable.getRecordSet().getLength();i++) {

                    checkCodeID = eval(BetTable.getRecordSet().getRecord(i)._oData.CouponID);

                    for (var j=0;j<BetTable.getRecordSet().getLength();j++) {

                        if  ( (i!=j) && (eval(BetTable.getRecordSet().getRecord(j)._oData.CouponID)==checkCodeID) )
                              MaxDP++

                    }
               }

               if (MaxDP > 0)
                   MaxDP = MaxDP / 2;


               return MaxDP;

          }

          GetSystemStatus = function() {

                  var oSystem = YAHOO.util.Dom.get("System").checked;

                  return oSystem;

          }


           EnableSystem = function() {

                   var oSystem = YAHOO.util.Dom.get("System").checked;
                   if (oSystem == true) {

                       dp = checkForDP();
                       if ( dp > 0) {

                          YAHOO.util.Dom.get("System").checked = false;

                          YAHOO.example.alert('Δεν μπορείτε να παίξετε σύστημα όταν έχετε επιλέξει διπλές πληρωμένες.');
                          return;

                       }



                        YAHOO.SystemModule.show();

                        oCheckButton1.set("checked", false);
                        oCheckButton2.set("checked", false);
                        oCheckButton3.set("checked", false);
                        oCheckButton4.set("checked", false);
                        oCheckButton5.set("checked", false);
                        oCheckButton6.set("checked", false);
                        oCheckButton7.set("checked", false);
                        oCheckButton8.set("checked", false);
                        oCheckButton9.set("checked", false);
                        oCheckButton10.set("checked", false);
                        oCheckButton11.set("checked", false);
                        oCheckButton12.set("checked", false);
                        oCheckButton13.set("checked", false);
                        oCheckButton14.set("checked", false);
                        oCheckButton15.set("checked", false);

                        oCheckButton1.set("disabled", true);

                        BetMoneyTable.deleteRows(0,BetMoneyTable.getRecordSet().getLength());

                        YAHOO.util.Dom.get('Odds').innerHTML = '0.00';
                        YAHOO.util.Dom.get('PossibleProfit').innerHTML = '€ 0.00';
                        YAHOO.util.Dom.get('Cost').innerHTML = '€ 0.00';



                        ComputeValues();

                   } else {
                        YAHOO.SystemModule.hide();

                        BetMoneyTable.deleteRows(0,BetMoneyTable.getRecordSet().getLength());

                        YAHOO.util.Dom.get('Odds').innerHTML = '0.00';
                        YAHOO.util.Dom.get('PossibleProfit').innerHTML = '€ 0.00';
                        YAHOO.util.Dom.get('Cost').innerHTML = '€ 0.00';

                        if (BetTable.getRecordSet().getLength() > 0)
                            BetMoneyTable.addRow({System:0, Odds:0, MulFactor:"", ColNum:1, BetMoney:0});

                        ComputeValues();

                   }


           }

            ClearSystem = function() {

                        oCheckButton1.set("checked", false);
                        oCheckButton2.set("checked", false);
                        oCheckButton3.set("checked", false);
                        oCheckButton4.set("checked", false);
                        oCheckButton5.set("checked", false);
                        oCheckButton6.set("checked", false);
                        oCheckButton7.set("checked", false);
                        oCheckButton8.set("checked", false);
                        oCheckButton9.set("checked", false);
                        oCheckButton10.set("checked", false);
                        oCheckButton11.set("checked", false);
                        oCheckButton12.set("checked", false);
                        oCheckButton13.set("checked", false);
                        oCheckButton14.set("checked", false);
                        oCheckButton15.set("checked", false);

                        oCheckButton1.set("disabled", true);

                        BetMoneyTable.deleteRows(0,BetMoneyTable.getRecordSet().getLength());

                        YAHOO.util.Dom.get('Odds').innerHTML = '0.00';
                        YAHOO.util.Dom.get('PossibleProfit').innerHTML = '€ 0.00';
                        YAHOO.util.Dom.get('Cost').innerHTML = '€ 0.00';

                        ComputeValues();

            }









           YAHOO.util.Event.addListener(window, "load", function() {



                YAHOO.example.RowDataMod = function() {
                    var myBetColumnDefs = [
                        {key:"Code", label:"ΚΩΔ", formatter:"string", width:20 },
                        {key:"Event",label:"ΓΕΓΟΝΟΣ", formatter:"string", width:130},
                        {key:"Goal", label:"ΣΗΜΕΙΟ", formatter:"string", width:50},
                        {key:"BetFactor", label:"ΑΠΟΔ.", formatter:"string", width:30},
    	                {key:'del', label:'', className: 'delete-button', action:'delete',width:15}
                    ];

                    var myBetDataSource = new YAHOO.util.DataSource([]);
                    myBetDataSource.responseType = YAHOO.util.DataSource.TYPE_JSARRAY;


                    myBetDataSource.responseSchema = {
                      resultsList: "DataSet.items",
                      fields: [
                        {key:"CouponID",parser:"number"},
                        {key:"EE",parser:"number"},
                        {key:"Code",parser:"number"},
                        "Event",
                        "Goal",
                        {key:"GoalCoded",parser:"number"},
                        {key:"BetFactor",parser:"number"},
                        "del"
                      ],
                      metaFields: {totalRecords: "DataSet.totalRecords"} // Access server-provided dynamic value

                    };

                    var oConfigs = {


                            dateOptions:{format:"%d/%m/%Y"},
                            selectionMode:"singlecell",
                            numberOptions:{decimalPlaces:2, thousandsSeparator:","},
                            MSG_EMPTY:"Δεν υπάρχουν επιλογές στοιχήματος",
                            draggableColumns:false



        	        };

                    BetTable = new YAHOO.widget.DataTable("container",myBetColumnDefs, myBetDataSource, oConfigs);

                    BetTable.subscribe('rowAddEvent',function(oArgs) {

                            if ( ( BetMoneyTable.getRecordSet().getLength() == 0 ) && (YAHOO.util.Dom.get("System").checked == false ) )
                                BetMoneyTable.addRow({System:0, Odds:0, MulFactor:"", ColNum:1, BetMoney:0});

                            ComputeValues();

                    });

        			BetTable.subscribe('cellClickEvent',function(oArgs) {


                        var target = oArgs.target;

                        column = this.getColumn(target);
                        record = this.getRecord(target);



                        switch (column.action) {

                         case 'delete' :
                                    this.deleteRow(target);

                                    if ( BetTable.getRecordSet().getLength() == 0 )
                                         BetMoneyTable.deleteRows(0);

                                    ComputeValues();
                                    break;

                        }

                    })


                    var BetMoneyFormatter = function(elCell, oRecord, oColumn, oData) {

                        YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "BetMoney");
                        var formatted_value = YAHOO.util.Number.format(oData, {decimalPlaces:2} );
                        elCell.innerHTML = '€'+formatted_value;
                    }

                    var DescriptionFormatter = function(elCell, oRecord, oColumn, oData) {

                        YAHOO.util.Dom.replaceClass(elCell.parentNode, "", "DescriptionFormatter");
                        elCell.innerHTML = oData;
                    }




                //**************************************************************************************


                    var myColumnDefs = [
                        {key:"MulFactor", label:"Περιγραφή", formatter:DescriptionFormatter, width:170 },
                        {key:"ColNum", label:"Στήλες", formatter:YAHOO.widget.DataTable.formatText, width:50 },
                        {key:"BetMoney", label:"Ποσό σε €", formatter:BetMoneyFormatter, editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"OK", disableBtns:false}), width:60 }

                    ];

                    var myDataSource = new YAHOO.util.DataSource([]);
                    myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSARRAY;


                    myDataSource.responseSchema = {
                      resultsList: "DataSet.items",
                      fields: [{key:"System", parser:"number"},{key:"Odds", parser:"number"},{key:"MulFactor",parser:"string"},{key:"ColNum",parser:"number"}, {key:"BetMoney",parser:"number"}],
                      metaFields: {totalRecords: "DataSet.totalRecords"} // Access server-provided dynamic value

                    };

                    var oConfigs = {


                            dateOptions:{format:"%d/%m/%Y"},
                            selectionMode:"singlecell",
                            numberOptions:{decimalPlaces:2, thousandsSeparator:","},
                            MSG_EMPTY:"Δεν υπάρχουν πληροφορίες στοιχήματος",
                            draggableColumns:false,
                            currencyOptions:{prefix: "€", decimalPlaces:2, decimalSeparator:".", thousandsSeparator:","}



        	        };


                    BetMoneyTable = new YAHOO.widget.DataTable("BetMoney", myColumnDefs, myDataSource, oConfigs);

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

                    BetMoneyTable.subscribe("cellMouseoverEvent", highlightEditableCell);
        	        BetMoneyTable.subscribe("cellMouseoutEvent", BetMoneyTable.onEventUnhighlightCell);
                    BetMoneyTable.subscribe("cellClickEvent", BetMoneyTable.onEventShowCellEditor);

                    BetMoneyTable.subscribe("editorShowEvent", function(oArgs){
                        var oEditor = oArgs.editor;

                        oEditor.focus();


                        //this.getDataTable()._focusEl( this.textbox) ;
                        //this.textbox.select();

                    });

                    BetMoneyTable.subscribe("editorSaveEvent", function(oArgs){

                       var oEditor = oArgs.editor;
                  	   var newData = oArgs.newData;
                  	   var oldData = oArgs.oldData;
              		   var elCell = oEditor.cell;
          		       var oRecord = oEditor.getRecord();
                   	   var oColumn = oEditor.getColumn();

        				if ( isNaN(newData) ){
          					this.updateCell ( oRecord , oColumn , oldData );
                            return;
                        }

                       var num = trimNumber(newData);
                       var value = parseFloat(num);

                       if (!isNaN(value)) {
                         if (value >= 0) {

                              this.updateCell ( oRecord , oColumn , value );
                              ComputeValues();



                         } else {


                            YAHOO.example.alert('Παρακαλώ δώστε ένα ποσό μεγαλύτερο του μηδενός.');
                            this.updateCell ( oRecord , oColumn , oldData );
                            return;

                         }
                       } else {

                            YAHOO.example.alert('Μόνον αριθμητικά δεδομένα επιτρέπονται.');
                            this.updateCell ( oRecord , oColumn , oldData );
                            return;
                       }




                    });




                    return {
                        ds1: myBetDataSource,
                        ds2: myDataSource,
                        dt1: BetTable,
                        dt2: BetMoneyTable
                    };


        }();
});








    </script>

<!--END SOURCE CODE FOR EXAMPLE =============================== -->

<SCRIPT type=text/javascript>

function Save(){

        var length = BetTable.getRecordSet().getLength();
        if ( length == 0) {

          YAHOO.example.alert('Παρακαλώ επιλέξτε κάποιο γεγονός.');
          return;

        }

        var min = 1;
        for (var i=0;i<length;i++) {

                if (eval(BetTable.getRecordSet().getRecord(i)._oData.EE) > min)
                    min = eval(BetTable.getRecordSet().getRecord(i)._oData.EE);
        }

       dp = eval(checkForDP());
       if ( dp > 0) {

            length=eval(length-dp);

       }

       if ( length < min ) {

          YAHOO.example.alert('Τα ελάχιστα σημεία (γεγονότα) που μπορείτε να παίξετε είναι ' + min + '.');
          return;

       }

       if ( ( length == 1 ) && (dp > 0) ) {

          YAHOO.example.alert('Δεν μπορείτε να παίξετε διπλή πληρωμένη με ένα μόνο παιχνίδι. Παρακαλώ επιλέξετε επιπλέον παιχνίδια.');
          return;

       }

       if ( length > 15 ) {

          YAHOO.example.alert('Δεν μπορείτε να στοιχηματίσετε παραπάνω από 15 αγώνες.');
          return;

       }

        var bettype = 0;
        if  (YAHOO.util.Dom.get("System").checked == false) {
            if (BetTable.getRecordSet().getLength() > 1)
                bettype=1;
            else
                bettype=0;

        } else
           bettype = 2;

       if ( (BetMoneyTable.getRecordSet().getLength()==0) && (bettype == 2) ) {

                  YAHOO.example.alert('Παρακαλώ επιλέξτε <b>τύπο συστήματος</b> πχ 3άδες, 4άδες κτλ κάνοντας κλικ επάνω στους '+
                                      'αντίστοιχους αριθμούς. ');

                  return;

       }

       if ( (BetMoneyTable.getRecordSet().getLength()==0)  ) {

                  YAHOO.example.alert('Παρακαλώ συμπληρώστε το ποσό στοιχηματισμού στη στήλη "<b>Ποσό σε €</b>" '+
                                      'στην κατηγορία "Πληροφορίες στοιχήματος". ');

                  return;

       }

       var TotalCost = 0;

       for (var i=0;i<BetMoneyTable.getRecordSet().getLength();i++) {


                TotalCost = TotalCost + ( eval(BetMoneyTable.getRecordSet().getRecord(i)._oData.BetMoney) * eval(BetMoneyTable.getRecordSet().getRecord(i)._oData.ColNum) );

                if (eval(BetMoneyTable.getRecordSet().getRecord(i)._oData.BetMoney) == 0) {
                  YAHOO.example.alert('Παρακαλώ συμπληρώστε το ποσό στοιχηματισμού στη στήλη "<b>Ποσό σε €</b>" '+
                                      'στην κατηγορία "Πληροφορίες στοιχήματος". ');

                  return;
                }

                if ( (eval(BetMoneyTable.getRecordSet().getRecord(i)._oData.BetMoney) < MINBET) && (bettype == 2) ){
                  YAHOO.example.alert('Δεν μπορείτε να στοιχηματίσετε ποσά μικρότερα των <b>'+MINBET+'€</b>.');

                  return;
                } else if ( (eval(BetMoneyTable.getRecordSet().getRecord(i)._oData.BetMoney) < 5) && ( (bettype == 0) || (bettype == 1)) ) {
                  YAHOO.example.alert('Δεν μπορείτε να στοιχηματίσετε ποσά μικρότερα των <b> 5€ </b>.');

                  return;

                }



                if ( (eval(BetMoneyTable.getRecordSet().getRecord(i)._oData.System) > eval(length) ) && (bettype==2) ) {
                  YAHOO.example.alert('Δεν μπορείτε να στοιχηματίσετε '+ BetMoneyTable.getRecordSet().getRecord(i)._oData.System +'άδες με '+length+' επιλεγμένα γεγονότα');

                  return;
                }


                if (eval(NIGHT_RESTRICTIONS)==1)  {

                    if ( (eval(bettype)==0) && (eval(BetMoneyTable.getRecordSet().getRecord(i)._oData.BetMoney) > eval(LIMIT_MONA)) ) {

                      var msg =  "Δεν μπορείτε να στοιχηματίσετε ποσά μεγαλύτερα των <b>"+LIMIT_MONA+"€</b> από τις "+NIGHT_FROM+"μμ έως τις "+NIGHT_TO+"πμ.";

                      YAHOO.example.alert( msg );

                      return;

                    }

                    if ( (eval(bettype)==1) && (eval(BetMoneyTable.getRecordSet().getRecord(i)._oData.BetMoney) > eval(LIMIT_POLLAPLA)) ) {

                      var msg =  "Δεν μπορείτε να στοιχηματίσετε ποσά μεγαλύτερα των <b>"+LIMIT_POLLAPLA+"€</b> από τις "+NIGHT_FROM+"μμ έως τις "+NIGHT_TO+"πμ.";

                      YAHOO.example.alert( msg );

                      return;

                    }

                    if ( (eval(bettype)==2) && (eval(BetMoneyTable.getRecordSet().getRecord(i)._oData.BetMoney) > eval(LIMIT_SYSTEMS)) ) {

                      var msg =  "Δεν μπορείτε να στοιχηματίσετε ποσά μεγαλύτερα των <b>"+LIMIT_SYSTEMS+"€</b> από τις "+NIGHT_FROM+"μμ έως τις "+NIGHT_TO+"πμ.";

                      YAHOO.example.alert( msg );

                      return;

                    }





                } else if (eval(BetMoneyTable.getRecordSet().getRecord(i)._oData.BetMoney) > MAXBET) {
                  YAHOO.example.alert('Δεν μπορείτε να στοιχηματίσετε ποσά μεγαλύτερα των <b>'+MAXBET+'€</b>.');

                  return;
                }

        }

        if ( (TotalCost < 5) && (bettype == 2) ) {

                  YAHOO.example.alert('Το κόστος του δελτίου δεν μπορεί να είναι μικρότερο των <b> 5€ </b>.');

                  return;

        }

       var strPossibleProfit = YAHOO.util.Dom.get('PossibleProfit').innerHTML;
       var valPossibleProfit = eval(strPossibleProfit.substr(1));
       var strCost = YAHOO.util.Dom.get('Cost').innerHTML;
       var maxprofit = MAXPROFIT;
       var finalPossibleProfit = valPossibleProfit;

       if ( (valPossibleProfit > MAXPROFIT) &&  ( valPossibleProfit >  eval(strCost.substr(1))*1000 ) ) {

               if  ( MAXPROFIT < (eval(strCost.substr(1))* 1000) )   {
                   finalPossibleProfit = maxprofit;
                   if (!confirm('Το πιθανό κέρδος είναι μεγαλύτερο από αυτό που μπορεί να σας πληρώσει η VelvetBet. Εφόσον κερδίσετε θα πληρωθείτε με το μέγιστο ποσό των €'+maxprofit+'.\n\nΘέλετε να προχωρήσετε στην κατάθεση του δελτίου ;')) {
                       return;
                   }
               } else  {
                      finalPossibleProfit = (eval(strCost.substr(1))* 1000);
                      if (!confirm('Το πιθανό κέρδος ξεπερνάει σύμφωνα με τον κανονισμό, το ποσό στοιχηματισμού πολλαπλασιασμένο επί 1000.\n\n'+
                      'Το ποσό που πληρωθείτε εφόσον κερδίσετε θα είναι €'+ (eval(strCost.substr(1))* 1000) + '\n\n'+
                      'Θέλετε να προχωρήσετε στην κατάθεση του δελτίου ;')) {

                          return;
                      }
                }

       } else  if  (valPossibleProfit > MAXPROFIT)  {
           finalPossibleProfit = maxprofit;
           if (!confirm('Το πιθανό κέρδος του στοιχήματος έχει ξεπεράσει το όριο των €'+maxprofit+'.\n\nΕφόσον κερδίσετε θα πληρωθείτε με το μέγιστο ποσό των €'+maxprofit+'.\n\nΘέλετε να προχωρήσετε στην κατάθεση του δελτίου ;')) {
               return;
           }
       } else if  ( valPossibleProfit >  eval(strCost.substr(1))* 1000 )  {
              finalPossibleProfit = eval(strCost.substr(1))* 1000;
              if (!confirm('Το πιθανό κέρδος ξεπερνάει σύμφωνα με τον κανονισμό, το ποσό στοιχηματισμού πολλαπλασιασμένο επί 1000.\n\n'+
              'Το ποσό που πληρωθείτε εφόσον κερδίσετε θα είναι €'+ (eval(strCost.substr(1))* 1000) + '\n\n'+
              'Θέλετε να προχωρήσετε στην κατάθεση του δελτίου ;')) {

                  return;
              }

       }


     YAHOO.util.Dom.get('PossibleProfit').innerHTML = '€'+eval(finalPossibleProfit).toFixed(2);
     var childWin = document.getElementById('coupon').contentWindow;
     childWin.Refresh(true);


}

function RefreshDone(AgentRemainder) {

     var counter = 0;
     var childWin = document.getElementById('coupon').contentWindow;
     var matchCodes = new Array();
     var Code, found;

    var FillSpecials=['Goal_1','Goal_x','Goal_2','Under','Over','GG','NG','de_1ORX','de_XOR2','de_1OR2','HMI_1','HMI_X','HMI_2','HT_11','HT_1X','HT_12','HT_X1','HT_XX','HT_X2','HT_21','HT_2X','HT_22','SS_10','SS_20','SS_21','SS_30',
                      'SS_31','SS_32','SS_40','SS_41','SS_42','SS_43','SS_00','SS_11','SS_22','SS_33','SS_01','SS_02','SS_12','SS_03','SS_13','SS_23','SS_04','SS_14','SS_24','SS_34',
                      'TG_01','TG_23','TG_46','TG_7'];


    var FillSpecialsLabel=['1','X','2','Under','Over','GG','NG','ΔΕ 1ήΧ','ΔΕ Χή2','ΔΕ 1ή2','HMI 1','HMI X','HMI 2','HT 1-1','HT 1-X','HT 1-2','HT X-1','HT X-X','HT X-2','HT 2-1','HT 2-X','HT 2-2','ΣΣ 1-0','ΣΣ 2-0','ΣΣ 2-1','ΣΣ 3-0',
                           'ΣΣ 3-1','ΣΣ 3-2','ΣΣ 4-0','ΣΣ 4-1','ΣΣ 4-2','ΣΣ 4-3','ΣΣ 0-0','ΣΣ 1-1','ΣΣ 2-2','ΣΣ 3-3','ΣΣ 0-1','ΣΣ 0-2','ΣΣ 1-2','ΣΣ 0-3','ΣΣ 1-3','ΣΣ 2-3','ΣΣ 0-4','ΣΣ 1-4','ΣΣ 2-4','ΣΣ 3-4',
                           'TG 0-1','TG 2-3','TG 4-6','TG 7'];


     for (var i=0;i<childWin.myDataTable.getRecordSet().getLength();i++) {

             match=eval(childWin.myDataTable.getRecordSet().getRecord(i)._oData.CouponID);
             for (var j=0;j<BetTable.getRecordSet().getLength();j++) {
                   if ( eval(BetTable.getRecordSet().getRecord(j)._oData.CouponID) == match) {

                      for (var k=0;k<FillSpecialsLabel.length;k++) {
                          if ( FillSpecialsLabel[k] == BetTable.getRecordSet().getRecord(j)._oData.Goal) {

                              field = FillSpecials[k];


                              if (eval(BetTable.getRecordSet().getRecord(j)._oData.BetFactor) != eval(childWin.myDataTable.getRecordSet().getRecord(i)._oData[field]) ) {
                                    Code = eval(BetTable.getRecordSet().getRecord(j)._oData.Code);
                                    YAHOO.example.alert('Στο δελτίο που συμπληρώσατε, το μάτς με κωδικό <b>'+Code+'</b> οι αποδόσεις των επιλεγμένων σημείων άλλαξαν.<br><br>'+
                                                        'Παρακαλώ αναπροσαρμόστε το δελτίο σας.');

                                    return;

                              }


                          }

                      }

                      matchCodes[counter] = eval(BetTable.getRecordSet().getRecord(j)._oData.Code);
                      counter++;
                   }

             }

     }


     if (counter !=  BetTable.getRecordSet().getLength()) {

         for (var i=0;i<BetTable.getRecordSet().getLength();i++) {

               Code = eval(BetTable.getRecordSet().getRecord(i)._oData.Code);

               for (var j=0;j<matchCodes.length;j++) {
                 if (eval(matchCodes[j]) == Code) {
                     found = true;
                     break;
                 }
                 else
                     found = false;
               }

               if (!found)
                  break;

         }

        YAHOO.example.alert('Στο δελτίο που συμπληρώσατε, το μάτς με κωδικό <b>'+Code+'</b> δεν υπάρχει πλέον στο κουπόνι διότι ο αγώνας έχει ήδη ξεκινήσει.<br><br>'+
                            'Παρακαλώ αναπροσαρμόστε το δελτίο σας.');

        return;

     }


     for (var i=0;i<BetTable.getRecordSet().getLength();i++) {
        data = YAHOO.lang.JSON.stringify(BetTable.getRecordSet().getRecord(i)._oData);
        num = 'point'+(i+1).toString();
        YAHOO.util.Dom.get( num ).value = data;
     }

     for (var i=0;i<BetMoneyTable.getRecordSet().getLength();i++) {
        BetMoneyTable.getRecordSet().getRecord(i)._oData.BetMoney = eval(BetMoneyTable.getRecordSet().getRecord(i)._oData.BetMoney).toFixed(2);
        data = YAHOO.lang.JSON.stringify(BetMoneyTable.getRecordSet().getRecord(i)._oData);
        num = 'bet'+(i+1).toString();
        YAHOO.util.Dom.get( num ).value = data;
     }


    var strPossibleProfit = YAHOO.util.Dom.get('PossibleProfit').innerHTML;
    var strCost = YAHOO.util.Dom.get('Cost').innerHTML;

    YAHOO.util.Dom.get( 'f_odds' ).value = eval(YAHOO.util.Dom.get('Odds').innerHTML).toFixed(2);
    YAHOO.util.Dom.get( 'f_possibleprofit' ).value = eval(strPossibleProfit.substr(1)).toFixed(2);
    YAHOO.util.Dom.get( 'f_cost' ).value = eval(strCost.substr(1)).toFixed(2);
    YAHOO.util.Dom.get( 'f_remainder' ).value = eval(AgentRemainder);



    if ( eval(strCost.substr(1)) > MAXBET ) {

        YAHOO.example.alert('Το ανώτερο ποσό στοιχηματισμού είναι €'+MAXBET+'.<br><br>'+
                            'Παρακαλώ αναπροσαρμόστε το δελτίο σας.');

        return;

    }

    
    if ( eval(strCost.substr(1)) > eval(AgentRemainder) ) {

        YAHOO.example.alert('Το <b>υπόλοιπο των χρημάτων</b> που έχετε, δεν επαρκεί για την καταχώρηση του δελτίου σας.<br><br>'+
                            'Παρακαλώ αναπροσαρμόστε το δελτίο σας ή επικοινωνήστε με τη VelvetBet.');

        return;

    }



    var bettype = 0;
    if  (YAHOO.util.Dom.get("System").checked == false) {
        if (BetTable.getRecordSet().getLength() > 1)
            bettype=1;
        else
            bettype=0;

    } else
       bettype = 2;

   

    YAHOO.util.Dom.get('f_bettype').value = bettype;

    var formObject = document.getElementById('submit');
    formObject.submit();



}

function trim (str)
{
    var i = str.length - 1;
    while ( i >= 0 && /\s/.test(str.charAt(i)) ) --i;


    return str.substring(0, i + 1);
}

function trimNumber(s) {
  while (s.substr(0,1) == '0' && s.length>1) { s = s.substr(1,9999); }
  return s;
}

function Reset(){

    if (confirm('Είσαι σίγουρος ότι θέλεις να διαγράψεις τις εώς τώρα επιλογές σου ;')) {
        BetTable.deleteRows(0,BetTable.getRecordSet().getLength());
        BetMoneyTable.deleteRows(0,BetMoneyTable.getRecordSet().getLength());
        YAHOO.util.Dom.get("System").checked = false;
        EnableSystem();
        ComputeValues();
    }

}

</SCRIPT>





</BODY>
</HTML>
