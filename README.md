# Dojo : La censure !

## Objectifs

- Travailler avec les chaînes de caractères
- Créer une méthode de classe

## Consignes

Il est des mots que l'on ne doit pas dire...

Crée une méthode de classe nommée `censor` dans la classe Censor, qui prends en paramètre deux chaînes de caractères et qui en renvoie une troisième : la copie du premier paramètre où toutes les occurrences du second paramètre ont été remplacées par des caractères '*', à l'exception du premier caractère.

Le remplacement doit être insensible à la casse, mais la première lettre du mot censuré doit être identique à ce qu'elle était dans la phrase d'origine.

Exemples :

- Censor::censor("Voldemort is back","voldemort") 
  - => "V******** is back"

- Censor::censor("En variant le ton, – par exemple, tenez : Agressif : « Moi, monsieur, si j’avais un tel nez, il faudrait sur-le-champ que je me l’amputasse ! »","nez")
  - => "En variant le ton, – par exemple, ten** : Agressif : « Moi, monsieur, si j’avais un tel n**, il faudrait sur-le-champ que je me l’amputasse ! »"

## Test

Vous pouvez tester votre code avec la commande : `$ php vendor/bin/phpunit test`
