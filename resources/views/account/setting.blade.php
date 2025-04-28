<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" integrity="sha256-jKV9n9bkk/CTP8zbtEtnKaKf+ehRovOYeKoyfthwbC8=" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/account/setting.css') }}">

    <div class="contain">

        <h2>Edit Profile</h2>

        {{-- Profile header with photo and username --}}
        <div class="profile-header">
            <div style="display: flex; align-items: center;">
                <img
                    id="profile-picture"
                    src="{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : asset('pictures/pop.png') }}"
                    alt="Profile Picture"
                    class="profile-photo"
                >
                <p style="margin-left: 15px; font-weight: bold;">{{ Auth::user()->name }}</p>
            </div>

            {{-- Button editing profile picture --}}
            <button class="btn-edit-photo" onclick="openModal()">Edit photo</button>
        </div>

        {{-- Modal popup for photo actions --}}
        <div id="photoModal" class="modal">
            <div class="modal-content">
                <h3>Edit Profile Photo</h3>

                {{-- Button to import a new photo --}}
                <button onclick="triggerFileInput()">Import photo</button>

                {{-- Hidden form to upload the new profile photo --}}
                <form id="uploadForm" style="display: none;">
                    @csrf
                    <input type="file" id="fileInput" name="profile_photo" accept="image/*">
                </form>

                {{-- Preview of the image to crop --}}
                <div>
                    <img id="crop-preview" style="max-width: 100%; display: none;" alt="preview">
                </div>

                <button id="confirmCrop" style="display: none;">Confirm Photo</button>

                {{-- Form to delete the current profile picture --}}
                <form action="{{ route('profile.deletePhoto') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete-photo" style="color: red;">Delete current photo</button>
                </form>

                <button onclick="closeModal()">Cancel</button>
            </div>
        </div>

        {{-- Form to update user bio --}}
        <form action="{{ route('profile.updateBio') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="bio">Bio</label>

                {{-- Bio textarea with character counter --}}
                <textarea
                    id="bio"
                    name="bio"
                    rows="4"
                    maxlength="200"
                    placeholder="Your bio...">{{ Auth::user()->bio }}</textarea>

                <div id="charCount" class="char-counter">{{ strlen(Auth::user()->bio) }} / 200</div>
            </div>
            <button type="submit" class="btn-submit">Send</button>
        </form>
    </div>
</x-app-layout>

{{-- Scripts for jQuery, Bootstrap, Cropper.js, and custom settings --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/account/setting.js') }}"></script>
{{--DO--}}
