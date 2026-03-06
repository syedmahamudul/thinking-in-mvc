<?php
namespace Src\Core;

function view(string $view, array $data = [])
{
    $viewPath = __DIR__ . '/../../views/' . $view . '.php';

    if(!file_exists($viewPath)){
        throw new \Exception("View $view not found");
    }

    // Extract variables to be available in view
    extract($data);

    // Start output buffering
    ob_start();
    include $viewPath;
    return ob_get_clean(); // Return output as string
}