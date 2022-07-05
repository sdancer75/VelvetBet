<?php
    session_start();
    include '../includes/database.php';
    include '../includes/login.php';
    include '../includes/statistics.php';


     $LoginMsg = '';
     $DB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
     mysql_select_db(DataBase, $DB) or die(mysql_error());
     mysql_query("SET NAMES 'utf8'");

     SaveLog(-1,$_SESSION['user/id'],0,$_SERVER['HTTP_USER_AGENT'],$Description,'Πλοήγηση χρήστη στη σελίδα ['.$_SESSION['user/pagenavigation'].'] του περιβάλλοντος του.');

     if (!check_login('masterusers') )
        header( 'Location: ../index.php' ) ;

    mysql_close($DB);


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HEAD>
<HTML xmlns="http://www.w3.org/1999/xhtml">
<TITLE>VelvetBet - Στοιχήματα Ποδοσφαίρου</TITLE>
 <?php include '../includes/metatagsgr.php' ?>

<link href="../betplatform.css" rel="stylesheet" type="text/css">


<link rel="stylesheet" type="text/css" href="../build/fonts/fonts-min.css" />
<link rel="stylesheet" type="text/css" href="../build/datatable/assets/skins/sam/datatable.css" />
<link rel="stylesheet" type="text/css" href="../build/paginator/assets/skins/sam/paginator.css" />
<link rel="stylesheet" type="text/css" href="../build/button/assets/skins/sam/button.css" />
<link rel="stylesheet" type="text/css" href="../build/tabview/assets/skins/sam/tabview.css" />
<link rel="stylesheet" type="text/css" href="../build/container/assets/skins/sam/container.css" />
<link type="text/css" rel="stylesheet" href="../build/calendar/assets/skins/sam/calendar.css">
<link rel="stylesheet" type="text/css" href="../build/menu/assets/skins/sam/menu.css" />

<script type="text/javascript" src="../build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="../build/container/container-min.js"></script>
<script type="text/javascript" src="../build/menu/menu-min.js"></script>
<script type="text/javascript" src="../build/dragdrop/dragdrop-min.js"></script>
<script type="text/javascript" src="../build/element/element-min.js"></script>
<script type="text/javascript" src="../build/button/button-min.js"></script>
<script type="text/javascript" src="../build/datasource/datasource-min.js"></script>
<script type="text/javascript" src="../build/datatable/datatable-min.js"></script>
<script type="text/javascript" src="../build/tabview/tabview-min.js"></script>
<script type="text/javascript" src="../build/paginator/paginator-min.js"></script>
<script type="text/javascript" src="../build/connection/connection-min.js"></script>
<script type="text/javascript" src="../build/json/json-min.js"></script>
<script type="text/javascript" src="../build/calendar/calendar-min.js"></script>



<script type="text/javascript" src="../js/dateformat.js"></script>

<!--begin custom header content for this example-->
<style type="text/css">


/* Remove row striping, column borders, and sort highlighting */
.yui-skin-sam tr.yui-dt-odd
{
  background-color: #FFEFC6;

}

.yui-skin-sam tr.yui-dt-odd td.yui-dt-asc,
.yui-skin-sam tr.yui-dt-odd td.yui-dt-desc,
.yui-skin-sam tr.yui-dt-even td.yui-dt-asc,
.yui-skin-sam tr.yui-dt-even td.yui-dt-desc {
    background-color: #AfAfAf;
}
.yui-skin-sam .yui-dt tbody td {
    border-bottom: 0px solid #ddd;
}

.yui-skin-sam .yui-dt thead th {
    border-bottom: 0px solid #7f7f7f;
}



.yui-skin-sam .yui-dt tr.yui-dt-last td,
.yui-skin-sam .yui-dt th,
.yui-skin-sam .yui-dt td {
    border-bottom: 0px solid #7f7f7f;
    text-align: center;
}



/* custom styles for this example */
.yui-skin-sam .yui-dt-body { cursor:pointer; } /* when cells are selectable */
#cellrange, #singlecell { margin-top:2em; }





/* custom styles for this example */
.modform {margin-bottom: 1em;}
.index {width:5em;}

.myHighlightClassName {
    background-color: #FFCA95;
    Color:black;
}


.yui-skin-sam .yui-checkbox-button button {
    width: 4em;
}

.yui-skin-sam .yui-dt td.BetType {
    background-color: #FFFFD7;
    Color:black;
}


/* Class for marked rows */
.yui-skin-sam .yui-dt tr.BetTypeTotalRow,
.yui-skin-sam .yui-dt tr.BetTypeTotalRow td.yui-dt-asc,
.yui-skin-sam .yui-dt tr.BetTypeTotalRow td.yui-dt-desc,
.yui-skin-sam .yui-dt tr.BetTypeTotalRow td.yui-dt-asc,
.yui-skin-sam .yui-dt tr.BetTypeTotalRow td.yui-dt-desc {
    background-color: black;
    Color:white;
    font-weight: bold
}

/* Class for marked rows */
.yui-skin-sam .yui-dt tr.BetTypeAgentLabel,
.yui-skin-sam .yui-dt tr.BetTypeAgentLabel td.yui-dt-asc,
.yui-skin-sam .yui-dt tr.BetTypeAgentLabel td.yui-dt-desc,
.yui-skin-sam .yui-dt tr.BetTypeAgentLabel td.yui-dt-asc,
.yui-skin-sam .yui-dt tr.BetTypeAgentLabel td.yui-dt-desc {
    background-color: #FFCC00;
    Color:black;
    font-weight: bold;
    font-size: 12px;
    height: 30px;

}

/* Class for marked rows */
.yui-skin-sam .yui-dt tr.EmptyLine,
.yui-skin-sam .yui-dt tr.EmptyLine td.yui-dt-asc,
.yui-skin-sam .yui-dt tr.EmptyLine td.yui-dt-desc,
.yui-skin-sam .yui-dt tr.EmptyLine td.yui-dt-asc,
.yui-skin-sam .yui-dt tr.EmptyLine td.yui-dt-desc {
    background-color: white;
    Color:white;
    font-weight: bold;
    height: 15px
}

/* Class for marked rows */
.yui-skin-sam .yui-dt tr.Title,
.yui-skin-sam .yui-dt tr.Title td.yui-dt-asc,
.yui-skin-sam .yui-dt tr.Title td.yui-dt-desc,
.yui-skin-sam .yui-dt tr.Title td.yui-dt-asc,
.yui-skin-sam .yui-dt tr.Title td.yui-dt-desc {
    background-color: gray;
    Color:white;
    font-weight: bold;
    height: 15px
}

/* Class for marked rows */
.yui-skin-sam .yui-dt tr.Total,
.yui-skin-sam .yui-dt tr.Total td.yui-dt-asc,
.yui-skin-sam .yui-dt tr.Total td.yui-dt-desc,
.yui-skin-sam .yui-dt tr.Total td.yui-dt-asc,
.yui-skin-sam .yui-dt tr.Total td.yui-dt-desc {
    background-color: #BFD5FF;
    Color:black;
    font-weight: bold;
    font-size: 12px;
    height: 30px;

}

.yui-skin-sam .yui-dt td.BetTypeTotal {
    background-color: black;
    Color:white;
    font-weight: bold
}

.yui-button#pushbuttonDelete button {

    padding-left: 3em;
    background: url(../grafix/delete.png) 10% 50% no-repeat;


}

.yui-skin-sam .yui-dt td.Lose {


    Color:#FF0000;
}

.yui-skin-sam .yui-dt td.Win {

    Color:#000000;

}

.yui-skin-sam .yui-dt td.TotalWin {

    Color:#FFFFFF;

}

.calweekdaycell {
  background: #FFD700
}

#menubutton2 {

    width: 22em;


}

</style>

</HEAD>


<BODY class="yui-skin-sam"  oncontextmenu="return false">

<div align=top>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
  <TBODY>
  <TR>
    <TD class=logoback colSpan=2>
                <?php include '../includes/logo.php' ?>
    </TD>
  </TR>
  <TR>
    <TD class=logoback colSpan=2 height=10>
    </TD>
  </TR>
  <TR>
    <TD class=InfoTitle colSpan=2 bgcolor="#575348">

       <?php include 'includes/information.php' ?>


    </TD>
  </TR>

  <TR>
    <TD class=logoback colSpan=2 height=10></TD>
  </TR>
<!--
  <TR>
    <TD class=HeaderOptions colSpan=2 bgcolor="#475658" height="30px" align="right"><a href="#" class="HeaderOptions">Κεντρική σελίδα</a> | <a  href="#" class="HeaderOptions">Έξοδος </a></TD>
  </TR>
-->
  <TR>
    <TD class=DummyPrint bgcolor="#CCCC99" style="FONT-SIZE:14px" colSpan=2  height="25px" align="center">
                <strong>Ενεργοποίηση / Απενεργοποίηση χρηστών</strong>
    </TD>
  </TR>


   <!-- hide the stuff the they are repeated -->
   <?php include 'includes/panel.php' ?>



    <TD style="VERTICAL-ALIGN: top;" width="100%" >


      <Table border=0 width="100%">
        <TR>
            <TD class="yui-skin-sam" style="FONT-SIZE: 11px;"  valign="top" width="100%" style="FONT-SIZE: 10px;">

                <div id="tvcontainer" class="yui-navset">

                    <ul class="yui-nav">
                        <li class="selected"><a href="#tab1"><em>Πρόσβαση χρηστών στο σύστημα</em></a></li>
                    </ul>

                    <div class="yui-content">
                      <br><br>


                      <Table width=100%>
                      <tr>
                        <td align=left>

                                        <?php

									    $myDB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
										mysql_select_db(DataBase, $myDB) or die(mysql_error());
                                        mysql_query("SET NAMES 'utf8'");


                                        if (isset($_GET['ShutDownEnabled'])) {

                                           if (($_GET['Table'] == 'agents') && ($_GET['ShutDownEnabled'] == 1) )
                                                $sqlquery ="update agents set ShutDownEnabled=1, session='$0', cookie='$1'";
                                           else if ( ($_GET['Table'] == 'agents') && ( $_GET['ShutDownEnabled'] == 0) )
                                                $sqlquery ="update agents set ShutDownEnabled=0, session='$0', cookie='$1'";
                                           else if ( ($_GET['Table'] == 'superagents') && ( $_GET['ShutDownEnabled'] == 0) )
                                                $sqlquery ="update superagents set ShutDownEnabled=0, session='$0', cookie='$1'";
                                           else if ( ($_GET['Table'] == 'superagents') && ( $_GET['ShutDownEnabled'] == 1) )
                                                $sqlquery ="update superagents set ShutDownEnabled=1, session='$0', cookie='$1'";

                                           $result_id = mysql_query($sqlquery);
                                        }



                                        $sqlquery ="select IFNULL(ShutDownEnabled,0) as agents from agents limit 1";
                            			$result_id = mysql_query($sqlquery);
                                        $NumRecords = mysql_num_rows($result_id);
                                        $row = mysql_fetch_assoc($result_id);
                                        if ($row) {
                                            if ( $NumRecords == 0)  {
                                                $AgentStatus = 0;
                                            } else  {
                                                $AgentStatus = $row['agents'];
                                            }

                                            if ($AgentStatus==0)
                                                $AgentMsg="<span style=\"color:#006600\">Ενεργή (επιτρέπεται η πρόσβαση)</span>";
                                            else
                                                $AgentMsg="<span style=\"color:#FF0000\">Mη Ενεργή (δεν επιτρέπεται η πρόσβαση)</span>";

                                        }

                                        $sqlquery ="select IFNULL(ShutDownEnabled,0) as superagents from superagents limit 1";
                            			$result_id = mysql_query($sqlquery);
                                        $NumRecords = mysql_num_rows($result_id);
                                        $row = mysql_fetch_assoc($result_id);
                                        if ($row) {
                                            if ( $NumRecords == 0)  {
                                                $SAgentStatus = 0;
                                            } else  {
                                                $SAgentStatus = $row['superagents'];
                                            }

                                        if ($SAgentStatus==0)
                                                $SAgentMsg="<span style=\"color:#006600\">Ενεργή (επιτρέπεται η πρόσβαση)</span>";
                                            else
                                                $SAgentMsg="<span style=\"color:#FF0000\">Mη Ενεργή (δεν επιτρέπεται η πρόσβαση)</span>";

                                        }



                                        ?>
                                        <b>Agents</b><br>
                                        <hr width="100%" style="Color:red;"></hr>
                                        <br><br>
                                        Κατάσταση πρόσβασης Agent : <b><?php echo $AgentMsg ?></b>
                                        <br><br>
                                        <a href="shutdown.php?ShutDownEnabled=1&Table=agents">Απενεργοποίηση χρηστών</a> |
                                        <a href="shutdown.php?ShutDownEnabled=0&Table=agents">Ενεργοποίηση χρηστών</a>
                                        <br><br>   <br><br>
                                        <br><br>  <br><br>   <br><br>

                                        <b>Super Agents</b><br>
                                        <hr width="100%" style="Color:red;"></hr>
                                        <br><br>
                                        Κατάσταση πρόσβασης Super Agent : <b><?php echo $SAgentMsg ?></b>
                                        <br><br>
                                        <a href="shutdown.php?ShutDownEnabled=1&Table=superagents">Απενεργοποίηση χρηστών</a> |
                                        <a href="shutdown.php?ShutDownEnabled=0&Table=superagents">Ενεργοποίηση χρηστών</a>

                                        <br><br>   <br><br>


                      </td>
                      </tr>
                      </table>

                       <br><br>



                        <br>


                        <br><br>

                    </div>
                </div>


            </TD>
        </TR>



        </Table>







    </TD>
  </TR>
  <TR>
    <TD class=footerback colSpan=2>
         <?php include '../includes/footer.php' ?>
    </TD>
  </TR>
</TBODY>
</TABLE>
</div>

     <Script type="text/javascript">

        var DataTable;
        var ViewAgentFilter = '*';



           var ajaxLoadingPanel = new YAHOO.widget.Panel('ajaxLoadPanel', {
                width:"240px",
                fixedcenter:true,
                close:false,
                draggable:false,
                modal:true,
                visible:false
                //effect:{effect:YAHOO.widget.ContainerEffect.FADE,duration:0.25}
            }
            );

            ajaxLoadingPanel.setHeader('Παρακαλώ περιμένετε...');
            ajaxLoadingPanel.setBody('<img src="../grafix/ajax-loader.gif" />');
            ajaxLoadingPanel.render(document.body);
            ajaxLoadingPanel.bringToTop();
            //Create a SimpleDialog used to mimic an OS dialog
            var panel = new YAHOO.widget.SimpleDialog('alert', {
                fixedcenter: true,
                visible: false,
                modal: true,
                width: '600px',
                constraintoviewport: true,
                icon: YAHOO.widget.SimpleDialog.ICON_WARN,
                buttons: [
                    { text: 'OK', handler: function() {
                        panel.hide();
                    }, isDefault: true }
                ]
            });
            //Set the header
            panel.setHeader('Alert');
            //Give the body something to render with
            panel.setBody('Notta');
            //Render the Dialog to the body
            panel.render(document.body);

            //Create a namepaced alert method
            YAHOO.example.alert = function(str) {

                //Set the body to the string passed
                panel.setBody(str);
                //Set an icon
                panel.cfg.setProperty('icon', YAHOO.widget.SimpleDialog.ICON_WARN);
                //Bring the dialog to the top
                panel.bringToTop();
                //Show it
                panel.show();
            };







         var myTabView = new YAHOO.widget.TabView("tvcontainer");

    </script>

</BODY>
</HTML>
