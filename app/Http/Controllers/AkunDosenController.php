<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AkunDosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('data-akun-dosen', [
            'datas' => User::where('role', 'dosen')->orWhere('role', 'dosen_penguji')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data-akun-dosen-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6',
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['role'] = User::ROLE_DOSEN;
        $data['photo'] = User::PHOTO_DEFAULT;

        User::create($data);
        return redirect()->route('data-akun-dosen.index');
    }

    public function jadikan_dosen_penguji(string $id)
    {
        $dataAkunDosen = User::find($id);

        if ($dataAkunDosen->role === User::ROLE_DOSEN_PENGUJI) {
            $dataAkunDosen->update([
                'role' => User::ROLE_DOSEN,
            ]);
        } else {
            $dataAkunDosen->update([
                'role' => User::ROLE_DOSEN_PENGUJI,
            ]);
        }

        return redirect()->route('data-akun-dosen.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
