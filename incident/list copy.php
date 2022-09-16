<?
session_start();
$_SESSION['nav_level'] = "1";
$_SESSION['nav_title'] = "incident";

?>
         
                <?
                $sqlquery = "SELECT * FROM casesaddr where sts = '0' order by open_date desc";
                if(isset($_POST['fltr']) && ($_POST['fltr']!='')){
                  $fltr = $_POST['fltr'];
                  $fltr = str_replace("^", "'", $fltr);
                  $sqlquery = "SELECT * FROM casesaddr where ".$fltr." order by open_date desc";                
                   
                }                
                if (isset($_GET['date_type']) && isset($_GET['begin']) && isset($_GET['end'])) {
                  $date_type    = $_GET['date_type'];
                  $begin      = $_GET['begin'];
                  $end      = $_GET['end'];
                  $sqlquery   = "SELECT * FROM casesaddr where project_code in ($project_code) and $date_type between (STR_TO_DATE('$begin', '%Y-%m-%d')) AND DATE_ADD((STR_TO_DATE('$end', '%Y-%m-%d')), INTERVAL 1 DAY) order by open_date desc";
                }
                if (isset($_GET['projects']) ) {
                  $project_code=$_GET['projects'];
                  $sqlquery = "SELECT * FROM casesaddr where sts = '0' and project_code in ($project_code) order by open_date desc";               
                }
                //echo $sqlquery;
                include '../DB.php';
                $result = mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query

                $query = "SELECT COUNT(*) as num FROM casesaddr where sts='0'";
                if(isset($_POST['fltr']) && ($_POST['fltr']!='')){
                  $fltr = $_POST['fltr'];
                  $fltr = str_replace("^", "'", $fltr);                  
                    $query = "SELECT COUNT(*) as num FROM casesaddr where ".$fltr;
                    
                }                
                $total_pages = mysqli_fetch_array(mysqli_query($con,$query));
                $total_pages = $total_pages['num'];


                $num  = mysqli_num_rows($result);

                $i=0;?>
                   <table id="datatables" class="ui-widget ui-widget-content  table table-hover">
                      <thead>
                      <tr>
                        <th style="width: 50px;">No </th>
                        <th>Incident ID </th>
                        <th>Customer Name </th>
                        <th>Customer Contact </th>
                        <th>Status </th>
                        <th>Problem Title </th>
                        
                      </tr>
                      </thead>
                    <tbody>
                    <?
                    while($row = mysqli_fetch_array($result)){
                        $i++;
                        echo      "<tr data=". $row['case_id']."><td>".$i."</td>";?>
                        <td><?=$row['case_id']?></td>                        
                        <td><?=$row['caller']?></td>
                        <td><?=$row['contact']?></td>
                        <td><?=$row['sts']?></td>
                        <td><?=$row['title']?></td>
                        <td><?=$row['open_date']?></td>

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
            window.location.href = "view.php?app_no="+$(this).attr('data');
      });
    </script>

<?
include ("../nav/footer.php");
?>