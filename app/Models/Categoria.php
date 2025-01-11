<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Categoria
 * 
 * @property int $id_categoria
 * @property string $nombre_categoria
 * 
 * @property Collection|Libro[] $libros
 *
 * @package App\Models
 */
class Categoria extends Model
{
	protected $table = 'categorias';
	protected $primaryKey = 'id_categoria';
	public $timestamps = false;

	// Campos permitidos para la asignación masiva
	protected $fillable = [
		'nombre_categoria',
		'eliminado',
	];

	// Relación con el modelo Libro
	public function libros()
	{
		return $this->belongsToMany(Libro::class, 'libros_categorias', 'id_categoria', 'id_libro')
					->withPivot('id_libro_categoria');
	}
}