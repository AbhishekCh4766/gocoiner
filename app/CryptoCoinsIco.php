<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CryptoCoinsIco extends Model
{
	protected $table = 'crypto_coins_icos';
    protected $fillable = ['id', 'name', 'alias', 'status', 'image', 'website', 'icowatchlist_url', 'start_time', 'end_time', 'timezone', 'description'];
}
