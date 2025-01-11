<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Carrito
 * 
 * @property int $id_carrito
 * @property int $id_usuario
 * @property int $id_libro
 * @property int $cantidad
 * 
 * @property Usuario $usuario
 * @property Libro $libro
 *
 * @package App\Models
 */
class Carrito extends Model
{
	protected $table = 'carrito';
	protected $primaryKey = 'id_carrito';
	public $timestamps = false;

	protected $casts = [
		'id_usuario' => 'int',
		'id_libro' => 'int',
		'cantidad' => 'int'
	];

	protected $fillable = [
		'id_usuario',
		'id_libro',
		'cantidad'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'id_usuario');
	}

	public function libro()
	{
		return $this->belongsTo(Libro::class, 'id_libro');
	}
}
