<?php

echo "<h1>" . $data[0] . "</h1>";
echo "<div class='flex-container'>";
if(count($data) == 1){
    echo "<h3>...No Results Found</h3>";
}
foreach (array_slice($data, 1) as $key => $value) {
    echo "<div style='
        background: linear-gradient(to bottom right, " . $value['hex_color'] . " ," . $value['hex_color'] . ")'  data-board-id='" . $value['board_id'] . "' data-href='/boards/index/" . $value['board_id'] . "' class='home-board-link board'>";
    if ($data[0] === "Your Boards") {
        echo "<a class='remove-board' data-board-id='" . $value['board_id'] . "'>";
        echo "<i class='fa fa-minus-circle fa-small fa-float-right'></i>";
        echo "</a>";
    }
    echo "<h1>" . $value["board_name"] . "</h1>";
    echo "</div>";
    echo "</a>";
}
echo "</div>";

?>
<script>
$( function() {
    $('.home-board-link').click(function (){
        // https://stackoverflow.com/questions/17862228/button-onclick-inside-whole-clickable-div
        event.cancelBubble = true;
        if(event.stopPropagation) event.stopPropagation();
        href = $(this).attr('data-href');
        window.location.href = href;
        window.location = $(this).data("/boards/index/"+boardid);
    });
    $('.remove-board').unbind('click').click(function(){
        event.cancelBubble = true;
        if(event.stopPropagation) event.stopPropagation();
        board_id = $(this).attr('data-board-id');
        $.ajax({
            type: "POST",
            url: "/boards/markBoardAsDeleted",
            data:
            {
                board_id: board_id
            },
            error: function(xhr, status, error) {
                alert(error);
                console.error(xhr.responseText);

            }
        });
        location.reload();
    });
});
    </script>
