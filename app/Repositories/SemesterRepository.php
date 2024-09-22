<?php

namespace App\Repositories;

use App\Repositories\Interfaces\SemesterRepositoryInterface;
use App\Models\Semester;
use App\Models\SchoolSession;

class SemesterRepository implements SemesterRepositoryInterface
{
    public function create($request)
    {
        try {
            Semester::create($request);
        } catch (\Exception $e) {
            throw new \Exception('Failed to create School Semester. '.$e->getMessage());
        }
    }

    public function getAll($session_id)
    {
        return Semester::where('session_id', $session_id)->orderBy('id', 'desc')->get();
    }

    public function getLattest($session_id)
    {
        return Semester::where('session_id', $session_id)->latest()->first();
    }
}
