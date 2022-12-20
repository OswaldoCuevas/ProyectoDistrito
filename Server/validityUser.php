<?php
session_start();
if(empty($_SESSION['Type_User'])){
    echo "
    <script type='text/javascript'>
    window.location.href = '../user';
    </script>
    ";  
}
?>