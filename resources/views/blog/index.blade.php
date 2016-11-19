@extends('layouts.master')

@section('content')

<p style="color:red"><?php echo Session::get('message');  ?></p>
<a href="<?php echo 'blogform'; ?>">Add new Blog</a>

<table class="table table-bordered table-hover" >
	<thead>
		<th> Id</th>
		<th>Title</th>

		<th>Description</th>
		<!-- <th>Product Quantity</th>
		<th>Total price</th> -->

		<th>Action</th>
	</thead>
	<tbody>
	@foreach($blog as $row)
	<tr>
		<td>{{$row->id}}</td>
		<td>{{$row->title}}</td>
		<td>{{$row->description}}</td>
		
		<td>
			<a href="<?php echo 'EditBlog/'.$row->id ?>">Edit</a>|
			<a href="<?php echo 'DeleteBlog/'.$row->id ?>">Delete</a>
		</td>
		</tr>


		@endforeach
		<!-- display next prev button -->
		<?php echo $blog->render(); ?>
	</tbody>
	
</table>

@endsection()