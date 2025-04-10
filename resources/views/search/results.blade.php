<x-app-layout>
    <h2>Résultats pour "{{ $query }}"</h2>

    <h3>Utilisateurs</h3>
    @forelse($users as $user)
        <p>{{ $user->name }}</p>
    @empty
        <p>Aucun utilisateur trouvé.</p>
    @endforelse

    <h3>Évènements</h3>
    @forelse($events as $event)
        <p>{{ $event->title }}</p>
    @empty
        <p>Aucun évènement trouvé.</p>
    @endforelse

    <h3>Posts</h3>
    @forelse($posts as $post)
        <p>{{ $post->description }}</p>
    @empty
        <p>Aucune team trouvée.</p>
    @endforelse
</x-app-layout>
