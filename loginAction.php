<?php

function incrementAttempt(){
    $_SESSION['attempts']++;
}

function resetAttempts(){
    $_SESSION['attempts'] = 0;
    unset($_SESSION['unlockTime']);
}

/**
 * Method is called after failed three login attempts.
 * It disables the text input as well as the buttons for 60 sec.
 * After 60 seconds has passed, resets the attempt counter;
 */
function lockUser(){
    //Lock user for 1 min
    if(!isset($_SESSION['unlockTime'])){
        $_SESSION['unlockTime'] = time() + 60;
        echo "You've been locked out for 60 sec!";
    }
    else if(time() < $_SESSION['unlockTime']){
        echo "You're still locked! Please try again in ".($_SESSION['unlockTime'] - time())." seconds";
    }
    else{ //If time is up, reset attempts
        resetAttempts();
        header('location: loginPage.php');
        exit;
    }
}

function login($username) {
    $_SESSION['username'] = $username;
    header("location: index.php");
    exit;
}
