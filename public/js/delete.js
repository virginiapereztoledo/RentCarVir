document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('delete-all').addEventListener('click', function () {
        if (confirm('¿Estás seguro de que deseas eliminar a todos los clientes?')) {
            const form = this.closest('form');
            form.submit();
        }
    });
});
