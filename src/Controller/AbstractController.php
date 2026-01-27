<?php

namespace App\Controller;

abstract class AbstractController
{
    /**
     * Méthode pour rendre une vue avec un template
     * @param string $template Le nom du template à inclure
     * @param string|null $title Le titre de la page
     * @param array $data Les données à passer au template
     * @return void
     */
    public function render(string $template, ?string $title, array $data = []): void
    {
        include __DIR__ . "/../../templates/template_" . $template . ".php";
    }

    /**
     * Méthode pour envoyer une réponse JSON
     * @param array $data Les données à encoder en JSON
     * @param int $statusCode Le code de statut HTTP
     * @return void
     */
    public function jsonResponse(array $data, int $statusCode = 200): void
    {
        http_response_code($statusCode);
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
    
    /**
     * Méthode pour vérifier si un formulaire a été soumis
     * @param array $post Les données POST
     * @return bool Vrai si le formulaire a été soumis, faux sinon
     */
    public function isFormSubmitted(array $post, ?string $button = "submit"): bool
    {
        return isset($post[$button]);
    }
}
