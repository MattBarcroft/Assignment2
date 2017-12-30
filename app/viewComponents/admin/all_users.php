<div class="container theme-showcase" role="main">
  <div class="jumbotron">
    <table class="table table-striped">
        <tr>
            <th>User Id</th>
            <th>Username</th>
            <th>Account Created</th>
            <th>Deleted?</th>
            <th>Action</th>

        <tr>
        <?php 

        foreach($data as $user){
            echo "<tr>";
            echo "<td>" . $user["user_id"] . "</td>";
            echo "<td>" . $user["username"] . "</td>";
            echo "<td>" . $user["accountcreated"] . "</td>";
            echo "<td>" . $user["deleted"] . "</td>";
            echo "<td><a href='/admin/user_details/" . $user["user_id"] . "'>User Details</a></td>";
            
            echo "</tr>";
        }
        ?>
    </table>
  </div>
</div>