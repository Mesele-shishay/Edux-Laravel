<?php

namespace App\Repositories\Interfaces;

interface SchoolSessionRepositoryInterface
{
    public function getLatestSession();

    public function getAll();

    public function getPreviousSession();

    public function create($request);

    public function getSessionById($id);

    public function browse($request);
}
