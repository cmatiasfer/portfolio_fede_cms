<?php

namespace App\Zard\CoreBundle\Twig;

use App\Zard\CoreBundle\Entity\Texts;
use App\Repository\Zard\CoreBundle\Entity\TextsRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Doctrine\Common\Persistence\ObjectManager;

class LangExtension extends AbstractExtension
{
    
    public function __construct(TextsRepository $em )
    {   
        $this->text = $em;
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('filter_language', [$this, 'language']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('tt', [$this, 'tt']),
        ];
    }

    public function tt($variable , $type = '', $lang)
    {   
        $uppercase_type = ucwords($type); 
        $uppercase_lang = ucwords($lang); 
        $res_variable = $this->text->findOneBy(['variable' => $variable]);
        
        $getterTitle = 'gettitle'.$uppercase_lang;
        $getterText = 'gettext'.$uppercase_lang;
        $getterSeoTitle = 'getSeoTitle';
        $getterSeoDesc = 'getSeoDesc';
        
        
        if($res_variable != null){
            switch($uppercase_type){
                case 'TITLE':
                    return $res_variable->$getterTitle();
                break;
                case 'TEXT':
                    return $res_variable->$getterText();
                    die;
                break;
                case 'SEO_TITLE':
                    return $res_variable->$getterSeoTitle();
                    die;
                break;
                case 'SEO_DESC':
                    return $res_variable->$getterSeoDesc();
                    die;
                break;
                default:
                    return $res_variable->$getterTitle();
                    die;
                break;
            }
        }else{
            return 'variable:'.$variable.' no found';
        }
    }
}
