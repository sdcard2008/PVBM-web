<?php    
    $name_page = $_SESSION['name_page'];
    $title_page = $_SESSION['title_page'];
    $css_path = $_SESSION['css_path'];
?>    

<html>
    <head>
    <?php  echo '<title>' .  $title_page . '</title>'; ?>
    <meta name="viewport" content="width=device-width", initial-scale=1>
    <meta name = 'author'
        content = 'Saptak De'/>
        <meta charset="UTF-8"/>
        <meta name = 'description'
        content = 'Website of a Paschim Vangya Bigyan Mancha Jhargram'/>
        <meta name = 'keyword'
        content ='science , global warming , science activities'/>
        
        <link href='css\universal-template.css' type='text/css' rel='stylesheet'>
        <?php echo '<link href=' . $css_path . ' type="text/css" rel="stylesheet">'; ?><br/> 

        
    </head>
    <body>
        <div id='box'>
            <img class="logo" src='css\image\logo.png'>
        </div>
        <h1 class = 'title'>Paschim vangya bigyan mancha</h1>
        <h2 class = 'title'>Jhargram Jilla Comitte</h2>
        <?php  echo '<h3 class = "title">' .  $name_page . '</h3>'; ?>
        <div id = 'toolbar'>
            <ul>
                <li class = 'tools'><a href = '../../index.php'>Home</a></li>
                <li class = 'tools'><a href = 'about.php'>About Us</a></li>
                <li class = 'tools'><a href = 'read.php'>Our magazines</a></li>
                <li class = 'tools'><a href = 'join.php'>Join Us</a></li>
                <li class = 'tools'><a href = 'feedback.php'>Feedback</a></li>
                <li class = 'tools'><a href='admin_login.php'>Admin Login</a></li>
                <li class = 'tools'><a href='notice_page.php'>Notice And Events</a></li>
                <li class='tools'><a href='exam_enroll'>Exam Enrollment</a></li>
            </ul>
        </div>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
    </body>
</html>