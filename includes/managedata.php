<?php

  session_start();


  include 'database.php';
  include 'functions.php';

  date_default_timezone_set("Europe/Athens");

$appid=$_GET['appid'];
$table=$_GET['query'];
$type=$_GET['type'];
$record=$_GET['id'];
$primaryKey=$_GET['primaryKey'];
$column=$_GET['column'];
$newvalue=$_GET['newvalue'];
$output=$_GET['output'];
$whereID=$_GET['whereID'];
$jsondata=stripcslashes($_GET['jsondata']);
$cascade=$_GET['cascade'];



/****************************************************
 function removeCtrlChars ($pString)

 Removes Ascii chars < 32 (Control Chars)

******************************************************/
     function removeCtrlChars ($pString) {

         for($control = 0; $control < 32; $control++) {
             $pString = str_replace(chr($control), "", $pString);
         }

        $pString = str_replace(chr(127), "", $pString);

        return $pString;

     }

 function convert_yui($result_id, $field_labels, $type)
{


      //******************** Column Definition *************************************
      if (isset($result_id)){


        //here return the table fields, column names
        $column_count = mysql_num_fields($result_id) or die("display_db_query:" . mysql_error());

        if ($type==1) {

          for ($column_num = 0; $column_num < $column_count; $column_num++) {
                          $field_name = mysql_field_name($result_id, $column_num);

                          //here u can modify thecolumns properties

                          if ( ($column_num==0) && (strpos($field_name, "ID") > 0) ) {
                                $table_header .= "{key:\"".$field_name."\", label:\"$field_labels[$column_num]\", isPrimaryKey:true}";
                          }
                          else {
                                $table_header .= "{key:\"".$field_name."\", label:\"$field_labels[$column_num]\", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:\"Ακύρ.\", LABEL_SAVE:\"Αποθ.\", disableBtns:false}), sortable:true, resizeable:true}";
                          }
                          //insert "," at the end
                          $table_header .= (($column_num +1) == $column_count)?",{key:'delete', label:' ', className:'delete-button', action:'delete', width:50}" : ", ";

          }
          return $table_header ;
        }

        //******************** Data Source *************************************
        if ($type==2) {

        $first = 0;



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


                  //make also the record id as a scrambled string for security reasons.
                  if ( (strpos($field_name, strtoupper("ID")) > 0)  ) {

                      $colum_value = ($row[$column_num]==nil || $row[$column_num]=="") ? "\"\"" : "\"".rawurlencode(encrypt(CRYPTKEY,$row[$column_num]))."\"";
                      $field_value .= "\"id_s\":".$colum_value;
                      $field_value .= ",";

                      $colum_value = ($row[$column_num]==nil || $row[$column_num]=="") ? "\"\"" : "\"".rand_uniqid($row[$column_num],true)."\"";
                      $field_value .= "\"id_u\":".$colum_value;
                      $field_value .= ",";

                  }



                  $colum_value = ($row[$column_num]==nil || $row[$column_num]=="") ? "\"\"" : "\"".$row[$column_num]."\"";
                  $field_value .= "\"".$field_name."\":".html_entity_decode($colum_value);
                  $field_value .= (($column_num + 1 ) == $column_count)?" } ":",";

              }





           }

           //create envelop
           $field_value = "{\"DataSet\": {\"totalRecords\":".html_entity_decode(mysql_num_rows (  $result_id )).",\"items\":[".$field_value."]}}";
           return $field_value;

         }

         //******************** Schema *************************************
         if ($type==3) {

           for ($column_num = 0; $column_num < $column_count; $column_num++) {

               $field_name = mysql_field_name($result_id, $column_num);
               $table_schema .= "\"".$field_name."\"";
               //insert "," at the end
               $table_schema .= (($column_num +1) == $column_count)?" ":", ";

           }


           return $table_schema;
        }

       //******************** Data Source without envelop *************************************
        if ($type==4) {

        $first = 0;


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


                  $colum_value = ($row[$column_num]==nil || $row[$column_num]=="") ? "\"\"" : "\"".$row[$column_num]."\"";
                  $field_value .= "\"".$field_name."\":".html_entity_decode($colum_value);
                  $field_value .= (($column_num + 1 ) == $column_count)?" } ":",";

              }

           }


           return $field_value;

         }


       //******************** Special Data Source with sorting for covering select query *************************************
        if ($type==5) {

        $first = 0;

        $FillSpecials = array('Goal_1','Goal_x','Goal_2','Under','Over','GG','NG','de_1ORX','de_XOR2','de_1OR2','HMI_1','HMI_X','HMI_2','HT_11','HT_1X','HT_12','HT_X1','HT_XX','HT_X2','HT_21','HT_2X','HT_22','SS_10','SS_20','SS_21','SS_30',
                      'SS_31','SS_32','SS_40','SS_41','SS_42','SS_43','SS_00','SS_11','SS_22','SS_33','SS_01','SS_02','SS_12','SS_03','SS_13','SS_23','SS_04','SS_14','SS_24','SS_34',
                      'TG_01','TG_23','TG_46','TG_7');

        $FillSpecialsLabel = array('1','X','2','Under','Over','GG','NG','ΔΕ 1ήΧ','ΔΕ Χή2','ΔΕ 1ή2','HMI 1','HMI X','HMI 2','HT 1-1','HT 1-X','HT 1-2','HT X-1','HT X-X','HT X-2','HT 2-1','HT 2-X','HT 2-2','ΣΣ 1-0','ΣΣ 2-0','ΣΣ 2-1','ΣΣ 3-0',
                           'ΣΣ 3-1','ΣΣ 3-2','ΣΣ 4-0','ΣΣ 4-1','ΣΣ 4-2','ΣΣ 4-3','ΣΣ 0-0','ΣΣ 1-1','ΣΣ 2-2','ΣΣ 3-3','ΣΣ 0-1','ΣΣ 0-2','ΣΣ 1-2','ΣΣ 0-3','ΣΣ 1-3','ΣΣ 2-3','ΣΣ 0-4','ΣΣ 1-4','ΣΣ 2-4','ΣΣ 3-4',
                           'TG 0-1','TG 2-3','TG 4-6','TG 7');


          while ($row = mysql_fetch_row($result_id)) {

              $arrayvalues = '';
              unset($SortArray);

              for ($column_num = 0; $column_num < $column_count; $column_num++) {

                  $field_name = mysql_field_name($result_id, $column_num);

                  $Found=false;
                  for ($i=7;$i<count($FillSpecials);$i++)
                  {

                        if ($FillSpecials[$i] == $field_name) {
                            $Found=true;
                            break;
                        }


                  }
                  // dont take in account any fieldname that belongs to  $FillSpecials array
                  if ($Found==false) {

                      if($first==0){
                            $field_value .= ($column_num == 0)?"{" :" ";
                            $first = 1;
                      }
                      else {
                            $field_value .= ($column_num == 0)?",{" :" ";
                      }

                      $colum_value = ($row[$column_num]==nil || $row[$column_num]=="") ? "\"\"" : "\"".$row[$column_num]."\"";
                      $field_value .= "\"".$field_name."\":".html_entity_decode($colum_value).", ";
                  }



                  if ( ($field_name!='Code') && ($field_name!='Event') && ($field_name!='TotalBets') && ($field_name!='Bets') &&  ($field_name!='BetList') ) {

                      for ($i=0; $i<count($FillSpecials); $i++) {

                        if ($FillSpecials[$i] == $field_name) {

                            $LabelKey = $FillSpecialsLabel[$i];
                            break;
                        }

                      }
                      $SortArray[$LabelKey] = $row[$column_num];


                  }



                  if  (($column_num + 1 ) == $column_count) {

                     arsort($SortArray);
                     $SortedArrayStr="{\\\"label\\\":\\\"- Προβολή -\\\",\\\"value\\\":\\\"0\\\"},";
                     $i=0;
                     foreach ($SortArray as $key => $val) {
                          if ($val != 0)
                              $SortedArrayStr .= "{\\\"label\\\":\\\"".$key." - €".number_format($val,2)."\\\",\\\"value\\\":\\\"".$i."\\\"},";
                          $i++;
                     }
                     $SortedArrayStr = substr($SortedArrayStr,0,-1);
                     $field_value .= "\"AllOthers\":\"[".$SortedArrayStr."]\", \"AllOthers_Local\":\"0\"} ";


                  }





              }

           }


          $num_of_rows = html_entity_decode(mysql_num_rows (  $result_id ));
          mysql_free_result($result_id);

          //now send a query to find some statistics and add to the above list as am extra record
          $sqlquery = $field_labels;

          $result_newid = mysql_query($sqlquery);
          // Check result
          // This shows the actual query sent to MySQL, and the error. Useful for debugging.
          if (!$result_newid) {
              $message  = 'Invalid query: ' . mysql_error() . "\n";
              $message .= 'Whole query: ' . $sqlquery;
              die($message);
          }
          $row = mysql_fetch_assoc($result_newid);

          if ( $row['TotalBets'] > 0) {

              $field_value .= ',{"Code":"-1",  "TotalBets":"'.$row['TotalBets'].'",  "Event":"0",  "Bets":"'.$row['Bets'].'",  "BetList":"0",  "Goal_1":"0",  "Goal_x":"0",  "Goal_2":"0",  "Under":"0.0000",  "Over":"0.0000",  "GG":"0.0000",  "NG":"0.0000", "AllOthers":"[{\"label\":\"- Προβολή -\",\"value\":\"0\"}]", "AllOthers_Local":"0"}';
              $num_of_rows++;

          }



           //create envelop
           $field_value = "{\"DataSet\": {\"totalRecords\":".$num_of_rows.",\"items\":[".$field_value."]}}";
           return $field_value;

         }


       //******************** Special management for master remainer *************************************
        if ($type==6) {

        $first = 0;
        $SAgentID=-1;
        $SAgentName = '';
        $field_value = '';
        $NumRecords = 0;



          while ($row = mysql_fetch_row ($result_id)) {

              $NumRecords++;

              if ($row[0] != $SAgentID) {

                    if ($first != 0) {

                        $field_value .= ",{\"Name\":\"SAGENT_TOTAL\", \"Bet\":\"".$Bet."\", \"Profit\":\"".$Profit."\", \"Commission\":\"".$Commission."\", \"Mixed\":\"".$Mixed."\", \"Commission_SAgent\":\"".$Commission_SAgent."\", \"Final\":\"".$Final."\", \"BetSum\":\"".$BetSum."\", \"OpenBetSum\":\"".$OpenBetSum."\", \"OpenBet\":\"".$OpenBet."\" },";
                        $field_value .= "{\"Name\":\"EMPTY\", \"Bet\":\"\", \"Profit\":\"\", \"Commission\":\"\", \"Mixed\":\"\", \"Commission_SAgent\":\"\", \"Final\":\"\", \"BetSum\":\"\", \"OpenBetSum\":\"\", \"OpenBet\":\"\" },";
                        $NumRecords++;
                        $NumRecords++;
                    }

                    $SAgentID = $row[0];
                    $SAgentName = $row[1];

                    $field_value .= "{\"Name\":\"".$SAgentName."\", \"Bet\":\"\", \"Profit\":\"\", \"Commission\":\"\", \"Mixed\":\"\", \"Commission_SAgent\":\"\", \"Final\":\"\", \"BetSum\":\"-1\", \"OpenBetSum\":\"\", \"OpenBet\":\"\" },";
                    $field_value .= "{\"Name\":\"NAME\", \"Bet\":\"Σ.ΚΛΕΙΣΤΩΝ\", \"Profit\":\"Σ.ΚΕΡΔΙΣΜΕΝΩΝ\", \"Commission\":\"ΠΡΟΜ. AGENT\", \"Mixed\":\"ΜΕΙΚΤΟ\", \"Commission_SAgent\":\"ΠΡΟΜ. SAGENT\", \"Final\":\"ΚΑΘΑΡΟ\", \"BetSum\":\"ΑΡ.ΚΛΕΙΣΤΩΝ\", \"OpenBetSum\":\"ΑΡ.ΑΝΟΙΧΤΩΝ\", \"OpenBet\":\"Σ.ΑΝΟΙΧΤΩΝ\" }";
                    $NumRecords++;
                    $NumRecords++;

                    $BetSum = 0;
                    $Bet = 0;
                    $Profit = 0;
                    $Commission = 0;
                    $Final = 0;
                    $Mixed = 0;
                    $Commission_SAgent = 0;
                    $OpenBetSum=0;
                    $OpenBet=0;
               }

              for ($column_num = 0; $column_num < $column_count; $column_num++) {

                  $field_name = mysql_field_name($result_id, $column_num);


                  switch ($field_name) {
                     case "Bet"         : $Bet = $Bet + $row[$column_num];break;
                     case "BetSum"      : $BetSum = $BetSum + $row[$column_num];break;
                     case "Profit"      : $Profit = $Profit + $row[$column_num];break;
                     case "Commission"  : $Commission = $Commission + $row[$column_num];break;
                     case "Final"       : $Final = $Final + $row[$column_num];break;
                     case "Mixed"       : $Mixed = $Mixed + $row[$column_num];break;
                     case "Commission_SAgent"  : $Commission_SAgent = $Commission_SAgent + $row[$column_num];break;
                     case "OpenBetSum"  : $OpenBetSum = $OpenBetSum + $row[$column_num];break;
                     case "OpenBet"     : $OpenBet = $OpenBet + $row[$column_num];break;
                  }

                  $first = 1;
                  $field_value .= ($column_num == 0)?",{" :" ";


                  if ( ($field_name != 'sName') && ($field_name != 'SAgentID') ) {
                      $colum_value = ($row[$column_num]==nil || $row[$column_num]=="") ? "\"\"" : "\"".$row[$column_num]."\"";
                      $field_value .= "\"".$field_name."\":".html_entity_decode($colum_value);
                      $field_value .= (($column_num + 1 ) == $column_count)?" } ":",";


                  }

              }





           }


           $field_value .= ",{\"Name\":\"SAGENT_TOTAL\", \"Bet\":\"".$Bet."\", \"Profit\":\"".$Profit."\", \"Commission\":\"".$Commission."\", \"Mixed\":\"".$Mixed."\", \"Commission_SAgent\":\"".$Commission_SAgent."\", \"Final\":\"".$Final."\", \"BetSum\":\"".$BetSum."\", \"OpenBetSum\":\"".$OpenBetSum."\", \"OpenBet\":\"".$OpenBet."\" },";
           $field_value .= "{\"Name\":\"EMPTY\", \"Bet\":\"\", \"Profit\":\"\", \"Commission\":\"\", \"Mixed\":\"\", \"Commission_SAgent\":\"\", \"Final\":\"\", \"BetSum\":\"\", \"OpenBetSum\":\"\", \"OpenBet\":\"\" },";
           $NumRecords++;
           $NumRecords++;

           $field_value .= "{\"Name\":\"TOTAL\", \"Bet\":\"0\", \"Profit\":\"0\", \"Commission\":\"0\", \"Mixed\":\"0\", \"Commission_SAgent\":\"0\", \"Final\":\"0\", \"BetSum\":\"0\", \"OpenBetSum\":\"0\", \"OpenBet\":\"0\" }";
           $NumRecords++;


           $MYDATASOURCE = "{\"DataSet\": {\"totalRecords\":".($NumRecords).",\"items\":[".$field_value."]}}";
           return $MYDATASOURCE;

         }

    }
}

/*********************************************************************
get_pair_values
Designed to return pair values ideal for YUI drop down menus


***********************************************************************/
 function get_pair_values($result_id, $primaryKey)
{

        //************************ Get Values for Drop Down Menus ************************************
        // format : [{"label": "Germany", "value": "97"}, {"label": "Italy", "value": "101"}]

         //return "{\"DataSet\": {\"totalrecords\":1, \"items\": [{\"value\": \"97\",\"label\": \"Italy\"}]}}";
         //return "[{\"label\": \"Germany\", \"value\": \"97\"}, {\"label\": \"Italy\", \"value\": \"101\"}]";
         $first = 0;
         $count = 0;


         $column_count = mysql_num_fields($result_id) or die("display_db_query:" . mysql_error());


          while ($row = mysql_fetch_row($result_id)) {

              $count++;

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
           $field_value = "{\"DataSet\": {\"totalrecords\":".$count.", \"items\": [".$field_value."]}}";
           return $field_value;



}


/*********************************************************************
get_pair_values
Designed to return pair values ideal for YUI drop down menus


***********************************************************************/
 function get_pair_valuesForAgents($result_id, $primaryKey)
{

        //************************ Get Values for Drop Down Menus ************************************
        // format : [{"label": "Germany", "value": "97"}, {"label": "Italy", "value": "101"}]

         //return "{\"DataSet\": {\"totalrecords\":1, \"items\": [{\"value\": \"97\",\"label\": \"Italy\"}]}}";
         //return "[{\"label\": \"Germany\", \"value\": \"97\"}, {\"label\": \"Italy\", \"value\": \"101\"}]";


         $first = 0;
         $count = 0;
         $field_value ='';

         $num_rows = mysql_num_rows($result_id);

         while ($row = mysql_fetch_assoc($result_id)) {


            $field_value .= "{\"value\":\"".$row['AgentID']."\",\"label\":\"".$row['Name']." ( €".number_format($row['Remainder'],2)." )\"}";
            $count++;

            if ($count < $num_rows)
              $field_value .= ",";

         }



         //create envelop
         $field_value = "{\"DataSet\": {\"totalrecords\":".$count.", \"items\": [".$field_value."]}}";
         return $field_value;



}

/*********************************************************************
update_single
Update just one record, given a primaryKey


***********************************************************************/
 function update_single($newvalue, $table, $column, $primaryKey, $record)
{


     if ($record[0] == '@')
         $record = "'".substr($record, 1)."'";

     //check to see if new value is string. Strings have @ symbol at the very first character
     if ($newvalue[0] == '@')
       $result_id = mysql_query("UPDATE ".$table." SET ".$column."='".substr($newvalue, 1)."' Where ".$primaryKey."=".$record);
     else
       $result_id = mysql_query("UPDATE ".$table." SET ".$column."=".$newvalue." Where ".$primaryKey."=".$record);



      return $result_id;
}


/**********************************************************************
function get_json_values($result_id)

get Straight label/values pairs without the extra data the the
json protocol needs as an envelop.
the number before the data is the num of records. ie

20{"label":"Name","value":"George"},{.........}

***********************************************************************/
function get_json_values($result_id) {

        $first = 0;
      if (isset($result_id)){


        //here return the table fields, column names
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


                  $colum_value = ($row[$column_num]==nil || $row[$column_num]=="") ? "\"\"" : "\"".$row[$column_num]."\"";
                  $field_value .= "\"".$field_name."\":".html_entity_decode($colum_value);
                  $field_value .= (($column_num + 1 ) == $column_count)?" } ":",";

              }

           }
        }

         $field_value = mysql_num_rows (  $result_id ).$field_value;
         return $field_value;

}


/***********************************************************************************************
function parseGoalBetIntCoupon()

Reads the coupon from the GoalBetInt and returns a table with the appropriate infos.
The table has the following informations

          $SpyResultArray[0][0] - chapionship
          $SpyResultArray[0][1] - time
          $SpyResultArray[0][2] - code
          $SpyResultArray[0][3] - ee
          $SpyResultArray[0][4] - goal_1
          $SpyResultArray[0][5] - team_home
          $SpyResultArray[0][6] - goal_x
          $SpyResultArray[0][7] - team_host
          $SpyResultArray[0][8] - goal_2

          $SpyResultArray[0][9] - de_1ORX
          $SpyResultArray[0][10] - de_XOR2
          $SpyResultArray[0][11] - de_1OR2
          $SpyResultArray[0][12] - under
          $SpyResultArray[0][13] - over
          $SpyResultArray[0][14] - GG
          $SpyResultArray[0][15] - NG

************************************************************************************************/

function columnSort($unsorted) {
    $sorted = $unsorted;
    for ($i=0; $i < sizeof($sorted)-1; $i++) {
      for ($j=0; $j<sizeof($sorted)-1-$i; $j++)
        if ($sorted[$j][2] > $sorted[$j+1][2]) {
          $tmp = $sorted[$j];
          $sorted[$j] = $sorted[$j+1];
          $sorted[$j+1] = $tmp;
      }
    }
    return $sorted;
}

function parseGoalBetIntCoupon() {

  $SpyResultArray =array();



  // new dom object
  $dom = new DOMDocument();

  //load the html
  $ER = error_reporting(0);

  //check to see if we read from file
  if (isset($_GET['File'])) {
     $html = $dom->loadHTMLfile('../grafix/coupon.htm');

  } else
     $html = $dom->loadHTMLfile('http://www.unblock-web.com/index.php?q=aHR0cHM6Ly93d3cuZ29hbGJldGludC5jb20vY291cG9uX0ZPT1RCQUxMLnBocA%3D%3D&hl=3ed');
     //$html = $dom->loadHTMLfile('https://www.goalbetint.com/coupon_FOOTBALL.php');

  error_reporting($ER);

  if ($html==false)
      return false;

  //discard white space
  $dom->preserveWhiteSpace = false;

  //the table by its tag name
  $tables = $dom->getElementsByTagName('table');

  //get all rows from the table
  $rows = $tables->item(0)->getElementsByTagName('tr');

  // loop over the table rows
  $arr_count=0;
  foreach ($rows as $row) {
   // get each column by tag name
      $cols = $row->getElementsByTagName('td');



      if ( ($cols->length >= 16) and ($cols->item(3)->nodeValue != '-') ) {


          $SpyResultArray[$arr_count][0]=$cols->item(0)->nodeValue; //chapionship
          $SpyResultArray[$arr_count][1]=$cols->item(1)->nodeValue; //time
          $SpyResultArray[$arr_count][2]=intval($cols->item(3)->nodeValue) == 0 ? -1 : intval($cols->item(3)->nodeValue); //code
          $SpyResultArray[$arr_count][3]='0'; //$cols->item(4)->nodeValue; ee
          $SpyResultArray[$arr_count][4]=$cols->item(4)->nodeValue=='-' ? '0.00' : $cols->item(4)->nodeValue; //goal_1
          $SpyResultArray[$arr_count][5]=$cols->item(5)->nodeValue=='-' ? '0.00' : $cols->item(5)->nodeValue; //team_home
          $SpyResultArray[$arr_count][6]=$cols->item(6)->nodeValue=='-' ? '0.00' : $cols->item(6)->nodeValue; //goal_x
          $SpyResultArray[$arr_count][7]=$cols->item(7)->nodeValue=='-' ? '0.00' : $cols->item(7)->nodeValue; //team_host
          $SpyResultArray[$arr_count][8]=$cols->item(8)->nodeValue=='-' ? '0.00' : $cols->item(8)->nodeValue; //goal_2

          $SpyResultArray[$arr_count][9]=$cols->item(9)->nodeValue=='-' ? '0.00' : $cols->item(9)->nodeValue; //de_1ORX
          $SpyResultArray[$arr_count][10]=$cols->item(10)->nodeValue=='-' ? '0.00' : $cols->item(10)->nodeValue; //de_XOR2
          $SpyResultArray[$arr_count][11]=$cols->item(11)->nodeValue=='-' ? '0.00' : $cols->item(11)->nodeValue; //de_1OR2
          $SpyResultArray[$arr_count][12]=$cols->item(12)->nodeValue=='-' ? '0.00' : $cols->item(12)->nodeValue; //under
          $SpyResultArray[$arr_count][13]=$cols->item(13)->nodeValue=='-' ? '0.00' : $cols->item(13)->nodeValue; //over
          $SpyResultArray[$arr_count][14]=$cols->item(14)->nodeValue=='-' ? '0.00' : $cols->item(14)->nodeValue; //GG
          $SpyResultArray[$arr_count][15]=$cols->item(15)->nodeValue=='-' ? '0.00' : $cols->item(15)->nodeValue; //NG


          $arr_count++;


      }


    }



    //$SpyResultArray = columnSort( $SpyResultArray );
    return $SpyResultArray;


}

/*****************************************************************************************
function CompareGoalBetResutls($SpyResultArray)

Returns only those records that exist in local DataBase comparing the code and have at least
one difference in the values of :goal_1,goal_x,goal_2,de_XXXX,under,over,GG,NG

The format of the SpyResultArray is

          $SpyResultArray[0][0] - chapionship
          $SpyResultArray[0][1] - time
          $SpyResultArray[0][2] - code
          $SpyResultArray[0][3] - ee
          $SpyResultArray[0][4] - goal_1
          $SpyResultArray[0][5] - team_home
          $SpyResultArray[0][6] - goal_x
          $SpyResultArray[0][7] - team_host
          $SpyResultArray[0][8] - goal_2

          $SpyResultArray[0][9] - de_1ORX
          $SpyResultArray[0][10] - de_XOR2
          $SpyResultArray[0][11] - de_1OR2
          $SpyResultArray[0][12] - under
          $SpyResultArray[0][13] - over
          $SpyResultArray[0][14] - GG
          $SpyResultArray[0][15] - NG

for single records you can use the following sql query

SELECT CouponID,Code,Goal_1  FROM `coupons` WHERE published=1 and showed=1 and indexed=0 and code=142 and NULLIF(Goal_1,2.26) is not NULL
******************************************************************************************/
function CompareGoalBetResutls($SpyResultArray){

    if (count($SpyResultArray)==0)
        return '{"DataSet": {"totalRecords":0,"items":[]}}';

    $echostring = '';
    for ($i=0;$i<sizeof($SpyResultArray);$i++){

        $echostring .= $SpyResultArray[$i][2].",";

    }

    $echostring = '('.substr($echostring, 0, -1).')';

    //check to see if we have dates. If yes then we have to change some things.
    if (isset($_GET['SQL'])) {
        $DateParams =$_GET['SQL'];
        $DateParams=str_replace('@','\'',$DateParams);

        $sqlquery = "select coupons.*,coupons.Date as IsoDate,TIME_FORMAT(Time,'%H:%i') AS Time,ShortcutName as chapionD from coupons,chapionships Where coupons.ChapionshipID=chapionships.ChapionshipID and code in ".$echostring." and published=0 and showed=1 and indexed=0 and ".$DateParams." order by Date,Time,Code Asc";
    } else
        $sqlquery = "select coupons.*,coupons.Date as IsoDate,TIME_FORMAT(Time,'%H:%i') AS Time,ShortcutName as chapionD from coupons,chapionships Where coupons.ChapionshipID=chapionships.ChapionshipID and code in ".$echostring." and published=1 and showed=1 and indexed=0 order by Date,Time,Code Asc";



    $result_id = mysql_query($sqlquery);
    if (!$result_id) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $sqlquery;
        die($message);
    }

    if (mysql_num_rows($result_id) == 0) {
        $MYDATASOURCE = convert_yui($result_id, $field_labels, 2);
        return $MYDATASOURCE;
    }


    $AA=0;
    $count_final_records=0;
    $field_value='';
    $first=0;
    $column_count = mysql_num_fields($result_id) or die("display_db_query:" . mysql_error());


    while ($row = mysql_fetch_array($result_id)) {

        //check
        $recFound = -1;
        for ($i=0;$i<sizeof($SpyResultArray);$i++){

           if ( (intval($SpyResultArray[$i][2]) == intval($row['Code'])) and ($row["Time"] == $SpyResultArray[$i][1])  ) {
               $recFound = $i;
               break;
           }

        }
        if ($recFound != -1) {
              // if we have at least one change to the basic parameters below, show it to the list
              if ( ( ($row["Goal_1"] != $SpyResultArray[$recFound][4])  or ($row["Goal_x"] != $SpyResultArray[$recFound][6]) or ($row["Goal_2"] != $SpyResultArray[$recFound][8])
                 // or ($row["de_1ORX"] != $SpyResultArray[$recFound][9]) or ($row["de_XOR2"] != $SpyResultArray[$recFound][10]) or ($row["de_1OR2"] != $SpyResultArray[$recFound][11])
                  or ($row["Under"] != $SpyResultArray[$recFound][12]) or ($row["Over"] != $SpyResultArray[$recFound][13]) or ($row["GG"] != $SpyResultArray[$recFound][14])
                  or ($row["NG"] != $SpyResultArray[$recFound][15]) )  )   {


                      $AA++;
                      $count_final_records=$count_final_records+3;

                      if($first==0){
                              $field_value .= "{";
                              $first = 1;
                      } else {

                              $field_value .= ",{";
                      }

                      for ($j=0;$j<=15;$j++) {

                            //In this point, we have at least one difference.
                            //Now try to specify these differences, by negating the numbers.If the number is zero 0.00 then
                            //change slightly the number from 0.00 to -0.01. Take care to change again the number inside the coupon
                            //to its original value.

                            switch ($j) {
                                  //Goal_1
                                  case 4: if ($SpyResultArray[$recFound][4] != $row['Goal_1']) { $SpyResultArray[$recFound][4]= $SpyResultArray[$recFound][4]==0 ?-0.01 :floatval(-$SpyResultArray[$recFound][4]);} break;
                                  //Goal_x
                                  case 6: if ($SpyResultArray[$recFound][6] != $row['Goal_x']) { $SpyResultArray[$recFound][6] = $SpyResultArray[$recFound][6]==0 ?-0.01 :floatval(-$SpyResultArray[$recFound][6]);} break;
                                  //Goal_2
                                  case 8: if ($SpyResultArray[$recFound][8] != $row['Goal_2'] ) { $SpyResultArray[$recFound][8] = $SpyResultArray[$recFound][8]==0 ?-0.01 :floatval(-$SpyResultArray[$recFound][8]);} break;
                                  //de_1ORX
                                  //case 9: if ($SpyResultArray[$recFound][9] != $row['de_1ORX'] ) { $SpyResultArray[$recFound][9] = $SpyResultArray[$recFound][9]==0 ?-0.01 :floatval(-$SpyResultArray[$recFound][9]);} break;
                                  //de_XOR2
                                  //case 10: if ($SpyResultArray[$recFound][10] != $row['de_XOR2'] ) { $SpyResultArray[$recFound][10] = $SpyResultArray[$recFound][10]==0 ?-0.01 :floatval(-$SpyResultArray[$recFound][10]);} break;
                                  //de_1OR2
                                  //case 11: if ($SpyResultArray[$recFound][11] != $row['de_1OR2'] ) { $SpyResultArray[$recFound][11] = $SpyResultArray[$recFound][11]==0 ?-0.01 :floatval(-$SpyResultArray[$recFound][11]);} break;
                                  //Under
                                  case 12: if ($SpyResultArray[$recFound][12] != $row['Under'] ) { $SpyResultArray[$recFound][12] = $SpyResultArray[$recFound][12]==0 ?-0.01 :floatval(-$SpyResultArray[$recFound][12]);} break;
                                  //Over
                                  case 13: if ($SpyResultArray[$recFound][13] != $row['Over'] ) { $SpyResultArray[$recFound][13] = $SpyResultArray[$recFound][13]==0 ?-0.01 :floatval(-$SpyResultArray[$recFound][13]);} break;
                                  //GG
                                  case 14: if ($SpyResultArray[$recFound][14] != $row['GG'] ) { $SpyResultArray[$recFound][14] = $SpyResultArray[$recFound][14]==0 ?-0.01 :floatval(-$SpyResultArray[$recFound][14]);} break;
                                  //NG
                                  case 15: if ($SpyResultArray[$recFound][15] != $row['NG'] ) { $SpyResultArray[$recFound][15]= $SpyResultArray[$recFound][15]==0 ?-0.01 :floatval(-$SpyResultArray[$recFound][15]);} break;
                            }



                      }

                      $field_value .= '"AA":"'.$AA.'", "id_s":"GOALBETINT","CouponID":"-1", "CountryID":"Goal", "ChapionshipID":"'.$SpyResultArray[$recFound][0].'", "Time":"'.$SpyResultArray[$recFound][1].'", "Date":"-1", "Code":"'.$SpyResultArray[$recFound][2].'", "EE":"'.$SpyResultArray[$recFound][3].'", "Goal_1":"'.$SpyResultArray[$recFound][4].
                      '", "HomeTeamID":"'.$SpyResultArray[$recFound][5].'", "Goal_x":"'.$SpyResultArray[$recFound][6].'", "HostTeamID":"'.$SpyResultArray[$recFound][7].
                      '", "Goal_2":"'.$SpyResultArray[$recFound][8].'", "de_1ORX":"'.$SpyResultArray[$recFound][9].'", "de_XOR2":"'.$SpyResultArray[$recFound][10].
                      '", "de_1OR2":"'.$SpyResultArray[$recFound][11].'", "Under":"'.$SpyResultArray[$recFound][12].'", "Over":"'.$SpyResultArray[$recFound][13].
                      '", "GG":"'.$SpyResultArray[$recFound][14].'", "NG":"'.$SpyResultArray[$recFound][15].
                      '", "HMI_1":"-", "HMI_X":"-", "HMI_2":"-", "HT_11":"-", "HT_1X":"-", "HT_12":"-", "HT_X1":"-", "HT_XX":"-", "HT_X2":"-", "HT_21":"-", "HT_2X":"-", "HT_22":"-", "SS_10":"-", "SS_20":"-", "SS_21":"-", "SS_30":"-", "SS_31":"-", "SS_32":"-", "SS_40":"-", "SS_41":"-", "SS_42":"-", "SS_43":"-", "SS_00":"-", "SS_11":"-", "SS_22":"-", "SS_33":"-", "SS_01":"-", "SS_02":"-", "SS_12":"-", "SS_03":"-", "SS_13":"-", "SS_23":"-", "SS_04":"-", "SS_14":"-", "SS_24":"-", "SS_34":"-", "TG_01":"-", "TG_23":"-", "TG_46":"-", "TG_7":"-", "HalfTimeScore":"-", "FullTimeScore":"-", "Published":"1", "Canceled":"0", "Dirty":"0", "Indexed":"0", "Showed":"1", "IsoDate":"-", "Time":"'.$SpyResultArray[$recFound][1].'", "chapionD":"" }';




                      for ($column_num = 0; $column_num < $column_count; $column_num++) {

                        $field_name = mysql_field_name($result_id, $column_num);





                        if($first==0){
                              $field_value .= ($column_num == 0) ? '{"AA":"'.$AA.'",' : ' ';
                              $first = 1;
                        }
                        else {
                              $field_value .= ($column_num == 0) ? ',{"AA":"'.$AA.'",' : ' ';
                        }


                        //make also the record id as a scrambled string for security reasons.
                        if ( (strpos($field_name, strtoupper("ID")) > 0) and ($column_num == 0) ) {

                            $colum_value = ($row[$column_num]==nil || $row[$column_num]=="") ? "\"\"" : "\"".rawurlencode(encrypt(CRYPTKEY,$row[$column_num]))."\"";
                            $field_value .= "\"id_s\":".$colum_value;
                            $field_value .= ",";

                        }


                        if ($field_name == 'ChapionshipID') {
                           $colum_value = ($row[$column_num]==nil || $row[$column_num]=="") ? "\"\"" : "\"".$row['chapionD']."\"";
                        }  else {
                           $colum_value = ($row[$column_num]==nil || $row[$column_num]=="") ? "\"\"" : "\"".$row[$column_num]."\"";
                        }

                        $field_value .= "\"".$field_name."\":".html_entity_decode($colum_value);
                        $field_value .= (($column_num + 1 ) == $column_count)?" } ":",";

                    }



                      $field_value .= ',{"AA":"","id_s":"EMPTY","CouponID":"", "CountryID":"", "ChapionshipID":"", "Time":"", "Date":"", "Code":"", "EE":"", "Goal_1":"'.
                      '", "HomeTeamID":"", "Goal_x":"", "HostTeamID":"'.
                      '", "Goal_2":"", "de_1ORX":"", "de_XOR2":"'.
                      '", "de_1OR2":"", "Under":"", "Over":"'.
                      '", "GG":"", "NG":"'.
                      '", "HMI_1":"-", "HMI_X":"-", "HMI_2":"-", "HT_11":"-", "HT_1X":"-", "HT_12":"-", "HT_X1":"-", "HT_XX":"-", "HT_X2":"-", "HT_21":"-", "HT_2X":"-", "HT_22":"-", "SS_10":"-", "SS_20":"-", "SS_21":"-", "SS_30":"-", "SS_31":"-", "SS_32":"-", "SS_40":"-", "SS_41":"-", "SS_42":"-", "SS_43":"-", "SS_00":"-", "SS_11":"-", "SS_22":"-", "SS_33":"-", "SS_01":"-", "SS_02":"-", "SS_12":"-", "SS_03":"-", "SS_13":"-", "SS_23":"-", "SS_04":"-", "SS_14":"-", "SS_24":"-", "SS_34":"-", "TG_01":"-", "TG_23":"-", "TG_46":"-", "TG_7":"-", "HalfTimeScore":"-", "FullTimeScore":"-", "Published":"1", "Canceled":"0", "Dirty":"0", "Indexed":"0", "Showed":"1", "IsoDate":"-", "Time":"", "chapionD":"" }';



                 }
        }


    }
    $field_value = "{\"DataSet\": {\"totalRecords\":".html_entity_decode($count_final_records).",\"items\":[".$field_value."]}}";

    mysql_free_result($result_id);
	$MYDATASOURCE = $field_value;



    return $MYDATASOURCE;

}

/***********************************************************************************************
function parseOpapXML()
Load OPAP's XML data



************************************************************************************************/
function parseOpapXML() {
   $ER = error_reporting(0);

   // SpecialContent=19 = Next coupon
   // SpecialContent=17 = Current coupon
   //$rez = get_redirect_url('http://www.pamestoixima.gr/ShowSpecialContent.ashx?langid=1&FolderId=329a10c9-f525-4d8a-bb69-2b786f31c043&SpecialContent=19');
   $couponID=$_GET['CouponID'];

   //$rez = 'http://www.pamestoixima.gr/FlexBetXMLfootballCoupon.aspx?langID=1&couponID='.$couponID;
   /*
   if (!$rez) {


      return '{"DataSet": {"couponperiod":"url not valid", "couponID":-1, "totalRecords":0,"items":[]}}';


   }

   parse_str($rez, $url_params);

   $couponID=$url_params['CouponID'];

  */
   if (empty($couponID)) {


      return '{"DataSet": {"couponperiod":"CouponID not found", "couponID":-1,  "totalRecords":0,"items":[]}}';

   }

   $sqlquery = "update master set CouponID=".$couponID.' where masterID=1';
   $result_id = mysql_query($sqlquery);

   $xml_url = "http://www.pamestoixima.gr/FlexBetXMLfootballCoupon.aspx?langID=1&couponID=".$couponID;



  /*
   $couponID=1;
   $xml_url = "http://localhost/lackybet/NoData/Opap/XML/1.xml?couponID=1";

 */
   $xml = simpleXML_load_file($xml_url);
   error_reporting($ER);

   if($xml ===  FALSE) {

      return '{"DataSet": {"couponperiod":"xml file not valid", "couponID":-1, "totalRecords":0,"items":[]}}';
   }

   $xmlarray = amstore_xmlobj2array($xml);

   $count_final_records=0;
   $NotFound = "<table border=0 cellpadding=0 cellspacing=0 align=center width=100%><tr><td width=100px><b>Ημερομηνία</b></td><td width=50><b>ΚΩΔ</b></td><td width=50><b>ΠΡΩΤ</b></td><td><b>ΟΜΑΔΕΣ</b></td></tr>";
   $NotFoundCount = 0;

   foreach ($xmlarray['Section'] as $Section) {

       foreach ($Section['Event'] as $Event) {

          foreach ($Event as $key => $value) {

                $Event[$key] = str_replace (',','.',$value);

                if ($value=='-') {
                    $Event[$key] = 0;
                }

                if (is_array($Event[$key])){
                     $Event[$key] =0;
                }

          }

          if ( ( date("H:i", strtotime($Event['Time'])) >= date("H:i", strtotime("00:00")) ) && ( date("H:i",strtotime($Event['Time'])) < date("H:i", strtotime("06:00"))) ) {
               $Event['Date'] = ConvertDate($Event['Date'],true);

          } else
               $Event['Date'] = ConvertDate($Event['Date'],false);



          $sqlquery = "SELECT CO.*,CH.ChapionshipID,CH.Chapionship,CH.ShortcutName,T1.TeamID as HomeTeamID,T1.Team as HomeTeamName,T2.TeamID as HostTeamID,T2.Team as HostTeamName
                      FROM countries AS CO
                      LEFT JOIN chapionships AS CH
                        ON CO.CountryID = CH.CountryID
                      LEFT JOIN teams AS T1
                        ON CH.ChapionshipID = T1.chapionshipID
                      LEFT JOIN teams AS T2
                        ON CH.ChapionshipID = T2.chapionshipID
                      WHERE CH.ShortcutName='".$Event['League']."' AND T1.TEAM='".$Event['HomeTeam']."' AND T2.team='".$Event['AwayTeam']."'";

          $result_id = mysql_query($sqlquery);

          if (mysql_num_rows($result_id) > 0) {


                      $row = mysql_fetch_assoc($result_id);
                      $count_final_records++;
                      if($count_final_records==1){
                              $field_value .= "{";
                              $first = 1;
                      } else {

                              $field_value .= ",{";
                      }


                     $field_value .= '"AA":'.$count_final_records.',"Date":"'.$Event['Date'].'", "CountryID":'.$row['CountryID'].', "ChapionshipID":'.$row['ChapionshipID'].',  "Time":"'.$Event['Time'].'", "Code":'.$Event['Code'].', "EE":'.ConvertEE($Event['SpecialSignal']).',
                        "Goal_1":'.$Event['Apodosi1'].', "HomeTeamID":"'.$row['HomeTeamID'].'", "Goal_x":'.$Event['ApodosiX'].', "HostTeamID": "'.$row['HostTeamID'].'", "Goal_2":'.$Event['Apodosi2'].', "de_1ORX":'.$Event['Apodosi1X'].', "de_XOR2":'.$Event['ApodosiX2'].', "de_1OR2":'.$Event['Apodosi12'].',
                        "Under":'.$Event['ApodosiUNDER'].', "Over":'.$Event['ApodosiOVER'].', "GG":'.$Event['ApodosiSNS1Y'].', "NG":'.$Event['ApodosiSNS1N'].',"HMI_1":'.$Event['ApodosiHalf1'].', "HMI_X":'.$Event['ApodosiHalfX'].', "HMI_2":'.$Event['ApodosiHalf2'].', "HT_11":'.$Event['ApodosiHF11'].', "HT_1X":'.$Event['ApodosiHF1X'].', "HT_12":'.$Event['ApodosiHF12'].', "HT_X1":'.$Event['ApodosiHFX1'].',
                        "HT_XX":'.$Event['ApodosiHFXX'].', "HT_X2":'.$Event['ApodosiHFX2'].', "HT_21":'.$Event['ApodosiHF21'].', "HT_2X":'.$Event['ApodosiHF2X'].', "HT_22":'.$Event['ApodosiHF22'].', "SS_10":0, "SS_20":0, "SS_21":0, "SS_30":0, "SS_31":0,
                        "SS_32":0,"SS_40":0, "SS_41":0, "SS_42":0, "SS_43":0, "SS_00":0, "SS_11":0, "SS_22":0, "SS_33":0, "SS_01":0,
                        "SS_02":0, "SS_12":0, "SS_03":0, "SS_13":0, "SS_23":0, "SS_04":0, "SS_14":0, "SS_24":0, "SS_34":0,"TG_01":'.$Event['ApodosiSOG01'].',
                        "TG_23":'.$Event['ApodosiSOG23'].', "TG_46":'.$Event['ApodosiSOG46'].', "TG_7":'.$Event['ApodosiSOG7'].'}';




          } else {

              //test code to find where is the problem.

              $sqlquery = "SELECT CO.*,CH.ChapionshipID,CH.Chapionship,CH.ShortcutName,T1.TeamID as HomeTeamID,T1.Team as HomeTeamName,T2.TeamID as HostTeamID,T2.Team as HostTeamName
                          FROM countries AS CO
                          LEFT JOIN chapionships AS CH
                            ON CO.CountryID = CH.CountryID
                          LEFT JOIN teams AS T1
                            ON CH.ChapionshipID = T1.chapionshipID
                          LEFT JOIN teams AS T2
                            ON CH.ChapionshipID = T2.chapionshipID
                          WHERE CH.ShortcutName='".$Event['League']."'";

            $result_id_1 = mysql_query($sqlquery);

            if (mysql_num_rows($result_id_1) > 0) {


                    $sqlquery = "SELECT CO.*,CH.ChapionshipID,CH.Chapionship,CH.ShortcutName,T1.TeamID as HomeTeamID,T1.Team as HomeTeamName,T2.TeamID as HostTeamID,T2.Team as HostTeamName
                                FROM countries AS CO
                                LEFT JOIN chapionships AS CH
                                  ON CO.CountryID = CH.CountryID
                                LEFT JOIN teams AS T1
                                  ON CH.ChapionshipID = T1.chapionshipID
                                LEFT JOIN teams AS T2
                                  ON CH.ChapionshipID = T2.chapionshipID
                                WHERE CH.ShortcutName='".$Event['League']."' AND T1.TEAM='".$Event['HomeTeam']."'";



                    $result_id_2 = mysql_query($sqlquery);

                    if (mysql_num_rows($result_id_2) > 0) {

                        $Event['AwayTeam'] = '<font color=red>'.$Event['AwayTeam'].'</font>';
                    } else {

                        $Event['HomeTeam'] = '<font color=red>'.$Event['HomeTeam'].'</font>';
                    }
              } else {

                $Event['League'] = '<font color=red>'.$Event['League'].'</font>';

              }

              $NotFoundCount++;
              $NotFound .= '<tr><td>'.date('d/m/Y',strtotime($Event['Date'])).'</td><td>'.trim($Event['Code']).'</td><td>'.trim($Event['League']).'</td><td>'.trim($Event['HomeTeam']).' - '.trim($Event['AwayTeam']).'</td><tr>';
          }

       }

   }



   $NotFound .= '</table>';
   $couponperiod =$xmlarray['BasicInformation']['StartDate'].' έως '.$xmlarray['BasicInformation']['EndDate'];

   $field_value = "{\"DataSet\":{\"couponperiod\":\"".html_entity_decode($couponperiod)."\", \"couponID\":".html_entity_decode($couponID).", \"notfoundcount\":".html_entity_decode($NotFoundCount).",\"totalRecords\":".html_entity_decode($count_final_records).",\"notfound\":\"".html_entity_decode(substr($NotFound,0,-1))."\",\"items\":[".$field_value."]}}";
   $MYDATASOURCE = $field_value;



   return $MYDATASOURCE;
}

//*********************** debug**********************

 /*

//$primaryKey = "CouponID";
$table="agentremainer";

$appid="VelvetBet";
$type="select";

//$column="Remainder";

//$newvalue=1300.45;
//$whereID="SQL|Date >='2009-08-04' AND Date <='2009-08-10' order by Date,Time Asc";
//$cascade="yes";
$record=2;


//$jsondata='{"Date":"25/07/2009","ChapionshipID":"4","Code":"22","CountryID":"2","EE":"1","GG":2.5,"Goal_1":"2","Goal_2":"2","Goal_x":"2","HomeTeamID":"9","HostTeamID":"11","NG":5,"Over":1.3,"Time":"00:01","Under":2.5,"de_1OR2":3,"de_1ORX":1.5,"de_XOR2":2}';
*/
/*
$DB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
mysql_select_db(DataBase, $DB) or die(mysql_error());
$result_id = mysql_query("select ChapionshipID,Chapionship from ".$table." where CountryID=". $whereID .";");
$MYDATASOURCE = get_pair_values($result_id,$primaryKey);
echo  $MYDATASOURCE;
return;

*/


    //enable the Stored Procedures calls
    $DB = mysql_connect(MySQLIP, Username, Password,false,65536) or die(mysql_error());

    mysql_select_db(DataBase, $DB) or die(mysql_error());
	mysql_query("SET NAMES 'utf8'");


$forbiddenSQLArray = array('UPDATE','INSERT','DELETE','DROP','SELECT', 'SET','%31%27%6f%72%27%31%27%3d%27%31');

if ($appid=="VelvetBet123456789!") {

    //check for foribedden sql queries in the where clause
    //$whereID=str_replace(';','',$whereID);

    for ($i=0;$i<count($forbiddenSQLArray)-1;$i++) {
        if (stristr($whereID, $forbiddenSQLArray[$i]) == true){

             if ($_SESSION['user/id']=="guest") {
                 $_SESSION['user/id']=-2;
                 $_SESSION["user/level"]="guest";
             }
              //log anything
             $Description = 'Forbidden SQL Word    appid=['.$appid.'], table=['.$table.'], type=['.$type.'], record=['.$record.'], primaryKey=['.$primaryKey.'], column=['.$column.'], newvalue=['.$newvalue.'], output=['.$output.'], whereID=['.$whereID.'], jsondata=['.$jsondata.'], cascade=['.$cascade.']';
             $sqlquery = "Insert errorreport set RegDate='".GR_Time('Y-m-d H:i:s',time())."', UserBetSynopsisID=-1, AgentID=-1, BrowserInfo='".$_SERVER['HTTP_USER_AGENT']."', Description='".$Description."'";
             SaveLog(-1,$_SESSION['user/id'],4,$_SERVER['HTTP_USER_AGENT'],$Description,'Προειδοποίηση ! Χρήστης που δεν έχει τα απαραίτητα δικαιώματα προσπάθησε να δημιουργήσει ερωτήματα στη βάση δεδομένων με εξουσιοδοτημένο περιεχόμενο.');

             if ($_SESSION['user/id']==-2) {
                 $_SESSION['user/id']="guest";
                 unset($_SESSION["user/level"]);
             }


              die('I got you bastard. You might think that you are smarter than me, but you are just a fucking lousy loser. Get a life and find a proper job to earn your money.');
        }

    }

    //-------------------- Disable some calls from unathorized users -----------------
          switch ($type) {
            case 'select' :

                        break;
            case 'update' :
                        switch ($column) {
                            case 'Remainder' : if ( ($_SESSION["user/level"] == "agents") || ($_SESSION["user/level"] == "superagents") ) {
                                                    SaveLog(-1,$_SESSION['user/id'],1,$_SERVER['HTTP_USER_AGENT'],'update error (Disabled calls): '.mysql_error().' update_sigle('.$newvalue.','.$table.','.$column.','.$primaryKey.','.$record.')' ,'Μη εξουσιοδοτημένη ενημέρωση. Από τη σελίδα ['.$_SESSION['user/pagenavigation'].'] του περιβάλλοντος του.');
                                                    return;
                                               }
                            break;
                        }
                        break;
            case 'delete' :

                        break;

          }


    //--------------------------------------------------------------------------------



    if ($type=="select") {

        if (strcasecmp($table, "superagentsprojection") == 0) {

    			$result_id = mysql_query("select SAgentProjectionID,SAgentIDSlave,Name from superagents,superagentsprojection where superagentsprojection.SAgentIDMaster=".$record." AND superagents.SAgentID=superagentsprojection.SAgentIDSlave");
    	        $MYDATASOURCE = convert_yui($result_id, $field_labels, 2);
    	        echo $MYDATASOURCE;


        } elseif (strcasecmp($table, "logreport") == 0) {

                $whereID=str_replace('@','\'',$whereID);


                if ($output=='*')
                    $Filter = " ";
                else if ($output=='>0')
                    $Filter = " AND WarningLevel > 0";
                else
                    $Filter = " AND WarningLevel=".$output;




                $sqlquery = "select ReportID,RegDate,UserBetSynopsisID,AgentName,AgentLevel,FriendlyDescription from errorreport where ".substr($whereID,4).$Filter." order by ReportID desc";


    			$result_id = mysql_query($sqlquery);
                $MYDATASOURCE = convert_yui($result_id, $field_labels, 2);
                echo $MYDATASOURCE;

        } elseif (strcasecmp($table, "countries") == 0) {

            if ($output == "dropdown") {

    			$result_id = mysql_query("select DISTINCT countries.* from ".$table.", chapionships where countries.CountryID=chapionships.CountryID order by Country;");
                $MYDATASOURCE = get_pair_values($result_id,$primaryKey);
                echo $MYDATASOURCE;

            } else {

    			$result_id = mysql_query("select * from ".$table." order by Country");
    	        $MYDATASOURCE = convert_yui($result_id, $field_labels, 2);
    	        echo $MYDATASOURCE;
            }


        } elseif (strcasecmp($table, "chapionships") == 0) {

             if ($output == "dropdown") {
    			$result_id = mysql_query("select ChapionshipID,Chapionship from ".$table." where CountryID=". $whereID .";");
                $MYDATASOURCE = get_pair_values($result_id,$primaryKey);
                echo $MYDATASOURCE;

            } else {
                $result_id = mysql_query("select chapionships.* from ".$table.",countries where chapionships.CountryID = countries.CountryID order by Country,chapionship Asc;");
      	        $MYDATASOURCE = convert_yui($result_id, $field_labels, 2);
      	        echo $MYDATASOURCE;
      	        //$test = array('results' => array("ID"=> 1));
      	        //$test = array("ID"=> 1);
      	        //echo json_encode($test);
      	        //echo "{\"DataSet\": {\"totalRecords\":1,\"items\":[{\"ChapionshipID\":\"1\", \"Chapionship\":\"A Eth\", \"CountryID\":\"97\" } ]}}";
            }

   		} elseif (strcasecmp($table, "teams") == 0) {

             if ((strpos($whereID,'SQL')) !== false) {

                $whereID=str_replace('@','\'',$whereID);
                $sqlquery = "select teams.* from ".$table.",countries,chapionships where chapionships.ChapionshipID = teams.ChapionshipID and countries.CountryID = teams.CountryID and ".substr($whereID,4)." order by Country,Chapionship,Team Asc;";
                //echo $sqlquery;
                //return;
				$result_id = mysql_query($sqlquery);
		        $MYDATASOURCE = convert_yui($result_id, $field_labels, 2);
		        echo $MYDATASOURCE;

             } elseif ($output == "dropdown") {
    			$result_id = mysql_query("select TeamID,Team from ".$table." where ChapionshipID=". $whereID ." Order by Team asc;");
                $MYDATASOURCE = get_pair_values($result_id,$primaryKey);
                echo $MYDATASOURCE;

            } else {

				$result_id = mysql_query("select teams.* from ".$table.",countries,chapionships where chapionships.ChapionshipID = teams.ChapionshipID and countries.CountryID = teams.CountryID order by Country,Chapionship,Team asc;");
		        $MYDATASOURCE = convert_yui($result_id, $field_labels, 2);
		        echo $MYDATASOURCE;
			}

		} elseif (strcasecmp($table, "coupons") == 0) {

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

            $ValidStartPeriodBigZone  = mktime(0, 0, 0, GR_Time("m",time())  , GR_Time("d",time())-$StartPeriod, GR_Time("Y",time()));
            $ValidEndPeriodBigZone = mktime(0, 0, 0, GR_Time("m",time())  , GR_Time("d",time())+$EndPeriod, GR_Time("Y",time()));
            $MiddleDateBetweenPeriods =  mktime(0, 0, 0, GR_Time("m",time())  , GR_Time("d",time())+$MiddlePeriod, GR_Time("Y",time()));

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

            $ValidStartPeriodSmallZone  = mktime(0, 0, 0, GR_Time("m",time())  , GR_Time("d",time())-$StartPeriod, GR_Time("Y",time()));
            $ValidEndPeriodSmallZone = mktime(0, 0, 0, GR_Time("m",time())  , GR_Time("d",time())+$EndPeriod, GR_Time("Y",time()));


            if ( ($DayOfWeek >= 2) && ($DayOfWeek <= 4) ) {
                	$StartDate =  $ValidStartPeriodBigZone;
                    $EndDate = $ValidEndPeriodBigZone;
            } else {
                	$StartDate =  $ValidStartPeriodSmallZone;
                  $EndDate = $ValidEndPeriodSmallZone;

            }

            $StartDate=date("Y-m-d",$StartDate);
            $EndDate=date("Y-m-d",$EndDate);


            //if select has a cascade parameter then return all data from relation tables
            if ((strcasecmp($cascade, "yes") == 0)){

                if ((strpos($whereID,'CSQL')) !== false) {



                      $whereID='SQL|Date >=@'.$StartDate.'@ AND TIMESTAMPDIFF(SECOND,PHPTIME,TIMESTAMP(Date,Time)) >= 2 AND Published=1 AND Showed=1 order by Date,Time,Code Asc;';
                      $whereID=str_replace('@','\'',$whereID);
                      $whereID=str_replace('PHPTIME','\''.GR_Time('Y-m-d H:i:s',time()).'\'',$whereID);
                      $sqlquery = "
                      SELECT C.*,C.Date as IsoDate, TIME_FORMAT(Time,'%H:%i') AS Time,T1.Team as HomeTeam,T2.Team as HostTeam,CH.Chapionship as Chapionship, CH.ShortcutName as ShortcutName, CO.Country as Country
                      FROM ".$table." AS C
                      LEFT JOIN countries AS CO
                        ON C.CountryID = CO.CountryID
                      LEFT JOIN chapionships AS CH
                        ON C.ChapionshipID = CH.ChapionshipID
                      LEFT JOIN teams AS T1
                        ON C.HomeTeamID = T1.TeamID
                      LEFT JOIN teams AS T2
                        ON C.HostTeamID = T2.TeamID
                      WHERE ".substr($whereID,4);

                } else if ((strpos($whereID,'RSQL')) !== false) {

                      $whereID='SQL|HalfTimeScore <> @-@ AND FullTimeScore <> @-@ AND Date >=@'.$StartDate.'@  AND Published=1 AND Showed=1 order by Date,Time,Code Asc;';
                      $whereID=str_replace('@','\'',$whereID);

                      $sqlquery = "
                      SELECT C.*,C.Date as IsoDate, TIME_FORMAT(Time,'%H:%i') AS Time,T1.Team as HomeTeam,T2.Team as HostTeam,CH.Chapionship as Chapionship, CH.ShortcutName as ShortcutName, CO.Country as Country
                      FROM ".$table." AS C
                      LEFT JOIN countries AS CO
                        ON C.CountryID = CO.CountryID
                      LEFT JOIN chapionships AS CH
                        ON C.ChapionshipID = CH.ChapionshipID
                      LEFT JOIN teams AS T1
                        ON C.HomeTeamID = T1.TeamID
                      LEFT JOIN teams AS T2
                        ON C.HostTeamID = T2.TeamID
                      WHERE ".substr($whereID,4);

                } else {
                      $sqlquery = "
                      SELECT C.*,C.Date as IsoDate,TIME_FORMAT(Time,'%H:%i') AS Time,T1.Team as HomeTeam,T2.Team as HostTeam,CH.Chapionship as Chapionship, CH.ShortcutName as ShortcutName, CO.Country as Country
                      FROM ".$table." AS C
                      LEFT JOIN countries AS CO
                        ON C.CountryID = CO.CountryID
                      LEFT JOIN chapionships AS CH
                        ON C.ChapionshipID = CH.ChapionshipID
                      LEFT JOIN teams AS T1
                        ON C.HomeTeamID = T1.TeamID
                      LEFT JOIN teams AS T2
                        ON C.HostTeamID = T2.TeamID
                      WHERE date = '".$whereID."' order by Date,Time,Code Asc";
                }

				$result_id = mysql_query($sqlquery);
		        $MYDATASOURCE = convert_yui($result_id, $field_labels, 2);
		        echo $MYDATASOURCE;

            } elseif ((strpos($whereID,'SQL')) !== false) {
                // ************  TAKE CARE OF THIS !!! *****************
                // It might you cause problems cos you DONT COMPARE but you SEARCH for a string.
                // So, the next if that is CompareGoalBet if it was SQLCompareGoalBet it will come by here.
                // I didn't anything here for that, just for compatibility purposes!
                // I Dont want to have problems with that shit  and as always, I dont have mood to make all the corresponding changes !
                //******************************************************************************************
                $whereID=str_replace('@','\'',$whereID);
                $whereID=str_replace('PHPTIME','\''.GR_Time('Y-m-d H:i:s',time()).'\'',$whereID);
				$result_id = mysql_query("select coupons.*,coupons.Date as IsoDate,TIME_FORMAT(Time,'%H:%i') AS Time from ".$table." Where ".substr($whereID,4)." order by Date,Time,Code Asc" );
		        $MYDATASOURCE = convert_yui($result_id, $field_labels, 2);
                echo $MYDATASOURCE;
		        //echo "select coupons.*,TIME_FORMAT(Time,'%H:%i') AS Time from ".$table." Where ".substr($whereID,4);

			} else if ((strcasecmp($whereID,'CompareGoalBet')) == 0) {
                // Create a DOM object from a URL

                $Results = parseGoalBetIntCoupon();
                if ($Results==false)
                    $MYDATASOURCE = '{"DataSet": {"totalRecords":0,"items":[]}}';
                else
                    $MYDATASOURCE = CompareGoalBetResutls($Results);

		        echo $MYDATASOURCE;

			} else if ((strcasecmp($whereID,'OpapXML')) == 0) {
                // Create a DOM object from a URL


                $Results = parseOpapXML();
                if ($Results==false)
                    $MYDATASOURCE = '{"DataSet": {"totalRecords":0,"items":[]}}';
                else
                    $MYDATASOURCE = $Results;

		        echo $MYDATASOURCE;

            } else {

				$result_id = mysql_query("select coupons.*,coupons.Date as IsoDate,TIME_FORMAT(Time,'%H:%i') AS Time from ".$table." Where Date='".$whereID."' order by Date,Time,Code Asc");
		        $MYDATASOURCE = convert_yui($result_id, $field_labels, 2);
		        echo $MYDATASOURCE;


            }




   		}  elseif (strcasecmp($table, "superagents") == 0) {

                $result_id = mysql_query("select * from ".$table." order by ".$primaryKey);
    	        $MYDATASOURCE = convert_yui($result_id, $field_labels, 2);
    	        echo $MYDATASOURCE;


   		}  elseif (strcasecmp($table, "masterusers") == 0) {

    			$result_id = mysql_query("select * from ".$table." order by ".$primaryKey);
    	        $MYDATASOURCE = convert_yui($result_id, $field_labels, 2);
    	        echo $MYDATASOURCE;
    	        
		}  elseif (strcasecmp($table, "agents") == 0) {

                if (isset($record) && !isset($whereID)) {

        			$result_id = mysql_query("select * from agents Where AgentID=".$record);
        	        $MYDATASOURCE = convert_yui($result_id, $field_labels, 2);
        	        echo $MYDATASOURCE;

                } else if ($output == "dropdown") {
        			$result_id = mysql_query("select Name,AgentID,Remainder from ".$table." where SAgentID=". $whereID ." Order by Name asc;");
                    $MYDATASOURCE = get_pair_valuesForAgents($result_id,$primaryKey);
                    echo $MYDATASOURCE;
                } else {

        			$result_id = mysql_query("select * from ".$table." Where SAgentID=".$whereID." order by ".$primaryKey);
        	        $MYDATASOURCE = convert_yui($result_id, $field_labels, 2);
        	        echo $MYDATASOURCE;


                }

        } elseif (strcasecmp($table, "agents_list") == 0) {

                if (isset($whereID)) {

        			$result_id = mysql_query("select AgentID,SAgentID,RegDate,Name,Password,City,Phone,Mona,Dipla,Triades,Systems,Remainder,LastLogin,Active from agents Where SAgentID=".$whereID." order by ".$primaryKey);
        	        $MYDATASOURCE = convert_yui($result_id, $field_labels, 2);
        	        echo $MYDATASOURCE;

                }



		}  elseif (strcasecmp($table, "guestsip") == 0) {

    			$result_id = mysql_query("select * from ".$table." order by VisitDateTime DESC LIMIT 200");
    	        $MYDATASOURCE = convert_yui($result_id, $field_labels, 2);
    	        echo $MYDATASOURCE;

		}  elseif (strcasecmp($table, "online") == 0) {

                $sqlquery = "SELECT IP,Lastlogin,Name,'Agent' as AgentType FROM agents WHERE TIMESTAMPDIFF(MINUTE,Lastlogin,'".
                            GR_Time("Y-m-d H:i:s",time())."') < 5 AND TIMESTAMPDIFF(MINUTE,Lastlogin,'".GR_Time("Y-m-d H:i:s",time())."') >=0";

    			$result_id = mysql_query($sqlquery);
    	        $MYDATASOURCE1 = get_json_values($result_id);
                $Pos1 = strpos($MYDATASOURCE1, '{');
                if ($Pos1 !== false) {
                    $TotalRec1 = substr($MYDATASOURCE1,0,$Pos1);
                    $MYDATASOURCE1 = substr($MYDATASOURCE1,$Pos1);
                } else {
                    $TotalRec1 = 0;
                    $MYDATASOURCE1 ='';
                }


                $sqlquery = "SELECT IP,Lastlogin,Name,'Super Agent' as AgentType FROM superagents WHERE TIMESTAMPDIFF(MINUTE,Lastlogin,'".
                            GR_Time("Y-m-d H:i:s",time())."') < 5 AND TIMESTAMPDIFF(MINUTE,Lastlogin,'".GR_Time("Y-m-d H:i:s",time())."') >=0";

    			$result_id = mysql_query($sqlquery);
    	        $MYDATASOURCE2 = get_json_values($result_id);
                $Pos2 = strpos($MYDATASOURCE2, '{');
                if ($Pos2 !== false) {
                    $TotalRec2 = substr($MYDATASOURCE2,0,$Pos2);
                    $MYDATASOURCE2 = substr($MYDATASOURCE2,$Pos2);
                } else {
                    $TotalRec1 = 0;
                    $MYDATASOURCE2 ='';
                }


                $MYDATASOURCE = ($MYDATASOURCE2 != '') ? $MYDATASOURCE1.','.$MYDATASOURCE2 : $MYDATASOURCE1;
                $MYDATASOURCE = "{\"DataSet\": {\"totalRecords\":".($TotalRec1+$TotalRec2).",\"items\":[".$MYDATASOURCE."]}}";
    	        echo $MYDATASOURCE;

		}  elseif (strcasecmp($table, "master") == 0) {

    			$result_id = mysql_query("select * from ".$table." limit 1");
    	        $MYDATASOURCE = convert_yui($result_id, $field_labels, 2);
    	        echo $MYDATASOURCE;

		}  elseif (strcasecmp($table, "news") == 0) {

    			$result_id = mysql_query("select * from ".$table." order by Date Desc");
    	        $MYDATASOURCE = convert_yui($result_id, $field_labels, 2);
    	        echo $MYDATASOURCE;

        }  elseif (strcasecmp($table, "agentremainer") == 0) {

                $whereID=str_replace('@','\'',$whereID);
                if ($primaryKey=='SAgentID') {

                    if  ($column == '*') {
                         $AgentFilter = ' AND SAgentID='.$record;
                    } else {
                         $AgentFilter = ' AND SAgentID='.$record.' AND AgentID='.$column.' ';
                    }
                } else {

                   $AgentFilter = " AND AgentID=".$record;
                }



                //************ bettype=0 = Mona ********
                $sqlquery = "select BetType, Count(*) as BetSum, Sum(cost) as Bet, Sum(FinalUserProfit) as Profit,Sum(AgentProfit) as Commission,".
                            "(Sum(cost)-Sum(FinalUserProfit)-Sum(AgentProfit)) as Total from userbetssynopsis where ".
                            "BetType=0 AND Status > 0  AND Canceled=0 AND ".substr($whereID,4).$AgentFilter;


    			$result_id = mysql_query($sqlquery);
                $row = mysql_fetch_assoc($result_id);
                if ($row) {
                    	if ( (is_null($row["BetType"])) && ( $row["BetSum"] == 0) ) {

                            $FinalData = "{\"BetType\":\"0\", \"BetSum\":\"0\", \"Bet\":\"0\", \"Profit\":\"0\", \"Commission\":\"0\", \"Total\":\"0\" }";

                    	} else {
                        	mysql_data_seek($result_id, 0);
                	        $FinalData = convert_yui($result_id, $field_labels, 4);
                        }


                } else
                    $MYDATASOURCE = "Error at table agentremainer BetType=0";

                 //************ bettype=1 = Pollapla-dyades ********
                $sqlquery = "select Count(*) as BetSum, Sum(cost) as Bet, Sum(FinalUserProfit) as Profit,Sum(AgentProfit) as Commission,".
                            "(Sum(cost)-Sum(FinalUserProfit)-Sum(AgentProfit)) as Total from userbetssynopsis where ".
                            "BetType=1 AND UserBetsCount=2 AND Canceled=0 AND Status > 0 AND ".substr($whereID,4).$AgentFilter;

    			$result_id = mysql_query($sqlquery);
                $row = mysql_fetch_assoc($result_id);
                if ($row) {
                    	if ( (is_null($row["BetType"])) && ( $row["BetSum"] == 0) ) {

                            $FinalData = $FinalData.",{\"BetType\":\"12\", \"BetSum\":\"0\", \"Bet\":\"0\", \"Profit\":\"0\", \"Commission\":\"0\", \"Total\":\"0\" }";

                    	} else {
                        	mysql_data_seek($result_id, 0);
                   	        $FinalData = $FinalData.",{\"BetType\":\"12\",". substr(convert_yui($result_id, $field_labels, 4),1);
                        }


                } else
                    $MYDATASOURCE = "Error at table agentremainer BetType=12";

                 //************ bettype=1 = Pollapla-tryades ********
                $sqlquery = "select Count(*) as BetSum, Sum(cost) as Bet, Sum(FinalUserProfit) as Profit,Sum(AgentProfit) as Commission,".
                            "(Sum(cost)-Sum(FinalUserProfit)-Sum(AgentProfit)) as Total from userbetssynopsis where ".
                            "BetType=1 AND UserBetsCount>2 AND Status > 0 AND Canceled=0 AND ".substr($whereID,4).$AgentFilter;

    			$result_id = mysql_query($sqlquery);
                $row = mysql_fetch_assoc($result_id);
                if ($row) {
                    	if ( (is_null($row["BetType"])) && ( $row["BetSum"] == 0) ) {

                            $FinalData = $FinalData.",{\"BetType\":\"13\", \"BetSum\":\"0\", \"Bet\":\"0\", \"Profit\":\"0\", \"Commission\":\"0\", \"Total\":\"0\" }";

                    	} else {
                        	mysql_data_seek($result_id, 0);
                	        $FinalData = $FinalData.",{\"BetType\":\"13\",". substr(convert_yui($result_id, $field_labels, 4),1);
                        }


                } else
                    $MYDATASOURCE = "Error at table agentremainer BetType=13";

                //************ bettype=2 = systimata ********
                $sqlquery = "select BetType, Count(*) as BetSum, Sum(cost) as Bet, Sum(FinalUserProfit) as Profit,Sum(AgentProfit) as Commission,".
                            "(Sum(cost)-Sum(FinalUserProfit)-Sum(AgentProfit)) as Total from userbetssynopsis where ".
                            "BetType=2  AND Status > 0 AND Canceled=0 AND ".substr($whereID,4).$AgentFilter;

    			$result_id = mysql_query($sqlquery);
                $row = mysql_fetch_assoc($result_id);
                if ($row) {
                    	if ( (is_null($row["BetType"])) && ( $row["BetSum"] == 0) ) {

                            $FinalData = $FinalData.",{\"BetType\":\"2\", \"BetSum\":\"0\", \"Bet\":\"0\", \"Profit\":\"0\", \"Commission\":\"0\", \"Total\":\"0\" }";

                    	} else {
                        	mysql_data_seek($result_id, 0);
                	        $FinalData = $FinalData.",".convert_yui($result_id, $field_labels, 4);
                        }


                } else
                    $MYDATASOURCE = "Error at table agentremainer BetType=2";

                $FinalData = $FinalData.",{\"BetType\":\"99\", \"BetSum\":\"0\", \"Bet\":\"0\", \"Profit\":\"0\", \"Commission\":\"0\", \"Total\":\"0\" }";
                //create envelop
                $MYDATASOURCE = "{\"DataSet\": {\"totalRecords\":5,\"items\":[".$FinalData."]}}";

    	        echo $MYDATASOURCE;

        }  elseif (strcasecmp($table, "sagentremainer") == 0) {

                $whereID=str_replace('@','\'',$whereID);

                if (substr($record,0,1) == '*')
                    $record=' IN '.substr($record,1);
                else
                    $record='='.$record;

                $sqlquery = "select superagents.Name as SName, agents.Name, Sum(CASE WHEN Status > 0 THEN COST ELSE 0 END) as Bet, Sum(CASE WHEN Status > 0 THEN FinalUserProfit ELSE 0 END) as Profit, Sum(CASE WHEN Status > 0 THEN AgentProfit ELSE 0 END) as Commission,".
                            "(Sum(CASE WHEN Status > 0 THEN COST ELSE 0 END)-Sum(CASE WHEN Status > 0 THEN FinalUserProfit ELSE 0 END)-Sum(CASE WHEN Status > 0 THEN AgentProfit ELSE 0 END)) as Mixed, (Sum(CASE WHEN Status > 0 THEN SAgentProfitWin ELSE 0 END) - Sum(CASE WHEN Status > 0 THEN SAgentProfitLose ELSE 0 END)) as Commission_SAgent, ".
                            " ( (Sum(CASE WHEN Status > 0 THEN COST ELSE 0 END)-Sum(CASE WHEN Status > 0 THEN FinalUserProfit ELSE 0 END)-Sum(CASE WHEN Status > 0 THEN AgentProfit ELSE 0 END)) - (Sum(CASE WHEN Status > 0 THEN SAgentProfitWin ELSE 0 END) - Sum(CASE WHEN Status > 0 THEN SAgentProfitLose ELSE 0 END)) ) as Final, SUM(CASE WHEN Status > 0 THEN 1 ELSE 0 END) as BetSum, IFNULL(SUM(CASE WHEN Status = 0 THEN 1 ELSE 0 END),0) as OpenBetSum, IFNULL(Sum(CASE WHEN Status = 0 THEN COST ELSE 0 END),0) as OpenBet ".
                            " from userbetssynopsis,agents,superagents where userbetssynopsis.SAgentID=superagents.SAgentID AND userbetssynopsis.AgentID=agents.AgentID AND Status < 4 AND Canceled=0 AND ".substr($whereID,4).
                            " AND userbetssynopsis.SAgentID".$record." GROUP BY Name Order By SName,Name Asc";


    			$result_id = mysql_query($sqlquery);
                $NumRecords = mysql_num_rows($result_id);
                $row = mysql_fetch_assoc($result_id);
                if ($row) {
                    if ( $NumRecords == 0)  {
                        $FinalData = '';
                        $NumRecords = 0;
                    } else  {
                        mysql_data_seek($result_id, 0);
                        $FinalData = convert_yui($result_id, $field_labels, 4).',';
                    }

                }



                $FinalData = $FinalData."{\"SName\":\"\", \"Name\":\"SAGENT_TOTAL\", \"Bet\":\"0\", \"Profit\":\"0\", \"Commission\":\"0\", \"Mixed\":\"0\", \"Commission_SAgent\":\"0\", \"Final\":\"0\", \"BetSum\":\"0\", \"OpenBetSum\":\"0\", \"OpenBet\":\"0\" }";
                //create envelop
                $MYDATASOURCE = "{\"DataSet\": {\"totalRecords\":".($NumRecords+1).",\"items\":[".$FinalData."]}}";

    	        echo $MYDATASOURCE;


        }  elseif (strcasecmp($table, "agentremainernew") == 0) {

                $whereID=str_replace('@','\'',$whereID);


                $sqlquery = "select Name, Sum(CASE WHEN Status > 0 THEN COST ELSE 0 END) as Bet, Sum(CASE WHEN Status > 0 THEN FinalUserProfit ELSE 0 END) as Profit, Sum(CASE WHEN Status > 0 THEN AgentProfit ELSE 0 END) as Commission,".
                            "(Sum(CASE WHEN Status > 0 THEN COST ELSE 0 END)-Sum(CASE WHEN Status > 0 THEN FinalUserProfit ELSE 0 END)-Sum(CASE WHEN Status > 0 THEN AgentProfit ELSE 0 END)) as Mixed, (Sum(CASE WHEN Status > 0 THEN SAgentProfitWin ELSE 0 END) - Sum(CASE WHEN Status > 0 THEN SAgentProfitLose ELSE 0 END)) as Commission_SAgent, ".
                            " ( (Sum(CASE WHEN Status > 0 THEN COST ELSE 0 END)-Sum(CASE WHEN Status > 0 THEN FinalUserProfit ELSE 0 END)-Sum(CASE WHEN Status > 0 THEN AgentProfit ELSE 0 END)) - (Sum(CASE WHEN Status > 0 THEN SAgentProfitWin ELSE 0 END) - Sum(CASE WHEN Status > 0 THEN SAgentProfitLose ELSE 0 END)) ) as Final, SUM(CASE WHEN Status > 0 THEN 1 ELSE 0 END) as BetSum, IFNULL(SUM(CASE WHEN Status = 0 THEN 1 ELSE 0 END),0) as OpenBetSum, IFNULL(Sum(CASE WHEN Status = 0 THEN COST ELSE 0 END),0) as OpenBet ".
                            " from userbetssynopsis,agents where userbetssynopsis.AgentID=agents.AgentID AND Status < 4 AND Canceled=0 AND ".substr($whereID,4).
                            " AND userbetssynopsis.AgentID=".$record." GROUP BY Name";


    			$result_id = mysql_query($sqlquery);
                $NumRecords = mysql_num_rows($result_id);
                $row = mysql_fetch_assoc($result_id);
                if ($row) {
                    if ( $NumRecords == 0)  {
                        $FinalData = "{\"Name\":\"SAGENT_TOTAL\", \"Bet\":\"0\", \"Profit\":\"0\", \"Commission\":\"0\", \"Mixed\":\"0\", \"Commission_SAgent\":\"0\", \"Final\":\"0\", \"BetSum\":\"0\", \"OpenBetSum\":\"0\", \"OpenBet\":\"0\" }";
                        $NumRecords = 1;
                    } else  {
                        mysql_data_seek($result_id, 0);
                        $FinalData = convert_yui($result_id, $field_labels, 4);
                    }

                }




                //create envelop
                $MYDATASOURCE = "{\"DataSet\": {\"totalRecords\":".($NumRecords).",\"items\":[".$FinalData."]}}";

    	        echo $MYDATASOURCE;




        }  elseif (strcasecmp($table, "allremainer") == 0) {

                $whereID=str_replace('@','\'',$whereID);



                // dont change the sequence of the fields in the select query since in
                // the convert_yui we are making hard-coded checking depending to this specific sequence
                /*

                Original query without sum(openbets)

                $sqlquery = "select superagents.SAgentID, superagents.Name as sName, agents.Name,".
                            "IFNULL(Sum(cost),0) as Bet, IFNULL(Sum(FinalUserProfit),0) as Profit, IFNULL(Sum(AgentProfit),0) as Commission, ".
                            "IFNULL((Sum(cost)-Sum(FinalUserProfit)-Sum(AgentProfit)),0) as Mixed, IFNULL((Sum(SAgentProfitWin) - Sum(SAgentProfitLose)),0) as ".
                            "Commission_SAgent,IFNULL(( (Sum(cost)-Sum(FinalUserProfit)-Sum(AgentProfit)) - (Sum(SAgentProfitWin) - Sum(SAgentProfitLose)) ),0) as Final, ".
                            "Count(UserBetSynopsisID) as BetSum ".
                            "FROM superagents LEFT JOIN agents ON superagents.SAgentID = agents.SAgentID LEFT JOIN userbetssynopsis On (agents.AgentID = ".
                            "userbetssynopsis.AgentID  AND Status > 0 AND Canceled=0 AND ".substr($whereID,4).") ".
                            "GROUP BY agents.Name ORDER BY superagents.Name";

                 */
                $sqlquery ="select superagents.SAgentID, superagents.Name as sName, agents.Name, IFNULL(Sum(CASE WHEN Status > 0 THEN COST ELSE 0 END),0) as Bet, IFNULL(Sum(CASE WHEN Status > 0 THEN FinalUserProfit ELSE 0 END),0) as Profit, IFNULL(Sum(CASE WHEN Status > 0 THEN AgentProfit ELSE 0 END),0) as Commission, IFNULL((Sum(CASE WHEN Status > 0 THEN COST ELSE 0 END)-Sum(CASE WHEN Status > 0 THEN FinalUserProfit ELSE 0 END)-Sum(CASE WHEN Status > 0 THEN AgentProfit ELSE 0 END)),0) as Mixed, IFNULL((Sum(CASE WHEN Status > 0 THEN SAgentProfitWin ELSE 0 END) - Sum(CASE WHEN Status > 0 THEN SAgentProfitLose ELSE 0 END)),0) as Commission_SAgent,IFNULL(( (Sum(CASE WHEN Status > 0 THEN COST ELSE 0 END)-Sum(CASE WHEN Status > 0 THEN FinalUserProfit ELSE 0 END)-Sum(CASE WHEN Status > 0 THEN AgentProfit ELSE 0 END)) - (Sum(CASE WHEN Status > 0 THEN SAgentProfitWin ELSE 0 END) - Sum(CASE WHEN Status > 0 THEN SAgentProfitLose ELSE 0 END)) ),0) as Final, SUM(CASE WHEN Status > 0 THEN 1 ELSE 0 END) as BetSum, IFNULL(SUM(CASE WHEN Status = 0 THEN 1 ELSE 0 END),0) as OpenBetSum, IFNULL(Sum(CASE WHEN Status = 0 THEN COST ELSE 0 END),0) as OpenBet FROM superagents LEFT JOIN agents ON superagents.SAgentID = agents.SAgentID LEFT JOIN userbetssynopsis On (agents.AgentID = userbetssynopsis.AgentID  AND Canceled=0 AND Status <4 AND ".substr($whereID,4).") GROUP BY userbetssynopsis.AgentID ORDER BY superagents.Name";

    			$result_id = mysql_query($sqlquery);
                $NumRecords = mysql_num_rows($result_id);
                $row = mysql_fetch_assoc($result_id);
                if ($row) {
                    if ( $NumRecords == 0)  {
                        $FinalData = '';
                        $NumRecords = 0;
                        $MYDATASOURCE = "{\"DataSet\": {\"totalRecords\":".($NumRecords).",\"items\":[".$FinalData."]}}";
                    } else  {
                        mysql_data_seek($result_id, 0);
                        $MYDATASOURCE = convert_yui($result_id, $field_labels, 6);
                    }

                }



    	        echo $MYDATASOURCE;


        }  elseif (strcasecmp($table, "agentbetlist") == 0) {

                $whereID=str_replace('@','\'',$whereID);
                if ($primaryKey=='SAgentID') {

                    if  ($column == '*') {
                         $AgentFilter = '';
                    } else {
                         $AgentFilter = ' AND userbetssynopsis.AgentID='.$column.' ';
                    }
                }
                $primaryKey = 'userbetssynopsis.'.$primaryKey;

                if ($output=='*')
                    $Status = "";
                else if ($output=='1')
                    $Status = " Status > ".$output." AND ";
                else
                    $Status = " Status = ".$output." AND ";

                if (substr($record,0,1) == '*')
                    $record=' IN '.substr($record,1);
                else
                    $record='='.$record;


                $sqlquery = "select superagents.Name as SName, agents.Name,userbetssynopsis.UserBetSynopsisID, DateTime, BetType, Cost, Canceled, Status, PossibleProfit, FinalUserProfit,UserBetsCount,dp from userbetssynopsis,agents,superagents where ".
                              $Status.$primaryKey.$record." AND ".substr($whereID,4).$AgentFilter." AND agents.AgentID=userbetssynopsis.AgentID AND superagents.SAgentID=userbetssynopsis.SAgentID order by UserBetSynopsisID desc";


    			$result_id = mysql_query($sqlquery);
                $MYDATASOURCE = convert_yui($result_id, $field_labels, 2);
                echo $MYDATASOURCE;

      }  elseif (strcasecmp($table, "masterbetlist") == 0) {
                $scrambled = 0;
                $whereID=str_replace('@','\'',$whereID);
                if ($record != '') {

                    if (substr($record,0,1) == '?') {
                        $BetID = " UniqueID = '".(substr($record,1))."'";
                        $scrambled = 1;
                    } else {
                        $BetID = " UserBetSynopsisID = ".$record;
                        $scrambled = 0;
                    }
                    $SAgentFilter = '';
                    $Status = "";
                    $whereID ="SQL|";

                } else {


                      if  ($column == '*') {
                           $SAgentFilter = '';
                      } else {
                           $SAgentFilter = ' AND userbetssynopsis.SAgentID='.$column.' ';
                      }



                      if ($output=='*')
                          $Status = "";
                      else if ($output=='1')
                          $Status = " Status > ".$output." AND ";
                      else if ($output=='4')
                          $Status = " Canceled = 1 AND ";
                      else
                          $Status = " Status = ".$output." AND ";

                      $BetID = '';

                }


                $sqlquery = "select superagents.Name as SName,agents.Name,UserBetSynopsisID, DateTime, BetType, Cost, Canceled, Status, PossibleProfit, FinalUserProfit, UserBetsCount, dp from userbetssynopsis,agents,superagents where ".
                              $BetID.$Status.substr($whereID,4).$SAgentFilter." AND agents.AgentID=userbetssynopsis.AgentID AND superagents.SAgentID=userbetssynopsis.SAgentID order by UserBetSynopsisID desc";


    			$result_id = mysql_query($sqlquery);
                $MYDATASOURCE = convert_yui($result_id, $field_labels, 2);
                echo $MYDATASOURCE;
      }  elseif (strcasecmp($table, "indexedreport") == 0) {



                $sqlquery = "select superagents.Name as SName,agents.Name,userbetssynopsis.UserBetSynopsisID, DateTime, BetType, Cost, Canceled, Status, PossibleProfit, FinalUserProfit, UserBetsCount, dp from userbetssynopsis,agents,superagents,userbetsindexreport where ".
                              " userbetsindexreport.UserBetSynopsisID=userbetssynopsis.UserBetSynopsisID AND agents.AgentID=userbetssynopsis.AgentID AND superagents.SAgentID=userbetssynopsis.SAgentID order by userbetssynopsis.UserBetSynopsisID desc";;


    			$result_id = mysql_query($sqlquery);
                $MYDATASOURCE = convert_yui($result_id, $field_labels, 2);
                echo $MYDATASOURCE;



        }  elseif (strcasecmp($table, "covering") == 0) {




                $whereID=str_replace('@','\'',$whereID);
                $sqlquery = "
                SELECT Code,Count(CouponID) as TotalBets,Event,SUM(Cost) as Bets,Group_Concat(DISTINCT userbetssynopsis.userbetsynopsisID ORDER BY userbetssynopsis.userbetsynopsisID DESC SEPARATOR ', ') AS BetList,
                SUM(CASE WHEN Goal='1' THEN COST ELSE 0 END) Goal_1,
                SUM(CASE WHEN Goal='X' THEN COST ELSE 0 END) Goal_x,
                SUM(CASE WHEN Goal='2' THEN COST ELSE 0 END) Goal_2,
                SUM(CASE WHEN Goal='Under' THEN COST ELSE 0 END) Under,
                SUM(CASE WHEN Goal='Over' THEN COST ELSE 0 END) Over,
                SUM(CASE WHEN Goal='GG' THEN COST ELSE 0 END) GG,
                SUM(CASE WHEN Goal='NG' THEN COST ELSE 0 END) NG,
                SUM(CASE WHEN Goal='ΔΕ 1ήΧ' THEN COST ELSE 0 END) de_1ORX,
                SUM(CASE WHEN Goal='ΔΕ Χή2' THEN COST ELSE 0 END) de_XOR2,
                SUM(CASE WHEN Goal='ΔΕ 1ή2' THEN COST ELSE 0 END) de_1OR2,
                SUM(CASE WHEN Goal='HMI 1' THEN COST ELSE 0 END) HMI_1,
                SUM(CASE WHEN Goal='HMI X' THEN COST ELSE 0 END) HMI_X,
                SUM(CASE WHEN Goal='HMI 2' THEN COST ELSE 0 END) HMI_2,
                SUM(CASE WHEN Goal='HT 1-1' THEN COST ELSE 0 END) HT_11,
                SUM(CASE WHEN Goal='HT 1-X' THEN COST ELSE 0 END) HT_1X,
                SUM(CASE WHEN Goal='HT 1-2' THEN COST ELSE 0 END) HT_12,
                SUM(CASE WHEN Goal='HT X-1' THEN COST ELSE 0 END) HT_X1,
                SUM(CASE WHEN Goal='HT X-X' THEN COST ELSE 0 END) HT_XX,
                SUM(CASE WHEN Goal='HT X-2' THEN COST ELSE 0 END) HT_X2,
                SUM(CASE WHEN Goal='HT 2-1' THEN COST ELSE 0 END) HT_21,
                SUM(CASE WHEN Goal='HT 2-X' THEN COST ELSE 0 END) HT_2X,
                SUM(CASE WHEN Goal='HT 2-2' THEN COST ELSE 0 END) HT_22,
                SUM(CASE WHEN Goal='ΣΣ 1-0' THEN COST ELSE 0 END) SS_10,
                SUM(CASE WHEN Goal='ΣΣ 2-0' THEN COST ELSE 0 END) SS_20,
                SUM(CASE WHEN Goal='ΣΣ 2-1' THEN COST ELSE 0 END) SS_21,
                SUM(CASE WHEN Goal='ΣΣ 3-0' THEN COST ELSE 0 END) SS_30,
                SUM(CASE WHEN Goal='ΣΣ 3-1' THEN COST ELSE 0 END) SS_31,
                SUM(CASE WHEN Goal='ΣΣ 3-2' THEN COST ELSE 0 END) SS_32,
                SUM(CASE WHEN Goal='ΣΣ 4-0' THEN COST ELSE 0 END) SS_40,
                SUM(CASE WHEN Goal='ΣΣ 4-1' THEN COST ELSE 0 END) SS_41,
                SUM(CASE WHEN Goal='ΣΣ 4-2' THEN COST ELSE 0 END) SS_42,
                SUM(CASE WHEN Goal='ΣΣ 4-3' THEN COST ELSE 0 END) SS_43,
                SUM(CASE WHEN Goal='ΣΣ 0-0' THEN COST ELSE 0 END) SS_00,
                SUM(CASE WHEN Goal='ΣΣ 1-1' THEN COST ELSE 0 END) SS_11,
                SUM(CASE WHEN Goal='ΣΣ 2-2' THEN COST ELSE 0 END) SS_22,
                SUM(CASE WHEN Goal='ΣΣ 3-3' THEN COST ELSE 0 END) SS_33,
                SUM(CASE WHEN Goal='ΣΣ 0-1' THEN COST ELSE 0 END) SS_01,
                SUM(CASE WHEN Goal='ΣΣ 0-2' THEN COST ELSE 0 END) SS_02,
                SUM(CASE WHEN Goal='ΣΣ 1-2' THEN COST ELSE 0 END) SS_12,
                SUM(CASE WHEN Goal='ΣΣ 0-3' THEN COST ELSE 0 END) SS_03,
                SUM(CASE WHEN Goal='ΣΣ 1-3' THEN COST ELSE 0 END) SS_13,
                SUM(CASE WHEN Goal='ΣΣ 2-3' THEN COST ELSE 0 END) SS_23,
                SUM(CASE WHEN Goal='ΣΣ 0-4' THEN COST ELSE 0 END) SS_04,
                SUM(CASE WHEN Goal='ΣΣ 1-4' THEN COST ELSE 0 END) SS_14,
                SUM(CASE WHEN Goal='ΣΣ 2-4' THEN COST ELSE 0 END) SS_24,
                SUM(CASE WHEN Goal='ΣΣ 3-4' THEN COST ELSE 0 END) SS_34,
                SUM(CASE WHEN Goal='TG 0-1' THEN COST ELSE 0 END) TG_01,
                SUM(CASE WHEN Goal='TG 2-3' THEN COST ELSE 0 END) TG_23,
                SUM(CASE WHEN Goal='TG 4-6' THEN COST ELSE 0 END) TG_46,
                SUM(CASE WHEN Goal='TG 7' THEN COST ELSE 0 END) TG_7
                FROM userbets,userbetssynopsis WHERE
                userbets.UserBetSynopsisID  = userbetssynopsis.UserBetSynopsisID AND  userbetssynopsis.Status = 0 AND Canceled=0
                AND ".substr($whereID,4)." Group By CouponID order by Bets Desc";

                $result_id = mysql_query('SET @@group_concat_max_len = 9999999');
                $result_id = mysql_query($sqlquery);

                $statisticssql = "select Count(UserBetSynopsisID) as TotalBets,SUM(Cost) as Bets from userbetssynopsis where Status=0 AND Canceled=0 AND ".substr($whereID,4);
                $MYDATASOURCE = convert_yui($result_id, $statisticssql, 5);





                echo $MYDATASOURCE;

        } else if (strcasecmp($table, "empty") == 0) {

             echo '{"DataSet": {"totalRecords":0,"items":[]}}';


        } else {



   			echo "error";
   		}







    }
    else if ($type=="delete") {

        if (strcasecmp($table, "guestsip") == 0) {

            $result_id = mysql_query("DELETE FROM ".$table);

        } else if (strcasecmp($table, "deleteremainer") == 0) {

            if ($newvalue=='hope') {
                $whereID=str_replace('@','\'',$whereID);
                $result_id = mysql_query("DELETE FROM userbetssynopsis where ".substr($whereID,4));
            } else {


              echo 'No correct password';
              mysql_close($DB);
              return;
            }


        } else {
            $result_id = mysql_query("DELETE FROM ".$table." WHERE ".$primaryKey."=".$record);
        }

        echo '200';


    }
    else if ($type=="update") {

       //removes control characters
       $newvalue = removeCtrlChars($newvalue);


        if ((strcasecmp($cascade, "yes") == 0)){
            //update the master record.

            $r_value=update_single($newvalue, $table, $column, $primaryKey, $record);
            if  ( (strcasecmp($column, "CountryID") == 0)&& ($r_value) ) {



                   //update ChapionshipID
                   $result_id = mysql_query("select * from chapionships where CountryID=".$newvalue." limit 1;");
                   $row = mysql_fetch_assoc($result_id);
                    if ($row) {
                    	$reclabel = $row["Chapionship"];
                    	$recvalue = $row["ChapionshipID"];
                        $newvalue =   $recvalue;

                    }

                   $r_value=update_single($newvalue, $table, 'ChapionshipID', $primaryKey, $record);
                   if ($r_value) {
                       $response = "{\"DataSet\": {\"totalrecords\":1, \"chapionships\": [{\"value\":".$recvalue.",\"label\":\"".$reclabel."\"}],";

                       //update HomeTeamID & HostTeamID
                       $result_id = mysql_query("select * from teams where ChapionshipID=".$recvalue." limit 1;");
                       $row = mysql_fetch_assoc($result_id);
                        if ($row) {
                        	$reclabel = $row["Team"];
                        	$recvalue = $row["TeamID"];
                            $newvalue =   $recvalue;

                        }

                      $r_value=update_single($newvalue, $table, 'HomeTeamID', $primaryKey, $record);
                      $r_value=update_single($newvalue, $table, 'HostTeamID', $primaryKey, $record);

                      $response = $response. "\"teams\": [{\"value\":".$recvalue.",\"label\":\"".$reclabel."\"}] }}";
                      echo $response;
                   }

            } else  if  ( (strcasecmp($column, "ChapionshipID") == 0) && ($r_value) ) {

                   //update ChapionshipID
                   $result_id = mysql_query("select * from teams where ChapionshipID=".$newvalue." limit 1;");
                   $row = mysql_fetch_assoc($result_id);
                    if ($row) {
                    	$reclabel = $row["Team"];
                    	$recvalue = $row["TeamID"];
                        $newvalue =   $recvalue;

                    }

                  update_single($newvalue, $table, 'HomeTeamID', $primaryKey, $record);
                  update_single($newvalue, $table, 'HostTeamID', $primaryKey, $record);

                  $response = "{\"DataSet\": {\"totalrecords\":1, \"teams\": [{\"value\":".$recvalue.",\"label\":\"".$reclabel."\"}]}}";
                  echo $response;

            } else {
                  echo  'update error: '.mysql_error().'<br>';

            }


        } else if ((strcasecmp($table, "changepassword") == 0)) {

                if ($primaryKey == 'AgentID')
                    $table='agents';
                else
                    $table='superagents';

                $sqlquery = "select Name,Password from ".$table." where ".$primaryKey."=".$record;
    			$result_id = mysql_query($sqlquery);
                $row = mysql_fetch_assoc($result_id);
                if ($row) {
                    $Password = $row['Password'];
                    $Name=$row['Name'];
                } else {

                    echo 'User not found with recordID='.$record;
                    mysql_close($DB);
                    return;

                }

                //check to see if the agent already exists in the database
                //if yes return with error.

                  $sqlquery = "SELECT agents.Name,agents.Password,superagents.Name,superagents.Password,masterusers.Name,masterusers.Password FROM agents,superagents,masterusers WHERE
                   (agents.Name='".$Name."' AND STRCMP(agents.Password, BINARY '".$newvalue."')=0 ) OR
                   (superagents.Name='".$Name."' AND STRCMP(superagents.Password, BINARY '".$newvalue."')=0) OR
                   (masterusers.Name='".$Name."' AND STRCMP(masterusers.Password, BINARY '".$newvalue."')=0);";
                  $result_id = mysql_query($sqlquery);
                  // Check result
                  // This shows the actual query sent to MySQL, and the error. Useful for debugging.
                  if (!$result_id) {
                      $message  = 'Invalid query: ' . mysql_error() . "\n";
                      $message .= 'Whole query: ' . $sqlquery;
                      die($message);
                  }

                  $num_rows = mysql_num_rows($result_id);

                  if($num_rows != NULL)
                  {
                    echo 'userexist';
                    mysql_close($DB);
                    return;
                  }




                 if (!ctype_alnum($Password)) {
                      echo "The password does not consist of all letters or digits.";
                  }


                $sqlquery = "update ".$table." Set Password='".$newvalue."' where ".$primaryKey."=".$record." AND STRCMP(Password, BINARY '".$_GET['oldvalue']."')=0;";
    			$result_id = mysql_query($sqlquery);
                $rowsAffected=mysql_affected_rows();

                if ($rowsAffected==1) {

                    echo '200';


                } else {

                    echo 'Wrong old password';


                }



        } else if ((strcasecmp($table, "userbetssynopsisedit") == 0)) {

                if ($column=='FinalUserProfit') {
                        ini_set("precision", "16");
                        $sqlquery = "select * from userbetssynopsis where UserBetSynopsisID=".$record;
            			$result_id = mysql_query($sqlquery);
                        $row = mysql_fetch_assoc($result_id);
                        if ($row) {

                            $sqlquery = "select * from superagents where SAgentID=".$row['SAgentID'];
                			$result_id2 = mysql_query($sqlquery);
                            $SAgentTbl = mysql_fetch_assoc($result_id2);

                            if ($SAgentTbl) {
                               // me pososta
                                if ($SAgentTbl['Commission_tziros'] == 0) {

                                       // if user profit is zero then the bet is lost
                                       if ($newvalue <= 0){

                                           $SAgentProfitWin =  ($row['Cost']-$row['AgentProfit']) *  ($SAgentTbl['Commission_pososto'] / 100.0);
                                           $SAgentProfitLose = 0;
                                           $MasterProfitWin =  $row['Cost'] - $row['AgentProfit'] - $SAgentProfitWin ;
                                           $MasterProfitLose = 0;


                                       } else {


                                          $total = $row['Cost'] - $newvalue - $row['AgentProfit'];

                                          if ($total <= 0 )
                                          {
                                              $SAgentProfitWin = 0;
                                              $SAgentProfitLose = abs($total) * ($SAgentTbl['Commission_pososto'] / 100.0) ;

                                              $MasterProfitWin =  0;
                                              $MasterProfitLose=  abs($total) - $SAgentProfitLose;



                                          } else {

                                              $SAgentProfitWin = $total * ($SAgentTbl['Commission_pososto'] / 100.0);
                                              $SAgentProfitLose = 0;

                                              $MasterProfitWin =  $total - $SAgentProfitWin;
                                              $MasterProfitLose= 0;


                                          }


                                       }


                                } else {
                                // me sigouro kerdos apo to kostos
                                       $SAgentProfitWin = $row['Cost'] * ($SAgentTbl['Commission_tziros'] / 100.0);
                                       $SAgentProfitLose = 0;

                                        // if user profit is zero then the bet is lost
                                       if ($newvalue <= 0){
                                           $MasterProfitWin = $row['Cost'] - $row['AgentProfit'] - $SAgentProfitWin ;
                                           $MasterProfitLose = 0;
                                       } else {

                                          $total = $row['Cost'] - $newvalue - $row['AgentProfit'] - $SAgentProfitWin;
                                          if ($total <= 0 )
                                          {
                                              $MasterProfitWin =  0;
                                              $MasterProfitLose=  abs($total);

                                          } else {

                                              $MasterProfitWin =  $total;
                                              $MasterProfitLose=  0;

                                          }


                                       }


                                }

                                mysql_free_result($result_id2);
                                $sqlquery = "update userbetssynopsis SET  FinalUserProfit=".$newvalue.", SAgentProfitWin=".$SAgentProfitWin.", SAgentProfitLose=".$SAgentProfitLose.", MasterProfitWin=".$MasterProfitWin.", MasterProfitLose=".$MasterProfitLose." where UserBetSynopsisID = ".$record;
                                $result_id = mysql_query($sqlquery);

                            }
                    }


                    echo '200';


                } else if ($column=='Status') {

                        $sqlquery = "update userbetssynopsis SET  Status=".$newvalue." where UserBetSynopsisID = ".$record;
            			$result_id = mysql_query($sqlquery);

                        echo '200';

               } else {

                    echo 'Record not found!';


               }




        }    else if ((strcasecmp($table, "coupons") == 0) && ($column=='edit_de') ) {

                //$sqlquery = "update coupons Set de_1ORX=".$_GET['de_1ORX'].",de_XOR2=".$_GET['de_XOR2'].", de_1OR2=".$_GET['de_1OR2'].", HMI_1=".$_GET['HMI_1'].", HMI_X=".$_GET['HMI_X'].", HMI_2=".$_GET['HMI_2']."  where CouponID=".$record;
                $sqlquery = "update coupons Set de_1ORX=".$_GET['de_1ORX'].",de_XOR2=".$_GET['de_XOR2'].", de_1OR2=".$_GET['de_1OR2']." where CouponID=".$record;
    			$result_id = mysql_query($sqlquery);


         } else {

            //if $newvalue is "create", then the new value is depended from the table that is pointed by $column
            if ($newvalue == "create") {
                $newvalue = 0;
                if ((strcasecmp($column, "ChapionshipID") == 0)) {

                   $result_id = mysql_query("select * from chapionships where CountryID=".$whereID." limit 1;");
                   $row = mysql_fetch_assoc($result_id);
                    if ($row) {
                    	$reclabel = $row["Chapionship"];
                    	$recvalue = $row["ChapionshipID"];
                        $newvalue =   $recvalue;

                    }
                }


            }


            if ( ($column=='Name') || ($column=='Password') ) {

            $t_newvalue = $newvalue;
            if ($t_newvalue[0] == '@')
                 $t_newvalue = substr($t_newvalue, 1);

              if ($column=='Name') {
                  //check to find the same username
                  $sqlquery = "SELECT agents.Name,superagents.Name,masterusers.Name FROM agents,superagents,masterusers WHERE
                   (agents.Name='".$t_newvalue."' ) OR
                   (superagents.Name='".$t_newvalue."' ) OR
                   (masterusers.Name='".$t_newvalue."' );";

                  $result_id = mysql_query($sqlquery);
                  // Check result
                  // This shows the actual query sent to MySQL, and the error. Useful for debugging.
                  if (!$result_id) {
                      $message  = 'Invalid query: ' . mysql_error() . "\n";
                      $message .= 'Whole query: ' . $sqlquery;
                      die($message);
                  }

                  $num_rows = mysql_num_rows($result_id);

                  if($num_rows != NULL)
                  {
                    echo 'userexist';
                    mysql_close($DB);
                    return;
                  }
              }

              $sqlquery = "select Name,Password from ".$table." where ".$primaryKey."=".$record;
  			  $result_id = mysql_query($sqlquery);
              $row = mysql_fetch_assoc($result_id);
              if ($row) {
                  $Password = $row['Password'];
                  $Name=$row['Name'];
              } else {

                  echo 'User not found with recordID='.$record;
                  mysql_close($DB);
                  return;

              }

              //check to find the same username and the same password
              $sqlquery = "SELECT agents.Name,agents.Password,superagents.Name,superagents.Password,masterusers.Name,masterusers.Password FROM agents,superagents,masterusers WHERE
               (agents.Name='".$Name."' AND STRCMP(agents.Password, BINARY '".$t_newvalue."')=0 ) OR
               (superagents.Name='".$Name."' AND STRCMP(superagents.Password, BINARY '".$t_newvalue."')=0) OR
               (masterusers.Name='".$Name."' AND STRCMP(masterusers.Password, BINARY '".$t_newvalue."')=0);";

              $result_id = mysql_query($sqlquery);
              // Check result
              // This shows the actual query sent to MySQL, and the error. Useful for debugging.
              if (!$result_id) {
                  $message  = 'Invalid query: ' . mysql_error() . "\n";
                  $message .= 'Whole query: ' . $sqlquery;
                  die($message);
              }

              $num_rows = mysql_num_rows($result_id);

              if($num_rows != NULL)
              {
                echo 'userexist';

                mysql_close($DB);
                return;
              }

              unset($t_newvalue);

            }


            $r_value=update_single($newvalue, $table, $column, $primaryKey, $record);


            if (!$r_value) {

                    //dont show the errors to user
                    //echo  'update error: '.mysql_error().'<br>';
                    SaveLog(-1,$_SESSION['user/id'],1,$_SERVER['HTTP_USER_AGENT'],'update error: '.mysql_error().' update_sigle('.$newvalue.','.$table.','.$column.','.$primaryKey.','.$record.')' ,'Μη εξουσιοδοτημένη ενημέρωση. Από τη σελίδα ['.$_SESSION['user/pagenavigation'].'] του περιβάλλοντος του.');

            }


            if ( ($table=='coupons') && ($column=='Canceled') && ($r_value) ) {

                $sqlquery = "update userbets Set EventCanceled=".$newvalue." where CouponID=".$record;
    			$result_id = mysql_query($sqlquery);



                $sqlquery = "select UserBetSystemID,UserBetSynopsisID, Events, OddsAnalytic from userbetssystems where Events LIKE CONCAT('%',".$record.",'%')";
    			$result_id = mysql_query($sqlquery);

                while ($row = mysql_fetch_assoc($result_id)) {




                    $Events = explode("|",$row['Events']);
                    $OddsAnalytic = explode("|",$row['OddsAnalytic']);
                    $Odds = 1;


                    for ($i=0;$i<count( $Events );$i++) {



                        if ($Events[$i]==$record) {
                            if ($newvalue==1)
                                $OddsAnalytic[$i]=1;
                            else {

                                $result_id2 = mysql_query("Select BetFactor from userbets where UserBetSynopsisID=".$row['UserBetSynopsisID']." AND CouponID=".$record);
                                $row2 = mysql_fetch_assoc($result_id2);
                                $OddsAnalytic[$i]=$row2['BetFactor'];

                            }


                        }

                        $Odds = $Odds * $OddsAnalytic[$i];

                    }

                $sqlquery = "update userbetssystems SET Odds =".$Odds.", OddsAnalytic='".implode("|",$OddsAnalytic)."' where UserBetSystemID = ".$row['UserBetSystemID'];

    			$result_id2 = mysql_query($sqlquery);

                }

            } else if ( ($table=='userbetssynopsis') && ($column=='Canceled') && ($r_value) ) {

                    $sqlquery = "select cost,AgentID from userbetssynopsis where UserBetSynopsisID=".$record;
        			$result_id = mysql_query($sqlquery);

                    while ($row = mysql_fetch_assoc($result_id)) {

                        if ($newvalue==1) {

                          $sqlquery = "update agents SET Remainder=Remainder+".$row['cost']." where AgentID=".$row['AgentID'];
                          mysql_query($sqlquery);

                        } else {

                          $sqlquery = "update agents SET Remainder=Remainder-".$row['cost']." where AgentID=".$row['AgentID'];
                          mysql_query($sqlquery);

                        }
                    }


            }




            if ( ($reclabel != "") && ($r_value) )
                echo  "{\"DataSet\": {\"totalrecords\":1, \"items\": [{\"value\":".$recvalue.",\"label\":\"".$reclabel."\"}]}}";
            else if ($r_value)
                echo '200';
            else if (!$r_value)
                echo 'Update Failed.';


      }


    }
    else if ($type=="insert") {


            $fields="";
            $data="";


            if ($jsondata != '') {


            	$decoded = json_decode(stripcslashes($jsondata),true);


				  foreach ($decoded as $key => $value) {

                      //remove any non ASCII chars;
                      $value = removeCtrlChars($value);



		              if ( ($key != "appid") && ($key != "query") && ($key != "type") && ($key != "primaryKey") && ($key != "AA") && ($key != "SpecialCouponADDStatus") )
		              {
				  		  $data.="'".$value."',";
		                  $fields.=$key.",";

		                  $response.="\"".$key."\"".":\"".$value."\",";
          			  } else if ($key == "SpecialCouponADDStatus") {
                             // we need this to know where to stop in multiple inserts
                             $SpecialCouponADDStatus = $value;

                      }

				  }



            } else {
            	
            	

		            foreach ($_GET as $key => $value) {

		
		              if ( ($key != "appid") && ($key != "query") && ($key != "type") && ($key != "primaryKey") && ($key != "AA") && ($key != "SpecialCouponADDStatus")   )
		              {

                         //remove any non ASCII chars;
                          $value = removeCtrlChars($value);


		                  $data.="'".$value."',";
		                  $fields.=$key.",";
		
		                  $response.="\"".$key."\"".":\"".$value."\",";
		
		              }

		             }

			}
			
			
            $fields = substr($fields, 0, -1);
            $data = substr($data, 0, -1);
            



            $fields="(".$fields.")";
            $data="(".$data.")";


            //check to see if the agent already exists in the database
            //if yes return with error.
            if ($table=='agents' || $table=='superagents' || $table=='masterusers'){


              //check to find the same username
              $sqlquery = "SELECT agents.Name,superagents.Name,masterusers.Name FROM agents,superagents,masterusers WHERE
               (agents.Name='".$_GET['Name']."' ) OR
               (superagents.Name='".$_GET['Name']."' ) OR
               (masterusers.Name='".$_GET['Name']."' );";

              $result_id = mysql_query($sqlquery);
              // Check result
              // This shows the actual query sent to MySQL, and the error. Useful for debugging.
              if (!$result_id) {
                  $message  = 'Invalid query: ' . mysql_error() . "\n";
                  $message .= 'Whole query: ' . $sqlquery;
                  die($message);
              }

              $num_rows = mysql_num_rows($result_id);

              if($num_rows != NULL)
              {
                echo 'userexist';
                mysql_close($DB);
                return;
              }



              //check to find the same username and the same password
              $sqlquery = "SELECT agents.Name,agents.Password,superagents.Name,superagents.Password,masterusers.Name,masterusers.Password FROM agents,superagents,masterusers WHERE
               (agents.Name='".$_GET['Name']."' AND STRCMP(agents.Password, BINARY '".$_GET['Password']."')=0 ) OR
               (superagents.Name='".$_GET['Name']."' AND STRCMP(superagents.Password, BINARY '".$_GET['Password']."')=0) OR
               (masterusers.Name='".$_GET['Name']."' AND STRCMP(masterusers.Password, BINARY '".$_GET['Password']."')=0);";

              $result_id = mysql_query($sqlquery);
              // Check result
              // This shows the actual query sent to MySQL, and the error. Useful for debugging.
              if (!$result_id) {
                  $message  = 'Invalid query: ' . mysql_error() . "\n";
                  $message .= 'Whole query: ' . $sqlquery;
                  die($message);
              }

              $num_rows = mysql_num_rows($result_id);

              if($num_rows != NULL)
              {
                echo 'userexist';
                mysql_close($DB);
                return;
              }


            }

            $sqlquery = "INSERT INTO ".$table." ".$fields." VALUES ".$data.";";


            $result_id = mysql_query($sqlquery);
            if (!isset($SpecialCouponADDStatus))
                $SpecialCouponADDStatus = "Undefined";

            // get the last auto incremented value
            $lastItemID = mysql_insert_id();
            $response.="\"".$_GET['primaryKey']."\"".":\"".$lastItemID."\"";
            $response.=",\"SpecialCouponADDStatus\":\"".$SpecialCouponADDStatus."\"";
            $response = "{".$response."}";

           echo  $response;

       // Stored Procedures
      }else if ($type=="sp") {

          if ($table=='coupons') {

                $sqlquery = "call sp_UpdateBets(".$record.",'".$_GET['halftime']."','".$_GET['fulltime']."')";
                $result_id = mysql_query($sqlquery);

                // Check result
                // This shows the actual query sent to MySQL, and the error. Useful for debugging.
                if (!$result_id) {
                    $message  = 'Invalid query: ' . mysql_error() . "\n";
                    $message .= 'Whole query: ' . $sqlquery;
                    echo  $message;
                } else {

                    echo  "200";

                }




          }

      }else if ($type=="moneytrans") {



                $sqlquery = "select superagents.Remainder as sr,agents.Remainder as ar from superagents, agents where superagents.SAgentID=".$_SESSION['user/id'].' and superagents.SAgentID=agents.SAgentID and agents.AgentID='.$record;
                $result_id = mysql_query($sqlquery);

                // Check result
                // This shows the actual query sent to MySQL, and the error. Useful for debugging.
                if (!$result_id) {
                    $message  = 'Invalid query: ' . mysql_error() . "\n";
                    $message .= 'Whole query: ' . $sqlquery;
                    echo  $message;

                } else {
                    $row = mysql_fetch_assoc($result_id);

                    if ($row) {
                        //get money from agent and put them to super agent
                        if ( $newvalue < 0 ) {
                            $Remainder = floatval($row['ar']) + floatval($newvalue);
                            if ( $Remainder >= 0 ) {

                                $sqlquery = 'update agents set Remainder='.$Remainder.' Where agents.AgentID='.$record;
                                mysql_query($sqlquery);

                                $Remainder = floatval($row['sr']) - floatval($newvalue);
                                $sqlquery = 'update superagents set Remainder='.$Remainder.' Where superagents.SAgentID='.$_SESSION['user/id'];
                                mysql_query($sqlquery);


                            } else {
                                //total $Remainder under 0
                                echo '202';
                            }


                        } else {
                            //get money from super agent and put them to  agent
                            $Remainder = floatval($row['sr']) - floatval($newvalue);
                            if ( $Remainder >= 0 ) {

                                $sqlquery = 'update superagents set Remainder='.$Remainder.' Where superagents.SAgentID='.$_SESSION['user/id'];
                                mysql_query($sqlquery);

                                $Remainder = floatval($row['ar']) + floatval($newvalue);

                                $sqlquery = 'update agents set Remainder='.$Remainder.' Where agents.AgentID='.$record;
                                mysql_query($sqlquery);


                            } else {
                                //total $Remainder under 0
                                echo '202';
                            }
                        }

                         echo  "200";
                    } else {
                         //not found
                         echo  "201";

                    }



                }

      }else {

        echo 'Error. No database query type found.';
        $sqlquery = "Insert errorreport set RegDate='".GR_Time('Y-m-d H:i:s',time())."', UserBetSynopsisID=-1, AgentID=-1, BrowserInfo='".$_SERVER['HTTP_USER_AGENT']."', Description='Error. No database query type found. QueryString --> ".$_SERVER[QUERY_STRING]."'";
        $result_id = mysql_query($sqlquery);

    }







} else {

    echo "Authorization Error : Unknown application";
    $sqlquery = "Insert errorreport set RegDate='".GR_Time('Y-m-d H:i:s',time())."', UserBetSynopsisID=-1, AgentID=-1, BrowserInfo='".$_SERVER['HTTP_USER_AGENT']."', Description='Authorization Error : Unknown application. QueryString --> ".$_SERVER[QUERY_STRING]."'";
    $result_id = mysql_query($sqlquery);


}


    mysql_close($DB);

?>