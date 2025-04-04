const bioInput = document.getElementById('bio');
const charCount = document.getElementById('charCount');
const maxLength = 200;

bioInput.addEventListener('input', () => {
    const currentLength = bioInput.value.length;
    charCount.textContent = `${currentLength} / ${maxLength}`;

    // Changer la couleur en rouge si on atteint la limite
    if (currentLength === maxLength) {
        charCount.classList.add('red');
    } else {
        charCount.classList.remove('red');
    }
});

function openModal() {
    document.getElementById('photoModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('photoModal').style.display = 'none';
}

function triggerFileInput() {
    document.getElementById('fileInput').click();
}
// Prévisualisation de l'image sélectionnée
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function () {
        const output = document.getElementById('profile-picture');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
