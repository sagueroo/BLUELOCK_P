{{--Dans cette page, nous avons repris les différents formats des autres pages (affichage des users,
posts, events, sports), cela reste du copier / coller d'où le faite que la page reste assez 'grosse' en terme de code--}}
<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/viewMore.css') }}">
    <link rel="stylesheet" href="{{ asset('css/blueSport.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/blueEvent.css') }}">
    <div class="result">
        <!-- Recherche pour Utilisateurs -->
        <div class="search-section">
            <h3 class="section-title">Résultat pour Utilisateurs</h3>
            <div class="user-list">
                @forelse($users as $index => $user)
                    <a href="{{ route('account.show', ['id' => $user->id]) }}">
                    <div class="user-row {{ $index % 2 === 0 ? 'even' : 'odd' }}">
                        <img src="{{ $user->profile_photo_url ?? asset('images/default-profile.png') }}" alt="{{ $user->name }}" class="profile-pic">
                        <span class="user-info">{{ $user->name }} - {{ $user->email }}</span>
                    </div>
                    </a>
                @empty
                    <p class="no-results">Aucun utilisateur trouvé.</p>
                @endforelse
            </div>
        </div>
        <hr class="separator">

        <!-- Recherche pour Sports -->
        <div class="search-section">
            <h3 class="section-title">Résultat pour Sports</h3>
            <div class="results">
                @forelse($sports as $sport)
                    <div class="sport">
                        <p>{{$sport->name}}</p>
                        @if($sport->isRegistered)
                            <form action="{{ route('deleteSport') }}" method="POST">
                                @csrf
                                <input type="hidden" name="sport_id" value="{{ $sport->id }}">
                                <button type="submit" class="locker-btn2" >ALREADY REGISTERED</button>
                            </form>
                        @else
                            <form action="{{ route('addSport') }}" method="POST">
                                @csrf
                                <input type="hidden" name="sport_id" value="{{ $sport->id }}">
                                <x-locker-btn/>
                            </form>
                        @endif
                    </div>
                    @empty
                    <p class="no-results">Aucun sport trouvé.</p>
                @endforelse
            </div>
        </div>
        <hr class="separator">

        <!-- Recherche pour Publications -->
        <div class="search-section">
            <h3 class="section-title">Résultat pour Publications</h3>
            <div class="results">
                @forelse($posts as $post)
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
                @empty
                    <p class="no-results">Aucune publication trouvée.</p>
                @endforelse
            </div>
        </div>
        <hr class="separator">

        <!-- Recherche pour Évènements -->
        <div class="search-section">
            <h3 class="section-title">Résultat pour Évènements</h3>
            <div class="results">
                @forelse($events as $event)
                    <div class="event-card" data-type="{{$event->type}}">
                        <h2>{{$event->title}}</h2>
                        <p><strong>Sport:</strong> {{$event->sport->name}}</p>
                        <p><strong>Date:</strong> {{$event->date}}</p>
                        <p><strong>Time:</strong> {{$event->time}}</p>
                        <p><strong>Location:</strong> {{$event->location}}</p>
                        <p><strong>Description:</strong> {{$event->description}}</p>
                        <p><strong>Number of Registered:</strong> {{$event->place_prises}} / {{$event->max_participants}}</p>
                        @php
                            $isRegistered = $event->users->contains(auth()->id());
                        @endphp
                        <form action="{{ $isRegistered ? route('leaveEvent', $event->id) : route('joinEvent', $event->id) }}" method="POST">
                            @csrf
                            @if($isRegistered)
                                @method('DELETE')
                            @endif
                            <button type="submit" class="join-btn {{ $isRegistered ? 'joined' : '' }}">
                                {{ $isRegistered ? 'Leave' : 'Join' }}
                            </button>
                        </form>
                        @if($event->user)
                            <div class="event-creator">
                                <p>Created by: <strong>{{ $event->user->name }}</strong></p>
                            </div>
                        @else
                            <div class="event-creator">
                                <p>Creator info not available</p>
                            </div>
                        @endif
                    </div>
                @empty
                    <p class="no-results">Aucun évènement trouvé.</p>
                @endforelse
            </div>
        </div>
    </div>
    <x-trending/>
    <style>
        /* Container principal */
        .result {
            max-width: 1280px;
            margin: 0 auto;
            padding-left: 1rem;
            padding-right: 1rem;
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        /* Section Recherche */
        .search-section {
            margin-bottom: 1rem;
        }

        /* Titre de chaque section */
        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
        }

        /* Résultats */
        .results {
            margin-bottom: 0.75rem;
            padding-left: 1rem;
        }

        /* Aucune donnée trouvée */
        .no-results {
            font-size: 1rem;
            color: #a0aec0;
        }

        /* Séparateur fin (trait gris) */
        .separator {
            width: 100%;
            border-top: 1px solid #e2e8f0;
            margin-top: 0.5rem;
            margin-bottom: 1.5rem;
        }
    </style>
</x-app-layout>
