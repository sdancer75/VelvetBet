<?php

 function convert_yui($result_id, $field_labels, $type)
{


      //******************** Column Definition *************************************
      if (isset($result_id)){


        //here return the table fields, column names
        $column_count = mysql_num_fields($result_id) or die("display_db_query:" . mysql_error());

        if ($type==1) {

          for ($column_num = 0; $column_num < $column_count; $column_num++) {
                          $field_name = mysql_field_name($result_id, $column_num);

                          //here u can modify thecolumns properties

                          if ( ($column_num==0) && (strpos($field_name, "ID") > 0) ) {
                                $table_header .= "{key:\"".$field_name."\", label:\"$field_labels[$column_num]\", isPrimaryKey:true}";
                          }
                          else {
                                $table_header .= "{key:\"".$field_name."\", label:\"$field_labels[$column_num]\", editor: new YAHOO.widget.TextboxCellEditor({LABEL_CANCEL:\"Ακύρ.\", LABEL_SAVE:\"Αποθ.\", disableBtns:false}), sortable:true, resizeable:true}";
                          }
                          //insert "," at the end
                          $table_header .= (($column_num +1) == $column_count)?",{key:'delete', label:' ', className:'delete-button', action:'delete', width:50}" : ", ";

          }
          return $table_header ;
        }

        //******************** Data Source *************************************
        if ($type==2) {

        $first = 0;


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
                  $field_value .= $field_name.":".html_entity_decode($colum_value);
                  $field_value .= (($column_num + 1 ) == $column_count)?" } ":",";

              }

           }

           //create envelop
           $field_value = "{DataSet: {totalRecords:".html_entity_decode(mysql_num_rows (  $result_id )).",items:[".$field_value."]}}";

           return $field_value;

         }

         //******************** Schema *************************************
         if ($type==3) {

           for ($column_num = 0; $column_num < $column_count; $column_num++) {

               $field_name = mysql_field_name($result_id, $column_num);
               $table_schema .= "\"".$field_name."\"";
               //insert "," at the end
               $table_schema .= (($column_num +1) == $column_count)?" ":", ";

           }


           return $table_schema;
        }

    }
}



?>