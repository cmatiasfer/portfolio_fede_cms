<?php

namespace App\Zard\FrontBundle\Controller;

use App\Repository\Zard\CoreBundle\Entity\ProjectsGalleryRepository;
use App\Repository\Zard\CoreBundle\Entity\ProjectsRepository;
use App\Repository\Zard\CoreBundle\Entity\HomeRepository;
use App\Zard\CoreBundle\Entity\Texts;
use App\Repository\Zard\CoreBundle\Entity\TextsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home" )
     */
    public function index(Request $request, HomeRepository $homeRepository , ProjectsGalleryRepository $projectsGalleryRepository,ProjectsRepository $projectsRepository)
    {
        $slideHome = $homeRepository->findOneBy(['name' => 'home']);

        $orderGallery = $slideHome->getOrderGallery();
        
        if($orderGallery == 'order-random'){
            $projectsGallery = $projectsGalleryRepository->itemsOrderRandom();
        }else{
            $projectsGallery = $projectsGalleryRepository->itemsByOrderProject();
        }

        $projects = $projectsRepository->findBy([], ["listingOrder" => "ASC"]);        

        return $this->render('@front_views/index.html.twig',[
            "projectsGallery" => $projectsGallery,
            "projects" => $projects
        ]);
    }
}