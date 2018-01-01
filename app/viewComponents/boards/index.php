
    <div class="jumbotron">
    <div class="container theme-showcase" role="main">


        <div class='top-bar'>
            <div class='board-title-div'>
                <h2> <?php echo $data[0]; ?> </h2>
            </div>
            <div class='input-div float-right'>
                <div class='input-group float-right div-above-search'>
                    <a class="btn btn-primary btn-add-card" data-toggle="modal" data-target="#invite_user_to_board_modal">Invite User</a>
                <br>
                </div>
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
            echo "<div class='board' style='background-color:" . $value[0]["hex_color"] . "' data-state-id='" . $state[1] . "'>";    
                echo "<div class='div-state-header'>";
                    echo "<div class='div-state-title'>";
                        echo "<h4>" . $state[0] . "</h4>";
                    echo "</div>";
                    echo "<div class='div-state-actions'>";
                        echo "<div class='div-state-arrow'>";
                            echo '<i class="fa fa-arrow-left" data-state-id="' . $state[1] . '"></i>';
                        echo "</div>";
                        echo "<div class='div-state-arrow'>";
                            echo '<i class="fa fa-arrow-right" data-state-id="' . $state[1] . '"></i>';
                        echo "</div>";
                        echo "<div class='div-state-arrow'>";
                            echo "<a class='remove-state' data-state-id=" . $state[1] . "><i class='fa fa-minus-circle fa-small fa-float-right'></i></a>";
                        echo "</div>"; 
                    echo "</div>"; 
                echo "</div>"; 
                    foreach ($value as $row) {
                        if ($row["card_name"] != null){
                            echo "<div class='card draggable' data-card-id='" . $row["card_id"] . "'>";
                                echo "<p>" . $row["card_name"] . "<a class='remove-card' data-card-id=" . $row["card_id"] . "><i class='fa fa-minus-circle fa-small fa-float-right'></i></a></p>";
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

        </div>
      </div>
    </div>

