<?php
session_start();
$_SESSION['nav_level'] = "1";
$_SESSION['nav_title'] = "config";
include ("../nav/header.php");
if ($access_control == "true") {
?>
      <input type="hidden" id="rpt_page" value="1">
      <input type="hidden" id="srcht" value="">
      <input type="hidden" id="fltr2" value="">
      <input type="hidden" id="fltrt1" value="<?=$_SESSION['def_project']?>">
      <input type="hidden" id="fltrt2" value="">
      <input type="hidden" id="fltrt3" value="">
      <input type="hidden" id="fltrt4" value="">
      <input type="hidden" id="fltrt5" value="">
      <input type="hidden" id="fltrt6" value="">      
      <input type="hidden" id="srt" value="">        
      <?
      if(isset($_GET['app_no'])){
      $case_id     =   htmlspecialchars(trim($_GET['app_no']));
      ?>
      <div id="page-wrapper">
              <div class="panel-body">
                <div class="row">
                  <div class="col-lg-12">
                    <h1>Notification <small>Keep track of all incidents updates</small></h1>
                    <ol class="breadcrumb">
                      <li><a href=".."><i class="icon-dashboard"></i> Dashboard</a></li>
                      <li class=""><a href="../notification"><i class="icon-fire"></i> Notification</a></li>                      
                      <li class="active"><i class="icon-file-alt"></i> <?=$_GET['app_no']?></li>
                    </ol>
                  </div>
                </div><!-- /.row -->
                <div class="table-responsive" id="div_app_list">              
                <?
                include '../DB.php';
                                          $user     = $_SESSION['username'];

                $sqlquery = "SELECT case_id, status, user, seen, notification, IF (SUBSTRING(updates,1,2) = '1 ' OR SUBSTRING(updates,1,2) = '0 ',REPLACE (updates,'s',''),updates) updates ".
                            "FROM (SELECT case_id, code_name status, user, seen, CASE ".
                            "WHEN TIMESTAMPDIFF(MINUTE,date, NOW()) < 60 THEN CONCAT (TIMESTAMPDIFF(MINUTE,date, NOW()),' minutes ago') ".
                            "WHEN TIMESTAMPDIFF(HOUR,date, NOW()) < 24 THEN CONCAT (TIMESTAMPDIFF(HOUR,date, NOW()),' hours ago') ".
                            "WHEN TIMESTAMPDIFF(DAY,date, NOW()) < 30 THEN CONCAT (TIMESTAMPDIFF(DAY,date, NOW()),' days ago') ".
                            "WHEN TIMESTAMPDIFF(MONTH,date, NOW()) < 12 THEN CONCAT (TIMESTAMPDIFF(MONTH,date, NOW()),' months ago') ".                            
                            "ELSE CONCAT (TIMESTAMPDIFF(YEAR,date, NOW()),' years ago') ".  
                            "END updates,  DATE_FORMAT(date,'%d %b %Y %h:%i %p') notification ".
                            "FROM `notification` a, (SELECT * FROM `code_definition` WHERE code_cat = 'casestatus') b ".
                            "WHERE a.case_status =  b.code  and user ='$user' ".
                            "AND case_id ='$case_id' ".
                            "ORDER BY a.date DESC) a";
                            //echo $sqlquery;
                $result = mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query
                $num  = mysqli_num_rows($result);
                $i=0;

                ?>
                   <table id="datatables" class="ui-widget ui-widget-content  table table-hover">
                      <thead>
                      <tr>
                        <th style="width: 50px;">No </th>
                        <th>Incident ID </th>
                        <th>Status </th>
                        <th>Updates </th>
                        <th>User </th>                        
                      </tr>
                      </thead>
                    <tbody>
                    <?
                    while($row = mysqli_fetch_array($result)){
                        $i++;
                        echo      "<tr data=". $row['case_id']."><td>".$i."</td>";
                    ?>
                        <td><?=$row['case_id']?></td>                        
                        <td><?=$row['status']?></td>
                        <td><?=$row['updates']?></td>
                        <td><?=$row['user']?></td>

                        </tr><?
                    }
                    ?>                      

                    </tbody>
                   </table>
                </div>
            </div>
      </div><!-- /#page-wrapper -->
      <?
      }
      else{
        echo "<h1> No data selected</h1>";
      }
      ?>     


    <script type="text/javascript">
      $(document).ready(function(){
        $('#datatables').dataTable();
      })
      $(document).on('click', '#datatables tbody tr', function(){
            window.location.replace("../incident/view.php?app_no="+$(this).attr('data'));
      });
    </script>

<?php
}else{
?>
<div id="page-wrapper" class="panel-body">
  <div class="row">
    <div class="col-lg-12" style="padding:5px">
      <div class="alert alert-danger">
        <span style="font-size:20px;font-weight:bold"><i class="fa fa-exclamation-triangle"></i></span>
        <strong>Access Denied : </strong>You are not authorized to access this page.<br/>
        Please contact System Administrator for help.
      </div> 
    </div>
  </div>  
</div>   
<?php
}
include ("../nav/footer.php");
?>