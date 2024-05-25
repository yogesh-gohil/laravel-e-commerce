<?php

namespace App\Builders;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class ProductBuilder extends Builder
{
    public function whereSearch($search)
    {
        foreach (explode(' ', $search) as $term) {
            $this->where(function ($builder) use ($term) {
                $builder->where('name', 'LIKE', '%'.$term.'%');
            });
        }

        return $this;
    }

    public function whereName($name)
    {
        return $this->where('name', 'LIKE', '%'.$name.'%');
    }

    public function whereCategory($category_id)
    {
        return $this->where('category_id', $category_id);
    }

    public function wherePrice($price)
    {
        return $this->where('price', $price);
    }

    public function paginateData($limit)
    {
        if ($limit == 'all') {
            return $this->get();
        }

        return $this->paginate($limit);
    }

    public function whereOrder($orderByField, $orderBy)
    {
        return $this->orderBy($orderByField, $orderBy);
    }

    public function applyFilters(array $filters)
    {
        $filters = collect($filters);

        if ($filters->get('search')) {
            $this->whereSearch($filters->get('search'));
        }

        if ($filters->get('name')) {
            $this->whereName($filters->get('name'));
        }

        if ($filters->get('price')) {
            $this->wherePrice($filters->get('price'));
        }

        if ($filters->get('category_id')) {
            $this->whereCategory($filters->get('category_id'));
        }

        if ($filters->get('orderByField') || $filters->get('orderBy')) {
            $field = $filters->get('orderByField') ? $filters->get('orderByField') : 'name';
            $orderBy = $filters->get('orderBy') ? $filters->get('orderBy') : 'asc';
            $this->whereOrder($field, $orderBy);
        }

        return $this;
    }
}
