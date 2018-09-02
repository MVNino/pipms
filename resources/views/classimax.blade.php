@extends('author.layouts.app-classimax')

@section('content')
<!-- Recently Favorited -->
<h3 class="widget-header">My Ads</h3>
<table class="table table-responsive product-dashboard-table">
	<thead>
		<tr>
			<th>Image</th>
			<th>Product Title</th>
			<th class="text-center">Category</th>
			<th class="text-center">Action</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			
			<td class="product-thumb">
				<img width="80px" height="auto" src="{{ asset('classimax/images/products/products-1.jpg') }}" alt="image description"></td>
			<td class="product-details">
				<h3 class="title">Macbook Pro 15inch</h3>
				<span class="add-id"><strong>Ad ID:</strong> ng3D5hAMHPajQrM</span>
				<span><strong>Posted on: </strong><time>Jun 27, 2017</time> </span>
				<span class="status active"><strong>Status</strong>Active</span>
				<span class="location"><strong>Location</strong>Dhaka,Bangladesh</span>
			</td>
			<td class="product-category"><span class="categories">Laptops</span></td>
			<td class="action" data-title="Action">
				<div class="">
					<ul class="list-inline justify-content-center">
						<li class="list-inline-item">
							<a data-toggle="tooltip" data-placement="top" title="Tooltip on top" class="view" href="">
								<i class="fa fa-eye"></i>
							</a>		
						</li>
						<li class="list-inline-item">
							<a class="edit" href="">
								<i class="fa fa-pencil"></i>
							</a>		
						</li>
						<li class="list-inline-item">
							<a class="delete" href="">
								<i class="fa fa-trash"></i>
							</a>
						</li>
					</ul>
				</div>
			</td>
		</tr>
		<tr>
			
			<td class="product-thumb">
				<img width="80px" height="auto" src="{{ asset('classimax/images/products/products-2.jpg') }}" alt="image description"></td>
			<td class="product-details">
				<h3 class="title">Study Table Combo</h3>
				<span class="add-id"><strong>Ad ID:</strong> ng3D5hAMHPajQrM</span>
				<span><strong>Posted on: </strong><time>Feb 12, 2017</time> </span>
				<span class="status active"><strong>Status</strong>Active</span>
				<span class="location"><strong>Location</strong>USA</span>
			</td>
			<td class="product-category"><span class="categories">Laptops</span></td>
			<td class="action" data-title="Action">
				<div class="">
					<ul class="list-inline justify-content-center">
						<li class="list-inline-item">
							<a data-toggle="tooltip" data-placement="top" title="Tooltip on top" class="view" href="">
								<i class="fa fa-eye"></i>
							</a>		
						</li>
						<li class="list-inline-item">
							<a class="edit" href="">
								<i class="fa fa-pencil"></i>
							</a>		
						</li>
						<li class="list-inline-item">
							<a class="delete" href="">
								<i class="fa fa-trash"></i>
							</a>
						</li>
					</ul>
				</div>
			</td>
		</tr>
		<tr>
			
			<td class="product-thumb">
				<img width="80px" height="auto" src="{{ asset('classimax/images/products/products-3.jpg') }}" alt="image description"></td>
			<td class="product-details">
				<h3 class="title">Macbook Pro 15inch</h3>
				<span class="add-id"><strong>Ad ID:</strong> ng3D5hAMHPajQrM</span>
				<span><strong>Posted on: </strong><time>Jun 27, 2017</time> </span>
				<span class="status active"><strong>Status</strong>Active</span>
				<span class="location"><strong>Location</strong>Dhaka,Bangladesh</span>
			</td>
			<td class="product-category"><span class="categories">Laptops</span></td>
			<td class="action" data-title="Action">
				<div class="">
					<ul class="list-inline justify-content-center">
						<li class="list-inline-item">
							<a data-toggle="tooltip" data-placement="top" title="Tooltip on top" class="view" href="">
								<i class="fa fa-eye"></i>
							</a>		
						</li>
						<li class="list-inline-item">
							<a class="edit" href="">
								<i class="fa fa-pencil"></i>
							</a>		
						</li>
						<li class="list-inline-item">
							<a class="delete" href="">
								<i class="fa fa-trash"></i>
							</a>
						</li>
					</ul>
				</div>
			</td>
		</tr>
		<tr>
			
			<td class="product-thumb">
				<img width="80px" height="auto" src="{{ asset('classimax/images/products/products-4.jpg') }}" alt="image description"></td>
			<td class="product-details">
				<h3 class="title">Macbook Pro 15inch</h3>
				<span class="add-id"><strong>Ad ID:</strong> ng3D5hAMHPajQrM</span>
				<span><strong>Posted on: </strong><time>Jun 27, 2017</time> </span>
				<span class="status active"><strong>Status</strong>Active</span>
				<span class="location"><strong>Location</strong>Dhaka,Bangladesh</span>
			</td>
			<td class="product-category"><span class="categories">Laptops</span></td>
			<td class="action" data-title="Action">
				<div class="">
					<ul class="list-inline justify-content-center">
						<li class="list-inline-item">
							<a data-toggle="tooltip" data-placement="top" title="Tooltip on top" class="view" href="">
								<i class="fa fa-eye"></i>
							</a>		
						</li>
						<li class="list-inline-item">
							<a class="edit" href="">
								<i class="fa fa-pencil"></i>
							</a>		
						</li>
						<li class="list-inline-item">
							<a class="delete" href="">
								<i class="fa fa-trash"></i>
							</a>
						</li>
					</ul>
				</div>
			</td>
		</tr>
		<tr>
			
			<td class="product-thumb">
				<img width="80px" height="auto" src="{{ asset('classimax/images/products/products-1.jpg') }}" alt="image description"></td>
			<td class="product-details">
				<h3 class="title">Macbook Pro 15inch</h3>
				<span class="add-id"><strong>Ad ID:</strong> ng3D5hAMHPajQrM</span>
				<span><strong>Posted on: </strong><time>Jun 27, 2017</time> </span>
				<span class="status active"><strong>Status</strong>Active</span>
				<span class="location"><strong>Location</strong>Dhaka,Bangladesh</span>
			</td>
			<td class="product-category"><span class="categories">Laptops</span></td>
			<td class="action" data-title="Action">
				<div class="">
					<ul class="list-inline justify-content-center">
						<li class="list-inline-item">
							<a data-toggle="tooltip" data-placement="top" title="Tooltip on top" class="view" href="">
								<i class="fa fa-eye"></i>
							</a>		
						</li>
						<li class="list-inline-item">
							<a class="edit" href="">
								<i class="fa fa-pencil"></i>
							</a>		
						</li>
						<li class="list-inline-item">
							<a class="delete" href="">
								<i class="fa fa-trash"></i>
							</a>
						</li>
					</ul>
				</div>
			</td>
		</tr>
	</tbody>
</table>
@endsection