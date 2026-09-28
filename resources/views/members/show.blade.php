<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Anggota</title>
    <style>
        body { font-family: sans-serif; margin: 40px; max-width: 500px; }
        table { border-collapse: collapse; width: 100%; margin-top: 16px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; vertical-align: top; }
        th { background: #f3f4f6; width: 35%; }
        .btn { padding: 6px 12px; background: #2563eb; color: #fff; border-radius: 4px; text-decoration: none; }
    </style>
</head>
<body>
    <h1>Detail Anggota</h1>
    <p><a href="{{ route('members.index') }}">&larr; Kembali ke daftar anggota</a></p>

    <table>
        <tr>
            <th>ID</th>
            <td>{{ $member->id }}</td>
        </tr>
        <tr>
            <th>Nama</th>
            <td>{{ $member->nama }}</td>
        </tr>
        <tr>
            <th>NIM</th>
            <td>{{ $member->nim }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $member->email }}</td>
        </tr>
        <tr>
            <th>Nomor Telepon</th>
            <td>{{ $member->nomor_telepon }}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>{{ $member->alamat }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ ucfirst($member->status) }}</td>
        </tr>
    </table>

    <p style="margin-top: 16px;">
        <a href="{{ route('members.edit', $member->id) }}" class="btn">Edit</a>
    </p>
</body>
</html>
