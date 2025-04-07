function confirmDeletePost(postId) {
    document.getElementById('deletePostForm').action = `/post/${postId}`;
    document.getElementById('confirmPostModal').style.display = 'block';
}

function closePostModal() {
    document.getElementById('confirmPostModal').style.display = 'none';
}
