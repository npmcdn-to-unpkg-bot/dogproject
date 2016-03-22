<?php

namespace Modules\Foundation\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Modules\Foundation\Repositories\Contracts\FoundationModelRepositoryInterface;

abstract class FoundationModelRepository implements FoundationModelRepositoryInterface
{
    protected $model;

    /**
     * Create new repository interface
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get fillable information for given model
     *
     * @return array
     */

    public function getModelFillables()
    {
        return $this->model->getFillable();
    }

    /**
     * Get new instance of model
     *
     * @param array $attributes
     * @return static
     */
    public function getNew(array $attributes = [])
    {
        return $this->model->newInstance($attributes);
    }

    /**
     * Insert new data in database
     *
     * @param array $data
     * @return static
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Updates database table based on primary or foreign key (id or user_id), removes all empty data fields
     *
     * @param $id
     * @param array $data
     * @param $primaryKey
     * @param bool $useEmpty
     * @return mixed
     */
    public function update($id, array $data, $primaryKey, $useEmpty = false)
    {
        if ($useEmpty == false) {
            $finalData = array_filter($data, function ($k) {
                if (!empty($k)||strlen($k)>0) {
                    return true;
                }
            });
        }else{
            $finalData = $data;
        }

        if ($primaryKey == true)
        {
            return $this->model->whereId($id)->update($finalData);
        }
        return $this->model->where("user_id","=",$id)->update($finalData);

    }


    /**
     * Delete data from database
     *
     * @param $id
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * Deletes row based on $id array (column name => value) KEEP
     * @param array $id
     * @return mixed
     */

    public function deleteCustom(array $id)
    {
        return $this->model->where($id)->delete();
    }

    /**
     * Get all data from database
     *
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll(array $columns = ['*'])
    {
        return $this->model->all($columns);
    }

    /**
     * Find data by id
     *
     * @param $id
     * @param array $columns
     * @return \Illuminate\Support\Collection|null|static
     */
    public function findById($id, $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    /**
     * Find data by custom field
     *
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */

    public function findByColumn(array $attributes, $columns = array('*'))
    {
        $query = $this->model;
        foreach ($attributes as $key => $value) {
            $query = $query->where($key, '=', $value);
        }
        if($columns[0] == '*')
        {
            return $query->first();  //može se i ovdje dodati to array
        }
        return $query->first($columns)->toArray();
    }

    public function findByColumnAll(array $attributes, $columns = array('*'))
    {
        $query = $this->model;
        foreach ($attributes as $key => $value)
        {
            $query = $query->where($key, '=', $value);
        }
        return $query->get();
    }

    /**
     * Check if given array(attribute => value) pair exists
     * @param array $attributes
     * @return mixed
     */

    public function attributeExists(array $attributes)
    {
        $query = $this->model;
        foreach ($attributes as $key => $value)
        {
            $query = $query->where($key, '=', $value);
        }
        return $query->exists();
    }

    public function whereIn($key,$value)
    {
        $this->model = $this->model->whereIn($key,$value);

        return $this;
    }

    public function whereBetween($key,$value) {

        $this->model = $this->model->whereBetween($key,$value);

        return $this;
    }

    /**
     * Get related data (custom), user specifies that in array KEEP
     * Also to get specific data (not all) where array must be provided (column name => value)
     * @param array $relations
     * @return array
     */

    public function getRelatedCustom(array $relations, array $where = [])
    {
        if(empty($where))
        {
            $query = $this->model;

            foreach ($relations as $value)
            {
                $query = $query->with($value);
            }
            return $query->get();
        }else
        {
            $query = $this->model;
            foreach ($relations as $value)
            {
                $query = $query->with($value);
            }
            $query = $query->where($where);
            return $query->get();
        }
    }

}
