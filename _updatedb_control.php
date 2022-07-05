<?php


    include 'includes/database.php';
     set_time_limit(225);

     function removeCtrlChars ($pString) {

         for($control = 0; $control < 32; $control++) {
             $pString = str_replace(chr($control), "", $pString);
         }

        $pString = str_replace(chr(127), "", $pString);

        return $pString;

     }

     $DB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
     mysql_select_db(DataBase, $DB) or die(mysql_error());
     mysql_query("SET NAMES 'utf8'");


     $sqlquery = "select TeamID,Team from teams";
     $result_id = mysql_query($sqlquery);
              // Check result
              // This shows the actual query sent to MySQL, and the error. Useful for debugging.
              if (!$result_id) {
                  $message  = 'Invalid query: ' . mysql_error() . "\n";
                  $message .= 'Whole query: ' . $sqlquery;
                  die($message);
              }

      while ($row = mysql_fetch_assoc($result_id)) {

           $value = removeCtrlChars($row['Team']);

           $sqlquery = 'update teams set Team="'.$value.'" where TeamID='.$row['TeamID'] ;
           $result_id2 = mysql_query($sqlquery);
              // Check result
              // This shows the actual query sent to MySQL, and the error. Useful for debugging.
              if (!$result_id2) {
                  $message  = 'Invalid query: ' . mysql_error() . "\n";
                  $message .= 'Whole query: ' . $sqlquery;
                  die($message);
              }
           echo "TeamID=".$row['TeamID']."  corrected.<br>";
     }

    mysql_close($DB);

    echo "<br><br>==>Update completed."


?>