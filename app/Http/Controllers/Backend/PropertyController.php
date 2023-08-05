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
use PHPUnit\Framework\Constraint\Count;
use App\Models\PackagePlan;
use Barryvdh\DomPDF\Facade\Pdf;

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


    /** Start of EditProperty Method 
     * Puts the value into the field and return the view
    */
    public function EditProperty($id)
    {
        $facility       = Facility::where('property_id', $id)->get();

        $property       = Property::findorfail($id);

        $type           = $property->amenities_id;
        $property_ami   = explode(',', $type);
        
        $multiImage     = MultiImage::where('property_id', $id)->get();
        

        $propertyType   = PropertyType::latest()->get(); 
        $amenities      = Amenities::latest()->get(); 
        $activeAgent    = User::where('status', 'active')->where('role', 'agent')->latest()->get();

        return view ('backend.property.edit_property', compact('property', 'propertyType','amenities', 'activeAgent', 'property_ami', 'multiImage', 'facility'));

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


    /** Start of StoreNewMultiimage Method 
     * While editing the Image it simply adds more if users wants to add into multi Image portion
    */
    public function StoreNewMultiimage(Request $request)
    {
            $new_multi_img_id = $request->imageid;
            // dd('test');
            $image = $request->file('multi_img');

            $make_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(770,520)->save('upload/property/multi-image/'.$make_name);
            $uploadPath = 'upload/property/multi-image/'.$make_name;

            MultiImage::insert([
                'property_id' => $new_multi_img_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),
            ]);

            $notification = [
                'message' => 'Porperty Multi Image Added Successfully !',
                'alert-type' => 'success'
            ];

            return redirect()->back()->with($notification);

    }
    /** End of StoreNewMultiimage Method */



    /** Start of UpdatePropertyFacilities Method 
     * Updates the Facilities Field and Save it into DataBase.
    */
    public function UpdatePropertyFacilities(Request $request)
    {
        $pid = $request->id;

        if($request->facility_name == NULL)
        {
            return redirect()->back();
        }
        else
        {
            Facility::where('property_id', $pid)->delete();

            $facilities = Count($request->facility_name);
            
                for ($i=0; $i < $facilities; $i++) { 
                    $fcount                 = new Facility();
                    $fcount->property_id    = $pid;
                    $fcount->facility_name  = $request->facility_name[$i];
                    $fcount->distance       = $request->distance[$i];
                    $fcount->save();
                }//end for  
        }

        $notification = [
            'message' => 'Property Facility Updated Successfully !',
            'alert-type'=> 'success',
        ];

        return redirect()->back()->with($notification);
    }
    /** End of UpdatePropertyFacilities Method. */


    /** Start of DeleteProperty Method. 
     * Deletes the data from all tables.
     * Facilities,Properties, Multiimages(all fields related Id)
    */
    public function DeleteProperty($id)
    {
        //For porperties table.
        // For Thumbnail Image
        $property = Property::findorFail($id);
        unlink($property->property_thumbnail);

        Property::findorFail($id)->delete();

        // For multi_images table
        $multi_images = MultiImage::where('property_id', $id)->get();

        foreach($multi_images as $img)
        {
            unlink($img->photo_name);
            MultiImage::where('property_id', $id)->delete();
        }

        //For facilities table
        $facilitiesData = Facility::where('property_id', $id)->get();
        foreach($facilitiesData as $data)
        {
            $data->facility_name;
            Facility::where('property_id', $id)->delete();
        }

        $notification = [
            'message' => "Property Data Delete Successfully !",
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }
    /** End of DeleteProperty Method. */


    /** Start of DetailsProperty Method. 
     * Gets the requested id details and returns to the User.
    */
    public function DetailsProperty($id)
    {

        $facilities = Facility::where('property_id',$id)->get();
        $property = Property::findOrFail($id);

        $type = $property->amenities_id;
        $property_ami = explode(',', $type);

        $multiImage = MultiImage::where('property_id',$id)->get();

        $propertytype = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = User::where('status','active')->where('role','agent')->latest()->get();

        return view('backend.property.details_property',compact('property','propertytype','amenities','activeAgent','property_ami','multiImage','facilities'));

    }

    /** End of DetailsProperty Method. */



    /** Start of InactiveProperty Method. 
     * Makes the product inactive if it's active.
    */
    public function InactiveProperty(Request $request)
    {
        $pid = $request->id;

        Property::findOrFail($pid)->update([
            'status' => 0,
        ]);
        
        $notification    = array(
            'message'    => 'Property Made Inactive Successfully !',
            'alert-type' => 'success',
        );

        return redirect()->route('all.property')->with($notification);

    }
    /** End of InactiveProperty Method. */


    /** Start of ActiveProperty Method. 
     * Makes the Product incase of inactive to active.
    */
    public function ActiveProperty(Request $request){

        $pid = $request->id;
        Property::findOrFail($pid)->update([

            'status' => 1,

        ]);

      $notification = array(
            'message' => 'Property made Active Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.property')->with($notification); 


    }
    /** End of InactiveProperty Method. */

    
    /** Start of AdminPackageHistory Method. 
     *  Views the packages history of all Agents.
    */
    public function AdminPackageHistory()
    {
        
        $packagehistory = PackagePlan::latest()->get();
        
        return view('backend.package.package_history', compact('packagehistory'));

    }
    /** End of AdminPackageHistory Method. */


    /** Start of PackageInvoice Method. 
     * Downloads the Invoice of Selected Agents
    */
    
    public function PackageInvoice($id){

        $packagehistory = PackagePlan::where('id',$id)->first();

        $pdf = Pdf::loadView('backend.package.package_history_invoice', compact('packagehistory'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');

    }
    /** End of PackageInvoice Method. */






}
