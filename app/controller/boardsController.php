<?php
class boardsController
{
    public function create()
    {
        render("layout", "head");
        render("layout", "navbar");
        $boardname = null;
        if (isset($_GET["boardname"])) {
            $boardname = $_GET["boardname"];
        }
        render("boards", "create", $boardname);
        render("layout", "footer");
    }

    public function create_board()
    {
        $board = new boards();
        $membership = new membership();
        isset($_POST['color-picker']) ? $board->set_hex_color($_POST['color-picker']) : $board->set_hex_color("#0275d8");
        isset($_POST['public']) ? $board->set_public(1) : $board->set_public(0);
        $board->set_board_name($_POST['name']);

        $boardsModel = new boardsModel();
        $membershipModel = new membershipModel();

        $id = $boardsModel->insert_new_board($board);
        $userid = $_SESSION['userid'];

        $membership->set_user_id($userid);
        $membership->set_board_id($id);

        $membershipModel->insert_membership($membership);

        $defaultStates = array("To Do", "In Progress", "Done");

        foreach ($defaultStates as $key => $state) {
            $key = $key + 1;
            $boardsModel->insert_new_state($state, $id, $key);
        }
        header("Location: /boards/index/$id");
    }
    public function insert_new_state()
    {
        $state = $_POST['state_name'];
        $id = $_POST['board_id'];
        $boardsModel = new boardsModel();

        $boardsModel->insert_new_state($state, $id);

    }
    public function remove_state()
    {
        $stateid = $_POST['state_id'];

        $boardsModel = new boardsModel();

        $r = $boardsModel->check_references($stateid);

        if (empty($r)) {
            $boardsModel->remove_state($stateid);
        } else {
            die(header('HTTP/1.0 400 Bad error'));
        }

    }
    public function markBoardAsDeleted()
    {

        $boardid = $_POST['board_id'];

        $boardsModel = new boardsModel();

        $r = $boardsModel->mark_board_deleted($boardid);

    }
    public function index($id)
    {
        render("layout", "head");
        render("layout", "navbar");

        $board_id = $id;
        $boardsModel = new boardsModel();
        $boardList = $boardsModel->select_board_card_state($board_id);
        $output_array = array($boardList[0]["board_name"], $boardList[0]["board_id"]);

        foreach ($boardList as $boardrow) {
            // Building Array - https://stackoverflow.com/questions/21272803/php-foreach-loop-with-grouped-items

            $output_array[$boardrow["state_name"] . "//" . $boardrow["state_id"]][] = $boardrow;
        }

        render("boards", "index", $output_array);
        render("layout", "footer");

    }

    public function usersBoards()
    {
        $userid = $_SESSION['userid'];
        $boardsModel = new boardsModel();
        $boardList = $boardsModel->select_boards_by_user($userid);
        array_unshift($boardList, "Your Boards");
        render("boards", "boardsContent", $boardList);
    }
    public function publicBoards()
    {
        $boardsModel = new boardsModel();
        $boardList = $boardsModel->select_public_boards();
        array_unshift($boardList, "Public Boards");
        render("boards", "boardsContent", $boardList);
    }

    public function updateCardState()
    {
        $card = new cards();
        $cardid = $_POST["card_id"];
        $stateid = $_POST["state_id"];
        $card->set_card_id($cardid);
        $card->set_state_id($stateid);
        $boardsModel = new boardsModel();
        $boardList = $boardsModel->update_card_state($card);
        return $boardList;
    }

    public function markCardAsDeleted()
    {
        $cardid = $_POST["card_id"];

        $boardsModel = new boardsModel();
        $boardList = $boardsModel->mark_card_deleted($cardid);
        return $boardList;
    }

    public function create_Card()
    {
        $stateid = $_POST["stateId"];
        $cardname = $_POST["cardName"];

        $boardsModel = new boardsModel;
        $id = $boardsModel->insert_new_card($stateid, $cardname);

    }
    public function updateStatePosition()
    {
        $stateid = $_POST["stateId"];
        $boardid = $_POST["boardId"];
        $position = $_POST["position"];

        $boardsModel = new boardsModel;
        $id = $boardsModel->get_surrounding_state($boardid, $stateid, $position);
    }
    public function search()
    {

        $board_name = $_POST['board_name'];
        $public = 0;
        if (isset($_POST['public'])) {
            $public = 1;
        }
        $userid = $_SESSION["userid"];
        $boardsModel = new boardsModel();
        $boardList = $boardsModel->select_boards_search($board_name, $public, $userid);
        $boardsController = new boardsController();
        render("layout", "head");
        render("layout", "navbar");
        render("boards", "boardsTopWrapper");
        array_unshift($boardList, "Search Results");
        render("boards", "boardsContent", $boardList);
        render("boards", "boardsBottomWrapper");
        render("layout", "footer");
    }
}
