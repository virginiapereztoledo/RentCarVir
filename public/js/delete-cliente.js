document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.client-to-delete');

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const clientId = this.id;
            const clientName = this.dataset.username;
            if (confirm(`¿Estás seguro de que deseas eliminar al cliente ${clientName}?`)) {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch(deleteUrl, { // Cambia a deleteUrl
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({ id: clientId }),
                })
                .then(response => {
                    if (response.ok) {
                        // Actualizar la tabla de clientes para reflejar el cambio
                        window.location.reload();
                    } else {
                        console.error('Error al eliminar el cliente');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    });
});
