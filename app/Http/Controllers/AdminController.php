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
        
        $notification = array(
            'message' => 'Admin Logout Sucessfully!',
            'alert-type' => 'success'
        );

        return redirect('/admin/login')->with($notification);
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
     * Saves The specific Logged In User data and return redirect with toaster message .
    */
    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id); 
        
        // Define the validation rules for the input fields
        $rules = [
            'username' => 'required|string|max:255|unique:users,username,' . $id . '|regex:/^\S*$/',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        // Define custom error messages
        $messages = [
            'username.regex' => 'The username must not contain spaces.',
        ];

        // Run the validation
        $validator = Validator::make($request->all(), $rules, $messages);

        // Check if the validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
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
    

    /** Start of AllAgent  Method 
     * Returns the list of all agents name and details.
    */
    public function AllAgent()
    {
        $allagent = User::where('role', 'agent')->get();

        return view('backend.agentuser.all_agent', compact('allagent'));
    }
    /** End of AllAgent  Method */



    /** Start of AddAgent  Method 
     * Returns the view to add the agents page
    */
    public function AddAgent()
    {

        return view('backend.agentuser.add_agent');
    }
    /** End of AddAgent  Method */


    /** Start of StoreAgent  Method 
     * Store the data into DB and save it.
    */

    public function StoreAgent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|unique:users,username',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'password' => 'required|string|min:6',
        ]);
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role' => 'agent',
            'status' => 'active', 
        ]);
    
        $notification = array(
            'message' => 'Agent Created Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->route('all.agent')->with($notification);
    }  
    /** End of StoreAgent  Method */


    /** Start of EditAgent Method 
     * Returns the veiw to edit the Page
    */
    public function EditAgent($id){

        $allagent = User::findOrFail($id);
        return view('backend.agentuser.edit_agent',compact('allagent'));
    
      }
    /** End of EditAgent Method */



    /** Start of UpdateAgent Method 
     * Store and Update the edited user data.
    */
    public function UpdateAgent(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'id' => 'required|exists:users,id', // Check if the user with the given ID exists
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $request->id, // Allow the current email if it's unchanged
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:500', // Address is optional, but if provided, it should be a string with max 500 characters
        ]);
    
        $user_id = $request->id;
    
        // Find the user by ID or throw a 404 error if not found
        $user = User::findOrFail($user_id);
    
        // Update the user data
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
    
        $notification = [
            'message' => 'Agent Updated Successfully',
            'alert-type' => 'success'
        ];
    
        return redirect()->route('all.agent')->with($notification);
    }    
    /** End of UpdateAgent Method */



    /** Start of DeleteAgent  Method 
     * Deletes the Desired or selected Users data from DB.
     * and send toaster notification of success.
    */
    public function DeleteAgent($id){

        User::findOrFail($id)->delete();

        $notification = array(
                'message' => 'Agent Deleted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification); 

    }
    /** End of DeleteAgent  Method */



    /** Start of changeStatus Method 
     * Changes the user status active to inactive and passed data via JSON AJAX.
    */
    public function changeStatus(Request $request)
    {
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['success'=> 'Status Changed Successfully !']);
    }
    /** End of changeStatus Method */



}
