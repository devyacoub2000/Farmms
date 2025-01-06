@extends('front.app')

@section('title', 'My Cart')

@section('css')
<style>
    section {
        margin-top: 35px;
        padding: 20px;
        background: linear-gradient(to right, #e0f7fa, #ffffff);
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .table {
        width: 100%;
        margin-bottom: 1rem;
        background-color: #fff;
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .table thead th {
        background: linear-gradient(to right, #00796b, #004d40);
        color: #ffffff;
        text-align: center;
        padding: 15px;
        font-size: 16px;
        border: none;
    }

    .table tbody tr {
        background-color: #ffffff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .table tbody td {
        padding: 12px 15px;
        text-align: center;
        vertical-align: middle;
        color: #333;
    }

    .table tbody td:first-child {
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
    }

    .table tbody td:last-child {
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
    }

    .table tbody tr:hover {
        transform: scale(1.02);
        transition: all 0.3s ease-in-out;
    }

    .price {
        text-decoration: line-through;
        color: #d32f2f;

    }

    .btn {
        border-radius: 30px;
        padding: 10px 20px;
        transition: all 0.3s ease-in-out;
    }

    .btn-success {
        background: linear-gradient(to right, #4caf50, #388e3c);
        border: none;
        color: #fff;
    }

    .btn-success:hover {
        background: linear-gradient(to right, #388e3c, #2e7d32);
        transform: scale(1.1);
    }

    .btn-danger {
        background: linear-gradient(to right, #f44336, #d32f2f);
        border: none;
        color: #fff;
    }

    .btn-danger:hover {
        background: linear-gradient(to right, #d32f2f, #b71c1c);
        transform: scale(1.1);
    }
    footer {
        margin-top: 66px;
    }
    .empty-cart {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        color: #757575;
        margin-top: 50px;
    }

    .total {
        font-size: 18px;
        font-weight: bold;
        color: #004d40;
    }

    @media (max-width: 768px) {
        section {
            padding: 15px;
        }

        .table thead {
            display: none;
        }

        .table tbody td {
            display: block;
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
        }

        .table tbody td::before {
            content: attr(data-label);
            font-weight: bold;
            display: inline-block;
            width: 120px;
            color: #004d40;
        }

        .btn {
            display: block;
            width: 100%;
            margin: 10px 0;
        }

    }
</style>
@endsection

@section('content')
<section>
    @if($data->isNotEmpty())
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('admin.product') }}</th>
                <th>{{ __('admin.price') }}</th>
                <th>{{ __('admin.discount') }}</th>
                <th>{{ __('admin.quantity') }}</th>
                <th>{{ __('admin.total') }}</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($data as $cart)
            <tr>
                <td data-label="#">{{ $loop->iteration }}</td>
                <td data-label="{{ __('admin.product') }}">{{ $cart->product->trans_name }}</td>
                <td data-label="{{ __('admin.price') }}" class="{{ $cart->discount > 0 ? 'price' : '' }}">
                    ${{ number_format($cart->price, 2) }}
                </td>
                <td data-label="{{ __('admin.discount') }}">
                    ${{ number_format($cart->discount, 2) }}
                </td>
                <td data-label="{{ __('admin.quantity') }}">{{ $cart->quantity }}</td>
                <td data-label="{{ __('admin.total') }}" class="total">
                    ${{ number_format($cart->total, 2) }}
                </td>
                <td data-label="{{ __('admin.action') }}">
                    <form class="d-inline" action="{{ route('front.remove_cart', $cart->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return deletecontact(event);" class="btn btn-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @php $total += $cart->total; @endphp
            @endforeach
            <tr>
                <td colspan="5" class="text-right total">{{ __('admin.total') }}</td>
                <td class="total">${{ number_format($total, 2) }}</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="7" class="text-center">
                    <form action="{{route('front.complete_order')}}" method="POST">
                        @csrf
                        <input type="hidden" name="total" value="{{ $total }}">
                        <button type="submit" class="btn btn-success" onclick="return confirm('Are u Sure ?')">Complete Order</button>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
    @else
    <p class="empty-cart">Cart Empty</p>
    @endif
</section>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function deletecontact(e) {
        e.preventDefault();
        Swal.fire({
            title: "{{ __('admin.confirm_delete') }}",
            text: "{{ __('admin.delete_warning') }}",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "{{ __('admin.yes_delete') }}"
        }).then((result) => {
            if (result.isConfirmed) {
                e.target.closest('form').submit();
                Swal.fire("Yes Deleted", "Item Deleted", "success");
            }
        });
    }
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
</script>
@endsection
