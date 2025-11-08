<?php

namespace App\Containers\Product\Actions;

use App\Containers\Product\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ListProductsAction
{
    public function run(array $filters = []): LengthAwarePaginator
    {
        $query = Product::query();

        // Фильтрация по поиску
        if (!empty($filters['search'])) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        }

        return $query->paginate($filters['per_page'] ?? 15);
    }
}
