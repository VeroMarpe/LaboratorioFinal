const validarCampos = (nombre, apellido1, apellido2, email, login, password) => {
    if (nombre === '' || apellido1 === '' || apellido2 === '' || email === '' || login === '' || password === '') {
        return false;
    }
    return true;
}

const validarEmail = (email) => {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (regex.test(email)) {
        return true;
    }
    return false;
};

const validarContraseña = (password) => {
    if (password.length >= 4 && password.length <= 8) {
        return true;
    }

    return false;
};

const validacion = () => {
    const nombre = document.getElementById('nombre').value;
    const apellido1 = document.getElementById('apellido1').value;
    const apellido2 = document.getElementById('apellido2').value;
    const email = document.getElementById('email').value;
    const login = document.getElementById('login').value;
    const password = document.getElementById('password').value;
    const correcto = validarCampos(nombre, apellido1, apellido2, email, login, password);

    if (!validarCampos) {
        alert('Por favor, rellene todos los campos.');
        return;
    }

    if (!validarEmail) {
        alert('El email no es válido.');
        return;
    }
}
