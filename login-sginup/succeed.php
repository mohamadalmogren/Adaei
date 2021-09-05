<?php 
include("header.php");
if(count($succeed) > 0):?> 

    <div class= "succeed">
        <?php  foreach($succeed as $succeeded): ?>
            <div class="alert alert-success" role="alert">
                <?php  echo $succeeded ; ?>
            </div>    
        <?php endforeach ?>
    </div>
    <META HTTP-EQUIV='Refresh' CONTENT='2; url=login.php'>‏
<?php endif ?>

