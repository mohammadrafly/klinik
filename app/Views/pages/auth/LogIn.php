                               <?= $this->extend('layout/AuthLayout') ?>     
                               <?= $this->section('content') ?>
                                    <h4 class="text-center mb-4">Masuk dengan akun anda.</h4>
                                    <form id="formLogin">
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Email/Username</strong></label>
                                            <input id="email" name="email" type="text" class="form-control" placeholder="Email or username">
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Kata Sandi</strong></label>
                                            <input id="password" name="password" type="password" class="form-control" placeholder="***********">
                                        </div>
                                        <div class="row d-flex justify-content-between mt-4 mb-2">
                                            <div class="mb-3">
                                                <a href="page-forgot-password.html">Lupa Kata Sandi?</a>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Tidak punya akun? <a class="text-primary" href="<?= base_url('signup') ?>">Sign up</a></p>
                                    </div>
                                <?= $this->endSection() ?>
                                <?= $this->section('script') ?>
                                <script src="<?= base_url('js/Auth.js') ?>"></script>
                                <?= $this->endSection() ?>