<?php
include '../../DB.php'; //DB Connection String

if(isset($_GET['case_id'])){
  $case_id    =   htmlspecialchars(trim($_GET['case_id']));
  $sqlquery   =   "SELECT  remarks,resolution,DATE_FORMAT(open_date,'%d/%m/%Y %H:%i') status_open_date,DATE_FORMAT(onsite_time,'%d/%m/%Y %H:%i') status_onsite_time,DATE_FORMAT(pending_time,'%d/%m/%Y %H:%i') status_pending_time,DATE_FORMAT(resolve_time,'%d/%m/%Y %H:%i') status_resolve_time,`open_date`,`onsite_time`,pending_time,`resolve_time`,`close_date`,`resolution` FROM cases where case_id = '$case_id' ";
  // echo $sqlquery;
  $result     =   mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query
  // $row        =   mysqli_fetch_array( $result );
  $num        =   mysqli_num_rows($result);
  $row        = mysqli_fetch_array($result);?>                
                <div class="form-group">
                    <label class="col-sm-4 control-label">Choose Incident Status</label>            
                    <div class="col-sm-7">
                        <select id="status_list" class="form-control"></select>
                        <p class="help-block"></p>
                    </div>
                </div>    
                <div class="form-group hide" id="div_onsite_time" style="clear:both">
                    <label class="col-sm-4 control-label">Onsite Date & Time</label>            
                    <div class="col-sm-7">
                        <input type="text" id="status_onsite_time" value="<?=$row['status_onsite_time']?>" class="form-control">
                        <p class="help-block"></p>
                    </div>
                </div>   
                <div class="form-group hide" id="div_remarks" style="clear:both">
                    <label class="col-sm-4 control-label">Remarks</label>            
                    <div class="col-sm-7">
                        <textarea placeholder="Remarks" id="status_remarks" class="form-control" style="height:70px"> <?=$row['remarks']?></textarea>
                        <p class="help-block"></p>
                    </div>
                </div>   
                <div class="form-group hide" id="div_resolve_type" >
                    <label class="col-sm-4 control-label">Resolution Type</label>            
                    <div class="col-sm-7">
                        <select id="status_resolution_type" class="form-control">
                            <option> </option>
                            <option value="1">Phone Support</option>
                            <option value="2">Onsite Support</option>
                            <option value="3">Onsite Support with part replacement</option>

                        </select>
                        <p class="help-block"></p>
                    </div>
                </div>                                    
                <div class="form-group hide" id="div_resolve_time"  style="clear:both">
                    <label class="col-sm-4 control-label">Resolve Date & Time</label>            
                    <div class="col-sm-7">
                        <input type="text" id="status_resolve_time"  value="<?=$row['status_resolve_time']?>" class="form-control">
                        <p class="help-block"></p>
                    </div>
                </div>                                    
                <div class="form-group hide" id="div_resolution" style="clear:both">
                    <label class="col-sm-4 control-label">Resolution</label>            
                    <div class="col-sm-7">
                        <textarea placeholder="Resolution" id="status_resolution" class="form-control" style="height:70px"><?=$row['resolution']?></textarea>
                        <p class="help-block"></p>
                    </div>
                </div>                                                                 
                <script type="text/javascript">
                    $('#status_onsite_time').datetimepicker({
                         dateFormat: 'dd/mm/yy'
                    });                    
                    $('#status_resolve_time').datetimepicker({
                         dateFormat: 'dd/mm/yy'
                    });  
                    $('select#status_list').load('../lookup/status.php?selected=', function() {  })    

                    $('select#status_list').change(function(){
                        if ($(this).val() == "1") { $('#div_onsite_time').show('slow');$('#div_remarks').hide('slow');$('#div_resolve_type').hide('fast');$('#div_resolve_time').hide('fast');$('#div_resolution').hide('fast')}
                        if ($(this).val() == "3") { $('#div_remarks').show('slow'); $('#div_onsite_time').hide('slow');$('#div_resolve_type').hide('fast');$('#div_resolve_time').hide('fast');$('#div_resolution').hide('fast')}
                        if ($(this).val() == "4") { $('#div_onsite_time').show('fast');$('#div_remarks').hide('slow');$('#div_resolve_type').show('fast');$('#div_resolve_time').show('fast');$('#div_resolution').show('fast')}
                        if ($(this).val() == "5") { $('#div_onsite_time').show('fast');$('#div_remarks').hide('slow');$('#div_resolve_type').show('fast');$('#div_resolve_time').show('fast');$('#div_resolution').show('fast')}
                           
                    })                          
                </script>
                <?}?>