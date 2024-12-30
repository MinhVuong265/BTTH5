@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chi tiết Nhân viên</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $staff->name }}</h5>
            <p><strong>Email:</strong> {{ $staff->email }}</p>
            <p><strong>Phòng ban:</strong> {{ $staff->department->name }}</p>
            <p><strong>Số điện thoại:</strong> {{ $staff->phone }}</p>
        </div>
    </div>
    <a href="{{ route('staffs.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
</div>
@endsection
