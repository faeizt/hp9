<?
$date = date("Y-m-d");
?>
<input type="hidden" id="project_list" value="MARA01,LHDN02">
<input type="hidden" id="today" value="<?=$date?>">

<?
session_start();
$_SESSION['nav_level'] = "1";
$_SESSION['nav_title'] = "report";
include ("../nav/header.php");
if ($access_control == "true") {
?>
      <!-- Submenu Navigation -->
      <nav class="navbar navbar-default" role="navigation">
        <div id="myScrollspy" class="collapse navbar-collapse  submenu-colls">
          <ul class="nav navbar-nav-thin navbar-nav-thin-leftborder-dark vert-menu-border-dark navbar-user">

            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="width:">Incident Report &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b class="caret "></b></a>
              <ul class="dropdown-menu">
                <li><a href="../profile?user=<?=$_SESSION['username']?>">Customer</a></li>
                <li><a href="../logout.php"> Project</a></li>
                <li><a href="../logout.php"> Incidents</a></li>
                <li><a href="../logout.php"> Engineer</a></li>
              </ul>
            </li>
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="width:">Report Type &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b class="caret "></b></a>
              <ul class="dropdown-menu">
                <li><a href="../profile?user=<?=$_SESSION['username']?>">Customer</a></li>
                <li><a href="../logout.php"> Project</a></li>
                <li><a href="../logout.php"> Incidents</a></li>
                <li><a href="../logout.php"> Engineer</a></li>
              </ul>
            </li> 
            <li><a href="machine"><span class="glyphicon glyphicon-file"></span> Machine Type</a></li>

          </ul>
          <ul class="nav navbar-right navbar-nav-thin navbar-nav-thin-leftborder-dark vert-menu-border-dark navbar-user">
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="width:">Report Type &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b class="caret "></b></a>
              <ul class="dropdown-menu">
                <li><a href="../profile?user=<?=$_SESSION['username']?>">Customer</a></li>
                <li><a href="../logout.php"> Project</a></li>
                <li><a href="../logout.php"> Incidents</a></li>
                <li><a href="../logout.php"> Engineer</a></li>
              </ul>
            </li> 
            <li id="reportrange" class=" date-picker"><a>
                      <i class="fa fa-calendar fa-lg"></i>
                      <span><?php echo date("F j, Y"); ?></span> <b class="caret"></b></a>
            </li>

          </ul>          
        </div><!--/.nav-collapse -->
      </nav><!--/.navbar-default -->
      <!-- end of Submenu -->
      <div id="page-wrapper" class="panel-body">
        <div class="row">
          <div class="col-lg-12">

              <div class="panel-body">
            <!-- statistics chart built with jQuery Flot -->
            <div class="row chart">
                <div class="col-md-12">
                </div>
                <div class="col-md-12">
                    <div id="statsChart" style="height: 300px;"></div>
                </div>
            </div>
            <!-- end statistics chart -->
            </div>
          </div>
        </div><!-- /.row -->
        <div class="row">
          <div class="col-lg-12">
            <ul class="bs-glyphicons">
              <li> 
                <div>
                  <p style="font-size:20px"><span class="glyphicon glyphicon-fire"></span></p>
                  <p></p><h3>Open</h3><p></p>
                  
                </div>
                <div style="float:right;margin-top:28px">
                  <span class="label label-warning">28/01/2014 07:45</span>
                </div>
                  
              </li>         
                 
              <li>
                <div>
                <p style="font-size:20px"><span class="glyphicon glyphicon-tint"></span></p>
                <p></p><h3>Engineer Onsite</h3><p></p>    
                </div>
                <div style="float:right;margin-top:0px">
                <span class="label label-info">29/01/2014 04:00</span>
                </div>
              </li>              

                           
                  <li>
                <div>
                <p style="font-size:20px"><span class="glyphicon glyphicon-leaf"></span></p>
                <p></p><h3>Closed</h3><p></p>    
                </div>
                <div style="float:right;margin-top:28px">
                <span class="label label-primary">29/01/2014 19:06</span>
                </div>
              </li>     
                                <li>
                <div>
                <p style="font-size:20px"><span class="glyphicon glyphicon-leaf"></span></p>
                <p></p><h3>Closed</h3><p></p>    
                </div>
                <div style="float:right;margin-top:28px">
                <span class="label label-primary">29/01/2014 19:06</span>
                </div>
              </li>  
              </ul>
              </div>
        </div><!-- /.row -->
        <div class="row">
          <div class="col-lg-12">   
          <div class="table-responsive" id="div_app_list">
          <blockquote>
          <p style="padding:5px">Showing 1 to 4 of 4 entries</p>
          </blockquote>   
          <div style="float:right;margin-top:-35px;">    
          <div class="btn-group">
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-cog"></i>
              </button>
              <ul class="dropdown-menu">
                <li><a href="#">Compact View</a></li>
                <li><a href="#">Details View</a></li>
              </ul>
            </div>
            <button id="first-top" class="btn  btn-small btn-default"><i class="icon-step-backward"></i> </button>
            <button id="prev-top" class="btn  btn-small btn-default"><i class=" icon-angle-left "></i> </button>
            <button id="next-top" class="btn  btn-small btn-default">   <i class="icon-angle-right"></i> </button>
            <button id="last-top" class="btn  btn-small btn-default">  <i class="icon-step-forward "></i> </button>
          </div>
             
          </div>
          <style type="text/css">
          .media p{font-size: 11px}
          .media{clear: both}
          </style>
          <div class="media">
               <script src="../js/holder.js"></script>
          <table class="commentsdata" style="width:100%;border-top: 2px solid #ECF4F8;margin-top: 5px;width: 100%;">
            <tbody>
            <tr style="border-bottom:1px solid #ddd">
              <td style="width:50px"><a class="pull-left" href="#"><img src="holder.js/70x70/social/text:01" style="border:5px solid #ddd" class="img-circle"></a></td>
              <td style="padding:15px">          
              <div style="margin-right: 100px;">
                <strong>have a table which is loaded with data via ajax asjdklfasjd</strong>
                <p><span>Logged on: Feb 13 2014</span> <span>Logged by: Abdul Jadid</span> </p>
              </div> 
              <p>That means that any event handlers bound to the elements during page load will not be applicable to the loaded data unless the event is delegated to a static parent element -- meaning that the element is never removed or replaced, and will exist indefinitely.</p>
              <p><span>Customer: UTM</span> <span>Status: Closed</span> </p>
              </td>
            </tr>
            <tr style="border-bottom:1px solid #ddd">
              <td style="width:50px"><a class="pull-left" href="#"><img class="media-object img-circle" src="../images/uploads/1390991603.jpg" alt="" style="width: 50px;height:50px"></a></td>
              <td style="padding:15px">          
              <div style="margin-right: 100px;">
                <strong>have a table which is loaded with data via ajax asjdklfasjd</strong>
                <p><span>Logged on: Feb 13 2014</span> <span>Logged by: Abdul Jadid</span> </p>
              </div> 
              <p>That means that any event handlers bound to the elements during page load will not be applicable to the loaded data unless the event is delegated to a static parent element -- meaning that the element is never removed or replaced, and will exist indefinitely.</p>
              <p><span>Customer: UTM</span> <span>Status: Closed</span> </p>
              </td>
            </tr>
            <tr style="border-bottom:1px solid #ddd">
              <td style="width:50px"><a class="pull-left" href="#"><img class="media-object img-circle" src="../images/uploads/1390991603.jpg" alt="" style="width: 50px;height:50px"></a></td>
              <td style="padding:15px">          
              <div style="margin-right: 100px;">
                <strong>have a table which is loaded with data via ajax asjdklfasjd</strong>
                <p><span>Logged on: Feb 13 2014</span> <span>Logged by: Abdul Jadid</span> </p>
              </div> 
              <p>That means that any event handlers bound to the elements during page load will not be applicable to the loaded data unless the event is delegated to a static parent element -- meaning that the element is never removed or replaced, and will exist indefinitely.</p>
              <p><span>Customer: UTM</span> <span>Status: Closed</span> </p>
              </td>
            </tr>
            <tr style="border-bottom:1px solid #ddd">
              <td style="width:50px"><a class="pull-left" href="#"><img class="media-object img-circle" src="../images/uploads/1390991603.jpg" alt="" style="width: 50px;height:50px"></a></td>
              <td style="padding:15px">          
              <div style="margin-right: 100px;">
                <strong>have a table which is loaded with data via ajax asjdklfasjd</strong>
                <p><span>Logged on: Feb 13 2014</span> <span>Logged by: Abdul Jadid</span> </p>
              </div> 
              <p>That means that any event handlers bound to the elements during page load will not be applicable to the loaded data unless the event is delegated to a static parent element -- meaning that the element is never removed or replaced, and will exist indefinitely.</p>
              <p><span>Customer: UTM</span> <span>Status: Closed</span> </p>
              </td>
            </tr>
            <tr style="border-bottom:1px solid #ddd">
              <td style="width:50px"><a class="pull-left" href="#"><img data-src="../js/holder.js/70x70" alt="707x70" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNzAiIGhlaWdodD0iODUiPjxyZWN0IHdpZHRoPSIxNzAiIGhlaWdodD0iODUiIGZpbGw9IiNhZmU3YjEiPjwvcmVjdD48dGV4dCB0ZXh0LWFuY2hvcj0ibWlkZGxlIiB4PSI4NSIgeT0iNDIuNSIgc3R5bGU9ImZpbGw6IzhjYjg4ZDtmb250LXdlaWdodDpib2xkO2ZvbnQtc2l6ZToxMnB4O2ZvbnQtZmFtaWx5OkFyaWFsLEhlbHZldGljYSxzYW5zLXNlcmlmO2RvbWluYW50LWJhc2VsaW5lOmNlbnRyYWwiPjE3MHg4NTwvdGV4dD48L3N2Zz4=" class="img-circle" style=" width: 70px; height: 70px;"></a></td>
              <td style="padding:15px">          
              <div style="margin-right: 100px;">
                <strong>have a table which is loaded with data via ajax asjdklfasjd</strong>
                <p><span>Logged on: Feb 13 2014</span> <span>Logged by: Abdul Jadid</span> </p>
              </div> 
              <p>That means that any event handlers bound to the elements during page load will not be applicable to the loaded data unless the event is delegated to a static parent element -- meaning that the element is never removed or replaced, and will exist indefinitely.</p>
              <p><span>Customer: UTM</span> <span>Status: Closed</span> </p>
              </td>
            </tr>
            <tr style="border-bottom:1px solid #ddd">
              <td style="width:50px"><a class="pull-left" href="#"><img class="media-object img-circle" src="../images/uploads/1390991603.jpg" alt="" style="width: 50px;height:50px"></a></td>
              <td style="padding:15px">          
              <div style="margin-right: 100px;">
                <strong>have a table which is loaded with data via ajax asjdklfasjd</strong>
                <p><span>Logged on: Feb 13 2014</span> <span>Logged by: Abdul Jadid</span> </p>
              </div> 
              <p>That means that any event handlers bound to the elements during page load will not be applicable to the loaded data unless the event is delegated to a static parent element -- meaning that the element is never removed or replaced, and will exist indefinitely.</p>
              <p><span>Customer: UTM</span> <span>Status: Closed</span> </p>
              </td>
            </tr>
            <tr style="border-bottom:1px solid #ddd">
              <td style="width:50px"><a class="pull-left" href="#"><img class="media-object img-circle" src="../images/uploads/1390991603.jpg" alt="" style="width: 50px;height:50px"></a></td>
              <td style="padding:15px">          
              <div style="margin-right: 100px;">
                <strong>have a table which is loaded with data via ajax asjdklfasjd</strong>
                <p><span>Logged on: Feb 13 2014</span> <span>Logged by: Abdul Jadid</span> </p>
              </div> 
              <p>That means that any event handlers bound to the elements during page load will not be applicable to the loaded data unless the event is delegated to a static parent element -- meaning that the element is never removed or replaced, and will exist indefinitely.</p>
              <p><span>Customer: UTM</span> <span>Status: Closed</span> </p>
              </td>
            </tr>
          </tbody></table>                
        </div>
          <blockquote>
          <p style="padding:5px">Showing 1 to 4 of 4 entries</p>
          </blockquote>   
          <div style="float:right;margin-top:-35px;">    
          <div class="btn-group ">
            <div class="btn-group dropup">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-cog"></i>
              </button>
              <ul class="dropdown-menu">
                <li><a href="#">Compact View</a></li>
                <li><a href="#">Details View</a></li>
              </ul>
            </div>
            <button id="first-top" class="btn  btn-small btn-default"><i class="icon-step-backward"></i> </button>
            <button id="prev-top" class="btn  btn-small btn-default"><i class=" icon-angle-left "></i> </button>
            <button id="next-top" class="btn  btn-small btn-default">   <i class="icon-angle-right"></i> </button>
            <button id="last-top" class="btn  btn-small btn-default">  <i class="icon-step-forward "></i> </button>
          </div>     
          </div>
        </div><!-- /.row -->


      </div><!-- /#page-wrapper -->
    <script src="../js/jquery.flot.js"></script>
    <script src="../js/jquery.flot.stack.js"></script>
    <script src="../js/jquery.flot.resize.js"></script>      
<script type="text/javascript">
$(function () {
            $.getJSON("../lookup/widget_json.php?begin="+ $('#today').val()+"&end="+$('#today').val(), function(json) {
                $('#open').html(json[0].open_date);
                $('#onsite').html(json[1].onsite_time);
                $('#pending').html(json[2].pending_time);
                $('#resolve').html(json[3].resolve_time);

          })

})
$('#reportrange').daterangepicker(
    {
      ranges: {
         'Today': [moment(), moment()],
         'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
         'Last 7 Days': [moment().subtract('days', 6), moment()],
         'Last 30 Days': [moment().subtract('days', 29), moment()],
         'This Month': [moment().startOf('month'), moment().endOf('month')],
         'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
      },
      startDate: moment(),
      endDate: moment()
    },
    function(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        // alert("Callback has fired: [" + start.format('YYYY-MM-D') + " to " + end.format('YYYY-MM-D') + "]");
        var begin = start.format('YYYY-MM-D');
        var end = end.format('YYYY-MM-D');
          $.getJSON("../lookup/widget_json.php?begin="+ begin+"&end="+end, function(json) {
                $('#open').html(json[0].open_date);
                $('#onsite').html(json[1].onsite_time);
                $('#pending').html(json[2].pending_time);
                $('#resolve').html(json[3].resolve_time);

          })

    }
);
  $('#btn-reportrange').click(function(){
    $('#div_reportrange').toggle();

  })






</script>
<script type="text/javascript">
          $(function () {


            // jQuery Flot Chart
            // var visits = [[1, 50], [2, 40], [3, 45], [4, 23],[5, 55],[6, 65],[7, 61],[8, 70],[9, 65],[10, 75],[11, 57],[12, 59]];
            // var visitors = [[1, 298], [2, 50], [3, 23], [4, 48],[5, 38],[6, 40],[7, 47],[8, 55],[9, 43],[10,50],[11,47],[12, 39]];
            var data = [];
var currnt_image_list = $('#project_list').val();
$.each(currnt_image_list.split(','), function(index, value) { 
  $.getJSON("../lookup/graph_json5.php?project="+value, function(json) {
                data.push(json);
 var plotarea = $("#statsChart");
            $.plot(plotarea , data,
           {
                              series: {
                                  lines: { show: true,
                                          lineWidth: 1,
                                          fill: true, 
                                          fillColor: { colors: [ { opacity: 0.1 }, { opacity: 0.13 } ] }
                                       },
                                  points: { show: true, 
                                           lineWidth: 2,
                                           radius: 3
                                       },
                                  shadowSize: 0,
                                  stack: true
                              },
                              grid: { hoverable: true, 
                                     clickable: true, 
                                     tickColor: "#f9f9f9",
                                     borderWidth: 0
                                  },
                              legend: {
                                      // show: false
                                      labelBoxBorderColor: "#fff"
                                  },  
                              colors: ["#a7b5c5", "#30a0eb"],
                              xaxis: {
                                  ticks: [[1, "JAN"], [2, "FEB"], [3, "MAR"], [4,"APR"], [5,"MAY"], [6,"JUN"], [7,"JUL"], [8,"AUG"], [9,"SEP"], [10,"OCT"], [11,"NOV"], [12,"DEC"]],
                                  font: {
                                      size: 12,
                                      family: "Open Sans, Arial",
                                      variant: "small-caps",
                                      color: "#697695"
                                  }
                              },
                              yaxis: {
                                  ticks:3, 
                                  tickDecimals: 0,
                                  font: {size:12, color: "#9da3a9"}
                              }
                           }            
        );
  });
});
// $.getJSON("lookup/graph_json3.php", function(json) {
//        //succes - data loaded, now use plot:
//            var plotarea = $("#statsChart");
//            var dataBar=json.dataBar;
//             var dataLine=json.dataLine;
//             data.push(json);

//     });
            // var plot = $.plot($("#statsChart"),[ { data: visits, label: "Signups"}, { data: visitors, label: "Visits" }], {
            //         series: {
            //             lines: { show: true,
            //                     lineWidth: 1,
            //                     fill: true, 
            //                     fillColor: { colors: [ { opacity: 0.1 }, { opacity: 0.13 } ] }
            //                  },
            //             points: { show: true, 
            //                      lineWidth: 2,
            //                      radius: 3
            //                  },
            //             shadowSize: 0,
            //             stack: true
            //         },
            //         grid: { hoverable: true, 
            //                clickable: true, 
            //                tickColor: "#f9f9f9",
            //                borderWidth: 0
            //             },
            //         legend: {
            //                 // show: false
            //                 labelBoxBorderColor: "#fff"
            //             },  
            //         colors: ["#a7b5c5", "#30a0eb"],
            //         xaxis: {
            //             ticks: [[1, "JAN"], [2, "FEB"], [3, "MAR"], [4,"APR"], [5,"MAY"], [6,"JUN"], [7,"JUL"], [8,"AUG"], [9,"SEP"], [10,"OCT"], [11,"NOV"], [12,"DEC"]],
            //             font: {
            //                 size: 12,
            //                 family: "Open Sans, Arial",
            //                 variant: "small-caps",
            //                 color: "#697695"
            //             }
            //         },
            //         yaxis: {
            //             ticks:3, 
            //             tickDecimals: 0,
            //             font: {size:12, color: "#9da3a9"}
            //         }
            //      });

            function showTooltip(x, y, contents) {
                $('<div id="tooltip">' + contents + '</div>').css( {
                    position: 'absolute',
                    display: 'none',
                    top: y - 30,
                    left: x - 50,
                    color: "#fff",
                    padding: '2px 5px',
                    'border-radius': '6px',
                    'background-color': '#000',
                    opacity: 0.80
                }).appendTo("body").fadeIn(200);
            }

            var previousPoint = null;
            $("#statsChart").bind("plothover", function (event, pos, item) {
                if (item) {
                    if (previousPoint != item.dataIndex) {
                        previousPoint = item.dataIndex;

                        $("#tooltip").remove();
                        var x = item.datapoint[0].toFixed(0),
                            y = item.datapoint[1].toFixed(0);

                        var month = item.series.xaxis.ticks[item.dataIndex].label;

                        showTooltip(item.pageX, item.pageY,
                                    item.series.label + " of " + month + ": " + y);
                    }
                }
                else {
                    $("#tooltip").remove();
                    previousPoint = null;
                }
            });
        });
</script>

<?
}else{
include ("../nav/access_denied.php");
}
include ("../nav/footer.php");
?>

