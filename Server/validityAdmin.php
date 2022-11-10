<?php
session_start();
if(empty($_SESSION['Type_User'])){
    echo "
    <script type='text/javascript'>
    window.location.href = '../';
    </script>
    ";  
}
if($_SESSION['Type_User'] != "Privileged_Admin" && $_SESSION['Type_User'] != "Admin"){
echo "
<script type='text/javascript'>
window.location.href = '../';
</script>
";  
}
?>