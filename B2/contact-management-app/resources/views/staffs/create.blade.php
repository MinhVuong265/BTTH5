@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Thêm mới Nhân viên</h1>
    <form action="{{ route('staffs.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Họ tên</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input type="text" name="phone" class="form-control" id="phone">
        </div>
        <div class="mb-3">
            <label for="department_id" class="form-label">Phòng ban</label>
            <select name="department_id" class="form-control" id="department_id" required>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
        <a href="{{ route('staffs.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
