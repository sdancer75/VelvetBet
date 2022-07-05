<?php
 session_start();
    include_once ('database.php');
    include_once ('functions.php');
    include_once ('statistics.php');


    date_default_timezone_set("Europe/Athens");




      /*****************************************************************************
      check_login

      returns : true if login is successful
                false if login failed

      *****************************************************************************/
      // I've already sanitized all GET, POST, and COOKIE data at this point.

      function check_login($table) {

      global $LoginMsg;
      mysql_query("SET NAMES 'utf8'"); 


       if ($_SESSION["user/id"]=="guest")
           remove_session("user/id");



        $login_justnow=false;
        $LoginMsg = '';

        if ($table=="agents")
            $RecordID = 'AgentID';
        else if ($table=="superagents")
            $RecordID = 'SAgentID';
        else if ($table=='masterusers')
            $RecordID = 'MasterID';

        // if the user isn't logged in and they're POSTing a login request, process it
        if(!get_session('user/id') && isset($_POST['submitted']) ) {
          $name=$_POST['login_name'];
          $remember_me=isset($_POST['remember_me'])?1:0;
          $pass=($_POST['login_pass']);

          $sqlquery = ("SELECT ".$RecordID.",ShutDownEnabled FROM ".$table." WHERE Name='$name' AND STRCMP(Password, BINARY '".$pass."')=0 AND Active=1 ");
          $result= mysql_query($sqlquery);
          $row = mysql_fetch_assoc($result);
          if ($row){

              if ($row['ShutDownEnabled']==0)
                  $user_id = $row[$RecordID];
          }

          if(isset($user_id)) {
            account_login($user_id,$table,$RecordID,$remember_me);
            $login_justnow=true;
            $name=get_session("user/given_name") ? ', '.get_session("user/given_name") : '';
            return true;

          } else {

            if  ($row['ShutDownEnabled']==0) {

                $sqlquery = ("UPDATE ".$table." SET FailedLogins=FailedLogins+1 WHERE Name='$name' LIMIT 1");
                $result = mysql_query($sqlquery);

                $sqlquery = ("SELECT FailedLogins From ".$table." WHERE Name='$name' LIMIT 1");
                $result = mysql_query($sqlquery);
                $row = mysql_fetch_assoc($result);
                if ($row) {

                  $FailedLogins = $row['FailedLogins'];
                  If ($FailedLogins > 3) {
                     $sqlquery = ("UPDATE ".$table." SET Active=0 WHERE Name='$name' LIMIT 1");
                     $result = mysql_query($sqlquery);

                     $Description = 'User account '.$name.' is suspended after a failed login from group '.$table.'.';
                     SaveLog(-1,-3,200,$_SERVER['HTTP_USER_AGENT'],$Description,'Προειδοποίηση ! Ο χρήστης με το όνομα '.$name.' και επίπεδο '.$table.', απέτυχε να δώσει το σωστό κωδικό για 3 συνεχόμενες φορές και ο λογαριασμός του απενεργοποιήθηκε.');
                  }

                }


                $LoginMsg="<span style=\"color:#FF2F2F;font-weight: bold\">".
                          "<img src=\"grafix/cancel.png\" width=\"16\" height=\"16\" align=\"absmiddle\" border=\"0\" hspace=\"2\" alt=\"error\">".
                          "Λάθος συνδυασμός χρήστη/κωδικού".
                          "</span>";

            } else {

                $LoginMsg="<span style=\"color:#FF2F2F;font-weight: bold\">".
                          "<img src=\"grafix/alert.gif\" width=\"16\" height=\"16\" align=\"absmiddle\" border=\"0\" hspace=\"2\" alt=\"maintance\">".
                          "Γίνεται συντήρηση του συστήματος.<br>Παρακαλώ προσπαθήστε αργότερα.".
                          "</span>";

            }


            return false;
          }
        }

        // if the user isn't logged in but has a COOKIE, process it
        if(!get_session("user/id") && isset($_COOKIE["remember_me"]) ) {
          list($user_id,$cookie_code)=@unserialize(stripslashes($_COOKIE["remember_me"]));
          if(isset($user_id) && isset($cookie_code)) {
            $cookie=md5($cookie_code);


            $sqlquery = ("SELECT * FROM ".$table." WHERE ".$RecordID."='$user_id' AND cookie='$cookie' AND active=1 LIMIT 1");
            $result= mysql_query($sqlquery);
            $row = mysql_fetch_row($result);
            if($row) {
              account_login($user_id,$table,$RecordID,true);
              $login_justnow=true;
              $name=get_session("user/given_name")?', '.get_session("user/given_name"):'';
              return true;

            } else {

              $LoginMsg="<span style=\"color:#FF2F2F;font-weight: bold\">".
                        "<img src=\"grafix/cancel.png\" width=\"16\" height=\"16\" align=\"absmiddle\" border=\"0\" hspace=\"2\" alt=\"error\">".
                        "Λάθος cookie. Δοκιμάστε ξανά.".
                        "</span>";
                account_logout();
                return false;

            }
          }
        }


        //if the user's session says they're logged in, process it
        if(get_session("user/id") && ($login_justnow===false)) {




          $user_id=get_session("user/id");
          $cookie=get_session("user/cookie");
          $ip=get_session("user/ip");
          $session=session_id();


          $sqlquery = "SELECT * FROM ".$table." WHERE ".$RecordID."='$user_id' AND ip='$ip' AND session='$session' AND cookie='$cookie' AND active=1 LIMIT 1";
          $result= mysql_query($sqlquery);
          $row = mysql_fetch_row($result);

          if($row) {
              account_login($user_id,$table,$RecordID,false);
              return true;
          } else {
            $LoginMsg="<span style=\"color:#FF2F2F;font-weight: bold\">".
                      "<img src=\"grafix/cancel.png\" width=\"16\" height=\"16\" align=\"absmiddle\" border=\"0\" hspace=\"2\" alt=\"error\">".
                      "Βρέθηκε ανοιχτό session. Κλείστε τον φυλλομετρητή και δοκιμάστε ξανά.".
                      "</span>";

             //account_logout(); //we are looking with this series master-agents-super agents. In this case if sagent is trying to login
                                //then in the next login check the agent check will logout the sagent
              return false;

          }

        }

        // check if the user actually has rights to this part of the site - your implementation may vary

       return false;
      }

      function account_logout() {

            remove_session("user/level");
            remove_session("user/id");
            remove_session("user/session");
            remove_session("user/lastlogin");
            remove_session("user/cookie");
            remove_session("user/ip");
            remove_session("user/given_name");
            setcookie('remember_me', get_session("user/cookie"), time() - 3600, '/');


      };

      function account_login($user_id,$table,$RecordID,$remember_me) {


        // update cookie
        if($remember_me==true) {
          $cookie_code=generate_random_string();
          $cookie_str=serialize(array($user_id, $cookie_code));
          setcookie('remember_me', $cookie_str, time() + 60*60*24*30, '/');
          add_session("user/cookie",$cookie_code);
        } else {
          remove_session("user/cookie");
        }

        // update session security
        $ip=$_SERVER['REMOTE_ADDR'];
        $session=session_id();
        $cookie_code=get_session("user/cookie");
        $cookie=md5($cookie_code);


        $sqlquery = ("UPDATE ".$table." SET FailedLogins=0, Lastlogin='".GR_Time('Y-m-d H:i:s',time())."', session='$session'".(($cookie_code!='') ? ", cookie='".$cookie."'" : "").", ip='$ip' WHERE ".$RecordID."='$user_id' LIMIT 1");
        $result = mysql_query($sqlquery);

        // update session info

        $sqlquery=("SELECT ".$RecordID.",Name,Lastlogin,session,cookie,ip FROM ".$table." WHERE ".$RecordID."='$user_id' LIMIT 1");
        $result = mysql_query($sqlquery);
        $row = mysql_fetch_assoc($result);
        if ($row) {

            add_session("user/level",$table);
            add_session("user/id",$row[$RecordID]);
            add_session("user/session",$row['session']);
            add_session("user/lastlogin",$row['Lastlogin']);
            add_session("user/cookie",$row['cookie']);
            add_session("user/ip",$row['ip']);
            add_session("user/given_name",$row['Name']);


        }



        // check if any other part of your system needs to know about a user logging in.
      }

      function user_is_logged_in() {
       return get_session("user/id")!=0;
      };

      function generate_random_string($length=32) {
       $random="";
       srand((double)microtime()*1000000);
       $char_list = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
       $char_list.= "abcdefghijklmnopqrstuvwxyz";
       $char_list.= "1234567890";

       for($i=0;$i<$length;++$i) {
          $random.=substr($char_list,(rand()%(strlen($char_list))), 1);
       }

       return $random;
      };

      function add_session($a,$b) {

          $_SESSION[$a]=$b;

      }

      function get_session($a) {

          return $_SESSION[$a];
      }

      function remove_session($a) {

          unset($_SESSION[$a]);

      }







?>