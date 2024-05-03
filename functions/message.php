<?php
if (isset($_SESSION['message'])) :
?>
    <script>
        // Set the timeout in milliseconds (e.g., 3000 for 3 seconds)
        const timeout = 3000;
        window.alert('<?php echo $_SESSION['message']; ?>', timeout);
    </script>
<?php
    unset($_SESSION['message']);
endif;
?>