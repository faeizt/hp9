<?php
include 'DB.php'; //DB Connection String

  $sqlquery   =   "SELECT *,getDateDiff(UNIX_TIMESTAMP(now()) - UNIX_TIMESTAMP(date)) dur,u.profile_image profile_image  FROM comments c left join  sys_users u on c.user_id= u.user_id order by date desc LIMIT 0, 5;";
  // echo $sqlquery;
  $result     =   mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query
  // $row        =   mysqli_fetch_array( $result );
  $num        =   mysqli_num_rows($result);?>
  
  <?
    while($row = mysqli_fetch_array($result)){?>
      <div class="content" style="margin-bottom:20px">
        <div class="media">
          <div style="margin-right: 100px;">
            
          </div>                
          <table class="commentsdata" >
            <tr>
              <td style="width:100px"><a class="pull-center" href="#"><img class="media-object img-circle" src="images/uploads/<?=$row['profile_image']?>" alt="" style="width: 50px;"></a></td>
              <td style="width: 100%;"><?=$row['comments']?>
                <br/>
                <span style="font-size: 12px; color:grey">-<?=$row['username']?> on <?=$row['case_id']?>
                <span class=pull-right>
                  <i class="icon-time"></i> <?=$row['dur']?>
                </span>
              </td>
            </tr>
          </table>                
        </div>          
      </div>
  <hr>
      <?}
  ?>      

  </div>

