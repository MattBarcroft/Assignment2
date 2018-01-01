<?php
echo "<div class='board-header'>";
echo "<h1>" . $data[0] . "</h1>";
echo "</div>";
echo "<div class='flex-container'>";
if(count($data) == 1){
    echo "<h3>...No Results Found</h3>";
}
foreach (array_slice($data, 1) as $key => $value) {
    echo "<div style='
        background: linear-gradient(to bottom right, " . $value['hex_color'] . " ," . $value['hex_color'] . ")'  data-board-id='" . $value['board_id'] . "' data-href='/boards/index/" . $value['board_id'] . "' class='home-board-link board'>";
    echo "<div class='div-state-header'>";
    if ($data[0] === "Your Boards") {
        echo "<a class='remove-board' data-board-id='" . $value['board_id'] . "'>";
        echo "<i class='fa fa-minus-circle fa-small fa-float-right'></i>";
        echo "</a>";
    }
    echo "<div class='div-state-title'>";
    echo "<h4>" . $value["board_name"] . "</h4>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</a>";
}
echo "</div>";

?>

