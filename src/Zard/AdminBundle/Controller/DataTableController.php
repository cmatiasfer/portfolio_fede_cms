<?php

namespace App\Zard\AdminBundle\Controller;

use App\Zard\CoreBundle\Entity\StudioCategory;
use App\Zard\CoreBundle\Entity\Project;
use App\Zard\CoreBundle\Entity\ProjectGallery;
use App\Repository\Zard\CoreBundle\Entity\ProjectRepository;
use App\Repository\Zard\CoreBundle\Entity\ProjectGalleryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Zard\AdminBundle\Form\ProjectType;
use App\Zard\CoreBundle\Service\AdminService;
use App\Zard\AdminBundle\Form\StudioCategoryType;
use Jawira\CaseConverter\Convert;

/**
 * @Route("admin")
 */
class DataTableController extends AbstractController
{
    /**
     * @Route("/datatable", name="datable_json", methods={"GET","POST"})
     */
    public function show(Request $request, AdminService $adminService): Response
    {
		$em = $this->getDoctrine()->getManager();
		//PARAMETROS 
        $mode = $request->query->get('_mode');
        $section = $request->query->get('_section');
		$parameters = $request->query->all();
        // DATATABLE
        $page = $request->query->get('draw');
        $start = $request->query->get('start');
        $length = $request->query->get('length');
		
		if($mode == "remove"){
			$listIdRemove = explode(',',$request->query->get('_list'));
			foreach($listIdRemove as $idRemove){
				$product = $em->getRepository("AppRemo:Products")->findOneBy(["id" => $idRemove]);
				$em->remove($product);
				$em->flush();
			}
        }
        
        $adminService->start($section);
        $section = new Convert($section);
        
        $elementsFilters = $em->getRepository("AppRemo:".$section->toPascal())->findAdmin($parameters, $limit=true);
        
        $rows = [];
        foreach($elementsFilters as $element){
            $data["colCheck"] = "<input type='checkbox' id='checkbox' class='checks' data-id='".$element->getId()."'> ";
            foreach($adminService->getColumns() as $title => $field){
                $data[$field] = $this
                    ->render('@admin_views/components/row.html.twig', ["title" => $title, "row" => $element, "field" => $field])
                    ->getContent();
            }
            
            $actions = $this
                ->render('@admin_views/components/buttons.html.twig', ["row" => $element, "section"=> $adminService->getSection(),"actions" => $adminService->getActions()])
                ->getContent();

            $data["actions"] = $actions;
            array_push($rows, $data);
        }
            

		$elementsFiltersWithoutLimit = $em->getRepository("AppRemo:".$section->toPascal())->findAdmin($parameters, $limit=false);

		$allElementsEntity = $em->getRepository("AppRemo:".$section->toPascal())->findAdmin($parameters=[], $limit=false);

		$data["data"] = $rows;
		$data["draw"] = $page;
		$data["recordsFiltered"] = count($elementsFiltersWithoutLimit);
		$data["recordsTotal"] = count($allElementsEntity);

		return new JsonResponse($data);
	}
}