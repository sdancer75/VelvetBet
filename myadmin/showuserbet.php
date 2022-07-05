<?php
    session_start();
    include_once '../includes/database.php';
    include_once '../includes/login.php';
    include_once '../includes/functions.php';
    include_once '../includes/statistics.php';


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



<script type="text/javascript" src="../build/yahoo-dom-event/yahoo-dom-event.js"></script>







</HEAD>


<BODY class="yui-skin-sam"  oncontextmenu="return false">

<div align=top>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
  <TBODY>
    <TR>
    <TD style="VERTICAL-ALIGN: top;" width="100%" >

      <Table border=0 width="800px">

       <TR>
            <TD  align="center" >




                <?php



                      if (isset($_GET['id']) || isset($_GET['idu']) )  {

                           //save the userbetssynopsis table and get the primary ID
                           $DB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
                           mysql_select_db(DataBase, $DB) or die(mysql_error());
                       	   mysql_query("SET NAMES 'utf8'");

                           if (isset($_GET['id']))
                               $decoded_id=decrypt(CRYPTKEY,rawurldecode($_GET['id']));
                           else
                               $decoded_id=trim($_GET['idu']);




                           $result_id = mysql_query("select Name,userbetssynopsis.* from userbetssynopsis,agents where agents.AgentID=userbetssynopsis.AgentID AND UserBetSynopsisID=".$decoded_id);

                           if (!$result_id)
                                die("<h1>Error, please contact with the author</h1>");

                           $row = mysql_fetch_assoc($result_id);

                           if ($row['Canceled']==1) {
                             $row['Status'] = 4;
                             $row['FinalUserProfit']=0;
                             $row['PossibleProfit']=0;                             
                           }

                           if ($row['Status'] == 2)
                                   $BetStatus = "<span style=\"color:#99FF33\">Κερδισμένο</span>";
                           else if ($row['Status'] == 3)
                                   $BetStatus = "<span style=\"color:#FF0000\">Χαμένο</span>";
                           else if ($row['Status'] == 4)
                                   $BetStatus = "<span style=\"color:#FF0000\">Ακυρώθηκε</span>";
                           else if ($row['Status'] == 5)
                                   $BetStatus = "<span style=\"color:#FF0000\">Αναβλήθηκε</span>";
                           else
                                   $BetStatus = "<span style=\"color:#DBB793\">Ανοιχτό</span>";




                           echo "<table width=850px border=0 cellSpacing=0 cellPadding=0 bgcolor=#555555 >";
                           echo "<tr height=2px bgcolor=#FFCC00><td></td></tr>";
                           echo "<tr height=5px ><td></td></tr>";
                           echo "<tr><td align=center>";
                           echo "<table width=830px border=0 cellSpacing=2 cellPadding=2 class=PrintClass bgcolor=white>";
                           echo "<tr><td bgcolor=#000000 class=Title width=200px>Agent</td><td class=Data1 bgcolor=#000000>".$row['Name']."</td></tr>";
                           echo "<tr><td bgcolor=#000000 class=Title width=200px>Ημερομηνία και ώρα</td><td class=Data1 bgcolor=#000000>".date("d/m/y (H:i:s)", strtotime($row['DateTime']))."</td></tr>";
                           echo "<tr><td bgcolor=#000000 class=Title width=200px>Κωδικός δελτίου</td><td class=Data1 bgcolor=#000000>".rand_uniqid($row['UserBetSynopsisID'],true).' ('.$row['UserBetSynopsisID'].")</td></tr>";
                           switch ($row['BetType']) {

                                case 0 :$BetType='Μονό';break;
                                case 1 :$BetType='Πολλαπλό';break;
                                case 2 :$BetType='Σύστημα';break;


                           }
                           echo "<tr><td bgcolor=#000000 class=Title width=200px>Τύπος στοιχήματος</td><td class=Data1 bgcolor=#000000>".$BetType."</td></tr>";
                           echo "<tr><td bgcolor=#000000 class=Title width=200px>Ποσό στοιχηματισμού</td><td class=Title bgcolor=#000000>€".number_format($row['Cost'],2,'.','') ."</td></tr>";
                           echo "<tr><td bgcolor=#000000 class=Title width=200px>Πιθανό κέρδος</td><td class=Title bgcolor=#000000>€".number_format($row['PossibleProfit'],2,'.','')."</td></tr>";
                           echo "<tr><td bgcolor=#000000 class=Title width=200px>Κέρδος</td><td class=Title bgcolor=#000000>€".number_format($row['FinalUserProfit'],2,'.','')."</td></tr>";

                           if ($row['Status'] == 2)
                                   $BetStatus = "<span style=\"color:#99FF33\">Κερδισμένο</span>";
                           else if ($row['Status'] == 3)
                                   $BetStatus = "<span style=\"color:#FF0011\">Χαμένο</span>";
                           else if ($row['Status'] == 4)
                                   $BetStatus = "<span style=\"color:#FF0000\">Ακυρωμένο</span>";
                           else if ($row['Status'] == 5)
                                   $BetStatus = "<span style=\"color:#FF0000\">Αναβλήθηκε</span>";
                           else
                                   $BetStatus = "<span style=\"color:#DBB793\">Ανοιχτό</span>";

                           echo "<tr><td bgcolor=#000000 class=Title width=200px>Κατάσταση δελτίου</td><td class=Data1 bgcolor=#000000>".$BetStatus."</td></tr>";





                           echo "</table>";

                           if ($row['Canceled']==1) {
                               echo "<table width=830px border=0 cellSpacing=0 cellPadding=0 class=PrintClass>";
                               echo "<tr height=4px><td></td></tr>";
                               echo "<tr height=5px ><td align=center bgcolor=#660000><span style=\"color:#FFCC00;FONT-WEIGHT: bold;\">ΑΚΥΡΩΜΕΝΟ</span></td></tr>";
                               echo "<tr height=4px><td></td></tr>";
                               echo "</table>";
                           }

                           echo "<br>";
                           echo "<table width=800px  cellSpacing=2 cellPadding=2>";
                           echo "<tr><td class=PrintClass bgcolor=#FF6633 colspan=7 align=center style=\"color:white\">Λεπτομέρειες στοιχήματος</td></tr>";
                           echo "<tr><td bgcolor=#EEEEEE align=center class=Header1>Κωδικός</td><td bgcolor=#EEEEEE align=center class=Header1>Γεγονός</td><td align=center bgcolor=#EEEEEE class=Header1>Σημείο</td><td align=center bgcolor=#EEEEEE class=Header1>Απόδοση</td><td align=center bgcolor=#EEEEEE class=Header1>Ημίχρονο</td><td align=center bgcolor=#EEEEEE class=Header1>Τελικό</td><td align=center bgcolor=#EEEEEE class=Header1>Πρόβλεψη</td></tr>";


                           $result2_id = mysql_query("select userbets.*,coupons.HalfTimeScore,coupons.FullTimeScore from userbets,coupons where UserBetSynopsisID=".$decoded_id." AND userbets.CouponID=coupons.CouponID");


                           while ($row2 = mysql_fetch_assoc($result2_id)) {


                                     $Code = "<td bgcolor=#444444 class=Data1 align=center>".$row2['Code']."</td>";
                                     $Event = "<td bgcolor=#444444 class=Data1 align=center>".$row2['Event']."</td>";
                                     $Goal = "<td bgcolor=#444444 class=Data1 align=center>".$row2['Goal']."</td>";
                                     $Half = "<td bgcolor=#444444 class=Data1 align=center>".$row2['HalfTimeScore']."</td>";
                                     $Full = "<td bgcolor=#444444 class=Data1 align=center>".$row2['FullTimeScore']."</td>";
                                     $BetFactor = "<td bgcolor=#444444 class=Data1 align=center>".$row2['BetFactor']."</td>";

                                     if ( $row2['Status']==0)
                                        $Forecast = "<td bgcolor=#444444 class=Data1 style=\"color:#DBB793\" align=center >Ανοιχτό</td>";
                                     else if  ( $row2['Status']==2)
                                        $Forecast = "<td bgcolor=#444444 class=Data1 style=\"color:#99FF33\" align=center >Σωστό</td>";
                                     else if  ( $row2['Status']==3)
                                        $Forecast = "<td bgcolor=#444444 class=Data1 style=\"color:#FF1111\" align=center >Λάθος</td>";

                                     if ($row2['EventCanceled'] == 1) {


                                        $Forecast = "<td bgcolor=#444444 class=Data1 style=\"color:#FFFFFF\" align=center >Αναβλήθηκε</td>";

                                     }




                                     echo "<tr>".$Code.$Event.$Goal.$BetFactor.$Half.$Full.$Forecast."</tr>";


                           }


                            echo "</table>";
                            echo "<br><br>";

                            if ($row['BetType']==2) {

                                  echo "<table width=800px>";
                                  echo "<tr><td class=PrintClass bgcolor=#FF6633 colspan=4 align=center style=\"color:white\">Πληροφορίες στοιχήματος</td></tr>";
                                  echo "<tr><td bgcolor=#EEEEEE align=center class=Header1>Περιγραφή</td><td bgcolor=#EEEEEE align=center class=Header1>Στήλες</td><td align=center bgcolor=#EEEEEE class=Header1>Ποσό σε €</td></tr>";

                                  $result2_id = mysql_query("select * from userbetsmoney where UserBetSynopsisID=".$decoded_id." Order by system desc");

                                 while ($row2 = mysql_fetch_assoc($result2_id)) {



                                          $MulFactor = "<td bgcolor=#444444 class=Data1 align=center>".$row2['MulFactor']."</td>";
                                          $ColNum = "<td bgcolor=#444444 class=Data1 align=center>".$row2['ColNum']."</td>";
                                          $BetMoney = "<td bgcolor=#444444 class=Data1 align=center>€".number_format($row2['BetMoney'],2,'.','')."</td>";

                                          echo "<tr>".$MulFactor.$ColNum.$BetMoney."</tr>";


                                 }


                                echo "</table>";

                            }


                           mysql_close($DB);





                     } else {


                            echo "Δεν βρέθηκε το κουπόνι.";
                     }

                ?>

                <br><br>

               <INPUT class=ButtonOrange id="printbutton" type="button" value="     Εκτύπωση     " onmouseover="this.style.cursor='pointer'" onclick="javascript:window.print();">

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
