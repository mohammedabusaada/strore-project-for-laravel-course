@extends('layouts.app')

@section('content')
    {{-- Alert the admin about the operation --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('info'))
        <div class="alert alert-warning">
            {{ session('info') }}
        </div>
    @endif


    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary"><i class="fas fa-layer-group"></i> إدارة الفئات</h2>
            <a href="{{ route('categories.create') }}" class="btn btn-success shadow-sm rounded-pill px-4">
                <i class="fas fa-plus"></i> إضافة فئة جديدة
            </a>
        </div>

        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">اسم الفئة</th>
                                <th scope="col">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <th scope="row">{{ $category->id }}</th>
                                    <td class="fw-bold">{{ $category->name }}</td>
                                    <td>
                                        <a href="{{ route('categories.edit', $category->id) }}"
                                            class="btn btn-info btn-sm rounded-pill shadow-sm">
                                            <i class="fas fa-edit"></i> تعديل
                                        </a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm rounded-pill shadow-sm"
                                                onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                                <i class="fas fa-trash-alt"></i> حذف
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


<script>
    document.addEventListener("DOMContentLoaded", function() {
        setTimeout(function() {
            let alertBox = document.querySelector(".alert");
            if (alertBox) {
                alertBox.style.transition = "opacity 1s";
                alertBox.style.opacity = "0";
                setTimeout(() => alertBox.remove(), 1000);
            }
        }, 3000);
    });
</script>
