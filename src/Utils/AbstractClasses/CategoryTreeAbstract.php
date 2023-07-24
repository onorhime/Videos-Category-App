<?php
namespace App\Utils\AbstractClasses;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

abstract class CategoryTreeAbstract{
    protected static $dbconnection;
    public $urlGenerator;
    public $em;
    public $categoriesArrayFromDb;
   

    public function __construct(EntityManagerInterface $em, UrlGeneratorInterface $urlGenerator)
    {
        
        $this->urlGenerator = $urlGenerator;
        $this->em = $em;

        $this->categoriesArrayFromDb = $this->getCategories();
      
    }
    
    abstract function getCategoryList(array $category_array);

    private function getCategories(): array
    {
        if (self::$dbconnection) {
            return self::$dbconnection;
        }else{

            $conn = $this->em->getConnection();
            $sql = "SELECET * FROM categories";
            $stmp = $conn->prepare($sql);
            return self::$dbconnection = $stmp->executeQuery()->fetchAllAssociative();
            
        }
       
    }
}