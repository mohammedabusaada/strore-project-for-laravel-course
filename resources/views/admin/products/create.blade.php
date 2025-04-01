@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-primary text-white text-center p-3">
                <h3><i class="fas fa-box me-2"></i> إضافة منتج جديد</h3>
            </div>
            <div class="card-body p-4">
                @if ($errors->any())
                    <div class="alert alert-danger rounded-3 mb-3">
                        <ul class="mb-0 list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label fw-bold"><i class="fas fa-tag me-1"></i> اسم
                                المنتج</label>
                            <input type="text" class="form-control rounded-3 shadow-sm" id="name" name="name"
                                value="{{ old('name') }}" placeholder="أدخل اسم المنتج" required>
                            <div class="form-text">أدخل اسماً وصفياً يعبر عن المنتج</div>
                        </div>

                        <div class="col-md-6 mb-43">
                            <label for="category_id" class="form-label fw-bold"><i class="fas fa-layer-group me-1"></i>
                                الفئة</label>
                            <select class="form-select rounded-3 shadow-sm" name="category_id" id="category_id" required>
                                <option value="" disabled selected>اختر فئة</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text">اختر الفئة المناسبة لتصنيف المنتج</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label fw-bold"><i class="fas fa-dollar-sign me-1"></i>
                                السعر</label>
                            <div class="input-group">
                                <span class="input-group-text rounded-start-3">$</span>
                                <input type="number" step="0.01" min="0"
                                    class="form-control rounded-end-3 shadow-sm" id="price" name="price"
                                    value="{{ old('price') }}" placeholder="0.00" required>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="quantity" class="form-label fw-bold"><i class="fas fa-boxes me-1"></i>
                                الكمية</label>
                            <input type="number" class="form-control rounded-3 shadow-sm" id="quantity" name="quantity"
                                value="{{ old('quantity') }}" placeholder="أدخل الكمية" required>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="description" class="form-label fw-bold"><i class="fas fa-align-left me-1"></i> وصف
                                المنتج</label>
                            <textarea class="form-control rounded-3 shadow-sm" id="description" name="description" rows="4"
                                placeholder="أدخل وصف المنتج">{{ old('description') }}</textarea>
                            <div class="form-text">يجب أن يكون الوصف أقل من 500 حرف</div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="image" class="form-label fw-bold"><i class="fas fa-image me-1"></i> صورة
                                المنتج</label>
                            <div class="input-group mb-2">
                                <input type="file" class="form-control rounded-3 shadow-sm" id="image" name="image"
                                    accept="image/*">
                            </div>
                            <div class="form-text mb-2">أضف صورة واضحة للمنتج(يفضل بخلفية بيضاء). الصيغ المدعومة: JPG, JPEG,
                                PNG, GIF</div>
                        </div>

                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-success rounded-pill shadow-sm px-4">
                                <i class="fas fa-plus"></i> إضافة المنتج
                            </button>
                            <a href="{{ route('products.index') }}" class="btn btn-secondary rounded-pill shadow-sm px-4">
                                <i class="fas fa-arrow-left"></i> إلغاء
                            </a>
                        </div>
                    </div>
                </form>
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
