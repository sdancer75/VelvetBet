CREATE PROCEDURE lackybet.sp_UpdateBets(IN pCouponID BIGINT, IN pSemiScore CHAR (15), IN pFinalScore CHAR (15))
  DETERMINISTIC
  SQL SECURITY INVOKER
  READS SQL DATA
exit_label:
BEGIN


  -- declare exit handler for not found rollback;
  -- declare exit handler for sqlexception rollback;
  -- declare exit handler for sqlwarning rollback;
  -- declare continue handler for not found set no_more := true; 

  DECLARE done                     BIT (1) DEFAULT 0;
  DECLARE nGoal                    TINYINT DEFAULT -1;
  DECLARE nUserBetID               BIGINT DEFAULT -1;
  DECLARE nBetType                 TINYINT DEFAULT -1;
  DECLARE nUserBetSynopsisID       BIGINT DEFAULT -1;
  DECLARE nUserBetsCount           TINYINT DEFAULT -1;
  DECLARE nSynopsisDP              TINYINT DEFAULT -1;
  DECLARE nPossibleProfit          DOUBLE (11, 4) DEFAULT -1;
  DECLARE nSAgentID                BIGINT DEFAULT -1;
  DECLARE nAgentID                 BIGINT DEFAULT -1;
  DECLARE nAgentProfit             DOUBLE (11, 4) DEFAULT -1;
  DECLARE nCost                    DOUBLE (11, 4) DEFAULT -1;
  DECLARE nDirty                   TINYINT DEFAULT 0;
  DECLARE nBetStatus               TINYINT DEFAULT -1;
  DECLARE nBetDP                   TINYINT DEFAULT -1;
  DECLARE nSynopsisStatus          TINYINT DEFAULT -1;
  DECLARE nMoney                   DOUBLE (11, 4) DEFAULT -1;
  DECLARE nCanceled                TINYINT DEFAULT 0;
  DECLARE nEventCanceled           TINYINT DEFAULT 0;
  DECLARE nCouponID                BIGINT DEFAULT -1;


  DECLARE nMAXProfit               DOUBLE (11, 4) DEFAULT -1;
  DECLARE nTotalCanceled           TINYINT DEFAULT 0;



  DECLARE nSemiScore_A_Team        TINYINT DEFAULT -1;
  DECLARE nSemiScore_B_Team        TINYINT DEFAULT -1;
  DECLARE nScore_A_Team            TINYINT DEFAULT -1;
  DECLARE nScore_B_Team            TINYINT DEFAULT -1;
  DECLARE strSemiScore             CHAR (15);
  DECLARE strFinalScore            CHAR (15);
  DECLARE nPos                     TINYINT DEFAULT -1;
  DECLARE nStatus                  TINYINT DEFAULT 3; -- 0=Open, 1=Closed, 2=Won, 3=Lost
  DECLARE nTotalStatus             SMALLINT;
  DECLARE nClosedBets              TINYINT DEFAULT -1;
  DECLARE nClosedSystemBets        SMALLINT DEFAULT -1;
  DECLARE nClosedSystemBetsUserWon DOUBLE (11, 4) DEFAULT -1;
  DECLARE nCommission_tziros       DOUBLE (11, 4) DEFAULT -1;
  DECLARE nCommission_pososto      DOUBLE (11, 4) DEFAULT -1;
  DECLARE nSAgentProfitWin         DOUBLE (11, 4) DEFAULT -1;
  DECLARE nSAgentProfitLose        DOUBLE (11, 4) DEFAULT -1;
  DECLARE nMasterProfitWin         DOUBLE (11, 4) DEFAULT -1;
  DECLARE nMasterProfitLose        DOUBLE (11, 4) DEFAULT -1;
  DECLARE nKerdosZimia             DOUBLE (11, 4) DEFAULT -1;




  DECLARE userbets_cursor CURSOR FOR
  SELECT
    GoalCoded, UserBetID, userbetssynopsis.BetType, userbets.UserBetSynopsisID, UserBetsCount, PossibleProfit, userbetssynopsis.SAgentID, AgentID, AgentProfit, Cost, Dirty, SAgentProfitWin, SAgentProfitLose, MasterProfitWin, MasterProfitLose, userbets.Status, userbetssynopsis.Canceled, userbets.EventCanceled, userbets.CouponID, userbetssynopsis.Status, userbetssynopsis.dp, userbets.BetDP
  FROM
    userbets, userbetssynopsis
  WHERE
    userbetssynopsis.UserBetSynopsisID = userbets.UserBetSynopsisID
    AND userbets.CouponID = pCouponID;


  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;




  -- Find the semi and final scores *********************************************************

  -- In case the match is canceled before the admin inputs any value
  IF pSemiScore <> '-' THEN

    -- Seni Score
    SET strSemiScore = RTRIM(pSemiScore);


    SET nPos = INSTR(strSemiScore, '-');
    IF nPos = 0 THEN
      LEAVE exit_label;
    END IF;



    SET nSemiScore_A_Team = SUBSTR(strSemiScore, 1, nPos - 1);
    SET nSemiScore_B_Team = SUBSTR(strSemiScore, nPos + 1);
  ELSE
    SET nSemiScore_A_Team = 0;
    SET nSemiScore_B_Team = 0;

  END IF;


  -- In case the match is canceled before the admin inputs any value
  IF pFinalScore <> '-' THEN

    -- Final Score
    SET strFinalScore = RTRIM(pFinalScore);

    SET nPos = INSTR(strFinalScore, '-');
    IF nPos = 0 THEN
      LEAVE exit_label;
    END IF;



    SET nScore_A_Team = SUBSTR(strFinalScore, 1, nPos - 1);
    SET nScore_B_Team = SUBSTR(strFinalScore, nPos + 1);
  ELSE
    SET nScore_A_Team = 0;
    SET nScore_B_Team = 0;
  END IF;

  -- ***************************************************************************************

  OPEN userbets_cursor;



  SET @sqlquery = 'UPDATE userbets SET Status =? WHERE UserBetID =?';
  PREPARE update_userbets FROM @sqlquery;

  SET @sqlquery = 'SELECT SAgentProfit,AgentProfit  INTO @UndoSAgentRemainder,@UndoAgentRemainder FROM indexedtransreport WHERE UserBetSynopsisID =?';
  PREPARE select_indexedtransreport FROM @sqlquery;



  SELECT
    MaxProfit
  INTO
    nMAXProfit
  FROM
    master;

  IF nMAXProfit = 0 THEN
    SET nMAXProfit = 10000;
  END IF;

  DELETE
  FROM
    userbetsindexreport;

find_bets_with_same_CouponID:
  LOOP



    SET done = 0;
    FETCH userbets_cursor INTO nGoal, nUserBetID, nBetType, nUserBetSynopsisID, nUserBetsCount, nPossibleProfit, nSAgentID, nAgentID, nAgentProfit, nCost, nDirty, nSAgentProfitWin, nSAgentProfitLose, nMasterProfitWin, nMasterProfitLose, nBetStatus, nCanceled, nEventCanceled, nCouponID, nSynopsisStatus, nSynopsisDP, nBetDP;

    IF done THEN
      LEAVE find_bets_with_same_CouponID;
    END IF;




    -- ['Goal_1','Goal_x','Goal_2','Under','Over','GG','NG','de_1ORX','de_XOR2','de_1OR2','HMI_1','HMI_X','HMI_2','HT_11','HT_1X','HT_12','HT_X1','HT_XX','HT_X2','HT_21','HT_2X','HT_22','SS_10','SS_20','SS_21','SS_30',
    -- 'SS_31','SS_32','SS_40','SS_41','SS_42','SS_43','SS_00','SS_11','SS_22','SS_33','SS_01','SS_02','SS_12','SS_03','SS_13','SS_23','SS_04','SS_14','SS_24','SS_34',
    -- 'TG_01','TG_23','TG_46','TG_7'];

    SET nStatus = 3; -- default is lost
    CASE nGoal
    -- Goal_1
    WHEN 0 THEN
      IF nScore_A_Team > nScore_B_Team THEN
        SET nStatus = 2;
      END IF;
    -- Goal_X
    WHEN 1 THEN
      IF nScore_A_Team = nScore_B_Team THEN
        SET nStatus = 2;
      END IF;
    -- Goal_2
    WHEN 2 THEN
      IF nScore_A_Team < nScore_B_Team THEN
        SET nStatus = 2;
      END IF;
    -- Under
    WHEN 3 THEN
      IF (nScore_A_Team + nScore_B_Team) < 2.5 THEN
        SET nStatus = 2;
      END IF;
    -- Over
    WHEN 4 THEN
      IF (nScore_A_Team + nScore_B_Team) > 2.5 THEN
        SET nStatus = 2;
      END IF;
    -- GG
    WHEN 5 THEN
      IF (nScore_A_Team > 0) AND (nScore_B_Team > 0) THEN
        SET nStatus = 2;
      END IF;
    -- NG
    WHEN 6 THEN
      IF (nScore_A_Team = 0) OR (nScore_B_Team = 0) THEN
        SET nStatus = 2;
      END IF;
    -- de_1ORX
    WHEN 7 THEN
      IF (nScore_A_Team > nScore_B_Team) OR (nScore_A_Team = nScore_B_Team) THEN
        SET nStatus = 2;
      END IF;
    -- de_XOR2
    WHEN 8 THEN
      IF (nScore_A_Team = nScore_B_Team) OR (nScore_B_Team > nScore_A_Team) THEN
        SET nStatus = 2;
      END IF;
    -- de_1OR2
    WHEN 9 THEN
      IF (nScore_A_Team > nScore_B_Team) OR (nScore_B_Team > nScore_A_Team) THEN
        SET nStatus = 2;
      END IF;
    -- HMI_1
    WHEN 10 THEN
      IF nSemiScore_A_Team > nSemiScore_B_Team THEN
        SET nStatus = 2;
      END IF;
    -- HMI_X
    WHEN 11 THEN
      IF nSemiScore_A_Team = nSemiScore_B_Team THEN
        SET nStatus = 2;
      END IF;
    -- HMI_2
    WHEN 12 THEN
      IF nSemiScore_B_Team > nSemiScore_A_Team THEN
        SET nStatus = 2;
      END IF;
    -- HT_11
    WHEN 13 THEN
      IF (nSemiScore_A_Team > nSemiScore_B_Team) AND (nScore_A_Team > nScore_B_Team) THEN
        SET nStatus = 2;
      END IF;
    -- HT_1X
    WHEN 14 THEN
      IF (nSemiScore_A_Team > nSemiScore_B_Team) AND (nScore_A_Team = nScore_B_Team) THEN
        SET nStatus = 2;
      END IF;
    -- HT_12
    WHEN 15 THEN
      IF (nSemiScore_A_Team > nSemiScore_B_Team) AND (nScore_B_Team > nScore_A_Team) THEN
        SET nStatus = 2;
      END IF;
    -- HT_X1
    WHEN 16 THEN
      IF (nSemiScore_A_Team = nSemiScore_B_Team) AND (nScore_A_Team > nScore_B_Team) THEN
        SET nStatus = 2;
      END IF;
    -- HT_XX
    WHEN 17 THEN
      IF (nSemiScore_A_Team = nSemiScore_B_Team) AND (nScore_A_Team = nScore_B_Team) THEN
        SET nStatus = 2;
      END IF;
    -- HT_X2
    WHEN 18 THEN
      IF (nSemiScore_A_Team = nSemiScore_B_Team) AND (nScore_B_Team > nScore_A_Team) THEN
        SET nStatus = 2;
      END IF;
    -- HT_21
    WHEN 19 THEN
      IF (nSemiScore_B_Team > nSemiScore_A_Team) AND (nScore_A_Team > nScore_B_Team) THEN
        SET nStatus = 2;
      END IF;
    -- HT_2X
    WHEN 20 THEN
      IF (nSemiScore_B_Team > nSemiScore_A_Team) AND (nScore_A_Team = nScore_B_Team) THEN
        SET nStatus = 2;
      END IF;
    -- HT_22
    WHEN 21 THEN
      IF (nSemiScore_B_Team > nSemiScore_A_Team) AND (nScore_B_Team > nScore_A_Team) THEN
        SET nStatus = 2;
      END IF;
    -- SS_10
    WHEN 22 THEN
      IF (nScore_A_Team = 1) AND (nScore_B_Team = 0) THEN
        SET nStatus = 2;
      END IF;
    -- SS_20
    WHEN 23 THEN
      IF (nScore_A_Team = 2) AND (nScore_B_Team = 0) THEN
        SET nStatus = 2;
      END IF;
    -- SS_21
    WHEN 24 THEN
      IF (nScore_A_Team = 2) AND (nScore_B_Team = 1) THEN
        SET nStatus = 2;
      END IF;
    -- SS_30
    WHEN 25 THEN
      IF (nScore_A_Team = 3) AND (nScore_B_Team = 0) THEN
        SET nStatus = 2;
      END IF;
    -- SS_31
    WHEN 26 THEN
      IF (nScore_A_Team = 3) AND (nScore_B_Team = 1) THEN
        SET nStatus = 2;
      END IF;
    -- SS_32
    WHEN 27 THEN
      IF (nScore_A_Team = 3) AND (nScore_B_Team = 2) THEN
        SET nStatus = 2;
      END IF;
    -- SS_40
    WHEN 28 THEN
      IF (nScore_A_Team = 4) AND (nScore_B_Team = 0) THEN
        SET nStatus = 2;
      END IF;
    -- SS_41
    WHEN 29 THEN
      IF (nScore_A_Team = 4) AND (nScore_B_Team = 1) THEN
        SET nStatus = 2;
      END IF;
    -- SS_42
    WHEN 30 THEN
      IF (nScore_A_Team = 4) AND (nScore_B_Team = 2) THEN
        SET nStatus = 2;
      END IF;
    -- SS_43
    WHEN 31 THEN
      IF (nScore_A_Team = 4) AND (nScore_B_Team = 3) THEN
        SET nStatus = 2;
      END IF;
    -- SS_00
    WHEN 32 THEN
      IF (nScore_A_Team = 0) AND (nScore_B_Team = 0) THEN
        SET nStatus = 2;
      END IF;
    -- SS_11
    WHEN 33 THEN
      IF (nScore_A_Team = 1) AND (nScore_B_Team = 1) THEN
        SET nStatus = 2;
      END IF;
    -- SS_22
    WHEN 34 THEN
      IF (nScore_A_Team = 2) AND (nScore_B_Team = 2) THEN
        SET nStatus = 2;
      END IF;
    -- SS_33
    WHEN 35 THEN
      IF (nScore_A_Team = 3) AND (nScore_B_Team = 3) THEN
        SET nStatus = 2;
      END IF;
    -- SS_01
    WHEN 36 THEN
      IF (nScore_A_Team = 0) AND (nScore_B_Team = 1) THEN
        SET nStatus = 2;
      END IF;
    -- SS_02
    WHEN 37 THEN
      IF (nScore_A_Team = 0) AND (nScore_B_Team = 2) THEN
        SET nStatus = 2;
      END IF;
    -- SS_12
    WHEN 38 THEN
      IF (nScore_A_Team = 1) AND (nScore_B_Team = 2) THEN
        SET nStatus = 2;
      END IF;
    -- SS_03
    WHEN 39 THEN
      IF (nScore_A_Team = 0) AND (nScore_B_Team = 3) THEN
        SET nStatus = 2;
      END IF;
    -- SS_13
    WHEN 40 THEN
      IF (nScore_A_Team = 1) AND (nScore_B_Team = 3) THEN
        SET nStatus = 2;
      END IF;
    -- SS_23
    WHEN 41 THEN
      IF (nScore_A_Team = 2) AND (nScore_B_Team = 3) THEN
        SET nStatus = 2;
      END IF;
    -- SS_04
    WHEN 42 THEN
      IF (nScore_A_Team = 0) AND (nScore_B_Team = 4) THEN
        SET nStatus = 2;
      END IF;
    -- SS_14
    WHEN 43 THEN
      IF (nScore_A_Team = 1) AND (nScore_B_Team = 4) THEN
        SET nStatus = 2;
      END IF;
    -- SS_24
    WHEN 44 THEN
      IF (nScore_A_Team = 2) AND (nScore_B_Team = 4) THEN
        SET nStatus = 2;
      END IF;
    -- SS_34
    WHEN 45 THEN
      IF (nScore_A_Team = 3) AND (nScore_B_Team = 4) THEN
        SET nStatus = 2;
      END IF;
    -- TG_01
    WHEN 46 THEN
      IF (nScore_A_Team + nScore_B_Team <= 1) THEN
        SET nStatus = 2;
      END IF;
    -- TG_23
    WHEN 47 THEN
      IF (nScore_A_Team + nScore_B_Team >= 2) AND (nScore_A_Team + nScore_B_Team <= 3) THEN
        SET nStatus = 2;
      END IF;
    -- TG_46
    WHEN 48 THEN
      IF (nScore_A_Team + nScore_B_Team >= 4) AND (nScore_A_Team + nScore_B_Team <= 6) THEN
        SET nStatus = 2;
      END IF;
    -- TG_7
    WHEN 49 THEN
      IF (nScore_A_Team + nScore_B_Team >= 7) THEN
        SET nStatus = 2;
      END IF;
    ELSE
      SET nStatus = -1;

    END CASE;






    IF nEventCanceled = 1 THEN
      SET nStatus = 2; -- always wins the canceled event;
      SET nDirty = 1; -- force to recompute;
    END IF;


    SET @nStatus = nStatus;
    SET @nUserBetID = nUserBetID;
    -- the execute from a prepared  query returns error Invalid query: PROCEDURE can't return a result set in the given context
    -- EXECUTE update_userbets USING @nStatus, @nUserBetID;
    UPDATE
      userbets
    SET
      STATUS = @nStatus
    WHERE
      UserBetID = @nUserBetID;

    -- SET @UserBetSynopsisID = nUserBetSynopsisID;
    -- EXECUTE select_indexedtransreport USING @UserBetSynopsisID;



    -- Fill Back the Remainders to Masters and SAgents since we have undo job
    --  IF Done = 0 AND nDirty=1 THEN

    -- SET nMoney = @UndoSAgentRemainder;
    -- UPDATE superagents SET Remainder = Remainder + nMoney  WHERE SAgentID = nSAgentID;

    -- SET nMoney = @UndoAgentRemainder;
    -- UPDATE agents SET Remainder = Remainder + nMoney  WHERE AgentID = nAgentID;

    -- DELETE FROM indexedtransreport WHERE UserBetSynopsisID = nUserBetSynopsisID;


    -- END IF;

    -- SET Done=0;



    IF (nSynopsisDP <> 0) AND (nBetDP = 1) THEN

      SELECT
        SUM(Status)
      INTO
        @nSumGhostStatus
      FROM
        userbets
      WHERE
        CouponID = nCouponID AND UserBetSynopsisID = nUserBetSynopsisID;


      IF (nEventCanceled = 0) THEN

        -- If sum of the pair=3+3=6 then the coupon is totally lost
        IF (@nSumGhostStatus = 6) THEN

          SET nStatus = 3; -- lost status		

        -- If sum of the pair=2+2=4 then the coupon is totally won
        ELSEIF (@nSumGhostStatus = 4) OR (@nSumGhostStatus = 5) THEN

          SET nStatus = 2; -- won status
          SET nDirty = 1; -- always force to recompute since the precomputed values are not valid in this case;	

        -- any other combination of the sum means that the pair is still open.
        -- in this case give the status=-1 to avoid any process
        ELSE

          SET nStatus = -1; -- unknown status, just a trick to avoid any process

        END IF;

      ELSE

        -- can not accept  the pair to have 2 wons (2+2) at the canceled event
        -- since we will have problem later
        IF (@nSumGhostStatus = 4) THEN

          -- make current as lose
          UPDATE
            userbets
          SET
            STATUS = 3
          WHERE
            UserBetID = @nUserBetID;

        END IF;

      END IF;


    END IF;



    -- **************************************************************************************************************
    -- LOST LOST LOST LOST
    -- If status = lost and bettype is mono or pollaplo then the bet is over and characterize it as lost
    -- **************************************************************************************************************
    IF (nBetType = 0 OR nBetType = 1) AND (nStatus = 3) THEN

      -- No recomputations
      IF (nDirty = 0) THEN

        UPDATE
          userbetssynopsis
        SET
          STATUS = nStatus, SAgentProfitLose = 0, MasterProfitLose = 0, FinalUserProfit = 0, Payment = 0, Dirty = 1
        WHERE
          UserBetSynopsisID = nUserBetSynopsisID;

        -- update report
        IF (nSynopsisStatus <> nStatus) AND (nCanceled = 0) THEN
          DELETE
          FROM
            userbetsindexreport
          WHERE
            UserBetSynopsisID = nUserBetSynopsisID;

          INSERT
          INTO userbetsindexreport (CouponID, UserBetSynopsisID)
          VALUES (nCouponID, nUserBetSynopsisID);
        END IF;

      -- SET  nMasterProfitLose = 0;
      -- SET  nSAgentProfitLose = 0;

      -- Set @SAgentRemainder = nSAgentProfitWin - nSAgentProfitLose;

      -- IF nCanceled = 0 THEN

      -- INSERT INTO indexedtransreport (UserBetSynopsisID, SAgentID, MasterProfit, SAgentProfit, AgentProfit)
      -- VALUES (nUserBetSynopsisID, nSAgentID, -(nMasterProfitWin - nMasterProfitLose), -@SAgentRemainder, -nAgentProfit);


      -- UPDATE superagents SET Remainder = Remainder + @SAgentRemainder WHERE SAgentID = nSAgentID;
      -- UPDATE agents SET Remainder = Remainder + nAgentProfit WHERE AgentID = nAgentID;

      -- END IF;


      ELSE
        -- Recompute


        SELECT
          Commission_tziros, Commission_pososto
        INTO
          nCommission_tziros, nCommission_pososto
        FROM
          superagents
        WHERE
          SAgentID = nSAgentID;

        IF (nCommission_tziros = 0) THEN

          SET nKerdosZimia = (nCost - nAgentProfit);
          SET nSAgentProfitWin = nKerdosZimia * (nCommission_pososto / 100.0000);
          SET nMasterProfitWin = nKerdosZimia - nSAgentProfitWin;

          SET nSAgentProfitLose = 0;
          SET nMasterProfitLose = 0;

        ELSE

          SET nSAgentProfitWin = nCost * (nCommission_tziros / 100.0000);
          SET nSAgentProfitLose = 0;

          SET nMasterProfitWin = ABS(nCost - nSAgentProfitWin - nAgentProfit);
          SET nSAgentProfitLose = 0;

        END IF;




        UPDATE
          userbetssynopsis
        SET
          STATUS = nStatus, SAgentProfitLose = 0, MasterProfitLose = 0, FinalUserProfit = 0, Payment = 1, Dirty = 1, SAgentProfitWin = nSAgentProfitWin, MasterProfitWin = nMasterProfitWin
        WHERE
          UserBetSynopsisID = nUserBetSynopsisID;

        -- update report

        IF (nSynopsisStatus <> nStatus) AND (nCanceled = 0) THEN

          DELETE
          FROM
            userbetsindexreport
          WHERE
            UserBetSynopsisID = nUserBetSynopsisID;

          INSERT
          INTO userbetsindexreport (CouponID, UserBetSynopsisID)
          VALUES (nCouponID, nUserBetSynopsisID);
        END IF;

      -- Set nMoney = nSAgentProfitWin - nSAgentProfitLose;

      -- IF nCanceled = 0 THEN

      -- INSERT INTO indexedtransreport (UserBetSynopsisID, SAgentID, MasterProfit, SAgentProfit, AgentProfit)
      -- VALUES (nUserBetSynopsisID, nSAgentID, -(nMasterProfitWin - nMasterProfitLose), -nMoney, -nAgentProfit);

      -- UPDATE superagents SET Remainder = Remainder + nMoney WHERE SAgentID = nSAgentID;
      -- UPDATE agents SET Remainder = Remainder + nAgentProfit WHERE AgentID = nAgentID;

      -- END IF;


      END IF;




    -- ******************************************************************************************************************************************
    -- WON WON WON WON WON
    -- If status = won and bettype is mono or pollaplo then check if all the rest event are already over and characterize it as won if its true
    -- ******************************************************************************************************************************************
    ELSEIF (nBetType = 0 OR nBetType = 1) AND (nStatus = 2) THEN


      -- ask if all userbets are closed or something is already lost.
      SELECT
        SUM(CASE WHEN Status > 0 THEN 1 ELSE 0 END), SUM(CASE WHEN Status > 0 THEN Status ELSE 0 END), SUM(EventCanceled), SUM(CASE WHEN Status = 3 AND BetDP = 0 THEN 1 ELSE 0 END), SUM(CASE WHEN Status = 0 AND BetDP = 1 THEN 1 ELSE 0 END), SUM(CASE WHEN Status <> 0 AND BetDP = 1 THEN Status ELSE 0 END), SUM(CASE WHEN EventCanceled AND BetDP = 1 THEN 1 ELSE 0 END)
      INTO
        nClosedBets, nTotalStatus, nTotalCanceled, @nTotalLose, @nSum_DP_Open, @nSum_DP, @nDP_Canceled
      FROM
        userbets
      WHERE
        UserBetSynopsisID = nUserBetSynopsisID;


      SET @nDP_Canceled = @nDP_Canceled DIV 2;
      SET @CountNotOpenDP = nSynopsisDP - (@nSum_DP_Open DIV 2);
      -- do this, just to avoid div by zero and null resutls
      IF (@CountNotOpenDP > 0) THEN
        SET @nDPLose = MOD(@nSum_DP, (@CountNotOpenDP * 5));
      ELSE
        SET @nDPLose = 0;
      END IF;

      SET @nTotalLose = @nTotalLose + @nDPLose;

      -- if yes then close the bet and characterize it
      IF (nClosedBets = nUserBetsCount) OR (@nTotalLose > 0) THEN

        -- No recomputations
        IF nDirty = 0 AND nTotalCanceled = 0 AND nSynopsisDP = 0 AND @nTotalLose=0 THEN


          SELECT
            Commission_tziros, Commission_pososto
          INTO
            nCommission_tziros, nCommission_pososto
          FROM
            superagents
          WHERE
            SAgentID = nSAgentID;

          IF (nCommission_tziros = 0) THEN
            -- pososto come here
            UPDATE
              userbetssynopsis
            SET
              STATUS = 2, SAgentProfitWin = 0, MasterProfitWin = 0, FinalUserProfit = nPossibleProfit, Payment = 0, Dirty = 1
            WHERE
              UserBetSynopsisID = nUserBetSynopsisID;
          ELSE

            -- tziros come here
            -- SuperAgent in this case always wins.
            UPDATE
              userbetssynopsis
            SET
              STATUS = 2, MasterProfitWin = 0, FinalUserProfit = nPossibleProfit, Payment = 0, Dirty = 1
            WHERE
              UserBetSynopsisID = nUserBetSynopsisID;

          END IF;

          -- update report
          IF (nSynopsisStatus <> nStatus) AND (nCanceled = 0) THEN

            DELETE
            FROM
              userbetsindexreport
            WHERE
              UserBetSynopsisID = nUserBetSynopsisID;

            INSERT
            INTO userbetsindexreport (CouponID, UserBetSynopsisID)
            VALUES (nCouponID, nUserBetSynopsisID);
          END IF;

        -- SET nSAgentProfitWin = 0;
        -- SET nMasterProfitWin = 0;

        -- Set @SAgentRemainder = nSAgentProfitWin - nSAgentProfitLose;

        -- IF nCanceled = 0 THEN

        -- INSERT INTO indexedtransreport (UserBetSynopsisID, SAgentID, MasterProfit, SAgentProfit, AgentProfit)
        -- VALUES (nUserBetSynopsisID, nSAgentID, -(nMasterProfitWin - nMasterProfitLose), -@SAgentRemainder, -nAgentProfit);

        -- UPDATE superagents SET Remainder = Remainder + @SAgentRemainder WHERE SAgentID = nSAgentID;
        -- UPDATE agents SET Remainder = Remainder + nAgentProfit WHERE AgentID = nAgentID;

        -- END IF;


        ELSE
          -- Recompute.
          -- Important : If you come here, then dont be sure that the Bet is defacto won, since we are making just editing
          -- If won then go straight to recompute
          -- else dont do anything since the lost is already inside the userbetsynopsis

          IF ( (nTotalStatus = (nClosedBets * 2)) OR (nTotalStatus = ((nUserBetsCount - (nSynopsisDP * 2)) * 2 + (nSynopsisDP * 5)))) AND (@nTotalLose=0) THEN
            -- Now we are sure that the Bet won


            -- default is won
            SET @NewStatus = 2;
            SET @CancelBet = 0;

            -- if there is at least 1 canceled event, then recompute the nPossible Profit
            IF (nTotalCanceled > 0) OR (nSynopsisDP > 0) THEN

              -- this all (exp(sum(log(coalesce(BetFactor,1))))*BetMoney) is just a multiplication BetFactor*BetMoney
              SELECT
                (EXP(SUM(log(COALESCE(BetFactor, 1)))) * BetMoney)
              INTO
                nPossibleProfit
              FROM
                userbets, userbetsmoney
              WHERE
                userbets.UserBetSynopsisID = nUserBetSynopsisID AND userbetsmoney.UserBetSynopsisID = nUserBetSynopsisID AND EventCanceled = 0 AND userbets.Status = 2
              GROUP BY
                userbets.UserBetSynopsisID;

              IF nPossibleProfit <= 0 THEN
                SET nPossibleProfit = nCost;
              END IF;

              IF (nSynopsisDP > 0) THEN
                SET nPossibleProfit = nPossibleProfit / POWER(2, (nSynopsisDP - @nDP_Canceled));
              END IF;



              IF (nPossibleProfit > (nCost * 1000)) THEN
                SET nPossibleProfit = nCost * 1000;
              END IF;

              IF (nPossibleProfit > nMAXProfit) THEN
                SET nPossibleProfit = nMAXProfit;
              END IF;

              -- if all matches of the bet are canceled then status is Canceled
              IF nTotalCanceled = nClosedBets THEN
                SET @NewStatus = 5; -- invalid status

                -- return the betmoney back to agent since we are even and make it canceled so
                -- it will not take part in the total remainer
                UPDATE
                  agents
                SET
                  Remainder = Remainder + nCost
                WHERE
                  AgentID = nAgentID;
                SET @CancelBet = 1;

              END IF;
            END IF;

            -- if not all the events are canceled come here
            IF @CancelBet = 0 THEN

              SELECT
                Commission_tziros, Commission_pososto
              INTO
                nCommission_tziros, nCommission_pososto
              FROM
                superagents
              WHERE
                SAgentID = nSAgentID;

              IF (nCommission_tziros = 0) THEN


                SET nKerdosZimia = (nCost - nPossibleProfit - nAgentProfit);
                SET nKerdosZimia = ABS(nKerdosZimia);
                SET nSAgentProfitLose = nKerdosZimia * (nCommission_pososto / 100.0000);
                SET nMasterProfitLose = nKerdosZimia - nSAgentProfitLose;
				
				-- Now a paradox case. If DP>0 then the user is possible to win BUT with less money of that he paid
				-- In this case Master and SAgent is really won. So, force them to win instead to lose.
				IF (nPossibleProfit < nCost) THEN
				
					SET nSAgentProfitWin = nSAgentProfitLose; 
					SET nMasterProfitWin = nMasterProfitLose;
					SET nSAgentProfitLose = 0;
					SET nMasterProfitLose = 0;
					
				ELSE
					
					SET nSAgentProfitWin = 0;
					SET nMasterProfitWin = 0;				
				
				END IF;
				



              ELSE

                SET nSAgentProfitWin = nCost * (nCommission_tziros / 100.0000);
                SET nSAgentProfitLose = 0;
                SET nMasterProfitWin = 0;
                SET nMasterProfitLose = ABS(nCost - nPossibleProfit - nAgentProfit - nSAgentProfitWin);


              END IF;





              UPDATE
                userbetssynopsis
              SET
                STATUS = @NewStatus, SAgentProfitWin = nSAgentProfitWin, MasterProfitWin = nMasterProfitWin, FinalUserProfit = nPossibleProfit, Payment = 1, Dirty = 1, SAgentProfitLose = nSAgentProfitLose, MasterProfitLose = nMasterProfitLose
              WHERE
                UserBetSynopsisID = nUserBetSynopsisID;

              -- update report
              IF (nSynopsisStatus <> @NewStatus) AND (nCanceled = 0) THEN
                DELETE
                FROM
                  userbetsindexreport
                WHERE
                  UserBetSynopsisID = nUserBetSynopsisID;

                INSERT
                INTO userbetsindexreport (CouponID, UserBetSynopsisID)
                VALUES (nCouponID, nUserBetSynopsisID);
              END IF;


            ELSE

              -- (the bet is invalid) if all events are canceled come here
              UPDATE
                userbetssynopsis
              SET
                STATUS = @NewStatus, SAgentProfitWin = 0, MasterProfitWin = 0, FinalUserProfit = nCost, Payment = 1, Dirty = 1, SAgentProfitLose = 0, MasterProfitLose = 0
              WHERE
                UserBetSynopsisID = nUserBetSynopsisID;


            END IF;

          ELSE

            -- maybe the current match is won, but since we are in editing mode the total bet is lost
            SELECT
              Commission_tziros, Commission_pososto
            INTO
              nCommission_tziros, nCommission_pososto
            FROM
              superagents
            WHERE
              SAgentID = nSAgentID;




            IF (nCommission_tziros = 0) THEN

              SET nKerdosZimia = (nCost - nAgentProfit);
              SET nSAgentProfitWin = nKerdosZimia * (nCommission_pososto / 100.0000);
              SET nMasterProfitWin = nKerdosZimia - nSAgentProfitWin;

              SET nSAgentProfitLose = 0;
              SET nMasterProfitLose = 0;

            ELSE

              SET nSAgentProfitWin = nCost * (nCommission_tziros / 100.0000);
              SET nSAgentProfitLose = 0;

              SET nMasterProfitWin = ABS(nCost - nSAgentProfitWin - nAgentProfit);
              SET nMasterProfitLose = 0;

            END IF;


            UPDATE
              userbetssynopsis
            SET
              STATUS = 3, SAgentProfitLose = 0, MasterProfitLose = 0, FinalUserProfit = 0, Payment = 1, Dirty = 1, SAgentProfitWin = nSAgentProfitWin, MasterProfitWin = nMasterProfitWin
            WHERE
              UserBetSynopsisID = nUserBetSynopsisID;

            -- update report
            IF (nSynopsisStatus <> 3) AND (nCanceled = 0) THEN

              DELETE
              FROM
                userbetsindexreport
              WHERE
                UserBetSynopsisID = nUserBetSynopsisID;

              INSERT
              INTO userbetsindexreport (CouponID, UserBetSynopsisID)
              VALUES (nCouponID, nUserBetSynopsisID);
            END IF;


          END IF;






        -- Set @SAgentRemainder = nSAgentProfitWin - nSAgentProfitLose;

        -- IF nCanceled = 0 THEN

        -- INSERT INTO indexedtransreport (UserBetSynopsisID, SAgentID, MasterProfit, SAgentProfit, AgentProfit)
        -- VALUES ( nUserBetSynopsisID, nSAgentID, -(nMasterProfitWin - nMasterProfitLose), -@SAgentRemainder, -nAgentProfit);

        -- UPDATE superagents SET Remainder = Remainder + @SAgentRemainder WHERE SAgentID = nSAgentID;
        -- UPDATE agents SET Remainder = Remainder + nAgentProfit WHERE AgentID = nAgentID;

        -- END IF;

        END IF;


      ELSE -- IF nClosedBets = nUserBetsCount THEN


        UPDATE
          userbetssynopsis
        SET
          STATUS = 0
        WHERE
          UserBetSynopsisID = nUserBetSynopsisID;


      END IF; -- IF nClosedBets = nUserBetsCount THEN

    -- **************************************************************************************************************************
    -- SYSTEM SYSTEM SYSTEM
    -- If status = lost and bettype is system then update the corresponding recornd inside userbetssystems
    -- **************************************************************************************************************************
    ELSEIF (nBetType = 2) THEN

      IF (nBetStatus <> nStatus) THEN
        -- Status default value is won. So, if lose the mark it.
        IF nStatus = 3 THEN
          UPDATE
            userbetssystems
          SET
            STATUS = nStatus, Loses = Loses + 1
          WHERE
            Events LIKE CONCAT('%', nCouponID, '%') AND UserBetSynopsisID = nUserBetSynopsisID;
        ELSE
          -- dont decrease any value is the bet is still open. That is wrong
          IF (nBetStatus <> 0) THEN
            UPDATE
              userbetssystems
            SET
              STATUS = IF(Loses = 1, 2, 3), Loses = Loses - 1
            WHERE
              Loses > 0 AND Events LIKE CONCAT('%', nCouponID, '%') AND UserBetSynopsisID = nUserBetSynopsisID;
          END IF;

        END IF;

      END IF;

      -- ask if all userbets are closed.
      SELECT
        COUNT(UserBetID), SUM(Status), SUM(EventCanceled), SUM(CASE WHEN Status = 3 THEN 1 ELSE 0 END)
      INTO
        nClosedBets, nTotalStatus, nTotalCanceled, @nTotalLose
      FROM
        userbets
      WHERE
        Status > 0 AND UserBetSynopsisID = nUserBetSynopsisID;

      -- ask for the wining combinations in the system
      -- dont forget that the default status value of the table UserBets is 2
      SET nClosedSystemBets = 0;

      SELECT
        COUNT(UserBetSystemID)
      INTO
        nClosedSystemBets
      FROM
        userbetssystems
      WHERE
        status = 2 AND UserBetSynopsisID = nUserBetSynopsisID;




      -- if yes then close the bet and characterize it
      IF (nClosedBets = nUserBetsCount) OR (nClosedSystemBets = 0) THEN

        -- ask min system
        SELECT
          MIN(system)
        INTO
          @minsystem
        FROM
          userbetssystems
        WHERE
          userbetsynopsisID = nUserBetSynopsisID
        GROUP BY
          userbetsynopsisID;


        SET @CancelBet = 0;
        SET @CanceledByFlag = 0;


        IF (nTotalCanceled = nClosedBets) THEN
          SET @NewStatus = 5;

          -- return the betmoney back to agent since we are even and make it canceled so
          -- it will not take part in the total remainer
          UPDATE
            agents
          SET
            Remainder = Remainder + nCost
          WHERE
            AgentID = nAgentID;
          SET @CancelBet = 1;

        END IF;


        IF @CancelBet = 0 THEN

          -- ask for the wining combinations in the system
          -- we moved the original wining combinations above just to capture if all bets are already lost
          -- SELECT COUNT(UserBetSystemID) INTO nClosedSystemBets FROM userbetssystems WHERE status = 2 AND UserBetSynopsisID = nUserBetSynopsisID;



          -- if the user lost all the matches then is totally lost
          -- pDirty = Recomputations, so any recomputed value is invalid. Start from scratch
          IF nClosedSystemBets = 0 AND nDirty = 0 THEN

            UPDATE
              userbetssynopsis
            SET
              STATUS = 3, SAgentProfitLose = 0, MasterProfitLose = 0, FinalUserProfit = 0, Payment = 0, Dirty = 1
            WHERE
              UserBetSynopsisID = nUserBetSynopsisID;

            -- update report
            IF (nSynopsisStatus <> 3) AND (nCanceled = 0) THEN
              INSERT
              INTO userbetsindexreport (CouponID, UserBetSynopsisID)
              VALUES (nCouponID, nUserBetSynopsisID);
            END IF;

          -- SET nSAgentProfitLose = 0;
          -- SET nMasterProfitLose = 0;

          -- Set @SAgentRemainder = nSAgentProfitWin - nSAgentProfitLose;

          -- IF nCanceled = 0 THEN

          -- INSERT INTO indexedtransreport (UserBetSynopsisID, SAgentID, MasterProfit, SAgentProfit, AgentProfit)
          -- VALUES (nUserBetSynopsisID, nSAgentID, -(nMasterProfitWin - nMasterProfitLose), -@SAgentRemainder, -nAgentProfit);

          -- UPDATE superagents SET Remainder = Remainder + @SAgentRemainder WHERE SAgentID = nSAgentID;
          -- UPDATE agents SET Remainder = Remainder + nAgentProfit WHERE AgentID = nAgentID;

          -- END IF;

          ELSE
            -- this is absolute nesseary, because for a mysterious reason the IFNULL does not return the exptected 0
            SET nClosedSystemBetsUserWon = 0;


            -- if the user partially won or he won all the matches or pDity=1 (recompute) then come here        
            -- this sql query computes the user profits from the systems that he won.
            SELECT
              IFNULL(SUM(userbetssystems.Odds * BetMoney), 0)
            INTO
              nClosedSystemBetsUserWon
            FROM
              userbetssystems, userbetsmoney
            WHERE
              userbetssystems.System = userbetsmoney.System
              AND userbetssystems.UserBetSynopsisID = userbetsmoney.UserBetSynopsisID
              AND userbetssystems.Status = 2
              AND userbetssystems.UserBetSynopsisID = nUserBetSynopsisID
            GROUP BY
              userbetssystems.UserBetSynopsisID;

            SET nStatus = 2;
            IF nClosedSystemBetsUserWon <= 0 THEN
              SET nClosedSystemBetsUserWon = 0;
              SET nStatus = 3;
            END IF;


            SELECT
              Commission_tziros, Commission_pososto
            INTO
              nCommission_tziros, nCommission_pososto
            FROM
              superagents
            WHERE
              SAgentID = nSAgentID;

            IF (nCommission_tziros = 0) THEN

              SET nKerdosZimia = (nCost - nClosedSystemBetsUserWon - nAgentProfit);


              IF (nKerdosZimia < 0) THEN
                SET nKerdosZimia = ABS(nKerdosZimia);
                SET nSAgentProfitWin = 0;
                SET nSAgentProfitLose = nKerdosZimia * (nCommission_pososto / 100.0000);
                SET nMasterProfitWin = 0;
                SET nMasterProfitLose = nKerdosZimia - nSAgentProfitLose;

              ELSE

                SET nSAgentProfitWin = nKerdosZimia * (nCommission_pososto / 100.0000);
                SET nSAgentProfitLose = 0;
                SET nMasterProfitWin = nKerdosZimia - nSAgentProfitWin;
                SET nMasterProfitLose = 0;


              END IF;

            ELSE

              SET nKerdosZimia = (nCost - nClosedSystemBetsUserWon - nAgentProfit);
              SET nSAgentProfitWin = nCost * (nCommission_tziros / 100.0000);
              SET nSAgentProfitLose = 0;

              IF (nKerdosZimia < 0) THEN

                SET nKerdosZimia = ABS(nKerdosZimia);
                SET nMasterProfitWin = 0;
                SET nMasterProfitLose = nKerdosZimia - nSAgentProfitWin;

              ELSE

                SET nMasterProfitWin = nKerdosZimia - nSAgentProfitWin;
                SET nMasterProfitLose = 0;


              END IF;


            END IF;
			
            IF (nClosedSystemBetsUserWon > (nCost * 1000)) THEN
              SET nClosedSystemBetsUserWon = nCost * 1000;
            END IF;			

            IF (nClosedSystemBetsUserWon > nPossibleProfit) THEN
              SET nClosedSystemBetsUserWon = nPossibleProfit;
            END IF;


            UPDATE
              userbetssynopsis
            SET
              STATUS = nStatus, SAgentProfitLose = nSAgentProfitLose, MasterProfitLose = nMasterProfitLose, SAgentProfitWin = nSAgentProfitWin, MasterProfitWin = nMasterProfitWin, FinalUserProfit = nClosedSystemBetsUserWon, Payment = 1, Dirty = 1
            WHERE
              UserBetSynopsisID = nUserBetSynopsisID;

            -- update report
            IF (nSynopsisStatus <> nStatus) AND (nCanceled = 0) THEN
              INSERT
              INTO userbetsindexreport (CouponID, UserBetSynopsisID)
              VALUES (nCouponID, nUserBetSynopsisID);
            END IF;


          -- Set @SAgentRemainder = nSAgentProfitWin - nSAgentProfitLose;

          -- IF nCanceled = 0 THEN

          -- INSERT INTO indexedtransreport (UserBetSynopsisID, SAgentID, MasterProfit, SAgentProfit, AgentProfit)
          -- VALUES (nUserBetSynopsisID, nSAgentID, -(nMasterProfitWin - nMasterProfitLose), -@SAgentRemainder, -nAgentProfit);

          -- UPDATE superagents SET Remainder = Remainder + @SAgentRemainder WHERE SAgentID = nSAgentID;
          -- UPDATE agents SET Remainder = Remainder + nAgentProfit WHERE AgentID = nAgentID;

          -- END IF;



          END IF;


        ELSE

          -- the bet is invalid
          UPDATE
            userbetssynopsis
          SET
            STATUS = 5, SAgentProfitLose = 0, MasterProfitLose = 0, SAgentProfitWin = 0, MasterProfitWin = 0, FinalUserProfit = nCost, Payment = 1, Dirty = 1
          WHERE
            UserBetSynopsisID = nUserBetSynopsisID;


        END IF; -- if all bets are canceled

      ELSE -- if all bet in system are closed 

        UPDATE
          userbetssynopsis
        SET
          STATUS = 0, Payment = 0
        WHERE
          UserBetSynopsisID = nUserBetSynopsisID;

      END IF; -- if all bet in system are closed 


    END IF; -- if bet=2=system






  END LOOP find_bets_with_same_CouponID;


  CLOSE userbets_cursor;


  DEALLOCATE PREPARE update_userbets;
  DEALLOCATE PREPARE select_indexedtransreport;

  SET done = 0;


END