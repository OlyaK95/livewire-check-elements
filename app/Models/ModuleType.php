<?php

namespace App\Models;

use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ModuleType extends Model implements HasName
{
    protected $fillable = [
        "name",
        "designator",
        "prefix",
    ];

    public function modules(): hasMany
    {
        return $this->hasMany(Module::class);
    }

    public function elements(): belongsToMany
    {
        return $this->belongsToMany(Element::class)->withPivot([
            "quantity",
            "ref_des",
        ]);
    }

    public function getFilamentName(): string
    {
        return $this->fullName;
    }

    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->designator}";
    }
}
