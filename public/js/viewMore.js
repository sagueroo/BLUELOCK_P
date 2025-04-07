const eventId = "{{ $event->id }}";
function confirmRemoval(userId, userName) {
    document.getElementById('modalText').innerText = `Voulez-vous supprimer ${userName} de votre événement ?`;
    document.getElementById('removeUserForm').action = `/removeUser/${eventId}/${userId}`;
    document.getElementById('confirmModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('confirmModal').style.display = 'none';
}
