window.onload = () => {
    changeForms();
    
}

function changeForms() {
    let btnLogin = document.querySelector("#botonlogin");
    let botonregistro = document.querySelector("#botonregistrarse");
    let panelvista = document.querySelector("#contenedorformulario");

    btnLogin.onclick = () => {
        panelvista.style.left = "0px";
    }
    botonregistro.onclick = () => {
        panelvista.style.left = "-400px";
    }
}