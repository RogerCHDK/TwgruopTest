@extends('layouts.master')
@section('contenido_central')
<div class="container">
    <form method="POST" action="{{ route('logs.store') }}">
        @csrf
        <div class="form-group">
        <label for="comment">Comment</label>
        <input type="text" class="form-control" id="comment" placeholder="Enter comment" name="comment">
        <input type="hidden" value="{{ $task_id }}" name="task_id">
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection