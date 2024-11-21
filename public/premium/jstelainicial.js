document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('input[name="softwares[]"]');


    checkboxes.forEach(checkbox => {
        checkbox.checked = false;
    });


    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', handleCheckboxLimit);
    });
});

function handleCheckboxLimit() {
    const checkedCount = document.querySelectorAll('input[name="softwares[]"]:checked').length;

    if (checkedCount > 3) {
        showAlert('Você pode selecionar no máximo 3 softwares.');
        this.checked = false;  // Desmarca o checkbox que ultrapassa o limite
    }
}

function toggleFillAndDetails(id, description) {
    const checkbox = document.getElementById(`software${id}`);
    const checkedCount = document.querySelectorAll('input[name="softwares[]"]:checked').length;


    if (!checkbox.checked && checkedCount >= 3) {
        showAlert('Você pode selecionar no máximo 3 softwares.');
        return;
    }


    toggleCheckbox(id);
    toggleFillCard(id);
    toggleDetails(id, description);
}

function toggleCheckbox(id) {
    const checkbox = document.getElementById(`software${id}`);
    checkbox.checked = !checkbox.checked;


    handleCheckboxLimit.call(checkbox);
}

function toggleFillCard(id) {
    const card = document.getElementById(`checkboxDiv${id}`);
    card.classList.toggle('filled-card');
}

function toggleDetails(id, description) {
    const details = document.getElementById('details-' + id);
    if (details.style.display === 'none') {
        details.style.display = 'block';
        typeWriterEffect(`description-${id}`, description);
    } else {
        details.style.display = 'none';
    }
}

function typeWriterEffect(elementId, text, speed = 20) {
    const element = document.getElementById(elementId);
    element.innerHTML = '';
    let i = 0;

    function type() {
        if (i < text.length) {
            element.innerHTML += text.charAt(i);
            i++;
            setTimeout(type, speed);
        }
    }

    type();
}


function showAlert(message) {
    const alertBox = document.getElementById('selectionAlert');
    alertBox.classList.remove('hidden');
    alertBox.querySelector('p').textContent = message;


    setTimeout(() => {
        alertBox.classList.add('hidden');
    }, 3000);
}


