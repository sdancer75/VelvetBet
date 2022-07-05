    <TR>

    <TD class=containertd id=ContRIGHT style="VERTICAL-ALIGN: top" align="left"  >
    <!-- BEGIN CONTRIGHT-->

<TABLE>
<TR>
<TD class=DummyPrint>
      <TABLE style="BACKGROUND-IMAGE: url(../grafix/biggradient.gif)" cellSpacing=0 cellPadding=0  align="left" border=0 width="180px">
        <TBODY>
        <TR>
          <TD class=HeaderTD colSpan=2>Γενικές επιλογές</TD>
          <TD class=shaderight width=3 rowSpan=4>
                <IMG src="../grafix/shadeholder.gif">
          </TD>
        </TR>



        <TR>
          <TD class=Padding3px width=5>&nbsp;</TD>
          <TD class=Padding3px>
                <IMG height=10 src="../grafix/arrow1.gif"  width=10>&nbsp;
                <STRONG><A class=Padding3px href="index.php">Κεντρική σελίδα</a></STRONG>
          </TD>
        </TR>


        <TR>
          <TD class=Padding3px>&nbsp;</TD>
          <TD class=Padding3px >
                <IMG height=10  src="../grafix/arrow1.gif"  width=10>&nbsp;
                <STRONG><a class=Padding3px href="logout.php">Έξοδος</a></STRONG>
          </TD>
        </TR>

         <TR>
          <TD colspan=2></TD>
        </TR>

        <TR>
          <TD class=shadebottom height=10 colspan=2><IMG src="../grafix/shadeholder.gif"></TD>
          <TD class=shadecorner width=10><IMG src="../grafix/shadeholder.gif"></TD>
        </TR>
        </TBODY>
      </TABLE>
</TD>
</TR>
<TR>
<TD class=DummyPrint>
      <TABLE style="BACKGROUND-IMAGE: url(../grafix/biggradient.gif)" cellSpacing=0 cellPadding=0  align=left border=0 width=180px>
        <TBODY>
        <TR>
          <TD class=HeaderTD colSpan=2>Στοιχήματα</TD>
          <TD class=shaderight width=3 <?php
                            if ($_SESSION['user/level'] == 'agents')  {
                                echo "rowSpan=4";
                            } else {
                                echo "rowSpan=3";
                            }
                            ?> >
                <IMG src="../grafix/shadeholder.gif">
          </TD>
        </TR>
        <?php if ($_SESSION['user/level'] == 'agents')  { ?>
        <TR>
          <TD class=Padding3px width=5>&nbsp;</TD>
          <TD class=Padding3px>
                <IMG height=10 src="../grafix/arrow1.gif"  width=10>&nbsp;
                <STRONG><A class=Padding3px href="betnow.php">Στοιχηματίστε</a></STRONG>
          </TD>
        </TR>
         <?php } ?>
        <TR>
          <TD class=Padding3px>&nbsp;</TD>
          <TD class=Padding3px >
                <IMG height=10  src="../grafix/arrow1.gif"  width=10>&nbsp;
                <STRONG><a class=Padding3px href="betlist.php">Λίστα στοιχημάτων</a></STRONG>
          </TD>
        </TR>

         <TR>
          <TD colspan=2></TD>
        </TR>

        <TR>
          <TD class=shadebottom height=10 colspan=2><IMG src="../grafix/shadeholder.gif"></TD>
          <TD class=shadecorner width=10><IMG src="../grafix/shadeholder.gif"></TD>
        </TR>
        </TBODY>
      </TABLE>
</TD>
</TR>
      <?php if ($_SESSION['user/level'] == 'superagents')  { ?>
<TR>
<TD class=DummyPrint>
            <TABLE style="BACKGROUND-IMAGE: url(../grafix/biggradient.gif)" cellSpacing=0 cellPadding=0  align=left border=0 width=180px>
              <TBODY>
              <TR>
                <TD class=HeaderTD colSpan=2>Διαχείριση ταμείου</TD>
                <TD class=shaderight width=3 rowSpan=4>
                      <IMG src="../grafix/shadeholder.gif">
                </TD>
              </TR>

              <TR>
                <TD class=Padding3px width=5>&nbsp;</TD>
                <TD class=Padding3px>
                      <IMG height=10 src="../grafix/arrow1.gif"  width=10>&nbsp;
                      <STRONG><A class=Padding3px href="remainersagent.php">Υπόλοιπο</a></STRONG>
                </TD>
              </TR>

              <TR>
                <TD class=Padding3px>&nbsp;</TD>
                <TD class=Padding3px >
                      <IMG height=10  src="../grafix/arrow1.gif"  width=10>&nbsp;
                      <STRONG><a class=Padding3px href="transfermoney.php">Μεταφορά χρημάτων</a></STRONG>
                </TD>
              </TR>

               <TR>
                <TD colspan=2></TD>
              </TR>

              <TR>
                <TD class=shadebottom height=10 colspan=2><IMG src="../grafix/shadeholder.gif"></TD>
                <TD class=shadecorner width=10><IMG src="../grafix/shadeholder.gif"></TD>
              </TR>
              </TBODY>
            </TABLE>
</TD>
</TR>

      <?php } else { ?>
<TR>
<TD class=DummyPrint>
            <TABLE style="BACKGROUND-IMAGE: url(../grafix/biggradient.gif)" cellSpacing=0 cellPadding=0  align=left border=0 width=180px>
              <TBODY>
              <TR>
                <TD class=HeaderTD colSpan=2>Διαχείριση ταμείου</TD>
                <TD class=shaderight width=3 rowSpan=3>
                      <IMG src="../grafix/shadeholder.gif">
                </TD>
              </TR>
              <TR>
                <TD class=Padding3px width=5>&nbsp;</TD>
                <TD class=Padding3px>
                      <IMG height=10 src="../grafix/arrow1.gif"  width=10>&nbsp;
                      <STRONG><A class=Padding3px href="remainer.php">Υπόλοιπο</a></STRONG>
                </TD>
              </TR>

               <TR>
                <TD colspan=2></TD>
              </TR>

              <TR>
                <TD class=shadebottom height=10 colspan=2><IMG src="../grafix/shadeholder.gif"></TD>
                <TD class=shadecorner width=10><IMG src="../grafix/shadeholder.gif"></TD>
              </TR>
              </TBODY>
            </TABLE>
</TD>
</TR>
      <?php } ?>




     <?php if ($_SESSION['user/level'] == 'superagents')  { ?>
<TR>
<TD class=DummyPrint>
         <TABLE style="BACKGROUND-IMAGE: url(../grafix/biggradient.gif)" cellSpacing=0 cellPadding=0  align=left border=0 width=180px>
            <TBODY>
            <TR>
              <TD class=HeaderTD colSpan=2>Διαχείριση agent</TD>
              <TD class=shaderight width=3 rowSpan=3>
                    <IMG src="../grafix/shadeholder.gif">
              </TD>
            </TR>

            <TR>
              <TD class=Padding3px >&nbsp;</TD>
              <TD class=Padding3px>
                    <IMG height=10 src="../grafix/arrow1.gif"  width=10>&nbsp;
                    <STRONG><a class=Padding3px href="userlist.php">Δημιουργία agent</a></STRONG>
              </TD>
            </TR>


            <TR>
              <TD colspan=2></TD>
            </TR>
            <TR>
              <TD class=shadebottom height=10 colspan=2><IMG src="../grafix/shadeholder.gif"></TD>
              <TD class=shadecorner width=10><IMG src="../grafix/shadeholder.gif"></TD>
            </TR>
            </TBODY>
          </TABLE>
</TD>
</TR>

     <?php } ?>

<TR>
<TD class=DummyPrint>
         <TABLE style="BACKGROUND-IMAGE: url(../grafix/biggradient.gif)" cellSpacing=0 cellPadding=0  align=left border=0 width=180px>
            <TBODY>
            <TR>
              <TD class=HeaderTD colSpan=2>Αλλαγή κωδικού</TD>
              <TD class=shaderight width=3 rowSpan=3>
                    <IMG src="../grafix/shadeholder.gif">
              </TD>
            </TR>

            <TR>
              <TD class=Padding3px >&nbsp;</TD>
              <TD class=Padding3px>
                    <IMG height=10 src="../grafix/arrow1.gif"  width=10>&nbsp;
                    <STRONG><a class=Padding3px href="changepassword.php">Αλλαγή κωδικού</a></STRONG>
              </TD>
            </TR>


            <TR>
              <TD colspan=2></TD>
            </TR>
            <TR>
              <TD class=shadebottom height=10 colspan=2><IMG src="../grafix/shadeholder.gif"></TD>
              <TD class=shadecorner width=10><IMG src="../grafix/shadeholder.gif"></TD>
            </TR>
            </TBODY>
          </TABLE>
</TD>
</TR>
      <!-- END CONTRIGHT-->

</TABLE>
    </TD>