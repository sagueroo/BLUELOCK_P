<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/viewMore.css') }}">

    <h1>{{ $event->name }}</h1>

    <h2>Utilisateurs inscrits :</h2>
    <div class="user-list">
        @foreach($users as $index => $user)
            <button class="user-row {{ $index % 2 == 0 ? 'even' : 'odd' }}"
                    onclick="confirmRemoval('{{ $user->id }}', '{{ $user->name }}')">
                <img src="{{ $user->profile_photo_url ?? asset('images/default-profile.png') }}"
                     alt="PP de {{ $user->name }}" class="profile-pic">
                <span class="user-info">{{ $user->name }} - {{ $user->email }}</span>
            </button>
        @endforeach
    </div>

    <!-- Modal -->
    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <p id="modalText"></p>
            <form id="removeUserForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Oui</button>
                <button type="button" onclick="closeModal()">Non</button>
            </form>
        </div>
    </div>


    <script src="{{ asset('js/viewMore.js') }}"></script>
    <x-trending/>
</x-app-layout>
<style>
    .user-list {
        width: 100%;
        max-width: 600px;
        margin: 20px auto;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .user-row {
        display: flex;
        align-items: center;
        padding: 12px;
        width: 100%;
        border: none;
        background: none;
        text-align: left;
        cursor: pointer;
        transition: background 0.3s;
    }

    .user-row.even {
        background-color: #f9f9f9;
    }

    .user-row.odd {
        background-color: #e0e0e0;
    }

    .user-row:hover {
        background-color: #d1d1d1;
    }

    .profile-pic {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 15px;
        object-fit: cover;
        border: 2px solid #ccc;
    }

    .user-info {
        font-size: 16px;
        font-weight: bold;
    }

    /* Popup */
    .popup {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        text-align: center;
        z-index: 1000;
    }

    .popup-content {
        max-width: 300px;
    }

    .popup-buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
    }

    .btn {
        padding: 8px 12px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
    }

    .confirm {
        background-color: red;
        color: white;
    }

    .cancel {
        background-color: gray;
        color: white;
    }

</style>
<script>
    function confirmRemoval(userId, userName) {
        document.getElementById('modalText').innerText = `Voulez-vous supprimer ${userName} de votre événement ?`;
        document.getElementById('removeUserForm').action = `/removeUser/${userId}`;
        document.getElementById('confirmModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('confirmModal').style.display = 'none';
    }

</script>
