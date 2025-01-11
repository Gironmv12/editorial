<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Deseo
 * 
 * @property int $id_deseo
 * @property int $id_usuario
 * @property int $id_libro
 * 
 * @property Usuario $usuario
 * @property Libro $libro
 *
 * @package App\Models
 */
class Deseo extends Model
{
	protected $table = 'deseos';
	protected $primaryKey = 'id_deseo';
	public $timestamps = false;

	protected $casts = [
		'id_usuario' => 'int',
		'id_libro' => 'int'
	];

	protected $fillable = [
		'id_usuario',
		'id_libro'
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
