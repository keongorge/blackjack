<?php
    Session_start();
?>

<form id="board">
    <input type="submit" value="Hit" name="action">
    <input type="submit" value="Stay" name="action">
    <input type="submit" value="Restart" name="action">
</form>

<?php

function setup(){
    session_unset();
    $_SESSION['deck'] = [
            ["name" => "ace of diamonds", "value" => 11],
            ["name" => "two of diamonds", "value" => 2],
            ["name" => "three of diamonds", "value" => 3],
            ["name" => "four of diamonds", "value" => 4],
            ["name" => "five of diamonds", "value" => 5],
            ["name" => "six of diamonds", "value" => 6],
            ["name" => "seven of diamonds", "value" => 7],
            ["name" => "eight of diamonds", "value" => 8],
            ["name" => "nine of diamonds", "value" => 9],
            ["name" => "ten of diamonds", "value" => 10],
            ["name" => "jack of diamonds", "value" => 10],
            ["name" => "queen of diamonds", "value" => 10],
            ["name" => "king of diamonds", "value" => 10],
            ["name" => "ace of hearts", "value" => 11],
            ["name" => "two of hearts", "value" => 2],
            ["name" => "three of hearts", "value" => 3],
            ["name" => "four of hearts", "value" => 4],
            ["name" => "five of hearts", "value" => 5],
            ["name" => "six of hearts", "value" => 6],
            ["name" => "seven of hearts", "value" => 7],
            ["name" => "eight of hearts", "value" => 8],
            ["name" => "nine of hearts", "value" => 9],
            ["name" => "ten of hearts", "value" => 10],
            ["name" => "jack of hearts", "value" => 10],
            ["name" => "queen of hearts", "value" => 10],
            ["name" => "king of hearts", "value" => 10],
            ["name" => "ace of spades", "value" => 11],
            ["name" => "two of spades", "value" => 2],
            ["name" => "three of spades", "value" => 3],
            ["name" => "four of spades", "value" => 4],
            ["name" => "five of spades", "value" => 5],
            ["name" => "six of spades", "value" => 6],
            ["name" => "seven of spades", "value" => 7],
            ["name" => "eight of spades", "value" => 8],
            ["name" => "nine of spades", "value" => 9],
            ["name" => "ten of spades", "value" => 10],
            ["name" => "jack of spades", "value" => 10],
            ["name" => "queen of spades", "value" => 10],
            ["name" => "king of spades", "value" => 10],
            ["name" => "ace of clubs", "value" => 11],
            ["name" => "two of clubs", "value" => 2],
            ["name" => "three of clubs", "value" => 3],
            ["name" => "four of clubs", "value" => 4],
            ["name" => "five of clubs", "value" => 5],
            ["name" => "six of clubs", "value" => 6],
            ["name" => "seven of clubs", "value" => 7],
            ["name" => "eight of clubs", "value" => 8],
            ["name" => "nine of clubs", "value" => 9],
            ["name" => "ten of clubs", "value" => 10],
            ["name" => "jack of clubs", "value" => 10],
            ["name" => "queen of clubs", "value" => 10],
            ["name" => "king of clubs", "value" => 10],
        ];
    $_SESSION['shufdeck'] = $_SESSION['deck'];
    shuffle($_SESSION['shufdeck']);
    $_SESSION['phand'] = [];
    $_SESSION['hhand'] = [];
    array_push($_SESSION['phand'], deal(), deal());
    array_push($_SESSION['hhand'], deal(), deal());
    $ptotal = $_SESSION['phand'][0]["value"] + $_SESSION['phand'][1]["value"];
    $htotal = $_SESSION['hhand'][0]["value"] + $_SESSION['hhand'][1]["value"];
    $message = "Your cards: ". $_SESSION['phand'][0]["name"] . " | " . $_SESSION['phand'][1]["name"];
    $hmessage = "House's card: ". $_SESSION['hhand'][1]["name"].".";
    echo $ptotal;
    echo '<br/>';
    echo $message;
    echo '<br/>';
    echo '<br/>';
    echo $hmessage;

}

function game()
{
    if (isset($_GET['action'])){
        switch($_GET['action']){
            case "Hit":
                array_push($_SESSION['phand'], deal());
                pscore();
                break;
            case "Stay":
                dturn();
                comp();
                break;
            case "Restart":
                setup();
                break;
            default:
                break;
        }
    }

}


function deal(){
    return array_pop($_SESSION['shufdeck']);
}

function dturn(){
    $hh = $_SESSION['hhand'];
    $hs = sumHand($hh);
    while ($hs < 17){
    array_push($_SESSION['hhand'], deal());
    $hh = $_SESSION['hhand'];
    $hs = sumHand($hh);
    }
}

function comp()
{
    $ph = $_SESSION['phand'];
    $ps = sumHand($ph);
    $hh = $_SESSION['hhand'];
    $hs = sumHand($hh);
    if (($hs > 21)&&($ps < 21)){
        echo "The house busts! You win!";
    }elseif ($ps > $hs){
        echo "You beat the house!";
    } elseif ($hs > $ps){
        echo "Aww shucks, the house wins...";
    } else if ($ps === $hs){
        echo "Huh... No one wins. At least you didn't loose!";
    }
    echo '<br/>';
    echo '<br/>';
    echo "Your total: " . $ps;
    echo '<br/>';
    echo "Your cards: " . hand($ph);
    echo '<br/>';
    echo '<br/>';
    echo "House's total: ". $hs;
    echo '<br/>';
    echo "House's cards: " . hand($hh);
}

function pscore(){
    $ph = $_SESSION['phand'];
    $ps = sumHand($ph);
    if ($ps < 21) {
        echo "Your total: " . $ps;
        echo '<br/>';
        echo "Your cards: " . hand($ph);
        echo '<br/>';
    } elseif ($ps > 21){
        echo "Your total: " . $ps;
        echo '<br/>';
        echo "Your cards: " . hand($ph);
        echo '<br/>';
        echo "Bust! You loose! Hit restart to try again.";
    }
}

function hscore() {
    $hh = $_SESSION['hhand'];
    $hs = sumHand($hh);
    echo "House's total: ". $hs;
    echo '<br/>';
    echo "House's cards: " . hand($hh);
 }

 function sumHand($hand) {
    	$total = 0;
    	foreach ($hand as $card) {
        		$total += $card['value'];
        	}
 	return $total;
 }

 function hand($hand){
     $names = "";
     foreach ($hand as $card){
         $names = $names. $card['name'] ." | ";
     }
     return $names;
 }

game();

