<?php
namespace App\Http\Controllers;
use App\Models\Transaction;
use App\Models\Banktransaction;
use App\Models\Deposit;
use App\Models\Account;
use App\Models\User;
use App\Models\Register;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;



class TransactionController extends Controller
{
    public function showDepositForm()
    {
        return view('deposit');
    }
   
   

    public function deposit(Request $request)
    {
        $user = auth()->user();
    
        $validatedData = Validator::make($request->all(), [
            'amount' => 'required',
        ]);
    
        if ($validatedData->fails()) {
            return redirect()->route('deposit.form')->withErrors($validatedData)->withInput();
        }
    
        $account = $user->account()->firstOrNew();
    
        $account->balance += $request->amount;
    
       
        return DB::transaction(function () use ($account, $request, $user) {
            if (!$account->save()) {
                return redirect()->route('home')->with('error', 'Failed to update account balance.');
            }
    
            $this->recordTransaction('deposit', $request->amount, $user->id);
    
            \Log::info('Updated account balance: ' . $account->balance);
    
            return redirect()->route('home')->with('success', 'Deposit successful.');

        });
    }
    
    private function recordTransaction($type, $amount, $userId)
    {
        $transaction = new Banktransaction();
        $transaction->user_id = $userId;
        $transaction->type = $type;
        $transaction->amount = $amount;
        $transaction->save();
    }
    

    public function showWithdrawForm()
    {
        return view('withdraw');
    }

    public function withdraw(Request $request)
    {
        $user = auth()->user();
    
        $validatedData = Validator::make($request->all(), [
            'amount' => 'required',
        ]);
    
        if ($validatedData->fails()) {
            return redirect()->route('withdraw.form')->withErrors($validatedData)->withInput();
        }
        $account=$user->account()->firstorNew();
        $account->balance-=$request->amount;
        return DB::transaction(function () use ($account, $request, $user) {
            if (!$account->save()) {
                return redirect()->route('home')->with('error', 'Failed to update account balance.');
            }
            $this->recordTransaction('withdraw',$request->amount,$user->id);
            \Log::info('Updated account balance: ' . $account->balance);
    
            return redirect()->route('home')->with('success', 'Deposit successful.');
        });
    }
    
     

    
    
    public function showTransferForm()
    {
        return view('transfer');
    }
  
public function transfer(Request $request)
{
    $user = auth()->user();

    $validatedData = Validator::make($request->all(), [
        'amount' => 'required',
        'email' => 'required|exists:users,email',
    ]);

    if ($validatedData->fails()) {
        return redirect()->route('transfer.form')->withErrors($validatedData)->withInput();
    }

    $recipient = User::where('email', $request->email)->first();

    $senderAccount = $user->account()->firstorNew();

    if (!$senderAccount) {
        return redirect()->route('home')->with('error', 'User does not have an associated account.');
    }

   
    if ($senderAccount->balance < $request->amount) {
        return redirect()->route('home')->with('error', 'Insufficient funds for the transfer.');
    }

    $senderAccount->balance -= $request->amount;

   
    return DB::transaction(function () use ($senderAccount, $request, $user, $recipient) {
        if (!$senderAccount->save()) {
            return redirect()->route('home')->with('error', 'Failed to update sender account balance.');
        }

        
        $recipientAccount = $recipient->account()->firstOrNew();
        $recipientAccount->balance += $request->amount;
        $recipientAccount->save();

      
        $this->recordTransaction('transfer_out', $request->amount, $user->id);
        $this->recordTransaction('transfer_in', $request->amount, $recipient->id);

        \Log::info('Updated sender account balance: ' . $senderAccount->balance);

        return redirect()->route('home')->with('success', 'Transfer successful.');
    });
}

public function statement()
{
    $user = auth()->user();
    $transactions = Banktransaction::where('user_id', $user->id)
    ->orderBy('created_at', 'desc')
    ->get();

return view('statement', ['transactions' => $transactions]);
}




}




