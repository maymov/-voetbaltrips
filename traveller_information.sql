--
-- Table structure for table `traveller_information`
--

DROP TABLE IF EXISTS `traveller_information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `traveller_information` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country_text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city_text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `postcode` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` char(7) COLLATE utf8_unicode_ci NOT NULL,
  `nationality` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `identity_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `passport_number` text COLLATE utf8_unicode_ci NOT NULL,
  `passport_validity` date DEFAULT NULL,
  `passport_document` text COLLATE utf8_unicode_ci NOT NULL,
  `is_updated` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT 'to know whether the user updated the travel information or not. 0 means not updated, 1 means updated successfully',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `traveller_information`
--

LOCK TABLES `traveller_information` WRITE;
/*!40000 ALTER TABLE `traveller_information` DISABLE KEYS */;

/*!40000 ALTER TABLE `traveller_information` ENABLE KEYS */;
UNLOCK TABLES;

