<?php

function getClassName($class): string
{
    $noSpacesName =  class_basename($class);
    $splitWithWhitespace = preg_split('/(?=[A-Z])/', $noSpacesName);
    $split = array_slice($splitWithWhitespace, 1);

    return  implode(' ', $split);
}

function getModelNamespace($name) {
    return 'App\\Models\\' . implode('', explode(' ', $name));
}
