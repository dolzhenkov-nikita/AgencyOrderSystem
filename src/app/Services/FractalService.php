<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class FractalService
{
    private Manager $fractal;

    public function __construct(Manager $fractal)
    {
        $this->fractal = $fractal;

        if (request()->has('include')) {
            $this->fractal->parseIncludes(request()->get('include'));
        }
    }

    public function item($data, $transformer, $resourceKey = null): array
    {
        $resource = new Item($data, $transformer, $resourceKey);
        return $this->fractal->createData($resource)->toArray();
    }

    public function collection($data, $transformer, $resourceKey = null): array
    {
        $resource = new Collection($data, $transformer, $resourceKey);
        return $this->fractal->createData($resource)->toArray();
    }

    public function paginate(LengthAwarePaginator $paginator, $transformer, $resourceKey = null): array
    {
        $collection = $paginator->getCollection();
        $resource = new Collection($collection, $transformer, $resourceKey);
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));
        return $this->fractal->createData($resource)->toArray();
    }
}
