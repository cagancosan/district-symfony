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
        $plat1_1 = new Plat();
        $plat1_1->setLibelle('Tartare de saumon');
        $plat1_1->setDescription('Saumon frais coupé en petits dés, assaisonné avec de l\'huile d\'olive, du citron et de l\'aneth.');
        $plat1_1->setPrix(12.99);
        $plat1_1->setImage('tartareausaumon.webp');
        $plat1_1->setActive(true);
        $categorie1->addPlat($plat1_1);

        $plat1_2 = new Plat();
        $plat1_2->setLibelle('Foie gras poêlé');
        $plat1_2->setDescription('Foie gras poêlé servi avec une compote de pommes et du pain grillé.');
        $plat1_2->setPrix(16.99);
        $plat1_2->setImage('foiegraspoele.webp');
        $plat1_2->setActive(false);
        $categorie1->addPlat($plat1_2);

        $plat1_3 = new Plat();
        $plat1_3->setLibelle('Petite salade de chèvre chaud');
        $plat1_3->setDescription('Salade verte, fromage de chèvre chaud sur toast, noix et vinaigrette balsamique.');
        $plat1_3->setPrix(9.99);
        $plat1_3->setImage('petitesaladedechevrechaud.webp');
        $plat1_3->setActive(true);
        $categorie1->addPlat($plat1_3);

        $plat1_4 = new Plat();
        $plat1_4->setLibelle('Carpaccio de bœuf');
        $plat1_4->setDescription('Fines tranches de bœuf cru assaisonnées avec de l\'huile d\'olive, des copeaux de parmesan et des câpres.');
        $plat1_4->setPrix(14.99);
        $plat1_4->setImage('carpacciodeboeuf.webp');
        $plat1_4->setActive(true);
        $categorie1->addPlat($plat1_4);

        $plat1_5 = new Plat();
        $plat1_5->setLibelle('Moules marinières');
        $plat1_5->setDescription('Moules cuites dans un bouillon à base de vin blanc, d\'oignons, d\'ail et de persil.');
        $plat1_5->setPrix(10.99);
        $plat1_5->setImage('moulesmarinieres.webp');
        $plat1_5->setActive(true);
        $categorie1->addPlat($plat1_5);

        // Viandes
        $plat2_1 = new Plat();
        $plat2_1->setLibelle('Entrecôte grillée');
        $plat2_1->setDescription('Entrecôte de boeuf grillée servie avec des frites et une sauce béarnaise.');
        $plat2_1->setPrix(24.99);
        $plat2_1->setImage('entrecotegrillee.webp');
        $plat2_1->setActive(true);
        $categorie2->addPlat($plat2_1);

        $plat2_2 = new Plat();
        $plat2_2->setLibelle('Magret de canard');
        $plat2_2->setDescription('Magret de canard grillé servi avec une purée de patates douces et une sauce aux fruits rouges.');
        $plat2_2->setPrix(22.99);
        $plat2_2->setImage('magretdecanard.webp');
        $plat2_2->setActive(false);
        $categorie2->addPlat($plat2_2);

        $plat2_3 = new Plat();
        $plat2_3->setLibelle('Steak tartare');
        $plat2_3->setDescription('Un bon mélange de viande hachée, de câpres et de cornichons, parfaitement assaisonné, servi avec son oeuf.');
        $plat2_3->setPrix(18.99);
        $plat2_3->setImage('steaktartare.webp');
        $plat2_3->setActive(true);
        $categorie2->addPlat($plat2_3);

        $plat2_4 = new Plat();
        $plat2_4->setLibelle('Poulet rôti');
        $plat2_4->setDescription('Poulet entier rôti au four avec des herbes et des légumes de saison.');
        $plat2_4->setPrix(19.99);
        $plat2_4->setImage('pouletroti.webp');
        $plat2_4->setActive(true);
        $categorie2->addPlat($plat2_4);

        $plat2_5 = new Plat();
        $plat2_5->setLibelle('Risotto aux champignons');
        $plat2_5->setDescription('Risotto crémeux préparé avec des champignons sautés, du parmesan et du bouillon de légumes.');
        $plat2_5->setPrix(16.49);
        $plat2_5->setImage('risottoauxchampignons.webp');
        $plat2_5->setActive(true);
        $categorie2->addPlat($plat2_5);

        // Desserts
        $plat3_1 = new Plat();
        $plat3_1->setLibelle('Crème brûlée');
        $plat3_1->setDescription('Crème brûlée à la vanille.');
        $plat3_1->setPrix(6.99);
        $plat3_1->setImage('cremebrulee.webp');
        $plat3_1->setActive(true);
        $categorie3->addPlat($plat3_1);

        $plat3_2 = new Plat();
        $plat3_2->setLibelle('Tarte Tatin');
        $plat3_2->setDescription('Tarte Tatin aux pommes.');
        $plat3_2->setPrix(7.99);
        $plat3_2->setImage('tartetatin.webp');
        $plat3_2->setActive(false);
        $categorie3->addPlat($plat3_2);

        $plat3_3 = new Plat();
        $plat3_3->setLibelle('Mousse au chocolat');
        $plat3_3->setDescription('Mousse au chocolat noir.');
        $plat3_3->setPrix(5.99);
        $plat3_3->setImage('mousseauchocolat.webp');
        $plat3_3->setActive(true);
        $categorie3->addPlat($plat3_3);

        $plat3_4 = new Plat();
        $plat3_4->setLibelle('Panna Cotta aux fruits rouges');
        $plat3_4->setDescription('Panna Cotta onctueuse aux fruits rouges et coulis de fruits frais.');
        $plat3_4->setPrix(8.49);
        $plat3_4->setImage('pannacotta.webp');
        $plat3_4->setActive(true);
        $categorie3->addPlat($plat3_4);

        // Pizzas
        $plat4_1 = new Plat();
        $plat4_1->setLibelle('Margherita');
        $plat4_1->setDescription('Tomate, mozzarella et basilic.');
        $plat4_1->setPrix(9.99);
        $plat4_1->setImage('margherita.webp');
        $plat4_1->setActive(true);
        $categorie4->addPlat($plat4_1);

        $plat4_2 = new Plat();
        $plat4_2->setLibelle('Reine');
        $plat4_2->setDescription('Tomate, mozzarella, jambon et champignons.');
        $plat4_2->setPrix(11.99);
        $plat4_2->setImage('reine.webp');
        $plat4_2->setActive(true);
        $categorie4->addPlat($plat4_2);

        $plat4_3 = new Plat();
        $plat4_3->setLibelle('4 fromages');
        $plat4_3->setDescription('Tomate, mozzarella, gorgonzola, chèvre et parmesan.');
        $plat4_3->setPrix(12.99);
        $plat4_3->setImage('4fromages.webp');
        $plat4_3->setActive(true);
        $categorie4->addPlat($plat4_3);

        // Sushis
        $plat5_1 = new Plat();
        $plat5_1->setLibelle('Sushi Saumon');
        $plat5_1->setDescription('Sushi Saumon frais coupé en petits dés, assaisonné avec de l\'huile d\'olive, du citron et de l\'aneth.');
        $plat5_1->setPrix(12.99);
        $plat5_1->setImage('sushisaumon.webp');
        $plat5_1->setActive(false);
        $categorie5->addPlat($plat5_1);

        $plat5_2 = new Plat();
        $plat5_2->setLibelle('Sashimi Thon');
        $plat5_2->setDescription('Sashimi Thon frais coupé en petits dés, assaisonné avec de l\'huile d\'olive, du citron et de l\'aneth.');
        $plat5_2->setPrix(14.99);
        $plat5_2->setImage('sashimithon.webp');
        $plat5_2->setActive(true);
        $categorie5->addPlat($plat5_2);

        // Hamburgers
        $plat6_1 = new Plat();
        $plat6_1->setLibelle('Hamburger végétarien');
        $plat6_1->setDescription('Steak végétarien grillé servi avec des frites et une sauce au yaourt.');
        $plat6_1->setPrix(12.99);
        $plat6_1->setImage('hamburgervegetarien.webp');
        $plat6_1->setActive(true);
        $categorie6->addPlat($plat6_1);

        $plat6_2 = new Plat();
        $plat6_2->setLibelle('Hamburger au bacon');
        $plat6_2->setDescription('Steak haché de boeuf grillé servi avec des frites, du bacon et du fromage.');
        $plat6_2->setPrix(14.99);
        $plat6_2->setImage('hamburgeraubacon.webp');
        $plat6_2->setActive(false);
        $categorie6->addPlat($plat6_2);

        $plat6_3 = new Plat();
        $plat6_3->setLibelle('Hamburger au poulet');
        $plat6_3->setDescription('Filet de poulet grillé servi avec des frites et une sauce barbecue.');
        $plat6_3->setPrix(13.99);
        $plat6_3->setImage('hamburgeraupoulet.webp');
        $plat6_3->setActive(true);
        $categorie6->addPlat($plat6_3);

        $plat6_4 = new Plat();
        $plat6_4->setLibelle('Hamburger au fromage de chèvre');
        $plat6_4->setDescription('Steak de boeuf grillé servi avec des frites, du fromage de chèvre et de la confiture de figues.');
        $plat6_4->setPrix(15.49);
        $plat6_4->setImage('hamburgerfromagechevre.webp');
        $plat6_4->setActive(true);
        $categorie6->addPlat($plat6_4);

        $plat6_5 = new Plat();
        $plat6_5->setLibelle('Hamburger végétalien');
        $plat6_5->setDescription('Steak végétalien grillé servi avec des frites et une mayonnaise végétalienne.');
        $plat6_5->setPrix(13.99);
        $plat6_5->setImage('hamburgervegetalien.webp');
        $plat6_5->setActive(true);
        $categorie6->addPlat($plat6_5);

        // Soupes
        $plat7_1 = new Plat();
        $plat7_1->setLibelle('Soupe à l\'oignon');
        $plat7_1->setDescription('Soupe à l\'oignon gratinée.');
        $plat7_1->setPrix(7.99);
        $plat7_1->setImage('soupealoignon.webp');
        $plat7_1->setActive(true);
        $categorie7->addPlat($plat7_1);

        $plat7_2 = new Plat();
        $plat7_2->setLibelle('Soupe de poisson');
        $plat7_2->setDescription('Soupe de poisson avec des croûtons et du fromage râpé.');
        $plat7_2->setPrix(8.99);
        $plat7_2->setImage('soupedepoisson.webp');
        $plat7_2->setActive(true);
        $categorie7->addPlat($plat7_2);

        $plat7_3 = new Plat();
        $plat7_3->setLibelle('Soupe de légumes');
        $plat7_3->setDescription('Soupe de légumes avec des croûtons.');
        $plat7_3->setPrix(6.99);
        $plat7_3->setImage('soupedelegumes.webp');
        $plat7_3->setActive(true);
        $categorie7->addPlat($plat7_3);

        // Salades
        $plat8_1 = new Plat();
        $plat8_1->setLibelle('Salade César');
        $plat8_1->setDescription('Salade César avec poulet grillé, croûtons et parmesan.');
        $plat8_1->setPrix(9.99);
        $plat8_1->setImage('saladecesar.webp');
        $plat8_1->setActive(true);
        $categorie8->addPlat($plat8_1);

        $plat8_2 = new Plat();
        $plat8_2->setLibelle('Salade Niçoise');
        $plat8_2->setDescription('Salade Niçoise avec thon, oeufs durs, tomates et olives.');
        $plat8_2->setPrix(10.99);
        $plat8_2->setImage('saladenicoise.webp');
        $plat8_2->setActive(true);
        $categorie8->addPlat($plat8_2);

        $plat8_3 = new Plat();
        $plat8_3->setLibelle('Salade de chèvre chaud');
        $plat8_3->setDescription('Salade verte avec fromage de chèvre chaud et vinaigrette au miel.');
        $plat8_3->setPrix(12.99);
        $plat8_3->setImage('saladedechevrechaud.webp');
        $plat8_3->setActive(true);
        $categorie8->addPlat($plat8_3);

        $plat8_4 = new Plat();
        $plat8_4->setLibelle('Salade méditerranéenne');
        $plat8_4->setDescription('Salade fraîche avec concombres, tomates, poivrons, olives, oignons rouges et vinaigrette à l\'huile d\'olive.');
        $plat8_4->setPrix(10.99);
        $plat8_4->setImage('salademediterraneenne.webp');
        $plat8_4->setActive(true);
        $categorie8->addPlat($plat8_4);

        // Pâtes
        $plat9_1 = new Plat();
        $plat9_1->setLibelle('Spaghetti bolognaise');
        $plat9_1->setDescription('Spaghetti avec une sauce bolognaise maison.');
        $plat9_1->setPrix(11.99);
        $plat9_1->setImage('spaghettibolognaise.webp');
        $plat9_1->setActive(true);
        $categorie9->addPlat($plat9_1);

        $plat9_2 = new Plat();
        $plat9_2->setLibelle('Penne à la carbonara');
        $plat9_2->setDescription('Penne avec une sauce carbonara à la crème et au bacon.');
        $plat9_2->setPrix(12.99);
        $plat9_2->setImage('pennealacarbonara.webp');
        $plat9_2->setActive(true);
        $categorie9->addPlat($plat9_2);

        $plat9_3 = new Plat();
        $plat9_3->setLibelle('Lasagnes');
        $plat9_3->setDescription('Lasagnes maison avec de la viande hachée et de la béchamel.');
        $plat9_3->setPrix(13.99);
        $plat9_3->setImage('lasagnes.webp');
        $plat9_3->setActive(false);
        $categorie9->addPlat($plat9_3);

        $plat9_4 = new Plat();
        $plat9_4->setLibelle('Tagliatelles aux fruits de mer');
        $plat9_4->setDescription('Tagliatelles fraîches avec une sauce aux fruits de mer, agrémentées de calamars.');
        $plat9_4->setPrix(15.99);
        $plat9_4->setImage('tagliatellesfruitsdemer.webp');
        $plat9_4->setActive(true);
        $categorie9->addPlat($plat9_4);

        $plat9_5 = new Plat();
        $plat9_5->setLibelle('Gnocchis au pesto');
        $plat9_5->setDescription('Gnocchis de pomme de terre servis avec une sauce pesto maison et des pignons de pin.');
        $plat9_5->setPrix(14.49);
        $plat9_5->setImage('gnocchispesto.webp');
        $plat9_5->setActive(true);
        $categorie9->addPlat($plat9_5);

        $plat9_6 = new Plat();
        $plat9_6->setLibelle('Raviolis à la ricotta et épinards');
        $plat9_6->setDescription('Raviolis frais farcis à la ricotta et aux épinards, servis avec une sauce tomate maison.');
        $plat9_6->setPrix(16.99);
        $plat9_6->setImage('raviolisricottaepinards.webp');
        $plat9_6->setActive(true);
        $categorie9->addPlat($plat9_6);

        $plat9_7 = new Plat();
        $plat9_7->setLibelle('Linguine aux champignons sauvages');
        $plat9_7->setDescription('Linguine avec une sauce crémeuse aux champignons sauvages, parmesan et persil frais.');
        $plat9_7->setPrix(14.99);
        $plat9_7->setImage('linguinechampignonssauvages.webp');
        $plat9_7->setActive(true);
        $categorie9->addPlat($plat9_7);

        // Boissons
        $plat10_1 = new Plat();
        $plat10_1->setLibelle('Coca-Cola');
        $plat10_1->setDescription('Boisson gazeuse Coca-Cola.');
        $plat10_1->setPrix(3.99);
        $plat10_1->setImage('cocacola.webp');
        $plat10_1->setActive(true);
        $categorie10->addPlat($plat10_1);

        $plat10_2 = new Plat();
        $plat10_2->setLibelle('Jus d\'orange');
        $plat10_2->setDescription('Jus d\'orange pressé frais.');
        $plat10_2->setPrix(2.99);
        $plat10_2->setImage('jusdorange.webp');
        $plat10_2->setActive(true);
        $categorie10->addPlat($plat10_2);

        $plat10_3 = new Plat();
        $plat10_3->setLibelle('Eau minérale');
        $plat10_3->setDescription('Eau minérale plate ou gazeuse.');
        $plat10_3->setPrix(1.99);
        $plat10_3->setImage('eauminerale.webp');
        $plat10_3->setActive(true);
        $categorie10->addPlat($plat10_3);

        $plat10_4 = new Plat();
        $plat10_4->setLibelle('Thé glacé');
        $plat10_4->setDescription('Thé glacé à la menthe ou au citron.');
        $plat10_4->setPrix(2.49);
        $plat10_4->setImage('theglace.webp');
        $plat10_4->setActive(true);
        $categorie10->addPlat($plat10_4);

        $plat10_5 = new Plat();
        $plat10_5->setLibelle('Limonade');
        $plat10_5->setDescription('Limonade rafraîchissante au citron.');
        $plat10_5->setPrix(1.79);
        $plat10_5->setImage('limonade.webp');
        $plat10_5->setActive(true);
        $categorie10->addPlat($plat10_5);

        $plat10_6 = new Plat();
        $plat10_6->setLibelle('Smoothie');
        $plat10_6->setDescription('Smoothie aux fruits frais et onctueux.');
        $plat10_6->setPrix(3.29);
        $plat10_6->setImage('smoothie.webp');
        $plat10_6->setActive(true);
        $categorie10->addPlat($plat10_6);

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

        // Détails
        $detail1 = new Detail();
        $detail1->setQuantite(2);
        $detail1->setCommande($commande1);
        $detail1->setPlat($plat1_2);

        $detail2 = new Detail();
        $detail2->setQuantite(3);
        $detail2->setCommande($commande1);
        $detail2->setPlat($plat3_3);

        $detail3 = new Detail();
        $detail3->setQuantite(1);
        $detail3->setCommande($commande2);
        $detail3->setPlat($plat1_3);

        $detail4 = new Detail();
        $detail4->setQuantite(2);
        $detail4->setCommande($commande3);
        $detail4->setPlat($plat10_3);

        $detail5 = new Detail();
        $detail5->setQuantite(1);
        $detail5->setCommande($commande4);
        $detail5->setPlat($plat10_2);

        $detail6 = new Detail();
        $detail6->setQuantite(3);
        $detail6->setCommande($commande5);
        $detail6->setPlat($plat2_5);

        $detail7 = new Detail();
        $detail7->setQuantite(2);
        $detail7->setCommande($commande5);
        $detail7->setPlat($plat3_3);

        $detail8 = new Detail();
        $detail8->setQuantite(1);
        $detail8->setCommande($commande4);
        $detail8->setPlat($plat3_2);

        $detail9 = new Detail();
        $detail9->setQuantite(1);
        $detail9->setCommande($commande1);
        $detail9->setPlat($plat5_2);

        $detail10 = new Detail();
        $detail10->setQuantite(2);
        $detail10->setCommande($commande2);
        $detail10->setPlat($plat7_2);

        $detail11 = new Detail();
        $detail11->setQuantite(3);
        $detail11->setCommande($commande3);
        $detail11->setPlat($plat6_2);

        $detail12 = new Detail();
        $detail12->setQuantite(1);
        $detail12->setCommande($commande4);
        $detail12->setPlat($plat6_3);

        $detail13 = new Detail();
        $detail13->setQuantite(2);
        $detail13->setCommande($commande5);
        $detail13->setPlat($plat8_4);

        $detail14 = new Detail();
        $detail14->setQuantite(2);
        $detail14->setCommande($commande1);
        $detail14->setPlat($plat2_4);

        $detail15 = new Detail();
        $detail15->setQuantite(1);
        $detail15->setCommande($commande2);
        $detail15->setPlat($plat2_1);

        $detail16 = new Detail();
        $detail16->setQuantite(2);
        $detail16->setCommande($commande3);
        $detail16->setPlat($plat1_2);

        $detail17 = new Detail();
        $detail17->setQuantite(3);
        $detail17->setCommande($commande4);
        $detail17->setPlat($plat9_1);

        $detail18 = new Detail();
        $detail18->setQuantite(1);
        $detail18->setCommande($commande5);
        $detail18->setPlat($plat5_2);

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
        foreach ($categorie1->getPlats() as $unPlat) {
            $manager->persist($unPlat);
        }
        foreach ($categorie2->getPlats() as $unPlat) {
            $manager->persist($unPlat);
        }
        foreach ($categorie3->getPlats() as $unPlat) {
            $manager->persist($unPlat);
        }
        foreach ($categorie4->getPlats() as $unPlat) {
            $manager->persist($unPlat);
        }
        foreach ($categorie5->getPlats() as $unPlat) {
            $manager->persist($unPlat);
        }
        foreach ($categorie6->getPlats() as $unPlat) {
            $manager->persist($unPlat);
        }
        foreach ($categorie7->getPlats() as $unPlat) {
            $manager->persist($unPlat);
        }
        foreach ($categorie8->getPlats() as $unPlat) {
            $manager->persist($unPlat);
        }
        foreach ($categorie9->getPlats() as $unPlat) {
            $manager->persist($unPlat);
        }
        foreach ($categorie10->getPlats() as $unPlat) {
            $manager->persist($unPlat);
        }
        $manager->persist($commande1);
        $manager->persist($commande2);
        $manager->persist($commande3);
        $manager->persist($commande4);
        $manager->persist($commande5);
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
