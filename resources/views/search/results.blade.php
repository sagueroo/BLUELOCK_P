<x-app-layout>
    <div class="container">
        <!-- Recherche pour Utilisateurs -->
        <div class="search-section">
            <h3 class="section-title">Résultat pour Utilisateurs</h3>
            <div class="results">
                @forelse($users as $user)
                    <p class="result-item">{{ $user->name }}</p>
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
                    <p class="result-item">{{ $sport->name }}</p>
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
                    <p class="result-item">{{ $post->content }}</p>
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
                    <p class="result-item">{{ $event->title }}</p>
                @empty
                    <p class="no-results">Aucun évènement trouvé.</p>
                @endforelse
            </div>
        </div>
    </div>
    <style>
        /* Container principal */
        .container {
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

        /* Élément de résultat */
        .result-item {
            font-size: 1rem;
            color: #2d3748;
            margin-bottom: 0.25rem;
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
