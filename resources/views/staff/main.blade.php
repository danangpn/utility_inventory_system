@extends('template.default')

@section('styles')
<style type="text/css">
	#borrowed{
		background-color: #d62728;
	}
	#quantities{
		background-color: chartreuse;
	}
	body{
		background-color: #060b0f;
	}
</style>
@endsection

@section('contents')
<div class="container">
	{{--<div class="jumbotron">--}}
		{{--<h2 class="text-center">School University Utility Inventory System</h2>--}}
	{{--</div>--}}
	<div class="col-md-3 ">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="text-center">My Profile</h3>
			</div>
			<div class="panel-body">
				<p><strong>Name: </strong>{{Auth::user()->lname}}, {{Auth::user()->fname}} {{Auth::user()->mname}}</p>

				<ul class="nav nav-pills nav-stacked">
				  <li role="presentation" class="active"><a href="{{route('staff')}}">List</a></li>
				  <li role="presentation"><a href="{{route('logout')}}">Logout</a></li>

				</ul>
			</div>
		</div>
	</div>
	<div class="col-md-9 ">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="text-center">Utility Inventory List</h3>
			</div>
			<div class="panel-body">
				@if(Session::has('borrow'))
					<div class="alert alert-success">{{Session::get('borrow')}}</div>
				@endif
				@if(Session::has('item'))
					<div class="alert alert-success">{{Session::get('item')}}</div>
				@endif
					<div class="container">
						{{--<h1>Click the filter icon <small>(<i class="glyphicon glyphicon-filter"></i>)</small></h1>--}}
						<div class="row">
							<div class="col-md-6">
								<div class="panel panel-primary">
									<div class="panel-heading">
										<h3 class="panel-title">Inventory</h3>
										<div class="pull-right">
											<a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#newItems">New</a>
											<span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="table">
												{{--<i class="glyphicon glyphicon-filter"></i>--}}
											</span>
										</div>
									</div>
									<div class="panel-body">
										<input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filter Inventory" />
									</div>

								<div>
									<table class="table table-hover tablesorter" id="dev-table">
											<thead>
											<tr>
												<th>#</th>
												<th>Item Name</th>
												<th>Quantity</th>
												<th>Sold</th>
												<th>Created Date</th>
												<th>Action</th>
											</tr>
											</thead>
										<tbody>
										@foreach($items as $item)
											<tr>
												<td>#</td>
												<td>{{$item->name}}</td>
												<td><span class="badge" id="quantities">{{$item->quantity}}</span></td>
												<td><a href="{{route('view_borrowed_item', ['item_id'=> $item->id])}}"><span class="badge" id="borrowed">{{$item->borrowed_item($item->id)}}</span></a></td>
												<td>{{$item->created_at->format('l j/m/Y H:i:s')}}</td>
												<td><a href="{{route('staff_borrow', ['item_id'=> $item->id])}}" class="btn btn-danger btn-xs">Sell</a></td>
											</tr>
										@endforeach
										</tbody>
									{{--</table>--}}
									</table>
									</div>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
	{{--//Data aslei--}}
	<div class="modal fade" id="newItems">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3>Enter New Items</h3>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" action="{{route('add_item')}}" method="POST">
						<div class="form-group">
							<label class="control-label col-md-3">Item Name</label>
							<div class="col-md-8">
								<input type="text" name="name" class="form-control" required="">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Item Quantity</label>
							<div class="col-md-8">
								<input type="number" name="quantity" class="form-control" required="">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-8 col-md-offset-3">
								<button class="btn btn-primary" type="submit">Submit</button>
							</div>

						</div>
						{{csrf_field()}}
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

@endsection

@section('scripts')

@endsection