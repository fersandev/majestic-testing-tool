<?php
/*
	This abstract class has the resposability of verify storage files
*/

abstract class StorageVerificator {
	// Verufy if the persistence way exist
	abstract protected function verifyPersistenceExistence();
}
?>