<?php
session_start();
$_SESSION['nav_level'] = "0";
$_SESSION['nav_title'] = "dashboard";

include ("nav/header.php");
if ($access_control == "true") {?>

<style type="text/css">
  #statsChart {
  height: 300px;
  margin-top: 0px;
  margin-bottom:   20px;
  }
</style>
      <div id="page-wrapper" class="panel-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="page-title">
              <ol class="breadcrumb_date">
                <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
                <li class="pull-right" style="margin-top: 0px;">
                      <i class="fa fa-calendar fa-lg"></i>
                      <span><?php echo date("F j, Y"); ?></span> 
                </li>
              </ol>
     
            </div>
          </div>
        </div><!-- /.row -->

        <div class="row">
          <div class="col-lg-12">
            <div class="panel-body">
            <!-- statistics chart built with jQuery Flot -->
            <div class="row chart" style="border: 1px solid #ccc;background-color: #fff;border-radius: 5px;opacity: 90%;">
                <div class="col-md-12">
                    <h3 class="clearfix pull-left">
                        Incidents For Year <?=$year?>
                    </h3>
                </div>
                <div class="col-md-12">
                    <div id="statsChart"></div>
                </div>
            </div>
            <!-- end statistics chart -->
            </div>
          </div>
        </div><!-- /.row -->
        <div class="alert alert-info">
            <font style="font-size:18px"><i class="fa fa-info-circle "></i> </font>
              Detail report generation can be done in <strong><a href="report/">Report</a></strong> section.
        </div>            
        <div class="row">
          <div class="col-lg-3">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-2">
                    <i class="fa fa-tint fa-5x"></i>
                  </div>
                  <div class="col-xs-10 text-right"><p class="announcement-heading" id="onsite">0</p></div>
                  <div class="col-xs-12 text-right"><p class="announcement-text">In Progress Incidents</p></div>

                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="panel panel-warning">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-2">
                    <i class="fa fa-fire fa-5x"></i>
                  </div>
                  <div class="col-xs-10 text-right"><p class="announcement-heading" id="open">0</p></div>
                  <div class="col-xs-12 text-right"><p class="announcement-text">Waiting for support</p></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="panel panel-danger">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-2">
                    <i class="fa fa-minus-circle fa-5x"></i>
                  </div>
                  <div class="col-xs-10 text-right"><p class="announcement-heading" id="blocked">0</p></div>
                  <div class="col-xs-12 text-right"><p class="announcement-text">Blocked / Pending Incidents</p></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="panel panel-success">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-2">
                    <i class="fa fa-check fa-5x"></i>
                  </div>
                  <div class="col-xs-10 text-right"><p class="announcement-heading" id="resolve">0</p></div>
                  <div class="col-xs-12 text-right"><p class="announcement-text">Resolved Incidents</p></div>

                </div>
              </div>
            </div>
          </div>
        </div><!-- /.row -->
        <div class="row">
          <div class="col-lg-12">   
            <div class="panel panel-default chat">
              <div class="panel-heading">
                Latest Incidents Reported
                <hr/>
              </div>
              <div class="table-responsive panel-body" id="div_app_list"></div>
            </div>
          </div>
        </div><!-- /.row -->


        <div class="row">
          <div class="col-lg-7">
            <div class="panel panel-default chat">
              <div class="panel-heading">
                Recent Comments
                <hr/>
              </div>
              <div class="panel-body" id="Comments"></div>
            </div>
          </div>

          <div class="col-lg-5  ">
            <div class="panel panel-default articles">
              <div class="panel-heading">
                Upcoming Events
                <hr/>
              </div>
                  <?php
                  $username=$_SESSION['username'];
                  $sqlquery = "SELECT id,owner,title, DATE_FORMAT(BEGIN,'%d/%m/%Y') begin, DATE_FORMAT(END,'%d/%m/%Y') end FROM events where begin > now()";
                  $result = mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query
                  while($row = mysqli_fetch_array($result)){?>
                    <!--                  <a style="cursor:pointer"><li id="<?=$row['id']?>"><?=$row['title']?> (<?=$row['begin']?>) - <?=$row['owner']?></li></a>-->
                    <div class="panel-body articles-container">
                    <div class="article border-bottom">
                    <div class="col-xs-12">
                      <div class="row">
                        <div class="col-xs-2 col-md-2 date">
                          <?=$row['begin']?>
                        </div>
                        <div class="col-xs-10 col-md-10">
                          <p><?=$row['title']?></p>
                        </div>
                      </div>
                    </div>
                    <div class="clear"></div>
                  </div>                                        
                  <?php
                  }?>                               
              </div>
            </div>          
          </div>
        </div><!-- /.row -->

      </div><!-- /#page-wrapper -->
      
<script src="js/jquery.flot.js"></script>
<script src="js/jquery.flot.stack.js"></script>
<script src="js/jquery.flot.resize.js"></script>      
<script type="text/javascript">

$('#div_app_list').load('app_list_compact.php?projects='+$('#project_code_list').val(),function(){  });
$('#Comments').load('comments.php?case_id='+$('#case_id').val(),function(){  });

$.ajaxSetup({
  async: false
});

$(function () {
  $.getJSON("lookup/widget_json.php?project_code="+$('#project_code_list').val()+"&begin="+ $('#today').val()+"&end="+$('#today').val(), function(json) {
      $('#open').html(json[0].open);
      $('#onsite').html(json[1].inprogress);
      $('#pending').html(json[2].waiting);
      $('#blocked').html(json[3].asdfa);
      $('#resolve').html(json[4].asdf);
  })
})

$(function () {
  var str_project       = "";
  var str_engineer      = "";
  var str_status        = "";
  var sql               = "";
  var type              = "";
  var date_type         = "";
  var data              = [];
  var currnt_image_list = $('#project_list').val();
  var begin             = $('#begin_date').val();
  var end               = $('#end_date').val();

  $.each(currnt_image_list.split(','), function(index, value) { 
    $.getJSON("lookup/graph_json_project.php?report_type="+type+"&project="+value+"&status="+str_status+"&engineer="+str_engineer+"&date_type=open_date"+"&sql="+sql+"&begin="+begin+"&end="+end, function(json) {
      // alert(JSON.stringify(json.data))
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
                ticks: json.xaxis,
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
         });
      });
    });
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

<?php
}else{
include ("nav/access_denied.php");
}
include ("nav/footer.php");
?>

