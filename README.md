LEMPEREUR Mathieu (mathieu.lempereur@univ-brest.fr)
Développement en php, mysql et HTML d'une base de données pour la gestion des AQM (Analyse Quantifiée de la Marche)

1. Installation de WampServer/Lamp
1. Install WampServer/Lamp

2. Ajouter dans config.php login et password de phpmyadmin 
2. Modify config.php in order to add login and password of phpmyadmin

3. Modifier dans config.php le répertoire dans lequel les fichiers ont été téléchargés 
3. Modify in config.php the path where all the files were download

4. Télécharger aqm_chru.sql 
4. Download aqm_chru.sql

5. Importer aqm_chru.sql dans phpmyadmin (dossier AQM)
5. Import aqm_chru.sql using phpmyadmin (folder AQM)

6. localhost/AQM/login.php 
6. localhost/AQM/login.php 

7. login : admin ; password : admin pour être administrateur de la base de données 
7. login : admin ; password : admin to be the administrator of the database 

8. 4 utilisateurs (administrateur peut modifier et visualiser les données de tous les CHU, Manager peut modifier et visualiser les données de son CHU, Membre (médecin, chirurgien, ...) peut visualiser les données de son CHU, Passive Member ne peut visualiser les données mais besoin de son identité dans la prescription d'un acte médical).
8. 4 users (administrator can modify and modify the data from all the gait labs, Manager can modify and view data the data of its gait lab, Membre (physiatrist, surgeon, ...) can view the data from its gait lab, Passive Member can not view the data but need its identity in the prescription of a medical act).

9. Menu Admin -> Hopitaux pour ajouter un ou plusieurs CHU

10. Menu Admin -> Utilisateurs pour ajouter un ou plusieurs utilisateurs



11. Pathologie des enfants __________ Non renseigné
							|_______ Sain
							|_______ Autre
							|_______ Hémiplégie
										|_______ Gauche / Droit
										|_______ Non renseigné / type 1 / 2a / 2b / 3 / 4
										|_______ Non renseigné / Autres / Paralysie Cérébrale
										|_______ Non renseigné / Autres / Prématurité / AVC / Tumeur / Traumatisme cranien
							|_______ Diplégie
										|_______ Non renseigné / Autres / Paralysie Cérébrale
										|_______ Non renseigné / Autres / Prématurité / AVC / Tumeur / Traumatisme cranien
							|_______ Triplégie
							|_______ Tétraplégie
							|_______ Myogènes
										|_______ Non renseigné / Duchenne / Steinert / Becker / Charcot Marie Tooth / Autre
							|_______ Orthopédie
										|_______ Gauche / Droit / Bilatéral
										
12. Pathologie des adultes __________ Non renseigné
							|_______ Sain
							|_______ Autre
							|_______ Hémiplégie
										|_______ Gauche / Droit
										|_______ Non renseigné / Autre / Ischémique / Traumatique/ Tumorale / IMC / Congénitale / SEP / Vasculaire										
							|_______ Paraplégie
										|_______ Non renseigné / Autre / SEP / Traumatique/ Tumorale / Congénitale / Diplégie / Vasculaire
							|_______ Ataxie
										|_______ Gauche / Droit / Bilatéral
										|_______ Non renseigné / Sensitive / Mixte / Cérébelleuse										
							|_______ Atteinte
										|_______ Gauche / Droit / Bilatéral
										|_______ Non renseigné / Acquise / Congénitale									
							|_______ Myogènes
										|_______ Non renseigné / Duchenne / Steinert / Becker / Charcot Marie Tooth / Autre
							|_______ Orthopédie
										|_______ Gauche / Droit / Bilatéral
							
							
							
							
							


