<?php
session_start();
$_SESSION['nav_level'] = "1";
$_SESSION['nav_title'] = "calendar";
include ("../nav/header.php");
if ($access_control == "true") {
$project = "";
        foreach ($result_array as $results) {
          // echo $results['project_code'];
          $project = $project . "'" . $results['project_code'] . "',";
        }
        $project = $project . "'" . $_SESSION['username'] . "'";
                // $project =  substr($project,0,-1);
?>
<link href='../css/fullcalendar.css' rel='stylesheet' />
<link href='../css/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='../js/moment.js'></script>
<script src='../js/fullcalendar.js'></script>
    <script type="text/javascript" src="../js/jquery-ui-timepicker-addon.js"></script>

      <!-- Submenu Navigation -->
      <nav class="navbar navbar-default" role="navigation">
      <div class="navbar-header visible-xs">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".submenu-colls">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>   
          <a class="navbar-brand" href=""> <FONT color="3ca6fb">Submenu &nbsp;</FONT></a>

          </div>   
        <div id="myScrollspy" class="collapse navbar-collapse  submenu-colls">
          <ul class="nav navbar-nav-thin navbar-nav-leftborder-light vert-menu-border">
            <li id="btn_schedule_event"><a><span class="glyphicon glyphicon-plus"></span> Schedule Event</a></li>
          </ul>          
        </div><!--/.nav-collapse -->
      </nav><!--/.navbar-default -->
      <!-- end of Submenu -->

  <input type="hidden" id="project_code" value="<?=$project?>">
  <input type="hidden" id="username" value="<?=$_SESSION['username']?>">

<div id="page-wrapper">
  <div class="panel-body">
    <div class="row">
      <div class="col-lg-12">
        <ol class="breadcrumb">
          <li ><a href=""><i class="icon-cogs"></i> Calendar</a></li>
          <li class="active"><i class="fa fa-fw fa-user"></i> <?=$_SESSION['username']?></li>
        </ol>
      </div>
    </div><!-- /.row -->
    <div class="table-responsive" id="div_app_list">
      <?include '../DB.php';?>  
        <div class="modal fade" id="modal_schedule_event" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-tag"></span> Schedule Event</h4>
              </div>
              <div class="modal-body">
              	<input type="hidden" class="form-control" id="event_id">
                <div class="form-group">
                    <label class="col-sm-4 control-label"> Title</label>            
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="event_title">
                        <p class="help-block"></p>
                    </div>
                </div>       
                <div class="form-group">
                    <label class="col-sm-4 control-label"> Start</label>            
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="event_start">
                        <p class="help-block"></p>
                    </div>
                </div>   
                <div class="form-group">
                    <label class="col-sm-4 control-label"> End</label>            
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="event_end">
                        <p class="help-block"></p>
                    </div>
                </div>   
                <div class="form-group">
                    <label class="col-sm-4 control-label"></label>            
                    <div class="col-sm-7">
                        <input type="checkbox" class="" id="event_all_day" value="false"> All Day
                        <p class="help-block"></p>
                    </div>
                </div>                                                                                       
              </div>
              <div class="modal-footer" style="clear:both">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="btn_add_event" class="btn btn-primary">Add Event</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->       
<!--       <div id='script-warning'>
        <code>php/get-events.php</code> must be running.
      </div>
 -->
      <div id='loading'>loading...</div>
<div class="col-md-9  with-sidebar">
  <div class="row">

      <div id='calendar' class="col-xs-12 col-lg-12"></div>
  </div>
</div>   
<div class="col-md-3 form-sidebar">
          <p>Scheduled Events<hr/></p>
          <p>
              <ol id="events" type="1">
                <?php
              	$username=$_SESSION['username'];
                $sqlquery = "SELECT id,owner,title, DATE_FORMAT(BEGIN,'%d/%m/%Y') begin, DATE_FORMAT(END,'%d/%m/%Y') end FROM events where owner in ($project)";
                $result = mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query
                while($row = mysqli_fetch_array($result)){?>
                  <a style="cursor:pointer"><li id="<?=$row['id']?>"><?=$row['title']?> (<?=$row['begin']?>) - <?=$row['owner']?></li></a><?php
                }?>                               
              </ol>
          </p>  
          <p>
            <br/>
          </p>                        

        </div>	
</div>  
</div>
  </div>
</div><!-- /#page-wrapper -->

<script type="text/javascript">
      $('#btn_schedule_event').click(function(){
            $('#event_id').val('');
            $('#event_title').val('');
            $('#event_start').val('');
            $('#event_end').val('');

      })
  $('#events li').click(function(){
  		var id = $(this).attr('id');
  		// alert(id)
        var msg = '<i class="fa fa-info-circle"></i> What you would like to do with the event?\n'+$(this).html();
        var div = $("<div>" + msg + "</div>");
        div.dialog({
            title: "Confirm Event",
            modal:true,
            buttons: [
                        {
                            text: "Update",
                            click: function () {
					            $.ajax({
					              async: "false",
					              type: "POST",
					              url: "event_id.php",
					              dataType: "json",
					              data: ({
					                      id        : id
				                    }) ,

					              success: function(json){
					                if(json=="false"){ 
					                  alert('Oppss!! Unable to get event.');
					                }
					                else{
					                	// alert('hello')
										$.each(json, function(idx, obj) {
											$('#event_id').val(obj.id);
											$('#event_title').val(obj.title);
											$('#event_start').val(obj.start);
											$('#event_end').val(obj.end);
				                            $('#modal_schedule_event').modal('show');
										});
					                }
					              }
					            });                                	
	                            div.dialog("close");
                            }
                        },
                        {
                            text: "Remove",
                            click: function () {
									        var msg = '<i class="fa fa-info-circle"></i> Are you sure to remove the event?';
									        var div = $("<div>" + msg + "</div>");
									        div.dialog({
									            title: "Confirm Remove",
									            modal:true,
									            buttons: [
									                        {
									                            text: "Yes",
									                            click: function () {
															      $.ajax({
															        async: "false",
															        type: "POST",
															        url: "remove_event.php",
															        data: ({
															                id        : id															              }) ,

															        success: function(auth){
															          // alert(auth)
															          if(auth=="false"){ 
															            alert('Oppss!! Unable to remove event.');
															          }
															          else{
															            
											                              window.location.reload(true);
															          }
															        }
															      });    									                            	
									                            }
									                        },
									                        {
									                            text: "No",
									                            click: function () {
									                                div.dialog("close");
									                            }
									                        }
									                    ]
									        });

                            }
                        },
                        {
                            text: "Cancel",
                            click: function () {
                                div.dialog("close");
                            }
                        }
                    ]
        });

  });        
  $('#btn_schedule_event').click(function() {
    $('#modal_schedule_event').modal('show');
  });  
  $('#event_start').datetimepicker({
     dateFormat: 'dd/mm/yy'
  });      
  $('#event_end').datetimepicker({
     dateFormat: 'dd/mm/yy'
  });     
  $('#event_all_day').change(function(){
      if($(this).is(':checked')) {
         $(this).val('true')
      } else {
          $(this).val('false')
      }
      // alert($(this).val())
  });

  $('#btn_add_event').click(function(){
    if ( (typeof $("#event_title").val() === "undefined") || ($("#event_title").val() === null) || ($("#event_title").val()=="")) {alert('Oppss!! Event title should not be left empty.');return false;};
      $.ajax({
        async: "false",
        type: "POST",
        url: "add_event.php",
        data: ({
                id        : $("#event_id").val() ,
                project   : $('#username').val(),
                title     : $('#event_title').val(),
                begin     : $("#event_start").val() ,
                end       : $("#event_end").val() ,
                allDay    : $("#event_all_day").val() 
              }) ,

        success: function(auth){
          // alert(auth)
          if(auth=="false"){ 
            alert('Oppss!! Unable to add event.');
          }
          else{
            var project   =$('#project_code').val();
            window.location.reload(true);
     
            // $('#modal_schedule_event').modal('hide');

          }
        }
      });    

  });    
// function addCalanderEvent(id, start, end, title, colour)
// {
//     var eventObject = {
//     title: title,
//     start: start,
//     end: end,
//     id: id,
//     color: colour
//     };

//     $('#calendar').fullCalendar('renderEvent', eventObject, true);
//     return eventObject;
// }
    /*
      jQuery document ready
    */
    
    $(document).ready(function()
    {
      /*
        date store today date.
        d store today date.
        m store current month.
        y store current year.
      */
      var date = new Date();
      var d = date.getDate();
      var m = date.getMonth();
      var y = date.getFullYear();
      
      /*
        Initialize fullCalendar and store into variable.
        Why in variable?
        Because doing so we can use it inside other function.
        In order to modify its option later.
      */
      
      var calendar = $('#calendar').fullCalendar(
      {
        /*
          header option will define our calendar header.
          left define what will be at left position in calendar
          center define what will be at center position in calendar
          right define what will be at right position in calendar
        */
        header:
        {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek,agendaDay'
        },
        /*
          defaultView option used to define which view to show by default,
          for example we have used agendaWeek.
        */
        defaultView: 'month',
        /*
          selectable:true will enable user to select datetime slot
          selectHelper will add helpers for selectable.
        */
        selectable: true,
        selectHelper: true,
        /*
          when user select timeslot this option code will execute.
          It has three arguments. Start,end and allDay.
          Start means starting time of event.
          End means ending time of event.
          allDay means if events is for entire day or not.
        */
        select: function(start, end, allDay)
        {
          calendar.fullCalendar('unselect');
        },
        eventClick: function(event, calEvent, minuteDelta, allDay,jsEvent, view) {
          // alert('edit event '+ event.start)
        },

        eventDragStart: function(event, jsEvent, ui, view) {
        },
        eventDragStop: function(event, jsEvent, ui, view) {
          // alert('DRAG STOP ' + event.title);
        },
        /*
          editable: true allow user to edit events.
        */
        editable: false,
        /*
          events is the main option for calendar.
          for demo we have added predefined events in json object.
        */
      events: {
        url: 'events.php?project_code='+$('#project_code').val(),
        error: function() {
          $('#script-warning').show();
        }
      },
      loading: function(bool) {
        $('#loading').toggle(bool);
      }
      });
      
    });

  </script>

<?php
}else{
include ("../nav/access_denied.php");
}
include ("../nav/footer.php");
?>