<?php

namespace achedon\statistiques\UI;

use achedon\statistiques\Main;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;

class AdminStatsUI extends SimpleForm{

    public static function adminstats(Player $player){

        $form = new SimpleForm(

            function (Player $player, int $data = null){
                if($data === null){
                    $player->sendMessage("§eFermeture de AdminStatsUI");

                    $db = Main::yo();
                    $db->set("$player",0);
                    $db->save();
                }
            }
        );

        $db = Main::yo();
        $playername = $db->get("$player");

        $dbK = Main::kill();
        $playerKill = $dbK->get("$playername");
        $dbD = Main::death();
        $playerDeath = $dbD->get("$playername");
        $dbBB = Main::blockBreak();
        $playerBlockBreakF = $dbBB->getNested($playername.'.fer');
        $playerBlockBreakO = $dbBB->getNested($playername.'.or');
        $playerBlockBreakD = $dbBB->getNested($playername.'.diamand');

        $form->setTitle("§c- §eStatsUI §c-");
        $form->setContent("§fPseudo : §c{$playername}\n§fFer Minés : §c{$playerBlockBreakF}\n§fOr Minés : §c{$playerBlockBreakO}\n§fDiamand Minés : §c{$playerBlockBreakD}\n§fKill : §c{$playerKill}\n§fMort : §c{$playerDeath}");
        $player->sendForm($form);
    }
}