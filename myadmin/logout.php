<?php
    session_start();
    include '../includes/database.php';
    include '../includes/login.php';
    include_once ('../includes/functions.php');
    include '../includes/statistics.php';


     $LoginMsg = '';
     $DB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
     mysql_select_db(DataBase, $DB) or die(mysql_error());
     mysql_query("SET NAMES 'utf8'");

    if (!check_login('masterusers') )
        header( 'Location: ../index.php' ) ;


    SaveLog(-1,$_SESSION['user/id'],0,$_SERVER['HTTP_USER_AGENT'],'User Logout','Έξοδος χρήστη από το σύστημα.');

    $sqlquery = "DELETE FROM coupons where DATEDIFF('".GR_Time('Y-m-d',time())."',Date) >= 15";
    $result_id = mysql_query($sqlquery);
    // Check result
    // This shows the actual query sent to MySQL, and the error. Useful for debugging.
    if (!$result_id) {
        $message  = 'Invalid query: ' . mysql_error() . "<br>";
        $message .= 'Whole query: ' . $sqlquery;
        echo  $message."<br><br>";
    }

    $sqlquery = "DELETE FROM userbets WHERE UserBetSynopsisID IN (SELECT UserBetSynopsisID FROM userbetssynopsis where DATEDIFF('".GR_Time('Y-m-d',time())."',DateTime) >= 15)";
    $result_id = mysql_query($sqlquery);
    // Check result
    // This shows the actual query sent to MySQL, and the error. Useful for debugging.
    if (!$result_id) {
        $message  = 'Invalid query: ' . mysql_error() . "<br>";
        $message .= 'Whole query: ' . $sqlquery;
        echo  $message."<br><br>";
    }

    $sqlquery = "DELETE FROM userbetsmoney WHERE UserBetSynopsisID IN (SELECT UserBetSynopsisID FROM userbetssynopsis where DATEDIFF('".GR_Time('Y-m-d',time())."',DateTime) >= 15)";
    $result_id = mysql_query($sqlquery);
    // Check result
    // This shows the actual query sent to MySQL, and the error. Useful for debugging.
    if (!$result_id) {
        $message  = 'Invalid query: ' . mysql_error() . "<br>";
        $message .= 'Whole query: ' . $sqlquery;
        echo  $message."<br><br>";
    }

    $sqlquery = "DELETE FROM userbetssystems WHERE UserBetSynopsisID IN (SELECT UserBetSynopsisID FROM userbetssynopsis where DATEDIFF('".GR_Time('Y-m-d',time())."',DateTime) >= 15)";
    $result_id = mysql_query($sqlquery);
    // Check result
    // This shows the actual query sent to MySQL, and the error. Useful for debugging.
    if (!$result_id) {
        $message  = 'Invalid query: ' . mysql_error() . "<br>";
        $message .= 'Whole query: ' . $sqlquery;
        echo  $message."<br><br>";
    }

    $sqlquery = "DELETE FROM guestsip where DATEDIFF('".GR_Time('Y-m-d',time())."',VisitDateTime) > 2";
    $result_id = mysql_query($sqlquery);
    // Check result
    // This shows the actual query sent to MySQL, and the error. Useful for debugging.
    if (!$result_id) {
        $message  = 'Invalid query: ' . mysql_error() . "<br>";
        $message .= 'Whole query: ' . $sqlquery;
        echo  $message."<br><br>";
    }

    $sqlquery = "DELETE FROM errorreport where DATEDIFF('".GR_Time('Y-m-d',time())."',RegDate) > 15";
    $result_id = mysql_query($sqlquery);
    // Check result
    // This shows the actual query sent to MySQL, and the error. Useful for debugging.
    if (!$result_id) {
        $message  = 'Invalid query: ' . mysql_error() . "<br>";
        $message .= 'Whole query: ' . $sqlquery;
        echo  $message."<br><br>";
    }


    mysql_close($DB);



    if (isset($_SESSION['user/id'])) {

        remove_session("user/level");
        remove_session("user/id");
        remove_session("user/session");
        remove_session("user/lastlogin");
        remove_session("user/cookie");
        remove_session("user/ip");
        remove_session("user/given_name");
        setcookie('remember_me', $_SESSION['user/cookie'], time() - 3600, '/');


        session_destroy();
    }



    header( 'Location: ../index.php' ) ;

?>