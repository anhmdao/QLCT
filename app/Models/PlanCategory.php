<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PlanCategory
 * 
 * @property int $id
 * @property int|null $plan_id
 * @property int|null $category_id
 * @property float|null $ammount
 * 
 * @property Category|null $category
 * @property Plan|null $plan
 *
 * @package App\Models
 */

class PlanCategory extends Model
{
    use HasFactory;
    protected $table = 'plan_categories';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'plan_id' => 'int',
		'category_id' => 'int',
		'ammount' => 'float'
	];

	protected $fillable = [
		'plan_id',
		'category_id',
		'ammount'
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function plan()
	{
		return $this->belongsTo(Plan::class);
	}
}
