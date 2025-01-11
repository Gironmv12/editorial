<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Comentario
 * 
 * @property int $id_comentario
 * @property int $id_libro
 * @property int $id_usuario
 * @property string $nombre
 * @property string $comentario
 * 
 * @property Libro $libro
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class Comentario extends Model
{
	protected $table = 'comentarios';
	protected $primaryKey = 'id_comentario';
	public $timestamps = false;

	protected $casts = [
		'id_libro' => 'int',
		'id_usuario' => 'int'
	];

	protected $fillable = [
		'id_libro',
		'id_usuario',
		'nombre',
		'comentario'
	];

	public function libro()
	{
		return $this->belongsTo(Libro::class, 'id_libro');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'id_usuario');
	}
}
