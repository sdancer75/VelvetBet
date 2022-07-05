<?php
    session_start();
    include 'includes/database.php';
    include 'includes/login.php';
    include 'includes/statistics.php';

    date_default_timezone_set("Europe/Athens");



    $_SESSION["user/id"]="guest";




     $LoginMsg = '';
     $DB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
     mysql_select_db(DataBase, $DB) or die(mysql_error());
     mysql_query("SET NAMES 'utf8'");


     //update guestsip table
     if (isset($_SESSION['ip']) == false) {


              $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];

              $ipaddr = $_SESSION['ip'];
              //$country = file_get_contents('http://api.hostip.info/get_html.php?ip='.$_SESSION['ip']);
              //$country = str_replace( array("\r\n", "\n","\r"), '<br />', $country );
              $country = "άγνωστο";
              $user = 'Επισκέπτης';
              $sqlquery = "INSERT INTO guestsip (Address,Country,VisitDateTime,User) VALUES ('".$ipaddr."','".$country."','".GR_Time('Y-m-d H:i:s',time())."','".$user."')";
              mysql_query("SET NAMES 'utf8'");
              $result_id = mysql_query($sqlquery);

     }

    if (isset($_POST['submitted'])) {



        if (check_login('masterusers')){
            SaveLog(-1,$_SESSION['user/id'],0,$_SERVER['HTTP_USER_AGENT'],'User Login','Εισαγωγή χρήστη στο σύστημα.');
            header( 'Location: myadmin/index.php' );
        }
        else if (check_login('superagents')) {
            SaveLog(-1,$_SESSION['user/id'],0,$_SERVER['HTTP_USER_AGENT'],'User Login','Εισαγωγή χρήστη στο σύστημα.');
            header( 'Location: gate/index.php' );
        }
        else if (check_login('agents')) {
            SaveLog(-1,$_SESSION['user/id'],0,$_SERVER['HTTP_USER_AGENT'],'User Login','Εισαγωγή χρήστη στο σύστημα.');
            header( 'Location: gate/index.php' );
        }


    }




   mysql_close($DB);






?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">

<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD><TITLE>VelvetBet - Στοιχήματα Ποδοσφαίρου</TITLE>

<?php include ('includes/metatagsgr.php') ?>

 <link href="betplatform.css" rel="stylesheet" type="text/css">
 <link rel="shortcut icon" href="grafix/favicon.ico" type="image/x-icon" />
</HEAD>

<SCRIPT src="js/filter.js" type=text/javascript></SCRIPT>
<script language="JavaScript" src="js/calculator.js" charset="utf-8"></script>
<script type="text/javascript" src="js/verifyinput.js"></script>




<BODY class="yui-skin-sam"  oncontextmenu="return false">

<div align=top>
<TABLE cellSpacing=0 cellPadding=0 width=800 align=center border=0>
  <TBODY>
  <TR>
    <TD class=logoback colSpan=2>

            <IMG height=69 src="grafix/Logo.png" align=absBottom>

    </TD>
  </TR>
  <TR>
    <TD colSpan=2><IMG src="grafix/img_fill.jpg"></TD>
  </TR>
  <TR>
    <TD class=containertd id=ContLEFT2 style="VERTICAL-ALIGN: top" width="50%">

    <!-- BEGIN CONTLEFT-->
      <FORM name="loginForm" id="loginForm" method="post">
      <input type="hidden" name="submitted" id="submitted" value="go">
      <TABLE style="BACKGROUND-IMAGE: url(grafix/biggradient.gif)" cellSpacing=0  cellPadding=0 width=300 align=center border=0>
        <TBODY>
        <TR>
          <TD class=HeaderTD>Συνδεθείτε</TD>
          <TD class=shaderight width=3 rowSpan=7>
                <IMG src="grafix/shadeholder.gif">
          </TD>
        </TR>
        <TR>
          <TD class=Padding3pxlogin>
                <br>
                <?php echo $LoginMsg?>
                <br><br>
                Όνομα χρήστη
          </TD>
        </TR>
        <TR>
          <TD class=Padding3pxlogin>
          <INPUT class=InputText onkeyup="this.value=this.value.toLowerCase()" onkeypress="editKeyBoard(event,keybAlphaNumeric);enterKey(event);" id="login_name" name="login_name">
          </TD>
        </TR>
        <TR>
          <TD class=Padding3pxlogin>Κωδικός</TD></TR>
        <TR>
          <TD class=Padding3pxlogin><INPUT type=password class=InputText onkeyup="this.value=this.value.toLowerCase()" onkeypress="editKeyBoard(event,keybAlphaNumeric);enterKey(event);" id="login_pass"  name="login_pass" onmouseover="this.style.cursor='pointer'"></TD></TR>
        <TR>
          <TD class=Padding3pxlogin>
            <br><br>
            <INPUT class=ButtonOrange id=butLogin type="button" value="     Συνδεθείτε     " name=butLogin onclick="ChkLogin();" onmouseover="this.style.cursor='pointer'">
            <br><br>
            <input type="hidden" name="remember_me" id="remember_me" >

          </TD>
        </TR>
        <TR>
          <TD></TD>
        </TR>
        <TR>
          <TD class=shadebottom height=10><IMG src="grafix/shadeholder.gif"></TD>
          <TD class=shadecorner width=10><IMG src="grafix/shadeholder.gif"></TD>
        </TR>
        </TBODY>
      </TABLE>
    </FORM>
    <!-- END CONTLEFT-->
    </TD>

    <TD class=containertd id=ContRIGHT style="VERTICAL-ALIGN: top" width="50%">
    <!-- BEGIN CONTRIGHT-->

      <TABLE style="BACKGROUND-IMAGE: url(grafix/biggradient.gif)" cellSpacing=0 cellPadding=0 width=300 align=center border=0>
        <TBODY>
        <TR>
          <TD class=HeaderTD colSpan=2>Επιλογές</TD>
          <TD class=shaderight width=3 rowSpan=7>
                <IMG src="grafix/shadeholder.gif">
          </TD>
        </TR>

        <TR>
          <TD class=Padding3px width=25>&nbsp;</TD>
          <TD class=Padding3px>
                <IMG height=10 src="grafix/arrow1.gif"  width=10>&nbsp;
                <STRONG><a class=Padding3px href="javascript:OpenWindow('coupon.php','toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=0,width=1144,height=600,left=0,top=0')" >Κουπόνι</a></STRONG>
          </TD>
        </TR>


        <TR>
          <TD class=Padding3px>&nbsp;</TD>
          <TD class=Padding3px >
                <IMG height=10  src="grafix/arrow1.gif"  width=10>&nbsp;
                <STRONG><a class=Padding3px href="javascript:OpenWindow('results.php','toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=0,width=790,height=600,left=0,top=0')">Αποτελέσματα</a></STRONG>
          </TD>
        </TR>

        <TR>
          <TD class=Padding3px>&nbsp;</TD>
          <TD class=Padding3px >
                <IMG height=10 src="grafix/arrow1.gif" width=10>&nbsp;

                <STRONG><a class=Padding3px href="javascript:OpenWindow('http://free.7m.cn:10001/live_default.aspx?skin=&img=&iadurl=&adword=&wadurl=&site=8783&Rst=&Cr=&Sl=&tz=&dst=&match=&view=&ordType=&encode=en','toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=0,width=1024,height=780,left=0,top=0')">Live Scores</a></STRONG>
          </TD>
        </TR>



        <TR>
          <TD class=Padding3px width=25>&nbsp;</TD>
          <TD class=Padding3px>
                <IMG height=10 src="grafix/arrow1.gif"  width=10>&nbsp;
                <STRONG><A class=Padding3px href="ComStix21.exe">Κομπουτεράκι στοιχήματος</a></STRONG>
          </TD>
        </TR>

        <TR>
          <TD class=Padding3px>&nbsp;</TD>
          <TD class=Padding3px >
                <IMG height=10 src="grafix/arrow1.gif" width=10>&nbsp;

                <STRONG><a class=Padding3px href="javascript:OpenWindow('terms.php','toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=0,width=850,height=780,left=0,top=0')">Κανόνες</a></STRONG>
          </TD>
        </TR>

        <TR>
          <TD class=Padding3px>&nbsp;</TD>
          <TD class=Padding3px >
                <IMG height=10 src="grafix/arrow1.gif" width=10>&nbsp;

                <STRONG><a class=Padding3px href="javascript:OpenWindow('contact.php','toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=0,width=520,height=530,left=0,top=0')">Επικοινωνία</a></STRONG>
          </TD>
        </TR>




        <TR>
          <TD colspan=2></TD>
        </TR>
        <TR>
          <TD class=shadebottom height=10 colspan=2><IMG src="grafix/shadeholder.gif"></TD>
          <TD class=shadecorner width=10><IMG src="grafix/shadeholder.gif"></TD>
        </TR>



        </TBODY>
      </TABLE>
      <br>
      <TABLE cellSpacing=0 cellPadding=0 width=300 align=center border=0>

        <TR>
            <TD colspan=2 align=center>

              <a href="http://live.velvetbet.com" target="_blank"><IMG src="grafix/livebet.jpg" border=0></a>

            </TD>
        </TR>

      </TABLE>
      <br><br>



    </TD>
  </TR>
  <TR>
    <TD class=footerback colSpan=2 align=center>
            <IMG src="grafix/footerholder.gif" align=absMiddle>
            <SPAN style="PADDING-RIGHT: 20px; FONT-SIZE: 9px">Copyright ©  <STRONG>VelvetBet</STRONG> 2009</SPAN>


    </TD>
  </TR>

  <TR>
    <TD  colSpan=2 align=center>
            <SPAN style="FONT-SIZE: 9px; text-align: center;COLOR:White">
            <BR><br>
            Συμβατό με <IMG src="grafix/ie8.png" align=absMiddle hspace="2"> Internet Explorer 8.0, <IMG src="grafix/firefox3.png " align=absMiddle hspace="2"> FireFox 3 και <IMG src="grafix/googlechrome3.png" align=absMiddle hspace="2"> Google Chrome 3
            <br><br>
            Προτεινόμενη ανάλυση οθόνης 1280x1024 pixels
            </SPAN>

    </TD>
  </TR>

</TBODY>
</TABLE>
</div>

<SCRIPT type=text/javascript>

function ChkLogin(){

		with(window.document.loginForm)
		{
				if ( (login_name.value=="") || (login_pass.value=="") )
				{
					alert("Παρακαλώ συμπληρώστε Όνομα χρήστη και τον Κωδικό χρήστη.");
				}
				else
				{
                    var check = browserCheck();

                    if (check==true) {

    					action="index.php";
    					submit();
                    }
				}
		}
}
</SCRIPT>

<script LANGUAGE="javascript" TYPE="text/javascript">


	function OpenWindow(name,features) {

		  win = window.open(name,'_blank',features);
          win.window.focus();

		}

    function enterKey(e)
    {
        var key = e.which||e.keyCode;

        if(key == 13)
        {
            document.getElementById("butLogin").click();
        }
    }




	// End hiding from old browsers -->
</script>

<SCRIPT language="javascript">




    var nVer = navigator.appVersion;
    var nAgt = navigator.userAgent;
    var browserName  = navigator.appName;
    var fullVersion  = ''+parseFloat(navigator.appVersion);
    var majorVersion = parseInt(navigator.appVersion,10);
    var nameOffset,verOffset,ix;
    var ver;

//DO NOT CHANGE ANYTHING BELOW THIS POINT
function browserCheck() {


    // In MSIE, the true version is after "MSIE" in userAgent
    if ((verOffset=nAgt.indexOf("MSIE"))!=-1) {
     browserName = "ie";
     fullVersion = nAgt.substring(verOffset+5);
    }
    // In Opera, the true version is after "Opera"
    else if ((verOffset=nAgt.indexOf("Opera"))!=-1) {
     browserName = "opera";
     fullVersion = nAgt.substring(verOffset+6);
    }
    // In Chrome, the true version is after "Chrome"
    else if ((verOffset=nAgt.indexOf("Chrome"))!=-1) {
     browserName = "chrome";
     fullVersion = nAgt.substring(verOffset+7);
    }
    // In Safari, the true version is after "Safari"
    else if ((verOffset=nAgt.indexOf("Safari"))!=-1) {
     browserName = "safari";
     fullVersion = nAgt.substring(verOffset+7);
    }
    // In Firefox, the true version is after "Firefox"
    else if ((verOffset=nAgt.indexOf("Firefox"))!=-1) {
     browserName = "firefox";
     fullVersion = nAgt.substring(verOffset+8);
    }
    // In most other browsers, "name/version" is at the end of userAgent
    else if ( (nameOffset=nAgt.lastIndexOf(' ')+1) < (verOffset=nAgt.lastIndexOf('/')) )
    {
     browserName = nAgt.substring(nameOffset,verOffset);
     fullVersion = nAgt.substring(verOffset+1);
     if (browserName.toLowerCase()==browserName.toUpperCase()) {
      browserName = navigator.appName;
     }
    }
    // trim the fullVersion string at semicolon/space if present
    if ((ix=fullVersion.indexOf(";"))!=-1) fullVersion=fullVersion.substring(0,ix);
    if ((ix=fullVersion.indexOf(" "))!=-1) fullVersion=fullVersion.substring(0,ix);

    majorVersion = parseInt(''+fullVersion,10);
    if (isNaN(majorVersion)) {
     fullVersion  = ''+parseFloat(navigator.appVersion);
     majorVersion = parseInt(navigator.appVersion,10);
    }

    ver = ''+browserName+majorVersion;

    /*
    alert('Browser name  = '+browserName+'<br>');
    alert('Full version  = '+fullVersion+'<br>');
    alert('Major version = '+majorVersion+'<br>');
    alert('navigator.appName = '+navigator.appName+'<br>');
    alert('navigator.userAgent = '+navigator.userAgent+'<br>');
    */

    if ( ( browserName == 'opera' ) || ( browserName == 'safari' ) )  {
      	window.location = "update.php";
        return false;

    }

    switch (ver) {
    case 'ie7':
    case 'ie6':
    case 'ie4':
    case 'ie3':
    case 'ie2':
    case 'chrome1':
    case 'firefox2':
    case 'firefox1':


    	window.location = "update.php";
      return false;
      break;



    default: return true;
             break;
  }



  return true;




}







</SCRIPT>

</BODY>
</HTML>
