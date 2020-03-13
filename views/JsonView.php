<?php
class JsonView extends ApiView
{
    public function render($content)
    {
        header('Content-Type: application/vnd.api+json; charset=utf8');
        echo json_encode($content, JSON_PRETTY_PRINT);

        return true;
    }
}
