<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BudgetType extends Model
{
    protected $table = 'budget_type';

    protected $primaryKey = 'budget_type_id';

    protected $fillable = [
        'budget_type_id',
        'name'
    ];
}
