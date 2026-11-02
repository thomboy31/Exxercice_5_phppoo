<?php

Class ModelTodos{
private int $id_user;
private int $id_role;
private string $firstname;
private string $lastname;
private string $email;
private string $password;
private DateTime $created_at;
private PDO $pdo;

public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }


/**
 * Get the value of id_user
 *
 * @return int
 */
public function getIdUser(): int {
return $this->id_user;
}

/**
 * Set the value of id_user
 *
 * @param int $id_user
 *
 * @return self
 */
public function setIdUser(int $id_user): self {
$this->id_user = $id_user;
return $this;
}

/**
 * Get the value of id_role
 *
 * @return int
 */
public function getIdRole(): int {
return $this->id_role;
}

/**
 * Set the value of id_role
 *
 * @param int $id_role
 *
 * @return self
 */
public function setIdRole(int $id_role): self {
$this->id_role = $id_role;
return $this;
}

/**
 * Get the value of firstname
 *
 * @return string
 */
public function getFirstname(): string {
return $this->firstname;
}

/**
 * Set the value of firstname
 *
 * @param string $firstname
 *
 * @return self
 */
public function setFirstname(string $firstname): self {
$this->firstname = $firstname;
return $this;
}

/**
 * Get the value of lastname
 *
 * @return string
 */
public function getLastname(): string {
return $this->lastname;
}

/**
 * Set the value of lastname
 *
 * @param string $lastname
 *
 * @return self
 */
public function setLastname(string $lastname): self {
$this->lastname = $lastname;
return $this;
}

/**
 * Get the value of email
 *
 * @return string
 */
public function getEmail(): string {
return $this->email;
}

/**
 * Set the value of email
 *
 * @param string $email
 *
 * @return self
 */
public function setEmail(string $email): self {
$this->email = $email;
return $this;
}

/**
 * Get the value of password
 *
 * @return string
 */
public function getPassword(): string {
return $this->password;
}

/**
 * Set the value of password
 *
 * @param string $password
 *
 * @return self
 */
public function setPassword(string $password): self {
$this->password = $password;
return $this;
}

/**
 * Get the value of created_at
 *
 * @return DateTime
 */
public function getCreatedAt(): DateTime {
return $this->created_at;
}

/**
 * Set the value of created_at
 *
 * @param DateTime $created_at
 *
 * @return self
 */
public function setCreatedAt(DateTime $created_at): self {
$this->created_at = $created_at;
return $this;
}

/**
 * Get the value of pdo
 *
 * @return PDO
 */
public function getPdo(): PDO {
return $this->pdo;
}

/**
 * Set the value of pdo
 *
 * @param PDO $pdo
 *
 * @return self
 */
public function setPdo(PDO $pdo): self {
$this->pdo = $pdo;
return $this;
}

public function findByEmail(string $email){
        //Recupération produit , nom de categorie
        try{
            //1. Construire l'objet connexion PDO

            //2. Préparation de la requête
            $request = $this->pdo->prepare('SELECT u.email FROM users u  WHERE u.email = ?');

            //BindParam() pour injecter l'email dans la requête

             $request->bindParam(1,$email,PDO::PARAM_STR);

            //3. Execution de la requête
            $request->execute([$email]);

            //4. Récupérere la réponse
            return $request->fetch(PDO::FETCH_ASSOC);

              } catch (PDOException $error) {
        die($error->getMessage());
    }

        }
        public function create(): bool {
            try {
             $request = $this->pdo->prepare('INSERT INTO users (firstname, lastname, email, `password`) VALUES(?, ?, ?, ?)');
                       
            return $request->execute([
            $this->firstname,
            $this->lastname,
            $this->email,
            $this->password
        ]);

        } catch (PDOException $error) {
        die($error->getMessage());

                           
         }
}

}
?>