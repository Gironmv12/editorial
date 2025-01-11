<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LibrosCategoria
 * 
 * @property int $id_libro_categoria
 * @property int $id_libro
 * @property int $id_categoria
 * 
 * @property Libro $libro
 * @property Categoria $categoria
 *
 * @package App\Models
 */
class LibrosCategoria extends Model
{
	protected $table = 'libros_categorias';
	protected $primaryKey = 'id_libro_categoria';
	public $timestamps = false;

	protected $casts = [
		'id_libro' => 'int',
		'id_categoria' => 'int'
	];

	protected $fillable = [
		'id_libro',
		'id_categoria'
	];

	public function libro()
	{
		return $this->belongsTo(Libro::class, 'id_libro');
	}

	public function categoria()
	{
		return $this->belongsTo(Categoria::class, 'id_categoria');
	}
}
