<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * Modelo de Eloquent para la entidad Cliente.
 * Representa un cliente en la base de datos.
 *
 * @property int $id ID del cliente.
 * @property string $nombre Nombre del cliente.
 * @property string $apellidos Apellidos del cliente.
 * @property string $domicilio Domicilio del cliente.
 * @property string $ocupacion Ocupación del cliente.
 * @property string $fechaNacimiento Fecha de nacimiento del cliente.
 * @property string|null $foto Ruta de la foto de perfil del cliente.
 */
class Cliente extends Model{
    use HasFactory;

    /**
     * Nombre de la tabla asociada a este modelo.
     *
     * @var string
     */
    protected $table = 'cliente';

    /**
     * Deshabilita los timestamps de Eloquent para este modelo.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Atributos que se pueden asignar de forma masiva.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'apellidos',
        'domicilio',
        'ocupacion',
        'fechaNacimiento',
        'foto',
    ];

    /**
     * Relación morf con el modelo Usuario.
     * Indica que un cliente tiene un usuario asociado.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne Relación morf con el usuario.
     */
    public function usuario(): MorphOne{
        return $this->morphOne(Usuario::class, 'utenteable');
    }

    public function alquiler()
    {
        return $this->hasMany(Alquiler::class, "clienteID", "id");
    }
}
