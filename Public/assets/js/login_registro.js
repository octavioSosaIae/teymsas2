window.onload = () => {
    changeForms();
    
}
            // funcion para cambiar el formulario
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
            //funcion de registro
function indexFunctions() {
    let formRegister = document.querySelector("#formLoginRegistro");

    formRegister.onsubmit = async (e) => {
        e.preventDefault();

        let password = document.querySelector("#password");
        let passwordConfirm = document.querySelector("#password_confirm");

        if (password.value === passwordConfirm.value) {
            let RegisterFormData = new FormData(formRegister);

            let url = 'http://localhost/teymsas2/app/api/controllers/UserController.php?function=register';

            let config = {
                method: 'POST',
                body: RegisterFormData
            };

            let respuesta = await fetch(url, config);
            let datos = await respuesta.json();

            alert(datos.message);
            formRegister.reset();
        } else {
            alert("Las contraseñas no coinciden");
        }

    };
            //funcion de login 
    let formLogin = document.querySelector("#formLogin");

    formLogin.onsubmit = async (e) => {
        e.preventDefault();

        let emailLogin = document.querySelector("#emailLogin");
        let passwordLogin = document.querySelector("#passwordLogin");
        let LoginFormData = new FormData();

        LoginFormData.append("email", emailLogin.value);
        LoginFormData.append("password", passwordLogin.value)

        let url = 'http://localhost/teymsas2/app/api/controllers/UserController.php?function=login';

        let config = {
            method: 'POST',
            body: LoginFormData
        };

        let respuesta = await fetch(url, config);
        let datos = await respuesta.json();

        if(datos.success){
            location.href ="http://http://localhost/teymsas2/public/user/";
        } else{
            alert(datos.error)
        }

    };
}