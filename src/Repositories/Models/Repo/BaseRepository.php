<?php

namespace SonTX\LaravelDOD\Repositories\Models\Repo;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use SonTX\LaravelDOD\Repositories\Models\Interfaces\BaseRepositoryInterface;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function model(): string;

    protected function setModel(): void
    {
        $this->model = app($this->model());
    }

    public function all(array $conditions = [], array $columns = ['*'], array $relations = []): Collection
    {
        $queryBuilder = $this->model->query();

        foreach ($conditions as $column => $value) {
            $queryBuilder->where($column, $value);
        }

        return $queryBuilder->with($relations)->get($columns);
    }

    public function find(int $id, array $columns = ['*'], array $relations = []): ?Model
    {
        return $this->model->with($relations)->find($id, $columns);
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $result = $this->find($id);
        if ($result) {
            return $result->update($data);
        }

        return false;
    }

    public function delete(int $id): bool
    {
        $result = $this->find($id);
        if ($result) {
            return $result->delete();
        }
        return false;
    }

    public function findBy(string $field, mixed $value, array $columns = ['*'], array $relations = []): ?Model
    {
        return $this->model->with($relations)->where($field, '=', $value)->first($columns);
    }

    public function paginate(int $perPage = 15, array $columns = ['*'], array $relations = []): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->model->with($relations)->paginate($perPage, $columns);
    }
}
