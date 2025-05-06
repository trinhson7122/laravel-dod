<?php

namespace SonTX\LaravelDOD\Repositories\Models\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function all(array $condition = [], array $columns = ['*'], array $relations = []): Collection;
    public function find(int $id, array $columns = ['*'], array $relations = []): ?Model;
    public function create(array $data): Model;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
    public function findBy(string $field, mixed $value, array $columns = ['*'], array $relations = []): ?Model;
    public function paginate(int $perPage = 15, array $columns = ['*'], array $relations = []): \Illuminate\Contracts\Pagination\LengthAwarePaginator;
}
