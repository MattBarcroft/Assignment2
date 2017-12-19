<?php
    echo "<h1>" . $data[0] . "</h1>";
    echo "<div class='flex-container'>";
        foreach(array_slice($data,1)  as $key => $value){
        echo "<a  class='board' href='/boards/index/" . $value['board_id'] . "'>";
        echo "<div> ";
            echo "<h1>" . $value["board_name"] . "</h1>";
        echo "</div>";
        echo "</a>";
        }
    echo "</div>";

?>