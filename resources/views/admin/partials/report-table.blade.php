<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Laporan Penggunaan Dana</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Item & Ringkasan</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($allReports->groupBy('user_id') as $userId => $userReports)
                        @php $user = $userReports->first()->user; @endphp
                        
                        <tr class="table-secondary text-gray-900 font-weight-bold">
                            <td colspan="4">
                                <div class="d-flex justify-content-between align-items-center w-100">
                                    <div>
                                        <i class="fas fa-user mr-2 text-primary"></i>
                                        {{ strtoupper($user->name) }} <small>({{ $user->nim }})</small>
                                    </div>
                                    <form action="{{ route('admin.mahasiswa.reset_password', $user->id) }}" method="POST" class="m-0" onsubmit="return confirm('Yakin ingin mereset password mahasiswa ini menjadi eramet2026?');">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-warning shadow-sm"><i class="fas fa-key fa-sm"></i> Reset Password</button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        @foreach($userReports as $report)
                            @include('admin.partials.table', ['report' => $report])
                        @endforeach

                    @empty
                        <tr><td colspan="4" class="text-center py-5">Belum ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach($allReports as $report)
    @include('admin.partials.modal-periksa', ['report' => $report])
@endforeach
