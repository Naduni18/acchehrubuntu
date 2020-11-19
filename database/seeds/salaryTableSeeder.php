<?php

use Illuminate\Database\Seeder;

class salaryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('salary')->insert([
                    'emp_id'=>'3',
                    'name'=>'Rukshan',
                    'designation'=>'chief executive officer',
                    'branch'=>'Maharagama',
                    'department'=>'HR',
                    'bank'=>'Commercial Bank of Ceylon PLC',
                    'bank_branch'=>'Maharagama',
                    'remitted_account_no'=>'3006655229',
                    'EPF_number'=>'87154ASDFRG54FD54ED',
                    'for_year'=>'2020',
                    'for_month'=>'March',
                    'date'=>'2020-10-31',
                    'basic_salary'=>'15000.00',
                    'variable_allowance'=>'25000.00',
                    'incentice'=>'10000.00',
                    'holiday_allowance'=>'5000.00',
                    'commission'=>'35000.00',
                    'phone_allowance'=>'1000.00',
                    'gross_salary'=>'91000.00',
                    'epf_employe_cont'=>'1120.00',
                    'salary_advance'=>'5000.00',
                    'telephone_deduction'=>'1500.00',
                    'no_pay'=>'1000.00',
                    'staff_loan'=>'2000.00',
                    'paye_tax'=>'1000.00',
                    'total_deductions'=>'11620.00',
                    'net_salary'=>'79380.00',
                    'epf_company_cont'=>'1680.00',
                    'etf_company_cont'=>'450.00',
                    'remitted_amount'=>'79380.00',
                    'created_at'=>now(),
                    'updated_at'=>now()
        ]);
    DB::table('salary')->insert([
                    'emp_id'=>'3',
                    'name'=>'Rukshan',
                    'designation'=>'chief executive officer',
                    'branch'=>'Maharagama',
                    'department'=>'HR',
                    'bank'=>'Commercial Bank of Ceylon PLC',
                    'bank_branch'=>'Maharagama',
                    'remitted_account_no'=>'3006655229',
                    'EPF_number'=>'87154ASDFRG54FD54ED',
                    'for_year'=>'2020',
                    'for_month'=>'October',
                    'date'=>'2020-10-31',
                    'basic_salary'=>'15000.00',
                    'variable_allowance'=>'25000.00',
                    'incentice'=>'10000.00',
                    'holiday_allowance'=>'5000.00',
                    'commission'=>'35000.00',
                    'phone_allowance'=>'1000.00',
                    'gross_salary'=>'91000.00',
                    'epf_employe_cont'=>'1120.00',
                    'salary_advance'=>'5000.00',
                    'telephone_deduction'=>'1500.00',
                    'no_pay'=>'1000.00',
                    'staff_loan'=>'2000.00',
                    'paye_tax'=>'1000.00',
                    'total_deductions'=>'11620.00',
                    'net_salary'=>'79380.00',
                    'epf_company_cont'=>'1680.00',
                    'etf_company_cont'=>'450.00',
                    'remitted_amount'=>'79380.00',
                    'created_at'=>now(),
                    'updated_at'=>now()
        ]);
    DB::table('salary')->insert([
                    'emp_id'=>'3',
                    'name'=>'Rukshan',
                    'designation'=>'chief executive officer',
                    'branch'=>'Maharagama',
                    'department'=>'HR',
                    'bank'=>'Commercial Bank of Ceylon PLC',
                    'bank_branch'=>'Maharagama',
                    'remitted_account_no'=>'3006655229',
                    'EPF_number'=>'87154ASDFRG54FD54ED',
                    'for_year'=>'2020',
                    'for_month'=>'May',
                    'date'=>'2020-10-31',
                    'basic_salary'=>'15000.00',
                    'variable_allowance'=>'25000.00',
                    'incentice'=>'10000.00',
                    'holiday_allowance'=>'5000.00',
                    'commission'=>'35000.00',
                    'phone_allowance'=>'1000.00',
                    'gross_salary'=>'91000.00',
                    'epf_employe_cont'=>'1120.00',
                    'salary_advance'=>'5000.00',
                    'telephone_deduction'=>'1500.00',
                    'no_pay'=>'1000.00',
                    'staff_loan'=>'2000.00',
                    'paye_tax'=>'1000.00',
                    'total_deductions'=>'11620.00',
                    'net_salary'=>'79380.00',
                    'epf_company_cont'=>'1680.00',
                    'etf_company_cont'=>'450.00',
                    'remitted_amount'=>'79380.00',
                    'created_at'=>now(),
                    'updated_at'=>now()
        ]);
    }
}
