
    <div class="container theme-showcase" role="main">

      <div class="jumbotron">

        <h2> <?php echo $data[0]; ?> </h2>
        <div class='top-bar'>
        <div class='input-div float-right'>
        <div class='input-group'>
        <input type='text' id='new-state-input' class='form-control' placeholder='New State...'>
        <span class='input-group-btn'>
        <button class='btn btn-secondary' id='btn-new-state' type='button'><i class='fa fa-plus fa-fw'></i></button>
        </span>
        </div>
        </div>
        </div>
        <div class='flex-container'>

        <?php
        foreach (array_slice($data, 2) as $key => $value) {
            $state = explode('//', $key, 2);
            echo "<div class='board' data-state-id='" . $state[1] . "'>";    
            echo "<div class='div-state-header'>";
            echo "<h3>" . $state[0] . "</h3>";
            echo "</div>"; 
            echo "<div class='div-state-move'>";
            echo "<div class='div-state-arrow'>";
            echo '<i class="fa fa-arrow-left" data-state-id="' . $state[1] . '"></i>';
            echo "</div>";
            echo "<div class='div-state-arrow'>";
            echo '<i class="fa fa-arrow-right" data-state-id="' . $state[1] . '"></i>';
            echo "</div>";
            echo "</div>";
            echo "<div class='div-remove-state'>";
            echo "<a class='remove-state' data-state-id=" . $state[1] . "><i class='fa fa-minus-circle fa-small fa-float-right'></i></a>";
            echo "</div>"; 
                foreach ($value as $row) {
                    if ($row["card_name"] != null){
                        echo "<div class='card draggable' data-card-id='" . $row["card_id"] . "'>";
                        echo "<h3>" . $row["card_name"] . "<a class='remove-card' data-card-id=" . $row["card_id"] . "><i class='fa fa-minus-circle fa-small fa-float-right'></i></a></h3>";
                       
                        echo "</div>";
                    }
                }
                echo "<div class='right-bottom-align'>";
                echo '<a data-state-id=' . $state[1] . ' class="btn btn-primary btn-add-card" data-toggle="modal" data-target="#card-create-modal"><i class="fa fa-plus fa-fw"></i></a>';
                echo "</div>";
            echo "</div>";
            next($data);
        }



        echo "</div>";
                   
        ?>
        <script>
        $( function() {
            let parent;
            let cardId;
            let boardId = /[^/]*$/.exec(window.location.pathname)[0];

            $( ".draggable" ).draggable({ 
                start: function(){
                    parent = $(this).parent().attr('class');
                    cardId = $(this).attr('data-card-id');
                    stateId = $(this).attr('data-state-id');
                }
                
            });

            $('.fa-arrow-left').click(function(){
                position = 0;
                stateId = $(this).attr('data-state-id');
                $.ajax({
                    type: "POST",
                    url: "/boards/updateStatePosition",
                    data: 
                    {
                        boardId: boardId,
                        stateId: stateId,
                        position: position
                    },
                    error: function(xhr, status, error) {
                        alert(error);
                        console.error(xhr.responseText);
                        
                    }
                });
                location.reload();
            });

            $('.fa-arrow-right').click(function(){
                position = 1;
                stateId = $(this).attr('data-state-id');
                $.ajax({
                    type: "POST",
                    url: "/boards/updateStatePosition",
                    data: 
                    {
                        boardId: boardId,
                        stateId: stateId,
                        position: position
                    },
                    error: function(xhr, status, error) {
                        alert(error);
                        console.error(xhr.responseText);
                        
                    }
                });
                location.reload();
            });

            $('.board').droppable({
                drop: function(event,ui){
                $(ui.draggable).appendTo($(this)).removeAttr('style'); 
                var stateId = ui.draggable.parent().attr('data-state-id');
                var cardId = ui.draggable.attr('data-card-id');
                $.ajax({
                    type: "POST",
                    url: "/boards/updateCardState",
                    data: 
                    {
                        card_id: cardId,
                        state_id: stateId
                    },
                    error: function(xhr, status, error) {
                        alert(error);
                        console.error(xhr.responseText);
                        
                    }
                });
                location.reload();

            }
            });
            $('.remove-card').click( function (){
                cardId = $(this).attr('data-card-id');
                $.ajax({
                    type: "POST",
                    url: "/boards/markCardAsDeleted",
                    data: 
                    {
                        card_id: cardId
                    },
                    error: function(xhr, status, error) {
                        alert(error);
                        console.error(xhr.responseText);
                        
                    }
                });
                location.reload();
            });
            $('.remove-state').click( function (){
                state_id = $(this).attr('data-state-id');
                $.ajax({
                    type: "POST",
                    url: "/boards/remove_state",
                    data: 
                    {
                        state_id: state_id
                    },
                    error: function(xhr, status, error) {
                        alert("Cannot delete - State has cards referencing it");
                        //console.error(xhr.responseText);
                        
                    }
                });
                location.reload();
            });
            //https://stackoverflow.com/questions/3273350/jquerys-click-pass-parameters-to-user-function
            $('#btn-new-state').on('click', {boardId: boardId}, function (){
                
                state_name = $('#new-state-input').val();
                $.ajax({
                    type: "POST",
                    url: "/boards/insert_new_state",
                    data: 
                    {
                        state_name: state_name,
                        board_id: boardId
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

        </div>
      </div>
    </div>
    <?php
include($_SERVER['DOCUMENT_ROOT'].'/app/viewComponents/modals/card_create.php');

?>

