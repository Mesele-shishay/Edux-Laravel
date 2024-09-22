<?php

namespace App\Repositories\Interfaces;

interface SemesterRepositoryInterface
{
    public function create($request);

    public function getAll($session_id);
}
