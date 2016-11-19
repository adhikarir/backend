@extends('layouts.master')
@section('content')
<html>
	<head>
		<title>Add Product</title>
	</head>
	<p style="color:red">{{$errors->first('product_name')}}</p>
	<p style="color:red">{{$errors->first('product_price')}}</p>

	<p style="color:red">{{$errors->first('product_qty')}}</p>

	<body>
		<form action="{{action('ProductController@save')}}" method="post" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="<?= csrf_token(); ?>">
			Product Name
			<input type="text" name="product_name" class="form-control">
			Price
			<input type="text" name="product_price" class="form-control">
			Quantity
			<input type="text" name="product_qty" class="form-control">
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