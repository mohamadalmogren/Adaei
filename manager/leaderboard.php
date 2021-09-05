<?php include("../config.php");
 include("m_header.php"); ?>



<div class="main">
  <h1 class="colorT">لائحة المتصدرين</h1> 
  <table class="mid">
  
    <tr id="header-tr"> 
      <th> المركز</th> 
      <th> الاسم</th> 
      <th>النقاط</th>
      <th> القسم</th> 
    </tr> 
      
      <?php 
        $result = mysqli_query($conn, "SELECT * FROM employee where is_manager=0 and point>0 ORDER BY point DESC limit 10");
        $ranking = 1; 
        $quary=mysqli_query($conn, "SELECT * from department");
        while($row=mysqli_fetch_array($result)){
          echo "<tr>
          <td>{$ranking}</td> 
          <td>{$row['full_name']}</td>
          <td>{$row['point']}</td> ";
          
          foreach($quary as $data){
            $arr=explode(", ",$data['employee_ids']);
            
            if(in_array($row['id_employee'], $arr) === true){
              $dept_name= $data['name'];
              echo "<td>$dept_name</td>
              </tr>";                      
            }
          }
          $ranking++;   
        }
        
        ?> 
  </table>
</div>
  <?php include("../footer.php"); ?>
