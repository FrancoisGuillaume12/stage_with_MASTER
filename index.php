
<?php

use LDAP\Result;

require_once 'vendor/autoload.php';

$faker = Faker\Factory::create('fr_FR');


$db = new PDO('mysql:host=localhost;dbname=annuaire_de_maitre;charset=utf8mb4','root','');

$tablo = ['css','html','js','php','java','lua'];

foreach($tablo as $value){
    $reqSpe = "INSERT INTO `specialiter` (specialiter) values (:specialiter)";
    $stats4 = $db->prepare($reqSpe);
    $stats4->execute([':specialiter'=>$value]);
}



for($m=0;$m<rand(2,7);$m++){
    $user = $faker->name();
    $req1 = "INSERT INTO `user` (nom) VALUES (:nom)";
    $stats = $db->prepare($req1);
    $stats->execute([':nom' => $user]);

    $rocket = "SELECT `IDuser` FROM `user` WHERE nom = :nom ";
    $statss = $db->prepare($rocket);
    $statss->execute([':nom' => $user]);

    $result = $statss->fetch(PDO::FETCH_ASSOC);





    for($i=0;$i<=10;$i++){

        $firstName = $faker->firstName();
        $lastName = $faker->lastName();
        $adress = $faker->region();

        $req =  "INSERT INTO `annuaire` (`IDuser`, `nom`, `prenom`, `adresse`) VALUES (:IDuser,:nom,:prenom, :adresse)";
        $stat = $db->prepare($req);
        $stat->execute(['IDuser'=>$result['IDuser'],':nom' =>$lastName ,':prenom'=>$firstName, ':adresse'=>$adress]);

        $rocket1= "SELECT `IDannuaire` FROM `annuaire` WHERE nom = :nom ";
        $statsss = $db->prepare($rocket1);
        $statsss->execute([':nom'=>$lastName]);

        $result1 = $statsss->fetch(PDO::FETCH_ASSOC);

        $nombre = rand(1,3);
        
        for($e=0;$e<=$nombre;$e++){

            $phone = $faker->phoneNumber();

            $req2 = "INSERT INTO `numero_de_telephone` (`IDannuaire`,`numero_de_telephone`) VALUES (:IDannuaire,:numero_de_telephone)";
            $stats1 = $db->prepare($req2);
            $stats1->execute([':IDannuaire' => $result1['IDannuaire'],':numero_de_telephone'=>$phone]);
        }

        $nombre1 = rand(1,5);
        
        for($s=0;$s<=$nombre1;$s++){

            $email = $faker->email();

            $req2 = "INSERT INTO `email` (`IDannuaire`,`email`) VALUES (:IDannuaire,:email)";
            $stats1 = $db->prepare($req2);
            $stats1->execute([':IDannuaire' => $result1['IDannuaire'],':email'=>$email]);
        }
        
        $nombreRand = rand(1,2);

        for($j=0;$j<$nombreRand;$j++){
            $speRand = rand(1,6);
            $rocketSpe = "INSERT INTO `annuaire/specialiter` (`IDspecialiter`,`IDannuaire`) VALUES (:IDspecialiter, :IDannuaire)";
            $stats5 = $db->prepare($rocketSpe);
            $stats5->execute([':IDspecialiter'=>$speRand,':IDannuaire'=>$result1['IDannuaire']]);
        }
        
            
    }
}



?>