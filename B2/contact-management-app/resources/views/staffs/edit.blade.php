@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chỉnh sửa Nhân viên</h1>
    <form action="{{ route('staffs.update', $staff->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="name" class="form-label">Họ tên</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $staff->name }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ $staff->email }}" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input type="text" name="phone" class="form-control" id="phone" value="{{ $staff->phone }}">
        </div>
        <div class="mb-3">
            <label for="department_id" class="form-label">Phòng ban</label>
            <select name="department_id" class="form-control" id="department_id" required>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ $department->id == $staff->department_id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="{{ route('staffs.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
