@extends('layouts.master')
@section('contenido_central')
    <div class="container">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-xs-6">
							<h2><b>Logs</b></h2>
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
							<th>Comment</th>
							<th>Created At</th>
						</tr>
					</thead>
					<tbody>
                       @foreach ($logs as $log)
                       <tr>
                        <td>
                            <span class="custom-checkbox">
                                <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                <label for="checkbox1"></label>
                            </span>
                            </td>
                           <td>{{ $log->comment }}</td>
                           <td>{{ $log->created_at }}</td>
                       </tr>
                       @endforeach
					</tbody>
				</table>
                @endauth
			</div>
		</div>        
    </div>
    @endsection