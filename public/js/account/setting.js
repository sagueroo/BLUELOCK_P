const bioInput = document.getElementById('bio');
const charCount = document.getElementById('charCount');
const maxLength = 200;

bioInput.addEventListener('input', () => {
    const currentLength = bioInput.value.length;
    charCount.textContent = `${currentLength} / ${maxLength}`;

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
let cropper;
const fileInput = document.getElementById('fileInput');
const preview = document.getElementById('crop-preview');
const confirmBtn = document.getElementById('confirmCrop');

fileInput.addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function () {
            preview.src = reader.result;
            preview.style.display = 'block';
            confirmBtn.style.display = 'inline-block';

            if (cropper) {
                cropper.destroy();
            }

            cropper = new Cropper(preview, {
                aspectRatio: 1,
                viewMode: 1,
                background: false,
                movable: true,
                zoomable: true,
                rotatable: false,
                scalable: false,
                autoCropArea: 1
            });
        };
        reader.readAsDataURL(file);
    }
});

confirmBtn.addEventListener('click', function () {
    if (cropper) {
        cropper.getCroppedCanvas().toBlob((blob) => {
            const formData = new FormData();
            formData.append('profile_photo', blob); // 👈 même nom que dans ton contrôleur

            fetch("/profile/photo", { // 👈 ici l'URL vers ta route Laravel
                method: "POST",
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            }).then(response => {
                if (response.ok) {
                    window.location.reload();
                } else {
                    alert("Erreur lors de la mise à jour de la photo de profil.");
                }
            });
        }, 'image/jpeg');
    }
});
