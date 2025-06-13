<?php

namespace App\Http\Controllers;


use App\Models\KategoriItems;
use App\Models\MasterItem;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        return view('kategori_items.index.index');
    }

    public function search(Request $request)
    {
        $request->validate([
            'kode' => 'nullable|string',
            'nama' => 'nullable|string',
        ]);

        $kode = $request->kode;
        $nama = $request->nama;

        $data_search = KategoriItems::query()
            ->when(!empty($kode), fn($query) => $query->where('kode', $kode))
            ->when(!empty($nama), fn($query) => $query->where('nama', 'LIKE', '%'.$nama.'%'))
            ->select('kode', 'nama')
            ->orderBy('id')
            ->get();

        return json_encode([
            'status' => 200,
            'data' => $data_search
        ]);
    }

    public function formSubmit(Request $request, string $method, int $id = 0)
    {
//        $request->validate([
//            'kode' => 'required|string',
//            'nama' => 'required|string',
//        ]);

        if ($method == 'new') {
            $item = new KategoriItems();
            $kode = KategoriItems::count('id');
            ++$kode;
            $kode = str_pad($kode, 5, '0', STR_PAD_LEFT);
            $item->kode = $kode;
        } else {
            $item = KategoriItems::find($id);
        }
        $item->nama = $request->nama;
        $item->save();


        return redirect()->route('kategori.index');
    }

    public function formView(string $method, int $id = 0)
    {
        if ($method == 'new') {
            $item = [];
        } else {
            $item = KategoriItems::find($id);
        }
        $data['item'] = $item;
        $data['method'] = $method;
        return view('kategori_items.form.index', $data);
    }

    public function singleView(string $kode)
    {

        $data['data'] = KategoriItems::where('kode', $kode)->first();
        return view('kategori_items.single.index', $data);
    }

    public function delete(string $id)
    {
        $item = KategoriItems::find($id);
        if ($item) {
            $item->delete();
            return redirect()->route('kategori.index');
        } else {
            return redirect()->route('kategori.index');
        }
    }
}
