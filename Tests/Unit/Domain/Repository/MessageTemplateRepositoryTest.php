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
 *  the Free Software Foundation; either version 3 of the License, or
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
 * Test case for class \TYPO3\CMS\Messenger\Domain\Repository\MessageTemplateRepository.
 */
class MessageTemplateRepositoryTest extends Tx_Messenger_BaseTest {

	/**
	 * @var \TYPO3\CMS\Messenger\Domain\Repository\MessageTemplateRepository
	 */
	private $fixture;


	public function setUp() {
		parent::setUp();
		$this->fixture = new \TYPO3\CMS\Messenger\Domain\Repository\MessageTemplateRepository();
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->fixture);
		TYPO3\CMS\Messenger\Utility\Context::getInstance()->setLanguage(0);
	}

	/**
	 * @test
	 */
	public function findByIdentifierReturnsTemplateObject() {
		$templateObject = $this->fixture->findByIdentifier($this->identifier);
		$this->assertEquals('TYPO3\CMS\Messenger\Domain\Model\MessageTemplate', get_class($templateObject));
	}

	/**
	 * @test
	 */
	public function canFindByIdentifier() {
		$GLOBALS['TSFE']->sys_language_content = 0;
		$templateObject = $this->fixture->findByIdentifier($this->identifier);
		$this->assertEquals($this->subject, $templateObject->getSubject());
	}

	/**
	 * @test
	 */
	public function canFindByIdentifierForSysLanguageEqualsOne() {
		// Fix me: does not make sense to run the test if library overlays is not loaded.
		if (class_exists('tx_overlays')) {
			TYPO3\CMS\Messenger\Utility\Context::getInstance()->setLanguage(1);
			$templateObject = $this->fixture->findByIdentifier($this->identifier);
			$this->assertEquals($this->subjectTranslated, $templateObject->getSubject());
		}
	}
}
?>