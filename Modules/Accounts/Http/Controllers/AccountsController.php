<?php

namespace Modules\Accounts\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Accounts\Models\Account;
use Illuminate\Support\Facades\DB;

class AccountsController extends Controller
{
    public function request_form()
    {

        $accounts = Account :: getActiveAcounts(); 
        
        return view('accounts::request_form', compact('accounts'));
    }
    public function expence_form()
    {

        // $accounts = Account :: insertRequest(); 
        
        return view('accounts::expence_form');
    }


       public function request_list(Request $request)
    {

        $fromDate = $request->from_date ?? date('Y-m-d');
        $toDate   = $request->to_date ?? date('Y-m-d');

        $db = Account::getRequestList($fromDate, $toDate);
        
        return view('accounts::request_list', compact('db'));
    }



       public function request_list_sub(Request $request)
    {

        $fromDate = $request->from_date ?? date('Y-m-d');
        $toDate   = $request->to_date ?? date('Y-m-d');

        $db = Account::getRequestListSub($fromDate, $toDate);
        
        return view('accounts::request_list_sub', compact('db'));
    }

       public function request_list_user(Request $request)
    {

        $fromDate = $request->from_date ?? date('Y-m-d');
        $toDate   = $request->to_date ?? date('Y-m-d');

        $db = Account::getRequestListUser($fromDate, $toDate);
        
        return view('accounts::request_list_user', compact('db'));
    }


       public function approve_list(Request $request)
    {

        $fromDate = $request->from_date ?? date('Y-m-d');
        $toDate   = $request->to_date ?? date('Y-m-d');

        $db = Account::getApproveList($fromDate, $toDate);
        
        return view('accounts::approve_list', compact('db'));
    }

    public function approve_list_sub(Request $request)
    {

        $fromDate = $request->from_date ?? date('Y-m-d');
        $toDate   = $request->to_date ?? date('Y-m-d');

        $db = Account::getApproveList($fromDate, $toDate);
        
        return view('accounts::approve_list_sub', compact('db'));
    }

    public function approve_list_user(Request $request)
    {

        $fromDate = $request->from_date ?? date('Y-m-d');
        $toDate   = $request->to_date ?? date('Y-m-d');

        $db = Account::getApproveList($fromDate, $toDate);
        
        return view('accounts::approve_list_user', compact('db'));
    }


    public function reject_list(Request $request)
    {

        $fromDate = $request->from_date ?? date('Y-m-d');
        $toDate   = $request->to_date ?? date('Y-m-d');

        $db = Account::getRejectList($fromDate, $toDate);
        
        return view('accounts::reject_list', compact('db'));
    }
    public function reject_list_sub(Request $request)
    {

        $fromDate = $request->from_date ?? date('Y-m-d');
        $toDate   = $request->to_date ?? date('Y-m-d');

        $db = Account::getRejectListAdmin($fromDate, $toDate);
       return view('accounts::reject_list_sub', compact('db'));
    }     
    
    public function reject_list_user(Request $request)
    {

        $fromDate = $request->from_date ?? date('Y-m-d');
        $toDate   = $request->to_date ?? date('Y-m-d');

        $db = Account::getRejectListUser($fromDate, $toDate);
       return view('accounts::reject_list_user', compact('db'));
    }     
    





















    public function save_request(Request $request)
    {
        // Validate the request data
        $request->validate([
            'userid' => 'required',
            'to_id' => 'required',
            'usdt' => 'required|numeric',
            'amount_inr' => 'required|numeric',
            
        ]);

       $admin_id = session('admin_id');



        // Save the request to the database (you can create a model for this)
        $savedata = [
            'c_active_user' => $request->input('userid'),
            'n_from_id' => $request->input('to_id'),
            'n_to_id' => $admin_id,
            'n_usdt' => $request->input('usdt'),
            'n_amount_inr' => $request->input('amount_inr'),
            'c_superadmin_status' => 'pending',
            'd_date' => now(),
            'd_request_date' => $request->input('date') ?? now(),        ];

        $db= Account :: insertrequestdata($savedata);
        if($db){
            return redirect()->back()->with('success', 'Request submitted successfully!');
        }else{
            return redirect()->back()->with('error', 'Failed to submit the request. Please try again.');
        }


    }
    public function save_expence_request(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:5',
            'amount' => 'required|numeric|min:1',
             'date' => 'required|date'
        ]);


       $admin_id = session('admin_id');



        // Save the request to the database (you can create a model for this)
        $savedata = [
            'n_user_id' => $admin_id,
            'c_tittle' => $request->input('title'),
            'c_description' => $request->input('description'),  
            'n_amount' => $request->input('amount'),
            'c_status' => 'P',
            'd_date' => now(),
            'd_expence' => $request->input('date'),
        ];

        $db= Account :: insertExpenceRequestData($savedata);
        if($db){
            return redirect()->back()->with('success', 'Request submitted successfully!');
        }else{
            return redirect()->back()->with('error', 'Failed to submit the request. Please try again.');
        }


    }




 
    public function expence_list(Request $request)
    {

        $fromDate = $request->from_date ?? date('Y-m-d');
        $toDate   = $request->to_date ?? date('Y-m-d');

        $db = Account::getExpenceList($fromDate, $toDate);
        
        return view('accounts::expence_list', compact('db'));
    }





    public function approve_request($id)
    {
     
        Account::approveRequest($id);
        return redirect()->back()->with('success', 'Request approved successfully!');
    }


    public function reject_request($id)
    {
     
        Account::rejectRequest($id);
        return redirect()->back()->with('success', 'Request rejected successfully!');
    }

    


    public function approve_request_admin($id)
    {
    
        Account::approveRequestAdmin($id);
        return redirect()->back()->with('success', 'Request approved successfully!');
    }



    public function reject_request_admin($id)
    {
    
        Account::rejectRequestAdmin($id);
        return redirect()->back()->with('success', 'Request rejected successfully!');
    }





    public function approve_request_expence($id)
    {
     
        Account::approveRequestExpence($id);
        return redirect()->back()->with('success', 'Request approved successfully!');
    }


    public function reject_request_expence($id)
    {
     
        Account::rejectRequestExpence($id);
        return redirect()->back()->with('success', 'Request rejected successfully!');
    }




     public function wallet_request_form()
    {

        return view('accounts::wallet_request_form');
    }



    public function save_wallet_request(Request $request)
    {
        // Validate the request data
        $request->validate([
            'request_reason' => 'required|string|min:10|max:255',
            'requested_amount' => 'required|numeric|min:1',
        ]);

       $admin_id = session('admin_id');

        // Save the request to the database (you can create a model for this)
        $savedata = [
            'n_user_id' => $admin_id,
            'c_description' => $request->input('request_reason'),
            'n_amount' => $request->input('requested_amount'),
            'c_status' => 'PENDING',
            'd_date' => now(),
        ];

        $db= Account :: insertWalletRequestData($savedata);
        if($db){
            return redirect()->back()->with('success', 'Wallet request submitted successfully!');
        }else{
            return redirect()->back()->with('error', 'Failed to submit the wallet request. Please try again.');
        }
    }




    public function wallet_request_list(Request $request)
    {

        $fromDate = $request->from_date ?? date('Y-m-d');
        $toDate   = $request->to_date ?? date('Y-m-d');

        $db = Account::getWalletRequestList($fromDate, $toDate);
        
        return view('accounts::wallet_request_list', compact('db'));
    }
   
  

 public function approve_wallet_request(Request $request, $id)
{
    $assignedAdminId = $request->assigned_admin_id;

    DB::table('account_wallet_request')
        ->where('n_slno', $id)
        ->update([
            'c_superadmin_status' => 'APPROVED',
            'n_assigned_id' => $assignedAdminId,
            'd_approve_super' => now()
        ]);

    return response()->json(['success' => true]);
}



    public function reject_wallet_request(Request $request, $id)
    {
         $reason = $request->reason;
        DB::table('account_wallet_request')
            ->where('n_slno', $id)
            ->update([
                'c_superadmin_status' => 'REJECTED',
                'c_superadmin_reject_reason'=>$reason,
                'd_reject_super' => now()
            ]);
    
return back()->with('error', 'Wallet request rejected successfully');
    }




  
     public static function approve_wallet_request_admin($id)
{
     try {
    return DB::transaction(function () use ($id) {

        // 1️⃣ Get wallet request
        $request = DB::table('account_wallet_request')
            ->select('n_assigned_id', 'n_user_id', 'n_amount')
            ->where('n_slno', $id)
            ->lockForUpdate()
            ->first();

        if (!$request) {
            throw new \Exception('Wallet request not found');
        }

        $amount = $request->n_amount;

        /*
        |--------------------------------------------------------------------------
        | 2️⃣ DEDUCT FROM ASSIGNED USER
        |--------------------------------------------------------------------------
        */

        $fromWallet = DB::table('account_wallet_master')
            ->where('n_user_id', $request->n_assigned_id)
            ->lockForUpdate()
            ->first();

        if (!$fromWallet) {
            throw new \Exception('Assigned user wallet not found');
        }

        if ($fromWallet->n_amount < $amount) {
            throw new \Exception('Insufficient balance');
        }

        $fromBefore = $fromWallet->n_amount;
        $fromAfter  = $fromBefore - $amount;

        $transNo = (DB::table('account_wallet_transcation_master')
                    ->max('n_transcation_no') ?? 0) + 1;

        DB::table('account_wallet_transcation_master')->insert([
            'n_slno'               => $transNo,
            'n_transcation_no'    => $transNo,
            'n_from_id'           => $request->n_assigned_id,
            'n_to_id'             => $request->n_user_id,
            'n_accbalance_before' => $fromBefore,
            'n_trans_amount'      => $amount,
            'n_accbalance_after'  => $fromAfter,
            'd_transcation'       => now(),
            'c_trans_type'        => 'Wallet Debit',
            'c_status'            => 'Y',
        ]);

        DB::table('account_wallet_master')
            ->where('n_user_id', $request->n_assigned_id)
            ->update([
                'n_amount' => $fromAfter
            ]);

        /*
        |--------------------------------------------------------------------------
        | 3️⃣ CREDIT TO REQUESTED USER
        |--------------------------------------------------------------------------
        */

        $toWallet = DB::table('account_wallet_master')
            ->where('n_user_id', $request->n_user_id)
            ->lockForUpdate()
            ->first();

        if (!$toWallet) {
            throw new \Exception('User wallet not found');
        }

        $toBefore = $toWallet->n_amount;
        $toAfter  = $toBefore + $amount;

        $transNo++;

        DB::table('account_wallet_transcation_master')->insert([
            'n_slno'              => $transNo,
            'n_transcation_no'    => $transNo,
            'n_from_id'           => $request->n_assigned_id,
            'n_to_id'             => $request->n_user_id,
            'n_accbalance_before' => $toBefore,
            'n_trans_amount'      => $amount,
            'n_accbalance_after'  => $toAfter,
            'd_transcation'       => now(),
            'c_trans_type'        => 'Wallet Credit',
            'c_status'            => 'Y',
        ]);

        DB::table('account_wallet_master')
            ->where('n_user_id', $request->n_user_id)
            ->update([
                'n_amount' => $toAfter
            ]);

        /*
        |--------------------------------------------------------------------------
        | 4️⃣ UPDATE REQUEST STATUS
        |--------------------------------------------------------------------------
        */

        DB::table('account_wallet_request')
            ->where('n_slno', $id)
            ->update([
                'c_admin_status' => 'APPROVED',
                'd_admin_approve'=> now()
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Wallet transferred successfully'
        ]);
    });

    } catch (\Exception $e) {

        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ], 400);
    }
}



public function reject_wallet_request_admin(Request $request, $id)
{
    $reason = $request->reason;

    DB::table('account_wallet_request')
        ->where('n_slno', $id)
        ->update([
            'c_admin_status' => 'REJECTED',
            'c_admin_reject_reason' => $reason,
            'd_admin_reject' => now()
        ]);

    return back()->with('error', 'Wallet request rejected successfully');
}





 public function wallet_approve_list(Request $request)
{

    $fromDate = $request->from_date ?? date('Y-m-d');
    $toDate   = $request->to_date ?? date('Y-m-d');

    $db = Account::getWalletApproveList($fromDate, $toDate);
    
    return view('accounts::wallet_approve_list', compact('db'));
}
 public function wallet_approve_list_admin(Request $request)
{

    $fromDate = $request->from_date ?? date('Y-m-d');
    $toDate   = $request->to_date ?? date('Y-m-d');

    $db = Account::getWalletApproveListAdmin($fromDate, $toDate);
    
    return view('accounts::wallet_approve_list_admin', compact('db'));
}
 public function wallet_approve_list_super(Request $request)
{

    $fromDate = $request->from_date ?? date('Y-m-d');
    $toDate   = $request->to_date ?? date('Y-m-d');

    $db = Account::getWalletApproveListSuper($fromDate, $toDate);
    
    return view('accounts::wallet_approve_list_super', compact('db'));
}



 public function wallet_reject_list(Request $request)
{

    $fromDate = $request->from_date ?? date('Y-m-d');
    $toDate   = $request->to_date ?? date('Y-m-d');

    $db = Account::getWalletRejectList($fromDate, $toDate);
    
    return view('accounts::wallet_reject_list', compact('db'));
}

 public function wallet_reject_list_admin(Request $request)
{

    $fromDate = $request->from_date ?? date('Y-m-d');
    $toDate   = $request->to_date ?? date('Y-m-d');

    $db = Account::getWalletRejectListAdmin($fromDate, $toDate);
    
    return view('accounts::wallet_reject_list_admin', compact('db'));
}
 public function wallet_reject_list_super(Request $request)
{

    $fromDate = $request->from_date ?? date('Y-m-d');
    $toDate   = $request->to_date ?? date('Y-m-d');

    $db = Account::getWalletRejectListSuper($fromDate, $toDate);
    
    return view('accounts::wallet_reject_list_super', compact('db'));
}



 public function wallet_request_list_super(Request $request)
{

    $fromDate = $request->from_date ?? date('Y-m-d');
    $toDate   = $request->to_date ?? date('Y-m-d');

    $db = Account::getWalletListSuper($fromDate, $toDate);

    $loginId = session('admin_id');

    $admins = DB::table('account_employee_details')
                ->where('c_status', 'Y')
                ->get();
    
    return view('accounts::wallet_request_list_super', compact('db','admins'));
}


 public function wallet_request_list_admin(Request $request)
{

    $fromDate = $request->from_date ?? date('Y-m-d');
    $toDate   = $request->to_date ?? date('Y-m-d');

    $db = Account::getWalletListadmin($fromDate, $toDate);
    
    return view('accounts::wallet_request_list_admin', compact('db'));
}















}
