<?php

namespace App\Controller;

use App\Entity\Books;
use App\Entity\Authors;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ScriptEnterDataController extends AbstractController
{
  #[Route('/script', name: 'script')]
  public function scriptEnterDataController(HttpClientInterface $client, EntityManagerInterface $entityManager): Response
  {
    $AuthorRepository = $entityManager->getRepository(Authors::class);
    for ($i = 0; $i < 9; $i++) {
      $response = $client->request(
        'GET',
        'https://gnikdroy.pythonanywhere.com/api/book?page=' . $i + 1
      );
      foreach ($response->toArray()["results"] as $dataBook) {
        //*****************************************************
        //                  Fetch author
        //*****************************************************
        if (isset($dataBook["agents"][0])) {
          $dataAuthor = $client->request(
            'GET',
            'https://gnikdroy.pythonanywhere.com/api/person/' . $dataBook["agents"][0]["id"]
          );
          if ($dataAuthor->getStatusCode() == 200) {
            $dataAuthor = $dataAuthor->toArray();
            $author = $AuthorRepository->findOneBy(['name' => $dataAuthor["name"]]);
            if ($author == null) {
              $author = new Authors();
              $author->setName($dataAuthor["name"]);
              $author->setAlias($dataAuthor["alias"]);
              $author->setBirthDate($dataAuthor["birth_date"]);
              $author->setDeathDate($dataAuthor["death_date"]);
              $author->setWebpage($dataAuthor["webpage"]);
              //persist
              $entityManager->persist($author);
              $entityManager->flush();
            }
          } else {
            $author = null;
          }
        } else {
          $author = null;
        }


        //*****************************************************
        //                  Fetch book
        //*****************************************************
        $book = new Books();
        $book->setName($dataBook["title"]);
        $book->setDescription($dataBook["description"]);
        //Author
        $book->setAuthor($author);
        //Langue
        $langue = "";
        foreach ($dataBook["languages"] as $lg) {
          $langue .= $lg . "";
        }
        $book->setLanguage($langue);
        //Bookshelve
        $bookshelve = [];
        foreach ($dataBook["bookshelves"] as $booksh) {
          array_push($bookshelve, $booksh);
        }
        $book->setBookshelves($bookshelve);
        //Subjects
        $subjects = [];
        foreach ($dataBook["subjects"] as $sub) {
          array_push($subjects, $sub);
        }
        $book->setSubjects($subjects);
        //persist
        $entityManager->persist($book);
        $entityManager->flush();
      }
    }
    return new JsonResponse(["response" => "Le fetch est terminé"]);
  }
}
