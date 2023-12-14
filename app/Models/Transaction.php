<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
	public $timestamps = false;

	protected $casts = [
		'total' => 'float',
		'wallet_id' => 'int',
		'category_id' => 'int'
	];

	protected $dates = [
		'time'
	];

	protected $fillable = [
		'description',
		'time',
		'total',
		'wallet_id',
		'category_id'
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function wallet()
	{
		return $this->belongsTo(Wallet::class);
	}
}
