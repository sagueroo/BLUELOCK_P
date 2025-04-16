function confirmDeletePost(postId) {
    const modal = document.getElementById('confirmPostModal');
    const form = document.getElementById('deletePostForm');

    // Met à jour l'action du formulaire avec l'ID du post à supprimer
    form.action = `/posts/${postId}`;
    modal.style.display = 'block';
}

function closePostModal() {
    const modal = document.getElementById('confirmPostModal');
    modal.style.display = 'none';
}

// Fermer la modal si on clique en dehors
window.onclick = function(event) {
    const modal = document.getElementById('confirmPostModal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
}
