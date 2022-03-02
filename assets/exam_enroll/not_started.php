<?php
    $_SESSION['name_page'] = 'Exam Enrollment Not Started';
    $_SESSION['title_page'] = 'PVBM Jhargram- Exam enrollment Not Started';
    $_SESSION['css_path'] = '../css/enrollment-style.css';
?>
<?php include 'template_for_enroll.php'; 
      include '../database_connection/connection.php';  
?>
<html>
<h3 class = 'paragraph'>Enrollment has not started yet</h3>
</html>