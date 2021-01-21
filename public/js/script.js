// Delete button warning
const deleteButtons = document.getElementsByClassName('button-red');
if (deleteButtons) {
    for (const button of deleteButtons) {
        button.addEventListener('click', e => confirm('Doorgaan met deze actie?') || e.preventDefault());
    }
}

// Image preview
const previewInput = document.getElementsByClassName('preview-input')[0];
const previewImg = document.getElementsByClassName('preview-img')[0];
if (previewInput) {
    previewInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            if (!['image/jpeg', 'image/gif', 'image/png'].includes(this.files[0].type)) {
                previewImg.classList.add('hidden');
                return;
            }
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
            };
            reader.readAsDataURL(this.files[0]);
            previewImg.classList.remove('hidden');
        }
    });
}

// Menu toggle
const lines = document.getElementsByClassName('toggle-line');
const menus = document.getElementsByClassName('menu');
let firstToggle = true;
let isOpen = false;
document.getElementById('menu-toggle').addEventListener('click', e => {
    e.preventDefault();
    for (const menu of menus) {
        menu.classList[isOpen ? 'remove' : 'add']('open');
    }
    if (firstToggle) {
        for (const line of lines) {
            line.classList.add('line-animation');
            firstToggle = false;
            isOpen = true;
        }
    } else {
        for (const line of lines) {
            line.classList[isOpen ? 'add' : 'remove']('line-animation-return');
        }
        isOpen = !isOpen;
    }
});
