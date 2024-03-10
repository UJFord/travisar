// script for access levels in admin
// hide or show based on account type
document.addEventListener("DOMContentLoaded", function () {
    // Elements to show/hide based on user role
    var curatorElements = document.querySelectorAll(".curator-only");
    var adminElements = document.querySelectorAll(".admin-only");
    var encoderElements = document.querySelectorAll(".encoder-only");

    // Function to set visibility based on user role
    function setVisibility(elements, isVisible) {
        elements.forEach(function (element) {
            element.style.display = isVisible ? "" : "none";
        });
    }

    // Check user role and set visibility
    if (userRole === "Curator") {
        setVisibility(curatorElements, true);
        setVisibility(adminElements, true);
        setVisibility(encoderElements, true);
    } else if (userRole === "Admin") {
        setVisibility(curatorElements, false);
        setVisibility(adminElements, true);
        setVisibility(encoderElements, true);
    } else if (userRole === "Encoder") {
        setVisibility(curatorElements, false);
        setVisibility(adminElements, false);
        setVisibility(encoderElements, true);
    } else if (userRole === "not_a_user") {
        setVisibility(curatorElements, false);
        setVisibility(adminElements, false);
        setVisibility(encoderElements, false);
        // Redirect to a different page or show an access denied message
        window.location.replace("../login/login-form.php");
        // Or show a message
        document.body.innerHTML = "<h1>Access Denied</h1>";
    } else {
        console.error("Unexpected user role:", userRole);
    }
});
