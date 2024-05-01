// NAVBAR
// for nested dropdowns
$(document).ready(function() {
    $('.dropend').each(function() {
        var $dropdown = $(this);
        var $button = $dropdown.find('.set-nav-toggler');

        $button.on('click', function(event) {
            $('.dropend').not($dropdown).removeClass('show');
            $('.dropend').not($dropdown).find('.dropdown-menu').removeClass('show');
            
            // Prevent the default dropdown behavior
            event.preventDefault();
            event.stopPropagation();
        });
    });

    // Prevent event propagation for dropdown items
    $('.dropdown-menu .dropdown-item').click(function(e) {
        e.stopPropagation();
    });
});






