<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use Xendit\Xendit;
use Xendit\Invoice;
use Xendit\Configuration;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;


class HomeController extends Controller
{
    public function index()
    {
        $user = User::where('usertype', 'user')->count();
        $product = Product::all()->count();
        $order = Order::all()->count();
        $deliverd = Order::where('status', 'Delivered')->count();
        return view('admin.index', compact('user', 'product', 'order', 'deliverd'));
    }

    public function home()
    {
        $product = Product::all();
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
        } else {
            $count = '';
        }
        return view('home.index', compact('product', 'count'));
    }

    public function login_home()
    {
        $product = Product::all();
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
        } else {
            $count = '';
        }
        return view('home.index', compact('product', 'count'));
    }

    public function product_details($id)
    {
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
        } else {
            $count = '';
        }
        $data = Product::find($id);  // Pastikan data produk tersedia
        return view('home.product_details', compact('data', 'count'));
    }

    public function add_cart($id)
    {
        $product_id = $id;
        $user = Auth::user();
        $user_id = $user->id;
        $data = new Cart;
        $data->user_id = $user_id;
        $data->product_id = $product_id;
        $data->save();
        toastr()->timeOut(10000)->closeButton()->addSuccess('Produk Berhasil di Tambahkan');
        return redirect()->back();
    }

    public function mycart()
    {
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
            $cart = Cart::where('user_id', $userid)->get();

        }
        return view('home.mycart', compact('count', 'cart'));
    }

    public function delete_cart($id)
    {
        $cart = Cart::find($id);
        if ($cart) {
            $cart->delete();
            toastr()->success('Item removed from cart successfully.');
        } else {
            toastr()->error('Item not found in cart.');
        }

        return redirect()->back();
    }

    public function confirm_order(Request $request)
{
    $userId = Auth::id();
    $cartItems = Cart::where('user_id', $userId)->get();

    if ($cartItems->isEmpty()) {
        return redirect()->back()->with('error', 'Keranjang Anda kosong.');
    }

    $name = $request->name;
    $address = $request->address;
    $phone = $request->phone;
    $paymentMethod = $request->payment_method;

    $orderList = [];

    foreach ($cartItems as $cartItem) {
        $order = new Order();
        $order->transaction_code = 'TRX-' . strtoupper(uniqid());
        $order->name = $name;
        $order->rec_address = $address;
        $order->phone = $phone;
        $order->user_id = $userId;
        $order->product_id = $cartItem->product_id;
        $order->payment_status = $paymentMethod;
        $order->status = $paymentMethod === 'transfer' ? 'menunggu pembayaran' : 'in progress';
        $order->resi = 'RESI-' . strtoupper(uniqid());

        $order->save();
        $orderList[] = $order;
    }

    toastr()->timeOut(10000)->closeButton()->addSuccess('Pesanan berhasil dengan pembayaran: ' . $paymentMethod);

    if ($paymentMethod === 'transfer') {
        // Tidak menghapus cart dulu — tunggu sampai user upload bukti
        return view('home.transfer', [
            'order' => $orderList[0],
            'orderList' => $orderList
        ]);
    }

    // Hanya jika COD: kosongkan cart langsung
    Cart::where('user_id', $userId)->delete();
    return redirect('/myorders');
}


    public function myorders()
    {
        $user = Auth::user()->id;
        $count = Cart::where('user_id', $user)->count();
        $order = Order::where('user_id', $user)->get();
        return view('home.order', compact('count', 'order'));
    }
    public function shop()
    {
        $product = Product::all();
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
        } else {
            $count = '';
        }
        return view('home.shop', compact('product', 'count'));
    }
    public function why()
    {
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
        } else {
            $count = '';
        }
        return view('home.why', compact('count'));
    }
    public function testimonial()
    {
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
        } else {
            $count = '';
        }
        return view('home.testimonial', compact('count'));
    }
    public function contact()
    {
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
        } else {
            $count = '';
        }
        return view('home.contact', compact('count'));
    }
    public function searchCategory(Request $request)
{
    $keyword = $request->category;
    $product = Product::where('category', 'LIKE', "%$keyword%")->get();

    return view('home.shop', compact('product', 'keyword'));
}
public function showConfirmationPage()
{
    $cart = Cart::with('product')->where('user_id', Auth::id())->get();

    if ($cart->isEmpty()) {
        return redirect('/')->with('error', 'Keranjang Anda kosong.');
    }

    return view('home.konfirmasi_pesanan', compact('cart'));
}
public function printAllInvoices()
{
    $orders = Order::with('product')
        ->where('user_id', Auth::id())
        ->get();

    if ($orders->isEmpty()) {
        return redirect()->back()->with('error', 'Tidak ada pesanan ditemukan.');
    }

    $pdf = Pdf::loadView('home.invoice_all', compact('orders'));
    return $pdf->stream('semua_invoice.pdf'); // Atau ->download() untuk langsung unduh
}
public function cancelOrder($id)
{
    $order = Order::where('id', $id)->where('user_id', Auth::id())->first();

    if ($order && $order->status == 'in progress') {
        $order->delete(); // Atau ubah status jadi 'cancelled' jika ingin disimpan
        return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan.');
    }

    return redirect()->back()->with('error', 'Pesanan tidak dapat dibatalkan.');
}
public function showTransferPage()
{
    $order = Order::where('user_id', Auth::id())
                ->latest()
                ->first(); // Ambil order terbaru dari user

    if (!$order) {
        return redirect('/')->with('error', 'Pesanan tidak ditemukan.');
    }

    return view('home.transfer', compact('order'));
}
public function confirm_payment($id)
{
    $order = Order::findOrFail($id);

    if ($order->user_id !== Auth::id()) {
        abort(403);
    }

    $order->status = 'waiting'; // atau 'menunggu konfirmasi'
    $order->save();

    // Setelah user upload & konfirmasi → kosongkan cart
    Cart::where('user_id', Auth::id())->delete();

    return redirect('/myorders')->with('success', 'Pembayaran dikonfirmasi, pesanan sedang diproses.');
}

public function uploadTransferProof(Request $request, $id)
{
    $request->validate([
        'transfer_proof' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $order = Order::findOrFail($id);

    if ($request->hasFile('transfer_proof')) {
        $file = $request->file('transfer_proof');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('bukti_transfer'), $filename);

        $order->bukti_transfer = $filename;
        $order->save();
    }

    $orderList = Order::where('resi', $order->resi)->with('product')->get();

    toastr()->success('Bukti transfer berhasil diunggah.');
    return view('home.transfer', compact('order', 'orderList'));
}
public function deleteItems(Request $request)
{
    $itemIds = $request->input('delete_items', []);

    if (!empty($itemIds)) {
        Cart::whereIn('id', $itemIds)
            ->where('user_id', Auth::id())
            ->delete();

        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }

    return redirect()->back()->with('error', 'Tidak ada item yang dipilih untuk dihapus.');
}

}