<?php
    session_start();
    $_SESSION['title_page'] = 'PVBM Jhargram-Our Books';
    $_SESSION['name_page'] = 'Our Books';
    $_SESSION['css_path'] = 'css/read-style.css';
    include 'template.php';
    include 'database_connection/connection.php';
?>
<!DOCTYPE html>
<html lang="en">

    
<body>
    <div id='all_books'>
    <?php 
        $sql= 'SELECT * FROM `new_book`';
        $result = mysqli_query($conn,$sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $_SESSION['book_name'] = $row['book_name'];
                echo '<div class="books">' . '<img src= ' . $row['img_path'] .   ' />' . '<p class="paragraph">Book name: ' . $row['book_name'] . '</p><p class="paragraph">Book price: '   . $row['book_price'] . '</p><p class="paragraph">Book Description: ' . $row['book_desc'] . '</p><p class="paragraph"><a href="order_form.php">Click Here To Order Book</a></p></div>';   
                
            }
        }
    ?>
    </div>
</body>
</html>    