<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LibroCatalogo
 * 
 * @property int $id_libro
 * @property int $id_catalogo
 * 
 * @property Libro $libro
 * @property Catalogo $catalogo
 *
 * @package App\Models
 */
class LibroCatalogo extends Model
{
	protected $table = 'libro_catalogo';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_libro' => 'int',
		'id_catalogo' => 'int'
	];

	public function libro()
	{
		return $this->belongsTo(Libro::class, 'id_libro');
	}

	public function catalogo()
	{
		return $this->belongsTo(Catalogo::class, 'id_catalogo');
	}
}
