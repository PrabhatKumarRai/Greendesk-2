<?php
    header("Content-type: text/css;");

    include_once __DIR__.'/../../modal/website_setting.class.php';

    $websiteSetting = new Website_setting();
    $result = $websiteSetting->GetWebsiteSetting();
    $row = $result->fetch_assoc();

    if($row == '' || $row == '0'){
        $themecolor = "#111";
    }
    else{
        $themecolor = $row['theme_color'];
    }
?>

/* ------------ Banner Setion Starts ------------ */
.banner-container{
    background-color: <?= $themecolor ?>;
}
/* ------------ Banner Setion Ends ------------ */


/* -------  Footer Section Starts  ------- */
.footer{
    background-color: <?= $themecolor; ?>;
}
/* -------  Footer Section Ends  ------- */

/* -------  Index Container Section Starts  ------- */
.index-container{
    border: 1px solid <?= $themecolor; ?>;
}
/* -------  Index Container Section Ends  ------- */


/* ------------ HR Setion Starts ------------ */
hr{
  background-color: <?= $themecolor ?>;
}
/* ------------ HR Setion Ends ------------ */

/* ------------ solution-category Setion Starts ------------ */
.solution-category {
    border-bottom: 1px solid <?= $themecolor ?>;
}
/* ------------ solution-category Setion Ends ------------ */

/* ------------ Page Head Setion Starts ------------ */
.page-head {
    border-bottom: 1px solid <?= $themecolor ?>;
}
/* ------------ Page Head Setion Ends ------------ */

.recent-articles-container{
    border-color: <?= $themecolor ?> !important;
}