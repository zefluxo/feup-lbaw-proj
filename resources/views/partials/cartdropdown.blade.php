<div class="nav-dropdowns" id="cart-dropdown">
    <p>Cart</p>
    <div id="cart-wrapper">
        @if (session('cart'))
            @foreach (session('cart') as $id => $details)
                @include('partials.cartitem', ['id' => $id, 'details' => $details])
            @endforeach
        @else
            <p class="dropdown-warning">Nothing in cart.</p>
        @endif
    </div>
    <a href="{{ route('checkout')}}" class="nav-button"> Purchase </a>
</div>
