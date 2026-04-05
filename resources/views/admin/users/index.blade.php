@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid p-4 p-lg-5">

        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 mb-lg-5 mb-xl-6">
            <div>
                <h1 class="h3 mb-0">User Management</h1>
                {{-- <p class="text-muted mb-0">Manage users, roles, and permissions</p> --}}
            </div>
            <div class="d-flex gap-2">
                {{-- <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#importModal">
                    <i class="bi bi-upload me-2"></i>Import Users
                </button>
                <button type="button" class="btn btn-outline-secondary" @click="exportUsers()">
                    <i class="bi bi-download me-2"></i>Export
                </button> --}}
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">
                    <i class="bi bi-person-plus me-2"></i>Add User
                </button>
            </div>
        </div>

        {{-- Thông báo lỗi boostrap form --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Users Management Container -->
        <div x-data="userTable">
            <!-- Users Table -->
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="card-title mb-0">Users Directory</h5>
                        </div>
                        <div class="col-auto">
                            <div class="d-flex gap-2">
                                <!-- Search -->
                                <div class="position-relative">
                                    <input type="search" class="form-control form-control-sm" placeholder="Search users..." style="width: 200px;">
                                    <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-2 text-muted"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                

                    <!-- Table -->
                    {{-- delete-all --}}
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 40px;">
                                        <input type="checkbox"  id="select-all" class="user-select-checkbox">
                                    </th>
                                    <th>
                                        STT
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th style="width: 120px;" class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="user-select-checkbox">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm" style="width: 40px;" value="{{ $user->numb??0 }}" >
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('assets/admin/images/avatar-placeholder.svg') }}"
                                                    class="rounded-circle me-2" width="32" height="32"
                                                    alt="Avatar">
                                                <div>
                                                    <div class="fw-medium">{{ $user->fullname??'' }}</div>
                                                    {{-- <small class="text-muted" >ID: {{ $user->id }}</small> --}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $user->email??'' }}</td>
                                        <td>
                                            <span class="badge bg-primary">{{ $user->role??'' }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success">{{ $user->status??'' }}</span>
                                        </td>
                                        <td class="text-end">
                                            <div class="group-box-action">
                                                <ul class="box-action-menu list-unstyled mb-0 d-flex gap-3  justify-content-end">
                                                    <li><a class="box-action-item edit-item-modal" alt="Edit User" data-action="edit" data-id="{{ $user->id ?? 0 }}" data-url="/admin/users/edit">
                                                            <i class="bi bi-pencil"></i>
                                                        </a></li>
                                                    <li><a class="box-action-item text-danger delete-item"
                                                            alt="Delete User" data-action="delete" data-id="{{ $user->id ?? 0 }}" data-url="/admin/users/delete">
                                                            <i class="bi bi-trash"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center p-3">
                        <div class="text-muted">
                            Showing <span x-text="(currentPage - 1) * itemsPerPage + 1"></span> to
                            <span x-text="Math.min(currentPage * itemsPerPage, filteredUsers.length)"></span> of
                            <span x-text="filteredUsers.length"></span> results
                        </div>
                        <nav>
                            <ul class="pagination pagination-sm mb-0">
                                <li class="page-item" :class="{ 'disabled': currentPage === 1 }">
                                    <a class="page-link" href="#"
                                        @click.prevent="goToPage(currentPage - 1)">Previous</a>
                                </li>
                                <template x-for="page in visiblePages" :key="page">
                                    <li class="page-item" :class="{ 'active': page === currentPage }">
                                        <a class="page-link" href="#" @click.prevent="goToPage(page)"
                                            x-text="page"></a>
                                    </li>
                                </template>
                                <li class="page-item" :class="{ 'disabled': currentPage === totalPages }">
                                    <a class="page-link" href="#"
                                        @click.prevent="goToPage(currentPage + 1)">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

        </div> <!-- End Users Management Container -->

    </div>

    <!-- User Modal (Add/Edit) -->
    <div class="modal fade" id="userModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" id="userForm" action="{{ route('adduser') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <input type="hidden" name="id" id="userId">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="fullname" required>
                            </div>
                 
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="tel" class="form-control" name="phone">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control" name="address">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Role</label>
                                <select class="form-select" name="role" required>
                                    <option value="">Select Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                    {{-- <option value="moderator">Moderator</option> --}}
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status" required>
                                    <option value="">Select Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="pending">Pending</option>
                                </select>
                            </div>
         
                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" >
                            </div>
                            <div class="col-12">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation" >
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary saveUser" >Save User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Import Modal -->
    {{-- <div class="modal fade" id="importModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Users</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Upload CSV File</label>
                        <input type="file" class="form-control" accept=".csv">
                        <div class="form-text">Upload a CSV file with columns: name, email, role, status</div>
                    </div>
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>CSV Format:</strong> name, email, role, status<br>
                        <small>Example: John Doe, john@example.com, user, active</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Import Users</button>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

{{-- @vite('resources/js/app.js') --}}
