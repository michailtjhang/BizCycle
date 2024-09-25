<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory, HasUlids;

    protected $keyType = 'string';
    protected $table = 'role';

    protected $fillable = [
        'name',
    ];

    static public function getRecords()
    {
        return Role::get();
    }

    static public function getRecord($id)
    {
        return Role::find($id);
    }
}
