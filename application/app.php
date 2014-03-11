<?php

define(BASEURL, "http://localhost/flipupweb/");

// this is where fran should link her functions and files together

function pageInit(){
  session_start();
}

/**
 * this should print the page head to screen any parameters should be passed if
 * required
 */
function pageHead(){
  include 'template/pageHead.php';
}

/**
 * this should render the page footer
 */
function pageFoot(){
  include 'template/pageFoot.php';
}

/**
 * this should return the non relative link to the subject
 */
function getLinkForSubject($subjectID){
  return BASEURL."subject.php?id=".$subjectID;
}

function getBaseUrl(){
  return BASEURL;
}
