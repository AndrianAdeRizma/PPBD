<h1>Detail Pendaftar: {{ $siswa->nama_lengkap }}</h1>

@if(session('sukses'))
<div class="alert-sukses">{{ session("sukses") }}</div>
@endif @if($siswa->foto_siswa)
<img
    src="{{ asset('storage/' . $siswa->foto_siswa) }}"
    alt="Foto Siswa"
    width="150"
/>
@else
<p>Tidak ada foto.</p>
@endif

<p><strong>NISN:</strong> {{ $siswa->nisn }}</p>
<p><strong>Alamat:</strong> {{ $siswa->alamat }}</p>
{{-- ... tambahkan data lainnya ... --}}

<hr />

<h3>Ubah Status Pendaftaran</h3>
<form
    action="{{ route('admin.pendaftar.updateStatus', $siswa->id) }}"
    method="POST"
>
    @csrf
    <label for="status_pendaftaran">Status:</label>
    <select name="status_pendaftaran" id="status_pendaftaran">
        <option value="pending" {{ $siswa->
            status_pendaftaran == 'pending' ? 'selected' : '' }}>Pending
        </option>
        <option value="diverifikasi" {{ $siswa->
            status_pendaftaran == 'diverifikasi' ? 'selected' : ''
            }}>Diverifikasi
        </option>
        <option value="diterima" {{ $siswa->
            status_pendaftaran == 'diterima' ? 'selected' : '' }}>Diterima
        </option>
        <option value="ditolak" {{ $siswa->
            status_pendaftaran == 'ditolak' ? 'selected' : '' }}>Ditolak
        </option>
    </select>
    <button type="submit">Update Status</button>
</form>
