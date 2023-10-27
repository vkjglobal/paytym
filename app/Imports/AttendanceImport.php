<?php

namespace App\Imports;

use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Carbon\Carbon;

class AttendanceImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{

    
    public function model(array $row)
    {
        try {
        $employer = Auth::guard('employer')->user();
        //dd($employer->id);

        return new Attendance([
            'user_id'     => $row['user_id'],
             'employer_id' => $employer->id,
            'check_in'    => Carbon::createFromFormat('d-m-Y H:i', $row['check_in'])->format('Y-m-d H:i:s'),//$row['checkin'], 
            'check_out' => Carbon::createFromFormat('d-m-Y H:i', $row['check_out'])->format('Y-m-d H:i:s'),//$row['checkout'],
            'status' => $row['status'],//(string)$row['status'],
            'date' => Carbon::createFromFormat('d-m-Y', $row['date'])->format('Y-m-d'),//$row['date'],
            'approve_reject' => null,
            'reason' => null
            
        ]);
    } catch (\Exception $e) {
        // Log the error for debugging purposes
        \Log::error('Error importing data: ' . $e->getMessage());

        // You can also add error notifications or custom handling here
    }
    }
    public function chunkSize(): int
    {
        return 1000;
    }
   
    
}
