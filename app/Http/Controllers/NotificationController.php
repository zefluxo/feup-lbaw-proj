<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // notif types: 'Order', 'Wishlist', 'Misc'

    public function showNotifications() {
        $user = User::findOr(Auth::id(), fn() => to_route('login'));

        $notifications = $user->notifications;
        foreach($notifications as $notif) {
            $notif['sent_at'] = date("d-m-Y H:i", strtotime($notif['sent_at']));
        }

        return view('pages.notification', ['notifications' => $notifications->reverse()]);
    }

    static public function notifyWishlist(int $product_id, string $type) {
        if (!Auth::user()->is_admin) abort(403);

        $product = Product::findOr($product_id, fn() => abort(404, 'Product not found.'));        
        $users = $product->inWishlist;

        switch ($type) {
            case 'sale':
                foreach ($users as $user) {
                    Notification::insert([
                        'user_id' => $user->id,
                        'content_id' => $product->id,
                        'description' => "Your wishlisted item '$product->name'
                                          is $product->discount% off!",
                        'type' => "Wishlist"
                    ]);
                }
                break;
            case 'stock':
                foreach ($users as $user) {
                    Notification::insert([
                        'user_id' => $user->id,
                        'content_id' => $product->id,
                        'description' => "Your wishlisted item '$product->name'
                                          is back in stock!",
                        'type' => "Wishlist"
                    ]);
                }
                break;
            default:
                break;
        }

        return 200;
    }

    static public function notifyOrder(int $order_id, string $new_state) {
        if (!Auth::user()->is_admin) abort(403);

        $order = Order::findOr($order_id, fn() => abort(404, 'Order not found.'));
        $user = $order->user;
        Notification::insert([
            'user_id' => $user->id,
            'description' => "Order #$order_id has been updated: $new_state!",
            'type' => "Order"
        ]);

        return 200;
    }

    static public function notifyMisc(string $message) {
        if (!Auth::user()->is_admin) abort(403);        
        $users = User::where('is_admin', 0)->get();
        foreach($users as $user) {
                Notification::insert([
                    'user_id' => $user->id,
                    'description' => $message,
                    'type' => "Misc"
                ]);
        }

        return 200;
    }

    static public function notifyTicket(string $message, int $id) {
        if (!Auth::user()->is_admin) abort(403);   

        $user = User::findOr($id, fn() => abort(404, 'User not found.'));
        Notification::insert([
            'user_id' => $user->id,
            'description' => $message,
            'type' => "Misc"
        ]);

        return 200;
    }

}
