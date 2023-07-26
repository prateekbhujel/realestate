@extends('admin.admin_dashboard')
@section('admin')

<script src="{{ asset('backend/assets/js/jquery.js') }}"></script>

<div class="page-content">
 
    <div class="row profile-body">

      <div class="col-md-12 col-xl-12 middle-wrapper">

        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Add Property Details</h6>
                        <form method="POST" action="{{ route('update.property') }}" id="myForm" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value = {{ $property->id }}>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Property Name</label>
                                        <span class="text-danger"> * </span>
                                        <input type="text" name="property_name" class="form-control" value="{{ $property->property_name }}" placeholder="Enter Property Name">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Property Status</label>
                                        <span class="text-danger"> * </span>
                                        <select name="property_status" id="exampleFormControlSelect1" class="form-select">
                                            <option selected="" disabled="">-- Select Status --</option>
                                            <option value="rent" {{ $property->property_status == 'rent' ? 'selected' : '' }}>For Rent</option>
                                            <option value="buy" {{ $property->property_status == 'buy' ? 'selected' : '' }}>For Buy</option>
                                        </select>
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Lowest Price</label>
                                        <span class="text-danger"> * </span>
                                        <input type="text" name="lowest_price" class="form-control"  value="{{ $property->lowest_price }}"placeholder="Lowest Price of Property">
                                    </div>
                                </div><!-- Col -->  
                                
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Maximum Price</label>
                                        <span class="text-danger"> * </span>
                                        <input type="text" name="max_price" class="form-control"  value="{{ $property->max_price }}"placeholder="Maximum Price of  Property">
                                    </div>
                                </div>

                            </div><!-- Row -->


                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">No. of Bedrooms</label>
                                        <input type="text" name="bedrooms" class="form-control"  value="{{ $property->bedrooms }}"placeholder="Number of Bathrooms">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">No. of Bathrooms</label>
                                        <input type="text" name="bathrooms" class="form-control"  value="{{ $property->bathrooms }}"placeholder="Number of Bathrooms">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">No. of Garage</label>
                                        <input type="text" name="garage" class="form-control"  value="{{ $property->garage }}"placeholder="Number of Garage">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Garage Size</label>
                                        <input type="text" name="garage_size" class="form-control"  value="{{ $property->garage_size }}"placeholder="Size of Garage">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            
                            
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Address</label>
                                        <input type="text" name="address" class="form-control"  value="{{ $property->address }}"placeholder="Adress Name">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">City</label>
                                        <input type="text" name="city" class="form-control" value="{{ $property->city }}" placeholder="Name of City">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">State</label>
                                        <input type="text" name="state" class="form-control"  value="{{ $property->state }}"placeholder="Name of State">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Postal Code</label>
                                        <input type="text" name="postal_code" class="form-control"  value="{{ $property->postal_code }}"placeholder="Postal Code">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Property Size</label>
                                        <input type="text" name="property_size" class="form-control"  value="{{ $property->property_size }}"placeholder="Size of The Property">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Property Video</label>
                                        <input type="text" name="property_video" class="form-control"  value="{{ $property->property_video }}"placeholder="Link to the Video(Youtbe, Vimeo)">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Neighborhood</label>
                                        <input type="text" name="neighborhood" class="form-control"  value="{{ $property->neighborhood }}"placeholder="Near By Neighborhood">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Latitude</label>
                                        <input type="text" name="latitude" class="form-control"  value="{{ $property->latitude }}"placeholder="Enter the Latitude for the map">
                                        <a href="https://www.latlong.net/" target="_blank">Get Your latitude of your address from here</a>
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Longitude</label>
                                        <input type="text" name="longitude" class="form-control"  value="{{ $property->longitude }}"placeholder="Enter The Longitude for the map">
                                        <a href="https://www.latlong.net/" target="_blank">Get Your longitude of your address from here</a>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Property Type</label>
                                        <span class="text-danger"> * </span>
                                        <select name="ptype_id" id="exampleFormControlSelect1" class="form-select">
                                            <option selected="" disabled="">-- Select Propery Type --</option>
                                            @foreach ($propertyType as $ptype)
                                                <option value="{{ $ptype->id}}" {{ $ptype->id == $property->ptype_id ? 'selected' : '' }}> {{ $ptype->type_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Property Amenities</label>
                                        <select name="amenities_id[]" class="js-example-basic-multiple form-select" multiple="multiple" data-width="100%">
                                            @foreach ($amenities as $ameni)
                                                <option value="{{ $ameni->id }}" {{ (in_array($ameni->id, $property_ami)) ? 'selected' : '' }}> {{ $ameni->amenities_name  }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Agent</label>
                                        <select name="agent" id="exampleFormControlSelect1" class="form-select">
                                            <option selected="" disabled="">-- Select Agent --</option>
                                            @foreach ($activeAgent as $agent)
                                                <option value="{{ $agent->id}}" {{ $agent->id == $property->agent_id  ? 'selected' : '' }}> {{ $agent->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->

                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label">Short Description</label>
                                    <textarea name="short_descp" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $property->short_descp }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label">Long Description</label>
                                    <textarea name="long_descp" class="form-control" name="tinymce" id="tinymceExample" rows="10">{!! $property->long_descp !!}</textarea>
                                </div>
                            </div>
                            
                            <hr>

                            <div class="mb-3">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="checkFeatured">Featured Property
                                        <input type="checkbox" name="featured" value="1" class="form-check-input" id="checkFeatured" {{ $property->featured == '1' ? 'checked' : '' }}>
                                    </label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="checkHot">Hot Property
                                        <input type="checkbox" name="hot" value="1" class="form-check-input" id="checkHot" {{ $property->hot == '1' ? 'checked' : '' }}>
                                    </label>
                                </div>
                            </div>

                
                         <button type="submit" class="btn btn-primary my-4">Save Changes</button>
                        </form>
                </div>
            </div>
        </div>
        </div>
    </div>

</div>
    


   <!--  /// Property Main Thambnail Image Update //// -->

   <div class="page-content" style="margin-top: -35px;" > 

    <div class="row profile-body"> 
      <div class="col-md-12 col-xl-12 middle-wrapper">
        <div class="row">

   <div class="card">
<div class="card-body">
    <h6 class="card-title">Edit Main Thumbnail Image </h6>


        <form method="post" action="{{ route('update.property.thumbnail') }}" id="myForm" enctype="multipart/form-data">
            @csrf

        <input type="hidden" name="id" value="{{ $property->id }}">
        <input type="hidden" name="old_img" value="{{ $property->property_thumbnail }}" >

        <div class="row mb-3">
            <div class="form-group col-md-6">
                <label class="form-label">Main Thumbnail </label>
                <input type="file" name="property_thumbnail" id="imageUpload" class="form-control" onChange="mainThamUrl(this)" accept="image/*" >

                <img src="" id="mainThmb">

            </div>


           <div class="form-group col-md-6">
            <label class="form-label">  </label> 
            <img src="{{ asset($property->property_thumbnail) }}" style="width:100px; height:100px;">
        </div>
    </div><!-- Col -->

<button type="submit" class="btn btn-primary">Save Changes </button>


        </form> 
    </div>
      </div>

    </div>
</div>
</div>
</div> 
<!--    /// End  Property Main Thambnail Image Update //// -->



<!--  /// Start of Property Multi Image Update //// -->

   <div class="page-content" style="margin-top: -35px;" > 

    <div class="row profile-body"> 
      <div class="col-md-12 col-xl-12 middle-wrapper">
        <div class="row">

            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Edit Multi-Image </h6>


                    <form method="post" action="{{ route('update.property.multiimage') }}" id="myForm" enctype="multipart/form-data">
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Image</th>
                                        <th>Change Image</th>
                                        <th>Update / Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($multiImage as $key => $img)
                                    <tr>
                                        <td>{{ $key+1 }}</td>

                                        <td class="py-1">
                                            <img src="{{ asset($img->photo_name) }}" alt="image" style="width: 65px; height: 65px;">
                                        </td>

                                        <td>

                                            <input type="file" class="form-control text-success" id="imageUpload" name="multi_img[{{ $img->id }}]" accept="image/*">
                                        </td>
                                        <td>
                                            <input type="submit" class="btn btn-primary px-4 btn-sm" value="Update Image">

                                            <a href="{{ route('property.multiimage.delete', $img->id) }}" class="btn btn-danger btn-xs" id="delete">Delete Image</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


        </form> 
    </div>
      </div>

    </div>
</div>
</div>
</div> 
<!--  /// End of Property Multi Image Update //// -->

 
<script type="text/javascript">
    function mainThamUrl(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e){
                $('#mainThmb').attr('src', e.target.result).width(111).height(111);
            };
            reader.readAsDataURL(input.files[0]);
        };
    };
</script>

<script>
    $(document).ready(function() {
      $('#imageUpload').on('change', function() {
        const fileInput = $(this);
        const file = fileInput[0].files[0];
        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

        if (file && allowedTypes.indexOf(file.type) === -1) {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please select a valid image file (JPEG, PNG, GIF).',
          });
          fileInput.val('');
          location.reload();
        }
      });
    });
</script>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                property_name: {
                    required : true,
                },
                property_status: {
                    required : true,
                }, 
                lowest_price: {
                    required : true,
                }, 
                max_price: {
                    required : true,
                }, 
                property_thumbnail: {
                    required : true,
                }, 
                multi_image: {
                    required : true,
                },
                ptype_id: {
                    required : true,
                },
                
            },
            messages :{
                property_name: {
                    required : 'The property name field is required. ',
                }, 
                property_status: {
                    required : 'Please Select Status of the Property. ',
                }, 
                lowest_price: {
                    required : 'The lowest price of property field is required. ',
                }, 
                max_price: {
                    required : 'The maximum price of the property field is required. ',
                }, 
                property_thumbnail: {
                    required : 'Thumbanil Image is required. ',
                },
                multi_image: {
                    required : 'Please select at least one image.',
                },
                ptype_id: {
                    required : 'Please select Property Type.',
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

<script type="text/javascript">
    function mainThumbnailUrl(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e){
                $('#mainThmb').attr('src', e.target.result).width(111).height(111);
            };
            reader.readAsDataURL(input.files[0]);
        };
    };
</script>

<script> 
 
    $(document).ready(function(){
     $('#multiImg').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            var data = $(this)[0].files; //this file data
             
            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                    .height(80); //create image element 
                        $('#preview_img').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });
             
        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
     });
    });
     
    </script>

@endsection