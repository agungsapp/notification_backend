<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $isEdit ? 'Edit Pertanyaan' : 'Buat Pertanyaan' }}</h4>

                    @if (session()->has('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Pertanyaan</label>
                                    <input type="text" class="form-control" wire:model.defer="question" placeholder="Contoh: Bagaimana sikap karyawan?">
                                    @error('question')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Bobot</label>
                                    <input type="number" class="form-control" wire:model.defer="weight" min="1" max="10">
                                    @error('weight')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" wire:model="is_active">
                                        <option value="1">Aktif</option>
                                        <option value="0">Nonaktif</option>
                                    </select>
                                    @error('is_active')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        {{ $isEdit ? 'Update Pertanyaan' : 'Simpan Pertanyaan' }}
                                    </button>
                                    @if ($isEdit)
                                        <button type="button" class="btn btn-secondary" wire:click="resetForm">Batal</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Daftar Pertanyaan --}}
        <div class="col-12 grid-margin stretch-card mt-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4 class="card-title">Daftar Pertanyaan</h4>
                        <div class="input-group w-25">
                            <input type="text" class="form-control" placeholder="Cari pertanyaan..." wire:model.debounce.500ms="search">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Pertanyaan</th>
                                    <th>Bobot</th>
                                    <th>Status</th>
                                    <th>Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($questions as $question)
                                    <tr>
                                        <td style="width:40%;">{{ $question->question }}</td>
                                        <td>{{ $question->weight }}</td>
                                        <td>
                                            <span class="badge {{ $question->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $question->is_active ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </td>
                                        <td>{{ $question->created_at->format('Y-m-d H:i') }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-info" wire:click="edit({{ $question->id }})">Edit</button>
                                            <button class="btn btn-sm {{ $question->is_active ? 'btn-warning' : 'btn-success' }}"
                                                    wire:click="toggleActive({{ $question->id }})">
                                                {{ $question->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                            </button>
                                            <button class="btn btn-sm btn-danger"
                                                    onclick="confirm('Yakin ingin menghapus pertanyaan ini?') || event.stopImmediatePropagation()"
                                                    wire:click="delete({{ $question->id }})">Hapus</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada pertanyaan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $questions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>