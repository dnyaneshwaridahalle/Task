<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'role_module_permission', 'permission_id', 'module_id')
            ->withPivot('role_id');
    }
}
