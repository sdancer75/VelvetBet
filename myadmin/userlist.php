<?php
    session_start();
    include '../includes/database.php';
    include '../includes/login.php';
    include '../includes/statistics.php';    


     $LoginMsg = '';
     $DB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
     mysql_select_db(DataBase, $DB) or die(mysql_error());

    if (!check_login('masterusers') )
        header( 'Location: ../index.php' ) ;

    mysql_close($DB);


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">

<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE>VelvetBet - Στοιχήματα Ποδοσφαίρου</TITLE>
<?php include '../includes/metatagsgr.php' ?>

<link href="../betplatform.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" href="../build/fonts/fonts-min.css" />
<link rel="stylesheet" type="text/css" href="../build/datatable/assets/skins/sam/datatable.css" />
<link rel="stylesheet" type="text/css" href="../build/paginator/assets/skins/sam/paginator.css" />
<link rel="stylesheet" type="text/css" href="../build/button/assets/skins/sam/button.css" />
<link rel="stylesheet" type="text/css" href="../build/tabview/assets/skins/sam/tabview.css" />
<link rel="stylesheet" type="text/css" href="../build/paginator/assets/skins/sam/paginator.css" />
<link rel="stylesheet" type="text/css" href="../build/container/assets/skins/sam/container.css" />
<link type="text/css" rel="stylesheet" href="../build/calendar/assets/skins/sam/calendar.css">

<script type="text/javascript" src="../build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="../build/dragdrop/dragdrop-min.js"></script>
<script type="text/javascript" src="../build/element/element-min.js"></script>
<script type="text/javascript" src="../build/button/button-min.js"></script>
<script type="text/javascript" src="../build/datasource/datasource-min.js"></script>
<script type="text/javascript" src="../build/datatable/datatable-min.js"></script>
<script type="text/javascript" src="../build/tabview/tabview-min.js"></script>
<script type="text/javascript" src="../build/paginator/paginator-min.js"></script>
<script type="text/javascript" src="../build/animation/animation-min.js"></script>
<script type="text/javascript" src="../build/container/container-min.js"></script>
<script type="text/javascript" src="../build/connection/connection-min.js"></script>
<script type="text/javascript" src="../build/json/json-min.js"></script>
<script type="text/javascript" src="../build/calendar/calendar-min.js"></script>


<script type="text/javascript" src="../js/dateformat.js"></script>
<script type="text/javascript" src="../js/verifyinput.js"></script>


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
    background-color: #F8FCFF;
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



/*custom columns */
.yui-skin-sam .yui-dt td.ee1 {
    background-color: #FF0000;
    Color:white;
}
.yui-skin-sam .yui-dt td.ee2 {
    background-color: #FF8040;
    Color:white;
}
.yui-skin-sam .yui-dt td.ee3 {
    background-color: #00CC00;
    Color:white;
}

.yui-skin-sam .yui-dt td.ee4 {
    background-color: #000099;
    Color:white;
}

 .yui-skin-sam .yui-dt td.ee5 {
    background-color: #CCCC66;
    Color:white;
}

.yui-skin-sam .yui-dt td.time {
    background-color: #FFCA95;
    Color:black;

}

.yui-skin-sam .yui-dt td.goal {
    background-color: #FAFEC2;
    Color:black;
    font-weight: bold;

}

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



.yui-button#pushbuttonAddRec button {

    padding-left: 3em;
    background: url(../grafix/save.png) 10% 50% no-repeat;


}
.yui-button#pushbuttonAdd2List button {

    padding-left: 0px;
    padding-right: 0px;
    width: 70px;
    height: 70px;
    background: url(../grafix/rigth-arrow.png) 100% 100% no-repeat;


}


.yui-button#pushbuttonFindRec button {

    padding-left: 3em;
    background: url(../grafix/add.gif) 10% 50% no-repeat;


}
/*
#paginated {
    text-align: center;
}
#paginated table {
    margin-left:auto; margin-right:auto;
}
*/


.calweekdaycell {
  background: #FFD700
}


/*custom columns */
.yui-skin-sam .yui-dt td.win {
    background-color: #339900;
    Color:white;
}
.yui-skin-sam .yui-dt td.lost {

    background-color: #FF0000;
    Color:white;
}

.delete-button {
	cursor:pointer;
	background: #FFFFCC url(../grafix/delete.png) no-repeat center center;
	width:16px;height:16px;
}

.linkgo-button {
	cursor:pointer;
	background: transparent url(../grafix/link_go.png) no-repeat center center;
	width:16px;height:16px;
}

.sagentprojection-button {
	cursor:pointer;
	background: transparent url(../grafix/boss.png) no-repeat center center;
	width:16px;height:16px;
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
    <TD bgcolor="#CCCC99" style="FONT-SIZE:14px" colSpan=2  height="25px" align="center">
                <strong>Διαχείριση χρηστών</strong>
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
                        <li class="selected"><a href="#tab1"><em>Λίστα Χρηστών</em></a></li>
                        <li><a href="#tab2"><em>Δημιουργία χρήστη</em></a></li>
                    </ul>
                    <div class="yui-content">

                        <table>
                        <tr>
                            <TD>

                             <br><br>

                              <b>SUPER AGENTS</b><br>
							  <hr width="100%" style="Color:red;"></hr>
							  <br>
                              <div id="paginated" align="left"></div>
                              <br><br><br>
                              <b>AGENTS</b><br>
							  <hr width="100%" style="Color:red;"></hr>
							  <br>
                              <div id="paginatedAgent" align="left"></div>

                             </TD>
                        </tr>
                        </table>





                        <div><p>

                              <form  id="submit" >
                              <Table width=400px>
                              <TR>
                                  <TD colspan=4>
                                     Όνομα Agent
                                  </TD>
                              </TR>
                              <TR>
                                  <TD colspan=4 >
                                      <INPUT name="Name" id="Name" size="50" maxlength="50" onkeyup="this.value=this.value.toLowerCase()" onkeypress="editKeyBoard(event,keybAlphaNumeric);">
								  	  <br><br>
                                  </TD>
                              </TR>


                              <TR>
                                  <TD colspan=4>
                                     Κωδικός
                                  </TD>
                              </TR>
                              <TR>

                                <TD colspan=4 valign="middle" align="left">

                                    <INPUT name="zPassword" id="zPassword" size="50" maxlength="10" onkeyup="this.value=this.value.toLowerCase()" onkeypress="editKeyBoard(event,keybAlphaNumeric);">
								  	<br><br>
                                </TD>
                              </TR>

                              <TR>
                                  <TD colspan=4>
                                     Πόλη
                                  </TD>
                              </TR>
                              <TR>
                                  <TD colspan=4 valign="middle" align="left">
                                      <INPUT name="City" id="City" size="50" maxlength="50" >
								  	  <br><br>

                                </TD>
                              </TR>
<!--
                              <TR>
                                  <TD colspan=4>
                                     Τηλέφωνο
                                  </TD>
                              </TR>
                              <TR>
                                  <TD colspan=4 valign="middle" align="left">
-->
                                      <INPUT type="hidden" name="Phone" id="Phone" size="50" maxlength="15"  onkeypress="editKeyBoard(event,keybNumeric);">
<!--
								  	  <br><br>

                                </TD>
                              </TR>

-->

                              <TR>
                                  <TD colspan=4>
                                     Επίπεδο χρήστη
                                  </TD>
                              </TR>
                              <TR>
                                  <TD colspan=4 valign="middle" align="left">

                                  <select style=" width:25em;" name="AgentType" id="AgentType" size="1" onchange="checkSelectSAgent();">
                                      <option value="superagents">Super Agent</option>
                                      <option value="agents">Agent</option>
                                  </select>
								  <br><br>

                                </TD>
                              </TR>

                              <TR>
                                  <TD colspan=4>
                                     Συσχέτιση με Super Agent
                                  </TD>
                              </TR>

                              <TR>
                                  <TD colspan=4 valign="middle" align="left">

                                  <select style=" width:25em;" name="SelectSAgent" id="SelectSAgent" size="1" >

                                         <?php
									        $myDB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
										    mysql_select_db(DataBase, $myDB) or die(mysql_error());
                                           	mysql_query("SET NAMES 'utf8'");
											$query_result = mysql_query("select * from superagents order by name Asc");
										    while ($row = mysql_fetch_assoc($query_result)) {

										  ?>

											<OPTION value="<?php echo $row['SAgentID']?>"><?php echo $row['Name']?></OPTION>

										  <?php
											}
											mysql_close($myDB);

										  ?>

    							  </select>
								  <br><br>


                                </TD>
                              </TR>

<!--
                              <TR>
                                  <TD colspan=4>
                                     Όριο κόστους > από
                                  </TD>
                              </TR>
                              <TR>
                                  <TD colspan=4 valign="middle" align="left">

                                        <INPUT name="verify_cost" size="50" maxlength="50">


                                </TD>
                              </TR>

                              <TR>
                                  <TD colspan=4>
                                     Όριο αθροίσματος πιθανού κέρδους > από
                                  </TD>
                              </TR>
                              <TR>
                                  <TD colspan=4 valign="middle" align="left">

                                        <INPUT name="verify_profit" size="50" maxlength="50">


                                </TD>
                              </TR>

 -->
                              </TABLE>

                              <br><br>


                              <TABLE border=0 width=200px>
                              <TR>
                                  <TD colspan=4>
                                        <strong>Προμήθεια Super Agents</strong>
                                        <HR width=100%>
                                  </TD>
                              </TR>
                              <TR>
                                  <TD  colspan=2 valign="middle" align="left">

                                         Επί του τζίρου

                                </TD>
                                  <TD colspan=2 valign="middle" align="left">

                                         Επί του κέρδους

                                </TD>
                              </TR>
                              <TR>
                                  <TD colspan=2 valign="middle" align="left">

                                         <INPUT onkeypress="editKeyBoard(event,keybNumeric);" style="TEXT-ALIGN:CENTER;" name="Commission_tziros" id="Commission_tziros" size="10" maxlength="2" value=0 >


                                </TD>
                                  <TD colspan=2 valign="middle" align="left">

                                        <INPUT onkeypress="editKeyBoard(event,keybNumeric);" style="TEXT-ALIGN:CENTER;" name="Commission_pososto" id="Commission_pososto" size="10" maxlength="2" value=0>


                                </TD>
                              </TR>


                               <TR>
                                  <TD colspan=4>
                                        <br><br>
                                        <strong>Προμήθεια Αgents</strong>
                                        <HR width=100%>
                                  </TD>
                              </TR>
                              <TR>
                                  <TD  valign="middle" align="left">

                                   Mονά


                                </TD>
                                  <TD  valign="middle" align="left">

                                   Διπλά


                                </TD>
                                  <TD  valign="middle" align="left">

                                   3άδες<br>και άνω


                                </TD>
                                  <TD  valign="middle" align="left">

                                   Συστήματα


                                </TD>
                              </TR>
                              <TR>
                                  <TD  valign="middle" align="left">

                                         <INPUT onkeypress="editKeyBoard(event,keybNumeric);" style="TEXT-ALIGN:CENTER;" name="Mona" id="Mona" size="5" maxlength="2" value=0>


                                </TD>
                                 <TD  valign="middle" align="left">

                                         <INPUT onkeypress="editKeyBoard(event,keybNumeric);" style="TEXT-ALIGN:CENTER;" name="Dipla" id="Dipla" size="5" maxlength="2" value=0>


                                </TD>
                                <TD  valign="middle" align="left">

                                         <INPUT onkeypress="editKeyBoard(event,keybNumeric);" style="TEXT-ALIGN:CENTER;" name="Triades" id="Triades" size="5" maxlength="2" value=0>


                                </TD>
                                <TD  valign="middle" align="left">

                                         <INPUT onkeypress="editKeyBoard(event,keybNumeric);" style="TEXT-ALIGN:CENTER;" name="Systems" id="Systems" size="5" maxlength="2" value=0>


                                </TD>
                              </TR>






                              <TR>
                                  <TD align="right" colspan=4>

                                     <br><br>
                                     <span id="pushbuttonAddRec" class="yui-button yui-push-button">
                                      <strong class="first-child">
                                        <button type="button" name="pushbuttonAddRec">Αποθήκευση</button>
                                      </strong>
                                      </span>

                                  </TD>
                              </TR>
                              </TABLE>
                              </form>
                        </p></div>



                    </div>



                </div>


            </TD>
        </TR>



        </Table>

        <div id="dialog1">
        <div class="hd">Προβολή Super Agent</div>
        <div class="bd">
        <form method="GET" id="BetListForm" name="BetListForm">

                   <label for="Λιστα">Λίστα καταχωρημένων super agent που μπορεί να δεί ο superagent </label>
                   <div id="cur_sagent">lakis</div>
                   <br><br>
                   <div align=center>

                   <Table width=100% border=0>
                   <tr>
                   <td>
                   <select id="SAgentList" name="SAgentList" size="15" style="width:15em">


                      <?php

                           //save the userbetssynopsis table and get the primary ID
                           $DB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
                           mysql_select_db(DataBase, $DB) or die(mysql_error());
                       	   mysql_query("SET NAMES 'utf8'");


                           $result_id = mysql_query("select Name,SAgentID from superagents");
                           while ($row = mysql_fetch_assoc($result_id)) {
                              echo '<option value="'.$row['SAgentID'].'">'.$row['Name'].'</option>';
                           }


                           mysql_close($DB);



                      ?>

                   </select>
                   </td>

                   <td align="center">


                     <span id="pushbuttonAdd2List" class="yui-button yui-push-button">
                      <strong class="first-child">
                        <button type="button" name="pushbuttonAdd2List"></button>
                      </strong>
                      </span>
                   </td>

                   <td valign="top">
                      <div id="superagentslist">

                      </div>

                   </td>

                   </tr>
                   </Table>




                   </div>

            <br><br>

        </form>
        </div>
        </div>

      <Script type="text/javascript">
                //************************************************** SUPER AGENT *********************************************************
        var DataTable;
        var AgentDataTable;
        var DataTableSAgentProjection;
        var SelectedSAgentID = -1;
        var elDropDownSagents;
        var sagentname = '';

            YAHOO.namespace("example.container");

          	var handleCancel = function() {
          		this.cancel();
          	};

          	// Instantiate the Dialog
          	YAHOO.example.container.dialog1 = new YAHOO.widget.Dialog("dialog1",
          							{ width : "40em",
          							  fixedcenter : true,
          							  visible : false,
          							  constraintoviewport : true,
                                      buttons : [ { text:"Κλείσιμο", handler:handleCancel, isDefault:true } ]
          							});




          	// Render the Dialog
          	YAHOO.example.container.dialog1.render();

            function prepareBetList(recordID) {

              var listbox=document.BetListForm.BetList;
              var recID=0;

              for (var i=0;i<DataTable.getRecordSet().getLength();i++) {

                if (recordID == DataTable.getRecordSet().getRecord(i)._nCount) {

                    recID = i;

                }

              }

              var ListArray = DataTable.getRecordSet().getRecord(recID)._oData.BetList.split(',');



              // first, remove all what is in the listbox
               while (listbox.options.length!=0)
                  listbox.remove(0);

               // now, fill it !
               for (var m=0; m<ListArray.length; m++)
                  // if you conditionnaly fill the list, put the condition here (for exemple : if (my_array[m][1]>"whatever"))
               {
                   var oOption = document.createElement("OPTION");
                   oOption.text='Δελτίο - ' + ListArray[m];
                   oOption.value=ListArray[m];
                   listbox.options.add(oOption)
               }

               document.getElementById('BetList').selectedIndex = 0;


              YAHOO.example.container.dialog1.show();

            }



            parseSQLDate = function(ISOdate)
            {

                if (ISOdate == undefined)
                    return;
                    
                var time = '';
                var pos = ISOdate.indexOf('-');
                var year = ISOdate.substr(0,pos);

                var pos2 = ISOdate.indexOf('-',pos+1);
                var month =  ISOdate.substr(pos+1,(pos2-pos-1));

                pos = ISOdate.indexOf(' ');
                if (pos != -1) {
                    var day =  ISOdate.substr(pos2+1,(pos-pos2-1));
                    time = ISOdate.substr(pos+1);

                }
                else
                    var day =  ISOdate.substr(pos2+1);




                if (pos != -1) {
                    var jsdate = new Date (month+"/"+day+"/"+year+' '+ time);
                    var formatedDateTime = dateFormat(jsdate,"dd/mm/yyyy HH:MM");
                }
                else {
                    var jsdate = new Date (month+"/"+day+"/"+year);
                    var formatedDateTime = dateFormat(jsdate,"dd/mm/yyyy");
                }


                return formatedDateTime;
            };


            function LogicalXOR(a,b) {
              return ( a || b ) && !( a && b );
            };

            //************ virtual functions for dynamic drop down updating *************************

		    YAHOO.widget.DropdownCellEditor.prototype.renderForm = function() {

                var elDropdown = this.getContainerEl().appendChild( document.createElement( "select") );
                elDropdown.style. zoom = 1;
                this.dropdown = elDropdown;

                this.setOptions( );

                if(this.disableBtns ) {
                    this.handleDisabledBtns();
                }
            };




            YAHOO.widget.DropdownCellEditor.prototype.setOptions = function () {

                var elDropdown = this.dropdown;

                elDropdown.innerHTML = "";
                if(YAHOO.lang.isArray( this.dropdownOptions)) {

                    var dropdownOption, elOption;
                    for(var i=0, j=this.dropdownOptions.length; i<j; i++) {
                        dropdownOption = this.dropdownOptions[i];
                        elOption = document.createElement("option" );
                        elOption.value = (YAHOO.lang.isValue( dropdownOption.value)) ? dropdownOption.value : dropdownOption;
                        elOption.innerHTML = (YAHOO.lang.isValue( dropdownOption.label)) ? dropdownOption.label : dropdownOption;
                        elOption = elDropdown.appendChild(elOption) ;
                    }
                }
            };

            //***********************************************************************************************

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



        function disableItems(agentType) {

            var oSelectSAgent = YAHOO.util.Dom.get("SelectSAgent");



            if ( agentType == "superagents"){
                 oSelectSAgent.disabled = true;
                 YAHOO.util.Dom.get("Mona").disabled = true;
                 YAHOO.util.Dom.get("Dipla").disabled = true;
                 YAHOO.util.Dom.get("Triades").disabled = true;
                 YAHOO.util.Dom.get("Systems").disabled = true;

          	     YAHOO.util.Dom.get("Commission_tziros").disabled = false;
      	         YAHOO.util.Dom.get("Commission_pososto").disabled = false;

            } else {

                 oSelectSAgent.disabled = false;
                 YAHOO.util.Dom.get("Mona").disabled = false;
                 YAHOO.util.Dom.get("Dipla").disabled = false;
                 YAHOO.util.Dom.get("Triades").disabled = false;
                 YAHOO.util.Dom.get("Systems").disabled = false;

          	     YAHOO.util.Dom.get("Commission_tziros").disabled = true;
      	         YAHOO.util.Dom.get("Commission_pososto").disabled = true;
            }

        };


		function checkSelectSAgent(){

            var oSelectSAgent = YAHOO.util.Dom.get("SelectSAgent");
       		var oAgentType = YAHOO.util.Dom.get("AgentType");

			if (oSelectSAgent.options.length < 1) {


			 	YAHOO.example.alert('Η λίστα των Super Agent είναι άδεια. Μέχρι να δημιουργήσετε κάποιον Super Agent δεν μπορείτε ' +
				  'να δημιουργήσετε απλούς Agents.');
				  
				oAgentType.options.selectedIndex = 'superagents';

			}

            disableItems (oAgentType.value);

			
		}

        function SyncDropDownagents() {

           var  oSelectSAgent = YAHOO.util.Dom.get("SelectSAgent");
           var optns='';

        	for (var i=0;i<oSelectSAgent.options.length;i++) {
        	        optns = optns + '{"value":"'+oSelectSAgent.options[i].value+'",';
        	        optns = optns + '"label":"'+oSelectSAgent.options[i].text+'"},';
       		}

            json = '['+optns.substr(0,optns.length-1)+']';


            elDropDownSagents.dropdownOptions = YAHOO.lang.JSON.parse(json);
            elDropDownSagents.setOptions();


        };


        var AjaxObject = {
        	handleSuccess:function(o){

                var oSelectSAgent = YAHOO.util.Dom.get("SelectSAgent");

                try {
                    var r = YAHOO.lang.JSON.parse(o.responseText);
                }
                catch (x) {
                    ajaxLoadingPanel.hide();

                    if ( o.responseText == 'userexist' ) {
                        YAHOO.example.alert("Η εγγραφή σας <b>δεν αποθηκεύτηκε</b> διότι είτε υπάρχει το όνομα χρήστη, ή ο συνδυασμός ονόματος χρήστη και κωδικού υπάρχει ήδη. Παρακαλώ επιλέξτε κάποιο άλλο όνομα χρήστη.");
                    } else
                        YAHOO.example.alert("JSON Parse failed! :" + o.responseText);
                    return;
                }




               //if super agent, add it to the
               if (YAHOO.util.Dom.get("AgentType").value == "superagents") {

                  DataTable.addRow({SAgentID:r.SAgentID,Name:r.Name,Password:r.Password,City:r.City,Phone:r.Phone,Commission_tziros:r.Commission_tziros,
                  Commission_pososto:r.Commission_pososto,RegDate:parseSQLDate(r.RegDate),LastLogin:parseSQLDate(r.LastLogin),Active:1,Remainder:0});

                  var optn = document.createElement("OPTION");
                  optn.text = r.Name;
                  optn.value = r.SAgentID;
                  oSelectSAgent.options.add(optn);

                  SyncDropDownagents();





               } else {

                    if  (SelectedSAgentID == eval(r.SAgentID)) {


                      AgentDataTable.addRow({SAgentID:r.SAgentID, AgentID:r.AgentID, Name:r.Name,Password:r.Password,City:r.City,Phone:r.Phone,Mona:r.Mona,
                      Dipla:r.Dipla, Triades:r.Triades, Systems:r.Systems, RegDate:parseSQLDate(r.RegDate),LastLogin:parseSQLDate(r.LastLogin),Active:1,Remainder:0});



                    }



               }

               YAHOO.util.Dom.get("Name").value = '';
               YAHOO.util.Dom.get("City").value = '';
               YAHOO.util.Dom.get("Phone").value = '';
               YAHOO.util.Dom.get("zPassword").value = '';



               YAHOO.util.Dom.get("Mona").value = 0;
               YAHOO.util.Dom.get("Dipla").value = 0;
               YAHOO.util.Dom.get("Triades").value = 0;
               YAHOO.util.Dom.get("Systems").value = 0;

			   YAHOO.util.Dom.get("Commission_tziros").value = 0;
			   YAHOO.util.Dom.get("Commission_pososto").value = 0;

			   ajaxLoadingPanel.hide();
               YAHOO.example.alert('Η εγγραφή σας αποθηκεύτηκε');
        	},

        	handleFailure:function(o){
        		alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή σας δεν αποθηκεύτηκε.');
        	},
        	startRequest:function(query) {
				ajaxLoadingPanel.show();
                YAHOO.util.Connect.asyncRequest('GET', query, callback);


        	}

        };

        /*
         * Define the callback object for success and failure
         * handlers as well as object scope.
         */
        var callback =
        {
        	success:AjaxObject.handleSuccess,
        	failure:AjaxObject.handleFailure,
        	scope: AjaxObject
        };


        function onAddRec(p_oEvent) {


               var oName = YAHOO.util.Dom.get("Name").value;
               var oCity = YAHOO.util.Dom.get("City").value;
               var oPhone = 0;
               var oPassword = YAHOO.util.Dom.get("zPassword").value;
               var oAgentType = YAHOO.util.Dom.get("AgentType").value;

               var oMona = YAHOO.util.Dom.get("Mona").value;
               var oDipla = YAHOO.util.Dom.get("Dipla").value;
               var oTriades = YAHOO.util.Dom.get("Triades").value;
               var oSystems = YAHOO.util.Dom.get("Systems").value;

			   var oCommission_tziros = YAHOO.util.Dom.get("Commission_tziros").value;
			   var oCommission_pososto = YAHOO.util.Dom.get("Commission_pososto").value;

                var oSelectSAgent = YAHOO.util.Dom.get("SelectSAgent");

               var currentTime = new Date();
               var month = currentTime.getMonth() + 1;
               var day = currentTime.getDate();
               var year = currentTime.getFullYear();
               var SqlToday = year + '-' + month + '-' + day;





			   
			   if (oAgentType == "superagents") {



			   		if ( (oName=='') || (oPassword=='') || !LogicalXOR((oCommission_tziros==0),(oCommission_pososto==0)) )  {

			   			YAHOO.example.alert('Παρακαλώ συμπληρώστε όλα τα υποχρεωτικά πεδία.<br><br>' +
						   'Τα πεδία <b>Όνομα Agent & Κωδικός</b> δεν επιτρέπεται να είναι κενά και<br>' +
						   'Τα πεδία <b>Επί του τζίρου ή Επί του κέρδους</b>  ένα εκ των δύο, δεν επιτρέπεται να είναι μηδέν.'
						   );
						   
					   return;

			   		}

                    if ( oPassword.length < 4 ) {

                            YAHOO.example.alert('Παρακαλώ πληκτρολογήστε τουλάχιστον 4 χαρακτήρες για το νέο κωδικό.');
                            return;
                    }


                    if ( (oCommission_tziros != 0) &&  (oCommission_pososto != 0) ) {

			   			YAHOO.example.alert('Δεν μπορείτε να έχετε ταυτόχρονα ποσοστά και στα δύο πεδία <b>Επί του τζίρου ή Επί του κέρδους</b>.' +
                                            'Μόνο ένα εκ των δυο πρέπει να έχει τιμή διαφορετική του μηδενός, το οποίο και θα ορίσει αυτόματα την ενεργή προμήθεια'
						   );
                        return;

                    }

       	           //disable sorting
       	           DataTable.set("sortedBy", null);

                    var queryForm = '&Name='+oName+'&City='+oCity+'&Phone='+oPhone+'&Password='+oPassword+'&Commission_tziros='+oCommission_tziros+'&Commission_pososto='+oCommission_pososto+'&RegDate='+SqlToday+'&LastLogin='+SqlToday;

                    // Start the transaction.
                   AjaxObject.startRequest('../includes/dataproxy.php?query=superagents&primaryKey=SAgentID&type=insert'+queryForm);



			   } else {
			   	
			   		if ( (oName=='') || (oCity=='') ||  (oPassword=='') ||
					   		(oMona==0) || (oDipla==0) || (oTriades==0) || (oSystems==0)) {

			   			YAHOO.example.alert('Παρακαλώ συμπληρώστε όλα τα υποχρεωτικά πεδία.<br><br>' +
						   'Τα πεδία <b>Όνομα Agent, Πόλη & Κωδικός</b> δεν επιτρέπεται να είναι κενά και<br>' +
						   'Τα πεδία <b>Μονά, Διπλά, 3άδες και άνω και Συστήματα</b>  δεν επιτρέπεται να είναι μηδέν.'
						   );

					   return;

			   		}

       	           //disable sorting
       	           AgentDataTable.set("sortedBy", null);
			   		
                    var queryForm = '&Name='+oName+'&City='+oCity+'&Phone='+oPhone+'&Password='+oPassword+'&Mona='+oMona+'&Dipla='+oDipla+'&Triades='+oTriades+'&Systems='+oSystems+'&SAgentID='+oSelectSAgent.options[oSelectSAgent.selectedIndex].value+'&RegDate='+SqlToday+'&LastLogin='+SqlToday;

                    // Start the transaction.
                   AjaxObject.startRequest('../includes/dataproxy.php?query=agents&primaryKey=AgentID&type=insert'+queryForm);

			  }

		   	
			   	


        }



        var οPushButtonAddRec = new YAHOO.widget.Button("pushbuttonAddRec");
        οPushButtonAddRec.on("click", onAddRec);



         function onAdd2List(p_oEvent) {
            var oSAgentList = YAHOO.util.Dom.get("SAgentList").value;
            var oSAgentListText = YAHOO.util.Dom.get("SAgentList").options[YAHOO.util.Dom.get("SAgentList").selectedIndex].text;



            if (SelectedSAgentID == oSAgentList) {

			      YAHOO.example.alert('Δεν μπορείτε να προσθέσετε το χρήστη <b>' + sagentname + '</b> στη λίστα διότι είναι ο super super agent.');
                  return;
            }

            for (var i=0;i<DataTableSAgentProjection.getRecordSet().getLength();i++) {

                 if ( eval(DataTableSAgentProjection.getRecordSet().getRecord(i)._oData.SAgentIDSlave) == eval(oSAgentList) ) {

			      YAHOO.example.alert('O χρήστης <b>' + oSAgentListText + '</b> υπάρχει ήδη στη λίστα.');
                  return;

                 }


            }


           ajaxLoadingPanel.show();
           YAHOO.util.Connect.asyncRequest('GET','../includes/dataproxy.php?query=superagentsprojection&type=insert&SAgentIDMaster=' + SelectedSAgentID + '&SAgentIDSlave=' + oSAgentList ,
              {

                  success: function (o) {

                          try {
                              var r = YAHOO.lang.JSON.parse(o.responseText);
                          }
                          catch (x) {
                              alert("JSON Parse failed!" + o.responseText);
                              return;
                          }
                          DataTableSAgentProjection.addRow({SAgentProjectionID:r.SAgentProjectionID,SAgentIDSlave:r.SAgentIDSlave,Name:oSAgentListText});
                          ajaxLoadingPanel.hide();

                  },
                  failure: function (o) {
                          alert('Κάποιο σφάλμα δημιουργήθηκε κατά την αποθύκευση στη λίστα.');
                  },
                  scope:this
              }

          );

         }




        var οPushButtonAdd2List = new YAHOO.widget.Button("pushbuttonAdd2List");
        οPushButtonAdd2List.on("click", onAdd2List);

        disableItems('superagents');





      var DropDownOptions = <?php


                 function get_pair_values($result_id, $primaryKey)
                  {

                          //************************ Get Values for Drop Down Menus ************************************

                           $first = 0;


                           $column_count = mysql_num_fields($result_id) or die("display_db_query:" . mysql_error());


                            while ($row = mysql_fetch_row($result_id)) {

                                for ($column_num = 0; $column_num < $column_count; $column_num++) {

                                    $field_name = mysql_field_name($result_id, $column_num);



                                    if($first==0){
                                          $field_value .= ($column_num == 0)?"{" :" ";
                                          $first = 1;
                                    }
                                    else {
                                          $field_value .= ($column_num == 0)?",{" :" ";
                                    }


                                    $colum_value = ($row[$column_num]==nil || $row[$column_num]=="") ? "\"" : "\"".$row[$column_num]."\"";

                                   if ($field_name == $primaryKey)
                                        $field_value .= "\"value\":".html_entity_decode($colum_value);
                                    else
                                        $field_value .= "\"label\":".html_entity_decode($colum_value);

                                    $field_value .= (($column_num + 1 ) == $column_count)?" } ":",";

                                }

                             }

                             //create envelop
                             $field_value = "'[".$field_value."]'";
                             return $field_value;



                  }

                 $DB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
                 mysql_select_db(DataBase, $DB) or die(mysql_error());
                 mysql_query("SET NAMES 'utf8'");
                 $result_id = mysql_query("select SAgentID, Name from superagents");
                 $MYDATASOURCE = get_pair_values($result_id,"SAgentID");
                 mysql_close($DB);
                 echo $MYDATASOURCE;


             ?>;

              elDropDownSagents = new YAHOO.widget.DropdownCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.",dropdownOptions:YAHOO.lang.JSON.parse(DropDownOptions),disableBtns:false});


              var formatSagents = function(elCell, oRecord, oColumn, oData) {


					for (var i=0;i<elDropDownSagents.dropdownOptions.length;i++) {

						if ( elDropDownSagents.dropdownOptions[i].value == oData ) {
							elCell.innerHTML = elDropDownSagents.dropdownOptions[i].label;

							return;
						}

					}


		        };
















         YAHOO.util.Event.addListener(window, "load", function() {
          YAHOO.example.paginated =  function() {


           var myColumnDefs = [
                {key:'linkgo', label:'', className: 'linkgo-button', action:'linkgo'},
                {key:'sagentprojection', label:'', className: 'sagentprojection-button', action:'addsuperagents'},
                {key:"SAgentID", label:"SAgentID", formatter:YAHOO.widget.DataTable.formatNumber, hidden:true, isPrimaryKey:true},
                {key:"Name", label:"ΟΝΟΜΑ", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTaformatTextring ,sortable:true},
                {key:"Password", label:"ΚΩΔΙΚΟΣ", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:"string",sortable:true},
                {key:"City", label:"ΠΟΛΗ", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTablformatTextng,  sortable:true},
                {key:"Commission_tziros", label:"ΕΠΙ ΤΖΙΡΟΥ %", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber,  sortable:true},
                {key:"Commission_pososto", label:"ΕΠΙ ΚΕΡΔΟΥΣ %", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber,  sortable:true},
                {key:"Remainder", label:"ΥΠΟΛΟΙΠΟ", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatCurrency,  sortable:true},
                {key:"LastLogin", label:"ΤΕΛ. ΣΥΝΑΛ.", formatter:YAHOO.widget.DataTable.formatText, sortable:true},
                {key:"RegDate", label:"ΕΓΓΡΑΦΗ", formatter:YAHOO.widget.DataTable.formatDate, sortable:true},
                {key:"Active", label:"ΕΝΕΡΓΟΣ", formatter:YAHOO.widget.DataTable.formatCheckbox, sortable:true},
                {key:'del', label:'', className: 'delete-button', action:'delete'}

            ];



            myDataSource = new YAHOO.util.XHRDataSource("../includes/dataproxy.php?");
            myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSON;
            myDataSource.connXhrMode = "queueRequests";




            myDataSource.responseSchema = {
                  resultsList: "DataSet.items",
                  fields: [
                  {key:"SAgentID",parser:"number"},
                  {key:"Name",parser:"string"},
                  {key:"Password",parser:"string"},
                  {key:"City",parser:"string"},
                  {key:"Commission_tziros",parser:"number"},
                  {key:"Commission_pososto",parser:"number"},
                  {key:"Remainder",parser:"number"},
                  {key:"LastLogin",parser:parseSQLDate},
                  {key:"RegDate",parser:parseSQLDate},
                  {key:"Active",parser:"number"},
                  "del"
                  ],
                  metaFields: {totalRecords: "DataSet.totalRecords"} // Access server-provided dynamic value

            };





            var oConfigs = {

                   //sortedBy:{key:"country",dir:"asc"},

                    dateOptions:{format:"%d/%m/%Y"},
                    //dateOptions:{format:"%Y-%m-%d"},
                    selectionMode:"single",
                    numberOptions:{decimalPlaces:0, thousandsSeparator:","},
                    MSG_EMPTY:"Δεν υπάρχουν εγγραφές",
                    draggableColumns:true,
					currencyOptions:{prefix: "€", decimalPlaces:2, decimalSeparator:".", thousandsSeparator:","},
                    initialRequest:"query=superagents&type=select&primaryKey=SAgentID",
                    // Sorting and pagination will be routed to the server via generateRequest
	                dynamicData : false,
	                height:"20em"
	        };

            DataTable = new YAHOO.widget.ScrollingDataTable("paginated", myColumnDefs, myDataSource, oConfigs  );




            var i=1,bReverseSorted = false;

            // Track when Column is reverse-sorted, since new data will come in out of order
            var trackReverseSorts = function(oArg) {
                bReverseSorted = (oArg.dir === YAHOO.widget.DataTable.CLASS_DESC);
            };



            // Set up editing flow
	        var highlightEditableCell = function(oArgs) {
	            var elCell = oArgs.target;
	            if(YAHOO.util.Dom.hasClass(elCell, "yui-dt-editable")) {
	                this.highlightCell(elCell);
	            }
	        };

            DataTable.subscribe("cellMouseoverEvent", highlightEditableCell);
	        DataTable.subscribe("cellMouseoutEvent", DataTable.onEventUnhighlightCell);

            DataTable.subscribe("initEvent",function(oArgs) {

                if (DataTable.getRecordSet().getLength() > 0) {
                          var recset = DataTable.getRecordSet().getRecord(0)._oData;
                          SelectedSAgentID = recset.SAgentID;

                          var oUpdateTableCallBack = {
                              success :AgentDataTable.onDataReturnReplaceRows,
                              failure :AgentDataTable.onDataReturnReplaceRows,
                              scope   :AgentDataTable
                          };

                         var sqlquery = "query=agents&type=select&primaryKey=AgentID&whereID=" + SelectedSAgentID;
                         AgentDataTable.getDataSource().sendRequest(sqlquery, oUpdateTableCallBack);
                }

             });


            var myBuildUrl = function(datatable,record) {
                var url = '';
                var cols = datatable.getColumnSet().keys;
                for (var i = 0; i < cols.length; i++) {
                    if (cols[i].isPrimaryKey) {
                        url += '&id=' + escape(record.getData(cols[i].key));
                        url += '&primaryKey=' + cols[i].key;
                    }
                }

                return url;
            };


			DataTable.subscribe('cellClickEvent',function(oArgs) {


                var target = oArgs.target;

                var column = this.getColumn(target);
                var record = this.getRecord(target);
                var value = record.getData(this.getColumn('SAgentID').key);
                sagentname = record.getData(this.getColumn('Name').key);



                switch (column.action) {

                 case 'delete' :

                            if (confirm('Είσαι σίγουρος για τη διαγραφή ;')) {

                                var record = this.getRecord(target);
								ajaxLoadingPanel.show();
                                 YAHOO.util.Connect.asyncRequest('GET','../includes/dataproxy.php?query=superagents&type=delete' + myBuildUrl(this,record),
                                    {

                                        success: function (o) {

                                                this.deleteRow(target);

                                                 var oSelectSAgent = YAHOO.util.Dom.get("SelectSAgent");
                                              	 for (var i=0;i<oSelectSAgent.options.length;i++) {
                                                      if (oSelectSAgent.options[i].value ==  value){
                                                             oSelectSAgent.remove(i);
                                                             break;

                                                      }
                                             	 }
                                                 SyncDropDownagents();

                                                 //delete all records from the Agent Table
												 if (SelectedSAgentID == value) {
                                                 	AgentDataTable.deleteRows(0, AgentDataTable.getRecordSet().getLength());
                                                 }

                                                 SelectedSAgentID = -1;

                                                 ajaxLoadingPanel.hide();

                                        },
                                        failure: function (o) {
                                                alert('Κάποιο σφάλμα δημιουργήθηκε');
                                        },
                                        scope:this
                                    }

                                );


                            }

                            break;
                    case 'linkgo':

                             // Sends a request to the DataSource for more data
                              var oUpdateTableCallBack = {
                                  success :function (oRequest , oResponse , oPayload) {

                                  				AgentDataTable.onDataReturnReplaceRows(oRequest,oResponse,oPayload);
                                  				ajaxLoadingPanel.hide();

                              				},
                                  failure :AgentDataTable.onDataReturnReplaceRows,
                                  scope   :AgentDataTable
                              };
                             ajaxLoadingPanel.show();
                             SelectedSAgentID = value;
                             var sqlquery = "query=agents&type=select&primaryKey=AgentID&whereID=" + SelectedSAgentID;
                             AgentDataTable.getDataSource().sendRequest(sqlquery, oUpdateTableCallBack);

                             break;
                    case 'addsuperagents':
                             SelectedSAgentID=value;

                              ajaxLoadingPanel.show();

                              // Sends a request to the DataSource for more data
                              var oUpdateTableCallBack = {
                                  success :function (oRequest , oResponse , oPayload) {

                                  				DataTableSAgentProjection.onDataReturnReplaceRows(oRequest,oResponse,oPayload);
                                                ajaxLoadingPanel.hide();

                              				},
                                  failure :DataTableSAgentProjection.onDataReturnReplaceRows,
                                  scope   :DataTableSAgentProjection,
                                  argument: DataTableSAgentProjection.getState()
                              };


                             var sqlquery = "query=superagentsprojection&type=select&primaryKey=SAgentProjectionID&id="+SelectedSAgentID;
                             DataTableSAgentProjection.getDataSource().sendRequest(sqlquery, oUpdateTableCallBack);


                             YAHOO.util.Dom.get('cur_sagent').innerHTML = '<strong>'+sagentname+'</strong>';
                             YAHOO.util.Dom.get("SAgentList").selectedIndex=0;
                             YAHOO.example.container.dialog1.show();
                             break;
                    default:DataTable.onEventShowCellEditor(oArgs);
                            break;
                }

            });

           DataTable.subscribe('checkboxClickEvent', function(oArgs){

				    var elCheckbox = oArgs.target;
					var newValue = elCheckbox.checked;
				    var oRecord = this.getRecord(elCheckbox);
					var column = this.getColumn(elCheckbox);
					var oldValue = oRecord.getData(column.key);





                    //convert to int
                    newValue = newValue - 0;

                    YAHOO.util.Connect.asyncRequest('GET', '../includes/dataproxy.php?query=superagents&type=update&column=Active&newvalue=' + newValue +  myBuildUrl(DataTable,oRecord), {
                                        success: function(o) {


                                        },
                                        failure: function(o) {
                                              alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή του Active Flag δεν αποθηκεύτηκε.<br><br>' +
                                              'Επικοινωνήστε με την κατασκευάστρια εταιρία.');


                                     }
                     });







				});



           DataTable.subscribe("editorSaveEvent", function(oArgs){


                var oEditor = oArgs.editor;
        	    var newData = oArgs.newData;
        	    var oldData = oArgs.oldData;
    			var elCell = oEditor.cell;
		        var oRecord = oEditor.getRecord();
           		var oColumn = oEditor.getColumn();
                var value = oRecord.getData(oColumn.key);


                DataTable.set("sortedBy", null);
                
				//no characters allowed to the following fields
		        if (  (oColumn.key == "Phone")  || (oColumn.key == "Commission_tziros")  || (oColumn.key == "Commission_pososto") ||
					  (oColumn.key == "Remainder")   ) {


						if ( isNaN(newData) ) {
							this.updateCell ( oRecord , oColumn , oldData );
                            return;
                        }

     					if (newData==''){
                        	this.updateCell ( oRecord , oColumn , oldData );
                            return;
                        }


						//Max_Value_Alert does not affect Code field
						var FloatValue = parseFloat(newData);
						if ( ( FloatValue > 100 ) && (oColumn.key != "Phone") && (oColumn.key != "Remainder")) {
							YAHOO.example.alert( 'Προσοχή ! Η τιμή που δώσατε στη στήλη <b>' + oColumn.label + '</b> είναι πάνω από 100.');
							this.updateCell ( oRecord , oColumn , oldData );
							return;
						}

	        	} 
				

                if(oldData != newData)
                {


                        if ( (oColumn.key == "Password") && (value.length < 4) ) {

                            YAHOO.example.alert('Παρακαλώ πληκτρολογήστε τουλάχιστον 4 χαρακτήρες για το νέο κωδικό.');
                            this.updateCell ( oRecord , oColumn , oldData );
                            return;

                        }


			            if ( (oColumn.key == "Phone") || (oColumn.key == "Commission_tziros") || (oColumn.key == "Commission_pososto") ||
			                         (oColumn.key == "Remainder" ) )
			                          qnewval =   "&newvalue=" + value;
			                    else
			                          qnewval =   "&newvalue=@" + value;



					query = '../includes/dataproxy.php?query=superagents&type=update&column='
					
					YAHOO.util.Connect.asyncRequest('GET', query + oColumn.key + qnewval + myBuildUrl(this,oRecord), {
                                   success: function(o) {

                                                try {

                                                    var r = YAHOO.lang.JSON.parse(o.responseText);
                                                }
                                                catch (x) {
                                                    if ((oColumn.key=='Name') && (o.responseText=='userexist')) {

                                                     YAHOO.example.alert("Η εγγραφή σας <b>δεν αποθηκεύτηκε</b> διότι το όνομα χρήστη υπάρχει ήδη. Παρακαλώ επιλέξτε κάποιο άλλο όνομα χρήστη.");
                                                     this.updateCell ( oRecord , oColumn , oldData );
                                                     return;

                                                    } else if ((oColumn.key=='Password') && (o.responseText=='userexist')) {
                                                     YAHOO.example.alert("Η εγγραφή σας <b>δεν αποθηκεύτηκε</b> διότι είτε υπάρχει το όνομα χρήστη, ή ο συνδυασμός ονόματος χρήστη και κωδικού υπάρχει ήδη. Παρακαλώ επιλέξτε κάποιο άλλο κωδικό.");
                                                     this.updateCell ( oRecord , oColumn , oldData );
                                                     return;
                                                    } else {
                                                        alert("JSON Parse failed!");
                                                        return;
                                                    }
                                                }

                                                //change the drop down menu
                                                if (oColumn.key == "Name") {

                                                   var oSelectSAgent = YAHOO.util.Dom.get("SelectSAgent");
                                                	 for (var i=0;i<oSelectSAgent.options.length;i++) {
                                                        if (oSelectSAgent.options[i].value ==  oRecord.getData( this.getColumn('SAgentID').key ) ){
                                                               oSelectSAgent.options[i].text = value;
                                                               break;

                                                        }
                                               	 }
                                                   SyncDropDownagents();


                                                   //if agents with the same code of SAgent are already viewed, change them all.
                                                   if (SelectedSAgentID == oRecord.getData( this.getColumn('SAgentID').key )) {


                                                            for(i=0;i<=AgentDataTable.getRecordSet().getLength()-1;i++){


                                                                var dRecord = AgentDataTable.getRecordSet().getRecord(i);
                                                                var SetCol = AgentDataTable.getColumn('SAgentID');

                                                               	AgentDataTable.updateCell ( dRecord , SetCol , (oRecord.getData( this.getColumn('SAgentID').key) ) );


                                                            }

                                                   }

                                                }

                                                YAHOO.example.alert('Οι αλλαγές αποθηκεύτηκαν.');




                                  },
                                  failure: function(o) {
                                         alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή σας δεν αποθηκεύτηκε.');
                                  },
                                  scope: this
                     }  );                	
               	}

		    });






			//*************************************************************************

           var AgentColumnDefs = [

                {key:"AgentID", label:"AGENT", formatter:YAHOO.widget.DataTable.formatNumber, hidden:true, isPrimaryKey:true},
                {key:"SAgentID", label:"S.AGENT", formatter:formatSagents, editor:elDropDownSagents, width:100, sortable:true},
				{key:"Name", label:"AGENT", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatString ,sortable:true},
                {key:"Password", label:"ΚΩΔΙΚΟΣ", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:"string",sortable:true},
                {key:"City", label:"ΠΟΛΗ", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatString,  sortable:true},
	            {key:"Mona", label:"MONA %", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber,  sortable:true},
	            {key:"Dipla", label:"ΔΙΠΛΑ %", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber,  sortable:true},
	            {key:"Triades", label:"3ΑΔΕΣ %", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber,  sortable:true},
	            {key:"Systems", label:"ΣΥΣΤΗΜΑΤΑ %", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatNumber,  sortable:true},
                {key:"Remainder", label:"ΥΠΟΛΟΙΠΟ", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatCurrency,  sortable:true},
                {key:"LastLogin", label:"ΤΕΛ. ΣΥΝΑΛ.", formatter:YAHOO.widget.DataTable.formatText, sortable:true},
                {key:"RegDate", label:"ΕΓΓΡΑΦΗ", formatter:YAHOO.widget.DataTable.formatDate, sortable:true},
                {key:"Active", label:"ΕΝΕΡΓΟΣ", width:50, formatter:YAHOO.widget.DataTable.formatCheckbox, sortable:true},
                {key:'del', label:'', className: 'delete-button', action:'delete',width:15}

            ];
			
            AgentDataSource = new YAHOO.util.XHRDataSource("../includes/dataproxy.php?");
            AgentDataSource.responseType = YAHOO.util.DataSource.TYPE_JSON;
            AgentDataSource.connXhrMode = "queueRequests";




            AgentDataSource.responseSchema = {
                  resultsList: "DataSet.items",
                  fields: [
                  {key:"AgentID",parser:"number"},
                  {key:"SAgentID",parser:"string"},
                  {key:"Name",parser:"string"},
                  {key:"Password",parser:"string"},
                  {key:"City",parser:"string"},
                  {key:"Phone",parser:"string"},
                  {key:"Mona",parser:"number"},
                  {key:"Dipla",parser:"number"},
                  {key:"Triades",parser:"number"},
                  {key:"Systems",parser:"number"},
                  {key:"Remainder",parser:"number"},
                  {key:"LastLogin",parser:parseSQLDate},
                  {key:"RegDate",parser:parseSQLDate},
                  {key:"Active",parser:"number"},
                  "del"
                  ],
                  metaFields: {totalRecords: "DataSet.totalRecords"} // Access server-provided dynamic value

            };






	        
            var oConfigs = {

                   //sortedBy:{key:"country",dir:"asc"},

                    dateOptions:{format:"%d/%m/%Y"},
                    selectionMode:"single",
                    numberOptions:{decimalPlaces:0, thousandsSeparator:","},
                    MSG_EMPTY:"Δεν υπάρχουν εγγραφές",
                    draggableColumns:true,
					currencyOptions:{prefix: "€", decimalPlaces:2, decimalSeparator:".", thousandsSeparator:","},
                    initialRequest:"query=agents&type=select&primaryKey=AgentID&whereID=-1",
                    // Sorting and pagination will be routed to the server via generateRequest
	                dynamicData : false,
	                height:"20em"
	               
	        };	

            AgentDataTable = new YAHOO.widget.ScrollingDataTable("paginatedAgent", AgentColumnDefs, AgentDataSource, oConfigs );


            var i=1,bReverseSorted = false;

            // Track when Column is reverse-sorted, since new data will come in out of order
            var trackReverseSorts = function(oArg) {
                bReverseSorted = (oArg.dir === YAHOO.widget.DataTable.CLASS_DESC);
            };



            // Set up editing flow
	        var highlightEditableCell = function(oArgs) {
	            var elCell = oArgs.target;
	            if(YAHOO.util.Dom.hasClass(elCell, "yui-dt-editable")) {
	                this.highlightCell(elCell);
	            }
	        };
            AgentDataTable.subscribe("cellMouseoverEvent", highlightEditableCell);
	        AgentDataTable.subscribe("cellMouseoutEvent", AgentDataTable.onEventUnhighlightCell);

            AgentDataTable.subscribe('cellClickEvent',function(oArgs) {


                var target = oArgs.target;

                column = this.getColumn(target);
                record = this.getRecord(target);



                switch (column.action) {

                 case 'delete' :

                            if (confirm('Είσαι σίγουρος για τη διαγραφή ; Η διαγραφή μπορεί να αφήσει ορφανές εγγραφές στοιχημάτων.')) {

                                var record = this.getRecord(target);

                                 YAHOO.util.Connect.asyncRequest('GET','../includes/dataproxy.php?query=agents&type=delete' + myBuildUrl(this,record),
                                    {

                                        success: function (o) {
                                              this.deleteRow(target);

                                        },
                                        failure: function (o) {
                                                alert('Κάποιο σφάλμα δημιουργήθηκε');
                                        },
                                        scope:this
                                    }

                                );


                            }

                            break;
                    case 'cancel':

                            break;
                    default:AgentDataTable.onEventShowCellEditor(oArgs);
                            break;
                }

            });


           AgentDataTable.subscribe('checkboxClickEvent', function(oArgs){

				    var elCheckbox = oArgs.target;
					var newValue = elCheckbox.checked;
				    var oRecord = this.getRecord(elCheckbox);
					var column = this.getColumn(elCheckbox);
					var oldValue = oRecord.getData(column.key);





                      //convert to int
                      newValue = newValue - 0;

                      YAHOO.util.Connect.asyncRequest('GET', '../includes/dataproxy.php?query=agents&type=update&column=Active&newvalue=' + newValue +  myBuildUrl(AgentDataTable,oRecord), {
                                          success: function(o) {


                                          },
                                          failure: function(o) {
                                                alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή του Active Flag δεν αποθηκεύτηκε.<br><br>' +
                                                'Επικοινωνήστε με την κατασκευάστρια εταιρία.');


                                       }
                       });







				});
				

          AgentDataTable.subscribe("editorSaveEvent", function(oArgs){

				
                var oEditor = oArgs.editor;
        	    var newData = oArgs.newData;
        	    var oldData = oArgs.oldData;
    			var elCell = oEditor.cell;
		        var oRecord = oEditor.getRecord();
           		var oColumn = oEditor.getColumn();
                var value = oRecord.getData(oColumn.key);


                DataTable.set("sortedBy", null);
                
				//no characters allowed to the following fields
    				if ( (oColumn.key == "Phone") || (oColumn.key == "Mona") || (oColumn.key == "Dipla") ||
			                  (oColumn.key == "Triades") || (oColumn.key == "Systems") || (oColumn.key == "Remainder" ) ) {


						if ( isNaN(newData) ) {
							this.updateCell ( oRecord , oColumn , oldData );
                            return;
                        }

     					if (newData==''){
                        	this.updateCell ( oRecord , oColumn , oldData );
                            return;
                        }


						//Max_Value_Alert does not affect Code field
						var FloatValue = parseFloat(newData);
						if ( ( FloatValue > 100 ) && (oColumn.key != "Phone") && (oColumn.key != "Remainder")) {
							YAHOO.example.alert( 'Προσοχή ! Η τιμή που δώσατε στη στήλη <b>' + oColumn.label + '</b> είναι πάνω από 100.');
							this.updateCell ( oRecord , oColumn , oldData );
							return;
						}

	        	} 

				
                if(oldData != newData)
                {

                    if ( (oColumn.key == "Password") && (value.length < 4) ) {

                        YAHOO.example.alert('Παρακαλώ πληκτρολογήστε τουλάχιστον 4 χαρακτήρες για το νέο κωδικό.');
                        this.updateCell ( oRecord , oColumn , oldData );
                        return;

                    }
                	
    				if ( (oColumn.key == "Phone") || (oColumn.key == "Mona") || (oColumn.key == "Dipla") ||
			                  (oColumn.key == "Triades") || (oColumn.key == "Systems") || (oColumn.key == "Remainder" ) )			                         
			                          qnewval =   "&newvalue=" + value;
			                    else
			                          qnewval =   "&newvalue=@" + value;

					query = '../includes/dataproxy.php?query=agents&type=update&column='

					YAHOO.util.Connect.asyncRequest('GET', query + oColumn.key + qnewval + myBuildUrl(this,oRecord), {
                                   success: function(o) {

                                                try {

                                                    var r = YAHOO.lang.JSON.parse(o.responseText);
                                                }
                                                catch (x) {

                                                    if ((oColumn.key=='Name') && (o.responseText=='userexist')) {

                                                     YAHOO.example.alert("Η εγγραφή σας <b>δεν αποθηκεύτηκε</b> διότι το όνομα χρήστη υπάρχει ήδη. Παρακαλώ επιλέξτε κάποιο άλλο όνομα χρήστη.");
                                                     this.updateCell ( oRecord , oColumn , oldData );
                                                     return;

                                                    } else if ((oColumn.key=='Password') && (o.responseText=='userexist')) {
                                                     YAHOO.example.alert("Η εγγραφή σας <b>δεν αποθηκεύτηκε</b> διότι είτε υπάρχει το όνομα χρήστη, ή ο συνδυασμός ονόματος χρήστη και κωδικού υπάρχει ήδη. Παρακαλώ επιλέξτε κάποιο άλλο κωδικό.");
                                                     this.updateCell ( oRecord , oColumn , oldData );
                                                     return;
                                                    } else {
                                                        alert("JSON Parse failed!");
                                                        return;
                                                    }
                                                }

							                    if (oColumn.key == "SAgentID") {
							                         AgentDataTable.deleteRow( oRecord );
		                         				}

                                                YAHOO.example.alert('Οι αλλαγές αποθηκεύτηκαν.');




                                  },
                                  failure: function(o) {
                                         alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή σας δεν αποθηκεύτηκε.');
                                  },
                                  scope: this
                     }  );
               	}
                
		    });
				






           //**************************************************************

           var myColumnDefsSAgentProjection = [
                {key:"SAgentProjectionID", label:"SAgentProjectionID", formatter:YAHOO.widget.DataTable.formatNumber, hidden:true, isPrimaryKey:true},
                {key:"SAgentIDSlave", label:"SAgentID", formatter:YAHOO.widget.DataTable.formatNumber, hidden:true},
                {key:"Name", label:"ΟΝΟΜΑ",  width:150, sortable:true},
                {key:'del', label:'', className: 'delete-button', action:'delete', width:15}
			];





            var  myDataSourceSAgentProjection = new YAHOO.util.XHRDataSource("../includes/dataproxy.php?");
            myDataSourceSAgentProjection.responseType = YAHOO.util.DataSource.TYPE_JSON;
            myDataSourceSAgentProjection.connXhrMode = "queueRequests";


            myDataSourceSAgentProjection.responseSchema = {
                  resultsList: "DataSet.items",
                  fields: [
                  {key:"SAgentProjectionID",parser:"number"},
                  {key:"SAgentIDSlave",parser:"number"},
                  {key:"Name",parser:"string"},
                  "del"
                  ],
                  metaFields: {totalRecords: "DataSet.totalRecords"} // Access server-provided dynamic value

            };


            var oConfigsSAgentProjection = {


                    dateOptions:{format:"%d/%m/%Y"},
                    selectionMode:"single",
                    numberOptions:{decimalPlaces:0, thousandsSeparator:","},
                    MSG_EMPTY:"Δεν υπάρχουν εγγραφές",
                    draggableColumns:true,
					currencyOptions:{prefix: "€", decimalPlaces:2, decimalSeparator:".", thousandsSeparator:","},
                    initialRequest:"query=superagentsprojection&type=select&primaryKey=SAgentProjectionID&id="+SelectedSAgentID,
                    // Sorting and pagination will be routed to the server via generateRequest
	                dynamicData : false,
                    height:"17em"

	        };




            DataTableSAgentProjection = new YAHOO.widget.ScrollingDataTable("superagentslist", myColumnDefsSAgentProjection, myDataSourceSAgentProjection,oConfigsSAgentProjection );
            var i=1,bReverseSorted = false;

            // Track when Column is reverse-sorted, since new data will come in out of order
            var trackReverseSorts = function(oArg) {
                bReverseSorted = (oArg.dir === YAHOO.widget.DataTableSAgentProjection.CLASS_DESC);
            };



            // Set up editing flow
	        var highlightEditableCell = function(oArgs) {
	            var elCell = oArgs.target;
	            if(YAHOO.util.Dom.hasClass(elCell, "yui-dt-editable")) {
	                this.highlightCell(elCell);
	            }
	        };

            var myBuildUrl = function(DataTableSAgentProjection,record) {
                var url = '';
                var cols = DataTableSAgentProjection.getColumnSet().keys;
                for (var i = 0; i < cols.length; i++) {
                    if (cols[i].isPrimaryKey) {
                        url += '&id=' + escape(record.getData(cols[i].key));
                        url += '&primaryKey=' + cols[i].key;
                    }
                }

                return url;
            };

            DataTableSAgentProjection.subscribe('cellClickEvent', DataTableSAgentProjection.onEventShowCellEditor);


            DataTableSAgentProjection.subscribe('cellClickEvent',function(oArgs) {
                var target = oArgs.target;

                column = this.getColumn(target),
                record = this.getRecord(target);

                switch (column.action) {

                 case 'delete' :

                            if (confirm('Είσαι σίγουρος για τη διαγραφή ;')) {

                                var record = this.getRecord(target);

                                 YAHOO.util.Connect.asyncRequest('GET','../includes/dataproxy.php?query=superagentsprojection&type=delete' + myBuildUrl(this,record),
                                    {

                                        success: function (o) {
                                                this.deleteRow(target);
                                        },
                                        failure: function (o) {
                                                alert('Κάποιο σφάλμα δημιουργήθηκε');
                                        },
                                        scope:this
                                    }

                                );


                            }


                            break;
                    case 'insert':
                            //this.addRow( {} , this.getRecordIndex(target));
                            break;
                    default:this.onEventShowCellEditor(oArgs);
                            break;
                }

            })



            var myTabView = new YAHOO.widget.TabView("tvcontainer");
	        myTabView.getTab(0).addListener("click", function() {DataTable.onShow(); AgentDataTable.onShow();})


            return {
             oDS : myDataSource,
             oDSA: AgentDataSource,
             oDT : DataTable,
             oDTA: AgentDataTable,
             oTV : myTabView
             };


        }();
});


    </script>

    <script type="text/javascript">
        //*****************************************************
        //Patch for sorting
        //http://yuilibrary.com/projects/yui2/ticket/2527707
        //*****************************************************
        YAHOO.widget.DataTable.prototype.getTdEl = function(cell) {

        var Dom = YAHOO.util.Dom,

        lang = YAHOO.lang,
        elCell,
        el = Dom.get(cell);

        // Validate HTML element
        if(el && (el.ownerDocument == document)) {

        // Validate TD element
        if(el.nodeName.toLowerCase() != "td") {

        // Traverse up the DOM to find the corresponding TR element
        elCell = Dom.getAncestorByTagName(el, "td");

        }
        else {

        elCell = el;

        }

        // Make sure the TD is in this TBODY
        if(elCell && (elCell.parentNode.parentNode == this._elTbody)) {

        // Now we can return the TD element
        return elCell;

        }

        }
        else if(cell) {

        var oRecord, nColKeyIndex;

        if(lang.isString(cell.columnKey) && lang.isString(cell.recordId)) {

        oRecord = this.getRecord(cell.recordId);
        var oColumn = this.getColumn(cell.columnKey);
        if(oColumn) {

        nColKeyIndex = oColumn.getKeyIndex();

        }

        }
        if(cell.record && cell.column && cell.column.getKeyIndex) {

        oRecord = cell.record;
        nColKeyIndex = cell.column.getKeyIndex();

        }
        var elRow = this.getTrEl(oRecord);
        if((nColKeyIndex !== null) && elRow && elRow.cells && elRow.cells.length > 0) {

        return elRow.cells[nColKeyIndex] || null;

        }

        }

        return null;

        };
    </script>





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

</BODY>
</HTML>



