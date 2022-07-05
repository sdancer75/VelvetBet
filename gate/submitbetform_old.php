<?php
    session_start();
    include '../includes/database.php';
    include '../includes/login.php';

    date_default_timezone_set("Europe/Athens");


     $LoginMsg = '';
     $DB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
     mysql_select_db(DataBase, $DB) or die(mysql_error());

    if ( (!check_login('agents')) && (!check_login('superagents')) )  {

            mysql_close($DB);
            header( 'Location: ../index.php' );

    }


    mysql_close($DB);


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HEAD>
<HTML xmlns="http://www.w3.org/1999/xhtml">
<TITLE>VelvetBet - Στοιχήματα Ποδοσφαίρου</TITLE>
 <?php include '../includes/metatagsgr.php' ?>

<link href="../betplatform.css" rel="stylesheet" type="text/css">


<link rel="stylesheet" type="text/css" href="../build/fonts/fonts-min.css" />



<script type="text/javascript" src="../build/yahoo-dom-event/yahoo-dom-event.js"></script>







</HEAD>


<BODY  class="yui-skin-sam" oncontextmenu="return false">

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
    <TD class=DummyPrint bgcolor="#CCCC99" style="FONT-SIZE:14px" colSpan=2  height="25px" align="center">
                <strong>Αποστολή δελτίου</strong>
    </TD>
  </TR>


   <!-- hide the stuff the they are repeated -->
   <?php include 'includes/panel.php' ?>



    <TD style="VERTICAL-ALIGN: top;" width="100%" >

      <Table border=0 width="800px">

       <TR>
            <TD  align="center" >

                 <br>
                 <span style="color:white; font: tahoma; font-size: 11px; font-weight: normal">
                        <table width=100% align="center" border=0  bgcolor="#6A97AE">
                        <tr>
                            <td align="center" width="70px" valign="middle">

                                    <span id="Image"></span>

                            </td>
                            <td align="left" valign="top">

                                    <span id="Descr"></span>

                            </td>
                        </tr>
                        </table>

                 </span>
                 <br><br>


                <?php
                      $SavedOK = 'Error';




                      if (isset($_POST['submitted']) && $_POST['submissionId'] == $_SESSION['nextValidSubmission']) {

                           //save the userbetssynopsis table and get the primary ID
                           $DB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
                           mysql_select_db(DataBase, $DB) or die(mysql_error());
                       	   mysql_query("SET NAMES 'utf8'");
                       	   mysql_query("START TRANSACTION");


                           $sqlquery = 'SELECT agents.SAgentID,Mona,Dipla,Triades,Systems,Commission_tziros,Commission_pososto  from agents,superagents where agents.SAgentID=superagents.SAgentID AND AgentID='.$_SESSION['user/id'];
                           $result_id = mysql_query($sqlquery);
                           $row = mysql_fetch_assoc($result_id);
                           if ($row) {
                              $SAgentID = $row['SAgentID'];
                              $Mona = $row['Mona'];
                              $Dipla = $row['Dipla'];
                              $Triades = $row['Triades'];
                              $Systems = $row['Systems'];
                              $Commission_tziros =  $row['Commission_tziros'];
                              $Commission_pososto =  $row['Commission_pososto'];
                           }

                           $SAgentProfitWin =0;
                           $SAgentProfitLose =0;
                           $AgentProfit  =0;
                           $MasterProfitWin =0;
                           $MasterProfitLose =0;



                           $sqlquery = "INSERT INTO userbetssynopsis (SAgentID,AgentID,DateTime,BetType,Cost,SAgentProfitWin,SAgentProfitLose,AgentProfit,MasterProfitWin,MasterProfitLose,Odds,PossibleProfit)".
                           " VALUES (".$SAgentID.",".$_SESSION['user/id'].",'".GR_Time('Y-m-d H:i:s',time())."',".$_POST['f_bettype'].",".$_POST['f_cost'].",".$SAgentProfitWin.",".$SAgentProfitLose.",".$AgentProfit.",".
                                $MasterProfitWin.",".$MasterProfitLose.",".$_POST['f_odds'].",".$_POST['f_possibleprofit'].");";


                           $result_id = mysql_query($sqlquery);
                           $lastItemID = mysql_insert_id();
                           $result_id = mysql_query("select DateTime from userbetssynopsis where UserBetSynopsisID=".$lastItemID);
                           $row = mysql_fetch_assoc($result_id);
                           if ($row) {
                              $TimeStamp = $row['DateTime'];
                           }
                           echo "<table width=800px border=0 cellSpacing=0 cellPadding=0 bgcolor=#555555 >";
                           echo "<tr height=2px bgcolor=#FFCC00><td></td></tr>";
                           echo "<tr height=5px ><td></td></tr>";
                           echo "<tr><td align=center>";
                           echo "<table width=780px border=1 cellSpacing=0 cellPadding=0 class=PrintClass>";
                           echo "<tr><td bgcolor=#000000 colspan=4 class=Title> Κατάθεση [ <span style=\"color:#83C6FC\">".date("d/m/y H:i:s", strtotime($TimeStamp))."</span> ] - Αρ. Δελτίου [ <span class=Coupon>".$lastItemID."</span> ] - Κατάσταση δελτίου [ <span style=\"color:#DBB793\">Σε εξέλιξη</span> ] </td></tr>";
                           echo "</table>";
                           echo "<br>";
                           echo "<table width=750px  cellSpacing=2 cellPadding=2>";
                           echo "<tr><td class=PrintClass bgcolor=#FF6633 colspan=4 align=center style=\"color:white\">Λεπτομέρειες στοιχήματος</td></tr>";
                           echo "<tr><td bgcolor=#EEEEEE align=center class=Header1>Κωδικός</td><td bgcolor=#EEEEEE align=center class=Header1>Γεγονός</td><td align=center bgcolor=#EEEEEE class=Header1>Σημείο</td><td align=center bgcolor=#EEEEEE class=Header1>Απόδοση</td></tr>";

                           $BetsCounter = 0;
                           $codeevents='';
                           $codeeventsBetFactor=array();

                           foreach ($_POST as $key => $value) {

                              if ( ($key != 'submitted') && ($key != 'f_odds')  && ($key != 'f_possibleprofit') && ($key != 'f_cost') && ($key != 'f_bettype') ) {

                                 if ( ($value != '') && (strstr($key, 'point') !== false  ) ) {

                                  	 $decoded = json_decode(stripcslashes($value),true);
                                     $data='';
                                     $fields='';
                                     $response='';



                      				 foreach ($decoded as $key => $value) {


                      				  		  $data.="'".$value."',";
                      		                  $fields.=$key.",";

                      		                  $response.="\"".$key."\"".":\"".$value."\",";

                                              switch ($key) {
                                                case 'Code'  : $Code = "<td bgcolor=#444444 class=Data1 align=center>".$value."</td>";break;
                                                case 'Event' : $Event = "<td bgcolor=#444444 class=Data1 align=center>".$value."</td>";break;
                                                case 'Goal'  : $Goal = "<td bgcolor=#444444 class=Data1 align=center>".$value."</td>";break;
                                                case 'BetFactor' : $BetFactor = "<td bgcolor=#444444 class=Data1 align=center>".$value."</td>";
                                                                   $codeeventsBetFactor[$BetsCounter]=$value;
                                                                   break;
                                                case 'CouponID' : $CouponID = $value;
                                              }




                      				  }

                                      $BetsCounter++;
                                      echo "<tr>".$Code.$Event.$Goal.$BetFactor."</tr>";

                                      $fields = substr($fields, 0, -1);
                                      $data = substr($data, 0, -1);

                                      $fields="(UserBetSynopsisID,".$fields.")";
                                      $data="(".$lastItemID.",".$data.")";


                                      $sqlquery = "INSERT INTO userbets ".$fields." VALUES ".$data.";";
                                      $result_id = mysql_query($sqlquery);
                                      $lastItemUserBetsID = mysql_insert_id();
                                      $codeevents = $codeevents.$CouponID."|";
                                }
                               }
                              }

                            $codeevents = substr($codeevents, 0, -1);

                            echo "</table>";
                            echo "<br><br>";
                            echo "<table width=750px>";
                            echo "<tr><td class=PrintClass bgcolor=#FF6633 colspan=4 align=center style=\"color:white\">Πληροφορίες στοιχήματος</td></tr>";
                            echo "<tr><td bgcolor=#EEEEEE align=center class=Header1>Περιγραφή</td><td bgcolor=#EEEEEE align=center class=Header1>Στήλες</td><td align=center bgcolor=#EEEEEE class=Header1>Ποσό σε €</td></tr>";

                            $counter=0;

                            foreach ($_POST as $key => $value) {

                              if ( ($key != 'submitted') && ($key != 'f_odds')  && ($key != 'f_possibleprofit') && ($key != 'f_cost') && ($key != 'f_bettype') ) {

                                if ( ($value != '') && (strstr($key, 'bet') !== false  ) ) {

                                  	 $decoded = json_decode(stripcslashes($value),true);
                                     $data='';
                                     $fields='';
                                     $response='';


                      				 foreach ($decoded as $key => $value) {


                      				  		  $data.="'".$value."',";
                      		                  $fields.=$key.",";

                      		                  $response.="\"".$key."\"".":\"".$value."\",";

                                              switch ($key) {
                                                case 'MulFactor'  : $MulFactor = "<td bgcolor=#444444 class=Data1 align=center>".$value."</td>";break;
                                                case 'ColNum' : $ColNum = "<td bgcolor=#444444 class=Data1 align=center>".$value."</td>";break;
                                                case 'BetMoney' : $BetMoney = "<td bgcolor=#444444 class=Data1 align=center>€".$value."</td>";break;
                                                case 'System' : $BetArray[$counter] = $value; $counter++; break;
                                              }


                      				  }
                                      echo "<tr>".$MulFactor.$ColNum.$BetMoney."</tr>";
                                      $fields = substr($fields, 0, -1);
                                      $data = substr($data, 0, -1);

                                      $fields="(UserBetSynopsisID,".$fields.")";
                                      $data="(".$lastItemID.",".$data.")";


                                      $sqlquery = "INSERT INTO userbetsmoney ".$fields." VALUES ".$data.";";
                                      $result_id = mysql_query($sqlquery);



                                }

                              }

                            }
                            echo "</table>";




                           //mono
                           if ( $_POST['f_bettype'] == 0) {

                                   $AgentProfit = $_POST['f_cost'] *  ($Mona / 100);


                           //pollaplo
                           } else if ( ( $_POST['f_bettype'] == 1)  && ($BetsCounter==2) ) {

                                    $AgentProfit = $_POST['f_cost'] *  ($Dipla / 100);

                           } else if ( ( $_POST['f_bettype'] == 1)  && ($BetsCounter > 2) ) {
                                  $AgentProfit = $_POST['f_cost'] *  ($Triades / 100);

                           //system
                           } else if ( $_POST['f_bettype'] == 2) {
                                  $AgentProfit = $_POST['f_cost'] *  ($Systems / 100);

                           } else {
                                echo "Δεν βρέθηκε ο τύπος στοιχήματος.";
                                return;
                           }

                           if ($Commission_tziros == 0) {

                               $SAgentProfitWin = $_POST['f_cost'] * ($Commission_pososto / 100);
                               $SAgentProfitLose = 0;

                           } else {

                               $SAgentProfitWin =  ($_POST['f_cost']-$AgentProfit) *  ($Commission_tziros / 100);
                               $SAgentProfitLose = ($_POST['f_possibleprofit']-$_POST['f_cost']+$AgentProfit) *  ($Commission_tziros / 100);
                           }

                           $MasterProfitWin =  $_POST['f_cost'] - $AgentProfit - $SAgentProfitWin ;
                           $MasterProfitLose=  $_POST['f_possibleprofit'] - $_POST['f_cost'] +  $AgentProfit - $SAgentProfitLose;


                           $result_id = mysql_query("update userbetssynopsis SET UserBetsCount=".$BetsCounter.",AgentProfit=".$AgentProfit.",SAgentProfitWin=".$SAgentProfitWin.
                                        ",SAgentProfitLose=".$SAgentProfitLose.", MasterProfitWin=".$MasterProfitWin.", MasterProfitLose=".$MasterProfitLose." where UserBetSynopsisID=".$lastItemID);

                           $remainder = $_POST['f_remainder'] - $_POST['f_cost']; //+ $AgentProfit;
                           $result_id = mysql_query("update agents SET Remainder=".$remainder." where AgentID=".$_SESSION['user/id']);



                            $N=$BetsCounter;
                            $x = explode("|",$codeevents);
                            $r = array();
                            $L=0;


                            function step($k, $l)  {

                                global $L,$N,$r,$x,$BetArray,$codeeventsBetFactor,$lastItemID;



                                if ($l==$L) {

                                    for ($k=count($BetArray)-1;$k>=0;$k--) {

                                        if ($l==$BetArray[$k]) {

                                            $odds = 1;
                                            $outputstring = implode("|", $r);


                                            $OddsAnalytic = '';

                                            for ($i=0;$i<count( $codeeventsBetFactor );$i++) {

                                                for ($j=0;$j<count($r);$j++) {
                                                    if ( $x[$i] == $r[$j] ) {
                                                         $odds = $odds * $codeeventsBetFactor[$i];
                                                         $OddsAnalytic = $OddsAnalytic.$codeeventsBetFactor[$i].'|';

                                                    }
                                                }

                                            }

                                           /*
                                            for ($i=(count( $codeeventsBetFactor )-1);$i>=0;$i--) {

                                                for ($j=(count($r)-1);$j>=0;$j--) {
                                                    if ( $x[$i] == $r[$j] ) {
                                                         $odds = $odds * $codeeventsBetFactor[$i];
                                                         $OddsAnalytic = $OddsAnalytic.$codeeventsBetFactor[$i].'|';

                                                    }
                                                }

                                            }

                                            */
                                            $sqlquery = "insert into userbetssystems (UserBetSynopsisID,Events,Odds,OddsAnalytic,System,Status) values (".$lastItemID.",'".$outputstring."',".$odds.",'".$OddsAnalytic."',".$l.",2);";
                                            mysql_query($sqlquery);

                                        }
                                    }



                                    return;
                                }


                                for ($i=$k; $i<$N; $i++)
                                {
                                    $r[$l] = $x[$i];
                                    step($i+1, $l+1);
                                }
                            }



                          if ( $_POST['f_bettype'] ==  2) {


                             for ($L=$N; $L>=1; $L--)
                             {
                                  unset($r);
                                  step(0,0);
                             };



                          }







                           mysql_query("COMMIT");
                           mysql_close($DB);
                           $SavedOK = 'OK';

                           echo "<br><br>";
                           echo "<table width=750px >";
                           echo "<tr><td class=PrintClass bgcolor=#FF6633 colspan=4 align=center style=\"color:white;\">Στατιστικά στοιχήματος</td></tr>";
                           echo "<tr><td bgcolor=#EEEEEE align=center class=Header1>Συνολική Απόδοση</td><td bgcolor=#EEEEEE align=center class=Header1>Κόστος δελτίου</td><td align=center bgcolor=#EEEEEE class=Header1>Πιθανό κέρδος</td></tr>";
                           echo "<tr><td bgcolor=#444444 class=Data1 align=center>".$_POST['f_odds']."</td><td bgcolor=#444444 class=Data1 align=center>€".$_POST['f_cost']."</td><td bgcolor=#444444 class=Data1 align=center>€".$_POST['f_possibleprofit']."</td></tr>";
                           echo "</table>";
                           echo "</tr></td>";
                           echo "<tr height=5px ><td></td></tr>";
                           echo "<tr bgcolor=#FFCC00 height=2px><td></td></tr>";
                           echo "</table>";
                           echo "<br><br>";
                           $_SESSION['nextValidSubmission'] = rand(1000000,9999999);
                     }







                ?>

                <script>
                 var SavedOK = '<?php echo $SavedOK ?>';
                 var Remainder = '<?php echo $remainder ?>';

                 if (SavedOK == 'OK') {
                         YAHOO.util.Dom.get('Image').innerHTML = '<img src="../grafix/success_icon.png" width="48" height="50" align="absmiddle" border="0" hspace="2" vspace="2" alt="success">';
                         YAHOO.util.Dom.get('Descr').innerHTML ='<br><span style="color:#FFFFCC;font-weight: bold;font-size:12px">Η καταχώρηση του δελτίου έγινε επιτυχώς.</span> <br><br>'+
                                        'Μπορείτε εφόσον το επιθυμείτε να εκτυπώσετε το δελτίο σας. Σας ευχόμαστε καλή επιτυχία!<br><br>';
                 } else {

                         YAHOO.util.Dom.get('Image').innerHTML = '<img src="../grafix/fail_icon.png" width="60" height="50" align="absmiddle" border="0" hspace="2" vspace="2" alt="success">';
                         YAHOO.util.Dom.get('Descr').innerHTML ='<br><span style="color:#FFFFCC;font-weight: bold;font-size:12px">Η καταχώρηση του δελτίου απέτυχε.</span><br><br>'+
                                        'Το σφάλμα, οφείλεται στη μη ολοκλήρωση της διαδικασίας μεταφοράς των δεδομένων λόγω κάποιας διακοπής της σύνδεσης, ή διότι προσπαθήσατε να '+
                                        'να ξαναστείλετε το δελτίο κάνοντας κλικ στο κουμπί Ανανέωση (refresh) από το πρόγραμμα πλοήγησης (Browser).<br><br>'+
                                        'Αν το πρόβλημα δεν οφείλεται στους παραπάνω λόγους και δεν είναι δυνατή η εύρυθμη λειτουργία της εφαρμογής, παρακαλώ επικοινωνήστε με τη <b>VelvetBet</b>.<br><br>';
                 }


                YAHOO.util.Dom.get('Remainder').innerHTML = '€' + eval(Remainder).toFixed(2);
                </script>

                <?php if ($SavedOK == 'OK') { ?>
                    <INPUT class=ButtonOrange id="printbutton" type="button" value="     Εκτύπωση     " onmouseover="this.style.cursor='pointer'" onclick="javascript:window.print();">
                <?php } ?>

                <INPUT class=ButtonOrange id="printbutton" type="button" value="     Νέο στοίχημα     " onmouseover="this.style.cursor='pointer'" onclick="javascript:window.location='betnow.php';">
                <br><br>

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

</BODY>
</HTML>
