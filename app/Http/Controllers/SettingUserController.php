<?php

namespace App\Http\Controllers;

use App\Models\MsHrUser;
use App\Models\MsHrUserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingUserController extends Controller
{
    public function index(Request $request)
    {
        $query = MsHrUser::with('userRole');

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('role', 'like', "%{$search}%")
                  ->orWhereHas('userRole', function($roleQuery) use ($search) {
                      $roleQuery->where('ms_hr__user_role_name', 'like', "%{$search}%");
                  });
            });
        }

        // Pagination dengan 50 data per halaman
        $users = $query->orderBy('created_at', 'desc')->paginate(50);
        
        // Get all roles for dropdown
        $roles = MsHrUserRole::orderBy('ms_hr__user_role_name')->get();

        return view('setting-user.index', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:ms_hr_user,username',
            'email' => 'required|string|email|max:255|unique:ms_hr_user,email',
            'password' => 'required|string|min:8',
            'role' => 'required|exists:ms_hr_user_role,ms_hr__user_role_name',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = MsHrUser::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'is_active' => 1, // default aktif dengan integer
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User berhasil ditambahkan',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan user: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $user = MsHrUser::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:ms_hr_user,username,' . $id,
            'email' => 'required|string|email|max:255|unique:ms_hr_user,email,' . $id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|exists:ms_hr_user_role,ms_hr__user_role_name',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $updateData = [
                'username' => $request->username,
                'email' => $request->email,
                'role' => $request->role,
            ];

            // Update password hanya jika diisi
            if (!empty($request->password)) {
                $updateData['password'] = Hash::make($request->password);
            }

            $user->update($updateData);

            return response()->json([
                'success' => true,
                'message' => 'User berhasil diupdate',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate user: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $user = MsHrUser::findOrFail($id);
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus user: ' . $e->getMessage()
            ], 500);
        }
    }

    public function toggleStatus($id)
    {
        try {
            $user = MsHrUser::findOrFail($id);
            $user->is_active = ($user->is_active == 1) ? 0 : 1; // Toggle antara 0 dan 1
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Status user berhasil diubah',
                'is_active' => $user->is_active == 1
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengubah status user: ' . $e->getMessage()
            ], 500);
        }
    }
}