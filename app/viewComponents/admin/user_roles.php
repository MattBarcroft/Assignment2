<label for="name"><h3>Roles:</h3></label>
    <div class="input-group">
<?php

foreach ($data as $role)
{
    echo $role["role_name"] . "</br>";
}

?>
</div>

<div class="input-group">

<?php
    if (!in_array("Admin", $data[0]))
      {
        
          ?>
        <a href="/admin/make_admin/<?php echo $data[0]["user_id"]; ?>" class="btn btn-secondary">Make Admin</a></br>
        <?php
      }
    else
    {
        
        ?>
        
      <a href="/admin/remove_admin/<?php echo $data[0]["user_id"]; ?>" class="btn btn-secondary">Remove Admin</a></br>
      <?php
    }
    ?>

<!-- divs to close user_details jumbotron -->
    </div>
  </div>
</div>