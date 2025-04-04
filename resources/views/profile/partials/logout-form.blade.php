<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Log Out') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('This will log you out of your account. Make sure you have saved your work before proceeding.') }}
        </p>
    </header>

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <x-danger-button
            x-data=""
            onclick="event.preventDefault(); this.closest('form').submit();"
        >
            {{ __('Log Out') }}
        </x-danger-button>
    </form>
</section>
