<div class="container theme-showcase" role="main">
<div class="jumbotron">
  <form method="POST" action="/boards/create_board">
    <h1>Insert Board<h1>
    <h3>Create a new board</h3>
    <div class="col-md-6">
      <div class="form-group">
        <label for="name"></label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-plus fa"></i></span>
          <?php
          if (isset($data)){
            echo '<input type="text" class="form-control" value=' . $data . ' id="name" name="name">';
          } else {
            echo '<input type="text" class="form-control" id="name" name="name">';
          }
          ?>
        </div>
      </div>
      <!-- https://jqueryui.com/slider/#colorpicker -->
      <div class="form-group">
        <label for="public">Board Color:</label>
        <div class="input-group">
          <div id="red-slider"></div>
          <div id="green-slider"></div>
          <div id="blue-slider"></div>
        </div>
        <div class="input-group">
          <input type="text" readonly class="form-control" id="color-picker" name="color-picker">
          <div id="swatch" class="ui-widget-content ui-corner-all"></div>
   
        </div>

      </div>
      <div class="form-group">
        <label for="public">Public:</label>
        <div class="input-group">
          <input type="checkbox" class="form-control" id="public" name="public">
        </div>
      </div>
      <div>
        <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
      </div>
    </div>
    <div class="col-md-6"></div>
  <form>
</div>
</div>
