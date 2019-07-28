<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $this->authorize('create', Admin::class);

        $admins = Admin::orderBy('name')->get()->filter(function($admin) {
            return $admin->role_id > auth('admin')->user()->role_id;
        })->values();

        return view('admins.index', compact('admins'));
    }

    public function create()
    {
        $this->authorize('create', Admin::class);

        return view('admins.create', ['roles' => Role::where('id', '>', auth()->user()->role_id)->get()]);
    }

    public function store(Request $request, Admin $admin)
    {
        $this->authorize('create', $admin);
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required',
            'roleId' => 'required|exists:roles,id'
        ]);

        if ($request->roleId <= auth()->user()->role_id) {
            return response('Unauthorized role', 401);
        }
        try {
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->password = bcrypt($request->password);
            $admin->role_id = $request->roleId;

            $admin->save();

            return response('Admin has been created', 201);
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return response('Failed to create admin', 500);
        }
    }

    public function show(Admin $admin)
    {
        //$this->authorize('view', $admin);

        return view('admins.show', ['admin' => auth('admin')->user()]);
    }

    public function edit(Admin $admin)
    {
        $this->authorize('create', $admin);

        $roles = Role::where('id', '>', auth('admin')->user()->role_id)->get();
        return view('admins.edit', compact(['admin', 'roles']));
    }

    /**
     * @param Request $request
     * @param Admin $admin
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Admin $admin)
    {
        $this->authorize('update', $admin);

        if ($request->has('password')) {
            $request->validate(['password' => 'string|min:6']);

            try {
                $admin->update(['password' => bcrypt($request->password)]);

                return response()->json('Password has been changed!', 200);
            } catch (\Exception $e) {
                Log::debug($e->getMessage(), ['file' => $e->getFile(), 'line' => $e->getLine()]);

                return response()->json('Failed to change password try again later!', 500);
            }

        }

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'roleId' => 'required|exists:roles,id'
        ]);

        try {
            $admin->update([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->roleId
            ]);

            return response()->json('Account has been updated!', 200);
        } catch (\Exception $e) {
            Log::debug($e->getMessage(), ['file' => $e->getFile(), 'line' => $e->getLine()]);

            return response()->json('Failed to update account try again later!', 500);
        }

    }

    /**
     * @param Admin $admin
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Admin $admin)
    {
        $this->authorize('create', $admin);

        try {
            $admin->delete();

            return response()->json('Admin has been deleted!', 204);
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return response()->json('Failed to delete admin!', 500);
        }
    }
}
