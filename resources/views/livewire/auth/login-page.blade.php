<div class="container-scroller">
		<div class="container-fluid page-body-wrapper full-page-wrapper">
				<div class="content-wrapper d-flex align-items-center auth px-0">
						<div class="row w-100 mx-0">
								<div class="col-lg-4 mx-auto">
										<div class="auth-form-light px-sm-5 px-4 py-5 text-left">
												<div class="brand-logo mb-3 text-center">
														<img src="{{ asset('assets/images/logo.svg') }}" alt="logo">
												</div>
												<h4 class="text-center">Hello! Let's get started</h4>
												<h6 class="font-weight-light text-center">Sign in to continue.</h6>

												<form class="pt-3" wire:submit.prevent="login">
														<div class="form-group">
																<input type="email" class="form-control form-control-lg" placeholder="Email" wire:model.defer="email">
																@error('email')
																		<small class="text-danger">{{ $message }}</small>
																@enderror
														</div>

														<div class="form-group">
																<input type="password" class="form-control form-control-lg" placeholder="Password"
																		wire:model.defer="password">
																@error('password')
																		<small class="text-danger">{{ $message }}</small>
																@enderror
														</div>

														<div class="form-check mb-3">
																<input type="checkbox" class="form-check-input" id="remember" wire:model="remember">
																<label class="form-check-label" for="remember">Keep me signed in</label>
														</div>

														<div class="d-grid mt-3 gap-2">
																<button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
																		SIGN IN
																</button>
														</div>
												</form>

										</div>
								</div>
						</div>
				</div>
		</div>
</div>
