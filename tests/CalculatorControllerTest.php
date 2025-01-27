<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CalculatorControllerTest extends WebTestCase
{
    public function testCalculatorPageLoads(): void
    {
        $client = static::createClient();

        $client->request('GET', '/calculator');

        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', 'Calculator');
    }

    public function testCalculatorFormSubmission(): void
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/calculator');
        $form = $crawler->selectButton('Calculate')->form([
            'calculator[a]' => 10,
            'calculator[b]' => 5,
            'calculator[operation]' => 'add',
        ]);
    
        $client->submit($form);
        $client->followRedirect();
    
        $this->assertSelectorTextContains('h3', 'Result: 15');
    }
}