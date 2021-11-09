<?php

namespace App\Controller;

use App\Repository\CircuitsRepository;
use App\Service\Cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/panier", name="cart_index")
     */
    public function index(CartService $cartService)
    {
        $panierWithData = $cartService->getFullCart();
        $total = $cartService->getTotal();
        return $this->render('cart/index.html.twig', [
            'items' => $cartService->getFullCart(),
            'total' => $cartService->getTotal()

        ]);
    }
    /**
     * @Route("/panier/add/{id}", name="cart_add")
     */
    public function add($id, CartService $cartService)
    {

        $cartService->add($id);
        return $this->redirectToRoute("cart_index");
    }
    /**
     * @Route("/panier/remove/{id}", name="cart_remove")
     */
    public function remove($id, CartService $cartService)
    {
        $cartService->remove($id);
        return $this->redirectToRoute("cart_index");
    }
    /**
     * @Route("/panier/payment", name="cart_check")
     */
//     public function payment(Request $request)
//     {
//         // Set your secret key. Remember to switch to your live secret key in production.
// // See your keys here: https://dashboard.stripe.com/apikeys
//         \Stripe\Stripe::setApiKey('sk_test_VePHdqKTYQjKNInc7u56JBrQ');

//       \Stripe\Charge::create([
//   'payment_method_types' => ['card'],
//   'amount' => 1000,
//   'currency' => 'eur',
//   'source' => $request->request->get('stripeToken'),
//   'description' => 'Paiement de test',
// ]);

        
//         return $this->render('cart/payment.html.twig');
//     }
}
