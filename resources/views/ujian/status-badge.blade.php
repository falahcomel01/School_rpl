@if($ujian->status_real === 'draft')
    <span class="badge bg-secondary">Draft</span>
@elseif($ujian->status_real === 'aktif')
    <span class="badge bg-success">Aktif</span>
@elseif($ujian->status_real === 'selesai')
    <span class="badge bg-dark">Selesai</span>
@else
    <span class="badge bg-warning">Nonaktif</span>
@endif
