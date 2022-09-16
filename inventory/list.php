<?
session_start();
$_SESSION['nav_level'] = "1";
$_SESSION['nav_title'] = "inventory";

?>
         
                <?
                include '../DB.php';
                $sqlquery = "SELECT * FROM v_inventory order by id desc";
                if(isset($_POST['fltr'])){
                  $fltr = $_POST['fltr'];
                  $fltr = str_replace("^", "'", $fltr);
                  $sqlquery = "SELECT * FROM v_inventory  where ".$fltr." order by id desc";
                    
                }
                $result = mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query
                $query = "SELECT COUNT(*) as num FROM v_inventory";
                if(isset($_POST['fltr'])){
                  $fltr = $_POST['fltr'];
                  $fltr = str_replace("^", "'", $fltr);                  
                    $query = "SELECT COUNT(*) as num FROM v_inventory where ".$fltr;
                    
                }
                $total_pages = mysqli_fetch_array(mysqli_query($con,$query));
                $total_pages = $total_pages['num'];


                $num  = mysqli_num_rows($result);

                $i=0;?>
                   <table id="datatables" class="ui-widget ui-widget-content  table table-hover">
                      <thead>
                      <tr>
                        <th style="width: 50px;">No </th>
                        <th>Machine Type</th>
                        <th>Serial Number </th>
                        <th>Specification</th>
                        <th>Contract </th>
                      </tr>
                      </thead>
                    <tbody>
                    <?
                    while($row = mysqli_fetch_array($result)){
                        $i++;
                        echo      "<tr data=". $row['id']."><td>".$i."</td>";?>
                        <td><?=$row['machine_type']?></td>
                        <td><?=$row['sn']?></td>
                        <td><?=$row['ispec']?></td>
                        <td><?=$row['project_name']?></td>                        


                        </tr><?
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
            window.location.replace("view.php?id="+$(this).attr('data'));
      });
    </script>

<?
include ("../nav/footer.php");
?>