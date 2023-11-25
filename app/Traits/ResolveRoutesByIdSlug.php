<?php

namespace App\Traits;

trait ResolveRoutesByIdSlug
{
    public function resolveRouteBinding($value, $field = null)
    {
        if ($field) {
            return $this->where($field, $value)
                ->firstOrFail();
        }

        return $this->where('id', $value)
            ->orWhere('slug', $value)
            ->firstOrFail();
    }
}