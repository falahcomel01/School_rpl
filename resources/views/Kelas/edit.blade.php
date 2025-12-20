<x-app-layout>
  <div class="container">

    <div class="top-section">
      <h3 class="section-title">Form Edit Kelas</h3>
      <a href="{{ route('kelas.index') }}" class="btn btn-add">Kembali</a>
    </div>

    {{-- Error --}}
    @if ($errors->any())
      <div class="alert-error">
        <ul>
          @foreach ($errors->all() as $e)
            <li>• {{ $e }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('kelas.update', $kelas->id) }}">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label>Jurusan</label>
     <select name="jurusan_id" class="input">

    {{-- Opsi NULL untuk kelas 10 --}}
    <option value="" {{ $kelas->jurusan_id == null ? 'selected' : '' }}>
        Tidak Ada Jurusan
    </option>

    @foreach ($jurusan as $j)
        <option value="{{ $j->id }}"
            {{ $kelas->jurusan_id == $j->id ? 'selected' : '' }}>
            {{ $j->nama_jurusan }}
        </option>
    @endforeach
</select>

      </div>

      <div class="form-group">
        <label>Nama Kelas</label>
        <input type="text" class="input" name="nama_kelas"
               value="{{ $kelas->nama_kelas }}">
      </div>

      <button class="btn btn-submit">Perbarui</button>
    </form>

  </div>

<style>
    body { font-family:'Segoe UI', Tahoma; background:#fafafa; }

    .container {
        max-width:900px; margin:40px auto; background:white;
        padding:30px; border-radius:12px;
        border:1px solid #f1dada; box-shadow:0 4px 10px rgba(0,0,0,0.08);
    }

    .page-title {
        font-size:1.5rem; font-weight:700; color:#b91c1c;
        border-bottom:3px solid #b91c1c; padding-bottom:6px;
        display:inline-block; margin-bottom:25px;
    }

    .top-section {
        display:flex; justify-content:space-between;
        align-items:center; margin-bottom:20px;
    }

    .section-title {
        font-size:1.1rem; font-weight:600; color:#b91c1c;
        border-bottom:3px solid #b91c1c; padding-bottom:5px;
    }

    .btn-add {
        background:#b91c1c; color:white;
        padding:8px 16px; border-radius:6px;
        text-decoration:none; font-weight:600;
    }

    .btn-submit {
        background:#b91c1c; color:white;
        padding:10px 20px; border-radius:8px;
        font-weight:600; border:none;
    }
    .btn-submit:hover { background:#991b1b; }

    .alert-success {
        background:#d1fae5; border-left:4px solid #10b981;
        padding:10px; border-radius:6px; margin-bottom:20px;
    }

    .alert-error {
        background:#fee2e2; border-left:4px solid #dc2626;
        padding:10px; border-radius:6px; margin-bottom:20px;
        color:#991b1b;
    }

    .input {
        width:100%; padding:10px; border-radius:8px;
        border:1px solid #e5e7eb; margin-top:6px;
    }

    table {
        width:100%; border-collapse:collapse; margin-top:10px;
    }

    thead {
        background:#b91c1c; color:white; text-transform:uppercase;
    }

    th, td {
        padding:10px; border:1px solid #f3c5c5;
        text-align:center;
    }

    .action-buttons {
        display:flex; gap:10px; justify-content:center;
    }

    .btn-edit {
        border:1px solid #b91c1c; color:#b91c1c;
        padding:6px 12px; border-radius:6px;
    }
    .btn-edit:hover {
        background:#b91c1c; color:white;
    }

    .btn-delete {
        background:#dc2626; color:white;
        padding:6px 12px; border-radius:6px;
        border:none;
    }
    .btn-delete:hover { background:#991b1b; }

    .empty-row td {
        padding:20px; color:#9ca3af; font-style:italic;
        background:#f9fafb;
    }
</style>

</x-app-layout>
