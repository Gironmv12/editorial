<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Catalogo
 * 
 * @property int $id_catalogo
 * @property string $nombre_catalogo
 * 
 * @property Collection|Libro[] $libros
 *
 * @package App\Models
 */
class Catalogo extends Model
{
	protected $table = 'catalogos';
	protected $primaryKey = 'id_catalogo';
	public $timestamps = false;

	protected $fillable = [
		'nombre_catalogo',
		'eliminado',
	];

	public function libros()
	{
		return $this->belongsToMany(Libro::class, 'libro_catalogo', 'id_catalogo', 'id_libro');
	}
}