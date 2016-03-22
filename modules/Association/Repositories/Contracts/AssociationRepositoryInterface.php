<?php

namespace Modules\Association\Repositories\Contracts;


interface AssociationRepositoryInterface
{
    public function getNew(array $attributes = []);

    public function create(array $data);

    public function update($id, array $data, $primaryKey);

    public function delete($id);

    public function deleteCustom(array $id);

    public function getAll(array $columns = ['*']);

    public function findById($id, $columns = ['*']);

    public function findByColumn(array $attribute, $columns = array('*'));

    public function attributeExists(array $attribute);

    public function getRelatedCustom(array $relations, array $where = []);

}
