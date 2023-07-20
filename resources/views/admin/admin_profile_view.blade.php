@extends('admin.admin_dashboard')
@section('admin')

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> --}}
<div class="page-content">
 
    <div class="row profile-body">
      <!-- left wrapper start -->
      <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
        <div class="card rounded">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-2">

              <div>
                <img class="wd-100 rounded-circle" src="{{ (!empty($profileData->photo)) ? url('upload/admin_images/'.$profileData->photo) : url('upload/no_image.jpg') }}" alt="profile">
                <span class="h4 ms-3">{{ $profileData->name }}</span>
              </div>

            </div>
           
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Name:</label>
              <p class="text-muted">{{ $profileData->name }}</p>
            </div>
            <div class="mt-3">
                <label class="tx-11 fw-bolder mb-0 text-uppercase">Username:</label>
                <p class="text-muted">{{ $profileData->username }}</p>
              </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
              <p class="text-muted">{{ $profileData->email }}</p>
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Phone:</label>
              <p class="text-muted">{{ $profileData->phone }}</p>
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Address:</label>
              <p class="text-muted">{{ $profileData->address }}</p>
            </div>

          </div>
        </div>
      </div>

      <div class="col-md-8 col-xl-8 middle-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">
                        Update Admin Profile
                    </h6>
                    
                        <form class="forms-sample" method="POST" action="{{ route('admin.profile.store') }}" enctype="multipart/form-data">
                            @csrf
                          <div class="mb-3">
                            <label for="Username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="username" autocomplete="off" value="{{ $profileData->username }}">
                          </div>

                          <div class="mb-3">
                            <label for="Name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" autocomplete="off" value="{{ $profileData->name }}">
                          </div>
                            
                          <div class="mb-3">
                            <label for="Email address" class="form-label">Email address</label>
                            <input type="email" class="form-control"  name="email" id="email" value="{{ $profileData->email }}">
                          </div>

                          <div class="mb-3">
                            <label for="Phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone" autocomplete="off" value="{{ $profileData->phone }}">
                          </div>

                          <div class="mb-3">
                            <label for="Address" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" id="address" autocomplete="off" value="{{ $profileData->address }}">
                          </div>

                          <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Photo</label>
                            <input type="file" class="form-control" name="photo" id="image" autocomplete="off" value="{{ $profileData->photo }}">
                   
                            <label for="exampleInputUsername1" class="form-label"> </label>
                            <center>
                                <img id="showImage" class="wd-100 rounded-circle" src="{{ (!empty($profileData->photo)) ? url('upload/admin_images/'.$profileData->photo) : url('upload/no_image.jpg') }}" alt="profile">
                            </center>
                          </div>

                      {{-- <div class="mb-3">
                          <label for="password" name="password" class="form-label">Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="Password">
                      </div> --}}

                          
                            
                          <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                    </form>
  
                </div>
            </div>
        </div>
      </div>

    </div>

        </div>

  <script type="text/javascript">
  
    $(document).ready(function(){
      $('#image').change(function(e){
        var reader = new FileReader();
        reader.onload = function(e){
          $('#showImage').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
      });
    });
  </script>
@endsection