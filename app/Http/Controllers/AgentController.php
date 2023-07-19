<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgentController extends Controller
{
       /** Start of AgentDashboard Function 
     * Code Relate to the Agent Dashboard and its associate returns the simple view of Dashboard
    */
    public function AgentController()
    {
        return view('agent.agent_dashboard');
    }
     /** End of AgentDashboard Function */
}
