                                <?= $this->extend('layout/AuthLayout') ?>     
                                <?= $this->section('content') ?>
                                    <h4 class="text-center mb-4">Sign up your account</h4>
                                    <form id="formRegister">
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Nama Lengkap</strong></label>
                                            <input id="name" name="name" type="text" class="form-control" placeholder="nama lengkap">
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Username</strong></label>
                                            <input id="username" name="username" type="text" class="form-control" placeholder="username">
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Email</strong></label>
                                            <input id="email" name="email" type="email" class="form-control" placeholder="hello@example.com">
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Nomor HP</strong></label>
                                            <input id="nomor_hp" name="nomor_hp" type="number" class="form-control" placeholder="08190XXXXXX">
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Jenis Kelamin</strong></label>
                                            <select class="form-control">
                                                <option>Pilih jenis kelamin</option>
                                                <option value="laki-laki">Laki-laki</option>
                                                <option value="perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Usia</strong></label>
                                            <input id="usia" name="usia" type="number" class="form-control" placeholder="25">
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Alamat</strong></label>
                                            <textarea id="alamat" name="alamat" type="text" class="form-control"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input id="password" name="password" type="password" class="form-control" value="Password">
                                        </div>
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary btn-block">Sign me up</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Already have an account? <a class="text-primary" href="<?= base_url('signin') ?>">Sign in</a></p>
                                    </div>
                                <?= $this->endSection() ?>
                                <?= $this->section('script') ?>
                                <script src="<?= base_url('js/Auth.js') ?>"></script>
                                <?= $this->endSection() ?>