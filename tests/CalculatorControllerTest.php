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

        // Submit form with valid data
        $crawler = $client->request('GET', '/calculator');
        $form = $crawler->selectButton('Calculate')->form([
            'a' => 10,
            'b' => 25,
            'operation' => 'add',
        ]);

        $client->submit($form);

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h3', 'Result: 35');
    }
}