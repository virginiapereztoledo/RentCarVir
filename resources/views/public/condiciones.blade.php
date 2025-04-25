@extends("public.layout.public-layout")
@section("title", "Condiciones")

@section("content")
<section class="container my-5 pt-4">
    <div class="text-center mb-5">
        <h1 class="mb-4">Términos y Condiciones</h1>
        <p class="lead">
            El alquiler de vehículos por parte de Rent Car Vir se rige por las siguientes condiciones generales. A continuación, se detallan los aspectos más importantes que debe conocer.
        </p>
    </div>
    <div class="row">
        <div class="col-md-12 mb-4">
            <section class="bg-light p-4 rounded">
                <h2 class="interior">Términos y Condiciones Generales</h2>
                <p class="oscuro">
                    En Rent Car Vir, nos comprometemos a brindarle un servicio claro y sin sorpresas. En nuestras oficinas encontrará los documentos fundamentales que rigen nuestro servicio de alquiler:
                </p>
                <ul>
                    <li><strong>Política de Privacidad:</strong> Explica cómo gestionamos y protegemos su información personal.</li>
                    <li><strong>Acuerdo de Alquiler: </strong> Documento que debe firmar al momento de alquilar un vehículo, confirmando su aceptación de nuestras condiciones.</li>
                    <li><strong>Tarifas: </strong> Incluye todas las tarifas de alquiler y cualquier cargo adicional aplicable.</li>
                    <li><strong>Normas de Daños: </strong> Detalla los procedimientos y reglas a seguir en caso de que el vehículo sufra daños durante el alquiler.</li>
                </ul>
                <p class="oscuro">
                    Estos documentos estarán disponibles en formato físico en nuestras oficinas. Al firmar el Acuerdo de Alquiler, usted declara haber leído y aceptado todos los términos. Si lo prefiere, podemos enviárselos por correo electrónico.
                </p>
            </section>
        </div>
        <div class="col-md-6 mb-4">
            <section class="bg-light p-4 rounded">
                <h2 class="interior">Acceso a Servicios</h2>
                <p class="oscuro">
                    Podrá explorar nuestras opciones sin necesidad de registro, pero para alquilar un vehículo, deberá estar registrado. El registro está disponible para:
                </p>
                <ul>
                    <li>Personas con un permiso de conducción tipo B.</li>
                    <li>Personas mayores de 18 años.</li>
                </ul>
                <p class="oscuro">
                    Si aún no tiene cuenta, puede registrarse de forma gratuita haciendo clic en <a href="{{ route('register') }}" class="text-primary">este enlace</a>.
                </p>
            </section>
        </div>
        <div class="col-md-6 mb-4">
            <section class="bg-light p-4 rounded">
                <h2 class="interior">Preguntas Frecuentes</h2>
                <p class="oscuro">
                    ¿Tienes dudas? Estamos para ayudarte. Contamos con un servicio de atención telefónica gratuito. Déjanos tu número y te llamaremos lo antes posible.
                </p>
                <address>
                    <a href="tel:+34 93 555 2368" title="Número de asistencia" class="d-block mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill me-2" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                        </svg>
                        +34 111 222 333
                    </a>
                    <a href="mailto:GreenCarRent@soporte.com" title="E-mail Empleado" class="d-block mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill me-2" viewBox="0 0 16 16">
                            <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z" />
                        </svg>
                        RentCarVir@soporte.com
                    </a>
                    <iframe src="https://www.google.com/maps/embed?pb=!3m2!1ses!2ses!4v1743862067771!5m2!1ses!2ses!6m8!1m7!1sPexdKK0Eg1HAw5iL7_EhpQ!2m2!1d36.53322161786441!2d-4.624847314905856!3f141.61265204877387!4f-6.093175658330367!5f0.7820865974627469" width="550" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        Calle Miguel Marquez, 29640 Fuengirola, Málaga, España
                    </a>
                </address>
            </section>
        </div>
    </div>
</section>
@endsection
