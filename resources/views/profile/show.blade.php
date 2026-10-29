@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
    <h1>Profil Saya</h1>

    <table>
        <tr>
            <th style="width:160px; background:#f3f4f6;">Nama</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th style="background:#f3f4f6;">Email</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th style="background:#f3f4f6;">Role</th>
            <td>{{ ucfirst($user->role) }}</td>
        </tr>
    </table>

    <h2 style="margin-top: 32px;">Ganti Password</h2>

    <form action="{{ route('profile.password') }}" method="POST" style="max-width: 400px;">
        @csrf
        @method('PUT')

        <label for="password_lama" style="display:block; margin-top:12px; font-weight:bold;">Password Lama</label>
        <input type="password" name="password_lama" id="password_lama" style="width:100%; padding:6px; margin-top:4px; box-sizing:border-box;">
        @error('password_lama')
            <div style="color:#b91c1c; font-size:14px; margin-top:4px;">{{ $message }}</div>
        @enderror

        <label for="password_baru" style="display:block; margin-top:12px; font-weight:bold;">Password Baru</label>
        <input type="password" name="password_baru" id="password_baru" style="width:100%; padding:6px; margin-top:4px; box-sizing:border-box;">
        @error('password_baru')
            <div style="color:#b91c1c; font-size:14px; margin-top:4px;">{{ $message }}</div>
        @enderror

        <label for="password_baru_confirmation" style="display:block; margin-top:12px; font-weight:bold;">Konfirmasi Password Baru</label>
        <input type="password" name="password_baru_confirmation" id="password_baru_confirmation" style="width:100%; padding:6px; margin-top:4px; box-sizing:border-box;">

        <button type="submit" class="btn" style="margin-top:20px;">Ubah Password</button>
    </form>
@endsection