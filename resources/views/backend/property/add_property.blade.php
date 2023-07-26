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
                        <form method="POST" action="{{ route('store.property') }}" id="myForm" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Property Name</label>
                                        <span class="text-danger"> * </span>
                                        <input type="text" name="property_name" class="form-control" placeholder="Enter Property Name">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Property Status</label>
                                        <span class="text-danger"> * </span>
                                        <select name="property_status" id="exampleFormControlSelect1" class="form-select">
                                            <option selected="" disabled="">-- Select Status --</option>
                                            <option value="rent">For Rent</option>
                                            <option value="buy">For Buy</option>
                                        </select>
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Lowest Price</label>
                                        <span class="text-danger"> * </span>
                                        <input type="text" name="lowest_price" class="form-control" placeholder="Lowest Price of Property">
                                    </div>
                                </div><!-- Col -->  
                                
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Maximum Price</label>
                                        <span class="text-danger"> * </span>
                                        <input type="text" name="max_price" class="form-control" placeholder="Maximum Price of  Property">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Main Thumbnail Image</label>
                                        <span class="text-danger"> * </span>
                                        <input type="file" name="property_thumbnail" class="form-control imageUpload" onChange="mainThumbnailUrl(this)" accept="image/*">

                                        <img src="" id="mainThmb">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Multiple Image</label>
                                        <span class="text-danger"> * </span>
                                        <p class="text-muted">Press CTRL and select Image</p>
                                        <input type="file" name="multi_img[]" class="form-control imageUpload" id="multiImg" multiple="" accept="image/*">

                                        <div class="row" id="preview_img"></div>
                                    </div>
                                </div><!-- Col -->

                                


                            </div><!-- Row -->


                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">No. of Bedrooms</label>
                                        <input type="text" name="bedrooms" class="form-control" placeholder="Number of Bathrooms">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">No. of Bathrooms</label>
                                        <input type="text" name="bathrooms" class="form-control" placeholder="Number of Bathrooms">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">No. of Garage</label>
                                        <input type="text" name="garage" class="form-control" placeholder="Number of Garage">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Garage Size</label>
                                        <input type="text" name="garage_size" class="form-control" placeholder="Size of Garage">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            
                            
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Address</label>
                                        <input type="text" name="address" class="form-control" placeholder="Adress Name">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">City</label>
                                        <input type="text" name="city" class="form-control" placeholder="Name of City">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">State</label>
                                        <input type="text" name="state" class="form-control" placeholder="Name of State">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Postal Code</label>
                                        <input type="text" name="postal_code" class="form-control" placeholder="Postal Code">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Property Size</label>
                                        <input type="text" name="property_size" class="form-control" placeholder="Size of The Property">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Property Video</label>
                                        <input type="text" name="property_video" class="form-control" placeholder="Link to the Video(Youtbe, Vimeo)">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Neighborhood</label>
                                        <input type="text" name="neighborhood" class="form-control" placeholder="Near By Neighborhood">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            
                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Latitude</label>
                                        <input type="text" name="latitude" class="form-control" placeholder="Enter the Latitude for the map">
                                        <a href="https://www.latlong.net/" target="_blank">Get Your latitude of your address from here</a>
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Longitude</label>
                                        <input type="text" name="longitude" class="form-control" placeholder="Enter The Longitude for the map">
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
                                                <option value="{{ $ptype->id}}"> {{ $ptype->type_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Property Amenities</label>
                                        <select name="amenities_id[]" class="js-example-basic-multiple form-select" multiple="multiple" data-width="100%">
                                            @foreach ($amenities as $ameni)
                                                <option value="{{ $ameni->id }}">{{ $ameni->amenities_name  }}</option>
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
                                                <option value="{{ $agent->id}}"> {{ $agent->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->

                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label">Short Description</label>
                                    <textarea name="short_descp" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label">Long Description</label>
                                    <textarea name="long_descp" class="form-control" name="tinymce" id="tinymceExample" rows="10"></textarea>
                                </div>
                            </div>
                            
                            <hr>

                            <div class="mb-3">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="checkFeatured">Featured Property
                                        <input type="checkbox" name="featured" value="1" class="form-check-input" id="checkFeatured">
                                    </label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="checkHot">Hot Property
                                        <input type="checkbox" name="hot" value="1" class="form-check-input" id="checkHot">
                                    </label>
                                </div>
                            </div>

                            <div class="row add_item">
                                <div class="col-md-4">
                                      <div class="mb-3">
                                            <label for="facility_name" class="form-label">Facilities </label>
                                            <select name="facility_name[]" id="facility_name" class="form-control">
                                                  <option value="">Select Facility</option>
                                                  <option value="Hospital">Hospital</option>
                                                  <option value="SuperMarket">Super Market</option>
                                                  <option value="School">School</option>
                                                  <option value="Entertainment">Entertainment</option>
                                                  <option value="Pharmacy">Pharmacy</option>
                                                  <option value="Airport">Airport</option>
                                                  <option value="Railways">Railways</option>
                                                  <option value="Bus Stop">Bus Stop</option>
                                                  <option value="Beach">Beach</option>
                                                  <option value="Mall">Mall</option>
                                                  <option value="Bank">Bank</option>
                                            </select>
                                      </div>
                                </div>
                                <div class="col-md-4">
                                      <div class="mb-3">
                                            <label for="distance" class="form-label"> Distance </label>
                                            <input type="text" name="distance[]" id="distance" class="form-control" placeholder="Distance (Km)">
                                      </div>
                                </div>
                                <div class="form-group col-md-4" style="padding-top: 30px;">
                                      <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Add More..</a>
                                </div>
                         </div> <!---end row-->
                
                         <button type="submit" class="btn btn-primary my-4">Save Changes</button>
                        </form>
                </div>
            </div>
        </div>
        </div>
    </div>

</div>
    


 <!--========== Start of add multiple class with ajax ==============-->
 <div style="visibility: hidden">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
       <div class="whole_extra_item_delete" id="whole_extra_item_delete">
          <div class="container mt-2">
             <div class="row">
               
                <div class="form-group col-md-4 mb-3">
                   <label for="facility_name">Facilities</label>
                   <select name="facility_name[]" id="facility_name" class="form-control">
                         <option value="">Select Facility</option>
                         <option value="Hospital">Hospital</option>
                         <option value="SuperMarket">Super Market</option>
                         <option value="School">School</option>
                         <option value="Entertainment">Entertainment</option>
                         <option value="Pharmacy">Pharmacy</option>
                         <option value="Airport">Airport</option>
                         <option value="Railways">Railways</option>
                         <option value="Bus Stop">Bus Stop</option>
                         <option value="Beach">Beach</option>
                         <option value="Mall">Mall</option>
                         <option value="Bank">Bank</option>
                   </select>
                </div>
                <div class="form-group col-md-4">
                   <label for="distance">Distance</label>
                   <input type="text" name="distance[]" id="distance" class="form-control" placeholder="Distance (Km)">
                </div>
                <div class="form-group col-md-4" style="padding-top: 20px">
                   <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle">Add</i></span>
                   <span class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle">Remove</i></span>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>      
 
 
 
<!----For Section-------->
 <script type="text/javascript">
    $(document).ready(function(){
       var counter = 0;
       $(document).on("click",".addeventmore",function(){
             var whole_extra_item_add = $("#whole_extra_item_add").html();
             $(this).closest(".add_item").append(whole_extra_item_add);
             counter++;
       });
       $(document).on("click",".removeeventmore",function(event){
             $(this).closest("#whole_extra_item_delete").remove();
             counter -= 1
       });
    });
 </script>
 <!--========== End of add multiple class with ajax ==============-->

 
 
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
<script>
    $(document).ready(function() {
      $('.imageUpload').on('change', function() {
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