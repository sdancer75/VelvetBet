<?php

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">

<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD><TITLE>Όλα για το Ποδόσφαιρο</TITLE>

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

            <br><br><br>

    </TD>
  </TR>
  <TR>
    <TD colSpan=2><IMG src="grafix/img_fill.jpg"></TD>
  </TR>
  <TR>
    <TD class=containertd id=ContLEFT2 style="VERTICAL-ALIGN: top" width="50%">

    </TD>

    <TD class=containertd id=ContRIGHT style="VERTICAL-ALIGN: top" width="50%">
    <!-- BEGIN CONTRIGHT-->
    <br><br><br>
    <span style="color:white">
    Λόγω αναβάθμισης ο δικτυακός τόπος θα παραμείνει κλειστός για λίγες ημέρες.
    </span>
    <br><br><br>

    </TD>
  </TR>
  <TR>
    <TD class=footerback colSpan=2 align=center>
            <IMG src="grafix/footerholder.gif" align=absMiddle>



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
