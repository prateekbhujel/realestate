<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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


}
