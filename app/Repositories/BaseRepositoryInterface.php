<?php

namespace App\Repositories;



interface BaseRepositoryInterface
{
    public function getAll();

    public function getAllDisc();

    public function getDisc_Filtering(array $filters);

    public function getDisc_Paginating(int $paginate);

    public function getDisc_Paginating_Filtering(int $paginate, array $filters);

    public function find($id);

    public function create($formData);

    public function update($model, $formData);

    public function destroy($model);

    public function requestFileExists(string $file): bool;

    public function saveImage(string $file, string $path);

    public function deleteImage($model);
}
