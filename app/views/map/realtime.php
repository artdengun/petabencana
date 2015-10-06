<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Peta Bencana</title>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="<?php echo  $this->uri->getBaseUri();  ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo  $this->uri->getBaseUri();  ?>assets/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo  $this->uri->getBaseUri();  ?>assets/css/map-styles.css" rel="stylesheet">
        <link href="<?php echo  $this->uri->getBaseUri();  ?>assets/js/leaflet/leaflet.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo  $this->uri->getBaseUri();  ?>assets/js/jquery-ui-1.10.4/themes/base/minified/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <!-- begin template -->
        <div class="navbar navbar-custom navbar-fixed-top">
         <div class="navbar-header"><a class="navbar-brand" href="#">Peta Bencana</a>
              <a class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </a>
            </div>
            <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li><a href="#">Tentang</a></li>
                <li><a href="#">Bantuan</a></li>
                <li>&nbsp;</li>
              </ul>
            </div>
        </div>
        <div id="map-canvas"></div>
        <div class="container-fluid" id="main">
          <div class="row">
            <div class="col-xs-3" id="left">

              <h4>Filter Peta Bencana (Realtime)</h4>
              <p>Silahkan tentukan kriteria untuk penampilan data bencana</p>
              <hr> 
              <!-- item list -->
                <form class="bs-example" id="criteria-form">  
                <div class="panel-group" id="accordion">
                    <!-- <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            Jenis Bencana
                          </a>
                        </h4>
                      </div>
                      <div style="height: 0px;" id="collapseOne" class="panel-collapse collapse">
                        <div class="panel-body">
                          <div class="checkbox">
                            <label>
                              <input value="banjir" name="jenis_bencana[]" type="checkbox"> Banjir
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                              <input value="tanah_longsor" name="jenis_bencana[]" type="checkbox"> Tanah Longsor
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                              <input value="puting_beliung" name="jenis_bencana[]" type="checkbox"> Puting Beliung
                            </label>
                          </div>
                        </div>
                      </div>
                    </div> -->
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            Pilih Data
                          </a>
                        </h4>
                      </div>
                      <div style="height: auto;" id="collapseOne" class="panel-collapse in">
                        <div class="panel-body">
                          <div class="radio">
                            <label>
                              <input name="pilih_data" value="gempa_bmkg" type="radio">
                              Gempa (BMKG)
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            Limit Data
                          </a>
                        </h4>
                      </div>
                      <div style="height: auto;" id="collapseTwo" class="panel-collapse in">
                        <div class="panel-body">
                          <div class="radio">
                            <label>
                              <input name="limit_data" value="25" type="radio">
                              25
                            </label>
                          </div>
                          <div class="radio">
                            <label>
                              <input name="limit_data" value="50" type="radio">
                              50
                            </label>
                          </div>
                          <div class="radio">
                            <label>
                              <input name="limit_data" value="100" type="radio">
                              100
                            </label>
                          </div>
                          <div class="radio">
                            <label>
                              <input name="limit_data" value="250" type="radio">
                              250
                            </label>
                          </div>
                        </div>
                      </div>
                    </div> -->
                </div>
              </form>
              <hr>      
            </div>
            <div class="col-xs-9">
            </div>
          </div>
        </div>
        <!-- end template -->

        <!-- script references -->
        <script type="text/javascript" src="<?php echo  $this->uri->getBaseUri(); ?>assets/js/leaflet/leaflet.js"></script>
        <script type="text/javascript" src="<?php echo $this->uri->getBaseUri(); ?>/assets/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->uri->getBaseUri(); ?>/assets/js/jquery-ui-1.10.4/ui/minified/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->uri->getBaseUri(); ?>/assets/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            var map = L.map('map-canvas').setView([-3.5319, 114.9644], 5);
            L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: 'map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>'
                        }).addTo(map);

            var floodIcon = L.icon({
                iconUrl: '<?php echo  $this->uri->getBaseUri(); ?>assets/img/disaster/floods.png',
                // shadowUrl: 'leaf-shadow.png',

                iconSize:     [30, 49], // size of the icon
                // shadowSize:   [50, 64], // size of the shadow
                iconAnchor:   [22, 49], // point of the icon which will correspond to marker's location
                // shadowAnchor: [4, 62],  // the same for the shadow
                popupAnchor:  [-3, -56] // point from which the popup should open relative to the iconAnchor
            });
            
            var mapMarkers = [];

            $(document).ready(function(){
                realtime_map(map);

                setInterval(function(){
                  delete_marker(map);
                  realtime_map(map);  
                }, 20000);
            })

            function realtime_map(map)
            {
                var last_response_len = false;
            
                $.ajax('<?php echo  $this->uri->getBaseUri()."index.php/map/realtime_map_process"; ?>', {
                    xhrFields: {
                        onprogress: function(e)
                        {
                            var this_response, response = e.currentTarget.response;
                            if(last_response_len === false)
                            {
                                this_response = response;
                                last_response_len = response.length;
                            }
                            else
                            {
                                this_response = response.substring(last_response_len);
                                last_response_len = response.length;
                            }

                            z = this_response.split('--');
                            console.log(z);
                            elem = "";
                            for (var i = 0; i < z.length; i++)
                            {
                                if (z[i] != "") 
                                {
                                    rows = JSON.parse(z[i]);
                                    
                                    if (rows.hasOwnProperty('start'))
                                    {
                                    }
                                    else if (rows.hasOwnProperty('end'))
                                    {
                                    }
                                    else
                                    {
                                        tempIcon = {icon: floodIcon};
                                        var marker = L.marker([rows.latitude, rows.langitude], tempIcon).addTo(map);
                                        var elemPopup = "<h4>"+$("<div/>").html(rows.lokasi).text()+"</h4>"+
                                                        "<ul>"+
                                                        "<li>waktu: "+rows.waktu+"</li>"+
                                                        "<li>magnitude: "+rows.magnitude+"</li>"+
                                                        "<li>kedalaman: "+rows.kedalaman+"</li>"+
                                                        "</ul>"+
                                                        "coordinate: ("+rows.latitude+
                                                        ", "+rows.langitude+")"+
                                                        '';
                                        
                                        marker.bindPopup(elemPopup);
                                        mapMarkers.push(marker);
                                        delete marker;
                                    }
                                    delete rows;
                                }
                            }

                            // deleting all variable
                            delete this_response;
                            delete elem;
                            delete response;
                            delete last_response;
                            delete z;

                        }
                    }
                })
                .done(function(data)
                {
                    console.log('Complete response..');
                })
                .fail(function(data)
                {
                    console.log('Error: ', data);
                });
            }

            function delete_marker(map)
            {
                for(var i = 0; i < mapMarkers.length; i++){
                    map.removeLayer(mapMarkers[i]);
                }
                mapMarkers = [];
            }
        </script>
    </body>
</html>