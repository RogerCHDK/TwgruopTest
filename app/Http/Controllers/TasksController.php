<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('status',1)->get();
        $tasks = Task::where('status',1)->get();
        $user_log = Auth::user();
        $today = Carbon::now();
        return view('tasks.index')
        ->with('users',$users)
        ->with('tasks',$tasks)
        ->with('user_log',$user_log)
        ->with('today',$today);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'description' => ['required', 'string'],
            'deadline' => ['required', 'date'],
            'user_id' => ['required'],
        ]);

        $tasks = Task::create([
            'description' =>$request->description ,
            'deadline' =>$request->deadline ,
            'user_id' =>$request->user_id ,
            'status' =>1 ,
        ]);

        $message = "Task created successfully";

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
        return view('tasks.show')
        ->with('user_log',$user_log)
        ->with('task',$task);
    }
}
