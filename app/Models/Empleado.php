<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * Modelo de Eloquent para la entidad Empleado.
 * Representa un empleado en la base de datos.
 *
 * @property int $id ID del empleado.
 * @property string $nombre Nombre del empleado.
 * @property string $apellidos Apellidos del empleado.
 * @property string|null $foto Ruta de la foto de perfil del empleado.
 */
class Empleado extends Model{
    use HasFactory;

    /**
     * Nombre de la tabla asociada a este modelo.
     *
     * @var string
     */
    protected $table = 'empleado';

    /**
     * Deshabilita los timestamps de Eloquent para este modelo.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Atributos que se pueden asignar de forma masiva.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'apellidos',
        'foto',
    ];

    /**
     * Relación morf con el modelo Usuario.
     * Indica que un empleado tiene un usuario asociado.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne Relación morf con el usuario.
     */
    public function usuario(): MorphOne{
        return $this->morphOne(Usuario::class, 'utenteable');
    }
}
