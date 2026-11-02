<?php

Class ViewTodos{
    private string $title = "Inscription";
    private string $messageError = "";
    
    /**
     * Get the value of title
     *
     * @return string
     */
    public function getTitle(): string {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param string $title
     *
     * @return self
     */
    public function setTitle(string $title): self {
        $this->title = $title;
        return $this;
    }

    /**
     * Get the value of messageError
     *
     * @return string
     */
    public function getMessageError(): string {
        return $this->messageError;
    }

    /**
     * Set the value of messageError
     *
     * @param string $messageError
     *
     * @return self
     */
    public function setMessageError(string $messageError): self {
        $this->messageError = $messageError;
        return $this;
    }

    public function formRegister(){
    ?>
     <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo(htmlentities($this->title)) ?></title>
        </head>
        <body>
            <header>
                <h1><?php echo(htmlentities($this->title)) ?></h1>
            </header>

            <main>

    <form action="" method="post">
                <label for="prenom">Prenom <input type="text" name="prenom" id="prenom"></label>
                <label for="nom">Nom <input type="text" name="nom" id="nom"></label>
                <label for="email">Email <input type="email" name="email" id="email"></label>
                <label for="password">Mot de Passe <input type="password" name="password" id="password"></label>
                <input type="submit" name="submit" value="S'inscrire">
            </form>
            <p><?php echo(htmlentities($this->messageError)); ?></p>
            </main>

            <footer>
            </footer>
        </body>
        </html>
<?php
    }
}


