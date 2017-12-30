
    <div class="container theme-showcase" role="main">

      <div class="jumbotron">

        <h2>User Details</h2>
        <div class="form-group">
            <label for="name"><h3>Username:</h3></label>
            <div class="input-group">
                <p><?php echo $data["username"]; ?></p>
            </div>
            <label for="name"><h3>Name:</h3></label>
            <div class="input-group">
                <p><?php echo $data["name"]; ?></p>
            </div>
            <label for="name"><h3>Email:</h3></label>
            <div class="input-group">
                <p><?php echo $data["email"]; ?></p>
            </div>
            <label for="name"><h3>Account Created:</h3></label>
            <div class="input-group">
                <p><?php echo $data["accountcreated"]; ?></p>
            </div>
            <label for="name"><h3>Deleted:</h3></label>
            <div class="input-group">
                <p><?php echo $data["deleted"]; ?></p>
            </div>
            <?php if($data["deleted"] != 1){
                ?>
            <a href="/admin/mark_user_deleted/<?php echo $data["user_id"]; ?>" class="btn btn-secondary" >Mark User Deleted</a>
            <?php
            }
            else
            {
            ?>
            <a href="/admin/mark_user_undeleted/<?php echo $data["user_id"]; ?>" class="btn btn-secondary" >Mark User Undeleted</a>
            <?php
            }
            ?>
            <br>
            <br>

