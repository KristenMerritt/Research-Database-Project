<?php

class Entry {

	private $EntryID;
	private $AccountID;
	private $ProjectID;
	private $Description;
	private $PostDate;
	private $DueDate;

	public function getEntryID(){
		return $this->EntryID;
	}

	public function getAccountID(){
		return $this->AccountID;
	}

	public function getProjectID(){
		return $this->ProjectID;
	}

	public function getDescription(){
		return $this->Description;
	}

	public function getPostDate(){
		return $this->PostDate;
	}

	public function getDueDate(){
		return $this->DueDate;
	}
}