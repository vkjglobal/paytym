<?php

namespace App\Imports;

use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;

class AttendanceImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{

    
    public function model(array $row)
    {
        return new Attendance([
            'user_id'     => $row['user_id'],
            // 'employer_id' => ,
            'check_in'    => $row['checkin'], 
            'check_out' => $row['checkout'],
            'status' => (string)$row['status'],
            'date' => $row['date'],
            
        ]);
    }
    public function chunkSize(): int
    {
        return 1000;
    }
   
    
}
