<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /** Start of AdminDashboard Method 
     * Code Relate to the Admin Dashboard and its associate returns the simple view of Dashboard
    */
    public function AdminDashboard()
    {
        return view('admin.index');
    }
    /** End of AdminDashboard Method */


    /** Start of AdminLogout Method
     * It Logs the User out and destroy an authenticated session.
    */
    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
    /** End of AdminLogout Method*/
    
    
    /**Start of AdminLogin Method 
     * returns the view of Admin Login Page 
    */
    public function AdminLogin()
    {
        return view('admin.admin_login');
    }
    /** End of Method*/


    /** Start of AdminProfile Method 
     * Displays the details about the users from Database.
    */
    public function AdminProfile()
    {

        $id = Auth::user()->id;  
        $profileData = User::find($id); 
       
        return view('admin.admin_profile_view', compact('profileData'));
    }
    /** End of AdminProfile Method */


    /** Start of AdminProfileStore Method 
     * This method Store the data passed from form and save it into Database.
     * Saves The specific Logged In User data.
    */
    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id); 

        $data->username = $request->username;
        $data->name     = $request->name;
        $data->email    = $request->email;
        $data->phone    = $request->phone;
        $data->address  = $request->address;

        if($request->file('photo')){
            
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));

            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();
        
        $notification = array(
            'message'    => 'Admin Profile Update Sucessfully !',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    /** End of AdminProfileStore Method */


    /** Start of AdminChangePassword  Method 
     * Gets the data and display the veiw only.
    */
    public function AdminChangePassword()
    {
        $id = Auth::user()->id;  
        $profileData = User::find($id); 

        return view('admin.admin_change_password', compact('profileData'));
    }
    /** End of AdminChangePassword  Method */

    
    /** Start of AdminUpdatePassword  Method 
     * Validates the Field, check for the valid input
     * and Updates the field from DB. 
    */
    public function AdminUpdatePassword(Request $request)
    {
        //Validation part
        $request->validate([
            'old_password' => 'required',
            'new_password'  => 'required|confirmed'
        ]);

        // Match The Old Password.
        if(!Hash::check($request->old_password, auth::user()->password))
        {
            $notification = array(
                'message'    => 'Old Password does not match !',
                'alert-type' => 'error'
            );
    
            return back()->with($notification);
        }

        // Update the New Password.
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message'    => 'Password Changed Sucessfully !',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }
    /** End of AdminUpdatePassword  Method */



}
