<?php

namespace achedon\statistiques\UI;

use achedon\statistiques\main;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;

class PlayerStatsUI extends SimpleForm{


    public static function player(Player $player){

        $form =new SimpleForm(

            function(Player $player,int $data = null){

                if($data === null){
                    $player->sendMessage("§eFermeture de StatsUI");
                }else{
                    if($data === 0){
                        $player->sendMessage("§eFermeture des Stats");
                    }
                }
            }
        );

        $playername = $player->getName();
        $dbK = Main::kill();
        $dbKpeople = $dbK->get("$playername");
        $dbD = Main::death();
        $dbDpeople = $dbD->get("$playername");

        $form->setTitle("§c- §eStatsUI §c-");
        $form->setContent("§fPseudo : {$playername}\n§fKill : {$dbKpeople}\n§fMort : {$dbDpeople}");
        $form->addButton("§c- §eFermer §c-");
        $player->sendForm($form);
    }
}