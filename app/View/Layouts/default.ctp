<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $title_for_layout?></title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<!-- Include external files and scripts here (See HTML helper for more info.) -->
<?php
echo $scripts_for_layout
?>
</head>
<body>

<div id="container">
    <!-- If you'd like some sort of menu to
    show up on all of your views, include it here -->
    <div id="header">
        <div id="menu"></div>
    </div>
    
    <!-- Here's where I want my views to be displayed -->
    <div id="content">
    <?php 
    echo $content_for_layout;
    ?>
    </div>

</div>
</body>
</html>