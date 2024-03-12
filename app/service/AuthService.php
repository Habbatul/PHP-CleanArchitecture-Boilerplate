<?php
/**
 * Contoh Pembuatan Service
 */
namespace Service {

    use Repository\AdminRepository;

    interface AuthService
    {
        function login(string $username, string $password);
        function logout();
        function isAuthenticated();
        function getUsername();
    }


    class AuthServiceImpl implements AuthService
    {
        //nerapin depedency injection sehingga objek diberikan dari luar kelas
        private AdminRepository $adminRepository;

        public function __construct(AdminRepository $adminRepository)
        {
            $this->adminRepository = $adminRepository;
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
        }

        public function login($username, $password)
        { 
            // Contoh sederhana: jika username dan password adalah "admin"
            if ($this->adminRepository->existByUsernameAndPassword($username, $password)) {
                // Tetapkan variabel session untuk menandai bahwa pengguna sudah login
                $_SESSION['is_authenticated'] = true;
                $_SESSION['username'] = $username;
    
                // Redirect ke halaman utama setelah login berhasil
                header('Location: '.base_url('admin/tentangkami'));
                exit;
            } else {
                // Jika login gagal, Anda bisa melakukan penanganan kesalahan sesuai kebutuhan
                throw new \Exception("Login gagal. Username atau password salah.");
            }
        }
    
        public function logout()
        {
            // Hapus semua data sesi
            session_unset();
    
            // Hancurkan sesi
            session_destroy();
    
            // Redirect ke halaman login setelah logout berhasil
            header('Location: '.base_url('admin/login'));
            exit;
        }
    
        public function isAuthenticated()
        {
            // Periksa apakah pengguna sudah terautentikasi dengan melihat variabel session
            if(!(isset($_SESSION['is_authenticated']) && $_SESSION['is_authenticated'] === true)){
                header('Location: '.base_url('admin/login'));
                echo $_SESSION['is_authenticated'];
            }
        }
    
        public function getUsername()
        {
            // Dapatkan username pengguna dari session
            return isset($_SESSION['username']) ? $_SESSION['username'] : '';
        }

    }

}