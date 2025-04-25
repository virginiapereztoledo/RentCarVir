document.addEventListener('DOMContentLoaded', function() {

    const validImageTypes = ['image/jpg', 'image/jpeg', 'image/png'];
    const imageInput = document.querySelector('[data-id="image"]');
    const imagePreview = document.querySelector('[data-id="image-item"]');
    const imageItemInput = document.getElementById('image-item-input');

    // Función para manejar cambios en el input de imagen
    function handleImageChange(event) {
        const file = event.target.files[0];

        // Crear un lector de archivos
        const reader = new FileReader();

        reader.onload = function(e) {
            // Establecer el src de la vista previa de la imagen
            imagePreview.src = e.target.result;
        };

        // Verificar si el tipo de archivo es válido
        if (validImageTypes.includes(file.type)) {
            // Leer el archivo como URL de datos
            reader.readAsDataURL(file);
        } else {
            // Mostrar un mensaje de error si el archivo no es válido
            if (!document.getElementById('image-error')) {
                const errorElement = document.createElement('p');
                errorElement.className = 'errorLabel';
                errorElement.id = 'image-error';
                errorElement.textContent = 'Archivo no válido';
                imageItemInput.appendChild(errorElement);
            }
        }
    }

    // Añadir evento de cambio al input de imagen
    imageInput.addEventListener('change', handleImageChange);
});
