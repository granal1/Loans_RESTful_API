<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dealership extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'dealerships';

    protected $fillable = [
        'name',
        'address',
        'created_at',
        'updated_at'
    ];

    public function employee()
    {
        return $this->hasMany(Employee::class);
    }
}
