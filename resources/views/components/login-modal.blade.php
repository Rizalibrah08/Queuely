<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="loginModalLabel">Masuk ke Queue<span class="text-brown">ly</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0">
                <form id="loginForm">
                    @csrf
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="loginEmail" placeholder="nama@email.com" required>
                        <div class="invalid-feedback" id="loginEmailError"></div>
                    </div>
                    <div class="mb-3">
                        <label for="loginPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="loginPassword" placeholder="Masukkan password" required>
                        <div class="invalid-feedback" id="loginPasswordError"></div>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Ingat saya</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-3" id="loginSubmitBtn">
                        <span id="loginBtnText">Masuk</span>
                        <span id="loginLoading" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                    <div class="text-center">
                        <a href="#" class="text-decoration-none" id="showRegister">Belum punya akun? Daftar</a>
                    </div>
                </form>

                <form id="registerForm" class="d-none">
                    @csrf
                    <div class="mb-3">
                        <label for="registerName" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="registerName" placeholder="Nama lengkap" required>
                        <div class="invalid-feedback" id="registerNameError"></div>
                    </div>
                    <div class="mb-3">
                        <label for="registerEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="registerEmail" placeholder="nama@email.com" required>
                        <div class="invalid-feedback" id="registerEmailError"></div>
                    </div>
                    <div class="mb-3">
                        <label for="registerPhone" class="form-label">Nomor Telepon</label>
                        <input type="tel" class="form-control" id="registerPhone" placeholder="0812-3456-7890">
                    </div>
                    <div class="mb-3">
                        <label for="registerPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="registerPassword" placeholder="Minimal 8 karakter" required>
                        <div class="invalid-feedback" id="registerPasswordError"></div>
                    </div>
                    <div class="mb-3">
                        <label for="registerPasswordConfirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="registerPasswordConfirmation" placeholder="Ulangi password" required>
                        <div class="invalid-feedback" id="registerPasswordConfirmationError"></div>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="agreeTerms" required>
                        <label class="form-check-label" for="agreeTerms">
                            Saya setuju dengan <a href="#" class="text-decoration-none">Syarat & Ketentuan</a>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-success w-100 mb-3" id="registerSubmitBtn">
                        <span id="registerBtnText">Daftar</span>
                        <span id="registerLoading" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                    <div class="text-center">
                        <a href="#" class="text-decoration-none" id="showLogin">Sudah punya akun? Masuk</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .text-brown {
        color: #AB886D;
    }
    
    .btn-primary {
        background-color: #AB886D;
        border-color: #AB886D;
    }
    
    .btn-primary:hover {
        background-color: #8A6F59;
        border-color: #8A6F59;
    }
    
    .btn-success {
        background-color: #493628;
        border-color: #493628;
    }
    
    .btn-success:hover {
        background-color: #36281D;
        border-color: #36281D;
    }
    
    .modal-content {
        border-radius: 15px;
        overflow: hidden;
    }
    
    .form-control:focus {
        border-color: #AB886D;
        box-shadow: 0 0 0 0.25rem rgba(171, 136, 109, 0.25);
    }
</style>