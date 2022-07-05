

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">

<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD><TITLE>VelvetBet - Στοιχήματα Ποδοσφαίρου</TITLE>

<?php include ('includes/metatagsgr.php') ?>

 <link href="betplatform.css" rel="stylesheet" type="text/css">
 <link rel="shortcut icon" href="grafix/favicon.ico" type="image/x-icon" />
</HEAD>






<BODY class="yui-skin-sam"  oncontextmenu="return false">

<div align=top>
<TABLE cellSpacing=0 cellPadding=0 width="800px" align=center border=0>
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
    <TD class=containertd id=ContLEFT2 style="VERTICAL-ALIGN: top" >

    <!-- BEGIN CONTLEFT-->

      <TABLE style="BACKGROUND-IMAGE: url(grafix/biggradient.gif)" cellSpacing=0  cellPadding=0  align=center border=0 width=90%>
        <TBODY>
        <TR>
          <TD class=HeaderTD>Αναβάθμιση φυλλομετρητή</TD>
          <TD class=shaderight width=3 rowSpan=7>
                <IMG src="grafix/shadeholder.gif">
          </TD>
        </TR>
        <TR>
          <TD class=Padding3pxlogin>
                <br><br>
                <span style="color:#FF9900; font-size: 13px; font-weight: bold">Η έκδοση του φυλλομετρητή (browser) που χρησιμοποιείτε είναι σχετικά παλαιά. <br><br>
                Θα πρέπει να προβείτε σε αναβάθμιση μιας νέας έκδοσης για να μπορέσετε να συνεχίσετε.</span>
                <br><br><br><br>
                Κάντε κλίκ σε μία από τις παρακάτω επιλογές για να εγκαταστήσετε τη νεότερη έκδοση του φυλλομετρητή της αρεσκείας σας.
                <br><br><br>
          </TD>
        </TR>
        <TR>
          <TD class=Padding3pxlogin>

                <INPUT class=SelectionButton  type="button" value="     IE Explorer 8.0 ή νεότερο     "  onclick="window.location = 'http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie8_b_CF33D999-11F2-4E38-A4ED-227368A7875A;'" onmouseover="this.style.cursor='pointer'">
                <INPUT class=SelectionButton  type="button" value="     FireFox 3.0 ή νεότερο     "  onclick="window.location = 'http://www.mozilla.com/el/'" onmouseover="this.style.cursor='pointer'">
                <INPUT class=SelectionButton  type="button" value="     Google Chrome 3.0 ή νεότερο     "  onclick="window.location = 'http://www.google.com/chrome'" onmouseover="this.style.cursor='pointer'">

          </TD>
        </TR>
        <TR>
          <TD class=Padding3pxlogin>  </TD></TR>
        <TR>
          <TD class=Padding3pxlogin>

          </TD></TR>
        <TR>
          <TD class=Padding3pxlogin>
            <br><br>


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

    <!-- END CONTLEFT-->
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
					action="index.php";
					submit();
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

</BODY>
</HTML>
