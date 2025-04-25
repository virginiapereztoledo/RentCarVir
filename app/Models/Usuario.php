<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Modelo Usuario.
 *
 * Representa a los usuarios en la base de datos y está asociado a la tabla 'usuario'.
 * Administra la relación con los modelos Cliente o Empleado a través de MorphTo.
 */
class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Indica si se deben guardar las marcas de tiempo en la tabla.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Nombre de la tabla asociada a este modelo.
     *
     * @var string
     */
    protected $table = 'usuario';

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
    ];

    /**
     * Los atributos que deben ocultarse en las serializaciones.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Establece y cifra la contraseña del usuario.
     *
     * @param string $value La contraseña sin cifrar.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Relación morfológica que llama al modelo relacionado (Cliente o Empleado).
     *
     * @return MorphTo
     */
    public function utenteable(): MorphTo
    {
        return $this->morphTo();
    }
}
