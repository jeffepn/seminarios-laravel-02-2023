<?php

namespace App\Models;

use App\Traits\ResolveRoutesByIdSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use ResolveRoutesByIdSlug;
}