<?php
namespace App\Helpers;

use Illuminate\Pagination\LengthAwarePaginator;

class PaginateUtility {


    public static function mapPagination(LengthAwarePaginator $paginate) {
        return [
            'currentPage' => $paginate->currentPage(),
            'firstPageUrl' => $paginate->url(1),
            'from' => $paginate->firstItem(),
            'lastPage' => $paginate->lastPage(),
            'lastPageUrl' => $paginate->url($paginate->lastPage()),
            'nextPageUrl' => $paginate->nextPageUrl(),
            'path' => $paginate->path(),
            'perPage' => $paginate->perPage(),
            'prevPageUrl' => $paginate->previousPageUrl(),
            'to' => $paginate->lastItem(),
            'total' => $paginate->total(),
            'sortField' => 'created_at',
            'sortType' => 'desc',
            'perPageDropdown' => [15, 30, 45, 60],
        ];
    }
}
