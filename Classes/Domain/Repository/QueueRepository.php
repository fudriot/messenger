<?php
namespace TYPO3\CMS\Messenger\Domain\Repository;
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
use TYPO3\CMS\Vidi\Tca\TcaService;

/**
 * A repository for the Queue.
 */
class QueueRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * @var string
	 */
	protected $tableName = 'tx_messenger_domain_model_queue';

	/**
	 * @param array $message
	 * @throws \Exception
	 * @return int
	 */
	public function add($message){

		$values = array();
		$values['tstamp'] = $values['crdate'] = time(); // default values

		// Make sure fields are allowed for this table.
		$fields = TcaService::table($this->tableName)->getFields();
		foreach ($message as $fieldName => $value) {
			if (in_array($fieldName, $fields)) {
				$values[$fieldName] = $value;
			}
		}

		$result = $this->getDatabaseConnection()->exec_INSERTquery($this->tableName, $values);
		if (!$result) {
			throw new \Exception('I could not queue the message.', 1389721932);
		}
		exit();
		return $this->getDatabaseConnection()->sql_insert_id();
	}

	/**
	 * Returns a pointer to the database.
	 *
	 * @return \TYPO3\CMS\Core\Database\DatabaseConnection
	 */
	protected function getDatabaseConnection() {
		return $GLOBALS['TYPO3_DB'];
	}
}
?>