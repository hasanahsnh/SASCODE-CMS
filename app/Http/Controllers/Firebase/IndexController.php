<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Firebase\UserController;
use App\Http\Controllers\Firebase\KatalogController;
use App\Http\Controllers\Firebase\PasarController;
use App\Http\Controllers\Firebase\BeritaController;
use App\Services\FirebaseService;

class IndexController extends Controller
{
    protected $userController;
    protected $katalogController;
    protected $pasarController;
    protected $beritaController;

    public function __construct(
        UserController $userController, 
        KatalogController $katalogController,
        PasarController $pasarController,
        BeritaController $beritaController) {
        $this->userController = $userController;
        $this->katalogController = $katalogController;
        $this->pasarController = $pasarController;
        $this->beritaController = $beritaController;
    }

    function dashboard() {
        $totalActiveUsers = $this->userController->getActiverUser();
        $totalKatalogs = $this->katalogController->countMotif();
        $totalPasars = $this->pasarController->countPasar();
        $totalArtikels = $this->beritaController->countArtikel();
        
        return view('pages.index', compact('totalActiveUsers', 'totalKatalogs', 'totalPasars', 'totalArtikels'));
    }
    
}
