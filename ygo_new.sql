-- MySQL dump 10.13  Distrib 8.0.44, for Win64 (x86_64)
--
-- Host: localhost    Database: ygo_new
-- ------------------------------------------------------
-- Server version	8.0.44

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `actions`
--

DROP TABLE IF EXISTS `actions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `actions` (
  `action_id` int NOT NULL AUTO_INCREMENT,
  `action_name` varchar(45) NOT NULL,
  PRIMARY KEY (`action_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actions`
--

LOCK TABLES `actions` WRITE;
/*!40000 ALTER TABLE `actions` DISABLE KEYS */;
INSERT INTO `actions` VALUES (-1,'ANY'),(1,'negate_effect'),(2,'negate_activation'),(3,'declare_activation'),(4,'destroy'),(5,'banish'),(6,'bounce'),(7,'spin'),(8,'add_deck_to_hand'),(9,'add_GY_to_hand'),(10,'add_banish_to_hand'),(11,'add_field_to_hand'),(12,'send_deck_to_GY'),(13,'send_banish_to_GY'),(14,'send_field_to_GY'),(15,'send_ED_to_GY'),(16,'send_hand_to_GY'),(17,'bansih_GY'),(18,'banish_hand'),(19,'banish_ED'),(20,'banish_deck'),(21,'ss_deck'),(22,'ss_ed'),(23,'ss_hand'),(24,'ss_banish'),(25,'ss_GY'),(27,'summon'),(28,'banish_field');
/*!40000 ALTER TABLE `actions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activation_location`
--

DROP TABLE IF EXISTS `activation_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activation_location` (
  `location_id` int NOT NULL AUTO_INCREMENT,
  `location_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Some cards can only activate their effects in certain locations. For example, carrds like "Despian Tragedy" can only be activated if it can only be activated if it is sent to the Graveyard or the Banishment. This is an important note, as certain counters can only target cards that are present in certain locations. Again, let''s take Impermanence, which negates a monster effect that is on the FIELD. Not in the hand, not in the graveyard, only the field.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activation_location`
--

LOCK TABLES `activation_location` WRITE;
/*!40000 ALTER TABLE `activation_location` DISABLE KEYS */;
INSERT INTO `activation_location` VALUES (-1,'ANY'),(1,'Deck'),(2,'Hand'),(3,'Field'),(4,'Graveyard'),(5,'Banishment'),(6,'Extra Deck'),(7,'Extra Monster Zone');
/*!40000 ALTER TABLE `activation_location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `archetype_gimmick`
--

DROP TABLE IF EXISTS `archetype_gimmick`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `archetype_gimmick` (
  `archetype_gimmick_id` int NOT NULL,
  `gimmick_name` varchar(45) DEFAULT NULL,
  `ARCHETYPES_archetype_id` int NOT NULL,
  PRIMARY KEY (`archetype_gimmick_id`),
  KEY `fk_ARCHETYPE_GIMMICK_ARCHETYPES1_idx` (`ARCHETYPES_archetype_id`),
  CONSTRAINT `fk_ARCHETYPE_GIMMICK_ARCHETYPES1` FOREIGN KEY (`ARCHETYPES_archetype_id`) REFERENCES `archetypes` (`archetype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Archetypes have gameplans that revolve around certain gimmicks or combinations of gimmicks.\n\nSome gimmicks include, but are not limited to:\n- Frequent Card Search or Search-reliance\n- Graveyard Reliance\n- Extra DeckSummoning\n	- Fusion Spam\n	- Synchro Spam\n	- XYZ Spam\n	- Link Spam\n- Spell Spam\n- Trap Spam\n- Material Spam\n- etc.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `archetype_gimmick`
--

LOCK TABLES `archetype_gimmick` WRITE;
/*!40000 ALTER TABLE `archetype_gimmick` DISABLE KEYS */;
/*!40000 ALTER TABLE `archetype_gimmick` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `archetype_interactions`
--

DROP TABLE IF EXISTS `archetype_interactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `archetype_interactions` (
  `archetype_interaction_id` int NOT NULL,
  `ARCHETYPES_archetype_id` int NOT NULL,
  `INTERACTION_TYPES_interaction_type_id` varchar(45) NOT NULL,
  PRIMARY KEY (`archetype_interaction_id`),
  KEY `fk_ARCHETYPE_INTERACTIONS_ARCHETYPES1_idx` (`ARCHETYPES_archetype_id`),
  KEY `fk_ARCHETYPE_INTERACTIONS_INTERACTION_TYPES1_idx` (`INTERACTION_TYPES_interaction_type_id`),
  CONSTRAINT `fk_ARCHETYPE_INTERACTIONS_ARCHETYPES1` FOREIGN KEY (`ARCHETYPES_archetype_id`) REFERENCES `archetypes` (`archetype_id`),
  CONSTRAINT `fk_ARCHETYPE_INTERACTIONS_INTERACTION_TYPES1` FOREIGN KEY (`INTERACTION_TYPES_interaction_type_id`) REFERENCES `interaction_types` (`interaction_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Tabulizes the interactions of archetypes and handtraps.\n\nThis was deemed necessary due to some counter cards countering archetypes as a whole, rather than single cards. In niche cases, some ONLY stop archetypes, rather than single cards.\nFurthermore, some can counter the whole archetype, single cards, combinations, all at once.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `archetype_interactions`
--

LOCK TABLES `archetype_interactions` WRITE;
/*!40000 ALTER TABLE `archetype_interactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `archetype_interactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `archetypes`
--

DROP TABLE IF EXISTS `archetypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `archetypes` (
  `archetype_id` int NOT NULL,
  `archetype_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`archetype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Many cards belong in archetypes, although not all of them. This is necessary for tabulating the interactions of archetypes and handtraps.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `archetypes`
--

LOCK TABLES `archetypes` WRITE;
/*!40000 ALTER TABLE `archetypes` DISABLE KEYS */;
/*!40000 ALTER TABLE `archetypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `card_archetypes`
--

DROP TABLE IF EXISTS `card_archetypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `card_archetypes` (
  `CARDS_card_id` int NOT NULL,
  `ARCHETYPES_archetype_id` int NOT NULL,
  KEY `fk_CARDS_has_ARCHETYPES_ARCHETYPES1_idx` (`ARCHETYPES_archetype_id`),
  CONSTRAINT `fk_CARDS_has_ARCHETYPES_ARCHETYPES1` FOREIGN KEY (`ARCHETYPES_archetype_id`) REFERENCES `archetypes` (`archetype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `card_archetypes`
--

LOCK TABLES `card_archetypes` WRITE;
/*!40000 ALTER TABLE `card_archetypes` DISABLE KEYS */;
/*!40000 ALTER TABLE `card_archetypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `card_categories`
--

DROP TABLE IF EXISTS `card_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `card_categories` (
  `card_category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`card_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Houses the categories of cards. This includes the official card types, and categorizations dubbed by the community.\nIncludes:\n\n(Official) Monster, Trap, Spell, (Official Sub-type) Fusion, Synchro, Xyz, Link, Ritual, Pendulum\n\nand (Unofficial) Handtraps.\n\nIf deemed necessary, may also include (Unofficial) "Board Breakers".';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `card_categories`
--

LOCK TABLES `card_categories` WRITE;
/*!40000 ALTER TABLE `card_categories` DISABLE KEYS */;
INSERT INTO `card_categories` VALUES (1,'Monster'),(2,'Spell'),(3,'Trap');
/*!40000 ALTER TABLE `card_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `card_interactions`
--

DROP TABLE IF EXISTS `card_interactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `card_interactions` (
  `interaction_type_id` int NOT NULL,
  `CARDS_counter_id` int NOT NULL,
  `EFFECTS_effect_id` int NOT NULL,
  PRIMARY KEY (`interaction_type_id`),
  KEY `fk_CARD_INTERACTIONS_EFFECTS1_idx` (`EFFECTS_effect_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Tabulizes the interactions between cards.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `card_interactions`
--

LOCK TABLES `card_interactions` WRITE;
/*!40000 ALTER TABLE `card_interactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `card_interactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `card_tag_assignments`
--

DROP TABLE IF EXISTS `card_tag_assignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `card_tag_assignments` (
  `CARD_TAGS_tag_id` int NOT NULL,
  `CARDS_card_id` int NOT NULL,
  KEY `fk_CARD_TAG_ASSIGNMENTS_CARD_TAGS1_idx` (`CARD_TAGS_tag_id`),
  CONSTRAINT `fk_CARD_TAG_ASSIGNMENTS_CARD_TAGS1` FOREIGN KEY (`CARD_TAGS_tag_id`) REFERENCES `card_tags` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `card_tag_assignments`
--

LOCK TABLES `card_tag_assignments` WRITE;
/*!40000 ALTER TABLE `card_tag_assignments` DISABLE KEYS */;
/*!40000 ALTER TABLE `card_tag_assignments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `card_tags`
--

DROP TABLE IF EXISTS `card_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `card_tags` (
  `tag_id` int NOT NULL,
  `tag_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Additional information about a card.\n\nIncludes:\n- Choke Point \n- High Threat\n- Starter\n- Extender\n\nThis is more for the information of player rather than the system. (Though the system can still make use of this.)';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `card_tags`
--

LOCK TABLES `card_tags` WRITE;
/*!40000 ALTER TABLE `card_tags` DISABLE KEYS */;
INSERT INTO `card_tags` VALUES (1,'Choke Point'),(2,'High Threat'),(3,'Starter'),(4,'Extender');
/*!40000 ALTER TABLE `card_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cards`
--

DROP TABLE IF EXISTS `cards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cards` (
  `card_id` int NOT NULL AUTO_INCREMENT,
  `card_name` varchar(45) NOT NULL,
  `threat_level` tinyint DEFAULT NULL,
  `handtrap` tinyint NOT NULL DEFAULT '0',
  `CATEGORY_category_id` int NOT NULL,
  PRIMARY KEY (`card_id`),
  KEY `fk_card_categories` (`CATEGORY_category_id`),
  CONSTRAINT `fk_card_categories` FOREIGN KEY (`CATEGORY_category_id`) REFERENCES `card_categories` (`card_category_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Cards in the Database. Contains the "engine" cards, and their counter cards (handtraps).\n\nWill make use of a single database, instead of making a database for engine cards and handtraps separately.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cards`
--

LOCK TABLES `cards` WRITE;
/*!40000 ALTER TABLE `cards` DISABLE KEYS */;
INSERT INTO `cards` VALUES (1,'Ghost Ogre & Snow Rabbit',0,1,1),(2,'Ash Blossom & Joyous Spring',0,1,1),(3,'Ghost Belle & Haunted Mansion',0,1,1),(4,'Infinite Impermanence',0,1,3),(5,'Droll & Lock Bird',0,1,1),(6,'Artifact Lancea',0,1,1),(7,'PSY-Framegear Gamma',0,1,1),(8,'D.D. Crow',0,1,1),(9,'Dominus Impulse',0,1,3),(10,'Dominus Purge',0,1,3),(11,'Performapal Odd-Eyes Dissolver',0,0,1),(12,'Maliss P Dormouse',5,0,1),(13,'Maliss P March Hare',2,0,1),(14,'Maliss White Rabbit',3,0,1),(15,'Maliss Q Hearts Crypter',0,0,1),(16,'Maliss in Underground',3,0,1),(17,'Maliss P Chessy Cat',1,0,1),(18,'Maliss Q Red Ransom',5,0,1),(19,'Maliss Q White Binder',5,0,1),(20,'Maliss in the Mirror',1,0,2),(21,'Maliss C MTP-07',1,0,3),(22,'Maliss C TB-11',1,0,3),(23,'Maliss C GWC-06',3,0,3),(24,'Ext Ryzeal',5,0,1),(25,'Ice Ryzeal',4,0,1),(26,'Ryzeal Detonator',0,0,1),(27,'Ryzeal Duo Drive',5,0,1),(28,'Sword Ryzeal',3,0,1),(29,'Node Ryzeal',0,0,1),(30,'Star Ryzeal',1,0,1),(31,'Palm Ryzeal',0,0,1),(32,'Ryzeal Cross',3,0,2),(33,'Ryzeal Plugin',0,0,2),(34,'Ryzeal Mass Driver',0,0,3),(35,'Ryzeal Plasma Hole',0,0,3),(38,'Blazing Cartesia, The Virtuous',NULL,1,1);
/*!40000 ALTER TABLE `cards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `effect_activation_location`
--

DROP TABLE IF EXISTS `effect_activation_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `effect_activation_location` (
  `EFFECTS_effect_id` int NOT NULL,
  `ACTIVATION_LOCATION_location_id` int NOT NULL,
  KEY `fk_EFFECTS_has_ACTIVATION_LOCATION_ACTIVATION_LOCATION1_idx` (`ACTIVATION_LOCATION_location_id`),
  KEY `fk_EFFECTS_has_ACTIVATION_LOCATION_EFFECTS1_idx` (`EFFECTS_effect_id`),
  CONSTRAINT `fk_activ_loc_id_eal` FOREIGN KEY (`ACTIVATION_LOCATION_location_id`) REFERENCES `activation_location` (`location_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_effect_id_eal` FOREIGN KEY (`EFFECTS_effect_id`) REFERENCES `effects` (`effect_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `effect_activation_location`
--

LOCK TABLES `effect_activation_location` WRITE;
/*!40000 ALTER TABLE `effect_activation_location` DISABLE KEYS */;
INSERT INTO `effect_activation_location` VALUES (1,2),(2,3),(3,2),(4,2),(5,2),(6,2),(7,2),(8,2),(9,2),(10,3),(11,2),(12,2),(13,3),(14,2),(15,2),(16,2),(17,2),(18,3),(19,2),(20,3),(21,3),(22,3),(23,3),(24,3),(25,5),(26,5),(27,3),(28,3),(29,3),(30,3),(31,5),(32,5),(33,5),(34,5),(35,5),(36,5),(37,3),(38,3),(39,3),(40,3),(41,3),(42,3),(44,2),(45,3);
/*!40000 ALTER TABLE `effect_activation_location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `effect_target_location`
--

DROP TABLE IF EXISTS `effect_target_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `effect_target_location` (
  `EFFECTS_effect_id` int NOT NULL,
  `TARGET_LOCATION_location_id` int NOT NULL,
  KEY `fk_EFFECTS_has_TARGET_LOCATION_TARGET_LOCATION1_idx` (`TARGET_LOCATION_location_id`),
  KEY `fk_EFFECTS_has_TARGET_LOCATION_EFFECTS1_idx` (`EFFECTS_effect_id`),
  CONSTRAINT `fk_effect_location` FOREIGN KEY (`EFFECTS_effect_id`) REFERENCES `effects` (`effect_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_target_loc_id_etl` FOREIGN KEY (`TARGET_LOCATION_location_id`) REFERENCES `target_location` (`location_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `effect_target_location`
--

LOCK TABLES `effect_target_location` WRITE;
/*!40000 ALTER TABLE `effect_target_location` DISABLE KEYS */;
INSERT INTO `effect_target_location` VALUES (1,3),(2,3),(3,-1),(4,-1),(5,-1),(6,-1),(7,-1),(8,-1),(9,3),(10,3),(11,-1),(12,-1),(13,-1),(14,-1),(15,-1),(16,-1),(17,-1),(18,-1),(19,-1),(20,-1),(21,1),(22,-1),(23,-1),(24,-1),(25,-1),(26,-1),(27,-1),(28,-1),(29,-1),(30,1),(31,-1),(32,-1),(33,-1),(34,-1),(35,-1),(36,-1),(37,-1),(38,-1),(39,-1),(40,-1),(41,-1),(42,-1),(44,-1),(45,-1);
/*!40000 ALTER TABLE `effect_target_location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `effect_target_type`
--

DROP TABLE IF EXISTS `effect_target_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `effect_target_type` (
  `EFFECTS_effect_id` int NOT NULL,
  `TARGET_TYPES_target_type_id` int NOT NULL,
  KEY `fk_CARD_TARGETS_TARGET_TYPES1_idx` (`TARGET_TYPES_target_type_id`),
  KEY `fk_CARD_TARGETS_EFFECTS1_idx` (`EFFECTS_effect_id`),
  CONSTRAINT `fk_effect_id_etts` FOREIGN KEY (`EFFECTS_effect_id`) REFERENCES `effects` (`effect_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_target_type_id_ett` FOREIGN KEY (`TARGET_TYPES_target_type_id`) REFERENCES `target_types` (`target_type_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `effect_target_type`
--

LOCK TABLES `effect_target_type` WRITE;
/*!40000 ALTER TABLE `effect_target_type` DISABLE KEYS */;
INSERT INTO `effect_target_type` VALUES (9,1),(10,1),(14,1),(21,1),(30,1),(1,-1),(2,-1),(3,-1),(4,-1),(5,-1),(6,-1),(7,-1),(8,-1),(11,-1),(12,-1),(13,-1),(15,-1),(16,-1),(17,-1),(18,-1),(19,-1),(20,-1),(22,-1),(23,-1),(24,-1),(25,-1),(26,-1),(27,-1),(28,-1),(29,-1),(31,-1),(32,-1),(33,-1),(34,-1),(35,-1),(36,-1),(37,-1),(38,-1),(39,-1),(40,-1),(41,-1),(42,-1),(44,-1),(45,-1);
/*!40000 ALTER TABLE `effect_target_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `effect_trigger`
--

DROP TABLE IF EXISTS `effect_trigger`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `effect_trigger` (
  `EFFECTS_effect_id` int NOT NULL,
  `TRIGGERS_action_id` int NOT NULL,
  KEY `fk_ACTIONS_has_EFFECTS_EFFECTS1_idx` (`EFFECTS_effect_id`),
  KEY `fk_ACTIONS_has_EFFECTS_ACTIONS1_idx` (`TRIGGERS_action_id`),
  CONSTRAINT `fk_effect_id_etr` FOREIGN KEY (`EFFECTS_effect_id`) REFERENCES `effects` (`effect_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_trigger_id_etr` FOREIGN KEY (`TRIGGERS_action_id`) REFERENCES `triggers` (`trigger_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `effect_trigger`
--

LOCK TABLES `effect_trigger` WRITE;
/*!40000 ALTER TABLE `effect_trigger` DISABLE KEYS */;
INSERT INTO `effect_trigger` VALUES (9,-1),(10,-1),(14,-1),(21,1),(30,1),(1,3),(2,3),(3,8),(4,21),(5,12),(6,9),(7,25),(8,17),(11,8),(12,5),(13,5),(15,-1),(16,27),(17,8),(18,4),(19,4),(20,4),(22,4),(23,4),(24,4),(25,4),(26,4),(27,4),(28,4),(29,4),(31,4),(32,4),(33,4),(34,4),(35,4),(36,4),(37,4),(38,4),(39,4),(40,4),(41,4),(42,4),(44,-1),(45,-1);
/*!40000 ALTER TABLE `effect_trigger` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `effects`
--

DROP TABLE IF EXISTS `effects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `effects` (
  `effect_id` int NOT NULL AUTO_INCREMENT,
  `CARDS_card_id` int NOT NULL,
  `activation_group` int DEFAULT NULL,
  `notes` varchar(45) DEFAULT NULL,
  `ACTIONS_action_id` int NOT NULL,
  PRIMARY KEY (`effect_id`),
  KEY `fk_card_effects` (`CARDS_card_id`),
  KEY `fk_effects_action_eff` (`ACTIONS_action_id`),
  CONSTRAINT `fk_card_effects` FOREIGN KEY (`CARDS_card_id`) REFERENCES `cards` (`card_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_effects_action_eff` FOREIGN KEY (`ACTIONS_action_id`) REFERENCES `actions` (`action_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `effects`
--

LOCK TABLES `effects` WRITE;
/*!40000 ALTER TABLE `effects` DISABLE KEYS */;
INSERT INTO `effects` VALUES (1,1,1,'',4),(2,1,2,'',4),(3,2,3,'',1),(4,2,4,'',1),(5,2,5,'',1),(6,3,6,'',1),(7,3,7,'',1),(8,3,8,'',1),(9,4,9,'',1),(10,4,10,'',1),(11,5,11,'',1),(12,6,12,'',1),(13,6,13,'',1),(14,7,14,'',1),(15,8,15,'',17),(16,9,16,'',1),(17,10,17,'',1),(18,12,18,'1st effect',5),(19,13,19,'1st effect',5),(20,14,20,'1st effect',21),(21,15,21,'',5),(22,16,22,'',5),(23,17,23,'',5),(24,19,24,'',5),(25,20,25,'',5),(26,20,25,'',8),(27,21,26,'',5),(28,21,26,'',8),(29,22,27,'',27),(30,23,28,'',27),(31,12,29,'Summons self on banish.',27),(32,13,30,'Summons self on banish.',27),(33,14,31,'Summons self on banish.',27),(34,15,32,'Summons self on banish.',27),(35,17,33,'Summons self on banish.',27),(36,19,34,'Summons self on banish.',27),(37,24,35,'Negate field card by sending ED to GY.',8),(38,25,36,'',8),(39,27,37,'',8),(40,28,38,'',8),(41,30,39,'',8),(42,32,40,'',1),(44,38,NULL,NULL,27),(45,38,NULL,NULL,22);
/*!40000 ALTER TABLE `effects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `interaction_types`
--

DROP TABLE IF EXISTS `interaction_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `interaction_types` (
  `interaction_type_id` varchar(45) NOT NULL,
  `interaction_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`interaction_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Houses the types of relevant interactions of cards. Includes:\n\n- neg_eff = negate effect\n- neg_act = negate activation\n- destroy\n- banish\n- bounce = return to hand\n- spin = return to deck';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interaction_types`
--

LOCK TABLES `interaction_types` WRITE;
/*!40000 ALTER TABLE `interaction_types` DISABLE KEYS */;
INSERT INTO `interaction_types` VALUES ('1','neg_eff'),('2','neg_act');
/*!40000 ALTER TABLE `interaction_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `it_in_ci`
--

DROP TABLE IF EXISTS `it_in_ci`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `it_in_ci` (
  `INTERACTION_TYPES_interaction_type_id` varchar(45) NOT NULL,
  `CARD_INTERACTIONS_interaction_type_id` int NOT NULL,
  KEY `fk_INTERACTION_TYPES_has_CARD_INTERACTIONS_CARD_INTERACTION_idx` (`CARD_INTERACTIONS_interaction_type_id`),
  KEY `fk_INTERACTION_TYPES_has_CARD_INTERACTIONS_INTERACTION_TYPE_idx` (`INTERACTION_TYPES_interaction_type_id`),
  CONSTRAINT `fk_INTERACTION_TYPES_has_CARD_INTERACTIONS_CARD_INTERACTIONS1` FOREIGN KEY (`CARD_INTERACTIONS_interaction_type_id`) REFERENCES `card_interactions` (`interaction_type_id`),
  CONSTRAINT `fk_INTERACTION_TYPES_has_CARD_INTERACTIONS_INTERACTION_TYPES1` FOREIGN KEY (`INTERACTION_TYPES_interaction_type_id`) REFERENCES `interaction_types` (`interaction_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `it_in_ci`
--

LOCK TABLES `it_in_ci` WRITE;
/*!40000 ALTER TABLE `it_in_ci` DISABLE KEYS */;
/*!40000 ALTER TABLE `it_in_ci` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `target_location`
--

DROP TABLE IF EXISTS `target_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `target_location` (
  `location_id` int NOT NULL AUTO_INCREMENT,
  `location_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Some cards can only activate their effects in certain locations. For example, carrds like "Despian Tragedy" can only be activated if it can only be activated if it is sent to the Graveyard or the Banishment. This is an important note, as certain counters can only target cards that are present in certain locations. Again, let''s take Impermanence, which negates a monster effect that is on the FIELD. Not in the hand, not in the graveyard, only the field.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `target_location`
--

LOCK TABLES `target_location` WRITE;
/*!40000 ALTER TABLE `target_location` DISABLE KEYS */;
INSERT INTO `target_location` VALUES (-1,'ANY'),(1,'Deck'),(2,'Hand'),(3,'Field'),(4,'GY'),(5,'Banishment'),(6,'Extra Deck');
/*!40000 ALTER TABLE `target_location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `target_types`
--

DROP TABLE IF EXISTS `target_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `target_types` (
  `target_type_id` int NOT NULL AUTO_INCREMENT,
  `target_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`target_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Certain cards can only target certain types of cards. (e.g. Infinite Impermanence can only affect Monster Cards).\n\n';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `target_types`
--

LOCK TABLES `target_types` WRITE;
/*!40000 ALTER TABLE `target_types` DISABLE KEYS */;
INSERT INTO `target_types` VALUES (-1,'ANY'),(1,'Monster'),(2,'Spell'),(3,'Trap');
/*!40000 ALTER TABLE `target_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `triggers`
--

DROP TABLE IF EXISTS `triggers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `triggers` (
  `trigger_id` int NOT NULL AUTO_INCREMENT,
  `trigger_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`trigger_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `triggers`
--

LOCK TABLES `triggers` WRITE;
/*!40000 ALTER TABLE `triggers` DISABLE KEYS */;
INSERT INTO `triggers` VALUES (-1,'ANY'),(1,'negate_effect'),(2,'negate_activation'),(3,'declare_activation'),(4,'destroy'),(5,'banish'),(6,'bounce'),(7,'spin'),(8,'add_deck_to_hand'),(9,'add_GY_to_hand'),(10,'add_banish_to_hand'),(11,'add_field_to_hand'),(12,'send_deck_to_GY'),(13,'send_banish_to_GY'),(14,'send_field_to_GY'),(15,'send_ED_to_GY'),(16,'send_hand_to_gy'),(17,'banish_GY'),(18,'banish_hand'),(19,'banish_ED'),(20,'banish_deck'),(21,'ss_deck'),(22,'ss_ed'),(23,'ss_hand'),(24,'ss_banish'),(25,'ss_GY'),(26,'placehold'),(27,'summon'),(28,'banish_field');
/*!40000 ALTER TABLE `triggers` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-01-02 10:12:05
