<?php

$DataBase = mysqli_connect("localhost", "root", "root", "bdprojet");


$DataBase->set_charset("utf8") ;

if (isset($_POST['id'])) {
	$IdProjet = $_POST['id'];	
}


if (isset($_POST['Date_de_debut'])) 
{
	$Date_de_debut = $_POST['Date_de_debut'];
	if ($_POST['Date_de_debut'] != '')
	{
		$RsqlUPDATE_tprojet = "UPDATE tprojet SET `Date_de_debut`='$Date_de_debut',Statut_projet ='En cours' where IdProjet = $IdProjet ";

  		$Resultat = mysqli_query ( $DataBase, $RsqlUPDATE_tprojet )  or  die(mysqli_error($DataBase) ) ;
	}
	else 
	{
		$RsqlUPDATE_tprojet = "UPDATE tprojet SET `Date_de_debut`='$Date_de_debut' where IdProjet = $IdProjet ";

  		$Resultat = mysqli_query ( $DataBase, $RsqlUPDATE_tprojet )  or  die(mysqli_error($DataBase) ) ;
	}
}

if (isset($_POST['Date_de_fin'])) {
	$Date_de_fin = $_POST['Date_de_fin'];
		if ($_POST['Date_de_fin'] != '')
	{
		$RsqlUPDATE_tprojet = "UPDATE tprojet SET `Date_de_fin`='$Date_de_fin',Statut_projet ='Cloturé' where IdProjet = $IdProjet ";

  		$Resultat = mysqli_query ( $DataBase, $RsqlUPDATE_tprojet )  or  die(mysqli_error($DataBase) ) ;
	}
	else 
	{
		$RsqlUPDATE_tprojet = "UPDATE tprojet SET `Date_de_fin`='$Date_de_fin', Statut_projet='En cours' where IdProjet = $IdProjet ";

  		$Resultat = mysqli_query ( $DataBase, $RsqlUPDATE_tprojet )  or  die(mysqli_error($DataBase) ) ;
	}
}

if ($_POST['Date_de_debut'] == '' && $_POST['Date_de_debut'] == '') {

	$RsqlUPDATE_tprojet = "UPDATE tprojet SET Statut_projet ='Initié' where IdProjet = $IdProjet ";

  	$Resultat = mysqli_query ( $DataBase, $RsqlUPDATE_tprojet )  or  die(mysqli_error($DataBase) ) ;
}

if (isset($_POST['Description_Projet'])) {
	$Description_Projet = $_POST['Description_Projet'];


	$RsqlUPDATE_tprojet_Programme = "UPDATE tprojet SET `Description_Projet`='$Description_Projet'  where IdProjet = $IdProjet ";
	$Resultat = mysqli_query ( $DataBase, $RsqlUPDATE_tprojet_Programme )  or  die(mysqli_error($DataBase) ) ;
	  
	

}

if (isset($_POST['P'])) {
	if ($_POST['P'] != '') {
	$Programme = $_POST['P'];
	$RsqlUPDATE_tprojet_Programme = "UPDATE tprojet SET `Programme_de_travail`='$Programme'  where IdProjet = $IdProjet ";
  	$Resultat = mysqli_query ( $DataBase, $RsqlUPDATE_tprojet_Programme )  or  die(mysqli_error($DataBase) ) ;
}
}

if (isset($_POST['L'])) {
	if ($_POST['L'] != '') {
	$Leader = $_POST['L'];
	$RsqlUPDATE_tprojet_Leader = "UPDATE tprojet SET Leader = '$Leader'  where IdProjet = $IdProjet ";
  	$Resultat = mysqli_query ( $DataBase, $RsqlUPDATE_tprojet_Leader )  or  die(mysqli_error($DataBase) ) ;
}
}

if (isset($_POST['Nom_Leader']))  {
	if ($_POST['Nom_Leader'] != '') {
		$Nom_Leader = $_POST['Nom_Leader'];
		if ($_POST['L'] == 'Oui') {
		$RsqlDELETE_tprojet_Nom_Leader = "UPDATE tprojet SET Nom_Leader = ''  where IdProjet = $IdProjet ";
  		$Resultat = mysqli_query ( $DataBase, $RsqlDELETE_tprojet_Nom_Leader )  or  die(mysqli_error($DataBase) ) ;	
  	}
  	else
  	{
  	$RsqlUPDATE_tprojet_Nom_Leader = "UPDATE tprojet SET Nom_Leader = '$Nom_Leader'  where IdProjet = $IdProjet ";
  	$Resultat = mysqli_query ( $DataBase, $RsqlUPDATE_tprojet_Nom_Leader )  or  die(mysqli_error($DataBase) ) ;	
  	}
  	}
}


if (isset($_POST['Budget_demande'])) 
{
	if ($_POST['Budget_demande'] != '') 
	{
		$Budget_demande = $_POST['Budget_demande'];

		$RsqlUPDATE_tprojet_budget = "UPDATE tprojet SET `Budget_demande`='$Budget_demande' where IdProjet = $IdProjet ";
		$Resultat = mysqli_query ( $DataBase, $RsqlUPDATE_tprojet_budget )  or  die(mysqli_error($DataBase) ) ;

		if (isset($_POST['budget_recu'])) 
		{
			if ($_POST['budget_recu'] != '') 
			{
				
				$Budget_recu = $_POST['budget_recu'];
				$RsqlUPDATE_tprojet_budget = "UPDATE tprojet SET  `budget_recu`='$Budget_recu' where IdProjet = $IdProjet ";
				$Resultat = mysqli_query ( $DataBase, $RsqlUPDATE_tprojet_budget )  or  die(mysqli_error($DataBase) ) ;
		
			}
		}
	}
}



if (isset($_POST['NumConvention_interne'])) {
	$NumConvention_interne = $_POST['NumConvention_interne'];

$RsqlUPDATE_StatuDossier = "UPDATE tprojet SET NumConvention_interne = '$NumConvention_interne' where IdProjet = $IdProjet ";

 $Resultat = mysqli_query ( $DataBase, $RsqlUPDATE_StatuDossier )  or  die(mysqli_error($DataBase) ) ;
}

if (isset($_POST['NumConvention_externe'])) {
	$NumConvention_externe = $_POST['NumConvention_externe'];

$RsqlUPDATE_StatuDossier = "UPDATE tprojet SET NumConvention_externe = '$NumConvention_externe' where IdProjet = $IdProjet ";

 $Resultat = mysqli_query ( $DataBase, $RsqlUPDATE_StatuDossier )  or  die(mysqli_error($DataBase) ) ;
}


if (isset($_POST['Statut_D']))
{
	foreach($_POST['Statut_D'] as $statut ) 
	{
	$RsqlD = "UPDATE tprojet SET Statut_dossier = 'Non retenu' where IdProjet = $IdProjet ";

 	$Resultat = mysqli_query ( $DataBase, $RsqlD )  or  die(mysqli_error($DataBase) ) ;
	}
}


if (isset($_POST['date_vie_projet']) && !empty($_POST['date_vie_projet']))
{
	$date_vie_projet = $_POST['date_vie_projet'];
	if (isset($_POST['description_date_projet']) && !empty($_POST['description_date_projet']))
	{
		
		$description_date_projet = $_POST['description_date_projet'];

		if (isset($_POST['date_de_soumission'])  )
		{
			
			$date_de_soumission = $_POST['date_de_soumission'];
			
			$Rsql = "INSERT INTO tVie_projet (RefProjet,Date_vie_Projet,Description_Date_Projet,Date_de_soumission)
							VALUES ($IdProjet,'$date_vie_projet','$description_date_projet','$date_de_soumission');";
			$Resultat = mysqli_query ( $DataBase, $Rsql )  or  die(mysqli_error($DataBase) ) ;
		} 
	}
}

if (isset($_POST['date_reponse'],$_POST['acceptation_projet'])  && !empty($_POST['date_reponse']) && !empty($_POST['acceptation_projet']))
		{
			
				$date_vie = $_POST['date_vie'];
				$date_reponse = $_POST['date_reponse'];
				$description_date = $_POST['description_date'];
				$date_soumission = $_POST['date_soumission'];
				$acceptation_projet = $_POST['acceptation_projet'];
				$IdVieProjet = $_POST['IdVieProjet'];

				$Rsql = "UPDATE tVie_Projet SET Date_vie_Projet = '$date_vie', Description_Date_Projet = '$description_date', Date_de_soumission = '$date_soumission', Date_de_reponse = '$date_reponse', Acceptation ='$acceptation_projet' WHERE IdVieProjet = $IdVieProjet ";
			$Resultat = mysqli_query ( $DataBase, $Rsql )  or  die(mysqli_error($DataBase) ) ;

			if ($_POST['acceptation_projet'] == 'Accepté') {
				
				
						$acceptation = $_POST['acceptation_projet'];
						$RsqlUPDATE_tprojet_budget = "UPDATE tprojet SET Statut_dossier = 'Retenu' where IdProjet = $IdProjet ";
						$Resultat = mysqli_query ( $DataBase, $RsqlUPDATE_tprojet_budget )  or  die(mysqli_error($DataBase) ) ;
				
			} else {
				$RsqlUPDATE_tprojet_budget = "UPDATE tprojet SET Statut_dossier = 'En attente' where IdProjet = $IdProjet ";
				$Resultat = mysqli_query ( $DataBase, $RsqlUPDATE_tprojet_budget )  or  die(mysqli_error($DataBase) ) ;
			}
		}




if (isset($_POST['Personne'] )   ) {
	foreach($_POST['Personne'] as $element)
    {
        $donnees = explode("|", $element);
        $IdPersonnel = $donnees[0]; 
        $NomP = $donnees[1];
        $PrenomP = $donnees[2];
        $EmailP = $donnees[3];


       $Requete = "INSERT INTO tpersonne (NomP,PrenomP,EmailP,RefProjet,RefUser)
       VALUES ('$NomP','$PrenomP','$EmailP',$IdProjet,$IdPersonnel)";

     $Resultat = mysqli_query ( $DataBase, $Requete )  or  die(mysqli_error($DataBase) ) ; 
    }
}

if (isset($_POST['Chef'] ) && !empty($_POST['Chef'])    ) {


	foreach($_POST['Chef'] as $element1)
    {
        $donnees1 = explode("|", $element1);
        $IdPersonnel = $donnees1[0]; 
        $NomC = $donnees1[1];
		$PrenomC = $donnees1[2];


       $Requete = "UPDATE tprojet SET NomPorteur = '$NomC',PrenomPorteur = '$PrenomC', RefUser = '$IdPersonnel' WHERE IdProjet = $IdProjet ";

       $Resultat = mysqli_query ( $DataBase, $Requete )  or  die(mysqli_error($DataBase) ) ; 
	}
}


if (isset($_POST['F'])) {
foreach ($_POST['F'] as $key => $value)
 {
 	$value1 = $_POST['F'];
 }

$Financement = implode (" / "  ,$value1);

if(!empty($Financement)) {
 $RsqlF = "UPDATE tprojet SET source_financement ='$Financement' Where IdProjet = $IdProjet";
 $Resultat = mysqli_query ( $DataBase, $RsqlF )  or  die(mysqli_error($DataBase) ) ; 

 if (isset($_POST['Nom_Financement'])){
 	$Nom_Financement = $_POST['Nom_Financement'];

 	$RsqlNF = "UPDATE tprojet SET Nom_Financement = '$Nom_Financement' WHERE IdProjet = $IdProjet";
	 $Resultat = mysqli_query ( $DataBase, $RsqlNF )  or  die(mysqli_error($DataBase) ) ; 
	}
 } 
} else {

$RsqlF = "UPDATE tprojet SET source_financement = NULL Where IdProjet = $IdProjet";
$Resultat = mysqli_query ( $DataBase, $RsqlF )  or  die(mysqli_error($DataBase) ) ; 

$RsqlNF = "UPDATE tprojet SET Nom_Financement = NULL WHERE IdProjet = $IdProjet";
$Resultat = mysqli_query ( $DataBase, $RsqlNF )  or  die(mysqli_error($DataBase) ) ; 
}


if (isset($_POST['Nom_externe']))
{
	if (isset($_POST['Prenom_externe']))
	{
		if (isset($_POST['Organisme']))
		{
			if (isset($_POST['EmailExt']))
			{
				if (isset($_POST['Telephone_externe']))
				{
					if (isset($_POST['Statut']))
					{
						if (isset($_POST['Date_de_debut_externe']))
						{
							if (isset($_POST['Date_de_fin_externe']))
							{
								if($_POST['Nom_externe'] != '') 
								{
									if($_POST['Prenom_externe'] != '') 
									{
										if($_POST['Organisme'] != '') 
										{
											if($_POST['EmailExt'] != '') 
											{
												if($_POST['Telephone_externe'] != '') 
												{
													if($_POST['Statut'] != '') 
													{
														if($_POST['Date_de_debut_externe'] != '') 
														{
															if($_POST['Date_de_fin_externe'] != '') 
															{

																$Nom_externe = $_POST['Nom_externe'];
																$Prenom_externe = $_POST['Prenom_externe'];
																$Organisme = $_POST['Organisme'];
																$EmailExt = $_POST['EmailExt'];
																$Telephone_externe = $_POST['Telephone_externe'];
																$Statut = $_POST['Statut'];
																$Date_de_debut_externe = $_POST['Date_de_debut_externe'];
																$Date_de_fin_externe = $_POST['Date_de_fin_externe'];
															

																$Rsqlmembre_externe = "INSERT INTO  tpersonne_externe (NomExt,PrenomExt,Organisme,EmailExt,Telephone,Statut,Date_de_debut_externe,Date_de_fin_externe,RefProjet)
																VALUES ('$Nom_externe','$Prenom_externe','$Organisme','$EmailExt','$Telephone_externe','$Statut','$Date_de_debut_externe','$Date_de_fin_externe',$IdProjet)";

																$Resultat = mysqli_query ( $DataBase, $Rsqlmembre_externe )  or  die(mysqli_error($DataBase) ) ;
															}
														}
													}
												}
											}
										}
									}	
								}
							}
						}
					}
				}
			}
		}
	}
}


if (isset($_POST['Nom_recruter']))
{
	if (isset($_POST['Prenom_recruter']))
	{
		if (isset($_POST['Email_recruter']))
		{
			if (isset($_POST['Categorie']))
			{
				if (isset($_POST['Date_de_debut_recruter']))
				{
					if (isset($_POST['Date_de_fin_recruter']))
					{	
						if($_POST['Nom_recruter'] != '') 
						{
							if($_POST['Prenom_recruter'] != '') 
							{
								if($_POST['Email_recruter'] != '') 
								{
									if($_POST['Categorie'] != '') 
									{
										if($_POST['Date_de_debut_recruter'] != '') 
										{
											if($_POST['Date_de_fin_recruter'] != '') 
											{
													
												$Nom_recruter = $_POST['Nom_recruter'];
												$Prenom_recruter = $_POST['Prenom_recruter'];
												$Email_recruter = $_POST['Email_recruter'];
												$Categorie = $_POST['Categorie'];
												$Date_de_debut_recruter = $_POST['Date_de_debut_recruter'];
												$Date_de_fin_recruter = $_POST['Date_de_fin_recruter'];
											

												$Rsqlmembre_recruter = "INSERT INTO  tpersonne_recruter (Nom_recruter,Prenom_recruter,Email_recruter,Categorie,Date_de_debut_recruter,Date_de_fin_recruter,RefProjet)
												VALUES ('$Nom_recruter','$Prenom_recruter','$Email_recruter','$Categorie','$Date_de_debut_recruter','$Date_de_fin_recruter',$IdProjet)";

												$Resultat = mysqli_query ( $DataBase, $Rsqlmembre_recruter )  or  die(mysqli_error($DataBase) ) ;
											}
										}
									}
								}
							}	
						}
					}
				}
			}
		}
	}
}


if (isset($_POST['Description_Document']) && !empty($_POST['Description_Document'])) {

	if(isset($_POST['Acronyme'])) {
	$Acronyme = $_POST['Acronyme'];
	define ('SITE_ROOT', realpath(dirname(__FILE__)));
	
	$filename = SITE_ROOT.'/../../files/'.$Acronyme.'';

	if (!file_exists($filename)) {
		mkdir(SITE_ROOT."/../../files/".$Acronyme."", 0700);
	} 	

}

	$Description_Document = $_POST['Description_Document'];

			$file_name = $_FILES['fichier']['name'];

			$file_tmp_name = $_FILES['fichier']['tmp_name'];

			$file_dest = '/Application/files/'.$Acronyme.'/'.$file_name;

			echo realpath("fichier");

			if(move_uploaded_file($file_tmp_name,SITE_ROOT.'/../../files/'.$Acronyme.'/'.$file_name)) {
				$Rsql = "INSERT INTO tdescription_projet (Description_Document,RefProjet,Url_Fichier,Nom_Fichier)
				VALUES ('$Description_Document',$IdProjet,'$file_dest','$file_name')";
				$Resultat = mysqli_query ( $DataBase, $Rsql )  or  die(mysqli_error($DataBase) ) ;
		}else {
			echo "echec de l'upload";
		}
}



mysqli_close ( $DataBase ) ;
header('Location:../display_form.php?id='.$IdProjet);
exit();
?>
