<?php

namespace App\Models;

use App\Models\Traits\CreatedAndUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory, CreatedAndUpdatedBy;
    protected $guarded = [];
}
