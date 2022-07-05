<?php
 session_start();
  include 'database.php';
  include 'functions.php';


  date_default_timezone_set("Europe/Athens");



$appid=addslashes(html_entity_decode($_GET['appid']));
$table=addslashes(html_entity_decode($_GET['query']));
$type=addslashes(html_entity_decode($_GET['type']));
$record=addslashes(html_entity_decode($_GET['id']));
$primaryKey=addslashes(html_entity_decode($_GET['primaryKey']));
$column=addslashes(html_entity_decode($_GET['column']));
$newvalue=addslashes(html_entity_decode($_GET['newvalue']));
$output=addslashes(html_entity_decode($_GET['output']));
$whereID=addslashes(html_entity_decode($_GET['whereID']));
$jsondata=addslashes(html_entity_decode($_GET['jsondata']));
$cascade=addslashes(html_entity_decode($_GET['cascade']));





    //enable the Stored Procedures calls
    $DB = mysql_connect(MySQLIP, Username, Password,false,65536) or die(mysql_error());

    mysql_select_db(DataBase, $DB) or die(mysql_error());
	mysql_query("SET NAMES 'utf8'");

    $querystring = ($_SERVER['QUERY_STRING']);
    $querystring=(addslashes($querystring));
    //echo $querystring;
      //log anything

    //*****************************************************
    //  User Error Codes
    // -1:Unkown_Guest_MainScreen, -2:Unknown_Guest_MainScreen_Coupon/Results, -3:No_Session_userID
    //
    //  Warning Levels
    //  0:No_Warning, 1:forbidden update , 2:forbidden delete , 3:forbidden insert , 4:forbidden select , 5:Unknown user ID
    //  6:query_string_command
    //*****************************************************
     if ( $_SESSION["user/id"] == "")
     {

        $Description = 'LogQuery    ExternalQueryString=['.$querystring.']';
        SaveLog(-1,-1,6,$_SERVER['HTTP_USER_AGENT'],$Description,'Προειδοποίηση ! Χρήστης προσπάθησε να πληκτρολογήσει στη γραμμή διεύθυνσης μη εξουσιοδοτημένο κώδικα.');
        die('Unathorized error 6.');
     }
     else
     {
          $Description = 'User Navigation   QueryString=['.$querystring.'], appid=['.$appid.'], table=['.$table.'], type=['.$type.'], record=['.$record.'], primaryKey=['.$primaryKey.'], column=['.$column.'], newvalue=['.$newvalue.'], output=['.$output.'], whereID=['.$whereID.'], jsondata=['.$jsondata.'], cascade=['.$cascade.']';
         //**************************************************************************************************************
         //The following piece of code can be disabled since its not a warning but a normal use of an authorized user.
         //**************************************************************************************************************

         switch ($type) {
            case 'select' : $type_gr = 'προβολή';break;
            case 'delete' : $type_gr = 'διαγραφή';break;
            case 'update' : $type_gr = 'ενημέρωση';break;
            case 'insert' : $type_gr = 'εισαγωγή';break;
            default  : $type_gr = $type;break;

         }

         if ($_SESSION['user/id']=="guest") {
             $_SESSION['user/id']=-2;
             SaveLog(-1,$_SESSION['user/id'],0,$_SERVER['HTTP_USER_AGENT'],$Description,'Πλοήγηση επισκέπτη σε μία από τις κεντρικές σελίδες ['.$_SESSION['user/pagenavigation'].']Tύπος ενέργειας='.$type_gr.', Πίνακας='.$table);
         } else
            SaveLog(-1,$_SESSION['user/id'],0,$_SERVER['HTTP_USER_AGENT'],$Description,'Πλοήγηση χρήστη στη σελίδα ['.$_SESSION['user/pagenavigation'].'] του περιβάλλοντος του.Tύπος ενέργειας='.$type_gr.', Πίνακας='.$table);

         if ($_SESSION['user/id']==-2)
             $_SESSION['user/id']="guest";
     }




    //update Lastlogin for current session to be accurate for Online user report
    if (( $_SESSION["user/id"] != "") && ( $_SESSION["user/id"] != "guest") ){

        $sqlquery = '';
        if ($_SESSION["user/level"] == "agents")
            $sqlquery = ("UPDATE agents SET Lastlogin='".GR_Time("Y-m-d H:i:s",time())."', session='".session_id()."' WHERE AgentID=".$_SESSION["user/id"]." LIMIT 1");
        else if ($_SESSION["user/level"] == "superagents")
            $sqlquery = ("UPDATE superagents SET Lastlogin='".GR_Time("Y-m-d H:i:s",time())."', session='".session_id()."' WHERE SAgentID=".$_SESSION["user/id"]." LIMIT 1");
        else if  ($_SESSION["user/level"] == "master")
            $sqlquery = ("UPDATE master SET Lastlogin='".GR_Time("Y-m-d H:i:s",time())."', session='".session_id()."' WHERE masterID=".$_SESSION["user/id"]." LIMIT 1");
        if ($sqlquery != '')
            $result = mysql_query($sqlquery);
    }







     //do some checks

     if ( $_SESSION["user/id"] == ""){


         $Description = 'Unathorized error 5 (Unknown user ID)    QueryString=['.$querystring.'], appid=['.$appid.'], table=['.$table.'], type=['.$type.'], record=['.$record.'], primaryKey=['.$primaryKey.'], column=['.$column.'], newvalue=['.$newvalue.'], output=['.$output.'], whereID=['.$whereID.'], jsondata=['.$jsondata.'], cascade=['.$cascade.']';
         SaveLog(-1,-3,5,$_SERVER['HTTP_USER_AGENT'],$Description,'Προειδοποίηση ! Χρήστης που δεν έκανε login προσπάθησε να δεί εξουσιοδοτημένο περιεχόμενο.');


         mysql_close($DB);


        die('Unathorized error 5.');


     }

    if ( ( $_SESSION["user/level"] == "agents") || ( $_SESSION["user/level"] == "superagents") || ($_SESSION['user/id']=="guest") ) {

       if   (strcasecmp($type,"update")==0) {

            if ( ($table=="coupons") || ($table=="userbetssynopsis") || ($table=="userbetssystems")
                    || ($table=="userbetsmoney") || ($table=="userbets") || ($table=="teams") || ($table=="superagentsprojection")
                    || ($table=="news") || ($table=="masterusers") || ($table=="master")
                    || ($table=="errorreport") || ($table=="countries") || ($table=="chapionships") || ($table=="master")
                    || ($column=="Mona") || ($column=="Dipla") || ($column=="Triades") || ($column=="Systems")
                    || ($column=="LastLogin") || ($column=="Active") || ($column=="session")
                    || ($column=="cookie") || ($column=="ip") || ($column=="Active") || ($column=="ShutDownEnabled") || ($column=="RegDate")

                     )
                    {
                           if ($_SESSION['user/id']=="guest") {
                               $_SESSION['user/id']=-2;
                               $_SESSION["user/level"]="guest";
                           }


                           $Description = 'Unathorized error 1 (forbidden update)  AgentType='.$_SESSION["user/level"].',   QueryString=['.$querystring.'], appid=['.$appid.'], table=['.$table.'], type=['.$type.'], record=['.$record.'], primaryKey=['.$primaryKey.'], column=['.$column.'], newvalue=['.$newvalue.'], output=['.$output.'], whereID=['.$whereID.'], jsondata=['.$jsondata.'], cascade=['.$cascade.']';
                           SaveLog(-1,$_SESSION['user/id'],1,$_SERVER['HTTP_USER_AGENT'],$Description,'Προειδοποίηση ! Χρήστης που δεν έχει τα απαραίτητα δικαιώματα προσπάθησε να τροποποιήσει εξουσιοδοτημένο περιεχόμενο.');

                           if ($_SESSION['user/id']==-2) {
                               $_SESSION['user/id']="guest";
                               unset($_SESSION["user/level"]);
                           }


                           mysql_close($DB);


                            die("Unathorized error 1");

                    }

       }

       if   (strcasecmp($type,"delete")==0)   {

            if ( ($table=="coupons") || ($table=="userbetssynopsis") || ($table=="userbetssystems")
                    || ($table=="userbetsmoney") || ($table=="userbets") || ($table=="teams") || ($table=="superagentsprojection")
                    || ($table=="news") || ($table=="masterusers") || ($table=="master")  || ($table=="agents") || ($table=="superagents")
                    || ($table=="errorreport") || ($table=="countries") || ($table=="chapionships")  ) {

                           if ($_SESSION['user/id']=="guest") {
                               $_SESSION['user/id']=-2;
                               $_SESSION["user/level"]="guest";
                           }

                           $Description = 'Unathorized error 2 (forbidden delete) AgentType='.$_SESSION["user/level"].'   QueryString=['.$querystring.'], appid=['.$appid.'], table=['.$table.'], type=['.$type.'], record=['.$record.'], primaryKey=['.$primaryKey.'], column=['.$column.'], newvalue=['.$newvalue.'], output=['.$output.'], whereID=['.$whereID.'], jsondata=['.$jsondata.'], cascade=['.$cascade.']';
                           SaveLog(-1,$_SESSION['user/id'],2,$_SERVER['HTTP_USER_AGENT'],$Description,'Προειδοποίηση ! Χρήστης που δεν έχει τα απαραίτητα δικαιώματα προσπάθησε να διαγράψει εξουσιοδοτημένο περιεχόμενο.');

                           if ($_SESSION['user/id']==-2) {
                               $_SESSION['user/id']="guest";
                               unset($_SESSION["user/level"]);
                           }


                           mysql_close($DB);


                            die('Unathorized error 2.');

                    }

       }

       if   (strcasecmp($type,"insert")==0)  {

            if ( ($table=="coupons") || ($table=="userbetssynopsis") || ($table=="userbetssystems")
                    || ($table=="userbetsmoney") || ($table=="userbets") || ($table=="teams") || ($table=="superagentsprojection")
                    || ($table=="news") || ($table=="masterusers") || ($table=="master")  || ($table=="superagents")
                    || ($table=="errorreport") || ($table=="countries") || ($table=="chapionships")


                    ) {


                           if ($_SESSION['user/id']=="guest") {
                               $_SESSION['user/id']=-2;
                               $_SESSION["user/level"]="guest";
                           }

                           $Description = 'Unathorized error 3 (forbidden insert) AgentType='.$_SESSION["user/level"].'   QueryString=['.$querystring.'], appid=['.$appid.'], table=['.$table.'], type=['.$type.'], record=['.$record.'], primaryKey=['.$primaryKey.'], column=['.$column.'], newvalue=['.$newvalue.'], output=['.$output.'], whereID=['.$whereID.'], jsondata=['.$jsondata.'], cascade=['.$cascade.']';
                           SaveLog(-1,$_SESSION['user/id'],3,$_SERVER['HTTP_USER_AGENT'],$Description,'Προειδοποίηση ! Χρήστης που δεν έχει τα απαραίτητα δικαιώματα προσπάθησε να εισαγάγει δεδομένα σε εξουσιοδοτημένο περιεχόμενο.');

                           if ($_SESSION['user/id']==-2) {
                               $_SESSION['user/id']="guest";
                               unset($_SESSION["user/level"]);
                           }


                           mysql_close($DB);


                            die('Unathorized error 3.');

                    }

       }

       if   (strcasecmp($type,"select")==0)  {

            if (  ($table=="superagentsprojection") || ($table=="masterusers") || ($table=="master") || ($table=="errorreport")
                   || ($column=="session") || ($column=="cookie") || ($column=="ip") || ($column=="Active") || ($column=="ShutDownEnabled")

            ) {


                           if ($_SESSION['user/id']=="guest") {
                               $_SESSION['user/id']=-2;
                               $_SESSION["user/level"]="guest";
                           }

                           $Description = 'Unathorized error 4 (forbidden select) AgentType='.$_SESSION["user/level"].'   QueryString=['.$querystring.'], appid=['.$appid.'], table=['.$table.'], type=['.$type.'], record=['.$record.'], primaryKey=['.$primaryKey.'], column=['.$column.'], newvalue=['.$newvalue.'], output=['.$output.'], whereID=['.$whereID.'], jsondata=['.$jsondata.'], cascade=['.$cascade.']';
                           SaveLog(-1,$_SESSION['user/id'],4,$_SERVER['HTTP_USER_AGENT'],$Description,'Προειδοποίηση ! Χρήστης που δεν έχει τα απαραίτητα δικαιώματα προσπάθησε να δει δεδομένα με εξουσιοδοτημένο περιεχόμενο.');

                           if ($_SESSION['user/id']==-2) {
                               $_SESSION['user/id']="guest";
                               unset($_SESSION["user/level"]);
                           }


                           mysql_close($DB);


                           die('Unathorized error 4.');

                    }

       }

    }





     mysql_close($DB);



/* yadl_spaceid - Skip Stamping */

// Yahoo! proxy

// Hard-code hostname and path:
define ('PATH', 'http://localhost/lackybet/includes/managedata.php');
//define ('PATH', 'http://www.velvetbet.com/includes/managedata.php');

//$type = "text/plain";
$type = "application/json";

// Get all query params
$query = "?";
foreach ($_GET as $key => $value) {
    if(($key == "output") && ($value == "json")) {
        $type = "application/json";
    }
    $query .= urlencode($key)."=".urlencode($value)."&";
}




foreach ($_POST as $key => $value) {
    if(($key == "output") && ($value == "json")) {
        $type = "application/json";
    }
    $query .= $key."=".$value."&";
}
$query .= "appid=VelvetBet123456789!";
$url = PATH.$query;

$strCookie = 'PHPSESSID=' . $_COOKIE['PHPSESSID'] . '; path=/';
session_write_close();

// Open the Curl session
$session = curl_init($url);

// Don't return HTTP headers. Do return the contents of the call
curl_setopt($session, CURLOPT_HEADER, false);
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
curl_setopt($session, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($session, CURLOPT_COOKIE, $strCookie );

// Make the call
$response = curl_exec($session);

header("Content-Type: ".$type);
echo $response;
curl_close($session);


if ($_SESSION['user/id']=="guest") {
    unset($_SESSION['user/id']);
}
?>
