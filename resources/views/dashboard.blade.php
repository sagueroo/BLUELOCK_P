<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <div class="wrapper">
        <main class="content">
            <!-- Formulaire de création de post -->

            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="message-box">
                    <a href="{{ route('account.show') }}">
                        <img src="{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : asset('pictures/pop.png') }}"
                             alt="Photo de profil"
                             class="nav-profile-pic">
                    </a>
                    <input type="text" name="contenu" placeholder="Want to chat ?" required>

                    <!-- Ajouter un champ caché pour sport_id -->
                    <select name="sport_id" required>
                        @foreach($sports as $sport)
                            <option value="{{ $sport->id }}">{{ $sport->name }}</option>
                        @endforeach
                    </select>

                    <!-- Bouton pour uploader une image -->
                    <label for="image-upload" class="upload-icon">
                        <img src="{{ asset('pictures/file.png') }}" alt="Upload File">
                    </label>
                    <input type="file" name="image" id="image-upload" accept="image/jpeg, image/jpg, image/png" hidden>

                    <button type="submit" class="locker-btn">LOCKER</button>
                </div>
            </form>


            <!-- Affichage des posts -->
            <!-- Affichage des posts -->
            @foreach($posts as $post)
                <div class="post">
                    <div class="post-header">
                        <a href="{{ route('account.show', ['id' => $post->user->id]) }}">
                            <img src="{{ $post->user->profile_photo_path ? (\Illuminate\Support\Str::startsWith($post->user->profile_photo_path, 'http') ? $post->user->profile_photo_path : asset('storage/' . $post->user->profile_photo_path)) : asset('pictures/pop.png') }}"
                                 alt="Photo de profil"
                                 class="nav-profile-pic">
                        </a>
                        <div class="post-info">
                            <!-- Lien vers le profil de l'utilisateur -->
                            <a href="{{ route('account.show', ['id' => $post->user->id]) }}">
                                <strong>{{ $post->user->name }}</strong>
                            </a>
                            <span class="post-time">{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <!-- Affichage de l'image si elle existe -->
                    @if($post->image_path)
                        <img src="{{ asset('storage/' . $post->image_path) }}" alt="Image du post" class="post-image">
                    @endif
                    <p>{{ $post->content }}</p>
                </div>
            @endforeach

        </main>

        <x-trending />
    </div>
</x-app-layout>
