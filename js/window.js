// design ni sya sa alert gi ani ra nako para mugawas sya hahahahaha
window.alert = function (message, timeout=null) {
    const alert = document.createElement('div');
    const alertButton = document.createElement('button');
    alertButton.innerHTML = 'ok';
    alert.appendChild(alertButton);
    alert.classList.add('alert');
    alert.setAttribute('style',`
        position: fixed;
        top: 20px;
        left: 75%;
        transform: translateX(-50%);
        padding: 20px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 10px 5px 0 #00000044;
        border: 1px solid #333;
        z-index: 10000;
    `);
    alertButton.setAttribute('style',`
        border: 1px solid #333;
        background: white;
        border-radius: 5px;
        padding: 5px;
    `);
    alert.innerHTML = `<span style="padding:10px;">${message}</span>`;
    alert.appendChild(alertButton);
    alertButton.addEventListener('click', () => {
        alert.remove();
    });
    document.body.appendChild(alert);
}