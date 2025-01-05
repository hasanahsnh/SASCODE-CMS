<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Contract\Storage;
use Kreait\Firebase\Exception\FirebaseException;

class PasarController extends Controller
{
    protected $database;
    protected $refTableName;
    protected $storage;
    public function __construct(Database $database, Storage $storage) {
        $this->database = $database;
        $this->refTableName = 'pasar';
        $this->storage = $storage;
    }

    function index() {
        $pasars = $this->database->getReference($this->refTableName)->getValue();
        return view('pages.ka-pasar', compact('pasars'));

        if ($pasars === null) {
            $pasars = [];
        }
        dd($pasars);
    }

    function countPasar() {
        $totalPasar = $this->database->getReference($this->refTableName)->getValue();
        if (empty($totalPasar)) {
            return 0;
        }
        $filteredPasars = array_filter($totalPasar, function ($item) {
            return !is_null($item) && !empty($item);
        });

        return count($filteredPasars);
    }

    function store(Request $request) {

        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'deskripsi_toko' => 'required|string|max:255',
            'no_telp_toko' => 'required|string|max:20',
            'alamat_toko' => 'required|string|max:1000',
            'foto_toko' => 'required|array',
            'foto_toko.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'url_instagram' => 'nullable|string|max:100',
        ]);
    
        $fotoTokoUrls = [];

        if ($request->hasFile('foto_toko')) {
            foreach ($request->file('foto_toko') as $file) {
                $uploadedFile = $this->storage->getBucket()->upload(
                    fopen($file->getRealPath(), 'r'),
                    ['name' => 'pasar/' . $file->getClientOriginalName()]
                );
                $fotoTokoUrls[] = $uploadedFile->info()['mediaLink'];
            }
        }
    
        $existingItems = $this->database->getReference($this->refTableName)->getValue();
        $newId = 1;
        if ($existingItems !== null) {
            $existingIds = array_keys($existingItems);
            $newId = max($existingIds) + 1;
        }
    
        $postData = [
            'namaToko' => $request->nama_toko,
            'deskripsiToko' => $request->deskripsi_toko,
            'noTelpToko' => $request->no_telp_toko,
            'alamatToko' =>$request->alamat_toko,
            'fotoTokoUrl' => $fotoTokoUrls,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'instagramUrl' => $request->url_instagram ?: null,
        ];
    
        $this->database->getReference("{$this->refTableName}/{$newId}")->set($postData);
    
        return redirect()->route('ka-pasar')->with('success', 'Toko berhasil disimpan');
    }

    function edit($id) {
        $key = $id;
        $editData = $this->database->getReference($this->refTableName)->getChild($key)->getValue();
        if ($editData) {
            return view('pages.ka-pasar', compact('editData', 'key'));
        } else {
            return redirect()->route('ka-pasar')->with('status', 'ID Toko tidak ditemukan');
        }
    }

    function update(Request $request, $id) {
        $key = $id;
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'deskripsi_toko' => 'required|string|max:255',
            'no_telp_toko' => 'required|string|max:20',
            'alamat_toko' => 'required|string|max:1000',
            'edit_latitude' => 'required|numeric',
            'edit_longitude' => 'required|numeric',
            'foto_toko' => 'array',
            'foto_toko.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'url_instagram' => 'nullable|string|max:100',
        ]);

        $fotoTokoUrls = [];

        $updateData = [
            'namaToko' => $request->nama_toko,
            'deskripsiToko' => $request->deskripsi_toko,
            'noTelpToko' => $request->no_telp_toko,
            'alamatToko' => $request->alamat_toko,
            'latitude' => $request->edit_latitude,
            'longitude' => $request->edit_longitude,
            'instagramUrl' => $request->url_instagram ?: null,
        ];

        if ($request->hasFile('foto_toko')) {
            foreach ($request->file('foto_toko') as $file) {
                if ($file->isValid()) {
                    try {
                        $uploadedFile = $this->storage->getBucket()->upload(
                            file_get_contents($file->getRealPath()),
                            ['name' => 'pasar/' . $file->getClientOriginalName()]
                        );
        
                        $fotoTokoUrls[] = $uploadedFile->info()['mediaLink'];
                        $updateData['fotoTokoUrl'] = $fotoTokoUrls;
                    } catch(FirebaseException $e) {
                        return redirect()->route('ka-pasar')->with('error', 'Gagal mengunggah gambar: ' . $e->getMessage());
                    }
                } 
            }
        }

        //dd($updateData);

        $resUpdate = $this->database->getReference($this->refTableName.'/'.$key)->update($updateData);
        if ($resUpdate) {
            return redirect()->route('ka-pasar')->with('success', 'Toko berhasil disimpan');
        } else {
            return redirect()->route('ka-pasar')->with('error', 'Toko gagal disimpan');
        }
        
    }

    function destroy($id) {
        $key = $id;
        $hapusData = $this->database->getReference($this->refTableName.'/'.$key)->remove();
        if ($hapusData) {
            return redirect()->route('ka-pasar')->with('success', 'Toko berhasil dihapus');
        } else {
            return redirect()->route('ka-pasar')->with('error', 'Toko gagal dihapus');
        }
    }

    function downloadDataPasar() {

        $items = $this->database->getReference($this->refTableName)->getValue();

        if ($items === null || empty($items)) {
            return redirect()->back()->with('error', 'Tidak ada data yang tersedia untuk diunduh.');
        }

        $csvData = "ID, Nama Toko, Alamat, No. Telp, Deskripsi, Latitude, Longitude\n";
        $images = [];

        foreach ($items as $id => $item) {
            if (is_array($item) && isset($item['namaToko'], $item['alamatToko'], $item['noTelpToko'], $item['deskripsiToko'], $item['latitude'], $item['longitude'])) {
                $csvData .= "{$id}, " . implode(", ", [
                    $item['namaToko'],
                    $item['alamatToko'],
                    $item['noTelpToko'],
                    $item['deskripsiToko'],
                    $item['latitude'],
                    $item['longitude']
                ]) . "\n";

                $namaToko = $item['namaToko'];

                if (!empty($item['fotoTokoUrl'])) {
                    // Jika `fotoTokoUrl` adalah array, iterasi setiap URL
                    if (is_array($item['fotoTokoUrl'])) {
                        foreach ($item['fotoTokoUrl'] as $index => $url) {
                            if (is_string($url)) {
                                $imageContent = @file_get_contents($url);
                                if ($imageContent !== false) {
                                    // Tambahkan indeks untuk membedakan file jika ada banyak URL
                                    $images["foto toko/{$namaToko}_{$index}.png"] = $imageContent;
                                }
                            }
                        }
                    } elseif (is_string($item['fotoTokoUrl'])) {
                        // Jika `fotoTokoUrl` adalah string tunggal, langsung unduh
                        $imageContent = @file_get_contents($item['fotoTokoUrl']);
                        if ($imageContent !== false) {
                            $images["foto toko/{$namaToko}.png"] = $imageContent;
                        }
                    }
                }
            }
        }

        $zip = new \ZipArchive();
        $zipFileName = storage_path('app/public/data-pasar.zip');

        if ($zip->open($zipFileName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
            $zip->addFromString('data-pasar.csv', $csvData);

            foreach ($images as $fileName => $content) {
                $zip->addFromString($fileName, $content);
            }

            $zip->close();
        } else {
            return redirect()->back()->with('error', 'Gagal membuat file zip.');
        }

        return response()->download($zipFileName)->deleteFileAfterSend(true);
    }
}
