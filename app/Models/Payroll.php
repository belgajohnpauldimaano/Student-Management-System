<?php

namespace App\Models;

use App\Traits\HasUser;
use App\Traits\HasDocuments;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasDocuments, HasUser;
}