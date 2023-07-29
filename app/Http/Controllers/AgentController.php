<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\support\Facades\Auth;
use Illuminate\support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illumintae\View\View;


class AgentController extends Controller
{
       /** Start of AgentDashboard method. 
     * Code Relate to the Agent Dashboard and its associate returns the simple view of Dashboard
    */
    public function AgentController()
    {
        return view('agent.index');
    }
     /** End of AgentDashboard method. */


     /** start of AgentLogin method. 
      * Returns the view to login page for Agent[User::Role]
     */
     public function AgentLogin()
     {
      return view('agent.agent_login');
     }
     /** End of AgentLogin method. */



     /** Start of AgentRegister method. 
      * Register an Agent into the DataBase.
     */
     public function AgentRegister(Request $request)
     {
      
      $user = User::create([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'phone' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'agent',
        'status' => 'inactive',
      ]);

      event(new Registered($user));

      Auth::login($user);

      return redirect(RouteServiceProvider::AGENT);

     }
     /** End of AgentRegister method. */


     /** Start of AgentLogout method. 
      * Logs the user out from the session and sends toaster message.
      * Destroy the session.
     */
     public function AgentLogout(Request $request){
      Auth::guard('web')->logout();

      $request->session()->invalidate();

      $request->session()->regenerateToken();

       $notification = array(
          'message' => 'Agent Logout Successfully',
          'alert-type' => 'success'
      ); 

      return redirect('/agent/login')->with($notification);
  }
     /** End of AgentRegister method. */


     /** Start of AgentProfile method. 
      * Returns the view to the Profile Update.
     */
    public function AgentProfile(){

      $id = Auth::user()->id;
      $profileData = User::find($id);
      return view('agent.agent_profile',compact('profileData'));

   }
     /** End of AgentProfile method. */



     /** Start of AgentProfileStore method. 
      * Store the Image and Data to db and file.
     */
    public function AgentProfileStore(Request $request){

      $id = Auth::user()->id;
      $data = User::find($id);
      $data->username = $request->username;
      $data->name = $request->name;
      $data->email = $request->email;
      $data->phone = $request->phone;
      $data->address = $request->address; 

      if ($request->file('photo')) {
          $file = $request->file('photo');
          @unlink(public_path('upload/agent_images/'.$data->photo));
          $filename = date('YmdHi').$file->getClientOriginalName(); 
          $file->move(public_path('upload/agent_images'),$filename);
          $data['photo'] = $filename;  
      }

      $data->save();

      $notification = array(
          'message' => 'Agent Profile Updated Successfully',
          'alert-type' => 'success'
      );

      return redirect()->back()->with($notification);

   }
     /** End of AgentProfileStore method. */



     /** Start of AgentChangePassword method. 
      * Returns the view for password Change
     */
      public function AgentChangePassword(){
     
             $id = Auth::user()->id;
             $profileData = User::find($id);
             return view('agent.agent_change_password',compact('profileData'));
     
          }
      /** End of AgentChangePassword method. */
 
     
    
    /** Start of AgentUpdatePassword method. */
    public function AgentUpdatePassword(Request $request){

      // Validation 
      $request->validate([
          'old_password' => 'required',
          'new_password' => 'required|confirmed'

      ]);

      /// Match The Old Password

      if (!Hash::check($request->old_password, auth::user()->password)) {

        $notification = array(
          'message' => 'Old Password Does not Match!',
          'alert-type' => 'error'
      );

      return back()->with($notification);
      }

      /// Update The New Password 

      User::whereId(auth()->user()->id)->update([
          'password' => Hash::make($request->new_password)

      ]);

      $notification = array(
          'message' => 'Password Change Successfully',
          'alert-type' => 'success'
      );

      return back()->with($notification); 

  }
  /** End of AgentUpdatePassword method. */

}
