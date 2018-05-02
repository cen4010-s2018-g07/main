<?php
// M. Kaan Tasbas

    function escape($str) {
        global $db;
        return mysqli_real_escape_string($db, trim($str));
    }

    function DelayedRedirect($path, $delay) {
        // echo javascript to redirect after $delay seconds
        echo "
        <script type=\"text/javascript\">
        setTimeout(function() {
            window.location.href = \"./$path\";
        }, $delay);
        </script>
        ";
    }

?>