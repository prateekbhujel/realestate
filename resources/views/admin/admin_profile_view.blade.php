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
                          <span class="text-danger"> * </span>
                          <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" autocomplete="off" value="{{ $profileData->username }}">
                          @error('username')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                  
                      <div class="mb-3">
                          <label for="Name" class="form-label">Name</label>
                          <span class="text-danger"> * </span>
                          <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" autocomplete="off" value="{{ $profileData->name }}">
                          @error('name')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                  
                      <div class="mb-3">
                          <label for="Email address" class="form-label">Email address</label>
                          <span class="text-danger"> * </span>
                          <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ $profileData->email }}">
                          @error('email')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                  
                      <div class="mb-3">
                          <label for="Phone" class="form-label">Phone</label>
                          <span class="text-danger"> * </span>
                          <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" autocomplete="off" value="{{ $profileData->phone }}">
                          @error('phone')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                  
                      <div class="mb-3">
                          <label for="Address" class="form-label">Address</label>
                          <span class="text-danger"> * </span>
                          <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" autocomplete="off" value="{{ $profileData->address }}">
                          @error('address')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                  
                      <div class="mb-3">
                          <label for="exampleInputUsername1" class="form-label">Photo</label>
                          <span class="text-danger"> * </span>
                          <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" id="image" autocomplete="off" value="{{ $profileData->photo }}">
                  
                          @if($profileData->photo)
                              <label for="exampleInputUsername1" class="form-label"> </label>
                              <center>
                                  <img id="showImage" class="wd-100 rounded-circle" src="{{ url('upload/admin_images/'.$profileData->photo) }}" alt="profile">
                              </center>
                          @endif
                  
                          @error('photo')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                  
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