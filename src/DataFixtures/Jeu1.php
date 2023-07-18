<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Categorie;
use App\Entity\Commande;
use App\Entity\Detail;
use App\Entity\Plat;
use App\Entity\Utilisateur;

class Jeu1 extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Utilisateurs
        $utilisateur1 = new Utilisateur();
        $utilisateur1->setEmail('jean.d@admin.com');
        $utilisateur1->setPassword(password_hash('password123', PASSWORD_BCRYPT));
        $utilisateur1->setNom('Dupont');
        $utilisateur1->setPrenom('Jean');
        $utilisateur1->setTelephone('0601020304');
        $utilisateur1->setAdresse('1 Rue Principale');
        $utilisateur1->setCp('75000');
        $utilisateur1->setVille('Paris');
        $utilisateur1->setRoles(['ROLE_ADMIN']);

        $utilisateur2 = new Utilisateur();
        $utilisateur2->setEmail('sophie.m@chef.com');
        $utilisateur2->setPassword(password_hash('password456', PASSWORD_BCRYPT));
        $utilisateur2->setNom('Martin');
        $utilisateur2->setPrenom('Sophie');
        $utilisateur2->setTelephone('0605060708');
        $utilisateur2->setAdresse('2 Avenue Secondaire');
        $utilisateur2->setCp('69000');
        $utilisateur2->setVille('Lyon');
        $utilisateur2->setRoles(['ROLE_CHEF']);

        $utilisateur3 = new Utilisateur();
        $utilisateur3->setEmail('marie.d@client.com');
        $utilisateur3->setPassword(password_hash('password789', PASSWORD_BCRYPT));
        $utilisateur3->setNom('Durand');
        $utilisateur3->setPrenom('Marie');
        $utilisateur3->setTelephone('0607080910');
        $utilisateur3->setAdresse('3 Boulevard Tertiaire');
        $utilisateur3->setCp('13000');
        $utilisateur3->setVille('Marseille');
        $utilisateur3->setRoles(['ROLE_CLIENT']);

        // Catégories 
        $categorie1 = new Categorie();
        $categorie1->setLibelle('Entrées');
        $categorie1->setImage('entrees.webp');
        $categorie1->setActive(true);

        $categorie2 = new Categorie();
        $categorie2->setLibelle('Viandes');
        $categorie2->setImage('viandes.webp');
        $categorie2->setActive(true);

        $categorie3 = new Categorie();
        $categorie3->setLibelle('Desserts');
        $categorie3->setImage('desserts.webp');
        $categorie3->setActive(true);

        $categorie4 = new Categorie();
        $categorie4->setLibelle('Pizzas');
        $categorie4->setImage('pizzas.webp');
        $categorie4->setActive(true);

        $categorie5 = new Categorie();
        $categorie5->setLibelle('Sushis');
        $categorie5->setImage('sushis.webp');
        $categorie5->setActive(false);

        $categorie6 = new Categorie();
        $categorie6->setLibelle('Burgers');
        $categorie6->setImage('burgers.webp');
        $categorie6->setActive(true);

        $categorie7 = new Categorie();
        $categorie7->setLibelle('Soupes');
        $categorie7->setImage('soupes.webp');
        $categorie7->setActive(false);

        $categorie8 = new Categorie();
        $categorie8->setLibelle('Salades');
        $categorie8->setImage('salades.webp');
        $categorie8->setActive(true);

        $categorie9 = new Categorie();
        $categorie9->setLibelle('Pâtes');
        $categorie9->setImage('pates.webp');
        $categorie9->setActive(true);

        $categorie10 = new Categorie();
        $categorie10->setLibelle('Boissons');
        $categorie10->setImage('boissons.webp');
        $categorie10->setActive(true);

        // Plats

        // Entrées
        $plat1 = new Plat();
        $plat1->setLibelle('Tartare de saumon');
        $plat1->setDescription('Saumon frais coupé en petits dés, assaisonné avec de l\'huile d\'olive, du citron et de l\'aneth.');
        $plat1->setPrix(12.99);
        $plat1->setImage('tartareausaumon.webp');
        $plat1->setActive(true);
        $plat1->setCategorie($categorie1);

        $plat2 = new Plat();
        $plat2->setLibelle('Foie gras poêlé');
        $plat2->setDescription('Foie gras poêlé servi avec une compote de pommes et du pain grillé.');
        $plat2->setPrix(16.99);
        $plat2->setImage('foiegraspoele.webp');
        $plat2->setActive(false);
        $plat2->setCategorie($categorie1);

        $plat3 = new Plat();
        $plat3->setLibelle('Petite salade de chèvre chaud');
        $plat3->setDescription('Salade verte, fromage de chèvre chaud sur toast, noix et vinaigrette balsamique.');
        $plat3->setPrix(9.99);
        $plat3->setImage('petitesaladedechevrechaud.webp');
        $plat3->setActive(true);
        $plat3->setCategorie($categorie1);

        // Viandes
        $plat4 = new Plat();
        $plat4->setLibelle('Entrecôte grillée');
        $plat4->setDescription('Entrecôte de boeuf grillée servie avec des frites et une sauce béarnaise.');
        $plat4->setPrix(24.99);
        $plat4->setImage('entrecotegrillee.webp');
        $plat4->setActive(true);
        $plat4->setCategorie($categorie2);

        $plat5 = new Plat();
        $plat5->setLibelle('Magret de canard');
        $plat5->setDescription('Magret de canard grillé servi avec une purée de patates douces et une sauce aux fruits rouges.');
        $plat5->setPrix(22.99);
        $plat5->setImage('magretdecanard.webp');
        $plat5->setActive(false);
        $plat5->setCategorie($categorie2);

        $plat6 = new Plat();
        $plat6->setLibelle('Steak tartare');
        $plat6->setDescription('Un bon mélange de viande hachée, de câpres et de cornichons, parfaitement assaisonné, servi avec son oeuf.');
        $plat6->setPrix(18.99);
        $plat6->setImage('steaktartare.webp');
        $plat6->setActive(true);
        $plat6->setCategorie($categorie2);

        // Desserts
        $plat7 = new Plat();
        $plat7->setLibelle('Crème brûlée');
        $plat7->setDescription('Crème brûlée à la vanille.');
        $plat7->setPrix(6.99);
        $plat7->setImage('cremebrulee.webp');
        $plat7->setActive(true);
        $plat7->setCategorie($categorie3);

        $plat8 = new Plat();
        $plat8->setLibelle('Tarte Tatin');
        $plat8->setDescription('Tarte Tatin aux pommes.');
        $plat8->setPrix(7.99);
        $plat8->setImage('tartetatin.webp');
        $plat8->setActive(false);
        $plat8->setCategorie($categorie3);

        $plat9 = new Plat();
        $plat9->setLibelle('Mousse au chocolat');
        $plat9->setDescription('Mousse au chocolat noir.');
        $plat9->setPrix(5.99);
        $plat9->setImage('mousseauchocolat.webp');
        $plat9->setActive(true);
        $plat9->setCategorie($categorie3);

        // Pizzas
        $plat10 = new Plat();
        $plat10->setLibelle('Margherita');
        $plat10->setDescription('Tomate, mozzarella et basilic.');
        $plat10->setPrix(9.99);
        $plat10->setImage('margherita.webp');
        $plat10->setActive(true);
        $plat10->setCategorie($categorie4);

        $plat11 = new Plat();
        $plat11->setLibelle('Reine');
        $plat11->setDescription('Tomate, mozzarella, jambon et champignons.');
        $plat11->setPrix(11.99);
        $plat11->setImage('reine.webp');
        $plat11->setActive(true);
        $plat11->setCategorie($categorie4);

        $plat12 = new Plat();
        $plat12->setLibelle('4 fromages');
        $plat12->setDescription('Tomate, mozzarella, gorgonzola, chèvre et parmesan.');
        $plat12->setPrix(12.99);
        $plat12->setImage('4fromages.webp');
        $plat12->setActive(true);
        $plat12->setCategorie($categorie4);

        // Sushis
        $plat13 = new Plat();
        $plat13->setLibelle('Sushi Saumon');
        $plat13->setDescription('Sushi Saumon frais coupé en petits dés, assaisonné avec de l\'huile d\'olive, du citron et de l\'aneth.');
        $plat13->setPrix(12.99);
        $plat13->setImage('sushisaumon.webp');
        $plat13->setActive(false);
        $plat13->setCategorie($categorie5);

        $plat14 = new Plat();
        $plat14->setLibelle('Sashimi Thon');
        $plat14->setDescription('Sashimi Thon frais coupé en petits dés, assaisonné avec de l\'huile d\'olive, du citron et de l\'aneth.');
        $plat14->setPrix(14.99);
        $plat14->setImage('sashimithon.webp');
        $plat14->setActive(true);
        $plat14->setCategorie($categorie5);

        $plat15 = new Plat();
        $plat15->setLibelle('Maki California');
        $plat15->setDescription('Maki California avec avocat et crabe.');
        $plat15->setPrix(10.99);
        $plat15->setImage('makicalifornia.webp');
        $plat15->setActive(true);
        $plat15->setCategorie($categorie5);

        // Hamburgers
        $plat16 = new Plat();
        $plat16->setLibelle('Hamburger végétarien');
        $plat16->setDescription('Steak végétarien grillé servi avec des frites et une sauce au yaourt.');
        $plat16->setPrix(12.99);
        $plat16->setImage('hamburgervegetarien.webp');
        $plat16->setActive(true);
        $plat16->setCategorie($categorie6);

        $plat17 = new Plat();
        $plat17->setLibelle('Hamburger au bacon');
        $plat17->setDescription('Steak haché de boeuf grillé servi avec des frites, du bacon et du fromage.');
        $plat17->setPrix(14.99);
        $plat17->setImage('hamburgeraubacon.webp');
        $plat17->setActive(false);
        $plat17->setCategorie($categorie6);

        $plat18 = new Plat();
        $plat18->setLibelle('Hamburger au poulet');
        $plat18->setDescription('Filet de poulet grillé servi avec des frites et une sauce barbecue.');
        $plat18->setPrix(13.99);
        $plat18->setImage('hamburgeraupoulet.webp');
        $plat18->setActive(true);
        $plat18->setCategorie($categorie6);

        // Soupes
        $plat19 = new Plat();
        $plat19->setLibelle('Soupe à l\'oignon');
        $plat19->setDescription('Soupe à l\'oignon gratinée.');
        $plat19->setPrix(7.99);
        $plat19->setImage('soupealoignon.webp');
        $plat19->setActive(true);
        $plat19->setCategorie($categorie7);

        $plat20 = new Plat();
        $plat20->setLibelle('Soupe de poisson');
        $plat20->setDescription('Soupe de poisson avec des croûtons et du fromage râpé.');
        $plat20->setPrix(8.99);
        $plat20->setImage('soupedepoisson.webp');
        $plat20->setActive(true);
        $plat20->setCategorie($categorie7);

        $plat21 = new Plat();
        $plat21->setLibelle('Soupe de légumes');
        $plat21->setDescription('Soupe de légumes avec des croûtons.');
        $plat21->setPrix(6.99);
        $plat21->setImage('soupedelegumes.webp');
        $plat21->setActive(true);
        $plat21->setCategorie($categorie7);

        // Salades
        $plat22 = new Plat();
        $plat22->setLibelle('Salade César');
        $plat22->setDescription('Salade César avec poulet grillé, croûtons et parmesan.');
        $plat22->setPrix(9.99);
        $plat22->setImage('saladecesar.webp');
        $plat22->setActive(true);
        $plat22->setCategorie($categorie8);

        $plat23 = new Plat();
        $plat23->setLibelle('Salade Niçoise');
        $plat23->setDescription('Salade Niçoise avec thon, oeufs durs, tomates et olives.');
        $plat23->setPrix(10.99);
        $plat23->setImage('saladenicoise.webp');
        $plat23->setActive(true);
        $plat23->setCategorie($categorie8);

        $plat24 = new Plat();
        $plat24->setLibelle('Salade de chèvre chaud');
        $plat24->setDescription('Salade verte avec fromage de chèvre chaud et vinaigrette au miel.');
        $plat24->setPrix(12.99);
        $plat24->setImage('saladedechevrechaud.webp');
        $plat24->setActive(true);
        $plat24->setCategorie($categorie8);

        // Pâtes
        $plat25 = new Plat();
        $plat25->setLibelle('Spaghetti bolognaise');
        $plat25->setDescription('Spaghetti avec une sauce bolognaise maison.');
        $plat25->setPrix(11.99);
        $plat25->setImage('spaghettibolognaise.webp');
        $plat25->setActive(true);
        $plat25->setCategorie($categorie9);

        $plat26 = new Plat();
        $plat26->setLibelle('Penne à la carbonara');
        $plat26->setDescription('Penne avec une sauce carbonara à la crème et au bacon.');
        $plat26->setPrix(12.99);
        $plat26->setImage('pennealacarbonara.webp');
        $plat26->setActive(true);
        $plat26->setCategorie($categorie9);

        $plat27 = new Plat();
        $plat27->setLibelle('Lasagnes');
        $plat27->setDescription('Lasagnes maison avec de la viande hachée et de la béchamel.');
        $plat27->setPrix(13.99);
        $plat27->setImage('lasagnes.webp');
        $plat27->setActive(false);
        $plat27->setCategorie($categorie9);

        // Boissons
        $plat28 = new Plat();
        $plat28->setLibelle('Coca-Cola');
        $plat28->setDescription('Boisson gazeuse Coca-Cola.');
        $plat28->setPrix(3.99);
        $plat28->setImage('cocacola.webp');
        $plat28->setActive(true);
        $plat28->setCategorie($categorie10);

        $plat29 = new Plat();
        $plat29->setLibelle('Jus d\'orange');
        $plat29->setDescription('Jus d\'orange pressé frais.');
        $plat29->setPrix(2.99);
        $plat29->setImage('jusdorange.webp');
        $plat29->setActive(true);
        $plat29->setCategorie($categorie10);

        $plat30 = new Plat();
        $plat30->setLibelle('Eau minérale');
        $plat30->setDescription('Eau minérale plate ou gazeuse.');
        $plat30->setPrix(1.99);
        $plat30->setImage('eauminerale.webp');
        $plat30->setActive(true);
        $plat30->setCategorie($categorie10);

        // Commandes
        $commande1 = new Commande();
        $commande1->setDateCommande(new \DateTime());
        $commande1->setTotal(0);
        $commande1->setEtat(3);
        $commande1->setUtilisateur($utilisateur1);

        $commande2 = new Commande();
        $commande2->setDateCommande(new \DateTime());
        $commande2->setTotal(0);
        $commande2->setEtat(2);
        $commande2->setUtilisateur($utilisateur1);

        $commande3 = new Commande();
        $commande3->setDateCommande(new \DateTime());
        $commande3->setTotal(0);
        $commande3->setEtat(3);
        $commande3->setUtilisateur($utilisateur2);

        $commande4 = new Commande();
        $commande4->setDateCommande(new \DateTime());
        $commande4->setTotal(0);
        $commande4->setEtat(1);
        $commande4->setUtilisateur($utilisateur2);

        $commande5 = new Commande();
        $commande5->setDateCommande(new \DateTime());
        $commande5->setTotal(0);
        $commande5->setEtat(3);
        $commande5->setUtilisateur($utilisateur3);

        $commande6 = new Commande();
        $commande6->setDateCommande(new \DateTime());
        $commande6->setTotal(0);
        $commande6->setEtat(3);
        $commande6->setUtilisateur($utilisateur3);

        $commande7 = new Commande();
        $commande7->setDateCommande(new \DateTime());
        $commande7->setTotal(0);
        $commande7->setEtat(3);
        $commande7->setUtilisateur($utilisateur3);

        $commande8 = new Commande();
        $commande8->setDateCommande(new \DateTime());
        $commande8->setTotal(0);
        $commande8->setEtat(2);
        $commande8->setUtilisateur($utilisateur3);

        $commande9 = new Commande();
        $commande9->setDateCommande(new \DateTime());
        $commande9->setTotal(0);
        $commande9->setEtat(1);
        $commande9->setUtilisateur($utilisateur3);

        $commande10 = new Commande();
        $commande10->setDateCommande(new \DateTime());
        $commande10->setTotal(0);
        $commande10->setEtat(1);
        $commande10->setUtilisateur($utilisateur3);

        // Détails
        $detail1 = new Detail();
        $detail1->setQuantite(2);
        $detail1->setCommande($commande1);
        $detail1->setPlat($plat2);

        $detail2 = new Detail();
        $detail2->setQuantite(3);
        $detail2->setCommande($commande1);
        $detail2->setPlat($plat9);

        $detail3 = new Detail();
        $detail3->setQuantite(1);
        $detail3->setCommande($commande2);
        $detail3->setPlat($plat3);

        $detail4 = new Detail();
        $detail4->setQuantite(2);
        $detail4->setCommande($commande3);
        $detail4->setPlat($plat28);

        $detail5 = new Detail();
        $detail5->setQuantite(1);
        $detail5->setCommande($commande4);
        $detail5->setPlat($plat11);

        $detail6 = new Detail();
        $detail6->setQuantite(3);
        $detail6->setCommande($commande5);
        $detail6->setPlat($plat14);

        $detail7 = new Detail();
        $detail7->setQuantite(2);
        $detail7->setCommande($commande5);
        $detail7->setPlat($plat18);

        $detail8 = new Detail();
        $detail8->setQuantite(1);
        $detail8->setCommande($commande10);
        $detail8->setPlat($plat22);

        $detail9 = new Detail();
        $detail9->setQuantite(1);
        $detail9->setCommande($commande1);
        $detail9->setPlat($plat24);

        $detail10 = new Detail();
        $detail10->setQuantite(2);
        $detail10->setCommande($commande2);
        $detail10->setPlat($plat8);

        $detail11 = new Detail();
        $detail11->setQuantite(3);
        $detail11->setCommande($commande3);
        $detail11->setPlat($plat6);

        $detail12 = new Detail();
        $detail12->setQuantite(1);
        $detail12->setCommande($commande4);
        $detail12->setPlat($plat3);

        $detail13 = new Detail();
        $detail13->setQuantite(2);
        $detail13->setCommande($commande5);
        $detail13->setPlat($plat18);

        $detail14 = new Detail();
        $detail14->setQuantite(2);
        $detail14->setCommande($commande1);
        $detail14->setPlat($plat27);

        $detail15 = new Detail();
        $detail15->setQuantite(1);
        $detail15->setCommande($commande2);
        $detail15->setPlat($plat21);

        $detail16 = new Detail();
        $detail16->setQuantite(2);
        $detail16->setCommande($commande3);
        $detail16->setPlat($plat20);

        $detail17 = new Detail();
        $detail17->setQuantite(3);
        $detail17->setCommande($commande4);
        $detail17->setPlat($plat2);

        $detail18 = new Detail();
        $detail18->setQuantite(1);
        $detail18->setCommande($commande5);
        $detail18->setPlat($plat2);

        $manager->persist($utilisateur1);
        $manager->persist($utilisateur2);
        $manager->persist($utilisateur3);
        $manager->persist($categorie1);
        $manager->persist($categorie2);
        $manager->persist($categorie3);
        $manager->persist($categorie4);
        $manager->persist($categorie5);
        $manager->persist($categorie6);
        $manager->persist($categorie7);
        $manager->persist($categorie8);
        $manager->persist($categorie9);
        $manager->persist($categorie10);
        $manager->persist($plat1);
        $manager->persist($plat2);
        $manager->persist($plat3);
        $manager->persist($plat4);
        $manager->persist($plat5);
        $manager->persist($plat6);
        $manager->persist($plat7);
        $manager->persist($plat8);
        $manager->persist($plat9);
        $manager->persist($plat10);
        $manager->persist($plat11);
        $manager->persist($plat12);
        $manager->persist($plat13);
        $manager->persist($plat14);
        $manager->persist($plat15);
        $manager->persist($plat16);
        $manager->persist($plat17);
        $manager->persist($plat18);
        $manager->persist($plat19);
        $manager->persist($plat20);
        $manager->persist($plat21);
        $manager->persist($plat22);
        $manager->persist($plat23);
        $manager->persist($plat24);
        $manager->persist($plat25);
        $manager->persist($plat26);
        $manager->persist($plat27);
        $manager->persist($plat28);
        $manager->persist($plat29);
        $manager->persist($plat30);
        $manager->persist($commande1);
        $manager->persist($commande2);
        $manager->persist($commande3);
        $manager->persist($commande4);
        $manager->persist($commande5);
        $manager->persist($commande6);
        $manager->persist($commande7);
        $manager->persist($commande8);
        $manager->persist($commande9);
        $manager->persist($commande10);
        $manager->persist($detail1);
        $manager->persist($detail2);
        $manager->persist($detail3);
        $manager->persist($detail4);
        $manager->persist($detail5);
        $manager->persist($detail6);
        $manager->persist($detail7);
        $manager->persist($detail8);
        $manager->persist($detail9);
        $manager->persist($detail10);
        $manager->persist($detail11);
        $manager->persist($detail12);
        $manager->persist($detail13);
        $manager->persist($detail14);
        $manager->persist($detail15);
        $manager->persist($detail16);
        $manager->persist($detail17);
        $manager->persist($detail18);

        $manager->flush();
    }
}
