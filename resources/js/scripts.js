function toggleDetails(id) {
    var details = document.getElementById('details-' + id);
    if (details.style.display === 'none') {
        details.style.display = 'block';
    } else {
        details.style.display = 'none';
    }
}

function validateForm(event) {
    var checkboxes = document.querySelectorAll('input[name="softwares[]"]');
    var isChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);

    if (!isChecked) {
        event.preventDefault();
        alert("Por favor, selecione pelo menos um software.");
    }
}

document.getElementById('menu-btn').addEventListener('click', function() {
    var menu = document.getElementById('mobile-menu');
    menu.classList.toggle('-translate-x-full');
});

document.getElementById('software-selection-form').addEventListener('submit', function(event) {
    event.preventDefault(); 

    var loadingSpinner = document.getElementById('loading-spinner');
    loadingSpinner.classList.remove('hidden'); 

    var formData = new FormData(this);

    fetch('{{ route("free.selecionar") }}', {
        method: 'POST',
        body: formData,
        /*headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Inclua o token CSRF se necessário
        }*/
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        loadingSpinner.classList.add('hidden'); 

        console.log('Dados recebidos:', data);
        alert("Softwares selecionados com sucesso!");

        if (data.desktops && Array.isArray(data.desktops)) {
            console.log('Desktops recebidos:', data.desktops);

            var formContainer = document.getElementById('software-selection-form');
            formContainer.style.display = 'none';

            const desktopsContainer = document.getElementById('desktops-container');
            desktopsContainer.innerHTML = '';

            data.desktops.forEach(desktop => {
                const desktopItem = document.createElement('div');
                desktopItem.classList.add('desktop-item', 'bg-zinc-800', 'p-4', 'rounded-lg', 'shadow', 'mb-4');

                desktopItem.innerHTML = `
                    <h3 class="text-xl font-semibold mb-2">Categoria: ${desktop.categoria}</h3>
                    <p><strong>CPU:</strong> ${desktop.componentes.CPU}</p>
                    <p><strong>Cooler:</strong> ${desktop.componentes.Cooler}</p>
                    <p><strong>Fonte:</strong> ${desktop.componentes.Fonte}</p>
                    <p><strong>GPU:</strong> ${desktop.componentes.GPU}</p>
                    <p><strong>HD:</strong> ${desktop.componentes.HD}</p>
                    <p><strong>MOTHERBOARD:</strong> ${desktop.componentes.MOTHERBOARD}</p>
                    <p><strong>RAM:</strong> ${desktop.componentes.RAM}</p>
                `;

                desktopsContainer.appendChild(desktopItem);
            });

            desktopsContainer.style.display = 'block';
            console.log('Desktops exibidos com sucesso.');
        } else {
            console.error('Dados recebidos não estão no formato esperado:', data);
        }
    })
    .catch(error => {
        loadingSpinner.classList.add('hidden'); 
        console.error('Erro:', error);
        alert("Ocorreu um erro ao selecionar os softwares.");
    });
});