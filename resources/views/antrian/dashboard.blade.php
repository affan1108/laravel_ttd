@extends('layouts.master-without-nav')
@section('title')
    @lang('translation.signin')
@endsection
@section('content')

    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>
        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4 auth-one-bg h-100">
                                        <div class="bg-overlay"></div>
                                        <div class="position-relative h-100 d-flex flex-column">
                                            <div class="mb-4">
                                                <!-- <a href="index" class="d-block">
                                                    <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="18">
                                                </a> -->
                                            </div>
                                            <div class="mt-auto">
                                                <div class="mb-3">
                                                    <i class="ri-double-quotes-l display-4 text-success"></i>
                                                </div>

                                                <div id="qoutescarouselIndicators" class="carousel slide"
                                                    data-bs-ride="carousel">
                                                    <div class="carousel-indicators">
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators"
                                                            data-bs-slide-to="0" class="active" aria-current="true"
                                                            aria-label="Slide 1"></button>
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators"
                                                            data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators"
                                                            data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                    </div>
                                                    <div class="carousel-inner text-center text-white-50 pb-5">
                                                        <div class="carousel-item active">
                                                            <p class="fs-15 fst-italic">" Lorem ipsum dolor sit amet consectetur adipisicing elit. "</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15 fst-italic">" Alias dolorum voluptatum incidunt fugit maxime illo quam velit nihil "</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15 fst-italic">" excepturi deserunt quo nesciunt ipsum, error inventore corrupti accusamus itaque magni sequi. "</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end carousel -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4">
                                        <div>
                                            <h5 class="text-primary text-center">Menu Pemeriksaan HB</h5>
                                            <!-- <p class="text-muted">Sign in to continue to Velzon.</p> -->
                                        </div>

                                        <div class="mt-4">
                                            <form action="index">

                                                <div class="mb-3">
                                                    <label for="nik" class="form-label">NIK</label>
                                                    <input type="text" class="form-control" id="nik" name="nik"
                                                        placeholder="Masukkan NIK">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                                    <input type="text" class="form-control" id="nama" name="nama"
                                                        placeholder="Masukkan Nama Lengkap">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nomer" class="form-label">No HP</label>
                                                    <input type="text" class="form-control" id="nomer" name="nomer"
                                                        placeholder="Masukkan No HP">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                                        placeholder="Masukkan Tempat Lahir">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                                    <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir"
                                                        placeholder="Masukkan Tanggal Lahir">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="alamat" class="form-label">Alamat Lengkap</label>
                                                    <input type="text" class="form-control" id="alamat" name="alamat"
                                                        placeholder="Masukkan Alamat Lengkap">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="puskesmas" class="form-label">Puskesmas Domisili</label>
                                                    <input type="text" class="form-control" id="puskesmas" name="puskesmas"
                                                        placeholder="Masukkan Puskesmas Domisili">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nama_sekolah" class="form-label">Nama Sekolah</label>
                                                    <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah"
                                                        placeholder="Masukkan Nama Sekolah">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="alamat_sekolah" class="form-label">Alamat Sekolah</label>
                                                    <input type="text" class="form-control" id="alamat_sekolah" name="alamat_sekolah"
                                                        placeholder="Masukkan Alamat Sekolah">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="kelas" class="form-label">Kelas</label>
                                                    <input type="text" class="form-control" id="kelas" name="kelas"
                                                        placeholder="Masukkan Kelas">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                                    <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin"
                                                        placeholder="Masukkan Jenis Kelamin">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nama_ortu" class="form-label">Nama Orang Tua</label>
                                                    <input type="text" class="form-control" id="nama_ortu" name="nama_ortu"
                                                        placeholder="Masukkan Nama Orang Tua">
                                                </div>

                                                <!-- <div class="mb-3">
                                                    <div class="float-end">
                                                        <a href="auth-pass-reset-cover" class="text-muted">Forgot
                                                            password?</a>
                                                    </div>
                                                    <label class="form-label" for="password-input">Password</label>
                                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                                        <input type="password" class="form-control pe-5 password-input"
                                                            placeholder="Enter password" id="password-input">
                                                        <button
                                                            class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                            type="button" id="password-addon"><i
                                                                class="ri-eye-fill align-middle"></i></button>
                                                    </div>
                                                </div> -->

                                                <!-- <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="auth-remember-check">
                                                    <label class="form-check-label" for="auth-remember-check">Remember
                                                        me</label>
                                                </div> -->

                                                <div class="mt-4">
                                                    <button class="btn btn-success w-100" type="submit">Kirim</button>
                                                </div>

                                                <!-- <div class="mt-4 text-center">
                                                    <div class="signin-other-title">
                                                        <h5 class="fs-13 mb-4 title">Sign In with</h5>
                                                    </div>

                                                    <div>
                                                        <button type="button"
                                                            class="btn btn-primary btn-icon waves-effect waves-light"><i
                                                                class="ri-facebook-fill fs-16"></i></button>
                                                        <button type="button"
                                                            class="btn btn-danger btn-icon waves-effect waves-light"><i
                                                                class="ri-google-fill fs-16"></i></button>
                                                        <button type="button"
                                                            class="btn btn-dark btn-icon waves-effect waves-light"><i
                                                                class="ri-github-fill fs-16"></i></button>
                                                        <button type="button"
                                                            class="btn btn-info btn-icon waves-effect waves-light"><i
                                                                class="ri-twitter-fill fs-16"></i></button>
                                                    </div>
                                                </div> -->

                                            </form>
                                        </div>

                                        <div class="mt-5 text-center">
                                            <p class="mb-0">
                                                <a class="btn btn-primary w-100" href="{{ route('login') }}">Login</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <!-- <footer class="footer start-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> Velzon. Crafted with <i
                                    class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer> -->
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

@endsection
@section('script')
    <script src="{{ URL::asset('build/js/pages/password-addon.init.js') }}"></script>
@endsection
