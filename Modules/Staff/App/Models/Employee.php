<?php

namespace Modules\Staff\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Staff\Database\Factories\EmployeeFactory;

class Employee extends Model
{
    use HasFactory;




    protected $table = 'account_employee_details';

    protected $primaryKey = 'n_slno';

    public $timestamps = false;

    protected $fillable = [
        'C_FNAME',
        'N_MOBILE',
        'C_EMAIL',
        'C_USERNAME',
        'C_PASSWORD',
        'C_ROLE',
    ];


















}
