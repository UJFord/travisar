$(document).ready(function() {
    // NAVBAR
    // for nested dropdowns
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

    // ACTIONS BTNS
    // Function to run when any input value changes
    $("select").change(function() {
        // show actions buttons
        $("#action-container").removeClass("d-none");
    });
    $("input").keydown(function() {
        // show actions buttons
        $("#action-container").removeClass("d-none");
    });

    // change modal values on change
    $("#discard-btn").click(function(){
        $('#confirm .modal-body').text("Confirm discarding changes? Any changes you've made wil be discarded.");
        $('#modal-discard-btn').removeClass("d-none");
        $('#modal-confirm-btn').addClass("d-none");
    });
    $("#apply-btn").click(function(){
        $('#confirm .modal-body').text("Confirm applying changes from your profile?");
        $('#modal-discard-btn').addClass("d-none");
        $('#modal-confirm-btn').removeClass("d-none");
    });
});
