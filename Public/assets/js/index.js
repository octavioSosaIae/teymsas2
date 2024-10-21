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

    let navbar = document.querySelector('.navbar');

    document.querySelector('#menu-btn').onclick = () => {
        navbar.classList.toggle('active');
        searchForm.classList.remove('active');
        shoppingCart.classList.remove('active');
        loginForm.classList.remove('active');
    }
}

// Función para cargar contenido dinámico
function loadContent(page) {
    fetch(page)
        .then(response => response.text())
        .then(data => {
            document.getElementById('main-content').innerHTML = data;
        })
        .catch(error => {
            console.error('Error cargando contenido:', error);
        });
}