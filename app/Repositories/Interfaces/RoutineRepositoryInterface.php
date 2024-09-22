<?php

namespace App\Repositories\Interfaces;

interface RoutineRepositoryInterface
{
    public function saveRoutine($request);

    public function getAll($class_id, $section_id, $session_id);
}
