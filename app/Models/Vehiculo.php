<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo Vehiculo.
 *
 * Representa la tabla 'vehiculo' y define las relaciones
 * con el modelo 'Alquiler'.
 *
 * @property int $id del vehículo.
 * @property string $matricula  del vehículo.
 * @property string $modelo del vehículo.
 * @property string $marca del vehículo.
 * @property string $motor del vehículo.
 * @property string $cambio El tipo de cambio (transmisión) del vehículo.
 * @property string $equipamiento adicional del vehículo.
 * @property string $puertas El número de puertas del vehículo.
 * @property string $asientos del vehículo.
 * @property float $autonomia del vehículo.
 * @property string $color
 * @property string|null $foto puede ser nula.
 * @property string|null $descripcion puede ser nula.
 * @property string $emision La fecha de emisión.
 * @property string $vencimiento La fecha de vencimiento.
 * @property float $costoDiario .
 */
class Vehiculo extends Model{
    use HasFactory;

    /**
     * La tabla asociada a este modelo.
     *
     * @var string
     */
    protected $table = 'vehiculo';

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array<string>
     */
    protected $fillable = [
        'matricula',
        'modelo',
        'marca',
        'motor',
        'cambio',
        'equipamiento',
        'puertas',
        'asientos',
        'autonomia',
        'color',
        'foto',
        'descripcion',
        'emision',
        'vencimiento',
        'costoDiario',
        'lat', // <-- añade esto
        'lng',
    ];

    /**
     * Define la relación de uno a muchos con el modelo Alquiler.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function alquiler(): HasMany{
        return $this->hasMany(Alquiler::class, "vehiculoID", "id");
    }
    public function localizaciones()
    {
        return $this->hasMany(Localizacion::class);
    }
}
