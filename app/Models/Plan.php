<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Plan
 * 
 * @property int $id
 * @property string|null $name
 * @property int|null $period_id
 * @property int|null $user_id
 * 
 * @property Period|null $period
 * @property User|null $user
 * @property Collection|Category[] $categories
 *
 * @package App\Models
 */

class Plan extends Model
{
    use HasFactory;
    protected $table = 'plans';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'period_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'name',
		'period_id',
		'user_id'
	];

	public function period()
	{
		return $this->belongsTo(Period::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function categories()
	{
		return $this->belongsToMany(Category::class, 'plan_category')
					->withPivot('id', 'ammount');
	}
}
