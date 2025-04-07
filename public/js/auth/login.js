document.addEventListener('DOMContentLoaded', () => {
    // Pop-up "Créer un compte"
    const createAccountBtn = document.querySelector('.create-account');
    const registerPopup = document.getElementById('register-popup');
    const closeRegisterBtn = document.getElementById('close-register-popup');

    // Pop-up "Se connecter"
    const loginBtn = document.querySelector('.login-button');
    const loginPopup = document.getElementById('login-popup');
    const closeLoginBtn = document.getElementById('close-login-popup');

    // Ouvrir le pop-up "Créer un compte"
    createAccountBtn.addEventListener('click', () => {
        registerPopup.classList.add('active');
    });

    // Fermer le pop-up "Créer un compte"
    closeRegisterBtn.addEventListener('click', () => {
        registerPopup.classList.remove('active');
    });

    // Ouvrir le pop-up "Se connecter"
    loginBtn.addEventListener('click', () => {
        loginPopup.classList.add('active');
    });

    // Fermer le pop-up "Se connecter"
    closeLoginBtn.addEventListener('click', () => {
        loginPopup.classList.remove('active');
    });

    // Fermer le pop-up en cliquant en dehors de la boîte
    window.addEventListener('click', (e) => {
        if (e.target === registerPopup) {
            registerPopup.classList.remove('active');
        }
        if (e.target === loginPopup) {
            loginPopup.classList.remove('active');
        }
    });
});
