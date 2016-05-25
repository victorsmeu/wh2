<?php

namespace App\Repositories;

class PatientRepository
{

    public function getAll($patient)
    {
        return $patient->orderBy('created_at', 'asc')
                       ->get();
    }
}