<form id="board">
    <input type="submit" value="Hit" name="action">
    <input type="submit" value="Stay" name="action">
    <input type="submit" value="Restart" name="action">
</form>

<?php
session_start();
if(isset($_SESSION['deck'])) {
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
}


function game()
{



    $phand = [];
    $hhand = [];

    if (empty($phand)) {
        array_push($phand, deal(), deal());
    }

    if (empty($hhand)) {
        array_push($hhand, deal(), deal());
    }
   if (isset($phand)&& isset($hhand)) {
       $ptotal = $phand[0]["value"] + $phand[1]["value"];
       $htotal = $hhand[0]["value"] + $hhand[1]["value"];
       $message = "Your cards are the ". $phand[0]["name"] . " and the " . $phand[1]["name"].".";
       $hmessage = "The house is showing the ". $hhand[1]["name"].".";
       echo $ptotal;
       echo '<br/>';
       echo $message;
       echo '<br/>';
       echo $hmessage;
   }

    if (!isset($_GET['action'])){
        switch($_GET['action']){
            case "Hit":
                array_push($phand, deal());
                break;
            case "Stay":
                scoring($phand, $hhand);
                break;
            case "Restart":
                session_unset();
               /* if(!isset($_SESSION['deck'])) {
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
                }*/
                break;
            default:
                break;
        }
    }

}


function deal(){
    return array_pop($_SESSION['shufdeck']);
}

function scoring($phand, $hhand){
    $ps = array_sum($phand);
    $hs = array_sum($hhand);
  /*  for ($x = 0; $x < count($phand); $x++){
        $ps = $ps + $phand[$x]["value"];
    }
    for ($x = 0; $x < count($hhand); $x++){
        $hs = $hs + $hhand[$x]["value"];
    }*/
    echo $ps;
    echo $hs;
}


echo game();

