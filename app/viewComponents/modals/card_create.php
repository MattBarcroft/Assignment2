<!-- https://bootsnipp.com/snippets/featured/modal-login-with-jquery-effects -->

<script>
    
$( function() {
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
</script>


<div class="modal fade" id="card-create-modal" style="display: none;">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header" align="center">
            <!-- image -->
            <div class="div-center">
                <img class="" src="/app/content/images/icons/wood-board.svg" width="100" height="100" alt="">
            </div>
            <button type="button" class="close" data-dismiss="modal">
                <span class="glyphicon glyphicon-remove"></span>
            </button>
        </div>
        <div id="div-forms">
            <div class="modal-body">
                <div id="div-login-msg">
                    <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                    <span id="text-login-msg">Enter a card name</span>
                </div>
                <input id="card_name" class="form-control card-input" type="text" placeholder="Card" required name="card_name">
            </div>
            <div class="modal-footer">
                <div>
                    <button id="card_submit_btn" class="btn btn-primary btn-lg btn-block">Create</button>
                </div>

            </div>
        </div>

    </div>
</div>
</div>
