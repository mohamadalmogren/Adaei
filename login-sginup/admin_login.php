<?php
    include("../config.php");

    $error="";
    $class="";
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //something was posted
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        if(!empty($username) && !empty($password))
        {
            $stmt = $conn->prepare("select * from admin where username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt_result = $stmt->get_result();
            if($stmt_result->num_rows > 0) {
                $data = $stmt_result->fetch_assoc();
                if($data['password'] === $password){
                    header('Location: ../admin/department.php');
                    die;
                    
                }else{
                $error= "تاكد من كلمة المرور";
                $class="alert alert-danger";
                }
            }else{
                $error="تاكد من اسم المستخدم و كلمة المرور";
                $class="alert alert-danger";
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
                            background-position:center;background-size:cover}
                        </style>
                            <div class="col-lg-6 d-none d-lg-block bg-login-image1"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">مرحبا بك في موقع أدائي</h1>
                                        <p class="mb-4">صفحة الأدمن</p>

                                        <br> 
                                        <div class="<?php echo $class?>">
                                            <?php echo $error?>
                                        </div>

                                    </div>
                                    <form method="post">
                                        <div class="form-group">       
                                            <input type="text" name="username" class="text-center form-control form-control-user" 
                                            id="exampleInputText"  placeholder="اسم المستخدم" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="text-center form-control form-control-user"
                                                id="exampleInputPassword" placeholder="الرمز السري" required>
                                        </div>
                                        <br>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="تسجيل الدخول" >
                                        <br>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


<?php include("../footer.php");?>