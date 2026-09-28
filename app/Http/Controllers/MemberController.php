<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    private array $members = [
        ['id' => 1, 'nama' => 'Budi Santoso', 'nim' => '2301001', 'email' => 'budi@example.com', 'nomor_telepon' => '081234567890', 'alamat' => 'Bekasi', 'status' => 'aktif'],
        ['id' => 2, 'nama' => 'Siti Aminah', 'nim' => '2301002', 'email' => 'siti@example.com', 'nomor_telepon' => '081298765432', 'alamat' => 'Jakarta', 'status' => 'aktif'],
        ['id' => 3, 'nama' => 'Andi Wijaya', 'nim' => '2301003', 'email' => 'andi@example.com', 'nomor_telepon' => null, 'alamat' => null, 'status' => 'nonaktif'],
    ];

    public function index()
    {
        $members = $this->members;

        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(StoreMemberRequest $request)
    {
        $validated = $request->validated();

        return redirect()->route('members.index')
            ->with('success', "Anggota \"{$validated['nama']}\" berhasil ditambahkan (data dummy, belum tersimpan ke database).");
    }

    public function show(string $id)
    {
        return "MemberController@show, id: {$id}";
    }

    public function edit(string $id)
    {
        return "MemberController@edit, id: {$id}";
    }

    public function update(Request $request, string $id)
    {
        return "MemberController@update, id: {$id}";
    }

    public function destroy(string $id)
    {
        return "MemberController@destroy, id: {$id}";
    }
}
