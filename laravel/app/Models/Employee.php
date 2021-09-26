<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @property int $id
 * @property int $department_id
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property string $birthdate
 * @property string $position
 * @property string $salary_type
 * @property float $work_hours
 * @property float $salary
 * @property string $created_at
 * @property string $updated_at
 */
class Employee extends Model
{
    use HasFactory;

    private const DEFAULT_EMPLOYEES_COUNT_PER_PAGE = 10;

    protected $table = 'employees';

    protected $fillable = [
        'department_id',
        'first_name',
        'last_name',
        'middle_name',
        'birthdate',
        'position',
        'salary_type',
        'work_hours',
        'salary',
    ];


    /**
     * One to many relationship with Department model
     * @return BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    /**
     * Method returns Paginator instance with all employees or employees only from some department
     * @param Request $request
     * @param int|null $departmentID
     * @return LengthAwarePaginator
     */
    public static function getPaginateEmployeeList(Request $request, int $departmentID = null): LengthAwarePaginator
    {
        $query = Employee::query();

        if($departmentID){
            $query = $query->where('department_id', $departmentID);
        }

        return $query->with('department')
            ->paginate(
                self::getNeededEmployeesCount($request->get('quantity')),
                ['*'],
                'page',
                $request->get('page'));
    }

    /**
     * Method prepares paginated employees array.
     * Exactly this one changes salary of employees in paginated array
     * @param array $items
     * @return array
     */
    public static function getPreparedPaginatedItems(array $items): array
    {
        foreach($items as $item){
            $item['salary'] = self::countEmployeeSalary(
                                                    $item['salary'],
                                                    $item['work_hours'],
                                                    $item['salary_type']
                                                );
        }

        return $items;
    }

    /**
     * If there is no quantity get parameter, method returns default number of employees per page
     * @param int|null $count
     * @return int
     */
    private static function getNeededEmployeesCount(?int $count): int
    {
        return $count ?? self::DEFAULT_EMPLOYEES_COUNT_PER_PAGE;
    }


    /**
     * Method returns counted employee`s salary
     * @param float $salary
     * @param float $workHours
     * @param string $salaryType
     * @return string
     */
    private static function countEmployeeSalary(float $salary, float $workHours, string $salaryType): string
    {
        $countedSalary = $salaryType === 'hourly'
                        ? $salary * $workHours
                        : $salary;

        return number_format($countedSalary, 2);
    }
}
