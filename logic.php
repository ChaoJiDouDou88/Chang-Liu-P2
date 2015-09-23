<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
?>

  <?php

  function max_number_error_checking(){
    $error_message = "";
    if (!isset($_POST["number_of_words"]) || (int)$_POST["number_of_words"] == 0) {
      $error_message = $error_message . "Please enter a number between 1 - 9 for number of words.<br>";
    }
    if (!isset($_POST["number_of_symbols"]) || (int)$_POST["number_of_symbols"] == 0 || (int)$_POST["number_of_symbols"] > 3) {
      $error_message = $error_message . "Please enter a number between 1 - 3 for number of symbols.<br>";
    }
    return $error_message;
  }

  function checkmark_error_checking(&$word_case, &$connection_symbol){
      $error_message = "";
      $word_case = "";
      $word_case_count = 0;
      $connection_symbol = "";
      $connection_symbol_count = 0;
      if (isset($_POST["upper_case"])) {
        $word_case = "upper_case";
        $word_case_count += 1;
      }
      if (isset($_POST["lower_case"])) {
        $word_case = "lower_case";
        $word_case_count += 1;
      }
      if (isset($_POST["first_letter_capitalize"])) {
        $word_case = "first_letter_capitalize";
        $word_case_count += 1;
      }
      if (isset($_POST["space"])) {
        $connection_symbol = "space";
        $connection_symbol_count += 1;
      }
      if (isset($_POST["hyphen"])) {
        $connection_symbol = "hyphen";
        $connection_symbol_count += 1;
      }
      if ($word_case_count == 0){
        $error_message = "Please choose one case type.<br>";
      } elseif ($word_case_count > 1) {
        $error_message = "Please only choose one case type.<br>";
      }
      if ($connection_symbol_count == 0) {
        $error_message = $error_message . "Please choose one connection symbol.<br>";
      } elseif ($connection_symbol_count > 1) {
        $error_message = $error_message . "Please only choose one connection symbol.<br>";
      }
      return $error_message;
  }

  function generate_password_segment($word_list, $symbol_list, $word_case){
      $password_segments = array();
      $number_of_words = (int)$_POST["number_of_words"];
      $number_of_symbols = (int)$_POST["number_of_symbols"];
      for ($i = 0; $i < $number_of_words; $i++) {
        $temp = $word_list[rand(0, sizeof($word_list)-1)];
        if ($word_case == "upper_case") {
          array_push($password_segments, strtoupper($temp));
        } elseif ($word_case == "lower_case") {
          array_push($password_segments, strtolower($temp));
        } else {
          array_push($password_segments, ucfirst($temp));
        }
      }

      for ($i = 0; $i < $number_of_symbols; ++$i) {
        $password_segments[$number_of_words - 1] = $password_segments[$number_of_words - 1] . $symbol_list[rand(0,7)];
      }

      if (isset($_POST["add_number"])) {
        $password_segments[$number_of_words - 1] = $password_segments[$number_of_words - 1] . rand(0,9);
      }
      return $password_segments;
  }

  function combine_passwords($password_segments, $connection_symbol){
    if ($connection_symbol == "space") {
      return implode(" ", $password_segments);
    } else {
      return implode("-", $password_segments);
    }
  }

  function password_generator(){
    $word_case = "";
    $connection_symbol = "";
    $files = array("http://www.paulnoll.com/Books/Clear-English/words-01-02-hundred.html",
                   "http://www.paulnoll.com/Books/Clear-English/words-03-04-hundred.html");
    $content = file_get_contents($files[0]) . file_get_contents($files[1]);
    preg_match_all("|<li>\s*\n\s*(\w*)\s*\n\s*</li>|U", $content, $out, PREG_PATTERN_ORDER);
    $word_list = $out[1];
    $symbol_list = array("!", "@", "#", "$", "%", "^", "&", "*");
    $error_message = max_number_error_checking() . checkmark_error_checking($word_case, $connection_symbol);

    if ($error_message != "") {
      return $error_message;
    } else {
      $passwords = generate_password_segment($word_list, $symbol_list, $word_case);
      return combine_passwords($passwords, $connection_symbol);
    }
  }

  $result = password_generator();

   ?>
