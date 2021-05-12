<?php
namespace App\Services\Share;

use Illuminate\Support\Facades\DB;

use App\Dto\ApiDto\SearchResultDto;

class SearchService
{
    public static function handleQuery($query, $criteria, $epochtimeKeys = []) : SearchResultDto
    {
        $total = $query->count();

        $query->orderByRaw(SearchService::buildOrderBy($criteria));
        $queryResult = $query->take($criteria->getPerPage())->skip($criteria->getSkip())->get()->toArray();
        $items = [];
        foreach($queryResult as $entities) {
            foreach($epochtimeKeys as $key)
            {
                $entities[$key] = convertStringToEpochTime($entities[$key]);
            }
            array_push($items, (array) $entities);
        }
        $result = new SearchResultDto(['total' => $total, 'data' => $items]);
        return $result;
    }

    public static function handleRawQuery($queryStr, $criteria, $parameters = [], $epochtimeKeys = []) : SearchResultDto
    {
        $sqlCount = 'SELECT count(*) total FROM ('. $queryStr . ') x';
        $result = DB::select($sqlCount, $parameters);

        $total = (isset($result) && count($result)>0)? $result[0]->total: 0;

        $queryStr = $queryStr.' order by '.SearchService::buildOrderBy($criteria);
        $queryStr = $queryStr.' limit '.$criteria->getPerPage().' offset '.($criteria->getSkip());
        $data = DB::select($queryStr, $parameters);

        if (count($epochtimeKeys) <= 0)
        {
            return new SearchResultDto(['total' => $total, 'data' => $data]);
        }
        
        $items = [];
        foreach($data as $entity) {
            foreach($epochtimeKeys as $key)
            {
                $array = get_object_vars($entity);
                $properties = array_keys($array);
                if (in_array($key, $properties))
                {
                    $entity->{$key} = convertStringToEpochTime($entity->{$key});
                }
            }
            array_push($items, (array) $entity);
        }


        $result = new SearchResultDto(['total' => $total, 'data' => $items]);

        return $result;
    }

    static public function buildOrderBy($criteria): string{
        $sortBy = $criteria->getSortBy();
        $order = $criteria->getOrder();
        $orders = [];
        $query = ' ';
        if (is_array($order))
        {
            $orders = $order;
        }
        else {
            $orders[] = $order;
        }
        $sortBys = [];
        if (is_array($sortBy))
        {
            $sortBys = $sortBy;
            $currentOrder = reset($orders); 
            foreach($sortBys as $currentSortBy){
                if($query != ' ')
                {
                    $query = $query.',';
                }
                $orders = array_diff($orders, array($currentOrder));
                $query = $query.$currentSortBy.' '.$currentOrder.' ';
                $newOrder = reset($orders); 
                if($newOrder){
                    $currentOrder = $newOrder;
                }
            }
            return $query;
        }
        $order = reset($orders); 
        return $sortBy.' '.$order;
    }
}