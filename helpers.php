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
 * @param string $name   The name of the view
 * @param array  $data   Data to be extracted for the view
 * @return void
 */
function loadView($name, $data = [])
{
    $viewPath = basePath("views/$name.view.php");

    // Check if the view file exists
    if (!file_exists($viewPath)) {
        echo "View file not found: $viewPath";
        throw new Exception("View file not found: $viewPath");
    }

    // Extract data to make variables available to the view
    extract($data);

    require $viewPath;
}


/**
 * Load a partial view file
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


/**
 * Inspect a value(s)
 * @params mixed $value The value to inspect
 * @return void
 */
function inspect($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}


/**
 * Inspect a value(s) and die
 * @params mixed $value The value to inspect
 * @return void
 */
function inspectAndDie($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    die();
}
