@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center my-4">لوحة التحكم</h1>

        <div class="row">
            <!-- Manage Categories -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="fas fa-list-alt fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">إدارة الفئات</h5>
                        <p class="card-text text-muted">تحكم في جميع الفئات وأضف فئات جديدة بسهولة.</p>
                        <a href="{{ route('categories.index') }}" class="btn btn-primary btn-block">عرض الفئات</a>
                    </div>
                </div>
            </div>

            <!-- Manage Products -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="fas fa-box-open fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">إدارة المنتجات</h5>
                        <p class="card-text text-muted">تحكم في جميع المنتجات وأضف منتجات جديدة بسهولة.</p>
                        <a href="{{ route('products.index') }}" class="btn btn-primary btn-block">عرض المنتجات</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
