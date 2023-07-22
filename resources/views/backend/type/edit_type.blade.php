@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
 
    <div class="row profile-body">

      <div class="col-md-8 col-xl-8 middle-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">
                       Edit Property Type
                    </h6>
                    
                        <form class="forms-sample" method="POST" action="{{ route('update.type') }}">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="id" value="{{ $types->id }}">
                                <div class="mb-3 mt-4">
                                    <label for="type_name" class="form-label">Type Name</label><span class="text-danger"> *</span>
                                    <input type="text" class="form-control @error('type_name') is-invalid @enderror" name="type_name" id="type_name" value="{{ $types->type_name }}" placeholder="Type Name for the property">
                                    @error('type_name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div> 
                                
                                <div class="mb-3">
                                    <label for="type_icon" class="form-label">Type Icon</label><span class="text-danger"> *</span>
                                    <input type="text" class="form-control @error('type_icon') is-invalid @enderror" name="type_icon" id="type_icon" value="{{ $types->type_icon }}" placeholder="Type class name of the Icon">
                                    @error('type_icon')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
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
</div>

@endsection