// resources/js/actualizar-ubicacion.js

async function actualizarUbicacion(id, direccion) {
    try {
        const response = await axios.put(`/api/vehiculo/${id}/actualizar-localizacion`, {
            direccion: direccion
        });

        console.log('Ubicación actualizada:', response.data);
        // Aquí puedes actualizar el marcador en el mapa o la vista
    } catch (error) {
        console.error('Error al actualizar la ubicación:', error.response ? error.response.data : error);
    }
}
