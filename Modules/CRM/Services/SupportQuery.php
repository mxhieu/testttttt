<?php

namespace Modules\CRM\Services;


class SupportQuery
{
    /**
     * @param $model
     * @param $filter
     * @param $column
     * @return mixed
     */
    public function applyWhere($model, $filter, $column)
    {
        if (empty($filter) || empty($column)) {
            return $model;
        }

        return $model->where([$column => $filter]);
    }

    /**
     * @param $model
     * @param $keyword
     * @param array $columns
     * @return mixed
     */
    public function applyLike($model, $keyword, $columns = [])
    {
        if (empty($keyword) || empty($columns)) {
            return $model;
        }

        return  $model->where(function($model) use ($keyword, $columns){
            foreach ($columns as $k => $column) {
                if ($k == 0) {
                    $model->where($column, 'LIKE', '%' . $keyword . '%');
                } else {
                    $model->orWhere($column, 'LIKE', '%' . $keyword . '%')
                        ->orWhere($column, 'LIKE', '%' . $keyword . '%');
                }
            }
        });
    }
}