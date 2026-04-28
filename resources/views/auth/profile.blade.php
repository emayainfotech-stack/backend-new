@extends('layouts.master')

@section('title', 'Profile')

@section('content')
 
    <div class="row">
        <!-- Profile Info Card -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    @php
                        $role = strtolower((string) ($user->role ?? ''));
                        $initial = $role === 'admin' ? 'A' : ($role === 'reporter' ? 'R' : strtoupper(substr((string) ($user->name ?? 'U'), 0, 1)));
                    @endphp
                    <div class="mb-3">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold mx-auto"
                             style="width:120px;height:120px;font-size:48px;line-height:1;">
                            {{ $initial }}
                        </div>
                    </div>
                    <h4 class="mb-1">{{ $user->name ?? 'User' }}</h4>
                    <p class="text-secondary mb-3">{{ $user->email }}</p>
                    <div class="d-flex justify-content-center gap-2">
                        <span class="badge bg-primary">{{ $user->role ?? 'User' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Update Profile Form -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Update Profile</h4>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $user->name) }}" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $user->email) }}" 
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Update Password Form -->
            <div class="card mt-4">
                <div class="card-body">
                    <h4 class="card-title mb-4">Change Password</h4>

                    <form action="{{ route('profile.password') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="password" class="form-label">New Password <span class="text-danger">*</span></label>
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password" 
                                   required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm New Password <span class="text-danger">*</span></label>
                            <input type="password" 
                                   class="form-control @error('password_confirmation') is-invalid @enderror" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   required>
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 
@endsection
