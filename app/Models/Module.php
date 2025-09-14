<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function permissions()
    {
        // Many-to-many via pivot table
        return $this->belongsToMany(Permission::class, 'role_module_permission', 'module_id', 'permission_id')
            ->withPivot('role_id');
    }
}
