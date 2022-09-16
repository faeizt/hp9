<style type="text/css">
  .bs-status {
  padding-left: 0;
  padding-bottom: 1px;
  margin-bottom: 20px;
  list-style: none;
  overflow: hidden;
  }
  #seven .label{ display:block; }
  #seven .bs-status li {
  float: left;
  min-height: 150px;
  padding: 10px;
  margin: 0 -1px -1px 0;
  font-size: 14px;
  line-height: 1.4;
  text-align: center;
  border: 1px solid #fff;
  }  
    
</style>
<?
include '../DB.php'; //DB Connection String

if(isset($_GET['case_id'])){
  $case_id    =   htmlspecialchars(trim($_GET['case_id']));
  $sqlquery   =   "SELECT  DATE_FORMAT(close_date,'%d/%m/%Y %H:%i') status_close_date, DATE_FORMAT(open_date,'%d/%m/%Y %H:%i') status_open_date,DATE_FORMAT(assign_time,'%d/%m/%Y %H:%i') status_assign_time,DATE_FORMAT(onsite_time,'%d/%m/%Y %H:%i') status_onsite_time,DATE_FORMAT(pending_time,'%d/%m/%Y %H:%i') status_pending_time,DATE_FORMAT(resolve_time,'%d/%m/%Y %H:%i') status_resolve_time,`open_date`,assign_time,`onsite_time`,pending_time,`resolve_time`,`close_date`,`resolution`,resolution_type,cd.code_name reso_type,sts FROM cases left join code_definition cd on cd.code_cat='resotype' and cd.code = cases.resolution_type  where case_id = '$case_id' ";
  // echo $sqlquery;
  $result     =   mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query
  // $row        =   mysqli_fetch_array( $result );
  $num        =   mysqli_num_rows( $result);
  $row        = mysqli_fetch_array($result);

if (($row['resolve_time']!="" && $row['resolution']!="" && $row['sts']=="4") ||  ($row['sts']=="5")) {?>
  <div style="clear:both;margin-top:40px;padding:10px;">
    <p><b>Resolution</b></p>  
    <div class="alert alert-success" style="">
    <i class="icon-ok-sign"></i>
      <?=$row['resolution']?>
    </div>    
    <div class="content"  style="float:left; margin-top:-20px" >
      <span class="label label-info"> Resolution Type  </span> &nbsp;<?=$row['reso_type']?>
    </div>                   
    <div class="content"  style="float:right; margin-top:-30px" >
      <span class="label label-success"><i class="icon-time"></i> Resolve Time  </span> &nbsp;<?=$row['status_resolve_time']?>
    </div>
  </div>
<?}
  ?>


  <div id="seven" style="clear:both;margin-top:0px;padding:10px;">

    <p><b>Incident Status</b></p>  
<ul class="bs-status">
    <?if ($row['open_date']!="") {?>
    <li class="col-xs-6 col-sm-3 " style="background:#F5F5F5"> 
      <div>
        <p style="font-size:15px"><span class="glyphicon glyphicon-fire"></span></p>
        <p><h3>Open</h3></p>
        
      </div>
      <div style="margin-top:28px">
        <span class="label label-warning" ><?=$row['status_open_date']?></span>
      </div>
        
    </li>      <?
    }?>   
    <?if ($row['assign_time']!="" || $row['sts']=="6") {?>   
    <li class="col-xs-6 col-sm-3 " style="background:#F5F5F5">
      <div>
      <p style="font-size:15px"><span class="glyphicon glyphicon-tint"></span></p>
      <p><h3>Assigned</h3></p>    
      </div>
      <div style="margin-top:28px">
      <span class="label label-info" ><?=$row['status_assign_time']?></span>
      </div>
    </li>      <?
    }?>            
    <?if ($row['onsite_time']!="" || $row['sts']=="1") {?>   
    <li class="col-xs-6 col-sm-3 " style="background: #F5F5F5;">
      <div>
      <p style="font-size:15px"><span class="glyphicon glyphicon-cog"></span></p>
      <p><h3>Work In Progress</h3></p>    
      </div>
      <div style="margin-top:28px">
      <span class="label label-info" ><?=$row['status_onsite_time']?></span>
      </div>
    </li>      <?
    }?>        

    <?if ($row['pending_time']!="" || $row['sts']=="3") {?>    
    <li class="col-xs-6 col-sm-3 " style="background: #F5F5F5;">
      <div>
      <p style="font-size:15px"><span class="glyphicon glyphicon-minus-sign"></span></p>
      <p><h3>Pending</h3></p>    
      </div>
      <div style="margin-top:28px">
      <span class="label label-danger" ><?=$row['status_pending_time']?></span>
      </div>
    </li><?
    }?>             
    <?if ($row['close_date']!="") {?>
    <li class="col-xs-6 col-sm-3 " style="background:#F5F5F5">
      <div>
      <p style="font-size:15px"><span class="glyphicon glyphicon-ok-sign"></span></p>
      <p><h3>Closed</h3></p>    
      </div>
      <div style="margin-top:28px">
      <span class="label label-primary"><?=$row['status_close_date']?></span>
      </div>
    </li><?
    }?>     
    </ul>
  </div>        

<?}?>