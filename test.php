<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>jQuery UI Autocomplete - Default functionality</title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <?php session_start() ?>
        <script>
            $(function () {
                var availableTags = [
                    "ActionScript",
                    "AppleScript",
                    "Asp",
                    "BASIC",
                    "C",
                    "C++",
                    "Clojure",
                    "COBOL",
                    "ColdFusion",
                    "Erlang",
                    "Fortran",
                    "Groovy",
                    "Haskell",
                    "Java",
                    "JavaScript",
                    "Lisp",
                    "Perl",
                    "PHP",
                    "Python",
                    "Ruby",
                    "Scala",
                    "Scheme"
                ];
                $("#tags").autocomplete({
                    source: availableTags
                });
            });
        </script>
    </head>
    <body>

        <script language="javascript" >
            xmlhttp.open("GET", "test.php?id=fsadf", true);
            xmlhttp.send();
        </script>
        <?php
        $getthevalueofid = $_GET['id'];
        ?>
    </body>
</html