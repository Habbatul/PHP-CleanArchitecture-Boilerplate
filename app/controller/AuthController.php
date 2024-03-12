<?php
/**
 * Contoh Pembuatan Controller
 */
namespace Controller;

use Error;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;

use Service\AuthService;

class AuthController
{
    private AuthService $authService;

    private Session $session;

    public function __construct( AuthService $authService)
    {
        $this->authService = $authService;
        $this->session = new Session();
    }

    public function login(Request $request)
    {
        $username = $request->request->get('username');
        $password = $request->request->get('password');
        try{
            $this->authService->login($username, $password);
        }catch(Error $e){
            //contoh implementasi ketika error
            $this->session->getFlashBag()->add('massage', 'failed');
            $redirectResponse = new RedirectResponse(base_url('/admin/login'));
            $redirectResponse->send();
        }catch(Exception $ex){
            //contoh implementasi ketika menangkap exception dari service
            session_destroy();
            $this->session->getFlashBag()->add('massage', 'failed');
            $redirectResponse = new RedirectResponse(base_url('/admin/login'));
            $redirectResponse->send();
        }
    }

    public function logout()
    {
        $this->authService->logout();
    }

    public function getUsername()
    {
        $this->authService->getUsername();
    }

    public function halamanLogin(){
        require(__DIR__ . '/../view/admin/login.php');
    }

}