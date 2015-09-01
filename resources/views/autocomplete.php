<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Remote datasource</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <style>
  .ui-autocomplete-loading {
    background: white url("/images/ui-anim_basic_16x16.gif") right center no-repeat;
  }
  </style>
  <script>
  $(function() {
    
    var fetchVehicleResults = function(request, response) {
      $.ajax({
        url: "<?= getenv('AUTOCOMPLETE_URL') ?>/vehicles",
        dataType: "json",
        data: { search: request.term }, 
        success: function (data) {
          response($.map(data['vehicles'], function(v,i){
            return {
              label: v.make,
              value: v.id
            };
          }));
        }
      })
    };
    
    $( "#vehicles" ).autocomplete({
      minLength: 2,
      source: fetchVehicleResults
    });
  });
  </script>
</head>
<body>
 
<div class="ui-widget">
  <label for="vehicles">Vehicles: </label>
  <input id="vehicles">
</div>
 
<div class="ui-widget" style="margin-top:2em; font-family:Arial">
  Result:
  <div id="log" style="height: 200px; width: 300px; overflow: auto;" class="ui-widget-content"></div>
</div>
 
 
</body>
</html>
