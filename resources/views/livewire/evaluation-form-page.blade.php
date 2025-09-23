<div class="content-wrapper">
		<div class="row">
				<div class="col-12 grid-margin stretch-card">
						<div class="card">
								<div class="card-body">
										<h4 class="card-title">{{ $isEdit ? 'Edit Evaluasi' : 'Buat Evaluasi' }}</h4>

										@if (session()->has('success'))
												<div class="alert alert-success">{{ session('success') }}</div>
										@endif

										<form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
												<div class="row">
														<div class="col-md-8">
																<div class="form-group">
																		<label>Karyawan</label>
																		<select class="form-control" wire:model="employee_id">
																				<option value="">Pilih Karyawan</option>
																				@foreach ($employees as $employee)
																						<option value="{{ $employee->id }}">{{ $employee->name }}</option>
																				@endforeach
																		</select>
																		@error('employee_id')
																				<small class="text-danger">{{ $message }}</small>
																		@enderror
																</div>

																<div class="form-group">
																		<label>Minggu Evaluasi</label>
																		<input type="date" class="form-control" wire:model.defer="week_start">
																		@error('week_start')
																				<small class="text-danger">{{ $message }}</small>
																		@enderror
																</div>

																<div class="form-group">
																		<label>Catatan</label>
																		<textarea class="form-control" rows="4" wire:model.defer="notes"></textarea>
																		@error('notes')
																				<small class="text-danger">{{ $message }}</small>
																		@enderror
																</div>
														</div>

														<div class="col-md-4">
																<h5>Pertanyaan Evaluasi</h5>
																@foreach ($questions as $question)
																		<div class="form-group">
																				<label>{{ $question->question }} (Bobot: {{ $question->weight }})</label>
																				<input type="number" class="form-control" wire:model="answers.{{ $question->id }}.score"
																						min="1" max="10" placeholder="Skor 1-10">
																				@error("answers.{$question->id}.score")
																						<small class="text-danger">{{ $message }}</small>
																				@enderror
																				<textarea class="form-control mt-2" rows="2" wire:model="answers.{$question->id}.comment"
																				  placeholder="Komentar (opsional)"></textarea>
																		</div>
																@endforeach

																<div class="mt-3">
																		<button type="submit" class="btn btn-primary">
																				{{ $isEdit ? 'Update Evaluasi' : 'Simpan Evaluasi' }}
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

				{{-- Daftar Evaluasi --}}
				<div class="col-12 grid-margin stretch-card mt-4">
						<div class="card">
								<div class="card-body">
										<div class="d-flex justify-content-between mb-3">
												<h4 class="card-title">Daftar Evaluasi</h4>
												<div class="input-group w-25">
														<input type="text" class="form-control" placeholder="Cari nama karyawan..."
																wire:model.debounce.500ms="search">
												</div>
										</div>

										<div class="table-responsive">
												<table class="table">
														<thead>
																<tr>
																		<th>Karyawan</th>
																		<th>Evaluator</th>
																		<th>Minggu</th>
																		<th>Skor Total</th>
																		<th>Catatan</th>
																		<th>Aksi</th>
																</tr>
														</thead>
														<tbody>
																@forelse ($evaluations as $evaluation)
																		<tr>
																				<td>{{ $evaluation->employee ? $evaluation->employee->name : '-' }}</td>
																				<td>{{ $evaluation->evaluator ? $evaluation->evaluator->name : '-' }}</td>
																				<td>{{ Carbon\Carbon::parse($evaluation->week_start)->format('Y-m-d') }}</td>
																				<td>{{ $evaluation->total_score ?? '-' }}</td>
																				<td>{{ $evaluation->notes ?? '-' }}</td>
																				<td>
																						<button class="btn btn-sm btn-info" wire:click="edit({{ $evaluation->id }})">Edit</button>
																						<button class="btn btn-sm btn-danger"
																								onclick="confirm('Yakin ingin menghapus evaluasi ini?') || event.stopImmediatePropagation()"
																								wire:click="delete({{ $evaluation->id }})">Hapus</button>
																				</td>
																		</tr>
																@empty
																		<tr>
																				<td colspan="6" class="text-center">Belum ada evaluasi</td>
																		</tr>
																@endforelse
														</tbody>
												</table>
										</div>

										<div class="mt-3">
												{{ $evaluations->links() }}
										</div>
								</div>
						</div>
				</div>
		</div>
</div>
