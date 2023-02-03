<?php

namespace App\Imports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AttendanceImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Attendance([
            'user_id'     => $row['user_id'],
            'check_in'    => $row['check_in'], 
            'check_out' => $row['check_out'],
            'status' => (string)$row['status'],
            'date' => $row['date'],
            
        ]);
    }
    
}
