<?php

    include '../includes/database.php';





?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HEAD>
<HTML xmlns="http://www.w3.org/1999/xhtml">




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





</HEAD>


<BODY class="yui-skin-sam"  oncontextmenu="return false">

<div align=top>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
  <TBODY>


  <TR>




    <TD style="VERTICAL-ALIGN: top;" width="100%" >
      <Table border=0 width="100%">
        <TR>
            <TD class="yui-skin-sam" style="FONT-SIZE: 11px;"  valign="top" width="100%" style="FONT-SIZE: 10px;">

                <div id="tvcontainer" class="yui-navset">
                    <ul class="yui-nav">
                          <li class="selected"><a href="#tab2"><em>Create</em></a></li>
                    </ul>
                    <div class="yui-content">

                       <div><p>
                                  <table>
                                  <tr>
                                      <td class=TextInfoBlack>

                                            <br><br>
                                            <span id="pushbuttonAddLocalRec" class="yui-button yui-push-button">
                                            <strong class="first-child">
                                              <button type="button" name="pushbuttonAddLocalRec">Add New Line</button>
                                            </strong>
                                            </span>
                                            <br><br>
                                              <div id="formatting" align="center"></div>
                                      </td>
                                  </tr>


                                  </table>


                        </p></div>
                    </div>
                </div>


            </TD>
        </TR>



        </Table>



        <Script type="text/javascript">

        var oDate,oDateShow;
		var AddDataTable;
        var DataEdit;
        var elDropDownchapionships, elDropDownchapionships2;
        var elDropDowncountries, elDropDowncountries2;
        var elDropDownteams, elDropDownteams2;
        var Published;
        var myTabView = new YAHOO.widget.TabView("tvcontainer");


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










        function onAddLocalRec(p_oEvent) {

            DataEdit.addRow({"CountryID": "", "ChapionshipID": "",  "Time":"00:00", "Code":0, "EE":0, "Goal_1":0, "HomeTeamID":"", "Goal_x":0, "HostTeamID": "", "Goal_2":0  });

        }



        var οPushButtonAddLocalRec = new YAHOO.widget.Button("pushbuttonAddLocalRec");
        οPushButtonAddLocalRec.on("click", onAddLocalRec);




      var countriesString = <?php


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
                 $result_id = mysql_query("select CountryID, Country from countries order by Country asc");
                 $MYDATASOURCE = get_pair_values($result_id,"CountryID");
                 mysql_close($DB);
                 echo $MYDATASOURCE;


             ?>;




              elDropDowncountries2 = new YAHOO.widget.DropdownCellEditor({dropdownOptions:YAHOO.lang.JSON.parse(countriesString),disableBtns:false});


              var formatcountries2 = function(elCell, oRecord, oColumn, oData) {

					for (var i=0;i<elDropDowncountries2.dropdownOptions.length;i++) {
						if ( elDropDowncountries2.dropdownOptions[i].value == oData ) {
							elCell.innerHTML = elDropDowncountries2.dropdownOptions[i].label;

							return;
						}

					}
		        };

   			var chapionshipsString = <?php

                 $DB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
                 mysql_select_db(DataBase, $DB) or die(mysql_error());
                 mysql_query("SET NAMES 'utf8'");
                 $result_id = mysql_query("select ChapionshipID, Chapionship from chapionships order by Chapionship asc");
                 $MYDATASOURCE = get_pair_values($result_id,"ChapionshipID");
                 mysql_close($DB);
                 echo $MYDATASOURCE;

             ?>;


              elDropDownchapionships2 = new YAHOO.widget.DropdownCellEditor({dropdownOptions:YAHOO.lang.JSON.parse(chapionshipsString),disableBtns:false});




              var formatchapionships2 = function(elCell, oRecord, oColumn, oData) {

					for (var i=0;i<elDropDownchapionships2.dropdownOptions.length;i++) {
						if ( elDropDownchapionships2.dropdownOptions[i].value == oData ) {
							elCell.innerHTML = elDropDownchapionships2.dropdownOptions[i].label;

							return;
						}

					}



		        };

   			var teamsString = <?php

                 $DB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
                 mysql_select_db(DataBase, $DB) or die(mysql_error());
                 mysql_query("SET NAMES 'utf8'");
                 $result_id = mysql_query("select TeamID, Team from teams order by Team asc");
                 $MYDATASOURCE = get_pair_values($result_id,"TeamID");
                 mysql_close($DB);
                 echo $MYDATASOURCE;

             ?>;


              elDropDownteams2 = new YAHOO.widget.DropdownCellEditor({dropdownOptions:YAHOO.lang.JSON.parse(teamsString),disableBtns:false});




              var formatteams2 = function(elCell, oRecord, oColumn, oData) {

					for (var i=0;i<elDropDownteams2.dropdownOptions.length;i++) {
						if ( elDropDownteams2.dropdownOptions[i].value == oData ) {
							elCell.innerHTML = elDropDownteams2.dropdownOptions[i].label;

							return;
						}

					}



		        };













         YAHOO.util.Event.addListener(window, "load", function() {
         YAHOO.example.EditCoupon =  function() {
         var Dom = YAHOO.util.Dom;




            var myColumnDefs = [

                {key:"CountryID", label:"Country", formatter:formatcountries2, editor:elDropDowncountries2, width:70},
				{key:"ChapionshipID", label:"Chapionship",  formatter:formatchapionships2, editor : elDropDownchapionships2,  width:130},
                {key:"Time", label:"Time", width:30, editor: new YAHOO.widget.TextboxCellEditor({ disableBtns:false})},
                {key:"Code", label:"Code", editor: new YAHOO.widget.TextboxCellEditor({ disableBtns:false}), formatter:"string", width:20},
                {key:"EE", label:"EE", editor: new YAHOO.widget.DropdownCellEditor({ dropdownOptions:["1","2","3","4","5"],disableBtns:false})},
                {key:"Goal_1", label:"1", editor: new YAHOO.widget.TextboxCellEditor({ disableBtns:false}) },
                {key:"HomeTeamID", label:"Home", formatter:formatteams2, editor : elDropDownteams2},
                {key:"Goal_x", label:"X", editor: new YAHOO.widget.TextboxCellEditor({ disableBtns:false})},
                {key:"HostTeamID", label:"Host", formatter:formatteams2, editor : elDropDownteams2},
                {key:"Goal_2", label:"2", editor: new YAHOO.widget.TextboxCellEditor({ disableBtns:false})},
                {key:'del', label:'', className: 'delete-button', action:'delete', width:15}
            ];

            var myDataSource = new YAHOO.util.DataSource(YAHOO.example.Inserted.multitypes);
            myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSARRAY;

            //var myDataSource = new YAHOO.util.DataSource(YAHOO.example.Data.multitypes);
            //myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSON;

            myDataSource.responseSchema = {
                resultsList: "items",
                // Use the parse methods to populate the RecordSet with the right data types
                fields: [
                    {key:"CountryID", parser:"number"},
					{key:"ChapionshipID", parser:"number"},
                    {key:"Time", parser:"string"},
                    {key:"Code", parser:"string"},
                    {key:"EE", parser:"number"},
                    {key:"Goal_1", parser:"number"},
                    {key:"HomeTeamID", parser:"string"},
                    {key:"Goal_x", parser:"number"},
                    {key:"HostTeamID", parser:"string"},
                    {key:"Goal_2", parser:"string"},
                    {key:"del"}
                ]
            };

            var oConfigs = {

                    dateOptions:{format:"%d/%m/%Y"},
                    selectionMode:"single",
                    numberOptions:{decimalPlaces:2, thousandsSeparator:","},
                    MSG_EMPTY:"no records",
                    draggableColumns:false
	        };

            DataEdit = new YAHOO.widget.DataTable("formatting", myColumnDefs, myDataSource, oConfigs  );



            // Set up editing flow
	        var highlightEditableCell = function(oArgs) {
	            var elCell = oArgs.target;
	            if(YAHOO.util.Dom.hasClass(elCell, "yui-dt-editable")) {
	                this.highlightCell(elCell);
	            }
	        };


            DataEdit.subscribe("cellMouseoverEvent", highlightEditableCell);
	        DataEdit.subscribe("cellMouseoutEvent", DataEdit.onEventUnhighlightCell);





           /**************************************

           DataEdit.doBeforeShowCellEditor = function(oCellEditor)


                 Note:

                 if I replace all the database code below and do it hard coded like this

                 oEditor.dropdownOptions = YAHOO.lang.JSON.parse('[{"label": "Germany", "value": "97"}, {"label": "Italy", "value": "101"}]');
                 oEditor.setOptions();


                 then the TAB key it works !!



           ***************************************/

           DataEdit.doBeforeShowCellEditor = function(oCellEditor) {


                var oEditor1 = elDropDowncountries2;
                var oEditor2 = elDropDownchapionships2;
                var oEditor3 = elDropDownteams2;
                var oEditor = oCellEditor;
		        var oRecord = oEditor.getRecord();
           		var oColumn1 = this.getColumn('CountryID');
				var oColumn2 = this.getColumn('ChapionshipID');
                var valueCountry = oRecord.getData(oColumn1.key);
				var valueChapionship = oRecord.getData(oColumn2.key);
				var processID;






                //take the value of the CountryID and fill the drop down menu with appropriate chapionship values that
                //corresponds to that country
                if (oEditor == oEditor2) {


                             ajaxLoadingPanel.show();
                            processID = YAHOO.util.Connect.asyncRequest('GET', '../includes/dataproxy.php?query=chapionships&primaryKey=ChapionshipID&type=select&output=dropdown&whereID=' + valueCountry, {
                                         success: function(o) {

                                                try {

                                                    var r = YAHOO.lang.JSON.parse(o.responseText);
                                                }
                                                catch (x) {

                                                    alert("JSON Parse failed!");
                                                    return;
                                                }


                                                oEditor.dropdownOptions = r.DataSet.items;
                                                oEditor.setOptions();

                                                ajaxLoadingPanel.hide();


                                        },
                                        failure: function(o) {

                                        },
                                        scope: this
                                }  );




                }

 				if (oEditor == oEditor3) {


							ajaxLoadingPanel.show();
                            processID = YAHOO.util.Connect.asyncRequest('GET', '../includes/dataproxy.php?query=teams&primaryKey=TeamID&type=select&output=dropdown&whereID=' + valueChapionship, {
                                         success: function(o) {

                                                try {

                                                    var r = YAHOO.lang.JSON.parse(o.responseText);
                                                }
                                                catch (x) {

                                                    alert("JSON Parse failed!");
                                                    return;
                                                }


                                                oEditor.dropdownOptions = r.DataSet.items;
                                                oEditor.setOptions();
                                                ajaxLoadingPanel.hide();

                                        },
                                        failure: function(o) {

                                        },
                                        scope: this
                                }  );


				}

                //dont let show countries that dont have chapionships.
                if (oEditor == oEditor1) {



                            ajaxLoadingPanel.show();

                            processID = YAHOO.util.Connect.asyncRequest('GET', '../includes/dataproxy.php?query=countries&primaryKey=CountryID&type=select&output=dropdown', {
                                         success: function(o) {

                                                try {

                                                    var r = YAHOO.lang.JSON.parse(o.responseText);
                                                }
                                                catch (x) {
                                                    alert("JSON Parse failed!");
                                                    return;
                                                }

                                                oEditor.dropdownOptions = r.DataSet.items;
                                                oEditor.setOptions();
                                                ajaxLoadingPanel.hide();

                                        },
                                        failure: function(o) {

                                        },
                                        scope: this
                                }  );

                }


                return true;
            };






			DataEdit.subscribe('cellClickEvent',function(oArgs) {


                var target = oArgs.target;

                column = this.getColumn(target);
                record = this.getRecord(target);



                switch (column.action) {

                 case 'delete' :

                            if (confirm('Είσαι σίγουρος για τη διαγραφή ;')) {
                            		this.deleteRow(target);
                            }
                            break;
                    case 'insert':

                            break;
                    default:DataEdit.onEventShowCellEditor(oArgs);
                            break;
                }

            })


      /* Start of change by Satyam to allow for keyboard navigation */

      	   DataEdit.subscribe("editorKeydownEvent",function(oArgs) {
 			var self = this,
				ed = this._oCellEditor,  // Should be: oArgs.editor, see: http://yuilibrary.com/projects/yui2/ticket/2513909
				ev = oArgs.event,
				KEY = YAHOO.util.KeyListener.KEY,
				Textbox = YAHOO.widget.TextboxCellEditor,
				Textarea = YAHOO.widget.TextareaCellEditor,
				cell = ed.getTdEl(),
				col = ed.getColumn(),
				row,rec,

				editNext = function(cell) {
					cell = self.getNextTdEl(cell);
					while (cell && !self.getColumn(cell).editor) {
						cell = self.getNextTdEl(cell);
					}
					if (cell) {
						self.showCellEditor(cell);
					}
				},
				editPrevious = function(cell) {
					cell = self.getPreviousTdEl(cell);
					while (cell && !self.getColumn(cell).editor) {
						cell = self.getPreviousTdEl(cell);
					}
					if (cell) {
						self.showCellEditor(cell);
					}
				};

			switch (ev.keyCode) {
				case KEY.UP:
					if (ed instanceof Textarea) { return; }
					YAHOO.util.Event.stopEvent(ev);
					ed.save();
					row = this.getPreviousTrEl(cell);
					if (row) {
						rec = this.getRecord(row);
						this.showCellEditor({record:rec,column:col});
					}
					break;
				case KEY.DOWN:
					if (ed instanceof Textarea) { return; }
					YAHOO.util.Event.stopEvent(ev);
					ed.save();
					row = this.getNextTrEl(cell);
					if (row) {
						rec = this.getRecord(row);
						this.showCellEditor({record:rec,column:col});
					}
					break;
				case KEY.LEFT:
					if (ed instanceof Textbox || ed instanceof Textarea) { return; }
					YAHOO.util.Event.stopEvent(ev);
					ed.save();
					editPrevious(cell);
					break;
				case KEY.RIGHT:
					if (ed instanceof Textbox || ed instanceof Textarea) { return; }
					YAHOO.util.Event.stopEvent(ev);
					ed.save();
					editNext(cell);
					break;
				case KEY.TAB:
					YAHOO.util.Event.stopEvent(ev);
					ed.save();
					if (ev.shiftKey) {
						editPrevious(cell);
					} else {
						editNext(cell);
					}
					break;
			}
		});

		// End of key handling

		// The following code tries to keep the cell editor visible at all times.

		DataEdit.on('editorShowEvent', function (oArgs) {
			var Dom = YAHOO.util.Dom;
			var el = oArgs.editor.getContainerEl();
			var reg = Dom.getRegion(el);
			var topScreen = Dom.getDocumentScrollTop(),
				bottomScreen = topScreen + Dom.getViewportHeight();
			if (reg.top < topScreen) {
				el.scrollIntoView();
			}
			if (reg.bottom > bottomScreen) {
				el.scrollIntoView(false);
			}
		});

		// End of patch.






	        myTabView.getTab(0).addListener("click", function() {DataEdit.onShow()});


             return {
                oDS: myDataSource,
                oDT: DataEdit,
                oTV: myTabView
            };


        }();
});


    </script>










    </TD>
  </TR>

</TBODY>
</TABLE>
</div>

</BODY>
</HTML>
