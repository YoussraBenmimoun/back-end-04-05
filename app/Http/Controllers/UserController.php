<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users = User::with(['client', 'host'])->get();

        return response()->json(['users' => $users]);
    }
    public function updateStatus(Request $request, $id)
    {

        $user = User::find($id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['message' => 'User status updated successfully'], 200);
    }

    public function deleteUsers(Request $request)
    {
        $userIds = $request->IdOfusersToDelete;
        try {
            User::whereIn('id', $userIds)->delete();
            return response()->json(['message' => 'Selected users deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete selected users'], 500);
        }
    }


    public function storeAdmin(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8'
        ]);
        $user = new user();
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->type = "admin";
        $user->save();

        return response()->json(['message' => "User ajouté avec succès"]);
    }
    public function updateAdmin(Request $request)
    {
        // $id = Auth::user()->id;
        $admin = User::find(3);
        $admin->email = $request->data->email;
        $admin->password = Hash::make($request->password);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('assets'), $fileName);
            $image = 'assets/' . $fileName;
            $admin->image = $image;
        }
        $admin->save();
        return response()->json(['data' => $request->all(), 'admin' => $admin]);
    }
}
