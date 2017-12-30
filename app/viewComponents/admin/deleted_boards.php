
    <div class="container theme-showcase" role="main">

      <div class="jumbotron">
        <table class="table table-striped">
            <tr>
                <th>Board Id</th>
                <th>Board Name</th>
                <th>Action</th>
            <tr>
            <?php 
            foreach($data as $board){
                echo "<tr>";
                echo "<td>" . $board[0] . "</td>";
                echo "<td>" . $board[1] . "</td>";
                echo "<td><a href='/admin/mark_undeleted/" . $board[0] . "'>Mark Undeleted</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
      </div>
    </div>