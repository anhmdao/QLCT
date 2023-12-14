<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MoneyType
 * 
 * @property int $id
 * @property string|null $name
 * @property int|null $wallet_id
 * 
 * @property Wallet|null $wallet
 *
 * @package App\Models
 */

class Moneytype extends Model
{
    use HasFactory;
    protected $table = 'moneytypes';
	public $timestamps = false;

	protected $casts = [
		'wallet_id' => 'int'
	];

	protected $fillable = [
		'name',
		
	];

	public function wallet()
	{
		return $this->belongsTo(Wallet::class);
	}
}
