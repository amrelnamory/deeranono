<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Intervention\Image\Facades\Image;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:update_users'])->only('edit');
        $this->middleware(['permission:delete_users'])->only('destroy');
    } //end of constructor

    // Index
    public function index(Request $request)
    {
        $users = User::whereRoleIs('admin')->get();
        return view('dashboard.users.index', compact('users'));
    } // End of Index


    // Create User
    public function create()
    {
        return view('dashboard.users.create');
    } // End of Create User


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'job' => 'required',
            'address' => 'required',
            'phone' => 'required|unique:users',
            'email' => 'required|unique:users',
            'image' => 'image',
            'password' => 'required|confirmed',
            'permissions' => 'required|min:1',
        ]);

        $request_data = $request->except(['password', 'password_confirmation', 'permissions', 'image']);
        $request_data['password'] = bcrypt($request->password);

        if ($request->image) {
            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save('uploads/user_images/' . $request->image->hashName(), 60);
            $request_data['image'] = $request->image->hashName();
        } //end of if

        $user = User::create($request_data);
        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.users.index');
    } // End of Store


    // Edit
    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    } // End of Edit


    // Update
    public function update(Request $request, User $user)
    {

        $request->validate([
            'name' => 'required',
            'job' => 'required',
            'address' => 'required',
            'image' => 'image',
            'email' => ['required', Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', Rule::unique('users')->ignore($user->id)],
            'permissions' => 'required|min:1',
        ]);

        $request_data = $request->except(['permissions', 'image']);

        if ($request->image) {
            if ($user->image != 'avatar.png') {
                File::delete('uploads/user_images/' . $user->image);
            } //end of inner if
            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save('uploads/user_images/' . $request->image->hashName(), 60);
            $request_data['image'] = $request->image->hashName();
        } //end of external if

        $user->update($request_data);
        $user->syncPermissions($request->permissions);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.users.index');
    } // End of Update


    // changePassword
    public function changePassword($id)
    {
        $user = User::find($id);

        return view('dashboard.users.changePassword', compact('user'));
    } // End of changePassword


    // Update Password
    public function updatePassword(Request $request, $id)
    {
        $user = User::find($id);

        $request->validate([
            'password' => 'required|confirmed',
        ]);

        $user->update([
            'password' => bcrypt($request->password),
        ]);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.users.index');
    } // End of Update Password


    // Delete
    public function destroy(User $user)
    {

        if ($user->image != 'avatar.png') {
            File::delete('uploads/user_images/' . $user->image);
        } //end of if

        $user->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.users.index');
    } // End of Delete

    
    // changePassword
    public function notifications($id)
    {
        $user = User::find($id);
 
        return view('dashboard.users.notifications', compact('user'));
    } // End of changePassword
}
