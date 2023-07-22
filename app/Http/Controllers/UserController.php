<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /** Start of index Method. 
     * Returns the view for universal/User page.
    */
    public function index()
    {
        return view('frontend.index');
    }
    /** End of index Method. */

    /** Start of UserProfile Method.
     *  Returns the view of Proifle Page(gets the data of logged in user from db) .
     */
    public function UserProfile()
    {
        $id       = Auth::user()->id;
        $userData = User::find($id);

        return view('frontend.dashboard.edit_profile', compact('userData'));
    }
     /** End of UserProfile Method. */


     
    /** Start of UserProfileStore Method 
     * This method Store the data passed from form and save it into Database.
     * Saves The specific Logged In User data and return redirect with toaster message .
    */
    public function UserProfileStore(Request $request)
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
            @unlink(public_path('upload/user_images/'.$data->photo));

            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();
        
        $notification = array(
            'message'    => 'User Profile Update Sucessfully !',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
     /** End of UserProfileStore Method. */

     
     /** Start of UserLogout Method
      * Logs the User out and kill or delete the session data.
      */
      public function UserLogout(Request $request)
      {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User Logout Sucessfully!',
            'alert-type' => 'success'
        );
        return redirect('/login')->with($notification);
      }
      /** End of UserLogout Method */

      
      /** Start of UserChangePassword Method 
       * Returns the View for Chnage Password.
      */
      public function UserChangePassword()
      {
        return view('frontend.dashboard.change_password');
      }
      /** End of UserChangePassword Method */

      
    /** Start of UserUpdatePassword  Method 
     * Validates the Field, check for the valid input
     * and Updates the field from DB. 
    */
    public function UserUpdatePassword(Request $request)
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
    /** End of UserUpdatePassword  Method */

}



