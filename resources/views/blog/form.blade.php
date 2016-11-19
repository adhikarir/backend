@extends('layouts.master')
@section('content')
<html>
	<head>
		<title>Add Blog</title>
	</head>
	<p style="color:red">{{$errors->first('title')}}</p>
	<p style="color:red">{{$errors->first('description')}}</p>


	<body>
		<form action="{{action('BlogController@save')}}" method="post" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="<?= csrf_token(); ?>">
			Title
			<input type="text" name="title" class="form-control">
			<!-- Description
			<input type="text" name="description" class="form-control"> -->
			<input type="text" name="description" class="form-control">
	
			
			<!--   <label>Select image to upload:</label>
                                    <input type="file" name="file" id="file"> -->
                          <div class="form-group">
		<label for="image">Image:</label>
		<input class="form-control" name="file" type="file" id="file">
		
	</div>            
			<br/>
			<input type="submit" value="Save Record" class="btn btn-primary">

		</form>

	</body>
</html>

@endsection()