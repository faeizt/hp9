<?
session_start();
$_SESSION['nav_level'] = "1";
$_SESSION['nav_title'] = "inventory";

?>
         
                <?
            include '../../DB.php';

                  $sql="SELECT * FROM product p LEFT JOIN project j ON j.project_code = p.project_code ORDER BY product_id DESC";
                  if(isset($_POST['fltr'])){
                    $fltr = $_POST['fltr'];
                    $fltr = str_replace("^", "'", $fltr);
                    $sql="SELECT * FROM product p LEFT JOIN project j ON j.project_code = p.project_code where ".$fltr." ORDER BY product_id DESC";                                          
                  }
                  $result = mysqli_query($con,$sql);          //query

                  $query = "SELECT COUNT(*) as num FROM product";
                  if(isset($_POST['fltr'])){
                    $fltr = $_POST['fltr'];
                    $fltr = str_replace("^", "'", $fltr);
                    $query = "SELECT COUNT(*) as num FROM product where ".$fltr." ";
                  }             
                  //$test1 = mysqli_query($con,$query);
                  //$total_pages = mysqli_fetch_array($test1);
                  //$total_pages = $total_pages['num'];

                   // echo $query;

                  //$num  = mysqli_num_rows($result);

                  $i=0;?>
                    <table id="datatables" class="ui-widget ui-widget-content  table table-hover">
                      <thead>
                        <tr class="ui-widget-header ">
                          <th>No</th>
                          <th>client </th>
                          <th>Contract</th>
                          <th>Machine Type</th>
                          <th>Brand</th>
                          <th>Model</th>
<!--                           <th>Spec</th>
 -->                        </tr>
                      </thead>
                      <tbody>

                  <?
                  while ($row = mysqli_fetch_assoc($result)) {
                    $id           = $row["product_id"];
                    $client           = $row["client_code"];
                    $project          = $row["project_name"];
                    $product          = $row["product_type"];
                    $brand            = $row["brand"];
                    $model            = $row["model"];
                    $spec             = $row["spec"];
                    $i++;

                    ?>
                        <tr  data="<?=$id?>">
                          <td style="width:15px"><?=$i?></td>
                          <td><?=$client;?></td>
                          <td><?=$project;?></td>
                          <td><?=$product?></td>
                          <td><?=$brand?></td>
                          <td><?=$model?></td>
<!--                           <td><?=$spec?></td>
 -->                        </tr>
                  <?php 
                  } 

                  ?>
                        </tbody>
                        
                     </table>           

    <script type="text/javascript">
   // $('#div_app_list').load('app_list.php',function(responseTxt,statusTxt,xhr){
   //      // if(statusTxt=="success")             alert("External content loaded successfully!");
   //      if(statusTxt=="error")               alert("Error: "+xhr.status+": "+xhr.statusText);
   //  });
      $(document).ready(function(){
        // $('#datatables').dataTable();
        var dTable=$("#datatables").dataTable({
          "bProcessing":false,
          "bPaginate":true,
          "bRetrieve":false,
          "bFilter":true,
          "bJQueryUI":true,
          "bAutoWidth":false,
          "bInfo":true,
          "fnPreDrawCallback":function(){
              $("#datatables").hide();
              // $("#loading").show();
              // alert("Pre Draw");
          },
          "fnDrawCallback":function(){
              $("#datatables").show();
              
              // $("#loading").hide();
              // alert("Draw");
          },
          "fnInitComplete":function(){
              // alert("Complete");
              $("#datatables").show();
          }
        })        
      })
      $(document).on('click', '#datatables tbody tr', function(){
                  window.location.href="view.php?product_id="+$(this).attr('data');
            });
    </script>

<?
include ("../../nav/footer.php");
?>