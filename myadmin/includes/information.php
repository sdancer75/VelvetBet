         <?php
             include '../includes/database.php';
             $DB = mysql_connect(MySQLIP, Username, Password) or die(mysql_error());
             mysql_select_db(DataBase, $DB) or die(mysql_error());

             $Online = 0;
             $Name = 'Άγνωστος';

             $sqlquery = "SELECT COUNT(AgentID) as OnLineAgents FROM agents WHERE TIMESTAMPDIFF(MINUTE,Lastlogin,'".
                         GR_Time("Y-m-d H:i:s",time())."') < 5 AND TIMESTAMPDIFF(MINUTE,Lastlogin,'".date('Y-m-d H:i:s')."') >=0";

             $result_id = mysql_query($sqlquery);
             $row = mysql_fetch_assoc($result_id);
             if ($row)
                $Online = $row['OnLineAgents'];

             $sqlquery = "SELECT COUNT(SAgentID) as OnLineSAgents FROM superagents WHERE TIMESTAMPDIFF(MINUTE,Lastlogin,'".
                         GR_Time("Y-m-d H:i:s",time())."') < 5 AND TIMESTAMPDIFF(MINUTE,Lastlogin,'".date('Y-m-d H:i:s')."') >=0";


             $result_id = mysql_query($sqlquery);
             $row = mysql_fetch_assoc($result_id);
             if ($row)
                $Online = $Online + $row['OnLineSAgents'];



             $sqlquery = 'SELECT Name from masterusers where MasterID='.$_SESSION['user/id'];
             $result_id = mysql_query($sqlquery);
             $row = mysql_fetch_assoc($result_id);
             if ($row)
                $Name = $row['Name'];



             mysql_close($DB);



         ?>

        <table cellpadding="0" cellspacing="0" border="0" width=100%>
        <tr>
        <td align=left width=70%>
        <span class=InfoTitle>Master :</span>
        <span class=InfoInformation> MASTER (<?php echo $Name ?>)</span>

        <span class=InfoTitle>Συνδεδεμένοι χρήστες (online) :</span>
        <span class=InfoInformation><?php echo $Online ?></span>
        </td>
        <td align=right>
        <span class=InfoTitle >Ημερ. & Ώρα συστήματος :</span>
        <span class=InfoInformation ><?php echo GR_Time("d/m/Y H:i:s",time()) ?></span>
        </td>
        </tr>
        </table>

