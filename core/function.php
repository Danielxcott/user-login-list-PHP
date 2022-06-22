<?php 
require_once "base.php";

//Common Start
function redirect($l){
    header("location:$l");
}

function location($l){
    echo "<script>location.href='$l'</script>";
}

function oldData($inputname){
    if(isset($_POST[$inputname])){
        return $_POST[$inputname];
    }else{
        return "";
    }
}

function filterText($txt){
    $txt = trim($txt);
    $txt = htmlentities($txt,ENT_QUOTES);
    $txt = stripslashes($txt);
    return $txt;
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function runQuery($sql){
    $con = connSql();
    if( mysqli_query($con,$sql)){
        return true;
    }else{
        die("query fail: ".mysqli_error($con));
    }
}

function fetchall($sql){
    $query = mysqli_query(connSql(),$sql);  
    $rows = [];
    while($row = mysqli_fetch_assoc($query)){
        array_push($rows,$row);
    }  
    return $rows;
}

//Common End

//Error Start
function setError($inputname,$message){
    $_SESSION['error'][$inputname] = $message;
}

function getError($inputname){
    if(isset($_SESSION['error'][$inputname])){
        return $_SESSION['error'][$inputname];
    }else{
        return "";
    }
}

function clearError(){
    $_SESSION['error']=[];
}
//Error End


//Validation Start
function register(){
    $errorStatus = 0;
    $name ="";
    $email = "";
    $password ="";
    $cpassword="";
    $image="";
    $phone="";
    $gender="";

    //username
    if(empty($_POST['name'])){
        setError("name","Name is required.");
        $errorStatus = 1;
    }else{
        if(strlen($_POST['name']) < 4){
            setError("name","Name is too short.");
            $errorStatus = 1;
        }else{
            if(strlen($_POST['name']) > 20){
                setError("name","Name is too long.");
                $errorStatus = 1;
            }else{
                if (!preg_match("/^[a-zA-Z ]*$/",$_POST['name'])) {
                    setError("name","Only letters and white space allowed");
                    $errorStatus =1;
                }else{
                    $name = filterText($_POST['name']);
                }
            }
        }
    }
    //email
    if(empty($_POST['email'])){
        setError("email","Email is required.");
        $errorStatus = 1;
    }else{
        if(!preg_match('~@gmail\.com$~',$_POST['email'])){
        setError("email",'Email format is incorrect, we only accept gmail.');
        $errorStatus = 1;
        }else{
            $email = filterText($_POST['email']);
        }
    }
    //password
    if(empty($_POST['password'])){
        setError('password',"Password should require.");
        $errorStatus = 1;
    }else{
        $passwordd = test_input($_POST["password"]);
        if(strlen($_POST['password']) <= 8){
            setError("password","Your Password Must Contain At Least 8 Characters!");
            $errorStatus = 1;
        }elseif(!preg_match("#[0-9]+#",$passwordd)){
            setError("password","Your Password Must Contain At Least 1 Number!");
            $errorStatus = 1;
        }
        elseif(!preg_match("#[A-Z]+#",$passwordd)) {
            setError("password","Your Password Must Contain At Least 1 Capital Letter!");
            $errorStatus = 1;
        }
        elseif(!preg_match("#[a-z]+#",$passwordd)) {
            setError("password","Your Password Must Contain At Least 1 Lowercase Letter!");
            $errorStatus = 1;
        }else{
        $password = $_POST['password'];
        }
    }
    //cpassword
    if(empty($_POST['cpassword'])){
        setError('cpassword',"Confirm password should require.");
        $errorStatus = 1;
    }else{
        $cpasswordd = test_input($_POST["cpassword"]);
        if(strlen($_POST['cpassword']) <= 8){
            setError("cpassword","Your Confirm Password Must Contain At Least 8 Characters!");
            $errorStatus = 1;
        }elseif(!preg_match("#[0-9]+#",$cpasswordd)){
            setError("cpassword","Your Confirm Password Must Contain At Least 1 Number!");
            $errorStatus = 1;
        }
        elseif(!preg_match("#[A-Z]+#",$cpasswordd)) {
            setError("cpassword","Your Confirm Password Must Contain At Least 1 Capital Letter!");
            $errorStatus = 1;
        }
        elseif(!preg_match("#[a-z]+#",$cpasswordd)) {
            setError("cpassword","Your Confirm Password Must Contain At Least 1 Lowercase Letter!");
            $errorStatus = 1;
        }else{
        $cpassword = $_POST['cpassword'];
        }
    }
    //phone
     if(empty($_POST['number'])){
        setError('phone','Number is required');
        $errorStatus = 1;
    }else{
        if(!preg_match('/^[0-9]{11}+$/',$_POST['number'])){
            setError('phone','Enter number format is incorrect');
            $errorStatus = 1;
        }else{
            $phone = filterText($_POST['number']);
        }
    }
    //image
    global $imageAccept;
    if(isset($_FILES['image']['name'])){
        $tmpFile = $_FILES['image']['tmp_name'];
        $filename = $_FILES['image']['name'];
        if(in_array($_FILES['image']['type'],$imageAccept)){
            $saveFolder = "assets/img/store/";
            move_uploaded_file($tmpFile,$saveFolder.$filename);
            $image = $_FILES['image']['name'];
        }else{
            setError("image","This type of file is not supported!");
            $errorStatus = 1;
        }
    }else{
        setError("image","File is required."); 
            $errorStatus = 1;
    }
    //gender
    global $genderArr;
    if(empty($_POST['gender'])){
        setError("gender","Gender is required.");
        $errorStatus = 1;
    }else{
        if(!in_array($_POST['gender'],$genderArr)){
            setError('gender','Editing gender is not allowed!');
            $errorStatus = 1;
            }else{
                $gender = filterText($_POST['gender']);
            }
    }

    if(!$errorStatus){
        // print_r($_POST);
        // print_r($_FILES);
        return true;
        // acceptRegister();
    }
}

function login(){
    $errorStatus = 0;
    $email = "";
    $password ="";
      //email
      if(empty($_POST['email'])){
        setError("email","Email is required.");
        $errorStatus = 1;
    }else{
        if(!preg_match('~@gmail\.com$~',$_POST['email'])){
        setError("email",'Email format is incorrect, we only accept gmail.');
        $errorStatus = 1;
        }else{
            $email = filterText($_POST['email']);
        }
    }
    //password
    if(empty($_POST['password'])){
        setError('password',"Password should require.");
        $errorStatus = 1;
    }else{
        $passwordd = test_input($_POST["password"]);
        if(strlen($_POST['password']) <= 8){
            setError("password","Your Password Must Contain At Least 8 Characters!");
            $errorStatus = 1;
        }elseif(!preg_match("#[0-9]+#",$passwordd)){
            setError("password","Your Password Must Contain At Least 1 Number!");
            $errorStatus = 1;
        }
        elseif(!preg_match("#[A-Z]+#",$passwordd)) {
            setError("password","Your Password Must Contain At Least 1 Capital Letter!");
            $errorStatus = 1;
        }
        elseif(!preg_match("#[a-z]+#",$passwordd)) {
            setError("password","Your Password Must Contain At Least 1 Lowercase Letter!");
            $errorStatus = 1;
        }else{
        $password = $_POST['password'];
        }
    }

    if(!$errorStatus){
        return true;
    }
}
//Validation End

//auth start
function acceptRegister(){
    $name =$_POST['name'];
    $email = $_POST['email'];
    $password =$_POST['password'];
    $cpassword=$_POST['cpassword'];
    $image=$_FILES['image']['name'];
    $phone=$_POST['number'];
    $gender=$_POST['gender'];
    if($password == $cpassword){
        $sPass = password_hash($password,PASSWORD_DEFAULT); //change their password into encrypt code and then send it to database
        $sql = "INSERT INTO users(name,email,password,profile,phone,gender) VALUES ('$name','$email','$sPass','$image','$phone','$gender')";
        // die($sql);
        if(runQuery($sql)){
         redirect("login.php");
        }
        // mysqli_query(connSql(),$sql);

    }else{
        setError('password',"check the password and email again!");
        setError('cpassword',"check the password and email again!");
        setError('email',"check the password and email again!");
    }

}

function acceptLogin(){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $query = mysqli_query(connSql(),$sql);
    $row = mysqli_fetch_assoc($query);

    if(!$row){
        setError('email','check the password and email again!');
        setError('password',"check the password and email again!");
    }else{
        if(!password_verify($password,$row['password'])){
            setError('email','check the password and email again!');
            setError('password',"check the password and email again!");
        }else{
            session_start();
            $_SESSION['user'] = $row;
            redirect("index.php");
        }
    }
}
//auth end

//User List Start
function alluser(){
    $sql = "SELECT * FROM users";
   return fetchall($sql);
}
function deleteUser($id){
    $sql = "DELETE FROM users WHERE id = $id";
    return runQuery($sql);
}
//User List End
