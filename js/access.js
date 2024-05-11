document.addEventListener("DOMContentLoaded", function () {
    // Elements to show/hide based on user role
    var curatorElements = document.querySelectorAll(".curator-only");
    var adminElements = document.querySelectorAll(".admin-only");
    var encoderElements = document.querySelectorAll(".contributor-only");

    // Function to set visibility based on user role
    function setVisibility(elements, isVisible) {
        elements.forEach(function (element) {
            element.style.display = isVisible ? "" : "none";
        });
    }

    // Check if userRole is defined
    if (typeof userRole !== 'undefined') {
        if (userRole === "Curator") {
            setVisibility(curatorElements, true);
            setVisibility(adminElements, false);
            setVisibility(encoderElements, false);
        } else if (userRole === "Admin") {
            setVisibility(curatorElements, true);
            setVisibility(adminElements, true);
            setVisibility(encoderElements, true);
        } else if (userRole === "Contributor") {
            setVisibility(curatorElements, false);
            setVisibility(adminElements, false);
            setVisibility(encoderElements, true);
        } else if (userRole === "not_a_user") {
            setVisibility(curatorElements, false);
            setVisibility(adminElements, false);
            setVisibility(encoderElements, false);
            // Redirect to a different page or show an access denied message
            window.location.replace("http://localhost/travisar/login/login.php");
            // Or show a message
            document.body.innerHTML = "<h1>Access Denied</h1>";
        } else {
            //console.error("Unexpected user role:", userRole);
        }
    } else {
        // userRole is not defined
        userRole = "not_a_user";
        setVisibility(curatorElements, false);
        setVisibility(adminElements, false);
        setVisibility(encoderElements, false);
    }

});