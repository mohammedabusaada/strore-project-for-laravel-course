@extends('layouts.front')
@section('content')

    <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach ($latestProducts as $index => $product)
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="{{ $index }}"
                    class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}"
                    aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>

        <div class="carousel-inner">
            @foreach ($latestProducts as $index => $product)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <img src="{{ asset('storage/' . $product->image) }}" class="d-block w-100" alt="{{ $product->name }}">
                    <div class="container">
                        <div class="carousel-caption {{ $index % 2 == 0 ? 'text-start' : 'text-end' }}">
                            <h1>{{ $product->name }}</h1>
                            <p>{{ $product->description }}</p>
                            <p><a class="btn btn-lg btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#productModal{{ $product->id }}">عرض المنتج</a></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">السابق</span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">التالي</span>
        </button>
    </div>


    <div class="spacer my-5"></div>

    <div class="container mt-4 text-center">
        <h3 class="mb-4 fw-bold">اختر فئة المنتجات</h3>

        <div class="category-filter d-flex flex-wrap justify-content-center gap-3 mb-4">
            <a href="{{ route('home') }}" class="category-item {{ request('category') ? '' : 'active' }}">
                <div class="btn btn-outline-primary btn-lg px-4">الكل</div>
            </a>

            @foreach ($categories as $category)
                <a href="{{ route('home', ['category' => $category->id]) }}"
                    class="category-item {{ request('category') == $category->id ? 'active' : '' }}">
                    <div class="btn btn-outline-primary btn-lg px-4">{{ $category->name }}</div>
                </a>
            @endforeach
        </div>
    </div>


    <div class="container marketing mt-4">
        @if ($products->count() > 0)
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-lg-4 text-center">
                        <img src="{{ asset('storage/' . $product->image) }}" class="rounded-circle" width="140"
                            height="140" alt="{{ $product->name }}">
                        <h2 class="fw-normal">{{ $product->name }}</h2>

                        {{-- Showing a Piece of the Description --}}
                        <p>
                            {{ Str::limit($product->description, 24) }} <!-- Only 24 characters of desc -->
                        </p>

                        <button class="btn btn-secondary" data-bs-toggle="modal"
                            data-bs-target="#productModal{{ $product->id }}">عرض التفاصيل</button>

                        {{-- Popup Window --}}
                        <div class="modal fade" id="productModal{{ $product->id }}" tabindex="-1"
                            aria-labelledby="productModalLabel{{ $product->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="productModalLabel{{ $product->id }}">
                                            {{ $product->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{ asset('storage/' . $product->image) }}" class="d-block mx-auto w-50"
                                            alt="{{ $product->name }}">
                                        <h3>الفئة: {{ $product->category->name }}</h3>
                                        <p><strong>الوصف:</strong> {{ $product->description }}</p>
                                        <p><strong>السعر:</strong> {{ $product->price }} $</p>
                                        <p><strong>الكمية المتوفرة:</strong> {{ $product->quantity }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">إغلاق</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info text-center my-5">
                <h4>لا توجد منتجات في هذه الفئة</h4>
                <p>يرجى اختيار فئة أخرى أو العودة إلى <a href="{{ route('home') }}" class="alert-link">جميع المنتجات</a>
                </p>
            </div>
        @endif
        <hr class="featurette-divider">
    </div>

@endsection
