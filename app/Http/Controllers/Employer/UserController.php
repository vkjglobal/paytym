<?php

namespace App\Http\Controllers\Employer;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests\Employer\StoreUserRequest;
use App\Http\Requests\Employer\UpdateUserRequest;
use App\Models\User;
use App\Models\Branch;
use App\Models\EmployerBusiness;
use App\Models\Department;
use App\Models\Employer;
use App\Models\Country;
use App\Models\EmployeeType;
use App\Models\PayPeriod;
use App\Models\Role;
use App\Models\LeaveRequest;
use App\Models\FrcsEmployeeData;
use Auth,Hash;
use App\Jobs\SendEmployeeInfo;
use Barryvdh\DomPDF\Facade\Pdf;
use symfony\Component\Mailer\Exception\TransportExceptionInterface;
use App\Jobs\EmployeeCreationPushNotification;
use App\Mail\EmployeeCredentialsMail;
use App\Models\EmployeeExtraDetails;
use App\Models\SplitPayment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Mail;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Imports\ExistingUserImport;
use App\Imports\FRCSUserImport;
use Illuminate\Support\Facades\Response;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        {
            $breadcrumbs = [
                [(__('Dashboard')), route('employer.user.index')],
                [(__('Users')), null],
            ];
    
            $users = User::where('employer_id',Auth::guard('employer')->user()->id)->with('business')->latest()->get();
            $roles = Role::where('employer_id',Auth::guard('employer')->user()->id)->get();   
          
            return view('employer.user.index', compact('breadcrumbs', 'users','roles'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.user.create')],
            [(__('Users')), null],
        ];
        $branches = Branch::where('employer_id',Auth::guard('employer')->user()->id)->where('status', '1')->get();
        $departments = Department::where('employer_id',Auth::guard('employer')->user()->id)->where('status', '1')->get();
        $businesses = EmployerBusiness::where('employer_id',Auth::guard('employer')->user()->id)->where('status', '1')->get();
        // $businesses = EmployerBusiness::where('employer_id',Auth::guard('employer')->user()->id)->where('status', '1')->get();
        $countries = Country::get();
        $roles = Role::where('employer_id',Auth::guard('employer')->user()->id)->get();  
        return view('employer.user.create',compact('breadcrumbs','branches','roles','departments','businesses','countries'));
    }

    // public function employee_period_get_branch($business_id=0)
    // {
    //     $branchData['data'] = Branch::orderby("name","asc")->select('id','name')
    //     ->where('employer_id', $this->employer_id())->where('employer_business_id', $business_id)->get();
    //     return response()->json($branchData);
    // }
    // public function employee_period_get_department($branch_id=0)
    // {
    //     $departmentData['data'] = Department::orderby("dep_name","asc")->select('id','dep_name')
    //     ->where('employer_id', $this->employer_id())->where('branch_id', $branch_id)->get();
    //     return response()->json($departmentData);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
     $user = new User(); 
     $validated = $request->validated();
   
     $user->employer_id = Auth::guard('employer')->user()->id;
     $user->company = Auth::guard('employer')->user()->company;
     $user->first_name = $validated['first_name'];
     $user->last_name = $validated['last_name'];
     $user->job_title = $validated['job_title'];
     $user->email = $validated['email'];
     $user->branch_id = $validated['branch'];
     $user->country_id = $validated['country'];
     $user->position = $validated['position'];
     $user->phone = $validated['phone'];
     $user->date_of_birth = $validated['date_of_birth'];
     $user->street = $validated['street'];
     $user->postcode = $validated['postcode'];
     $user->tin = $validated['tin'];
     $user->bank = $validated['bank'];
     $user->city = $validated['city'];
     $user->account_number = $validated['account_number'];
     $user->salary_type = $validated['salary_type'];
     $user->business_id = $validated['business'];
     $user->department_id = $validated['department'];
     $user->bank_branch_name = $validated['bank_branch'];
     $user->employment_start_date = $validated['start_date'];
     $user->employment_end_date = $validated['end_date'];
     $user->check_in_default = $request->get('start_time');
     $user->check_out_default = $request->get('end_time');
     $password =  Str::random(8);
     $user->password = FacadesHash::make($password);
     if($request->get('check_out_reqd') != null)
     {
     $user->check_out_requred = '1';
     }

    // Robin 02-08-23
    $user->licence_no = $request->get('licence_no');
    $user->licence_expiry_date = $request->get('licence_expiry_date');
    $user->passport_no = $request->get('passport_no');
    $user->passport_expiry_date = $request->get('passport_expiry_date');

    //20-10-23 N
    $user->tax_code = $request->get('tax_code');

    //  $user->pay_period = $validated['payperiod'];
     
     if(!empty($validated['hourly_rate'])){
        $user->rate = $validated['hourly_rate'];
     }

     if(!empty($validated['payperiod'])){
        $user->pay_period = $validated['payperiod'];
     }
     if(!empty($validated['hourly_pay_period'])){
        $user->pay_period = $validated['hourly_pay_period'];
     }
     if(!empty($validated['fixed-rate'])){
        $user->rate = $validated['fixed-rate'];
     }
     $user->employee_type = $validated['employeetype'];
     if( isset($validated['work_days_per_week'])){
        $user->workdays_per_week = $validated['work_days_per_week'];
     }
     if(isset($validated['total_hours_per_week'])){
        $user->total_hours_per_week = $validated['total_hours_per_week'];
     }
     if(isset($validated['extra_hours_at_base_rate'])){
        $user->extra_hours_at_base_rate = $validated['extra_hours_at_base_rate'];
     }
     
    //  $user->password = Hash::make($validated['password']);

     if ($request->hasFile('image')) {
        $path =  $request->file('image')->storeAs(  
            'uploads/users',
            urlencode(time()) . '_' . uniqid() . '_' . $request->image->getClientOriginalName(),
            'public'
        );
        $user->image = $path;
    }
    $issave = $user->save();

    $split_payment = new SplitPayment();
    $split_payment->employee_id = $user->id;
    $split_payment->employer_id = Auth::guard('employer')->id();
    $split_payment->save();


    if($issave){
        $employeeName = $validated['first_name'];
        $employeeBranch = Branch::where('id',$validated['branch'])->first()->name;
        $position = Role::where('id', $validated['position'])->first()->role_name;
        EmployeeCreationPushNotification::dispatch(Auth::guard('employer')->user()->id,$employeeBranch,$position,$employeeName);
      
        $email = new EmployeeCredentialsMail($user,$password);
        //mail confirmation
        //mail
        FacadesMail::to($validated['email'])->send($email);
        //FacadesMail::to($validated['email'])->send(new Employee($employer,$password));

        notify()->success(__('Created successfully'));
            } else {
                notify()->error(__('Failed to Create. Please try again'));
            }
            return redirect()->back();
    }
     

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.branch.create')],
            [(__('Branch')), null],
        ];
        $branches = Branch::where('employer_id',Auth::guard('employer')->user()->id)->where('status', '1')->get();
        $departments = Department::where('employer_id',Auth::guard('employer')->user()->id)->where('status', '1')->get();
        $businesses = EmployerBusiness::where('employer_id',Auth::guard('employer')->user()->id)->where('status', '1')->get();
        $countries = Country::get();
        $roles = Role::where('employer_id',Auth::guard('employer')->user()->id)->get();  
        
        return view('employer.user.edit',compact('breadcrumbs','user','branches','roles','countries','businesses','departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request,User $user)
    {
     $validated = $request->validated();
     $user->employer_id = Auth::guard('employer')->user()->id;
     $user->company = Auth::guard('employer')->user()->company;
     $user->first_name = $validated['first_name'];
     $user->last_name = $validated['last_name'];
     $user->email = $validated['email'];
     $user->job_title = $validated['job_title'];
     $user->branch_id = $validated['branch'];
     $user->country_id = $validated['country'];
     $user->position = $validated['position'];
     $user->phone = $validated['phone'];
     $user->date_of_birth = $validated['date_of_birth'];
     $user->street = $validated['street'];
     $user->postcode = $validated['postcode'];
     $user->tin = $validated['tin'];
     $user->bank = $validated['bank'];
     $user->city = $validated['city'];
     $user->account_number = $validated['account_number'];
     $user->salary_type = $validated['salary_type'];
     $user->business_id = $validated['business'];
     $user->department_id = $validated['department'];
     $user->bank_branch_name = $validated['bank_branch'];
     $user->employment_start_date = $validated['start_date'];
     $user->employment_end_date = $validated['end_date'];
    //  $user->pay_period = $validated['payperiod'];
    if($request->get('check_out_reqd') == '0')
     {
     $user->check_out_requred = '1';
     }
     else{
        $user->check_out_requred = '0';
     }
     
     if(!empty($validated['hourly_rate'])){
        $user->rate = $validated['hourly_rate'];
     }

     if(!empty($validated['payperiod'])){
        $user->pay_period = $validated['payperiod'];
     }
     if(!empty($validated['hourly_pay_period'])){
        $user->pay_period = $validated['hourly_pay_period'];
     }
     if(!empty($validated['fixed-rate'])){
        $user->rate = $validated['fixed-rate'];
     }
     $user->employee_type = $validated['employeetype'];
     if( isset($validated['work_days_per_week'])){
        $user->workdays_per_week = $validated['work_days_per_week'];
     }
     if(isset($validated['total_hours_per_week'])){
        $user->total_hours_per_week = $validated['total_hours_per_week'];
     }
     if(isset($validated['extra_hours_at_base_rate'])){
        $user->extra_hours_at_base_rate = $validated['extra_hours_at_base_rate'];
     }

     if(isset($validated['password'])){
        $user->password = Hash::make($validated['password']);
     }

       // Robin 02-08-23
    $user->licence_no = $request->get('licence_no');
    $user->licence_expiry_date = $request->get('licence_expiry_date');
    $user->passport_no = $request->get('passport_no');
    $user->passport_expiry_date = $request->get('passport_expiry_date');

     //20-10-23 N
     $user->tax_code = $request->get('tax_code');
     
    //  $user->password = Hash::make($validated['password']);
    
    $image=$user->image;
     if ($request->hasFile('image')) {
        if (Storage::exists('public/'. $image))  {
            $del=Storage::delete('public/'.$image);
           
        } 
        $path =  $request->file('image')->storeAs(  
            'uploads/users',
            urlencode(time()) . '_' . uniqid() . '_' . $request->image->getClientOriginalName(),
            'public'
        );
        $user->image = $path;
    }
    $issave = $user->save();
    if($issave){
        notify()->success(__('Updated successfully'));
            } 
            else {
        notify()->error(__('Failed to Update. Please try again'));
            }
            return redirect()->route('employer.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {   
        $user->paymentAdvance()->delete();
        $image = $user->imagel;
        if (Storage::exists('public/'. $image))  {
            $del=Storage::delete('public/'.$image);
           
        } 
        $res = $user->delete();
    
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }


    //Change Employer Status
    public function changeStatus(Request $request){
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $res= $user->save();
        if($res){
        return response()->json(['success' => 'Status change successfully.']);
        }
    }

    public function SendMailWithPublicInfo(Request $request)
    {
        $request = $request->validate([
            'recipient_mail' => 'required|email',
            'user_id'=> 'required'
        ]);
        $user_id = $request['user_id'];
        $user = User::findOrFail($user_id); 
        $role = Role::where('id',$user->position)->first();
        //dd($role);
        $rolename = $role->role_name;
        //return view('employer.user.publicinformation', compact('user','rolename'));
        $recipientMail = $request['recipient_mail'];
        $email = $user->email;
        $name = $user->first_name;
        $data=['user'=>$user,'rolename'=>$rolename];
        //dd($data);
        $data["email"]= $recipientMail;
        $data["name"] = $name;
        SendEmployeeInfo::dispatch($data,$user,$rolename);
        notify()->success(__('Mail Send'));
        return redirect()->route('employer.user.index');
       
    }

    public function importEmployee()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.user.index')],
            [(__('Users')), null],
        ];

        return view('employer.user.user_import', compact('breadcrumbs'));
    }
    public function importExistingEmployee()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.user.index')],
            [(__('Users')), null],
        ];

        return view('employer.user.existing_user_import', compact('breadcrumbs'));
    }

    public function csvfile(Request $request)
    {
        //return $request;
        //return $request->file('csvfile');
         $request->validate([
            //'csvfile' => 'required',//|file|mimes:xls,xlsx,csv',
            'csvfile' => 'required|mimes:csv,xls,xlsx',
        ]); 

        $file = $request->file('csvfile');
       
        try {
            Excel::import(new UsersImport, $request->file('csvfile'));
            $recentlyImportedEmployees = User::where('created_at', '>=', Carbon::now()->subMinute())->get();
           foreach($recentlyImportedEmployees as $user)
           {
                $employeeName = $user->first_name;
                $branch =  Branch::where('id',$user->branch_id)->first();
                 if(!is_null($branch))
                    {
            
                        $employeeBranch = Branch::where('id',$user->branch_id)->first()->name;
                    }
                 else
                    {
                        $employeeBranch = "";
                    }
                        $role = Role::where('id', $user->position)->first();
                    if(!is_null($role)){
                         $position = Role::where('id', $user->position)->first()->role_name;
                    }
                    else{
                            $position = "";
                        }
                        $password =  Str::random(8);
                        $hashedPassword = FacadesHash::make($password);
                        User::where('id', $user->id)->update(['password' => $hashedPassword]);
                
                        //$user->save();
                        EmployeeCreationPushNotification::dispatch(Auth::guard('employer')->user()->id,$employeeBranch,$position,$employeeName);
            
                        $email = new EmployeeCredentialsMail($user,$password);
                        //mail confirmation
                        //mail
                        FacadesMail::to($user->email)->send($email);
                        notify()->success(__('Imported successfully'));
           }


            
        } catch (Exception $e) {
            notify()->error(__('Failed to upload file. Wrong csv format. Please try again'));
        }
        return redirect()->back();
    }

    public function frcsimport(Request $request)
    {
        //return $request;
        //return $request->file('csvfile');
         $request->validate([
            //'csvfile' => 'required',//|file|mimes:xls,xlsx,csv',
            'csvfile' => 'required|mimes:csv,xls,xlsx',
        ]); 

        $file = $request->file('csvfile');
       
        try {
            Excel::import(new ExistingUserImport, $request->file('csvfile'));
            $recentlyImportedEmployees = User::where('created_at', '>=', Carbon::now()->subMinute())->get();
          
            //$importedEmployeeIds = [];
            Excel::import(new FrcsUserImport, $request->file('csvfile'));

            foreach($recentlyImportedEmployees as $user)
           {
                /* $userId = $user->id;
                //dd($request->file('csvfile'));
                if (!in_array($userId, $importedEmployeeIds)) {
                    $import = new FrcsUserImport($userId);
                    Excel::import($import, $file);
    
                    $importedEmployeeIds[] = $userId; */
                //Excel::import(new FrcsUserImport($userId), $request->file('csvfile'));
                $employeeName = $user->first_name;
                $branch =  Branch::where('id',$user->branch_id)->first();
                 if(!is_null($branch))
                    {
            
                        $employeeBranch = Branch::where('id',$user->branch_id)->first()->name;
                    }
                 else
                    {
                        $employeeBranch = "";
                    }
                        $role = Role::where('id', $user->position)->first();
                    if(!is_null($role)){
                         $position = Role::where('id', $user->position)->first()->role_name;
                    }
                    else{
                            $position = "";
                        }
                        $password =  Str::random(8);
                        $hashedPassword = FacadesHash::make($password);
                        User::where('id', $user->id)->update(['password' => $hashedPassword]);
                
                      
                        EmployeeCreationPushNotification::dispatch(Auth::guard('employer')->user()->id,$employeeBranch,$position,$employeeName);
            
                        $email = new EmployeeCredentialsMail($user,$password);
                        
                        FacadesMail::to($user->email)->send($email);
                        notify()->success(__('Imported successfully'));
           }
        //}

            
        } catch (Exception $e) {
            notify()->error(__('Failed to upload file. Wrong csv format. Please try again'));
        }
        return redirect()->back();
    }

    public function downloadTemplate_newEmployee()
    {
        $templatePath = public_path('user_assets/user_import_templates/new_employee_import_template.csv');
        
        if (file_exists($templatePath)) {
            return Response::download($templatePath, 'new_employee_import_template.csv');
        } else {
            return redirect()->back()->with('message', 'File does not exist!');
            // abort(404);
        }
    }

    public function downloadTemplate_existingEmployee()
    {
        $templatePath = public_path('user_assets/user_import_templates/existing_employee_import_template.csv');
        
        if (file_exists($templatePath)) {
            return Response::download($templatePath, 'existing_employee_import_template.csv');
        } else {
            return redirect()->back()->with('message', 'File does not exist!');
            // abort(404);
        }
    }

    public function downloadInstruction()
    {
        $templatePath = public_path('user_assets/user_import_templates/Instruction manual for New Employee Import.docx');
        if (file_exists($templatePath)) {
            return Response::download($templatePath, 'Instruction manual for New Employee Import.docx');
        } else {
            return redirect()->back()->with('message', 'File does not exist!');
            // abort(404);
        }
    }

    public function downloadexEmpInstruction()
    {
        $templatePath = public_path('user_assets/user_import_templates/Instruction manual for Existing Employee Import.docx');
        if (file_exists($templatePath)) {
            return Response::download($templatePath, 'Instruction manual for Existing Employee Import.docx');
        } else {
            return redirect()->back()->with('message', 'File does not exist!');
            // abort(404);
        }
    }
    
    
}
