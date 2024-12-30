@extends('layouts.app')

@section('title', 'Danh sách Đơn vị')

@section('content')
    <h1>Danh sách Đơn vị</h1>

    @if(Auth::check() && Auth::user()->role === 'admin')
            <a href="{{ route('departments.create') }}" class="btn btn-primary mb-3">Thêm đơn vị</a>
        @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên Đơn vị</th>
                <th>Code</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody> 
            @foreach($departments as $department)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><a class="text-decoration-none" href="{{ route('departments.show', $department->id) }}">{{ $department->name }}</a></td>
                    <td>{{ $department->code }}</td>
                    <td>{{ $department->phone }}</td>
                    <td>{{ $department->email }}</td>

                    {{-- @if(Auth::check() && Auth::user()->role === 'admin') --}}
                    <td>
                        <a href="{{ route('departments.edit', $department) }}" class="btn btn-sm btn-warning {{ Auth::check() && Auth::user()->role === 'admin' ? '' : 'disabled' }} ">Sửa</a>
                        <form action="{{ route('departments.destroy', $department) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger  {{ Auth::check() && Auth::user()->role === 'admin' ? '' : 'disabled' }}" onclick="return confirm('Are you sure?')">Xóa</button>
                        </form>
                    </td>
                {{-- @endif --}}

                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
