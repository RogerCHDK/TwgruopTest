@extends('layouts.master')
@section('contenido_central')
    <div class="container">
			@if(session('message'))
			<div class="alert alert-success">
				{{ session('message') }}
			</div>
			@endif
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-xs-6">
							<h2><b>Tasks</b></h2>
						</div>
						<div class="col-xs-6">
							<a href="#addTaskModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Task</span></a>					
						</div>
					</div>
				</div>
                @auth
				<table class="table" id="datatable">
					<thead>
						<tr>
							<th>
								<span class="custom-checkbox">
									<input type="checkbox" id="selectAll">
									<label for="selectAll"></label>
								</span>
							</th>
							<th>Description</th>
							<th>Dead line</th>
							<th>User</th>
							<th>Logs</th>
						</tr>
					</thead>
					<tbody>
                        @foreach ($tasks as $task)
                        <tr class="{{($today >= $task->deadline) ?"deadline-red" : " " }}">
							<td>
								<span class="custom-checkbox">
									<input type="checkbox" id="checkbox1" name="options[]" value="1">
									<label for="checkbox1"></label>
								</span>
							</td>
							<td>{{ $task->description }}</td>
							<td>{{ $task->deadline }}</td>
							<td>{{ $task->user->name }}</td>
                            @auth
                            <td>
								<a href="{{ route('logs.show',$task->id) }}">
                                    <span class="material-icons" title="Show Logs">
                                        visibility
                                        </span>
                                </a>
                                @if ($user_log->id == $task->user->id)
                                <a href="{{ route('log.create',$task->id) }}">
                                    <span class="material-icons" title="Add Log">
                                        add
                                        </span>
                                </a>
                                @endif
                                
                            </td>
                            @endauth
							
						</tr>
                        @endforeach
						
					</tbody>
				</table>
                @endauth
				
			</div>
		</div>        
    </div>
	<!-- Add Modal HTML -->
	<div id="addTaskModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="POST" action="{{ route('tasks.store') }}">
                    @csrf
					<div class="modal-header">						
						<h4 class="modal-title">Add Task</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>User</label>
							<select name="user_id" class="form-control">
                                @foreach ($users as $user)
                                <option value="{{$user->id}}">{{ $user->name }}</option>
                                @endforeach
                                
                            </select>
						</div>
                        <div class="form-group">
							<label for="deadline">Dead Line</label>
							<input type="date" class="form-control" required name="deadline">
						</div>
                        <div class="form-group">
							<label for="description">Description</label>
							<textarea class="form-control" required name="description"></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>
    @endsection