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
  <?php include '../includes/database.php' ?>

<link href="../betplatform.css" rel="stylesheet" type="text/css">


<link rel="stylesheet" type="text/css" href="../build/fonts/fonts-min.css" />
<link rel="stylesheet" type="text/css" href="../build/datatable/assets/skins/sam/datatable.css" />
<link rel="stylesheet" type="text/css" href="../build/paginator/assets/skins/sam/paginator.css" />
<link rel="stylesheet" type="text/css" href="../build/button/assets/skins/sam/button.css" />
<link rel="stylesheet" type="text/css" href="../build/tabview/assets/skins/sam/tabview.css" />
<link rel="stylesheet" type="text/css" href="../build/paginator/assets/skins/sam/paginator.css" />
<link rel="stylesheet" type="text/css" href="../build/container/assets/skins/sam/container.css" />

<script type="text/javascript" src="../build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="../build/dragdrop/dragdrop-min.js"></script>
<script type="text/javascript" src="../build/element/element-min.js"></script>
<script type="text/javascript" src="../build/button/button-min.js"></script>
<script type="text/javascript" src="../build/datasource/datasource-min.js"></script>
<script type="text/javascript" src="../build/datatable/datatable-min.js"></script>
<script type="text/javascript" src="../build/tabview/tabview-min.js"></script>
<script type="text/javascript" src="../build/paginator/paginator-min.js"></script>
<script type="text/javascript" src="../build/container/container-min.js"></script>
<script type="text/javascript" src="../build/connection/connection-min.js"></script>
<script type="text/javascript" src="../build/json/json-min.js"></script>




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

.yui-button#pushbuttonFind button {

    padding-left: 3em;
    background: url(../grafix/search.png) 10% 50% no-repeat;


}

.delete-button {
	cursor:pointer;
	background: #FFFFCC url(../grafix/delete.png) no-repeat center center;
	width:16px;height:16px;
}
/*
#paginated {
    text-align: center;
}
#paginated table {
    margin-left:auto; margin-right:auto;
}
*/

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
                <strong>Διαχείριση Ομάδων</strong>
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
                        <li class="selected"><a href="#tab1"><em>Προβολή εγγραφών</em></a></li>
                        <li><a href="#tab2"><em>Εισαγωγή νέας εγγραφής</em></a></li>
                    </ul>
                    <div class="yui-content">
                                    <table>
                                  <tr>
                                      <td class=TextInfoBlack>
                                       <br><br>

                                         <b>Φίλτρο</b><br>
            							 <hr width="100%" style="Color:red;"></hr>
            							 <br>

                                         Χώρα
                                      </td>
                                  </tr>
                                    <tr>
                                      <td>

                                         <SELECT style=" width:26em;" id="FilterCountryID" name="FilterCountryID" size="1">
                                         <OPTION value="*" selected="selected">Εμφάνιση όλων</OPTION>
                                          <?php
                                            $chapionships = array();
                                            $i=0;
                                            $myDB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
										    mysql_select_db(DataBase, $myDB) or die(mysql_error());
                                           	mysql_query("SET NAMES 'utf8'");
											$query_result = mysql_query("select * from countries order by Country Asc");
										    while ($row = mysql_fetch_assoc($query_result)) {

								             $query_result2 = mysql_query("select * from chapionships where CountryID=".$row['CountryID']." order by Chapionship Desc");
                                             if (mysql_num_rows ($query_result2) > 0) {
                                                 echo '<OPTION value="'.$row['CountryID'].'">'.$row['Country'].'</OPTION>';

                                               while ($row2 = mysql_fetch_assoc($query_result2)) {
                                                      $chapionships[$i]='<OPTION class="'.$row['CountryID'].'" value="'.$row2['ChapionshipID'].'">'.$row2['Chapionship'].'</OPTION>';
                                                      $i++;

                                                }
                                             }
											}
											mysql_close($myDB);

										  ?>

                                         </SELECT>

                                      </td>
                                  </tr>

                                  <tr>
                                      <td class=TextInfoBlack>
                                         Πρωτάθλημα
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                         <SELECT style=" width:26em;" id="FilterChapionshipID" name="FilterChapionshipID" size="1">
                                         <OPTION value="*" selected="selected">Εμφάνιση όλων</OPTION>
                                         <?php

										    while ($i >= 0 ) {
                                               echo  $chapionships[$i];
                                               $i--;

                                            }
										  ?>

                                         </SELECT>

                                      </td>
                                  </tr>
                                  <tr>
                                    <td>
                                       <span id="pushbuttonFind" class="yui-button yui-push-button">
                                        <strong class="first-child">
                                          <button type="button" name="pushbuttonFind">Εφαρμογή</button>
                                        </strong>
                                        </span>
                                         <br><br>
                                        <hr width="100%" style="Color:red;"></hr>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                       <div id="paginated" align="left"></div>
                                    </td>
                                  </tr>
                                  </table>



                        <div><p>
                                 <form  id="submit" >
                                 <table>
                                  <tr>
                                      <td class=TextInfoBlack2>
                                         Χώρα
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                         <SELECT class=TextInfoBlack2 style=" width:26em;" id="CountryID" name="CountryID" size="1">
                                        <?php
                                            $chapionships = array();
                                            $i=0;
                                            $myDB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
										    mysql_select_db(DataBase, $myDB) or die(mysql_error());
                                           	mysql_query("SET NAMES 'utf8'");
											$query_result = mysql_query("select * from countries order by Country Asc");
										    while ($row = mysql_fetch_assoc($query_result)) {

								             $query_result2 = mysql_query("select * from chapionships where CountryID=".$row['CountryID']." order by Chapionship Asc");
                                             if (mysql_num_rows ($query_result2) > 0) {
                                                 echo '<OPTION value="'.$row['CountryID'].'">'.$row['Country'].'</OPTION>';

                                               while ($row2 = mysql_fetch_assoc($query_result2)) {
                                                      $chapionships[$i]='<OPTION class="'.$row['CountryID'].'" value="'.$row2['ChapionshipID'].'">'.$row2['Chapionship'].'</OPTION>';
                                                      $i++;

                                                }
                                             }
											}
											mysql_close($myDB);

										  ?>

                                         </SELECT>

                                      </td>
                                  </tr>

                                  <tr>
                                      <td class=TextInfoBlack2>
                                         <br><br>
                                         Πρωτάθλημα
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                         <SELECT class=TextInfoBlack2 style=" width:26em;" id="ChapionshipID" name="ChapionshipID" size="1">
                                         <?php

										    while ($i >= 0 ) {
                                               echo  $chapionships[$i];
                                               $i--;

                                            }
										  ?>

                                         </SELECT>

                                      </td>
                                  </tr>

                                  <tr>
                                      <td class=TextInfoBlack2>
                                         <br><br>
                                         Ομάδες
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                         <INPUT class=TextInfoBlack2 name="Team" id="Team" size="50" maxlength="50">
                                      </td>
                                  </tr>

                                  <tr>
                                      <td align="right">
                                          <br><br>
                                          <span id="pushbuttonAddRec" class="yui-button yui-push-button">
                                          <strong class="first-child">
                                            <button type="button" name="pushbuttonAddRec">Αποθήκευση</button>
                                          </strong>
                                          </span>



                                      </td>
                                  </tr>
                                  </table>
                                  </form>


                        </p></div>
                    </div>
                </div>


            </TD>
        </TR>



        </Table>


      <Script type="text/javascript">

        var DataTable;
        var elDropDownchapionships;
        var elDropDowncountries;


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
                        elOption.innerHTML = (YAHOO.lang.isValue( dropdownOption. label)) ? dropdownOption.label : dropdownOption;
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
                width: '500px',
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




         var AjaxObject = {
        	handleSuccess:function(o){
        		// This member handles the success response
        		// and passes the response object o to AjaxObject's
        		// processResult member.

                try {
                    var r = YAHOO.lang.JSON.parse(o.responseText);
                }
                catch (x) {
                    alert("JSON Parse failed!");
                    return;
                }




                // Sends a request to the DataSource for more data
                var oUpdateTableCallBack = {
                    success :DataTable.onDataReturnReplaceRows,
                    failure :DataTable.onDataReturnReplaceRows,
                    scope   :DataTable,
                    argument: DataTable.getState()
                };
                DataTable.getDataSource().sendRequest("query=teams&type=select&primaryKey=TeamID", oUpdateTableCallBack);


                var oFilterCountryID = YAHOO.util.Dom.get("FilterCountryID");
                oFilterCountryID.options.selectedIndex = '*';

                var oFilterChapionshipID = YAHOO.util.Dom.get("FilterChapionshipID");
                oFilterChapionshipID.options.selectedIndex = -1;

                //must get all options to trick the formatter

                elDropDownchapionships.dropdownOptions = YAHOO.lang.JSON.parse(optionsChapionshipID);
                elDropDownchapionships.setOptions();

                DataTable.addRow({ChapionshipID:r.ChapionshipID, CountryID:r.CountryID, TeamID:r.TeamID, Team:r.Team});

                YAHOO.util.Dom.get("Team").value = "";
                YAHOO.example.alert('Η εγγραφή σας αποθηκεύτηκε');
        	},

        	handleFailure:function(o){
        		alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή σας δεν αποθηκεύτηκε.');
        	},

        	processArgument:function(o){
           		DataTable.getState()
        	},

        	startRequest:function() {
        	   YAHOO.util.Connect.asyncRequest('GET', '../includes/dataproxy.php?query=teams&primaryKey=TeamID&type=insert', callback);


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
            argument:AjaxObject.processArgument,
        	scope: AjaxObject
        };

        function onAddRec(p_oEvent) {

               var oCountry = YAHOO.util.Dom.get("CountryID").value;
               var oChapionship = YAHOO.util.Dom.get("ChapionshipID").value;
               var oTeam = YAHOO.util.Dom.get("Team").value;

               if ( (oTeam.length != 0) && (oChapionship.length != 0 ) && (oCountry.length != 0 ) ) {


                        //disable sorting
                        DataTable.set("sortedBy", null);

                        //get data from the form.
                        var formObject = document.getElementById('submit');
                       	YAHOO.util.Connect.setForm(formObject);

                        // Start the transaction.
                        AjaxObject.startRequest();



               }
               else
                   YAHOO.example.alert('Παρακαλώ συμπληρώστε τα υποχρεωτικά πεδία');


        }



          var οPushButtonAddRec = new YAHOO.widget.Button("pushbuttonAddRec");
          οPushButtonAddRec.on("click", onAddRec);





         function onFind(p_oEvent) {

               var oCountry = YAHOO.util.Dom.get("FilterCountryID").value;
               var oChapionship = YAHOO.util.Dom.get("FilterChapionshipID").value;



                // Sends a request to the DataSource for more data
                var oUpdateTableCallBack = {
                    success :function (oRequest , oResponse , oPayload) {

                    				DataTable.onDataReturnReplaceRows(oRequest,oResponse,oPayload);
                    				ajaxLoadingPanel.hide();

                				},
                    failure :DataTable.onDataReturnReplaceRows,
                    scope   :DataTable,
                    argument: DataTable.getState()
                };

               ajaxLoadingPanel.show();
               if (oCountry=="*")
                  sqlquery = "query=teams&type=select&primaryKey=TeamID";
               else
                  sqlquery = "query=teams&type=select&primaryKey=TeamID&whereID=SQL|teams.CountryID="+oCountry+" AND teams.ChapionshipID="+oChapionship;
               DataTable.getDataSource().sendRequest(sqlquery, oUpdateTableCallBack);


         };


        var οPushButtonFind = new YAHOO.widget.Button("pushbuttonFind");
        οPushButtonFind.on("click", onFind);


          YAHOO.util.Event.addListener(window, "load", function() {
          YAHOO.example.userslist =  function() {





            var countriesString = <?php

                 $DB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
                 mysql_select_db(DataBase, $DB) or die(mysql_error());
               	 mysql_query("SET NAMES 'utf8'");
                 $result_id = mysql_query("select CountryID, Country from countries");
                 $MYDATASOURCE = get_pair_values($result_id,"CountryID");
                 mysql_close($DB);
                 echo $MYDATASOURCE;

             ?>;



              elDropDowncountries = new YAHOO.widget.DropdownCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.",dropdownOptions:YAHOO.lang.JSON.parse(countriesString),disableBtns:false});

              var formatcountries = function(elCell, oRecord, oColumn, oData) {
					
					for (var i=0;i<elDropDowncountries.dropdownOptions.length;i++) {
						if ( elDropDowncountries.dropdownOptions[i].value == oData ) {
							elCell.innerHTML = elDropDowncountries.dropdownOptions[i].label;

							return;
						}

					}
					elCell.innerHTML = "MISSED";


		        };



            chapionshipsString = <?php

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
                 $result_id = mysql_query("select ChapionshipID, Chapionship from chapionships");
                 $MYDATASOURCE = get_pair_values($result_id,"ChapionshipID");
                 mysql_close($DB);
                 echo $MYDATASOURCE;

             ?>;

              elDropDownchapionships = new YAHOO.widget.DropdownCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.",dropdownOptions:YAHOO.lang.JSON.parse(chapionshipsString),disableBtns:false});


              var formatchapionships = function(elCell, oRecord, oColumn, oData) {
					
					for (var i=0;i<elDropDownchapionships.dropdownOptions.length;i++) {
						if ( elDropDownchapionships.dropdownOptions[i].value == oData ) {
							elCell.innerHTML = elDropDownchapionships.dropdownOptions[i].label;

							return;
						}

					}
                    elCell.innerHTML = "MISSED";


		        };

  	          var myColumnDefs = [

                    {key:"TeamID", label:"Κωδ Ομάδας", formatter:YAHOO.widget.DataTable.formatNumber, hidden:true, isPrimaryKey:true},
                    {key:"CountryID", label:"Χώρα", formatter:formatcountries, editor : elDropDowncountries,  sortable:true, width:150},
  					{key:"ChapionshipID",label:'Πρωτάθλημα', formatter:formatchapionships, editor : elDropDownchapionships,  sortable:true, width:300},
                    {key:"Team", label:"Ομάδα", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:"Ακύρ.", LABEL_SAVE:"Αποθ.", disableBtns:false}), formatter:YAHOO.widget.DataTable.formatString, sortable:true, width:200},
  	                {key:'del', label:'', className: 'delete-button', action:'delete', width:15}

  	            ];

                myDataSource = new YAHOO.util.DataSource("../includes/dataproxy.php?");
                myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSON;
                myDataSource.connXhrMode = "queueRequests";


                myDataSource.responseSchema = {
                  resultsList: "DataSet.items",
                  fields: [{key:"TeamID",parser:"number"},{key:"CountryID",parser:"number"},{key:"ChapionshipID",parser:"number"},"Team", "del"],
                  metaFields: {totalRecords: "DataSet.totalRecords"} // Access server-provided dynamic value

                };


/*
                myDataSource.doBeforeCallback = function  (oRequest , oFullResponse , oParsedResponse , oCallback ) {

                     //response.meta = { totalRecords : response.results.length };


                };
  */
            var oConfigs = {

                   //sortedBy:{key:"country",dir:"asc"},

                    dateOptions:{format:"%d/%m/%Y"},
                    selectionMode:"single",
                    numberOptions:{decimalPlaces:2, thousandsSeparator:","},
                    MSG_EMPTY:"Δεν υπάρχουν εγγραφές",
                    draggableColumns:true,
                    initialRequest:"query=teams&type=select&primaryKey=TeamID"
	        };

            DataTable = new YAHOO.widget.DataTable("paginated", myColumnDefs,   myDataSource, oConfigs  );

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

                column = this.getColumn(target);
                record = this.getRecord(target);

                switch (column.action) {

                 case 'delete' :

                            if (confirm('Είσαι σίγουρος για τη διαγραφή ;')) {

                                var record = this.getRecord(target);

                                 YAHOO.util.Connect.asyncRequest('GET','../includes/dataproxy.php?query=teams&type=delete' + myBuildUrl(this,record),
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

                            break;
                    default:this.onEventShowCellEditor(oArgs);
                            break;
                }

            })




           DataTable.doBeforeShowCellEditor = function(oCellEditor) {


                var oEditor1 = elDropDowncountries;
                var oEditor2 = elDropDownchapionships;
                var oEditor = oCellEditor;
		        var oRecord = oEditor.getRecord();
           		var oColumn = this.getColumn('CountryID');
                var value = oRecord.getData(oColumn.key);






                //take the value of the CountryID and fill the drop down menu with appropriate chapionship values that
                //corresponds to that country
                if (oEditor == oEditor2) {


                            YAHOO.util.Connect.asyncRequest('GET', '../includes/dataproxy.php?query=chapionships&primaryKey=ChapionshipID&type=select&output=dropdown&whereID=' + value, {
                                         success: function(o) {

                                                try {

                                                    var r = YAHOO.lang.JSON.parse(o.responseText);
                                                }
                                                catch (x) {

                                                    alert("JSON Parse failed!");
                                                    return;
                                                }
                                                 //debug
                                                //alert(YAHOO.lang.dump(r));

                                                oEditor.dropdownOptions = r.DataSet.items;
                                                oEditor.setOptions();


                                        },
                                        failure: function(o) {
                                               alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή σας δεν αποθηκεύτηκε.');
                                        },
                                        scope: this
                                }  );




                }



                //dont let show countries that dont have chapionships.
                if (oEditor == oEditor1) {


                            YAHOO.util.Connect.asyncRequest('GET', '../includes/dataproxy.php?query=countries&primaryKey=CountryID&type=select&output=dropdown', {
                                         success: function(o) {

                                                try {

                                                    var r = YAHOO.lang.JSON.parse(o.responseText);
                                                }
                                                catch (x) {
                                                    alert("JSON Parse failed!");
                                                    return;
                                                }
                                                 //debug
                                                //alert("Inside=" + YAHOO.lang.dump(r));
                                                oEditor.dropdownOptions = r.DataSet.items;
                                                oEditor.setOptions();

                                        },
                                        failure: function(o) {
                                               alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή σας δεν αποθηκεύτηκε.');
                                        },
                                        scope: this
                                }  );

                }


                return true;
            };


            DataTable.doBeforeSortColumn = function(oColumn , sSortDir) {



                elDropDownchapionships.dropdownOptions = YAHOO.lang.JSON.parse(chapionshipsString);
                elDropDownchapionships.setOptions();

                return true;

            };


            DataTable.subscribe("editorSaveEvent", function(oArgs){


                var oEditor = oArgs.editor;
        	    var newData = oArgs.newData;
        	    var oldData = oArgs.oldData;
    			var elCell = oEditor.cell;
		        var oRecord = oEditor.getRecord();
           		var oColumn = oEditor.getColumn();
                var value = oRecord.getData(oColumn.key);




                DataTable.set("sortedBy", null);



                if ( (oColumn.key == "CountryID") || (oColumn.key == "ChapionshipID") )
                      qnewval =   "&newvalue=" + encodeURIComponent (value);
                else
                      qnewval =   "&newvalue=@" + encodeURIComponent (value);



                if(oldData != newData)
                {



                  if (myColumnDefs.formatter = "number")

                      YAHOO.util.Connect.asyncRequest('GET', '../includes/dataproxy.php?query=teams&type=update&column=' + oColumn.key + qnewval + myBuildUrl(this,oRecord), {

                                   success: function(o) {

                                       if (o.responseText=='200'){

                                                if (oColumn.key == "CountryID") {




                                                               //we must update also the ChapionshipID
                                                               YAHOO.util.Connect.asyncRequest('GET', '../includes/dataproxy.php?query=teams&type=update&column=ChapionshipID&newvalue=create&whereID=' + value + myBuildUrl(this,oRecord), {
                                                               success: function(o) {

                                                                          try {

                                                                              var r = YAHOO.lang.JSON.parse(o.responseText);
                                                                          }
                                                                          catch (x) {
                                                                              alert("JSON Parse failed!");
                                                                              return;
                                                                          }
                                                                          elDropDownchapionships.dropdownOptions = r.DataSet.items;
                                                                          elDropDownchapionships.setOptions();

                                                                          var SetCol = this.getColumn('ChapionshipID');
                                                                          this.updateCell ( oRecord , SetCol , r.DataSet.items[0].value );
                                                                          YAHOO.example.alert('Οι αλλαγές αποθηκεύτηκαν.<br><br><b>Προσοχή, άλλαξε αυτόματα και η στήλη Πρωταθλήματος για να υπάρχει συνέπεια στις εγγραφές.</b>');


                                                                          return;

                                                              },
                                                              failure: function(o) {
                                                                     alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή σας δεν αποθηκεύτηκε.');
                                                              },
                                                              scope: this
                                                              }  );






                                                }


                                                YAHOO.example.alert('Οι αλλαγές αποθηκεύτηκαν.');


                                       } else {
                                          YAHOO.example.alert('Επιτυχής διαδικασία, αλλά δεν λήφθηκε σωστός κωδικός επιστροφής από τον server');

                                       }

                                  },
                                  failure: function(o) {
                                         alert('Παρουσιάστηκε κάποιο σφάλμα. Η εγγραφή σας δεν αποθηκεύτηκε.');
                                  },
                                  scope: this
                          }  );




                  }




             });





            var myTabView = new YAHOO.widget.TabView("tvcontainer");
	        myTabView.getTab(1).addListener("click", function() {DataTable.onShow()})


            return {
             oDS: myDataSource,
             oDT: DataTable,
             oTV: myTabView
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

   <script type="text/javascript">

   var optionsChapionshipID;
   var optionsFilterChapionshipID

   optionsChapionshipID='';
   optionsFilterChapionshipID='';

    //Applies cascading behavior for the specified dropdowns
    function applyCascadingDropdown(sourceId, targetId) {
        var source = document.getElementById(sourceId);
        var target = document.getElementById(targetId);
        if (source && target) {
            source.onchange = function() {
                displayOptionItemsByClass(target, source.value);
            }
            displayOptionItemsByClass(target, source.value);
        }
    }

    //Displays a subset of a dropdown's options
    function displayOptionItemsByClass(selectElement, className) {
        if (!selectElement.backup) {
            selectElement.backup = selectElement.cloneNode(true);
        }
        var options = selectElement.getElementsByTagName("option");
        for(var i=0, length=options.length; i<length; i++) {
            selectElement.removeChild(options[0]);
        }
        var options = selectElement.backup.getElementsByTagName("option");
        for(var i=0, length=options.length; i<length; i++) {
            if (options[i].className==className)
                selectElement.appendChild(options[i].cloneNode(true));
        }
    }

    function FilterCascade() {
       var dropdownchapionship = document.getElementById("FilterChapionshipID").getElementsByTagName("option");;

       var options = ''

       for (var i=0; i < dropdownchapionship.length; i++) {

        if (i == (dropdownchapionship.length - 1) )
          options = options + '{"label":"' + dropdownchapionship[i].text + '", "value":"' + dropdownchapionship[i].value + '"}';
        else
          options = options + '{"label":"' + dropdownchapionship[i].text + '", "value":"' + dropdownchapionship[i].value + '"},';

        }

        optionsFilterChapionshipID = '[' +  options + ']';
        applyCascadingDropdown("FilterCountryID", "FilterChapionshipID");

    }

    function InputCascade() {
       var dropdownchapionship = document.getElementById("ChapionshipID").getElementsByTagName("option");;
       var options = ''

       for (var i=0; i < dropdownchapionship.length; i++) {

        if (i == (dropdownchapionship.length - 1) )
          options = options + '{"label":"' + dropdownchapionship[i].text + '", "value":"' + dropdownchapionship[i].value + '"}';
        else
          options = options + '{"label":"' + dropdownchapionship[i].text + '", "value":"' + dropdownchapionship[i].value + '"},';

        }

        optionsChapionshipID = '[' +  options + ']';
        applyCascadingDropdown("CountryID", "ChapionshipID");

    }

    //Binds dropdowns
    function applyCascadingDropdowns() {

       InputCascade();
       FilterCascade();


    }

    //execute when the page is ready
    window.onload=applyCascadingDropdowns;
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
