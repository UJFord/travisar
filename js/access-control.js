function checkAccess(userRole) {
    if (userRole === 'Encoder') {
        // Customize based on the viewer's access
        console.log('Encoder has access');
    } else if (userRole === 'Admin') {
        // Customize based on the admin's access
        console.log('Admin has access');
    } else if (userRole === 'Curator') {
        // Customize based on the curator's access
        console.log('Curator has access');
    } else {
        // Handle other cases or show an error message
        // Redirect the user to the desired location
        window.location.href = 'http://localhost/travisar/login/login.php';
        // Set a JavaScript variable for the error message
        var errorMessage = "You do not have enough access.";

        // Display the error message (you need to have an element with the id 'error-message' in your HTML)
        document.getElementById('error-message').innerHTML = '<div class="error">' + errorMessage + '</div>';
    }
}