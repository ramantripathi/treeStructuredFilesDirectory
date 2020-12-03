<!DOCTYPE html>
<html>
<head>
	<title>Laravel Directory View</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link href="css/treeview.css" rel="stylesheet">
</head>
<body>
	<div class="container">     
		<div class="panel panel-primary">
			<div class="panel-heading">Manage Directory and Files</div>
	  		<div class="panel-body">
	  			<div class="row">
	  				<div class="col-md-3">
	  					<h3>Directory and File List</h3>
				        <ul id="tree1">
				            @foreach($categories as $category)
				                <li>
				                    {{ $category->title }}
				                    @if(count($category->childs))
				                        @include('manageChild',['childs' => $category->childs])
				                    @endif
				                </li>
				            @endforeach
				        </ul>
	  				</div>
	  				<div class="col-md-3">
	  					<h3>Add New Directory</h3>


				  			{!! Form::open(['route'=>'add.category']) !!}


				  				@if ($message = Session::get('successdir'))
									<div class="alert alert-success alert-block">
										<button type="button" class="close" data-dismiss="alert">×</button>	
									        <strong>{{ $message }}</strong>
									</div>
								@endif


				  				<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
									{!! Form::label('Title:') !!}
									{!! Form::text('title', old('title'), ['class'=>'form-control', 'placeholder'=>'Enter Title']) !!}
									<span class="text-danger">{{ $errors->first('title') }}</span>
								</div>


								<div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">
									{!! Form::label('Directory:') !!}
									{!! Form::select('parent_id',$allCategories, old('parent_id'), ['class'=>'form-control', 'placeholder'=>'Select Directory']) !!}
									<span class="text-danger">{{ $errors->first('parent_id') }}</span>
								</div>
								<input type="hidden" name="is_dir" value="0">

								<div class="form-group">
									<button class="btn btn-success">Add New</button>
								</div>


				  			{!! Form::close() !!}


	  				</div>
					<div class="col-md-3">
	  					<h3>Add New File</h3>


				  			{!! Form::open(['route'=>'add.category']) !!}
							
							@if ($message = Session::get('successfile'))
									<div class="alert alert-success alert-block">
										<button type="button" class="close" data-dismiss="alert">×</button>	
									        <strong>{{ $message }}</strong>
									</div>
								@endif

				  				<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
									{!! Form::label('Title:') !!}
									{!! Form::text('title', old('title'), ['class'=>'form-control', 'placeholder'=>'Enter Title']) !!}
									<span class="text-danger">{{ $errors->first('title') }}</span>
								</div>


								<div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">
									{!! Form::label('Directory:') !!}
									{!! Form::select('parent_id',$allCategories, old('parent_id'), ['class'=>'form-control', 'placeholder'=>'Select Category']) !!}
									<span class="text-danger">{{ $errors->first('parent_id') }}</span>
								</div>
								<input type="hidden" name="is_dir" value="1">

								<div class="form-group">
									<button class="btn btn-success">Add New</button>
								</div>


				  			{!! Form::close() !!}


	  				</div>
					<div class="col-md-3">
	  					<h3>Delete Directory or File</h3>


				  			{!! Form::open(['route'=>'delete.category']) !!}
							
							@if ($message = Session::get('successdel'))
									<div class="alert alert-success alert-block">
										<button type="button" class="close" data-dismiss="alert">×</button>	
									        <strong>{{ $message }}</strong>
									</div>
								@endif

								<div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">
									{!! Form::label('Directory:') !!}
									{!! Form::select('parent_id',$dallCategories, old('parent_id'), ['class'=>'form-control', 'placeholder'=>'Select Category']) !!}
									<span class="text-danger">{{ $errors->first('parent_id') }}</span>
									@if ($message = Session::get('faildir'))
										<span class="text-danger">{{ $message }}</span>
									@endif
								</div>

								<div class="form-group">
									<button class="btn btn-success">Delete</button>
								</div>


				  			{!! Form::close() !!}


	  				</div>
	  			</div>

	  			
	  		</div>
        </div>
    </div>
    <script src="js/treeview.js"></script>
</body>
</html>