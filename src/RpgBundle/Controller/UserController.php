<?php

namespace RpgBundle\Controller;
use RpgBundle\DTO\PlayerRegisterBindingModel;
use RpgBundle\Entity\Planet;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use RpgBundle\Entity\Player;
use RpgBundle\Form\PlayerType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * Class UserController
 * @package RpgBundle\Controller
 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
 */
class UserController extends PlanetAwareController
{

    CONST MIN_X = 0;
    CONST MAX_X = 100;

    CONST MIN_Y = 0;
    CONST MAX_Y = 100;
    CONST START_PLANETS = 2;

    /**
     * @Route("/", name="rpg_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     *
     * @Route("/profile", name="player_profile")
     */
    public function profileAction()
    {
        /** @var Player $player */
        $player = $this->getUser();
        return $this->render("user/profile", [
            "user" => $player,
            "planetId" => $this->getPlanet()
        ]);
    }

    /**
     * @Route("/user/change/{id}", name="change_planet")
     * @param $id
     * @return RedirectResponse
     */
    public function changePlanet($id)
    {
        /** @var  Player $player */
        $player = $this->getUser();
        $planetRepository = $this->getDoctrine()->getRepository(Planet::class);
        $planet = $planetRepository->findOneBy(
            [
                'id' => $id,
                'player' => $player
            ]
        );
        if ($planet === null) {
            return $this->redirectToRoute("security_logout");
        }
        $this->get('session')->set('planet_id', $id);
        return $this->redirectToRoute("player_profile");
    }

    /**
     * @Route("/register", name="player_register")
     * @Security("is_granted('IS_AUTHENTICATED_ANONYMOUSLY')")
     * @Method("GET")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */

     public function registerAction(Request $request)
    {
        $form = $this->createForm(PlayerType::class);

        return $this->render("/user/register.html.twig",
            [
                'form'=>$form->createView()
            ]);
    }




    /**
     * @param Request $request
     *  @Security("is_granted('IS_AUTHENTICATED_ANONYMOUSLY')")
     * @Route("/register_post", name="player_register_post")
     * @Method("POST")
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function registerPost(Request $request)
    {
        $player=new Player();
        $form=$this->createForm(PlayerType::class,$player);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $password = $this->get("security.password_encoder")
                ->encodePassword($player, $player->getPassword());

            $player->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $em->persist($player);
            $em->flush();

            for ($i = 0; $i < self::START_PLANETS; $i++) {
                $x = -1;
                $y = -1;
                do {
                    $planetRepository = $this->getDoctrine()->getRepository(Planet::class);
                    $x = rand(self::MIN_X, self::MAX_X);
                    $y = rand(self::MIN_Y, self::MAX_Y);
                    $usedPlanet = $planetRepository->findOneBy(
                        ['x' => $x, 'y' => '$y']
                    );
                } while ($usedPlanet !== null);

                $planet = new Planet();
                $planet->setX($x);
                $planet->setY($y);
                $planet->setName($player->getUsername() . "_" . ($i + 1));
                $planet->setPlayer($player);
                $em->persist($planet);
                $em->flush();
            };

            //при успешна регистрация препраща в Login
            return $this->redirectToRoute("security_login");
        }
        $form->getErrors();
        //при неуспешна, остава на същата страница за регистрация
        return $this->redirectToRoute("player_register");

    }




    /**
     * @Route("/register1", name="player_register1")
     * @Security("is_granted('IS_AUTHENTICATED_ANONYMOUSLY')")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */


   public function registerAction2(Request $request)
    {

        $player = new Player();


        $form = $this->createForm($player);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this->get("security.password_encoder")
                ->encodePassword($player, $player->getPassword());

            $player->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $em->persist($player);
            $em->flush();

            for ($i = 0; $i < self::START_PLANETS; $i++) {
                $x = -1;
                $y = -1;
                do {
                    $planetRepository = $this->getDoctrine()->getRepository(Planet::class);
                    $x = rand(self::MIN_X, self::MAX_X);
                    $y = rand(self::MIN_Y, self::MAX_Y);
                    $usedPlanet = $planetRepository->findOneBy(
                        ['x' => $x, 'y' => '$y']
                    );
                } while ($usedPlanet !== null);

                $planet = new Planet();
                $planet->setX($x);
                $planet->setY($y);
                $planet->setName($player->getUsername() . "_" . ($i + 1));
                $planet->setPlayer($player);
                $em->persist($planet);
                $em->flush();
            };
            //при успешна регистрация препраща в Login
            return $this->redirectToRoute("security_login");
        } //при неуспешна, остава на същата страница за регистрация
        return $this->render("/user/register.html.twig");
    }





}