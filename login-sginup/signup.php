<?PHP include("../config.php");
$errors = array();
$succeed=array();

// reg اسم الزر الي داخل الفورم --> ء
if (isset($_POST['reg'])) {
    // الداله ذي تستخدم للحمايه من المسافات والسلاش والخ
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $SECURITY_CODE = md5(date("h:i:s"));

 
    // نتأكد من تعبية الخانات في الفورم
    //  array_push() ادخال الاخطاء في الايرور مع شرح الخطء $errors array
    if (empty($username)) { array_push($errors, "اسم المستخدم مطلوب"); }
    if (empty($full_name)) { array_push($errors, "الاسم الكامل مطلوب"); }
    if (empty($email)) { array_push($errors, "الأيميل مطلوب"); }
    if (empty($password_1)) { array_push($errors, "كلمة المرور مطلوبة"); }

    if ($password_1 != $password_2) { array_push($errors, "تأكد من تطابق كلمة المرور"); }

  
    // تأكد من اسم المستخدم والاميل اذا موجوده بالفعل او لا 
    $user_check_query = "SELECT * FROM employee WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    
    if ($user) { // if user exists
      if ($user['username'] === $username) {
        array_push($errors, "اسم المستخدم موجود بالفعل ");
      }
  
      if ($user['email'] === $email) {
        array_push($errors, "البريد الالكتروني مستخدم ");
      }
    }


    // شروط كلمة السر
    $uppercase = preg_match('@[A-Z]@', $password_1);
    $lowercase = preg_match('@[a-z]@', $password_1);
    $number    = preg_match('@[0-9]@', $password_1);
    // $specialChars = preg_match('@[^\w]@', $password_1); <-- هذي حرف خاص مثل !@#$%^& ء

    if(!$uppercase || !$lowercase || !$number || strlen($password_1) < 8) {
        array_push($errors, "<br>يجب أن تتكون كلمة المرور من 8 أحرف على الأقل <br>
        ويجب أن تشتمل على حرف واحد كبير على الأقل ورقم واحد");
    }

    // وصلنا لمرحلة التسجيل بدون اي خطأ 
    if (count($errors) == 0) {
        $password =$password_1;
    
    $query="insert into employee(username, full_name, email, password, SECURITY_CODE) values('$username','$full_name','$email','$password','$SECURITY_CODE')";
        if(mysqli_query($conn, $query)){
            
            array_push($succeed,"تم إنشاء الحساب ");

        }else{
            array_push($errors,"خطاء");
        }
    }
  }
   
?>

<?php include("header.php");?>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">    
                    <style>.bg-login-image1{background:url(../img/logo2.png);
                            background-position:center;background-size:cover}</style>
                
                    <div class="col-lg-5 d-none d-lg-block bg-login-image1"></div>

                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">إنشاء حساب</h1>
                                <br>
                                <?php include("succeed.php"); ?>
                                <?php include("errors.php");?>
                            </div>
                            
                            <form class="user"  action="signup.php" method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="text-center form-control form-control-user" id="exampleUserName"
                                        name="username" placeholder="اسم المستخدم" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="text-center form-control form-control-user" id="exampleFullName"
                                        name="full_name" placeholder=" الاسم الكامل" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="text-center form-control form-control-user" id="exampleInputEmail"
                                    name="email" placeholder="البريد الألكتروني" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="text-center form-control form-control-user"
                                            id="exampleRepeatPassword" name="password_2" placeholder="تأكيد كلمة المرور" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="text-center form-control form-control-user"
                                            id="exampleInputPassword" name="password_1" placeholder="كلمة المرور" required>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary btn-user btn-block" name="reg" value="تسجيل" >
                            </form>
                            <hr>
                            <div class="text-center">
                            <a class="small" href="PasswordReset.php">نسيت كلمة المرور؟</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">هل تمتلك حساب بالفعل؟</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


<?php include("../footer.php");?>