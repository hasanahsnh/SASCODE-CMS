<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Beranda</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/base/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/card/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <div class="_navbar">
        @include('partials._navbar')
    </div>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <div class="_sidebar">
        @include('partials._sidebar')
      </div>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                  <div class="mr-md-3 mr-xl-5">
                    <h4>Selamat datang kembali, Manajer Konten!</h4>
                    <p class="mb-md-0">
                      Ciptakan dan kembangkan konten yang luar biasa!
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body dashboard-tabs p-0">
                  <ul class="nav nav-tabs px-4" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">RINGKASAN</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="sales-tab" data-toggle="tab" href="#petunjuk" role="tab" aria-controls="sales" aria-selected="false">PETUNJUK</a>
                    </li>
                  </ul>
                  <div class="tab-content py-0 px-0">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-account-multiple mr-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Pengguna Aktif</small>
                            <h5 class="mr-2 mb-0">{{ $totalActiveUsers}} pengguna</h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-barley mr-3 icon-lg text-success"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Konten Motif</small>
                            <h5 class="mr-2 mb-0">{{ $totalKatalogs}} motif</h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-basket mr-3 icon-lg text-warning"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Mitra x SASCODE</small>
                            <h5 class="mr-2 mb-0">{{ $totalPasars}} toko</h5>
                          </div>
                        </div>
                        <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-newspaper mr-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Konten Artikel</small>
                            <h5 class="mr-2 mb-0">{{ $totalArtikels}} artikel</h5>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="tab-pane fade" id="petunjuk" role="tabpanel" aria-labelledby="sales-tab">
                      <h4 style="margin-left: 20px; margin-top: 20px; color: #522258;">Publikasi</h4>
                      <div class="d-flex flex-wrap justify-content-xl-between">

                        <div class="card-card">
                          <div class="card-card-header">
                            <h4>S-Katalog</h4>
                          </div>
                          <div class="card-card-body">
                            <p><strong>Ringkasan:</strong> S-Katalog disusun untuk mempublikasikan berbagai motif kain sasirangan beserta filosofi motif, mulai dari motif dasar hingga yang terbaru. Informasi lebih lanjut lihat <a href="{{ url('/faq') }}">FAQ</a>.</p>
                          </div>
                          <div class="card-card-footer" onclick="window.location.href='{{ route('katalog') }}';" style="cursor: pointer;">
                            <i class="fas fa-arrow-right" style="margin-right: 7px"></i> Arahkan ke "S-Katalog"
                          </div>
                        </div>

                        <div class="card-card">
                          <div class="card-card-header">
                            <h4>Ka Pasaran</h4>
                          </div>
                          <div class="card-card-body">
                            <p><strong>Ringkasan:</strong> Ka Pasar disusun untuk mempublikasikan pasar yang menjalin kerja sama melalui fitur <strong>Mitra x SASCODE</strong>. Informasi lebih lanjut dapat ditemukan pada bagian <a href="{{ url('/faq') }}">FAQ</a>.</p>
                          </div>
                          <div class="card-card-footer" onclick="window.location.href='{{ route('ka-pasar') }}';" style="cursor: pointer;">
                            <i class="fas fa-arrow-right" style="margin-right: 7px"></i> Arahkan ke "Ka Pasar"
                          </div>
                        </div>

                        <div class="card-card">
                          <div class="card-card-header">
                            <h4>Artikel</h4>
                          </div>
                          <div class="card-card-body">
                            <p><strong>Ringkasan:</strong> Artikel disusun untuk mempublikasikan informasi seputar kegiatan dan event terkait sasirangan melalui media. Informasi lebih lanjut lihat <a href="{{ url('/faq') }}">FAQ</a>.</p>
                          </div>
                          <div class="card-card-footer" onclick="window.location.href='{{ route('berita') }}';" style="cursor: pointer;">
                            <i class="fas fa-arrow-right" style="margin-right: 7px"></i> Arahkan ke "Artikel"
                          </div>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <div class="_footer">
            @include('partials._footer')
        </div>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{ asset('vendors/base/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('vendors/datatables.net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{ asset('js/off-canvas.js') }}"></script>
  <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('js/template.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ asset('js/dashboard.js') }}"></script>
  <script src="{{ asset('js/data-table.js') }}"></script>
  <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('js/dataTables.bootstrap4.js') }}"></script>
  <!-- End custom js for this page-->
</body>

</html>

