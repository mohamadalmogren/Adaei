<?php include("header.php");?>
<?php     include("../config.php");?>


<?php
    $succeed= array();
    $errors = array();

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $email=$_POST['EMAIL'];
       
        $username=$_POST['UN'];
        if(!empty($username) && !empty($email)){
            $quary="SELECT * FROM employee WHERE email = '$email' and username='$username' ";
            $result=mysqli_query($conn,$quary);
            if(mysqli_num_rows($result)>0){
                require_once 'mail.php';
                $user =$result -> fetch_object();
            $mail->addAddress($_POST['EMAIL']); 
            $mail->Subject = "reset password";
            $mail->Body    = '
            <p></p>
            <br>
            Reset your password
            '.' <a href="http://localhost/adaei/login-sginup/PasswordReset.php?username='.$_POST['UN'].'&email='.$_POST['EMAIL'].
            '&code='.$user -> SECURITY_CODE . '">here </a>';
            
            $mail->setFrom('adaeiservess@gmail.com', 'ADAEI');
            $mail->send();
            array_push($succeed, "تم ارسال رسالة اعادة تعيين كلمة المرور");
            }else{
                array_push($errors, "الايميل او اسم المستخدم غير موجود");

            }
        }
    }
        
?>
          

<?PHP 

if (!isset($_GET['code'])){
    

   ?><body class="bg-gradient-primary">

   <div class="container">

       <!-- Outer Row -->
       <div class="row justify-content-center">

           <div class="col-xl-10 col-lg-12 col-md-9">

               <div class="card o-hidden border-0 shadow-lg my-5">
                   <div class="card-body p-0">
                       <!-- Nested Row within Card Body -->
                       <div class="row">
                       <style>.bg-login-image1{background:url(../img/logo2.png);
                           background-position:center;background-size:cover}</style>
                           <div class="col-lg-6 d-none d-lg-block bg-login-image1"></div>
                           <div class="col-lg-6">
                               <div class="p-5">
                                   <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">تغيير كلمة المرور</h1>
                                        <p class="mb-4">هل نسيت كلمة المرور؟ ما عليك سوى إدخال عنوان بريدك الإلكتروني أدناه وسنرسل لك رابطًا لإعادة تعيين كلمة المرور الخاصة بك</p>
                                        <?php include("errors.php");?>
                                        <?php include("succeed.php");?>
                                    </div>
                                   <form class="post" method="POST">
                                       <div class="form-group">
                                           <input type="email" class="text-center form-control form-control-user"
                                               id="exampleInputEmail" aria-describedby="emailHelp"
                                               placeholder="أدخل بريدك الاكتروني هنا" name="EMAIL" required>
                                       </div>
                                       <div class="form-group">
                                           <input type="text" class="text-center form-control form-control-user"
                                               id="exampleInputUsername"
                                               placeholder="أدخل اسم المستخدم هنا" name="UN" required>
                                       </div>
                                       <input type="submit" class="btn btn-primary btn-user btn-block" 
                                       value="اعادة تعيين كلمة المرور">
                                   </form>
                                   <hr>
                                   <div class="text-center">
                               <a class="small" href="login.php">هل تمتلك حساب بالفعل؟</a>
                                  </div>
                                   <div class="text-center">
                                       <a class="small" href="signup.php">أنشئ حسابك</a>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>

           </div>
    <?php } 
elseif(isset($_GET['code']) &&  isset($_GET['username']) && isset($_GET['email'])){
    header("Location: newpassword.php");
}

?>