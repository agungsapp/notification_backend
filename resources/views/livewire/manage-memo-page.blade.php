<div class="content-wrapper">
		<div class="row">
				<div class="col-12 grid-margin stretch-card">
						<div class="card">
								<div class="card-body">
										<h4 class="card-title">{{ $isEdit ? 'Edit Memo' : 'Buat Memo' }}</h4>

										@if (session()->has('success'))
												<div class="alert alert-success">{{ session('success') }}</div>
										@endif

										<form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
												<div class="row">
														<div class="col-md-8">
																<div class="form-group">
																		<label>Judul</label>
																		<input type="text" class="form-control" wire:model.defer="title">
																		@error('title')
																				<small class="text-danger">{{ $message }}</small>
																		@enderror
																</div>

																<div class="form-group">
																		<label>Isi Memo</label>
																		<textarea class="form-control" rows="4" wire:model.defer="body"></textarea>
																		@error('body')
																				<small class="text-danger">{{ $message }}</small>
																		@enderror
																</div>
														</div>

														<div class="col-md-4">
																<div class="form-group">
																		<label>Priority</label>
																		<select class="form-control" wire:model="priority">
																				<option value="low">Low</option>
																				<option value="normal">Normal</option>
																				<option value="high">High</option>
																		</select>
																		@error('priority')
																				<small class="text-danger">{{ $message }}</small>
																		@enderror
																</div>

																<div class="form-group">
																		<label>Status</label>
																		<select class="form-control" wire:model="status">
																				<option value="draft">Draft</option>
																				<option value="sent">Kirim Sekarang</option>
																		</select>
																		@error('status')
																				<small class="text-danger">{{ $message }}</small>
																		@enderror
																</div>

																<div class="mt-3">
																		<button type="submit" class="btn btn-primary">
																				{{ $isEdit ? 'Update Memo' : 'Simpan Memo' }}
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

				{{-- Daftar Memo --}}
				<div class="col-12 grid-margin stretch-card mt-4">
						<div class="card">
								<div class="card-body">
										<div class="d-flex justify-content-between mb-3">
												<h4 class="card-title">Daftar Memo</h4>
												<div class="input-group w-25">
														<input type="text" class="form-control" placeholder="Cari judul..." wire:model.debounce.500ms="search">
												</div>
										</div>

										<div class="table-responsive">
												<table class="table">
														<thead>
																<tr>
																		<th>Judul</th>
																		<th>Priority</th>
																		<th>Status</th>
																		<th>Pengirim</th>
																		<th>Terkirim</th>
																		<th>Aksi</th>
																</tr>
														</thead>
														<tbody>
																@forelse ($memos as $memo)
																		<tr>
																				<td style="width:40%;">{{ $memo->title }}</td>
																				<td>
																						@if ($memo->priority === 'high')
																								<span class="badge bg-danger">High</span>
																						@elseif($memo->priority === 'normal')
																								<span class="badge bg-primary">Normal</span>
																						@else
																								<span class="badge bg-secondary">Low</span>
																						@endif
																				</td>
																				<td>
																						<span class="badge {{ $memo->status === 'sent' ? 'bg-success' : 'bg-secondary' }}">
																								{{ ucfirst($memo->status) }}
																						</span>
																				</td>
																				<td>{{ $memo->sender ? $memo->sender->name : '-' }}</td>
																				<td>
																						{{ optional($memo->sent_at)->format('Y-m-d H:i') ?? '-' }}
																				</td>
																				<td>
																						<button class="btn btn-sm btn-info" wire:click="edit({{ $memo->id }})">Edit</button>

																						@if ($memo->status === 'draft')
																								<button class="btn btn-sm btn-success"
																										wire:click="publish({{ $memo->id }})">Publish</button>
																						@endif

																						<button class="btn btn-sm btn-danger"
																								onclick="confirm('Yakin ingin menghapus memo ini?') || event.stopImmediatePropagation()"
																								wire:click="delete({{ $memo->id }})">Hapus</button>
																				</td>
																		</tr>
																@empty
																		<tr>
																				<td colspan="6" class="text-center">Belum ada memo</td>
																		</tr>
																@endforelse
														</tbody>
												</table>
										</div>

										<div class="mt-3">
												{{ $memos->links() }}
										</div>
								</div>
						</div>
				</div>
		</div>
</div>
