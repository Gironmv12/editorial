<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Comparacione
 * 
 * @property int $id_comparacion
 * @property int $id_usuario
 * @property int $id_libro_1
 * @property int $id_libro_2
 * 
 * @property Usuario $usuario
 * @property Libro $libro
 *
 * @package App\Models
 */
class Comparacione extends Model
{
	protected $table = 'comparaciones';
	protected $primaryKey = 'id_comparacion';
	public $timestamps = false;

	protected $casts = [
		'id_usuario' => 'int',
		'id_libro_1' => 'int',
		'id_libro_2' => 'int'
	];

	protected $fillable = [
		'id_usuario',
		'id_libro_1',
		'id_libro_2'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'id_usuario');
	}

	public function libro()
	{
		return $this->belongsTo(Libro::class, 'id_libro_2');
	}
}
