<?php
/**
 * Class BiereControleur
 * Controleur de la ressource Biere
 * 
 * @author Jonathan Martel
 * @version 1.1
 * @update 2019-11-11
 * @license MIT
 */

  
class BiereControlleur 
{
	private $retour = array('data'=>array());

	/**
	 * Méthode qui gère les action en GET
     * Route : /biere - Liste des bieres
     *       : /biere/id_biere - Détails d'une bière
     *       : /biere/id_biere/note - Les notes sur une bière
     *       : /biere/id_biere/commentaire - Les commentaires sur une bière
     * 
	 * @param Requete $requete
	 * @return Array Données retournées
     * 
	 */
	public function getAction(Requete $requete)
	{
		//var_dump($requete);
		
		if(isset($requete->url_elements[0]) && is_numeric($requete->url_elements[0]))	// Normalement l'id de la biere 
		{
			$id_biere = (int)$requete->url_elements[0];
			
			if(isset($requete->url_elements[1]))
			{
				switch($requete->url_elements[1])
				{
					case  "note":
						// Get note...
						break;
					case "commentaire":
						// get commentaire
						break;
					
					default:
						$this->retour['erreur'] = $this->erreur(400);

				}
			}
			else 	// route /biere/id_biere
			{
				$this->retour["data"] = $this->getBiere($id_biere);
			}

		} 
		else 
		{
			$this->retour["data"] = $this->getListeBiere();
			
		}

        return $this->retour;		
		
	}
	
	/**
	 * Méthode qui gère les action en POST
     * Route : /biere/id_biere - Modifier une bière
     * 
	 * @param Requete $requete
	 * @return Array Données retournées
	 */
	public function postAction(Requete $requete)	// Modification
	{
		if(!$this->valideAuthentification())
		{
			$this->retour['erreur'] = $this->erreur(401);
		}
		else
		{
			if(isset($requete->url_elements[0]) && is_numeric($requete->url_elements[0]))	// Normalement l'id de la biere 
			{
				$id_biere = (int)$requete->url_elements[0];
				
				$this->retour['data'] = $this->modifBiere($id_biere, $requete->parametres);
			}
		}
		return $this->retour;
	}
	
	/**
	 * Méthode qui gère les action en PUT
     * Route : /biere - Ajouter une bière
     *       : /biere/id_biere/note - Ajouter une note sur une bière
     *       : /biere/id_biere/commentaire - Ajouter un commentaire sur une bière
	 * @param Requete $requete
	 * @return Array Données retournées
	 */
	public function putAction(Requete $requete)		//ajout ou modification
	{
	
		if(!$this->valideAuthentification())
		{
			$this->retour['erreur'] = $this->erreur(401);
		}
		
		return $this->retour;
	}
	
	/**
	 * Méthode qui gère les action en DELETE
     * Route : /biere/id_biere - Effacer une bière
	 * @param Requete $oReq
	 * @return Array Données retournées
	 */
	public function deleteAction(Requete $requete)
	{
		
		if(!$this->valideAuthentification())
		{
			$this->retour['erreur'] = $this->erreur(401);
		}
		

		return $this->retour;
		
	}
	
	
	
	/**
	 * Retourne les informations de la bière $id_biere
	 * @param int $id_biere Identifiant de la bière
	 * @return Array Les informations de la bière
	 * @access private
	 */	
	private function getBiere($id_biere)
	{
		$res = Array();
		$oBiere = new Biere();
		$res = $oBiere->getBiere($id_biere);
		return $res; 
	}
	
	/**
	 * Retourne les informations des bières de la db	 
	 * @return Array Les informations sur toutes les bières
	 * @access private
	 */	
	private function getListeBiere()
	{
		$res = Array();
		$oBiere = new Biere();
		$res = $oBiere->getListe();
		
		return $res; 
	}
	
	/**
	 * Retourne les commentaires de la bière $id_biere
	 * @param int $id_biere Identifiant de la bière
	 * @return Array Les commentaires de la bière
	 * @access private
	 */	
	private function getCommentaire($id_biere)
	{
		$res = Array();
		
		
		return $res; 
	}

	/**
	 * Retourne la note moyenne et le nombre de note de la bière $id_biere
	 * @param int $id_biere Identifiant de la bière
	 * @return Array Informations sur la note de la bière : [nombre, note, id_biere]
	 * @access private
	 */	
	private function getNote($id_biere)
	{
		
		$res = Array();
		
		return $res; 
	}
	

	/**
	 * Modifie les informations de la bière $id_biere
	 * @param int $id_biere Identifiant de la bière
	 * @param Array $data Les informations de la bière
	 * @return int Identifiant de la bière modifiée (0 en cas d'erreur)
	 * @access private
	 */	
	private function modifBiere($id_biere, $data)
	{
		$res = Array();
		$oBiere = new Biere();
		$res = $oBiere->modifierBiere($id_biere, $data);
		return $res; 
	}
	
	/**
	 * Effacer la bière $id_biere
	 * @param int $id_biere Identifiant de la bière
	 * @return boolean Succès ou échec
	 * @access private
	 */	
	private function effacerBiere($id_biere)
	{
		$res = Array();
		
		return $res; 
	}

	/**
	 * Ajouter une bière 
	 * @param Array Les informations de la bière
	 * @return int Identifiant de la nouvelle bière
	 * @access private
	 */	
	private function ajouterUneBiere($data)
	{
		$res = Array();
		
		return $res; 
	}

	/**
	 * Ajouter une bière 
	 * @param int $id_biere Identifiant de la bière
	 * @param Array $data Les informations sur la note
	 * @return int Identifiant de la nouvelle note
	 * @access private
	 */	
	private function ajouterUneNote($id_biere, $data)
	{
		$res = Array();

		return $res; 
	}


	/**
	 * Ajouter une bière 
	 * @param int $id_biere Identifiant de la bière
	 * @param Array $data Les informations du commentaire
	 * @return int Identifiant du nouveau commentaire
	 * @access private
	 */	
	private function ajouterUnCommentaire($id_biere, $data)
	{
		$res = Array();

		return $res; 
	}


	/**
	 * Valide les données d'authentification du service web
	 * @return Boolean Si l'authentification est valide ou non
	 * @access private
	 */	
	private function valideAuthentification()
    {
      	$access = false;
		$headers = apache_request_headers();
		
		if(isset($headers['Authorization']) || isset($headers['authorization']))	//Fetch avec Chrome envoie authorization et non Authorization ! 
		{
			if(isset($_SERVER['PHP_AUTH_PW']) && isset($_SERVER['PHP_AUTH_USER']))
			{
				if($_SERVER['PHP_AUTH_PW'] == 'biero' && $_SERVER['PHP_AUTH_USER'] == 'biero')
				{
					$access = true;
				}
			}
		}
      	return $access;
    }

	
	private function erreur($code, $data="")
	{
		//header('HTTP/1.1 400 Bad Request');
		http_response_code($code);

		return array("message"=>"Erreur de requete", "code"=>$code);
		
	}

}
