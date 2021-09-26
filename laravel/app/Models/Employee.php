<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $department_id
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property string $birthdate
 * @property string $position
 * @property string $salary_type
 * @property float $salary
 * @property string $created_at
 * @property string $updated_at
 */
class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'department_id',
        'first_name',
        'last_name',
        'middle_name',
        'birthdate',
        'position',
        'salary_type',
        'salary',
    ];


    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}
