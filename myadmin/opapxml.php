<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE>VelvetBet - Στοιχήματα Ποδοσφαίρου</TITLE>
<?php include '../includes/metatagsgr.php' ?>
<?php include '../includes/functions.php' ?>

</HEAD>

<?php


       $rez = get_redirect_url('http://www.pamestoixima.gr/ShowSpecialContent.ashx?langid=1&FolderId=329a10c9-f525-4d8a-bb69-2b786f31c043&SpecialContent=17');
       if (!$rez) {

          echo "url not valid";
          return;


       }

       parse_str($rez, $url_params);
       $couponID=$url_params['CouponID'];
       if (empty($couponID)) {

          echo "CouponID not found";
          return;

       }

       $xml_url = "http://www.pamestoixima.gr/FlexBetXMLfootballCoupon.aspx?langID=1&couponID=".$couponID;

       /*
       $couponID=1;
       $xml_url = "http://localhost/lackybet/NoData/Opap/XML/1.xml?couponID=1";
       */
       $xml = simpleXML_load_file($xml_url);
       $xmlarray = amstore_xmlobj2array($xml);

       /*
       echo is_array($xmlarray['Section'][0]) ? 'Array' : 'not an Array';

       echo $xmlarray['Section'][0]['Event'][0]['Code'];

       */
        /*
        if (count($xmlarray['Section'][0])==0) {
            $medDataPrologue = $xmlarray['BasicInformation'];
            $medDataSection = $xmlarray['Section'];

            unset($xmlarray);

            $xmlarray = $medDataPrologue;
            $xmlarray = $medDataSection


        }
        */
  /*
       echo "SectionArraySize=".count($xmlarray['Section'])."<br><br>";

       if (count($xmlarray['Section'][0])==0)
            $Sections = 1;
       else
            $Sections = count($xmlarray['Section']);

       if ($Sections == 1) {
           if (count($xmlarray['Section']['Events'][0])==0)
               $Events = 1;
           else
               $Events = count($xmlarray['Section'][0]['Events']);
       } else
          $Events = count($xmlarray['Section'][0]['Events']);


       */
       echo   $xmlarray['BasicInformation']['StartDate'];
       echo   "<br>";
       echo   $xmlarray['BasicInformation']['EndDate'];
       echo   "<br>";
       echo   "========================================";
       echo   "<br><br><br>";



               foreach ($xmlarray['Section'] as $Section) {
                   echo   $Section['Title']."<br>";
                   foreach ($Section['Event'] as $Event) {



                      foreach ($Event as $key => $value) {

                           

                           $Event[$key] = str_replace (',','.',$value);


                            //echo "val= ".$value;
                            if ($value=='-') {
                                $Event[$key] =0;
                                // echo "   [FIXED]";
                            }

                            if (is_array($Event[$key])){
                                 $Event[$key] =0;
                            }






                      }

                      if ( ( date("H:i", strtotime($Event['Time'])) >= date("H:i", strtotime("00:00")) ) && ( date("H:i",strtotime($Event['Time'])) < date("H:i", strtotime("06:00"))) ) {
                           echo "@ ";
                           $Event['Date'] = ConvertDate($Event['Date'],true);

                      } else
                           $Event['Date'] = ConvertDate($Event['Date'],false);


                      echo   '************* DATA *************************<br>';
                     // echo    ( date("H:i", strtotime($Event['Time'])) >= date("H:i", strtotime("00:00")) ) ? "true" : "false"."  ";
                      echo   $Event['Date']." ";
                      //echo   $Event['League']." ";
                      echo   $Event['Code']." ";
                      echo   $Event['Time']." ";
                      /*
                      echo   ConvertEE($Event['SpecialSignal'])." ";
                      echo   $Event['Apodosi1']." ";
                      echo   $Event['HomeTeam']." ";
                      echo   $Event['ApodosiX']." ";
                      echo   $Event['AwayTeam']." ";
                      echo   $Event['Apodosi2']." ";
                      echo   $Event['ApodosiUNDER']." ";
                      echo   $Event['ApodosiOVER']." ";
                      echo   $Event['ApodosiSNS1Y']." ";
                      echo   $Event['ApodosiSNS1N']." ";
                      echo   $Event['ApodosiHalf1']." ";
                      echo   $Event['ApodosiHalfΧ']." ";
                      echo   $Event['ApodosiHalf2']." ";
                      */


                      echo   "<br><br><br>";
                   }
                   echo   "---------------------------------------------<br>";
               }








?>

</HTML>

