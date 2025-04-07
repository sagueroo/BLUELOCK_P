



<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" integrity="sha256-jKV9n9bkk/CTP8zbtEtnKaKf+ehRovOYeKoyfthwbC8=" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/account/setting.css') }}">

    <div class="contain">
    <h2>Modifier le profil</h2>

    <!-- En-tête du profil -->
    <div class="profile-header">
        <div style="display: flex; align-items: center;">
            <img id="profile-picture"
                 src="{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : asset('pictures/pop.png') }}"
                 alt="Photo de profil"
                 class="profile-photo">
            <p style="margin-left: 15px; font-weight: bold;">{{ Auth::user()->name }}</p>
        </div>
        <button class="btn-edit-photo" onclick="openModal()">Modifier la photo</button>
    </div>

    <!-- Pop-up Modal -->
    <div id="photoModal" class="modal">
        <div class="modal-content">
            <h3>Modifier la photo de profil</h3>
            <button onclick="triggerFileInput()">Importer une photo</button>
            <form id="uploadForm" action="{{ route('profile.updatePhoto') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                @csrf
                <input type="file" id="fileInput" name="profile_photo" accept="image/*" onchange="document.getElementById('uploadForm').submit();">
            </form>
            <form action="{{ route('profile.deletePhoto') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" style="color: red;" class="btn-delete-photo">Supprimer la photo actuelle</button>
            </form>
            <button onclick="closeModal()">Annuler</button>
        </div>
    </div>

    <!-- Formulaire de modification -->
    <form action="{{ route('profile.updateBio') }}" method="POST">
        @csrf

        <!-- Formulaire de la bio -->
        <div class="form-group">
            <label for="bio">Bio</label>
            <textarea id="bio" name="bio" rows="4" maxlength="200" placeholder="Votre bio...">{{ Auth::user()->bio }}</textarea>
            <div id="charCount" class="char-counter">{{ strlen(Auth::user()->bio) }} / 200</div>
        </div>

        <button type="submit" class="btn-submit">Envoyer</button>
    </form>
</div>
</x-app-layout>

<script src="{{ asset('js/account/setting.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha256-WqU1JavFxSAMcLP2WIOI+GB2zWmShMI82mTpLDcqFUg=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js" integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY=" crossorigin="anonymous"></script>



