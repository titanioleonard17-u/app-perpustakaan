<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Anggota</title>
    <style>
        body { font-family: sans-serif; margin: 40px; }
        table { border-collapse: collapse; width: 100%; margin-top: 16px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f3f4f6; }
        .success { background: #dcfce7; color: #166534; padding: 10px; border-radius: 4px; margin-top: 16px; }
        .btn { padding: 4px 10px; background: #2563eb; color: #fff; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; font-size: 14px; }
        .btn-danger { background: #dc2626; }
        form.inline { display: inline; }
    </style>
</head>
<body>
    <h1>Daftar Anggota</h1>
    <p><a href="{{ route('members.create') }}" class="btn">+ Tambah Anggota</a></p>

    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('members.index') }}" method="GET">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama anggota...">
        <button type="submit" class="btn">Cari</button>
        @if (request('search'))
            <a href="{{ route('members.index') }}">Reset</a>
        @endif
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Email</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($members as $member)
                <tr>
                    <td>{{ $member->id }}</td>
                    <td>{{ $member->nama }}</td>
                    <td>{{ $member->nim }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ ucfirst($member->status) }}</td>
                    <td>
                        <a href="{{ route('members.show', $member->id) }}" class="btn">Detail</a>
                        <a href="{{ route('members.edit', $member->id) }}" class="btn">Edit</a>
                        <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus anggota ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Tidak ada anggota ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 16px;">
        {{ $members->appends(request()->query())->links() }}
    </div>
</body>
</html>
