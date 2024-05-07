<?php
if (isset($_SESSION['message'])) :
?>
    <script>
        // Set the timeout in milliseconds (e.g., 3000 for 3 seconds)
        const timeout = 3000;
        window.alert('<?php echo $_SESSION['message']; ?>', timeout);
    </script>
<?php
    //unset($_SESSION['message']);
endif;
?>

<script>
    // Custom alert function with callback
    function alertWithCallback(message, timeout) {
        const alert = document.createElement('div');
        const alertButton = document.createElement('button');
        alertButton.innerHTML = '<i class="fa-solid fa-xmark"></i>';
        alert.appendChild(alertButton);
        alert.classList.add('alert');
        alert.setAttribute('style', `
            position: fixed;
            top: 20px;
            left: 75%;
            transform: translateX(-50%);
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 5px 0 #00000044;
            border: 1px solid #333;
            z-index: 10000;
        `);
        alertButton.setAttribute('style', `
            background: white;
            border-radius: 5px;
            padding: 5px;
        `);
        alert.innerHTML = `<span style="padding:10px;">${message}</span>`;
        alert.appendChild(alertButton);
        alertButton.addEventListener('click', () => {
            alert.remove();
            <?php unset($_SESSION['message']); ?>;
        });
        if (timeout != null) {
            setTimeout(() => {
                alert.remove();
            }, Number(timeout));
        }
        document.body.appendChild(alert);

        // Unset session message after timeout
        if (timeout != null) {
            setTimeout(() => {
                <?php unset($_SESSION['message']); ?>;
            }, timeout);
        }
    }
</script>