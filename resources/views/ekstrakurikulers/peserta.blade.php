<x-app-layout>
<style>
.card {
  background:#fff;
  border-radius:12px;
  border:1px solid #f1dada;
  padding:24px;
  box-shadow:0 4px 10px rgba(0,0,0,.08);
}

.header-title {
  font-size:1.5rem;
  font-weight:700;
  color:#b91c1c;
  border-bottom:3px solid #b91c1c;
  padding-bottom:6px;
  margin-bottom:20px;
}

.header-card {
  background:#b91c1c;
  color:#fff;
  border-radius:12px;
  padding:20px;
  display:flex;
  justify-content:space-between;
  gap:20px;
  margin-bottom:20px;
}

.ekstra-name {
  font-size:22px;
  font-weight:700;
  margin-bottom:6px;
}

.ekstra-meta span {
  font-size:14px;
  margin-right:15px;
}

.kuota-card {
  background:#fff;
  color:#111;
  padding:15px;
  border-radius:12px;
  min-width:160px;
  text-align:center;
}

.kuota-number {
  font-size:26px;
  font-weight:700;
  color:#b91c1c;
}

.table-card {
  border:1px solid #f1dada;
  border-radius:12px;
  overflow:hidden;
}

.table-header {
  padding:15px 20px;
  font-weight:700;
  border-bottom:1px solid #f1dada;
}

table {
  width:100%;
  border-collapse:collapse;
}

thead {
  background:#b91c1c;
  color:#fff;
}

th, td {
  padding:10px;
  border:1px solid #f3c5c5;
  text-align:center;
}

tbody tr:hover {
  background:#fde8e8;
}

.date-badge {
  background:#fef2f2;
  color:#991b1b;
  padding:4px 10px;
  border-radius:6px;
  font-size:13px;
}

.btn-back {
  display:inline-block;
  margin-top:20px;
  background:#f3f4f6;
  border:1px solid #d1d5db;
  padding:8px 16px;
  border-radius:6px;
  font-weight:600;
}
</style>

<div class="py-10">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<div class="card">

<h3 class="header-title">Peserta Ekstrakurikuler</h3>

{{-- HEADER --}}
<div class="header-card">
  <div>
    <h3 class="ekstra-name">{{ $ekstrakurikuler->nama_extra }}</h3>
    <div class="ekstra-meta">
      <span><i class="fas fa-user-tie"></i> {{ $ekstrakurikuler->pembina->user->name ?? '-' }}</span>
      <span><i class="fas fa-calendar"></i> {{ $ekstrakurikuler->jadwal }}</span>
      <span><i class="fas fa-map-marker-alt"></i> {{ $ekstrakurikuler->tempat }}</span>
    </div>
  </div>

  <div class="kuota-card">
    <div>Total Peserta</div>
    <div class="kuota-number">
      {{ $ekstrakurikuler->peserta->count() }} / {{ $ekstrakurikuler->kuota }}
    </div>
  </div>
</div>

{{-- TABLE --}}
<div class="table-card">
  <div class="table-header">Daftar Peserta</div>
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Siswa</th>
        <th>Kelas</th>
        <th>Jurusan</th>
        <th>Tanggal Daftar</th>
      </tr>
    </thead>
    <tbody>
      @forelse($ekstrakurikuler->peserta as $i => $siswa)
      <tr>
        <td>{{ $i + 1 }}</td>
        <td class="text-start font-semibold">
          {{ $siswa->user->name }}
        </td>
        <td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
        <td>{{ $siswa->kelas->jurusan->nama_jurusan ?? '-' }}</td>
        <td>
          <span class="date-badge">
            {{ $siswa->pivot->created_at->format('d M Y') }}
          </span>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="5">Belum ada peserta</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>

<a href="{{ route('ekstrakurikulers.index') }}" class="btn-back">
  <i class="fas fa-arrow-left"></i> Kembali
</a>

</div>
</div>
</div>
</x-app-layout>
