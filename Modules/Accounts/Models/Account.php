<?php

namespace Modules\Accounts\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Accounts\Database\Factories\AccountFactory;
use Illuminate\Support\Facades\DB;

class Account extends Model
{



    public static function getActiveAcounts()
    {
           $admin_id = session('admin_id');

         return DB::table('account_employee_details') 
            ->where('c_status', 'Y')
            ->where('n_slno', '!=', $admin_id)  // Exclude logged-in user
            ->get()->pluck('C_FNAME', 'n_slno');
    }



    public static function insertrequestdata($data)
    {
        return DB::table('account_request_data')->insert($data);
    }
    public static function insertExpenceRequestData($data)
    {
        return DB::table('account_expence_request')->insert($data);
    }


    public static function getRequestList($fromDate, $toDate)
    {
        return DB::table('account_request_data as a')
        ->join('account_employee_details as b', 'a.n_from_id', '=', 'b.n_slno')
        ->join('account_employee_details as c', 'a.n_to_id', '=', 'c.n_slno')
        ->where('a.c_superadmin_status', 'pending') 
        ->where('a.c_superadmin_status', 'pending')  
         ->whereDate('a.d_date', '>=', $fromDate)
        ->whereDate('a.d_date', '<=', $toDate)
        ->select(
            'a.c_active_user',
            'a.n_usdt',
            'a.n_amount_inr',
            'a.d_date',
            'a.n_from_id',
            'a.n_to_id',
            'a.n_slno',
            'b.C_FNAME' ,
            'a.c_superadmin_status' ,
            'a.c_admin_status',
            'c.C_FNAME as to_name'
        )->get();
        

    }
    public static function getRequestListSub($fromDate, $toDate)
    {
        return DB::table('account_request_data as a')
        ->join('account_employee_details as b', 'a.n_from_id', '=', 'b.n_slno')
        ->join('account_employee_details as c', 'a.n_to_id', '=', 'c.n_slno')
        ->where('a.c_admin_status', 'pending')  
           ->where('a.c_superadmin_status', '!=', 'rejected')
         ->whereDate('a.d_date', '>=', $fromDate)
        ->whereDate('a.d_date', '<=', $toDate)
        ->select(
            'a.c_active_user',
            'a.n_usdt',
            'a.n_amount_inr',
            'a.d_date',
            'a.n_from_id',
            'a.n_slno',
            'b.C_FNAME' ,
            'a.c_superadmin_status' ,
            'a.c_admin_status',
            'c.C_FNAME as to_name'
        )->get();
        

    }
    public static function getRequestListUser($fromDate, $toDate)
    {
        return DB::table('account_request_data as a')
        ->join('account_employee_details as b', 'a.n_from_id', '=', 'b.n_slno')
                ->join('account_employee_details as c', 'a.n_to_id', '=', 'c.n_slno')

        ->where('a.c_superadmin_status', 'pending')  
        ->where('a.c_admin_status', 'pending')  
         ->whereDate('a.d_date', '>=', $fromDate)
        ->whereDate('a.d_date', '<=', $toDate)
        ->select(
            'a.c_active_user',
            'a.n_usdt',
            'a.n_amount_inr',
            'a.d_date',
            'a.n_from_id',
            'a.n_slno',
            'b.C_FNAME' ,
            'a.c_superadmin_status' ,
            'a.c_admin_status',
            'c.C_FNAME as to_name'
        )->get();
        

    }


    public static function getApproveList($fromDate, $toDate)
    {
        return DB::table('account_request_data as a')
        ->join('account_employee_details as b', 'a.n_from_id', '=', 'b.n_slno')
                ->join('account_employee_details as c', 'a.n_to_id', '=', 'c.n_slno')

        
            ->where(function($query) {
                $query->where('a.c_superadmin_status', 'approved')
                    ->orWhere('a.c_admin_status', 'approved');
            })
         ->whereDate('a.d_super_approve', '>=', $fromDate)
        ->whereDate('a.d_super_approve', '<=', $toDate)
        ->select(
            'a.c_active_user',
            'a.n_usdt',
            'a.n_amount_inr',
            'a.d_date',
            'a.n_from_id',
            'a.n_slno',
            'b.C_FNAME' ,
            'a.c_superadmin_status' ,
            'a.c_admin_status',
            'c.C_FNAME as to_name'
        )->get();
        

    }

    public static function getRejectList($fromDate, $toDate)
    {
        return DB::table('account_request_data as a')
        ->join('account_employee_details as b', 'a.n_from_id', '=', 'b.n_slno')
                ->join('account_employee_details as c', 'a.n_to_id', '=', 'c.n_slno')
        ->where('a.c_superadmin_status', 'rejected')  

         ->whereDate('a.d_super_reject', '>=', $fromDate)
        ->whereDate('a.d_super_reject', '<=', $toDate)
        ->select(
            'a.c_active_user',
            'a.n_usdt',
            'a.n_amount_inr',
            'a.d_date',
            'a.n_from_id',
            'a.n_slno',
            'b.C_FNAME' ,
            'a.c_superadmin_status' ,
            'a.c_admin_status',
            'c.C_FNAME as to_name'
        )->get();
        

    }
    public static function getRejectListAdmin($fromDate, $toDate)
    {
        return DB::table('account_request_data as a')
        ->join('account_employee_details as b', 'a.n_from_id', '=', 'b.n_slno')
                ->join('account_employee_details as c', 'a.n_to_id', '=', 'c.n_slno')
        ->where('a.c_admin_status', 'rejected')  

         ->whereDate('a.d_admin_reject', '>=', $fromDate)
        ->whereDate('a.d_admin_reject', '<=', $toDate)
        ->select(
            'a.c_active_user',
            'a.n_usdt',
            'a.n_amount_inr',
            'a.d_date',
            'a.n_from_id',
            'a.n_slno',
            'b.C_FNAME' ,
            'a.c_superadmin_status' ,
            'a.c_admin_status',
            'c.C_FNAME as to_name'
        )->get();
        

    }
    public static function getRejectListUser($fromDate, $toDate)
    {
        return DB::table('account_request_data as a')
        ->join('account_employee_details as b', 'a.n_from_id', '=', 'b.n_slno')
                ->join('account_employee_details as c', 'a.n_to_id', '=', 'c.n_slno')
          ->where(function($query) {
                $query->where('a.c_superadmin_status', 'rejected')
                    ->orWhere('a.c_admin_status', 'rejected');
            })

         ->whereDate('a.d_date', '>=', $fromDate)
        ->whereDate('a.d_date', '<=', $toDate)
        ->select(
            'a.c_active_user',
            'a.n_usdt',
            'a.n_amount_inr',
            'a.d_date',
            'a.n_from_id',
            'a.n_slno',
            'b.C_FNAME' ,
            'a.c_superadmin_status' ,
            'a.c_admin_status',
            'c.C_FNAME as to_name'
        )->get();
        

    }

   

        


  public static function getExpenceList($fromDate, $toDate)
{
    $query = DB::table('account_expence_request as a')
        ->join('account_employee_details as b', 'a.n_user_id', '=', 'b.n_slno')
        ->whereDate('a.d_date', '>=', $fromDate)
        ->whereDate('a.d_date', '<=', $toDate);

    // If NOT Super Admin, filter by logged-in user
    if (session('admin_id') != 1) {
        $query->where('a.n_user_id', session('admin_id'));
    }

    return $query->select(
            'a.c_tittle',
            'a.c_description',
            'a.n_amount',
            'a.d_date',
            'a.n_user_id',
            'a.n_slno',
            'b.C_FNAME',
            'a.c_status'
        )
        ->get();
}






        public static function approveRequest($id)
        {
            return DB::table('account_request_data')
                ->where('n_slno', $id)
                ->update(['c_superadmin_status' => 'approved','d_super_approve' => now()]);

        }
    public static function approveRequestExpence($id)
{
    return DB::transaction(function () use ($id) {

        // 1️⃣ Get expense request
        $expense = DB::table('account_expence_request')
            ->select('n_user_id', 'n_amount')
            ->where('n_slno', $id)
            ->lockForUpdate()
            ->first();

        if (!$expense) {
            throw new \Exception('Expense request not found');
        }

        // 2️⃣ Get wallet details
        $wallet = DB::table('account_wallet_master')
            ->where('n_user_id', $expense->n_user_id)
            ->lockForUpdate()
            ->first();

        if (!$wallet) {
            throw new \Exception('Wallet not found');
        }

        $walletBalance = $wallet->n_amount;
        $transactionAmount = $expense->n_amount;

        // 3️⃣ Check sufficient balance
        if ($walletBalance < $transactionAmount) {
            throw new \Exception('Insufficient Balance');
        }

        // 4️⃣ Generate new transaction values
        $nextSlno = (DB::table('account_wallet_transcation_master')->max('n_slno') ?? 0) + 1;
        $nextTransactionNo = (DB::table('account_wallet_transcation_master')->max('n_transcation_no') ?? 0) + 1;

        $balanceBefore = $walletBalance;
        $balanceAfter = $walletBalance - $transactionAmount;

        // ⚠️ Make sure you pass login user id properly
        $loginUser = session('admin_id'); // change if needed

        // 5️⃣ Insert into transaction table
        DB::table('account_wallet_transcation_master')->insert([
            'n_slno'              => $nextSlno,
            'n_transcation_no'    => $nextTransactionNo,
            'n_from_id'           => $loginUser,
            'n_to_id'             => -1,
            'n_accbalance_before' => $balanceBefore,
            'n_trans_amount'      => $transactionAmount,
            'n_accbalance_after'  => $balanceAfter,
            'd_transcation'       => now(),
            'c_trans_type'        => 'Expense Approval',
            'c_status'            => 'Y',
        ]);

        // 6️⃣ Update wallet balance
        DB::table('account_wallet_master')
            ->where('n_user_id', $expense->n_user_id)
            ->update([
                'n_amount' => $balanceAfter
            ]);

        // 7️⃣ Update expense request status
        DB::table('account_expence_request')
            ->where('n_slno', $id)
            ->update([
                'c_status'      => 'A',
                'd_approve_date'=> now()
            ]);

        return back()->with('success', 'Wallet deducted successfully');
    });
}


            



        
        public static function rejectRequest($id)
        {
            return DB::table('account_request_data')
                ->where('n_slno', $id)
                ->update(['c_superadmin_status' => 'rejected','d_super_reject' => now()]);

        }
   
        public static function rejectRequestExpence($id)
        {
            return DB::table('account_expence_request')
                ->where('n_slno', $id)
                ->update(['c_status' => 'R','d_reject_date' => now()]);

        }





        public static function approveRequestAdmin($id)
        {

        return DB::transaction(function () use ($id) {

        // 1️⃣ Get expense request
        $expense = DB::table('account_request_data')
            ->select('n_to_id', 'n_amount_inr')
            ->where('n_slno', $id)
            ->lockForUpdate()
            ->first();

        if (!$expense) {
            throw new \Exception('Expense request not found');
        }

        // 2️⃣ Get wallet details
        $wallet = DB::table('account_wallet_master')
            ->where('n_user_id', $expense->n_to_id)
            ->lockForUpdate()
            ->first();

        if (!$wallet) {
            throw new \Exception('Wallet not found');
        }

        $walletBalance = $wallet->n_amount;
        $transactionAmount = $expense->n_amount_inr;

      

        // 4️⃣ Generate new transaction values
        $nextSlno = (DB::table('account_wallet_transcation_master')->max('n_slno') ?? 0) + 1;
        $nextTransactionNo = (DB::table('account_wallet_transcation_master')->max('n_transcation_no') ?? 0) + 1;

        $balanceBefore = $walletBalance;
        $balanceAfter = $walletBalance + $transactionAmount;


        // 5️⃣ Insert into transaction table
        DB::table('account_wallet_transcation_master')->insert([
            'n_slno'              => $nextSlno,
            'n_transcation_no'    => $nextTransactionNo,
            'n_from_id'           => $expense->n_to_id,
            'n_to_id'             => -1,
            'n_accbalance_before' => $balanceBefore,
            'n_trans_amount'      => $transactionAmount,
            'n_accbalance_after'  => $balanceAfter,
            'd_transcation'       => now(),
            'c_trans_type'        => 'Activation Approval',
            'c_status'            => 'Y',
        ]);

        // 6️⃣ Update wallet balance
        DB::table('account_wallet_master')
            ->where('n_user_id', $expense->n_to_id)
            ->update([
                'n_amount' => $balanceAfter
            ]);

        // 7️⃣ Update expense request status
        DB::table('account_request_data')
            ->where('n_slno', $id)
            ->update([
                'c_admin_status'      => 'approved',
                'd_admin_approve'=> now()
            ]);

        return back()->with('success', 'Wallet deducted successfully');
    });
}



        
        public static function rejectRequestAdmin($id)
        {
            return DB::table('account_request_data')
                ->where('n_slno', $id)
                ->update(['c_admin_status' => 'rejected','d_admin_reject' => now()]);

        }



        public static function insertWalletRequestData($data)
        {
            return DB::table('account_wallet_request')->insert($data);
        }


        public static function getWalletRequestList($fromDate, $toDate)
        {

     


            return DB::table('account_wallet_request as a')
            ->join('account_employee_details as b', 'a.n_user_id', '=', 'b.n_slno')
            ->where('a.c_admin_status', 'PENDING')  
            ->where('a.c_superadmin_status', 'PENDING')  
           ->whereDate('a.d_date', '>=', $fromDate)
           ->whereDate('a.d_date', '<=', $toDate)
            ->select(
                'a.c_description',
                'a.n_amount',
                'a.d_date',
                'a.n_user_id',
                'a.n_slno',
                'b.C_FNAME' ,
                'a.c_superadmin_status' ,
                'a.c_admin_status',
                'a.n_assigned_id',
                'a.c_admin_reject_reason',
            )->get();
        }



        public static function getWalletApproveList($fromDate, $toDate)
        {

       
            return DB::table('account_wallet_request as a')
            ->join('account_employee_details as b', 'a.n_user_id', '=', 'b.n_slno')
            ->where('a.c_admin_status', 'APPROVED')  
            ->where('a.c_superadmin_status', 'APPROVED')  
           ->whereDate('a.d_admin_approve', '>=', $fromDate)
           ->whereDate('a.d_admin_approve', '<=', $toDate)
            ->select(
                'a.c_description',
                'a.n_amount',
                'a.d_date',
                'a.n_user_id',
                'a.n_slno',
                'b.C_FNAME' ,
                'a.c_superadmin_status' ,
                'a.c_admin_status',
                'a.n_assigned_id',
                'a.c_admin_reject_reason',
            )->get();
        }
        public static function getWalletApproveListSuper($fromDate, $toDate)
        {

       
            return DB::table('account_wallet_request as a')
            ->join('account_employee_details as b', 'a.n_user_id', '=', 'b.n_slno')
            ->where('a.c_superadmin_status', 'APPROVED')  
           ->whereDate('a.d_approve_super', '>=', $fromDate)
           ->whereDate('a.d_approve_super', '<=', $toDate)
            ->select(
                'a.c_description',
                'a.n_amount',
                'a.d_date',
                'a.n_user_id',
                'a.n_slno',
                'b.C_FNAME' ,
                'a.c_superadmin_status' ,
                'a.c_admin_status',
                'a.n_assigned_id',
                'a.c_admin_reject_reason',
            )->get();
        }

        public static function getWalletApproveListAdmin($fromDate, $toDate)
        {

       
            return DB::table('account_wallet_request as a')
            ->join('account_employee_details as b', 'a.n_user_id', '=', 'b.n_slno')
            ->where('a.c_admin_status', 'APPROVED')  
           ->whereDate('a.d_admin_approve', '>=', $fromDate)
           ->whereDate('a.d_admin_approve', '<=', $toDate)
            ->select(
                'a.c_description',
                'a.n_amount',
                'a.d_date',
                'a.n_user_id',
                'a.n_slno',
                'b.C_FNAME' ,
                'a.c_superadmin_status' ,
                'a.c_admin_status',
                'a.n_assigned_id',
                'a.c_admin_reject_reason',
            )->get();
        }



        public static function getWalletRejectList($fromDate, $toDate)
        {

       
            return DB::table('account_wallet_request as a')
            ->join('account_employee_details as b', 'a.n_user_id', '=', 'b.n_slno')
             ->where(function($query) {
                $query->where('a.c_superadmin_status', 'REJECTED')
                ->orWhere('a.c_admin_status', 'REJECTED');
            }) 
           ->whereDate('a.d_date', '>=', $fromDate)
           ->whereDate('a.d_date', '<=', $toDate)
            ->select(
                'a.c_description',
                'a.n_amount',
                'a.d_date',
                'a.n_user_id',
                'a.n_slno',
                'b.C_FNAME' ,
                'a.c_superadmin_status' ,
                'a.c_admin_status',
                'a.n_assigned_id',
                'a.c_admin_reject_reason',
                'a.c_superadmin_reject_reason',
            )->get();
        }
        public static function getWalletRejectListAdmin($fromDate, $toDate)
        {

       
            return DB::table('account_wallet_request as a')
            ->join('account_employee_details as b', 'a.n_user_id', '=', 'b.n_slno')
            ->where('a.c_admin_status', 'REJECTED')
          
           ->whereDate('a.d_admin_reject', '>=', $fromDate)
           ->whereDate('a.d_admin_reject', '<=', $toDate)
            ->select(
                'a.c_description',
                'a.n_amount',
                'a.d_date',
                'a.n_user_id',
                'a.n_slno',
                'b.C_FNAME' ,
                'a.c_superadmin_status' ,
                'a.c_admin_status',
                'a.n_assigned_id',
                'a.c_admin_reject_reason',
                'a.c_superadmin_reject_reason',
            )->get();
        }
        public static function getWalletRejectListSuper($fromDate, $toDate)
        {

       
            return DB::table('account_wallet_request as a')
            ->join('account_employee_details as b', 'a.n_user_id', '=', 'b.n_slno')
            ->where('a.c_superadmin_status', 'REJECTED')
           ->whereDate('a.d_reject_super', '>=', $fromDate)
           ->whereDate('a.d_reject_super', '<=', $toDate)
            ->select(
                'a.c_description',
                'a.n_amount',
                'a.d_date',
                'a.n_user_id',
                'a.n_slno',
                'b.C_FNAME' ,
                'a.c_superadmin_status' ,
                'a.c_admin_status',
                'a.n_assigned_id',
                'a.c_admin_reject_reason',
                'a.c_superadmin_reject_reason',
            )->get();
        }


        public static function getWalletListSuper($fromDate, $toDate)
        {

       
            return DB::table('account_wallet_request as a')
            ->join('account_employee_details as b', 'a.n_user_id', '=', 'b.n_slno')
            ->where('a.c_superadmin_status', 'PENDING')
           ->whereDate('a.d_date', '>=', $fromDate)
           ->whereDate('a.d_date', '<=', $toDate)
            ->select(
                'a.c_description',
                'a.n_amount',
                'a.d_date',
                'a.n_user_id',
                'a.n_slno',
                'b.C_FNAME' ,
                'a.c_superadmin_status' ,
                'a.c_admin_status',
                'a.n_assigned_id',
                'a.c_admin_reject_reason',
                'a.c_superadmin_reject_reason',
            )->get();
        }
        public static function getWalletListadmin($fromDate, $toDate)
        {

           $adminid=session('admin_id');

       
            return DB::table('account_wallet_request as a')
            ->join('account_employee_details as b', 'a.n_user_id', '=', 'b.n_slno')
            ->where('a.c_superadmin_status', 'APPROVED')
            ->where('a.c_superadmin_status', 'PENDING')
            ->where('a.n_assigned_id', $adminid)
           ->whereDate('a.d_approve_super', '>=', $fromDate)
           ->whereDate('a.d_approve_super', '<=', $toDate)
            ->select(
                'a.c_description',
                'a.n_amount',
                'a.d_date',
                'a.n_user_id',
                'a.n_slno',
                'b.C_FNAME' ,
                'a.c_superadmin_status' ,
                'a.c_admin_status',
                'a.n_assigned_id',
                'a.c_admin_reject_reason',
                'a.c_superadmin_reject_reason',
            )->get();
        }















}
