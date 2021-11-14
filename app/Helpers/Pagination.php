<?php


namespace App\Helpers;


use Illuminate\Support\Collection;

class Pagination
{
    public static function handle($result, $nullable = false): ?Collection
    {
        $data                 = null;
        $data['total']        = $result->total();
        $data['current_page'] = $result->currentPage();
        $data['last_page']    = $result->lastPage();
        $data['per_page']     = $result->perPage();
        $data['data']         = $result->items();

        return collect($data);
    }
}
