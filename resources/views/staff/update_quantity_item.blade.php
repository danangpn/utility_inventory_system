@extends('template.default')

@section('styles')
<style type="text/css">
	#borrowed{
		background-color: red;
	}
	#quantities{
		background-color: blue;
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
				<h3>My Profile</h3>
			</div>
			<div class="panel-body">
				<p><strong>Name:</strong>{{Auth::user()->lname}}, {{Auth::user()->fname}} {{Auth::user()->mname}}</p>

				<ul class="nav nav-pills nav-stacked">
				  <li role="presentation" ><a href="{{route('staff')}}">List</a></li>
				  <li role="presentation"><a href="{{route('logout')}}">Logout</a></li>
				  
				</ul>
			</div>
		</div>
	</div>
	<div class="col-md-9 ">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="text-center">Update Quantity of Item</h3>
			</div>
			<div class="panel-body">
				@if(Session::has('quantity'))
					<div class="alert alert-success">{{Session::get('quantity')}}</div>
				@endif
				{{--<div class="modal fade" id="updateItems">--}}
				<div>
						<div class="modal-content">
							<div class="modal-body">
								<form class="form-horizontal" action="{{route('action_update_quantity_item',['item_id'=> $find_item->id])}}" method="POST">
									<div class="form-group">
										<label class="control-label col-md-3">Item Name</label>
										<div class="col-md-8">
											{{--Name: {{$find_item->name}}--}}
											<input type="text" name="name" class="form-control" required=""  disabled="disabled" value="{{$find_item->name}}">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Current Quantity</label>
										<div class="col-md-8">
											{{--<p>{{$find_item->quantity}}</p>--}}
											<input type="number" name="quantity" class="form-control" disabled="disabled" value="{{$find_item->quantity}}">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Add Quantity</label>
										<div class="col-md-8">
											<input type="number" name="add_quantity" class="form-control" required="">
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
</div>
@endsection

@section('scripts')

@endsection