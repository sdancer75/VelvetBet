<?php
    session_start();
    include_once ('database.php');

    date_default_timezone_set("Europe/Athens");

    define("CRYPTKEY","password to (en/de)crypt");
    //**********************************************
    //Returns the Local Time for Greece
    //*********************************************
    function GR_Time($format,$timestamp){
       //Offset is in hours from gmt, including a - sign if applicable.
       //So lets turn offset into seconds
       if  (date('I') == 1)
           $offset = 10800; // GMT=3*60*60;
       else
           $offset = 7200; // GMT=2*60*60;
       $timestamp = $timestamp + $offset;
        //Remember, adding a negative is still subtraction ;)
       return gmdate($format,$timestamp);
    }

    function rand_uniqid($in, $to_num = false, $pad_up = false, $passKey = null) {
        $index = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        if ($passKey !== null) {
            // Although this function's purpose is to just make the
            // ID short - and not so much secure,
            // you can optionally supply a password to make it harder
            // to calculate the corresponding numeric ID

            for ($n = 0; $n<strlen($index); $n++) {
                $i[] = substr( $index,$n ,1);
            }

            $passhash = hash('sha256',$passKey);
            $passhash = (strlen($passhash) < strlen($index))
                ? hash('sha512',$passKey)
                : $passhash;

            for ($n=0; $n < strlen($index); $n++) {
                $p[] =  substr($passhash, $n ,1);
            }

            array_multisort($p,  SORT_DESC, $i);
            $index = implode($i);
        }

        $base  = strlen($index);

        if ($to_num) {
            // Digital number  <<--  alphabet letter code
            $in  = strrev($in);
            $out = 0;
            $len = strlen($in) - 1;
            for ($t = 0; $t <= $len; $t++) {
                $bcpow = bcpow($base, $len - $t);
                $out   = $out + strpos($index, substr($in, $t, 1)) * $bcpow;
            }

            if (is_numeric($pad_up)) {
                $pad_up--;
                if ($pad_up > 0) {
                    $out -= pow($base, $pad_up);
                }
            }
            $out = sprintf('%F', $out);
            $out = substr($out, 0, strpos($out, '.'));
        } else {
            // Digital number  -->>  alphabet letter code
            if (is_numeric($pad_up)) {
                $pad_up--;
                if ($pad_up > 0) {
                    $in += pow($base, $pad_up);
                }
            }

            $out = "";
            for ($t = floor(log($in, $base)); $t >= 0; $t--) {
                $bcp = bcpow($base, $t);
                $a   = floor($in / $bcp) % $base;
                $out = $out . substr($index, $a, 1);
                $in  = $in - ($a * $bcp);
            }
            $out = strrev($out); // reverse
        }

        return $out;
    }


    function encrypt($key,$string){
	   return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
	}

	function decrypt($key,$string){
		return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
	}

    //****************************************************************************************************************
    //Function SaveLog
    //
    //Saves a log to table errorreport
    //Note:Make sure that before any call to this function, the DB is open and is working fine.
    //****************************************************************************************************************
	function SaveLog($UserBetSynopsisID,$AgentID,$WarningLevel,$BrowserInfo,$Description,$FriendlyDescription){

        $AgentLevel = "Δεν υπάρχει";
        if ($AgentID >= 0) {
            $AgentName=$_SESSION['user/given_name'];
            if ($_SESSION["user/level"]=="agents")
                $AgentLevel="agent";
            else if ($_SESSION["user/level"]=="superagents")
                $AgentLevel="superagent";
            else if ($_SESSION["user/level"]=="masterusers")
                $AgentLevel="master";
            else
                $AgentLevel="Άγνωστο (λάθος session)";
        }
        else if ($AgentID==-1)
            $AgentName="Άγνωστος (query string)";
        else if ($AgentID==-2)
            $AgentName="Επισκέπτης";
        else if ($AgentID==-3)
            $AgentName="Άγνωστος (unauthorized)";



        $sqlquery = "Insert errorreport set RegDate='".GR_Time('Y-m-d H:i:s',time())."', UserBetSynopsisID=".$UserBetSynopsisID.", AgentID=".$AgentID.", AgentName='".$AgentName."', AgentLevel='".$AgentLevel."', WarningLevel=".$WarningLevel.", BrowserInfo='".$BrowserInfo."', Description='".$Description."', FriendlyDescription='".$FriendlyDescription."'";
        $result_id = mysql_query($sqlquery);
        $lastItemID = mysql_insert_id();
        if (!$result_id) {
          $message  = 'Invalid query: ' . mysql_error() . "\n";
          $message .= 'Whole query: ' .$sqlquery;
          die($message);
        }

        return  $lastItemID;
	}


      function get_redirect_url($url){
      	$redirect_url = null;

      	$url_parts = @parse_url($url);
      	if (!$url_parts) return false;
      	if (!isset($url_parts['host'])) return false; //can't process relative URLs
      	if (!isset($url_parts['path'])) $url_parts['path'] = '/';
        $ER = error_reporting(0);
      	$sock = fsockopen($url_parts['host'], (isset($url_parts['port']) ? (int)$url_parts['port'] : 80), $errno, $errstr, 30);
        error_reporting($ER);
      	if (!$sock) return false;

      	$request = "HEAD " . $url_parts['path'] . (isset($url_parts['query']) ? '?'.$url_parts['query'] : '') . " HTTP/1.1\r\n";
      	$request .= 'Host: ' . $url_parts['host'] . "\r\n";
      	$request .= "Connection: Close\r\n\r\n";
      	fwrite($sock, $request);
      	$response = '';
      	while(!feof($sock)) $response .= fread($sock, 8192);
      	fclose($sock);

      	if (preg_match('/^Location: (.+?)$/m', $response, $matches)){
      		if ( substr($matches[1], 0, 1) == "/" )
      			return $url_parts['scheme'] . "://" . $url_parts['host'] . trim($matches[1]);
      		else
      			return trim($matches[1]);

      	} else {
      		return false;
      	}

      }


      /**
       * get_all_redirects()
       * Follows and collects all redirects, in order, for the given URL.
       *
       * @param string $url
       * @return array
       */
      function get_all_redirects($url){
      	$redirects = array();
      	while ($newurl = get_redirect_url($url)){
      		if (in_array($newurl, $redirects)){
      			break;
      		}
      		$redirects[] = $newurl;
      		$url = $newurl;
      	}
      	return $redirects;
      }

      /**
       * get_final_url()
       * Gets the address that the URL ultimately leads to.
       * Returns $url itself if it isn't a redirect.
       *
       * @param string $url
       * @return string
       */
      function get_final_url($url){
      	$redirects = get_all_redirects($url);
      	if (count($redirects)>0){
      		return array_pop($redirects);
      	} else {
      		return $url;
      	}
      }




    function XMLToArrayFlat($xml, &$return, $path='', $root=false)
    {
        $children = array();
        if ($xml instanceof SimpleXMLElement) {
            $children = $xml->children();
            if ($root){ // we're at root
                $path .= '/'.$xml->getName();
            }
        }
        if ( count($children) == 0 ){
            $return[$path] = (string)$xml;
            return;
        }
        $seen=array();
        foreach ($children as $child => $value) {
            $childname = ($child instanceof SimpleXMLElement)?$child->getName():$child;
            if ( !isset($seen[$childname])){
                $seen[$childname]=0;
            }
            $seen[$childname]++;
            XMLToArrayFlat($value, $return, $path.'/'.$child.'['.$seen[$childname].']');
        }
    }


      function amstore_xmlobj2array($obj, $level=0) {

          $items = array();

          if(!is_object($obj)) return $items;

          $child = (array)$obj;

          if(sizeof($child)>1) {
              foreach($child as $aa=>$bb) {
                  if(is_array($bb)) {
                      foreach($bb as $ee=>$ff) {
                          if(!is_object($ff)) {
                              $items[$aa][$ee] = $ff;
                          } else
                          if(get_class($ff)=='SimpleXMLElement') {
                              $items[$aa][$ee] = amstore_xmlobj2array($ff,$level+1);
                          }
                      }
                  } else
                  if(!is_object($bb)) {
                      $items[$aa] = $bb;
                  } else
                  if(get_class($bb)=='SimpleXMLElement') {
                      // I need Section and Event as Array, so force them to be a size one array
                      if ( ($aa == "Section") || ($aa == "Event") ) {
                          $items[$aa][0] = amstore_xmlobj2array($bb,$level+1);
                      } else
                          $items[$aa] = amstore_xmlobj2array($bb,$level+1);
                  }
              }
          } else
          if(sizeof($child)>0) {
              foreach($child as $aa=>$bb) {
                  if(!is_array($bb)&&!is_object($bb)) {
                      $items[$aa] = $bb;
                  } else
                  if(is_object($bb)) {
                      $items[$aa] = amstore_xmlobj2array($bb,$level+1);
                  } else {
                      foreach($bb as $cc=>$dd) {
                          if(!is_object($dd)) {
                              $items[$obj->getName()][$cc] = $dd;
                          } else
                          if(get_class($dd)=='SimpleXMLElement') {
                              $items[$obj->getName()][$cc] = amstore_xmlobj2array($dd,$level+1);
                          }
                      }
                  }
              }
          }

          return $items;
      }





      function dump_table($var, $title=false, $level=0)
      {
          if($level==0)
          {
              echo '<table width="400" border="0" cellspacing="1" cellpadding="3" class="dump">';

              if($title)
                    echo '<tr>
                           <th align="center" colspan="2">'.$title.'</th>
                         </tr>';

              echo '
                <tr>
                  <th align="right">VAR NAME</th>
                  <th align="left">VALUE</th>
                </tr>';
          }
          else
          {
              echo '<tr>
                      <td colspan="2">
                          <table width="100%" border="0" cellspacing="3" cellpadding="3" class="dump_b">
                      </td>
                    </tr>';
          }

          foreach($var as $i=>$value)
          {
              if(is_array($value) or is_object($value))
              {
                  dump_table($value, false, ($level +1));
              }
              else
              {
                      echo '<tr>
                              <td align="right" width="50%" >'.$i.'</th>
                              <td align="left" width="50%" >'.$value.'</th>
                             </tr>';
              }
          }
          echo '</table>';
      }

      function ConvertDate($paramDate,$nextday=false,$iso=true) {



        $paramDates_pieces = explode(" ", $paramDate);
        $month = substr($paramDates_pieces[2], 0, 8);



        switch ($month) {
            case "Ιανο" : $month = 1;break;
            case "Φεβρ" : $month = 2;break;
            case "Μαρτ" : $month = 3;break;
            case "Απρι" : $month = 4;break;
            case "Μαΐο" : $month = 5;break;
            case "Ιουν" : $month = 6;break;
            case "Ιουλ" : $month = 7;break;
            case "Αυγο" : $month = 8;break;
            case "Σεπτ" : $month = 9;break;
            case "Οκτω" : $month = 10;break;
            case "Νοεμ" : $month = 11;break;
            case "Δεκε" : $month = 12;break;
            default : return $paramDate;
        }

        if (!$iso) {
            return date('d/m/Y', mktime(0, 0, 0, intval($month), ($nextday==false) ? intval($paramDates_pieces[1]) : intval($paramDates_pieces[1])+1, intval($paramDates_pieces[3]))) ;
        }
        else {
        // iso format

           return date('Y/m/d',   mktime(0, 0, 0, intval($month), ($nextday==false) ? intval($paramDates_pieces[1]) : intval($paramDates_pieces[1])+1, intval($paramDates_pieces[3]))) ;
        }

      }

      function ConvertEE($EE) {



        switch ($EE) {
            case "Μονά"       : $customEE = "1";break;
            case "Συν Ένα"    : $customEE = "2";break;
            case "Δυάδες"     : $customEE = "2";break;
            case "Συν Δύο"    : $customEE = "3";break;
            case "Τριάδες"    : $customEE = "3";break;
            case "Συν Τρία"   : $customEE = "4";break;
            case "Τετράδες"   : $customEE = "4";break;
            case "Συν Τέσσερα": $customEE = "5";break;
            case "Πεντάδες"   : $customEE = "5";break;
            case "Συν Πέντε"  : $customEE = "5";break;
            default : $customEE = "0";

        }

        return $customEE;

      }

?>