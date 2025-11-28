<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserSkillOffered;
use App\Entity\UserSkillWanted;
use App\Repository\SkillRepository;
use App\Form\ProfileType;
use App\Repository\UserSkillOfferedRepository;
use App\Repository\UserSkillWantedRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/profile')]
final class ProfileController extends AbstractController
{
    #[Route(name: 'app_profile_index', methods: ['GET', 'POST'])]
    public function index(Request $request, SkillRepository $skillRepository, EntityManagerInterface $entityManager): Response
    {
        $userData = $this->getUser();
        $form = $this->createForm(ProfileType::class, $userData);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($userData);
            $entityManager->flush();

            return $this->redirectToRoute('app_profile_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('profile/index.html.twig', [
            'userData' => $userData,
            'form' => $form,
            'skills' => $skillRepository->findAll()
        ]);
    }
    #[Route('/skillofferedadd/{id}', name: 'app_profile_skillofferedadd', methods: ['GET'])]
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
    #[Route('/skilloffereddel/{id}', name: 'app_profile_skilloffereddel', methods: ['GET'])]
    public function skilloffereddel(Request $request, UserSkillOfferedRepository $userSkillOfferedRepository, EntityManagerInterface $entityManager): Response
    {
        $userData = $this->getUser();
        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $userData->getUserIdentifier()]);
        $userSkillOffered = $userSkillOfferedRepository->findOneBy(['id' => $request->get('id')]);
        $user->removeUserSkillOffered($userSkillOffered);
        $entityManager->persist($userSkillOffered);
        $entityManager->flush();
        return $this->redirectToRoute('app_profile_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/skillwantedadd/{id}', name: 'app_profile_skillwantedadd', methods: ['GET'])]
    public function skillwantedadd(Request $request, SkillRepository $skillRepository, EntityManagerInterface $entityManager): Response
    {
        $userData = $this->getUser();
        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $userData->getUserIdentifier()]);
        $skill = $skillRepository->find($request->get('id'));
        $userSkillWanted = new UserSkillWanted();
        $userSkillWanted->setUser($user);
        $userSkillWanted->setSkill($skill);
        $user->addUserSkillWanted($userSkillWanted);
        $entityManager->persist($userSkillWanted);
        $entityManager->flush();
        return $this->redirectToRoute('app_profile_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/skillwanteddel/{id}', name: 'app_profile_skillwanteddel', methods: ['GET'])]
    public function skillwanteddel(Request $request, UserSkillWantedRepository $userSkillWantedRepository, EntityManagerInterface $entityManager): Response
    {
        $userData = $this->getUser();
        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $userData->getUserIdentifier()]);
        $userSkillWanted = $userSkillWantedRepository->findOneBy(['id' => $request->get('id')]);
        $user->removeUserSkillWanted($userSkillWanted);
        $entityManager->persist($userSkillWanted);
        $entityManager->flush();
        return $this->redirectToRoute('app_profile_index', [], Response::HTTP_SEE_OTHER);
    }
}
