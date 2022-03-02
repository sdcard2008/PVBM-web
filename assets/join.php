<!DOCTYPE html>
<?php 
    session_start();
    $_SESSION['name_page'] = 'Join Form';
    $_SESSION['title_page'] = 'PVBM jhargram-Join';
    $_SESSION['css_path'] = 'css\join-style.css';
?>
<?php include 'template.php' ?>
<html>
<head>
    <link href='css/confirm-style.css' type='text/css' rel='stylesheet'/>
</head>
<script src = "https://cdn.tiny.cloud/1/s0i1c59kp1a7llno2imi2h3zj39vcd2rv5i23atomvwg4ntm/tinymce/5/tinymce.min.js" referrerpolicy="origin" ></script>
<script>
    tinymce.init({
        selector: "textarea"
    })
</script>    
    <html>
        <body>   
         <h1 class='title'>Join Form</h1>
        <div id = 'join_form'>
            <form action = <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method = 'GET'>
                
                <label for='name'>Your Name</label> 
                <input id='name' name='user_name' type='text' required = 'required'/>
                    <br />
                    <label for='adress'>Your Adress</label>
                    <br />
                    <textarea class='textarea' id='adress' placeholder='Type Adress Here' required='required' name='adress'></textarea>
                    <br/>
                    <label for='phone'>Phone number</label>
                    <input id='phone' name='phone_number' type='text' required='required'/>
                    <br />
                    <label for='job'>Your Job</label>
                    <input id='job' name='job' type='text' required='required'/>
                    <br />
                    <label for='age'>Your Age</label>
                    <input id='age' name='age' type='text' required='required'/>
                    <br />
                    <label for='amount'>Amount(In number)</label>
                    <input id='amount' name='amount' type='text' requiried='reqiuired'/>
                    <br/>
                    <label for='gender'>Your gender</label>
                    <br />
                    <label for='gender_male'>Male</label>
                    <input name='gender' id='gender_male' type='radio' name='gender' value='male' required='required'/>
                    <label for='gender_female'>Female</label>
                    <input name='gender' id='gender_female' name='gender' type='radio' value='female' required='required'/>
                    <br/>
                    <br/>
                    <label for='date_of'>Date</label><br/>
                    <input type='date' id='date_of' name='date_of' required='required'/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <input name='submit' type='submit'/>
            </form>
        </div>
        <?php 
            
            $name = $adress = $phone = $job = $age = $amount = $gender = ''; 
            include 'database_connection\connection.php'; 
            if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['submit'])) {
                $sql = "SELECT * FROM `join_form_table` WHERE `name` = '$_GET[user_name]' AND `adress` = '$_GET[adress]' AND `phone_number` = '$_GET[phone_number]' AND `job` = '$_GET[job]' AND `age`='$_GET[age]' AND `gender` = '$_GET[gender]'";
                $user_name = $_GET['user_name'];
                $adress = $_GET['adress'];
                $phone = $_GET['phone_number'];
                $job = $_GET['job'];
                $age = $_GET['age'];
                $amount = $_GET['amount'];
                $gender = $_GET['gender'];
                $date = $_GET['date_of'];
                if (!filter_var($phone,FILTER_VALIDATE_INT)) {
                    echo "<p id='error'>Please Enter Only Numbers For Phone Number</p><br /><br />";
                } if (!ctype_alpha($job)) {
                    echo "<p id='error'>Please Enter Only Strings For Job</p><br /><br />";
                } if (!filter_var($age,FILTER_VALIDATE_INT)) {
                    echo "<p id='error'>Please Enter Only Numbers For age</p><br /><br />";    
                } elseif (mysqli_query($conn,$sql))  {
                   echo '<p class="confirm_para">Congratulations!</p>';
                   echo '<p class="confirm_para">' . $_GET['user_name'] . '</p>';
                   echo '<p class="confirm_para">You Have Joined Us Succesfully</P>';
                   echo '<p class="confirm_para">Please exit this page for security reasons</P>';
                   
                    $sql2 = "INSERT INTO join_form_table VALUE (null,'$user_name','$adress','$phone','$job','$age','$gender','$date')";
                    if (!mysqli_query($conn,$sql2)) {
                        die('Error 2: ' . mysqli_error($conn));
                    }
                    

                } else {
                    echo '<p class="confirm_para">Data Already Exists. Please enter new informations</p>';
                }
            }
        
                
            
        
            ?>
    </body>
    
    
</html>    
        