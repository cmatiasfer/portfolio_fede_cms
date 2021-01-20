<?php

namespace App\Zard\FrontBundle\Controller;

use App\Repository\Zard\CoreBundle\Entity\ProjectsGalleryRepository;
use App\Repository\Zard\CoreBundle\Entity\ProjectsRepository;
use App\Repository\Zard\CoreBundle\Entity\HomeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    /**
     * @Route("/{_locale}", name="home" , defaults={"_locale"="es"}, requirements={
     *     "_locale"="en|es"
     * })
     */
    public function index($_locale, Request $request, HomeRepository $homeRepository, ProjectsGalleryRepository $projectsGalleryRepository,ProjectsRepository $projectsRepository)
    {
        $slideHome = $homeRepository->findOneBy(['name' => 'home']);
        $orderGallery = $slideHome->getOrderGallery();
        
        if($orderGallery == 'order-random'){
            $projectsGallery = $projectsGalleryRepository->itemsOrderRandom();
        }else{
            $projectsGallery = $projectsGalleryRepository->itemsByOrderProject();
        }
        
        $projects = $projectsRepository->findBy([], ["listingOrder" => "ASC"]);        
        $coverProjectGallery = $projectsGalleryRepository->getProjectGalleryRandom();
        
       /*  dd($coverProjectGallery); */

        return $this->render('@front_views/index.html.twig', [
            "projectsGallery" => $projectsGallery,
            "projects" => $projects,
            'lang_url' => $_locale,
            'coverProjectGallery' => $coverProjectGallery,
        ]);
    }
}