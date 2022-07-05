         <?php

             include '../includes/database.php';
             $DB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
             mysql_select_db(DataBase, $DB) or die(mysql_error());

             $Online = 0;
             $Name = 'Άγνωστος';
             $Remainder=0;


             if ($_SESSION['user/level'] == 'agents')
                 $sqlquery = 'SELECT Name,Remainder from '.$_SESSION['user/level'].' where AgentID='.$_SESSION['user/id'];
             else
                 $sqlquery = 'SELECT Name,Remainder from '.$_SESSION['user/level'].' where SAgentID='.$_SESSION['user/id'];


             $result_id = mysql_query($sqlquery);
             $row = mysql_fetch_assoc($result_id);

             if ($row) {
                $Name = $row['Name'];
                $Remainder= $row['Remainder'];

               }

             mysql_close($DB);



            if ($_SESSION['user/level'] == 'agents')
                echo "<span class=InfoTitle>Agent :</span>";
            else
                echo "<span class=InfoTitle>Super Agent :</span>";



         ?>



        <span class=InfoInformation><?php echo $Name ?></span>

        <span class=InfoTitle>Υπόλοιπο :</span>
        <span id="Remainder" class=InfoInformation><?php echo '€'.number_format($Remainder,2,'.','') ?></span>
