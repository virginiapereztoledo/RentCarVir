window.addEventListener('load', function () {
    let today = new Date();
    let nextDay = getNextDay(today);

    let fechaRecogida = document.getElementById('fechaRecogida');
    let fechaEntrega = document.getElementById('fechaEntrega');

    if (fechaRecogida) {
        fechaRecogida.min = dateToString(nextDay);
        let oneYearAfterToday = addYear(today, 1);
        fechaRecogida.max = dateToString(oneYearAfterToday);

        fechaRecogida.addEventListener('change', function () {
            let nextDay = getNextDay(new Date(fechaRecogida.value));
            if (fechaEntrega) {
                fechaEntrega.min = dateToString(nextDay);
                let fechaEntregaValue = new Date(fechaEntrega.value);

                if (nextDay > fechaEntregaValue) {
                    fechaEntrega.value = dateToString(nextDay);
                }
            }
        });
    }

    if (fechaEntrega) {
        let nextNextDay = getNextDay(nextDay);
        fechaEntrega.min = dateToString(nextNextDay);
        let threeYearsAfterToday = addYear(today, 3);
        fechaEntrega.max = dateToString(threeYearsAfterToday);
    }

    // ✅ VALIDACIÓN para evitar envío sin datos
    const reservarButtons = document.querySelectorAll('form[action*="reservar"] button[type="submit"]');

    reservarButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            const form = button.closest('form');

            const fechaRecogida = document.getElementById('fechaRecogida')?.value;
            const lugarRecogida = document.getElementById('lugarRecogida')?.value;
            const horaRecogida = document.getElementById('horaRecogida')?.value;

            const fechaEntrega = document.getElementById('fechaEntrega')?.value;
            const lugarEntrega = document.getElementById('lugarEntrega')?.value;
            const horaEntrega = document.getElementById('horaEntrega')?.value;

            // Validación de los campos necesarios
            if (!fechaRecogida || !lugarRecogida || !horaRecogida || !fechaEntrega || !lugarEntrega || !horaEntrega) {
                e.preventDefault(); // Impide el envío del formulario
                alert(" Por favor, rellena todos los campos de recogida y entrega para poder reservar.");
            }
        });
    });
});
