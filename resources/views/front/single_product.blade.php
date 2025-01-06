@extends('front.app')
@section('title', 'Product Details')

@section('content')
<section class="single_product">
    <div class="product-container">
        <!-- Image Box -->
        <div class="product-image">
            <img src="{{ asset('images/' . $item->image->path) }}" alt="Product Image">
        </div>

        <!-- Product Details -->
        <div class="product-details">
            <h2 class="product-title">{{ $item->Trans_Name }}</h2>
            <p class="product-description">{{ $item->Trans_Body }}</p>
            <p class="product-category"><strong>Category:</strong> {{ $item->category->Trans_Name }}</p>
            <p class="product-quantity"><strong>Available Quantity:</strong> {{ $item->quantity }}</p>

            @if($item->discount > 0)
                <p class="product-price">
                    <strong>Price:</strong> 
                    <span class="old-price">${{ $item->price }}</span>
                    <span class="discount-price">${{ $item->discount }}</span>
                </p>
            @else
                <p class="product-price">
                    <strong>Price:</strong> <span class="current-price">${{ $item->price }}</span>
                </p>
            @endif

            <!-- Add to Cart Button -->
               <form action="{{route('front.store_cart', $item->id)}}" method="POST">
                     @csrf
                    <div class="right-content">
                        <div class="quantity buttons_added">
                            <button type="button" class="btn-quantity minus">-</button>
                            <input type="number" step="1" min="1" max="{{$item->quantity}}" name="quantity" value="1" title="Qty" class="input-text qty text" size="4">
                            <button type="button" class="btn-quantity plus">+</button>
                        </div>
                    </div>

                <div class="button-container">
                    <button class="btn btn-primary btn-add-to-cart">Add To Cart</button>
                </div>
                </form>

                <div class="total">
                    <h4>Total: $<b class="final">{{$item->price}}</b></h4>
                </div>
        </div>
    </div>
</section>
@endsection

@section('css')
<style>
    /* General Styles */
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f8f9fa;
    }

    section.single_product {
        padding: 40px 20px;
        background-color: #ffffff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
        max-width: 1200px;
        margin: 30px auto;
    }

    .product-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        align-items: flex-start;
    }

    .product-image img {
        width: 100%;
        max-width: 500px;
        height: auto;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .product-details {
        flex: 1;
        max-width: 600px;
    }

    .product-title {
        font-size: 30px;
        font-weight: bold;
        color: #343a40;
        margin-bottom: 15px;
    }

    .product-description {
        font-size: 16px;
        color: #6c757d;
        margin-bottom: 20px;
        line-height: 1.6;
    }

    .product-category,
    .product-quantity,
    .product-price {
        font-size: 18px;
        color: #495057;
        margin-bottom: 15px;
    }

    .product-category strong,
    .product-quantity strong,
    .product-price strong {
        color: #343a40;
    }

    .product-price {
        font-size: 20px;
    }

    .old-price {
        text-decoration: line-through;
        color: #868e96;
        margin-right: 10px;
    }

    .discount-price {
        color: #dc3545;
        font-weight: bold;
    }

    .current-price {
        color: #28a745;
        font-weight: bold;
    }

    .btn-add-to-cart {
        padding: 12px 30px;
        font-size: 16px;
        font-weight: bold;
        color: #ffffff;
        background-color: #007bff;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
        margin-top: 20px;
    }

    .btn-add-to-cart:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    .btn-quantity {
        background-color: #f1f1f1;
        border: 1px solid #ced4da;
        padding: 5px 15px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 4px;
        transition: all 0.3s;
    }

    .btn-quantity:hover {
        background-color: #e2e6ea;
    }

    .qty {
        width: 60px;
        text-align: center;
        margin: 0 10px;
        border: 1px solid #ced4da;
        border-radius: 4px;
    }

    .button-container {
        margin-top: 20px;
    }

    .total {
        margin-top: 30px;
        font-size: 18px;
        color: #495057;
    }

    @media (max-width: 768px) {
        .product-container {
            flex-direction: column;
            align-items: center;
        }

        .product-details {
            text-align: center;
        }
    }
</style>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });

    @if(session('msg'))
        Toast.fire({
            icon: "success",
            title: "{{session('msg')}}"
        });
    @endif

    $(document).ready(function () {
        $('.buttons_added .minus').click(function () {
            let $qty = $(this).parent().find('.qty');
            let quantity = parseInt($qty.val());
            if (quantity > 1) {
                $qty.val(--quantity);
            }
            updateTotal();
        });

        $('.buttons_added .plus').click(function () {
            let $qty = $(this).parent().find('.qty');
            let maxQty = parseInt($qty.attr('max'));
            let quantity = parseInt($qty.val());
            if (quantity < maxQty) {
                $qty.val(++quantity);
            }
            updateTotal();
        });

        function updateTotal() {
            let priceElement = $('.product-price .discount-price, .product-price .current-price');
            let price = parseFloat(priceElement.text().replace('$', ''));
            let quantity = parseInt($('.qty').val());
            $('.final').text((price * quantity).toFixed(2));
        }

        // Initial calculation
        updateTotal();
    });
</script>
@endsection