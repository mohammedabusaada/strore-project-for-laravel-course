@extends('layouts.admin')

@section('content')

    {{-- This is if the admin is trying to update the Category with an already existing name! --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-gradient text-dark text-center py-3"
                    style="background: linear-gradient(135deg, #ffc107, #ff851b);">
                    <h3 class="mb-0"><i class="fas fa-edit"></i> تعديل الفئة</h3>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('categories.update', $category->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold text-warning">اسم الفئة</label>
                            <input type="text" class="form-control rounded-3 shadow-sm" id="name" name="name"
                                value="{{ $category->name }}" required>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">
                                <i class="fas fa-save"></i> حفظ التعديلات
                            </button>
                            <a href="{{ route('categories.index') }}"
                                class="btn btn-outline-secondary px-4 rounded-pill shadow-sm">
                                <i class="fas fa-times-circle"></i> إلغاء
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


<script>
    document.addEventListener("DOMContentLoaded", function() {
        setTimeout(function() {
            let alertBox = document.querySelector(".alert-danger");
            if (alertBox) {
                alertBox.style.transition = "opacity 1s";
                alertBox.style.opacity = "0";
                setTimeout(() => alertBox.remove(), 1000);
            }
        }, 3000);
    });
</script>
