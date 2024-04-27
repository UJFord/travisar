// FILTER MODAL
// open on load
document.addEventListener("DOMContentLoaded", function() {
    var myModal = new bootstrap.Modal(document.getElementById('filter-modal'));
    myModal.show();
});

// crop type
const cropButtons = document.querySelectorAll('.filter-crop-type');

cropButtons.forEach(button => {
    button.addEventListener('click', function() {
        const radioId = `crop_${this.textContent.toLowerCase()}`;
        const radio = document.getElementById(radioId);
        radio.checked = true;

        // Update button styles based on selection
        cropButtons.forEach(otherButton => {
            otherButton.classList.remove('bg-dark');
            otherButton.classList.add('bg-white');
            otherButton.classList.remove('text-light');
            otherButton.classList.add('text-dark');
        });
        this.classList.remove('bg-white');
        this.classList.add('bg-dark');
        this.classList.remove('text-dark');
        this.classList.add('text-light');
    });
});

