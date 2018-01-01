<!-- https://bootsnipp.com/snippets/featured/modal-login-with-jquery-effects -->
<!-- https://stackoverflow.com/questions/8663189/jquery-autocomplete-no-result-message -->
<script>
        $( function() {
            var uri = $(location).attr('href');
            var board_id = uri.split('/').pop();
            $.ajax({
                type: 'GET',
                url: "/membership/users_with_access_to_board",
                data: 
                {
                    board_id : board_id
                },
                error: function(xhr, status, error) {
                    alert(error);
                    console.error(xhr.responseText);
                },
                success: function (response) {
                    var tableData = '';
                    response = JSON.parse(response);
                    $.each(response, function (index, username) {
                        tableData += 
                                '<tr>' +
                                '<td data-userid=' + index + '>' + username + '</td>' +
                                '<td><button type="button" class="btn btn-danger btn-sm remove_membership_button" value=' + index 
                                +'>Remove User</button></td>' +
                                '</tr>'
                        
                    });
                    $('#table-users').append(tableData);
                },
            });
            // https://stackoverflow.com/questions/19237235/jquery-button-click-event-not-firing
            $(document).on("click", ".remove_membership_button", function(){
                var user_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "/membership/remove_membership",
                    data: 
                    {
                        user_id : user_id,
                        board_id : board_id
                    },
                    error: function(xhr, status, error) {
                        alert(error);
                        console.error(xhr.responseText);
                    }
                });
                alert("membership removed");
                $('#invite_user_to_board_modal').modal('hide');
                location.reload();
            });

            $("#invite_submit_btn").attr("disabled", "disabled");
            var userList = [
                <?php
                $userlist = "";
                foreach($data as $user){
                    $userlist = $userlist . "{key: " . $user["user_id"] . ",value: '" . $user["username"] . "'},";
                }
                substr($userlist, 0, -1);
                echo $userlist;
                ?>
            ];
            var NoResultsLabel = "No Users Found";
            
            $( "#search-users" ).autocomplete({

                source: function(request, response) {
                    var results = $.ui.autocomplete.filter(userList, request.term);
                    $("#invite_submit_btn").removeAttr("disabled");
                    if (!results.length) {
                        results = [ NoResultsLabel ];
                        $("#invite_submit_btn").attr("disabled", "disabled");
                    }
                    response(results);
                },
                focus: function( event, ui ) {
                    if (ui.item.label === NoResultsLabel) {
                        event.preventDefault();
                        return false;
                    }
                    else{
                        $( "#search-users" ).val( ui.item.value );
                        return false;
                    }
                },
                select: function( event, ui ) {
                    if (ui.item.label === NoResultsLabel) {
                        event.preventDefault();
                        $( "#search-users-id" ).val( 0 );
                        return false;
                    }
                    else{
                        $( "#search-users" ).val( ui.item.value );
                        $( "#search-users-id" ).val( ui.item.key );
                    }
                  return false;
                } 
                });

            $('#invite_submit_btn').click(function() { 
                var user_id = $('#search-users-id').val(); 
                var uri = $(location).attr('href');
                var board_id = uri.split('/').pop();
                console.log(user_id + "         " + board_id);
                $.ajax({
                    type: "POST",
                    url: "/membership/insert_membership",
                    data: 
                    {
                        user_id : user_id,
                        board_id : board_id
                    },
                    error: function(xhr, status, error) {
                        alert(error);
                        console.error(xhr.responseText);
                    }
                });
                alert("User successfully invited to board");
                $('#invite_user_to_board_modal').modal('hide');
                location.reload();
            });
          } );
</script>

<div class="modal fade" id="invite_user_to_board_modal" style="display: none;">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header" align="center">
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
                    <span id="text-login-msg">Users with access to this board</span>
                    <div class="ui-widget">
                        <table id="table-users" class="table-striped table">
                            <tr>
                                <th>Username</th>
                                <th>Remove</th>
                            </tr>
                        </table>
                    </div>
                    <span id="text-login-msg">Invite a user</span>
                    <div class="ui-widget">
                        <input id="search-users" class="form-control card-input" name="search-users">  
                        <input id="search-users-id" class="display-none" name="search-users-id">  
                        
                    </div>
                </div>
  
            </div>
            
            <div class="modal-footer">
                <div>
                    <button id="invite_submit_btn" class="btn btn-primary btn-lg btn-block">Invite</button>
                </div>
            </div>
        </div>

    </div>
</div>
</div>

