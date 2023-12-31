<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('front/index.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    #[Route(path: '/video-list/category/{categoryname},{id}', name: 'video-list')]
    public function videoList(): Response
    {
        return $this->render('front/videolist.html.twig');
    }

    #[Route('/video-details/{id}', name: 'video-details')]
    public function videoDetails(): Response
    {
        return $this->render('front/video_details.html.twig');
    }

    #[Route('/search-results', name: 'search-results', methods: ['POST'])]
    public function searchResults(): Response
    {
        return $this->render('front/search_results.html.twig');
    }

    #[Route('/pricing', name: 'pricing')]
    public function pricing(): Response
    {
        return $this->render('front/pricing.html.twig');
    }
    #[Route('/register', name: 'register')]
    public function register(): Response
    {
        return $this->render('front/register.html.twig');
    }
    #[Route('/login', name: 'login')]
    public function login(): Response
    {
        return $this->render('front/login.html.twig');
    }
    #[Route('/payment', name: 'payment')]
    public function action(): Response
    {
        return $this->render('front/payment.html.twig');
    }
   
    public function MainCategories(ManagerRegistry $doctrine): Response
    {
        // Get all categories with their subcategories and videos count
        $categories = $doctrine->getRepository(Category::class)->findBy(['parent'=> null], ['name'=>'ASC']);
        return $this->render('front/_main_categories.html.twig', [
            'categories' => $categories
        ]);
    }
}
