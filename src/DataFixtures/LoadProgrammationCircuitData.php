<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\ProgrammationCircuit;
use App\Entity\Circuit;

class LoadProgrammationCircuitData extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $circuit=$this->getReference('andalousie-circuit');
        $programmationCircuit = new ProgrammationCircuit();
        $programmationCircuit->setDateDepart(\DateTime::createFromFormat('Y-m-d', "2018-09-09"));
        $programmationCircuit->setNombrePersonnes(1);
        $programmationCircuit->setPrix(1);
        $programmationCircuit->setCircuit($circuit);
        $manager->persist($programmationCircuit);
        
       // $this->addReference('andalousie-pro-circuit', $programmationCircuit);
        $circuit=$this->getReference('vietnam-circuit');
        $programmationCircuit = new ProgrammationCircuit();
        $programmationCircuit->setDateDepart(\DateTime::createFromFormat('Y-m-d', "2018-09-09"));
        $programmationCircuit->setNombrePersonnes(2);
        $programmationCircuit->setPrix(2);
        $programmationCircuit->setCircuit($circuit);
        $manager->persist($programmationCircuit);
        
       // $this->addReference('vietnam-pro-circuit', $programmationCircuit);
        $circuit=$this->getReference('idf-circuit');
        $programmationCircuit = new ProgrammationCircuit();
        $programmationCircuit->setDateDepart(\DateTime::createFromFormat('Y-m-d', "2018-09-09"));
        $programmationCircuit->setNombrePersonnes(2);
        $programmationCircuit->setPrix(2);
        $programmationCircuit->setCircuit($circuit);
        $manager->persist($programmationCircuit);
        
       // $this->addReference('idf-pro-circuit', $programmationCircuit);
        $circuit=$this->getReference('italie-circuit');
        $programmationCircuit = new ProgrammationCircuit();
        $programmationCircuit->setDateDepart(\DateTime::createFromFormat('Y-m-d', "2018-09-09"));
        $programmationCircuit->setNombrePersonnes(3);
        $programmationCircuit->setPrix(3);
        $programmationCircuit->setCircuit($circuit);
        $manager->persist($programmationCircuit);
        
       // $this->addReference('italie-pro-circuit', $programmationCircuit);
        
        $manager->flush();
    }
    
}
// (1, 'Andalousie', 'Espagne', 'Grenade', 'Séville', 4),
// (2, 'VietNam', 'VietNam', 'Hanoi', 'Hô Chi Minh', 4),
// (3, 'Ile de France', 'France', 'Paris', 'Paris', 2),
// (4, 'Italie', 'Italie', 'Milan', 'Rome', 4);