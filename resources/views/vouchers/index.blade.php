<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Voucher</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <div class="box">
        <h2>Data Voucher
            @if (auth()->user()->role === 'admin')
                <a href="{{ route('vouchers.create') }}" class="btn float-r">+ Tambah</a>
            @endif
        </h2>

        <div class="userbar">
            Login sebagai <b>{{ auth()->user()->name }}</b> ({{ auth()->user()->role }})
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="btn-red">Logout</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Jenis</th>
                    <th>Nilai</th>
                    <th>Syarat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($vouchers as $v)
                <tr>
                    <td>{{ $v->kode }}</td>
                    <td>{{ $v->jenis }}</td>
                    <td>
                        {{ $v->jenis == 'Persen (%)' ? $v->nilai . '%' : 'Rp ' . number_format($v->nilai, 0, ',', '.') }}
                    </td>
                    <td>Rp {{ number_format($v->syarat, 0, ',', '.') }}</td>
                    <td>
    @if (auth()->user()->role === 'admin')
        <div class="aksi">
            <a href="{{ route('vouchers.edit', $v) }}" class="btn">Edit</a>
            <form action="{{ route('vouchers.destroy', $v) }}" method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus voucher ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-red">Hapus</button>
            </form>
        </div>
    @else
        -
    @endif
</td>
                </tr>
                @empty
                <tr><td colspan="5">Belum ada voucher</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>