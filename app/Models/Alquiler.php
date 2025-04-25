<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo de Eloquent para la entidad Alquiler.
 * Representa un alquiler en la base de datos.
 *
 * @property int $id ID del alquiler.
 * @property float $importe Importe del alquiler.
 * @property string $fechaRecogida Fecha de recogida del vehículo.
 * @property string $lugarRecogida Lugar de recogida del vehículo.
 * @property string $horaRecogida Hora de recogida del vehículo.
 * @property string $fechaEntrega Fecha de entrega del vehículo.
 * @property string $lugarEntrega Lugar de entrega del vehículo.
 * @property string $horaEntrega Hora de entrega del vehículo.
 * @property bool $activo Estado de actividad del alquiler.
 * @property int $clienteID ID del cliente asociado.
 * @property int $vehiculoID ID del vehículo asociado.
 */
class Alquiler extends Model{
    use HasFactory;

    /**
     * Deshabilita los timestamps de Eloquent para este modelo.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Nombre de la tabla asociada a este modelo.
     *
     * @var string
     */
    protected $table = 'alquiler';

    /**
     * Atributos que se pueden asignar de forma masiva.
     *
     * @var array
     */
    protected $fillable = [
        'importe',
        'fechaRecogida',
        'lugarRecogida',
        'horaRecogida',
        'fechaEntrega',
        'lugarEntrega',
        'horaEntrega',
        'activo',
        'clienteID',
    ];

    /**
     * Relación con el modelo Cliente.
     * Indica que un alquiler pertenece a un cliente.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Relación de pertenencia a un cliente.
     */
    public function cliente(): BelongsTo{
        return $this->belongsTo(Cliente::class, "clienteID", "id");
    }

    /**
     * Relación con el modelo Vehículo.
     * Indica que un alquiler pertenece a un vehículo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Relación de pertenencia a un vehículo.
     */
    public function vehiculo(): BelongsTo{
        return $this->belongsTo(Vehiculo::class, "vehiculoID", "id");
    }
}
