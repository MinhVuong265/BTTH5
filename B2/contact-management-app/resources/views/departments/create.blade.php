@extends('layouts.app')

@section('title', 'Thêm mới Đơn vị')

@section('content')
    <h1>Thêm mới Đơn vị</h1>
    <form action="{{ route('departments.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên Đơn vị</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
@endsection
