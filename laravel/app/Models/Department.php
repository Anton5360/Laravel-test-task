<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $title
 * @property string $created_at
 * @property string $updated_at
 */
class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';

    public $timestamps = false;

    protected $fillable = [
        'title'
    ];

    /**
     * One to many relationship with Employee model
     * @return HasMany
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class, 'department_id', 'id');
    }

    /**
     * Method returns all columns except for timestamps
     * @return Collection
     */
    public static function allWithoutTimestamps(): Collection
    {
        return self::get(['id', 'title']);
    }
}
