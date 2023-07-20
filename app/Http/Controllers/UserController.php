<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
