<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dealership;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'employees';
    protected $hidden = ['key'];

    protected $fillable = [
        'dealership_id',
        'name',
        'key',
        'created_at',
        'updated_at'
    ];

    public function dealership()
    {
        return $this->belongsTo(Dealership::class);
    }

}
