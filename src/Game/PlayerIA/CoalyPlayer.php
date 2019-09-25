<?php

namespace Hackathon\PlayerIA;
use Hackathon\Game\Result;

/**
 * Class PaperPlayer
 * @package Hackathon\PlayerIA
 * @author Robin
 *
 */
class CoalyPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    public function getChoice()
    {

      $mySide = $this->result->getChoicesFor($this->mySide);
      $opponentSide = $this->result->getChoicesFor($this->mySide);
      //echo(count($length));
      //print_r($this->result->getChoicesFor($this->mySide));
      //echo($this->result->getChoicesFor($this->mySide)[0]);

      $nbRound = count($mySide);
      $contrary = false;
      if ($nbRound > 4)
      {
        if ($mySide[$nbRound - 1] == "paper" and $opponentSide[$nbRound - 1] == "rock" and
            $mySide[$nbRound - 2] == "rock" and $opponentSide[$nbRound - 2] == "paper" and
            $mySide[$nbRound - 3] == "paper" and $opponentSide[$nbRound - 3] == "rock")
        {
          $contrary = true;
        }
        else if ($mySide[$nbRound - 1] == "paper" and $opponentSide[$nbRound - 1] == "rock" and
                 $mySide[$nbRound - 2] == "rock" and $opponentSide[$nbRound - 2] == "paper" and
                 $mySide[$nbRound - 3] == "paper" and $opponentSide[$nbRound - 3] == "rock")
        {
          $contrary = true;
        }
        else if ($mySide[$nbRound - 1] == "paper" and $opponentSide[$nbRound - 1] == "rock" and
                 $mySide[$nbRound - 2] == "rock" and $opponentSide[$nbRound - 2] == "paper" and
                 $mySide[$nbRound - 3] == "paper" and $opponentSide[$nbRound - 3] == "rock")
        {
          $contrary = true;
        }
      }
        

      switch ($this->result->getLastChoiceFor($this->opponentSide)) {
        case "0":          
          return parent::scissorsChoice();  
          break;
        case "paper":
          if ($contrary)
            return parent::paperChoice();
          else
            return parent::scissorsChoice();  
          break;
        case "rock":
          if ($contrary)
            return parent::rockChoice();
          else
            return parent::paperChoice();  
          break;
        case "scissors":
          if ($contrary)
            return parent::scissorsChoice();
          else
            return parent::rockChoice(); 
          break;
      }
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Choice           ?    $this->result->getLastChoiceFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Choice ?    $this->result->getLastChoiceFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get all the Choices          ?    $this->result->getChoicesFor($this->mySide)
        // How to get the opponent Last Choice ?    $this->result->getChoicesFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
       // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get the stats                ?    $this->result->getStats()
        // How to get the stats for me         ?    $this->result->getStatsFor($this->mySide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // How to get the stats for the oppo   ?    $this->result->getStatsFor($this->opponentSide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // -------------------------------------    -----------------------------------------------------
        // How to get the number of round      ?    $this->result->getNbRound()
        // -------------------------------------    -----------------------------------------------------
        // How can i display the result of each round ? $this->prettyDisplay()
        // -------------------------------------    -----------------------------------------------------
        
        return parent::paperChoice();            
  }
};
