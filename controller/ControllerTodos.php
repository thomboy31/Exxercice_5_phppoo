
<?php

require_once '../model/ModelTodos.php';
require_once '../view/ViewTodos.php';

class ControllerTodos {

    private ModelTodos $modelTodos;
    private ViewTodos $viewTodos;

    public function __construct(ModelTodos $modelTodos, ViewTodos $viewTodos) {
        $this->modelTodos = $modelTodos;
        $this->viewTodos = $viewTodos;
    }

    /**
     * Get the value of modelTodos
     *
     * @return ModelTodos
     */
    public function getModelTodos(): ModelTodos {
        return $this->modelTodos;
    }

    /**
     * Set the value of modelTodos
     *
     * @param ModelTodos $modelTodos
     *
     * @return self
     */
    public function setModelTodos(ModelTodos $modelTodos): self {
        $this->modelTodos = $modelTodos;
        return $this;
    }

    /**
     * Get the value of viewTodos
     *
     * @return ViewTodos
     */
    public function getViewTodos(): ViewTodos {
        return $this->viewTodos;
    }

    /**
     * Set the value of viewTodos
     *
     * @param ViewTodos $viewTodos
     *
     * @return self
     */
    public function setViewTodos(ViewTodos $viewTodos): self {
        $this->viewTodos = $viewTodos;
        return $this;
    }
   public function register() {

    if (isset($_POST['submit'])) {

        $prenom = trim($_POST['prenom'] ?? '');
        $nom = trim($_POST['nom'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (
            $prenom !== '' &&
            $nom !== '' &&
            $email !== '' &&
            $password !== ''
        ) {

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                if (mb_strlen($password, 'UTF-8') >= 12) {

                    $passwordHash = password_hash(
                        $password,
                        PASSWORD_DEFAULT
                    );

                    $data = $this->modelTodos->findByEmail($email);

                    if (empty($data)) {

                        $this->modelTodos->setFirstname($prenom);
                        $this->modelTodos->setLastname($nom);
                        $this->modelTodos->setEmail($email);
                        $this->modelTodos->setPassword($passwordHash);

                        if ($this->modelTodos->create()) {

                            $this->viewTodos->setMessageError(
                                "Inscription réussie !"
                            );

                        } else {

                            $this->viewTodos->setMessageError(
                                "Erreur lors de l'inscription."
                            );
                        }

                    } else {

                        $this->viewTodos->setMessageError(
                            "Cette adresse email est déjà utilisée."
                        );
                    }

                } else {

                    $this->viewTodos->setMessageError(
                        "Mot de passe trop court."
                    );
                }

            } else {

                $this->viewTodos->setMessageError(
                    "Email invalide."
                );
            }

        } else {

            $this->viewTodos->setMessageError(
                "Veuillez remplir tous les champs."
            );
        }
    }

    $this->viewTodos->formRegister();
}

// Fonction render
public function render() {
    $this->register();
}

} 


// Création du Model avec la connexion PDO
$model = new ModelTodos(
    new PDO("mysql:host=localhost;dbname=todos;charset=utf8mb4", "root", "root")
);

// Création de la View
$view = new ViewTodos();

// Création du Controller
$controllerTodos = new ControllerTodos($model, $view);

// Lancer le formulaire d'inscription
$controllerTodos->render();

?>