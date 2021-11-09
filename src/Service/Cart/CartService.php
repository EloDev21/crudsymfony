<?php

namespace App\Service\Cart;
use App\Repository\CircuitsRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartService {

    protected $session;
    protected $circuitRepository;

    public function __construct(SessionInterface $session, CircuitsRepository $circuitRepository )
    {
        $this->session = $session;
        $this->circuitRepository= $circuitRepository;
    }

    public function add(int $id)
    {
        $panier = $this->session->get('panier', []);
     
        if (!empty($panier[$id])) {
            $panier[$id]++;
       
        } else {

            $panier[$id] = 1;
        }
        $this->session->set('panier', $panier);

    }
    public function remove(int $id)
    {
        
        $panier = $this->session->get('panier', []);
        if (!empty($panier[$id])) {
            unset( $panier[$id]);
        }
        $this->session->set('panier',$panier) ;
    }
     public function getFullCart() : array
     {
        $panier = $this->session->get('panier', []);
        $panierWithData = [];
        foreach ($panier as $id => $quantity) {
            $panierWithData[] = [
                'circuit' => $this->circuitRepository->find($id),
                'quantity' => $quantity
            ];
        }
        return $panierWithData;
     }
     public function getTotal() : int 
     {
        $total = 0;
 
        foreach($this->getFullCart() as $item){
           
            $total += $item['circuit']->getPrice() * $item ['quantity'];
        }
        return $total;
     }
}