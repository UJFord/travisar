window.alert = function (message, timeout=null) {
    const alert = document.createElement('div');
    alert.classList.add('alert');
    alert.setAttribute('style',`
    position: fixed;
    top: 0;
    left: 0;
    padding: 0;
    border: ;
    `);
    alert.innerHTML = message;
    document.body.appendChild(alert);
}