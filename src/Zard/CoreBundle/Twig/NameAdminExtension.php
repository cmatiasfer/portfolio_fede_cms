<?php

namespace App\Zard\CoreBundle\Twig;

use App\Zard\CoreBundle\Entity\Texts;
use App\Zard\CoreBundle\Service\AdminService;
use App\Repository\Zard\CoreBundle\Entity\TextsRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Doctrine\Common\Persistence\ObjectManager;

class NameAdminExtension extends AbstractExtension
{
    
    public function __construct(AdminService $adminService )
    {   
        $this->adminService = $adminService;
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('filter_language', [$this, 'name_admin']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('name_admin', [$this, 'name_admin']),
        ];
    }

    public function name_admin()
    {
        return $this->adminService->getNameAdmin();
    }
}
