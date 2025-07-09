<h1>Daftar Calon Siswa</h1>
<table>
    <thead>
        <tr>
            <th>No. Pendaftaran</th>
            <th>Nama Lengkap</th>
            <th>Asal Sekolah</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pendaftar as $siswa)
        <tr>
            <td>{{ $siswa->nomor_pendaftaran }}</td>
            <td>{{ $siswa->nama_lengkap }}</td>
            <td>{{ $siswa->asal_sekolah }}</td>
            <td>
                <span
                    class="status-{{ $siswa->status_pendaftaran }}"
                    >{{ ucfirst($siswa->status_pendaftaran) }}</span
                >
            </td>
            <td>
                <a href="{{ route('admin.pendaftar.show', $siswa->id) }}"
                    >Lihat Detail</a
                >
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
