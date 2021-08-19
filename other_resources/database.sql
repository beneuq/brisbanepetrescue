-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 19, 2021 at 11:56 AM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pet_rescue_db`
--
CREATE DATABASE IF NOT EXISTS `pet_rescue_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `pet_rescue_db`;

-- --------------------------------------------------------

--
-- Table structure for table `dog_breeds`
--

CREATE TABLE `dog_breeds` (
  `breed_id` int(11) NOT NULL,
  `Breed` varchar(64) NOT NULL,
  `height_low` int(11) NOT NULL,
  `height_high` int(11) NOT NULL,
  `weight_low` int(11) NOT NULL,
  `weight_high` int(11) NOT NULL,
  `height_class` int(11) NOT NULL,
  `weight_class` int(11) NOT NULL,
  `adult_cal_intake_low` int(11) NOT NULL,
  `adult_cal_intake_high` int(11) NOT NULL,
  `intelligence_desc` varchar(64) NOT NULL,
  `obey_perc` decimal(4,2) NOT NULL,
  `training_reps_low` int(11) NOT NULL,
  `training_reps_high` int(11) NOT NULL,
  `intelligence_class` int(11) NOT NULL,
  `adaptability_class` int(11) NOT NULL,
  `general_friendliness_class` int(11) NOT NULL,
  `apartment_living_class` int(11) NOT NULL,
  `family_affectionate_class` int(11) NOT NULL,
  `shedding_amount_class` int(11) NOT NULL,
  `dog_friendly_class` int(11) NOT NULL,
  `drooling_potential_class` int(11) NOT NULL,
  `ease_of_grooming_class` int(11) NOT NULL,
  `energy_level_class` int(11) NOT NULL,
  `exercise_needs_class` int(11) NOT NULL,
  `friendly_toward_strangers_class` int(11) NOT NULL,
  `general_health_class` int(11) NOT NULL,
  `good_for_novice_owners` int(11) NOT NULL,
  `incredibly_kid_friendly_class` int(11) NOT NULL,
  `intensity_class` int(11) NOT NULL,
  `potential_for_mouthiness_class` int(11) NOT NULL,
  `potential_for_playfulness_class` int(11) NOT NULL,
  `potential_for_weight_gain_class` int(11) NOT NULL,
  `prey_drive_class` int(11) NOT NULL,
  `sensitivity_class` int(11) NOT NULL,
  `size_class` int(11) NOT NULL,
  `tendency_to_bark_or_howl_class` int(11) NOT NULL,
  `tolerates_being_alone_class` int(11) NOT NULL,
  `tolerates_cold_weather_class` int(11) NOT NULL,
  `tolerates_hot_weather_class` int(11) NOT NULL,
  `wanderlust_potential_class` int(11) NOT NULL,
  `watchdog_class` int(11) NOT NULL,
  `type_of_dog` varchar(16) NOT NULL,
  `average_lifespan` decimal(5,2) NOT NULL,
  `genetic_conditions` varchar(256) NOT NULL,
  `genetic_diseases` varchar(256) NOT NULL,
  `lifetime_cost_class` int(11) NOT NULL,
  `average_lifespan_class` int(11) NOT NULL,
  `average_purchase_price_class` int(11) NOT NULL,
  `popularity_class` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dog_breeds`
--

INSERT INTO `dog_breeds` (`breed_id`, `Breed`, `height_low`, `height_high`, `weight_low`, `weight_high`, `height_class`, `weight_class`, `adult_cal_intake_low`, `adult_cal_intake_high`, `intelligence_desc`, `obey_perc`, `training_reps_low`, `training_reps_high`, `intelligence_class`, `adaptability_class`, `general_friendliness_class`, `apartment_living_class`, `family_affectionate_class`, `shedding_amount_class`, `dog_friendly_class`, `drooling_potential_class`, `ease_of_grooming_class`, `energy_level_class`, `exercise_needs_class`, `friendly_toward_strangers_class`, `general_health_class`, `good_for_novice_owners`, `incredibly_kid_friendly_class`, `intensity_class`, `potential_for_mouthiness_class`, `potential_for_playfulness_class`, `potential_for_weight_gain_class`, `prey_drive_class`, `sensitivity_class`, `size_class`, `tendency_to_bark_or_howl_class`, `tolerates_being_alone_class`, `tolerates_cold_weather_class`, `tolerates_hot_weather_class`, `wanderlust_potential_class`, `watchdog_class`, `type_of_dog`, `average_lifespan`, `genetic_conditions`, `genetic_diseases`, `lifetime_cost_class`, `average_lifespan_class`, `average_purchase_price_class`, `popularity_class`) VALUES
(1, 'Akita', 66, 72, 36, 55, 2, 3, 1481, 2488, 'Average Working/Obedience Intelligence', '0.50', 26, 40, 3, 3, 2, 2, 5, 5, 1, 5, 1, 4, 4, 2, 4, 2, 1, 3, 3, 5, 4, 4, 5, 4, 5, 1, 5, 2, 4, 5, 'working', '10.16', 'hip problems', 'hip dysplasia', 3, 2, 2, 4),
(2, 'Bernese Mountain Dog', 58, 69, 38, 50, 2, 3, 1542, 2316, 'Excellent Working Dogs', '0.85', 5, 15, 5, 2, 5, 1, 5, 5, 3, 4, 3, 4, 3, 5, 1, 2, 5, 3, 5, 4, 4, 5, 4, 5, 4, 1, 5, 1, 3, 5, 'working', '7.56', 'meningitis, elbow + hip problems, complex immune disorder', 'Meningitis, Elbow dysplasia - OCD of the elbow, Hip dysplasia, Histiocytosis', 2, 1, 2, 5),
(3, 'Bloodhound', 60, 67, 36, 55, 2, 3, 1481, 2488, 'Lowest Degree of Working/Obedience Intelligence', '0.00', 81, 100, 1, 3, 5, 1, 5, 4, 5, 5, 1, 5, 5, 5, 3, 2, 5, 4, 5, 3, 3, 3, 4, 4, 4, 2, 3, 3, 5, 1, 'hound', '6.75', 'fatal stomach bloat, skin problems', 'Gastric dilatation-volvulus, Hip dysplasia', 1, 1, 1, 4),
(4, 'Borzoi', 66, 72, 31, 46, 2, 3, 1324, 2176, 'Lowest Degree of Working/Obedience Intelligence', '0.00', 81, 100, 1, 4, 4, 5, 4, 5, 4, 1, 4, 2, 2, 4, 4, 3, 3, 2, 3, 3, 2, 5, 5, 5, 2, 1, 4, 3, 4, 1, 'hound', '9.08', 'none', 'none', 2, 2, 1, 2),
(5, 'Bullmastiff', 63, 69, 45, 59, 2, 4, 1751, 2622, 'Fair Working/Obedience Intelligence', '0.30', 41, 80, 2, 3, 4, 3, 5, 1, 4, 5, 5, 2, 3, 3, 2, 2, 5, 4, 3, 5, 5, 3, 4, 5, 4, 2, 4, 2, 3, 5, 'working', '7.57', 'eye, hip problems', 'Entropion, Hip dysplasia', 1, 1, 2, 4),
(6, 'Great Dane', 81, 82, 54, 73, 3, 4, 2007, 3076, 'Average Working/Obedience Intelligence', '0.50', 26, 40, 3, 2, 5, 1, 5, 5, 5, 4, 5, 5, 5, 5, 4, 1, 5, 5, 2, 5, 2, 3, 5, 5, 4, 1, 2, 3, 3, 5, 'working', '6.96', 'heart, spinal, hip problems, fatal stomach bloat', 'Dilated cardiomyopathy, Cervical vertebral instability (Wobbler syndrome), Gastric dilatation-volvulus, Hip dysplasia', 1, 1, 2, 5),
(7, 'Great Pyrenees', 68, 82, 43, 55, 3, 3, 1692, 2488, 'Fair Working/Obedience Intelligence', '0.30', 41, 80, 2, 3, 4, 1, 5, 5, 4, 2, 4, 5, 5, 3, 2, 1, 4, 5, 2, 4, 4, 5, 4, 5, 5, 3, 5, 3, 5, 5, 'working', '10.00', 'hip problems', 'hip dysplasia', 5, 2, 1, 3),
(8, 'Irish Wolfhound', 71, 89, 40, 69, 3, 4, 1603, 2949, 'Average Working/Obedience Intelligence', '0.50', 26, 40, 3, 2, 5, 1, 5, 3, 5, 1, 3, 2, 4, 5, 1, 2, 5, 2, 3, 4, 3, 5, 3, 5, 1, 2, 4, 2, 3, 3, 'hound', '6.94', 'heart, liver, hip problems', 'Dilated cardiomyopathy, Hip dysplasia, Portosystemic shunt', 3, 1, 2, 3),
(9, 'Mastiff', 68, 77, 79, 87, 3, 5, 2671, 3509, 'Lowest Degree of Working/Obedience Intelligence', '0.00', 81, 100, 1, 2, 4, 2, 5, 3, 2, 5, 3, 3, 4, 2, 3, 1, 5, 3, 4, 4, 4, 2, 3, 5, 2, 3, 4, 1, 1, 5, 'working', '6.50', 'hip, heart problems', 'Hip dysplasia, Pulmonic stenosis', 1, 1, 1, 5),
(10, 'Rottweiler', 55, 69, 40, 50, 2, 3, 1603, 2316, 'Brightest Dogs', '0.95', 1, 4, 5, 2, 4, 2, 5, 4, 2, 4, 5, 4, 4, 4, 2, 1, 4, 4, 3, 5, 5, 4, 4, 3, 4, 1, 2, 3, 2, 5, 'working', '9.11', 'heart, elbow, hip problems', 'Subaortic stenosis, Elbow dysplasia - OCD of the elbow, Hip dysplasia', 3, 2, 2, 5),
(11, 'Saint Bernard', 63, 72, 49, 87, 2, 5, 1866, 3509, 'Fair Working/Obedience Intelligence', '0.30', 41, 80, 2, 3, 5, 3, 5, 4, 5, 5, 2, 3, 2, 5, 2, 2, 5, 2, 3, 4, 4, 1, 4, 5, 1, 1, 5, 1, 2, 3, 'working', '7.78', 'heart, hip disorders, fatal stomach bloat', 'Dilated cardiomyopathy, Gastric dilatation-volvulus, Hip dysplasia', 3, 1, 1, 4),
(12, 'Afghan Hound', 63, 69, 22, 28, 2, 2, 1023, 1499, 'Lowest Degree of Working/Obedience Intelligence', '0.00', 81, 100, 1, 4, 4, 5, 5, 4, 4, 1, 1, 5, 4, 2, 3, 3, 5, 2, 3, 4, 1, 5, 5, 4, 2, 2, 5, 5, 5, 1, 'hound', '11.92', 'none', 'none', 5, 3, 1, 3),
(13, 'Boxer', 53, 64, 29, 32, 2, 2, 1259, 1657, 'Average Working/Obedience Intelligence', '0.50', 26, 40, 3, 3, 4, 4, 5, 4, 3, 2, 5, 5, 5, 4, 2, 3, 4, 5, 2, 5, 4, 3, 4, 3, 3, 1, 2, 1, 3, 5, 'working', '8.81', 'eye, nerve, heart problems', 'Corneal dystrophy, Degenerative myelopathy, Dilated cardiomyopathy, Subaortic stenosis', 2, 2, 1, 5),
(14, 'Briard', 58, 69, 33, 35, 2, 2, 1387, 1772, 'Above Average Working Dogs', '0.70', 16, 25, 4, 3, 4, 3, 4, 1, 5, 1, 1, 4, 4, 2, 3, 3, 5, 4, 2, 4, 3, 3, 4, 4, 4, 3, 4, 3, 5, 5, 'herding', '11.17', 'hip problems', 'hip dysplasia', 3, 3, 1, 2),
(15, 'Chesapeake Bay Retriever', 53, 67, 24, 35, 2, 2, 1092, 1772, 'Above Average Working Dogs', '0.70', 16, 25, 4, 3, 3, 1, 5, 5, 1, 3, 5, 5, 5, 1, 4, 1, 3, 5, 3, 4, 4, 3, 3, 3, 3, 2, 4, 4, 4, 3, 'sporting', '9.48', 'hip problems', 'hip dysplasia', 2, 2, 1, 4),
(16, 'Clumber Spaniel', 48, 51, 15, 30, 2, 2, 768, 1579, 'Above Average Working Dogs', '0.70', 16, 25, 4, 4, 4, 5, 5, 5, 4, 5, 1, 3, 2, 3, 2, 5, 3, 1, 5, 5, 5, 5, 4, 3, 1, 2, 5, 2, 4, 3, 'sporting', '10.00', 'none', 'none', 2, 2, 2, 2),
(17, 'Doberman Pinscher', 66, 72, 27, 46, 2, 3, 1193, 2176, 'Brightest Dogs', '0.95', 1, 4, 5, 3, 3, 3, 5, 4, 1, 4, 5, 3, 3, 3, 1, 3, 3, 3, 2, 5, 3, 1, 5, 4, 1, 2, 1, 4, 2, 5, 'working', '10.33', 'heart, spine, blood clotting disorders', 'Dilated cardiomyopathy, Cervical vertebral instability (Wobbler syndrome), Intervertebral disk disease, von Willebrand\'s disease', 3, 2, 1, 5),
(18, 'English Setter', 58, 69, 20, 37, 2, 2, 953, 1848, 'Above Average Working Dogs', '0.70', 16, 25, 4, 3, 5, 1, 5, 3, 5, 2, 3, 4, 5, 5, 3, 3, 5, 2, 4, 5, 5, 5, 4, 3, 4, 1, 4, 3, 5, 3, 'sporting', '11.57', 'deafness, hip problems', 'deafness, hip dysplasia', 3, 3, 1, 3),
(19, 'German Shorthaired Pointer', 50, 69, 22, 37, 2, 2, 1023, 1848, 'Excellent Working Dogs', '0.85', 5, 15, 5, 2, 4, 1, 5, 2, 4, 2, 5, 5, 5, 3, 3, 2, 5, 3, 4, 5, 3, 5, 4, 3, 3, 1, 2, 4, 5, 3, 'sporting', '11.46', 'hip problems', 'hip dysplasia', 5, 3, 1, 5),
(20, 'German Wirehaired Pointer', 55, 67, 27, 32, 2, 2, 1193, 1657, 'Average Working/Obedience Intelligence', '0.50', 26, 40, 3, 3, 3, 2, 5, 2, 3, 2, 4, 5, 5, 2, 4, 3, 3, 4, 4, 5, 3, 4, 4, 4, 3, 2, 3, 4, 5, 5, 'sporting', '10.00', 'hip problems', 'hip dysplasia', 5, 2, 1, 3),
(21, 'Giant Schnauzer', 63, 72, 31, 35, 2, 2, 1324, 1772, 'Above Average Working Dogs', '0.70', 16, 25, 4, 2, 3, 1, 5, 4, 3, 1, 2, 5, 5, 2, 4, 1, 3, 2, 3, 5, 3, 4, 4, 4, 4, 2, 4, 2, 4, 5, 'working', '10.00', 'hip problems', 'hip dysplasia', 5, 2, 1, 3),
(22, 'Golden Retriever', 53, 61, 24, 35, 2, 2, 1092, 1772, 'Brightest Dogs', '0.95', 1, 4, 5, 3, 5, 2, 5, 5, 5, 4, 2, 5, 5, 5, 2, 3, 5, 2, 5, 5, 5, 3, 5, 3, 3, 1, 3, 3, 2, 3, 'sporting', '12.04', 'elbows, hips, eyes, heart', 'elbow dysplasia, hip dysplasia, retinal dysplasia, subaortic stenosis', 4, 3, 2, 5),
(23, 'Gordon Setter', 58, 69, 20, 37, 2, 2, 953, 1848, 'Above Average Working Dogs', '0.70', 16, 25, 4, 3, 3, 2, 5, 5, 2, 3, 2, 5, 5, 3, 4, 3, 3, 2, 3, 5, 3, 4, 4, 3, 5, 1, 4, 3, 4, 4, 'sporting', '11.10', 'hip problems', 'hip dysplasia', 3, 3, 1, 3),
(24, 'Greyhound', 68, 77, 27, 32, 3, 2, 1193, 1657, 'Average Working/Obedience Intelligence', '0.50', 26, 40, 3, 3, 5, 4, 5, 4, 4, 5, 5, 5, 5, 5, 4, 2, 5, 3, 4, 4, 5, 5, 5, 4, 2, 1, 1, 5, 5, 3, 'hound', '9.36', 'blood vessel disorders', 'familial vasculopathy', 2, 2, 2, 1),
(25, 'Irish Setter', 63, 69, 27, 32, 2, 2, 1193, 1657, 'Above Average Working Dogs', '0.70', 16, 25, 4, 3, 5, 1, 5, 4, 5, 2, 3, 5, 5, 5, 2, 3, 5, 3, 5, 5, 3, 5, 4, 4, 4, 2, 4, 3, 5, 3, 'sporting', '11.63', 'hip, eye problems', 'Hip dysplasia, Progressive retinal atrophy', 3, 3, 1, 3),
(26, 'Labrador Retriever', 53, 61, 24, 37, 2, 2, 1092, 1848, 'Brightest Dogs', '0.95', 1, 4, 5, 3, 5, 1, 5, 5, 5, 3, 5, 5, 5, 5, 3, 3, 5, 5, 5, 5, 5, 2, 5, 4, 4, 2, 3, 3, 3, 3, 'sporting', '12.04', 'elbows, hips, eyes', 'elbow dysplasia, hip dysplasia, retinal dysplasia', 4, 3, 1, 5),
(27, 'Rhodesian Ridgeback', 60, 69, 31, 39, 2, 3, 1324, 1922, 'Average Working/Obedience Intelligence', '0.50', 26, 40, 3, 3, 4, 1, 5, 4, 4, 1, 5, 4, 5, 3, 4, 2, 4, 4, 3, 5, 3, 5, 4, 4, 1, 2, 3, 3, 5, 3, 'hound', '9.10', 'birth defects, hip problems', 'dermoid sinus, Hip dysplasia', 2, 2, 2, 4),
(28, 'Scottish Deerhound', 71, 82, 34, 50, 3, 3, 1419, 2316, 'Average Working/Obedience Intelligence', '0.50', 26, 40, 3, 3, 4, 1, 5, 5, 2, 1, 2, 5, 5, 5, 3, 1, 4, 5, 4, 5, 4, 5, 3, 5, 1, 2, 4, 4, 4, 1, 'hound', '8.70', 'heart problems, fatal stomach bloat', 'Dilated cardiomyopathy, Gastric dilatation-volvulus', 3, 2, 1, 1),
(29, 'Australian Shepherd', 45, 59, 18, 28, 2, 2, 880, 1499, 'Average Working/Obedience Intelligence', '0.50', 26, 40, 3, 3, 4, 1, 5, 3, 5, 1, 1, 5, 5, 3, 2, 2, 4, 4, 4, 5, 4, 4, 5, 3, 4, 2, 4, 4, 5, 5, 'herding', '12.28', 'deafness, hip problems', 'deafness, hip dysplasia', 4, 3, 1, 5),
(30, 'Basset Hound', 35, 36, 18, 23, 1, 2, 880, 1293, 'Lowest Degree of Working/Obedience Intelligence', '0.00', 81, 100, 1, 3, 5, 5, 5, 4, 5, 4, 5, 2, 2, 5, 1, 4, 5, 2, 3, 2, 5, 5, 4, 2, 4, 3, 2, 2, 5, 1, 'hound', '11.43', 'blood, skin disorders', 'Platelet dysfunction (thrombocytopathia, Basset hound thrombopathia), seborrhea', 3, 3, 1, 4),
(31, 'Bearded Collie', 50, 56, 18, 28, 2, 2, 880, 1499, 'Above Average Working Dogs', '0.70', 16, 25, 4, 3, 5, 3, 5, 4, 5, 1, 2, 4, 4, 4, 3, 4, 4, 4, 3, 5, 4, 3, 4, 3, 3, 2, 4, 3, 5, 4, 'herding', '12.77', 'none', 'none', 3, 4, 1, 2),
(32, 'Border Collie', 48, 54, 18, 19, 2, 2, 880, 1121, 'Brightest Dogs', '0.95', 1, 4, 5, 3, 4, 2, 5, 3, 3, 1, 3, 5, 5, 5, 2, 2, 4, 3, 3, 5, 3, 3, 5, 3, 2, 1, 4, 4, 3, 5, 'herding', '12.52', 'eye problems, deafness', 'Collie eye anomaly, deafness', 3, 4, 1, 4),
(33, 'Bull Terrier', 53, 56, 22, 32, 2, 2, 1023, 1657, 'Fair Working/Obedience Intelligence', '0.30', 41, 80, 2, 3, 5, 4, 5, 3, 4, 1, 5, 4, 5, 5, 4, 4, 5, 5, 4, 5, 5, 4, 5, 2, 1, 2, 1, 4, 5, 5, 'terrier', '10.21', 'heart problems, zinc metabolism disorder', 'lethal acrodermatitis, Mitral valve dysplasia', 3, 2, 2, 4),
(34, 'Chow Chow', 48, 56, 20, 25, 2, 2, 953, 1377, 'Lowest Degree of Working/Obedience Intelligence', '0.00', 81, 100, 1, 3, 1, 3, 2, 1, 1, 3, 1, 2, 2, 1, 2, 2, 1, 2, 5, 1, 4, 2, 2, 4, 1, 5, 5, 2, 2, 3, 'non-sporting', '9.01', 'eye, hip problems', 'Entropion, Hip dysplasia', 2, 2, 1, 4),
(35, 'Dalmatian', 48, 59, 20, 32, 2, 2, 953, 1657, 'Above Average Working Dogs', '0.70', 16, 25, 4, 3, 4, 2, 5, 5, 4, 1, 5, 5, 5, 3, 4, 3, 4, 4, 2, 4, 4, 2, 4, 3, 2, 3, 3, 4, 4, 3, 'non-sporting', '11.27', 'deafness, urinary stones', 'Deafness, Urolithiasis (stones)', 3, 3, 1, 3),
(36, 'English Springer Spaniel', 50, 51, 20, 25, 2, 2, 953, 1377, 'Excellent Working Dogs', '0.85', 5, 15, 5, 3, 5, 1, 5, 3, 5, 1, 2, 5, 5, 4, 3, 3, 5, 3, 3, 5, 3, 5, 4, 3, 3, 1, 3, 4, 4, 3, 'sporting', '12.54', 'hip, eye, skin problems; enzyme deficiency', 'Hip dysplasia, Phosphofructokinase (PFK) deficiency, Retinal dysplasia, seborrhea', 4, 4, 1, 5),
(37, 'Field Spaniel', 45, 46, 15, 23, 2, 2, 768, 1293, 'Above Average Working Dogs', '0.70', 16, 25, 4, 3, 5, 1, 5, 3, 4, 1, 4, 5, 5, 4, 3, 3, 5, 3, 3, 5, 4, 4, 4, 2, 2, 1, 3, 4, 5, 3, 'sporting', '9.90', 'none', 'none', 2, 2, 1, 1),
(38, 'Finnish Spitz', 38, 51, 14, 16, 2, 1, 729, 985, 'Average Working/Obedience Intelligence', '0.50', 26, 40, 3, 3, 5, 3, 5, 4, 5, 1, 2, 5, 5, 3, 4, 3, 5, 4, 3, 5, 3, 3, 3, 3, 5, 1, 5, 3, 4, 3, 'non-sporting', '11.17', 'none', 'none', 3, 3, 1, 1),
(39, 'Irish Water Spaniel', 25, 59, 20, 30, 1, 2, 953, 1579, 'Excellent Working Dogs', '0.85', 5, 15, 5, 3, 5, 3, 5, 1, 4, 2, 3, 5, 5, 5, 2, 2, 5, 3, 3, 4, 3, 5, 4, 3, 4, 3, 4, 4, 3, 4, 'sporting', '9.33', 'hip problems', 'hip dysplasia', 3, 2, 1, 1),
(40, 'Keeshond', 43, 49, 15, 23, 2, 2, 768, 1293, 'Excellent Working Dogs', '0.85', 5, 15, 5, 4, 5, 4, 5, 5, 4, 1, 3, 4, 3, 4, 3, 4, 5, 3, 3, 5, 4, 3, 5, 3, 4, 1, 5, 3, 2, 4, 'non-sporting', '12.17', 'hip problems', 'hip dysplasia', 4, 3, 1, 3),
(41, 'Kerry Blue Terrier', 43, 54, 13, 21, 2, 1, 690, 1208, 'Above Average Working Dogs', '0.70', 16, 25, 4, 3, 4, 3, 4, 1, 2, 1, 2, 4, 5, 5, 3, 2, 4, 4, 4, 4, 3, 3, 3, 3, 4, 3, 4, 3, 3, 5, 'terrier', '9.40', 'heart problems', 'Patent ductus arteriosus (PDA)', 2, 2, 2, 2),
(42, 'Pharaoh Hound', 53, 64, 20, 25, 2, 2, 953, 1377, 'Above Average Working Dogs', '0.70', 16, 25, 4, 4, 5, 4, 5, 2, 5, 1, 4, 2, 4, 4, 5, 4, 5, 3, 4, 4, 3, 5, 5, 3, 4, 2, 1, 5, 4, 2, 'hound', '11.83', 'none', 'none', 3, 3, 1, 1),
(43, 'Pointer', 53, 61, 19, 30, 2, 2, 917, 1579, 'Average Working/Obedience Intelligence', '0.50', 26, 40, 3, 2, 5, 1, 5, 3, 5, 1, 5, 5, 5, 5, 3, 1, 5, 5, 5, 5, 3, 5, 3, 3, 3, 1, 2, 4, 5, 4, 'sporting', '12.42', 'hip problems', 'hip dysplasia', 5, 4, 1, 2),
(44, 'Portuguese Water Dog', 50, 59, 19, 28, 2, 2, 917, 1499, 'Above Average Working Dogs', '0.70', 16, 25, 4, 3, 5, 4, 5, 1, 5, 1, 2, 5, 5, 3, 4, 3, 5, 3, 5, 5, 3, 3, 4, 3, 3, 2, 4, 3, 3, 4, 'working', '11.42', 'none', 'none', 3, 3, 2, 4),
(45, 'Saluki', 58, 72, 15, 32, 2, 2, 768, 1657, 'Average Working/Obedience Intelligence', '0.50', 26, 40, 3, 2, 4, 1, 5, 2, 4, 1, 4, 5, 5, 1, 4, 2, 4, 2, 4, 5, 1, 5, 5, 4, 1, 1, 2, 3, 5, 3, 'hound', '12.00', 'none', 'none', 5, 3, 2, 2),
(46, 'Samoyed', 48, 61, 22, 30, 2, 2, 1023, 1579, 'Above Average Working Dogs', '0.70', 16, 25, 4, 3, 5, 2, 5, 5, 5, 2, 1, 5, 5, 5, 3, 2, 5, 2, 3, 5, 4, 5, 4, 3, 3, 2, 5, 1, 4, 4, 'working', '12.44', 'hip problems', 'hip dysplasia', 5, 4, 2, 3),
(47, 'Siberian Husky', 50, 59, 18, 28, 2, 2, 880, 1499, 'Average Working/Obedience Intelligence', '0.50', 26, 40, 3, 3, 5, 2, 5, 3, 5, 3, 2, 5, 5, 5, 4, 1, 5, 3, 4, 5, 2, 3, 4, 3, 5, 1, 5, 3, 5, 1, 'working', '12.58', 'none', 'none', 4, 4, 1, 5),
(48, 'Staffordshire Bull Terrier', 35, 41, 10, 13, 1, 1, 566, 843, 'Average Working/Obedience Intelligence', '0.50', 26, 40, 3, 2, 4, 3, 5, 3, 1, 3, 5, 3, 4, 5, 3, 1, 5, 3, 2, 5, 4, 2, 4, 2, 3, 2, 3, 1, 4, 3, 'terrier', '12.05', 'hip problems', 'hip dysplasia', 4, 3, 2, 3),
(49, 'Vizsla', 121, 168, 9, 12, 5, 1, 523, 794, 'Excellent Working Dogs', '0.85', 5, 15, 5, 3, 5, 1, 5, 2, 5, 1, 5, 5, 5, 5, 4, 3, 5, 4, 4, 5, 2, 2, 5, 3, 5, 1, 1, 4, 5, 3, 'sporting', '12.50', 'none', 'none', 5, 4, 2, 4),
(50, 'Welsh Springer Spaniel', 40, 49, 15, 21, 2, 2, 768, 1208, 'Above Average Working Dogs', '0.70', 16, 25, 4, 4, 4, 4, 5, 3, 4, 1, 4, 5, 5, 3, 4, 4, 5, 4, 3, 4, 4, 3, 5, 3, 5, 1, 4, 4, 5, 4, 'sporting', '12.49', 'hip problems', 'hip dysplasia', 3, 4, 1, 2),
(51, 'Australian Terrier', 25, 26, 4, 7, 1, 1, 285, 530, 'Above Average Working Dogs', '0.70', 16, 25, 4, 3, 3, 5, 4, 1, 2, 1, 5, 5, 4, 3, 5, 3, 3, 5, 1, 5, 3, 5, 2, 1, 5, 2, 3, 4, 4, 3, 'terrier', '11.05', 'none', 'none', 2, 3, 1, 2),
(52, 'Basenji', 43, 44, 9, 10, 1, 1, 523, 692, 'Lowest Degree of Working/Obedience Intelligence', '0.00', 81, 100, 1, 4, 5, 5, 5, 1, 4, 5, 5, 5, 5, 5, 2, 4, 5, 1, 5, 2, 2, 5, 3, 2, 1, 4, 1, 4, 5, 5, 'hound', '13.58', 'kidney, eye problems, anaemia', 'Fanconi syndrome, Persistent pupillary membranes (PPM), Pyruvate kinase (PK) deficiency', 4, 4, 2, 3),
(53, 'Beagle', 33, 41, 8, 14, 1, 1, 479, 891, 'Lowest Degree of Working/Obedience Intelligence', '0.00', 81, 100, 1, 3, 5, 4, 5, 3, 5, 1, 4, 4, 4, 5, 1, 3, 5, 5, 3, 5, 5, 5, 4, 2, 5, 1, 2, 4, 5, 1, 'hound', '12.30', 'heart problems', 'Pulmonic stenosis', 3, 3, 1, 5),
(54, 'Bedlington Terrier', 38, 41, 8, 11, 1, 1, 479, 744, 'Average Working/Obedience Intelligence', '0.50', 26, 40, 3, 4, 5, 4, 5, 5, 4, 1, 1, 4, 4, 5, 4, 4, 4, 2, 4, 5, 3, 5, 3, 3, 3, 3, 4, 3, 4, 3, 'terrier', '13.51', 'liver, eye problems', 'Chronic hepatitis, Retinal dysplasia', 4, 4, 2, 2),
(55, 'Bichon Frise', 24, 30, 4, 9, 1, 1, 285, 640, 'Average Working/Obedience Intelligence', '0.50', 26, 40, 3, 4, 5, 5, 5, 2, 4, 1, 1, 5, 3, 5, 4, 5, 4, 3, 3, 5, 4, 4, 5, 2, 2, 1, 3, 4, 2, 3, 'non-sporting', '12.21', 'none', 'none', 3, 3, 1, 4),
(56, 'Border Terrier', 30, 39, 5, 7, 1, 1, 337, 530, 'Above Average Working Dogs', '0.70', 16, 25, 4, 3, 4, 4, 5, 3, 2, 1, 2, 4, 5, 5, 4, 3, 4, 4, 5, 5, 5, 5, 3, 2, 1, 1, 4, 3, 4, 4, 'terrier', '14.00', 'none', 'none', 4, 4, 1, 3),
(57, 'Boston Terrier', 35, 39, 6, 12, 1, 1, 386, 794, 'Average Working/Obedience Intelligence', '0.50', 26, 40, 3, 4, 5, 5, 4, 2, 5, 1, 5, 4, 4, 4, 4, 4, 5, 5, 2, 5, 3, 2, 5, 2, 3, 3, 3, 2, 5, 3, 'non-sporting', '10.92', 'breathing problems', 'brachycephalic syndrome', 2, 3, 1, 5),
(58, 'Cairn Terrier', 22, 26, 6, 7, 1, 1, 386, 530, 'Above Average Working Dogs', '0.70', 16, 25, 4, 4, 5, 5, 5, 3, 4, 1, 5, 5, 4, 4, 4, 4, 5, 4, 3, 5, 3, 4, 3, 1, 4, 1, 4, 4, 3, 4, 'terrier', '13.84', '\'lion jaw\', heart problems', 'Craniomandibular osteopathy (\"lion jaw\"), Mitral valve dysplasia', 4, 4, 1, 4),
(59, 'Cavalier King Charles Spaniel', 25, 39, 6, 10, 1, 1, 386, 692, 'Average Working/Obedience Intelligence', '0.50', 26, 40, 3, 4, 5, 5, 5, 3, 5, 1, 4, 3, 4, 5, 4, 5, 5, 2, 3, 5, 4, 3, 5, 2, 3, 1, 3, 2, 2, 2, 'toy', '11.29', 'heart, spinal problems', 'Mitral valve dysplasia, Chiari-like malformation (CM) and syringomyelia (SM)', 3, 3, 2, 5),
(60, 'Dachshund', 17, 26, 7, 15, 1, 1, 433, 939, 'Average Working/Obedience Intelligence', '0.50', 26, 40, 3, 3, 3, 5, 4, 3, 3, 1, 3, 3, 3, 1, 2, 4, 5, 3, 4, 4, 5, 5, 4, 1, 5, 3, 1, 3, 5, 3, 'hound', '12.63', 'skin, spinal problems', 'acanthosis nigricans, Intervertebral disk disease', 3, 4, 1, 5),
(61, 'French Bulldog', 27, 31, 7, 13, 1, 1, 433, 843, 'Fair Working/Obedience Intelligence', '0.30', 41, 80, 2, 3, 4, 5, 5, 3, 4, 1, 5, 3, 2, 4, 2, 5, 4, 4, 3, 5, 4, 2, 3, 2, 3, 1, 2, 1, 2, 3, 'non-sporting', '9.00', 'none', 'none', 2, 2, 3, 5),
(62, 'Pug', 25, 28, 6, 10, 1, 1, 386, 692, 'Fair Working/Obedience Intelligence', '0.30', 41, 80, 2, 3, 4, 5, 5, 5, 4, 1, 5, 3, 3, 4, 1, 5, 4, 4, 2, 5, 5, 3, 3, 2, 2, 1, 2, 1, 2, 3, 'toy', '11.00', '\'dry eye\'', 'Keratoconjunctivitis sicca (KCS) - \"dry eye\"', 3, 3, 1, 5),
(63, 'Schipperke', 25, 34, 5, 9, 1, 1, 337, 640, 'Excellent Working Dogs', '0.85', 5, 15, 5, 3, 3, 4, 4, 3, 2, 1, 5, 5, 5, 2, 4, 4, 5, 3, 3, 5, 5, 2, 4, 1, 4, 3, 3, 2, 5, 3, 'non-sporting', '13.00', 'hair loss, diabetes, skin problems', 'colour dilution alopecia, Diabetes mellitus, Follicular dysplasias, Pemphigus', 3, 4, 1, 2),
(64, 'Sealyham Terrier', 30, 31, 8, 10, 1, 1, 479, 692, 'Fair Working/Obedience Intelligence', '0.30', 41, 80, 2, 4, 4, 4, 4, 4, 4, 3, 1, 4, 4, 3, 5, 4, 4, 2, 2, 4, 3, 2, 4, 2, 2, 2, 4, 3, 3, 3, 'terrier', '12.25', 'eye problems', 'Retinal dysplasia', 5, 3, 1, 1),
(65, 'Shiba Inu', 33, 41, 6, 14, 1, 1, 386, 891, 'Average Working/Obedience Intelligence', '0.50', 26, 40, 3, 4, 3, 5, 4, 4, 3, 1, 4, 4, 3, 3, 3, 4, 3, 2, 4, 3, 2, 3, 3, 2, 4, 5, 4, 3, 4, 4, 'non-sporting', '7.00', 'hip problems', 'hip dysplasia', 1, 1, 1, 4),
(66, 'Shih Tzu', 20, 28, 4, 8, 1, 1, 285, 586, 'Lowest Degree of Working/Obedience Intelligence', '0.00', 81, 100, 1, 3, 5, 5, 5, 3, 4, 1, 1, 2, 2, 5, 3, 5, 4, 3, 4, 4, 4, 4, 3, 1, 2, 3, 3, 1, 2, 3, 'toy', '13.20', 'eye problems', 'Exposure keratopathy syndrome (exophthalmos, lagophthalmos, and/or macroblepharon)', 4, 4, 1, 5),
(67, 'Skye Terrier', 25, 26, 11, 12, 1, 1, 608, 794, 'Fair Working/Obedience Intelligence', '0.30', 41, 80, 2, 4, 4, 4, 4, 3, 2, 1, 3, 3, 3, 5, 5, 4, 4, 4, 3, 4, 3, 4, 3, 2, 4, 2, 4, 4, 4, 4, 'terrier', '11.00', 'none', 'none', 3, 3, 1, 1),
(68, 'Tibetan Spaniel', 25, 26, 4, 7, 1, 1, 285, 530, 'Average Working/Obedience Intelligence', '0.50', 26, 40, 3, 3, 4, 5, 5, 3, 4, 1, 4, 3, 4, 3, 5, 4, 5, 3, 3, 4, 3, 3, 5, 1, 4, 1, 1, 2, 3, 4, 'non-sporting', '14.42', 'none', 'none', 5, 4, 2, 2),
(69, 'Tibetan Terrier', 35, 44, 9, 14, 1, 1, 523, 891, 'Fair Working/Obedience Intelligence', '0.30', 41, 80, 2, 4, 4, 5, 5, 1, 4, 1, 1, 5, 5, 3, 5, 3, 5, 4, 2, 5, 3, 2, 4, 2, 2, 1, 4, 4, 3, 3, 'non-sporting', '12.31', 'none', 'none', 3, 3, 2, 3),
(70, 'Whippet', 45, 56, 12, 14, 2, 1, 649, 891, 'Average Working/Obedience Intelligence', '0.50', 26, 40, 3, 3, 5, 5, 5, 2, 4, 1, 5, 5, 5, 4, 4, 3, 5, 2, 4, 5, 1, 5, 5, 3, 1, 2, 1, 4, 4, 3, 'hound', '12.87', 'none', 'none', 3, 4, 1, 4),
(71, 'Affenpinscher', 22, 31, 3, 6, 1, 1, 229, 472, 'Above Average Working Dogs', '0.70', 16, 25, 4, 3, 3, 5, 5, 1, 4, 1, 3, 4, 3, 3, 4, 4, 1, 3, 4, 4, 3, 3, 3, 1, 2, 1, 3, 3, 2, 1, 'toy', '11.42', 'none', 'none', 3, 3, 1, 1),
(72, 'Chihuahua', 15, 23, 0, 3, 1, 1, 0, 280, 'Fair Working/Obedience Intelligence', '0.30', 41, 80, 2, 3, 4, 5, 5, 2, 2, 1, 5, 3, 1, 2, 2, 4, 5, 2, 3, 4, 3, 3, 5, 1, 3, 1, 1, 2, 2, 2, 'toy', '16.50', 'knee problems', 'Patellar luxation', 5, 5, 1, 5),
(73, 'Italian Greyhound', 30, 39, 2, 5, 1, 1, 169, 411, 'Fair Working/Obedience Intelligence', '0.30', 41, 80, 2, 3, 5, 5, 5, 2, 4, 1, 5, 4, 4, 4, 3, 5, 5, 2, 4, 4, 2, 5, 5, 2, 3, 1, 1, 3, 3, 3, 'toy', '10.02', 'none', 'none', 2, 2, 1, 4),
(74, 'Japanese Chin', 20, 28, 1, 5, 1, 1, 100, 411, 'Fair Working/Obedience Intelligence', '0.30', 41, 80, 2, 3, 3, 5, 3, 3, 3, 1, 3, 2, 2, 4, 3, 4, 3, 1, 4, 4, 3, 3, 3, 1, 3, 1, 3, 2, 1, 3, 'toy', '9.25', 'none', 'none', 3, 2, 1, 3),
(75, 'Maltese', 20, 26, 1, 3, 1, 1, 100, 280, 'Fair Working/Obedience Intelligence', '0.30', 41, 80, 2, 3, 4, 5, 5, 2, 4, 1, 2, 3, 2, 2, 3, 5, 3, 3, 3, 4, 3, 4, 4, 1, 2, 1, 1, 3, 1, 3, 'toy', '12.25', 'heart problems', 'Patent ductus arteriosus (PDA)', 3, 3, 1, 5),
(76, 'Papillon', 20, 28, 2, 5, 1, 1, 169, 411, 'Brightest Dogs', '0.95', 1, 4, 5, 3, 4, 5, 5, 2, 4, 1, 3, 4, 5, 5, 3, 5, 3, 3, 3, 5, 3, 4, 3, 1, 2, 1, 2, 4, 1, 3, 'toy', '13.00', 'cataracts, hair loss, heart, eye, blood clotting disorders', 'Cataracts, Follicular dysplasias, Mitral valve dysplasia, Progressive retinal atrophy, von Willebrand\'s disease', 3, 4, 1, 4),
(77, 'Pomeranian', 30, 31, 1, 4, 1, 1, 100, 348, 'Excellent Working Dogs', '0.85', 5, 15, 5, 3, 3, 4, 5, 4, 2, 1, 2, 3, 2, 3, 3, 4, 2, 2, 2, 3, 4, 2, 4, 1, 5, 1, 4, 2, 1, 3, 'toy', '9.67', 'heart problems', 'Patent ductus arteriosus (PDA)', 2, 2, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(12) NOT NULL,
  `first_name` varchar(4) NOT NULL,
  `last_name` varchar(6) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(21) NOT NULL,
  `password` varchar(17) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `first_name`, `last_name`, `dob`, `email`, `password`) VALUES
(1, 'mpowell', 'Matt', 'Powell', '2000-06-02', 'matt@mpowell.tech', 'SpeedyCar21'),
(2, 'john_smith99', 'John', 'Smith', '1985-01-01', 'jsmith@hotmail.com', 'Testing123'),
(3, 'rick_astley', 'Rick', 'Astley', '1966-02-06', 'rick.astley@gmail.com', 'NeverG0nnaGiveUUp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dog_breeds`
--
ALTER TABLE `dog_breeds`
  ADD PRIMARY KEY (`breed_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dog_breeds`
--
ALTER TABLE `dog_breeds`
  MODIFY `breed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
