<x-app-layout>
  <div class="container">
    <h3 class="section-title">Edit Catatan Perkembangan</h3>

    <div class="info-siswa">
      <strong>{{ $catatan_perkembangan->siswa->user->name }}</strong><br>
      Semester: {{ ucfirst($catatan_perkembangan->semester) }} |
      Tahun Ajaran: {{ $catatan_perkembangan->tahun_ajaran }}
    </div>

    <form action="{{ route('catatan_perkembangan.update', $catatan_perkembangan->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label>Catatan Akademik</label>
        <textarea name="catatan_akademik" rows="5" class="form-control" required>
{{ old('catatan_akademik', $catatan_perkembangan->catatan_akademik) }}
        </textarea>
      </div>

      <div class="form-group">
        <label>Catatan Non Akademik</label>
        <textarea name="catatan_non_akademik" rows="5" class="form-control" required>
{{ old('catatan_non_akademik', $catatan_perkembangan->catatan_non_akademik) }}
        </textarea>
      </div>

      <div class="form-actions">
        <a href="{{ route('catatan_perkembangan.index') }}" class="btn btn-cancel">Batal</a>
        <button class="btn btn-submit">Update</button>
      </div>
    </form>
  </div>

  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #fafafa;
    }

    .container {
      max-width: 700px;
      margin: 40px auto;
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
      border: 1px solid #f1dada;
      padding: 30px;
    }

    .section-title {
      font-size: 1.2rem;
      font-weight: 600;
      color: #b91c1c;
      border-bottom: 3px solid #b91c1c;
      display: inline-block;
      padding-bottom: 6px;
      margin-bottom: 20px;
    }

    .alert-error {
      background-color: #fee2e2;
      border-left: 4px solid #dc2626;
      color: #991b1b;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 20px;
      font-size: 14px;
    }

    .info-siswa {
      background-color: #f9fafb;
      padding: 12px 16px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-size: 14px;
      color: #374151;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      font-weight: 600;
      margin-bottom: 8px;
      color: #374151;
    }

    .form-control {
      width: 100%;
      padding: 10px 14px;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      font-size: 14px;
      transition: border-color 0.2s;
    }

    .form-control:focus {
      outline: none;
      border-color: #b91c1c;
      box-shadow: 0 0 0 3px rgba(185, 28, 28, 0.1);
    }

    .form-control.is-invalid {
      border-color: #dc2626;
    }

    .invalid-feedback {
      color: #dc2626;
      font-size: 13px;
      margin-top: 5px;
    }

    textarea.form-control {
      resize: vertical;
      min-height: 120px;
    }

    .form-actions {
      display: flex;
      justify-content: flex-end;
      gap: 12px;
      margin-top: 25px;
    }

    .btn {
      display: inline-block;
      padding: 10px 20px;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      text-decoration: none;
      transition: 0.2s;
      border: none;
    }

    .btn-cancel {
      background-color: #f3f4f6;
      color: #374151;
    }

    .btn-cancel:hover {
      background-color: #e5e7eb;
    }

    .btn-submit {
      background-color: #b91c1c;
      color: #fff;
    }

    .btn-submit:hover {
      background-color: #991b1b;
    }
  </style>
</x-app-layout>
