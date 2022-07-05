<?php
    session_start();
    include '../includes/database.php';
    include '../includes/login.php';


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
    <TD style="VERTICAL-ALIGN: top;" width="100%" >

      <Table border=0 width="800px">

       <TR>
            <TD  align="center" >




                <?php



                      if (isset($_GET['id'])) {

                           //save the userbetssynopsis table and get the primary ID
                           $DB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
                           mysql_select_db(DataBase, $DB) or die(mysql_error());
                       	   mysql_query("SET NAMES 'utf8'");


                           $result_id = mysql_query("select Name,userbetssynopsis.* from userbetssynopsis,agents where agents.AgentID=userbetssynopsis.AgentID AND UserBetSynopsisID=".$_GET['id']);
                           $row = mysql_fetch_assoc($result_id);

                           if ($row['Status'] == 2)
                                   $BetStatus = "<span style=\"color:#99FF33\">Κερδισμένο</span>";
                           else if ($row['Status'] == 3)
                                   $BetStatus = "<span style=\"color:#FF0000\">Χαμένο</span>";
                           else if ($row['Status'] == 4)
                                   $BetStatus = "<span style=\"color:#FF0000\">Αναβλήθηκε</span>";
                           else
                                   $BetStatus = "<span style=\"color:#DBB793\">Σε εξέλιξη</span>";


                           echo "<table width=850px border=0 cellSpacing=0 cellPadding=0 bgcolor=#555555 >";
                           echo "<tr height=2px bgcolor=#FFCC00><td></td></tr>";
                           echo "<tr height=5px ><td></td></tr>";
                           echo "<tr><td align=center>";
                           echo "<table width=830px border=1 cellSpacing=0 cellPadding=0 class=PrintClass>";
                           echo "<tr><td bgcolor=#000000 colspan=4 class=Title>Agent [ <span style=\"color:#999966\">".$row['Name']."</span> ] - Κατάθεση [ <span style=\"color:#83C6FC\">".date("d/m/y H:i:s", strtotime($row['DateTime']))."</span> ] - Αρ. Δελτίου [ <span class=Coupon>".$row['UserBetSynopsisID']."</span> ] - Κατάσταση δελτίου [ ".$BetStatus." ]</td></tr>";
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
                           echo "<tr><td class=PrintClass bgcolor=#FF6633 colspan=5 align=center style=\"color:white\">Λεπτομέρειες στοιχήματος</td></tr>";
                           echo "<tr><td bgcolor=#EEEEEE align=center class=Header1>Κωδικός</td><td bgcolor=#EEEEEE align=center class=Header1>Γεγονός</td><td align=center bgcolor=#EEEEEE class=Header1>Σημείο</td><td align=center bgcolor=#EEEEEE class=Header1>Απόδοση</td><td align=center bgcolor=#EEEEEE class=Header1>Πρόβλεψη</td></tr>";


                           $result2_id = mysql_query("select * from userbets where UserBetSynopsisID=".$_GET['id']);


                           while ($row2 = mysql_fetch_assoc($result2_id)) {


                                     $Code = "<td bgcolor=#444444 class=Data1 align=center>".$row2['Code']."</td>";
                                     $Event = "<td bgcolor=#444444 class=Data1 align=center>".$row2['Event']."</td>";
                                     $Goal = "<td bgcolor=#444444 class=Data1 align=center>".$row2['Goal']."</td>";
                                     $BetFactor = "<td bgcolor=#444444 class=Data1 align=center>".$row2['BetFactor']."</td>";

                                     if ( $row2['Status']==0)
                                        $forecast_msg = "Σε εξέλιξη";
                                     else if  ( $row2['Status']==2)
                                        $forecast_msg = "Σωστή";
                                     else if  ( $row2['Status']==3)
                                        $forecast_msg = "Λάθος";

                                     if ($row2['EventCanceled'] == 1) {

                                        $forecast_msg = "Αναβλήθηκε";

                                     }                                        

                                     $Forecast = "<td bgcolor=#444444 class=Data1 align=center>".$forecast_msg."</td>";


                                     echo "<tr>".$Code.$Event.$Goal.$BetFactor.$Forecast."</tr>";


                           }


                            echo "</table>";
                            echo "<br><br>";
                            echo "<table width=800px>";
                            echo "<tr><td class=PrintClass bgcolor=#FF6633 colspan=4 align=center style=\"color:white\">Πληροφορίες στοιχήματος</td></tr>";
                            echo "<tr><td bgcolor=#EEEEEE align=center class=Header1>Περιγραφή</td><td bgcolor=#EEEEEE align=center class=Header1>Στήλες</td><td align=center bgcolor=#EEEEEE class=Header1>Ποσό σε €</td></tr>";

                            $result2_id = mysql_query("select * from userbetsmoney where UserBetSynopsisID=".$_GET['id']);

                           while ($row2 = mysql_fetch_assoc($result2_id)) {



                                    $MulFactor = "<td bgcolor=#444444 class=Data1 align=center>".$row2['MulFactor']."</td>";
                                    $ColNum = "<td bgcolor=#444444 class=Data1 align=center>".$row2['ColNum']."</td>";
                                    $BetMoney = "<td bgcolor=#444444 class=Data1 align=center>€".number_format($row2['BetMoney'],2,'.','')."</td>";

                                    echo "<tr>".$MulFactor.$ColNum.$BetMoney."</tr>";


                           }


                          echo "</table>";


                           mysql_close($DB);


                           echo "<br><br>";
                           echo "<table width=800px border=0 >";
                           echo "<tr><td class=PrintClass bgcolor=#FF6633 colspan=4 align=center style=\"color:white;\">Στατιστικά στοιχήματος</td></tr>";
                           echo "<tr><td width=200px bgcolor=#EEEEEE align=center class=Header1>Συνολική Απόδοση</td><td width=200px bgcolor=#EEEEEE align=center class=Header1>Κόστος δελτίου</td><td width=200px align=center bgcolor=#EEEEEE class=Header1>Πιθανό κέρδος</td><td width=200px align=center bgcolor=#EEEEEE class=Header1>Κέρδος</td></tr>";
                           echo "<tr><td bgcolor=#444444 class=Data1 align=center>".number_format($row['Odds'],2,'.','')."</td><td bgcolor=#444444 class=Data1 align=center>€".number_format($row['Cost'],2,'.','')."</td><td bgcolor=#444444 class=Data1 align=center>€".number_format($row['PossibleProfit'],2,'.','')."</td><td bgcolor=#444444 class=Data1 align=center>€".number_format($row['FinalUserProfit'],2,'.','')."</td></tr>";
                           echo "</table>";
                           echo "</tr></td>";
                           echo "<tr height=5px ><td></td></tr>";
                           echo "<tr bgcolor=#FFCC00 height=2px><td></td></tr>";
                           echo "</table>";


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
