<x-app-layout>
    <div class="container">

        {{-- Title & Back --}}
        <div class="top-section">
            <h3 class="section-title">Form Edit Jurusan</h3>
            <a href="{{ route('jurusan.index') }}" class="btn btn-add">Kembali</a>
        </div>

        {{-- Error --}}
        @if ($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('jurusan.update', $jurusan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Jurusan</label>
                <input type="text" name="nama_jurusan" class="input"
                       value="{{ $jurusan->nama_jurusan }}" required>
            </div>

            <button class="btn btn-submit">Perbarui</button>
        </form>

    </div>

    {{-- CSS Sama --}}
    <style>
        body { font-family:'Segoe UI', Tahoma; background:#fafafa; }

        .container {
            max-width: 700px; margin:40px auto; background:white;
            padding:30px; border-radius:12px;
            border:1px solid #f1dada; box-shadow:0 4px 10px rgba(0,0,0,0.08);
        }

        .page-title {
            font-size:1.5rem; font-weight:700; color:#b91c1c;
            border-bottom:3px solid #b91c1c; padding-bottom:6px;
            display:inline-block; margin-bottom:25px;
        }

        .top-section {
            display:flex; justify-content:space-between; margin-bottom:20px;
        }

        .section-title {
            font-size:1.1rem; font-weight:600; color:#b91c1c;
            border-bottom:3px solid #b91c1c; padding-bottom:5px;
        }

        .alert-error {
            background:#fee2e2; border-left:4px solid #dc2626;
            padding:10px; border-radius:6px; margin-bottom:15px; color:#991b1b;
        }

        .form-group { margin-bottom:20px; }
        label { font-weight:600; color:#444; }

        .input {
            width:100%; padding:10px; border:1px solid #e5e7eb;
            border-radius:8px; margin-top:6px;
        }

        .btn-add {
            background-color:#b91c1c; color:white; padding:8px 16px;
            border-radius:6px; text-decoration:none; font-weight:600;
        }

        .btn-submit {
            background:#b91c1c; color:white; padding:10px 20px;
            border:none; border-radius:8px; font-weight:600;
        }
        .btn-submit:hover { background:#991b1b; }
    </style>
</x-app-layout>
