<?php
    include '../includes/database.php';
    include '../includes/login.php';
    include_once ('../includes/functions.php');
    include '../includes/statistics.php';
    session_start();

     $DB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
     mysql_select_db(DataBase, $DB) or die(mysql_error());
     mysql_query("SET NAMES 'utf8'");

     if ( (!check_login('agents')) && (!check_login('superagents')) )  {

            mysql_close($DB);
            header( 'Location: ../index.php' );
     }



    SaveLog(-1,$_SESSION['user/id'],0,$_SERVER['HTTP_USER_AGENT'],'User Logout','Έξοδος χρήστη από το σύστημα.');

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

    mysql_close($DB);
    header( 'Location: ../index.php' ) ;

?>