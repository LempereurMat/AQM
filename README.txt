1. Installation de WampServer/Lamp
1. Install WampServer/Lamp

2. Ajouter dans config.php login et password de phpmyadmin 
2. Modify config.php in order to add login and password of phpmyadmin

3. Modifier dans config.php le répertoire dans lequel les fichiers ont été téléchargés 
3. Modify in config.php the path where all the files were download

4. Télécharger aqm_chru.sql (dossier SQL)
4. Download aqm_chru.sql (folder SQL)

5. Créer une base de données intitulée 'aqm_chru' dans phpmyadmin
5. Create a database called 'aqm_chru' using phpmyadmin

6. Importer aqm_chru.sql dans phpmyadmin 
6. Import aqm_chru.sql using phpmyadmin 

7. Modifier la ligne 'error_reporting = E_ALL' par 'error_reporting = E_ALL & ~E_NOTICE' dans php.ini
7. Modify the ligne 'error_reporting = E_ALL' by 'error_reporting = E_ALL & ~E_NOTICE' in php.ini

8. localhost/AQM/login.php 
8. localhost/AQM/login.php 

9. login : admin ; password : admin pour être administrateur de la base de données 
9. login : admin ; password : admin to be the administrator of the database 

10. 4 utilisateurs (administrateur peut modifier et visualiser les données de tous les CHU, Manager peut modifier et visualiser les données de son CHU, Membre (médecin, chirurgien, ...) peut visualiser les données de son CHU, Passive Member ne peut visualiser les données mais besoin de son identité dans la prescription d'un acte médical).
10. 4 users (administrator can modify and modify the data from all the gait labs, Manager can modify and view data the data of its gait lab, Membre (physiatrist, surgeon, ...) can view the data from its gait lab, Passive Member can not view the data but need its identity in the prescription of a medical act).

11. Menu Admin -> Hopitaux pour ajouter un ou plusieurs CHU

12. Menu Admin -> Utilisateurs pour ajouter un ou plusieurs utilisateurs



13. Pathologie des enfants __________ Non renseigné
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
										
14. Pathologie des adultes __________ Non renseigné
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
