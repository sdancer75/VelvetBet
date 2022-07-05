<?php session_start();

 $_SESSION["user/id"]="guest";

 ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">


<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE>VelvetBet - Στοιχήματα Ποδοσφαίρου</TITLE>
 <?php include 'includes/metatagsgr.php' ?>

<link href="betplatform.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" href="includes/contact-form/style-simple.css">





</HEAD>


<BODY class="yui-skin-sam"  oncontextmenu="return false">

<div align=top>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
  <TBODY>



  <TR>
    <TD class=logoback colSpan=2 height=10></TD>
  </TR>

  <TR>
    <TD bgcolor="#CCCC99" style="FONT-SIZE:14px" colSpan=2  height="25px" align="center" width="100%">
                <strong>Επικοινωνία</strong>
    </TD>
  </TR>
  <TR>

    <TD style="VERTICAL-ALIGN: top; padding: 10px" width="100%" >
    <br>
    <br>



      <TABLE style="BACKGROUND-IMAGE: url(grafix/biggradient.gif)" cellSpacing=0  cellPadding=0 width=500 align=left border=0>
        <TBODY>
        <TR>
          <TD class=HeaderTD>Παρακαλώ συμπληρώστε τη φόρμα επικοινωνίας.</TD>
          <TD class=shaderight width=3 rowSpan=3>
                <IMG src="grafix/shadeholder.gif">
          </TD>
        </TR>
        <TR>
          <TD class=Padding3pxlogin style="padding: 10px" align=center>


    <?php

    $contact_form_fields = array(

      array('name'    => 'Όνομα:',
            'type'    => 'name',
            'require' => 1),

      array('name'    => 'E-mail:',
            'type'    => 'email',
            'require' => 1),

      array('name'    => 'Τηλ/Φαξ:',
            'type'    => 'input',
            'require' => 0),

      array('name'    => 'Πόλη:',
            'type'    => 'input',
            'require' => 0),

      array('name'    => 'Θέμα:',
            'type'    => 'subject',
            'require' => 1),

      array('name'    => 'Μήνυμα:',
            'type'    => 'textarea',
            'require' => 1),


      array('name'    => 'Κωδ. Ασφάλειας:',
            'type'    => 'turing',
            'require' => 1,
            'url'     => 'includes/contact-form/image.php',
            'prompt'  => 'Πληκτρολογήστε τον αριθμό που φαίνεται παραπάνω.'));


    $contact_form_graph           = false;
    $contact_form_xhtml           = false;

    $contact_form_email           = "info@velvetbet.com";
    $contact_form_encoding        = "utf-8";
    $contact_form_default_subject = "VelvetBet.com";
    $contact_form_message_prefix  = "Αποστολή μηνύματος από VelvetBet.com\r\n==============================\r\n\r\n";

    include_once "includes/contact-form/contact-form.php";

    ?>



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






    </TD>
  </TR>

  <TR>
    <TD class=footerback colSpan=2>
            <IMG src="grafix/footerholder.gif" align=absMiddle>
            <SPAN style="PADDING-RIGHT: 20px; FONT-SIZE: 9px">Copyright ©  <STRONG>VelvetBet</STRONG> 2009</SPAN>
    </TD>
  </TR>
</TBODY>
</TABLE>
</div>

</BODY>
</HTML>
