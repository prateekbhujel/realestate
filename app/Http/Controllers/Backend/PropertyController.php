<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\MultiImage;
use App\Models\Facility;
use App\Models\Amenities;
use App\Models\PropertyType;
use App\Models\User;
use Intervention\Image\Facades\Image;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;

class PropertyController extends Controller
{
   
    /** Start of AllProperty Method */
    public function AllProperty()
    {
        $property = Property::latest()->get();

        return view('backend.property.all_property', compact('property'));
    }
    /** End of AllProperty Method */


     /** Start of AddProperty Method
      * Returns The data from PropertyTYpe, Amenities, User Models fro (agents,proeprty type and amenties data)
     * Returns the View for storing the data.
    */
    public function AddProperty()
    {
        $propertyType = PropertyType::latest()->get(); 
        $amenities = Amenities::latest()->get(); 
        $activeAgent = User::where('status', 'active')->where('role', 'agent')->latest()->get();

        return view('backend.property.add_property', compact('propertyType', 'amenities', 'activeAgent'));
    }
    /** End of AddProperty Method*/


    /** Start of StoreProperty Method
     * checks the data and save it into DB.
     * Saves The data into Three Table (properties, multi-image,facilities).
     * Use Image Intervention to Resize the Image.
    */
    public function storeProperty(Request $request)
    {
        // Implode or separate and get the data.
        // Amenities before saving as it is multiple select
        $amen = $request->amenities_id;
        $amenities = implode(",", $amen);
    
        $pcode = IDGenerator::generate(['table' => 'properties', 'field'=>'property_code', 'length'=> 5, 'prefix'=>'PC']);
        
        $image = $request->file('property_thumbnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 250)->save('upload/property/thumbnail/' . $name_gen);
        $save_url = 'upload/property/thumbnail/'.$name_gen;
    
        // Insert property data and get the inserted property_id
        $property = Property::create([
            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenities,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_slug)),
            'property_code' => $pcode,
            'property_status' => $request->property_status,
            'lowest_price' => $request->lowest_price,
            'max_price' => $request->max_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
            'garage_size' => $request->garage_size,
            'property_size' => $request->property_size,
            'property_video' => $request->property_video,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'featured' => $request->featured,
            'hot' => $request->hot,
            'agent_id' => $request->agent,
            'status' => 1,
            'property_thumbnail' => $save_url,
            'created_at' => Carbon::now(),
        ]);
    
        $property_id = $property->getKey(); // Get the primary key value (ID) of the inserted property
    
                /// Multiple Image Upload From Here ////

                $images = $request->file('multi_img');
                foreach($images as $img){
                    
                    $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
                    Image::make($img)->resize(770,520)->save('upload/property/multi-image/'.$make_name);
                    $uploadPath = 'upload/property/multi-image/'.$make_name;
                    
                    // dd($uploadPath);
                MultiImage::insert([
        
                    'property_id' => $property_id,
                    'photo_name' => $uploadPath,
                    'created_at' => Carbon::now(), 
        
                ]); 
                } // End Foreach
        
                 /// End Multiple Image Upload From Here ////
        
                    /// Facilities Add From Here ////
        
                    $facilities = Count($request->facility_name);
        
                    if ($facilities != null) {
                        for ($i=0; $i < $facilities; $i++) { 
                            $fcount = new Facility();
                            $fcount->property_id  = $property_id;
                            $fcount->facility_name = $request->facility_name[$i];
                            $fcount->distance = $request->distance[$i];
                            $fcount->save();
                        }
                    }
        
                    /// End Facilities  ////
        
        
                    $notification = array(
                    'message' => 'Property Inserted Successfully',
                    'alert-type' => 'success'
                    );
        
                return redirect()->route('all.property')->with($notification);
    }
    /** End of StoreProperty Method*/


    /** End of EditProperty Method 
     * Puts the value into the field and return the view
    */
    public function EditProperty($id)
    {
        $property = Property::findorfail($id);

        $type           = $property->amenities_id;
        $property_ami   = explode(',', $type);
        
        $multiImage     = MultiImage::where('property_id', $id)->get();
        

        $propertyType   = PropertyType::latest()->get(); 
        $amenities      = Amenities::latest()->get(); 
        $activeAgent    = User::where('status', 'active')->where('role', 'agent')->latest()->get();

        return view ('backend.property.edit_property', compact('property', 'propertyType','amenities', 'activeAgent', 'property_ami', 'multiImage'));

    }
    /** End of EditProperty Method*/


    /** Start of UpdateProperty Method 
     *  Updates the data from the filed got from edit file and saves changes to db.
    */
    public function UpdateProperty(Request $request)
    {

        $amen = $request->amenities_id;
        $amenites = implode(",", $amen);
        // dd($request);

        $property_id = $request->id;

        Property::findOrFail($property_id)->update([

            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenites,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)), 
            'property_status' => $request->property_status,

            'lowest_price' => $request->lowest_price,
            'max_price' => $request->max_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
            'garage_size' => $request->garage_size,

            'property_size' => $request->property_size,
            'property_video' => $request->property_video,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,

            'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'featured' => $request->featured,
            'hot' => $request->hot,
            'agent_id' => $request->agent, 
            'updated_at' => Carbon::now(), 

        ]);

         $notification = array(
            'message' => 'Property Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.property')->with($notification);

    }
    /** End of UpdateProperty Method*/


    /** End of UpdatePropertyThumbnail Method*/
    public function UpdatePropertyThumbnail(Request $request)
    {
        $pro_id = $request->id;
        $oldImage = $request->old_img;

        $image = $request->file('property_thumbnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 250)->save('upload/property/thumbnail/' . $name_gen);
        $save_url = 'upload/property/thumbnail/'.$name_gen;

        if(file_exists($oldImage))
        {
            unlink($oldImage);
        }

        Property::findorFail($pro_id)->update([
            'property_thumbnail' => $save_url,
            'updated_at'         => Carbon::now()
        ]);

        $notification = array(
            'message'    => 'Property Image Thumbnail Update Successfully !', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }
    /** End of UpdatePropertyThumbnail Method */

    
    /** End of UpdatePropertyMultiimage Method 
     * takes the image of logged in users and updates the Images.
    */
    public function UpdatePropertyMultiimage(Request $request)
    {
            $imgs = $request->multi_img;

            foreach ($imgs as $id => $img) 
            {
                $imgdel = MultiImage::findorFail($id);
                unlink($imgdel->photo_name);

                $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
                Image::make($img)->resize(770,520)->save('upload/property/multi-image/'.$make_name);
                $uploadPath = 'upload/property/multi-image/'.$make_name;

                MultiImage::where('id', $id)->update([
                    'photo_name' => $uploadPath,
                    'updated_at' => Carbon::now(),
                ]);

                $notification = [
                    'message'       => 'Multi Image been Updated Sucessfully !',
                    'alert-type'    => 'success',
                ];

                return redirect()->back()->with($notification);
            }
    }
    /** End of UpdatePropertyMultiimage Method */


/** End of PropertyMultiimageDelete Method 
 * Gets the id of specific users image and deletes the logged in user selected or images.
*/
public function PropertyMultiimageDelete($id)
{
    $oldImage = MultiImage::findorFail($id);
    unlink($oldImage->photo_name);

    MultiImage::findorFail($id)->delete();

    $notification = [
        'message'    => 'Property Multi Images is been deleted Sucessfully !',
        'alert-type' => 'success'
    ];

    return redirect()->back()->with($notification);

}
/** End of PropertyMultiimageDelete Method */
}
