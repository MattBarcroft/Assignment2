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

<script>
  $( function() {
    function hexFromRGB(r, g, b) {
      var hex = [
        r.toString( 16 ),
        g.toString( 16 ),
        b.toString( 16 )
      ];
      $.each( hex, function( nr, val ) {
        if ( val.length === 1 ) {
          hex[ nr ] = "0" + val;
        }
      });
      return hex.join( "" ).toUpperCase();
    }
    function refreshSwatch() {
      var red = $( "#red-slider" ).slider( "value" ),
        green = $( "#green-slider" ).slider( "value" ),
        blue = $( "#blue-slider" ).slider( "value" ),
        hex = hexFromRGB( red, green, blue );
      $( "#swatch" ).css( "background-color", "#" + hex );
      $( "#color-picker" ).val("#" + hex)
    }
 
    $( "#red-slider, #green-slider, #blue-slider" ).slider({
      orientation: "horizontal",
      range: "min",
      max: 255,
      value: 127,
      slide: refreshSwatch,
      change: refreshSwatch
    });
    $( "#red-slider" ).slider( "value", 255 );
    $( "#green-slider" ).slider( "value", 140 );
    $( "#blue-slider" ).slider( "value", 60 );
  } );
  </script>
    <style>
  #red-slider, #green-slider, #blue-slider {
    float: left;
    clear: left;
    width: 300px;
    margin: 15px;
  }
  #swatch {
    width: 120px;
    height: 40px;
    background-image: none;
  }
  #red-slider .ui-slider-range { background: #ef2929; }
  #red-slider .ui-slider-handle { border-color: #ef2929; }
  #green-slider .ui-slider-range { background: #8ae234; }
  #green-slider .ui-slider-handle { border-color: #8ae234; }
  #blue-slider .ui-slider-range { background: #729fcf; }
  #blue-slider .ui-slider-handle { border-color: #729fcf; }
  </style>