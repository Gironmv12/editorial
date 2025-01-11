<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Video
 * 
 * @property int $id_video
 * @property string $titulo
 * @property string $video
 * @property string|null $descripcion
 * @property int|null $id_categoria
 * 
 * @property Categoria|null $categoria
 *
 * @package App\Models
 */
class Video extends Model
{
	protected $table = 'videos';
	protected $primaryKey = 'id_video';
	public $timestamps = false;

	protected $casts = [
		'id_categoria' => 'int'
	];

	protected $fillable = [
		'titulo',
		'video',
		'descripcion',
		'id_categoria'
	];

	public function categoria()
	{
		return $this->belongsTo(Categoria::class, 'id_categoria');
	}
}
