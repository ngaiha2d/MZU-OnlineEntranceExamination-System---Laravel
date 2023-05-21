<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class CandidateExportSort implements FromCollection
{
    protected $exam_id;

    public function __construct($exam_id)
    {
        $this->exam_id = $exam_id;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Fetch the users based on the exam ID
        $users = User::where('exam_code', $this->exam_id)->get();

        // Create a new collection and add the users to it
        $collection = new Collection($users);

        // Return the collection of users
        return $collection;
    }
}
