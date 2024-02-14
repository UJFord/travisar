let cropToggler = document.querySelector('#crop-filter-dropdown-toggler');
let munToggler = document.querySelector('#mun-filter-dropdown-toggler');
let contToggler = document.querySelector('#cont-filter-dropdown-toggler');



let cropChev = document.querySelector('#cropChev');
let munChev  = document.querySelector('#munChev');
let contChev = document.querySelector('#contChev');

function toggleChevron(element) {
    element.classList.toggle('rotate-chevron');
}

cropToggler.onclick = () => toggleChevron(cropChev);
munToggler.onclick = () => toggleChevron(munChev);
contToggler.onclick = () => toggleChevron(contChev);

// hello
console.log('hello world');

