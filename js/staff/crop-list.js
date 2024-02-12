const btn = document.querySelector('#chevron-dropdown-btn'); // Select the element

btn.addEventListener('click', function() {
  this.classList.toggle('collapse'); // Toggle the class
});
