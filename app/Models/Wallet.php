<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Wallet
 *
 * @property int $id
 * @property string|null $icon
 * @property float|null $money
 * @property string|null $name
 * @property int|null $status
 *
 * @property Collection|MoneyType[] $money_types
 * @property Collection|Transaction[] $transactions
 *
 * @package App\Models
 */

class Wallet extends Model
{
    use HasFactory;
    protected $table = 'wallet';
	public $timestamps = false;

	protected $casts = [
		'money' => 'float',
		'status' => 'int'
	];

	protected $fillable = [

		'money',
		'name',
        'user_id',
        'money_type_id'
	];

	public function users(){
		return $this->belongsTo(User::class);
	}
	public function money_types()
	{
		return $this->hasMany(MoneyType::class);
	}

	public function transactions()
	{
		return $this->hasMany(Transaction::class);
	}
}
