<div class="container theme-showcase" role="main">
    <div class="jumbotron">

        <div class='top-bar'>
            <div class='search-bar'>
                <form class="navbar-form" action="/boards/search" method="POST">
                    <div class="input-group add-on">
                        <input class="form-control" placeholder="Search" name="board_name" type="text">
                        <div class="input-group-btn">
                            <div class="btn-group" role="group">
                                <div class="dropdown dropdown-lg">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="form-group">
                                            <label for="public">Public:</label>
                                            <div class="input-group">
                                                <input type="checkbox" class="form-control" id="public" name="public">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Search </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-group-btn">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <hr>
            <div class='input-div float-right'>
                <div class='input-group'>
                    <input type='text' id='new-board-input' class='form-control' placeholder='New Board...'>
                    <span class='input-group-btn'>
                        <button class='btn btn-secondary' id='btn-new-board' type='button'>
                            <i class='fa fa-plus fa-fw'></i>
                        </button>
                    </span>
                </div>
            </div>
        </div>
        <div class="space">
        </div>
