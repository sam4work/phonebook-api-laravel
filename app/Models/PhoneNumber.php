<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhoneNumber extends Model
{
	use HasFactory;
	use HasUuids;
	use SoftDeletes;

	public static array $TYPES  = ["mobile", "landline",];

	protected $fillable = ['type', 'sim_number', 'contact_id', 'registered'];


	public function contact(): BelongsTo
	{
		return $this->belongsTo(Contact::class);
	}
}
