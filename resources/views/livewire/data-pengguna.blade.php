<div class="content-wrapper">
		<div class="row">
				<div class="col-12 grid-margin stretch-card">
						<div class="card">
								<div class="card-body">
										<h4 class="card-title">{{ $isEdit ? 'Edit Pengguna' : 'Buat Pengguna' }}</h4>

										@if (session()->has('success'))
												<div class="alert alert-success">{{ session('success') }}</div>
										@endif

										<form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
												<div class="row">
														<div class="col-md-8">
																<div class="form-group">
																		<label>Nama</label>
																		<input type="text" class="form-control" wire:model.defer="name">
																		@error('name')
																				<small class="text-danger">{{ $message }}</small>
																		@enderror
																</div>

																<div class="form-group">
																		<label>Email</label>
																		<input type="email" class="form-control" wire:model.defer="email">
																		@error('email')
																				<small class="text-danger">{{ $message }}</small>
																		@enderror
																</div>

																<div class="form-group">
																		<label>Password</label>
																		<input type="password" class="form-control" wire:model.defer="password">
																		@error('password')
																				<small class="text-danger">{{ $message }}</small>
																		@enderror
																</div>
														</div>

														<div class="col-md-4">
																<div class="form-group">
																		<label>Role</label>
																		<select class="form-control" wire:model="role">
																				<option value="admin">Admin</option>
																				<option value="manager">Manager</option>
																				<option value="employee">Employee</option>
																		</select>
																		@error('role')
																				<small class="text-danger">{{ $message }}</small>
																		@enderror
																</div>

																<div class="form-group">
																		<label>Position</label>
																		<select class="form-control" wire:model="position">
																				<option value="owner">Owner</option>
																				<option value="hrd">HRD</option>
																				<option value="manager">Manager</option>
																				<option value="pic">PIC</option>
																				<option value="staff">Staff</option>
																		</select>
																		@error('position')
																				<small class="text-danger">{{ $message }}</small>
																		@enderror
																</div>

																<div class="form-group">
																		<label>Supervisor</label>
																		<select class="form-control" wire:model="supervisor_id">
																				<option value="">Pilih Supervisor</option>
																				@foreach ($supervisors as $supervisor)
																						<option value="{{ $supervisor->id }}">{{ $supervisor->name }}</option>
																				@endforeach
																		</select>
																		@error('supervisor_id')
																				<small class="text-danger">{{ $message }}</small>
																		@enderror
																</div>

																<div class="mt-3">
																		<button type="submit" class="btn btn-primary">
																				{{ $isEdit ? 'Update Pengguna' : 'Simpan Pengguna' }}
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

				{{-- Daftar Pengguna dengan Filter --}}
				<div class="col-12 grid-margin stretch-card mt-4">
						<div class="card">
								<div class="card-body">
										<div class="row">
												<div class="col-md-3">
														<h4 class="card-title">Filter Position</h4>
														<div class="d-flex flex-column gap-2">
																<button class="btn btn-sm {{ $filterPosition == '' ? 'btn-primary' : 'btn-outline-primary' }}"
																		wire:click="resetFilter">Semua</button>
																@foreach (['owner', 'hrd', 'manager', 'pic', 'staff'] as $pos)
																		<button class="btn btn-sm {{ $filterPosition == $pos ? 'btn-primary' : 'btn-outline-primary' }}"
																				wire:click="filterByPosition('{{ $pos }}')">{{ ucfirst($pos) }}</button>
																@endforeach
														</div>
												</div>
												<div class="col-md-9">
														<div class="d-flex justify-content-between mb-3">
																<h4 class="card-title">Daftar Pengguna</h4>
																<div class="input-group w-25">
																		<input type="text" class="form-control" placeholder="Cari nama atau email..."
																				wire:model.debounce.500ms="search">
																</div>
														</div>

														<div class="table-responsive">
																<table class="table">
																		<thead>
																				<tr>
																						<th>Nama</th>
																						<th>Email</th>
																						<th>Role</th>
																						<th>Position</th>
																						<th>Supervisor</th>
																						<th>Aksi</th>
																				</tr>
																		</thead>
																		<tbody>
																				@forelse ($users as $user)
																						<tr>
																								<td style="width:20%;">{{ $user->name }}</td>
																								<td>{{ $user->email }}</td>
																								<td>
																										<span
																												class="badge {{ $user->role === 'admin' ? 'bg-danger' : ($user->role === 'manager' ? 'bg-primary' : 'bg-secondary') }}">
																												{{ ucfirst($user->role) }}
																										</span>
																								</td>
																								<td>{{ ucfirst($user->position) }}</td>
																								<td>{{ $user->supervisor ? $user->supervisor->name : '-' }}</td>
																								<td>
																										<button class="btn btn-sm btn-info" wire:click="edit({{ $user->id }})">Edit</button>
																										<button class="btn btn-sm btn-danger"
																												onclick="confirm('Yakin ingin menghapus pengguna ini?') || event.stopImmediatePropagation()"
																												wire:click="delete({{ $user->id }})">Hapus</button>
																								</td>
																						</tr>
																				@empty
																						<tr>
																								<td colspan="6" class="text-center">Belum ada pengguna</td>
																						</tr>
																				@endforelse
																		</tbody>
																</table>
														</div>

														<div class="mt-3">
																{{ $users->links() }}
														</div>
												</div>
										</div>
								</div>
						</div>
				</div>
		</div>
</div>
