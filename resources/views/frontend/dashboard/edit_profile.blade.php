@extends('frontend.forntend_dashboard')
@section('main')

<!--Page Title-->
<section class="page-title centred" style="background-image: url({{ asset('frontend/assets/images/background/page-title-5.jpg') }});">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>User Profile</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index.html">Home</a></li>
                <li>User Profile</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->

<!-- sidebar-page-container -->
<section class="sidebar-page-container blog-details sec-pad-2">
    <div class="auto-container">
        <div class="row clearfix">
            <!-- Sidebar Column -->
            @php
                $id = Auth::user()->id;
                $userData = App\Models\User::find($id);
            @endphp

            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="blog-sidebar">
                    <div class="sidebar-widget post-widget">
                        <div class="widget-title">
                            <h4>User Profile</h4>
                        </div>
                        <div class="post-inner">
                            <div class="post">
                                <figure class="post-thumb"><a href="blog-details.html">
                                    <img src="{{ (!empty($userData->photo)) ? url('upload/user_images/'.$userData->photo) : url('upload/no_image.jpg') }}" alt=""></a></figure>
                                <h5><a href="blog-details.html">{{ $userData->name }}</a></h5>
                                <p>{{ $userData->email }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-widget category-widget">
                        <div class="widget-title">
                            <!-- ... Your widget title content ... -->
                        </div>

                        @include('frontend.dashboard.dashboard_sidebar')

                    </div>
                </div>
            </div>

            <!-- Content Column -->
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="blog-details-content">
                    <div class="news-block-one">
                        <div class="inner-box">
                            <!-- ... Your existing news block content ... -->

                            <div class="lower-content">
                            

                                <form action="{{ route('user.profile.store') }}" method="POST" class="default-form" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label>Username</label>
                                        <span class="text-danger"> * </span>
                                        <input type="text" name="username" id="username" value="{{ $userData->username }}" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <span class="text-danger"> * </span>
                                        <input type="text" name="name" id="name"value="{{ $userData->name }}" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Email address</label>
                                        <span class="text-danger"> * </span>
                                        <input type="email" name="email" id="email" value="{{ $userData->email }}" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <span class="text-danger"> * </span>
                                        <input type="text" name="phone" id="phone" value="{{ $userData->phone }}" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <span class="text-danger"> * </span>
                                        <input type="text" name="address" id="address" value="{{ $userData->address }}" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="formFile" class="form-label">Image</label>
                                        <span class="text-danger"> * </span>
                                        <input class="form-control" name="photo" type="file" id="image">
                                    </div>

                                    <div class="form-group">
                                        <label for="formFile" class="form-label"></label>
                                            <img id="showImage" src="{{ (!empty($userData->photo)) ? url('upload/user_images/'.$userData->photo) : url('upload/no_image.jpg') }}" alt="" style="width: 100px; height: 100px;"></a>
                                    </div>

                                    <div class="form-group message-btn">
                                        <button type="submit" class="theme-btn btn-one">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- sidebar-page-container -->

<!-- subscribe-section -->
<section class="subscribe-section bg-color-3">
    <div class="pattern-layer" style="background-image: url(assets/images/shape/shape-2.png);"></div>
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-6 col-md-6 col-sm-12 text-column">
                <div class="text">
                    <span>Subscribe</span>
                    <h2>Sign Up To Our Newsletter To Get The Latest News And Offers.</h2>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 form-column">
                <div class="form-inner">
                    <form action="contact.html" method="post" class="subscribe-form">
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Enter your email" required="">
                            <button type="submit">Subscribe Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- subscribe-section end -->

<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            };
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection
