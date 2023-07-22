<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PropertyType;
use App\Models\Amenities;

class PropertyTypeController extends Controller
{

    /** Statr of AllType Method 
     * Gets the latest data from DB and Pass it on view and returns the view.
    */
    public function AllType()
    {
        $types = PropertyType::latest()->get();
        return view('backend.type.all_type', compact('types'));
    }
    /** End of AllType Method*/

    
    /** Start of AddType Method
     * Returns the View for storing the data.
    */
    public function AddType()
    {
        return view('backend.type.add_type');
    }
    /** End of AddType Method*/

    
    /** Start of StoreType Method 
     * checks for validation and store the data into db.
    */
    public function StoreType(Request $request)
    {
        // Validation and check valid inputs.
        $request->validate([
            'type_name' => 'required|unique:property_types|max:200',
            'type_icon' => 'required',
        ]);

        // Inserting into Database 
        PropertyType::insert([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon
        ]);

        // Toaster Notification
        $notification = array([
            'message'    => 'Property Type Created Sucessfully !',
            'alert-type' => 'success'
        ]);

        return redirect()->route('all.type')->with($notification);
    }
    /** End of StoreType Method*/


    /** Start of EditType Method
     * Gets the id from view and pass and find the details of that id and return view
    */
    public function EditType($id)
    {
        $types = PropertyType::findOrFail($id);

        return view('backend.type.edit_type', compact('types'));
    }
    /** End of EditType Method*/


    /** Start of UpdateType Method 
     * Checks for the validation and Updates the data db and redirects with success message.
    */
    public function UpdateType(Request $request)
    {
         // Validation and check valid inputs.
         $request->validate([
            'type_name' => 'required|unique:property_types|max:200',
            'type_icon' => 'required',
        ]);

        $pid = $request->id; //Set as hiddent field and passing it to update the data of specific users

        // Inserting into Database 
        PropertyType::findOrFail($pid)->update([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon
        ]);

        // Toaster Notification
        $notification = array([
            'message'    => 'Property Type Updated Sucessfully !',
            'alert-type' => 'success'
        ]);

        return redirect()->route('all.type')->with($notification);

    }
    /** End of UpdateType Method*/


    /** Start of DeleteType Method. 
     * Deletes the the data from database which is been passed or specific user id data.
     * And Send Toaster Notification of Sucessfully Delete.
    */
    public function DeleteType($id)
    {
        PropertyType::findorFail($id)->delete();

        // Toaster Notification
        $notification = array([
            'message'    => 'Property Type Deleted Sucessfully !',
            'alert-type' => 'success'
        ]);

        return redirect()->back()->with($notification);
    }
    /** End of DeleteType Method. */

/***********************End of Property Type Methods Here******************************************************/




/*********************** Amenities Type All Methods Here ******************************************************/

    /** Start of AllAmenities Method 
     * Gets the desc or latest data from DB and retuns the simple view.
    */
    public function AllAmenities()
    {
        $amenities = Amenities::latest()->get();
        return view('backend.amenities.all_amenities', compact('amenities'));
    }
    /** End of AllAmenities Method*/


    /** Start of AddAmenities Method
     * Returns the View for storing the data.
    */
    public function AddAmenities()
    {
        return view('backend.amenities.add_amenities');
    }
    /** End of AddAmenities Method*/

        /** Start of StoreType Method 
     * checks for validation and store the data into db.
    */
    public function StoreAmenities(Request $request)
    {
        // Validation and check valid inputs.
        $request->validate([
            'amenities_name' => 'required|max:200',
        ]);

        // Inserting into Database 
        Amenities::insert([
            'amenities_name' => $request->amenities_name,
        ]);

        // Toaster Notification
        $notification = array([
            'message'    => 'Amenities Created Sucessfully !',
            'alert-type' => 'success'
        ]);

        return redirect()->route('all.amenities')->with($notification);
    }
    /** End of StoreType Method*/


    /** Start of EditAmenities Method
     * Gets the id from view and pass and find the details of that id and return view
    */
    public function EditAmenities($id)
    {

        $amenities = Amenities::findOrFail($id);

        return view('backend.amenities.edit_amenities', compact('amenities'));
    }
    /** End of EditAmenities Method*/


    /** Start of UpdateAmenities Method 
     * Checks for the validation and Updates the data db and redirects with success message.
    */
    public function UpdateAmenities(Request $request)
    {
        // dd($request->id, $request->amenities_name);
        // dd($request);
         // Validation and check valid inputs.
         $request->validate([
            'amenities_name' => 'required|max:200',
        ]);

        $ame_id = $request->id; //Set as hiddent field and passing it to update the data of specific users

        // Inserting into Database 
        Amenities::findOrFail($ame_id)->update([
            'amenities_name' => $request->amenities_name,
        ]);
        // Toaster Notification
        $notification = array([
            'message'    => 'Amenities Updated Sucessfully !',
            'alert-type' => 'success'
        ]);

        return redirect()->route('all.amenities')->with($notification);

    }
    /** End of UpdateAmenities Method*/

    
    /** Start of DeleteAmenities Method. 
     * Deletes the the data from database which is been passed or specific user id data.
     * And Send Toaster Notification of Sucessfully Delete.
    */
    public function DeleteAmenities($id)
    {
        Amenities::findorFail($id)->delete();

        // Toaster Notification
        $notification = array([
            'message'    => 'Amenities Deleted Sucessfully !',
            'alert-type' => 'success'
        ]);

        return redirect()->back()->with($notification);
    }
    /** End of DeleteAmenities Method. */




/*********************** End of Amenities Type Methods Here ******************************************************/

}
