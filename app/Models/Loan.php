<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dealership;
use App\Models\Employee;
use App\Models\Status;
use App\Models\Bank;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'loans';

    protected $fillable = [
        'dealership_id',
        'employee_id',
        'amount',
        'months',
        'interest',
        'reason',
        'status_id',
        'bank_id',
        'created_at',
        'updated_at'
    ];

    public function dealership()
    {
        return $this->belongsTo(Dealership::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}
