<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
	use HasFactory;
	use HasUuids;
	use SoftDeletes;


	protected $fillable = [
		'first_name', 'last_name', 'user_id'
	];


	protected $with = ['phoneNumbers'];
	/**
	 * @return BelongsTo
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function phoneNumbers(): HasMany
	{
		return $this->hasMany(PhoneNumber::class);
	}

	public function scopeFilter($query, array $filters)
	{

		$query->when(
			$filters['search'] ?? null,
			function ($query, $search) {

				$query->where('first_name', 'like', '%' . str()->lower($search) . '%')

					->orWhere('last_name', 'like', '%' . str()->lower($search) . '%')
					->orWhereHas('phoneNumbers', function ($query) use ($search) {
						$query->where('sim_number', 'like', '%' . str()->lower($search) . '%');
					});
			}

		)->when($filters['trashed'] ?? null, function ($query, $trashed) {
			if ($trashed === 'with') {
				$query->withTrashed();
			} elseif ($trashed === 'only') {
				$query->onlyTrashed();
			}
		});
	}
}
