<?php

namespace App\Controller;

use App\Entity\Authors;
use App\Entity\Books;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BasicController extends AbstractController
{
  #[Route('/', name: 'accueil')]
  public function accueil(): Response
  {
    return $this->render('index.html.twig', [
      'page_title' => "bonjour"
    ]);
  }

  #[Route('/Recherche/book', name: 'rechercheBook')]
  public function rechercheBook(Request $request, EntityManagerInterface $entityManager): Response
  {
    $BookRepository = $entityManager->getRepository(Books::class);
    $dataBooks = $BookRepository->createQueryBuilder("b")->select('b')->Where("b.name LIKE :value OR b.description LIKE :value")
      ->setParameter("value", "%" . $request->request->get("query") . "%")
      ->getQuery()->execute();
    return $this->render('book.html.twig', [
      'dataBooks' => $dataBooks
    ]);
  }

  #[Route('/Recherche/author', name: 'rechercheAuthor')]
  public function rechercheAuthor(Request $request, EntityManagerInterface $entityManager): Response
  {
    $AuthorRepository = $entityManager->getRepository(Authors::class);
    $dataAuthors = $AuthorRepository->createQueryBuilder("a")->select('a')->Where("a.name LIKE :value OR a.alias LIKE :value")
      ->setParameter("value", "%" . $request->request->get("query") . "%")
      ->getQuery()->execute();
    // dd($dataAuthors);
    return $this->render('author.html.twig', [
      'dataAuthors' => $dataAuthors
    ]);
  }
}
