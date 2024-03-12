<?php
/**
 * Contoh Pembuatan Repository
 */
namespace Repository {

    use Entity\Admin;

    interface AdminRepository
    {
        function updateByID(int $id, string $username, string $password): void;
        function existByUsernameAndPassword(string $username, string $password) : bool;
    }

    class AdminRepositoryImpl implements AdminRepository
    {
        public array $admin = array();
        private \PDO $connection;

        public function __construct(\PDO $connection)
        {
            $this->connection = $connection;
        }

        function existByUsernameAndPassword($username, $password): bool
        {
            $sql = "SELECT * FROM admin WHERE username = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$username]);
        
            $admin = $statement->fetch(); 
        
            if ($admin && password_verify($password, $admin['password'])) {
                return true; 
            } else {
                return false; 
            }
        }

        function updateByID(int $id, string $username, string $password): void {
            $sql = "UPDATE admin SET username=?, password=? WHERE id=?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$username, $password, $id]);
        }

    }

}
?>