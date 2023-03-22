<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('payslip/style.css')}}">
  <title>Document</title>
</head>
<body>
<div class="salary-slip" >
            <table class="empDetail">
              <tr height="100px" style='background-color: #c2d69b'>
                <td colspan='4'>
                  <img height="90px" src='https://organisationmedia.toggleflow.com/demo/logo.png' /></td>
                <td colspan='4' class="companyName">{{optional($employee->employer)->company ?? 'no data'}}</td>
              </tr>
              <tr>
                <th>
                  Name
      </th>
                <td>
                {{$employee->first_name.' '.$employee->last_name}}
      </td>
                <td></td>
                <th>
                  Bank Code
      </th>
                <td>
                  ABC123
      </td>
                <td></td>
                <th>
                  Branch Name
      </th>
                <td>
                  {{$employee->bank_branch_name}}
      </td>
              </tr>
              <tr>
                <th>
                  Employee Code
      </th>
                <td>
                  XXXXXXXXXXX
      </td>
                <td></td>
                <th>
                  Bank Name
      </th>
                <td>
                  XXXXXXXXXXX
      </td>
                <td></td>
                <th>
                  Payslip no.
      </th>
                <td>
                  XXXXXXXXXX
      </td>
              </tr>
              <tr>
                <th>
                  Cost Centre
      </th>
                <td>
                  XXXXXXXXXXX
      </td><td></td>
                <th>
                  Bank Branch
      </th>
                <td>
                  XXXXXXXXXX
      </td><td></td>
                <th>
                  Pay Period
      </th>
                <td>
                  XXXXXXXXXXX
      </td>
              </tr>
              <tr>
                <th>
                  CC Description:
      </th>
                <td>
                  XXXXXXXXXXX
      </td><td></td>
                <th>
                  Bank A/C no.
      </th>
                <td>
                  {{$employee->account_number}}
      </td><td></td>
                <th>
                  Personel Area
      </th>
                <td>
                  XXXXXXXXXX
      </td>
              </tr>
              <tr>
                <th>
                  Grade:
      </th>
                <td>
                  18
      </td><td></td>
                <th>
                  Employee Group
      </th>
                <td>
                  Sales Manager
      </td><td></td>
                <th>
                  PAN No:
      </th>
                <td>
                  MOP72182E
      </td>
              </tr>
              <tr class="myBackground">
                <th colspan="2">
                  Payments
      </th>
                <th >
                  Particular
      </th>
                <th class="table-border-right">
                  Amount (Rs.)
      </th>
                <th colspan="2">
                  Deductions
      </th>
                <th >
                  Particular
      </th>
                <th >
                  Amount (Rs.)
      </th>
              </tr>
              <tr>
                <th colspan="2">
                  Basic Salary
      </th>
                <td></td>
                <td class="myAlign">
                  {{$base_pay}}
      </td>
                <th colspan="2" >
                  Provident Fund
      </th >
                <td></td>

                <td class="myAlign">
                  00.00
      </td>
              </tr >
              <tr>
                <th colspan="2">
                  Fixed Dearness Allowance
      </th>
                <td></td>

                <td class="myAlign">
                  00.00
      </td>
                <th colspan="2" >
                  LIC
      </th >
                <td></td>

                <td class="myAlign">
                  00.00
      </td>
              </tr >
              <tr>
                <th colspan="2">
                  Variable Dearness Allowance
      </th>
                <td></td>

                <td class="myAlign">
                  00.00
      </td>
                <th colspan="2" >
                  Loan
      </th >
                <td></td>

                <td class="myAlign">
                  00.00
      </td>
              </tr >
              <tr>
                <th colspan="2">
                  House Rent Allowance
      </th>
                <td></td>
                <td class="myAlign">
                  00.00
      </td>
                <th colspan="2" >
                  Professional Tax
      </th >
                <td></td>
                <td class="myAlign">
                  00.00
      </td>
              </tr >
              <tr>
                <th colspan="2">
                  Graduation Allowance
      </th>
                <td></td>

                <td class="myAlign">
                  00.00
      </td>
                <th colspan="2" >
                  Security Deposite(SD)
      </th >
                <td></td>

                <td class="myAlign">
                  00.00
      </td>
              </tr >
              <tr>
                <th colspan="2">
                  Conveyance Allowance
      </th> <td></td>
                <td class="myAlign">
                  00.00
      </td>
                <th colspan="2" >
                  Staff Benefit(SB)
      </th >
                <td></td>
                <td class="myAlign">
                  00.00
      </td>
              </tr >
              <tr>
                <th colspan="2">
                  Post Allowance
      </th>
                <td></td>
                <td class="myAlign">
                  00.00
      </td>
                <th colspan="2" >
                  Labour Welfare Fund
      </th >
                <td></td>
                <td class="myAlign">
                  00.00
      </td>
              </tr >
              <tr>
                <th colspan="2">
                  Special Allowance
      </th>
                <td></td>
                <td class="myAlign">
                  00.00
      </td>
                <th colspan="2" >
                  NSC
      </th >
                <td></td>
                <td class="myAlign">
                  00.00
      </td>
              </tr >
              <tr>
                <td colspan="4" class="table-border-right"></td>
                <th colspan="2" >
                  Union Thanco Officer(UTO)
      </th >
                <td></td>
                <td class="myAlign">
                  00.00
      </td>
              </tr >
              <tr>
                <td colspan="4" class="table-border-right"></td>
                <th colspan="2" >
                  Advance
      </th >
                <td></td>
                <td class="myAlign">
                  00.00
      </td>
              </tr >
              <tr>
                <td colspan="4" class="table-border-right"></td>
                <th colspan="2" >
                  Income Tax
      </th > <td></td>
                <td class="myAlign">
                  00.00
      </td>
              </tr >
              <tr class="myBackground">
                <th colspan="3">
                  Total Payments
      </th>
                <td class="myAlign">
                  10000
      </td>
                <th colspan="3" >
                  Total Deductions
      </th >
                <td class="myAlign">
                  1000
      </td>
              </tr >
              <tr height="40px">
                <th colspan="2">
                  Projection for Financial Year:
                </th>
                <th>
                </th>
                <td class="table-border-right">
                </td>
                <th colspan="2" class="table-border-bottom" >
                  Net Salary
                </th >
                <td >
                </td>
                <td >
                  XXXXXXXXXX
                </td>
              </tr >
              <tr>
                <td colspan="2">
                  Gross Salary
                </td> <td></td>
                <td class="myAlign">
                  00.00
      </td><td colspan="4"></td>
              </tr >
              <tr>
                <td colspan="2">
                  Aggr. Dedu - P.Tax & Std Ded
      </td> <td></td>
                <td class="myAlign">
                  00.00
      </td>
                <th colspan="2" >
                  Cumulative
      </th >
                <td colspan="2"></td>
              </tr >
              <tr>
                <td colspan="2">
                  Gross Total Income
      </td> <td></td>
                <td class="myAlign">
                  00.00
      </td>
                <td colspan="2" >
                  Empl PF Contribution
      </td > <td></td>
                <td class="myAlign">
                  00.00
      </td>
              </tr >
              <tr>
                <td colspan="2">
                  Aggr of Chapter "PF"
      </td> <td></td>
                <td class="myAlign">
                  00.00
      </td><td colspan="4"></td>
              </tr >
              <tr>
                <td colspan="2">
                  Total Income
      </td> <td></td>
                <td class="myAlign">
                  00.00
      </td>
                <td colspan="4"></td>
              </tr >
              <tbody class="border-center">
                <tr>
                  <th>
                    Attend/ Absence
      </th>
                  <th>
                    Days in Month
      </th>
                  <th>
                    Days Paid
      </th>
                  <th>
                    Days Not Paid
      </th>
                  <th>
                    Leave Position
      </th>
                  <th>
                    Privilege Leave
      </th>
                  <th>
                    Sick Leave
      </th>
                  <th>
                    Casual Leave
      </th>
                </tr>
                <tr>
                  <td ></td>
                  <td ></td>
                  <td ></td>
                  <td ></td>
                  <td>Yrly Open Balance</td>
                  <td>0.0</td> <td>0.0</td>
                  <td>0.0</td>
                </tr >
                <tr>
                  <th >Current Month</th>
                  <td >31.0</td>
                  <td >31.0</td>
                  <td >31.0</td>
                  <td>Availed</td>
                  <td>0.0</td> <td>0.0</td>
                  <td>0.0</td>
                </tr >
                <tr>
                  <td colspan="4"></td>
                  <td>Closing Balance</td>
                  <td>0.0</td> <td>0.0</td>
                  <td>0.0</td>
                </tr >
                <tr>
                  <td colspan="4"> &nbsp; </td>
                  <td > </td>
                  <td > </td>
                  <td > </td>
                  <td > </td>
                </tr >
                <tr>
                  <td colspan="4"></td>
                  <td>Company Pool Leave Balance</td>
                  <td>1500</td>
                  <td ></td>
                  <td ></td>
                </tr >
              </tbody>
            </table >

          </div >
     
</body>
</html>