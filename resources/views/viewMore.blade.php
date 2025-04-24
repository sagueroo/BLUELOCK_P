<x-app-layout>
    {{-- Style for this page --}}
    <link rel="stylesheet" href="{{ asset('css/viewMore.css') }}">

    <h1>{{ $event->name }}</h1>
    <h2>User(s) registered :</h2>

    {{-- List of registered users --}}
    <div class="user-list">
        @foreach($users as $index => $user)
            <button class="user-row {{ $index % 2 == 0 ? 'even' : 'odd' }}"
                    onclick="confirmRemoval('{{ $user->id }}', '{{ $user->name }}')">
                {{-- By ChatGPT for the if with ? --}}
                <img src="{{ $user->profile_photo_url ?? asset('images/default-profile.png') }}"
                     alt="PP de {{ $user->name }}" class="profile-pic">
                <span class="user-info">{{ $user->name }} - {{ $user->email }}</span>
            </button>
        @endforeach
    </div>

    {{-- Confirmation modal when removing user --}}
    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <p id="modalText"></p>
            <form id="removeUserForm" method="POST">
                @csrf
                @method('DELETE')
                <button class="confirm" type="submit">Yes</button>
                <button class="cancel" type="button" onclick="closeModal()">No</button>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/viewMore.js') }}"></script>
    <x-trending/>
</x-app-layout>
{{--DO--}}
