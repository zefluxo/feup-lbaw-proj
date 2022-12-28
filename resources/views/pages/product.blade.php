@include('partials.common.head', ['page' => "product"])
<main id="content-wrapper">
    <div id="product-grid">
        <div id="product-img-wrapper">
            <img src={{ url('/images/products/' . $product['id'] . '.jpg') }} id="product-img" class="tilt">
        </div>
        <div class="product-description">
            <div>
                <p id="product-name">{{$product->name}}</p>
                <a href="/artist/{{$product['artist_id']}}" id="product-artist">{{$product->artist->name}}</a>
                @if ($product->rating)
                    <p id="rating">{{$product->rating}}/5<span class="material-icons" style="color:var(--star);">star</span></p>                    
                @else
                    <p id="rating">N/A<span class="material-icons" style="color:var(--star);">star</span></p>
                @endif
            </div>
            <div id="genres-wrapper">
                @foreach ($genres as $genre)
                    <p class="product-genre">{{$genre['name']}}</p>
                @endforeach
            </div>
        </div>
        <div id="product-purchase">
            <p id="product-price">{{$product->price}} €</p>
            @include('partials.common.stock', ['stock' => $product->stock])
            {{-- @if (!Auth::user()->is_admin) --}}
            @if ($product->stock > 0)
                <form id="buy-form" action="{{route('buyProduct', ['id' => $product->id])}}">
                    <button type=submit class="confirm-button">BUY</button>
                </form>
                @else
                <button class="confirm-button" href="{{route('buyProduct', ['id' => $product->id])}}" disabled>BUY</button>
                @endif
                @if (in_array($product['id'], $wishlist))
                    <p class="wishlist-container" id="favorite-container-{{$product->id}}" onclick="toggleLike(event, {{$product['id']}})">Wishlisted<span class="material-icons fav-album">favorite</span>
                @else
                    <p class="wishlist-container" id="favorite-container-{{$product->id}}" onclick="toggleLike(event, {{$product['id']}})">Add to Wishlist<span class="material-icons fav-album">favorite_outline</span>
                @endif
                    </p>
            {{-- @endif --}}
        </div>
    </div>
    <div id="product-tracklist-wrapper">
        @include('partials.common.subtitle', ['title' => "Tracklist"])
        <div id="product-tracklist">
            <?php
                $arr = explode("\n", $product->description);
                foreach ($arr as $track) {?>
                <p class="track"><?= $track ?></p>
            <?php } ?>
        </div>
    </div>
    <div id="review-box-wrapper">
        @if (Auth::check() && isset($product->previous_review)) 
            @include('partials.common.subtitle', ['title' => "Your Previous Review"])
            @include('partials.forms.edit-review-form', ['review' => $product->previous_review])
        @else
            @include('partials.forms.review-form')
        @endif
    </div>
    @include('partials.common.subtitle', ['title' => "Reviews"])
    <div id="reviews-wrapper">
        <section id="reviews">
            @foreach ($reviews as $review)
                @include('partials.common.review', ['type' => "product", 'review' => $review])                
            @endforeach
        </section>
    </div>

    @include('partials.common.carousel', [
        'carouselTitle' => 'More like this...',
        'carouselId' => 'carousel-product',
        'type' => 'product',
        'content' => $products,
        'wishlist' => $wishlist
    ])
</main>
@include('partials.common.foot')