<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
	<meta name="author" content="NobleUI">
	<meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<title>Admin Panel - Real Estate </title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <!-- End fonts -->

	<!-- core:css -->
	<link rel="stylesheet" href="{{ asset('backend/assets/vendors/core/core.css') }}">
	<!-- endinject -->

	<!-- Plugin css for this page -->
	<link rel="stylesheet" href="{{ asset('backend/assets/vendors/flatpickr/flatpickr.min.css') }}">
	<!-- End plugin css for this page -->

	<!-- inject:css -->
	<link rel="stylesheet" href="{{ asset('backend/assets/fonts/feather-font/css/iconfont.css') }}">
	<link rel="stylesheet" href="{{ asset('backend/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
	<!-- endinject -->

  <!-- Layout styles -->  
	<link rel="stylesheet" href="{{ asset('backend/assets/css/demo2/style.css') }}">
  <!-- End layout styles -->

  <link rel="icon" href="{{ asset('backend/assets/images/favicon.ico') }}" />
{{-- <link rel="icon" href="{{ ('frontend/assets/images/favicon.ico') }}" type="image/x-icon"> --}}


  {{-- Jquery 3.6.4 version --}}
  <script src="{{ asset('backend/assets/js/jquery.js') }}"></script>

  {{-- Toaster CSS --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/toastr.css') }}" >

</head>
<body>
	<div class="main-wrapper">

		<!-- partial:partials/_sidebar.html -->
            @include('admin.body.sidebar')
		<!-- End partial Side-Bar -->
	
		<div class="page-wrapper">
					
	<!-- partial:partials/_navbar.html -->
        @include('admin.body.header')
	<!-- partial -->

        @yield('admin')

    <!-- partial:partials/_footer.html -->
        @include('admin.body.footer')
    <!-- partial -->
		
		</div>
	</div>

	<!-- core:js -->
	<script src="{{ asset('backend/assets/vendors/core/core.js') }}"></script>
	<!-- endinject -->

	<!-- Plugin js for this page -->
  <script src="{{ asset('backend/assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
  <script src="{{ asset('backend/assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
	<!-- End plugin js for this page -->

	<!-- inject:js -->
	<script src="{{ asset('backend/assets/vendors/feather-icons/feather.min.js') }}"></script>
	<script src="{{ asset('backend/assets/js/template.js') }}"></script>
	<!-- endinject -->

	<!-- Custom js for this page -->
  <script src="{{ asset('backend/assets/js/dashboard-dark.js') }}"></script>
	<!-- End custom js for this page -->

<script type="text/javascript" src="{{ asset('backend/assets/js/toastr.min.js') }}"></script>
	<script>
		@if(Session::has('message'))
		var type = "{{ Session::get('alert-type','info') }}"
		switch(type){
		case 'info':
		toastr.info(" {{ Session::get('message') }} ");
		break;
		
		case 'success':
		toastr.success(" {{ Session::get('message') }} ");
		break;
		
		case 'warning':
		toastr.warning(" {{ Session::get('message') }} ");
		break;
		
		case 'error':
		toastr.error(" {{ Session::get('message') }} ");
		break; 
		}
		@endif 
	</script>

</body>
</html>    




{{-- =========================Add Sweetalert =======================

<script src="{{ asset('backend/assets/js/sweetalert2@10') }}"></script>

<script src="{{ asset('backend/assets/js/code.js') }}"></script>


$(function(){
   $(document).on('click','#delete',function(e){
	   e.preventDefault();
	   var link = $(this).attr("href");

 
				 Swal.fire({
				   title: 'Are you sure?',
				   text: "Delete This Data?",
				   icon: 'warning',
				   showCancelButton: true,
				   confirmButtonColor: '#3085d6',
				   cancelButtonColor: '#d33',
				   confirmButtonText: 'Yes, delete it!'
				 }).then((result) => {
				   if (result.isConfirmed) {
					 window.location.href = link
					 Swal.fire(
					   'Deleted!',
					   'Your file has been deleted.',
					   'success'
					 )
				   }
				 }) 


   });

 });


============================Sweetalert Show Messsage ================= 

			   // Start Message 

		   const Toast = Swal.mixin({
				 toast: true,
				 position: 'top-end',
				 icon: 'success', 
				 showConfirmButton: false,
				 timer: 3000 
		   })
		   if ($.isEmptyObject(data.error)) {
				   
				   Toast.fire({
				   type: 'success',
				   title: data.success, 
				   })

		   }else{
			  
		  Toast.fire({
				   type: 'error',
				   title: data.error, 
				   })
			   }

			 // End Message   




=============== WishList Part For Show Response Message ==========================

 // Start Message 

		   const Toast = Swal.mixin({
				 toast: true,
				 position: 'top-end',
				 
				 showConfirmButton: false,
				 timer: 3000 
		   })
		   if ($.isEmptyObject(data.error)) {
				   
				   Toast.fire({
				   type: 'success',
				   icon: 'success', 
				   title: data.success, 
				   })

		   }else{
			  
		  Toast.fire({
				   type: 'error',
				   icon: 'error', 
				   title: data.error, 
				   })
			   }

			 // End Message  

=============== End WishList Part For Show Response Message ========================== --}}


