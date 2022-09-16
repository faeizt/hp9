<?
$date = date("Y-m-d");
$first_day_this_month = date('Y-m-01'); // hard-coded '01' for first day
$last_day_this_month  = date('Y-m-t');

$first_day = date('F 01, Y'); // hard-coded '01' for first day
$last_day  = date('F t, Y');
?>
<input type="hidden" id="today" value="<?=$date?>">

<?
session_start();
$_SESSION['nav_level'] = "1";
$_SESSION['nav_title'] = "report";
include ("../nav/header.php");
if ($access_control == "true") {

$project="";
$PAC  = 0;

foreach ($result_array as $results) {
  $PAC = $results['access'];
  if ($PAC & 8192) {
    $project = $project. "'" .$results['project_code'] . "',";
  }
}
$project = substr($project,0,-1);
// echo $project;
?><input type="hidden" id="project_list" value="<?=$project?>">
   <!-- Submenu Navigation -->
    <nav class="navbar  navbar-default" role="navigation">
      <div class="navbar-header visible-xs">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".submenu-colls">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>   
          <a class="navbar-brand" > <FONT color="3ca6fb">Submenu &nbsp;</FONT></a>
      </div>         
      <div id="myScrollspy" class="collapse navbar-collapse  submenu-colls" style="height:100%">
        <input type="hidden" id="begin_date" value="<?=$first_day_this_month?>">
        <input type="hidden" id="end_date" value="<?=$last_day_this_month?>">
        <input type="hidden" id="fltr">
        <ul class="nav navbar-nav-thin navbar-nav-thin-leftborder-dark vert-menu-border-dark navbar-user">
          <li class="dropdown user-dropdown">
            <select id="report_type" class="hide selectpicker " data-selected-text-format="count>3" title='Report Type'>
                <optgroup label="Report type"  >
                    <option selected>Incident</option>
                    <option >Project</option>
                    <option >Engineer</option>
                </optgroup>              
            </select>
          </li>
          <li>
            <select id="report_project" title="Project " class="hide selectpicker " multiple data-live-search="true" data-selected-text-format="count>1" data-size="20">
                <optgroup label="LHDN" data-subtext="Lembaga Hasil Dalam Negeri" >
                    <option value="LHDN01">Projek Sewaan PC Dell(T1650) &amp; Printer OKI</option>
                    <option value="LHDN02" >Projek Sewaan PC HP, Dell(T1600) &amp; Printer Samsung</option>
                </optgroup>   
                <optgroup label="MARA" data-subtext="Majlis Amarah Rakyat">
                    <option value="MARA01" >Projek Sewa PC MARA</option>
                </optgroup>    
                <optgroup label="KWP"  data-subtext="Kementerian Wilayah">
                    <option value="KWP01" >Projek Belian PC KWP</option>
                </optgroup>    
                <optgroup label="TM"  data-subtext="Telekom Malaysia">
                    <option value="TM01" >Projek TM</option>
                </optgroup>                                                                     
            </select>
          </li>            <li>
            <select title="Incident Status " id="report_status" class="hide selectpicker " multiple data-live-search="true" multiple data--text-format="count>3">
                <optgroup label="Incident Status" >
                    <option >Open</option>
                    <option >Engineer Onsite</option>
                    <option >Pending</option>
                    <option >Resolved</option>
                    <option >Closed</option>
                </optgroup>              
            </select>
          </li>
          <li>
            <select title="Engineer " id="report_engineer" class="hide selectpicker " multiple data-live-search="true"  data--text-format="count>3" >
                <optgroup label="Engineer" >
                    <option >Mohd Faeiz Bin Mohd Taib</option>
                    <option >Mahadir Abdul Muin</option>
                    <option >Mohd Azri Bin Abd Rahman</option>
                    <option >Mohamad Fairuz Bin Mohamad Ariffin</option>
                    <option >Mohd Mukhlis Bin Yaacob</option>
                </optgroup>              
            </select>
          </li>
        </ul>
        <ul class="nav navbar-right navbar-nav-thin navbar-nav-thin-leftborder-dark vert-menu-border-dark navbar-user">
          <li>
            <select title="Date Range " id="report_date" class="hide selectpicker " data-live-search="true" data--text-format="count>3">
                <optgroup label="Date Range" >
                    <option value="assign_time" >Assigned Date</option>
                    <option value="open_date" selected>Open Date</option>
                    <option value="onsite_time" >Onsite Date</option>
                    <option value="pending_time" >Pending Date</option>
                    <option value="resolve_time" >Resolved Date</option>
                    <option value="close_date" >Closed Date</option>
                </optgroup>              
            </select>
          </li>          
          <li id="reportrange" class=" date-picker"><a>
                    <i class="fa fa-calendar fa-lg"></i>
                    <span><?php echo $first_day ." - ". $last_day; ?></span> <b class="caret"></b></a>
          </li>

        </ul>          
      </div><!--/.nav-collapse -->
    </nav><!--/.navbar-default -->
    <!-- end of Submenu -->
    <div id="page-wrapper" class="panel-body">
      <div class="row">
        <div class="col-lg-12">
        <button id="btn_regen" class="pull-right btn btn-primary" style="margin-right:28px"><i class="fa fa-cog"></i> Regenerate Report</button>
            <div class="panel-body" style="clear:both">
          <!-- statistics chart built with jQuery Flot -->
          <div class="row chart" style="border: 1px solid #ccc;background-color: #fff;border-radius: 5px;opacity: 90%;">
              <div class="col-md-12">
              </div>
              <div class="col-md-12">
                  <div id="statsChart" style="height: 300px;"></div>
              </div>
          </div>
          <!-- end statistics chart -->
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">   
          <div class="table-responsive" id="div_app_list" style="">        </div>
        </div>
      </div><!-- /.row -->
    </div><!-- /#page-wrapper -->
    <style type="text/css">
      .media p{font-size: 11px}
      .media{clear: both}
    </style>

<script type="text/javascript" src="../js/bootstrap-select.js"></script>
<link rel="stylesheet" type="text/css" href="../css/bootstrap-select.css">
<script src="../js/jquery.flot.js"></script>
<script src="../js/jquery.flot.stack.js"></script>
<script src="../js/jquery.flot.resize.js"></script>      
<script src="../js/jquery.flot.axislabels.js"></script>      

<script type="text/javascript">
$.ajaxSetup({
  async: false
});
  $('#report_status').load('../lookup/status.php?selected=', function() {             
    $(this).selectpicker({
        'selectedText': 'cat'
    });
  })    
  $('#report_engineer').load('../lookup/engineer_report.php?selected=', function() {             
    $(this).selectpicker({
        'selectedText': 'cat'
    });
  })    
  $('#report_project').load('../lookup/project_report.php?client=&selected=', function() { 
    $(this).selectpicker({
        'selectedText': 'cat'
    });
  })    
  $('#report_type').selectpicker({
    'selectedText': 'cat'
  });
  $('#report_date').selectpicker({
    'selectedText': 'cat'
  });
// $('#div_app_list').load('app_list.php?fltr='+$('#project_list').val(),function(responseTxt,statusTxt,xhr){
//     // if(statusTxt=="success")             alert("External content loaded successfully!");
//     if(statusTxt=="error")               alert("Error: "+xhr.status+": "+xhr.statusText);
// });
var str_project = $('#project_list').val();
  var sql       = "";
  if (str_project != "")  sql = sql +"project_code in     (" + str_project +")";
  var date_type     = $('#report_date').val();
  var begin         = $('#begin_date').val();
  var end           = $('#end_date').val();
// alert(sql)
  $.ajax({
    async: "false",
    type: "POST",
    url: "app_list_compact.php",
    data: ({
        type       : ''  ,
        fltr       : ''  ,
        date_type  : date_type  ,
        begin      : begin  ,
        end        : end  
        }) ,

    success: function(data){
      if(data!=""){ 
        $('#div_app_list').html(data);

      }

      else{//true
            valid = false;
            alert('fail')
      }
    } 
  }); 

$('#btn_regen').click(function(){
  var str_project   = "";
  var str_engineer  = "";
  var str_status    = "";
  var project       = $('#report_project').val();
  var type          = $('#report_type').val();
  var status        = $('#report_status').val();
  var engineer      = $('#report_engineer').val();
  var date_type     = $('#report_date').val();
  var begin         = $('#begin_date').val();
  var end           = $('#end_date').val();
  if (project != null) {
    $.each(project, function( index, value ) {
      str_project =str_project+"'"+value+"',";
    });
    var lastIndex = str_project.lastIndexOf(",")
    var str_project = str_project.substring(0, lastIndex);       
  };
  if (engineer != null) {
    $.each(engineer, function( index, value ) {
      str_engineer =str_engineer+value+",";
    });
    var lastIndex = str_engineer.lastIndexOf(",")
    var str_engineer = str_engineer.substring(0, lastIndex);       
  };
  if (status != null) {
    $.each(status, function( index, value ) {
      str_status =str_status+value+",";
    });
    var lastIndex = str_status.lastIndexOf(",")
    var str_status = str_status.substring(0, lastIndex);       
  };


  var sql       = "";

  if (str_project != "")  sql = sql +"project_code in     (" + str_project +")";
  if (status != null) {
    if (sql != "") {sql = sql + " AND ";};
    sql = sql +" sts in (" + status.toString() +")"; 
  }
  if (engineer != null) {
    if (sql != "") {sql = sql + " AND ";};
    sql = sql +" engineer in (" + engineer.toString() +")"; 
  }
$('#fltr').val(sql);
  // alert(type);
  // alert(str_project);
  // alert(status);
  // alert(engineer);
  // alert(begin);
  // alert(end);
  // alert(sql)

  //load list
      $.ajax({
        async: "false",
        type: "POST",
        url: "app_list_compact.php",
        data: ({
            type       : type  ,
            fltr       : sql  ,
            date_type  : date_type,
            begin      : begin  ,
            end        : end  
            }) ,

        success: function(data){
          if(data!=""){ 
            $('#div_app_list').html(data);

          }

          else{//true
                valid = false;
                alert('fail')
          }
        } 
      }); 
//load graph
var data = [];
if (type=="Project") {//load graph based on project
  // alert(status);
  // alert(engineer);
  if (status != null) {
    if (sql != "") {sql = sql + " AND ";};
    sql = sql +" sts in (" + status.toString() +")"; 
  }
  if (engineer != null) {
    if (sql != "") {sql = sql + " AND ";};
    sql = sql +" engineer in (" + engineer.toString() +")"; 
  }
  if(project== null) {alert("Please choose project");return false;}
  $.each(project, function(index, value) { 
    $.getJSON("graph_json_project.php?report_type="+type+"&project="+value+"&status="+str_status+"&engineer="+str_engineer+"&date_type="+date_type+"&+begin="+begin+"&end="+end+"&sql="+sql, function(json) {
      data.push(json);
      // alert(JSON.stringify(json.xaxis))
      // alert(JSON.stringify(json.data))
      // alert(value)
      // var axis = [];
      // axis.push(json.xaxis);
      // alert(axis.toString()     )
      // alert(data)
      var plotarea = $("#statsChart");
        $.plot(plotarea , data,{//[ { label: json.label, data: json.data } ]
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
              axisLabel: json.xlabel,
              axisLabelUseCanvas: true,
              axisLabelFontSizePixels: 12,
              axisLabelFontFamily: "Open Sans, Arial, Helvetica, Tahoma, sans-serif",
              axisLabelPadding: 5,
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
              font: {size:12, color: "#9da3a9"},
              axisLabel: "No of incidents",
              axisLabelUseCanvas: true,
              axisLabelFontSizePixels: 12,
              axisLabelFontFamily: "Open Sans, Arial, Helvetica, Tahoma, sans-serif",
              axisLabelPadding: 5

          }
       });
      })    //end of $.plot
    })      //end of $.each
  }       // end of type project
if (type=="Engineer") {//load graph based on Engineer
  // alert(status);
  // alert(engineer);
  if (status != null) {
    if (sql != "") {sql = sql + " AND ";};
    sql = sql +" sts in (" + status.toString() +")"; 
  }
  if (str_project != "")  {
    if (sql != "") {sql = sql + " AND ";};
    sql = sql +"project_code in     (" + str_project +")";
  }
  //  var engineer_name ="";
  // $("#report_engineer option[1]:selected").each(function() {
  //  engineer_name = this.text;
  // });
  if(engineer== null) {alert("Please choose Engineer");return false;}

  $.each(engineer, function(index, value) { 
    // alert(value)
    $.getJSON("graph_json_engineer.php?report_type="+type+"&project="+str_project+"&status="+str_status+"&engineer="+value+"&date_type="+date_type+"&+begin="+begin+"&end="+end+"&sql="+sql, function(json) {
      data.push(json);
      // alert(JSON.stringify(json.xaxis))
      // alert(JSON.stringify(json.data))
      // alert(value)
      // var axis = [];
      // axis.push(json.xaxis);
      // alert(axis.toString()     )
      // alert(data)
      var plotarea = $("#statsChart");
        $.plot(plotarea , data,{//[ { label: json.label, data: json.data } ]
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
              axisLabel: json.xlabel,
              axisLabelUseCanvas: true,
              axisLabelFontSizePixels: 12,
              axisLabelFontFamily: "Open Sans, Arial, Helvetica, Tahoma, sans-serif",
              axisLabelPadding: 5,
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
              font: {size:12, color: "#9da3a9"},
              axisLabel: "No of incidents",
              axisLabelUseCanvas: true,
              axisLabelFontSizePixels: 12,
              axisLabelFontFamily: "Open Sans, Arial, Helvetica, Tahoma, sans-serif",
              axisLabelPadding: 5

          }
       });
      })    //end of $.plot
    })      //end of $.each
  }       // end of type project
  if (type=="Incident") {
    // alert(str_project)
    $.getJSON("graph_json.php?report_type="+type+"&project="+str_project+"&status="+str_status+"&engineer="+str_engineer+"&date_type="+date_type+"&+begin="+begin+"&end="+end+"&sql="+sql, function(json) {
      // alert(JSON.stringify(json.xaxis))
      // alert(JSON.stringify(json.data))
      // alert(value)
      // var axis = [];
      // axis.push(json.xaxis);
      // alert(axis.toString()     )
      // alert(data)
      data.push(json);
      var plotarea = $("#statsChart");
        $.plot(plotarea , data,{//[ { label: json.label, data: json.data } ]
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
              axisLabel: json.xlabel,
              axisLabelUseCanvas: true,
              axisLabelFontSizePixels: 12,
              axisLabelFontFamily: "Open Sans, Arial, Helvetica, Tahoma, sans-serif",
              axisLabelPadding: 5,
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
              font: {size:12, color: "#9da3a9"},
              axisLabel: "No of incidents",
              axisLabelUseCanvas: true,
              axisLabelFontSizePixels: 12,
              axisLabelFontFamily: "Open Sans, Arial, Helvetica, Tahoma, sans-serif",
              axisLabelPadding: 5

          }
      });
    })
  } //end of incident loading

  //load widget
})
            // $('.selectpicker').selectpicker({
            //     'selectedText': 'cat'
            // });


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
      startDate: moment().startOf('month'),
      endDate: moment().endOf('month')
    },
    function(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        // alert("Callback has fired: [" + start.format('YYYY-MM-D') + " to " + end.format('YYYY-MM-D') + "]");
        var begin = start.format('YYYY-MM-D');
        var end = end.format('YYYY-MM-D');
        $('#begin_date').val(begin);
        $('#end_date').val(end);
    }
);
  $('#btn-reportrange').click(function(){
    $('#div_reportrange').toggle();

  })






</script>
<script type="text/javascript">
          $(function () {


            // jQuery Flot Chart
            // var visits = [[3, 5], [4, 2], [5, 1], [6, 4], [7, 5]];
            // var visitors =[[3, "Week 3"], [4, "Week 4"], [5, "Week 5"], [6, "Week 6"], [7, "Week 7"]];
// var currnt_image_list = $('#project_list').val();
// $.each(currnt_image_list.split(','), function(index, value) { 
    var str_project   = "";
  var str_engineer  = "";
  var str_status    = "";
  var sql = "";
  var type      = $('#report_type').val();
  var date_type  = $('#report_date').val();
  var begin     = $('#begin_date').val();
  var end     = $('#end_date').val();
      // alert(str_project)

  $.getJSON("graph_json.php?report_type="+type+"&project="+str_project+"&status="+str_status+"&engineer="+str_engineer+"&date_type=open_date"+"&sql="+sql+"&begin="+begin+"&end="+end, function(json) {
     // alert(JSON.stringify(json.xaxis))

    // var axis = [];
    // axis.push(json.xaxis);
    // alert(axis.toString()     )
    // alert(data)
 var plotarea = $("#statsChart");
 $.plot(plotarea , [ { label: json.label, data: json.data } ], {
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
                                  axisLabel: "This Month",
                                  axisLabelUseCanvas: true,
                                  axisLabelFontSizePixels: 12,
                                  axisLabelFontFamily: "Open Sans, Arial, Helvetica, Tahoma, sans-serif",
                                  axisLabelPadding: 5,
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
                                  font: {size:12, color: "#9da3a9"},
                                  axisLabel: "No of incidents",
                                  axisLabelUseCanvas: true,
                                  axisLabelFontSizePixels: 12,
                                  axisLabelFontFamily: "Open Sans, Arial, Helvetica, Tahoma, sans-serif",
                                  axisLabelPadding: 20
                              }
                           }           
         );
  });
// });
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

