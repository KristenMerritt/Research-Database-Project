<?php

class Project {

	private $ProjectID;
	private $ProjectName;
	private $AccountID;
	private $Abstract;
	private $Keyword;
	private $PostDate;

	public function getProjectID(){
		return $this->ProjectID;
	}

	public function getProjectName(){
		return $this->ProjectName;
	}

	public function getAccountID(){
		return $this->AccountID;
	}

	public function getAbstract(){
		return $this->Abstract;
	}

	public function getKeyword(){
		return $this->Keyword;
	}

	public function getPostDate(){
		return $this->PostDate;
	}
}