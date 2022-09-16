<?
include '../DB.php'; //DB Connection String

if(isset($_GET['case_id'])){
  $case_id    =   htmlspecialchars(trim($_GET['case_id']));
  $sqlquery   =   "SELECT *, DATE_FORMAT(c.date,'%d %b %Y') comment_date FROM comments c left join sys_users usr on c.user_id = usr.user_id where case_id = '$case_id' ";
  // echo $sqlquery;
  $result     =   mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query
  // $row        =   mysqli_fetch_array( $result );
  $num        =   mysqli_num_rows($result);}?>
  
<style type="text/css">
  .commentsdata td{ border:0px solid #f5f5f5; padding:5px;}
</style>

<div style="padding:10px">
  <div class="info">
    <span class="name"><i class="fa fa-comments"></i> 
      <strong class="indent">Comments</strong>
    </span>      
    <span class="badge pull-right label-warning"><?=$num?></span>     
  </div>


  <?
    while($row = mysqli_fetch_array($result)){?>
      <div class="content" style="margin-bottom:20px">
        <div class="media">
          <div style="margin-right: 100px;">
            <strong><?=$row['username']?></strong> <span class="label label-success"><?=$row['designation']?></span>
          </div>                
          <table class="commentsdata" style="width:100%;border-top: 1px dashed #ECF4F8;margin-top: 5px;width: 100%;">
            <tr>
              <td style="width:50px"><a class="pull-left" href="#"><img class="media-object" src="../images/uploads/<?=$row['profile_image']?>" alt="" style="width: 50px;"></a></td>
              <td><?=$row['comments']?></td>
              <td style="width: 50px;text-align: center;"><?=$row['comment_date']?></td>
            </tr>
          </table>                
        </div>          
      </div>
  <?}
  ?>
  <div style="margin-bottom:10px">
    <textarea id="comments"style="width:100%;border: 1px solid #f8f8f8;padding: 7px 8px;" placeholder="Place your comment here..."></textarea>
    <button id="btn_save_comments" type="button" class="btn btn-primary btn-xs pull-right" style="margin-top:10px">Post</button>
  </div>
  <hr>
<script type="text/javascript">
  $('#btn_save_comments').click(function(){
    if ($('#comments').val()=="") {alert('Oppss!!, Your comment should not be left empty.');return false;};
    $.ajax({
        type  :   "POST",
        url   :   "comments_add.php",
        data  :   ({
                case_id     :$('#case_id').val(),
                comments    :$('#comments').val(),

              }),
        async   :   false,
        success: function(result) {
          $('#Comments').load('comments.php?case_id='+$('#case_id').val(),function(){  })
        }
    }); 
  })
</script>
  </div>
