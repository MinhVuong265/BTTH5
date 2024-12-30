@extends('layouts.app')

@section('title', 'Chi tiết Đơn vị')

@section('content')
    <h1>{{ $department->name }}</h1>

    <p><strong>Code:</strong> {{ $department->code }}</p>
    <p><strong>Phone:</strong> {{ $department->phone }}</p>
    <p><strong>Email:</strong> {{ $department->email }}</p>
    <p><strong>Website:</strong> {{ $department->website }}</p>
    <p><strong>Address:</strong> {{ $department->address }}</p>

    <h2>Staff</h2>
    <ul>
        @forelse($department->staff as $staff)
            <li><a href="{{ route('staffs.show', $staff) }}">{{$staff->name}}</a></li>
        @empty
            <li>No staff found.</li>
        @endforelse
    </ul>
    @if(Auth::check() && Auth::user()->role === 'admin')
        <a href="{{ route('departments.edit', $department) }}" class="btn btn-warning">Edit</a>
    @endif

@endsection
