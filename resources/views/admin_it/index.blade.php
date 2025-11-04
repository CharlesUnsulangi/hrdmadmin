@extends('layouts.app')

@section('content')
<div class="container">
    <h2>List Stored Procedure Admin IT</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <style>
        .table-sp th, .table-sp td { min-width: 180px; }
        .table-sp thead { background: #e3f2fd; }
    </style>
    <table class="table table-bordered table-hover table-sp align-middle">
        <thead>
            <tr>
                <th style="width: 220px;">SP ID</th>
                <th>Deskripsi</th>
                <th style="width: 220px;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sps as $sp)
            <tr>
                <td><span class="fw-bold text-primary">{{ $sp->ms_admin_sp_id }}</span></td>
                <td>{{ $sp->sp_desc }}</td>
        <td>
          <button type="button" class="btn btn-info btn-sm" onclick="showSpModal('{{ addslashes($sp->ms_admin_sp_id) }}', '{{ addslashes($sp->sp_desc) }}')">View</button>
          <button type="button" class="btn btn-success btn-sm ms-1" onclick="showSpResult('{{ addslashes($sp->ms_admin_sp_id) }}')">Lihat Hasil SP</button>
          <form action="{{ route('admin-it.execute', $sp->ms_admin_sp_id) }}" method="POST" style="display:inline-block;">
            @csrf
            <button type="submit" class="btn btn-primary btn-sm ms-1">Execute SP</button>
          </form>
        </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal Detail SP -->
    <div class="modal fade" id="spModal" tabindex="-1" aria-labelledby="spModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="spModalLabel">Detail Stored Procedure</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div><b>ID:</b> <span id="spModalId"></span></div>
            <div class="mt-2"><b>Deskripsi:</b> <span id="spModalDesc"></span></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Hasil SP -->
    <div class="modal fade" id="spResultModal" tabindex="-1" aria-labelledby="spResultModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="spResultModalLabel">Hasil Eksekusi Stored Procedure</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="spResultBody">
            <div class="text-center text-muted">Loading...</div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
</div>

<script>
function showSpModal(id, desc) {
  document.getElementById('spModalId').textContent = id;
  document.getElementById('spModalDesc').textContent = desc;
  var modal = new bootstrap.Modal(document.getElementById('spModal'));
  modal.show();
}

function showSpResult(id) {
  var modal = new bootstrap.Modal(document.getElementById('spResultModal'));
  var body = document.getElementById('spResultBody');
  body.innerHTML = '<div class="text-center text-muted">Loading...</div>';
  fetch('/admin-it/ajax-execute/' + encodeURIComponent(id), {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': '{{ csrf_token() }}',
      'Accept': 'application/json'
    }
  })
  .then(async response => {
    let data = await response.json();
    if (!response.ok) {
      body.innerHTML = '<div class="alert alert-danger">Gagal mengambil hasil SP:<br>' + (data.error ? data.error : 'Unknown error') + '</div>';
      return;
    }
    if (data.data && data.data.length > 0) {
      let html = '<div class="table-responsive"><table class="table table-bordered"><thead><tr>';
      Object.keys(data.data[0]).forEach(function(key) {
        html += '<th>' + key + '</th>';
      });
      html += '</tr></thead><tbody>';
      data.data.forEach(function(row) {
        html += '<tr>';
        Object.values(row).forEach(function(val) {
          html += '<td>' + (val === null ? '-' : val) + '</td>';
        });
        html += '</tr>';
      });
      html += '</tbody></table></div>';
      body.innerHTML = html;
    } else {
      body.innerHTML = '<div class="alert alert-warning">Hasil SP kosong atau tidak ada data.</div>';
    }
  })
  .catch(() => {
    body.innerHTML = '<div class="alert alert-danger">Gagal mengambil hasil SP (network error).</div>';
  });
  modal.show();
}
</script>
</div>
@endsection
