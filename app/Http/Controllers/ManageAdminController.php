<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class ManageAdminController extends Controller
{
    public function showUsersMenu() {

        $users = User::all();
        $user_details = UserDetail::all();
      
        return view('admin.users', compact('users', 'user_details'));
    }

    public function showUserDetails($id) {

        $user = User::with('userDetail')->findOrFail($id);
        
        return view('admin.user_details', compact('user'));
    }

    public function updateUserDetails(Request $request, $id) {

        $user = User::findOrFail($id);

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        
        $user->save();

         // Find or create user details
        $userDetail = UserDetail::firstOrNew(['user_id' => $id]);
        $userDetail->role = $request->input('role'); // Assuming 'role' is a field in your user details
        $userDetail->access_level = $request->input('access_level'); // Assuming 'access_level' is a field in your user details
        $userDetail->save();



        return redirect()->back()->with('success', 'User details updated successfully');
    }
}
