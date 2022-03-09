<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use View;
use DateTime;
use Session;
use App\Models\User;
use App\Models\Leave;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userType = Auth::User()->user_type;

        if($userType === 'employee') {
            return view('home');
        } else {
            $leaves = Leave::select('leaves.*', 'users.name')
                    ->leftJoin('users', function($join) {
                      $join->on('users.id', '=', 'leaves.user_id');
                    })->get();

            return view('approve-leaves')->with('leaves', $leaves);
        }
    }

    public function applyLeave()
    {
        return view('apply');
    }

    public function leaveBalance() {

        $leaves = json_decode(Auth::User()->leave_balance, true);

        $leaveBalance = [
            'cl' => $leaves['cl'] ?? 0,
            'pl' => $leaves['pl'] ?? 0,
            'sl' => $leaves['sl'] ?? 0
        ];

        return View::make('leave-balance')->with('leave_balance', $leaveBalance);
    }

    public function leaves() {
        $id = Auth::user()->id;
        $leaves = Leave::where('user_id', $id)->get();
        return view('leaves')->with('leaves', $leaves);
    }

    public function save(Request $request) {

        //Calculating days between dates using php
        $fdate = $request->from_date;
        $tdate = $request->to_date;
        $datetime1 = new DateTime($fdate);
        $datetime2 = new DateTime($tdate);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');

        //Leave days calculation
        if($days == 0 && $request->from_leave_value == 2 && $request->to_leave_value == 2) {
            $leave = 0.5;
        } else if($request->from_leave_value == 2 && $request->to_leave_value == 2) {
            $leave = $days + 1;
        } else if(($request->from_leave_value == 2 &&  $request->to_leave_value == 1) 
            || ($request->from_leave_value == 1 &&  $request->to_leave_value == 2)) {
            $leave = $days + 0.5;
        } else {
            $leave = $days + 1;
        }

        $leaves = json_decode(Auth::User()->leave_balance, true);

        if(! $leaves) {
            Session::flash('message', 'OMG!. Leave balance not found!.'); 
            return redirect('/apply-leave'); 
        }

        //Checking exiting leave balance
        if( ($request->type == 1 && $leaves['cl'] < $leave) ||
            ($request->type == 2 && $leaves['sl'] < $leave) ||
            ($request->type == 3 && $leaves['pl'] < $leave)) {
            Session::flash('message', 'OMG!. You doesn`t have enough balance leave!.'); 
            return redirect('/apply-leave'); 
        }

        //Insert leave data
        $applyLeave = new Leave;
        $applyLeave->user_id = Auth::User()->id;
        $applyLeave->type = $request->type;
        $applyLeave->from_date = $request->from_date;
        $applyLeave->to_date = $request->to_date;
        $applyLeave->remarks = $request->remarks;
        $applyLeave->leaves = $leave;
        $applyLeave->save();

        //Updating leave balance in user profile
        $id = Auth::user()->id;
        $user = User::find($id);
        if($request->type == 1 ) {
            $leaves['cl'] = ($leaves['cl'] - (int) $leave);
        } else if($request->type == 2) {
            $leaves['sl'] = ($leaves['sl'] - (int) $leave);
        } else if($request->type == 3) {
            $leaves['pl'] = ($leaves['pl'] -  (int) $leave);
        }
        $user->leave_balance = json_encode($leaves);
        $user->save();

        return redirect('leaves');
    }

    public function approve($id) {

        $user_id = Auth::user()->id;
        $leave = Leave::where('id', $id)->first();

        if($leave) {
            $leave->approved_by = $user_id;
            $leave->status = 1;
            $leave->save();
        }
        return redirect('home');
    }

    public function decline(Request $request) {

        $user_id = Auth::user()->id;
        $id = $request->id;
        $leave = Leave::where('id', $id)->first();

        if($leave) {
            $leave->approved_by = $user_id;
            $leave->status = 2;
            $leave->reason = $request->reason;
            $leave->save();

            $user = User::find($leave->user_id);
            $leaves = json_decode($user->leave_balance, true);
            if($leave->type == 1 ) {
                $leaves['cl'] = ($leaves['cl'] + (int) $leave->leaves);
            } else if($leave->type == 2) {
                $leaves['sl'] = ($leaves['sl'] + (int) $leave->leaves);
            } else if($leave->type == 3) {
                $leaves['pl'] = ($leaves['pl'] +  (int) $leave->leaves);
            }
            $user->leave_balance = json_encode($leaves);
            $user->save();
        }


        return redirect('home');
    }
}