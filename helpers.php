<?php

/**
 * Get the base path of the application
 * @param string $path
 * @return string
 */
function basePath($path = '')
{
    return __DIR__ . '/' . $path;
}

/**
 * Load a view
 * 
 * @param string $name  
 * @return void
 */

function loadView($name)
{

    $viewPath =  basePath("views/$name.view.php");

    // Check if the view file exists
    if (!file_exists($viewPath)) {
        echo "View file not found: $viewPath";
        throw new Exception("View file not found: $viewPath");
    }

    require $viewPath;
}


/**
 * Load partials
 * Load a partial view
 * 
 * @param string $name   The name of the partial view
 * @return void
 */
function loadPartial($name)
{
    $partialPath = basePath("views/partials/$name.php");

    // Check if the partial file exists
    if (!file_exists($partialPath)) {
        echo "Partial file not found: $partialPath";
        throw new Exception("Partial file not found: $partialPath");
    }

    require $partialPath;
}
