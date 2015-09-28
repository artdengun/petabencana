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
              <form class="navbar-form">
                <div class="form-group" style="display:inline;">
                  <div class="input-group">
                    <div class="input-group-btn">
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="fa fa-paperclip"></span></button>
                      <ul class="dropdown-menu">
                        <li><a href="#">0 - 50</a></li>
                        <li><a href="#">51 - 100</a></li>
                        <li><a href="#">101 - 150</a></li>
                        <li><a href="#">151 - 200</a></li>
                        <li><a href="#">201 - ...</a></li> 
                      </ul>
                    </div>
                    <input id="disaster-keywords" type="text" class="form-control" placeholder="Cari lokasi bencana?">
                    <span class="btn btn-default input-group-addon" onclick="search_disaster();"><span class="fa fa-search"></span> Cari</span>
                  </div>
                </div>
              </form>
            </div>
        </div>

        <div id="map-canvas"></div>
        <div class="container-fluid" id="main">
          <div class="row">
            <div class="col-xs-3" id="left">

              <h4>Filter Peta Bencana</h4>
              <p>Silahkan tentukan kriteria untuk penampilan data bencana</p>
              <hr> 
              <!-- item list -->
                <form class="bs-example" id="criteria-form">
                <div class="panel panel-default">
                    <div class="panel-heading">Pilih Rentang Waktu</div>
                    <div class="panel-body">
                         <div class="form-group">
                            <label for="start-range">Awal Rentang</label>
                            <input class="form-control" id="start-range" name="start-range" placeholder="yyyy-mm-dd" type="text" />
                          </div>
                          <div class="form-group">
                            <label for="end-range">Akhir Rentang</label>
                            <input class="form-control" id="end-range" name="end-range" placeholder="yyyy-mm-dd" type="text" />
                          </div>
                    </div>
                </div>
                
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
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
                    </div>
                    <div class="panel panel-default">
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
                    </div>
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
            
            var landslideIcon = L.icon({
                iconUrl: '<?php echo  $this->uri->getBaseUri(); ?>assets/img/disaster/landslides.png',
                // shadowUrl: 'leaf-shadow.png',

                iconSize:     [30, 49], // size of the icon
                // shadowSize:   [50, 64], // size of the shadow
                iconAnchor:   [22, 49], // point of the icon which will correspond to marker's location
                // shadowAnchor: [4, 62],  // the same for the shadow
                popupAnchor:  [-3, -56] // point from which the popup should open relative to the iconAnchor
            });

            var twisterIcon = L.icon({
                iconUrl: '<?php echo  $this->uri->getBaseUri(); ?>assets/img/disaster/twisters.png',
                // shadowUrl: 'leaf-shadow.png',

                iconSize:     [30, 49], // size of the icon
                // shadowSize:   [50, 64], // size of the shadow
                iconAnchor:   [22, 49], // point of the icon which will correspond to marker's location
                // shadowAnchor: [4, 62],  // the same for the shadow
                popupAnchor:  [-3, -56] // point from which the popup should open relative to the iconAnchor
            });

            var mapMarkers = [];

            $(document).ready(function(){
                $('#start-range').datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: "yy-mm-dd",
                    minDate: new Date(2010, 1 - 1, 1),
                    maxDate: new Date(2016, 1 - 1, 1),
                });

                $('#end-range').datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: "yy-mm-dd",
                    minDate: new Date(2010, 1 - 1, 1),
                    maxDate: new Date(2016, 1 - 1, 1),
                });
                
                init_map(map);
            })

            function search_disaster()
            {
                delete_marker(map);

                var last_response_len = false;
                var keywords = $('#disaster-keywords').val();
                var criteria_form_data = $('#criteria-form').serialize();

                $.ajax('<?php echo  $this->uri->getBaseUri()."index.php/map/search_disaster_process"; ?>', {
                    type: 'POST',
                    data: criteria_form_data+'&keywords='+keywords,
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
                                        tempIcon = {};
                                        if (rows.jenis.toLowerCase() == 'banjir')
                                        {
                                            tempIcon = {icon: floodIcon};
                                        }
                                        else if (rows.jenis.toLowerCase() == 'tanah longsor')
                                        {
                                            tempIcon = {icon: landslideIcon};
                                        }

                                        else if (rows.jenis.toLowerCase() == 'puting beliung')
                                        {
                                            tempIcon = {icon: twisterIcon};
                                        }

                                        var marker = L.marker([rows.latitude, rows.langitude], tempIcon).addTo(map);
                                        var elemPopup = "<h4>"+rows.jenis+"</h4>"+
                                                        "<ul>"+
                                                        "<li>tanggal: "+rows.tanggal+"</li>"+
                                                        "<li>jam: "+rows.jam+" "+rows.zona_waktu+"</li>"+
                                                        "<li>lokasi: "+rows.lokasi+"</li>"+
                                                        "<li>korban: "+rows.korban+"</li>"+
                                                        "<li>kerugian: "+rows.kerugian+"</li>"+
                                                        "</ul>"+
                                                        rows.keterangan+" ("+rows.langitude+","+rows.latitude+")";

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

            function init_map(map)
            {
                var last_response_len = false;
            
                $.ajax('<?php echo  $this->uri->getBaseUri()."index.php/map/init_map_process"; ?>', {
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
                                        tempIcon = {};
                                        if (rows.jenis.toLowerCase() == 'banjir')
                                        {
                                            tempIcon = {icon: floodIcon};
                                        }

                                        else if (rows.jenis.toLowerCase() == 'tanah longsor')
                                        {
                                            tempIcon = {icon: landslideIcon};
                                        }

                                        else if (rows.jenis.toLowerCase() == 'puting beliung')
                                        {
                                            tempIcon = {icon: twisterIcon};
                                        }

                                        var marker = L.marker([rows.latitude, rows.langitude], tempIcon).addTo(map);

                                        var elemPopup = "<h4>"+rows.jenis+"</h4>"+
                                                        "<ul>"+
                                                        "<li>tanggal: "+rows.tanggal+"</li>"+
                                                        "<li>jam: "+rows.jam+" "+rows.zona_waktu+"</li>"+
                                                        "<li>lokasi: "+rows.lokasi+"</li>"+
                                                        "<li>korban: "+rows.korban+"</li>"+
                                                        "<li>kerugian: "+rows.kerugian+"</li>"+
                                                        "</ul>"+
                                                        rows.keterangan+" ("+rows.langitude+","+rows.latitude+")";
                                        
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