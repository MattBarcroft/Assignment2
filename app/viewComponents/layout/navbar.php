<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse">
<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
  <span class="navbar-toggler-icon"></span>
</button>
<a class="navbar-brand" href="/home">
    <img src="/app/content/images/icons/wood-board.svg" width="50" height="40" alt="">
  </a>
<a class="navbar-brand" href="/home">IKanban</a>

<div class="collapse navbar-collapse">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
      <a class="nav-link" href="/home">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/boards/create">Create Board <span class="sr-only">(current)</span></a>
    </li>
  </ul>
  <ul class="navbar-nav">
  
    <li class="nav-item">
      <?php 
      if(isset($_SESSION['username'])){ 
        ?>
        <a class="nav-link" href="/users/logout">Logout</a>
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