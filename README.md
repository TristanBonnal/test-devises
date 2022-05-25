# Calcul de devises

## Démarche

J'ai commencé par réaliser le front avec des valeurs en dur dans le html, j'ai utilisé du CSS basique avec un peu de responsive pour le format mobile. J'ai ensuite séparé mon code en deux parties, la logique principale est réalisée en début de script, les valeurs sont calculées grâce un fichier dédié aux fonctions. J'ai ensuite remplacé les valeurs en dur par les valeurs dynamiques calculées puis stockées dans les variables. 

En ce qui concerne la logique du calcul, de ce que j'ai compris de l'énoncé, si l'utilisateur entre 2 montants en dollars, l'addition se fait en dollars, sinon si l'utilisateur choisit une des deux valeurs en euros, le résultat sera en euros avec les éventuelles valeurs en dollars converties en euros aussi.

Pour le formulaire, j'ai choisi la méthode GET, étant donné que la sécurité des données renseignées n'est pas primordiale dans ce cas, et le résultat peut ainsi être facilement partagé via l'url. Lorsque le formulaire est envoyé, les valeurs sont sauvegardées dans les champs pour plus de lisibilité.

## Améliorations
Avec un délai de 10h, j'aurais commencé par ajouter un second champs "devises" pour chaque montant rentré, ainsi nous aurions la devise désirée en entrée, et la devise désirée en sortie, le but étant de pouvoir afficher indépendamment chaque conversion pour chaque montant.
De même pour le résultat, nous pourrions décider en quelle devise se fait l'addition.
La plupart de ces fonctionnalités pourraient facilement être implémentées dans le code que j'ai commencé, en ajoutant des paramètres à la fonction "calculate".

Pour rajouter plusieurs devises, il suffirait de rajouter des options à l'input select, et d'intégrer dans la fonction calculate un petit tableau de conversion plutot que de toujours utiliser le taux 0.9. Pour les taux, nous pourrions d'ailleurs dans le futur les récupérer grâce à une API externe avec des données mises à jour en temps réel. Techniquement, nous pourrions utiliser pour cela la bibliothèque curl en php. 
Nous pourrions aussi repenser l'UI avec du javascript et de l'ajax pour faire tout cela sans rafraichissement de page.

Si le client souhaitait avoir un récap de ses calculs par mail, nous pourrions stocker son historique dans une session php (une bdd n'est pas nécessaire, nous ne souhaitons pas la persistance des données à long terme), nous pourrions enregistrer la conversion a chaque fois que le formulaire est envoyé, en sauvegardant un identifiant qui s'incrémente et la date/heure précise de la conversion. Un formulaire permettrait de récupérer le mail de l'utilisateur, et l'envoi des données se ferait à la demande. Une fois l'historique envoyé, nous pourrions détruire la session pour repartir de 0 éventuellement.