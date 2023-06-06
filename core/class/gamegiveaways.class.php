<?php
/* This file is part of Jeedom.
*
* Jeedom is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* Jeedom is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
*/

/* * ***************************Includes********************************* */
require_once __DIR__  . '/../../../../core/php/core.inc.php';

class gamegiveaways extends eqLogic {
  /*     * *************************Attributs****************************** */
  public function getGame() {
	  log::add(__CLASS__,"debug", "Start getGame");
	  
	  if (!empty($this->getConfiguration('platforms1'))) {
       $platforms = "?platforms=" . $this->getCmd('platforms1');
      }else{
		  $platforms = "";
		  log::add(__CLASS__,"debug", "Aucune platforme séléctionner");
	   }
      if (!empty($this->getConfiguration('type1'))) {
        $type = "?type=" . $this->getCmd('type1');
      }else{
		  $type = "";
		  log::add(__CLASS__,"debug", "Aucun type séléctionner");
	   }
      if (!empty($this->getConfiguration('sort-by1'))) {
        $sort_by = "?sort-by=" . $this->getCmd('sort-by1');
      }else{
		  $sort_by="";
		  log::add(__CLASS__,"debug", "Aucun type de trie séléctionner");
	   }
	  /*$platforms = $this->getConfiguration('platforms1');
	  $type = $this->getConfiguration('type1');
	  $sort_by = $this->getConfiguration('sort-by1');*/
	  
	  //lien de l'API
	  $api_url = "https://www.gamerpower.com/api/giveaways$platforms$type$sort_by" ;
	  log::add(__CLASS__,"debug", "Search $api_url");
	  $response = file_get_contents($api_url);
	  $data = json_decode($response, true);
	  if ($data === null) {
		  // Échec du décodage JSON
          log::add(__CLASS__, "debug", "Échec du décodage JSON");
		  return;
      }
	  if (!empty($data)) {
		  $game = $data[0];  // Récupère le premier jeu de la liste
		  $titre = $game['title'];
		  $id = $game['id'];
		  $prix = $game['worth'];
	      $description = $game['description'];
		  $type = $game['type'];
		  $plateforme = $game['platforms'];
		  $date_de_publication = $game['published_date'];
		  $date_de_fin = $game['end_date'];
		  $lien_du_deal = $game['open_giveaway_url'];
		  $lien_image = $game['thumbnail'];

		  // On met les valeurs dans les logs
		  $log_message = "Titre: " . $titre . "\n";
		  $log_message .= "ID: " . $id . "\n";
		  $log_message .= "Prix: " . $prix . "\n";
		  $log_message .= "Description: " . $description . "\n";
		  $log_message .= "Type: " . $type . "\n";
		  $log_message .= "Plateforme: " . $plateforme . "\n";
		  $log_message .= "Date de publication: " . $date_de_publication . "\n";
	      $log_message .= "Date de fin: " . $date_de_fin . "\n";
		  $log_message .= "Lien du deal: " . $lien_du_deal . "\n";
		  $log_message .= "Lien de l'image: " . $lien_image . "\n";

          log::add(__CLASS__, "debug", $log_message);

		  log::add(__CLASS__,"debug", "Update des commandes en cours ...");
		  $this->checkAndUpdateCmd('title', $titre);
		  $this->checkAndUpdateCmd('id', $id);
		  $this->checkAndUpdateCmd('worth', $prix);
		  $this->checkAndUpdateCmd('description', $description);
		  $this->checkAndUpdateCmd('type', $type);
		  $this->checkAndUpdateCmd('platforms', $plateforme);
		  $this->checkAndUpdateCmd('published_date', $date_de_publication);
		  $this->checkAndUpdateCmd('end_date', $date_de_fin);
		  $this->checkAndUpdateCmd('url_deal', $lien_du_deal);
		  $this->checkAndUpdateCmd('url_image', $lien_image);
		  log::add(__CLASS__,"debug", "Update des commandes réussi !");
		  log::add(__CLASS__,"debug", "Fin de getGame()");
	    }
    }
  /*
  * Permet de définir les possibilités de personnalisation du widget (en cas d'utilisation de la fonction 'toHtml' par exemple)
  * Tableau multidimensionnel - exemple: array('custom' => true, 'custom::layout' => false)
  public static $_widgetPossibility = array();
  */

  /*
  * Permet de crypter/décrypter automatiquement des champs de configuration du plugin
  * Exemple : "param1" & "param2" seront cryptés mais pas "param3"
  public static $_encryptConfigKey = array('param1', 'param2');
  */

  /*     * ***********************Methode static*************************** */

  /*
  * Fonction exécutée automatiquement toutes les minutes par Jeedom
  public static function cron() {}
  */

  /*
  * Fonction exécutée automatiquement toutes les 5 minutes par Jeedom
  public static function cron5() {}
  */

  /*
  * Fonction exécutée automatiquement toutes les 10 minutes par Jeedom
  public static function cron10() {}
  */

  /*
  * Fonction exécutée automatiquement toutes les 15 minutes par Jeedom
  public static function cron15() {}
  */

  /*
  * Fonction exécutée automatiquement toutes les 30 minutes par Jeedom
  public static function cron30() {}
  */

  /*
  * Fonction exécutée automatiquement toutes les heures par Jeedom
  public static function cronHourly() {}
  */

  /*
  * Fonction exécutée automatiquement tous les jours par Jeedom
  public static function cronDaily() {}
  */

  /*     * *********************Méthodes d'instance************************* */

  // Fonction exécutée automatiquement avant la création de l'équipement
  public function preInsert() {
  }

  // Fonction exécutée automatiquement après la création de l'équipement
  public function postInsert() {
  }

  // Fonction exécutée automatiquement avant la mise à jour de l'équipement
  public function preUpdate() {
  }

  // Fonction exécutée automatiquement après la mise à jour de l'équipement
  public function postUpdate() {
  }

  // Fonction exécutée automatiquement avant la sauvegarde (création ou mise à jour) de l'équipement
  public function preSave() {
  }

  // Fonction exécutée automatiquement après la sauvegarde (création ou mise à jour) de l'équipement
  public function postSave() {
	  $refresh = $this->getCmd(null, 'refresh');
	  if (!is_object($refresh)) {
		  $refresh = new gamegiveawaysCmd();
		  $refresh->setName(__('Rafraichir', __FILE__));
	  }
	  $refresh->setEqLogic_id($this->getId());
	  $refresh->setLogicalId('refresh');
	  $refresh->setType('action');
	  $refresh->setSubType('other');
	  $refresh->save();
	  
	  $title = $this->getCmd(null, 'title');
	  if (!is_object($title)) {
		  $title = new gamegiveawaysCmd();
		  $title->setName(__('Titre', __FILE__));
	  }
	  $title->setEqLogic_id($this->getId());
	  $title->setLogicalId('title');
	  $title->setType('info');
	  $title->setSubType('string');
	  $title->save();
	  
	  $id = $this->getCmd(null, 'id');
	  if (!is_object($id)) {
		  $id = new gamegiveawaysCmd();
		  $id->setName(__('Id', __FILE__));
	  }
	  $id->setEqLogic_id($this->getId());
	  $id->setLogicalId('id');
	  $id->setType('info');
	  $id->setSubType('string');
	  $id->save();
	  
	  $worth = $this->getCmd(null, 'worth');
	  if (!is_object($worth)) {
		  $worth = new gamegiveawaysCmd();
		  $worth->setName(__('Prix', __FILE__));
	  }
	  $worth->setEqLogic_id($this->getId());
	  $worth->setLogicalId('worth');
	  $worth->setType('info');
	  $worth->setSubType('string');
	  $worth->save();
	  
	  $description = $this->getCmd(null, 'description');
	  if (!is_object($description)) {
		  $description = new gamegiveawaysCmd();
		  $description->setName(__('Description', __FILE__));
	  }
	  $description->setEqLogic_id($this->getId());
	  $description->setLogicalId('description');
	  $description->setType('info');
	  $description->setSubType('string');
	  $description->save();
	  
	  $type = $this->getCmd(null, 'type');
	  if (!is_object($type)) {
		  $type = new gamegiveawaysCmd();
		  $type->setName(__('Type', __FILE__));
	  }
	  $type->setEqLogic_id($this->getId());
	  $type->setLogicalId('type');
	  $type->setType('info');
	  $type->setSubType('string');
	  $type->save();
	  
	  $platforms = $this->getCmd(null, 'platforms');
	  if (!is_object($platforms)) {
		  $platforms = new gamegiveawaysCmd();
		  $platforms->setName(__('Plateforme', __FILE__));
	  }
	  $platforms->setEqLogic_id($this->getId());
	  $platforms->setLogicalId('platforms');
	  $platforms->setType('info');
	  $platforms->setSubType('string');
	  $platforms->save();
	  
	  $published_date = $this->getCmd(null, 'published_date');
	  if (!is_object($published_date)) {
		  $published_date = new gamegiveawaysCmd();
		  $published_date->setName(__('Date de publication', __FILE__));
	  }
	  $published_date->setEqLogic_id($this->getId());
	  $published_date->setLogicalId('published_date');
	  $published_date->setType('info');
	  $published_date->setSubType('string');
	  $published_date->save();
	  
	  $end_date = $this->getCmd(null, 'end_date');
	  if (!is_object($end_date)) {
		  $end_date = new gamegiveawaysCmd();
		  $end_date->setName(__('Date de fin', __FILE__));
	  }
	  $end_date->setEqLogic_id($this->getId());
	  $end_date->setLogicalId('end_date');
	  $end_date->setType('info');
	  $end_date->setSubType('string');
	  $end_date->save();
	  
	  $url_deal = $this->getCmd(null, 'url_deal');
	  if (!is_object($url_deal)) {
		  $url_deal = new gamegiveawaysCmd();
		  $url_deal->setName(__('URL du jeu', __FILE__));
	  }
	  $url_deal->setEqLogic_id($this->getId());
	  $url_deal->setLogicalId('url_deal');
	  $url_deal->setType('info');
	  $url_deal->setSubType('string');
	  $url_deal->save();
	  
	  $url_image = $this->getCmd(null, 'url_image');
	  if (!is_object($url_image)) {
		  $url_image = new gamegiveawaysCmd();
		  $url_image->setName(__('Date de fin', __FILE__));
	  }
	  $url_image->setEqLogic_id($this->getId());
	  $url_image->setLogicalId('url_image');
	  $url_image->setType('info');
	  $url_image->setSubType('string');
	  $url_image->save();
	  
	  
    }

  // Fonction exécutée automatiquement avant la suppression de l'équipement
  public function preRemove() {
  }

  // Fonction exécutée automatiquement après la suppression de l'équipement
  public function postRemove() {
  }

  /*
  * Permet de crypter/décrypter automatiquement des champs de configuration des équipements
  * Exemple avec le champ "Mot de passe" (password)
  public function decrypt() {
    $this->setConfiguration('password', utils::decrypt($this->getConfiguration('password')));
  }
  public function encrypt() {
    $this->setConfiguration('password', utils::encrypt($this->getConfiguration('password')));
  }
  */

  /*
  * Permet de modifier l'affichage du widget (également utilisable par les commandes)
  public function toHtml($_version = 'dashboard') {}
  */

  /*
  * Permet de déclencher une action avant modification d'une variable de configuration du plugin
  * Exemple avec la variable "param3"
  public static function preConfig_param3( $value ) {
    // do some checks or modify on $value
    return $value;
  }
  */

  /*
  * Permet de déclencher une action après modification d'une variable de configuration du plugin
  * Exemple avec la variable "param3"
  public static function postConfig_param3($value) {
    // no return value
  }
  */

  /*     * **********************Getteur Setteur*************************** */

}

class gamegiveawaysCmd extends cmd {
  /*     * *************************Attributs****************************** */

  /*
  public static $_widgetPossibility = array();
  */

  /*     * ***********************Methode static*************************** */


  /*     * *********************Methode d'instance************************* */

  /*
  * Permet d'empêcher la suppression des commandes même si elles ne sont pas dans la nouvelle configuration de l'équipement envoyé en JS
  public function dontRemoveCmd() {
    return true;
  }
  */

  // Exécution d'une commande
  public function execute($_options = array()) {
	$eqlogic = $this->getEqLogic(); //récupère l'éqlogic de la commande $this
	  switch ($this->getLogicalId()) { //vérifie le logicalid de la commande
	    case 'refresh': // LogicalId de la commande rafraîchir que l’on a créé dans la méthode Postsave de la classe.
		log::add(__CLASS__,"debug", "Bouton Refresh");
		$eqlogic->getGame(); // Récupère les données de l'API
      }
    }

  /*     * **********************Getteur Setteur*************************** */

}
