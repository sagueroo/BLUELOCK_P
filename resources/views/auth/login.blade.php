<x-guest-layout>
    <div class="logo">
        <a href="/">
            <x-bluelock-logo/>
        </a>
    </div>
    <div class="content">
        <h2>The future is yours</h2>
        <a href="/register"><h1>Join us</h1></a>
        <p class="instructions">Sign up now.</p>
        <x-social-button type="google"><a href="{{ route('auth.google') }}">
                <button class="google-btn">Google...</button>
            </a></x-social-button>

        <div class="divider">
            <hr><span>ou</span><hr>
        </div>

        <button class="create-account">Create account</button>
        <p class="terms-text">
            By registering, you agree to the
            <a href="#" class="terms-link">Terms of Use </a>and
            <a href="#" class="terms-link">Privacy Policy</a>, including
            <a href="#" class="terms-link">Cookie Usage</a>.
        </p>


        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <p class="login-prompt">Already have an account?</p>
        <button class="login-button">Sign in</button>
        <x-login-popup/>
        <x-register-popup/>
    </div>

   <style>
       .content {
           flex: 1;
           text-align: left;
           padding-left: 40px;
           border-left: 1px solid #ccc;
       }

       .content h2 {
           font-size: 24px;
           color: #4b4b4b;

       }

       .content h1 {
           font-size: 36px;
           font-weight: bold;
       }

       .instructions {
           font-size: 18px;

       }
       .divider {
           display: flex;
           align-items: center;
           margin: 10px 0;
           color: #aaa;
           font-weight: bold;
       }

       .divider hr {
           flex: 1;
           border: none;
           border-top: 1px solid #ccc;
       }

       .divider span {
           margin: 0 10px;
           font-size: 14px;
       }
       .create-account {
           background-color: #009ddc;
           color: #fff;
           border: none;
           padding: 10px 30px;
           font-size: 18px;
           border-radius: 50px;
           cursor: pointer;
           transition: background-color 0.3s ease;
           width: 70%;
           max-width: 280px;

       }

       .create-account:hover {
           background-color: #0078a3;
       }

       p {
           color: #777;
           margin-bottom: 20px;
       }

       .google-btn {
           background-color: #db4437;
           color: #fff;
       }

       .apple-btn {
           background-color: #000;
           color: #fff;
           margin-bottom: 0px;

       }

       .terms-text {
           font-size: 10px;
           color: #555;
           text-align: left;
           line-height: 1.6;
           margin-top: 1px;
           margin-bottom: 50px;
           max-width: 280px;
       }

       .terms-link {
           color: #0078d7;
           text-decoration: none;
       }

       .terms-link:hover {
           text-decoration: underline;
       }

       .popup-overlay {
           position: fixed;
           top: 0;
           left: 0;
           width: 100%;
           height: 100%;
           background: rgba(0, 0, 0, 0.6);
           display: flex;
           justify-content: center;
           align-items: center;
           visibility: hidden;
           opacity: 0;
           transition: visibility 0s, opacity 0.3s;
       }

       .popup-box {
           background-color: #fff;
           padding: 30px;
           border-radius: 10px;
           width: 100%;
           max-width: 400px;
           position: relative;
           box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
           text-align: center;
           align-items: center;
           justify-content: center;
       }

       .login-prompt {
           font-size: 16px;
           margin: 30px 0 10px;
           color: #555;
       }
       .close-btn {
           position: absolute;
           top: 10px;
           right: 15px;
           font-size: 24px;
           cursor: pointer;
           color: #777;
       }

       .close-btn:hover {
           color: #000;
       }

       .popup-overlay.active {
           visibility: visible !important;
           opacity: 1 !important;
       }

   </style>

    <script>
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

    </script>

</x-guest-layout>

