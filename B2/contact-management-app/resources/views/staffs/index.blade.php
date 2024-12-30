@extends('layouts.app')

@section('title', 'Danh sách Cán bộ')

@section('content')
    <h1>Danh sách Cán bộ</h1>
    @if(Auth::check() && Auth::user()->role === 'admin')
        <a href="{{ route('staffs.create') }}" class="btn btn-primary mb-3">Thêm cán bộ</a>
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
                <th>Tên</th>
                <th>Đơn vị</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($staff as $person)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><a class="text-decoration-none" href="{{ route('staffs.show', $person->id) }}">{{ $person->name }}</a></td>
                    <td>{{ $person->department->name }}</td>
                    <td>
                        <a href="{{ route('staffs.edit', $person->id) }}" class="btn btn-sm btn-warning {{ Auth::check() && Auth::user()->role === 'admin' ? '' : 'disabled' }} ">Sửa</a>
                        <form action="{{ route('staffs.destroy', $person->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger {{ Auth::check() && Auth::user()->role === 'admin' ? '' : 'disabled' }} " onclick="return confirm('Bạn có chắc chắn?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
