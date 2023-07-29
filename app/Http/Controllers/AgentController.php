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
        return view('agent.agent_dashboard');
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


}
