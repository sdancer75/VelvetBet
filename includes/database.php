<?php
/*
  mysql_connect($host, $user, $password, true, 65536); //enable the Stored Procedures calls


  delimiter //
  CREATE PROCEDURE Sample(IN userID INT, OUT userName VARCHAR(20))
  BEGIN
  SELECT UserName INTO userName FROM TblUsers WHERE UserID=userID;
  END

  Here is the PHP code. MYSQL: calling sp with out variables.

  $rs = mysql_query( "CALL getCountry(1, @userName)" );
  $rs = mysql_query( "SELECT @userName" );
  while($row = mysql_fetch_assoc($rs))
  {
  echo $row['@userName'];
  }

  define("MySQLIP", "mysql5.s701.sureserver.com:3307");
  define("Username", "sdancer75");
  define("Password", "gpapa300");
  define("DataBase", "paradox_royalbet");
  */
  define("MySQLIP", "127.0.0.1");
  define("Username", "root");
  define("Password", "");
  define("DataBase", "lackybet");

  
?>