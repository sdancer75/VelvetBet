<?php
    include 'includes/database.php';

      function EncryptClientId($id)
      {
      return substr(md5($id), 0, 8).dechex($id);
      }

      function DecryptClientId($id)
      {
      $md5_8 = substr($id, 0, 8);
      $real_id = hexdec(substr($id, 8));
      return ($md5_8==substr(md5($real_id), 0, 8)) ? $real_id : 0;
      }

    function encrypt($id,$time) {
            return ($id^$time)<<16 | $time;
    }



    function rand_uniqid($in, $to_num = false, $pad_up = false, $passKey = null)
    {
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
                    $out += pow($base, $pad_up);
                }
            }
            $out = sprintf('%F', $out);
            $out = substr($out, 0, strpos($out, '.'));
        } else {
            // Digital number  -->>  alphabet letter code
            if (is_numeric($pad_up)) {
                $pad_up--;
                if ($pad_up > 0) {
                    $out -= pow($base, $pad_up);
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
    //date_default_timezone_set("Europe/Athens");

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

    function timeDiff($firstTime,$lastTime)
    {

    // convert to unix timestamps
    $firstTime=strtotime($firstTime);
    $lastTime=strtotime($lastTime);

    // perform subtraction to get the difference (in seconds) between times
    $timeDiff=$lastTime-$firstTime;

    // return the difference
    return $timeDiff;
    }

function uuid($serverID=1)
{
    $t=explode(" ",microtime());
    return sprintf( '%04x-%08s-%08s-%04s-%04x%04x',
        $serverID,
        clientIPToHex(),
        substr("00000000".dechex($t[1]),-8),   // get 8HEX of unixtime
        substr("0000".dechex(round($t[0]*65536)),-4), // get 4HEX of microtime
        mt_rand(0,0xffff), mt_rand(0,0xffff));
}

function uuidDecode($uuid) {
    $rez=Array();
    $u=explode("-",$uuid);
    if(is_array($u)&&count($u)==5) {
        $rez=Array(
            'serverID'=>$u[0],
            'ip'=>clientIPFromHex($u[1]),
            'unixtime'=>hexdec($u[2]),
            'micro'=>(hexdec($u[3])/65536)
        );
    }
    return $rez;
}
function clientIPToHex($ip="") {
    $hex="";
    if($ip=="") $ip=getEnv("REMOTE_ADDR");
    $part=explode('.', $ip);
    for ($i=0; $i<=count($part)-1; $i++) {
        $hex.=substr("0".dechex($part[$i]),-2);
    }
    return $hex;
}
function clientIPFromHex($hex) {
    $ip="";
    if(strlen($hex)==8) {
        $ip.=hexdec(substr($hex,0,2)).".";
        $ip.=hexdec(substr($hex,2,2)).".";
        $ip.=hexdec(substr($hex,4,2)).".";
        $ip.=hexdec(substr($hex,6,2));
    }
    return $ip;
}

     $DB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
     mysql_select_db(DataBase, $DB) or die(mysql_error());

    $NightRestrictions = 0;
    $TimeOutFrom = 0;
    $TimeOutTo = 0;

    $result_id = mysql_query("select * from master limit 1");
    $row = mysql_fetch_assoc($result_id);
    if ($row) {

        $NightFrom = $row['NightLimitFrom'];
        $NightTo = $row['NightLimitTo'];
        $Time =time();

        echo '==========Time Stamp test ======================<br>';
        echo  rand_uniqid(200000,true)."<br>";
        echo  rand_uniqid(1232,true)."<br>";
        echo  rand_uniqid(1124,true)."<br>";
        echo '==========Decrypt===============================<br>';
        echo  DecryptClientId('c4ca42381')."<br>";
        echo  DecryptClientId('c81e728d2')."<br>";
        echo '==========Time Stamp test ======================<br>';

        echo strtotime("1970-01-01 UTC 00:00:00"), "<br>";
        echo "NightLimitFrom (".$row['NightLimitFrom'].") ".strtotime("1970-01-01 UTC ".$row['NightLimitFrom']), "<br>";
        echo "NightLimitTo (".$row['NightLimitTo'].") ".strtotime("1970-01-01 UTC ".$row['NightLimitTo']), "<br>";

        echo "FROM=".( ((strtotime("1970-01-01 UTC ".$row['NightLimitFrom']) - strtotime("1970-01-01 UTC 00:00:00"))) )."<br>";
        echo "TO=".((strtotime("1970-01-01 UTC ".$row['NightLimitTo']) - strtotime("1970-01-01 UTC 00:00:00"))  )."<br>";
        echo "GRTime=".GR_Time("H:i:s",time())."<br>";
        echo "ServerTime=".date("H:i:s",time())."<br>";
        echo "Difference=".date("H:i:s",strtotime(timeDiff(GR_Time("H:i:s",time()),date("H:i:s",time()))));
        //echo "NOW=".date("H:i:s" ,);



        if ( ( strtotime("1970-01-01 UTC ".$row['NightLimitFrom']) - strtotime("1970-01-01 UTC ".GR_Time("H:i:s",time())) ) > 0 )
            $TimeOutFrom = 0;
        else
            $TimeOutFrom = 1;


        if ( ( strtotime("1970-01-01 UTC ".GR_Time("H:i:s",time())) - strtotime("1970-01-01 UTC ".$row['NightLimitTo']) ) > 0 )
            $TimeOutTo = 0;
        else
            $TimeOutTo = 1;


        if ( ( $TimeOutFrom == 1) || ( $TimeOutTo == 1) )
            $NightRestrictions = 1;


        $LimitMona = $row['LimitMona'];
        $LimitPollapla = $row['LimitPollapla'];
        $LimitSystems = $row['LimitSystems'];


        $MaxProfit = $row['MaxProfit'];
        $MinBet = $row['MinBet'];
        $MaxBet  = $row['MaxBet'];

        if ($MaxProfit==0)
            $MaxProfit=10000;

        if ($MinBet==0)
            $MinBet=1;

        if ($MaxBet==0)
            $MaxBet=500;

    }


?>

    <Script type="text/javascript">
            var MAXPROFIT = eval(<?php echo $MaxProfit ?>);
            var MINBET = eval(<?php echo $MinBet ?>);
            var MAXBET = eval(<?php echo $MaxBet ?>);


            var LIMIT_MONA = eval(<?php echo $LimitMona ?>);
            var LIMIT_POLLAPLA =  eval(<?php echo $LimitPollapla ?>);
            var LIMIT_SYSTEMS = eval(<?php echo $LimitSystems ?>);

            var NIGHT_RESTRICTIONS = eval(<?php echo $NightRestrictions ?>);

            var NIGHT_FROM = "<?php echo $NightFrom ?>";
            var NIGHT_TO = "<?php echo $NightTo ?>";
            /*
            alert('NIGHT_RESTRICTIONS ='+NIGHT_RESTRICTIONS);

            alert('MAXPROFIT ='+MAXPROFIT);
            alert('MINBET ='+MINBET);
            alert('MAXBET ='+MAXBET);
            alert('LIMIT_MONA ='+LIMIT_MONA);
            alert('LIMIT_POLLAPLA ='+LIMIT_POLLAPLA);
            alert('LIMIT_SYSTEMS ='+LIMIT_SYSTEMS);


            alert('NIGHT_FROM ='+NIGHT_FROM);
            alert('NIGHT_TO ='+NIGHT_TO);
              */

            //alert('SystemTime ='+SYS_TIME);



    </script>