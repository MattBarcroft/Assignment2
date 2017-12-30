<nav class="navbar navbar-toggleable-md navbar-inverse">
<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar-main">
  <span class="navbar-toggler-icon"></span>
</button>
<a class="navbar-brand" href="/home">
    <img src="/app/content/images/icons/wood-board.svg" width="50" height="40" alt="">
  </a>
<a class="navbar-brand" href="/home">IKanban</a>

<div id="navbar-main" class="collapse navbar-collapse">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
      <a class="nav-link" href="/home">Home</a>
    </li>
    <?php
    if(isset($_SESSION['username'])){
    ?>
      <li class="nav-item">
        <a class="nav-link" href="/boards/create">Create Board</span></a>
      </li>
    <?php 
    }
    ?>
    <?php 
    if(isset($_SESSION['admin'])){
      if($_SESSION['admin'] == 1){
      ?>
    <li class="nav-item">
      <a class="nav-link" href="/admin/index">Admin</span></a>
    </li>
    <?php }
    }
    ?>
  </ul>
  <ul class="navbar-nav">
  
    <li class="nav-item">
      <?php 
      if(isset($_SESSION['username'])){ 
        ?>
        <a class="nav-link" href="/users/logout">Logout <?php echo $_SESSION['username']; ?></a>
      <?php
      } else{
      ?>
        <a class="nav-link" data-toggle="modal" data-target="#login-modal">
        <i class="fa fa-user txt-white pdg-5px"></i>Login/Register</a>
      <?php } ?>
    </li>
  </ul>
</div>
</nav>

<?php
include($_SERVER['DOCUMENT_ROOT'].'/app/viewComponents/modals/login.php');

?>