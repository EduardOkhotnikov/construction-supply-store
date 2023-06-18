<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Good extends Model
{
    use HasFactory;

    public static array $fieldsToSort = [
        "id" => "Id",
        "name" => "Name",
        "price" => "Price"
    ];
    public static array $defaultFilters = [
        "sort" => "id"
    ];
    public function producer(): BelongsTo
    {
        return $this->belongsTo(Producer::class);
    }
    public static function getByParams(array $params): Collection
    {
        $whereFields = [
            'filter_price' => 'price',
            'filter_expiration' => 'expiration_date'
            ];

        $where = [];

        foreach ($params as $field => $value) {

            if($field == 'filter_expiration'){
                if($value == null){
                    continue;
                }
                $where[] = [$whereFields[$field], '=', $value];
                continue;
            }
            if (\array_key_exists($field, $whereFields) && $value) {
                $where[] = [$whereFields[$field], '>', $value];
            }
        }
        return Good::query()->where($where)->orderBy($params['sort'])->get();
    }
}
