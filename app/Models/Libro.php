<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Libro
 * 
 * @property int $id_libro
 * @property string|null $imagen
 * @property string $titulo
 * @property string $isbn
 * @property float|null $calificacion
 * @property string $autor
 * @property string|null $coordinado_por
 * @property string|null $descripcion
 * @property string|null $detalle
 * @property string|null $archivo_pdf
 * @property string|null $archivo_epub
 * @property float|null $precio
 * @property string $tipo
 * @property bool|null $desactivar
 * 
 * @property Collection|Carrito[] $carritos
 * @property Collection|Comentario[] $comentarios
 * @property Collection|Comparacione[] $comparaciones
 * @property Collection|Deseo[] $deseos
 * @property Collection|Catalogo[] $catalogos
 * @property Collection|Categoria[] $categorias
 *
 * @package App\Models
 */
class Libro extends Model
{
	protected $table = 'libros';
	protected $primaryKey = 'id_libro';
	public $timestamps = false;

	protected $casts = [
		'calificacion' => 'float',
		'precio' => 'float',
		'desactivar' => 'bool'
	];

	protected $fillable = [
		'imagen',
		'titulo',
		'isbn',
		'calificacion',
		'autor',
		'coordinado_por',
		'descripcion',
		'detalle',
		'archivo_pdf',
		'archivo_epub',
		'precio',
		'tipo',
		'desactivar'
	];

	public function carritos()
	{
		return $this->hasMany(Carrito::class, 'id_libro');
	}

	public function comentarios()
	{
		return $this->hasMany(Comentario::class, 'id_libro');
	}

	public function comparaciones()
	{
		return $this->hasMany(Comparacione::class, 'id_libro_2');
	}

	public function deseos()
	{
		return $this->hasMany(Deseo::class, 'id_libro');
	}

	public function catalogos()
	{
		return $this->belongsToMany(Catalogo::class, 'libro_catalogo', 'id_libro', 'id_catalogo');
	}

	public function categorias()
	{
		return $this->belongsToMany(Categoria::class, 'libros_categorias', 'id_libro', 'id_categoria')
					->withPivot('id_libro_categoria');
	}
}
