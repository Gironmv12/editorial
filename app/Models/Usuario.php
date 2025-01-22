<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class Usuario
 * 
 * @property int $id_usuario
 * @property string $nombre_usuario
 * @property string $email
 * @property string $contrasena
 * @property string $rol
 * 
 * @property Collection|Carrito[] $carritos
 * @property Collection|Comentario[] $comentarios
 * @property Collection|Comparacione[] $comparaciones
 * @property Collection|Deseo[] $deseos
 *
 * @package App\Models
 */
class Usuario extends Model
{
    use HasApiTokens;

	protected $table = 'usuarios';
	protected $primaryKey = 'id_usuario';
	public $timestamps = false;
	public $incrementing = true; // Asegurar que sea auto-incremental

	protected $fillable = [
		'nombre_usuario',
		'email',
		'contrasena',
		'rol'
	];

	public function carritos()
	{
		return $this->hasMany(Carrito::class, 'id_usuario');
	}

	public function comentarios()
	{
		return $this->hasMany(Comentario::class, 'id_usuario');
	}

	public function comparaciones()
	{
		return $this->hasMany(Comparacione::class, 'id_usuario');
	}

	public function deseos()
	{
		return $this->hasMany(Deseo::class, 'id_usuario');
	}
}