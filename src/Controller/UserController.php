<?php


namespace App\Controller;

use App\Entity\Advert;
use App\Form\AdvertType;
use App\Service\AdvertPhotoUploader;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @package App\Controller
 * @Route("/account")
 */
class UserController extends AbstractController
{

    /**
     * @Route("/my-profile", name="myProfile")
     */
    public function myProfile() {
        return new Response("<h1>Mon compte</h1>");
    }

    /**
     * @Route("/create-advert", name="accountCreateAdvert")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param AdvertPhotoUploader $advertPhotoUploader
     * @return RedirectResponse|Response
     */
    public function createAdvert(Request $request, EntityManagerInterface $em, AdvertPhotoUploader $advertPhotoUploader) {
        $advert = new Advert();
        $advert->setYear(new DateTime());
        $form = $this->createForm(AdvertType::class, $advert);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $advertPhotoUploader->uploadFilesFromForm($form->get('gallery'));
            $em->persist($advert);
            $em->flush();
            return $this->redirectToRoute('showAdvert', ['slug' => $advert->getSlug()]);
        }

        return $this->render("pages/account/create-advert.html.twig", ['form' => $form->createView()]);
    }
}