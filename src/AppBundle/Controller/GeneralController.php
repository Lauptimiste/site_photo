<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Entity\Theme;
use AppBundle\Entity\Rubrique;
use AppBundle\Entity\Image;  

class GeneralController extends Controller
{
  public function indexAction()
  {
    $em = $this->getDoctrine()
      ->getManager()
    ;  
    
    // On récupère la liste des thèmes
    $tbThemes = $em
      ->getRepository('AppBundle:Theme')
      ->findAll()
    ;    
    return $this->render('AppBundle:General:index.html.twig', array(
        'themes' => $tbThemes,
    ));
  }

  public function photoAction(Theme $theme)
  {
    $em = $this->getDoctrine()
      ->getManager()
    ;

    // On récupère la liste des rubriques du thème
    $rubriques = $em
      ->getRepository('AppBundle:Rubrique')
      ->findBy(array('theme' => $theme))
    ;
    
    // Mise en place position de l'image : 1 colonne sur 3
    $tbCol = array();
    foreach ($rubriques as $yyKey => $rubrique) {
        foreach ($rubrique->getImages() as $xxKey => $image) {            
            $imageId = $image->getId();
            if ($imageId % 3 == 1) $tbCol[$imageId] = 1;
            elseif ($imageId % 3 == 2) $tbCol[$imageId] = 2;
            elseif ($imageId % 3 == 0) $tbCol[$imageId] = 3;
        }
    }
    
    // création variable si pas de rubriques
    $uniqRub = true;
    foreach ($rubriques as $yyKey => $rubrique) {
        if ($rubrique->getRef() != $theme->getRef()) {
            $uniqRub = false;
            break;
        }
    }
    
    // Choix de l'image en bandeau
    foreach ($rubriques as $yyKey => $rubrique) {
        if ($rubrique->getId() == $theme->getId()) {
            foreach ($rubrique->getImages() as $xxKey => $image) {
                if ($image->getEmplacement() == 4)  $bandeauImg = $image; 
            }    
        }
    }   
    
    if (!isset($bandeauImg)) $bandeauImg = null; 

    // Twig           
    return $this->render('AppBundle:General:photo.html.twig', array(
      'theme' => $theme,
      'rubriques' => $rubriques,
      'col' => $tbCol, 
      'uniqRub' => $uniqRub,
      'bandeauImg' => $bandeauImg,
    ));
  }

  public function presentationAction()
  {
  
    return $this->render('AppBundle:General:presentation.html.twig', array(

    ));
  }

  public function tarifsAction()
  {
  
    return $this->render('AppBundle:General:tarifs.html.twig', array(

    ));
  }

  public function contactsAction()
  {
  
    return $this->render('AppBundle:General:contacts.html.twig', array(

    ));
  }

  public function livreAction()
  {
  
    return $this->render('AppBundle:General:livre.html.twig', array(

    ));
  }
  
  public function headerAction(Request $request)
  {
    $repository = $this
    	  ->getDoctrine()
    	  ->getManager()
    	  ->getRepository('AppBundle:Theme')
    	;
	
    $listThemes = $repository->findAll();  
   
    return $this->render('AppBundle:General:header.html.twig', array(
        'listThemes' => $listThemes,
    ));
  }

  public function footerAction()
  {
  
    return $this->render('AppBundle:General:footer.html.twig', array(

    ));
  }

    public function carrouselAction(Request $request)
    {
        if ($request->request->get('id')) {
            //make something curious, get some unbelieveable data
//            $arrData = ['output' => 'here the result which will appear in div'];
//            return new JsonResponse($this->render('AppBundle:General:carrousel.html.twig',
//                            array(
//            )));
            $repository = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('AppBundle:Image');
            // On récupère la liste des thèmes
            $image = $repository->find($request->request->get('id'));
            $rubrique = $image->getRubrique();

            $images = $repository->findBy(array('rubrique' => $rubrique, 'emplacement' => array(3, 2)));

            return $this->render('AppBundle:General:carrousel.html.twig', array(
                        'images' => $images,
                        'first' => $image
            ));
        }
//        return $this->render('AppBundle:General:carrousel.html.twig', array(
//        ));
    }

}
