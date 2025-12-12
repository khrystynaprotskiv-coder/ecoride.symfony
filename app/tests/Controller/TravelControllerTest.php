<?php

namespace App\Tests\Controller;

use App\Entity\Travel;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class TravelControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $travelRepository;
    private string $path = '/travel/crud/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->travelRepository = $this->manager->getRepository(Travel::class);

        foreach ($this->travelRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Travel index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first()->text());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'travel[dateDepart]' => 'Testing',
            'travel[dateArrive]' => 'Testing',
            'travel[timeDepart]' => 'Testing',
            'travel[timeArrive]' => 'Testing',
            'travel[placeDepart]' => 'Testing',
            'travel[placeArrive]' => 'Testing',
            'travel[statu]' => 'Testing',
            'travel[nbPlaces]' => 'Testing',
            'travel[price]' => 'Testing',
            'travel[car]' => 'Testing',
            'travel[user]' => 'Testing',
            'travel[y]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->travelRepository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Travel();
        $fixture->setDateDepart('My Title');
        $fixture->setDateArrive('My Title');
        $fixture->setTimeDepart('My Title');
        $fixture->setTimeArrive('My Title');
        $fixture->setPlaceDepart('My Title');
        $fixture->setPlaceArrive('My Title');
        $fixture->setStatu('My Title');
        $fixture->setNbPlaces('My Title');
        $fixture->setPrice('My Title');
        $fixture->setCar('My Title');
        $fixture->setUser('My Title');
        $fixture->setY('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Travel');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Travel();
        $fixture->setDateDepart('Value');
        $fixture->setDateArrive('Value');
        $fixture->setTimeDepart('Value');
        $fixture->setTimeArrive('Value');
        $fixture->setPlaceDepart('Value');
        $fixture->setPlaceArrive('Value');
        $fixture->setStatu('Value');
        $fixture->setNbPlaces('Value');
        $fixture->setPrice('Value');
        $fixture->setCar('Value');
        $fixture->setUser('Value');
        $fixture->setY('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'travel[dateDepart]' => 'Something New',
            'travel[dateArrive]' => 'Something New',
            'travel[timeDepart]' => 'Something New',
            'travel[timeArrive]' => 'Something New',
            'travel[placeDepart]' => 'Something New',
            'travel[placeArrive]' => 'Something New',
            'travel[statu]' => 'Something New',
            'travel[nbPlaces]' => 'Something New',
            'travel[price]' => 'Something New',
            'travel[car]' => 'Something New',
            'travel[user]' => 'Something New',
            'travel[y]' => 'Something New',
        ]);

        self::assertResponseRedirects('/travel/crud/');

        $fixture = $this->travelRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getDateDepart());
        self::assertSame('Something New', $fixture[0]->getDateArrive());
        self::assertSame('Something New', $fixture[0]->getTimeDepart());
        self::assertSame('Something New', $fixture[0]->getTimeArrive());
        self::assertSame('Something New', $fixture[0]->getPlaceDepart());
        self::assertSame('Something New', $fixture[0]->getPlaceArrive());
        self::assertSame('Something New', $fixture[0]->getStatu());
        self::assertSame('Something New', $fixture[0]->getNbPlaces());
        self::assertSame('Something New', $fixture[0]->getPrice());
        self::assertSame('Something New', $fixture[0]->getCar());
        self::assertSame('Something New', $fixture[0]->getUser());
        self::assertSame('Something New', $fixture[0]->getY());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Travel();
        $fixture->setDateDepart('Value');
        $fixture->setDateArrive('Value');
        $fixture->setTimeDepart('Value');
        $fixture->setTimeArrive('Value');
        $fixture->setPlaceDepart('Value');
        $fixture->setPlaceArrive('Value');
        $fixture->setStatu('Value');
        $fixture->setNbPlaces('Value');
        $fixture->setPrice('Value');
        $fixture->setCar('Value');
        $fixture->setUser('Value');
        $fixture->setY('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/travel/crud/');
        self::assertSame(0, $this->travelRepository->count([]));
    }
}
