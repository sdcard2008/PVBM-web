<!DOCTYPE html>
<?php
    session_start();
    $_SESSION['title_page'] = 'PVBM Jhargram-Order Form';
    $_SESSION['name_page'] = 'Book Order Form';
    $_SESSION['css_path'] = 'css/order-form.css';
    include 'template.php';
    include 'database_connection/connection.php';
    $book_name = $_SESSION['book_name'];
?>

<html lang="en"> 
<script src = "https://cdn.tiny.cloud/1/s0i1c59kp1a7llno2imi2h3zj39vcd2rv5i23atomvwg4ntm/tinymce/5/tinymce.min.js" referrerpolicy="origin">
    </script>
    <script>
        tinymce.init({
            selector:'textarea'
        
        })
    </script>    
<body>
    <?php echo '<h2 class="title">Book Order For ' . $book_name . '</h2>'; ?>
    <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method='GET'>
        <label for='name'>Your Name</label><br/>
        <input type='text' id='name' name='name' required='required'/><br/>
        <label for='ph_num'>Your Phone Number</label><br />
        <input type='text' id='ph_num' name='ph_num'/><br />
        <label for='adress'>Your Adress</label><br/>
        <textarea name='adress' id='adress' placeholder='Your Adress...' col=30 row=50></textarea><br /><br/>
        <input type='submit' name='submit'/>
        
</form>
<p class='paragraph'>Note: PaymentMode Is Cash On Delivery</p>
      
   <?php
        
      if (!empty($_GET['submit'])) {  
        $sql="INSERT INTO order_form  VALUE (null,'$_GET[name]','$_GET[adress]','$_GET[ph_num]','$book_name')";
        if (mysqli_query($conn,$sql)){
            echo '<p class="confirm_para">You Have Ordered</p><br/>' . '<p class="confirm_para">' . $book_name . '</p>' ;
        }
      }
    ?>


</body>
</html>    