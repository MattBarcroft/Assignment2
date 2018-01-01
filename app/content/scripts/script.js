
$( document ).ready(function() {
    $('#login_register_btn').click(function(){
        window.location.href='/users/register';
    });
    $('#btn-new-board').click(function (){
        var boardName = $('#new-board-input').val();
        if (boardName) {
            window.location = '/boards/create?boardname=' + boardName;
        }

    });

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
    function hexFromRGB(r, g, b) {
      var hex = [
        r.toString( 16 ),
        g.toString( 16 ),
        b.toString( 16 )
      ];
      $.each( hex, function( nr, val ) {
        if ( val.length === 1 ) {
          hex[ nr ] = "0" + val;
        }
      });
      return hex.join( "" ).toUpperCase();
    }
    function refreshSwatch() {
      var red = $( "#red-slider" ).slider( "value" ),
        green = $( "#green-slider" ).slider( "value" ),
        blue = $( "#blue-slider" ).slider( "value" ),
        hex = hexFromRGB( red, green, blue );
      $( "#swatch" ).css( "background-color", "#" + hex );
      $( "#color-picker" ).val("#" + hex)
    }
 
    $( "#red-slider, #green-slider, #blue-slider" ).slider({
      orientation: "horizontal",
      range: "min",
      max: 255,
      value: 127,
      slide: refreshSwatch,
      change: refreshSwatch
    });
    $( "#red-slider" ).slider( "value", 255 );
    $( "#green-slider" ).slider( "value", 140 );
    $( "#blue-slider" ).slider( "value", 60 );

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

                $('.btn-add-card').on( "click", function() {
        stateid = $(this).attr('data-state-id');
        $('#card_submit_btn').attr("data-state-id", stateid);
        $('#testModal').modal();
    });
    $('#card-create-modal').on('shown.bs.modal', function () {
            stateid = $('#card_submit_btn').attr('data-state-id');
            $('#card_name').focus();
    });
    $('#card_submit_btn').click(function() { 
        var card_name = $('#card_name').val(); 
        $.ajax({
            type: "POST",
            url: "/boards/create_Card",
            data: 
            {
                cardName : card_name,
                stateId : stateid
            },
            error: function(xhr, status, error) {
                alert(error);
                console.error(xhr.responseText);
            }
        });
        $('#card-create-modal').modal('hide');
        location.reload();
    });
    
});
