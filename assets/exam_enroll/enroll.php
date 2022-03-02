<?php
   include '../database_connection/connection.php';
  $sql = "SELECT `show_enroll` FROM `enroll_show` ORDER BY id DESC LIMIT 1";
  $res = mysqli_query($conn,$sql);
  if (mysqli_num_rows($res) > 0) {
  while ($row = mysqli_fetch_assoc($res)) {
    if ($row['show_enroll'] == 'false') {
    header('location: not_started.php');
  }
}
}
?>
<?php
    $_SESSION['name_page'] = 'Exam Enrollment';
    $_SESSION['title_page'] = 'PVBM Jhargram- Exam enrollment';
    $_SESSION['css_path'] = '../css/enrollment-style.css';
?>
<?php include 'template_for_enroll.php'; 
       
?>

<br/>
<h1 class='title'>Enrollment Form</h1>
<div id='enroll_form'>
    <form action = <?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?> method='GET'>
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
        </select>
        <br/><br/><br/>
        <input type='submit' name='submit'/>
    </form>
</div>

<?php
    if (!empty($_GET['submit'])) {
      $name = $_GET['name_st'];
      $school  = $_GET['school_st'];
      $class = $_GET['class_st'];
      $roll = $_GET['roll_st'];
      $block = $_GET['block_st'];
      $sql = "INSERT INTO  `enroll_form`(id,name_st,school_st,class_st,roll_st,block_st) VALUES ('','$name','$school','$class','$roll','$block')";
        mysqli_query($conn,$sql);
        $roll_start = 0;
        $sql = "SELECT max(`id`) FROM `enroll_form`";
        $current_roll = mysqli_query($conn,$sql);
        $current_roll = $current_roll ->fetch_array();
        $new_roll = intval($current_roll[0]);
        $act = htmlspecialchars($_SERVER['PHP_SELF']);
        echo "<h1 class='title'>Form part 2</h1>
        <form action = $act method='GET'> ";
        $block_arr = array('block A', 'block B','block C');
        $block_part_arr = array('BA','BB','BC');
        $centers = array('CENTER A', '','CENTER B','','CENTER C','' ,'CENTER D', '','CENTER E','','CENTER F');
        $class_arr = array('1','2','3','4');
        for ($z = 0 ,  $e = 0;$z < sizeof($block_arr); $z++ , $e += 4) {
          if ($block == $block_arr[$z]) {
            echo "<label for='center'>Choose Center</label><br/>
            <select name='center_st' id='center'>
              <option value='" . $centers[$e] . "'>". $centers[$e] . "</option>
              <option value='" . $centers[$e+2] . "'>" . $centers[$e+2]  . "</option>
            </select><br/><br/>
            <input name='submit2' value = 'Submit Form Part 2' type='submit'/>
          </form>";
          for ($i = 0;$i < sizeof($class_arr);$i++) {
            if ($class == $class_arr[$i]) {
              if ($new_roll < 10) {
                $true_roll = 'A00' . $new_roll . $class . $block_part_arr[$z];
                $sql = "UPDATE `enroll_form` SET  `serial_st` = '$true_roll' ORDER BY id DESC LIMIT 1";
                mysqli_query($conn,$sql); 
              }
            }
          }

          }

        }
        
        echo "<p class='enroll_conf'>Form Part 1 submitted</p>";
      }
     
      if (!empty($_GET['submit2'])) {
        
        $sql = " UPDATE `enroll_form`  SET `center_st` = '$_GET[center_st]' ORDER BY id DESC LIMIT 1";
        mysqli_query($conn,$sql) or die(mysqli_error($conn));
        $sql = "SELECT `serial_st` FROM `enroll_form` ORDER BY `id` DESC LIMIT 1";
        $raw_sr = mysqli_query($conn,$sql);
        $raw_sr = $raw_sr ->fetch_array();
        $roll_num_true = strval($raw_sr[0]);
        echo "<p class='enroll_conf'>Form Part 2 Submitted";
        echo "<p class='enroll_conf'>Your Serial No. is " . $roll_num_true . "</p>";
        echo "<p class='enroll_conf'>Your center " . $_GET['center_st'] . "</p>";
        echo "<p class='enroll_conf'>Admit card will be issued soon</p>";
        $sql = "SELECT * FROM `enroll_form` ORDER BY id DESC LIMIT 1";
        $res = mysqli_query($conn,$sql) or die(mysqli_error($conn));
        if (mysqli_num_rows($res) > 0) {
          while($row = mysqli_fetch_assoc($res)) {
            // Create Image From Existing File
          $jpg_image = imagecreatefromjpeg('../css/image/background_admit.jpg');
          //$jpg_image=imagecreatetruecolor(100,100);
          
            // Allocate A Color For The Text
          $red = imagecolorallocate($jpg_image,245, 66, 66);
          
          
            // Set Path to Font File
            $font_path = '../css/fonts/Academy.ttf';
          
            // Set Text to Be Printed On Image
            $text = $row['name_st'];
          
            // Print Text On Image
            
              imagettftext($jpg_image, 30, 0, 0, 200, $red, $font_path, $text);
            
          
          
            // Send Image to Browser
            imagejpeg($jpg_image,'all_admits/' . $row['name_st'] . '-admit.jpg');
          
            // Clear Memory
          }
        }
      }


?>