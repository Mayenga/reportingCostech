<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Todo;
use App\Models\Process;
use App\Models\Transfer;
use Illuminate\Support\Facades\Mail;
use Auth;

class TodoController extends Controller
{
    public function index(){
        $id = auth()->id();
        $carbon = \Carbon\Carbon::now();  
        $weekStartDate = $carbon->startOfWeek()->format('Y-m-d H:i');
        $weekEndDate = $carbon->endOfWeek()->format('Y-m-d H:i');
        $todos = DB::select("SELECT * FROM todos WHERE user_id = $id AND created_at BETWEEN '$weekStartDate' AND '$weekEndDate' UNION SELECT * FROM todos WHERE id IN(SELECT todo_id FROM transfers WHERE user_id = $id OR dpt_id IN(SELECT dpt_id FROM users WHERE id = $id AND id IN(SELECT user_id FROM role_user WHERE role_id = 3))) AND created_at BETWEEN '$weekStartDate' AND '$weekEndDate' ORDER BY created_at DESC");
        return view('todo.todolist')->with(['todos' => $todos,'week' => true]);
    }

    public function isOnline($site = "https://www.youtube.com/"){
        if(@fopen($site,"r")){
            return true;
        }else{
            return false;
        }
    }

    public function reporttodo(){
        // $id = auth()->id();
        // $carbon = \Carbon\Carbon::now();  
        // $weekStartDate = $carbon->startOfWeek()->format('Y-m-d H:i');
        // $weekEndDate = $carbon->endOfWeek()->format('Y-m-d H:i');
        // $todos = DB::select("SELECT * FROM todos WHERE user_id = $id AND created_at BETWEEN '$weekStartDate' AND '$weekEndDate' UNION SELECT * FROM todos WHERE id IN(SELECT todo_id FROM transfers WHERE user_id = $id) AND created_at BETWEEN '$weekStartDate' AND '$weekEndDate'");
        $todos = [];
        return view('todo.reports.reporttodo')->with(['todos' => $todos,'week' => true]);
    }

    public function reporttododg(){
        // $id = auth()->id();
        // $uidd = '';
        // $dpt = '';
        // $dp = DB::select("SELECT * FROM departments limit 1");
        // foreach($dp As $ddp){
        //     $dpt = $ddp->id;
        // }
        // $uid = DB::select("SELECT * FROM users WHERE dpt_id = $dpt AND id IN(SELECT user_id FROM role_user WHERE role_id = 3)");
        // foreach($uid As $ID){
        //     $uidd = $ID->id;
        // }
        // $carbon = \Carbon\Carbon::now();  
        // $weekStartDate = $carbon->startOfWeek()->format('Y-m-d H:i');
        // $weekEndDate = $carbon->endOfWeek()->format('Y-m-d H:i');
        // $todos = DB::select("SELECT * FROM todos WHERE user_id = $uidd AND created_at BETWEEN '$weekStartDate' AND '$weekEndDate' UNION SELECT * FROM todos WHERE id IN(SELECT todo_id FROM transfers WHERE user_id = $uidd) AND created_at BETWEEN '$weekStartDate' AND '$weekEndDate'");
        $todos = [];
        return view('todo.reports.reportsDG')->with(['todos' => $todos,'week' => true]);
    }

    public function reporttododr(){
        // $id = auth()->id();
        // $uidd = '';
        // $dpt = '';
        // $dp = DB::select("SELECT * FROM departments limit 1");
        // foreach($dp As $ddp){
        //     $dpt = $ddp->id;
        // }
        // $uid = DB::select("SELECT * FROM users WHERE dpt_id = $dpt AND id IN(SELECT user_id FROM role_user WHERE role_id = 3)");
        // foreach($uid As $ID){
        //     $uidd = $ID->id;
        // }
        // $carbon = \Carbon\Carbon::now();  
        // $weekStartDate = $carbon->startOfWeek()->format('Y-m-d H:i');
        // $weekEndDate = $carbon->endOfWeek()->format('Y-m-d H:i');
        // $todos = DB::select("SELECT * FROM todos WHERE user_id = $uidd AND created_at BETWEEN '$weekStartDate' AND '$weekEndDate' UNION SELECT * FROM todos WHERE id IN(SELECT todo_id FROM transfers WHERE user_id = $uidd) AND created_at BETWEEN '$weekStartDate' AND '$weekEndDate'");
        $todos = [];
        return view('todo.reports.reportsDR')->with(['todos' => $todos,'week' => true]);
    }

    public function getTodosWeek(){
        $id = auth()->id();
        $carbon = \Carbon\Carbon::now();  
        $weekStartDate = $carbon->startOfWeek()->format('Y-m-d H:i');
        $weekEndDate = $carbon->endOfWeek()->format('Y-m-d H:i');
        $todos = DB::select("SELECT * FROM todos WHERE user_id = $id AND created_at BETWEEN '$weekStartDate' AND '$weekEndDate' UNION SELECT * FROM todos WHERE id IN(SELECT todo_id FROM transfers WHERE user_id = $id) AND created_at BETWEEN '$weekStartDate' AND '$weekEndDate'");
        return view('todo.todolist')->with(['todos' => $todos,'week' => true]);
    }

    public function getTodosAll(){
        $id = auth()->id();
        // $todos = Todo::where('user_id',$id)->orderBy('complited')->get();
        $todos = DB::select("SELECT * FROM todos WHERE user_id = $id UNION SELECT * FROM todos WHERE id IN(SELECT todo_id FROM transfers WHERE user_id = $id)");
        return view('todo.todolist')->with(['todos' => $todos,'week' => false]);
    }

    public function create(){
        return view('todo.newtodo');
    } 

    public function report(Request $request){
        $id = auth()->id();
        $carbon = \Carbon\Carbon::now();  
        $weekStartDate = $carbon->startOfWeek()->format('Y-m-d H:i');
        $weekEndDate = $carbon->endOfWeek()->format('Y-m-d H:i');
        $category = $request->category; 
        $datefrom = $request->datefrom; 
        $dateto = $request->dateto;
        $dpt = $request->dpt;
        $user = $request->user;
        $todos = [];

        if($datefrom != '' && $dateto != ''){
            if($datefrom > $dateto){
                return view('todo.reports.reporttodo')->with(['todos' => $todos]);
            }
        }

        if($datefrom == ''){
            $datefrom = $weekStartDate;
        }else{
            if($datefrom > now()){
                return view('todo.reports.reporttodo')->with(['todos' => $todos]);
            }
        }
        if($dateto == ''){
            $dateto = $weekEndDate;
        }else{
            if($dateto > now()){
                return view('todo.reports.reporttodo')->with(['todos' => $todos]);
            }
        }

        if($category == 1){
            if(Auth::user()->hasRole('dg')){
                if($dpt == 0){
                    $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$datefrom' AND '$dateto' AND user_id = $id UNION SELECT * FROM todos WHERE id IN(SELECT todo_id FROM transfers WHERE user_id = $id)");
                    return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                }elseif($dpt == -1){
                    $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$datefrom' AND '$dateto' AND user_id IN(SELECT id FROM users WHERE dpt_id IN(SELECT id FROM departments) AND id IN(SELECT user_id FROM role_user WHERE role_id = 3)) UNION SELECT * FROM todos WHERE id IN(SELECT todo_id FROM transfers WHERE user_id != $id OR user_id = $id)");
                    return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                }elseif($dpt != -1 && $dpt != 0){
                    $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$datefrom' AND '$dateto' AND user_id IN(SELECT id FROM users WHERE dpt_id IN(SELECT id FROM departments WHERE id = $dpt) AND id IN(SELECT user_id FROM role_user WHERE role_id = 3)) UNION SELECT * FROM todos WHERE id IN(SELECT todo_id FROM transfers WHERE dpt_id = $dpt)");
                    return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                }
            }
            if(Auth::user()->hasRole('director')){
                if($user == 0){
                    $todos = DB::select("SELECT * FROM todos WHERE user_id = $id AND created_at BETWEEN '$weekStartDate' AND '$weekEndDate' UNION SELECT * FROM todos WHERE id IN(SELECT todo_id FROM transfers WHERE dpt_id IN(SELECT dpt_id FROM users WHERE id = $id AND id IN(SELECT user_id FROM role_user WHERE role_id = 3)))");
                    return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                }elseif($user != 0){
                    $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$datefrom' AND '$dateto' AND user_id = $user UNION SELECT * FROM todos WHERE id IN(SELECT todo_id FROM transfers WHERE user_id = $user)");
                    return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                }
            }
            if(Auth::user()->hasRole('user')){
                $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$datefrom' AND '$dateto' AND user_id = $id UNION SELECT * FROM todos WHERE id IN(SELECT todo_id FROM transfers WHERE user_id = $id)");
                return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                // if($dpt == 0){
                //     $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$datefrom' AND '$dateto' AND user_id = $id UNION SELECT * FROM todos WHERE id IN(SELECT todo_id FROM transfers WHERE user_id = $id)");
                //     return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                // }elseif($dpt == -1){
                //     $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$datefrom' AND '$dateto' AND user_id IN(SELECT id FROM users WHERE dpt_id IN(SELECT id FROM departments) AND id IN(SELECT user_id FROM role_user WHERE role_id = 3)) UNION SELECT * FROM todos WHERE id IN(SELECT todo_id FROM transfers WHERE user_id != $id OR user_id = $id)");
                //     return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                // }elseif($dpt != -1 && $dpt != 0){
                //     $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$datefrom' AND '$dateto' AND user_id IN(SELECT id FROM users WHERE dpt_id IN(SELECT id FROM departments WHERE id = $dpt) AND id IN(SELECT user_id FROM role_user WHERE role_id = 3)) UNION SELECT * FROM todos WHERE id IN(SELECT todo_id FROM transfers WHERE dpt_id = $dpt)");
                //     return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                // }
            }
        }elseif($category == 2){
            if(Auth::user()->hasRole('dg')){
                if($dpt == 0){
                    $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$datefrom' AND '$dateto' AND user_id = $id AND complited = 1 UNION SELECT * FROM todos WHERE complited = 1 AND id IN(SELECT todo_id FROM transfers WHERE user_id = $id OR dpt_id = $dpt)");
                    return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                }elseif($dpt == -1){
                    $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$datefrom' AND '$dateto' AND complited = 1 AND user_id IN(SELECT id FROM users WHERE dpt_id IN(SELECT id FROM departments) AND id IN(SELECT user_id FROM role_user WHERE role_id = 3)) UNION SELECT * FROM todos WHERE complited = 1 AND id IN(SELECT todo_id FROM transfers WHERE dpt_id = $dpt OR user_id = $id)");
                    return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                }elseif($dpt != -1 && $dpt != 0){
                    $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$datefrom' AND '$dateto' AND complited = 1 AND user_id IN(SELECT id FROM users WHERE dpt_id IN(SELECT id FROM departments WHERE id = $dpt) AND id IN(SELECT user_id FROM role_user WHERE role_id = 3)) UNION SELECT * FROM todos WHERE complited = 1 AND id IN(SELECT todo_id FROM transfers WHERE dpt_id = $dpt AND user_id = $id)");
                    return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                }
            }
            if(Auth::user()->hasRole('director')){
                if($user == 0){
                    $todos = DB::select("SELECT * FROM todos WHERE complited = 1 AND user_id = $id AND created_at BETWEEN '$weekStartDate' AND '$weekEndDate' UNION SELECT * FROM todos WHERE complited = 1 AND id IN(SELECT todo_id FROM transfers WHERE dpt_id IN(SELECT dpt_id FROM users WHERE id = $id AND id IN(SELECT user_id FROM role_user WHERE role_id = 3)))");
                    return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                }elseif($user != 0){
                    $todos = DB::select("SELECT * FROM todos WHERE complited = 1 AND created_at BETWEEN '$datefrom' AND '$dateto' AND user_id = $user UNION SELECT * FROM todos WHERE complited = 1 AND id IN(SELECT todo_id FROM transfers WHERE user_id = $user)");
                    return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                }
            }
            if(Auth::user()->hasRole('user')){
                $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$datefrom' AND '$dateto' AND user_id = $id AND complited = 1 UNION SELECT * FROM todos WHERE complited = 1 AND id IN(SELECT todo_id FROM transfers WHERE user_id = $id)");
                return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                // if($dpt == 0){
                //     $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$datefrom' AND '$dateto' AND user_id = $id AND complited = 1 UNION SELECT * FROM todos WHERE complited = 1 AND id IN(SELECT todo_id FROM transfers WHERE user_id = $id)");
                //     return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                // }elseif($dpt == -1){
                //     $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$datefrom' AND '$dateto' AND complited = 1 AND user_id IN(SELECT id FROM users WHERE dpt_id IN(SELECT id FROM departments) AND id IN(SELECT user_id FROM role_user WHERE role_id = 3)) UNION SELECT * FROM todos WHERE complited = 1 AND id IN(SELECT todo_id FROM transfers WHERE dpt_id = $dpt OR user_id = $id)");
                //     return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                // }elseif($dpt != -1 && $dpt != 0){
                //     $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$datefrom' AND '$dateto' AND complited = 1 AND user_id IN(SELECT id FROM users WHERE dpt_id IN(SELECT id FROM departments WHERE id = $dpt) AND id IN(SELECT user_id FROM role_user WHERE role_id = 3)) UNION SELECT * FROM todos WHERE complited = 1 AND id IN(SELECT todo_id FROM transfers WHERE dpt_id = $dpt AND user_id = $id)");
                //     return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                // }
            }
        }elseif($category == 3){
            if(Auth::user()->hasRole('dg')){
                if($dpt == 0){
                    $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$datefrom' AND '$dateto' AND user_id = $id AND complited = 0 UNION SELECT * FROM todos WHERE complited = 0 AND id IN(SELECT todo_id FROM transfers WHERE user_id = $id)");
                    return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                }elseif($dpt == -1){
                    $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$datefrom' AND '$dateto' AND complited = 0 AND user_id IN(SELECT id FROM users WHERE dpt_id IN(SELECT id FROM departments) AND id IN(SELECT user_id FROM role_user WHERE role_id = 3)) UNION SELECT * FROM todos WHERE complited = 0 AND id IN(SELECT todo_id FROM transfers WHERE dpt_id = $dpt OR user_id = $id)");
                    return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                }elseif($dpt != -1 && $dpt != 0){
                    $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$datefrom' AND '$dateto' AND complited = 0 AND user_id IN(SELECT id FROM users WHERE dpt_id IN(SELECT id FROM departments WHERE id = $dpt) AND id IN(SELECT user_id FROM role_user WHERE role_id = 3)) UNION SELECT * FROM todos WHERE complited = 0 AND id IN(SELECT todo_id FROM transfers WHERE dpt_id = $dpt AND user_id = $id)");
                    return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                }
            }
            if(Auth::user()->hasRole('director')){
                if($user == 0){
                    $todos = DB::select("SELECT * FROM todos WHERE complited = 0 AND user_id = $id AND created_at BETWEEN '$weekStartDate' AND '$weekEndDate' UNION SELECT * FROM todos WHERE complited = 0 AND id IN(SELECT todo_id FROM transfers WHERE dpt_id IN(SELECT dpt_id FROM users WHERE id = $id AND id IN(SELECT user_id FROM role_user WHERE role_id = 3)))");
                    return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                }elseif($user != 0){
                    $todos = DB::select("SELECT * FROM todos WHERE complited = 0 AND created_at BETWEEN '$datefrom' AND '$dateto' AND user_id = $user UNION SELECT * FROM todos WHERE complited = 0 AND id IN(SELECT todo_id FROM transfers WHERE user_id = $user)");
                    return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                }
            }
            if(Auth::user()->hasRole('user')){
                $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$datefrom' AND '$dateto' AND user_id = $id AND complited = 0 UNION SELECT * FROM todos WHERE complited = 0 AND id IN(SELECT todo_id FROM transfers WHERE user_id = $id)");
                return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                // if($dpt == 0){
                //     $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$datefrom' AND '$dateto' AND user_id = $id AND complited = 0 UNION SELECT * FROM todos WHERE complited = 0 AND id IN(SELECT todo_id FROM transfers WHERE user_id = $id)");
                //     return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                // }elseif($dpt == -1){
                //     $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$datefrom' AND '$dateto' AND complited = 0 AND user_id IN(SELECT id FROM users WHERE dpt_id IN(SELECT id FROM departments) AND id IN(SELECT user_id FROM role_user WHERE role_id = 3)) UNION SELECT * FROM todos WHERE complited = 0 AND id IN(SELECT todo_id FROM transfers WHERE dpt_id = $dpt OR user_id = $id)");
                //     return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                // }elseif($dpt != -1 && $dpt != 0){
                //     $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$datefrom' AND '$dateto' AND complited = 0 AND user_id IN(SELECT id FROM users WHERE dpt_id IN(SELECT id FROM departments WHERE id = $dpt) AND id IN(SELECT user_id FROM role_user WHERE role_id = 3)) UNION SELECT * FROM todos WHERE complited = 0 AND id IN(SELECT todo_id FROM transfers WHERE dpt_id = $dpt AND user_id = $id)");
                //     return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                // }
            }
        }elseif($category == 4){
            if(Auth::user()->hasRole('dg')){
                if($dpt == 0){
                    $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$datefrom' AND '$dateto' AND user_id = $id AND id IN(SELECT todo_id FROM transfers WHERE user_id = $id)");
                    return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                }elseif($dpt == -1){
                    $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$datefrom' AND '$dateto' AND id IN(SELECT todo_id FROM transfers)");
                    return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                }elseif($dpt != -1 && $dpt != 0){
                    $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$datefrom' AND '$dateto' AND id IN(SELECT todo_id FROM transfers WHERE dpt_id = $dpt)");
                    return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                }
            }
            if(Auth::user()->hasRole('director')){
                if($user == 0){
                    $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$datefrom' AND '$dateto' AND id IN(SELECT todo_id FROM transfers WHERE dpt_id IN(SELECT dpt_id FROM users WHERE id = $id AND id IN(SELECT user_id FROM role_user WHERE role_id = 3)))");
                    return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                }elseif($user != 0){
                    $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$datefrom' AND '$dateto' AND id IN(SELECT todo_id FROM transfers WHERE user_id = $user)");
                    return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                }
            }
            if(Auth::user()->hasRole('user')){
                $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$datefrom' AND '$dateto' AND id IN(SELECT todo_id FROM transfers WHERE user_id = $id)");
                return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                // if($dpt == 0){
                //     $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$datefrom' AND '$dateto' AND user_id = $id AND id IN(SELECT todo_id FROM transfers WHERE user_id = $id)");
                //     return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                // }elseif($dpt == -1){
                //     $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$datefrom' AND '$dateto' AND id IN(SELECT todo_id FROM transfers)");
                //     return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                // }elseif($dpt != -1 && $dpt != 0){
                //     $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$datefrom' AND '$dateto' AND id IN(SELECT todo_id FROM transfers WHERE dpt_id = $dpt)");
                //     return view('todo.reports.reporttodo')->with(['todos' => $todos]);
                // }
            }
        }
    }

    public function reportdg(Request $request){
        $id = auth()->id();
        $uidd = '';
        $todayweek =date("W");
        $carbon = \Carbon\Carbon::now();  
        $weekStartDate = $carbon->startOfWeek()->format('Y-m-d H:i');
        $weekEndDate = $carbon->endOfWeek()->format('Y-m-d H:i');
        $dpt = $request->dpt; 
        $week = $request->week; 
        $todos = [];
        $week = substr($week,6);
        $d1 = $weekStartDate;
        $d2 = $weekEndDate;
        $dptName = DB::select("SELECT name FROM departments WHERE id = $dpt");
        if($week == ''){
            // $uid = DB::select("SELECT * FROM users WHERE dpt_id = $dpt AND id IN(SELECT user_id FROM role_user WHERE role_id = 3)");
            // foreach($uid As $ID){
            //     $uidd = $ID->id;
            // }
            // $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$d1' AND '$d2' AND user_id = $uidd UNION SELECT * FROM todos WHERE id IN(SELECT todo_id FROM transfers WHERE user_id = $uidd)");
            $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$d1' AND '$d2' AND user_id IN(SELECT id FROM users WHERE dpt_id IN(SELECT id FROM departments WHERE id = $dpt) AND id IN(SELECT user_id FROM role_user WHERE role_id = 3)) UNION SELECT * FROM todos WHERE id IN(SELECT todo_id FROM transfers WHERE dpt_id = $dpt)");
            return view('todo.reports.reportsDG')->with(['todos' => $todos,'dptName' => $dptName]);
        }else if($week > $todayweek){
            return view('todo.reports.reportsDG')->with(['todos' => $todos]);
        }else{
            $uid = DB::select("SELECT * FROM users WHERE dpt_id = $dpt AND id IN(SELECT user_id FROM role_user WHERE role_id = 3)");
            foreach($uid As $ID){
                $uid = $ID->id;
                $uname = $ID->name;
            }
            // date()
            $year = date('Y');
            $week_start = new \DateTime();
            $week_start->setISODate($year,$week);
            $d1 = $week_start->format('Y-m-d H:i');
            
            $d2 = $d1;
            $d2 = date( "Y-m-d H:i", strtotime( "$d2 +5 day" ) ); 

            $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$d1' AND '$d2' AND user_id IN(SELECT id FROM users WHERE dpt_id IN(SELECT id FROM departments WHERE id = $dpt) AND id IN(SELECT user_id FROM role_user WHERE role_id = 3)) UNION SELECT * FROM todos WHERE id IN(SELECT todo_id FROM transfers WHERE dpt_id = $dpt)");
            // $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$d1' AND '$d2' AND user_id = $uid UNION SELECT * FROM todos WHERE id IN(SELECT todo_id FROM transfers WHERE user_id = $id)");
            return view('todo.reports.reportsDG')->with(['todos' => $todos,'dptName' => $dptName]);
        }
    }

    public function reportdr(Request $request){
        $id = auth()->id();
        $uidd = '';
        $todayweek =date("W");
        $carbon = \Carbon\Carbon::now();  
        $weekStartDate = $carbon->startOfWeek()->format('Y-m-d H:i');
        $weekEndDate = $carbon->endOfWeek()->format('Y-m-d H:i');
        $user = $request->user; 
        $week = $request->week; 
        $todos = [];
        $week = substr($week,6);
        $d1 = $weekStartDate;
        $d2 = $weekEndDate;
        $userName = DB::select("SELECT name FROM users WHERE id = $user");
        if($week == ''){
            $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$d1' AND '$d2' AND user_id = $user UNION SELECT * FROM todos WHERE id IN(SELECT todo_id FROM transfers WHERE user_id = $user)");
            return view('todo.reports.reportsDR')->with(['todos' => $todos,'userName' => $userName]);
        }else if($week > $todayweek){
            return view('todo.reports.reportsDR')->with(['todos' => $todos]);
        }else{
            // $uid = DB::select("SELECT * FROM users WHERE dpt_id = $dpt AND id IN(SELECT user_id FROM role_user WHERE role_id = 3)");
            // foreach($uid As $ID){
            //     $uid = $ID->id;
            //     $uname = $ID->name;
            // }
            // date()
            $year = date('Y');
            $week_start = new \DateTime();
            $week_start->setISODate($year,$week);
            $d1 = $week_start->format('Y-m-d H:i');
            
            $d2 = $d1;
            $d2 = date( "Y-m-d H:i", strtotime( "$d2 +5 day" ) ); 

            // $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$d1' AND '$d2' AND user_id IN(SELECT id FROM users WHERE dpt_id IN(SELECT id FROM departments WHERE id = $dpt) AND id IN(SELECT user_id FROM role_user WHERE role_id = 3)) UNION SELECT * FROM todos WHERE id IN(SELECT todo_id FROM transfers WHERE dpt_id = $dpt)");
            $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$d1' AND '$d2' AND user_id = $user UNION SELECT * FROM todos WHERE id IN(SELECT todo_id FROM transfers WHERE user_id = $user)");
            
            // $todos = DB::select("SELECT * FROM todos WHERE created_at BETWEEN '$d1' AND '$d2' AND user_id = $uid UNION SELECT * FROM todos WHERE id IN(SELECT todo_id FROM transfers WHERE user_id = $id)");
            return view('todo.reports.reportsDR')->with(['todos' => $todos,'userName' => $userName]);
        }
    }

    public function upload(Request $request){
        $request->validate([
            'title' => 'required',
            'deadline' => 'required'
        ]);

        if($request->deadline < now()){
            return redirect()->back()->with('error', "Please select correct dates");
        }

        $transfer = $request->transfer;
        $transferUser = $request->transferUser;
        $title = $request->title;
        $output = $request->output;
        $deadline = $request->deadline;
        $transfered = false;
        $transferedWho = 0;
        $reason = "No reason";

        if($output == ""){
            $output = "No autput at the moment";
        }

        if($deadline == ''){
            $deadline = now();
        }

        // DG
        if($transfer != ''){
            $transfered = true;
            $transferedWho = 1;
        }

        // director
        if($transferUser != ''){
            $transfered = true;
            $transferedWho = 2;
        }

        $user_id = auth()->id();
        $now = now();
        $progress = 0;
        $todo = Todo::create(['title' => $title,'deadline' => $deadline,'output' => $output,'progress' => $progress,'completedtime' => $now,'transfered' => $transfered,'transferedWho' => $transferedWho,'user_id' => $user_id,'reason' => $reason]);
        
        if($transfer != ''){
            Transfer::create(['transferDate' => $now,'user_id' => $user_id,'todo_id' => $todo->id,'dpt_id' => $transfer]);
            $name = '';
            $email = '';
            $user = DB::select("SELECT users.name,users.email FROM users,role_user WHERE users.id = role_user.user_id AND role_user.role_id = 3");
            $userfro = DB::select("SELECT * FROM users WHERE id = $user_id");
            $namefro = "";
            foreach($userfro As $fro){
                $namefro = $fro->name;
            }
            foreach($user As $users){
                $name = $users->name;
                $email = $users->email;

                $data = array('name'=>$name, 'email' => $email,'from' => $namefro);
                if($this->isOnline()){
                    Mail::send(['text'=>'transfer'], $data, function($message)use ($users) {
                        $message->to($users->email, $users->name)->subject('ICT Commision Reporter Assignment note');
                        $message->from('info@ictc.go.tz','ICTC');
                    });
                }else{
                    return redirect()->back()->with('success', "Email not sent, maybe caused by poor internet connection.");            
                }
            }
        }

        if($transferUser != ''){
            $dpt = '';
            $userdpts = DB::select("SELECT departments.id FROM users,departments WHERE users.dpt_id = departments.id AND users.id = $transferUser");
            foreach($userdpts As $userdpt){
                $dpt = $userdpt->id;
            }
            Transfer::create(['transferDate' => $now,'user_id' => $transferUser,'todo_id' => $todo->id,'dpt_id' => $dpt]);
            $name = '';
            $email = '';
            $user = DB::select("SELECT users.name,users.email FROM users,role_user,departments WHERE users.dpt_id = departments.id AND users.id = role_user.user_id AND role_user.role_id = 4 AND departments.id = $dpt");
            $userfro = DB::select("SELECT * FROM users WHERE id = $user_id");
            $namefro = "";
            foreach($userfro As $fro){
                $namefro = $fro->name;
            }
            foreach($user As $users){
                $name = $users->name;
                $email = $users->email;

                $data = array('name'=>$name, 'email' => $email,'from' => $namefro);
                if($this->isOnline()){
                    Mail::send(['text'=>'transfer'], $data, function($message)use ($users) {
                        $message->to($users->email, $users->name)->subject('ICT Commision Reporter Assignment note');
                        $message->from('info@ictc.go.tz','ICTC');
                    });
                }else{
                    return redirect()->back()->with('success', "Email not sent, maybe caused by poor internet connection.");            
                }
            }
        }
        return redirect('newtodoprogress')->with(['success' => "Activity created successfully",'activity' => $title]);
    }

    public function uploadprocess(Request $request){
        $request->validate([
            'process' => 'required',
            'todoid' => 'required'
        ]);
        $progress = 0;
        $status = 0;
        $process = Process::create(['process' => $request->process,'status' => $status,'progress' => $progress,'todo_id' => $request->todoid]);
        
        return redirect('newtodoprogress')->with(['success' => "Activity Process added successfully",'activity' => $request->todoid]);
    }

    public function uploadprocesses(Request $request){
        $request->validate([
            'process' => 'required',
            'todoid' => 'required'
        ]);
        $progress = 0;
        $status = 0;
        $process = Process::create(['process' => $request->process,'status' => $status,'progress' => $progress,'todo_id' => $request->todoid]);
        
        return redirect("/$request->todoid/newtodoprogresses")->with(['success' => "Activity Process added successfully",'activity' => $request->todoid]);
    }

    public function edit($id){
        $todo = Todo::find($id);
        return view('todo.edit')->with(['id' => $id, 'todo' => $todo]);
    }
    
    public function editprocess($id){
        $process = Process::find($id);
        return view('todo.editprocess')->with(['id' => $id, 'process' => $process]);
    }

    public function newtodoprogresses($id){
        $todo = Todo::find($id);
        return view('todo.newtodoprogresses')->with(['id' => $id, 'todo' => $todo]);
    }

    public function sendDelaymessage(Request $request){
        $request->validate([
            'Reason' => 'required',
        ]);
        $updateReasonTodo = DB::table('todos')->where('id', $request->id)->limit(1)->update(array('reason' => $request->Reason)); 
        return redirect('/dashboard/todolist')->with('success', "Reason sent successfully!");
    }
    
    public function update(Request $request){
        $request->validate([
            'title' => 'required',
            'progress' => 'required',
            'deadline' => 'required',
            'output' => 'required'
        ]);
        $today = now();
        if($request->progress > 100){
            return redirect()->back()->with('error', "Please Enter Correct Progress Value");
        }
        if($request->progress == 100){
            $todo = Todo::find($request->id);
            $process = DB::select("SELECT * FROM processes WHERE todo_id = $request->id");
            foreach($process As $process){
                $processid = $process->id;
                $process = Process::find($processid);
                $process->update(['status' => 1, 'progress' => 100]);
            }
            $todo->update(['complited' => true, 'completedtime' => now()]);
        }

        if($request->progress < 0){
            return redirect()->back()->with('error', "Please Enter Correct Progress Value");
        }
        if($request->deadline < $today){
            return redirect()->back()->with('error', "Please Enter Correct Deadline Dates");
        }
        $now = now();
        $updateTodo = Todo::find($request->id);
        $updateTodo->update(['title' => $request->title,'progress' => $request->progress,'deadline' => $request->deadline, 'output' => $request->output, 'completedtime' => $now]);
        return redirect('/dashboard/todolist')->with('success', "Activity Updated Successfully!");
    }

    public function updateprocess(Request $request){
        $request->validate([
            'title' => 'required',
            'progress' => 'required'
        ]);
        $today = now();
        if($request->progress > 100){
            return redirect()->back()->with('error', "Please Enter Correct Progress Value");
        }

        if($request->progress < 0){
            return redirect()->back()->with('error', "Please Enter Correct Progress Value");
        }

        if($request->progress == 100){
            $updateProcess = Process::find($request->id);
            $updateProcess->update(['status' => true]);    
        }

        $now = now();
        $updateProcess = Process::find($request->id);
        $updateProcess->update(['process' => $request->title,'progress' => $request->progress]);
        return redirect()->back()->with('success', "Activity Process Updated Successfully!");
    }

    public function complited($id){
        $todo = Todo::find($id);
        $process = DB::select("SELECT * FROM processes WHERE todo_id = $id");
        foreach($process As $process){
            $processid = $process->id;
            $process = Process::find($processid);
            $process->update(['status' => 1, 'progress' => 100]);
        }
        
        if($todo->complited){
            $todo->update(['complited' => false, 'completedtime' => now()]);
            return redirect('/dashboard/todolist')->with('success', "Task marked as Incomplete!");
        }else{
            $todo->update(['complited' => true, 'completedtime' => now(), 'progress' => 100]);
            return redirect('/dashboard/todolist')->with('success', "Task marked as Complete!");
        }
    }

    public function complitedprocess($id){
        $process = Process::find($id);    
        $process->update(['status' => true]);
        return redirect()->back()->with('success', "Activity Process Marked as Complete!");
    }

    public function delete($id){
        $todo = Todo::find($id);
        $todo->delete();
        return redirect('/dashboard/todolist')->with('success', "Activity deleted Successfully!");
    }

    public function deleteprocess($id){
        $process = Process::find($id);
        $process->delete();
        return redirect()->back()->with('success', "Activity Process deleted Successfully!");
    }

    public function getUsersTasktodirector($id){
        return view('director.directordashboard')->with(['userid' => $id]);
    }

    public function getUsersTasktodg1($id){
        return view('dg.dgdashboard')->with(['userid' => $id]);
    }

    public function getUsersTasktodg2($id){
        return view('dg.dgdashboard')->with(['dptid' => $id]);
    }
}