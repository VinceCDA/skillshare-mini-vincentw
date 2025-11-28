<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserSkillOffered;
use App\Repository\SkillRepository;
use App\Form\ProfileType;
use App\Repository\UserSkillOfferedRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/profile')]
final class ProfileController extends AbstractController
{
    #[Route(name: 'app_profile_index', methods: ['GET'])]
    public function index(Request $request, SkillRepository $skillRepository): Response
    {
        $userData = $this->getUser();
        $skills = $skillRepository->findAll();
        $form = $this->createForm(ProfileType::class, $userData);
        $form->handleRequest($request);
        return $this->render('profile/index.html.twig', [
            'userData' => $userData,
            'form' => $form,
            'skills' => $skillRepository->findAll()
        ]);
    }
    #[Route('/skillofferedadd/{id}', name: 'app_profile_skillofferedadd', methods: ['GET', 'POST'])]
    public function skillofferedadd(Request $request, SkillRepository $skillRepository, EntityManagerInterface $entityManager): Response
    {
        $userData = $this->getUser();
        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $userData->getUserIdentifier()]);
        $skill = $skillRepository->find($request->get('id'));
        $userSkillOffered = new UserSkillOffered();
        $userSkillOffered->setUser($user);
        $userSkillOffered->setSkill($skill);
        $user->addUserSkillOffered($userSkillOffered);
        $entityManager->persist($userSkillOffered);
        $entityManager->flush();
        return $this->redirectToRoute('app_profile_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/skilloffereddel/{id}', name: 'app_profile_skilloffereddel', methods: ['GET', 'POST'])]
    public function skilloffereddel(Request $request, UserSkillOfferedRepository $userSkillOfferedRepository, EntityManagerInterface $entityManager): Response
    {
        $userData = $this->getUser();
        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $userData->getUserIdentifier()]);
        $userSkillOffered = $userSkillOfferedRepository->findOneBy(['id' => $request->get('id')]);
        //dd($userSkillOffered);
        //$userSkillOffered = $entityManager->getRepository(User::class)->findOneBy(['email' => $userData->getUserIdentifier()]);
        //$userSkillOffered = $entityManager->getRepository(User::class)->findOneBy(['email' => $userData->getUserIdentifier()]);
        $user->removeUserSkillOffered($userSkillOffered);
        $entityManager->persist($userSkillOffered);
        $entityManager->flush();
        return $this->redirectToRoute('app_profile_index', [], Response::HTTP_SEE_OTHER);
    }
}
