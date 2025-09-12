<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuGroup extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'icon', 'permission_name'];

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }

    public function getLoggableData(): array
    {
        return $this->only(['id', 'name', 'permission_name']);
    }
}
