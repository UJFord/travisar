
// LIST TABLE
// make rows clickable
$(document).ready(function () {
    // Add click event to table rows
    $('#crop-list-tbody tr[data-href]').on("click", function () {
        // Get the URL from the data-href attribute
        var url = $(this).attr('data-href');
        // Navigate to the URL
        window.location = url;
        console.log(this)
    });
});