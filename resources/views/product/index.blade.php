@extends('layouts.master')

@section('content')

<p style="color:red"><?php echo Session::get('message');  ?></p>
<a href="<?php echo 'productform'; ?>">Add new Product</a>

<table class="table table-bordered table-hover" >
	<thead>
		<th>Product Id</th>
		<th>Product Name</th>

		<th>Product Price</th>
		<th>Product Quantity</th>
		<th>Total price</th>

		<th>Action</th>
	</thead>
	<tbody>
	@foreach($data as $row)
	<tr>
		<td>{{$row->id}}</td>
		<td>{{$row->product_name}}</td>
		<td>{{$row->product_price}}</td>
		<td>{{$row->product_qty}}</td>
		<td>{{$a=$row->product_price*$row->product_qty}}</td>
		<td>
			<a href="<?php echo 'EditProduct/'.$row->id ?>">Edit</a>|
			<a href="<?php echo 'DeleteProduct/'.$row->id ?>">Delete</a>
		</td>
		</tr>


		@endforeach
		<!-- display next prev button -->
		<?php echo $data->render(); ?>
	</tbody>
	
</table>

@endsection()