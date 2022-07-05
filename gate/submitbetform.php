<?php
    session_start();
    include '../includes/database.php';
    include '../includes/login.php';
    include_once ('../includes/functions.php');
    include '../includes/statistics.php';


    //It would be usefull to check the source of the form submittion
    //This is a feature to be done

    //echo $_SERVER['SERVER_NAME'];
    //echo $_SERVER['SERVER_ADDR'];

    //echo $_SERVER['REMOTE_HOST'];
    //echo $_SERVER['HTTP_REFERER'];
    //die;

    date_default_timezone_set("Europe/Athens");


     $LoginMsg = '';
     $DB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
     mysql_select_db(DataBase, $DB) or die(mysql_error());

     if ( (!check_login('agents'))  )  {

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


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>

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
                            <td align="center" width="70px" valign="top">
                                    <br><br>
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


                      //*****************************************************
                      //
                      //  Warning Levels
                      //
                      //    100=Δεν βρέθηκε ο κωδικός του Agent/Super Agent
                      //    101=Κάποιο από τα κρίσιμα πεδία είναι λάθος κατά την αποστολή του δελτίου
                      //    102=Το υπόλοιπο του agent ειναι ίσο ή μικρότερο του μηδενός
                      //    103=Δεν βρέθηκε το δελτίο κατά την αναζήτηση
                      //    104=Κάποιος από τους επιλεγμένους αγώνες έχει ήδη ξεκινήσει
                      //    105=Στοιχηματισμός μεγαλύτερος από το νυχτερινό όριο
                      //    106=Δεν επιτρέπεται η εκ νέου αποστολή του δελτίου με τη μέθοδο της ανανέωσης σελίδας
                      //    107=Καταχώρηση δελτίου από super agent.Ο λογαριασμός κλειδώθηκε.
                      //    108=Στοιχηματισμός κάτω από 5 Ευρώ.
                      //    109=Βρέθηκε μεγαλύτερος αριθμός διπλών πληρωμένων (μέγιστο=4)
                      //    110=Το δελτίο ενώ είχε διπλές πληρωμένες δεν είχε δηλωθεί σαν πολλαπλό.
                      //    111=Ο έλεγχος της απόδοσης του μονού ή του πολλαπλού δεν επαληθεύτηκε
                      //    112=Ο έλεγχος της απόδοσης του συστήματος δεν επαληθεύτηκε
                      //    113=Απέτυχε η πρόσβαση στη βάση δεδομένων κατά την καταχώρηση δεδομένων του δελτίου
                      //    114=Απέτυχε ο έλεγχος των ελαχίστων σημείων (γεγονότα) που μπορεί να παίξει κάποιος παίκτης
                      //    115=Απέτυχε ο έλεγχος των αποδόσεων
                      //*****************************************************

                      //echo variable_array_dump('GLOBAL SERVER', $_SERVER);
                      //echo variable_array_dump('GLOBAL ENV', $_ENV);
                      //echo variable_array_dump('GLOBAL REQUEST', $_REQUEST);
                      // echo variable_array_dump('GLOBAL GET', $_GET);
                      //echo variable_array_dump('GLOBAL POST', $_POST);
                      //echo variable_array_dump('GLOBAL COOKIE', $_COOKIE);

                      function variable_array_dump($VARIABLE_NAME, $VARIABLE_ARRAY){
                         if (is_array($VARIABLE_ARRAY)) {
                            $output = "<table border='1'>";
                            $output .= "<head><tr><td><b>" . $VARIABLE_NAME . "</b></td><td><b>VALUE</b></td></tr></head><body>";
                            foreach ($VARIABLE_ARRAY as $key => $value) {
                               $value = variable_array_dump($key, $value);
                               $output .= "<tr><td>$key</td><td>$value</td></tr>";
                            }
                            $output .= "</body></table>";
                            return $output;
                         } else {return strval($VARIABLE_ARRAY);}
                      }



                     $DB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
                     mysql_select_db(DataBase, $DB) or die(mysql_error());
                 	 mysql_query("SET NAMES 'utf8'");

                     if ($_SESSION['user/level']=="agents")
                        $AgentType="AgentType=agents";
                     else
                        $AgentType="AgentType=superagents or unknown";



                     $Description = 'SubmitLogQuery    ['.$AgentType.']  <BR>GET='.addslashes(variable_array_dump('GLOBAL REQUEST', $_GET)).'    POST='.addslashes(variable_array_dump('GLOBAL REQUEST', $_POST));
                     $GetCouponID = SaveLog(-1,$_SESSION['user/id'],0,$_SERVER['HTTP_USER_AGENT'],$Description,'Καταχώρηση δελτίου.');



                     if  ($_SESSION['user/level']!="agents") {

                            $sqlquery = "UPDATE superagents SET Active=0 Where SAgentID=".$_SESSION['user/id'];
                            mysql_query($sqlquery);

                            $Err_Descr='Προσπάθεια καταχώρησης δελτίου από κάποιον χρήστη είναι super agent. Ο λογαριασμός του κλειδώθηκε.';
                            SaveLog(-1,$_SESSION['user/id'],107,$_SERVER['HTTP_USER_AGENT'],'Trying to save a new coupon from a non agent client.',$Err_Descr);

                            mysql_close($DB);
                            die('<span style="color:white;font-size:14px">Unathorized error 6. The system is locked you out.</span>');


                     }

                 	 mysql_query("START TRANSACTION");

                     $remainder = $_POST['f_remainder'];
                     $SavedOK = 'Error';
                     $Err_Descr="Δεν ολοκληρώθηκε η μετάδοση των δεδομένων στο διακομιστή.";

                     function LogError($UserBetSynopsisID,$WarningLevel,$Description,$FriendlyDescription) {
                           global $DB;
                           global $SavedOK;

                           mysql_query("ROLLBACK");
                           //$browser = get_browser();

                           SaveLog($UserBetSynopsisID,$_SESSION['user/id'],$WarningLevel,$_SERVER['HTTP_USER_AGENT'],$Description,$FriendlyDescription);

                           mysql_close($DB);
                           $SavedOK = 'Error';


                      }


                      /*****************************************************************************************
                      function checkForDP
                      It returns the number of Diples Pliromenes, else it returns 0
                      It also register the couponID of Dp's to that global array $ArrayOfRegisterdDP
                      *****************************************************************************************/
                      function checkForDP($ArrayBetPoints_copy) {

                        $MaxDP=0;
                        global $ArrayOfRegisterdDP;

                        if (count($ArrayBetPoints_copy) == 0)
                            return 0;




                        for ($i=0;$i<count($ArrayBetPoints_copy);$i++) {

                            $checkCodeID = $ArrayBetPoints_copy[$i]['CouponID'];

                            for ($j=0;$j<count($ArrayBetPoints_copy);$j++) {

                                if  ( ($i!=$j) && ($ArrayBetPoints_copy[$j]['CouponID']==$checkCodeID) ) {

                                        $ArrayOfRegisterdDP[$MaxDP]=$checkCodeID;
                                        $MaxDP++;

                                }

                            }

                        }



                         if ($MaxDP > 0)
                             $MaxDP = $MaxDP / 2;


                         return $MaxDP;


                      }

                      /*****************************************************************************************
                      function checkForOdds
                      It returns the Odds, if dp's exists it returns the max odds

                      *****************************************************************************************/
                      function checkForOdds($ArrayBetPoints_copy) {

                          $dp=checkForDP($ArrayBetPoints_copy);
                          $Odds=1;

                          if ($dp==0) {
                            for ($i=0;$i<count($ArrayBetPoints_copy);$i++)
                                   $Odds = $Odds * floatval($ArrayBetPoints_copy[$i]['BetFactor']);
                          } else {

                             for ($i=0;$i<count($ArrayBetPoints_copy);$i++) {

                                  $checkCodeID = floatval($ArrayBetPoints_copy[$i]['CouponID']);
                                  $OddsTemp = floatval($ArrayBetPoints_copy[$i]['BetFactor']);

                                  for ($j=0;$j<count($ArrayBetPoints_copy);$j++) {

                                      if  ( ($i!=$j) && (floatval($ArrayBetPoints_copy[$j]['CouponID'])==$checkCodeID) && (floatval($ArrayBetPoints_copy[$j]['BetFactor']) > 0 ) ) {


                                           if (floatval($ArrayBetPoints_copy[$j]['BetFactor']) > $OddsTemp ){
                                               $OddsTemp = floatval($ArrayBetPoints_copy[$j]['BetFactor']);
                                           }


                                          //make them negative, so disallow any pass again.
                                           $ArrayBetPoints_copy[$i]['BetFactor'] = -floatval($ArrayBetPoints_copy[$i]['BetFactor']);
                                           $ArrayBetPoints_copy[$j]['BetFactor'] = -floatval($ArrayBetPoints_copy[$j]['BetFactor']);

                                      }

                                  }

                                  if ($OddsTemp > 0) {
                                    $Odds = $Odds * $OddsTemp;
                                  }
                             }

                            //make them all positive again
                            for ($i=0;$i<count($ArrayBetPoints_copy);$i++)
                                    $ArrayBetPoints_copy[$i]['BetFactor'] =abs(floatval($ArrayBetPoints_copy[$i]['BetFactor']));

                            }

                            return round($Odds,2);


                      }



                      function step($k, $l)  {

                          global $L,$N,$r,$x,$BetArray,$codeeventsBetFactor,$lastItemID,$SystemOdds;



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
                                      $SystemOdds=$SystemOdds+$odds;

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






                      $SavedOK = 'OK';
                      $SystemOdds=0;
                      $ArrayOfRegisterdDP=array();





                      if (isset($_POST['submitted']) && $_POST['submissionId'] == $_SESSION['nextValidSubmission']) {

                           //save the userbetssynopsis table and get the primary ID




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
                           } else {
                                $Err_Descr="Δεν βρέθηκε ο κωδικός του Agent/Super Agent.";
                                LogError(-1,100,"Δεν βρέθηκε ο κωδικός του Agent/Super Agent (submitbetform.php line 165.",$Err_Descr);
                                $SavedOK = 'Error 100';

                           }

                          if ( (floatval($_POST['f_cost']) < 5 ) ) {


                                $Err_Descr="Στοιχηματισμός μικρότερος από 5€.";
                                LogError(-1,108,"Στοιχηματισμός μικρότερος από 5€. f_odds=".$_POST['f_odds'].", f_possibleprofit=".$_POST['f_possibleprofit'].", f_bettype=".$_POST['f_bettype'].", f_cost=".$_POST['f_cost'].
                                        ", bet1=".$_POST['bet1'].", bet2=".$_POST['bet2'].", bet3=".$_POST['bet3'].", bet4=".$_POST['bet4'].", bet5=".$_POST['bet5'].", bet6=".$_POST['bet6'].
                                        ", bet7=".$_POST['bet7'].", bet8=".$_POST['bet8'].", bet9=".$_POST['bet9'].", bet10=".$_POST['bet10'].", bet11=".$_POST['bet11'].", bet12=".$_POST['bet2'].
                                        ", bet13=".$_POST['bet13'].", bet14=".$_POST['bet14'].", bet15=".$_POST['bet15'].
                                        ", point1=".$_POST['point1'].", point2=".$_POST['point2'].", point3=".$_POST['point3'].", point4=".$_POST['point4'].", point5=".$_POST['point5'].", point6=".$_POST['point6'].
                                        ", point7=".$_POST['point7'].", point8=".$_POST['point8'].", point9=".$_POST['point9'].", point10=".$_POST['point10'].", point11=".$_POST['point11'].", point12=".$_POST['point12'].
                                        ", point13=".$_POST['point13'].", point14=".$_POST['point14'].", point15=".$_POST['point15'],$Err_Descr);

                                $SavedOK = 'Error 108';
                          }

                           if ($SavedOK=='OK') {

                                   if ($NightRestrictions == 1) {

                                        if ( (intval($_POST['f_bettype']) == 0) && (floatval($_POST['f_cost']) > intval($LimitMona) ) ) {


                                              $Err_Descr="Δεν επιτρέπεται να στοιχηματίσετε μεγαλύτερο ποσό από ".number_format($LimitMona,2,'.','')." € όταν ισχύει το νυχτερινό όριο.";
                                              LogError(-1,105,"Στοιχηματισμός μεγαλύτερος από το νυχτερινό όριο. (LimitMona=".$LimitMona.", remainder=".$remainder.",f_cost=".$_POST['f_cost'].",ServerTime=".GR_Time("H:i:s",time()).", LimitFrom=". $NightFrom.", LimitTo=".$NightTo.")", $Err_Descr);

                                              $SavedOK = 'Error 105';
                                        }
                                        else if ( (intval($_POST['f_bettype']) == 1) && (floatval($_POST['f_cost']) > intval($LimitPollapla) ) ) {

                                              $Err_Descr="Δεν επιτρέπεται να στοιχηματίσετε μεγαλύτερο ποσό από ".number_format($LimitPollapla,2,'.','')." € όταν ισχύει το νυχτερινό όριο.";
                                              LogError(-1,105,"Στοιχηματισμός μεγαλύτερος από το νυχτερινό όριο. (LimitPollapla=".$LimitMona.", remainder=".$remainder.",f_cost=".$_POST['f_cost'].",ServerTime=".GR_Time("H:i:s",time()).", LimitFrom=". $NightFrom.", LimitTo=".$NightTo.")", $Err_Descr);

                                              $SavedOK = 'Error 105';
                                        }
                                        else if ( (intval($_POST['f_bettype']) == 2) && (floatval($_POST['f_cost']) > intval($LimitSystems) ) ) {

                                              $Err_Descr="Δεν επιτρέπεται να στοιχηματίσετε μεγαλύτερο ποσό από ".number_format($LimitSystems,2,'.','')." € όταν ισχύει το νυχτερινό όριο.";
                                              LogError(-1,105,"Στοιχηματισμός μεγαλύτερος από το νυχτερινό όριο. (LimitMona=".$LimitSystems.", remainder=".$remainder.",f_cost=".$_POST['f_cost'].",ServerTime=".GR_Time("H:i:s",time()).", LimitFrom=". $NightFrom.", LimitTo=".$NightTo.")", $Err_Descr);

                                              $SavedOK = 'Error 105';


                                        }
                                   }
                           }



                           if ($SavedOK=='OK') {
                                   $SAgentProfitWin =0;
                                   $SAgentProfitLose =0;
                                   $AgentProfit  =0;
                                   $MasterProfitWin =0;
                                   $MasterProfitLose =0;

                                   if ( (floatval($_POST['f_odds']) == 0 ) || (floatval($_POST['f_possibleprofit']) > 10000)  ||  (intval($_POST['f_bettype']) > 2)
                                      || (floatval($_POST['f_cost'])==0) || ($_POST['bet1']=='') || ($_POST['point1']=='') ) {

                                        $Err_Descr="Κάποιο από τα κρίσιμα πεδία είναι λάθος κατά την αποστολή του δελτίου.";
                                        LogError(-1,101,"Κάποιο από τα κρίσιμα πεδία είναι λάθος κατά την αποστολή του δελτίου (submitbetform.php line 179). f_odds=".$_POST['f_odds'].", f_possibleprofit=".$_POST['f_possibleprofit'].", f_bettype=".$_POST['f_bettype'].", f_cost=".$_POST['f_cost'].
                                        ", bet1=".$_POST['bet1'].", bet2=".$_POST['bet2'].", bet3=".$_POST['bet3'].", bet4=".$_POST['bet4'].", bet5=".$_POST['bet5'].", bet6=".$_POST['bet6'].
                                        ", bet7=".$_POST['bet7'].", bet8=".$_POST['bet8'].", bet9=".$_POST['bet9'].", bet10=".$_POST['bet10'].", bet11=".$_POST['bet11'].", bet12=".$_POST['bet2'].
                                        ", bet13=".$_POST['bet13'].", bet14=".$_POST['bet14'].", bet15=".$_POST['bet15'].
                                        ", point1=".$_POST['point1'].", point2=".$_POST['point2'].", point3=".$_POST['point3'].", point4=".$_POST['point4'].", point5=".$_POST['point5'].", point6=".$_POST['point6'].
                                        ", point7=".$_POST['point7'].", point8=".$_POST['point8'].", point9=".$_POST['point9'].", point10=".$_POST['point10'].", point11=".$_POST['point11'].", point12=".$_POST['point12'].
                                        ", point13=".$_POST['point13'].", point14=".$_POST['point14'].", point15=".$_POST['point15']
                                        , $Err_Descr);

                                        $SavedOK = 'Error 101';

                                   }

                                  if ($SavedOK=='OK') {

                                         if ( (floatval($remainder) <0) || ( (floatval($remainder)-floatval($_POST['f_cost']) ) <0 ) )  {

                                              $Err_Descr="Το υπόλοιπο του agent ειναι ίσο ή μικρότερο του μηδενός. ";
                                              LogError(-1,102,"Το υπόλοιπο του agent ειναι ίσο ή μικρότερο του μηδενός (submitbetform.php line 273). (remainder=".$remainder.",f_cost=".$_POST['f_cost'].")", $Err_Descr);

                                              $SavedOK = 'Error 102';

                                         }


                                         if ($SavedOK=='OK') {

                                                 $sqlquery = "INSERT INTO userbetssynopsis (SAgentID,AgentID,DateTime,BetType,Cost,SAgentProfitWin,SAgentProfitLose,AgentProfit,MasterProfitWin,MasterProfitLose,Odds,PossibleProfit)".
                                                 " VALUES (".$SAgentID.",".$_SESSION['user/id'].",'".GR_Time('Y-m-d H:i:s',time())."',".$_POST['f_bettype'].",".$_POST['f_cost'].",".$SAgentProfitWin.",".$SAgentProfitLose.",".$AgentProfit.",".
                                                      $MasterProfitWin.",".$MasterProfitLose.",".$_POST['f_odds'].",".$_POST['f_possibleprofit'].");";


                                                 $result_id = mysql_query($sqlquery);
                                                 $lastItemID = mysql_insert_id();
                                                 $result_id = mysql_query("select DateTime from userbetssynopsis where UserBetSynopsisID=".$lastItemID);
                                                 $row = mysql_fetch_assoc($result_id);
                                                 if ($row) {
                                                    $TimeStamp = $row['DateTime'];
                                                 } else {

                                                      $Err_Descr="Δεν βρέθηκε το δελτίο κατά την αναζήτηση.";
                                                      LogError($lastItemID,103,"Δεν βρέθηκε το δελτίο κατά την αναζήτηση (submitbetform.php line 196).", $Err_Descr);

                                                      $SavedOK = 'Error 103';

                                                 }

                                                 if ($SavedOK=='OK') {
                                                       $ShowHTML = '';
                                                       $ShowHTML .= "<table width=850px border=0 cellSpacing=0 cellPadding=0 bgcolor=#555555 >";
                                                       $ShowHTML .= "<tr height=2px bgcolor=#FFCC00><td></td></tr>";
                                                       $ShowHTML .= "<tr height=5px ><td></td></tr>";
                                                       $ShowHTML .= "<tr><td align=center>";
                                                       $ShowHTML .= "<table width=830px border=0 cellSpacing=2 cellPadding=2 class=PrintClass bgcolor=white>";
                                                       $ShowHTML .= "<tr><td bgcolor=#000000 class=Title width=200px>Agent</td><td class=Data1 bgcolor=#000000>".$Name."</td></tr>";
                                                       $ShowHTML .= "<tr><td bgcolor=#000000 class=Title width=200px>Ημερομηνία και ώρα</td><td class=Data1 bgcolor=#000000>".date("d/m/y (H:i:s)", strtotime($TimeStamp))."</td></tr>";
                                                       $ShowHTML .= "<tr><td bgcolor=#000000 class=Title width=200px>Κωδικός δελτίου</td><td class=Data1 bgcolor=#000000>".rand_uniqid($lastItemID,true)."</td></tr>";
                                                       switch ($_POST['f_bettype']) {

                                                            case 0 :$BetType='Μονό';break;
                                                            case 1 :$BetType='Πολλαπλό';break;
                                                            case 2 :$BetType='Σύστημα';break;


                                                       }
                                                       $ShowHTML .= "<tr><td bgcolor=#000000 class=Title width=200px>Τύπος στοιχήματος</td><td class=Data1 bgcolor=#000000>".$BetType."</td></tr>";
                                                       $ShowHTML .= "<tr><td bgcolor=#000000 class=Title width=200px>Ποσό στοιχηματισμού</td><td class=Title bgcolor=#000000>€".$_POST['f_cost']."</td></tr>";
                                                       $ShowHTML .= "<tr><td bgcolor=#000000 class=Title width=200px>Πιθανό κέρδος</td><td class=Title bgcolor=#000000>€".$_POST['f_possibleprofit']."</td></tr>";
                                                       $ShowHTML .= "<tr><td bgcolor=#000000 class=Title width=200px>Κέρδος</td><td class=Title bgcolor=#000000>€0.00</td></tr>";

                                                       $BetStatus = "<span style=\"color:#DBB793\">Ανοιχτό</span>";
                                                       $ShowHTML .= "<tr><td bgcolor=#000000 class=Title width=200px>Κατάσταση δελτίου</td><td class=Data1 bgcolor=#000000>".$BetStatus."</td></tr>";
                                                       $ShowHTML .= "</table>";

                                                       $ShowHTML .= "<br>";
                                                       $ShowHTML .= "<table width=800px  cellSpacing=2 cellPadding=2>";
                                                       $ShowHTML .= "<tr><td class=PrintClass bgcolor=#FF6633 colspan=7 align=center style=\"color:white\">Λεπτομέρειες στοιχήματος</td></tr>";
                                                       $ShowHTML .= "<tr><td bgcolor=#EEEEEE align=center class=Header1>Κωδικός</td><td bgcolor=#EEEEEE align=center class=Header1>Γεγονός</td><td align=center bgcolor=#EEEEEE class=Header1>Σημείο</td><td align=center bgcolor=#EEEEEE class=Header1>Απόδοση</td><td align=center bgcolor=#EEEEEE class=Header1>Ημίχρονο</td><td align=center bgcolor=#EEEEEE class=Header1>Τελικό</td><td align=center bgcolor=#EEEEEE class=Header1>Πρόβλεψη</td></tr>";



                                                       $BetsCounter = 0;
                                                       $codeevents='';
                                                       $codeeventsBetFactor=array();
                                                       $ArrayBetPoint=array();
                                                       $count=0;

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
                                                                            case 'Code'  : $ArrayBetPoint[$count]['Code']=$value; $Code = "<td bgcolor=#444444 class=Data1 align=center>".$value."</td>";break;
                                                                            case 'Event' : $ArrayBetPoint[$count]['Event']=$value; $Event = "<td bgcolor=#444444 class=Data1 align=center>".$value."</td>";break;
                                                                            case 'Goal'  : $ArrayBetPoint[$count]['Goal']=$value; $Goal = "<td bgcolor=#444444 class=Data1 align=center>".$value."</td>";break;
                                                                            case 'BetFactor' : $ArrayBetPoint[$count]['BetFactor']=$value; $BetFactor = "<td bgcolor=#444444 class=Data1 align=center>".$value."</td>";
                                                                                               $codeeventsBetFactor[$BetsCounter]=$value;
                                                                                               break;
                                                                            case 'CouponID' : $ArrayBetPoint[$count]['CouponID']=$value; $CouponID = $value;break;
                                                                            case 'EE' : $ArrayBetPoint[$count]['EE']=$value;break;
                                                                          }




                                                  				  }

                                                                  $BetsCounter++;

                                                                  $ShowHTML .= "<tr>".$Code.$Event.$Goal.$BetFactor."<td bgcolor=#444444 class=Data1 align=center> - </td> <td bgcolor=#444444 class=Data1 align=center> - </td><td bgcolor=#444444 class=Data1 style=\"color:#DBB793\" align=center >Ανοιχτό</td></tr>";

                                                                  $fields = substr($fields, 0, -1);
                                                                  $data = substr($data, 0, -1);

                                                                  $fields="(UserBetSynopsisID,".$fields.")";
                                                                  $data="(".$lastItemID.",".$data.")";


                                                                  $sqlquery = "INSERT INTO userbets ".$fields." VALUES ".$data.";";
                                                                  $result_id = mysql_query($sqlquery);
                                                                  $lastItemUserBetsID = mysql_insert_id();
                                                                  $codeevents = $codeevents.$CouponID."|";

                                                                  $count++;

                                                            }
                                                           }

                                                          }

                                                        //fill the array $ArrayOfRegisterdDP
                                                        $dp = checkForDP($ArrayBetPoint);

                                                        //update with BetDP=1 all bets that belong to DP
                                                        for ($i=0;$i<count($ArrayOfRegisterdDP);$i++) {

                                                                $CouponID = $ArrayOfRegisterdDP[$i];
                                                                $sqlquery = "UPDATE  userbets SET BetDP = 1  WHERE CouponID=".$CouponID." AND UserBetSynopsisID=".$lastItemID;
                                                                $result_id = mysql_query($sqlquery);
                                                        }




                                                        if ($dp > 4) {

                                                            $Err_Descr="Βρέθηκε μεγαλύτερος αριθμός διπλών πληρωμένων από το μέγιστο επιτρεπτό (μέγιστο=4).";
                                                            LogError($lastItemID,109,"Βρέθηκε μεγαλύτερος αριθμός διπλών πληρωμένων από το μέγιστο επιτρεπτό (μέγιστο=4).", $Err_Descr);

                                                            $SavedOK = 'Error 109';

                                                            //goto exit_label;
                                                        }


                                                        if ($SavedOK=='OK') {

                                                              //compare DB BetFactor with submitted BetFactor to see if they are the same
                                                              $sqlquery ="SELECT C.UserBetSynopsisID FROM userbetssynopsis AS C
                                                              LEFT JOIN userbets AS UB
                                                                ON C.UserBetSynopsisID = UB.UserBetSynopsisID
                                                              LEFT JOIN coupons AS CH
                                                                ON UB.CouponID = CH.CouponID
                                                              WHERE C.UserBetSynopsisID=".$lastItemID." AND UB.BetFactor <> (CASE GoalCoded
                                                                                                                              WHEN 0 THEN Goal_1
                                                                                                                              WHEN 1 THEN Goal_x
                                                                                                                              WHEN 2 THEN Goal_2
                                                                                                                              WHEN 3 THEN Under
                                                                                                                              WHEN 4 THEN Over
                                                                                                                              WHEN 5 THEN GG
                                                                                                                              WHEN 6 THEN NG
                                                                                                                              WHEN 7 THEN de_1ORX
                                                                                                                              WHEN 8 THEN de_XOR2
                                                                                                                              WHEN 9 THEN de_1OR2
                                                                                                                              WHEN 10 THEN HMI_1
                                                                                                                              WHEN 11 THEN HMI_X
                                                                                                                              WHEN 12 THEN HMI_2
                                                                                                                              WHEN 13 THEN HT_11
                                                                                                                              WHEN 14 THEN HT_1X
                                                                                                                              WHEN 15 THEN HT_12
                                                                                                                              WHEN 16 THEN HT_X1
                                                                                                                              WHEN 17 THEN HT_XX
                                                                                                                              WHEN 18 THEN HT_X2
                                                                                                                              WHEN 19 THEN HT_21
                                                                                                                              WHEN 20 THEN HT_2X
                                                                                                                              WHEN 21 THEN HT_22
                                                                                                                              WHEN 22 THEN SS_10
                                                                                                                              WHEN 23 THEN SS_20
                                                                                                                              WHEN 24 THEN SS_21
                                                                                                                              WHEN 25 THEN SS_30
                                                                                                                              WHEN 26 THEN SS_31
                                                                                                                              WHEN 27 THEN SS_32
                                                                                                                              WHEN 28 THEN SS_40
                                                                                                                              WHEN 29 THEN SS_41
                                                                                                                              WHEN 30 THEN SS_42
                                                                                                                              WHEN 31 THEN SS_43
                                                                                                                              WHEN 32 THEN SS_00
                                                                                                                              WHEN 33 THEN SS_11
                                                                                                                              WHEN 34 THEN SS_22
                                                                                                                              WHEN 35 THEN SS_33
                                                                                                                              WHEN 36 THEN SS_01
                                                                                                                              WHEN 37 THEN SS_02
                                                                                                                              WHEN 38 THEN SS_12
                                                                                                                              WHEN 39 THEN SS_03
                                                                                                                              WHEN 40 THEN SS_13
                                                                                                                              WHEN 41 THEN SS_23
                                                                                                                              WHEN 42 THEN SS_04
                                                                                                                              WHEN 43 THEN SS_14
                                                                                                                              WHEN 44 THEN SS_24
                                                                                                                              WHEN 45 THEN SS_34
                                                                                                                              WHEN 46 THEN TG_01
                                                                                                                              WHEN 47 THEN TG_23
                                                                                                                              WHEN 48 THEN TG_46
                                                                                                                              WHEN 49 THEN TG_7
                                                                                                                              END)
                                                              AND Published=1 AND Showed=1 order by C.DateTime Asc" ;
                                                              $result_id = mysql_query($sqlquery);
                                                              $num_rows = mysql_num_rows($result_id);
                                                              if ($num_rows > 0) {

                                                                        $Err_Descr="Απέτυχε ο έλεγχος των αποδόσεων.";
                                                                        LogError($lastItemID,115,"Απέτυχε ο έλεγχος των αποδόσεων (DB Error).  f_odds=".$_POST['f_odds'].", f_possibleprofit=".$_POST['f_possibleprofit'].", f_bettype=".$_POST['f_bettype'].", f_cost=".$_POST['f_cost'].
                                                                        ", bet1=".$_POST['bet1'].", bet2=".$_POST['bet2'].", bet3=".$_POST['bet3'].", bet4=".$_POST['bet4'].", bet5=".$_POST['bet5'].", bet6=".$_POST['bet6'].
                                                                        ", bet7=".$_POST['bet7'].", bet8=".$_POST['bet8'].", bet9=".$_POST['bet9'].", bet10=".$_POST['bet10'].", bet11=".$_POST['bet11'].", bet12=".$_POST['bet2'].
                                                                        ", bet13=".$_POST['bet13'].", bet14=".$_POST['bet14'].", bet15=".$_POST['bet15'].
                                                                        ", point1=".$_POST['point1'].", point2=".$_POST['point2'].", point3=".$_POST['point3'].", point4=".$_POST['point4'].", point5=".$_POST['point5'].", point6=".$_POST['point6'].
                                                                        ", point7=".$_POST['point7'].", point8=".$_POST['point8'].", point9=".$_POST['point9'].", point10=".$_POST['point10'].", point11=".$_POST['point11'].", point12=".$_POST['point12'].
                                                                        ", point13=".$_POST['point13'].", point14=".$_POST['point14'].", point15=".$_POST['point15'], $Err_Descr);

                                                                        $SavedOK = 'Error 115';
                                                              }

                                                         }

                                                         if ($SavedOK=='OK') {

                                                              //compare DB EE with submitted EE to see if they are the same
                                                              $sqlquery ="SELECT C.UserBetSynopsisID FROM userbetssynopsis AS C
                                                              LEFT JOIN userbets AS UB
                                                                ON C.UserBetSynopsisID = UB.UserBetSynopsisID
                                                              LEFT JOIN coupons AS CH
                                                                ON UB.CouponID = CH.CouponID
                                                              WHERE C.UserBetSynopsisID=".$lastItemID." AND UB.EE <> CH.EE AND Published=1 AND Showed=1 order by C.DateTime Asc" ;
                                                              $result_id = mysql_query($sqlquery);
                                                              $num_rows = mysql_num_rows($result_id);
                                                              if ($num_rows > 0) {

                                                                        $Err_Descr="Απέτυχε ο έλεγχος των ελαχίστων σημείων (γεγονότα) που μπορεί να παίξει κάποιος παίκτης.";
                                                                        LogError($lastItemID,114,"Απέτυχε ο έλεγχος των ελαχίστων σημείων (γεγονότα) που μπορεί να παίξει κάποιος παίκτης (DB Error). f_odds=".$_POST['f_odds'].", f_possibleprofit=".$_POST['f_possibleprofit'].", f_bettype=".$_POST['f_bettype'].", f_cost=".$_POST['f_cost'].
                                                                        ", bet1=".$_POST['bet1'].", bet2=".$_POST['bet2'].", bet3=".$_POST['bet3'].", bet4=".$_POST['bet4'].", bet5=".$_POST['bet5'].", bet6=".$_POST['bet6'].
                                                                        ", bet7=".$_POST['bet7'].", bet8=".$_POST['bet8'].", bet9=".$_POST['bet9'].", bet10=".$_POST['bet10'].", bet11=".$_POST['bet11'].", bet12=".$_POST['bet2'].
                                                                        ", bet13=".$_POST['bet13'].", bet14=".$_POST['bet14'].", bet15=".$_POST['bet15'].
                                                                        ", point1=".$_POST['point1'].", point2=".$_POST['point2'].", point3=".$_POST['point3'].", point4=".$_POST['point4'].", point5=".$_POST['point5'].", point6=".$_POST['point6'].
                                                                        ", point7=".$_POST['point7'].", point8=".$_POST['point8'].", point9=".$_POST['point9'].", point10=".$_POST['point10'].", point11=".$_POST['point11'].", point12=".$_POST['point12'].
                                                                        ", point13=".$_POST['point13'].", point14=".$_POST['point14'].", point15=".$_POST['point15'],$Err_Descr);

                                                                        $SavedOK = 'Error 114';
                                                              }

                                                        }



                                                       if ($SavedOK=='OK') {

                                                              //check to see if the coupon submitted with invalid EE rule
                                                              //length < min EE

                                                             $MaxBetsCounter = $BetsCounter;
                                                             if ( $dp > 0) {

                                                                  $MaxBetsCounter=$BetsCounter-$dp;

                                                             }

                                                             for ($i=0;$i<count($ArrayBetPoint);$i++) {

                                                                     if (intval($ArrayBetPoint[$i]['EE']) > $MaxBetsCounter) {
                                                                        $Err_Descr="Απέτυχε ο έλεγχος των ελαχίστων σημείων (γεγονότα) που μπορεί να παίξει κάποιος παίκτης.";
                                                                        LogError($lastItemID,114,"Απέτυχε ο έλεγχος των ελαχίστων σημείων (γεγονότα) που μπορεί να παίξει κάποιος παίκτης (JS Error).   f_odds=".$_POST['f_odds'].", f_possibleprofit=".$_POST['f_possibleprofit'].", f_bettype=".$_POST['f_bettype'].", f_cost=".$_POST['f_cost'].
                                                                        ", bet1=".$_POST['bet1'].", bet2=".$_POST['bet2'].", bet3=".$_POST['bet3'].", bet4=".$_POST['bet4'].", bet5=".$_POST['bet5'].", bet6=".$_POST['bet6'].
                                                                        ", bet7=".$_POST['bet7'].", bet8=".$_POST['bet8'].", bet9=".$_POST['bet9'].", bet10=".$_POST['bet10'].", bet11=".$_POST['bet11'].", bet12=".$_POST['bet2'].
                                                                        ", bet13=".$_POST['bet13'].", bet14=".$_POST['bet14'].", bet15=".$_POST['bet15'].
                                                                        ", point1=".$_POST['point1'].", point2=".$_POST['point2'].", point3=".$_POST['point3'].", point4=".$_POST['point4'].", point5=".$_POST['point5'].", point6=".$_POST['point6'].
                                                                        ", point7=".$_POST['point7'].", point8=".$_POST['point8'].", point9=".$_POST['point9'].", point10=".$_POST['point10'].", point11=".$_POST['point11'].", point12=".$_POST['point12'].
                                                                        ", point13=".$_POST['point13'].", point14=".$_POST['point14'].", point15=".$_POST['point15'], $Err_Descr);

                                                                        $SavedOK = 'Error 114';
                                                                        break;
                                                                     }

                                                              }
                                                        }

                                                        if ( ($dp > 0) && (intval($_POST['f_bettype'])!=1) && ($SavedOK=='OK') )  {

                                                            $Err_Descr="Το δελτίο ενώ είχε διπλές πληρωμένες δεν είχε δηλωθεί σαν πολλαπλό.";
                                                            LogError($lastItemID,110,"Το δελτίο ενώ είχε διπλές πληρωμένες δεν είχε δηλωθεί σαν πολλαπλό.", $Err_Descr);

                                                            $SavedOK = 'Error 110';

                                                            //goto exit_label;
                                                        }

                                                        if (($dp > 0) && ($SavedOK=='OK')) {


                                                            $result_id = mysql_query("update userbetssynopsis SET dp=".$dp." where UserBetSynopsisID=".$lastItemID);

                                                            if (!$result_id) {

                                                                $Err_Descr="Απέτυχε η πρόσβαση στη βάση δεδομένων κατά την καταχώρηση δεδομένων του δελτίου.";
                                                                LogError($lastItemID,110,"Απέτυχε η πρόσβαση στη βάση δεδομένων κατά την καταχώρηση δεδομένων του δελτίου.", $Err_Descr);

                                                                $SavedOK = 'Error 113';

                                                                //goto exit_label;

                                                            }
                                                        }

                                                        /*
                                                        if ( (intval($_POST['f_bettype'])!=2) && ($SavedOK=='OK') ){
                                                            $TakeOdds = checkForOdds($ArrayBetPoint);

                                                            if ($TakeOdds != floatval($_POST['f_odds'])) {

                                                                echo '**********'.$TakeOdds;
                                                                $Err_Descr="Ο έλεγχος της απόδοσης του μονού ή πολλαπλού δεν επαληθεύτηκε.";
                                                                LogError($lastItemID,111,"Ο έλεγχος της απόδοσης του μονού ή του πολλαπλού δεν επαληθεύτηκε.", $Err_Descr);

                                                                $SavedOK = 'Error 111';

                                                                //goto exit_label;

                                                            }
                                                        }
                                                        */

                                                        if ( $SavedOK == 'OK') {

                                                                //now its time to check if the current coupon has matches that have already started
                                                                $sqlquery ="SELECT C.UserBetSynopsisID,C.AgentID, C.DateTime AS DeltioDateTime, CH.CouponID, UB.Event, CH.Date, CH.Time
                                                                FROM userbetssynopsis AS C
                                                                LEFT JOIN userbets AS UB
                                                                  ON C.UserBetSynopsisID = UB.UserBetSynopsisID
                                                                LEFT JOIN coupons AS CH
                                                                  ON UB.CouponID = CH.CouponID
                                                                WHERE C.UserBetSynopsisID=".$lastItemID." AND TIMESTAMPDIFF(SECOND,TIMESTAMP(CH.Date,CH.Time),TIMESTAMP(C.DateTime)) > 1 AND Published=1 AND Showed=1 order by C.DateTime Asc";
                                                                $result_id = mysql_query($sqlquery);
                                                                $num_rows = mysql_num_rows($result_id);
                                                                if  ($num_rows > 0) {

                                                                       //this is not really needed since in the LogError we use ROLLBACK
                                                                      //$sqlquery='delete FROM userbetssynopsis WHERE UserBetSynopsisID='.$lastItemID;
                                                                      //$result_id = mysql_query($sqlquery);


                                                                      $Err_Descr="Κάποιος από τους επιλεγμένους αγώνες έχει ήδη ξεκινήσει.";
                                                                      LogError($lastItemID,104,"Κάποιος από τους επιλεγμένους αγώνες έχει ήδη ξεκινήσει (submitbetform.php line 196). f_odds=".$_POST['f_odds'].", f_possibleprofit=".$_POST['f_possibleprofit'].", f_bettype=".$_POST['f_bettype'].", f_cost=".$_POST['f_cost'].
                                                                      ", bet1=".$_POST['bet1'].", bet2=".$_POST['bet2'].", bet3=".$_POST['bet3'].", bet4=".$_POST['bet4'].", bet5=".$_POST['bet5'].", bet6=".$_POST['bet6'].
                                                                      ", bet7=".$_POST['bet7'].", bet8=".$_POST['bet8'].", bet9=".$_POST['bet9'].", bet10=".$_POST['bet10'].", bet11=".$_POST['bet11'].", bet12=".$_POST['bet2'].
                                                                      ", bet13=".$_POST['bet13'].", bet14=".$_POST['bet14'].", bet15=".$_POST['bet15'].
                                                                      ", point1=".$_POST['point1'].", point2=".$_POST['point2'].", point3=".$_POST['point3'].", point4=".$_POST['point4'].", point5=".$_POST['point5'].", point6=".$_POST['point6'].
                                                                      ", point7=".$_POST['point7'].", point8=".$_POST['point8'].", point9=".$_POST['point9'].", point10=".$_POST['point10'].", point11=".$_POST['point11'].", point12=".$_POST['point12'].
                                                                      ", point13=".$_POST['point13'].", point14=".$_POST['point14'].", point15=".$_POST['point15']
                                                                      , $Err_Descr);

                                                                      $SavedOK = 'Error 104';

                                                                      //goto exit_label;

                                                                }
                                                        }

                                                        if ($SavedOK=='OK') {

                                                                echo $ShowHTML;
                                                                $codeevents = substr($codeevents, 0, -1);

                                                                echo "</table>";
                                                                echo "<br><br>";

                                                                if ($_POST['f_bettype']==2) {
                                                                  echo "<table width=750px>";
                                                                  echo "<tr><td class=PrintClass bgcolor=#FF6633 colspan=4 align=center style=\"color:white\">Πληροφορίες στοιχήματος</td></tr>";
                                                                  echo "<tr><td bgcolor=#EEEEEE align=center class=Header1>Περιγραφή</td><td bgcolor=#EEEEEE align=center class=Header1>Στήλες</td><td align=center bgcolor=#EEEEEE class=Header1>Ποσό σε €</td></tr>";
                                                                }

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

                                                                          if (intval($_POST['f_bettype'])==2) {
                                                                              echo "<tr>".$MulFactor.$ColNum.$BetMoney."</tr>";
                                                                          }

                                                                          $fields = substr($fields, 0, -1);
                                                                          $data = substr($data, 0, -1);

                                                                          $fields="(UserBetSynopsisID,".$fields.")";
                                                                          $data="(".$lastItemID.",".$data.")";


                                                                          $sqlquery = "INSERT INTO userbetsmoney ".$fields." VALUES ".$data.";";
                                                                          $result_id = mysql_query($sqlquery);
                                                                          if (!$result_id) {

                                                                              $Err_Descr="Απέτυχε η πρόσβαση στη βάση δεδομένων κατά την καταχώρηση δεδομένων του δελτίου.";
                                                                              LogError($lastItemID,110,"Απέτυχε η πρόσβαση στη βάση δεδομένων κατά την καταχώρηση δεδομένων του δελτίου.", $Err_Descr);

                                                                              $SavedOK = 'Error 113';

                                                                              //goto exit_label;

                                                                          }



                                                                    }

                                                                  }

                                                                }

                                                                if ($SavedOK=='OK') {

                                                                        if (intval($_POST['f_bettype'])==2) {
                                                                            echo "</table>";
                                                                        }




                                                                       //mono
                                                                       if ( $_POST['f_bettype'] == 0) {

                                                                               $AgentProfit = floatval($_POST['f_cost']) *  ($Mona / 100.0);


                                                                       //pollaplo
                                                                       } else if ( ( intval($_POST['f_bettype']) == 1)  && ( ($BetsCounter-$dp) == 2 ) ) {

                                                                                $AgentProfit = floatval($_POST['f_cost']) *  ($Dipla / 100.0);

                                                                       } else if ( ( intval($_POST['f_bettype']) == 1)  && ( ( $BetsCounter-$dp) > 2) ) {
                                                                              $AgentProfit = floatval($_POST['f_cost']) *  ($Triades / 100.0);

                                                                       //system
                                                                       } else if ( intval($_POST['f_bettype']) == 2) {
                                                                              $AgentProfit = floatval($_POST['f_cost']) *  ($Systems / 100.0);

                                                                       }


                                                                       if ($Commission_tziros == 0) {
                                                                           //pososto
                                                                           $SAgentProfitWin =  (floatval($_POST['f_cost'])-$AgentProfit) *  ($Commission_pososto / 100.0);
                                                                           $SAgentProfitLose = (floatval($_POST['f_possibleprofit'])-floatval($_POST['f_cost'])+$AgentProfit) *  ($Commission_pososto / 100.0);
                                                                           $MasterProfitLose=  floatval($_POST['f_possibleprofit']) - floatval($_POST['f_cost']) +  $AgentProfit - $SAgentProfitLose;

                                                                       } else {
                                                                           //tziros
                                                                           $SAgentProfitWin = floatval($_POST['f_cost']) * ($Commission_tziros / 100.0);
                                                                           $SAgentProfitLose = 0;
                                                                           $MasterProfitLose=  floatval($_POST['f_possibleprofit']) - floatval($_POST['f_cost']) +  $AgentProfit + $SAgentProfitWin;

                                                                       }

                                                                       $MasterProfitWin =  floatval($_POST['f_cost']) - $AgentProfit - $SAgentProfitWin ;



                                                                       $result_id = mysql_query("update userbetssynopsis SET UserBetsCount=".$BetsCounter.",AgentProfit=".$AgentProfit.",SAgentProfitWin=".$SAgentProfitWin.
                                                                                    ",SAgentProfitLose=".$SAgentProfitLose.", MasterProfitWin=".$MasterProfitWin.", MasterProfitLose=".$MasterProfitLose.", UniqueID='".rand_uniqid($lastItemID,true)."' where UserBetSynopsisID=".$lastItemID);

                                                                        if (!$result_id) {

                                                                            $Err_Descr="Απέτυχε η πρόσβαση στη βάση δεδομένων κατά την καταχώρηση δεδομένων του δελτίου.";
                                                                            LogError($lastItemID,110,"Απέτυχε η πρόσβαση στη βάση δεδομένων κατά την καταχώρηση δεδομένων του δελτίου.", $Err_Descr);

                                                                            $SavedOK = 'Error 113';

                                                                            //goto exit_label;

                                                                        }

                                                                       if ($SavedOK=='OK') {

                                                                           $remainder = floatval($_POST['f_remainder']) - floatval($_POST['f_cost']); //+ $AgentProfit;
                                                                           $result_id = mysql_query("update agents SET Remainder=".floatval($remainder)." where AgentID=".$_SESSION['user/id']);
                                                                           if (!$result_id) {

                                                                                $Err_Descr="Απέτυχε η πρόσβαση στη βάση δεδομένων κατά την καταχώρηση δεδομένων του δελτίου.";
                                                                                LogError($lastItemID,110,"Απέτυχε η πρόσβαση στη βάση δεδομένων κατά την καταχώρηση δεδομένων του δελτίου.", $Err_Descr);

                                                                                $SavedOK = 'Error 113';

                                                                                //goto exit_label;

                                                                           }

                                                                       }

                                                                       if ($SavedOK=='OK'){

                                                                            $N=$BetsCounter;
                                                                            $x = explode("|",$codeevents);
                                                                            $r = array();
                                                                            $L=0;






                                                                          if ( $_POST['f_bettype'] ==  2) {


                                                                             for ($L=$N; $L>=1; $L--)
                                                                             {
                                                                                  unset($r);
                                                                                  step(0,0);
                                                                             };

                                                                            /*
                                                                            if ( round($SystemOdds,2) != floatval($_POST['f_odds']) ) {

                                                                              $Err_Descr="Ο έλεγχος της απόδοσης του συστήματος δεν επαληθεύτηκε.";
                                                                              LogError($lastItemID,112,"Ο έλεγχος της απόδοσης του συστήματος δεν επαληθεύτηκε.", $Err_Descr);

                                                                              $SavedOK = 'Error 112';

                                                                              //goto exit_label;

                                                                            }

                                                                            */

                                                                          }
                                                                  }


                                                               }

                                                               if ($SavedOK=='OK'){


                                                                   $sqlquery = "UPDATE errorreport SET UserBetSynopsisID=".$lastItemID." Where ReportID=".$GetCouponID;
                                                                   $result_id = mysql_query($sqlquery);
                                                                   if (!$result_id) {
                                                                      $message  = 'Invalid query: ' . mysql_error() . "\n";
                                                                      $message .= 'Whole query: ' .$sqlquery;
                                                                    }

                                                                   mysql_query("COMMIT");
                                                                   mysql_close($DB);
                                                                   $SavedOK = 'OK';



                                                                   //$_SESSION['nextValidSubmission'] = rand(1000000,9999999);
                                                               }
                                            }
                                         }
                                  }
                           }

                      }
                     } else if ($_POST['submissionId'] != $_SESSION['nextValidSubmission']) {
                        $Err_Descr="Δεν επιτρέπεται η εκ νέου αποστολή του δελτίου με τη μέθοδο της ανανέωσης σελίδας.";
                        LogError(-1,106,"Δεν επιτρέπεται η εκ νέου αποστολή του δελτίου με τη μέθοδο της ανανέωσης σελίδας. (submitbetform.php line 546).", $Err_Descr);

                        $SavedOK = 'Error 106';
                        $remainder = 0;

                        //goto exit_label;
                     }

                     //exit_label:

                     $_SESSION['nextValidSubmission'] = rand(1000000,9999999);

                ?>

                <script>
                 var SavedOK = '<?php echo $SavedOK ?>';
                 var Remainder = <?php echo $remainder ?>;
                 var Err_Descr = '<?php echo $Err_Descr ?>';



                 if (SavedOK == 'OK') {
                         YAHOO.util.Dom.get('Image').innerHTML = '<img src="../grafix/success_icon.png" width="48" height="50" align="absmiddle" border="0" hspace="2" vspace="2" alt="success">';
                         YAHOO.util.Dom.get('Descr').innerHTML ='<br><span style="color:#FFFFCC;font-weight: bold;font-size:12px">Η καταχώρηση του δελτίου έγινε επιτυχώς.</span> <br><br>'+
                                        'Μπορείτε εφόσον το επιθυμείτε να εκτυπώσετε το δελτίο σας. Σας ευχόμαστε καλή επιτυχία!<br><br>';
                 } else {

                         YAHOO.util.Dom.get('Image').innerHTML = '<img src="../grafix/fail_icon.png" width="60" height="50" align="middle" border="0" hspace="2" vspace="2" alt="success">';
                         YAHOO.util.Dom.get('Descr').innerHTML ='<br><span style="color:#FFFFCC;font-weight: bold;font-size:12px">Η καταχώρηση του δελτίου απέτυχε.</span><br><br>'+
                                        'Το σφάλμα, οφείλεται στη μη ολοκλήρωση της διαδικασίας μεταφοράς των δεδομένων λόγω κάποιας διακοπής της σύνδεσης, λόγου κάποιου σφάλματος, ή διότι προσπαθήσατε να '+
                                        'να ξαναστείλετε το δελτίο κάνοντας κλικ στο κουμπί Ανανέωση (refresh) από το πρόγραμμα πλοήγησης (Browser).<br><br>'+
                                        'Αν το πρόβλημα δεν οφείλεται στους παραπάνω λόγους και δεν είναι δυνατή η εύρυθμη λειτουργία της εφαρμογής, παρακαλώ επικοινωνήστε με τη <b>VelvetBet</b>.<br><br>'+
                                        '<br><br>Περιγραφή σφάλματος:<br><br><b>[<span style="color:#FFFF00">'+(Err_Descr)+'</span>]</b><br><br>'+
                                        'Το πρόβλημα καταγράφηκε από τo σύστημα και θα εξεταστεί άμεσα για την επίλυση του.<br><br>';
                 }


                YAHOO.util.Dom.get('Remainder').innerHTML = '€' + eval(Remainder).toFixed(2);
                </script>
                <br><br>
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
         <?php
         include '../includes/footer.php';
         ?>
    </TD>
  </TR>
</TBODY>
</TABLE>
</div>

</BODY>
</HTML>
