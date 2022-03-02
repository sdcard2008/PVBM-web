<!DOCTYPE html>
<?php
    session_start();
    $_SESSION['name_page'] = 'Admin Control';
    $_SESSION['title_page'] = 'PVBM Jhargram-Admin';
    $_SESSION['css_path'] = '../css/admin.css';
    include 'template-for-admin.php'; 
    include '../database_connection/connection.php'
    
?>
<?php include 'check_log.php'; ?>

<html lang="en">
    <script src = "https://cdn.tiny.cloud/1/s0i1c59kp1a7llno2imi2h3zj39vcd2rv5i23atomvwg4ntm/tinymce/5/tinymce.min.js" referrerpolicy="origin">
    </script>
    <script>
        tinymce.init({
            selector:'textarea'
        
        })
    </script>    
<body>
    <head>
        <link href='../css/join_submission.css' type='text/css' rel='stylesheet'>
</head>    
<div id=Index_panel>    
<h1>Welcome To Admin Panel <?php echo $_SESSION['AdminLoginId'] ?></h1>
    <form action = <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method='POST'>
        <input type='submit' name='LogOut' value='Log Out'></input>
    </form>
</div>
    <?php

         if (!empty($_POST['LogOut'])) {
            session_destroy();
            header('location: ../admin_login.php');
        }
    ?>
    <?php
        $sql = 'SELECT * FROM `join_form_table` getLastRecord ORDER BY id DESC LIMIT 1';
        $res = mysqli_query($conn,$sql);
    ?>    
        
<div id='form_requests'>
    <h3 class='title'>All form requests</h3>
    <table>
    <tr>    
        
        <th>Name</th>
        <th>Adress</th>
        <th>Phone Number</td>
        <th>Job</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Date Of Submission</th>
    </tr>    
    <?php
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                echo '<tr>'  .'<td>' . $row['name'] . '</td><td>'. $row['adress'] . '</td><td>' . $row['phone_number'] . '</td><td>'  . $row['job'] . '</td><td>' . $row['age'] . '</td><td>' . $row['gender'] . '</td><td>' . $row['date'] .'</td></tr><br />'; 
                }
            }
        
    ?>
    </table>

    <h3 class='title'>Add a new book in the read section</h3>
    <div id='add_book'>
    <form action = <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method='POST' enctype='multipart/form-data'>
        <label for='book_name'>Book Name: </label>
        <input type = 'text' name='caption' id='book_name' required='required'/><br /><br/>
        <label for='price'>Book Price: </label>
        <input type='text' id='price' name='price'/><br/><br/>
        <label for='desc'>Book Description</label><br/><br/>
        <textarea id='desc' name='desc' placeholder='Desc...'></textarea><br/><br>
        <label for='img'>Upload Image</label><br /><br/>
        <input id='img' type='file' name='Image'><br /><br />
        <input type='submit' name='submit'>
    </form>
    </div>
        
        <?php
            include 'upload.php';
            if (!empty($SESSION['Done'])) {
                $db_img_path = "admin_pages/" . $target_file;
                $sql = "INSERT INTO `new_book` VALUE ('','$_POST[caption]','$_POST[price]','$_POST[desc]','$db_img_path')";
                if (!mysqli_query($conn,$sql)) {
                    echo "ERROR: " . mysqli_error($conn);
                }
                    echo "<p class='confirm_para'>Book Uploaded</p>";
            }
        ?>
              
    <br />
    <br />
    <h3 class='title'>Book Orders</h3>   
        <div id='book_orders'>
            <table>
        <tr>    
            
            <th>Name Of Customer</th>
            <th>Phone Number</th>
            <th>Adress</th>
            <th>Book Name</th>
        </tr>    
        <?php
            $sql = 'SELECT * FROM `order_form`';
            $res = mysqli_query($conn,$sql);
            if (mysqli_num_rows($res) !== 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    echo '<tr>'  .'<td>' . $row['name_b'] . '</td><td>'. $row['adress'] . '</td><td>' . $row['ph_num'] . '</td><td>'  . $row['book_name'] . '</td>'; 
            }
        }
    ?>
    </table>
    <br/>
    <br/>
    <h3 class='title'>Add Notice</h3>
    <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method='POST' novalidate>
        <label for='notice_header'>Title Of Notice</label><br/>
        <input type='text' id='notice_header' name='notice_header' required='required'/>
        <label for='notice_content'>Content Of Notice</label><br/>
        <textarea type = 'text' id='notice_content' name='notice_content' required='required' ></textarea><br/>
        <label for='date'>Date Of Submission</label><br/>
        <input type='date' id='date'name='date' required='required'/><br/><br/>

        <input type='submit' name='submit_1'/>
    </form> 
    <?php    
        if(!empty($_POST['submit_1'])) {
            $sql = "INSERT INTO `notice_form` VALUE(null,'$_POST[notice_header]','$_POST[notice_content]','$_POST[date]')";
            if (!mysqli_query($conn,$sql)) {
                echo 'ERROR: ' . mysqli_error($conn);
            } else {
                echo '<p class="confirm_para">Notice Submitted</p>';
            }
        }

    ?>
    <div id='feedbacks'>
    <h3 class='title'>All feedbacks </h3>
    <table>
    <tr>    
        
        <th>Name</th>
        <th>Feedback</th>
    </tr>    
    <?php
        $sql = 'SELECT * FROM `feedback_form`';
        $res = mysqli_query($conn,$sql);
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                echo '<tr>'  .'<td>' . $row['name_f'] . '</td><td>'. $row['feedback'] . '</td></tr><br />'; 
            }
        }
    ?>
    </table>
    </div><br/><br/>
    <div id='give_roll'>
        <h3 class='title'>Exam Candidates</h3>
            <table>
                <tr>
                    <th>Student Name</th>
                    <th>Serial No. </th>
                    <th>School</th>
                    <th>Class</th>
                    <th>Roll</th>
                    <th>Block</th>
                    <th>Center</th>
                </tr>
                <?php
                    $sql = "SELECT * FROM `enroll_form`";
                    $res = mysqli_query($conn,$sql);
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                        echo '<tr><td>' . $row['name_st'] . '</td><td>' . $row['serial_st'] . '</td><td>' . $row['school_st']  . '</td><td>' . $row['class_st'] . '</td><td>' . $row['roll_st'] . '</td><td>' . $row['block_st'] . '</td><td>' . $row['center_st'] . '</td></tr>' ;
                        }
                    }
                ?>
            </table>
            
        </form>
    </div>
    <div id='offline_candidates_register'>
        <h3 class = 'title'>Data entry for offline registered candidates</h3>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?> method='POST'>
        <label for='st_n'>Student Name </label><br/>
        <input type='text' name='name_st' id='st_n' required='required'/><br/><br/>
        <label for='school'>School Name</label><br/>
        <input id='school' type='text' name='school_st' required='required'/><br/><br/>
        <label for = 'class'>Class</label><br/><br/>
        <select name = 'class_st' id='class' required='required'>
            <option value='01'>1</option>
            <option value='02'>2</option>
            <option value='03'>3</option>
            <option value='04'>4</option>
        </select> 
        <br/><br/><br/> 
        <label for='Roll_no'>Roll No(Optional)</label><br/>
        <input type='text' name='roll_st' id='Roll_no'/>  <br/><br/> 

        <label for='block'>Select Block</label><br/><br/>
        <select name='block_st' id='block' required='required'>
            <option value='block A'>Block A </option>
            <option value='block B'>Block B</option>
            <option value='block C'>Block C</option>
        </select><br/>
        <label for = 'center'>Selected Center</label><br/>
        <input type='text' id='center' name='center_st' required='required'/>
        <br/><br/><br/>
        <input type='submit' name='submit__'/>       
        </form>
        <?php
            if(!empty($_POST['submit__'])) {
                $sql = "SELECT max(`id`) FROM `enroll_form`";
                $current_roll = mysqli_query($conn,$sql);
                $current_roll = $current_roll ->fetch_array();
                $new_roll = intval($current_roll[0]+1);
                $block_arr = array('block A', 'block B','block C');
        $block_part_arr = array('BA','BB','BC');
        $centers = array('CENTER A', '','CENTER B','','CENTER C','' ,'CENTER D', '','CENTER E','','CENTER F');
        $class_arr = array('1','2','3','4');
        for ($z = 0 ,  $e = 0;$z < sizeof($block_arr); $z++ , $e += 4) {
          if ($_POST['block_st'] == $block_arr[$z]) {
            
          for ($i = 0;$i < sizeof($class_arr);$i++) {
            if ($_POST['class_st'] == $class_arr[$i]) {
              if ($new_roll < 10) {
                $true_roll = 'A00' . $new_roll . $_POST['class_st'] . $block_part_arr[$z];
                $sql = "INSERT INTO `enroll_form` VALUES('','$_POST[name_st]','$_POST[school_st]','$_POST[class_st]','$_POST[roll_st]','$_POST[block_st]','$_POST[center_st]','$true_roll')";
                mysqli_query($conn,$sql) or die(mysqli_error($conn));
                echo "<p class='confirm_para'>New Student Enrolled</p>"; 
              }
            }
          }
        }
    }
}      
        ?>

    </div><br/><br/>
    <form method='POST'>
        <input type='submit' name='start_enr' value='Start/Stop Enrolling Students'/>            
    </form>
    <?php
     if(!empty($_POST['start_enr'])) {
        $sql = "SELECT `show_enroll` FROM `enroll_show` ORDER BY id DESC LIMIT 1";
        $res = mysqli_query($conn,$sql);
        if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
          if ($row['show_enroll'] == 'false') {
            $sql = "UPDATE `enroll_show` SET `show_enroll` = 'true' ORDER BY id DESC LIMIT 1";
            mysqli_query($conn,$sql) or die(mysqli_error($conn));
     } else {
        $sql = "UPDATE `enroll_show` SET `show_enroll` = 'false' ORDER BY id DESC LIMIT 1";
        mysqli_query($conn,$sql) or die(mysqli_error($conn));
     }
     echo "<p class='paragraph'>Current Status For Enrollment:</p><p class = 'paragraph'>" . $row['show_enroll']. "</p>"; 
    }
}
     }
    
    ?> 
    </body>
        
</html>    

    

