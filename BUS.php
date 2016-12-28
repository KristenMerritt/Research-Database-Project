<?php
//session_start();
/*
 * Sends account information to DB be created
 * @param $db
 * @param $firstName
 * @param $lastName
 * @param $email
 * @param $password
 * @param $accountType
 */
function createAccount($db, $firstName, $lastName, $email, $password, $accountType){
  $db->createAccount($firstName, $lastName, $email, $password, $accountType);
}

/*
 * Sends project information to DB be created
 * @param $db
 * @param $projectName
 * @param $projectAbstract
 * @param $accountID
 */
function createProject($db, $projectName, $projectAbstract, $accountID){
    $db->createProject($projectName, $projectAbstract, $accountID);
}

/*
 * Sends project information to DB be edited
 * @param $db
 * @param $projectID
 * @param $projectName
 * @param $projectAbstract
 */
function editProject($db, $projectID, $projectName, $projectAbstract){
    $db->updateProject($projectID, $projectName, $projectAbstract);
}

/*
 * Requests project object from DB, returns the project's name
 * @param $db
 * @param $id
 * @return $name
 */
function getProjectName($db, $id){
    $projects = $db->getProject($id);

    foreach($projects as $proj){
        $name = $proj->getProjectName();
    }

    return $name;
}

/*
 * Requests the project object from DB, returns the project's abstract
 * @param $db
 * @param $id
 * @return $abstract
 */
function getProjectAbstract($db, $id){
    $projects = $db->getProject($id);

    foreach($projects as $proj){
        $abstract = $proj->getAbstract();
    }

    return $abstract;
}

/*
 * Sends entry info to DB to create the entry
 * @param $db
 * @param $projectID
 * @param $accountID
 * @param $entryContent
 * @param $dueDate
 */
function createEntry($db, $projectID, $accountID, $entryContent, $dueDate){
    $db->createEntry($projectID, $accountID, $entryContent, $dueDate);
}

/*
 * Sends entry info to DB to edit the entry
 * @param $db
 * @param $entryID
 * @param $entryContent
 * @param $dueDate
 */
function editEntry($db, $entryID, $entryContent, $dueDate){
    $db->editEntry($entryID, $entryContent, $dueDate);
}

/*
 * Requests entry object from DB, returns the description
 * @param $db
 * @param $id
 * @return $desc
 */
function getEntryDescription($db, $id){
    $entries = $db->getEntry($id);

    foreach($entries as $entry){
        $desc = $entry->getDescription();
    }

    return $desc;
}

/*
 * Requests entry from DB, returns the due date
 * @param $db
 * @param $id
 * @return $duedate
 */
function getEntryDueDate($db, $id){
    $entries = $db->getEntry($id);

    foreach($entries as $entry){
        $duedate = $entry->getDueDate();
    }

    return $duedate;
}

/*
 * Requests all accounts from DB, echos out HTML for All Professors page
 * @param $db
 */
function professorPage($db){
    $professors = $db->getAllAccounts();

    foreach($professors as $prof){
        $id = $prof->getAccountID();
        $name = $prof->getFirstName() . " " . $prof->getLastName();
        $email = $prof->getEmail();

        echo "<a class=\"noColor\" href=\"profileLookup.php?id={$id}\"><div class=\"row entry\">
            <div class=\"col-xs-12 col-sm-12 col-md-1 col-lg-1\">
            </div>
            <div class=\"col-xs-12 col-sm-12 col-md-9 col-lg-9\">
                <h2> {$name} </h2>
            </div>
            <div class=\"col-xs-12 col-sm-12 col-md-2 col-lg-2\">
                <h5 class=\"author\">{$email}</h5>
            </div>
        </div></a>";
    }
}

/*
 * Requests all projects from DB, echos out HTML for All Projects page
 * @param $db
 */
function projectPage($db){
    $projects = $db->getAllProjects();

    foreach($projects as $proj){
        $projID = $proj->getProjectID();
        $name = $proj->getProjectName();
        $accountID = $proj->getAccountID();
        $accountNameArray = $db->getAccountName($accountID);
        $firstName = $accountNameArray[0][0];
        $lastName = $accountNameArray[0][1];
        $abstract = $proj->getAbstract();
        $postDate = $proj->getPostDate();

        echo "<a class=\"noColor\" href=\"project.php?id={$projID}\"><div class=\"row entry\">
            <div class=\"col-xs-12 col-sm-12 col-md-1 col-lg-1\">
            </div>
            <div class=\"col-xs-12 col-sm-12 col-md-9 col-lg-9\">
                <h2> {$name} </h2>
                <p>
                {$abstract}
                </p>
            </div>
            <div class=\"col-xs-12 col-sm-12 col-md-2 col-lg-2\">
                <h5 class=\"author\">{$firstName} {$lastName}</h5>
            </div>
        </div></a>";
    }
}

/*
 * Requests project search results from DB, echos out HTML for search page
 * @param $db
 * @param $likeString
 * @param &orderBy
 */
function searchProjects($db, $likeString, $orderBy){
	$projects = $db->searchProjectResults($likeString, $orderBy);

	if(sizeOf($projects) > 0){
		foreach($projects as $proj){
			$projID = $proj->getProjectID();
			$name = $proj->getProjectName();
			$accountID = $proj->getAccountID();
			$accountNameArray = $db->getAccountName($accountID);
			$firstName = $accountNameArray[0][0];
			$lastName = $accountNameArray[0][1];
			$abstract = $proj->getAbstract();
			$postDate = $proj->getPostDate();

			echo "<a class=\"noColor\" href=\"project.php?id={$projID}\"><div class=\"row entry\">
				<div class=\"col-xs-12 col-sm-12 col-md-1 col-lg-1\">

				</div>
				<div class=\"col-xs-12 col-sm-12 col-md-10 col-lg-10\">
					<h2> {$name} </h2>
					<p>
					{$abstract}
					</p>
				</div>
				<div class=\"col-xs-12 col-sm-12 col-md-1 col-lg-1\">
					<h5 class=\"author\">{$firstName} {$lastName}</h5>
				</div>
			</div></a>";
		}
	} else {
		echo "<p> No Results found searching $likeString </p>";
	}

}

/*
 * Requests account search results from DB, echos out HTML for search page
 * @param $db
 * @param $likeString
 */
function searchAccounts($db, $likeString){
    $professors = $db->searchAccountResults($likeString);

	if(sizeOf($professors) > 0){
		foreach($professors as $prof){
			$id = $prof->getAccountID();
			$name = $prof->getFirstName() . " " . $prof->getLastName();
			$email = $prof->getEmail();

			echo "<a class=\"noColor\" href=\"profileLookup.php?id={$id}\"><div class=\"row entry\">
				<div class=\"col-xs-12 col-sm-12 col-md-1 col-lg-1\">
				</div>
				<div class=\"col-xs-12 col-sm-12 col-md-9 col-lg-9\">
					<h2> {$name} </h2>
				</div>
				<div class=\"col-xs-12 col-sm-12 col-md-2 col-lg-2\">
					<h5 class=\"author\">{$email}</h5>
				</div>
			</div></a>";
		}
	} else {
		echo "<p> No Results found searching $likeString </p>";
	}

}

/*
 * Requests account information from DB, echos out Profile page html
 * @param $db
 * @param $accountID
 */
function getUserProfile($db, $accountID){
    $name = $db->getAccountName($accountID);
    $first = $name[0][0];
    $last = $name[0][1];
    $email = $name[0][2];

    echo "<br>
        <br>
        <div id=\"profileHeaderBox\">
            <h1 class=\"projectName\">{$first} {$last}</h1>
            <h2 class=\"projectName\"> {$email}</h2>";

     if($_SESSION["loginID"] == $email || $_SESSION['loginID'] == "admin"){
        echo "<a href=\"createProject.php\"><button>Add Project</button></a>";
     }

    echo "<br>
          <br>
        </div>
        <br>
        <hr/>
        <br>
        <h1 style=\"text-align: center;\"> Projects and Research </h1>
        <br>";

    $projects = $db->getAccountProjects($accountID);

    foreach($projects as $proj){
        $projID = $proj->getProjectID();
        $name = $proj->getProjectName();
        $abstract = $proj->getAbstract();
        $postDate = $proj->getPostDate();

        echo "<a class=\"noColor\" href=\"project.php?id={$projID}\"><div class=\"row entry\">
            <div class=\"col-xs-12 col-sm-12 col-md-1 col-lg-1\">
            </div>
            <div class=\"col-xs-12 col-sm-12 col-md-10 col-lg-10\">
                <h2> {$name} </h2>
                <p>
                {$abstract}
                </p>
            </div>
        </div></a>";
    }
}

/*
 * Requests project information from DB, echos out HTML for project page
 * @param $db
 * @param $projectID
 */
function getProjectProfile($db, $projectID){
    $projectInfo = $db->getProject($projectID);
    $id = $projectInfo[0]->getProjectID();
    $projectName = $projectInfo[0]->getProjectName();
    $projectCreatorID = $projectInfo[0]->getAccountID();
    $check = $db->getAccountIdFromProject($_GET['id']);
    $accountID = $check[0][0];
    $projectAbstract = $projectInfo[0]->getAbstract();
    $projectPostDate = $projectInfo[0]->getPostDate();
    $projectCreatorName = $db->getAccountName($projectCreatorID);
    $projectCreatorFirst = $projectCreatorName[0][0];
    $projectCreatorLast = $projectCreatorName[0][1];
   // echo $accountID;
    //echo $_SESSION['accountID'];
    echo "<br>
          <br>
          <h1>#{$id} ~ {$projectName}</h1>";
    if($accountID == $_SESSION['accountID'] || $_SESSION['loginID'] == "admin"){
        echo "<a href=\"editProject.php?id={$id}\"> <button> Edit Project </button> </a>
              <a href=\"createEntry.php?projID={$id}\"> <button> Add Entry </button> </a>
              <a href=\"deleteProject.php?projID={$id}\"> <button> Delete Project </button> </a>";
    }

    echo "<br>
        <h2> Project Creator</h2>
            <div class=\"row entry\">
                <div class=\"col-md-10\">
                    <h3> {$projectCreatorFirst} {$projectCreatorLast}</h3>
                </div>
            </div>
        <br>
        <h2> Abstract</h2>
            <div class=\"row entry\">
                <div class=\"col-md-10\">
                    <h4>{$projectAbstract}</h4>
                </div>
            </div>
        <br>
        <h2> Post Date</h2>
            <div class=\"row entry\">
                <div class=\"col-md-10\">
                    <h3>{$projectPostDate}</h3>
                </div>
            </div>
        <br>
        <h2> Entries </h2>";

    $entries = $db->getProjectEntries($projectID);

    foreach($entries as $entry){
        $entryID = $entry->getEntryID();
        $entryDesc = $entry->getDescription();
        $entryPostDate = $entry->getPostDate();
        $entryDueDate = $entry->getDueDate();

        echo "<a class=\"noColor\" href=\"entry.php?id={$entryID}\"><div class=\"row entry\">
                <div class=\"col-xs-12 col-sm-12 col-md-1 col-lg-1\">
                </div>
                <div class=\"col-xs-12 col-sm-12 col-md-10 col-lg-10\">
                    <h2> {$entryPostDate} </h2>
                    <h3> {$entryDesc} </h3>
                </div>
                <div class=\"col-xs-12 col-sm-12 col-md-1 col-lg-1\">
                    <h5 class=\"author\">{$entryDueDate}</h5>
                </div>
            </div></a>";

    }

}

/*
 * Requests entry information from DB, echos out HTML for entry page
 * @param $db
 * @param $entryID
 */
function getEntryProfile($db, $entryID){
    $entryInfo = $db->getEntry($entryID);
    $id = $entryInfo[0]->getEntryID();
    $entryAccountID = $entryInfo[0]->getAccountID();
    $entryProjectID = $entryInfo[0]->getProjectID();
    $entryDescription = $entryInfo[0]->getDescription();
    $entryPostDate = $entryInfo[0]->getPostDate();
    $entryDueDate = $entryInfo[0]->getDueDate();

    $entryCreatorName = $db->getAccountName($entryAccountID);
    $entryCreatorFirst = $entryCreatorName[0][0];
    $entryCreatorLast = $entryCreatorName[0][1];

    echo "<br>
        <br>
        <a href=\"editEntry.php?id={$id}\"> <button> Edit Entry </button> </a>
        <a href=\"deleteProject.php?entryID={$id}\"> <button> Delete Entry </button> </a>
        <br>
        <h2> Entry Creator</h2>
            <div class=\"row entry\">
                <div class=\"col-md-10\">
                    <h3> {$entryCreatorFirst} {$entryCreatorLast}</h3>
                </div>
            </div>
        <br>
        <h2> Description</h2>
            <div class=\"row entry\">
                <div class=\"col-md-10\">
                    <h4>{$entryDescription}</h4>
                </div>
            </div>
        <br>
        <h2> Post Date</h2>
            <div class=\"row entry\">
                <div class=\"col-md-10\">
                    <h3>{$entryPostDate}</h3>
                </div>
            </div>
        <br>

        <h2> Due Date</h2>
            <div class=\"row entry\">
                <div class=\"col-md-10\">
                    <h3>{$entryDueDate}</h3>
                </div>
            </div>
        <br>";
}






// ===============================================================================================
// ================================== HEADER, FOOTER, NAV, ETC ===================================
// ===============================================================================================
function getHeader(){
	echo "<head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <meta name=\"description\" content=\"Final Project for ISTE 330 - Database Connectivity and Access\">
    <meta name=\"author\" content=\"Dustin Spitz, Kristen Merritt\">
    <link rel=\"icon\" href=\"../../favicon.ico\">

    <title>RIT Research Database</title>

    <!-- Bootstrap core CSS -->
    <link href=\"css/bootstrap.min.css\" rel=\"stylesheet\">
    <!-- Bootstrap theme -->
    <link href=\"css/bootstrap-theme.min.css\" rel=\"stylesheet\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"font-awesome-4.6.3/css/font-awesome.min.css\">
    <!-- Custom styles for this template -->
    <link rel=\"stylesheet\" href=\"css/style.css\">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src=\"https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js\"></script>
      <script src=\"https://oss.maxcdn.com/respond/1.4.2/respond.min.js\"></script>
    <![endif]-->
</head>";
session_start();
}

function getNavBar(){
	echo "
        <div class=\"container\">
            <h1 class=\"openHeader bigHeader\">RIT Faculty Research Database</h1>
            <hr/>
            <nav>
                <ul>
                    <li><a href=\"index.php\">Home</a></li>
                    <li><a href=\"profile.php\">Profile</a></li>
                    <li><a href=\"professors.php\">All Professors</a></li>
                    <li><a href=\"projects.php\">All Projects</a></li>
                    <li><a href=\"login.php\">Login/Logout</a></li>
                </ul>
            </nav> <br/>";
}

function getSearchBar(){
	echo "
		<div class=\"row entry\">
			<div class=\"search col-xs-12 col-sm-12 col-md-12 col-lg-12\">
				<form action=\"searchResults.php\" method=\"post\">
					<input type=\"text\" id=\"searchBox\" name=\"searchBox\" placeholder=\"Search..\">
					<button type=\"submit\" formmethod=\"post\" formaction=\"searchResults.php\" id=\"searchBtn\" name=\"searchBtn\" value=\"searchBtn\"><i class=\"fa fa-search\" aria-hidden=\"true\"></i></button>
					<br/>
					<label class=\"dropdownLabel\" for=\"projectSort\">Sort by</label>
					<select id=\"projectSort\" name=\"choice\">
						<option value=\"ProjectName\">By Name</option>
						<option value=\"FirstName\">By Professor (FirstName) </option>
						<option value=\"LastName\">By Professor (LastName)</option>
						<option value=\"PostDate\">By Date</option>
					</select>

				</form>
			</div>
		</div>";
}

function importScripts(){
	echo "<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js\"></script>
<script>window.jQuery || document.write('<script src=\"js/vendor/jquery.min.js\"><\/script>')</script>
<script src=\"js/bootstrap.min.js\"></script>
<script src=\"js/nav.js\"></script>";

}
