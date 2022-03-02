<!DOCTYPE html>
<?php
    $_SESSION['title_page'] = 'PVBM Jhargram-Feedback Page';
    $_SESSION['name_page'] = 'Feedback Page';
    $_SESSION['css_path'] = 'css/order-form.css';
    include 'template.php';
    include 'database_connection/connection.php';
?>


<html lang="en">
<script src = "https://cdn.tiny.cloud/1/s0i1c59kp1a7llno2imi2h3zj39vcd2rv5i23atomvwg4ntm/tinymce/5/tinymce.min.js" referrerpolicy="origin" >
</script>
<script>
    tinymce.init({
        selector: '#feedback'
    }

    )
</script>        

<body>
    <form action = <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method='GET'>
        <label for='name_f'>Your Name</label><br />
        <input id='name_f' name='name_f' type='text' required='required'/><br/>
        <label for='feedback'>Your Feedback</label><br/>
        <textarea id='feedback' name='feedback' required='required' ></textarea><br/><br/>
        <input type='submit' name='submit'/>
    </form>
    <?php
        if(!empty($_GET['submit'])) {
            $sql = "INSERT INTO `feedback_form`(name_f,feedback) VALUE ('$_GET[name_f]','$_GET[feedback]')";
            if (!mysqli_query($conn,$sql)) {
                die('ERROR: ' . mysqli_error($conn));
            }
            echo '<p class="confirm_para">Your Feedback Is Submitted</p>';
        }
    ?>    
    
</body>
</html>    