@extends('layouts.app')

@section('title', 'Chỉnh sửa Đơn vị')

@section('content')
    <h1>Chỉnh sửa Đơn vị</h1>
    <form action="{{ route('departments.update', $department->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Tên Đơn vị</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $department->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
@endsection
