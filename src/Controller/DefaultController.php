<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class DefaultController
{
    public function home()
    {
        return new Response('<!DOCTYPE html><title>Kody rabatowe</title><p>Generator kodów</p>');
    }
}
