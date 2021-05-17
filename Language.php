<?php

namespace Kaiser;

class Language
{
   // Si le mot sasie existe dans le dictionnaire fr. > cette phrase est en fr.
   // Sinon le mot ou la phrase saisie a une origine inconnue

   // Ouvrir la liste des mots fr
   // Comparer la phrase sasie pour trouver une correspondance dans le dictionnaire
   // Compter le nombre de mots qui paraissent dans le dictionnaire pour définir la langue
   // Compter le nombre de mots que l'on ne connait pas

   private $lang = [
      "fr." => [],
      "en." => []
   ];

   private $result = [
      "francais"         => [],
      "anglais"          => [],
      "inconnu"          => [],
      "defined_language" => null
   ];

   public function __construct() {
      $this->setDictionary([
         'fr.' => 'ressources/french.json',
         'en.' => 'ressources/english.json'
      ]);
   }

   /**
    * @param Array $words 
    * @return Array
    */
   public function defineLanguage($words)
   {
      $this->countWords($words);

      if(
         count($this->result['francais']) + count($this->result['anglais']) > count($this->result['inconnu'])
      ) {
         if(count($this->result['francais']) > count($this->result['anglais'])) {
            $this->result['defined_language'] = 'francais';
         };
   
         if(count($this->result['francais']) < count($this->result['anglais'])) {
            $this->result['defined_language'] = 'anglais';
         }
   
         if(count($this->result['francais']) == count($this->result['anglais'])) {
            $this->result['defined_language'] = 'mixed';
         }
      } else {
         $this->result['defined_language'] = 'inconnu';
      }

      return $this->result;
   }

   /**
    * @param Array $path
    */
   private function setDictionary($path)
   {
      foreach ($path as $key => $value) {
         $file = file_get_contents($path[$key]);
         $this->lang[$key]= json_decode($file, true);
      }
   }

   /**
    * @param Array $words
    */
   private function countWords($words)
   {
      foreach ($words as $key => $value) {
         if (in_array($value, $this->lang['fr.'])) {
            array_push($this->result['francais'], $value);

         } else if(in_array($value, $this->lang['en.'])) { 
            array_push($this->result['anglais'], $value);

         } else {
            array_push($this->result['inconnu'], $value);
         }
      }
   }
}
