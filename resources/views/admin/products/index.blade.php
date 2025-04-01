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
            <h2><i class="fas fa-boxes"></i> إدارة المنتجات</h2>
            <a href="{{ route('products.create') }}" class="btn btn-success rounded-pill shadow-sm">
                <i class="fas fa-plus"></i> إضافة منتج جديد
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover shadow-sm border rounded-3">
                <thead class="table-dark text-center">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">الصورة</th>
                        <th scope="col">اسم المنتج</th>
                        <th scope="col">الفئة</th>
                        <th scope="col">السعر</th>
                        <th scope="col">الكمية</th>
                        <th scope="col">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($products as $product)
                        <tr>
                            <th scope="row">{{ $product->id }}</th>
                            <td>
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                        class="img-thumbnail rounded shadow-sm" width="60" height="60">
                                @else
                                    <i class="fas fa-box-open text-muted fa-2x"></i>
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td><strong class="text-success">{{ $product->price }} $</strong></td>
                            <td>{{ $product->quantity }}</td>
                            <td>
                                <a href="{{ route('products.edit', $product->id) }}"
                                    class="btn btn-info btn-sm rounded-pill shadow-sm">
                                    <i class="fas fa-edit"></i> تعديل
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm rounded-pill shadow-sm"
                                        onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                        <i class="fas fa-trash"></i> حذف
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{$products->links()}}
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
