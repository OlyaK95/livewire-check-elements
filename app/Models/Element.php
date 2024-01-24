<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Element extends Model
{
    protected $fillable = [
        "element_type_id",
        "name",
        "quantity",
    ];

    public function module_types(): belongsToMany
    {
        return $this->belongsToMany(ModuleType::class)->withPivot([
            "quantity",
            "ref_des",
        ]);
    }
}
