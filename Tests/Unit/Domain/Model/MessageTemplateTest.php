<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Fabien Udriot <fabien.udriot@typo3.org>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

require_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('messenger') . 'Tests/Unit/BaseTest.php');

/**
 * Test case for class \TYPO3\CMS\Messenger\Domain\Model\MessageTemplate.
 */
class MessageTemplateTest extends Tx_Messenger_BaseTest {

	/**
	 * @var \TYPO3\CMS\Messenger\Domain\Model\MessageTemplate
	 */
	protected $fixture;

	public function setUp() {
		parent::setUp();
		$this->fixture = new \TYPO3\CMS\Messenger\Domain\Model\MessageTemplate();
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getSubjectReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setSubjectForStringSetsSubject() {
		$this->fixture->setSubject('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getSubject()
		);
	}

	/**
	 * @test
	 */
	public function getBodyReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setBodyForStringSetsBody() {
		$this->fixture->setBody('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getBody()
		);
	}

	/**
	 * @test
	 */
	public function getIdentifierReturnsInitialValueForString() {
	}

	/**
	 * @test
	 */
	public function setIdentifierForStringSetsIdentifier() {
		$this->fixture->setIdentifier('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getIdentifier()
		);
	}

	/**
	 * @test
	 * @expectedException \TYPO3\CMS\Messenger\Exception\RecordNotFoundException
	 */
	public function getLayoutContentReturnsExceptionIfLayoutIsNotSet() {
		$this->fixture->getLayoutContent();
	}

	/**
	 * @test
	 */
	public function getLayoutContentCanReturnContent() {
		$this->fixture->setLayout($this->layoutIdentifier);
		$actual = $this->fixture->getLayoutContent();
		$this->assertEquals($this->layoutContent, $actual);
	}

	/**
	 * @test
	 */
	public function getMarkerTemplateReturnsDefaultMarker() {
		$method = new ReflectionMethod(
			'TYPO3\CMS\Messenger\Domain\Model\MessageTemplate', 'getMarkerTemplate'
		);

		$method->setAccessible(TRUE);
		$this->assertEquals('{template}', $method->invoke($this->fixture));
	}

	/**
	 * @test
	 */
	public function getBodyIsWrappedIfLayoutIsSet() {
		$body = uniqid('I am singing in the rain!');
		$this->fixture->setBody($body);
		$this->fixture->setLayout($this->layoutIdentifier);
		$expected = str_replace('{template}', $body, $this->layoutContent);
		$this->assertEquals($expected, $this->fixture->getBody());
	}
}
?>