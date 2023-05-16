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

    public static array $PROVIDERS  = ["mtn", "airtel-tigo", "vodafone", "glo"];
    public static array $TYPES  = ["mobile", "landline",];

    protected $fillable = ['type','sim_number','contact_id','registered'];


    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('provider', 'like', '%'.strtolower(str()->snake($search)).'%')
                ->orWhere('types', 'like', '%'.strtolower($search).'%')
                ->orWhere('sim_number', 'like', '%'.strtolower($search).'%');
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }

}
