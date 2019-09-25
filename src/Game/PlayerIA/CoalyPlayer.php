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

    // Return 1 for player1 winner, 0 equality, -1 for player2
    private function winner($choice1, $choice2)
    {
      if ($choice1 == $choice2)
        return 0;
      else if ($choice1 == "paper" and $choice2 == "rock")
        return 1;
      else if ($choice1 == "paper" and $choice2 == "scissors")
        return -1;
      else if ($choice1 == "rock" and $choice2 == "paper")
        return -1;
      else if ($choice1 == "rock" and $choice2 == "scissors")
        return 1;
      else if ($choice1 == "scissors" and $choice2 == "paper")
        return 1;
      else if ($choice1 == "scissors" and $choice2 == "rock")
        return -1;
      else
        return 0;
    }

    public function getChoice()
    {
      //get data and nb round
      $mySide = $this->result->getChoicesFor($this->mySide);
      $opponentSide = $this->result->getChoicesFor($this->mySide);
      $nbRound = count($mySide);

    

      // Check strat on the last maxround/2
      $stats1 = 0;
      // Check strat on the last maxround
      $stats2 = 0;
      $maxround = 6;
      if ($nbRound > $maxround + 1)
      {
        for ($i = 0; $i < $maxround; $i++)
        {
          if ($i < $maxround / 2)
          {
            $stats1 += $this->winner($mySide[$nbRound - $i - 1], $opponentSide[$nbRound - $i - 1]);
          }
          $stats2 += $this->winner($mySide[$nbRound - $i - 1], $opponentSide[$nbRound - $i - 1]);
          
        }
      }

      $option = 1;
      if ($stats1 < 0)
      {
        // Counter the counter of the counter play (chose the third option)
        if ($stats2 < 0 and $stats1 > $stats2)
        {
          //$option = 0;
          $option = -1;
        }
        else
        {
          // Counter the counter
          $option = -1;
        }
      }
        

      // Chose return value according to option value 
      switch ($this->result->getLastChoiceFor($this->opponentSide)) {
        case "0":          
          return parent::rockChoice();  
          break;
        case "paper":
          if ($option == -1)
            return parent::paperChoice();
          else if ($option == 1)
            return parent::scissorsChoice();  
          else
            return parent::rockChoice();
          break;
        case "rock":
          if ($option == -1)
            return parent::rockChoice();
          else if ($option == 1)
            return parent::paperChoice();
          else
            return parent::scissorsChoice();  
          break;
        case "scissors":
          if ($option == -1)
            return parent::scissorsChoice();
          else if ($option == 1)
            return parent::rockChoice();
          else
            return parent::paperChoice();
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
