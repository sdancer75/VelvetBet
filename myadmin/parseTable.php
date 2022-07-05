<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE>VelvetBet - Στοιχήματα Ποδοσφαίρου</TITLE>
<?php include '../includes/metatagsgr.php' ?>

</HEAD>

<?php

$SpyResultArray =array();




  // new dom object
  $dom = new DOMDocument();

  //load the html
  $ER = error_reporting(0);
  //$html = $dom->loadHTMLfile('https://www.goalbetint.com/coupon_FOOTBALL.php');
  //$html = $dom->loadHTMLfile('http://www.unblock-web.com/index.php?q=aHR0cHM6Ly93d3cuZ29hbGJldGludC5jb20vY291cG9uX0ZPT1RCQUxMLnBocA%3D%3D&hl=3ed');
  $html = $dom->loadHTMLfile('../grafix/coupon.htm');
  error_reporting($ER);

  //discard white space
  $dom->preserveWhiteSpace = false;

  //the table by its tag name
  $tables = $dom->getElementsByTagName('table');
  echo var_dump($html);
  //get all rows from the table
  $rows = $tables->item(0)->getElementsByTagName('tr');
  echo var_dump($rows);

  // loop over the table rows
  $arr_count=0;
  foreach ($rows as $row) {
   // get each column by tag name
      $cols = $row->getElementsByTagName('td');



      if ( ($cols->length >= 16) and ($cols->item(3)->nodeValue != '-') ) {


          $SpyResultArray[$arr_count][0]=$cols->item(0)->nodeValue; //chapionship
          $SpyResultArray[$arr_count][1]=$cols->item(1)->nodeValue; //time
          $SpyResultArray[$arr_count][2]=$cols->item(3)->nodeValue; //code
          $SpyResultArray[$arr_count][3]=$cols->item(4)->nodeValue; //ee
          $SpyResultArray[$arr_count][4]=$cols->item(5)->nodeValue; //goal_1
          $SpyResultArray[$arr_count][5]=$cols->item(6)->nodeValue; //team_home
          $SpyResultArray[$arr_count][6]=$cols->item(7)->nodeValue; //goal_x
          $SpyResultArray[$arr_count][7]=$cols->item(8)->nodeValue; //team_host
          $SpyResultArray[$arr_count][8]=$cols->item(9)->nodeValue; //goal_2

          $SpyResultArray[$arr_count][9]=$cols->item(10)->nodeValue; //de_1ORX
          $SpyResultArray[$arr_count][10]=$cols->item(11)->nodeValue; //de_XOR2
          $SpyResultArray[$arr_count][11]=$cols->item(12)->nodeValue; //de_1OR2
          $SpyResultArray[$arr_count][12]=$cols->item(13)->nodeValue; //under
          $SpyResultArray[$arr_count][13]=$cols->item(14)->nodeValue; //over
          $SpyResultArray[$arr_count][14]=$cols->item(15)->nodeValue; //GG
          $SpyResultArray[$arr_count][15]=$cols->item(16)->nodeValue; //NG


          $arr_count++;


      }


    }



    for ($i=0;$i<=sizeof($SpyResultArray);$i++){

        echo $SpyResultArray[$i][0]." ".$SpyResultArray[$i][1]." ".$SpyResultArray[$i][2]."<br>";

    }







/*

$dom = new DomDocument();
$ER = error_reporting(0);

$dom->loadHTMLFile("https://www.goalbetint.com/coupon_FOOTBALL.php");
error_reporting($ER);

//$dom->loadHTMLFile("file://c:/download/GoalBetint.htm");

$titles = $dom->getElementsByTagName("table");
foreach($titles as $node) {
   $value = $node->textContent;
echo  $value;
}
*/

?>

</HTML>

