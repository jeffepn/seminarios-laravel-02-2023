<?php

namespace App\Models;

use App\Traits\ResolveRoutesByIdSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use ResolveRoutesByIdSlug;
    // This "Trait" adding comportaments of soft delete in "Model"
    use SoftDeletes;

    // Define what fields can be assigned in mass
    protected $fillable = ['name', 'price'];

    // Define what fields can't be assigned in mass
    protected $guarded = [];

    // Define what fields must be returned how an instance of "Carbon"
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}