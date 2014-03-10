-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 04, 2014 at 03:20 PM
-- Server version: 5.5.32-log
-- PHP Version: 5.5.9-pl0-gentoo

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `2013_comp10120_w2`
--

-- --------------------------------------------------------

--
-- Table structure for table `Deck`
--

DROP TABLE IF EXISTS `Deck`;
CREATE TABLE IF NOT EXISTS `Deck` (
  `deckID` int(11) NOT NULL AUTO_INCREMENT,
  `subjectID` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `userID` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `createdOn` date NOT NULL,
  PRIMARY KEY (`deckID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `Deck`
--

INSERT INTO `Deck` (`deckID`, `subjectID`, `name`, `userID`, `rating`, `createdOn`) VALUES
(1, 2, 'Java', 1, 0, '2014-03-04'),
(2, 2, 'Gaming Trivia', 1, 0, '2014-03-04'),
(3, 2, 'Python', 2, 0, '2014-03-04'),
(4, 1, 'English Literature', 2, 0, '2014-03-04'),
(5, 1, 'Romanian Literature', 3, 0, '2014-03-04'),
(6, 3, 'Logic', 3, 0, '2014-03-04'),
(7, 3, 'Probabilities', 3, 0, '2014-03-04'),
(8, 5, 'Arabic', 1, 0, '2014-03-04'),
(9, 5, 'Chinese', 1, 0, '2014-03-04'),
(10, 5, 'German', 1, 0, '2014-03-04'),
(11, 4, 'Zoology', 2, 0, '2014-03-04'),
(12, 4, 'Human Body', 2, 0, '2014-03-04');

-- --------------------------------------------------------

--
-- Table structure for table `Question`
--

DROP TABLE IF EXISTS `Question`;
CREATE TABLE IF NOT EXISTS `Question` (
  `questionID` int(11) NOT NULL AUTO_INCREMENT,
  `deckID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  `difficulty` int(11) NOT NULL,
  PRIMARY KEY (`questionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `Question`
--

INSERT INTO `Question` (`questionID`, `deckID`, `userID`, `data`, `difficulty`) VALUES
(1, 2, 1, '{   \r\n  "text":"Which long-running game serious was spawned by a company''s last attempt at making a game before closing?",\r\n  "answers:"[\r\n    {\r\n      "text":"Mega Man",\r\n      "correct":false\r\n    },\r\n    {\r\n      "text":"Dragon Quest",\r\n      "correct":false\r\n    },\r\n    {\r\n      "text":"Persona",\r\n      "correct":false\r\n    },\r\n    {\r\n      "text":"Final Fantasy",\r\n      "correct":true\r\n    }\r\n  ],\r\n  "type":"multiplechoice"\r\n}', 0),
(2, 2, 2, '{\r\n  "text":"Minecraft was created by Jeb.",\r\n  "answer":false,\r\n  "type":"truefalse"\r\n}', 0),
(3, 2, 3, '{\r\n  "text":"The theme to Pac-man is called Korobeiniki.",\r\n  "answer":false,\r\n  "type":"truefalse"\r\n}', 0),
(4, 2, 1, '{\r\n  "text":"The ghosts in pacman are called Inky, Blinky, Pinky and ____?",\r\n  "answers":[\r\n    {\r\n      "text":"Clyde",\r\n      "correct":true\r\n    }\r\n  ],\r\n  "type":"blanks",\r\n  "editdistance":1\r\n}', 0),
(5, 2, 2, '{\r\n  "text":"In Pac-man, each ghost has its own distinct AI.",\r\n  "answer":true,\r\n  "type":"truefalse"\r\n}', 0),
(6, 2, 3, '{\r\n  "text":"What was the first Pokemon that Ash Ketchum recieved?",\r\n  "answers":[\r\n    {\r\n      "text":"Pikachu",\r\n      "correct":true\r\n    },\r\n    {\r\n      "text":"Pidgey",\r\n      "correct":false\r\n    },\r\n    {\r\n      "text":"Augumon",\r\n      "correct":false\r\n    },\r\n    {\r\n      "text":"Bulbasaur",\r\n      "correct":false\r\n    }\r\n  ],\r\n  "type":"multiplechoice"\r\n}', 0),
(7, 2, 1, '{\r\n  "text":"What is the name of the protagonist in The Legend of Zelda?",\r\n  "answers":[\r\n    {\r\n      "text": "Link",\r\n      "correct":true\r\n    }\r\n  ],\r\n  "type":"blanks",\r\n  "editdistance":0\r\n}', 0),
(8, 2, 2, '{\r\n  "text":"ArenaNet created which MMORPG?",\r\n  "answers":[\r\n    {\r\n      "text":"Star Wars: The Old Republic",\r\n      "correct":false\r\n    },\r\n    {\r\n      "text":"Runescape",\r\n      "correct":false\r\n    },\r\n    {\r\n      "text":"Guild Wars 2",\r\n      "correct":true\r\n    },\r\n    {\r\n      "text":"World of Warcraft",\r\n      "correct":false\r\n    }\r\n  ],\r\n  "type":"multiplechoice"\r\n}', 0),
(9, 2, 3, '{\r\n  "text":"The R in RPG (gaming acronym) stands for what?",\r\n  "answers":[\r\n    {\r\n      "text":"Role",\r\n      "correct":true\r\n    }\r\n  ],\r\n  "type":"blanks",\r\n  "editdistance":0\r\n}', 0),
(10, 2, 1, '{\r\n  "text":"Enix Corporation merged with which rival company in 2003?",\r\n  "answers":[\r\n    {\r\n      "text":"Square Soft",\r\n      "correct":true\r\n    },\r\n    {\r\n      "text":"Nintendo",\r\n      "correct":false\r\n    },\r\n    {\r\n      "text":"Bethesda Softworks",\r\n      "correct":false\r\n    },\r\n    {\r\n      "text":"Kairosoft",\r\n      "correct":false\r\n    },\r\n  ],\r\n  "type":"multiplechoice"\r\n}\r\n', 0),
(11, 1, 2, '{\r\n  "text": "what is meaning of the symbol && ?",\r\n  "answers": [\r\n    {\r\n      "text":"and",\r\n      "correct":true\r\n    }\r\n    {\r\n      "text":"or",\r\n      "correct":false\r\n    }\r\n    {\r\n      "text":"not",\r\n      "correct":false\r\n    }\r\n    {\r\n      "text":"compile",\r\n      "correct":false\r\n    }\r\n  ] ,\r\n  "type":"mutiplechoice"\r\n}', 0),
(12, 1, 2, '{\r\n  "text":"Consider the following fragment of code:\r\n          \r\n          int temp, a = 1, b = 2;\r\n          temp = a;\r\n          b = a;\r\n          a = temp;\r\n\r\n          Which one of the following gives the values contained by the variables ’a’ and ’b’ after the above code is run?",\r\n  "answers": [\r\n    {\r\n      "text":"a = 1 and b = 1",\r\n      "correct":true\r\n    }\r\n    {\r\n      "text":"a = 1 and b = 2",\r\n      "correct":false\r\n    }\r\n    {\r\n      "text":"a = 2 and b = 1",\r\n      "correct":false\r\n    }\r\n    {\r\n      "text":"a = 2 and b = 2",\r\n      "correct":false\r\n    }\r\n    {\r\n      "text":"a = 2 and b = 2",\r\n      "correct":false\r\n    }\r\n  ] ,\r\n  "type":"mutiplechoice"\r\n}', 0),
(13, 1, 1, '{\r\n  "text":"Which one of the following is an illegal array declaration?",\r\n  "answers": [\r\n    {\r\n      "text":"int [] a;",\r\n      "correct":false\r\n    }\r\n    {\r\n      "text":"int [] a = new int[0]",\r\n      "correct":false\r\n    }\r\n    {\r\n      "text":"int [] a = new int[10]",\r\n      "correct":false\r\n    }\r\n    {\r\n      "text":"int [a] = new int[5]",\r\n      "correct":true\r\n    }\r\n    {\r\n      "text":"int [] a = new int[112358]",\r\n      "correct":false \r\n    }\r\n  ] ,\r\n  "type":"mutiplechoice"\r\n}', 0),
(14, 1, 3, '{\r\n  "text":"Does this symbol || mean or?",\r\n  "answers":true,\r\n  "type":"truefalse"\r\n}', 0),
(15, 1, 1, '{\r\n  "text":"what is function of word void in the main method?",\r\n  "answers": [\r\n    {\r\n      "text":"This main part can still return a value",\r\n      "correct":false\r\n    }\r\n    {\r\n      "text":"This main part can not return a value",\r\n      "correct":true\r\n    }\r\n    {\r\n      "text":"Like computer memory to remember things",\r\n      "correct":false\r\n    }\r\n    {\r\n      "text":"program arguments are passed to main method",\r\n      "correct":false\r\n    }\r\n  ] ,\r\n  "type":"mutiplechoice"\r\n}', 0),
(16, 1, 3, '{\r\n  "text":"Instances of classes are initialised via constructors. Which one of the following statements is TRUE?",\r\n  "answers": [\r\n    {\r\n      "text":"A class can have more than one constructor, as long as they have a different number of arguments, or the arguments have different types.",\r\n      "correct":true\r\n    }\r\n    {\r\n      "text":"A class can have more than one constructor, but only one of them can be a void method.",\r\n      "correct":false\r\n    }\r\n    {\r\n      "text":"A class can have more than one constructor, as long as they all have different names.",\r\n      "correct":false\r\n    }\r\n    {\r\n      "text":"A class can have more than one constructor, but only if they each have a different number of arguments.",\r\n      "correct":false\r\n    }\r\n    {\r\n      "text":"A class can have more than one constructor, as long as they have the same number and types of arguments.",\r\n      "correct":false \r\n    }\r\n  ] ,\r\n  "type":"mutiplechoice"\r\n}', 0),
(17, 1, 1, '{\r\n  "text":"Does this symbol x++ mean x = x + x",\r\n  "answers":false,\r\n  "type":"truefalse"\r\n}', 0),
(18, 1, 3, '{\r\n  "text":"If the answers have decimal number, which type should be used?",\r\n  "answers": [\r\n    {\r\n      "text":"int",\r\n      "correct":false\r\n    }\r\n    {\r\n      "text":"double",\r\n      "correct":true\r\n    }\r\n    {\r\n      "text":"boolean",\r\n      "correct":false\r\n    }\r\n    {\r\n      "text":"string",\r\n      "correct":false\r\n    }\r\n  ] ,\r\n  "type":"mutiplechoice"\r\n}', 0),
(19, 1, 1, '{\r\n  "text":"Consider the following program fragment:\r\n          \r\n          System.out.println( 1 + 2 + 3 + 4 + 5 + \\"-hello-\\" + (6 + 7 + 8 + 9) );\r\n\r\n          Which one of the following will be displayed when the above fragment is run?",\r\n\r\n  "answers": [\r\n    {\r\n      "text":"12345-hello-6789",\r\n      "correct":false\r\n    }\r\n    {\r\n      "text":"15-hello-30",\r\n      "correct":true\r\n    }\r\n    {\r\n      "text":"12345-hello-30",\r\n      "correct":false\r\n    }\r\n    {\r\n      "text":"15-hello-6789",\r\n      "correct":false\r\n    }\r\n    {\r\n      "text":"12345--6789",\r\n      "correct":false \r\n    }\r\n  ] ,\r\n  "type":"mutiplechoice",\r\n}', 0),
(20, 1, 1, '{\r\n  "text":"Is this condition 5 != 5 correct?",\r\n  "answers":false,\r\n  "type":"truefalse"\r\n}', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Quiz`
--

DROP TABLE IF EXISTS `Quiz`;
CREATE TABLE IF NOT EXISTS `Quiz` (
  `quizID` int(11) NOT NULL AUTO_INCREMENT,
  `questionsLeft` int(11) NOT NULL,
  `deckID` int(11) NOT NULL,
  `startedOn` date NOT NULL,
  `finishedOn` date NOT NULL,
  PRIMARY KEY (`quizID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Rating`
--

DROP TABLE IF EXISTS `Rating`;
CREATE TABLE IF NOT EXISTS `Rating` (
  `questionID` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Result`
--

DROP TABLE IF EXISTS `Result`;
CREATE TABLE IF NOT EXISTS `Result` (
  `quizID` int(11) NOT NULL,
  `correct` int(11) NOT NULL,
  `questionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Subject`
--

DROP TABLE IF EXISTS `Subject`;
CREATE TABLE IF NOT EXISTS `Subject` (
  `subjectID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`subjectID`),
  UNIQUE KEY `subjectID` (`subjectID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `Subject`
--

INSERT INTO `Subject` (`subjectID`, `name`) VALUES
(1, 'Literature'),
(2, 'Computer Science'),
(3, 'Maths'),
(4, 'Biology'),
(5, 'Languages');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
CREATE TABLE IF NOT EXISTS `User` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `aboutMe` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `picture` blob NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`userID`, `name`, `password`, `aboutMe`, `picture`) VALUES
(1, 'frannybabe', '', '', ''),
(2, 'jamesp', '', '', ''),
(3, 'raduboss', '', '', '');
