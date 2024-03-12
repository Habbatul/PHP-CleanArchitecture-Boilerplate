<?php
/**
 * Contoh Pembuatan Service
 */
namespace Service {

    use Repository\AdminRepository;

    interface AdminService
    {
        function changeAdmin(int $id, string $username, string $password) : void;
    }


    class AdminServiceImpl implements AdminService
    {
        private AdminRepository $AdminRepository;

        public function __construct(AdminRepository $AdminRepository)
        {
            $this->AdminRepository = $AdminRepository;
        }


        function changeAdmin(int $id, string $username, string $password): void
        {
            $this->AdminRepository->updateByID($id, $username, $password);

         }


    }

}