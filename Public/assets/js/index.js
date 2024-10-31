// Función para cargar contenido dinámico
window.loadContent = function (page) {
    if(page.includes("productId=")){
        var regex = /(\d+)/g;
        const productId = page.match(regex)
        history.pushState(null, "", `product.html?productId=${productId}`);
    }
    fetch(page)
        .then(response => response.text())
        .then(data => {
            const mainContent = document.getElementById('main-content');
            mainContent.innerHTML = data;

            // Buscar y ejecutar todos los scripts dentro del contenido dinámico
            const scripts = mainContent.querySelectorAll('script[type="module"]');
            scripts.forEach(script => {
                if (script.src) {
                    const newScript = document.createElement('script');
                    newScript.type = 'module';
                    newScript.src = `${script.src}?t=${new Date().getTime()}`; // Forzar recarga

                    // Agregar el nuevo script al DOM
                    document.body.appendChild(newScript);

                    // // Escuchar cuando se carga el módulo
                    // newScript.onload = () => {
                    //     console.log('Módulo cargado correctamente:', newScript.src);
                    // };

                    // newScript.onerror = (error) => {
                    //     console.error('Error al cargar el módulo:', error);
                    // };
                }
            });
        })
        .catch(error => {
            console.error('Error cargando contenido:', error);
        });
};

import userDAO from "./DAO/userDAO.js";

window.onload = () => {

    loadContent('../user/PaginaPrincipal.html');

    let searchForm = document.querySelector('.search-form');

    document.querySelector('#search-btn').onclick = () => {
        searchForm.classList.toggle('active');
        shoppingCart.classList.remove('active');
        loginForm.classList.remove('active');
        navbar.classList.remove('active');

    }

    let shoppingCart = document.querySelector('.shopping-cart');

    document.querySelector('#cart-btn').onclick = () => {
        shoppingCart.classList.toggle('active');
        searchForm.classList.remove('active');
        loginForm.classList.remove('active');
        navbar.classList.remove('active');
    }

    let loginForm = document.querySelector('.login-form');

    document.querySelector('#login-btn').onclick = () => {
        if (localStorage.getItem('session')) {
            loadContent('../user/usuario.html');
        } else {
            loginForm.classList.toggle('active');
            searchForm.classList.remove('active');
            shoppingCart.classList.remove('active');
            navbar.classList.remove('active');
        }
    }

    loginForm.onsubmit = async (e) => {
        e.preventDefault();
        const email = loginForm.elements['email'].value;
        const password = loginForm.elements['password'].value;
        const respuesta = await new userDAO().login(email, password);

        if (respuesta.success) {
            location.reload()
        } else {
            alert(respuesta.message);
        }
    }

    let navbar = document.querySelector('.navbar');

    document.querySelector('#menu-btn').onclick = () => {
        navbar.classList.toggle('active');
        searchForm.classList.remove('active');
        shoppingCart.classList.remove('active');
        loginForm.classList.remove('active');
    }
}