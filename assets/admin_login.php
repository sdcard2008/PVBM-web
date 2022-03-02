<?php session_start();
    $_SESSION['name_page'] = 'Admin Login';
    $_SESSION['title_page'] = 'PVBM Jhargram-Admin Login'; 
    $_SESSION['css_path'] = 'css\admin-login-style.css';
    echo  '<h3 class="paragraph">Note: This Page Is For ADMIN ONLY</h3>';
    include 'template.php';
    
?>    


<DOCTYPE html>
<html>
    <body>
        
            <div id='login_form'>
                <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method="POST">
                    <label for = 'user' >Admin Name: </label>
                    <input  id='user' name='user' type='text' required='required'/>
                    <br/>
                    <br/>
                    <label for='pass'>Password: </label>
                    <input id='pass' name='password' type='password' required='required'/>  
                    <br/>
                    <br/>
                    <input name='submit' type='submit'  />
                </form>
            </div>
            <?php
                include 'database_connection\connection.php';
                if (isset($_POST['submit'])) {
                    $sql = "SELECT * FROM `admin_login` WHERE `Admin-name` = '$_POST[user]' AND `Admin-password` = '$_POST[password]'";
                    $res = mysqli_query($conn,$sql);
                    if (mysqli_num_rows($res) == 1) {
                        session_start();
                        $_SESSION['AdminLoginId'] = $_POST['user'];
                        header('location: admin_pages/admin.php');
                    } else {
                        echo "<script>alert('Incorrect Password.Please Try Again')</script>";
                    }
                }   
                
            ?>    
                
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
    </body>
</html>