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
                <br/>
                <canvas id="myChart" width="900" height="400"></canvas>
                <br/>
                <canvas id="myChart1" width="900" height="400"></canvas>
                <br/>
                <canvas id="myChart2" width="900" height="400"></canvas>
                <br/>
                <canvas id="myChart3" width="900" height="400"></canvas>
                
            </div>
          </div>
        </div>
        <!-- end template -->

        <!-- script references -->
        <script type="text/javascript" src="<?php echo  $this->uri->getBaseUri(); ?>assets/js/leaflet/leaflet.js"></script>
        <script type="text/javascript" src="<?php echo  $this->uri->getBaseUri(); ?>assets/js/chartjs/Chart.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->uri->getBaseUri(); ?>/assets/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->uri->getBaseUri(); ?>/assets/js/jquery-ui-1.10.4/ui/minified/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->uri->getBaseUri(); ?>/assets/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            var data = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "My First dataset",
                        fillColor: "rgba(220,220,220,0.5)",
                        strokeColor: "rgba(220,220,220,0.8)",
                        highlightFill: "rgba(220,220,220,0.75)",
                        highlightStroke: "rgba(220,220,220,1)",
                        data: [65, 59, 80, 81, 56, 55, 40]
                    },
                    {
                        label: "My Second dataset",
                        fillColor: "rgba(151,187,205,0.5)",
                        strokeColor: "rgba(151,187,205,0.8)",
                        highlightFill: "rgba(151,187,205,0.75)",
                        highlightStroke: "rgba(151,187,205,1)",
                        data: [28, 48, 40, 19, 86, 27, 90]
                    }
                ]
            };

            var options = {
                //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                scaleBeginAtZero : true,

                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines : true,

                //String - Colour of the grid lines
                scaleGridLineColor : "rgba(0,0,0,.05)",

                //Number - Width of the grid lines
                scaleGridLineWidth : 1,

                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,

                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines: true,

                //Boolean - If there is a stroke on each bar
                barShowStroke : true,

                //Number - Pixel width of the bar stroke
                barStrokeWidth : 2,

                //Number - Spacing between each of the X value sets
                barValueSpacing : 5,

                //Number - Spacing between data sets within X values
                barDatasetSpacing : 1,

                //String - A legend template
                legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"

            };

            var ctx = document.getElementById("myChart").getContext("2d");
            var myBarChart = new Chart(ctx).Bar(data, options);

            var ctx = document.getElementById("myChart1").getContext("2d");
            var myBarChart1 = new Chart(ctx).Bar(data, options);
            
            var ctx = document.getElementById("myChart2").getContext("2d");
            var myBarChart2 = new Chart(ctx).Bar(data, options);
            
            var ctx = document.getElementById("myChart3").getContext("2d");
            var myBarChart3 = new Chart(ctx).Bar(data, options);
            
        </script>
    </body>
</html>