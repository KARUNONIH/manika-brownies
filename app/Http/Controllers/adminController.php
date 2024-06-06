<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class adminController extends Controller
{
    public function index(Request $request)
    {
        //     $results = DB::table('transactions')
        // ->where('status', '=', 'selesai')
        // ->where('created_at', '>=', Carbon::now()->subDays(12))
        // ->select(DB::raw('AVG(total_harga) as average_income'))
        // ->first();

        $categories = Kategori::orderBy('namaKategori', 'asc')->get();


        $totalIncomeTodayResult = DB::table('transactions')
            ->where('status', '=', 'selesai')
            ->whereDate('updated_at', Carbon::today())
            ->select(DB::raw('SUM(total_harga) as total_harga_today'))
            ->first();

        $totalIncomeYesterdayResult = DB::table('transactions')
            ->where('status', '=', 'selesai')
            ->whereDate('updated_at', Carbon::yesterday())
            ->select(DB::raw('SUM(total_harga) as total_harga_yesterday'))
            ->first();

        $totalIncomeToday = $totalIncomeTodayResult ? $totalIncomeTodayResult->total_harga_today : 0;
        $totalIncomeYesterday = $totalIncomeYesterdayResult ? $totalIncomeYesterdayResult->total_harga_yesterday : 0;


        if ($totalIncomeYesterday > 0) {
            $percentageIncome = (($totalIncomeToday - $totalIncomeYesterday) / $totalIncomeYesterday) * 100;
        } else {
            $percentageIncome = $totalIncomeToday > 0 ? 100 : 0;
        }

        $products = Product::all();
        $originalOrder = Product::pluck('kode_kue')->toArray();
        $products = Product::orderBy('kode_kue')->get();

        foreach ($products as $product) {
            $newOrder = array_search($product->id, $originalOrder);
            $product->update(['order' => $newOrder]);
        }

        // $selectedMonth = $request->input('tanggal', date('Y-m'));
        // $distinctDates = Transaction::distinct()
        //     ->orderBy('created_at')
        //     ->pluck('created_at')
        //     ->map(function ($date) {
        //         return $date->format('Y-m');
        //     })
        //     ->unique();

        $transactionsDetail = DB::table('transactions')
            ->select('nama_pembeli', 'nomor_telepon', 'alamat', 'catatan', 'created_at', 'status',  DB::raw('SUM(total_harga) as total_harga'))
            ->groupBy('nama_pembeli', 'nomor_telepon', 'alamat', 'catatan', 'created_at', 'status')
            ->get();

        $transactions = DB::table('transactions as t')
            ->join('products as p', 't.kode_kue', '=', 'p.kode_kue')
            ->select('t.kode_transaksi', 't.nama_pembeli', 't.created_at', 'p.nama_kue', 't.jumlah_kue', 't.total_harga', DB::raw('(t.total_harga / t.jumlah_kue) as harga_satuan'))
            ->orderBy('t.nama_pembeli')
            ->orderBy('t.created_at')
            ->get();

        $penjualan = DB::table('transactions')
            ->join('products', 'transactions.kode_kue', '=', 'products.kode_kue')
            ->selectRaw('products.nama_kue, products.gambar_kue, COUNT(*) AS jumlah_transaksi, SUM(transactions.jumlah_kue) AS total_kue_terjual')
            ->selectRaw('ROUND((SUM(transactions.jumlah_kue) / CAST((SELECT SUM(jumlah_kue) FROM transactions WHERE status = \'selesai\') AS DECIMAL(10, 2))) * 100, 2) AS persentase_penjualan')
            ->where('transactions.status', '=', 'selesai')
            ->groupBy('products.kode_kue')
            ->orderBy('persentase_penjualan', 'DESC')
            ->get();

        $historiTransaksi = DB::table('transactions')
        ->select('nama_pembeli', 'updated_at' , 'status')
        ->groupBy('nama_pembeli', 'updated_at' , 'status')
        ->orderBy('updated_at', 'DESC')
        ->get();

        $produkTerjualHariIni = DB::table('transactions')
            ->where('status', '=', 'selesai')
            ->whereDate('updated_at', '=', Carbon::today())
            ->sum('jumlah_kue');

        $produkTerjualKemarin = DB::table('transactions')
            ->where('status', '=', 'selesai')
            ->whereDate('updated_at', '=', Carbon::yesterday())
            ->sum('jumlah_kue');

            $produkTerjualHariinicek = $produkTerjualHariIni ? $produkTerjualHariIni : 0;
            $produkTerjualKemarincek = $produkTerjualKemarin ? $produkTerjualKemarin : 0;

            if ($produkTerjualKemarincek > 0) {
                $percentageProduct = (($produkTerjualHariinicek - $produkTerjualKemarincek) / $produkTerjualKemarincek) * 100;
            } else {
                $percentageProduct = $produkTerjualHariinicek > 0 ? 100 : 0;
            }

            $totalProdukTerjual = DB::table('transactions')
            ->where('status', '=', 'selesai')
            ->sum('jumlah_kue');

            $totalIncome = DB::table('transactions')
            ->where('status', '=', 'selesai')
            ->select(DB::raw('SUM(total_harga) as total_harga'))
            ->first();

        // $transactionss = Transaction::whereYear('created_at', '=', substr($selectedMonth, 0, 4))
        //     ->whereMonth('created_at', '=', substr($selectedMonth, 5, 2))
        //     ->get();
        return view('admin.app', compact('products', 'transactions','transactionsDetail', 'totalIncomeToday', 'percentageIncome', 'penjualan', 'historiTransaksi', 'produkTerjualHariIni', 'percentageProduct', 'totalProdukTerjual', 'totalIncome', 'categories'));
    }
}
