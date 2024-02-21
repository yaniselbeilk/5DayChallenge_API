<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BasicController extends AbstractController
{
  #[Route('/', name: 'accueil')]
  public function basicController(): Response
  {
    return $this->render('accueil.html.twig', [
      'page_title' => "bonjour"
    ]);
  }
}
