<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>jQuery UI Autocomplete - Default functionality</title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <?php include './Site.php'; ?> 
    </head>
    <body>
        <?php 
            $site = new Site();
            $site->setEnddate('fadsf');
            echo $site->getEnddate();
        ?>
        
    </body>
</html