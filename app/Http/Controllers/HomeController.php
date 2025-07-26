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

    $shippingRates = [
        'JNE' => 20000,
        'J&T' => 18000,
        'SiCepat' => 17000,
        'Pos Indonesia' => 15000,
        'AnterAja' => 16000,
        'GrabExpress' => 25000,
        'GoSend' => 24000,
    ];

    $transactionCode = 'TRX-' . strtoupper(uniqid());
    $resiCode = 'RESI-' . strtoupper(uniqid());

    $orderData = [
        'transaction_code' => $transactionCode,
        'name' => $request->name,
        'rec_address' => $request->address,
        'phone' => $request->phone,
        'user_id' => $userId,
        'payment_status' => $request->payment_method,
        'status' => $request->payment_method === 'transfer' ? 'menunggu pembayaran' : 'in progress',
        'resi' => $resiCode,
        'shipping_provider' => $request->shipping_provider,
        'shipping_cost' => $shippingRates[strtoupper($request->shipping_provider)] ?? 0,
    ];

    // Simpan ke session sementara
    session([
        'pending_order' => $orderData,
        'pending_cart' => $cartItems,
    ]);

    return redirect()->route('transfer_view');
}


    public function myorders()
    {
    $userId = Auth::id();

    $orders = Order::with('product')
        ->where('user_id', $userId)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('home.order', compact('orders')); // ✅ Kirim variable orders
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

    // Ambil semua order dengan resi yang sama
    $orderList = Order::where('resi', $order->resi)
                    ->with('product')
                    ->get();

    return view('home.transfer', compact('order', 'orderList'));
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
    $orderData = session('pending_order');
    $cartItems = session('pending_cart');

    if (!$orderData || !$cartItems) {
        return redirect('/')->with('error', 'Data pesanan tidak ditemukan.');
    }

    foreach ($cartItems as $cartItem) {
        $order = new Order($orderData);
        $order->product_id = $cartItem->product_id;

        if ($request->hasFile('transfer_proof')) {
            $file = $request->file('transfer_proof');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('bukti_transfer'), $filename);
            $order->bukti_transfer = $filename;
        }

        $order->save();
    }

    Cart::where('user_id', Auth::id())->delete();
    session()->forget(['pending_order', 'pending_cart']);

    return redirect()->back()->with('success', 'Bukti transfer berhasil diupload.');
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
public function generateInvoice($id)
{
    $order = Order::with('product')->findOrFail($id);

    // Jika 1 order memiliki banyak produk:
    $orderList = $order->orderItems()->with('product')->get();

    // Kalau produk disimpan langsung di relasi order -> product:
    // $orderList = collect([$order]);

    return view('home.invoice', compact('order', 'orderList'));

    // atau jika pakai PDF:
    // $pdf = Pdf::loadView('home.invoice', compact('order', 'orderList'));
    // return $pdf->stream('Invoice-' . $order->transaction_code . '.pdf');
}
public function invoice($id)
{
    $order = Order::with('product')->findOrFail($id);
    $orderList = Order::where('resi', $order->resi)->with('product')->get();
    return view('home.invoice', compact('order', 'orderList'));
}

public function setBankTujuan(Request $request, $id)
{
    $request->validate([
        'bank_tujuan' => 'required|in:bri,bni,mandiri'
    ]);

    $order = Order::findOrFail($id);
    $order->bank_tujuan = $request->bank_tujuan;
    $order->save();

    return redirect()->back()->with('success', 'Bank tujuan berhasil disimpan.');
}


}