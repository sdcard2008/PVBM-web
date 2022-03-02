<?php
    $_SESSION['title_page'] = 'PVBM Jhargram-Notice Board And Event';
    $_SESSION['name_page'] = 'Notice And Event Board';
    $_SESSION['css_path'] = 'css/notice-style.css';
    include 'template.php';
    include 'database_connection/connection.php'
?>
<!DOCTYPE html>
<html lang="en">
<body>
<div id='all_notice'>
    <?php 
        $sql= 'SELECT * FROM `notice_form`';
        $result = mysqli_query($conn,$sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="notices"><p class="date">'. $row['submission_date'] . '</p><h1 class="notice_hd">' . $row['notice_title'] . '</h1><br/><br/>' .$row['notice_content'] .'</div>';
                
            }
        }
    ?>
    </div>    
</body>
</html>    