<?php

namespace Modules\Dog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Modules\Dog\Repositories\Entities\DogModel;

trait QueryBuilderTrait
{

    protected $table;

    protected $paginate = 2;

    protected function table($param)
    {
        $this->table = DB::table($param);
        return $this;
    }

    protected function in(array $data)
    {
        foreach ($data as $key => $value)
        {
            $this->table->whereIn($key, $value);
        }
        return $this;
    }

    protected function between(array $data)
    {
        foreach ($data as $key => $value)
        {
            $this->table->whereBetween($key, $value);
        }
        return $this;
    }


    protected function paginate()
    {
        $data=$this->table->paginate($this->paginate);
        //$data->setPath('http://api.petagree/api/dog?'.$json);
        return $data;
    }

    public function filter($filter)
    {
        foreach($filter as $key => $array)
        {
            $this->$key($array);
        }
        return $this;

    }

}