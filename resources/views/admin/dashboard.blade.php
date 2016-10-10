@extends('admin.layouts.master')

@section('content')
<section class="content-header">
	<h1>Dashboard</h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('admin::dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	</ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-aqua"><i class="fa fa-flag-o"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Total Users</span>
					<span class="info-box-number">{{ $users }}</span>
				</div>
			</div>
			<div class="info-box">
				<span class="info-box-icon bg-aqua"><i class="fa fa-flag-o"></i></span>
				<div class="info-box-content">
				<span class="info-box-text">Total Pin</span>
					<span class="info-box-number">{{ $pins }}</span>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection