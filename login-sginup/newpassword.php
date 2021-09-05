<?PHP    include("../config.php");
    $errors=array();
    $succeed=array();
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);
        if ($password_1 != $password_2) {
            array_push($errors, "لايوجد تطابق بين كلمة المرور وتأكيد كلمة المرور");
        }
        $uppercase = preg_match('@[A-Z]@', $password_1);
        $lowercase = preg_match('@[a-z]@', $password_1);
        $number    = preg_match('@[0-9]@', $password_1);

        if(!$uppercase || !$lowercase || !$number || strlen($password_1) < 8) {
            array_push($errors, "<br>يجب أن تتكون كلمة المرور من 8 أحرف على الأقل <br>
            ويجب أن تشتمل على حرف واحد كبير على الأقل ورقم واحد");
        }
        if (count($errors) == 0) {
            $newpassword=$password_1;
            $chech_email=mysqli_query($conn,"SELECT email from employee where email='$email'");
            if(mysqli_num_rows($chech_email)>0){

                $update="UPDATE  employee set password='$newpassword' WHERE email = '$email'";
                if(mysqli_query($conn,$update)){

                    array_push($succeed,"تم اعادة تعين كلمة المرور");

                }else{
                    array_push($errors,"خطاء");
                }
            }else{
                array_push($errors,"البريد الالكتروني غير صحيح");
            }
        }
    }
?>
<?php include("header.php");?>

<body class="bg-gradient-primary">

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
                                       <h1 class="h4 text-gray-900 mb-2">إعادة تعيين كلمة المرور</h1>
                                       <p class="mb-4">ادخل المعلومات التالية لكي يتم تغيير كلمة المرور</p>
                                       <?php include("errors.php");?>
                                        <?php include("succeed.php");?>
                                   </div>
                                   <form class="post" method="POST">
                                       
                                       <div class="form-group">
                                           <input type="password" class="text-center form-control form-control-user"
                                               placeholder="ادخل كلمة المرور الجديدة" name="password_1" required>
                                       </div>

                                       <div class="form-group">
                                       <input type="password" class="text-center form-control form-control-user"
                                               placeholder="تأكيد كلمة المرور" name="password_2" required>
                                       </div>

                                       <div class="form-group">
                                       <input type="email" class="text-center form-control form-control-user"
                                               placeholder="ادخل البريد الاكتروني" name="email" required>
                                       </div>

                                       <input type="submit" class="btn btn-primary btn-user btn-block" 
                                       value="اعادة تعيين كلمة المرور">
                                   </form>
                                 
                           </div>
                       </div>
                   </div>
               </div>

           </div>


<?php include("../footer.php");?>
