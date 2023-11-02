<?php

namespace App\Http\Controllers\Api\Employee;

use App\Exports\Employer\HfcExport;
use App\Exports\Employer\PaymentExport;
use App\Exports\Employer\MpaisaExport;
use App\Exports\Employer\MycashExport;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Carbon\CarbonInterval;
use App\Http\Controllers\Employer\PayrollController;
use App\Mail\PayrollTemplateMail;
use App\Models\Employer;
use App\Models\Payroll;
use App\Models\LeaveRequest;
use App\Models\Overtime;
use App\Models\SplitPayment;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Branch;
use App\Models\Department;
use App\Models\EmployerBusiness;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class PayrollCalculationController extends Controller
{
    public function payroll(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employer_id' => 'required',
            'flag' => 'required',
        ]);


        $flag_payroll = 0;
        //if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
            ], 400);
        }
        $EmployerId = $request->employer_id;
        $id = $request->id;
        $id_type = $id;
        $flag = $request->flag;
        $bank = "";
        if ($flag == "business") {
            foreach ($id as  $id) {
                $employees = User::where('business_id', $id)->get();
                $bank = EmployerBusiness::with('banks')->where('id', $id)->first();
            }
        } else if ($flag == "branch") {
            foreach ($id as $id) {
                $employees = User::where('branch_id', $id)->get();
                $bank = Branch::with('banks')->where('id', $id)->first();
                if (!$bank) {
                    $business = Branch::select('employer_business_id')->where('id', $id)->first();
                    $bank = EmployerBusiness::with('banks')->where('id', $business->employer_business_id)->first();
                }
            }
        } else if ($flag == "department") {
            foreach ($id as $id) {
                $employees = User::where('department_id', $id)->get();
                $branch = Department::select('branch_id')->where('id', $id)->first();
                $bank = Branch::with('banks')->where('id', $branch->branch_id)->first();
                if (!$bank) {
                    $business = Branch::select('employer_business_id')->where('id', $branch->branch_id)->first();
                    $bank = EmployerBusiness::with('banks')->where('id', $business->employer_business_id)->first();
                }
            }
        } else if ($flag == "all") {
            $employees = User::where('employer_id', $EmployerId)->get();
            //Checking for pending approval or rejection leaves , attendance or overtime
            $pending_leaves = LeaveRequest::where('employer_id', $request->employer_id)->where('status', '0')->get();
            $pending_overtime = Overtime::where('employer_id', $request->employer_id)->where('status', '0')->get();
            $pending_attendance = Attendance::where('employer_id', $request->employer_id)->where('approve_reject', null)->get();

            if ((count($pending_leaves) > 0)) {

                if ($request->expectsJson()) {
                    // Handle API-specific logic here
                    return response()->json([
                        'message' => 'There is pending leave requests'
                    ], 400);
                } else {
                    // Handle web form-specific logic here
                    return  notify()->error(__('There is pending leave requests'));
                }
            }
            if ((count($pending_overtime) > 0)) {
                if ($request->expectsJson()) {
                    // Handle API-specific logic here
                    return response()->json([
                        'message' => 'There is pending overtime requests'
                    ], 400);
                } else {
                    // Handle web form-specific logic here
                    return  notify()->error(__('There is pending overtime requests'));
                }
            }
            if ((count($pending_attendance) > 0)) {
                if ($request->expectsJson()) {
                    // Handle API-specific logic here
                    return response()->json([
                        'message' => 'There is pending attendance approvals'
                    ], 400);
                } else {
                    // Handle web form-specific logic here
                    return  notify()->error(__('There is pending attendance approvals'));
                }
            }
        } else if ($flag == "others") {
            $i = 0;
            $newIdResponse = [];
            // dd($id);

            //for Web
            $idResponse = $id;
            $inputString = $idResponse;
            $result = array_map(function ($val) {
                return [$val];
            }, $inputString);
            //For app

            //0ld
            // $idResponse = $id[0];
            // $inputString = $idResponse;
            // $values = explode(',', $inputString);

            // $result = array_map(function ($val) {
            //     return [$val];
            // }, $values);
            //End Old

            //dd($result);
            $idResponse = $result;
            $newid = $idResponse;
            foreach ($newid as $id) {
                $i = $i + 1;
                // Inside the loop, you fetch a user record based on each $id and add it to the $employees array.
                $employees[] = User::where('id', $id)->first();
            }
        }

        $flag_type = $flag;
        $today = Carbon::today();

        $employee_count = 0;
        if ($flag == "others") {
            $employee_count = 1;
        } else {
            if ($employees->count() > 0) {
                $employee_count = 1;
            }
        }
        if ($employee_count == 1) {
            $result = $this->get_csv_data($flag_type, $id_type, $employees, $bank);

            foreach ($employees as $employee) {
                if ($employee->salary_type == "1" && $employee->status == "1") {
                    //Taking each employees 
                    if ($employee->payed_date != Null) {
                        $LastPayedDate = $employee->payed_date;
                    } else {
                        $LastPayedDate = $employee->employment_start_date;
                    }

                    $payPeriod = CarbonPeriod::since($LastPayedDate)->until($today);

                    if ($employee->pay_period == "1") {
                        $subPeriodLength = CarbonInterval::days(14);
                    } else {
                        $subPeriodLength = CarbonInterval::days(7);
                    }

                    $subPeriods = [];
                    $startDate = $payPeriod->getStartDate();
                    while ($startDate->lessThan($payPeriod->getEndDate())) {
                        $endDate = $startDate->copy()->add($subPeriodLength)->subDay(); // Subtract one day from the end date
                        if ($endDate->gt($today)) {
                            $endDate = $today->copy(); // Adjust the end date to be equal to today's date
                        }
                        $subPeriod = CarbonPeriod::since($startDate)->until($endDate);
                        $subPeriods[] = $subPeriod;
                        $startDate = $endDate->copy()->addDay(); // Add one day to the start date for the next sub-period
                    }
                    if (count($subPeriods) > 0) {
                        $flag = 0;
                        foreach ($subPeriods as $week) {

                            if ($employee->pay_period == "1") {
                                if (count($week) < 14) {
                                    $flag = 1;
                                    break;
                                }
                            } else {
                                if (count($week) < 7) {
                                    $flag = 1;
                                    break;
                                }
                            }
                            if ($flag == 0) {
                                $payrollcontroller = new PayrollController;
                                $fromDate = $week->getStartDate();
                                $endDate = $week->getEndDate();
                                $payrollcontroller->generate_hourly_payroll($employee, $fromDate, $endDate, $EmployerId);
                                $salaryEndDate = $endDate;
                                $employee->payed_date = $salaryEndDate;
                                $employee->save();
                            }
                        }
                    }
                }


                //Fixed salary type
                else if ($employee->salary_type == "0" && $employee->status == "1") {
                    $lastPayedDate = $employee->payed_date ?? $employee->employment_start_date;
                    switch ($employee->pay_period) {
                        case 0:
                            $frequencyType = 'weekly';
                            $payPeriodLength = '1 week';
                            break;
                        case 1:
                            $frequencyType = 'fortnightly';
                            $payPeriodLength = '2 weeks';
                            break;
                        case 2:
                            $frequencyType = 'monthly';
                            $payPeriodLength = '1 month';
                            break;
                        default:
                            throw new Exception('Invalid salary type');
                    }

                    // Calculate number of pay periods to process
                    $now = Carbon::now();
                    $payPeriods = [];
                    $lastPayedDate = Carbon::parse($lastPayedDate);
                    $startDate = $lastPayedDate->copy()->addDay();  // start with next day after last paid date
                    while ($startDate < $now) {
                        if ($frequencyType == 'monthly') {
                            $endDate = $startDate->copy()->endOfMonth();
                        } else if ($frequencyType == 'weekly') {
                            $endDate = $startDate->copy()->addWeek()->subDay();
                        } else {
                            $endDate = $startDate->copy()->addWeek(2);
                        }

                        $payPeriods[] = ['start_date' => $startDate, 'end_date' => $endDate];
                        $startDate = $endDate->copy()->addDay(); // start next pay period with next day after end date
                    }
                    $lastPayPeriod = end($payPeriods);
                    if (count($payPeriods) != 0) {

                        foreach ($payPeriods as $payPeriod) {
                            $salaryStartDate = $payPeriod['start_date'];
                            $salaryEndDate = $payPeriod['end_date'];
                            $payrollcontroller = new PayrollController;
                            $payrollcontroller->generate_fixed_payroll($employee, $salaryStartDate, $salaryEndDate, $EmployerId);
                        }

                        if (isset($salaryEndDate)) {
                            $employee->payed_date = $salaryEndDate;
                        }
                        $employee->save();
                    }
                }
            }
        } else {
            if ($request->expectsJson()) {
                // Handle API-specific logic here
                return response()->json([
                    'message' => 'Sorry, no employees match this data. Please try different criteria.'
                ], 400);
            } else {
                // Handle web form-specific logic here
                return  notify()->error(__('Sorry, no employees match this data. Please try different criteria.'));
            }
        }


        //    Comented by robin on 14-06-23   it is needed. 
        //  $hr = User::with('role')->where('employer_id', $EmployerId)->where('role_name', 'like', '%hr%')->first();
        $currentDate = Carbon::now()->format('dmy');


        if (($flag == "all" || $flag == "others")) {
            $csv_name = "HFC" . $currentDate;
            $export = new HfcExport(0, 0, $flag_type, 0,  $employees);
        } else {
            if (!$bank) {
                $bankname = "BNK";
            } else {
                $bankid = $bank->banks->id;
                $bankname = optional($bank)->banks->bank_name;
                if ($bankname == 'HFC') {
                    $csv_name = "HFC" . $currentDate;
                    $export = new HfcExport($bankid, $bankname, $flag_type, $id_type,  $employees);
                } else if ($bankname == 'BSP') {
                    $csv_name = "BSP" . $currentDate;
                    $export = new PaymentExport($bankid, $bankname, $flag_type, $id_type);
                } else if ($bankname == 'BRED') {
                    $result = $this->get_csv_data($flag_type, $id_type, $employees, $bank);
                } else if ($bankname == 'BOB') {
                } else if ($bankname == 'BRED') {
                    $result = $this->get_csv_data($flag_type, $id_type, $employees, $bank);
                } else if ($bankname == 'BOB') {
                }
            }
        }
        $store = Storage::put('exports/' . $csv_name, Excel::raw($export, \Maatwebsite\Excel\Excel::CSV));
        $path = 'exports/' . $csv_name;
        $to = "robin.reubro@gmail.com";
        //   $issend = Mail::to($to)->send(new PayrollTemplateMail($path, $EmployerId, $csv_name));
        Mail::send([], [], function ($message) use ($path, $EmployerId, $csv_name) {
            // $hr = User::where('employer_id', $EmployerId)->where('position', 1)->first();
            $hr = Role::with('user')->where('employer_id', $EmployerId)->where('role_name', 'like', '%hr%')->first();
            //$finance = User::where('employer_id', $EmployerId)->where('position', 5)->first();
            $finance = Role::with('user')->where('employer_id', $EmployerId)->where('role_name', 'like', '%finance%')->first();
            $to = "";
            if ($hr) {
                $to = [$hr->user->email];
            } elseif ($hr) {
                $to = [$hr->user->email];
            } elseif ($finance) {
                $to = [$finance->user->email];
            } else {
                $employer = Employer::where('employer_id', $EmployerId)->first();
                $to = $employer->email;
            }

            if ($to == "") {
                $to = "robin.reubro@gmail.com";
            }


            // if ($finance == null) {
            //     $to = [$hr->user->email];
            // } elseif ($hr == null) {
            //     $to = [$finance->user->email];
            // } elseif ($finance == null && $hr == null) {
            //     $employer = Employer::where('employer_id', $EmployerId)->first();
            //     $to = $employer->email;
            // } else {
            //     // $to = [$hr->user->email, $finance->user->email];
            //     $mail= optional($finance)->user->email;
            //     dd($mail);
            //     $to = [$finance->user->email];
            // }
            //    $to = "buzzmefiji@gmail.com";
            //->cc([$cc1, $cc2, $cc3]) /
            $to = "robin.reubro@gmail.com";
            $cc = "robin.reubro@gmail.com";
            $cc1 = "josephson.1991@gmail.com";
            $message->to($to)
                //   ->cc([$cc, $cc1])
                ->subject('Payroll csv file created on:' . Carbon::today()->format('d-m-Y'))
                ->attach(Storage::path($path), [
                    'as' => $csv_name,
                    'mime' => 'text/csv'
                ]);
        });
        Storage::delete($path);


        //sending payroll csv file through email mpaisa
        // $export = new MpaisaExport();
        // $store = Storage::put('exports/payroll.csv', Excel::raw($export, \Maatwebsite\Excel\Excel::CSV));
        // $path = 'exports/payroll.csv';
        // Mail::send([], [], function ($message) use ($path, $EmployerId) {
        //     $hr = User::where('employer_id', $EmployerId)->where('position', 1)->first();
        //     $finance = User::where('employer_id', $EmployerId)->where('position', 5)->first();
        //     if($finance == null){
        //         $to = [$hr->email];
        //     }elseif($hr == null){
        //         $to = [$finance->email];
        //     }elseif($finance == null && $hr == null){
        //         $employer = Employer::where('employer_id', $EmployerId)->first();
        //         $to = $employer->email;
        //     }else{
        //         $to = [$hr->email, $finance->email];
        //     }
        //     $message->to($to)
        //             ->subject('Payroll csv file created on:'.Carbon::today()->format('d-m-Y'))
        //             ->attach(Storage::path($path), [
        //                 'as' => 'mpaisa.csv',
        //                 'mime' => 'text/csv'
        //             ]);
        // });
        // Storage::delete($path); 



        //end sending

        //sending payroll csv file through email mycash
        // $export = new MycashExport();
        // $store = Storage::put('exports/payroll.csv', Excel::raw($export, \Maatwebsite\Excel\Excel::CSV));
        // $path = 'exports/payroll.csv';
        // Mail::send([], [], function ($message) use ($path, $EmployerId) {
        //     $hr = User::where('employer_id', $EmployerId)->where('position', 1)->first();
        //     $finance = User::where('employer_id', $EmployerId)->where('position', 5)->first();
        //     if($finance == null){
        //         $to = [$hr->email];
        //     }elseif($hr == null){
        //         $to = [$finance->email];
        //     }elseif($finance == null && $hr == null){
        //         $employer = Employer::where('employer_id', $EmployerId)->first();
        //         $to = $employer->email;
        //     }else{
        //         $to = [$hr->email, $finance->email];
        //     }
        //     $message->to($to)
        //             ->subject('Payroll csv file created on:'.Carbon::today()->format('d-m-Y'))
        //             ->attach(Storage::path($path), [
        //                 'as' => 'mycash.csv',
        //                 'mime' => 'text/csv'
        //             ]);
        // });
        // Storage::delete($path); 

        if ($request->expectsJson()) {
            // Handle API-specific logic here
            return response()->json([
                'message' => 'Payroll calculated successfully.',
            ]);
            return response()->json([
                'message' => 'Payroll calculated successfully.',
            ]);
        } else {
            // Handle web form-specific logic here
            return  notify()->success(__('Payroll calculated successfully.'));
        }


        // if($flag_payroll==1)
        // {

        // }
        // else{
        //     return response()->json([
        //         'message' => 'All Employees PayRoll Already Calculated.',
        //     ]);
        // }

    }

    public function bred_bank_template($data, $bank)
    {
        // Add Data to the Excel File
        // Read the template CSV file
        // $templatePath = '/path/to/template.csv'; // Replace with the actual path
        $banks = optional($bank)->banks;
        if ($banks) {
            $templatePath = storage_path('uploads/bank_template/' . $banks->template);
            //storage_path('app/public/uploads/bank_template/').$banks->template; // Replace with the actual path
        } else {
            $templatePath =  storage_path('app/public/csv/BRED.xlsx'); // Replace with the actual path
        }

        $template = fopen($templatePath, 'r');
        $currentDate = Carbon::now()->format('dmy');
        $csv_name = 'BRED' . $currentDate . '.xlsx';
        //  dd($csv_name);
        // Create a new CSV file for the updated data
        $updatedPath = storage_path('app/public/csv/' . $csv_name); // Replace with the desired path
        // Specify the source file and the destination for the copy
        $sourcePath = $templatePath; // Replace with the actual source file path
        $destinationPath = $updatedPath; // Replace with the desired destination path
        File::copy($sourcePath, $destinationPath);
        // Check if the copy was successful
        if (File::exists($destinationPath)) {
            // File has been successfully copied
            // You can perform additional operations on the copied file if needed

            $spreadsheet = IOFactory::load($templatePath);

            // Get the active worksheet
            $worksheet = $spreadsheet->getActiveSheet();

            // Define the starting row where data should be added
            $startRow = 3; // Assuming you have a header row, starting from the second row

            foreach ($data as $rowData) {
                $column = 'A';
                $startRow++;
                // Start with the first column

                //Bank Code
                $worksheet->setCellValue($column . $startRow, $bank->other_bank_code);
                $column++;

                //Name
                $worksheet->setCellValue($column . $startRow, $rowData->first_name . ' ' . $rowData->last_name);
                $column++;

                //Accnt  Number
                $worksheet->setCellValue($column . $startRow, $rowData->account_number);
                $column++;
                //AMount
                $worksheet->setCellValue($column . $startRow, "AMT");
                $column++;

                // Company Name

                $worksheet->setCellValue($column . $startRow, "BSC");
                $column++;

                // Narration 
                $worksheet->setCellValue($column . $startRow, "TEst");
            }

            // Save the modified spreadsheet to the new file
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save($destinationPath);
        } else {
            //  dd("else");
            // Handle the case where the copy failed
        }
        // End 
    }


    public function bob_bank_template($data, $bank)
    {
        // Add Data to the Excel File
        // Read the template CSV file
        // $templatePath = '/path/to/template.csv'; // Replace with the actual path
        $banks = optional($bank)->banks;
        if ($banks) {
            $templatePath = storage_path('uploads/bank_template/' . $banks->template);
            //storage_path('app/public/uploads/bank_template/').$banks->template; // Replace with the actual path
        } else {
            $templatePath =  storage_path('app/public/csv/BRED.xlsx'); // Replace with the actual path
        }

        $template = fopen($templatePath, 'r');
        $currentDate = Carbon::now()->format('dmy');
        $csv_name = 'BOB' . $currentDate . '.xlsx';
        //  dd($csv_name);
        // Create a new CSV file for the updated data
        $updatedPath = storage_path('app/public/csv/' . $csv_name); // Replace with the desired path
        // Specify the source file and the destination for the copy
        $sourcePath = $templatePath; // Replace with the actual source file path
        $destinationPath = $updatedPath; // Replace with the desired destination path
        File::copy($sourcePath, $destinationPath);
        // Check if the copy was successful
        if (File::exists($destinationPath)) {
            // File has been successfully copied
            // You can perform additional operations on the copied file if needed

            $spreadsheet = IOFactory::load($templatePath);

            // Get the active worksheet
            $worksheet = $spreadsheet->getActiveSheet();

            // Define the starting row where data should be added
            $startRow = 3; // Assuming you have a header row, starting from the second row

            foreach ($data as $rowData) {
                $column = 'A';
                $startRow++;
                // Start with the first column

                //Bank Code
                $worksheet->setCellValue($column . $startRow, $bank->other_bank_code);
                $column++;

                //Name
                $worksheet->setCellValue($column . $startRow, $rowData->first_name . ' ' . $rowData->last_name);
                $column++;

                //Accnt  Number
                $worksheet->setCellValue($column . $startRow, $rowData->account_number);
                $column++;
                //AMount
                $worksheet->setCellValue($column . $startRow, "AMT");
                $column++;

                // Company Name

                $worksheet->setCellValue($column . $startRow, "BSC");
                $column++;

                // Narration 
                $worksheet->setCellValue($column . $startRow, "TEst");
            }

            // Save the modified spreadsheet to the new file
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save($destinationPath);
        } else {
            //  dd("else");
            // Handle the case where the copy failed
        }
        // End 
    }


    public function get_csv_data($flag, $id, $employees, $bank)
    {
        if ($flag == "business") {
            foreach ($id as  $id) {
                $data = User::with(['payroll_latest', 'split_payment'])
                    ->where('employer_id', Auth::guard('employer')->id())
                    ->where('status', '1')
                    ->where('business_id', $id)->get();
            }
        } else if ($flag == "branch") {
            foreach ($id as $id) {
                $data = User::with(['payroll_latest', 'split_payment'])
                    ->where('employer_id', Auth::guard('employer')->id())
                    ->where('status', '1')
                    ->where('branch_id', $id)->get();
            }
        } else if ($flag == "department") {
            foreach ($id as $id) {
                $data = User::with(['payroll_latest', 'split_payment'])
                    ->where('employer_id', Auth::guard('employer')->id())
                    ->where('status', '1')
                    ->where('department_id', $id)->get();
            }
        } else if ($flag == "all") {

            $data = User::with(['branch' => function ($query) {
                $query->with(['banks' => function ($relatedQuery) {
                    $relatedQuery->where('bank_name', '=', 'HFC');
                }]);
            }])->with(['payroll_latest', 'split_payment'])->where('employer_id', Auth::guard('employer')->id())->where('status', '1')->get();


            // $data = User::with(['payroll_latest', 'split_payment'])->where('employer_id', Auth::guard('employer')->id())->where('status', '1')->get();
        } else if ($flag = "others") {
            //dd($this->employees->id);
            foreach ($employees as $id) {
                //  $i = $i + 1;
                // Inside the loop, you fetch a user record based on each $id and add it to the $employees array.
                $data = User::with(['branch' => function ($query) {
                    $query->with(['banks' => function ($relatedQuery) {
                        $relatedQuery->where('bank_name', '=', 'HFC');
                    }]);
                }])->with(['payroll_latest', 'split_payment'])->where('id', $id->id)->where('status', '1')->get();
            }
        }
        $bankname = optional($bank)->banks->bank_name;
        if ($bankname == 'BRED') {
            $this->bred_bank_template($data, $bank);
        } elseif ($bankname == 'BOB') {
            $this->bob_bank_template($data, $bank);
        } elseif ($bankname == 'HFC') {
            $this->bred_bank_template($data, $bank);
        }
    }
}
