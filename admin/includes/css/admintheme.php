<?php
    header("Content-type: text/css;");

    include_once __DIR__.'/../../modal/admintheme.class.php';

    $theme = new Admintheme();
    $result = $theme->ReadAdminTheme();

    if($result == '' || $result == '0'){
        $themeColor = "#111";
    }
    else{
        $row = $result->fetch_assoc();
        
        $themeColor = $row['theme_color'];
    }
?>
/*-- ------------------------xx----------------------- */

/*-------------- Navbar Section Starts --------------*/
.navbar{
    background-color: <?= $themeColor; ?>;
}
/*-------------- Navbar Section Ends --------------*/

/*-------------- Footer Section Starts --------------*/
footer{
    background-color: <?= $themeColor; ?>;
}
/*-------------- Footer Section Ends --------------*/


/*-------------- HR Section Starts --------------*/
hr{
    background-color: <?= $themeColor; ?>;
}
/*-------------- HR Section Ends --------------*/



/*-------------------------- Index Page Starts --------------------------*/

/*-------------- Organization Logo Section Starts --------------*/
.index-details-logo{
    border: 3px solid <?= $themeColor; ?>;
}
/*-------------- Organization Logo Section Ends --------------*/



/*-------------- Cards Section Starts --------------*/
.index-card{
    background-color: <?= $themeColor; ?>; 
}
/*-------------- Cards Section Ends --------------*/

/*-------------------------- Index Page Ends --------------------------*/


.post-container{
    border: 1px solid <?= $themeColor; ?>;
}


