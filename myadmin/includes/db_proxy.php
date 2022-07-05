<?php
    require_once ('includes/ajaxServices.php');
    mysql_connect("localhost", "root", "") or die(mysql_error());
    mysql_select_db("lackybet") or die(mysql_error());
    /*
    $result = mysql_query('select country as country from countries order by CountryID');

    while($row = mysql_fetch_array($result )) {
        echo $row['country'];

    }
    */
    ajaxReq();

    function ajax_DataTable_Select() {
        result = mysql_query('select country as country from countries order by CountryID') or ajaxReply(500,'SQL error '  . mysql_error());


    }

?>