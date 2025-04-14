<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function emailExists($email) {
        try{
        $stmt = $this->db->prepare("SELECT 1 FROM users WHERE user_email = ?");
        $stmt->execute([$email]);
        return $stmt->fetchColumn() !== false;
        } catch (PDOException $e) {
            error_log("Erreur SQL : " . $e->getMessage());
            return false;
        }
    }

    public function create($pseudo, $email, $password) {
        // id_role par défaut = 2 (joueur)
        $stmt = $this->db->prepare("INSERT INTO users (user_pseudo, user_email, user_password, id_role) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$pseudo, $email, $password, 1]);
    }

    public function getUserByEmail($email) {
        $query = "SELECT * FROM users WHERE user_email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsers() {
        $stmt = $this->db->query("SELECT * FROM users LEFT JOIN roles ON users.id_role = roles.role_id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function deleteUser($id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE user_id = ?");
        return $stmt->execute([$id]);
    }
    
    public function updateUser($id, $pseudo, $email, $password = null) {
        // Si un mot de passe est fourni, on le met à jour, sinon on l'ignore
        if ($password) {
            $stmt = $this->db->prepare("UPDATE users SET user_pseudo = ?, user_email = ?, user_password = ? WHERE user_id = ?");
            return $stmt->execute([$pseudo, $email, $password, $id]);
        } else {
            $stmt = $this->db->prepare("UPDATE users SET user_pseudo = ?, user_email = ? WHERE user_id = ?");
            return $stmt->execute([$pseudo, $email, $id]);
        }
    }
    

    public function updateUserRole($id, $role) {
        $stmt = $this->db->prepare("UPDATE users SET id_role = ? WHERE user_id = ?");
        return $stmt->execute([$role, $id]);
    }
    
    public function getAllRoles() {
        $stmt = $this->db->query("SELECT role_id, role_name FROM roles");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
}
