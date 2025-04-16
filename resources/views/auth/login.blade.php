<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
    <div class="logo">
        <a href="/login">
            <x-bluelock-logo/>
        </a>
    </div>
    <div class="content">
        <h2>The future is yours</h2>
        <a href="/register"><h1>Join us</h1></a>
        <p class="instructions">Sign up now.</p>
        <x-social-button type="google"><a href="{{ route('auth.google') }}">
                <button class="google-btn">Google...</button></a></x-social-button>

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
</x-guest-layout>
<style>
    .google-btn {
        background-color: #db4437;
        color: #fff;
    }

    .apple-btn{
        background-color: #000;
        color: #fff;
    }
</style>
<script src="{{ asset('js/auth/login.js') }}"></script>

