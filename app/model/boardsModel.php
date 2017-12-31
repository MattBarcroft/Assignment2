<?php
class boardsModel
{
    //boards
    public function select_boards_by_user($user_id)
    {
        $pdo = get_db();

        $r = $pdo->prepare("
            SELECT
            boards.board_id,
            boards.board_name,
            boards.hex_color,
            boards.board_created,
            boards.board_last_modified FROM Boards
            JOIN Membership
            ON boards.board_id = membership.board_id
            WHERE membership.user_id = :user_id
            AND boards.deleted != 1;
        ");

        $r->execute(array(':user_id' => $user_id));
        $r = $r->fetchAll();
        return $r;
    }
    public function select_deleted_boards()
    {
        $pdo = get_db();

        $r = $pdo->prepare("
            SELECT
            board_id,
            board_name,
            hex_color,
            board_created,
            board_last_modified 
            FROM Boards
            WHERE deleted = 1;
        ");

        $r->execute(array());
        $r = $r->fetchAll();
        return $r;
    }
    public function select_public_boards()
    {
        $pdo = get_db();

        $r = $pdo->prepare("
            SELECT
            boards.board_id,
            boards.board_name,
            boards.board_created,
            boards.hex_color,
            boards.board_last_modified FROM Boards
            WHERE boards.public = 1
            AND boards.deleted != 1;
        ");

        $r->execute();
        $r = $r->fetchAll();
        return $r;
    }
    public function select_all_boards()
    {
        $pdo = get_db();

        $r = $pdo->prepare("
            SELECT
            boards.board_id,
            boards.board_name,
            boards.board_created,
            boards.hex_color,
            boards.board_last_modified FROM Boards
        ");

        $r->execute();
        $r = $r->fetchAll();
        return $r;
    }

    public function insert_new_board($board)
    {
        $pdo = get_db();

        $r = $pdo->prepare("
            INSERT INTO Boards (`board_name`, `public`, `hex_color`) VALUES (:board_name, :public, :hex_color);
        ");

        $r->execute(array(
            ':board_name' => $board->get_board_name(),
            ':public' => $board->get_public(),
            ':hex_color' => $board->get_hex_color(),
        ));

        $r = $pdo->lastInsertId();

        return $r;
    }
    public function mark_card_deleted($card_id)
    {
        $pdo = get_db();

        $r = $pdo->prepare("
            UPDATE `Cards` SET `deleted`='1' WHERE `card_id`=:card_id;
        ");

        try {
            $r->execute(array(
                ':card_id' => $card_id,
            ));
            $rowCount = $r->rowCount();
            return $rowCount;
        } catch (Exception $e) {
            error_log("make card deleted failed", 0);
            echo 'Updated failed!';
        }
    }
    public function mark_board_deleted($board_id)
    {
        $pdo = get_db();

        $r = $pdo->prepare("
            UPDATE `Boards` SET `deleted`='1' WHERE `board_id`=:board_id;
        ");

        try {
            $r->execute(array(
                ':board_id' => $board_id,
            ));
            $rowCount = $r->rowCount();
            return $rowCount;
        } catch (Exception $e) {
            error_log("mark board deleted failed", 0);
            echo 'Updated failed!';
        }

        return $r;
    }
    public function mark_board_undeleted($board_id)
    {
        $pdo = get_db();

        $r = $pdo->prepare("
            UPDATE `Boards` SET `deleted`='0' WHERE `board_id`=:board_id;
        ");

        try {
            $r->execute(array(
                ':board_id' => $board_id,
            ));
            $rowCount = $r->rowCount();
            return $rowCount;
        } catch (Exception $e) {
            error_log("mark board undeleted failed", 0);
            echo 'Updated failed!';
        }

        return $r;
    }
    public function select_board_card_state($board_id)
    {
        $pdo = get_db();

        $r = $pdo->prepare("
            SELECT
            Boards.board_name,
            Boards.board_id,
            Boards.board_created,
            Boards.board_last_modified,
            boards.hex_color,
            Boards.deleted,
            Boards.public,
            States.state_id,
            States.state_name,
            States.deleted,
            States.state_created,
            States.state_last_modified,
            Cards.card_id,
            Cards.card_name,
            Cards.deleted,
            Cards.card_created,
            Cards.card_last_modified
            FROM Boards
            LEFT JOIN States
            ON States.board_id = Boards.board_id
            LEFT JOIN Cards
            ON Cards.state_id = States.state_id
            AND Cards.deleted != 1
            WHERE Boards.board_id = :board_id
            AND States.deleted != 1
            ORDER BY States.position asc, States.state_id;
        ");

        $r->execute(array(
            ':board_id' => $board_id,
        ));

        $r = $r->fetchAll(PDO::FETCH_ASSOC);

        return $r;
    }
    public function select_board($board_id)
    {
        $pdo = get_db();

        $r = $pdo->prepare("
            SELECT * FROM Boards WHERE  board_id = :board_id;
        ");

        $r->execute(array(
            ':board_id' => $board_id,
        ));

        $r = $r->fetchAll(PDO::FETCH_ASSOC);

        return $r;
    }
    public function update_board($board_id, $board_name, $hex_color = null, $deleted = null, $public = null)
    {
        //https://stackoverflow.com/questions/16865747/pdo-prepared-statement-with-optional-parameters
        $pdo = get_db();

        $pdoParamsArray = array();
        $pdoParamsArray[':board_id'] = $board_id;

        $sql = "UPDATE Boards SET ";

        if ($board_name !== null) {
            $sql = $sql . " board_name = :board_name,";
            $pdoParamsArray[':board_name'] = $board_name;
        }
        if ($hex_color !== null) {
            $sql = $sql . " hex_color = :hex_color,";
            $pdoParamsArray[':hex_color'] = $hex_color;
        }
        if ($deleted !== null) {
            $sql = $sql . " deleted = :deleted,";
            $pdoParamsArray[':deleted'] = $deleted;
        }
        if ($public !== null) {
            $sql = $sql . " public = :public,";
            $pdoParamsArray[':public'] = $public;
        }
        $sql = substr($sql, 0, -1);
        $sql = $sql . " WHERE board_id = :board_id;";

        $r = $pdo->prepare("$sql");
        try {
            $r->execute($pdoParamsArray);

            $rowCount = $r->rowCount();
            return $rowCount;
        } catch (Exception $e) {
            error_log("updated board failed", 0);
            $r = 'Connection failed: ' . $e->getMessage();
            return false;
        }
    }
    //cards
    public function select_cards_for_board($board_id)
    {
        $pdo = get_db();

        $r = $pdo->prepare("
            SELECT board_name, board_created, board_last_modified, deleted, public FROM Boards
            WHERE board_id = :board_id;
        ");

        $r->execute(array(
            ':board_id' => $board_id,
        ));

        $r = $r->fetchAll();
        return $r;
    }
    public function insert_new_card($stateid, $cardname)
    {
        $pdo = get_db();

        $r = $pdo->prepare("
            INSERT INTO `Cards` (`state_id`, `card_name`) VALUES (:state_id, :board_id);

        ");

        $r->execute(array(
            ':state_id' => $stateid,
            ':board_id' => $cardname,
        ));

        $r = $pdo->lastInsertId();

        return $r;

    }
    public function check_references($stateid)
    {
        $pdo = get_db();

        $r = $pdo->prepare("
            SELECT card_name FROM Cards WHERE state_id = :state_id AND deleted != 1
        ");

        $r->execute(array(
            ':state_id' => $stateid,
        ));
        $r = $r->fetchAll();

        return $r;

    }
    public function update_card($card_id, $card_name, $deleted = null)
    {
        //https://stackoverflow.com/questions/16865747/pdo-prepared-statement-with-optional-parameters
        $pdo = get_db();

        $pdoParamsArray = array();
        $pdoParamsArray[':card_id'] = $card_id;

        $sql = "UPDATE Cards SET ";

        if ($card_name !== null) {
            $sql = $sql . " card_name = :card_name,";
            $pdoParamsArray[':card_name'] = $card_name;
        }
        if ($deleted !== null) {
            $sql = $sql . " deleted = :deleted,";
            $pdoParamsArray[':deleted'] = $deleted;
        }

        $sql = substr($sql, 0, -1);
        $sql = $sql . " WHERE card_id = :card_id;";

        $r = $pdo->prepare("$sql");
        try {
            $r->execute($pdoParamsArray);

            $rowCount = $r->rowCount();
            return $rowCount;
        } catch (Exception $e) {
            error_log("updated card failed", 0);
            $r = 'Connection failed: ' . $e->getMessage();
            return false;
        }
    }

    //states
    public function insert_new_state($state_name, $board_id, $position = 0)
    {
        $pdo = get_db();

        $position = $this->get_next_position($board_id);
        var_dump($position);

        $r = $pdo->prepare("
            INSERT INTO `States` (`state_name`, `board_id`, `position`) VALUES (:state_name, :board_id, :position);
        ");
        try {
            $r->execute(array(
                ':state_name' => $state_name,
                ':board_id' => $board_id,
                ':position' => $position
            ));

            $r = $pdo->lastInsertId();
            return $r;
        } catch (Exception $e) {
            error_log("insert new state failed", 0);
            $r = 'Connection failed: ' . $e->getMessage();
            return false;
        }
        return $r;
    }
    public function select_boards_search($board_name, $public, $user_id)
    {
        $pdo = get_db();

        $r = $pdo->prepare("
            SELECT
            boards.board_id,
            boards.board_name,
            boards.board_created,
            boards.hex_color,
            boards.board_last_modified FROM Boards
            JOIN Membership
            ON Membership.board_id = boards.board_id
            WHERE boards.public = :public 
            AND board_name LIKE CONCAT('%', :board_name, '%')
            AND Membership.user_id = :user_id
            AND boards.deleted != 1;
        ");

        $r->execute(array(
            ':public' => $public,
            ':board_name' => $board_name,
            ':user_id' => $user_id
        ));
        $r = $r->fetchAll();
        return $r;
    }

    public function update_state($state_id, $state_name = null, $deleted = null)
    {
        //https://stackoverflow.com/questions/16865747/pdo-prepared-statement-with-optional-parameters
        $pdo = get_db();

        $pdoParamsArray = array();
        $pdoParamsArray[':state_id'] = $state_id;

        $sql = "UPDATE States SET ";

        if ($state_name !== null) {
            $sql = $sql . " state_name = :state_name,";
            $pdoParamsArray[':state_name'] = $state_name;
        }
        if ($deleted !== null) {
            $sql = $sql . " deleted = :deleted,";
            $pdoParamsArray[':deleted'] = $deleted;
        }

        $sql = substr($sql, 0, -1);
        $sql = $sql . " WHERE state_id = :state_id;";

        $r = $pdo->prepare("$sql");
        try {
            $r->execute($pdoParamsArray);

            $rowCount = $r->rowCount();
            return $rowCount;
        } catch (Exception $e) {
            error_log("update state failed", 0);
            $r = 'Connection failed: ' . $e->getMessage();
            return false;
        }
    }
    public function select_states_for_board($board_id)
    {
        $pdo = get_db();

        $r = $pdo->prepare("
            SELECT * FROM myKanban.States where board_id = :board_id
        ");

        $r->execute(array(
            ':board_id' => $board_id
        ));

        $r = $r->fetchAll();
        return $r;
    }
    public function select_single_state($state_id)
    {
        $pdo = get_db();

        $r = $pdo->prepare("
            SELECT * FROM myKanban.States where state_id = :state_id
        ");

        $r->execute(array(
            ':state_id' => $state_id
        ));

        $r = $r->fetchAll();
        return $r;
    }
    public function select_all_states()
    {
        $pdo = get_db();

        $r = $pdo->prepare("
            SELECT * FROM myKanban.States
        ");

        $r->execute(array(
            ':state_id' => $state_id,
        ));

        $r = $r->fetchAll();
        return $r;
    }
    public function get_next_position($board_id)
    {
        $pdo = get_db();

        $r = $pdo->prepare("
            SELECT max(position) AS maxPos FROM myKanban.States where board_id = :board_id
        ");

        $r->execute(array(
            ':board_id' => $board_id,
        ));

        $r = $r->fetch();
        $nextPos = $r['maxPos'] + 1;

        return $nextPos;
    }
    public function update_card_state($card)
    {
        $pdo = get_db();

        $r = $pdo->prepare("
        UPDATE Cards SET state_id = :state_id where card_id = :card_id;
        ");
        try {
            $r->execute(array(
                ':state_id' => $card->get_state_id(),
                ':card_id' => $card->get_card_id(),
            ));
            return true;
        } catch (PDOException $e) {
            error_log("update card state failed", 0);
            $r = 'Connection failed: ' . $e->getMessage();
            return false;
        }
    }

    public function remove_state($state_id)
    {
        $pdo = get_db();

        $r = $pdo->prepare("
        UPDATE States SET deleted = 1 where state_id = :state_id;
        ");
        try {
            $r->execute(array(
                ':state_id' => $state_id,
            ));
            $rowCount = $r->rowCount();
            return $rowCount;
        } catch (Exception $e) {
            echo 'Updated failed!';
        }
    }

    public function update_state_position($stateId, $newPosition)
    {
        $pdo = get_db();

        $r = $pdo->prepare("
        UPDATE States SET position = :position where state_id = :state_id;
        ");
        try {
            $r->execute(array(
                ':state_id' => $stateId,
                ':position' => $newPosition,
            ));
            return true;
        } catch (PDOException $e) {
            error_log("update state position failed", 0);
            $r = 'Connection failed: ' . $e->getMessage();
            return false;
        }
    }

    public function position_adjustment($board_id, $state_id, $position)
    {
        $pdo = get_db();

        $r = $pdo->prepare("
        SELECT DISTINCT
        States.state_id,
        States.position
        FROM Boards
        LEFT JOIN States
        ON States.board_id = Boards.board_id
        LEFT JOIN Cards
        ON Cards.state_id = States.state_id
        AND Cards.deleted != 1
        WHERE Boards.board_id = :board_id
        AND States.deleted != 1
        ORDER BY States.position asc, States.state_id;
        ");

        $r->execute(array(
            ':board_id' => $board_id,
        ));
        $r = $r->fetchAll(PDO::FETCH_ASSOC);

        $statePositionInArray = array_search($state_id, array_column($r, 'state_id'));

        //statePositionInArray is position in array of clicked state
        $stateToSwapWith = 0;

        //position 1 means move right
        if ($position == 1) {
            $stateToSwapWith = $statePositionInArray + 1;
            echo (count($r));
            echo $stateToSwapWith;
            if ((count($r)) == $stateToSwapWith) {
                error_log("state position not updated", 0);
                die(header('HTTP/1.0 400 Bad error'));
                return;
            }
        } else {
            $stateToSwapWith = $statePositionInArray - 1;
            if ($stateToSwapWith < 0) {
                error_log("state position not updated", 0);
                die(header('HTTP/1.0 400 Bad error'));
                return;
            }
        }
        $positionInArray = $r[$statePositionInArray]['position'];

        $replacementStateId = $r[$stateToSwapWith]["state_id"];
        $replacementPosition = $r[$stateToSwapWith]["position"];

        // var_dump("replacement" . $replacementStateId . "   " . $replacementPosition);
        // var_dump("clicked" . $state_id. "   " .  $positionInArray);

        $this->update_state_position($state_id, $replacementPosition);
        $this->update_state_position($replacementStateId, $positionInArray);

    }
}
