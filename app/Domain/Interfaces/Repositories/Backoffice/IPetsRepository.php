<?php

namespace App\Domain\Interfaces\Repositories\Backoffice;

interface IPetsRepository
{
    public function fetch($patient_id);

    public function saveData($request);

    public function findOrFail($id);

    public function deleteData($id);
}
