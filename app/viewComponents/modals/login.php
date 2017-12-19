<!-- https://bootsnipp.com/snippets/featured/modal-login-with-jquery-effects -->

<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header" align="center">
            <!-- image -->
            <div class="div-center">
                <img class="" src="/app/content/images/icons/wood-board.svg" width="100" height="100" alt="">
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
            </button>
        </div>
        <div id="div-forms">
            <form id="login-form" action="/users/check_login" method="POST">
                <div class="modal-body">
                    <div id="div-login-msg">
                        <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                        <span id="text-login-msg">Type your username and password.</span>
                    </div>
                    <input id="login_username" class="form-control login-input" type="text" placeholder="Username" required name="username">
                    <input id="login_password" class="form-control login-input" type="password" placeholder="Password" required name="password">
                </div>
                <div class="modal-footer">
                    <div>
                        <button type="login_submit_btn" class="btn btn-primary btn-lg btn-block">Login</button>
                    </div>
                    <div>
                        <button id="login_register_btn" type="button" class="btn btn-link">Register</button>
                    </div>

                </div>
            </form>

        </div>

    </div>
</div>
</div>