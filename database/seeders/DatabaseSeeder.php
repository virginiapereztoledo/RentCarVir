<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Empleado;
use Carbon\Carbon;
use App\Models\Vehiculo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void{
        // Default Cliente

        DB::table('cliente')->insert([
            'id' => 1,
            'nombre' => 'cliente',
            'apellidos' => 'cliente',
            'domicilio' => 'random',
            'ocupacion' => 'Estudiante',
            'fechaNacimiento' => date('Y-m-d', mktime(0, 0, 0, 1, 1, 1995)),
            'foto' => 'storage/persona.png',
        ]);


        // Default empleado

        DB::table('empleado')->insert([
            'id' => 1,
            'nombre' => 'empleado',
            'apellidos' => 'empleado',
            'foto' => 'storage/persona.png',
        ]);

        //Default Usuarios

        DB::table('usuario')->insert([
            [
                'id' => 1,
                'username' => 'clientecliente',
                'password' => bcrypt('Focr12345@'),
                'utenteable_id' => 1,
                'utenteable_type' => 'App\Models\Cliente',
                'remember_token' => Str::random(10)
            ],

            [
                'id' => 2,
                'username' => 'empleadoempleado',
                'password' => bcrypt('Focr12345@'),
                'utenteable_id' => 1,
                'utenteable_type' => 'App\Models\Empleado',
                'remember_token' => Str::random(10)
            ],

            // Admin

            [
                'id' => 3,
                'username' => 'adminadmin',
                'password' => bcrypt('Admin1'),
                'utenteable_id' => null,
                'utenteable_type' => "Admin",
                'remember_token' => Str::random(10)
            ]
        ]);

        // Cliente
        Cliente::factory()->hasUsuario(1)->count(20)->create();

        // Empleado
        Empleado::factory()->hasUsuario(1)->count(20)->create();


        DB::table('vehiculo')->insert([
            [
                'matricula' => "4436MRF",
                'modelo' => "Model S",
                'marca' => "Tesla",
                'motor' => "Electrico",
                'cambio' => "Automatico",
                'equipamiento' => 'navegador',
                'puertas' => "4",
                'asientos' => "5",
                'autonomia' => 600,
                'color' => "blanco",
                'foto' => "storage/vehiculo/10.jpg",
                'descripcion' => "El Tesla Model S es un sedán eléctrico de lujo y alto rendimiento. Es conocido por su aceleración rápida, su gran autonomía y su diseño futurista. El Model S ofrece un interior espacioso y lujoso con una pantalla táctil grande y un sistema de infoentretenimiento avanzado. Además, cuenta con características de conducción autónoma de Tesla.",
                'emision' => date('Y-m-d', mktime(0, 0, 0, 8, 9, 2023)),
                'vencimiento' => date('Y-m-d', mktime(0, 0, 0, 8, 9, 2024)),
                'costoDiario' => 90.00,
            ],
            [
                'matricula' => "2323MMD",
                'modelo' => "Model 3",
                'marca' => "Tesla",
                'motor' => "Electrico",
                'cambio' => "Automatico",
                'equipamiento' => 'navegador',
                'puertas' => "4",
                'asientos' => "5",
                'autonomia' => 540,
                'color' => "negro",
                'foto' => "storage/vehiculo/9.png",
                'descripcion' => "El Tesla Model 3 es un sedán eléctrico de lujo con un diseño aerodinámico y una excelente autonomía. Es conocido por su rendimiento impresionante, su amplio espacio interior y sus características de seguridad avanzadas. El Model 3 ofrece una experiencia de conducción emocionante y está equipado con tecnología innovadora de Tesla.",
                'emision' => date('Y-m-d', mktime(0, 0, 0, 8, 9, 2023)),
                'vencimiento' => date('Y-m-d', mktime(0, 0, 0, 8, 9, 2024)),
                'costoDiario' => 80.00,
            ],
            [
                'matricula' => "4423MJD",
                'modelo' => "ID. Buzz",
                'marca' => "Volkswagen",
                'motor' => "Electrico",
                'cambio' => "Manual",
                'equipamiento' => 'Full',
                'puertas' => "4",
                'asientos' => "7",
                'autonomia' => 640,
                'color' => "verde",
                'foto' => "storage/vehiculo/9.png",
                'descripcion' => "El ID. Buzz impresiona no solo por su encanto único, sino también por la tecnología de última generación y una sensación de espacio completamente nueva, lo que lo convierte en un compañero agradable e inteligente para cualquier aventura.",
                'emision' => date('Y-m-d', mktime(0, 0, 0, 8, 9, 2023)),
                'vencimiento' => date('Y-m-d', mktime(0, 0, 0, 8, 9, 2024)),
                'costoDiario' => 40.00,
            ],
            [
                'matricula' => "1212MSD",
                'modelo' => "Leaf",
                'marca' => "Nissan",
                'motor' => "Electrico",
                'cambio' => "Automatico",
                'equipamiento' => 'navegador',
                'puertas' => "4",
                'asientos' => "5",
                'autonomia' => 270,
                'color' => "verde",
                'foto' => "storage/vehiculo/3.jpg",
                'descripcion' => "El Nissan Leaf es un automóvil eléctrico compacto que ofrece una conducción suave y silenciosa. Es ideal para viajes urbanos y cuenta con tecnología avanzada de asistencia al conductor y un diseño aerodinámico. Con su motor eléctrico eficiente, el Leaf ofrece una autonomía impresionante y es respetuoso con el medio ambiente.",
                'emision' => date('Y-m-d', mktime(0, 0, 0, 8, 9, 2023)),
                'vencimiento' => date('Y-m-d', mktime(0, 0, 0, 8, 9, 2024)),
                'costoDiario' => 20.00,
            ],
            [
                'matricula' => "9987MNB",
                'modelo' => "i3",
                'marca' => "BMW",
                'motor' => "Electrico",
                'cambio' => "Automatico",
                'equipamiento' => 'navegador',
                'puertas' => "4",
                'asientos' => "4",
                'autonomia' => 260,
                'color' => "gris",
                'foto' => "storage/vehiculo/4.jpg",
                'descripcion' => "El BMW i3 es un vehículo eléctrico compacto que combina un diseño moderno con tecnología avanzada. Es ideal para conducir en entornos urbanos y ofrece una experiencia de conducción ágil y divertida. Además de su impresionante autonomía, el i3 cuenta con características de seguridad y comodidad de última generación.",
                'emision' => date('Y-m-d', mktime(0, 0, 0, 8, 9, 2023)),
                'vencimiento' => date('Y-m-d', mktime(0, 0, 0, 8, 9, 2024)),
                'costoDiario' => 25.00,
            ],
            [
                'matricula' => "8876MSD",
                'modelo' => "ZS EV",
                'marca' => "MG",
                'motor' => "Electrico",
                'cambio' => "Automatico",
                'equipamiento' => 'navegador',
                'puertas' => "4",
                'asientos' => "5",
                'autonomia' => 260,
                'color' => "gris",
                'foto' => "storage/vehiculo/8.jpg",
                'descripcion' => "El MG ZS EV es un SUV eléctrico compacto y asequible que ofrece una excelente relación calidad-precio. Con su diseño moderno y su amplio espacio interior, el ZS EV es perfecto para la vida urbana. Además, cuenta con tecnología avanzada y una autonomía impresionante, lo que lo convierte en una opción ideal para aquellos que buscan un vehículo eléctrico económico.",
                'emision' => date('Y-m-d', mktime(0, 0, 0, 8, 9, 2023)),
                'vencimiento' => date('Y-m-d', mktime(0, 0, 0, 8, 9, 2024)),
                'costoDiario' => 30.00,
            ],
            [
                'matricula' => "9767MJU",
                'modelo' => "Kona Electric",
                'marca' => "Hyundai",
                'motor' => "Electrico",
                'cambio' => "Automatico",
                'equipamiento' => 'navegador',
                'puertas' => "4",
                'asientos' => "5",
                'autonomia' => 415,
                'color' => "azul",
                'foto' => "storage/vehiculo/9.jpg",
                'descripcion' => "El Hyundai Kona Electric es un SUV eléctrico versátil y eficiente que ofrece un excelente valor por su precio. Con una amplia autonomía y un interior cómodo y bien equipado, el Kona Electric es una excelente opción para aquellos que buscan un vehículo eléctrico asequible sin comprometer el rendimiento ni la calidad.",
                'emision' => date('Y-m-d', mktime(0, 0, 0, 8, 9, 2023)),
                'vencimiento' => date('Y-m-d', mktime(0, 0, 0, 8, 9, 2024)),
                'costoDiario' => 40.00,
            ],
            [
                'matricula' => "3446MKM",
                'modelo' => "Spring",
                'marca' => "Dacia",
                'motor' => "Electrico",
                'cambio' => "Automatico",
                'equipamiento' => 'navegador',
                'puertas' => "4",
                'asientos' => "4",
                'autonomia' => 230,
                'color' => "blanco",
                'foto' => "storage/vehiculo/12.jpg",
                'descripcion' => "El Dacia Spring es un coche eléctrico compacto y asequible perfecto para la movilidad urbana. Con un diseño sencillo y funcional, el Spring ofrece una conducción cómoda y eficiente. Su autonomía y su bajo coste de mantenimiento lo convierten en una opción popular para aquellos que buscan un vehículo eléctrico económico y práctico.",
                'emision' => date('Y-m-d', mktime(0, 0, 0, 8, 9, 2023)),
                'vencimiento' => date('Y-m-d', mktime(0, 0, 0, 8, 9, 2024)),
                'costoDiario' => 20.00,
            ],

        ]);

        $cliente = Cliente::where("id", ">", 3)->take(5)->get();

        $fechaRecogida = Carbon::now();
        $fechaEntrega =  Carbon::now()->addMonth();
        for ($i = 0; $i < 5; $i++) {
            DB::table('alquiler')->insert([
                'id' => $i + 1,
                'clienteID' => $cliente[$i]->id,
                'vehiculoID' => $i + 1,
                'importe' => Vehiculo::find($i + 1)->CostoDiario * date_diff($fechaRecogida, $fechaEntrega)->days,
                'fechaRecogida' => $fechaRecogida->toDate(),
                'lugarRecogida' => 'Fuengirola',
                'horaRecogida' => '08:30',
                'fechaEntrega' => $fechaEntrega->toDate(),
                'lugarEntrega' => 'Fuengirola',
                'horaEntrega' => '08:30',
                'activo' => true,
            ]);

            $fechaRecogida->addMonth();
            $fechaEntrega->addMonth();
        }
    }
}
