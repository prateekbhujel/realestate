@extends('admin.admin_dashboard')
@section('admin')

<script src="{{ asset('backend/assets/js/jquery.js') }}"></script>
<div class="page-content">
 
    <div class="row profile-body">

      <div class="col-md-8 col-xl-8 middle-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">
                       Add Amenities
                    </h6>
                    
                        <form id="myForm" class="forms-sample" method="POST" action="{{ route('store.amenities') }}">
                            @csrf
                            <div class="row">

                                <div class="form-group mb-3 mt-4">
                                    <label for="amenities_name" class="form-label">Amenities Name</label><span class="text-danger"> *</span>
                                    <input type="text" class="form-control @error('amenities_name') is-invalid @enderror" name="amenities_name" id="amenities_name" value="{{ old('amenities_name') }}" placeholder="Type Name for the Amenities">
                                    @error('amenities_name')
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
<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                amenities_name: {
                    required : true,
                }, 
                
            },
            messages :{
                amenities_name: {
                    required : 'The amenities name field is required. ',
                }, 
                 

            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>

@endsection