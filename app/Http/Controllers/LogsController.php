<?php

namespace App\Http\Controllers;

use App\Mail\MyTestMail;
use App\Models\Log;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($task_id)
    {
        $user_log = Auth::user();
        return view('logs.create')
        ->with('user_log',$user_log)
        ->with('task_id',$task_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $this->validate($request, [
            'comment' => ['required', 'string'],
            'task_id' => ['required'],
        ]);
        $log = Log::create([
            'task_id' => $request->task_id,
            'comment' => $request->comment,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);
       $email_user = Auth::user()->email;
        Mail::to($email_user)->send(new MyTestMail());

        $message = "Log created  and email sent successfully";
        return redirect()->route('tasks.index')->with('message',$message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        $user_log = Auth::user();
        return view('logs.show')
        ->with('logs',$task->logs)
        ->with('user_log',$user_log);
    }

}
