<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Ka Pasaran</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/base/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/alerts/style-success.css') }}">
  <link rel="stylesheet" href="{{ asset('css/alerts/style-error.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- Modal -->
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <div class="_navbar">
      @include('partials._navbar')
    </div>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
      <div class="_sidebar">
        @include('partials._sidebar')
      </div>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

          @if(session('success'))
          <div class="custom-alert-success">
              <span class="alert-icon-success">!</span>
              <span class="alert-message-success">{{ session('success') }}</span>
              <button class="alert-close-success" onclick="this.parentElement.style.display='none';">&times;</button>
          </div>
          @elseif(session('error'))
          <div class="custom-alert-error">
              <span class="alert-icon-error">!</span>
              <span class="alert-message-error">{{ session('error') }}</span>
              <button class="alert-close-error" onclick="this.parentElement.style.display='none';">&times;</button>
          </div>
          @endif

          <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <h1 class="card-title" style="font-size:16px; color:black; display: inline-block; border-bottom: 2px solid #522258; padding-bottom: 10px;">
                    DATA PASAR SASIRANGAN
                  </h1>
                  <div class="d-none d-md-flex ms-3" style="margin-left: 60px;">
                    <a type="button" data-toggle="modal" data-target="#modalTambah" onclick="setRedirectUrl('{{ route('tambah-toko') }}')"
                    style="font-size:14px; margin-right: 30px; color:#2768FF; display: flex; align-items: center;">
                      <i class="mdi mdi-plus-box" style="font-size: 20px; vertical-align: middle; margin-right: 5px; color:#2768FF"></i>
                        TAMBAH TOKO SASIRANGAN
                    </a>
                    <a href="{{ route('download-data-pasar') }}" type="button"
                    style="font-size:14px; color:#757575; display: flex; align-items: center; text-decoration: none;">
                      <i class="mdi mdi-download text-muted" style="font-size: 20px; vertical-align: middle; margin-right: 5px;"></i>
                        UNDUH DATA
                    </a>
                  </div>

                  <!-- Dropdown Menu for smaller screens -->
                  <div class="ms-3 d-md-none">
                    <div class="dropdown">
                      <a class="mdi mdi-dots-vertical" href="#" role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                      style="font-size: 20px; margin-left:20px">
                      </a>
                      <div id="dropdownMenu" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" type="button" data-toggle="modal" data-target="#modalTambah" onclick="setRedirectUrl('{{ route('tambah-berita') }}')">
                              <i class="mdi mdi-plus-box" style="font-size: 20px; vertical-align: middle; margin-right: 5px; color:#2768FF"></i>
                              TAMBAH TOKO SASIRANGAN
                          </a>
                          <a href="{{ route('download-data-pasar') }}" class="dropdown-item" type="button" style="font-size:14px; color:#757575; display: flex; align-items: center; text-decoration: none;">
                              <i class="mdi mdi-download text-muted" style="font-size: 20px; vertical-align: middle; margin-right: 5px;"></i>
                              UNDUH DATA
                          </a>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="table-responsive">
                  <table class="table table-hover w-100">
                    <thead>
                      <tr>
                        <th>Lihat</th>
                        <th>Nama Toko</th>
                        <th>Deskripsi</th>
                        <th>Alamat Toko</th>
                        <th>No. Telp</th>
                        <th>URL Instagram</th>
                        <th>Foto Toko</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- tr fields -->
                      @if($pasars && count($pasars) > 0)
                        @foreach ($pasars as $key => $item)
                        @if(!empty($item['namaToko']) || !empty($item['deskripsiToko']) || !empty($item['alamatToko']) ||!empty($item['noTelpToko']) || !empty($item['fotoTokoUrl']))
                          <tr>
                            <td>
                              <a href="" data-toggle="modal" data-target="#modalLihat{{ $key }}" title="Lihat Detail Toko"><i class="mdi mdi-eye" style="margin-right: 15px;"></i></a>    
                            </td>
                            <td>{{ $item['namaToko'] }}</td>
                            <td>{{ $item['deskripsiToko'] }}</td>
                            <td>{{ $item['alamatToko'] }}</td>
                            <td>{{ $item['noTelpToko'] }}</td>
                            <td>
                              @isset($item['instagramUrl']) 
                                @if($item['instagramUrl'])
                                    <a href="{{ $item['instagramUrl'] }}" target="_blank">
                                        {{ $item['instagramUrl'] }}
                                    </a>
                                @else
                                    {{ 'URL tidak ditemukan' }}
                                @endif
                              @else
                                {{ 'URL tidak ditemukan' }}
                              @endisset
                            </td>
                            <td>
                              <div>
                                @foreach ($item['fotoTokoUrl'] as $fotoUrl)
                                  <a href="{{ $fotoUrl }}" target="_blank" title="Download Foto Toko" style="display: block; margin-bottom: 10px;">{{ $fotoUrl }}</a>
                                @endforeach
                              </div>                            
                            </td>
                            <td>
                              <a href="" data-toggle="modal" data-target="#modalEdit{{ $key }}" title="Edit"><i class="fas fa-edit" style="margin-right: 15px;"></i></a>    
                              <a href="" data-toggle="modal" data-target="#modalHapus{{ $key }}" title="Hapus"><i class="fa-solid fa-trash" style="color: red"></i></a>     
                            </td>
                          </tr>

                          <!-- Modal Edit -->
                          <div class="modal fade" id="modalEdit{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 700px; width: 100%;">
                              <div class="modal-content rounded-0">
                                <div class="modal-body p-4 px-5">
                        
                                  
                                  <div class="main-content text-center">
                                      
                                      <a href="#" class="close-btn" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true"><span class="icon-close2"></span></span>
                                        </a>
                                      <div class="card-body">
                                        <h4 class="card-title">Edit Toko {{ $item['namaToko'] }}</h4>
                                        <form class="forms-sample" id="formEdit{{ $key }}" action="{{ route('update-toko', ['id' => $key]) }}" method="POST" enctype="multipart/form-data">
                                          @csrf
                                          @method('PUT')
                                          <div class="form-group row">
                                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nama Toko</label>
                                            <div class="col-sm-9">
                                              <input type="text" class="form-control" value="{{ $item['namaToko'] }}" id="nama_toko" name="nama_toko" placeholder="Nama toko" required>
                                            </div>
                                          </div>
                                          <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Deskripsi Toko</label>
                                            <div class="col-sm-9">
                                              <textarea class="form-control" id="deskripsi_toko" name="deskripsi_toko" rows="4" placeholder="Deskripsi toko" required>{{ $item['deskripsiToko'] }}</textarea>
                                            </div>
                                          </div>
                                          <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Alamat Toko</label>
                                            <div class="col-sm-9">
                                              <textarea class="form-control" id="edit-pac-input-{{ $key }}" name="alamat_toko" rows="4" placeholder="Alamat toko" style="margin-bottom: 16px" required>{{ $item['alamatToko'] }}</textarea>
                                              <ul id="edit-autocomplete-results-{{ $key }}" style="list-style: none; padding: 0; margin: 0; border: 1px solid #ddd; position: absolute; background: #fff; width: 100%; z-index: 1000; display: none;">
                                              </ul>
                                            </div>
                                            <div id="edit-map-{{ $key }}" style="width: 100%; height:250px; margin: 0 auto;"></div>
                                            <label for="latitude" class="col-sm-3 col-form-label">Latitude</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{ $item['latitude'] }}" id="edit-latitude-{{ $key }}" name="edit_latitude" style="margin-top: 16px" required>
                                            </div>
                                            <label for="longitude" class="col-sm-3 col-form-label">Longitude</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{ $item['longitude'] }}" id="edit-longitude-{{ $key }}" name="edit_longitude" style="margin-top: 16px" required>
                                            </div>
                                          </div>
                                          <div class="form-group row">
                                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">No. Telp Toko</label>
                                            <div class="col-sm-9">
                                              <input type="tel" class="form-control" value="{{ $item['noTelpToko'] }}" id="no_telp_toko" name="no_telp_toko" placeholder="Nomor telepon toko" required>
                                            </div>
                                          </div>
                                          <div class="form-group row">
                                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">Foto Toko</label>
                                            <div class="col-sm-9">
                                              <input type="file" class="form-control" value="{{ $item['fotoTokoUrl'] }}" id="foto_toko" name="foto_toko[]" placeholder="Pilih Foto" multiple>
                                            </div>
                                          </div>
                                          <div class="form-group row">
                                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">Link Instagram (Opsional)</label>
                                            <div class="col-sm-9">
                                              <input type="url" class="form-control" value="{{ $item['instagramUrl'] ?? 'URL tidak ditemukan' }}" id="url_instagram" name="url_instagram" placeholder="URL Instagram">
                                            </div>
                                          </div>
                                          <button type="submit" class="btn btn-primary mr-2">Update</button>
                                          <button class="btn btn-light" data-dismiss="modal" onclick="clearForm('formEdit{{ $key }}')">Cancel</button>
                                        </form>
                                      </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- Modal Hapus -->
                          <div class="modal fade" id="modalHapus{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 700px; width: 100%;">
                              <div class="modal-content rounded-0">
                                <div class="modal-body p-4 px-5">
                        
                                  
                                  <div class="main-content text-center">
                                      
                                      <a href="#" class="close-btn" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true"><span class="icon-close2"></span></span>
                                        </a>
                                      <div class="card-body">
                                        <h4 class="card-title">Hapus Toko {{ $item['namaToko'] }}</h4>
                                        <p class="card-description">
                                          <i class="fas fa-exclamation-triangle" style="color: red;"></i>
                                          Anda yakin ingin menghapus data toko yang dipilih?
                                        </p>
                                        <form class="forms-sample" id="formHapus{{ $key }}" action="{{ route('destroy-toko', ['id' => $key]) }}" method="POST">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn btn-danger mr-2">Hapus</button>
                                          <button class="btn btn-light" data-dismiss="modal" onclick="clearForm('formHapus{{ $key }}')">Cancel</button>
                                        </form>
                                      </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- Modal Lihat -->
                          <div class="modal fade" id="modalLihat{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 700px; width: 100%;">
                              <div class="modal-content rounded-0">
                                <div class="modal-body p-4 px-5">
                        
                                  
                                  <div class="main-content text-center">
                                      
                                      <a href="#" class="close-btn" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true"><span class="icon-close2"></span></span>
                                        </a>
                                      <div class="card-body">
                                        <h4 class="card-title">Toko {{ $item['namaToko'] }}</h4>
                                        <form class="forms-sample" id="formEdit{{ $key }}" action="" method="">
                                          @csrf
                                          <div class="form-group row">
                                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nama Toko</label>
                                            <div class="col-sm-9">
                                              <input type="text" class="form-control" value="{{ $item['namaToko'] }}" id="nama_toko" name="nama_toko" placeholder="Nama toko" readonly>
                                            </div>
                                          </div>
                                          <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Deskripsi Toko</label>
                                            <div class="col-sm-9">
                                              <textarea class="form-control" id="deskripsi_toko" name="deskripsi_toko" rows="4" placeholder="Jurnalis" readonly>{{ $item['deskripsiToko'] }}</textarea>
                                            </div>
                                          </div>
                                          <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Alamat Toko</label>
                                            <div class="col-sm-9">
                                              <textarea class="form-control" id="alamat_toko" name="alamat_toko" rows="4" placeholder="Alamat toko" readonly>{{ $item['alamatToko'] }}"</textarea>
                                            </div>
                                          </div>
                                          <div class="form-group row">
                                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">No. Telp Toko</label>
                                            <div class="col-sm-9">
                                              <input type="tel" class="form-control" value="{{ $item['noTelpToko'] }}" id="no_telp_toko" name="no_telp_toko" placeholder="Nomor telepon toko" readonly>
                                            </div>
                                          </div>
                                          <div class="form-group row">
                                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">URL Instagram</label>
                                            <div class="col-sm-9">
                                              <input type="url" class="form-control" value="{{ $item['instagramUrl'] ?? 'URL tidak ditemukan' }}" id="url_instagram" name="url_instagram" placeholder="URL Instagram" readonly>
                                              @if(isset($item['instagramUrl']) && !empty($item['instagramUrl']))
                                                  <a href="{{ $item['instagramUrl'] }}" target="_blank" class="btn btn-link">Kunjungi URL</a>
                                              @endif
                                            </div>
                                          </div>
                                          <div class="form-group row">
                                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">Foto Toko</label>
                                            <div class="col-sm-9">
                                              @foreach ($item['fotoTokoUrl'] as $fotoUrl)
                                                <img src="{{ $fotoUrl }}" alt="Preview Foto Toko" style="max-width: 50%; height: auto; margin-bottom: 10px;">
                                              @endforeach
                                            </div>
                                          </div>
                                          <button class="btn btn-light" data-dismiss="modal" onclick="clearForm('formEdit{{ $key }}')">Cancel</button>
                                        </form>
                                      </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                        @endif
                        @endforeach
                      @else
                        <tr>
                          <td colspan="8" style="text-align: center">Data Toko tidak ditemukan</td>
                        </tr>
                      @endif
                    </tbody>
                  </table>
                </div>
                <!-- Modal Tambah -->
                <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 700px; width: 100%;">
                    <div class="modal-content rounded-0">
                      <div class="modal-body p-4 px-5">

                        
                        <div class="main-content text-center">
                            
                            <a href="#" class="close-btn" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><span class="icon-close2"></span></span>
                              </a>
                            <div class="card-body">
                              <h4 class="card-title">Tambah Toko Sasirangan</h4>
                              <form class="forms-sample" id="formTambah" action="{{ url('simpan-toko') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                  <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nama Toko</label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nama_toko" name="nama_toko" placeholder="Nama toko" required>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Deskripsi Toko</label>
                                  <div class="col-sm-9">
                                    <textarea class="form-control" id="deskripsi_toko" name="deskripsi_toko" rows="4" placeholder="Deskripsi toko" required></textarea>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Alamat Toko</label>

                                  <div class="col-sm-9">
                                    <input type="text" class="form-control" id="pac-input" name="alamat_toko" placeholder="Masukkan alamat toko" required>
                                    <ul id="autocomplete-results" style="list-style: none; padding: 0; margin: 0; border: 1px solid #ddd; position: absolute; background: #fff; width: 100%; z-index: 1000; display: none;">
                                    </ul>
                                  </div>

                                  <div id="map" style="width: 100%; height:250px; margin: 0 auto;"></div>

                                  <label for="latitude" class="col-sm-3 col-form-label">Latitude</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control" id="latitude" name="latitude" style="margin-top: 16px" placeholder="Latitude" readonly>
                                  </div>

                                  <label for="longitude" class="col-sm-3 col-form-label">Longitude</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control" id="longitude" name="longitude" style="margin-top: 16px" placeholder="Longitude" readonly>
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label for="exampleInputUsername2" class="col-sm-3 col-form-label">No. Telp Toko</label>
                                  <div class="col-sm-9">
                                    <input type="tel" class="form-control" id="no_telp_toko" name="no_telp_toko" placeholder="Nomor telepon toko" required>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="exampleInputMobile" class="col-sm-3 col-form-label">Foto Toko</label>
                                  <div class="col-sm-9">
                                    <input type="file" class="form-control" id="foto_toko" name="foto_toko[]" placeholder="Pilih Foto" required multiple>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="exampleInputMobile" class="col-sm-3 col-form-label">Link Instagram (Opsional)</label>
                                  <div class="col-sm-9">
                                    <input type="url" class="form-control" id="url_instagram" name="url_instagram" placeholder="https://www.instagram.com/username/" multiple>
                                  </div>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button class="btn btn-light" data-dismiss="modal" onclick="clearForm('formTambah')">Cancel</button>
                              </form>
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
        <!-- partial:../../partials/_footer.html -->
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
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
        fetch('/gomaps-script')
            .then(response => response.json())
            .then(data => {
                const script = document.createElement('script');
                script.src = data.script_url;
                script.async = true;
                script.defer = true;
                script.onload = () => {
                  document.querySelectorAll('.forms-sample').forEach((form, index) => {
                      const key = form.id.replace('formEdit', '');
                      initMap(key);
                  });
                };
                document.head.appendChild(script);
            })
            .catch(error => console.error('Error fetching gomaps script:', error));
    });
  </script>

  <script type="text/javascript" src="{{ asset('js/mapInput.js') }}"></script>
  
  <script>
    function resetForm(formId) {
      document.getElementById(formId).reset();
    }
  </script>
  <!-- plugins:js -->
  <script src="{{ asset('vendors/base/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{ asset('js/off-canvas.js') }}"></script>
  <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('js/template.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>

</html>
