--
-- Base de données :  `pedagogique`
--

-- --------------------------------------------------------

--
-- Structure de la table `activité`
--

CREATE TABLE `activité` (
  `ID_utilisateur` int(11) NOT NULL,
  `Action` varchar(20) NOT NULL,
  `Details` text NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `NUM_ETUDIANT` int(7) NOT NULL,
  `ID_LISTE` int(20) NOT NULL,
  `PRENOM_ETUDIANT` varchar(25) DEFAULT NULL,
  `NOM_ETUDIANT` varchar(20) DEFAULT NULL,
  `NAISSANCE_ETUDIANT` date NOT NULL,
  `ADRESSE_ETUDIANT` tinytext,
  `TEL_ETUDIANT` varchar(20) DEFAULT NULL,
  `EMAIL_ETUDIANT` varchar(50) DEFAULT NULL,
  `ADRESSE_PARENTS` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `fiche_pedagogique`
--

CREATE TABLE `fiche_pedagogique` (
  `ID_FICHE` int(11) NOT NULL,
  `NUM_ETUDIANT` int(11) NOT NULL,
  `ID_PARCOURS` int(11) NOT NULL,
  `ID_SECRETAIRE` int(11) NOT NULL,
  `SEMESTRE` varchar(2) DEFAULT NULL,
  `ETAT_VALIDITE` varchar(10) DEFAULT NULL,
  `DATE_Fiche` date DEFAULT NULL,
  `DATE_VALIDATION` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `listes`
--

CREATE TABLE `listes` (
  `ID_LISTE` int(11) NOT NULL,
  `NOM_Liste` varchar(20) DEFAULT NULL,
  `ID_RESPONSABLE` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `parcours`
--

CREATE TABLE `parcours` (
  `ID_PARCOURS` int(11) NOT NULL,
  `LIBELLE` varchar(20) DEFAULT NULL,
  `NIVEAU_PARCOURS` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `responsable`
--

CREATE TABLE `responsable` (
  `ID_RESPONSABLE` int(11) NOT NULL,
  `NOM_RESPONSABLE` varchar(20) DEFAULT NULL,
  `PRENOM_RESPONSABLE` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `secretaire`
--

CREATE TABLE `secretaire` (
  `ID_SECRETAIRE` int(11) NOT NULL,
  `NOM_SECRETAIRE` varchar(20) DEFAULT NULL,
  `PRENOM_SECRETAIRE` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

CREATE TABLE `statut` (
  `ID_STATUT` int(11) NOT NULL,
  `NUM_ETUDIANT` int(10) NOT NULL,
  `ETUDIANT_RSE` varchar(10) NOT NULL,
  `ETUDIANT_AJAC` varchar(10) NOT NULL,
  `ETUDIANT_RNE` varchar(10) NOT NULL,
  `ETUDIANT_REDOUBLANT` varchar(10) NOT NULL,
  `ETUDIANT_SEMESTRE_OBTENU` varchar(4) NOT NULL,
  `ETUDIANT_TIERS_TEMPS` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ue`
--

CREATE TABLE `ue` (
  `ID_UE` int(11) NOT NULL,
  `CODE_APOGEE` varchar(20) NOT NULL,
  `TYPE` varchar(20) NOT NULL,
  `LIBELLE` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ue_parcours`
--

CREATE TABLE `ue_parcours` (
  `ID_UE` int(11) NOT NULL,
  `ID_PARCOURS` int(11) NOT NULL,
  `ID_UE_FICHE` int(11) NOT NULL,
  `ECTS` int(11) DEFAULT NULL,
  `ANNEE_PARCOURS` varchar(5) DEFAULT NULL,
  `SEMESTRE` varchar(2) DEFAULT NULL,
  `RSE` varchar(10) DEFAULT NULL,
  `VALIDATION_RSE` varchar(10) DEFAULT NULL,
  `INSCRIPTION` varchar(10) DEFAULT NULL,
  `V_NOTE` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `ID_utilisateur` int(11) NOT NULL,
  `Role` varchar(20) NOT NULL,
  `Nom_utilisateur` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Mot_de_passe` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activité`
--
ALTER TABLE `activité`
  ADD PRIMARY KEY (`ID_utilisateur`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`NUM_ETUDIANT`),
  ADD KEY `FK_ETUDIANT_LISTES` (`ID_LISTE`);

--
-- Index pour la table `fiche_pedagogique`
--
ALTER TABLE `fiche_pedagogique`
  ADD PRIMARY KEY (`ID_FICHE`),
  ADD KEY `NUM_ETUDIANT` (`NUM_ETUDIANT`),
  ADD KEY `FK_FICHE_PEDAGOGIQUE_PARCOURS` (`ID_PARCOURS`),
  ADD KEY `FK_FICHE_PEDAGOGIQUE_SECRETAIRE` (`ID_SECRETAIRE`);

--
-- Index pour la table `listes`
--
ALTER TABLE `listes`
  ADD PRIMARY KEY (`ID_LISTE`),
  ADD KEY `FK_LISTES_RESPONSABLE` (`ID_RESPONSABLE`);

--
-- Index pour la table `parcours`
--
ALTER TABLE `parcours`
  ADD PRIMARY KEY (`ID_PARCOURS`);

--
-- Index pour la table `responsable`
--
ALTER TABLE `responsable`
  ADD PRIMARY KEY (`ID_RESPONSABLE`);

--
-- Index pour la table `secretaire`
--
ALTER TABLE `secretaire`
  ADD PRIMARY KEY (`ID_SECRETAIRE`);

--
-- Index pour la table `statut`
--
ALTER TABLE `statut`
  ADD PRIMARY KEY (`ID_STATUT`),
  ADD KEY `FK_STATUT_ETUDIANT` (`NUM_ETUDIANT`);

--
-- Index pour la table `ue`
--
ALTER TABLE `ue`
  ADD PRIMARY KEY (`ID_UE`);

--
-- Index pour la table `ue_parcours`
--
ALTER TABLE `ue_parcours`
  ADD PRIMARY KEY (`ID_UE`,`ID_PARCOURS`,`ID_UE_FICHE`),
  ADD KEY `FK_UE_PARCOURS_PARCOURS` (`ID_PARCOURS`),
  ADD KEY `FK_UE_PARCOURS_fiche` (`ID_UE_FICHE`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`ID_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `NUM_ETUDIANT` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9990399;

--
-- AUTO_INCREMENT pour la table `statut`
--
ALTER TABLE `statut`
  MODIFY `ID_STATUT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=993;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `ID_utilisateur` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `FK_ETUDIANT_LISTES` FOREIGN KEY (`ID_LISTE`) REFERENCES `listes` (`ID_LISTE`);

--
-- Contraintes pour la table `fiche_pedagogique`
--
ALTER TABLE `fiche_pedagogique`
  ADD CONSTRAINT `FK_FICHE_PEDAGOGIQUE_PARCOURS` FOREIGN KEY (`ID_PARCOURS`) REFERENCES `parcours` (`ID_PARCOURS`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_FICHE_PEDAGOGIQUE_SECRETAIRE` FOREIGN KEY (`ID_SECRETAIRE`) REFERENCES `secretaire` (`ID_SECRETAIRE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fiche_pedagogique_ibfk_1` FOREIGN KEY (`NUM_ETUDIANT`) REFERENCES `etudiant` (`NUM_ETUDIANT`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `listes`
--
ALTER TABLE `listes`
  ADD CONSTRAINT `FK_LISTES_RESPONSABLE` FOREIGN KEY (`ID_RESPONSABLE`) REFERENCES `responsable` (`ID_RESPONSABLE`);

--
-- Contraintes pour la table `statut`
--
ALTER TABLE `statut`
  ADD CONSTRAINT `FK_STATUT_ETUDIANT` FOREIGN KEY (`NUM_ETUDIANT`) REFERENCES `etudiant` (`NUM_ETUDIANT`);

--
-- Contraintes pour la table `ue_parcours`
--
ALTER TABLE `ue_parcours`
  ADD CONSTRAINT `FK_UE_PARCOURS_PARCOURS` FOREIGN KEY (`ID_PARCOURS`) REFERENCES `parcours` (`ID_PARCOURS`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_UE_PARCOURS_UE` FOREIGN KEY (`ID_UE`) REFERENCES `ue` (`ID_UE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_UE_PARCOURS_fiche` FOREIGN KEY (`ID_UE_FICHE`) REFERENCES `fiche_pedagogique` (`ID_FICHE`);
COMMIT;
